<div class="col-md-<?php echo e(round(($dashboard_detail->size / 100) * 12), false); ?>">
    <div
        class="card radius-10 mb-4 shadow-sm">
        <div class="p-2 p-sm-3">
            <div class="box-header text-center">
                <h3 class="box-title pull-left"><?php echo e($dashboard_detail->heading, false); ?></h3>
                <h6 class="text-uppercase"
                    style="font-family: Arial, sans-serif; color: #333; letter-spacing: 2px; margin-top: 5px;">
                    <?php echo e(\Carbon::createFromTimestamp(strtotime($dates['date_to']))->format(session('business.date_format')), false); ?> - <?php echo e(\Carbon::createFromTimestamp(strtotime($dates['date_from']))->format(session('business.date_format')), false); ?>

                </h6>
            </div>
            <div class="mt-3">
                <div class="table-responsive">
                    <div class="w-100 py-2 px-3">
                        <?php echo $__env->make('hms::partials.hms_report_table', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
