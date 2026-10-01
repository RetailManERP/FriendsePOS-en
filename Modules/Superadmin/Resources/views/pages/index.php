
<?php $__env->startSection('title', __('superadmin::lang.superadmin') . ' | ' . __('superadmin::lang.frontend_pages')); ?>

<?php $__env->startSection('content'); ?>

<!-- Content Header (Page header) -->
<section class="content-header">
    <h1><?php echo app('translator')->get('superadmin::lang.frontend_pages'); ?></h1>
</section>

<!-- Main content -->
<section class="content">

	<div class="box">
        <div class="box-header">
            <h3 class="box-title">&nbsp;</h3>
        	<div class="box-tools">
                <a href="<?php echo e(action([\Modules\Superadmin\Http\Controllers\PageController::class, 'create']), false); ?>" 
                    class="btn btn-block btn-primary">
                	<i class="fa fa-plus"></i> <?php echo app('translator')->get( 'messages.add' ); ?></a>
            </div>
        </div>

        <div class="box-body">
        	<div class="row">
        		<?php $__currentLoopData = $pages; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $page): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
	                <div class="col-md-4 page_details">
						<div class="box box-success hvr-grow-shadow">
							<div class="box-header with-border text-center">
								<h2 class="box-title"><?php echo e($page->title, false); ?></h2>

								<div class="row">
									<?php if($page->is_shown == 1): ?>
										<span class="badge bg-green">
											<?php echo app('translator')->get('superadmin::lang.visible'); ?>
										</span>
									<?php else: ?>
										<span class="badge bg-red">
										<?php echo app('translator')->get('superadmin::lang.hidden'); ?>
										</span>
									<?php endif; ?>

                                    <span class="badge bg-info" title="<?php echo app('translator')->get('superadmin::lang.menu_order'); ?>">
                                        <?php echo e($page->menu_order, false); ?>

                                    </span>
									
									<a href="<?php echo e(action([\Modules\Superadmin\Http\Controllers\PageController::class, 'edit'], [$page->id]), false); ?>" class="btn btn-box-tool" title="edit"><i class="fa fa-edit"></i></a>
									<a href="<?php echo e(action([\Modules\Superadmin\Http\Controllers\PageController::class, 'destroy'], [$page->id]), false); ?>" class="btn btn-box-tool delete_page" title="delete"><i class="fa fa-trash"></i></a>
	              					
								</div>
							</div>
							<!-- /.box-header -->
							<div class="box-body" style="max-height: 300px; overflow: hidden;">
								<strong><?php echo app('translator')->get('superadmin::lang.page_content'); ?>:</strong>
								<?php echo $page->content; ?>

							</div>
						</div>
						<!-- /.box -->
	                </div>
	                <?php if($loop->iteration%3 == 0): ?>
	    				<div class="clearfix"></div>
	    			<?php endif; ?>
	            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        	</div>
        </div>

    </div>

</section>
<!-- /.content -->
<?php $__env->stopSection(); ?>
<?php $__env->startSection('javascript'); ?>
<script type="text/javascript">
	$(document).on('click', 'a.delete_page', function(e) {
		var page_details = $(this).closest('div.page_details')
		e.preventDefault();
        swal({
            title: LANG.sure,
            icon: 'warning',
            buttons: true,
            dangerMode: true,
        }).then(willDelete => {
            if (willDelete) {
                var href = $(this).attr('href');
                var data = $(this).serialize();

                $.ajax({
                    method: 'DELETE',
                    url: href,
                    dataType: 'json',
                    data: data,
                    success: function(result) {
                        if (result.success == true) {
                            page_details.remove();
                            toastr.success(result.msg);
                        } else {
                            toastr.error(result.msg);
                        }
                    },
                });
            }
        });
    });
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>