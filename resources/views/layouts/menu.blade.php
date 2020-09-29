<!-- need to remove -->
<li class="nav-item">
    <a href="{{ route('home') }}" class="nav-link {{ (request()->is('home')) ? 'active' : '' }}">
        <i class="nav-icon fa fa-tachometer-alt"></i>
        <p>Dashboard</p>
    </a>
</li>
