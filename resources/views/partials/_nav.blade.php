<nav class="navbar sticky-top bg-body-tertiary">
    <div class="container">
        <a class="navbar-brand" href="{{ route('posts.index') }}">
            <img src="{{ asset('logo.svg') }}" alt="Logo" width="30" height="24"
                class="d-inline-block align-text-top">
            <span class="fw-bold">Howl</span>
        </a>
        <a href="{{ route('dashboard') }}" class="d-flex align-items-center text-decoration-none">
            <span class="material-symbols-outlined">face</span>
            <small class="text-secondary ms-2">{{ auth()->user()->name }}</small>
        </a>
    </div>
</nav>
