<aside id="sidebar" class="js-sidebar">
    <div class="h-100">
        <div class="sidebar-logo mb-2">
            <a href="#">
                <img src="{{ asset('images/handbag.png') }}" class="me-1 pb-1" alt="Icon Handbag">
                SIMS Web App
            </a>
        </div>
        <ul class="sidebar-nav">
            <li class="sidebar-item {{ request()->routeIs('products.index') ? 'active' : '' }}">
                <a href="{{ route('products.index') }}" class="sidebar-link">
                    <img src="{{ asset('images/package.png') }}" class="pe-2" alt="Package">
                    Produk
                </a>
            </li>
            <li class="sidebar-item {{ request()->routeIs('profile.index') ? 'active' : '' }}">
                <a href="{{ route('profile.index') }}" class="sidebar-link">
                    <img src="{{ asset('images/user.png') }}" class="pe-2" alt="Profile">
                    Profil
                </a>
            </li>
            <li class="sidebar-item">
                <form action="{{ route('logout') }}" method="POST" class="d-inline-block ps-2">
                    @csrf
                    <button type="submit" class="btn sidebar-link text-white"
                        style="font-size: 14px; font-weight: 500">
                        <img src="{{ asset('images/logout.png') }}" class="pe-2" alt="Logout">
                        Logout
                    </button>
                </form>
            </li>
        </ul>
    </div>
</aside>
