<div class="sidebar-wrapper">
    <nav class="mt-2">
        <!--begin::Sidebar Menu-->
        <ul class="nav sidebar-menu flex-column" data-lte-toggle="treeview" role="navigation" aria-label="Main navigation"
            data-accordion="false" id="navigation">
            <li class="nav-header">Admin Panel</li>
            <li class="nav-item">
                <a href="./docs/introduction.html" class="nav-link">
                    <i class="nav-icon bi bi-clipboard-fill"></i>
                    <p>Posts</p>
                    <span class="nav-badge badge text-bg-secondary">{{ $posts->total() }}</span>
                </a>
            </li>
        </ul>
        <!--end::Sidebar Menu-->
    </nav>
</div>
