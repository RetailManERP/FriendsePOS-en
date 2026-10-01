<div class="modal fade" id="custom_blind_modal" tabindex="-1" role="dialog" aria-labelledby="customBlindModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="customBlindModalLabel">Customize Blind</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>

            </div>
            <div class="modal-body">
                <input type="hidden" id="cb_blind_type" value="">

                <div class="row">
                    <div class="form-group">
                        <label for="cb_fabric"><?php echo app('translator')->get('lang_v1.fabric'); ?>:</label>
                        <select id="cb_fabric" class="form-control select2" style="width: 100%;">
                            <option value=""><?php echo app('translator')->get('messages.please_select'); ?></option>
                            <?php $__currentLoopData = $blind_products['fabrics']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $fabric): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <?php $__currentLoopData = $fabric->variations; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $variation): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value="<?php echo e($variation->id, false); ?>" data-price="<?php echo e($variation->sell_price_inc_tax, false); ?>">
                                        <?php echo e($fabric->name, false); ?> <?php if($fabric->type == 'variable'): ?> - <?php echo e($variation->name, false); ?> <?php endif; ?>
                                    </option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>
                    </div>

                    <!-- <div class="row"> -->
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="cb_width"><?php echo app('translator')->get('lang_v1.width'); ?> (in):</label>
                            <input type="number" id="cb_width" class="form-control" step="0.01" min="0"
                                placeholder="Width">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="cb_height"><?php echo app('translator')->get('lang_v1.height'); ?> (in):</label>
                            <input type="number" id="cb_height" class="form-control" step="0.01" min="0"
                                placeholder="Height">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="cb_quantity"><?php echo app('translator')->get('lang_v1.quantity'); ?>:</label>
                            <input type="number" id="cb_quantity" class="form-control" value="1" min="1" step="1">
                        </div>
                    </div>
                    <!-- </div> -->

                    <div class="form-group">
                        <label>Calculated Square Footage (Min 16 / item):</label>
                        <div class="input-group">
                            <input type="text" id="cb_sqft" class="form-control" readonly>
                            <span class="input-group-addon">sq ft</span>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="cb_controller"><?php echo app('translator')->get('lang_v1.controller_options'); ?>:</label>
                        <select id="cb_controller" name="cb_controller" class="form-control select2" style="width: 100%;">
                            <option value=""><?php echo app('translator')->get('messages.please_select'); ?></option>
                            <option value="manual">Manual</option>
                            <option value="motor">Motor</option>
                        </select>
                    </div>

                    <div class="form-group" id="cb_motor_selection_div" style="display: none;">
                        <label for="cb_motor">Select Motor:</label>
                        <select id="cb_motor" class="form-control select2" style="width: 100%;">
                            <option value=""><?php echo app('translator')->get('messages.please_select'); ?></option>
                            <?php $__currentLoopData = $blind_products['motor']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $motor): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <?php $__currentLoopData = $motor->variations; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $variation): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <?php
                                        $v_name = strtolower($variation->name);
                                        $m_name = strtolower($motor->name);
                                        if (strpos($v_name, '25mm') === false && strpos($v_name, '35mm') === false && strpos($m_name, '25mm') === false && strpos($m_name, '35mm') === false) {
                                            continue;
                                        }
                                    ?>
                                    <option value="<?php echo e($variation->id, false); ?>"><?php echo e($motor->name, false); ?> <?php if($motor->type == 'variable'): ?> -
                                    <?php echo e($variation->name, false); ?> <?php endif; ?>
                                    </option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>
                    </div>
                </div>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-bs-dismiss="modal"><?php echo app('translator')->get('messages.close'); ?></button>
                <button type="button" class="btn btn-primary" id="cb_add_btn"><?php echo app('translator')->get('messages.add'); ?></button>
            </div>
        </div>
    </div>
</div>