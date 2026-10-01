<button type="button" class="btn btn-sm btn-primary btn-modal pull-right" 
    data-href="<?php echo e(action([\Modules\Truckmate\Http\Controllers\TruckmateStatusController::class, 'create']), false); ?>" 
    data-container=".view_modal">
    <i class="fa fa-plus"></i>
    <?php echo app('translator')->get( 'messages.add' ); ?>
</button>
<br><br>
<div class="table-responsive">
<table class="table table-bordered table-striped table-th-skin" id="status_table" style="width: 100%">
    <thead>
    <tr>
        <th><?php echo app('translator')->get( 'truckmate::lang.status_name' ); ?></th>
        <th><?php echo app('translator')->get( 'truckmate::lang.color' ); ?></th>
        <th><?php echo app('translator')->get( 'truckmate::lang.sort_order' ); ?></th>
        <th><?php echo app('translator')->get( 'messages.action' ); ?></th>
    </tr>
    </thead>
</table>
</div>
<div class="modal fade brands_modal" tabindex="-1" role="dialog" 
aria-labelledby="gridSystemModalLabel">
</div>