<li class="nav-item {{ request()->is('admin/users*') ? 'active' : '' }}">
    <a class="nav-link" href="{{ route('backend.users.index') }}">
        <i class="fas fa-users"></i>
        <span>Users</span>
    </a>
</li>