
<?php $__env->startSection('title', __('fieldforce::lang.field_force')); ?>

<?php $__env->startSection('content'); ?>

<?php echo $__env->make('fieldforce::layouts.nav', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>


<section class="content no-print">
    <?php if($is_admin && !empty($kpi)): ?>
    
    <div class="row row-custom">
        <div class="col-md-3 col-sm-6 col-xs-12 col-custom">
            <div class="info-box info-box-new-style">
                <span class="info-box-icon bg-red"><i class="fas fa-exclamation-triangle"></i></span>
                <div class="info-box-content">
                    <span class="info-box-text"><?php echo e(__('fieldforce::lang.overdue_visits'), false); ?></span>
                    <span class="info-box-number"><?php echo e($kpi->overdue_visits, false); ?></span>
                </div>
            </div>
        </div>
        <div class="col-md-3 col-sm-6 col-xs-12 col-custom">
            <div class="info-box info-box-new-style">
                <span class="info-box-icon bg-green"><i class="fas fa-percentage"></i></span>
                <div class="info-box-content">
                    <span class="info-box-text"><?php echo e(__('fieldforce::lang.success_rate'), false); ?></span>
                    <span class="info-box-number"><?php echo e($kpi->success_rate, false); ?>%</span>
                </div>
            </div>
        </div>
        <div class="col-md-3 col-sm-6 col-xs-12 col-custom">
            <div class="info-box info-box-new-style">
                <span class="info-box-icon bg-yellow"><i class="fas fa-calendar-week"></i></span>
                <div class="info-box-content">
                    <span class="info-box-text"><?php echo e(__('fieldforce::lang.visits_this_week'), false); ?></span>
                    <span class="info-box-number"><?php echo e($kpi->visits_this_week, false); ?></span>
                </div>
            </div>
        </div>
        <div class="col-md-3 col-sm-6 col-xs-12 col-custom">
            <div class="info-box info-box-new-style">
                <span class="info-box-icon bg-aqua"><i class="fas fa-chart-line"></i></span>
                <div class="info-box-content">
                    <span class="info-box-text"><?php echo e(__('fieldforce::lang.avg_visits_per_day'), false); ?></span>
                    <span class="info-box-number"><?php echo e($kpi->avg_per_day, false); ?></span>
                </div>
            </div>
        </div>
    </div>
    <hr>
    <?php endif; ?>

    <div class="row">
        <div class="col-md-4">
            <div class="col-md-12">
                <div class="info-box info-box-new-style">
                    <span class="info-box-icon bg-aqua"><i class="fas fa-calendar-check"></i></span>

                    <div class="info-box-content">
                        <span class="info-box-text"><?php echo e(__('fieldforce::lang.assigned'), false); ?></span>
                        <span class="info-box-number"><?php echo e($my_visit_status->assigned ?? 0, false); ?></span>

                    </div>
                    <!-- /.info-box-content -->
                </div>
            </div>
            <div class="col-md-12">
                <div class="info-box info-box-new-style">
                    <span class="info-box-icon bg-green"><i class="fas fa-user-check"></i></span>

                    <div class="info-box-content">
                        <span class="info-box-text"><?php echo e(__('fieldforce::lang.met_contact'), false); ?></span>
                        <span class="info-box-number"><?php echo e($my_visit_status->met_contact ?? 0, false); ?></span>

                    </div>
                    <!-- /.info-box-content -->
                </div>
            </div>
            <div class="col-md-12">
                <div class="info-box info-box-new-style">
                    <span class="info-box-icon bg-red"><i class="fas fa-user-times"></i></span>

                    <div class="info-box-content">
                        <span class="info-box-text"><?php echo e(__('fieldforce::lang.did_not_meet_contact'), false); ?></span>
                        <span class="info-box-number"><?php echo e($my_visit_status->did_not_meet_contact ?? 0, false); ?></span>

                    </div>
                    <!-- /.info-box-content -->
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title"><?php echo app('translator')->get('fieldforce::lang.my_visits'); ?></h3>
                </div>
                <div class="box-body p-10">
                    <table class="table no-margin">
                        <tr>
                            <th></th>
                            <th><?php echo app('translator')->get('fieldforce::lang.contact'); ?></th>
                            <th><?php echo app('translator')->get('fieldforce::lang.others'); ?></th>
                        </tr>
                        <tr>
                            <th><?php echo app('translator')->get('fieldforce::lang.visits_today'); ?></th>
                            <td><?php echo e($my_visits->contact_visits_today ?? 0, false); ?></td>
                            <td><?php echo e($my_visits->others_visits_today ?? 0, false); ?></td>
                        </tr>
                        <tr>
                            <th><?php echo app('translator')->get('fieldforce::lang.visits_yesterday'); ?></th>
                            <td><?php echo e($my_visits->contact_visits_yesterday ?? 0, false); ?></td>
                            <td><?php echo e($my_visits->others_visits_yesterday ?? 0, false); ?></td>
                        </tr>
                        <tr>
                            <th><?php echo app('translator')->get('fieldforce::lang.visits_this_month'); ?></th>
                            <td><?php echo e($my_visits->contact_visits_this_month ?? 0, false); ?></td>
                            <td><?php echo e($my_visits->others_visits_this_month ?? 0, false); ?></td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <hr>
    <?php if($is_admin): ?>
    <div class="row row-custom">
        <div class="col-md-3 col-sm-6 col-xs-12 col-custom">
            <div class="info-box info-box-new-style">
                <span class="info-box-icon bg-orange">
                    <i class="fas fa-life-ring"></i>
                </span>

                <div class="info-box-content">
                    <span class="info-box-text"><?php echo e(__('fieldforce::lang.total_visits'), false); ?></span>
                    <span class="info-box-number invoice_due"><?php echo e($all_visits->total_visits ?? 0, false); ?></span>

                    <span class="info-box-text">
                        <a href="<?php echo e(action('\Modules\FieldForce\Http\Controllers\FieldForceController@index'), false); ?>" target="_blank">
                            <?php echo e(__('fieldforce::lang.view'), false); ?> <i class="fa fa-arrow-circle-right"></i>
                        </a>
                    </span>
                </div>
                <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
        </div>
        <!-- /.col -->
        <div class="col-md-3 col-sm-6 col-xs-12 col-custom">
            <div class="info-box info-box-new-style">
                <span class="info-box-icon bg-aqua"><i class="fas fa-calendar-check"></i></span>

                <div class="info-box-content">
                    <span class="info-box-text"><?php echo e(__('fieldforce::lang.assigned'), false); ?></span>
                    <span class="info-box-number"><?php echo e($all_visits->assigned ?? 0, false); ?></span>

                    <span class="info-box-text">
                        <a href="<?php echo e(action('\Modules\FieldForce\Http\Controllers\FieldForceController@index') . '?status=assigned', false); ?>" target="_blank">
                            <?php echo e(__('fieldforce::lang.view'), false); ?> <i class="fa fa-arrow-circle-right"></i>
                        </a>
                    </span>
                </div>
                <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
        </div>
        <!-- /.col -->
        <div class="col-md-3 col-sm-6 col-xs-12 col-custom">
            <div class="info-box info-box-new-style">
                <span class="info-box-icon bg-green"><i class="fas fa-user-check"></i></span>

                <div class="info-box-content">
                    <span class="info-box-text"><?php echo e(__('fieldforce::lang.met_contact'), false); ?></span>
                    <span class="info-box-number"><?php echo e($all_visits->met_contact ?? 0, false); ?></span>

                    <span class="info-box-text">
                        <a href="<?php echo e(action('\Modules\FieldForce\Http\Controllers\FieldForceController@index') . '?status=met_contact', false); ?>" target="_blank">
                            <?php echo e(__('fieldforce::lang.view'), false); ?> <i class="fa fa-arrow-circle-right"></i>
                        </a>
                    </span>
                </div>
                <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
        </div>
        <!-- /.col -->
        <div class="col-md-3 col-sm-6 col-xs-12 col-custom">
            <div class="info-box info-box-new-style">
                <span class="info-box-icon bg-red">
                    <i class="fas fa-user-times"></i>
                </span>

                <div class="info-box-content">
                    <span class="info-box-text"><?php echo e(__('fieldforce::lang.did_not_meet_contact'), false); ?></span>
                    <span class="info-box-number"><?php echo e($all_visits->did_not_meet_contact ?? 0, false); ?></span>

                    <span class="info-box-text">
                        <a href="<?php echo e(action('\Modules\FieldForce\Http\Controllers\FieldForceController@index') . '?status=did_not_meet_contact', false); ?>" target="_blank">
                            <?php echo e(__('fieldforce::lang.view'), false); ?> <i class="fa fa-arrow-circle-right"></i>
                        </a>
                    </span>
                </div>
                <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
        </div>
        <!-- /.col -->
    </div>

    <div class="row row-custom">
        <div class="col-md-3 col-sm-6 col-xs-12 col-custom">
            <div class="info-box info-box-new-style">
                <span class="info-box-icon bg-orange">
                    <i class="fas fa-life-ring"></i>
                </span>

                <div class="info-box-content">
                    <span class="info-box-text"><?php echo e(__('fieldforce::lang.today_total_visits'), false); ?></span>
                    <span class="info-box-number invoice_due"><?php echo e($today_visits->total_visits ?? 0, false); ?></span>

                    <span class="info-box-text">
                        <a href="<?php echo e(action('\Modules\FieldForce\Http\Controllers\FieldForceController@index') . '?start_date=' . \Carbon::createFromTimestamp(strtotime(\Carbon::today()))->format(session('business.date_format')) . '&end_date=' . \Carbon::createFromTimestamp(strtotime(\Carbon::today()))->format(session('business.date_format')), false); ?>" target="_blank">
                            <?php echo e(__('fieldforce::lang.view'), false); ?> <i class="fa fa-arrow-circle-right"></i>
                        </a>
                    </span>
                </div>
                <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
        </div>
        <!-- /.col -->
        <div class="col-md-3 col-sm-6 col-xs-12 col-custom">
            <div class="info-box info-box-new-style">
                <span class="info-box-icon bg-aqua"><i class="fas fa-calendar-check"></i></span>

                <div class="info-box-content">
                    <span class="info-box-text"><?php echo e(__('fieldforce::lang.today_assigned'), false); ?></span>
                    <span class="info-box-number"><?php echo e($today_visits->assigned ?? 0, false); ?></span>

                    <span class="info-box-text">
                        <a href="<?php echo e(action('\Modules\FieldForce\Http\Controllers\FieldForceController@index') . '?status=assigned&start_date=' . \Carbon::createFromTimestamp(strtotime(\Carbon::today()))->format(session('business.date_format')) . '&end_date=' . \Carbon::createFromTimestamp(strtotime(\Carbon::today()))->format(session('business.date_format')), false); ?>" 
                        target="_blank"><?php echo e(__('fieldforce::lang.view'), false); ?> <i class="fa fa-arrow-circle-right"></i>
                        </a>
                    </span>
                </div>
                <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
        </div>
        <!-- /.col -->
        <div class="col-md-3 col-sm-6 col-xs-12 col-custom">
            <div class="info-box info-box-new-style">
                <span class="info-box-icon bg-green"><i class="fas fa-user-check"></i></span>

                <div class="info-box-content">
                    <span class="info-box-text"><?php echo e(__('fieldforce::lang.today_met_contact'), false); ?></span>
                    <span class="info-box-number"><?php echo e($today_visits->met_contact ?? 0, false); ?></span>

                    <span class="info-box-text">
                        <a href="<?php echo e(action('\Modules\FieldForce\Http\Controllers\FieldForceController@index') . '?status=met_contact&start_date=' . \Carbon::createFromTimestamp(strtotime(\Carbon::today()))->format(session('business.date_format')) . '&end_date=' . \Carbon::createFromTimestamp(strtotime(\Carbon::today()))->format(session('business.date_format')), false); ?>" 
                        target="_blank"><?php echo e(__('fieldforce::lang.view'), false); ?> <i class="fa fa-arrow-circle-right"></i>
                        </a>
                    </span>
                </div>
                <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
        </div>
        <!-- /.col -->
        <div class="col-md-3 col-sm-6 col-xs-12 col-custom">
            <div class="info-box info-box-new-style">
                <span class="info-box-icon bg-red">
                    <i class="fas fa-user-times"></i>
                </span>

                <div class="info-box-content">
                    <span class="info-box-text"><?php echo e(__('fieldforce::lang.today_did_not_meet_contact'), false); ?></span>
                    <span class="info-box-number"><?php echo e($today_visits->did_not_meet_contact ?? 0, false); ?></span>

                    <span class="info-box-text">
                        <a href="<?php echo e(action('\Modules\FieldForce\Http\Controllers\FieldForceController@index') . '?status=did_not_meet_contact&start_date=' . \Carbon::createFromTimestamp(strtotime(\Carbon::today()))->format(session('business.date_format')) . '&end_date=' . \Carbon::createFromTimestamp(strtotime(\Carbon::today()))->format(session('business.date_format')), false); ?>" 
                        target="_blank"><?php echo e(__('fieldforce::lang.view'), false); ?> <i class="fa fa-arrow-circle-right"></i>
                        </a>
                    </span>
                </div>
                <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
        </div>
        <!-- /.col -->
    </div>

    <div class="row">
        <div class="col-md-12">
            <?php $__env->startComponent('components.widget', ['class' => 'box-solid', 'title' => __('fieldforce::lang.visits_by_user')]); ?>

            <div class="table-responsive">
<table class="table table-bordered table-striped table-th-skin" id="visits_by_user" style="width: 100%;">
                <thead>
                    <tr>
                        <th><?php echo app('translator')->get('role.user'); ?></th>
                        <th><?php echo app('translator')->get('fieldforce::lang.contact_visits_today'); ?></th>
                        <th><?php echo app('translator')->get('fieldforce::lang.others_visits_today'); ?></th>
                        <th><?php echo app('translator')->get('fieldforce::lang.contact_visits_yesterday'); ?></th>
                        <th><?php echo app('translator')->get('fieldforce::lang.others_visits_yesterday'); ?></th>
                        <th><?php echo app('translator')->get('fieldforce::lang.contact_visits_this_month'); ?></th>
                        <th><?php echo app('translator')->get('fieldforce::lang.others_visits_this_month'); ?></th>
                        <th><?php echo app('translator')->get('fieldforce::lang.total_visits'); ?></th>
                    </tr>
                </thead>
            </table>
</div>

            <?php echo $__env->renderComponent(); ?>
        </div>
    </div>

    <?php endif; ?>
</section>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('javascript'); ?>
<script type="text/javascript">
    $(document).ready(function() {

        <?php if($is_admin): ?>
        $("#visits_by_user").DataTable({
            processing: true,
            serverSide: true,
            scrollY: "75vh",
            scrollX: true,
            scrollCollapse: true,
            fixedHeader: false,
            'ajax': {
                url: "<?php echo e(action('\Modules\FieldForce\Http\Controllers\FieldForceDashboardController@visitByUsers'), false); ?>"
            },
            columns: [{
                    data: 'name',
                    name: 'u.first_name'
                },
                {
                    data: 'contact_visits_today',
                    searchable: false
                },
                {
                    data: 'others_visits_today',
                    searchable: false
                },
                {
                    data: 'contact_visits_yesterday',
                    searchable: false
                },
                {
                    data: 'others_visits_yesterday',
                    searchable: false
                },
                {
                    data: 'contact_visits_this_month',
                    searchable: false
                },
                {
                    data: 'others_visits_this_month',
                    searchable: false
                },
                {
                    data: 'all_visits',
                    searchable: false
                }
            ],
        });
        <?php endif; ?>
    });
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>