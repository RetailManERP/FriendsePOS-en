<?php $request = app('Illuminate\Http\Request'); ?>
<!--start top header-->
<style>
    .top-header {
        --header-icon-size: 34px;
        --header-icon-font-size: 15px;
    }
    .top-header .navbar {
        display: flex;
        align-items: center;
        flex-wrap: wrap;
        gap: 0.5rem;
        min-height: 0 !important;
        padding: 0.45rem 0.75rem;
        align-content: center;
    }
    .top-header .top-navbar-left {
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
        flex: 0 0 auto;
    }
    .top-header .top-navbar-actions {
        margin-left: auto;
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
        min-width: 0;
    }
    .top-header .top-navbar-right {
        flex: 0 1 auto;
        min-width: 0;
        margin-left: 0 !important;
    }
    .top-header .top-navbar-right .navbar-nav {
        display: flex;
        align-items: center;
        flex-wrap: wrap;
        justify-content: flex-end;
        gap: 0.35rem !important;
    }
    .top-header .toggle-icon .icon-close {
        display: none;
    }
    .top-header .toggle-icon.is-open .icon-open {
        display: none;
    }
    .top-header .toggle-icon.is-open .icon-close {
        display: inline-block;
    }
    .top-header .dropdown-user-setting {
        margin-left: 0;
    }
    .top-header .toggle-icon {
        position: relative;
        z-index: 2;
        cursor: pointer;
        width: var(--header-icon-size);
        height: var(--header-icon-size);
        display: inline-flex !important;
        align-items: center;
        justify-content: center;
        border-radius: 6px;
    }
    @media (max-width: 1024px) {
        .sidebar-wrapper,
        .wrapper.toggled .sidebar-wrapper,
        .wrapper.sidebar-hovered .sidebar-wrapper {
            z-index: 1060 !important;
        }
        .top-header {
            z-index: 1040 !important;
        }
        .wrapper.toggled .top-header .top-navbar-right,
        .wrapper.sidebar-hovered .top-header .top-navbar-right,
        .wrapper.toggled .top-header .dropdown-user-setting,
        .wrapper.sidebar-hovered .top-header .dropdown-user-setting {
            pointer-events: none;
        }
        .wrapper.toggled .top-header .toggle-icon,
        .wrapper.sidebar-hovered .top-header .toggle-icon {
            position: fixed;
            left: 12px;
            top: 12px;
            z-index: 1070;
            pointer-events: auto;
            width: 38px;
            height: 38px;
            display: inline-flex !important;
            align-items: center;
            justify-content: center;
            border-radius: 8px;
            background: #ffffff;
            border: 1px solid #d9dee7;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.12);
        }
    }
    .top-header .navbar-nav .nav-item .nav-icon-btn {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        width: var(--header-icon-size);
        height: var(--header-icon-size);
        border-radius: 6px;
        font-size: var(--header-icon-font-size);
        padding: 0;
        margin: 0;
        border: none;
        color: #fff;
        background-color: var(--bs-primary, #3461ff);
        cursor: pointer;
        text-decoration: none;
        line-height: 1;
        position: relative;
    }
    .top-header .navbar-nav .nav-item .nav-icon-btn:hover {
        background-color: var(--theme-primary-dark, #2850e0);
        color: #fff;
        text-decoration: none;
    }
    .top-header .navbar-nav .nav-item .nav-icon-btn.nav-icon-outline {
        background-color: transparent;
        color: var(--bs-primary, #3461ff);
        border: 1.5px solid #d0d5dd;
        box-shadow: none;
    }
    .top-header .navbar-nav .nav-item .nav-icon-btn.nav-icon-outline:hover {
        background-color: var(--theme-primary-light, #eef1ff);
        border-color: var(--bs-primary, #3461ff);
        color: var(--theme-primary-dark, #2850e0);
    }
    .top-header .navbar-nav .nav-item .nav-icon-btn i {
        display: block;
        line-height: 1;
        font-size: var(--header-icon-font-size);
    }
</style>
<header class="top-header no-print">
    <nav class="navbar navbar-expand gap-3">
        <div class="top-navbar-left">
            <div class="toggle-icon fs-3 d-flex">
                <i class="bi bi-list icon-open"></i>
                <i class="fa fa-times icon-close"></i>
            </div>
        </div>

        <div class="top-navbar-actions">
            <div class="top-navbar-right ms-auto d-flex">
                <ul class="navbar-nav align-items-center" style="gap: 0.75rem;">
                    
                    <li class="nav-item d-none d-sm-flex">
                        <span class="text-nowrap" style="font-size:.85rem; line-height: var(--header-icon-size);">
                            <strong><?php echo e(\Carbon::createFromTimestamp(strtotime('now'))->format(session('business.date_format')), false); ?></strong>
                        </span>
                    </li>

                    
                    <?php
                        $unread_notif_count = auth()->user()->unreadNotifications->count();
                    ?>
                    <li class="nav-item dropdown notifications-menu">
                        <a href="#" class="nav-icon-btn nav-icon-outline load_notifications dropdown-toggle"
                           data-bs-toggle="dropdown" id="show_unread_notifications" data-loaded="false"
                           title="<?php echo app('translator')->get('lang_v1.notifications'); ?>" data-bs-auto-close="outside">
                            <i class="fas fa-bell"></i>
                            <?php if($unread_notif_count > 0): ?>
                            <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger notifications_count" style="font-size:.6rem;min-width:16px;padding:2px 5px;">
                                <?php echo e($unread_notif_count, false); ?>

                            </span>
                            <?php else: ?>
                            <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger notifications_count" style="font-size:.6rem;min-width:16px;padding:2px 5px;display:none;"></span>
                            <?php endif; ?>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end" style="padding:0;">
                            <li class="dropdown-header d-flex justify-content-between align-items-center" style="padding:10px 14px;border-bottom:1px solid #e5e7eb;">
                                <strong style="font-size:.85rem;"><?php echo app('translator')->get('lang_v1.notifications'); ?></strong>
                            </li>
                            <li style="display:block;max-height:360px;overflow-y:auto;overflow-x:hidden;">
                                <ul class="list-unstyled mb-0" id="notifications_list"></ul>
                            </li>
                            <li class="footer load_more_li">
                                <a href="#" class="load_more_notifications text-primary" style="font-size:.78rem;"><?php echo app('translator')->get('lang_v1.load_more'); ?></a>
                            </li>
                        </ul>
                        <input type="hidden" id="notification_page" value="1">
                    </li>
                </ul>
            </div>

            
            <div class="dropdown-user-setting d-flex align-items-center ms-2">
                <a class="dropdown-toggle dropdown-toggle-nocaret" href="#" data-bs-toggle="dropdown">
                    <?php
                        $profile_photo = auth()->user()->media;
                    ?>
                    <?php if(!empty($profile_photo)): ?>
                        <img src="<?php echo e($profile_photo->display_url, false); ?>" class="user-img" alt="User Image" style="width:35px;height:35px;border-radius:50%;">
                    <?php else: ?>
                        <i class="fas fa-user-circle fa-2x"></i>
                    <?php endif; ?>
                </a>
                <ul class="dropdown-menu dropdown-menu-end">
                    <li>
                        <div class="d-flex align-items-center px-3 py-2">
                            <?php if(!empty(Session::get('business.logo'))): ?>
                                <img src="<?php echo e(\App\Utils\Util::getBusinessLogoUrl(Session::get('business.logo'), Session::get('business.id')), false); ?>" alt="Logo" style="max-width: 40px; max-height: 40px;" class="me-2">
                            <?php endif; ?>
                            <div>
                                <h6 class="mb-0"><?php echo e(Auth::User()->first_name, false); ?> <?php echo e(Auth::User()->last_name, false); ?></h6>
                            </div>
                        </div>
                    </li>
                    <li><hr class="dropdown-divider"></li>
                    <li>
                        <a class="dropdown-item" href="<?php echo e(action([\Modules\Crm\Http\Controllers\ManageProfileController::class, 'getProfile']), false); ?>">
                            <i class="fas fa-user me-2"></i><?php echo app('translator')->get('lang_v1.profile'); ?>
                        </a>
                    </li>
                    <li><hr class="dropdown-divider"></li>
                    <li>
                        <a class="dropdown-item" href="<?php echo e(action([\App\Http\Controllers\Auth\LoginController::class, 'logout']), false); ?>">
                            <i class="fas fa-sign-out-alt me-2"></i><?php echo app('translator')->get('lang_v1.sign_out'); ?>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
</header>
<!--end top header-->
