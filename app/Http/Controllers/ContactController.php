<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\ContactMessage;
use App\Models\Product;
use App\Support\Whatsapp;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class ContactController extends Controller
{
    public function show(Request $request)
    {
        $categories = Category::active()->with(['products' => fn($q) => $q->active()])->get();
        $selectedProduct = $request->filled('product_id')
            ? Product::find($request->product_id)
            : null;

        $whatsappLink = Whatsapp::link($selectedProduct);

        return view('contact', compact('categories', 'selectedProduct', 'whatsappLink'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name'       => 'required|string|max:255',
            'email'      => 'required|email:filter|max:255',
            'phone'      => 'nullable|string|max:30',
            'product_id' => 'nullable|exists:products,id',
            'subject'    => 'nullable|string|max:255',
            'message'    => 'required|string|max:5000',
        ]);

        $message = ContactMessage::create($validated);

        $this->sendEmailNotification($message);

        return redirect()->route('contact')
            ->with('success', 'Votre message a été envoyé avec succès ! Nous vous contacterons bientôt.');
    }

    private function sendEmailNotification(ContactMessage $msg): void
    {
        $adminEmail = config('services.admin_email');

        if (!$adminEmail) {
            return;
        }

        $productName = $msg->product_id
            ? (Product::find($msg->product_id)?->name ?? 'Non précisé')
            : 'Non précisé';

        $body = "Nouvelle demande de commande — Electro Vitrine\n"
              . str_repeat('─', 50) . "\n\n"
              . "Nom      : {$msg->name}\n"
              . "Email    : {$msg->email}\n"
              . "Téléphone: " . ($msg->phone ?? 'Non fourni') . "\n"
              . "Produit  : {$productName}\n"
              . "Sujet    : " . ($msg->subject ?? 'Non précisé') . "\n\n"
              . "Message :\n" . $msg->message . "\n\n"
              . str_repeat('─', 50) . "\n"
              . "Voir dans l'admin : " . url('/admin/messages/' . $msg->id);

        $subject = $msg->subject
            ? "Nouvelle demande : {$msg->subject}"
            : "Nouvelle demande de commande de {$msg->name}";

        try {
            Mail::raw($body, function ($mail) use ($adminEmail, $subject, $msg) {
                $mail->to($adminEmail)
                     ->replyTo($msg->email, $msg->name)
                     ->subject($subject);
            });
        } catch (\Throwable $e) {
            Log::warning('Email notification failed: ' . $e->getMessage());
        }
    }
}
