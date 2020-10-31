<!-- need to remove -->
<li class="nav-item">
    <a href="{{ route('home') }}" class="nav-link {{ (request()->is('home')) ? 'active' : '' }}">
        <i class="nav-icon fa fa-tachometer-alt"></i>
        <p>Dashboard</p>
    </a>
</li>

<li class="nav-item">
    <a href="{{ url('/calendar') }}" class="nav-link {{ (request()->is('calendar*')) ? 'active' : '' }}">
        <i class="nav-icon fa fa-calendar-alt"></i>
        <p>Calendar</p>
    </a>
</li>

<li class="nav-item">
    <a href="{{ url('/church') }}" class="nav-link {{ (request()->is('church*')) ? 'active' : '' }}">
        <i class="nav-icon fas fa-church"></i>
        <p>Church</p>
    </a>
</li>

<li class="nav-item">
    <a href="{{ url('/baptismal') }}" class="nav-link {{ (request()->is('baptismal*')) ? 'active' : '' }}">
        <i class="nav-icon fa fa-child"></i>
        <p>Baptismal</p>
    </a>
</li>

<li class="nav-item">
    <a href="{{ url('/first-communion') }}" class="nav-link {{ (request()->is('first-communion*')) ? 'active' : '' }}">
        <i class="nav-icon fas fa-pray"></i>
        <p>First Communion</p>
    </a>
</li>

<li class="nav-item">
    <a href="{{ url('/confirmation') }}" class="nav-link {{ (request()->is('confirmation*')) ? 'active' : '' }}">
        <i class="nav-icon fas fa-bible"></i>
        <p>Confirmation</p>
    </a>
</li>

<li class="nav-item">
    <a href="{{ url('/marriage') }}" class="nav-link {{ (request()->is('marriage*')) ? 'active' : '' }}">
        <i class="nav-icon fas fa-dove"></i>
        <p>Marriage</p>
    </a>
</li>

<li class="nav-item">
    <a href="{{ url('/import-records') }}" class="nav-link {{ (request()->is('import-records*')) ? 'active' : '' }}">
        <i class="nav-icon fas fa-file-import"></i>
        <p>Import Records</p>
    </a>
</li>

<li class="nav-item">
    <a href="{{ url('/reports') }}" class="nav-link {{ (request()->is('reports*')) ? 'active' : '' }}">
        <i class="nav-icon fa fa-users"></i>
        <p>User Management</p>
    </a>
</li>

<li class="nav-item">
    <a href="{{ url('/reports') }}" class="nav-link {{ (request()->is('reports*')) ? 'active' : '' }}">
        <i class="nav-icon fa fa-cog"></i>
        <p>Account Settings</p>
    </a>
</li>