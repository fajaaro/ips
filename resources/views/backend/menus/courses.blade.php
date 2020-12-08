<li class="nav-item {{ request()->is('admin/course*') ? 'active' : '' }}">
    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUtilities" aria-expanded="true" aria-controls="collapseUtilities">
        <i class="fas fa-book-open"></i>
        <span>Courses</span>
    </a>
    <div id="collapseUtilities" class="collapse" aria-labelledby="headingUtilities" data-parent="#accordionSidebar">
        <div class="bg-white py-2 collapse-inner rounded">
            <h6 class="collapse-header">Section:</h6>
            <a class="collapse-item" href="{{ route('backend.courses.index') }}">List Courses</a>
            <a class="collapse-item" href="{{ route('backend.course-categories.index') }}">Categories</a>
            <a class="collapse-item" href="{{ route('backend.course-bundles.index') }}">Bundles</a>
        </div>
    </div>
</li>