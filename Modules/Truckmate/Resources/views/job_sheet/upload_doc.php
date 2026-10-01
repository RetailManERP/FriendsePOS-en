
<?php $__env->startSection('title', __('truckmate::lang.upload_job_sheet_docs')); ?>

<?php $__env->startSection('content'); ?>
<?php echo $__env->make('truckmate::job_sheet.nav', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<!-- Content Header (Page header) -->
<section class="content-header no-print">
    <div class="tm-page-header">
        <h1><i class="fas fa-upload" style="color:var(--tm-primary)"></i> <?php echo app('translator')->get('truckmate::lang.upload_job_sheet_docs'); ?></h1>
    </div>
</section>
<!-- Main content -->
<section class="content tm-content">
	<?php $__env->startComponent('components.widget', ['class' => 'box-primary']); ?>
		<div class="row">
			<div class="<?php if($job_sheet->media->count() > 0): ?> col-md-6 <?php else: ?> col-md-12 <?php endif; ?>">
				<table class="table">
					<tr>
						<th><?php echo app('translator')->get('truckmate::lang.job_sheet_no'); ?>:</th>
						<td><?php echo e($job_sheet->job_sheet_no, false); ?></td>
					</tr>
					<tr>
						<th><?php echo app('translator')->get('receipt.date'); ?>:</th>
						<td><?php echo format_datetime_br($job_sheet->created_at); ?></td>
					</tr>
					<tr>
						<th>
							<?php echo app('translator')->get('role.customer'); ?>:
						</th>
						<td><?php echo e(!empty($job_sheet->customer->name) ? $job_sheet->customer->name : $job_sheet->customer->supplier_business_name, false); ?></td>
					</tr>
					<tr>
						<th><?php echo app('translator')->get('truckmate::lang.job_sheet'); ?> <?php echo app('translator')->get('business.location'); ?>:</th>
						<td>
							<?php echo e($job_sheet->businessLocation?->name, false); ?>

						</td>
					</tr>
				</table>
			</div>
			<?php if($job_sheet->media->count() > 0): ?>
				<div class="col-md-6">
					<div class="row ">
						<div class="col-md-12">
							<h4>
							<?php echo app('translator')->get('truckmate::lang.uploaded_image_for', ['number' => $job_sheet->job_sheet_no]); ?>
							</h4>
						</div>
						<div class="col-md-12">
							<?php if ($__env->exists('truckmate::job_sheet.partials.document_table_view', ['medias' => $job_sheet->media])) echo $__env->make('truckmate::job_sheet.partials.document_table_view', ['medias' => $job_sheet->media], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
						</div>
					</div>
				</div>
			<?php endif; ?>
		</div>
	<?php echo $__env->renderComponent(); ?>
	<?php $__env->startComponent('components.widget', ['class' => 'box-primary']); ?>
		<?php if(in_array('upload_documents', $enabled_modules)): ?>
		<?php echo Form::open(['action' => '\Modules\Truckmate\Http\Controllers\JobSheetController@postUploadDocs', 'id' => 'job_sheet_doc_upload', 'method' => 'post']); ?>

			<input type="hidden" name="job_sheet_id" value="<?php echo e($job_sheet->id, false); ?>">
			<div class="row">
		        <div class="col-md-12">
		            <div class="form-group">
		                <label for="fileupload">
		                    <?php echo app('translator')->get('truckmate::lang.document'); ?>:
		                </label>
		                <i class="fas fa-info-circle text-muted" data-bs-toggle="tooltip" data-bs-html="true" title="<?php echo app('translator')->get('purchase.max_file_size', ['size' => config('constants.document_size_limit') / 1000000]); ?><br><?php echo app('translator')->get('lang_v1.allowed_file'); ?>: <?php echo e(implode(', ', config('constants.document_upload_mimes_types')), false); ?>"></i>
		                <div class="dropzone" id="imageUpload"></div>
		            </div>
		            <input type="hidden" id="images" name="images" value="">
		        </div>
		    </div>
		    <button type="submit" class="btn btn-block btn-primary pull-right">
                <?php echo app('translator')->get('messages.save'); ?>
            </button>
	    <?php echo Form::close(); ?>

	    <?php endif; ?>
   	<?php echo $__env->renderComponent(); ?>
   	<?php
   		$accepted_files = implode(',', array_keys(config('constants.document_upload_mimes_types')));
   	?>
</section>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('javascript'); ?>
<script type="text/javascript">
	Dropzone.autoDiscover = false;
	$(function () {
		var file_names = [];
	    $("div#imageUpload").dropzone({
	        url: base_path+'/post-document-upload',
	        paramName: 'file',
	        uploadMultiple: true,
	        autoProcessQueue: true,
	        timeout:600000, //10 min
	        acceptedFiles: '<?php echo e($accepted_files, false); ?>',
	        maxFiles: 4,
	        headers: {
	            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
	        },
	        success: function(file, response) {
	            if (response.success) {
	                toastr.success(response.msg);
	                file_names.push(response.file_name);
	                $('input#images').val(JSON.stringify(file_names));
	            } else {
	                toastr.error(response.msg);
	            }
	        },
	    });

	    $(document).on('click', '.delete_media', function (e) {
            e.preventDefault();
            var url = $(this).data('href');
            var this_btn = $(this);
            swal({
                title: LANG.sure,
                icon: "warning",
                buttons: true,
                dangerMode: true,
            }).then((confirmed) => {
                if (confirmed) {
                    $.ajax({
                        method: 'GET',
                        url: url,
                        dataType: 'json',
                        success: function(result) {
                            if(result.success == true){
			                    this_btn.closest('tr').remove();
			                    toastr.success(result.msg);
			                } else {
			                    toastr.error(result.msg);
			                }
                        }
                    });
                }
            });
        });
	});
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>