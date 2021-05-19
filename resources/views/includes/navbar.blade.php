    <!-- Navbar -->
    <nav class="main-header navbar navbar-expand navbar-white navbar-light">
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
            </li>
        </ul>
        <ul class="navbar-nav ml-auto">

            <li class="nav-item dropdown">
                <a class="nav-link" data-toggle="dropdown" href="#">
                    <i class="far fa-user"></i>
                </a>
                <div class="dropdown-menu dropdown-menu-right">
                    <span class="dropdown-item dropdown-header">{{ Auth::user()->name }}</span>
                    <div class="dropdown-divider"></div>
                    <a href="{{url('profil')}}" class="dropdown-item">
                        <i class="fas fa-user-edit mr-2"></i> Profile
                    </a>
                    <div class="dropdown-divider"></div>
                    <a href="#" onclick="logout(); return false;" class="dropdown-item">
                        <i class="fas fa-sign-out-alt mr-2"></i> Logout

                    </a>

                </div>
            </li>

        </ul>
    </nav>
    <!-- /.navbar -->
