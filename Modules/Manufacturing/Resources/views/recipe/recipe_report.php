
<?php $__env->startSection('title', __( 'manufacturing::lang.recipe_report' )); ?>

<?php $__env->startSection('content'); ?>
<?php echo $__env->make('manufacturing::layouts.nav', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<!-- Content Header (Page header) -->
<section class="content-header">
    <h1><?php echo app('translator')->get( 'manufacturing::lang.recipe_report' ); ?>
    </h1>
</section>

<!-- Main content -->
<section class="content">
    <div class="print_section"><h2><?php echo e(session()->get('business.name'), false); ?> - <?php echo app('translator')->get( 'manufacturing::lang.recipe_report' ); ?></h2></div>

    <?php $__env->startComponent('components.filters', ['title' => __('report.filters')]); ?>
        <?php echo Form::open(['url' => action([\Modules\Manufacturing\Http\Controllers\RecipeController::class, 'getRecipeReport']), 'method' => 'get', 'class' => 'row', 'id' => 'recipe_report_filter_form']); ?>

            <?php if(session('business.enable_category')): ?>
            <div class="col-md-3">
                <div class="form-group mb-2">
                    <?php echo Form::label('rr_category_id', __('product.category') . ':'); ?>

                    <?php echo Form::select('category_id', $categories, request('category_id'), ['placeholder' => __('messages.all'), 'class' => 'form-control select2', 'style' => 'width:100%', 'id' => 'rr_category_id']); ?>

                </div>
            </div>
            <?php endif; ?>
            <?php if(session('business.enable_category') && session('business.enable_sub_category')): ?>
            <div class="col-md-3">
                <div class="form-group mb-2">
                    <?php echo Form::label('rr_sub_category_id', __('product.sub_category') . ':'); ?>

                    <?php echo Form::select('sub_category_id', [], request('sub_category_id'), ['placeholder' => __('messages.all'), 'class' => 'form-control select2', 'style' => 'width:100%', 'id' => 'rr_sub_category_id']); ?>

                </div>
            </div>
            <?php endif; ?>
            <?php if(session('business.enable_category') && session('business.enable_sub_category') && session('business.enable_sub2_category')): ?>
            <div class="col-md-3">
                <div class="form-group mb-2">
                    <?php echo Form::label('rr_sub2_category_id', __('lang_v1.sub2_category') . ':'); ?>

                    <?php echo Form::select('sub2_category_id', [], request('sub2_category_id'), ['placeholder' => __('messages.all'), 'class' => 'form-control select2', 'style' => 'width:100%', 'id' => 'rr_sub2_category_id']); ?>

                </div>
            </div>
            <?php endif; ?>
            <div class="col-md-3">
                <div class="form-group mb-2">
                    <?php echo Form::label('rr_search_product_lbl', __('lang_v1.search_product') . ':'); ?>

                    <div class="input-group">
                        <span class="input-group-addon"><i class="fa fa-search"></i></span>
                        <input type="hidden" name="variation_id" id="rr_variation_id" value="<?php echo e(request('variation_id'), false); ?>">
                        <input type="text" name="rr_search_product" id="rr_search_product" class="form-control"
                            placeholder="<?php echo e(__('lang_v1.search_product_placeholder'), false); ?>"
                            value="<?php echo e(request('rr_search_product'), false); ?>">
                    </div>
                </div>
            </div>
            <div class="col-md-12 mt-2">
                <button type="submit" class="btn btn-primary btn-sm">
                    <i class="fa fa-filter"></i> <?php echo app('translator')->get('report.filters'); ?>
                </button>
                <a href="<?php echo e(action([\Modules\Manufacturing\Http\Controllers\RecipeController::class, 'getRecipeReport']), false); ?>" class="btn btn-default btn-sm">
                    <i class="fa fa-undo"></i> <?php echo app('translator')->get('lang_v1.reset'); ?>
                </a>
            </div>
        <?php echo Form::close(); ?>

    <?php echo $__env->renderComponent(); ?>

    <?php $__env->startComponent('components.widget', ['class' => 'box-primary']); ?>
        <div class="row no-print mb-2">
            <div class="col-md-12">
                <button type="button" class="btn btn-primary float-end open-recipe-report-print">
                    <i class="fa fa-print"></i> <?php echo app('translator')->get('messages.print'); ?> A4
                </button>
            </div>
        </div>
        <style>
            .recipe-product-row {
                background-color: #d9e8fb !important;
                font-weight: 600;
                border-left: 4px solid #3c8dbc;
            }
            .recipe-ingredient-row {
                background-color: #fdf6e3 !important;
                border-left: 4px solid #f0ad4e;
            }
            .recipe-ingredient-row td:first-child {
                padding-left: 25px;
            }
            #recipe_report_table tbody tr.recipe-product-row:hover {
                background-color: #c5ddf5 !important;
            }
            #recipe_report_table tbody tr.recipe-ingredient-row:hover {
                background-color: #fcedc4 !important;
            }
            .ingredient-badge {
                font-size: 10px;
                padding: 2px 6px;
                border-radius: 3px;
                background-color: #f0ad4e;
                color: #fff;
                margin-right: 5px;
                font-weight: normal;
            }
            .product-badge {
                font-size: 10px;
                padding: 2px 6px;
                border-radius: 3px;
                background-color: #3c8dbc;
                color: #fff;
                margin-right: 5px;
                font-weight: normal;
            }

            /* ── Dark Mode ── */
            html.dark-theme .recipe-product-row {
                background-color: #1e3a5f !important;
                color: #e4e5e6 !important;
                border-left-color: #5ba3d9;
            }
            html.dark-theme .recipe-ingredient-row {
                background-color: #3a2e1a !important;
                color: #e4e5e6 !important;
                border-left-color: #d4993d;
            }
            html.dark-theme #recipe_report_table tbody tr.recipe-product-row:hover {
                background-color: #264b73 !important;
            }
            html.dark-theme #recipe_report_table tbody tr.recipe-ingredient-row:hover {
                background-color: #4a3b22 !important;
            }
            html.dark-theme #recipe_report_table thead th {
                background-color: #1a2232 !important;
                color: #e4e5e6 !important;
                border-color: rgba(255,255,255,0.12) !important;
            }
            html.dark-theme #recipe_report_table {
                border-color: rgba(255,255,255,0.12) !important;
            }
            html.dark-theme #recipe_report_table td {
                border-color: rgba(255,255,255,0.12) !important;
                color: #e4e5e6 !important;
            }
            html.dark-theme #recipe_report_table_wrapper .dt-buttons .btn {
                background-color: #202a40 !important;
                color: #e4e5e6 !important;
                border-color: rgba(255,255,255,0.15) !important;
            }
            html.dark-theme #recipe_report_table_wrapper .dt-buttons .btn:hover {
                background-color: #2a3650 !important;
            }
            html.dark-theme #recipe_report_table_wrapper .dataTables_filter input,
            html.dark-theme #recipe_report_table_wrapper .dataTables_length select {
                background-color: #1a2232 !important;
                color: #e4e5e6 !important;
                border-color: rgba(255,255,255,0.15) !important;
            }
            html.dark-theme #recipe_report_table_wrapper .dataTables_info,
            html.dark-theme #recipe_report_table_wrapper .dataTables_paginate .paginate_button {
                color: #b8bfc9 !important;
            }
            html.dark-theme #recipe_report_table_wrapper .dataTables_paginate .paginate_button.current {
                background: #2a3650 !important;
                color: #e4e5e6 !important;
                border-color: rgba(255,255,255,0.15) !important;
            }
        </style>
        <div class="table-responsive">
            <table class="table table-bordered table-th-skin" id="recipe_report_table">
                <thead>
                    <tr>
                        <th><?php echo app('translator')->get( 'manufacturing::lang.recipe' ); ?></th>
                        <th><?php echo app('translator')->get( 'product.category' ); ?></th>
                        <th><?php echo app('translator')->get( 'product.sub_category' ); ?></th>
                        <th><?php echo app('translator')->get( 'lang_v1.quantity' ); ?></th>
                        <th>Wastage %</th>
                        <th><?php echo app('translator')->get( 'lang_v1.price' ); ?> <?php echo e('('.session("currency")["symbol"].')', false); ?> <?php
                if(session('business.enable_tooltip')){
                    echo '<i class="fa fa-info-circle text-info hover-q no-print"
                    aria-hidden="true"
                    data-bs-toggle="tooltip"
                    data-bs-placement="bottom"
                    data-bs-html="true"
                    title="' . __('manufacturing::lang.price_updated_live') . '"></i>';
                }
            ?></th>
                        <th><?php echo app('translator')->get( 'sale.unit_price' ); ?> <?php echo e('('.session("currency")["symbol"].')', false); ?></th>
                    </tr>
                </thead>
                <tbody>
                    <?php $__currentLoopData = $recipes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $recipe): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr class="recipe-product-row">
                            <td><span class="product-badge">Product</span> <?php echo e($recipe->recipe_name, false); ?></td>
                            <td><?php echo e($recipe->category, false); ?></td>
                            <td><?php echo e($recipe->sub_category, false); ?></td>
                            <td><?php echo e(number_format($recipe->total_quantity, session('business.quantity_precision', 2), session('currency')['decimal_separator'], session('currency')['thousand_separator']), false); ?> <?php echo e((! empty($recipe->sub_unit_id)) ? $recipe->sub_unit->short_name : $recipe->unit_name, false); ?> </td>
                            <td></td>
                            <td><?php 
            $formated_number = "";
            /* if (session("business.currency_symbol_placement") == "before") {
                 $formated_number .= session("currency")["symbol"] . " ";
            }*/ 
            $formated_number .= number_format((float) $recipe->unit_cost, session("business.currency_precision", 2) , session("currency")["decimal_separator"], session("currency")["thousand_separator"]);

            /* if (session("business.currency_symbol_placement") == "after") {
                 $formated_number .= " " . session("currency")["symbol"];
            } */
            echo $formated_number; ?></td>
                            <td><?php 
            $formated_number = "";
            /* if (session("business.currency_symbol_placement") == "before") {
                 $formated_number .= session("currency")["symbol"] . " ";
            }*/ 
            $formated_number .= number_format((float) $recipe->recipe_total, session("business.currency_precision", 2) , session("currency")["decimal_separator"], session("currency")["thousand_separator"]);

            /* if (session("business.currency_symbol_placement") == "after") {
                 $formated_number .= " " . session("currency")["symbol"];
            } */
            echo $formated_number; ?></td>
                        </tr>
                        <?php $__currentLoopData = $recipe->ingredients; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $ing): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr class="recipe-ingredient-row">
                            <td><span class="ingredient-badge">Ingredient</span> <?php echo e($ing->variation->product->name, false); ?> (<?php echo e($ing->variation->sub_sku, false); ?>)</td>
                            <td></td>
                            <td></td>
                            <td><?php echo e(number_format($ing->quantity, session('business.quantity_precision', 2), session('currency')['decimal_separator'], session('currency')['thousand_separator']), false); ?> <?php echo e((! empty($ing->sub_unit_id)) ? $ing->sub_unit->short_name : $ing->variation->product->unit->short_name, false); ?></td>
                            <td><?php echo e(number_format($ing->waste_percent, session('business.quantity_precision', 2), session('currency')['decimal_separator'], session('currency')['thousand_separator']), false); ?>%</td>
                            <td><?php 
            $formated_number = "";
            /* if (session("business.currency_symbol_placement") == "before") {
                 $formated_number .= session("currency")["symbol"] . " ";
            }*/ 
            $formated_number .= number_format((float) $ing->ingredient_price, session("business.currency_precision", 2) , session("currency")["decimal_separator"], session("currency")["thousand_separator"]);

            /* if (session("business.currency_symbol_placement") == "after") {
                 $formated_number .= " " . session("currency")["symbol"];
            } */
            echo $formated_number; ?></td>
                            <td></td>
                        </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </tbody>
            </table>
        </div>
    <?php echo $__env->renderComponent(); ?>

