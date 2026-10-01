
<?php $__env->startSection('title', __( 'repair::lang.repair_label' )); ?>
<?php $__env->startSection('content'); ?>
<style type="text/css">
</style>
<!-- Main content -->
<section class="content">
<div class="row">
    <div class="col-md-12 text-center">
			<?php
				$loop_count = 0;
			?>
			<?php $__currentLoopData = $product_details; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $details): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
				<?php while($details['qty'] > 0): ?>
					<?php
						$loop_count += 1;
						$is_new_row = ($barcode_details->is_continuous) && (($loop_count == 1) || ($loop_count % $barcode_details->stickers_in_one_row) == 1) ? true : false;

						$is_new_row = true;
					?>

					<?php if(($barcode_details->is_continuous) || (!$barcode_details->is_continuous && ($loop_count % $barcode_details->stickers_in_one_sheet) == 1)): ?>

						
					<div style="<?php if(!$barcode_details->is_continuous): ?> height:<?php echo e($barcode_details->paper_height*0.95, false); ?>in !important; <?php else: ?> height:<?php echo e($barcode_details->height*0.95, false); ?>in !important; <?php endif; ?> width:<?php echo e($barcode_details->paper_width, false); ?>in !important; line-height: 16px !important; page-break-after: always;">


						
						<div style="<?php if(!$barcode_details->is_continuous): ?>margin-top:<?php echo e($barcode_details->top_margin, false); ?>in !important; margin-bottom:<?php echo e($barcode_details->top_margin, false); ?>in !important; margin-left:<?php echo e($barcode_details->left_margin, false); ?>in !important;margin-right:<?php echo e($barcode_details->left_margin, false); ?>in !important;<?php endif; ?>" class="label-border-internal">
					<?php endif; ?>

					<?php if((!$barcode_details->is_continuous) && ($loop_count % $barcode_details->stickers_in_one_sheet) <= $barcode_details->stickers_in_one_row): ?>
						<?php $first_row = true ?>
					<?php elseif($barcode_details->is_continuous && ($loop_count <= $barcode_details->stickers_in_one_row) ): ?>
						<?php $first_row = true ?>
					<?php else: ?>
						<?php $first_row = false ?>
					<?php endif; ?>

					<div style="height:<?php echo e($barcode_details->height, false); ?>in !important; line-height: <?php echo e($barcode_details->height, false); ?>in; width:<?php echo e($barcode_details->width*0.97, false); ?>in !important; display: inline-block; <?php if(!$is_new_row): ?> margin-left:<?php echo e($barcode_details->col_distance, false); ?>in !important; <?php endif; ?> <?php if(!$first_row): ?>margin-top:<?php echo e($barcode_details->row_distance, false); ?>in !important; <?php endif; ?>" class="sticker-border text-center">
					<div style="display:inline-block;vertical-align:middle;line-height:16px !important;     text-align: center;" class="barcode">
						
						<?php if(!empty($business_name)): ?>
							<b style="display: block !important" class="text-uppercase"><?php echo e($business_name, false); ?></b>
						<?php endif; ?>
						<?php if(!empty($details['details']->contact->name)): ?>
							<small><?php echo app('translator')->get('contact.customer'); ?>: <?php echo e($details['details']->contact->name, false); ?></small><br>
						<?php endif; ?>
						<?php if(!empty($details['details']->repair_model)): ?>
							<small><?php echo app('translator')->get('repair::lang.model'); ?>: <?php echo e($details['details']->repair_model, false); ?></small><br>
						<?php endif; ?>

						
						<img class="center-block" style="width:90% !important;height: <?php echo e($barcode_details->height*0.24, false); ?>in !important;" src="data:image/png;base64,<?php echo e(DNS1D::getBarcodePNG($details['details']->invoice_no, $barcode_type, 2,30,array(39, 48, 54), true), false); ?>">

					</div>
					</div>

					<?php if($barcode_details->is_continuous || ($loop_count % $barcode_details->stickers_in_one_sheet) == 0): ?>
						
						</div>

						
						</div>
					<?php endif; ?>

					<?php
						$details['qty'] = $details['qty'] - 1;
					?>
				<?php endwhile; ?>
				<br>
				<br>
				<a href="#" class="print-invoice no-print btn btn-success" data-href="<?php echo e(route('sell.printInvoice', [$details['details']->id]), false); ?>"><i class="fa fa-print"></i> <?php echo e(__("repair::lang.print_invoice"), false); ?></a>

				<a href="#" id="print-barcode" class="no-print btn btn-primary"><i class="fa fa-barcode"></i> <?php echo e(__("repair::lang.print_barcode"), false); ?></a>
			<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

			</div>
    </div>
</div>
</section>
<!-- /.content -->

<?php $__env->stopSection(); ?>

<?php $__env->startSection('javascript'); ?>
    <script type="text/javascript">
        setTimeout(function(){ $('.barcode').printThis(); }, 1000);
        $('.print-invoice').click( function() {
        	$('.content').addClass('no-print');
        });
        $('#print-barcode').click( function() {
        	$('.content').removeClass('no-print');
        	$('.barcode').printThis();
        });
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>