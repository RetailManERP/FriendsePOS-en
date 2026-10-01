
<?php $__env->startSection('title', __('stock_adjustment.add')); ?>

<?php $__env->startSection('content'); ?>
<?php echo $__env->make('warehouse::layouts.nav', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php
    $user_settings = json_decode(auth()->user()->user_settings, true);
    $asset_v = config('constants.asset_version', '1.0');
?>

<section class="content-header">
    <h1><?php echo app('translator')->get('stock_adjustment.add'); ?></h1>
</section>

<section class="content no-print">
    <input type="hidden" id="page_type" value="purchase">
    <?php echo Form::open(['route' => 'warehouse.stock.adjustments.store', 'method' => 'post', 'id' => 'stock_adjustment_form']); ?>


    <div class="box box-primary">
        <div class="box-body box box-primary">
            <div class="row">
                <?php if(count($business_locations) == 1): ?>
                    <?php $default_location = current(array_keys($business_locations->toArray())) ?>
                <?php else: ?>
                    <?php $default_location = array_key_first($business_locations->toArray()); ?>
                <?php endif; ?>
                <?php
                    if(isset($user_settings['default_location']) && !empty($user_settings['default_location'])){
                        $default_location = $user_settings['default_location'];
                    }
                ?>

                <div class="col-sm-3">
                    <div class="form-group mb-2">
                        <?php echo Form::label('location_id', __('purchase.business_location').':*'); ?>

                        <?php echo Form::select('location_id', $business_locations, $default_location, ['class' => 'form-control select2', 'placeholder' => __('messages.please_select'), 'required']); ?>

                    </div>
                </div>
                <div class="col-sm-3">
                    <div class="form-group mb-2">
                        <?php echo Form::label('ref_no', __('purchase.ref_no').':'); ?>

                        <?php echo Form::text('ref_no', null, ['class' => 'form-control']); ?>

                    </div>
                </div>
                <?php
                    $is_readonly = empty($user_settings['enable_stock_adjustment_transaction_date']) ? 'disabled' : '';
                ?>
                <div class="col-sm-3">
                    <?php echo Form::hidden('transaction_date', \Carbon::createFromTimestamp(strtotime('now'))->format(session('business.date_format') . ' ' . 'h:i A'), ['id' => 'transaction_date', 'class' => 'form-control transaction_date', 'required']); ?>

                    <div class="form-group mb-2">
                        <?php echo Form::label('transaction_date', __('messages.date') . ':*'); ?>

                        <div class="input-group">
                            <span class="input-group-text"><i class="fa fa-calendar"></i></span>
                            <?php echo Form::text('transaction_date_text', \Carbon::createFromTimestamp(strtotime('now'))->format(session('business.date_format') . ' ' . 'h:i A'), ['id' => 'transaction_date_text', 'class' => 'form-control', $is_readonly, 'required']); ?>

                        </div>
                    </div>
                </div>
                <div class="col-sm-3">
                    <div class="form-group mb-2">
                        <?php echo Form::label('adjustment_type', __('stock_adjustment.adjustment_type') . ':*'); ?>

                        <?php echo Form::select('adjustment_type', [
                            'stock_adjustment' => __('stock_adjustment.stock_adjustment'),
                            'stock_take'       => __('stock_adjustment.stock_take'),
                        ], null, ['class' => 'form-control select2', 'required']); ?>

                    </div>
                </div>
                <input type="hidden" id="is_overselling_allowed">
            </div>
        </div>
    </div>

    
    <div class="box box-primary">
        <div class="box-body box box-primary">
            <div class="row">
                <div class="col-md-12">
                    <h4>Load Products by Filters</h4>
                </div>
                <?php if(session('business.enable_category')): ?>
                <div class="col-md-3">
                    <div class="mb-3">
                        <?php echo Form::label('category_id', __('category.category') . ':'); ?>

                        <?php echo Form::select('category', $categories, null, ['placeholder' => __('messages.all'), 'class' => 'form-control select2', 'style' => 'width:100%', 'id' => 'category_id']); ?>

                    </div>
                </div>
                <?php endif; ?>
                <?php if(session('business.enable_sub_category')): ?>
                <div class="col-md-3">
                    <div class="mb-3">
                        <?php echo Form::label('sub_category_id', __('product.sub_category') . ':'); ?>

                        <?php echo Form::select('sub_category', [], null, ['placeholder' => __('messages.all'), 'class' => 'form-control select2', 'style' => 'width:100%', 'id' => 'sub_category_id']); ?>

                    </div>
                </div>
                <?php endif; ?>
                <?php if(session('business.enable_brand')): ?>
                <div class="col-md-3">
                    <div class="mb-3">
                        <?php echo Form::label('brand_id', __('product.brand') . ':'); ?>

                        <?php echo Form::select('brand_id', $brands, null, ['placeholder' => __('messages.all'), 'class' => 'form-control select2', 'style' => 'width:100%']); ?>

                    </div>
                </div>
                <?php endif; ?>
                <div class="clearfix"></div>
                <?php if(session('business.enable_racks')): ?>
                <div class="col-md-3">
                    <div class="mb-3">
                        <?php echo Form::label('pr_rack', __('lang_v1.rack') . ':'); ?>

                        <?php echo Form::select('pr_rack', $racks, null, ['placeholder' => __('messages.all'), 'class' => 'form-control select2', 'style' => 'width:100%']); ?>

                    </div>
                </div>
                <?php endif; ?>
                <?php if(session('business.enable_row')): ?>
                <div class="col-md-3">
                    <div class="mb-3">
                        <?php echo Form::label('pr_row', __('lang_v1.row') . ':'); ?>

                        <?php echo Form::select('pr_row', $rows, null, ['placeholder' => __('messages.all'), 'class' => 'form-control select2', 'style' => 'width:100%']); ?>

                    </div>
                </div>
                <?php endif; ?>
                <?php if(session('business.enable_position')): ?>
                <div class="col-md-3">
                    <div class="mb-3">
                        <?php echo Form::label('pr_pos', __('lang_v1.position') . ':'); ?>

                        <?php echo Form::select('pr_pos', $positions, null, ['placeholder' => __('messages.all'), 'class' => 'form-control select2', 'style' => 'width:100%']); ?>

                    </div>
                </div>
                <?php endif; ?>
                <?php if(session('business.enable_category') || session('business.enable_brand') || session('business.enable_racks') || session('business.enable_row') || session('business.enable_position')): ?>
                <div class="col-md-3">
                    <br>
                    <button type="button" id="bulk_load_products" class="btn btn-primary btn-block" style="margin-top:4px;">
                        Load Products <i class="hide fas fa-sync fa-spin fa-fw"></i>
                    </button>
                </div>
                <?php endif; ?>
            </div>
        </div>
    </div>

    
    <div class="box box-primary">
        <div class="box-header box box-primary">
            <h3 class="box-title"><?php echo e(__('stock_adjustment.search_products'), false); ?></h3>
        </div>
        <div class="box-body">
            <div class="row">
                <div class="col-sm-8 offset-sm-2">
                    <div class="mb-3">
                        <div class="input-group">
                            <button type="button" class="btn btn-secondary btn-flat" id="open_products_search_modal" title="<?php echo e(__('lang_v1.products_search'), false); ?>">
                                <i class="fas fa-search"></i>
                            </button>
                            <?php echo Form::text('search_product', null, ['class' => 'form-control', 'id' => 'search_product_for_srock_adjustment', 'placeholder' => __('stock_adjustment.search_product')]); ?>

                        </div>
                    </div>
                </div>
            </div>

            <?php
                $is_admin = auth()->user()->hasRole('Admin#'.auth()->user()->business_id);
                $hide_brand = '';
                $colspan = '7';
                if (empty($user_settings['stock_adjustment_show_brand_column']) && !$is_admin) {
                    $hide_brand = 'hide';
                    $colspan = '5';
                }
                $hide_category = '';
                if (empty($user_settings['stock_adjustment_show_category_column']) && !$is_admin) {
                    $hide_category = 'hide';
                    $colspan = '5';
                }
                $hide_price = '';
                if (empty($user_settings['stock_adjustment_show_price_column']) && !$is_admin) {
                    $hide_price = 'hide';
                }
            ?>

            <div class="row">
                <div class="col-sm-12">
                    <input type="hidden" id="product_row_index" value="0">
                    <input type="hidden" id="total_amount" name="final_total" value="0">
                    <div class="table-responsive" style="max-height: 450px; overflow-y: auto;">
                        <table class="table table-bordered table-striped table-th-skin" id="stock_adjustment_product_table">
                            <thead>
                                <tr>
                                    <th class="text-nowrap" style="width:1%; min-width:30px">#</th>
                                    <th class="text-nowrap" style="width:1%; min-width:50px" id="sort_by_sku"><?php echo app('translator')->get('product.sku'); ?></th>
                                    <th class="text-nowrap" style="width:100%"><?php echo app('translator')->get('sale.product'); ?></th>
                                    <th class="text-nowrap <?php echo e($hide_brand, false); ?>"><?php echo app('translator')->get('product.brand'); ?></th>
                                    <th class="text-nowrap <?php echo e($hide_category, false); ?>"><?php echo app('translator')->get('product.category'); ?></th>
                                    <th class="text-nowrap hide" id="on_hand_column"><?php echo app('translator')->get('stock_adjustment.on_hand'); ?></th>
                                    <th class="text-nowrap hide" id="counted_column"><?php echo app('translator')->get('stock_adjustment.counted'); ?></th>
                                    <th class="text-nowrap" style="width:1%">
                                        <?php echo app('translator')->get('sale.qty'); ?>
                                        <?php
                if(session('business.enable_tooltip')){
                    echo '<i class="fa fa-info-circle text-info hover-q no-print"
                    aria-hidden="true"
                    data-bs-toggle="tooltip"
                    data-bs-placement="bottom"
                    data-bs-html="true"
                    title="' . __('lang_v1.stock_adjustment_quantity_tooltip') . '"></i>';
                }
            ?>
                                    </th>
                                    <th class="text-nowrap text-end <?php echo e($hide_price, false); ?>">
                                        <?php echo app('translator')->get('sale.unit_price'); ?> <span class="selected_currency_symbol badge bg-info" style="font-size:10px;"></span>
                                    </th>
                                    <th class="text-nowrap text-end <?php echo e($hide_price, false); ?>">
                                        <?php echo app('translator')->get('sale.subtotal'); ?> <span class="selected_currency_symbol badge bg-info" style="font-size:10px;"></span>
                                    </th>
                                    <th class="text-nowrap" style="width:1%; min-width:30px"><i class="fa fa-trash" aria-hidden="true"></i></th>
                                </tr>
                            </thead>
                            <tbody></tbody>
                            <tfoot>
                                <tr class="text-center">
                                    <td colspan="<?php echo e($colspan, false); ?>"></td>
                                    <td>
                                        <div class="float-end">
                                            <b><?php echo app('translator')->get('stock_adjustment.total_amount'); ?>:</b>
                                            <span id="total_adjustment">0.00</span>
                                        </div>
                                    </td>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="box box-primary">
        <div class="box-body box box-primary">
            <div class="row">
                <div class="col-sm-6">
                    <div class="form-group mb-2">
                        <?php echo Form::label('total_amount_recovered', __('stock_adjustment.total_amount_recovered') . ':'); ?>

                        <?php
                if(session('business.enable_tooltip')){
                    echo '<i class="fa fa-info-circle text-info hover-q no-print"
                    aria-hidden="true"
                    data-bs-toggle="tooltip"
                    data-bs-placement="bottom"
                    data-bs-html="true"
                    title="' . __('tooltip.total_amount_recovered') . '"></i>';
                }
            ?>
                        <?php echo Form::text('total_amount_recovered', 0, ['class' => 'form-control input_number', 'placeholder' => __('stock_adjustment.total_amount_recovered')]); ?>

                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="form-group mb-2">
                        <?php echo Form::label('additional_notes', __('stock_adjustment.reason_for_stock_adjustment') . ':'); ?>

                        <a href="javascript:void(0)" class="toggle-note">
                            <i class="fa fa-plus-circle text-success"></i>
                        </a>
                        <div class="note-wrapper" style="display:none;">
                            <?php echo Form::textarea('additional_notes', null, ['class' => 'form-control', 'placeholder' => __('stock_adjustment.reason_for_stock_adjustment'), 'rows' => 3]); ?>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="box box-primary">
        <div class="box-body box box-primary">
            <div class="row">
                <div class="col-sm-12 text-end">
                    <a href="<?php echo e(route('warehouse.stock.adjustments'), false); ?>" class="btn btn-default">
                        <i class="fas fa-times"></i> <?php echo app('translator')->get('messages.cancel'); ?>
                    </a>
                    &nbsp;
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-save"></i> <?php echo app('translator')->get('messages.save'); ?>
                    </button>
                </div>
            </div>
        </div>
    </div>

    <?php echo Form::close(); ?>

</section>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('javascript'); ?>
    <script src="<?php echo e(asset('js/stock_adjustment.js?v=' . $asset_v), false); ?>"></script>
    <script type="text/javascript">
        $(document).ready(function () {

            $('select#adjustment_type').change(function () {
                $('#stock_adjustment_product_table tbody').empty();
                $('#on_hand_column').toggleClass('hide');
                $('#counted_column').toggleClass('hide');
            });

            $('#bulk_load_products').click(function () {
                if ($('select#location_id').val()) {
                    var loading = $(this).find('i');
                    loading.toggleClass('hide');
                    $.ajax({
                        method: 'GET',
                        url: "/products/get-variations-by-filters",
                        data: {
                            category_id:    $('#category_id').val(),
                            sub_category_id: $('#sub_category_id').val(),
                            brand_id:       $('#brand_id').val(),
                            pr_rack:        $('#pr_rack').val(),
                            pr_row:         $('#pr_row').val(),
                            pr_pos:         $('#pr_pos').val(),
                            location_id:    $('#location_id').val(),
                        },
                        success: function (result) {
                            $.each(result, function (index, v) {
                                stock_adjustment_product_row(v.variation_id);
                            });
                            loading.toggleClass('hide');
                        }
                    });
                } else {
                    toastr.warning('Please Select Location First');
                }
            });

            __page_leave_confirmation('#stock_adjustment_form');
        });
    </script>
    <?php echo $__env->make('stock_adjustment.partials.stock_adjustment_keyboard_shortcuts', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <?php echo $__env->make('stock_adjustment.partials.stock_adjustment_keyboard_shortcuts_help_modal', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>