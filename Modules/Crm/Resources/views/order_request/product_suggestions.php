<?php $__empty_18 = true; $__currentLoopData = $products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $variation): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_18 = false; ?>
    <?php
        $product = $variation->product;
        $name = $product->name;
        if ($product->type === 'variable' && !empty($variation->name) && $variation->name !== 'DUMMY') {
            $name .= ' - ' . $variation->name;
        }
        $gallery_images = $product->media->where('model_media_type', 'product_gallery')->pluck('display_url')->filter()->values();
        if (!empty($product->image) && !empty($product->image_url)) {
            $gallery_images->prepend($product->image_url);
        }
    ?>
    <article class="order-request-suggestion" title="<?php echo e($name, false); ?> (<?php echo e($variation->sub_sku, false); ?>)">
        <button type="button" class="order-request-suggestion-image-button js-order-request-gallery <?php echo e($gallery_images->isEmpty() ? 'is-unavailable' : '', false); ?>"
            data-gallery='<?php echo e(json_encode($gallery_images->all()), false); ?>'
            aria-label="View images for <?php echo e($name, false); ?>" <?php echo e($gallery_images->isEmpty() ? 'disabled' : '', false); ?>>
            <img class="order-request-suggestion-image" src="<?php echo e($product->image_url, false); ?>" alt="<?php echo e($name, false); ?>">
        </button>
        <span class="order-request-suggestion-name"><?php echo e($name, false); ?></span>
        <small class="text-muted">(<?php echo e($variation->sub_sku, false); ?>)</small>
        <strong><?php 
            $formated_number = "";
            /* if (session("business.currency_symbol_placement") == "before") {
                 $formated_number .= session("currency")["symbol"] . " ";
            }*/ 
            $formated_number .= number_format((float) $variation->sell_price_inc_tax, session("business.currency_precision", 2) , session("currency")["decimal_separator"], session("currency")["thousand_separator"]);

            /* if (session("business.currency_symbol_placement") == "after") {
                 $formated_number .= " " . session("currency")["symbol"];
            } */
            echo $formated_number; ?></strong>
        <button type="button" class="btn btn-primary btn-sm btn-block js-order-request-add"
            data-variation-id="<?php echo e($variation->id, false); ?>">
            <i class="fa fa-cart-plus" aria-hidden="true"></i> Add to Cart
        </button>
    </article>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_18): ?>
    <div class="col-12 text-center text-muted py-4"><?php echo app('translator')->get('lang_v1.no_products_to_display'); ?></div>
<?php endif; ?>
