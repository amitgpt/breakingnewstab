<!-- Sidebar -->
<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

<!-- Sidebar - Brand -->
<a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{ route('admin.dashboard') }}">
  <div class="sidebar-brand-icon ">
  <img class="img-fluid" src="{{ url('images/news-logo.png') }}">
  </div>        
  <!-- <div class="sidebar-brand-text mx-3">Breaking NEWS Tab</div> -->
</a>

<!-- Divider -->
<hr class="sidebar-divider my-0">

<!-- Nav Item - Dashboard -->
<li class="nav-item active">
  <a class="nav-link" href="{{ route('admin.dashboard') }}">
    <i class="fas fa-fw fa-tachometer-alt"></i>
    <span>Dashboard</span></a>
</li>

<!-- Divider -->
<hr class="sidebar-divider">

<!-- Nav Item - Pages Collapse Menu -->
<li class="nav-item">
        <a class="nav-link {{ (request()->is('admin/rssfeeds') || request()->is('admin/rssfeeds/create')) ? 'active' : 'collapsed' }}" href="#" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="{{ (request()->is('admin/rssfeeds') || request()->is('admin/rssfeeds/create')) ? 'true' : 'false' }}" aria-controls="collapseTwo">
          <!-- <i class="fas fa-fw fa-cog"></i> -->
          <span>RSS Feeds</span>
        </a>
        <div id="collapseTwo" class="collapse {{ (request()->is('admin/rssfeeds') || request()->is('admin/rssfeeds/create') ) ? 'show' : '' }}" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
          <div class="bg-white py-2 collapse-inner rounded">            
            <a class="collapse-item {{ (request()->is('admin/rssfeeds')) ? 'active' : '' }}" href="{{ route('admin.rssfeeds') }}">Manage RSS Feeds</a>
            <a class="collapse-item {{ (request()->is('admin/rssfeeds/create')) ? 'active' : '' }}" href="{{ url('/admin/rssfeeds/create') }}">Add new RSS feeds</a>
          </div>
        </div>
      </li>
<!-- Divider -->
<hr class="sidebar-divider">

<!-- Sidebar Toggler (Sidebar) -->
<div class="text-center d-none d-md-inline">
  <button class="rounded-circle border-0" id="sidebarToggle"></button>
</div>

</ul>
<!-- End of Sidebar -->

 <!-- Content Wrapper -->
 <div id="content-wrapper" class="d-flex flex-column">

<!-- Main Content -->
<div id="content">