<aside class="main-sidebar sidebar-dark-danger elevation-4">
    <!-- Brand Logo -->
    <a href="{{route('admin.dashboard')}}" class="brand-link">
        <img src="{{ asset('icon/stopuno_logo.png') }}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
        <span class="brand-text font-weight-light">Stopuno</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user (optional) -->
        {{-- <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <img src="https://adminlte.io/themes/v3/dist/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image">
            </div>
            <div class="info">
                <a href="#" class="d-block">John Doe</a>
            </div>
        </div>

        <!-- SidebarSearch Form -->
        <div class="form-inline">
            <div class="input-group" data-widget="sidebar-search">
                <input class="form-control form-control-sidebar" type="search" placeholder="Search"
                    aria-label="Search">
                <div class="input-group-append">
                    <button class="btn btn-sidebar">
                        <i class="fas fa-search fa-fw"></i>
                    </button>
                </div>
            </div>
        </div> --}}

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <!-- Add icons to the links using the .nav-icon class with font-awesome or any other icon font library -->
                @foreach(config('menu.admin') as $menu)
                    @php
                        $hasSubmenu = (isset($menu["submenu"]) ? true : false);
                        $active = false;
                        $currentUrl = Route::current()->getName();
                        // $breadcrumb = "";
                        if($hasSubmenu){
                            $active = array_search($currentUrl, array_column($menu['submenu'], 'route'));
                            // $breadcrumb .= $menu['title'];
                        }else{
                            $active = array_search($currentUrl, $menu);
                        }

                        if($currentUrl == $menu['route']){
                            $breadcrumb = $menu['title'];
                            // dd($menu['title']);
                        }elseif(str_contains($currentUrl, $menu['route'])){
                            $breadcrumb = $menu['title'];
                        }

                    @endphp
                    @if(!empty($menu['module']))
                    @can('view-'.$menu['module'])
                    @endif
                    <li class="nav-item {{ $active === false ? '' : 'menu-open'}}">
                        <a href="{{!empty($menu['route']) ? route($menu['route']) : '#'}}" class="nav-link  {{(!empty($menu['route']) && str_contains($currentUrl, $menu['route'])) ? 'active' : ''}}">
                            <i class="nav-icon {{$menu['icon']}}"></i>
                            <p>
                                {{$menu['title']}}
                                @if($hasSubmenu)
                                    <i class="right fas fa-angle-left"></i>
                                @endif
                            </p>
                        </a>
                        @if($hasSubmenu)
                            @foreach($menu['submenu'] as $submenu)
                                <ul class="nav nav-treeview">
                                    <li class="nav-item">
                                        <a href="{{!empty($submenu['route']) ? route($submenu['route']) : '#'}}" class="nav-link {{$currentUrl == $submenu['route'] ? 'active' : ''}}">
                                            <i class="far fa-circle nav-icon"></i>
                                            <p>{{$submenu['title']}}</p>
                                        </a>
                                    </li>
                                </ul>
                            @endforeach
                        @endif
                    </li>
                    @if(!empty($menu['module']))
                    @endcan
                    @endif
                @endforeach

                @section('breadcrumb')
                    <li class="breadcrumb-item {{$hasSubmenu ? "" : "active"}}">
                        {{ $breadcrumb }}
                    </li>
                @endsection
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>
