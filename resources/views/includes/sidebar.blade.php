  <!-- Sidebar -->
  <div class="sidebar">
      <!-- Sidebar user panel (optional) -->

      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
        <img src="{{url('profile')}}/{{Auth::user()->profil}}" class="img-circle elevation-2" alt="User Image">
            {{-- <img class="direct-chat-img" src="{{url('profile')}}/{{Auth::user()->profil}}" alt="message user image"> --}}
            <!-- <img class="profile-user-img img-fluid img-circle" src="{{url('profile')}}/{{Auth::user()->profil}}"
            alt="User profile picture"> -->
        </div>
        <div class="info">
          <a href="#" class="d-block">{{ Auth::user()->name }}</a>
        </div>
      </div>
      <!-- Sidebar Menu -->
      <nav class="mt-2">
          <ul class="nav nav-pills nav-sidebar flex-column nav-legacy" data-widget="treeview" role="menu" data-accordion="false">
              <?php
            $role_id = Auth::user()->role_id; 
            $menu =  DB::table('menus')
            ->join('access_menus', 'menus.id', '=', 'access_menus.menu_id')
            ->where('role_id',$role_id)
            ->where('is_active','1')
            ->select('menus.*')
            ->orderBy('urut', 'ASC')
            ->get(); 
         
           ?>

              <!-- Menu -->
              @foreach ($menu as $m)
              <?php
            $menuId =$m->id;
            
            $sub_menu =  DB::table('sub_menus')
            ->join('menus', 'sub_menus.menu_id', '=', 'menus.id')
            ->join('access_sub_menus', 'sub_menus.id', '=', 'access_sub_menus.sub_menu_id')
            ->where('sub_menus.menu_id',$menuId)
            ->where('access_sub_menus.sub_role_id',$role_id)
            ->where('sub_menus.is_active','1')
            ->orderBy('urut_sub', 'ASC')
            ->get(); 
              ?>

              @if ($m->url == "")
              <li
                  class="nav-item has-treeview  @foreach ($sub_menu as $sm) {{ (request()->is($sm->sub_url)) ? 'menu-open' : '' }}  @endforeach ">
                  <a href="#"
                      class="nav-link @foreach ($sub_menu as $sm) {{ (request()->is($sm->sub_url)) ? 'active' : '' }}  @endforeach ">
                      <i class="{{$m->icon}}"></i>
                      <p>
                          {{$m->menu}}
                          <i class="right fas fa-angle-left"></i>
                      </p>
                  </a>

                  <ul class="nav nav-treeview">
                      @foreach ($sub_menu as $sm)
                      <li class="nav-item">
                          <a href="{{url('/')}}/{{$sm->sub_url}}"
                              class="nav-link {{ (request()->is($sm->sub_url)) ? 'active' : '' }}">
                              <i class="far fa-circle nav-icon"></i>
                              <p>{{$sm->sub}}</p>
                          </a>
                      </li>
                      @endforeach

                  </ul>

              </li>


              @else
              <li class="nav-item">
                  <a href="{{url('/')}}/{{$m->url}}"
                      class="nav-link {{ Request::segment(1) == $m->url ? 'active' : '' }}">
                      <i class="{{$m->icon}}"></i>
                      <p>{{$m->menu}}</p>
                  </a>
              </li>
              @endif





              @endforeach


          </ul>
      </nav>
      <!-- /.sidebar-menu -->
  </div>
  <!-- /.sidebar -->
