<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ContactMessage extends Model
{
    protected $fillable = ['name', 'email', 'phone', 'product_id', 'subject', 'message', 'is_read'];

    protected $casts = ['is_read' => 'boolean'];

    public function product()
    {
        return $this->belongsTo(Product::class)->withDefault();
    }

    public function scopeUnread($query)
    {
        return $query->where('is_read', false);
    }
}
