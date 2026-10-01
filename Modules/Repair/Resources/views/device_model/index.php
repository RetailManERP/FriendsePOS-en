 <a class="btn btn-sm btn-primary float-end" data-href="<?php echo e(action([\Modules\Repair\Http\Controllers\DeviceModelController::class, 'create']), false); ?>" id="add_device_model">
	<i class="fa fa-plus"></i>
	<?php echo app('translator')->get('messages.add'); ?>
</a>
<br><br>
<div class="table-responsive">
    <table class="table table-bordered table-striped table-th-skin" id="model_table" style="width: 100%">
        <thead>
            <tr>
                <th><?php echo app('translator')->get('messages.action'); ?></th>
                <th><?php echo app('translator')->get('repair::lang.model_name'); ?></th>
                <th><?php echo app('translator')->get('repair::lang.repair_checklist'); ?></th>
                <th><?php echo app('translator')->get('repair::lang.device'); ?></th>
                <th><?php echo app('translator')->get('product.brand'); ?></th>
            </tr>
        </thead>
    </table>
</div>
<div class="modal fade" id="device_model_modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"></div>
