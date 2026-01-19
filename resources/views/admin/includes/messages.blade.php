@if (session('success'))
<div class="alert alert-success auto-hide">
    {{ session('success') }}
</div>
@endif

@if (session('error'))
<div class="alert alert-danger auto-hide">
    {{ session('error') }}
</div>
@endif