</section>
<!-- /.content -->
<?php $__env->stopSection(); ?>
<?php $__env->startSection('javascript'); ?>
<script type="text/javascript">
    $(document).ready( function() {
        // --- Category cascade helpers ---
        <?php if(session('business.enable_category') && session('business.enable_sub_category')): ?>
        function rrLoadSubCats(cat_id, targetEl, selectedVal, onSuccess) {
            $(targetEl).html('<option value=""><?php echo e(__("messages.all"), false); ?></option>').trigger('change.select2');
            if (!cat_id) return;
            $.ajax({
                method: 'POST',
                url: '/products/get_sub_categories',
                dataType: 'html',
                data: { cat_id: cat_id },
                success: function(result) {
                    if (result) {
                        $(targetEl).html(result);
                        if (selectedVal) {
                            $(targetEl).val(selectedVal).trigger('change.select2');
                        }
                    }
                    if (typeof onSuccess === 'function') { onSuccess(); }
                },
            });
        }

        // Pre-load on page reload
        var rrPreCat     = '<?php echo e(request("category_id"), false); ?>';
        var rrPreSubCat  = '<?php echo e(request("sub_category_id"), false); ?>';
        var rrPreSub2Cat = '<?php echo e(request("sub2_category_id"), false); ?>';
        if (rrPreCat) {
            rrLoadSubCats(rrPreCat, '#rr_sub_category_id', rrPreSubCat, function() {
                <?php if(session('business.enable_sub2_category')): ?>
                if (rrPreSubCat) {
                    rrLoadSubCats(rrPreSubCat, '#rr_sub2_category_id', rrPreSub2Cat);
                }
                <?php endif; ?>
            });
        }

        $('#rr_category_id').change(function() {
            var cat = $(this).val();
            <?php if(session('business.enable_sub2_category')): ?>
            $('#rr_sub2_category_id').html('<option value=""><?php echo e(__("messages.all"), false); ?></option>').trigger('change.select2');
            <?php endif; ?>
            rrLoadSubCats(cat, '#rr_sub_category_id', null);
        });

        <?php if(session('business.enable_sub2_category')): ?>
        $('#rr_sub_category_id').change(function() {
            rrLoadSubCats($(this).val(), '#rr_sub2_category_id', null);
        });
        <?php endif; ?>
        <?php endif; ?>

        // --- Product search autocomplete ---
        if ($('#rr_search_product').length > 0) {
            $('#rr_search_product').autocomplete({
                source: function(request, response) {
                    $.ajax({
                        url: '/purchases/get_products?check_enable_stock=false',
                        dataType: 'json',
                        data: { term: request.term },
                        success: function(data) {
                            response($.map(data, function(v, i) {
                                if (!v.variation_id) return false;
                                // Strip HTML tags (e.g. <br>Price: ...) from label
                                var label = $('<div>').html(v.text).text().replace(/\s+/g, ' ').trim();
                                return { label: label, value: v.variation_id };
                            }));
                        },
                    });
                },
                minLength: 2,
                select: function(event, ui) {
                    $('#rr_variation_id').val(ui.item.value);
                    event.preventDefault();
                    $(this).val(ui.item.label);
                }
            });
            $('#rr_search_product').on('input', function() {
                if ($(this).val() === '') { $('#rr_variation_id').val(''); }
            });
        }
        $('#recipe_report_table').DataTable({
            dom: '<"row margin-bottom-20"<"col-xs-12 col-2 mb-2"l><"col-xs-12 col-8 mb-2 dt-buttons-wrapper"B><"col-xs-12 col-2 mb-2"f>>rtip',
            buttons: [
                {
                    extend: 'excelHtml5',
                    text: '<i class="fa fa-file-excel"></i> Export to Excel',
                    title: 'Recipe Report',
                    className: 'btn-sm mr-5',
                },
                {
                    extend: 'pdfHtml5',
                    text: '<i class="fa fa-print"></i> Export to PDF',
                    title: 'Recipe Report',
                    className: 'btn-sm',
                }
            ],
            paging: true,
            pageLength: 25,
            lengthMenu: [[10, 25, 50, 100, -1], [10, 25, 50, 100, '<?php echo e(__("messages.all"), false); ?>']],
            lengthChange: true,
            searching: true,
            ordering: false,
            language: {
                paginate: {
                    previous: '<i class="fa fa-chevron-left"></i>',
                    next: '<i class="fa fa-chevron-right"></i>'
                }
            }
        });

        function getRecipeReportPrintParams() {
            var params = {
                tab: 'details',
                category_id: $('#rr_category_id').val(),
                sub_category_id: $('#rr_sub_category_id').val(),
                sub2_category_id: $('#rr_sub2_category_id').val(),
                variation_id: $('#rr_variation_id').val()
            };

            $.each(params, function(key, value) {
                if (value === '' || value === null || typeof value === 'undefined') {
                    delete params[key];
                }
            });

            return params;
        }

        $(document).on('click', '.open-recipe-report-print', function(e) {
            e.preventDefault();
            window.open('<?php echo e(url('manufacturing/recipe-report-print'), false); ?>?' + $.param(getRecipeReportPrintParams()), '_blank');
        });
    });
</script>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>