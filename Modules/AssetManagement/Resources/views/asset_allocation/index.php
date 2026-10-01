
<?php $__env->startSection('title', __('assetmanagement::lang.asset_allocated')); ?>
<?php $__env->startSection('content'); ?>
	<?php if ($__env->exists('assetmanagement::layouts.nav')) echo $__env->make('assetmanagement::layouts.nav', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
	<!-- Content Header (Page header) -->
	<section class="content-header no-print">
	    <h1 class="fs-4 fw-bold text-dark">
	    	<?php echo app('translator')->get('assetmanagement::lang.asset_allocated'); ?>
	    </h1>
	</section>
	<!-- Main content -->
	<section class="content no-print">
		<?php $__env->startComponent('components.widget'); ?>
		<div class="box-header with-border">
			<div class="box-tools float-end">
				<button class="btn btn-primary rounded-pill fw-bold float-end"
				id="allocate_asset" data-href="<?php echo e(action([\Modules\AssetManagement\Http\Controllers\AssetAllocationController::class, 'create']), false); ?>">
					<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor"
						stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
						class="icon icon-tabler icons-tabler-outline icon-tabler-plus">
						<path stroke="none" d="M0 0h24v24H0z" fill="none" />
						<path d="M12 5l0 14" />
						<path d="M5 12l14 0" />
					</svg> <?php echo app('translator')->get('messages.add'); ?>
				</button>
			</div>
		</div>
		<div class="box-body">
			<div class="table-responsive">
				<table class="table table-bordered table-striped" id="assest_allocated_table">
					<thead>
						<tr>
							<th><?php echo app('translator')->get('messages.action'); ?></th>
							<th><?php echo app('translator')->get('assetmanagement::lang.allocation_code'); ?></th>
							<th><?php echo app('translator')->get('assetmanagement::lang.allocated_to'); ?></th>
							<th><?php echo app('translator')->get('assetmanagement::lang.asset_name'); ?></th>
							<th><?php echo app('translator')->get('assetmanagement::lang.series_model'); ?></th>
							<th><?php echo app('translator')->get('lang_v1.quantity'); ?></th>
							<th>
								<?php echo app('translator')->get('assetmanagement::lang.revoked_qty'); ?>
							</th>
							<th><?php echo app('translator')->get('assetmanagement::lang.allocate_from'); ?></th>
							<th><?php echo app('translator')->get('assetmanagement::lang.allocated_upto'); ?></th>
							<th><?php echo app('translator')->get('assetmanagement::lang.allocated_by'); ?></th>
							<th><?php echo app('translator')->get('assetmanagement::lang.asset_category'); ?></th>
							<th>
								<?php echo app('translator')->get('assetmanagement::lang.reason'); ?>
							</th>
						</tr>
					</thead>
					<tbody></tbody>
				</table>
			</div>
		</div>
		<?php echo $__env->renderComponent(); ?>
	</section>
	<div class="modal fade" id="asset_revoke_modal" tabindex="-1" role="dialog"></div>
	<div class="modal fade" id="allocate_asset_modal" tabindex="-1" role="dialog"></div>
	<div class="modal fade" id="edit_allocate_asset_modal" tabindex="-1" role="dialog"></div>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('javascript'); ?>
<script type="text/javascript">
	$(document).ready(function () {
		assest_allocated_datatable = $("#assest_allocated_table").DataTable({
			processing: true,
            serverSide: true,
            ajax:{
                url: '/asset/allocation',
                "data": function ( d ) {
                    //
                }
            },
            columnDefs: [{
                targets: [0, 2, 6, 9],
                orderable: false,
                searchable: false
            }],
            aaSorting:[[7, 'desc']],
            columns:[
                { data: 'action', name: 'action' },
                { data: 'ref_no', name: 'asset_transactions.ref_no'},
                { data: 'receiver_name', name: 'receiver_name' },
                { data: 'asset', name: 'assets.name' },
                { data: 'model', name: 'assets.model' },
                { data: 'quantity', name: 'asset_transactions.quantity' },
                { data: 'revoked_quantity', name: 'revoked_quantity' },
                { data: 'allocated_at', name : 'asset_transactions.transaction_datetime' },
                { data: 'allocated_upto', name : 'asset_transactions.allocated_upto' },
                { data: 'provider_name', name: 'provider_name' },
                { data: 'category', name: 'CAT.name' },
                { data: 'reason', name: 'asset_transactions.reason' },
            ]
		});

		$(document).on('click', '#delete_allocated_asset', function () {
			var url = $(this).data('href');
			swal({
		      title: LANG.sure,
		      icon: "warning",
		      buttons: true,
		      dangerMode: true,
		    }).then((confirmed) => {
		        if (confirmed) {
		            $.ajax({
		                method:'DELETE',
		                dataType: 'json',
		                url: url,
		                success: function(result){
		                    if (result.success) {
		                        toastr.success(result.msg);
		                        assest_allocated_datatable.ajax.reload();
		                    } else {
		                        toastr.error(result.msg);
		                    }
		                }
		            });
		        }
		    });
		});

		$(document).on('click', '.revoke_allocated_asset', function () {
			var url = $(this).data('href');
			$.ajax({
				method: "GET",
				url: url,
				dataType: 'html',
				success: function (result) {
					$("#asset_revoke_modal").html(result).modal('show');
				}
			});
		});

		$('#asset_revoke_modal').on('shown.bs.modal', function () {
			
			$('form#revoke_asset_form #transaction_datetime').datetimepicker({
                format: moment_date_format + ' ' + moment_time_format,
                ignoreReadonly: true,
            });

		  	$("form#revoke_asset_form").validate({
		  		submitHandler: function(form) {
                    form.submit();
                }
		  	});
		})

		$(document).on('click', '#allocate_asset', function () {
			var url = $(this).data('href');
			$.ajax({
				method: "GET",
				url: url,
				dataType: 'html',
				success: function (result) {
					$("#allocate_asset_modal").html(result).modal('show');
				}
			});
		});

		$('#allocate_asset_modal').on('shown.bs.modal', function () {
			
			$('form#asset_allocation_form').validate({
                submitHandler: function(form) {
                    form.submit();
                }
            });

            $('#transaction_datetime').datetimepicker({
                format: moment_date_format + ' ' + moment_time_format,
                ignoreReadonly: true,
            });

            $('#allocated_upto').datepicker({
		        autoclose: true,
		        format:datepicker_date_format
		    });

            <?php if(!empty($asset_id)): ?>
                var quantity = $('select#asset_id').find(':selected').data('quantity');
                if (!_.isUndefined(quantity)) {
                    $("input#quantity").attr('max', parseInt(quantity));
                }
            <?php endif; ?>

            $(document).on('change', 'select#asset_id', function () {
                var quantity = $(this).find(':selected').data('quantity');
                if (!_.isUndefined(quantity)) {
                    $("input#quantity").attr('max', parseInt(quantity));
                } else {
                    $("input#quantity").removeAttr('max');
                }
            });
		})

		$(document).on('click', '.edit_allocated_asset', function () {
			var url = $(this).data('href');
			$.ajax({
				method: "GET",
				url: url,
				dataType: 'html',
				success: function (result) {
					$("#allocate_asset_modal").html(result).modal('show');
				}
			});
		});

		$('#edit_allocate_asset_modal').on('shown.bs.modal', function () {
			
			$('form#asset_allocation_form').validate({
                submitHandler: function(form) {
                    form.submit();
                }
            });

            $('#transaction_datetime').datetimepicker({
                format: moment_date_format + ' ' + moment_time_format,
                ignoreReadonly: true,
            });
		})
		
	})
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>