
<?php $__env->startSection('title', __('manufacturing::lang.demand_ingredient_report')); ?>

<?php $__env->startSection('css'); ?>
<style>
    #report_content table.dataTable,
    #report_content table.table {
        font-size: 14px;
    }

    #report_content table.dataTable th,
    #report_content table.dataTable td,
    #report_content table.table th,
    #report_content table.table td {
        font-size: 14px;
        line-height: 1.35;
    }

    .dir-production-status {
        cursor: pointer;
    }
</style>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
<?php echo $__env->make('manufacturing::layouts.nav', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<section class="content-header">
    <h1><i class="fas fa-chart-bar"></i> <?php echo app('translator')->get('manufacturing::lang.demand_ingredient_report'); ?></h1>
</section>

<section class="content">
    
    <?php $__env->startComponent('components.filters', ['title' => __('report.filters'), 'open' => true]); ?>
        <div class="col-md-3">
            <div class="form-group">
                <?php echo Form::label('dir_location_id', __('purchase.business_location') . ':'); ?>

                <?php echo Form::select('dir_location_id', $business_locations, null, ['class' => 'form-control select2', 'style' => 'width:100%', 'placeholder' => __('lang_v1.all')]); ?>

            </div>
        </div>
        <div class="col-md-3">
            <div class="form-group">
                <?php echo Form::label('dir_date_range', __('report.date_range') . ':'); ?>

                <?php echo Form::text('dir_date_range', null, ['placeholder' => __('lang_v1.select_a_date_range'), 'class' => 'form-control', 'readonly']); ?>

            </div>
        </div>
        <div class="col-md-3">
            <div class="form-group">
                <?php echo Form::label('dir_demand_order_ids', __('manufacturing::lang.demand_orders') . ':'); ?>

                <?php echo Form::select('dir_demand_order_ids[]', $demand_orders, null, ['class' => 'form-control select2', 'style' => 'width:100%', 'multiple', 'id' => 'dir_demand_order_ids']); ?>

            </div>
        </div>
        <div class="col-md-3">
            <div class="form-group">
                <?php echo Form::label('dir_category_id', __('product.category') . ':'); ?>

                <?php echo Form::select('dir_category_id', $categories, null, ['class' => 'form-control select2', 'style' => 'width:100%', 'placeholder' => __('lang_v1.all')]); ?>

            </div>
        </div>
        <div class="col-md-3">
            <div class="form-group">
                <?php echo Form::label('dir_sub_category_id', __('product.sub_category') . ':'); ?>

                <?php echo Form::select('dir_sub_category_id', [], null, ['class' => 'form-control select2', 'style' => 'width:100%', 'placeholder' => __('lang_v1.all')]); ?>

            </div>
        </div>
        <div class="col-md-3">
            <div class="form-group">
                <?php echo Form::label('dir_sub2_category_id', __('product.sub2_category') . ':'); ?>

                <?php echo Form::select('dir_sub2_category_id', [], null, ['class' => 'form-control select2', 'style' => 'width:100%', 'placeholder' => __('lang_v1.all')]); ?>

            </div>
        </div>
        <div class="col-md-3">
            <div class="form-group">
                <?php echo Form::label('dir_status_filter', __('manufacturing::lang.demand_order_status') . ':'); ?>

                <?php echo Form::select('dir_status_filter[]', \Modules\Manufacturing\Entities\MfgDemandOrder::statuses(), null, ['class' => 'form-control select2', 'style' => 'width:100%', 'multiple', 'id' => 'dir_status_filter']); ?>

            </div>
        </div>
        <div class="col-md-3">
            <div class="form-group">
                <br>
                <button type="button" class="btn btn-primary" id="generate_report">
                    <i class="fas fa-search"></i> <?php echo app('translator')->get('manufacturing::lang.generate_report'); ?>
                </button>
            </div>
        </div>
        <div class="col-md-12 mt-2">
            <button type="button" class="btn btn-primary btn-sm" id="dir_filter_save">
                <i class="fa fa-save"></i> <?php echo app('translator')->get('messages.save'); ?>
            </button>
            <button type="button" class="btn btn-warning btn-sm" id="dir_filter_reset">
                <i class="fa fa-undo"></i> <?php echo app('translator')->get('lang_v1.reset'); ?>
            </button>
        </div>
    <?php echo $__env->renderComponent(); ?>

    
    <div id="report_loading" class="text-center" style="display: none;">
        <i class="fa fa-refresh fa-spin fa-3x fa-fw"></i>
        <p><?php echo app('translator')->get('manufacturing::lang.generating_report'); ?>...</p>
    </div>

    
    <div id="report_content" style="display: none;">
        <div class="row mb-3 no-print">
            <div class="col-md-12 text-end">
                <button type="button" class="btn btn-primary" id="print_active_tab">
                    <i class="fa fa-print"></i> Print A4 Current Tab
                </button>
                <button type="button" class="btn btn-default" id="print_all_tabs">
                    <i class="fa fa-print"></i> Print A4 All Tabs
                </button>
            </div>
        </div>

        
        <div class="row mb-3">
            <div class="col-lg-4 col-md-6">
                <div class="card shadow-sm border-0 mb-3">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <div class="rounded-circle bg-primary bg-opacity-10 p-3 me-3">
                                <i class="fas fa-boxes fa-2x text-primary"></i>
                            </div>
                            <div>
                                <h6 class="text-muted mb-1"><?php echo app('translator')->get('manufacturing::lang.total_ingredients_needed'); ?></h6>
                                <h3 class="mb-0" id="kpi_total_ingredients">0</h3>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-6">
                <div class="card shadow-sm border-0 mb-3">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <div class="rounded-circle bg-success bg-opacity-10 p-3 me-3">
                                <i class="fas fa-money-bill-wave fa-2x text-success"></i>
                            </div>
                            <div>
                                <h6 class="text-muted mb-1"><?php echo app('translator')->get('manufacturing::lang.total_ingredient_cost'); ?></h6>
                                <h3 class="mb-0" id="kpi_total_cost">0</h3>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-6">
                <div class="card shadow-sm border-0 mb-3">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <div class="rounded-circle bg-info bg-opacity-10 p-3 me-3">
                                <i class="fas fa-layer-group fa-2x text-info"></i>
                            </div>
                            <div>
                                <h6 class="text-muted mb-1"><?php echo app('translator')->get('manufacturing::lang.categories_involved'); ?></h6>
                                <h3 class="mb-0" id="kpi_total_categories">0</h3>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        
        <ul class="nav nav-tabs" id="reportTabs" role="tablist">
            <li class="nav-item" role="presentation">
                <button class="nav-link active" id="product-tab" data-bs-toggle="tab" data-bs-target="#product_wise" type="button" role="tab">
                    <i class="fas fa-cube"></i> <?php echo app('translator')->get('manufacturing::lang.product_wise_summary'); ?>
                </button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="category-tab" data-bs-toggle="tab" data-bs-target="#category_wise" type="button" role="tab">
                    <i class="fas fa-tags"></i> <?php echo app('translator')->get('manufacturing::lang.category_wise_summary'); ?>
                </button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="ingredient-summary-tab" data-bs-toggle="tab" data-bs-target="#all_ingredients_summary" type="button" role="tab">
                    <i class="fas fa-boxes"></i> <?php echo app('translator')->get('manufacturing::lang.all_ingredients_summary'); ?>
                </button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="ingredient-tab" data-bs-toggle="tab" data-bs-target="#all_ingredients" type="button" role="tab">
                    <i class="fas fa-list"></i> <?php echo app('translator')->get('manufacturing::lang.all_ingredients_detail'); ?>
                </button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="batch-ingredient-summary-tab" data-bs-toggle="tab" data-bs-target="#batch_ingredients_summary" type="button" role="tab">
                    <i class="fas fa-boxes"></i> <?php echo app('translator')->get('manufacturing::lang.batch_ingredients_summary'); ?>
                </button>
            </li>
        </ul>

        <div class="tab-content" id="reportTabContent">
            
            <div class="tab-pane fade show active" id="product_wise" role="tabpanel">
                <?php $__env->startComponent('components.widget', ['class' => 'box-primary']); ?>
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped table-sm" id="product_summary_table">
                            <thead class="table-light">
                                <tr>
                                    <th>#</th>
                                    <th><?php echo app('translator')->get('manufacturing::lang.finished_product'); ?></th>
                                    <th><?php echo app('translator')->get('product.sku'); ?></th>
                                    <th><?php echo app('translator')->get('product.category'); ?></th>
                                    <th><?php echo app('translator')->get('product.sub_category'); ?></th>
                                    <th><?php echo app('translator')->get('product.sub2_category'); ?></th>
                                    <th><?php echo app('translator')->get('sale.status'); ?></th>
                                    <th class="text-end"><?php echo app('translator')->get('manufacturing::lang.demand_qty'); ?></th>
                                    <th><?php echo app('translator')->get('lang_v1.unit'); ?></th>
                                    <th class="text-end"><?php echo app('translator')->get('manufacturing::lang.total_ingredient_cost'); ?></th>
                                    <th class="text-end"><?php echo app('translator')->get('manufacturing::lang.total_selling_price'); ?> <?php echo e('('.session("currency")["symbol"].')', false); ?></th>
                                    <th style="width: 30px;"></th>
                                </tr>
                            </thead>
                            <tbody id="product_summary_body">
                            </tbody>
                            <tfoot>
                                <tr class="table-light fw-bold">
                                    <td colspan="7" class="text-end"><?php echo app('translator')->get('manufacturing::lang.grand_total'); ?>:</td>
                                    <td class="text-end" id="product_total_demand_qty">0</td>
                                    <td></td>
                                    <td class="text-end" id="product_grand_total">0</td>
                                    <td class="text-end" id="product_grand_selling_price">0</td>
                                    <td></td>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                <?php echo $__env->renderComponent(); ?>
            </div>

            
            <div class="tab-pane fade" id="category_wise" role="tabpanel">
                <?php $__env->startComponent('components.widget', ['class' => 'box-success']); ?>
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped table-sm" id="category_summary_table">
                            <thead class="table-light">
                                <tr>
                                    <th>#</th>
                                    <th><?php echo app('translator')->get('product.category'); ?></th>
                                    <th><?php echo app('translator')->get('product.sub_category'); ?></th>
                                    <th><?php echo app('translator')->get('product.sub2_category'); ?></th>
                                    <th class="text-end"><?php echo app('translator')->get('manufacturing::lang.total_ingredients'); ?></th>
                                    <th class="text-end"><?php echo app('translator')->get('manufacturing::lang.total_ingredient_cost'); ?></th>
                                    <th class="text-end"><?php echo app('translator')->get('manufacturing::lang.total_selling_price'); ?> <?php echo e('('.session("currency")["symbol"].')', false); ?></th>
                                    <th class="text-end"><?php echo app('translator')->get('manufacturing::lang.cost_percentage'); ?></th>
                                    <th style="width: 30px;"></th>
                                </tr>
                            </thead>
                            <tbody id="category_summary_body">
                            </tbody>
                            <tfoot>
                                <tr class="table-light fw-bold">
                                    <td colspan="4" class="text-end"><?php echo app('translator')->get('manufacturing::lang.grand_total'); ?>:</td>
                                    <td class="text-end" id="category_total_items">0</td>
                                    <td class="text-end" id="category_grand_total">0</td>
                                    <td class="text-end" id="category_grand_selling_price">0</td>
                                    <td class="text-end">100%</td>
                                    <td></td>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                <?php echo $__env->renderComponent(); ?>
            </div>

            
            <div class="tab-pane fade" id="all_ingredients_summary" role="tabpanel">
                <?php $__env->startComponent('components.widget', ['class' => 'box-warning']); ?>
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped table-sm" id="ingredient_summary_table">
                            <thead class="table-light">
                                <tr>
                                    <th>#</th>
                                    <th><?php echo app('translator')->get('manufacturing::lang.ingredient_name'); ?></th>
                                    <th><?php echo app('translator')->get('product.sku'); ?></th>
                                    <th><?php echo app('translator')->get('product.category'); ?></th>
                                    <th><?php echo app('translator')->get('product.sub_category'); ?></th>
                                    <th><?php echo app('translator')->get('product.sub2_category'); ?></th>
                                    <th class="text-end"><?php echo app('translator')->get('manufacturing::lang.total_qty'); ?></th>
                                    <th><?php echo app('translator')->get('lang_v1.unit'); ?></th>
                                    <th class="text-end"><?php echo app('translator')->get('manufacturing::lang.unit_cost'); ?></th>
                                    <th class="text-end"><?php echo app('translator')->get('manufacturing::lang.total_cost'); ?></th>
                                    <th class="text-end"><?php echo app('translator')->get('manufacturing::lang.total_selling_price'); ?> <?php echo e('('.session("currency")["symbol"].')', false); ?></th>
                                </tr>
                            </thead>
                            <tbody id="ingredient_summary_body">
                            </tbody>
                            <tfoot>
                                <tr class="table-light fw-bold">
                                    <td colspan="6" class="text-end"><?php echo app('translator')->get('manufacturing::lang.grand_total'); ?>:</td>
                                    <td class="text-end" id="ingredient_summary_total_qty">0</td>
                                    <td></td>
                                    <td></td>
                                    <td class="text-end" id="ingredient_summary_grand_total">0</td>
                                    <td class="text-end" id="ingredient_summary_grand_selling_price">0</td>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                <?php echo $__env->renderComponent(); ?>
            </div>

            
            <div class="tab-pane fade" id="all_ingredients" role="tabpanel">
                <?php $__env->startComponent('components.widget', ['class' => 'box-info']); ?>
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped table-sm" id="ingredient_detail_table">
                            <thead class="table-light">
                                <tr>
                                    <th>#</th>
                                    <th><?php echo app('translator')->get('manufacturing::lang.demand_order'); ?></th>
                                    <th><?php echo app('translator')->get('manufacturing::lang.ingredient_name'); ?></th>
                                    <th><?php echo app('translator')->get('product.sku'); ?></th>
                                    <th><?php echo app('translator')->get('product.category'); ?></th>
                                    <th><?php echo app('translator')->get('product.sub_category'); ?></th>
                                    <th><?php echo app('translator')->get('product.sub2_category'); ?></th>
                                    <th class="text-end"><?php echo app('translator')->get('manufacturing::lang.required_qty'); ?></th>
                                    <th class="text-end"><?php echo app('translator')->get('manufacturing::lang.waste_qty'); ?></th>
                                    <th class="text-end"><?php echo app('translator')->get('manufacturing::lang.net_qty'); ?></th>
                                    <th><?php echo app('translator')->get('lang_v1.unit'); ?></th>
                                    <th class="text-end"><?php echo app('translator')->get('manufacturing::lang.unit_cost'); ?></th>
                                    <th class="text-end"><?php echo app('translator')->get('manufacturing::lang.total_cost'); ?></th>
                                    <th class="text-end"><?php echo app('translator')->get('manufacturing::lang.total_selling_price'); ?> <?php echo e('('.session("currency")["symbol"].')', false); ?></th>
                                </tr>
                            </thead>
                            <tbody id="ingredient_detail_body">
                            </tbody>
                            <tfoot>
                                <tr class="table-light fw-bold">
                                    <td colspan="7" class="text-end"><?php echo app('translator')->get('manufacturing::lang.grand_total'); ?>:</td>
                                    <td class="text-end" id="ingredient_total_req_qty">0</td>
                                    <td class="text-end" id="ingredient_total_waste_qty">0</td>
                                    <td class="text-end" id="ingredient_total_net_qty">0</td>
                                    <td></td>
                                    <td></td>
                                    <td class="text-end" id="ingredient_grand_total">0</td>
                                    <td class="text-end" id="ingredient_grand_selling_price">0</td>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                <?php echo $__env->renderComponent(); ?>
            </div>

            
            <div class="tab-pane fade" id="batch_ingredients_summary" role="tabpanel">
                <?php $__env->startComponent('components.widget', ['class' => 'box-warning']); ?>
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped table-sm" id="batch_ingredient_summary_table">
                            <thead class="table-light">
                                <tr>
                                    <th>#</th>
                                    <th><?php echo app('translator')->get('manufacturing::lang.ingredient_name'); ?></th>
                                    <th><?php echo app('translator')->get('product.sku'); ?></th>
                                    <th><?php echo app('translator')->get('product.category'); ?></th>
                                    <th><?php echo app('translator')->get('product.sub_category'); ?></th>
                                    <th><?php echo app('translator')->get('product.sub2_category'); ?></th>
                                    <th class="text-end"><?php echo app('translator')->get('manufacturing::lang.total_qty'); ?></th>
                                    <th><?php echo app('translator')->get('lang_v1.unit'); ?></th>
                                    <th class="text-end"><?php echo app('translator')->get('manufacturing::lang.unit_cost'); ?></th>
                                    <th class="text-end"><?php echo app('translator')->get('manufacturing::lang.total_cost'); ?></th>
                                    <th class="text-end"><?php echo app('translator')->get('manufacturing::lang.total_selling_price'); ?> <?php echo e('('.session("currency")["symbol"].')', false); ?></th>
                                </tr>
                            </thead>
                            <tbody id="batch_ingredient_summary_body">
                            </tbody>
                            <tfoot>
                                <tr class="table-light fw-bold">
                                    <td colspan="6" class="text-end"><?php echo app('translator')->get('manufacturing::lang.grand_total'); ?>:</td>
                                    <td class="text-end" id="batch_ingredient_summary_total_qty">0</td>
                                    <td></td>
                                    <td></td>
                                    <td class="text-end" id="batch_ingredient_summary_grand_total">0</td>
                                    <td class="text-end" id="batch_ingredient_summary_grand_selling_price">0</td>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                <?php echo $__env->renderComponent(); ?>
            </div>
        </div>
    </div>

    
    <div id="no_data_msg" style="display: none;">
        <?php $__env->startComponent('components.widget', ['class' => 'box-warning']); ?>
            <div class="text-center py-5">
                <i class="fas fa-info-circle fa-3x text-muted mb-3"></i>
                <h4 class="text-muted"><?php echo app('translator')->get('manufacturing::lang.no_data_found'); ?></h4>
                <p class="text-muted"><?php echo app('translator')->get('manufacturing::lang.select_filters_and_generate'); ?></p>
            </div>
        <?php echo $__env->renderComponent(); ?>
    </div>

    <div class="modal fade" id="dir_product_status_modal" tabindex="-1" role="dialog" aria-labelledby="dirProductStatusModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="dirProductStatusModalLabel"><?php echo app('translator')->get('manufacturing::lang.change_status'); ?></h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <input type="hidden" id="dir_prod_status_row_index">
                    <input type="hidden" id="dir_prod_status_variation_id">
                    <div class="form-group">
                        <label for="dir_prod_status_new_status"><?php echo app('translator')->get('manufacturing::lang.production_status'); ?></label>
                        <select id="dir_prod_status_new_status" class="form-control">
                            <option value="planned"><?php echo app('translator')->get('manufacturing::lang.status_planned'); ?></option>
                            <option value="in_progress"><?php echo app('translator')->get('manufacturing::lang.status_in_progress'); ?></option>
                            <option value="quality_check"><?php echo app('translator')->get('manufacturing::lang.status_quality_check'); ?></option>
                            <option value="completed"><?php echo app('translator')->get('manufacturing::lang.status_completed'); ?></option>
                            <option value="on_hold"><?php echo app('translator')->get('manufacturing::lang.status_on_hold'); ?></option>
                            <option value="cancelled"><?php echo app('translator')->get('manufacturing::lang.status_cancelled'); ?></option>
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-bs-dismiss="modal"><?php echo app('translator')->get('messages.close'); ?></button>
                    <button type="button" class="btn btn-primary" id="dir_prod_status_save_btn"><?php echo app('translator')->get('manufacturing::lang.update_status'); ?></button>
                </div>
            </div>
        </div>
    </div>
</section>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('javascript'); ?>
<script>
$(document).ready(function() {
    // Bind click handler FIRST before anything that might throw
    $(document).on('click', '#generate_report', function(e) {
        e.preventDefault();
        var btn = $(this);
        btn.prop('disabled', true);
        $('#report_loading').show();
        $('#report_content').hide();
        $('#no_data_msg').hide();

        var data = {
            action: 'get_report',
            location_id: $('#dir_location_id').val(),
            category_id: $('#dir_category_id').val(),
            sub_category_id: $('#dir_sub_category_id').val(),
            sub2_category_id: $('#dir_sub2_category_id').val(),
        };

        // Get multi-select values
        var demandIds = $('#dir_demand_order_ids').val();
        if (demandIds && demandIds.length > 0) {
            data.demand_order_ids = demandIds;
        }

        var statusFilter = $('#dir_status_filter').val();
        if (statusFilter && statusFilter.length > 0) {
            data.status_filter = statusFilter;
        }

        // Get date range if daterangepicker is initialized
        try {
            var drp = $('#dir_date_range').data('daterangepicker');
            if (drp && $('#dir_date_range').val()) {
                data.start_date = drp.startDate.format('YYYY-MM-DD');
                data.end_date = drp.endDate.format('YYYY-MM-DD');
            }
        } catch(ex) {
            console.warn('daterangepicker read error:', ex);
        }

        $.ajax({
            url: '<?php echo e(url("/manufacturing/demand-ingredient-report"), false); ?>',
            type: 'GET',
            data: data,
            dataType: 'json',
            success: function(result) {
                btn.prop('disabled', false);
                $('#report_loading').hide();

                if (!result || !result.ingredient_details || result.ingredient_details.length === 0) {
                    $('#no_data_msg').show();
                    return;
                }

                try {
                    renderReport(result);
                    $('#report_content').show();
                } catch(renderErr) {
                    console.error('renderReport error:', renderErr);
                    toastr.error('Report render error: ' + renderErr.message);
                }
            },
            error: function(xhr, textStatus, errorThrown) {
                btn.prop('disabled', false);
                $('#report_loading').hide();
                console.error('Ingredient Report AJAX error:', textStatus, xhr.status, errorThrown);
                var msg = (xhr.responseJSON && xhr.responseJSON.error) ? xhr.responseJSON.error : "<?php echo app('translator')->get('messages.something_went_wrong'); ?>";
                toastr.error(msg);
            }
        });
    });

    var demandIngredientPrintUrl = <?php echo json_encode(action([\Modules\Manufacturing\Http\Controllers\DemandIngredientReportController::class, 'printReport']), 512) ?>;
    var demandIngredientStatusUrl = <?php echo json_encode(action([\Modules\Manufacturing\Http\Controllers\DemandIngredientReportController::class, 'updateProductSummaryStatus']), 512) ?>;
    var demandIngredientGenericError = <?php echo json_encode(__('messages.something_went_wrong'), 15, 512) ?>;
    var productionStatusLabels = {
        planned: <?php echo json_encode(__('manufacturing::lang.status_planned'), 15, 512) ?>,
        in_progress: <?php echo json_encode(__('manufacturing::lang.status_in_progress'), 15, 512) ?>,
        quality_check: <?php echo json_encode(__('manufacturing::lang.status_quality_check'), 15, 512) ?>,
        completed: <?php echo json_encode(__('manufacturing::lang.status_completed'), 15, 512) ?>,
        on_hold: <?php echo json_encode(__('manufacturing::lang.status_on_hold'), 15, 512) ?>,
        cancelled: <?php echo json_encode(__('manufacturing::lang.status_cancelled'), 15, 512) ?>
    };
    var productionStatusBadges = {
        planned: 'bg-info',
        in_progress: 'bg-primary',
        quality_check: 'bg-warning',
        completed: 'bg-success',
        on_hold: 'bg-secondary',
        cancelled: 'bg-danger'
    };

    function escapeHtml(value) {
        return $('<div>').text(value == null ? '' : value).html();
    }

    function renderProductStatusBadge(status, label, variationId, rowIndex) {
        var safeStatus = status || 'planned';
        var badgeClass = productionStatusBadges[safeStatus] || 'bg-secondary';
        var text = label || productionStatusLabels[safeStatus] || safeStatus;
        var title = <?php echo json_encode(__('manufacturing::lang.change_status'), 15, 512) ?>;

        return '<span class="badge ' + badgeClass + ' dir-production-status change-dir-prod-status" ' +
            'data-row-index="' + rowIndex + '" ' +
            'data-status="' + escapeHtml(safeStatus) + '" ' +
            'data-variation-id="' + escapeHtml(variationId) + '" ' +
            'title="' + escapeHtml(title) + '">' +
            escapeHtml(text) + ' <i class="fas fa-exchange-alt fa-xs"></i></span>';
    }

    function getDemandIngredientPrintParams(tab) {
        var params = {
            tab: tab || 'product_wise',
            location_id: $('#dir_location_id').val(),
            category_id: $('#dir_category_id').val(),
            sub_category_id: $('#dir_sub_category_id').val(),
            sub2_category_id: $('#dir_sub2_category_id').val(),
            demand_order_ids: $('#dir_demand_order_ids').val() || [],
            status_filter: $('#dir_status_filter').val() || []
        };

        try {
            var drp = $('#dir_date_range').data('daterangepicker');
            if (drp && $('#dir_date_range').val()) {
                params.start_date = drp.startDate.format('YYYY-MM-DD');
                params.end_date = drp.endDate.format('YYYY-MM-DD');
            }
        } catch(ex) {
            console.warn('daterangepicker read error:', ex);
        }

        $.each(params, function(key, value) {
            if (value === '' || value === null || typeof value === 'undefined' || ($.isArray(value) && !value.length)) {
                delete params[key];
            }
        });

        return params;
    }

    function openDemandIngredientPrintPreview(tab) {
        var query = $.param(getDemandIngredientPrintParams(tab));
        window.open(demandIngredientPrintUrl + (query ? '?' + query : ''), '_blank');
    }

    $(document).on('click', '#print_active_tab', function() {
        var $activeTab = $('#reportTabContent .tab-pane.active');
        if (!$activeTab.length) {
            toastr.error("<?php echo app('translator')->get('manufacturing::lang.no_data_found'); ?>");
            return;
        }

        openDemandIngredientPrintPreview($activeTab.attr('id'));
    });

    $(document).on('click', '#print_all_tabs', function() {
        openDemandIngredientPrintPreview('all');
    });

    $(document).on('click', '.change-dir-prod-status', function(e) {
        e.preventDefault();
        var variationId = $(this).data('variation-id');

        var currentStatus = $(this).data('status') || 'planned';
        if (!$('#dir_prod_status_new_status option[value="' + currentStatus + '"]').length) {
            currentStatus = 'planned';
        }

        $('#dir_prod_status_row_index').val($(this).data('row-index'));
        $('#dir_prod_status_variation_id').val(variationId);
        $('#dir_prod_status_new_status').val(currentStatus);
        $('#dir_product_status_modal').modal('show');
    });

    $(document).on('click', '#dir_prod_status_save_btn', function() {
        var variationId = $('#dir_prod_status_variation_id').val();
        var newStatus = $('#dir_prod_status_new_status').val();
        var rowIndex = $('#dir_prod_status_row_index').val();

        if (!variationId || !newStatus) {
            toastr.error(demandIngredientGenericError);
            return;
        }

        var btn = $(this);
        btn.prop('disabled', true);
        $.ajax({
            method: 'POST',
            url: demandIngredientStatusUrl,
            dataType: 'json',
            data: {
                variation_id: variationId,
                status: newStatus,
                _token: $('meta[name="csrf-token"]').attr('content')
            },
            success: function(result) {
                btn.prop('disabled', false);
                if (result.success) {
                    toastr.success(result.msg);
                    $('#dir_product_status_modal').modal('hide');
                    $('.change-dir-prod-status[data-row-index="' + rowIndex + '"]').replaceWith(
                        renderProductStatusBadge(result.production_status, result.production_status_label, result.variation_id, rowIndex)
                    );
                } else {
                    toastr.error(result.msg);
                }
            },
            error: function() {
                btn.prop('disabled', false);
                toastr.error(demandIngredientGenericError);
            }
        });
    });

    // Cascade: category → sub-category → sub2-category
    $(document).on('change', '#dir_category_id', function() {
        var cat_id = $(this).val();
        $('#dir_sub_category_id').html('<option value=""><?php echo e(__("lang_v1.all"), false); ?></option>');
        $('#dir_sub2_category_id').html('<option value=""><?php echo e(__("lang_v1.all"), false); ?></option>');
        if (cat_id) {
            $.ajax({
                method: 'POST',
                url: '/products/get_sub_categories',
                dataType: 'html',
                data: { cat_id: cat_id },
                success: function(result) {
                    $('#dir_sub_category_id').append(result);
                },
            });
        }
    });
    $(document).on('change', '#dir_sub_category_id', function() {
        var cat_id = $(this).val();
        $('#dir_sub2_category_id').html('<option value=""><?php echo e(__("lang_v1.all"), false); ?></option>');
        if (cat_id) {
            $.ajax({
                method: 'POST',
                url: '/products/get_sub_categories',
                dataType: 'html',
                data: { cat_id: cat_id },
                success: function(result) {
                    $('#dir_sub2_category_id').append(result);
                },
            });
        }
    });

    // Date range - wrapped in try-catch to prevent blocking other handlers
    // ── Demand Ingredient Report filter: Save / Reset ────────────────────
    var _dirFilterKey = 'dir_filters_<?php echo e(auth()->id(), false); ?>';

    function _dirRestoreFilters() {
        var saved = null;
        try { saved = JSON.parse(localStorage.getItem(_dirFilterKey)); } catch(e) {}
        if (!saved) return;
        if (saved.location_id) {
            $('#dir_location_id').val(saved.location_id).trigger('change.select2');
        }
        if (saved.category_id) {
            $('#dir_category_id').val(saved.category_id).trigger('change.select2');
        }
        if (saved.sub_category_id) {
            var subEl = $('#dir_sub_category_id');
            subEl.append('<option value="' + $('<div>').text(saved.sub_category_id).html() + '">' + $('<div>').text(saved.sub_text || saved.sub_category_id).html() + '</option>');
            subEl.val(saved.sub_category_id).trigger('change.select2');
        }
        if (saved.sub2_category_id) {
            var sub2El = $('#dir_sub2_category_id');
            sub2El.append('<option value="' + $('<div>').text(saved.sub2_category_id).html() + '">' + $('<div>').text(saved.sub2_text || saved.sub2_category_id).html() + '</option>');
            sub2El.val(saved.sub2_category_id).trigger('change.select2');
        }
        if (saved.status_filter && saved.status_filter.length) {
            $('#dir_status_filter').val(saved.status_filter).trigger('change.select2');
        }
        if (saved.demand_order_ids && saved.demand_order_ids.length) {
            $('#dir_demand_order_ids').val(saved.demand_order_ids).trigger('change.select2');
        }
    }

    $('#dir_filter_save').on('click', function() {
        var sub  = $('#dir_sub_category_id');
        var sub2 = $('#dir_sub2_category_id');
        var data = {
            location_id:      $('#dir_location_id').val()          || '',
            date_range:       $('#dir_date_range').val()            || '',
            demand_order_ids: $('#dir_demand_order_ids').val()      || [],
            category_id:      $('#dir_category_id').val()           || '',
            sub_category_id:  sub.val()                             || '',
            sub2_category_id: sub2.val()                            || '',
            sub_text:         sub.find('option:selected').text()    || '',
            sub2_text:        sub2.find('option:selected').text()   || '',
            status_filter:    $('#dir_status_filter').val()         || [],
        };
        localStorage.setItem(_dirFilterKey, JSON.stringify(data));
        toastr.success('<?php echo e(__('lang_v1.success'), false); ?>');
    });

    $('#dir_filter_reset').on('click', function() {
        localStorage.removeItem(_dirFilterKey);
        $('#dir_location_id').val('').trigger('change.select2');
        var drp = $('#dir_date_range').data('daterangepicker');
        if (drp) { drp.setStartDate(moment()); drp.setEndDate(moment()); }
        $('#dir_date_range').val('');
        $('#dir_demand_order_ids').val([]).trigger('change.select2');
        $('#dir_category_id').val('').trigger('change.select2');
        $('#dir_sub_category_id').html('<option value=""><?php echo e(__("lang_v1.all"), false); ?></option>').trigger('change.select2');
        $('#dir_sub2_category_id').html('<option value=""><?php echo e(__("lang_v1.all"), false); ?></option>').trigger('change.select2');
        $('#dir_status_filter').val([]).trigger('change.select2');
    });
    // ───────────────────────────────────────────────────────────────────

    try {
        if (typeof dateRangeSettings !== 'undefined') {
            var dirDateSettings = $.extend(true, {}, dateRangeSettings);
            dirDateSettings.startDate = moment().subtract(1, 'days');
            dirDateSettings.endDate = moment().subtract(1, 'days');
            var _dirSaved = null;
            try { _dirSaved = JSON.parse(localStorage.getItem(_dirFilterKey)); } catch(e) {}
            if (_dirSaved && _dirSaved.date_range) {
                var _dirParts = _dirSaved.date_range.split(' ~ ');
                if (_dirParts.length === 2) {
                    dirDateSettings.startDate = moment(_dirParts[0], moment_date_format);
                    dirDateSettings.endDate   = moment(_dirParts[1], moment_date_format);
                }
            }
            $('#dir_date_range').daterangepicker(dirDateSettings, function(start, end) {
                $('#dir_date_range').val(start.format(moment_date_format) + ' ~ ' + end.format(moment_date_format));
            });
            if (_dirSaved && _dirSaved.date_range) {
                $('#dir_date_range').val(_dirSaved.date_range);
            } else {
                $('#dir_date_range').val(moment().subtract(1, 'days').format(moment_date_format) + ' ~ ' + moment().subtract(1, 'days').format(moment_date_format));
            }
            $('#dir_date_range').on('cancel.daterangepicker', function() {
                $(this).val('');
            });
        }
    } catch(e) {
        console.error('daterangepicker init error:', e);
    }

    _dirRestoreFilters();

    function renderReport(data) {
        // KPIs
        $('#kpi_total_ingredients').text(data.ingredient_details.length);
        $('#kpi_total_cost').text(__currency_trans_from_en(data.total_ingredient_cost, true));
        $('#kpi_total_categories').text(data.category_summary.length);

        // Product-wise Summary
        var productHtml = '';
        var productGrandTotal = 0;
        var productTotalDemandQty = 0;
        var productGrandSellingPrice = 0;
        $.each(data.product_summary, function(i, item) {
            productGrandTotal += item.total_ingredient_cost;
            productTotalDemandQty += item.total_demand_qty;
            var itemSellingPrice = item.total_demand_qty * (item.sell_price_inc_tax || 0);
            productGrandSellingPrice += itemSellingPrice;
            var ingredientRows = '';
            $.each(item.ingredients, function(j, ing) {
                ingredientRows += '<tr class="table-light product-ingredients-' + i + '" style="display:none;">' +
                    '<td></td>' +
                    '<td class="ps-4"><small><i class="fas fa-arrow-right text-muted"></i> ' + ing.ingredient_name + '</small></td>' +
                    '<td><small>' + ing.sku + '</small></td>' +
                    '<td></td>' +
                    '<td></td>' +
                    '<td></td>' +
                    '<td></td>' +
                    '<td class="text-end"><small>' + __number_f(ing.total_quantity, false, false, __quantity_precision) + '</small></td>' +
                    '<td><small>' + ing.unit + '</small></td>' +
                    '<td class="text-end"><small>' + __number_f(ing.total_cost) + '</small></td>' +
                    '<td></td>' +
                    '<td></td></tr>';
            });

            productHtml += '<tr>' +
                '<td>' + (i + 1) + '</td>' +
                '<td><strong>' + item.product_name + '</strong></td>' +
                '<td>' + item.sku + '</td>' +
                '<td>' + item.category + '</td>' +
                '<td>' + (item.sub_category || '') + '</td>' +
                '<td>' + (item.sub2_category || '') + '</td>' +
                '<td>' + renderProductStatusBadge(item.production_status, item.production_status_label, item.variation_id, i) + '</td>' +
                '<td class="text-end">' + __number_f(item.total_demand_qty, false, false, __quantity_precision) + '</td>' +
                '<td>' + item.unit + '</td>' +
                '<td class="text-end"><strong>' + __number_f(item.total_ingredient_cost) + '</strong></td>' +
                '<td class="text-end"><strong>' + __number_f(itemSellingPrice) + '</strong></td>' +
                '<td><button class="btn btn-xs btn-outline-primary toggle-product-ingredients" data-target="' + i + '"><i class="fas fa-chevron-down"></i></button></td>' +
                '</tr>' + ingredientRows;
        });
        $('#product_summary_body').html(productHtml);
        $('#product_total_demand_qty').text(__number_f(productTotalDemandQty, false, false, __quantity_precision));
        $('#product_grand_total').text(__currency_trans_from_en(productGrandTotal, true));
        $('#product_grand_selling_price').text(__number_f(productGrandSellingPrice));

        // Category-wise Summary
        var categoryHtml = '';
        var categoryGrandTotal = 0;
        var categoryTotalItems = 0;
        var categoryGrandSellingPrice = 0;
        $.each(data.category_summary, function(i, item) {
            categoryGrandTotal += item.total_cost;
            categoryTotalItems += item.total_items;
            categoryGrandSellingPrice += (item.total_selling_price || 0);
            var catIngredientRows = '';
            $.each(item.ingredients, function(j, ing) {
                catIngredientRows += '<tr class="table-light category-ingredients-' + i + '" style="display:none;">' +
                    '<td></td>' +
                    '<td class="ps-4"><small><i class="fas fa-arrow-right text-muted"></i> ' + ing.ingredient_name + ' (' + ing.sku + ')</small></td>' +
                    '<td></td>' +
                    '<td></td>' +
                    '<td class="text-end"><small>' + __number_f(ing.total_quantity, false, false, __quantity_precision) + ' ' + ing.unit + '</small></td>' +
                    '<td class="text-end"><small>' + __number_f(ing.total_cost) + '</small></td>' +
                    '<td class="text-end"><small>' + __number_f(ing.total_selling_price || 0) + '</small></td>' +
                    '<td></td><td></td></tr>';
            });

            var pct = data.total_ingredient_cost > 0 ? ((item.total_cost / data.total_ingredient_cost) * 100).toFixed(1) : 0;
            categoryHtml += '<tr>' +
                '<td>' + (i + 1) + '</td>' +
                '<td><strong>' + item.category_name + '</strong></td>' +
                '<td>' + (item.sub_category || '') + '</td>' +
                '<td>' + (item.sub2_category || '') + '</td>' +
                '<td class="text-end">' + item.total_items + '</td>' +
                '<td class="text-end"><strong>' + __number_f(item.total_cost) + '</strong></td>' +
                '<td class="text-end"><strong>' + __number_f(item.total_selling_price || 0) + '</strong></td>' +
                '<td class="text-end">' + pct + '%</td>' +
                '<td><button class="btn btn-xs btn-outline-success toggle-category-ingredients" data-target="' + i + '"><i class="fas fa-chevron-down"></i></button></td>' +
                '</tr>' + catIngredientRows;
        });
        $('#category_summary_body').html(categoryHtml);
        $('#category_total_items').text(categoryTotalItems);
        $('#category_grand_total').text(__currency_trans_from_en(categoryGrandTotal, true));
        $('#category_grand_selling_price').text(__number_f(categoryGrandSellingPrice));

        // All Ingredients Summary (aggregated)
        var summaryHtml = '';
        var summaryGrandTotal = 0;
        var summaryTotalQty = 0;
        var summaryGrandSellingPrice = 0;
        $.each(data.ingredient_details, function(i, item) {
            summaryGrandTotal += item.total_cost;
            summaryTotalQty += item.total_final_qty;
            summaryGrandSellingPrice += (item.total_selling_price || 0);
            summaryHtml += '<tr>' +
                '<td>' + (i + 1) + '</td>' +
                '<td>' + item.ingredient_name + '</td>' +
                '<td>' + item.sku + '</td>' +
                '<td>' + item.category + '</td>' +
                '<td>' + (item.sub_category || '') + '</td>' +
                '<td>' + (item.sub2_category || '') + '</td>' +
                '<td class="text-end">' + __number_f(item.total_final_qty, false, false, __quantity_precision) + '</td>' +
                '<td>' + item.unit + '</td>' +
                '<td class="text-end">' + __number_f(item.unit_cost) + '</td>' +
                '<td class="text-end"><strong>' + __number_f(item.total_cost) + '</strong></td>' +
                '<td class="text-end"><strong>' + __number_f(item.total_selling_price || 0) + '</strong></td>' +
                '</tr>';
        });
        $('#ingredient_summary_body').html(summaryHtml);
        $('#ingredient_summary_total_qty').text(__number_f(summaryTotalQty, false, false, __quantity_precision));
        $('#ingredient_summary_grand_total').text(__currency_trans_from_en(summaryGrandTotal, true));
        $('#ingredient_summary_grand_selling_price').text(__number_f(summaryGrandSellingPrice));

        // All Ingredients Detail (per order)
        var ingredientHtml = '';
        var ingredientGrandTotal = 0;
        var ingredientTotalReqQty = 0;
        var ingredientTotalWasteQty = 0;
        var ingredientTotalNetQty = 0;
        var ingredientGrandSellingPrice = 0;
        var rowNum = 0;
        $.each(data.ingredient_order_details, function(oi, order) {
            // Order header row
            ingredientHtml += '<tr class="table-primary">' +
                '<td colspan="14"><strong><i class="fas fa-file-alt"></i> ' + order.ref_no + '</strong>' +
                ' <small class="text-muted ms-2">' + order.demand_date + '</small>' +
                ' <span class="badge bg-secondary ms-2">' + order.status + '</span>' +
                '</td></tr>';

            var orderTotal = 0;
            var orderSellingTotal = 0;
            $.each(order.ingredients, function(j, item) {
                rowNum++;
                ingredientGrandTotal += item.total_cost;
                ingredientTotalReqQty += item.total_quantity;
                ingredientTotalWasteQty += item.total_waste_qty;
                ingredientTotalNetQty += item.total_final_qty;
                ingredientGrandSellingPrice += (item.total_selling_price || 0);
                orderTotal += item.total_cost;
                orderSellingTotal += (item.total_selling_price || 0);

                ingredientHtml += '<tr>' +
                    '<td>' + rowNum + '</td>' +
                    '<td></td>' +
                    '<td>' + item.ingredient_name + '</td>' +
                    '<td>' + item.sku + '</td>' +
                    '<td>' + (item.category || '') + '</td>' +
                    '<td>' + (item.sub_category || '') + '</td>' +
                    '<td>' + (item.sub2_category || '') + '</td>' +
                    '<td class="text-end">' + __number_f(item.total_quantity, false, false, __quantity_precision) + '</td>' +
                    '<td class="text-end">' + __number_f(item.total_waste_qty, false, false, __quantity_precision) + '</td>' +
                    '<td class="text-end">' + __number_f(item.total_final_qty, false, false, __quantity_precision) + '</td>' +
                    '<td>' + item.unit + '</td>' +
                    '<td class="text-end">' + __number_f(item.unit_cost) + '</td>' +
                    '<td class="text-end">' + __number_f(item.total_cost) + '</td>' +
                    '<td class="text-end">' + __number_f(item.total_selling_price || 0) + '</td>' +
                    '</tr>';
            });

            // Order subtotal
            ingredientHtml += '<tr class="table-light fw-bold">' +
                '<td colspan="12" class="text-end"><small>' + order.ref_no + ' <?php echo app('translator')->get("manufacturing::lang.subtotal"); ?>:</small></td>' +
                '<td class="text-end"><small>' + __currency_trans_from_en(orderTotal, true) + '</small></td>' +
                '<td class="text-end"><small>' + __number_f(orderSellingTotal) + '</small></td>' +
                '</tr>';
        });
        $('#ingredient_detail_body').html(ingredientHtml);
        $('#ingredient_total_req_qty').text(__number_f(ingredientTotalReqQty, false, false, __quantity_precision));
        $('#ingredient_total_waste_qty').text(__number_f(ingredientTotalWasteQty, false, false, __quantity_precision));
        $('#ingredient_total_net_qty').text(__number_f(ingredientTotalNetQty, false, false, __quantity_precision));
        $('#ingredient_grand_total').text(__currency_trans_from_en(ingredientGrandTotal, true));
        $('#ingredient_grand_selling_price').text(__number_f(ingredientGrandSellingPrice));


        // Batch Ingredients Summary (aggregated)
        var summaryHtml = '';
        var summaryGrandTotal = 0;
        var summaryTotalQty = 0;
        var summaryGrandSellingPrice = 0;
        $.each(data.batch_ingredient_details, function(i, item) {
            summaryGrandTotal += item.total_cost;
            summaryTotalQty += item.total_final_qty;
            summaryGrandSellingPrice += (item.total_selling_price || 0);
            summaryHtml += '<tr>' +
                '<td>' + (i + 1) + '</td>' +
                '<td>' + item.ingredient_name + '</td>' +
                '<td>' + item.sku + '</td>' +
                '<td>' + item.category + '</td>' +
                '<td>' + (item.sub_category || '') + '</td>' +
                '<td>' + (item.sub2_category || '') + '</td>' +
                '<td class="text-end">' + __number_f(item.total_final_qty, false, false, __quantity_precision) + '</td>' +
                '<td>' + item.unit + '</td>' +
                '<td class="text-end">' + __number_f(item.unit_cost) + '</td>' +
                '<td class="text-end"><strong>' + __number_f(item.total_cost) + '</strong></td>' +
                '<td class="text-end"><strong>' + __number_f(item.total_selling_price || 0) + '</strong></td>' +
                '</tr>';
        });
        $('#batch_ingredient_summary_body').html(summaryHtml);
        $('#batch_ingredient_summary_total_qty').text(__number_f(summaryTotalQty, false, false, __quantity_precision));
        $('#batch_ingredient_summary_grand_total').text(__currency_trans_from_en(summaryGrandTotal, true));
        $('#batch_ingredient_summary_grand_selling_price').text(__number_f(summaryGrandSellingPrice));
    }

    function getFilterSummaryHtml() {
        var filters = [];
        var locationText = $('#dir_location_id option:selected').text();
        var categoryText = $('#dir_category_id option:selected').text();
        var dateRange = $('#dir_date_range').val();
        var demandOrders = $('#dir_demand_order_ids option:selected').map(function() {
            return $(this).text();
        }).get();
        var statuses = $('#dir_status_filter option:selected').map(function() {
            return $(this).text();
        }).get();

        filters.push('<div><strong>Location:</strong> ' + (locationText && locationText !== '<?php echo app('translator')->get('lang_v1.all'); ?>' ? locationText : 'All') + '</div>');
        filters.push('<div><strong>Date Range:</strong> ' + (dateRange || 'All') + '</div>');
        filters.push('<div><strong>Category:</strong> ' + (categoryText && categoryText !== '<?php echo app('translator')->get('lang_v1.all'); ?>' ? categoryText : 'All') + '</div>');
        filters.push('<div><strong>Demand Orders:</strong> ' + (demandOrders.length ? demandOrders.join(', ') : 'All') + '</div>');
        filters.push('<div><strong><?php echo app('translator')->get('manufacturing::lang.demand_order_status'); ?>:</strong> ' + (statuses.length ? statuses.join(', ') : 'All') + '</div>');

        return filters.join('');
    }

    function getLaserPrintStyles() {
        return '<style>' +
            '@page{size:auto;margin:10mm;}' +
            'body{font-family:Arial,sans-serif;color:#222;font-size:12px;margin:0;}' +
            '.print-page{page-break-after:always;margin-bottom:12mm;}' +
            '.print-page:last-child{page-break-after:auto;}' +
            '.report-header{border-bottom:2px solid #333;padding-bottom:8px;margin-bottom:12px;}' +
            '.report-title{font-size:22px;font-weight:700;margin:0 0 4px 0;}' +
            '.report-subtitle{font-size:12px;color:#666;margin:0;}' +
            '.filter-grid{display:grid;grid-template-columns:1fr 1fr;gap:6px 18px;margin:10px 0 14px 0;}' +
            '.tab-title{font-size:16px;font-weight:700;margin:0 0 10px 0;padding:6px 0;border-bottom:1px solid #bbb;}' +
            'table{width:100%;border-collapse:collapse !important;}' +
            'th,td{border:1px solid #cfcfcf !important;padding:6px 7px !important;vertical-align:top;}' +
            'thead th,.table-light th,.table-light td{background:#f4f4f4 !important;color:#111 !important;}' +
            '.table-responsive{overflow:visible !important;}' +
            '.box,.card{border:0 !important;box-shadow:none !important;}' +
            '.card-body,.box-body{padding:0 !important;}' +
            '.btn,.nav,.no-print,.toggle-product-ingredients,.toggle-category-ingredients{display:none !important;}' +
            'tr[style*=\"display:none\"]{display:table-row !important;}' +
            '.rounded-circle{display:none !important;}' +
            '.text-end{text-align:right !important;}' +
            '.text-center{text-align:center !important;}' +
            '.fw-bold,strong{font-weight:700 !important;}' +
            'h3,h4,h5,h6{margin:0;}' +
            '</style>';
    }

    function printDemandIngredientSections(sections) {
        var printWindow = window.open('', '_blank');
        if (!printWindow) {
            toastr.error('Unable to open print window. Please allow popups.');
            return;
        }

        var html = '<html><head><title>Demand Ingredient Report</title>' + getLaserPrintStyles() + '</head><body>';
        var generatedAt = new Date().toLocaleString();
        var filterSummary = getFilterSummaryHtml();

        $.each(sections, function(index, section) {
            html += '<div class="print-page">';
            html += '<div class="report-header">';
            html += '<h1 class="report-title"><?php echo app('translator')->get('manufacturing::lang.demand_ingredient_report'); ?></h1>';
            html += '<p class="report-subtitle">Generated: ' + generatedAt + '</p>';
            html += '</div>';
            html += '<div class="filter-grid">' + filterSummary + '</div>';
            html += '<h2 class="tab-title">' + $('<div>').text(section.title).html() + '</h2>';
            html += '<div class="print-section">' + section.content + '</div>';
            html += '</div>';
        });

        html += '</body></html>';
        printWindow.document.open();
        printWindow.document.write(html);
        printWindow.document.close();
        printWindow.focus();
        setTimeout(function() {
            printWindow.print();
        }, 500);
    }

    // Toggle product ingredient rows
    $(document).on('click', '.toggle-product-ingredients', function() {
        var target = $(this).data('target');
        $('.product-ingredients-' + target).toggle();
        $(this).find('i').toggleClass('fa-chevron-down fa-chevron-up');
    });

    // Toggle category ingredient rows
    $(document).on('click', '.toggle-category-ingredients', function() {
        var target = $(this).data('target');
        $('.category-ingredients-' + target).toggle();
        $(this).find('i').toggleClass('fa-chevron-down fa-chevron-up');
    });
});
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>