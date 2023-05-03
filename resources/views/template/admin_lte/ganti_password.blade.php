<!-- User Account: style can be found in dropdown.less -->
<form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
     @csrf
</form>
<li class="dropdown user user-menu">
    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
        <img src="{{ asset('public/admin_lte/img/user2-160x160.jpg') }}" class="user-image" alt="User Image">
        <span class="hidden-xs">{{ auth()->user()->nama_user }}</span>
    </a>
    <ul class="dropdown-menu">
    <!-- User image -->
        <li class="user-header">
            <img src="{{ asset('public/admin_lte/img/user2-160x160.jpg') }}" class="img-circle" alt="User Image">
            <p>
            {{ auth()->user()->nama_user }} - {{ Session::get('role')->nama_role }}
                <small> {{ date("D, d M Y") }}</small>
            </p>
        </li>
        <!-- Menu Body -->
        <!-- <li class="user-body">
        <div class="col-xs-4 text-center">
            <a href="#">Followers</a>
        </div>
        <div class="col-xs-4 text-center">
            <a href="#">Sales</a>
        </div>
        <div class="col-xs-4 text-center">
            <a href="#">Friends</a>
        </div>
        </li> -->
        <!-- Menu Footer-->
        <li class="user-footer">
        <div class="pull-left">
            <a href="ganti-password" class="btn btn-default btn-flat">Ganti Password</a>
        </div>
        <div class="pull-right">
            <a href="#" 
                onclick="event.preventDefault();
                document.getElementById('logout-form').submit();" class="btn btn-default btn-flat">Sign out</a>
        </div>
        </li>
  </ul>
</li>