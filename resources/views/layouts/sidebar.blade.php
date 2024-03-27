<aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">
    <div class="app-brand demo">
        <a href="index.html" class="app-brand-link">
            <span class="app-brand-logo demo">
                <img src="{{asset('login_assets/img/hslogo.png')}}" alt="" width="25" height="25" class="my-3" >
            </span>
            <span class="app-brand-text demo menu-text fw-bolder ms-2">Space Health</span>
        </a>

        <a href="javascript:void(0);" class="layout-menu-toggle menu-link text-large ms-auto d-block d-xl-none">
            <i class="bx bx-chevron-left bx-sm align-middle"></i>
        </a>
    </div>

    <div class="menu-inner-shadow"></div>

    <ul class="menu-inner py-1">

    @if(auth()->user()->role == 'admin')
        <!-- Dashboard -->
        <li class="menu-item {{ request()->is('admin/dashboard') ? 'active' : ''  }}">
            <a href="{{url('admin/dashboard')}}" class="menu-link">
                <i class="menu-icon tf-icons bx bx-home-circle"></i>
                <div>Dashboard</div>
            </a>
        </li>

           <!-- Dashboard -->
           <!-- <li class="menu-item {{ request()->is('admin/poli') ? 'active' : ''  }} ">
            <a href="{{url('admin/poli')}}" class="menu-link">
                <i class="menu-icon tf-icons bx bx-first-aid"></i>
                <div>Poli</div>
            </a>
        </li> -->

           <!-- Dashboard -->
           <li class="menu-item {{ request()->is('admin/dokter') ? 'active' : ''  }} ">
            <a href="{{url('admin/dokter')}}" class="menu-link">
                <i class="menu-icon tf-icons bx bx-git-repo-forked"></i>
                <div>Dokter</div>
            </a>
        </li>

    @endif

        
    </ul>
</aside>