<!-- Left side column. contains the logo and sidebar -->
<aside class="main-sidebar">
  <!-- sidebar: style can be found in sidebar.less -->
  <section class="sidebar">
    <!-- Sidebar user panel -->
    <div class="user-panel">
      <div class="pull-left image">
        <img src="{{asset('dist/img/user2-160x160.jpg') }}" class="img-circle" alt="User Image">
      </div>
      @php ($user = \Auth::user())
      <div class="pull-left info">
        <p>{{ $user->name }}</p>
      </div>
    </div>
    <!-- sidebar menu: : style can be found in sidebar.less -->
    <ul class="sidebar-menu" data-widget="tree">
      <li class="header">MAIN NAVIGATION</li>
      <li class="{{ \Request::route()->getPrefix() == '/admin' ? 'active' : '' }}">
        <a href="{{ route('dashboard') }}">
          <i class="fa fa-dashboard"></i> <span>Dashboard</span>
          <span class="pull-right-container">
        </a>
      </li>
      
      <li class="treeview {{ \Request::route()->getPrefix() == 'admin/customers' ? 'active menu-open' : '' }}">
        <a href="#">
          <i class="fa fa-user-o"></i>
          <span>Customers</span>
          <span class="pull-right-container">
            <i class="fa fa-angle-left pull-right"></i>
          </span>
        </a>
        <ul class="treeview-menu" style="display: {{ \Request::route()->getPrefix() == 'admin/customers' ? 'block' : 'none' }}">
          <li class="{{ \Request::route()->getName() == 'customer-list' ? 'active' : '' }}"><a href="{{ route('customer-list') }}"><i class="fa fa-circle-o"></i> List</a></li>
        </ul>
      </li>

      <li class="treeview {{ \Request::route()->getPrefix() == 'admin/video-categories' ? 'active menu-open' : '' }}">
        <a href="#">
          <i class="fa fa-user-o"></i>
          <span>Video Categories</span>
          <span class="pull-right-container">
            <i class="fa fa-angle-left pull-right"></i>
          </span>
        </a>
        <ul class="treeview-menu" style="display: {{ \Request::route()->getPrefix() == 'admin/video-categories' ? 'block' : 'none' }}">
          <li class="{{ \Request::route()->getName() == 'video-category-list' ? 'active' : '' }}"><a href="{{ route('video-category-list') }}"><i class="fa fa-circle-o"></i> List</a></li>
          <li class="{{ \Request::route()->getName() == 'video-category-add' ? 'active' : '' }}"><a href="{{ route('video-category-add') }}"><i class="fa fa-circle-o"></i> Add</a></li>
        </ul>
      </li>
      
      <li class="treeview {{ \Request::route()->getPrefix() == 'admin/videos' ? 'active menu-open' : '' }}">
        <a href="#">
          <i class="fa fa-user-o"></i>
          <span>Videos</span>
          <span class="pull-right-container">
            <i class="fa fa-angle-left pull-right"></i>
          </span>
        </a>
        <ul class="treeview-menu" style="display: {{ \Request::route()->getPrefix() == 'admin/videos' ? 'block' : 'none' }}">
          <li class="{{ \Request::route()->getName() == 'video-list' ? 'active' : '' }}"><a href="{{ route('video-list') }}"><i class="fa fa-circle-o"></i> List</a></li>
          <li class="{{ \Request::route()->getName() == 'video-add' ? 'active' : '' }}"><a href="{{ route('video-add') }}"><i class="fa fa-circle-o"></i> Add</a></li>
        </ul>
      </li>

      <li class="treeview {{ \Request::route()->getPrefix() == 'admin/coupons' ? 'active menu-open' : '' }}">
        <a href="#">
          <i class="fa fa-user-o"></i>
          <span>Coupons</span>
          <span class="pull-right-container">
            <i class="fa fa-angle-left pull-right"></i>
          </span>
        </a>
        <ul class="treeview-menu" style="display: {{ \Request::route()->getPrefix() == 'admin/coupons' ? 'block' : 'none' }}">
          <li class="{{ \Request::route()->getName() == 'coupon-list' ? 'active' : '' }}"><a href="{{ route('coupon-list') }}"><i class="fa fa-circle-o"></i> List</a></li>
          <li class="{{ \Request::route()->getName() == 'coupon-add' ? 'active' : '' }}"><a href="{{ route('coupon-add') }}"><i class="fa fa-circle-o"></i> Add</a></li>
        </ul>
      </li>

    </ul>
  </section>
  <!-- /.sidebar -->
</aside>