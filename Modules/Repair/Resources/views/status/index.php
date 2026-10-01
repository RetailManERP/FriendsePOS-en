<button type="button" class="btn btn-sm btn-primary btn-modal float-end" 
    data-href="<?php echo e(action([\Modules\Repair\Http\Controllers\RepairStatusController::class, 'create']), false); ?>" 
    data-container=".view_modal">
    <i class="fa fa-plus"></i>
    <?php echo app('translator')->get( 'messages.add' ); ?>
</button>
<br><br>
<div class="table-responsive">
<table class="table table-bordered table-striped table-th-skin" id="status_table" style="width: 100%">
    <thead>
    <tr>
        <th><?php echo app('translator')->get( 'repair::lang.status_name' ); ?></th>
        <th><?php echo app('translator')->get( 'repair::lang.color' ); ?></th>
        <th><?php echo app('translator')->get( 'repair::lang.sort_order' ); ?></th>
        <th><?php echo app('translator')->get( 'messages.action' ); ?></th>
    </tr>
    </thead>
</table>
</div>
<div class="modal fade brands_modal" tabindex="-1" role="dialog" 
aria-labelledby="gridSystemModalLabel">
</div>
