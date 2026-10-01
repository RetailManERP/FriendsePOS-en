
<?php $__env->startSection('title', __('assetmanagement::lang.revoked_asset')); ?>
<?php $__env->startSection('content'); ?>
	<?php if ($__env->exists('assetmanagement::layouts.nav')) echo $__env->make('assetmanagement::layouts.nav', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
	<!-- Content Header (Page header) -->
	<section class="content-header no-print">
	    <h1>
	    	<?php echo app('translator')->get('assetmanagement::lang.revoked_asset'); ?>
	    </h1>
	</section>
	<!-- Main content -->
	<section class="content no-print">
		<?php $__env->startComponent('components.widget'); ?>
		<div class="table-responsive">
			<table class="table table-bordered table-striped" id="assest_revoked_table">
				<thead>
					<tr>
						<th><?php echo app('translator')->get('messages.action'); ?></th>
						<th><?php echo app('translator')->get('assetmanagement::lang.revoke_code'); ?></th>
						<th><?php echo app('translator')->get('assetmanagement::lang.revoked_for'); ?></th>
						<th><?php echo app('translator')->get('assetmanagement::lang.allocation_code'); ?></th>
						<th><?php echo app('translator')->get('assetmanagement::lang.asset_name'); ?></th>
						<th><?php echo app('translator')->get('assetmanagement::lang.series_model'); ?></th>
						<th><?php echo app('translator')->get('lang_v1.quantity'); ?></th>
						<th><?php echo app('translator')->get('assetmanagement::lang.revoked_at'); ?></th>
						<th><?php echo app('translator')->get('assetmanagement::lang.revoked_by'); ?></th>
						<th><?php echo app('translator')->get('assetmanagement::lang.asset_category'); ?></th>
						<th>
							<?php echo app('translator')->get('assetmanagement::lang.reason'); ?>
						</th>
					</tr>
				</thead>
				<tbody></tbody>
			</table>
		</div>
		<?php echo $__env->renderComponent(); ?>
	</section>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('javascript'); ?>
<script type="text/javascript">
	$(document).ready(function () {
		assest_revoked_datatable = $("#assest_revoked_table").DataTable({
			processing: true,
            serverSide: true,
            ajax:{
                url: '/asset/revocation',
                "data": function ( d ) {
                    //
                }
            },
            columnDefs: [{
                targets: [0, 2, 8],
                orderable: false,
                searchable: false
            }],
            aaSorting:[[7, 'desc']],
            columns:[
                { data: 'action', name: 'action' },
                { data: 'ref_no', name: 'asset_transactions.ref_no'},
                { data: 'revoked_for', name: 'revoked_for' },
                { data: 'allocation_code', name: 'PT.ref_no'},
                { data: 'asset', name: 'assets.name' },
                { data: 'model', name: 'assets.model' },
                { data: 'quantity', name: 'asset_transactions.quantity' },
                { data: 'revoked_at', name : 'asset_transactions.transaction_datetime' },
                { data: 'revoked_by_name', name: 'revoked_by_name' },
                { data: 'category', name: 'CAT.name' },
                { data: 'reason', name: 'asset_transactions.reason' },
            ]
		});

		$(document).on('click', '#delete_revoked_asset', function () {
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
		                        assest_revoked_datatable.ajax.reload();
		                    } else {
		                        toastr.error(result.msg);
		                    }
		                }
		            });
		        }
		    });
		});
	})
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>