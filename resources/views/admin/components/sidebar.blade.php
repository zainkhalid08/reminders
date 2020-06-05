<!-- Sidebar -->
<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

  <!-- Sidebar - Brand -->
  <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{ route('admin.dashboard') }}">
    <div class="sidebar-brand-icon">
      <i class="fas fa-kaaba"></i>
    </div>
    <div class="sidebar-brand-text mx-3">Dashboard</div>
  </a>

  <!-- Divider -->
  <hr class="sidebar-divider my-0">


  <li class="nav-item">
    <a class="nav-link" href="{{ route('admin.post.create') }}">
      <i class="fas fa-fw fa-crosshairs"></i>
      <span>Create Post</span></a>
  </li> 

  <li class="nav-item">
    <a class="nav-link" href="{{ route('admin.post.index') }}">
      <i class="fas fa-fw fa-search"></i>
      <span>All Posts</span></a>
  </li>

  <li class="nav-item">
    <a class="nav-link" href="{{ route('admin.feedback.index') }}">
      <i class="fas fa-fw fa-comment-dots"></i>
      <span>Feedbacks</span></a>
  </li>

  <!-- Divider -->
  <hr class="sidebar-divider">

</ul>
<!-- End of Sidebar -->