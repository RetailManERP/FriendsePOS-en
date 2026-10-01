
<?php $__env->startSection('title', __('tailorpro::lang.edit_order')); ?>

<?php $__env->startSection('content'); ?>
<?php echo $__env->make('tailorpro::layouts.nav', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<section class="content-header no-print">
    <h1>
        <i class="fas fa-edit" style="color:#6f42c1;"></i> <?php echo app('translator')->get('tailorpro::lang.edit_order'); ?> - <?php echo e($order->order_no, false); ?>

    </h1>
</section>

<section class="content no-print">
    <?php echo Form::open(['url' => action([\Modules\TailorPro\Http\Controllers\OrderController::class, 'update'], [$order->id]), 'method' => 'put', 'id' => 'tailorpro_order_form', 'files' => true]); ?>


    
    <div class="row">
        <div class="col-md-8">
            <div class="box" style="border-radius:10px;">
                <div class="box-header with-border">
                    <h3 class="box-title"><?php echo app('translator')->get('tailorpro::lang.order_details'); ?></h3>
                </div>
                <div class="box-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <?php echo Form::label('customer_id', __('role.customer') . ':*'); ?>

                                <?php echo Form::select('customer_id', $customers, $order->customer_id, ['class' => 'form-control select2', 'required', 'id' => 'customer_id']); ?>

                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <?php echo Form::label('location_id', __('purchase.business_location') . ':'); ?>

                                <?php echo Form::select('location_id', $business_locations, $order->location_id, ['class' => 'form-control select2', 'placeholder' => __('messages.please_select')]); ?>

                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-3">
                            <div class="form-group">
                                <?php echo Form::label('order_date', __('tailorpro::lang.order_date') . ':'); ?>

                                <?php echo Form::text('order_date', $order->order_date ? \Carbon::createFromTimestamp(strtotime($order->order_date))->format(session('business.date_format')) : null, ['class' => 'form-control', 'id' => 'tailorpro_order_date', 'readonly']); ?>

                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <?php echo Form::label('delivery_date', __('tailorpro::lang.delivery_date') . ':'); ?>

                                <?php echo Form::text('delivery_date', $order->delivery_date ? \Carbon::createFromTimestamp(strtotime($order->delivery_date))->format(session('business.date_format')) : null, ['class' => 'form-control', 'id' => 'tailorpro_delivery_date', 'readonly']); ?>

                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <?php echo Form::label('status_id', __('sale.status') . ':*'); ?>

                                <?php echo Form::select('status_id', $statuses['statuses'], $order->status_id, ['class' => 'form-control select2', 'required']); ?>

                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <?php echo Form::label('priority', __('tailorpro::lang.priority') . ':'); ?>

                                <?php echo Form::select('priority', ['normal' => __('tailorpro::lang.normal'), 'urgent' => __('tailorpro::lang.urgent'), 'express' => __('tailorpro::lang.express')], $order->priority, ['class' => 'form-control']); ?>

                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <?php echo Form::label('garment_type', __('tailorpro::lang.garment_type') . ':'); ?>

                                <?php echo Form::text('garment_type', $order->garment_type, ['class' => 'form-control']); ?>

                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <?php echo Form::label('measurement_id', __('tailorpro::lang.measurement') . ':'); ?>

                                <?php echo Form::select('measurement_id', $measurements, $order->measurement_id, ['class' => 'form-control', 'id' => 'measurement_id', 'placeholder' => __('messages.please_select')]); ?>

                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <?php echo Form::label('tailor_id', __('tailorpro::lang.tailor') . ':'); ?>

                                <?php echo Form::select('tailor_id', $tailors, $order->tailor_id, ['class' => 'form-control select2']); ?>

                            </div>
                        </div>
                    </div>

                    
                    <?php if($custom_fields->count()): ?>
                    <?php $cfData = $order->custom_fields_data ? json_decode($order->custom_fields_data, true) : []; ?>
                    <div class="row">
                        <?php $__currentLoopData = $custom_fields; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cf): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div class="col-md-4">
                            <div class="form-group">
                                <?php echo Form::label('custom_fields[' . $cf->field_name . ']', $cf->field_label . ($cf->is_required ? ':*' : ':')); ?>

                                <?php if($cf->field_type == 'text'): ?>
                                    <?php echo Form::text('custom_fields[' . $cf->field_name . ']', $cfData[$cf->field_name] ?? null, ['class' => 'form-control', $cf->is_required ? 'required' : '']); ?>

                                <?php elseif($cf->field_type == 'number'): ?>
                                    <?php echo Form::number('custom_fields[' . $cf->field_name . ']', $cfData[$cf->field_name] ?? null, ['class' => 'form-control', 'step' => 'any', $cf->is_required ? 'required' : '']); ?>

                                <?php elseif($cf->field_type == 'select'): ?>
                                    <?php echo Form::select('custom_fields[' . $cf->field_name . ']', is_array($cf->options) ? array_combine($cf->options, $cf->options) : [], $cfData[$cf->field_name] ?? null, ['class' => 'form-control', 'placeholder' => __('messages.please_select'), $cf->is_required ? 'required' : '']); ?>

                                <?php elseif($cf->field_type == 'textarea'): ?>
                                    <?php echo Form::textarea('custom_fields[' . $cf->field_name . ']', $cfData[$cf->field_name] ?? null, ['class' => 'form-control', 'rows' => 2, $cf->is_required ? 'required' : '']); ?>

                                <?php elseif($cf->field_type == 'date'): ?>
                                    <?php echo Form::text('custom_fields[' . $cf->field_name . ']', $cfData[$cf->field_name] ?? null, ['class' => 'form-control tp_custom_date', 'readonly', $cf->is_required ? 'required' : '']); ?>

                                <?php endif; ?>
                            </div>
                        </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>

        
        <div class="col-md-4">
            <div class="box" style="border-radius:10px;">
                <div class="box-header with-border">
                    <h3 class="box-title"><i class="fas fa-images"></i> <?php echo app('translator')->get('tailorpro::lang.design_images'); ?></h3>
                </div>
                <div class="box-body">
                    <?php if($order->media && $order->media->count()): ?>
                    <div class="row" style="margin-bottom:10px;">
                        <?php $__currentLoopData = $order->media; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $m): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div class="col-xs-4 col-md-6 text-center" style="margin-bottom:8px;" id="media_<?php echo e($m->id, false); ?>">
                            <img src="<?php echo e(asset('uploads/media/' . $m->file_name), false); ?>" style="width:100%;max-height:100px;object-fit:cover;border-radius:6px;">
                            <button type="button" class="btn btn-xs btn-danger delete_image_btn" data-id="<?php echo e($m->id, false); ?>" style="margin-top:4px;">
                                <i class="fas fa-trash"></i>
                            </button>
                        </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>
                    <?php endif; ?>
                    <div class="form-group">
                        <?php echo Form::file('design_images[]', ['class' => 'form-control', 'multiple', 'accept' => 'image/*']); ?>

                    </div>
                </div>
            </div>
        </div>
    </div>

    
    <div class="row">
        <div class="col-md-12">
            <div class="box" style="border-radius:10px;">
                <div class="box-header with-border">
                    <h3 class="box-title"><i class="fas fa-layer-group"></i> <?php echo app('translator')->get('tailorpro::lang.order_items'); ?></h3>
                    <div class="box-tools">
                        <button type="button" class="btn btn-sm btn-success" id="add_order_item_btn">
                            <i class="fas fa-plus"></i> <?php echo app('translator')->get('tailorpro::lang.add_item'); ?>
                        </button>
                    </div>
                </div>
                <div class="box-body">
                    <div id="order_items_container">
                        <?php $__currentLoopData = $order->orderItems; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $oi): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div class="order-item-row" style="border:1px solid #ddd;border-radius:8px;padding:15px;margin-bottom:10px;background:#fafafa;">
                            <input type="hidden" name="order_items[<?php echo e($loop->index, false); ?>][id]" value="<?php echo e($oi->id, false); ?>">
                            <div class="row">
                                <div class="col-md-3"><div class="form-group"><label><?php echo app('translator')->get('tailorpro::lang.garment_type'); ?></label>
                                    <input type="text" name="order_items[<?php echo e($loop->index, false); ?>][garment_type]" class="form-control" value="<?php echo e($oi->garment_type, false); ?>">
                                </div></div>
                                <div class="col-md-3"><div class="form-group"><label><?php echo app('translator')->get('tailorpro::lang.tailor'); ?></label>
                                    <?php echo Form::select('order_items[' . $loop->index . '][tailor_id]', $tailors, $oi->tailor_id, ['class' => 'form-control']); ?>

                                </div></div>
                                <div class="col-md-2"><div class="form-group"><label><?php echo app('translator')->get('tailorpro::lang.stitching_cost'); ?></label>
                                    <input type="number" name="order_items[<?php echo e($loop->index, false); ?>][stitching_cost]" class="form-control" step="0.01" min="0" value="<?php echo e($oi->stitching_cost, false); ?>">
                                </div></div>
                                <div class="col-md-2"><div class="form-group"><label><?php echo app('translator')->get('tailorpro::lang.addon_cost'); ?></label>
                                    <input type="number" name="order_items[<?php echo e($loop->index, false); ?>][addon_cost]" class="form-control" step="0.01" min="0" value="<?php echo e($oi->addon_cost, false); ?>">
                                </div></div>
                                <div class="col-md-2 text-right" style="padding-top:25px;">
                                    <button type="button" class="btn btn-sm btn-danger remove_item_btn"><i class="fas fa-trash"></i></button>
                                </div>
                            </div>
                        </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>
                    <p class="text-muted" id="no_items_msg" style="<?php echo e($order->orderItems->count() > 0 ? 'display:none;' : '', false); ?>"><?php echo app('translator')->get('tailorpro::lang.no_items_added'); ?></p>
                </div>
            </div>
        </div>
    </div>

    <?php echo $__env->make('tailorpro::order.partials.materials_section', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

    <div class="row">
        <div class="col-md-12">
            <div class="box" style="border-radius:10px;">
                <div class="box-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <?php echo Form::label('design_notes', __('tailorpro::lang.design_notes') . ':'); ?>

                                <?php echo Form::textarea('design_notes', $order->design_notes, ['class' => 'form-control', 'rows' => 3]); ?>

                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <?php echo Form::label('remarks', __('tailorpro::lang.remarks') . ':'); ?>

                                <?php echo Form::textarea('remarks', $order->remarks, ['class' => 'form-control', 'rows' => 3]); ?>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <?php echo Form::close(); ?>

</section>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('javascript'); ?>
<script type="text/javascript">
$(document).ready(function () {
    var itemIndex = <?php echo e($order->orderItems->count(), false); ?>;
    var materialIndex = 0;
    var tailors = <?php echo json_encode($tailors, 15, 512) ?>;
    var initialMaterials = <?php echo json_encode($order_materials_data ?? [], 15, 512) ?>;
    var materialLabelPlaceholder = <?php echo json_encode(__('tailorpro::lang.material_label_placeholder'), 15, 512) ?>;
    var materialNotesPlaceholder = <?php echo json_encode(__('tailorpro::lang.material_notes_placeholder'), 15, 512) ?>;
    var materialSearchPlaceholder = <?php echo json_encode(__('tailorpro::lang.search_material_product'), 15, 512) ?>;
    var pleaseSelectText = <?php echo json_encode(__('messages.please_select'), 15, 512) ?>;

    function tailorProUrl(path) {
        var currentPath = window.location.pathname;
        var modulePathParts = currentPath.split('/tailorpro/');
        var basePath = modulePathParts.length > 1 ? modulePathParts[0] : '';

        return basePath + '/tailorpro/' + String(path || '').replace(/^\/+/, '');
    }

    var materialSearchUrl = tailorProUrl('material-products');

    $('#tailorpro_order_date, #tailorpro_delivery_date').datetimepicker({
        format: moment_date_format,
        ignoreReadonly: true,
    });

    $('.tp_custom_date').datetimepicker({
        format: moment_date_format,
        ignoreReadonly: true,
    });

    $('#customer_id').on('change', function() {
        var customer_id = $(this).val();
        if (customer_id) {
            $.ajax({
                url: tailorProUrl('customer-measurements/' + customer_id),
                method: 'GET',
                dataType: 'json',
                success: function(data) {
                    var $select = $('#measurement_id');
                    $select.empty().append('<option value="">' + pleaseSelectText + '</option>');
                    $.each(data, function(i, item) {
                        $select.append('<option value="' + item.id + '">' + item.text + '</option>');
                    });
                }
            });
        }
    });

    function escapeHtml(text) {
        return $('<div/>').text(text || '').html();
    }

    function buildMaterialRow(index, rowData) {
        rowData = rowData || {};
        var selectedOption = '';
        if (rowData.variation_id && rowData.product_text) {
            selectedOption = '<option value="' + rowData.variation_id + '" selected="selected">' + escapeHtml(rowData.product_text) + '</option>';
        }

        var html = '<tr class="order-material-row" data-index="' + index + '">';
        html += '<td>';
        html += '<input type="hidden" name="materials[' + index + '][id]" value="' + (rowData.id || '') + '">';
        html += '<input type="hidden" class="material_product_id" name="materials[' + index + '][product_id]" value="' + (rowData.product_id || '') + '">';
        html += '<input type="text" name="materials[' + index + '][material_label]" class="form-control" list="tailorpro_material_label_list" placeholder="' + escapeHtml(materialLabelPlaceholder) + '" value="' + escapeHtml(rowData.material_label || '') + '">';
        html += '</td>';
        html += '<td><select name="materials[' + index + '][variation_id]" class="form-control material_variation_select" style="width:100%;">' + selectedOption + '</select></td>';
        html += '<td><span class="material_available_qty">' + (rowData.qty_available != null ? rowData.qty_available : '-') + '</span></td>';
        html += '<td><input type="number" name="materials[' + index + '][quantity]" class="form-control material_qty" step="0.01" min="0" value="' + (rowData.quantity || '') + '"></td>';
        html += '<td><span class="material_unit">' + escapeHtml(rowData.unit || '-') + '</span></td>';
        html += '<td><input type="number" name="materials[' + index + '][unit_cost]" class="form-control material_unit_cost" step="0.01" min="0" value="' + (rowData.unit_cost || 0) + '"></td>';
        html += '<td><input type="number" class="form-control material_line_total" step="0.01" min="0" readonly value="' + (rowData.total_cost || 0) + '"></td>';
        html += '<td><input type="text" name="materials[' + index + '][notes]" class="form-control" placeholder="' + escapeHtml(materialNotesPlaceholder) + '" value="' + escapeHtml(rowData.notes || '') + '"></td>';
        html += '<td class="text-center"><button type="button" class="btn btn-xs btn-danger remove_material_btn"><i class="fas fa-trash"></i></button></td>';
        html += '</tr>';

        return html;
    }

    function initMaterialProductSelect($select) {
        $select.select2({
            ajax: {
                url: materialSearchUrl,
                dataType: 'json',
                delay: 250,
                data: function(params) {
                    return {
                        term: params.term,
                        location_id: $('#location_id').val()
                    };
                },
                processResults: function(data) {
                    return { results: data };
                },
                cache: true
            },
            minimumInputLength: 1,
            placeholder: materialSearchPlaceholder
        });
    }

    function updateMaterialRow($row) {
        var qty = parseFloat($row.find('.material_qty').val() || 0);
        var unitCost = parseFloat($row.find('.material_unit_cost').val() || 0);
        var lineTotal = qty * unitCost;

        $row.find('.material_line_total').val(lineTotal.toFixed(2));
    }

    function syncLegacyFabricFields() {
        var $firstRow = $('#order_materials_body .order-material-row').first();
        if ($firstRow.length) {
            $('#legacy_fabric_product_id').val($firstRow.find('.material_product_id').val() || '');
            $('#legacy_fabric_qty').val($firstRow.find('.material_qty').val() || '');
        } else {
            $('#legacy_fabric_product_id').val('');
            $('#legacy_fabric_qty').val('');
        }
    }

    function updateMaterialSummary() {
        var total = 0;
        $('#order_materials_body .order-material-row').each(function () {
            updateMaterialRow($(this));
            total += parseFloat($(this).find('.material_line_total').val() || 0);
        });

        $('#order_material_total_cost').val(total.toFixed(2));
        $('#no_order_materials_msg').toggle($('#order_materials_body .order-material-row').length === 0);
        syncLegacyFabricFields();
    }

    $('#add_order_material_btn').on('click', function () {
        $('#order_materials_body').append(buildMaterialRow(materialIndex));
        initMaterialProductSelect($('#order_materials_body .order-material-row').last().find('.material_variation_select'));
        materialIndex++;
        updateMaterialSummary();
    });

    $(document).on('change', '.material_variation_select', function () {
        var data = $(this).select2('data')[0] || null;
        var $row = $(this).closest('.order-material-row');

        if (data) {
            $row.find('.material_product_id').val(data.product_id || '');
            $row.find('.material_available_qty').text(data.qty_available != null ? data.qty_available : '-');
            $row.find('.material_unit').text(data.unit || '-');
            if (!$row.find('.material_unit_cost').val() || parseFloat($row.find('.material_unit_cost').val()) === 0) {
                $row.find('.material_unit_cost').val((data.unit_cost || 0).toFixed(2));
            }
        } else {
            $row.find('.material_product_id').val('');
            $row.find('.material_available_qty').text('-');
            $row.find('.material_unit').text('-');
        }

        updateMaterialSummary();
    });

    $(document).on('input', '.material_qty, .material_unit_cost', function () {
        updateMaterialSummary();
    });

    $(document).on('click', '.remove_material_btn', function () {
        $(this).closest('.order-material-row').remove();
        updateMaterialSummary();
    });

    if (initialMaterials.length) {
        $.each(initialMaterials, function (_, rowData) {
            $('#order_materials_body').append(buildMaterialRow(materialIndex, rowData));
            initMaterialProductSelect($('#order_materials_body .order-material-row').last().find('.material_variation_select'));
            materialIndex++;
        });
    } else {
        $('#add_order_material_btn').trigger('click');
    }

    updateMaterialSummary();

    // Dynamic order items
    function buildItemRow(index) {
        var tailorOptions = '<option value="">-- Select --</option>';
        $.each(tailors, function(id, name) {
            tailorOptions += '<option value="' + id + '">' + name + '</option>';
        });

        var html = '<div class="order-item-row" style="border:1px solid #ddd;border-radius:8px;padding:15px;margin-bottom:10px;background:#fafafa;">';
        html += '<div class="row">';
        html += '<div class="col-md-3"><div class="form-group"><label><?php echo app('translator')->get("tailorpro::lang.garment_type"); ?></label>';
        html += '<input type="text" name="order_items[' + index + '][garment_type]" class="form-control"></div></div>';
        html += '<div class="col-md-3"><div class="form-group"><label><?php echo app('translator')->get("tailorpro::lang.tailor"); ?></label>';
        html += '<select name="order_items[' + index + '][tailor_id]" class="form-control">' + tailorOptions + '</select></div></div>';
        html += '<div class="col-md-2"><div class="form-group"><label><?php echo app('translator')->get("tailorpro::lang.stitching_cost"); ?></label>';
        html += '<input type="number" name="order_items[' + index + '][stitching_cost]" class="form-control" step="0.01" min="0" value="0"></div></div>';
        html += '<div class="col-md-2"><div class="form-group"><label><?php echo app('translator')->get("tailorpro::lang.addon_cost"); ?></label>';
        html += '<input type="number" name="order_items[' + index + '][addon_cost]" class="form-control" step="0.01" min="0" value="0"></div></div>';
        html += '<div class="col-md-2 text-right" style="padding-top:25px;">';
        html += '<button type="button" class="btn btn-sm btn-danger remove_item_btn"><i class="fas fa-trash"></i></button>';
        html += '</div></div></div>';
        return html;
    }

    $('#add_order_item_btn').on('click', function () {
        $('#order_items_container').append(buildItemRow(itemIndex));
        itemIndex++;
        $('#no_items_msg').hide();
    });

    $(document).on('click', '.remove_item_btn', function () {
        $(this).closest('.order-item-row').remove();
        if ($('.order-item-row').length === 0) {
            $('#no_items_msg').show();
        }
    });

    // Delete design image
    $(document).on('click', '.delete_image_btn', function () {
        var mediaId = $(this).data('id');
        var $container = $(this).closest('[id^="media_"]');
        $.ajax({
            url: tailorProUrl('orders/delete-image'),
            method: 'POST',
            data: { media_id: mediaId, _token: '<?php echo e(csrf_token(), false); ?>' },
            dataType: 'json',
            success: function (r) {
                if (r.success) {
                    $container.fadeOut(300, function () { $(this).remove(); });
                }
            }
        });
    });
});
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>