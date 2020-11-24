<li class="nav-item {{ request()->is('admin/orders*') ? 'active' : '' }}">
    <a class="nav-link" href="{{ route('backend.orders.index') }}">
        <i class="fa fa-shopping-cart"></i>
        <span>Orders</span>
    </a>
</li>