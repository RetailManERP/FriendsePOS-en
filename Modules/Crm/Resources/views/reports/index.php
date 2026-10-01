

<?php $__env->startSection('title', __('report.reports')); ?>

<?php $__env->startSection('content'); ?>
<?php echo $__env->make('crm::layouts.nav', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<!-- Content Header (Page header) -->
<section class="content-header no-print">
   <h1><?php echo app('translator')->get('report.reports'); ?></h1>
</section>

<section class="content no-print">
    <div class="row">
        <div class="col-md-12">
        	<?php $__env->startComponent('components.widget', ['class' => 'box-primary', 'title' => __('crm::lang.follow_ups_by_user')]); ?>
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <?php echo Form::label('follow_up_user_date_range', __('report.date_range') . ':'); ?>

                            <?php echo Form::text('follow_up_user_date_range', null, ['placeholder' => __('lang_v1.select_a_date_range'), 'class' => 'form-control', 'readonly']); ?>

                        </div>
                    </div>
                </div>
                <div class="table-responsive">
<table class="table table-bordered table-striped table-th-skin" id="follow_ups_by_user_table" style="width: 100%;">
                    <thead>
                        <tr>
                            <th><?php echo app('translator')->get('role.user'); ?></th>
                            <?php $__currentLoopData = $statuses; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <th>
                                    <?php echo e($value, false); ?>

                                </th>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            <th>
                                <?php echo app('translator')->get('lang_v1.others'); ?>
                            </th>
                            <th>
                                <?php echo app('translator')->get('crm::lang.total_follow_ups'); ?>
                            </th>
                        </tr>
                    </thead>
                </table>
</div>
            <?php echo $__env->renderComponent(); ?>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <?php $__env->startComponent('components.widget', ['class' => 'box-primary', 'title' => __('crm::lang.follow_ups_by_contacts')]); ?>
                <div class="table-responsive">
<table class="table table-bordered table-striped table-th-skin" id="follow_ups_by_contact_table" style="width: 100%;">
                    <thead>
                        <tr>
                            <th><?php echo app('translator')->get('contact.contact'); ?></th>
                            <?php $__currentLoopData = $statuses; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <th>
                                    <?php echo e($value, false); ?>

                                </th>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            <th>
                                <?php echo app('translator')->get('lang_v1.others'); ?>
                            </th>
                            <th>
                                <?php echo app('translator')->get('crm::lang.total_follow_ups'); ?>
                            </th>
                        </tr>
                    </thead>
                </table>
</div>
            <?php echo $__env->renderComponent(); ?>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <?php $__env->startComponent('components.widget', ['class' => 'box-primary', 'title' => __('crm::lang.lead_to_customer_conversion')]); ?>
                <div class="table-responsive">
<table class="table table-bordered table-striped table-th-skin" id="lead_to_customer_conversion" style="width: 100%;">
                    <thead>
                        <tr>
                            <th>&nbsp;</th>
                            <th><?php echo app('translator')->get('crm::lang.converted_by'); ?></th>
                            <th><?php echo app('translator')->get('sale.total'); ?></th>
                        </tr>
                    </thead>
                </table>
</div>
            <?php echo $__env->renderComponent(); ?>
        </div>
    </div>
</section>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('javascript'); ?>
    <?php echo $__env->make('crm::reports.report_javascripts', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>