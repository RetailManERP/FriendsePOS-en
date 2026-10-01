<!--start sidebar -->
<aside class="sidebar-wrapper" data-simplebar="true">
  <div class="sidebar-header">
    <div class="logo-icon-div">
      <img src="<?php echo e(asset('favicon.ico'), false); ?>" class="logo-icon" alt="logo icon">
    </div>
    <div style="overflow: hidden; flex: 1; min-width: 0;">
      <h4 class="logo-text" style="white-space: nowrap; overflow: hidden; text-overflow: ellipsis;"><a href="<?php echo e(action([\Modules\Crm\Http\Controllers\DashboardController::class, 'index']), false); ?>" class="text-decoration-none" title="<?php echo e(Session::get('business.name'), false); ?>"><?php echo e(Session::get('business.name'), false); ?></a></h4>
    </div>
  </div>
  <!--navigation-->
  <?php echo Menu::render('contact-sidebar-menu', 'onedash'); ?>

  <!--end navigation-->
</aside>
<!--end sidebar -->
