<nav class="navbar sticky-top bg-body-tertiary">
    <div class="container">
        <a class="navbar-brand" href="{{route('posts.index')}}">
            <img src="{{ asset('logo.svg') }}" alt="Logo" width="30" height="24"
                class="d-inline-block align-text-top">
            <span class="fw-bold">Howl</span>
        </a>
        <div class="d-flex align-items-center">
            <button class="btn btn-primary" type="button" data-bs-toggle="offcanvas"
                data-bs-target="#offcanvasScrolling" aria-controls="offcanvasScrolling">
                <span class="material-symbols-outlined">Apps</span>
            </button>

            <div class="offcanvas offcanvas-end" data-bs-scroll="true" data-bs-backdrop="false" tabindex="-1"
                id="offcanvasScrolling" aria-labelledby="offcanvasScrollingLabel">
                <div class="offcanvas-header">
                    <h5 class="offcanvas-title" id="offcanvasScrollingLabel">{{auth()->user()->name}}</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                </div>
                <div class="offcanvas-body">
                    <ul class="navbar-nav">
                        <li class="nav-item">
                            <a href="{{route('posts.index')}}" class="nav-link">Blog feeds</a>
                        </li>
                        <li class="nav-item">
                            <a href="{{route('dashboard')}}" class="nav-link">Profile</a>
                        </li>
                        <li class="nav-item">
                            <a href="" class="nav-link">Account Center</a>
                        </li>
                        <li class="nav-item">
                            <a href="" class="nav-link">Settings</a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</nav>
