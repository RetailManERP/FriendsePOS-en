<?php
    $materialRows = $order_materials_data ?? [];
    $currentOrder = $order ?? null;
?>

<div class="row">
    <div class="col-md-12">
        <div class="box" style="border-radius:10px;">
            <div class="box-header with-border">
                <h3 class="box-title"><?php echo app('translator')->get('tailorpro::lang.fabric_and_cost'); ?></h3>
                <div class="box-tools">
                    <button type="button" class="btn btn-sm btn-success" id="add_order_material_btn">
                        <i class="fas fa-plus"></i> <?php echo app('translator')->get('tailorpro::lang.add_material'); ?>
                    </button>
                </div>
            </div>
            <div class="box-body">
                <input type="hidden" name="fabric_product_id" id="legacy_fabric_product_id" value="<?php echo e(old('fabric_product_id', optional($currentOrder)->fabric_product_id), false); ?>">
                <input type="hidden" name="fabric_qty" id="legacy_fabric_qty" value="<?php echo e(old('fabric_qty', optional($currentOrder)->fabric_qty), false); ?>">

                <datalist id="tailorpro_material_label_list">
                    <option value="<?php echo app('translator')->get('tailorpro::lang.outer_fabric'); ?>">
                    <option value="<?php echo app('translator')->get('tailorpro::lang.lining_fabric'); ?>">
                    <option value="<?php echo app('translator')->get('tailorpro::lang.thread'); ?>">
                    <option value="<?php echo app('translator')->get('tailorpro::lang.canvas_interlining'); ?>">
                    <option value="<?php echo app('translator')->get('tailorpro::lang.buttons'); ?>">
                    <option value="<?php echo app('translator')->get('tailorpro::lang.shoulder_pads'); ?>">
                    <option value="<?php echo app('translator')->get('tailorpro::lang.zipper'); ?>">
                    <option value="<?php echo app('translator')->get('tailorpro::lang.pocketing_fabric'); ?>">
                </datalist>

                <p class="help-block text-muted" style="margin-bottom:12px;"><?php echo app('translator')->get('tailorpro::lang.materials_cost_auto'); ?></p>

                <div class="table-responsive">
                    <table class="table table-bordered table-striped" id="order_materials_table">
                        <thead>
                            <tr>
                                <th style="min-width:170px;"><?php echo app('translator')->get('tailorpro::lang.material_label'); ?></th>
                                <th style="min-width:240px;"><?php echo app('translator')->get('tailorpro::lang.inventory_product'); ?></th>
                                <th style="min-width:110px;"><?php echo app('translator')->get('tailorpro::lang.available_qty'); ?></th>
                                <th style="min-width:110px;"><?php echo app('translator')->get('tailorpro::lang.required_qty'); ?></th>
                                <th style="min-width:90px;"><?php echo app('translator')->get('tailorpro::lang.unit'); ?></th>
                                <th style="min-width:120px;"><?php echo app('translator')->get('tailorpro::lang.unit_cost'); ?></th>
                                <th style="min-width:120px;"><?php echo app('translator')->get('tailorpro::lang.line_total'); ?></th>
                                <th style="min-width:190px;"><?php echo app('translator')->get('tailorpro::lang.material_notes'); ?></th>
                                <th style="width:60px;"><?php echo app('translator')->get('tailorpro::lang.actions'); ?></th>
                            </tr>
                        </thead>
                        <tbody id="order_materials_body"></tbody>
                    </table>
                </div>

                <p class="text-muted" id="no_order_materials_msg" style="<?php echo e(count($materialRows) ? 'display:none;' : '', false); ?>"><?php echo app('translator')->get('tailorpro::lang.no_order_materials'); ?></p>

                <div class="row" style="margin-top:15px;">
                    <div class="col-md-4">
                        <div class="form-group">
                            <?php echo Form::label('stitching_cost', __('tailorpro::lang.stitching_cost') . ':'); ?>

                            <?php echo Form::number('stitching_cost', old('stitching_cost', optional($currentOrder)->stitching_cost ?? 0), ['class' => 'form-control', 'step' => '0.01', 'min' => '0']); ?>

                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <?php echo Form::label('fabric_cost', __('tailorpro::lang.fabric_cost') . ':'); ?>

                            <?php echo Form::number('fabric_cost', old('fabric_cost', optional($currentOrder)->fabric_cost ?? 0), ['class' => 'form-control', 'step' => '0.01', 'min' => '0', 'readonly', 'id' => 'order_material_total_cost']); ?>

                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <?php echo Form::label('addon_cost', __('tailorpro::lang.addon_cost') . ':'); ?>

                            <?php echo Form::number('addon_cost', old('addon_cost', optional($currentOrder)->addon_cost ?? 0), ['class' => 'form-control', 'step' => '0.01', 'min' => '0']); ?>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
