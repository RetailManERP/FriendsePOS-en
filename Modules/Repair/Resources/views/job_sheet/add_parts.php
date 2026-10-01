
<?php $__env->startSection('title', __('repair::lang.add_jobsheet_parts')); ?>

<?php $__env->startSection('content'); ?>
<?php echo $__env->make('repair::layouts.nav', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<!-- Content Header (Page header) -->
<section class="content-header">
    <h1><?php echo app('translator')->get('repair::lang.add_jobsheet_parts'); ?></h1>
</section>

<!-- Main content -->
<section class="content">
	<?php if(!empty($pos_settings['allow_overselling'])): ?>
		<input type="hidden" id="is_overselling_allowed">
	<?php endif; ?>
	<input type="hidden" id="location_id" value="<?php echo e($job_sheet->businessLocation?->id, false); ?>">
	<?php $__env->startComponent('components.widget', ['class' => 'box-primary']); ?>
		<table class="table">
			<tr>
				<th><?php echo app('translator')->get('repair::lang.job_sheet_no'); ?>:</th>
				<td><?php echo e($job_sheet->job_sheet_no, false); ?></td>
				<th><?php echo app('translator')->get('receipt.date'); ?>:</th>
				<td><?php echo format_datetime_br($job_sheet->created_at); ?></td>
			</tr>
			<tr>
				<th>
					<?php echo app('translator')->get('role.customer'); ?>:
				</th>
				<td><?php echo e($job_sheet->customer->name, false); ?></td>
				<th><?php echo app('translator')->get('business.location'); ?>:</th>
				<td>
					
					<?php echo e($job_sheet->businessLocation?->name, false); ?>

				</td>
			</tr>
		</table>
	<?php echo $__env->renderComponent(); ?>
	<?php echo Form::open(['url' => action([\Modules\Repair\Http\Controllers\JobSheetController::class, 'saveParts'], $job_sheet->id), 'method' => 'post', 'id' => 'add_part_form' ]); ?>

	<?php $__env->startComponent('components.widget', ['class' => 'box-primary', 'title' => __('repair::lang.add_parts')]); ?>
		<div class="row">
			<div class="col-sm-8 col-sm-offset-2">
				<div class="form-group">
					<div class="input-group">
						<span class="input-group-text">
							<i class="fa fa-search"></i>
						</span>
						<?php echo Form::text('search_product', null, ['class' => 'form-control', 'id' => 'search_job_sheet_parts', 'placeholder' => __('repair::lang.search_parts')]); ?>

					</div>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-sm-10 col-sm-offset-1">
				<div class="table-responsive">
				<table class="table table-bordered table-striped table-condensed" 
				id="job_sheet_parts_table">
					<thead>
						<tr>
							<th class="col-sm-4 text-center">	
								<?php echo app('translator')->get('repair::lang.part'); ?>
							</th>
							<th class="col-sm-2 text-center">
								<?php echo app('translator')->get('sale.qty'); ?>
							</th>
							<th class="col-sm-2 text-center"><i class="fa fa-trash" aria-hidden="true"></i></th>
						</tr>
					</thead>
					<tbody>
						<?php if(!empty($parts)): ?>
							<?php $__currentLoopData = $parts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $part): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
								<?php echo $__env->make('repair::job_sheet.partials.job_sheet_part_row', ['variation_name' => $part['variation_name'], 'unit' => $part['unit'], 'quantity' => $part['quantity'], 'variation_id' => $part['variation_id']], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
							<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
						<?php endif; ?>
					</tbody>
				</table>
				</div>
			</div>
		</div>
	<?php echo $__env->renderComponent(); ?>
	<?php if(!empty($status_update_data) && $status_update_data['job_sheet_id'] == $job_sheet->id): ?>
		<?php $__env->startComponent('components.widget', ['class' => 'box-primary']); ?>
			<?php echo $__env->make('repair::job_sheet.partials.edit_status_form', ['status_update_data' => $status_update_data], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
		<?php echo $__env->renderComponent(); ?>
	<?php endif; ?>
	<div class="row">
		<div class="col-sm-12">
			<button type="button" id="submit_add_part_form" class="btn btn-primary float-end"><?php echo app('translator')->get('messages.save'); ?></button>
		</div>
	</div>
	<?php echo Form::close(); ?>

</section>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('javascript'); ?>
<script type="text/javascript">
	$(document).ready( function(){
		$('#search_job_sheet_parts')
            .autocomplete({
                source: function(request, response) {
                    $.getJSON(
                        '/products/list',
                        { term: request.term },
                        response
                    );
                },
                minLength: 2,
                response: function(event, ui) {
                    if (ui.content.length == 1) {
                        ui.item = ui.content[0];
                        $(this).data('ui-autocomplete')._trigger('select', 'autocompleteselect', ui);
                        $(this).autocomplete('close');
                    } else if (ui.content.length == 0) {
                        swal(LANG.no_products_found);
                    }
                },
                select: function(event, ui) {
					var is_overselling_allowed = false;
					if($('input#is_overselling_allowed').length) {
						is_overselling_allowed = true;
					}
					if(ui.item.qty_available > 0 || is_overselling_allowed){
						job_sheet_parts_row(ui.item.variation_id);
					}else{
						swal(LANG.out_of_stock);
					}
                   
                },
            })
            .autocomplete('instance')._renderItem = function(ul, item) {
	            var string = '<div>' + item.name;
	                if (item.type == 'variable') {
	                    string += '-' + item.variation;
	                }
	                string += ' (' + item.sub_sku + ') </div>';
	                return $('<li>')
	                    .append(string)
	                    .appendTo(ul);
        	};

       	//initialize editor
        tinymce.init({
            selector: 'textarea#email_body',
        });

        $('#send_sms').change(function() {
            if ($(this). is(":checked")) {
                $('div.sms_body').fadeIn();
            } else {
                $('div.sms_body').fadeOut();
            }
        });

        $('#send_email').change(function() {
            if ($(this). is(":checked")) {
                $('div.email_template').fadeIn();
            } else {
                $('div.email_template').fadeOut();
            }
        });

        if ($('#status_id_modal').length) {
            ;
            $("#sms_body").val($("#status_id_modal :selected").data('sms_template'));
            $("#email_subject").val($("#status_id_modal :selected").data('email_subject'));
            tinymce.activeEditor.setContent($("#status_id_modal :selected").data('email_body'));  
        }

        $('#status_id_modal').on('change', function() {
            var sms_template = $(this).find(':selected').data('sms_template');
            var email_subject = $(this).find(':selected').data('email_subject');
            var email_body = $(this).find(':selected').data('email_body');

            $("#sms_body").val(sms_template);
            $("#email_subject").val(email_subject);
            tinymce.activeEditor.setContent(email_body);

            if ($('#status_modal .mark-as-complete-btn').length) {
                if ($(this).find(':selected').data('is_completed_status') == 1) 
                {
                    $('#status_modal').find('.mark-as-complete-btn').removeClass('hide');
                    $('#status_modal').find('.mark-as-incomplete-btn').addClass('hide');
                } else {
                    $('#status_modal').find('.mark-as-complete-btn').addClass('hide');
                    $('#status_modal').find('.mark-as-incomplete-btn').removeClass('hide');
                }
            }
        });
	});

	function job_sheet_parts_row(variation_id) {
		var row_index = parseInt($('#product_row_index').val());
	    var location_id = $('input#location_id').val();
		var allow_overselling = false;
		if($('input#is_overselling_allowed').length) {
			allow_overselling = true;
		}
	    $.ajax({
	        method: 'POST',
	        url: "<?php echo e(action([\Modules\Repair\Http\Controllers\JobSheetController::class, 'jobSheetPartRow']), false); ?>",
	        data: { variation_id: variation_id, location_id : location_id, allow_overselling : allow_overselling },
	        dataType: 'html',
	        success: function(result) {
	            $('table#job_sheet_parts_table tbody').append(result);
	            $('input#search_job_sheet_parts').val('')
	            $('input#search_job_sheet_parts').focus().select();
	            
	        },
	    });
	}

	$(document).on('click', '.remove_product_row', function(){
		$(this).closest('tr').remove();
	})

	$(document).on('click', '#submit_add_part_form', function(e){
		$('form#add_part_form').submit();
	})
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>