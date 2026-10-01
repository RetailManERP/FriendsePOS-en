<div class="col-md-3">
	<div class="form-group">
		<?php
			$is_disabled = !empty($product->woocommerce_disable_sync) ? true : false;
      if(empty($product) && !empty($duplicate_product->woocommerce_disable_sync)){
        $is_disabled = true;
      }
		?>
      <br>
        <label>
        	<input type="hidden" name="woocommerce_disable_sync" value="0">
          	<?php echo Form::checkbox('woocommerce_disable_sync', 1, $is_disabled, ['class' => 'form-check-input']); ?> <strong><?php echo app('translator')->get('woocommerce::lang.woocommerce_disable_sync'); ?></strong>
        </label>
        <?php
                if(session('business.enable_tooltip')){
                    echo '<i class="fa fa-info-circle text-info hover-q no-print"
                    aria-hidden="true"
                    data-bs-toggle="tooltip"
                    data-bs-placement="bottom"
                    data-bs-html="true"
                    title="' . __('woocommerce::lang.woocommerce_disable_sync_help') . '"></i>';
                }
            ?>
  	</div>
</div>
<div class="col-md-3">
	<div class="form-group">
		<?php
			$product_status = !empty($product->woocommerce_product_status) ? $product->woocommerce_product_status : 'publish';
			if(empty($product) && !empty($duplicate_product->woocommerce_product_status)){
				$product_status = $duplicate_product->woocommerce_product_status;
			}
		?>
		<?php echo Form::label('woocommerce_product_status', __('woocommerce::lang.product_status') . ':'); ?>

		<?php echo Form::select('woocommerce_product_status', ['publish' => 'Publish', 'draft' => 'Draft', 'pending' => 'Pending'], $product_status, ['class' => 'form-control select2']); ?>

	</div>
</div>
