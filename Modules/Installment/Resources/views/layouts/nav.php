<?php if (! $__env->hasRenderedOnce('4491dfd7-ebce-46dd-ac0b-d58971f938bb')): $__env->markAsRenderedOnce('4491dfd7-ebce-46dd-ac0b-d58971f938bb'); ?>
    <style>
        .installment-module-nav {
            background: transparent;
            margin-bottom: 0;
            padding: 12px 15px 0;
        }

        .installment-module-nav .btn-group {
            align-items: center;
            display: flex;
            flex-wrap: wrap;
            gap: 6px;
        }

        .installment-module-nav .btn {
            align-items: center;
            border-radius: 4px;
            display: inline-flex;
            gap: 5px;
            line-height: 1.4;
        }

        @media (max-width: 767px) {
            .installment-module-nav .btn-group {
                align-items: stretch;
                width: 100%;
            }

            .installment-module-nav .btn {
                flex: 1 1 auto;
            }
        }
    </style>
<?php endif; ?>

<?php
    $installment_user = auth()->user();
    $can_installment_admin = !empty($__is_admin)
        || $installment_user->can('superadmin')
        || $installment_user->hasRole('Admin#' . session('business.id'));
    $has_installment_view = $installment_user->can('installment.view');
?>

<section class="content-header no-print installment-module-nav">
    <div class="btn-group mb-2 flex-wrap" role="group">
        <?php if($can_installment_admin || $has_installment_view || $installment_user->can('installment.access_dashboard')): ?>
            <a href="<?php echo e(url('/installment/dashboard'), false); ?>" class="btn btn-sm <?php echo e(request()->segment(2) == 'dashboard' ? 'btn-primary' : 'btn-default', false); ?>">
                <i class="fas fa-tachometer-alt"></i> <?php echo app('translator')->get('installment::lang.dashboard'); ?>
            </a>
        <?php endif; ?>

        <?php if($can_installment_admin || $has_installment_view || $installment_user->can('installment.system_view') || $installment_user->can('installment.system_add') || $installment_user->can('installment.system_edit') || $installment_user->can('installment.system_delete')): ?>
            <a href="<?php echo e(url('/installment/plans'), false); ?>" class="btn btn-sm <?php echo e(request()->segment(2) == 'plans' ? 'btn-primary' : 'btn-default', false); ?>">
                <i class="fas fa-clipboard-list"></i> <?php echo app('translator')->get('installment::lang.installment_plan'); ?>
            </a>
        <?php endif; ?>

        <?php if($can_installment_admin || $has_installment_view || $installment_user->can('installment.view_sells') || $installment_user->can('installment.create')): ?>
            <a href="<?php echo e(url('/installment/sells'), false); ?>" class="btn btn-sm <?php echo e(request()->segment(2) == 'sells' ? 'btn-primary' : 'btn-default', false); ?>">
                <i class="fas fa-shopping-cart"></i> <?php echo app('translator')->get('installment::lang.customer_sells'); ?>
            </a>
        <?php endif; ?>

        <?php if($can_installment_admin || $has_installment_view || $installment_user->can('installment.view_customers')): ?>
            <a href="<?php echo e(url('/installment/customer'), false); ?>" class="btn btn-sm <?php echo e(request()->segment(2) == 'customer' ? 'btn-primary' : 'btn-default', false); ?>">
                <i class="fas fa-user-tag"></i> <?php echo app('translator')->get('installment::lang.customer'); ?>
            </a>
        <?php endif; ?>

        <?php if($can_installment_admin || $has_installment_view || $installment_user->can('installment.view_reports') || $installment_user->can('installment.view_contacts')): ?>
            <a href="<?php echo e(url('/installment/reports'), false); ?>" class="btn btn-sm <?php echo e(request()->segment(2) == 'reports' ? 'btn-primary' : 'btn-default', false); ?>">
                <i class="fas fa-chart-bar"></i> <?php echo app('translator')->get('installment::lang.installment_report'); ?>
            </a>
        <?php endif; ?>

        <?php if($can_installment_admin): ?>
            <a href="<?php echo e(url('/installment/settings'), false); ?>" class="btn btn-sm <?php echo e(request()->segment(2) == 'settings' ? 'btn-primary' : 'btn-default', false); ?>">
                <i class="fas fa-cog"></i> <?php echo app('translator')->get('installment::lang.settings'); ?>
            </a>
        <?php endif; ?>
    </div>
</section>
