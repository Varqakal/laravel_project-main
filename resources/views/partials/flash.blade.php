@if(session('success'))
    <div x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 5000)"
         x-transition class="alert alert-success alert-dismissible d-flex align-items-center mb-3" role="alert">
        <span>{{ session('success') }}</span>
        <button type="button" @click="show = false" class="btn-close ms-auto"></button>
    </div>
@endif

@if(session('error'))
    <div x-data="{ show: true }" x-show="show"
         x-transition class="alert alert-danger alert-dismissible d-flex align-items-center mb-3" role="alert">
        <span>{{ session('error') }}</span>
        <button type="button" @click="show = false" class="btn-close ms-auto"></button>
    </div>
@endif
