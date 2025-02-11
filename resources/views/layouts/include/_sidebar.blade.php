<aside class="app-sidebar bg-body-secondary shadow" data-bs-theme="dark">
    <!--begin::Sidebar Brand-->
    <div class="sidebar-brand">
        <!--begin::Brand Link-->
        <a href="./index.html" class="brand-link">
            <!--begin::Brand Image-->
            {{-- <img src="#" alt="AdminLTE Logo" class="brand-image opacity-75 shadow" /> --}}
            <!--end::Brand Image-->
            <!--begin::Brand Text-->
            <span class="brand-text fw-light">Desry</span>
            <!--end::Brand Text-->
        </a>
        <!--end::Brand Link-->
    </div>
    <!--end::Sidebar Brand-->
    <!--begin::Sidebar Wrapper-->
    <div class="sidebar-wrapper">
        <nav class="mt-2">
            <!--begin::Sidebar Menu-->
            <ul class="nav sidebar-menu flex-column" data-lte-toggle="treeview" role="menu" data-accordion="false">
                @if(auth()->user()->role=='admin')
                <li class="nav-item">
                    <a href="{{ route(auth()->user()->role.'_dashboard') }}" class="nav-link">

                        <i class="nav-icon bi bi-palette active"></i>
                        <p>Dashboard</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route(auth()->user()->role.'_draft') }}" class="nav-link">
                        <i class="nav-icon bi bi-palette "></i>
                        <p>Draft</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon bi bi-speedometer"></i>
                        <p>
                            Setting
                            <i class="nav-arrow bi bi-chevron-right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route(auth()->user()->role.'_permintaan.index') }}" class="nav-link">
                                <i class="nav-icon bi bi-circle"></i>
                                <p>Permintaan</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route(auth()->user()->role.'_user.index') }}" class="nav-link">
                                <i class="nav-icon bi bi-circle"></i>
                                <p>User</p>
                            </a>
                        </li>
                    </ul>
                </li>
                @elseif(auth()->user()->role=='manager'))
                 <li class="nav-item">
                    <a href="{{ route(auth()->user()->role.'_draft') }}" class="nav-link">
                        <i class="nav-icon bi bi-palette "></i>
                        <p>Draft</p>
                    </a>
                </li>
                @endif


            </ul>
            <!--end::Sidebar Menu-->
        </nav>
    </div>
    <!--end::Sidebar Wrapper-->
</aside>
