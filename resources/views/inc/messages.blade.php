@forelse($errors->all() as $error)
    <div class="container">
        <div class="alert alert-danger">
            {{ $error }}
        </div>
    </div>
@empty

@endforelse

@if (session('success'))
    <div class="container">
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    </div>
@elseif(session('error'))
    <div class="container">
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    </div>
@endif