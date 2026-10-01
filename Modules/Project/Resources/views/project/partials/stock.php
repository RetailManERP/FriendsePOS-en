
<style>
    /* Keep autocomplete suggestions above the Bootstrap modal. */
    #project_stock_request_modal .ui-autocomplete,
    #project_stock_transfer_modal .ui-autocomplete,
    #project_stock_return_modal .ui-autocomplete { z-index: 1060 !important; }

    /* Scrollable section body — first ~15 rows visible, scroll after. */
    .project-stock-scroll {
        max-height: 540px;
        overflow-y: auto;
        border: 1px solid #f0f0f0;
        border-radius: 4px;
    }
    .project-stock-scroll table { margin-bottom: 0; }
    .project-stock-scroll thead th {
        position: sticky; top: 0; background: #f9fafb; z-index: 2;
        box-shadow: 0 1px 0 #e5e7eb;
    }
    .project-stock-filter-bar { background: #fafafa; padding: 10px; border-radius: 6px; }
    .project-stock-section-nav {
        display: flex;
        flex-wrap: wrap;
        gap: 6px;
        margin-bottom: 12px;
    }
    .project-stock-section-nav .btn.active {
        background: #3c8dbc;
        border-color: #367fa9;
        color: #fff;
    }
    #project_stock_section_body .dropdown-menu li > a > i {
        font-size: 13px;
        width: 14px;
        display: inline-block;
        text-align: center;
    }
</style>

<div class="row">
    <div class="col-md-12">
        <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title"><i class="fa fa-boxes"></i> <?php echo app('translator')->get('project::lang.stock'); ?></h3>
                <div class="box-tools pull-right">
                    <?php if(!empty($can_manage)): ?>
                        <button type="button" class="btn btn-success btn-sm open-project-stock-transfer-modal">
                            <i class="fa fa-exchange-alt"></i> <?php echo app('translator')->get('project::lang.transfer_stock_to_project'); ?>
                        </button>
                        <button type="button" class="btn btn-primary btn-sm open-project-stock-request-modal">
                            <i class="fa fa-plus-circle"></i> <?php echo app('translator')->get('project::lang.request_stock'); ?>
                        </button>
                        <button type="button" class="btn btn-warning btn-sm open-project-stock-return-modal">
                            <i class="fa fa-undo"></i> <?php echo app('translator')->get('project::lang.return_stock'); ?>
                        </button>
                        <?php if(! empty($stock) && ! $stock->isEmpty()): ?>
                            <button type="button" class="btn btn-danger btn-sm open-project-stock-consume-modal">
                                <i class="fa fa-minus-circle"></i> <?php echo app('translator')->get('project::lang.consume_stock'); ?>
                            </button>
                        <?php endif; ?>
                    <?php endif; ?>
                </div>
            </div>
            <div class="box-body">
                <div class="project-stock-section-nav">
                    <button type="button" class="btn btn-default btn-sm project-stock-section-link active" data-section="allocated">
                        <i class="fa fa-boxes"></i> <?php echo app('translator')->get('project::lang.allocated_stock'); ?>
                    </button>
                    <button type="button" class="btn btn-default btn-sm project-stock-section-link" data-section="history">
                        <i class="fa fa-history"></i> <?php echo app('translator')->get('project::lang.project_stock_history'); ?>
                    </button>
                    <button type="button" class="btn btn-default btn-sm project-stock-section-link" data-section="requests">
                        <i class="fa fa-clipboard-list"></i> <?php echo app('translator')->get('project::lang.stock_requests'); ?>
                    </button>
                </div>

                
                <div class="project-stock-filter-bar" id="project_stock_filter_bar" style="display:none;">
                    <div class="row">
                        <div class="col-md-3">
                            <label><?php echo app('translator')->get('account.from'); ?></label>
                            <input type="date" id="project_stock_filter_from" class="form-control">
                        </div>
                        <div class="col-md-3">
                            <label><?php echo app('translator')->get('lang_v1.to'); ?></label>
                            <input type="date" id="project_stock_filter_to" class="form-control">
                        </div>
                        <div class="col-md-3">
                            <label><?php echo app('translator')->get('sale.product'); ?></label>
                            <input type="text" id="project_stock_filter_product" class="form-control" placeholder="<?php echo e(__('lang_v1.search_product'), false); ?>">
                        </div>
                        <div class="col-md-3" style="padding-top: 25px;">
                            <button type="button" id="project_stock_apply_filters" class="btn btn-primary btn-sm">
                                <i class="fa fa-filter"></i> <?php echo app('translator')->get('messages.filter'); ?>
                            </button>
                            <button type="button" id="project_stock_clear_filters" class="btn btn-default btn-sm">
                                <i class="fa fa-times"></i>
                            </button>
                        </div>
                    </div>
                </div>

                
                <div class="row" id="project_stock_search_row" style="margin-top: 12px; display:none;">
                    <div class="col-md-4 col-md-offset-8">
                        <input type="text" id="project_stock_section_search" class="form-control input-sm" placeholder="<?php echo e(__('messages.search'), false); ?>…">
                    </div>
                </div>

                
                <div id="project_stock_section_body" style="margin-top: 12px;">
                    <div class="text-center text-muted" style="padding: 30px 10px;">
                        <i class="fa fa-arrow-up fa-2x" style="opacity:.4"></i>
                        <p style="margin-top:10px;"><?php echo app('translator')->get('project::lang.pick_a_section'); ?></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>




<div class="modal fade" id="project_stock_transfer_modal" tabindex="-1" role="dialog">
    <div class="modal-dialog project-modal" role="document">
        <?php echo Form::open(['route' => ['project.stock.allocate', $project->id], 'method' => 'POST', 'id' => 'project_stock_transfer_form']); ?>

        <input type="hidden" name="stock_request_id" id="project_transfer_stock_request_id">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close project-stock-modal-close" data-dismiss="modal" data-bs-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title"><?php echo app('translator')->get('project::lang.transfer_stock_to_project'); ?></h4>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <?php echo Form::label('source_location_id', __('project::lang.from_location') . ':*'); ?>

                            <?php echo Form::select('source_location_id', $locations, $project->location_id, ['class' => 'form-control select2', 'id' => 'project_transfer_source_location_id', 'required', 'placeholder' => __('messages.please_select')]); ?>

                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <?php echo Form::label('project_destination', __('project::lang.project_destination') . ':'); ?>

                            <input type="text" class="form-control" value="<?php echo e(optional($project->location)->name ?? '-', false); ?>" readonly>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <?php echo Form::label('transfer_product_search', __('sale.product') . ':*'); ?>

                    <?php echo Form::text('transfer_product_search', null, ['class' => 'form-control', 'id' => 'project_transfer_product_search', 'placeholder' => __('lang_v1.search_product'), 'autocomplete' => 'off']); ?>

                </div>
                <div class="table-responsive">
                    <table class="table table-condensed table-bordered" id="project_transfer_product_table">
                        <thead>
                            <tr>
                                <th style="width: 48%;"><?php echo app('translator')->get('sale.product'); ?></th>
                                <th class="text-right" style="width: 18%;"><?php echo app('translator')->get('lang_v1.available'); ?></th>
                                <th style="width: 22%;"><?php echo app('translator')->get('sale.qty'); ?></th>
                                <th class="text-center" style="width: 12%;"><i class="fa fa-trash"></i></th>
                            </tr>
                        </thead>
                        <tbody></tbody>
                    </table>
                </div>
                <?php if(isset($project->steps) && $project->steps->count() > 0): ?>
                <div class="form-group">
                    <?php echo Form::label('pjt_project_step_id', __('project::lang.project_steps') . ':'); ?>

                    <?php echo Form::select('pjt_project_step_id', $project->steps->pluck('name', 'id'), null, ['class' => 'form-control select2', 'id' => 'project_transfer_step_id', 'placeholder' => __('messages.please_select'), 'style' => 'width: 100%;']); ?>

                </div>
                <?php endif; ?>
                <div class="form-group">
                    <?php echo Form::label('notes', __('lang_v1.additional_notes') . ':'); ?>

                    <?php echo Form::textarea('notes', null, ['class' => 'form-control', 'rows' => 2]); ?>

                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default project-stock-modal-close" data-dismiss="modal" data-bs-dismiss="modal"><?php echo app('translator')->get('messages.close'); ?></button>
                <button type="button" class="btn btn-success project-stock-modal-submit" data-form="#project_stock_transfer_form"><?php echo app('translator')->get('project::lang.transfer_stock'); ?></button>
            </div>
        </div>
        <?php echo Form::close(); ?>

    </div>
</div>


<div class="modal fade" id="project_stock_request_modal" tabindex="-1" role="dialog">
    <div class="modal-dialog project-modal" role="document">
        <?php echo Form::open(['route' => ['project.stock.request.store', $project->id], 'method' => 'POST', 'id' => 'project_stock_request_form']); ?>

        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close project-stock-modal-close" data-dismiss="modal" data-bs-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title"><?php echo app('translator')->get('project::lang.request_stock'); ?></h4>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <?php echo Form::label('request_product_search', __('sale.product') . ':*'); ?>

                    <?php echo Form::text('request_product_search', null, ['class' => 'form-control', 'id' => 'project_stock_product_search', 'placeholder' => __('lang_v1.search_product'), 'autocomplete' => 'off']); ?>

                </div>
                <div class="table-responsive">
                    <table class="table table-condensed table-bordered" id="project_request_product_table">
                        <thead>
                            <tr>
                                <th style="width: 62%;"><?php echo app('translator')->get('sale.product'); ?></th>
                                <th style="width: 26%;"><?php echo app('translator')->get('sale.qty'); ?></th>
                                <th class="text-center" style="width: 12%;"><i class="fa fa-trash"></i></th>
                            </tr>
                        </thead>
                        <tbody></tbody>
                    </table>
                </div>
                <div class="form-group">
                    <?php echo Form::label('source_location_id', __('project::lang.from_location') . ':'); ?>

                    <?php echo Form::select('source_location_id', $locations, $project->location_id, ['class' => 'form-control select2', 'placeholder' => __('messages.please_select')]); ?>

                </div>
                <div class="form-group">
                    <?php echo Form::label('priority', __('warehouse::lang.priority') . ':'); ?>

                    <?php echo Form::select('priority', [
                        'low' => __('warehouse::lang.priority_low'),
                        'normal' => __('warehouse::lang.priority_normal'),
                        'high' => __('warehouse::lang.priority_high'),
                        'urgent' => __('warehouse::lang.priority_urgent'),
                    ], 'normal', ['class' => 'form-control']); ?>

                </div>
                <div class="form-group">
                    <?php echo Form::label('notes', __('lang_v1.additional_notes') . ':'); ?>

                    <?php echo Form::textarea('notes', null, ['class' => 'form-control', 'rows' => 2]); ?>

                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default project-stock-modal-close" data-dismiss="modal" data-bs-dismiss="modal"><?php echo app('translator')->get('messages.close'); ?></button>
                <button type="button" class="btn btn-primary project-stock-modal-submit" data-form="#project_stock_request_form"><?php echo app('translator')->get('messages.save'); ?></button>
            </div>
        </div>
        <?php echo Form::close(); ?>

    </div>
</div>


<div class="modal fade" id="project_stock_return_modal" tabindex="-1" role="dialog">
    <div class="modal-dialog project-modal" role="document">
        <?php echo Form::open(['route' => ['project.stock.return', $project->id], 'method' => 'POST', 'id' => 'project_stock_return_form']); ?>

        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close project-stock-modal-close" data-dismiss="modal" data-bs-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title"><?php echo app('translator')->get('project::lang.return_stock'); ?></h4>
            </div>
            <div class="modal-body">
                <input type="hidden" name="from_location_id" id="project_return_from_location_id">
                <div class="form-group">
                    <?php echo Form::label('to_location_id', __('project::lang.return_to') . ':*'); ?>

                    <?php echo Form::select('to_location_id', $locations, $project->location_id, ['class' => 'form-control select2', 'required', 'placeholder' => __('messages.please_select')]); ?>

                </div>
                <div class="form-group">
                    <?php echo Form::label('return_product_search', __('sale.product') . ':*'); ?>

                    <?php echo Form::text('return_product_search', null, ['class' => 'form-control', 'id' => 'project_return_product_search', 'placeholder' => __('lang_v1.search_product'), 'autocomplete' => 'off', 'required']); ?>

                    <input type="hidden" name="product_id" id="project_return_product_id">
                    <input type="hidden" name="variation_id" id="project_return_variation_id">
                    <small class="text-muted" id="project_return_available_hint"></small>
                </div>
                <div class="form-group">
                    <?php echo Form::label('quantity', __('sale.qty') . ':*'); ?>

                    <?php echo Form::number('quantity', null, ['class' => 'form-control', 'id' => 'project_return_quantity', 'step' => '0.01', 'min' => '0.01', 'required']); ?>

                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default project-stock-modal-close" data-dismiss="modal" data-bs-dismiss="modal"><?php echo app('translator')->get('messages.close'); ?></button>
                <button type="button" class="btn btn-warning project-stock-modal-submit" data-form="#project_stock_return_form"><?php echo app('translator')->get('project::lang.process_return'); ?></button>
            </div>
        </div>
        <?php echo Form::close(); ?>

    </div>
</div>


<div class="modal fade" id="project_stock_consume_modal" tabindex="-1" role="dialog">
    <div class="modal-dialog project-modal" role="document">
        <?php echo Form::open(['route' => ['project.stock.consume', $project->id], 'method' => 'POST', 'id' => 'project_stock_consume_form']); ?>

        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close project-stock-modal-close" data-dismiss="modal" data-bs-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title"><?php echo app('translator')->get('project::lang.consume_stock'); ?></h4>
            </div>
            <div class="modal-body">
                <p class="text-muted"><?php echo app('translator')->get('project::lang.consume_stock_hint'); ?></p>
                <div class="form-group">
                    <?php echo Form::label('consume_line', __('project::lang.allocated_stock') . ':*'); ?>

                    <select name="consume_line" id="consume_line" class="form-control select2" required>
                        <option value=""><?php echo e(__('messages.please_select'), false); ?></option>
                        <?php $__currentLoopData = $stock; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <?php if($row->qty_available > 0): ?>
                                <option
                                    value="<?php echo e($row->product_id, false); ?>_<?php echo e($row->variation_id, false); ?>_<?php echo e($row->location_id, false); ?>"
                                    data-product-id="<?php echo e($row->product_id, false); ?>"
                                    data-variation-id="<?php echo e($row->variation_id, false); ?>"
                                    data-location-id="<?php echo e($row->location_id, false); ?>"
                                    data-available="<?php echo e($row->qty_available, false); ?>">
                                    <?php echo e($row->product_name, false); ?><?php if(!empty($row->variation_name) && $row->variation_name !== 'DUMMY'): ?> (<?php echo e($row->variation_name, false); ?>)<?php endif; ?>
                                    @ <?php echo e($row->location_name ?? '-', false); ?> — <?php echo e(__('lang_v1.available'), false); ?>: <?php echo e(number_format($row->qty_available, 2), false); ?>

                                </option>
                            <?php endif; ?>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </select>
                    <input type="hidden" name="product_id" id="consume_product_id">
                    <input type="hidden" name="variation_id" id="consume_variation_id">
                    <input type="hidden" name="location_id" id="consume_location_id">
                </div>
                <?php if(isset($project->steps) && $project->steps->count() > 0): ?>
                <div class="form-group">
                    <?php echo Form::label('pjt_project_step_id', __('project::lang.project_steps') . ':'); ?>

                    <?php echo Form::select('pjt_project_step_id', $project->steps->pluck('name', 'id'), null, ['class' => 'form-control select2', 'placeholder' => __('messages.please_select'), 'style' => 'width: 100%;']); ?>

                </div>
                <?php endif; ?>
                <div class="form-group">
                    <?php echo Form::label('quantity', __('sale.qty') . ':*'); ?>

                    <?php echo Form::number('quantity', null, ['class' => 'form-control', 'step' => '0.01', 'min' => '0.01', 'required', 'id' => 'consume_quantity']); ?>

                    <small class="text-muted" id="consume_available_hint"></small>
                </div>
                <div class="form-group">
                    <?php echo Form::label('notes', __('lang_v1.additional_notes') . ':'); ?>

                    <?php echo Form::textarea('notes', null, ['class' => 'form-control', 'rows' => 2]); ?>

                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default project-stock-modal-close" data-dismiss="modal" data-bs-dismiss="modal"><?php echo app('translator')->get('messages.close'); ?></button>
                <button type="button" class="btn btn-danger project-stock-modal-submit" data-form="#project_stock_consume_form"><?php echo app('translator')->get('project::lang.confirm_consume'); ?></button>
            </div>
        </div>
        <?php echo Form::close(); ?>

    </div>
</div>

<?php
    $project_return_stock_options = $stock->map(function ($row) {
        $variation = ! empty($row->variation_name) && $row->variation_name !== 'DUMMY' ? ' (' . $row->variation_name . ')' : '';
        $location = ! empty($row->location_name) ? $row->location_name : '-';
        $available = (float) $row->qty_available;

        return [
            'label' => $row->product_name . $variation . ' @ ' . $location . ' - ' . __('lang_v1.available') . ': ' . number_format($available, 2),
            'value' => $row->product_name,
            'product_id' => (int) $row->product_id,
            'variation_id' => (int) $row->variation_id,
            'location_id' => (int) $row->location_id,
            'available' => $available,
            'location_name' => $location,
        ];
    })->values();
?>

<script>
$(function () {
    var __project_id = <?php echo e((int) $project->id, false); ?>;
    var __project_return_stock_options = <?php echo json_encode($project_return_stock_options, 15, 512) ?>;
    // Build the section URL using the named route so we pick up the project module's
    // URL prefix (`/project/...`) correctly. The placeholder is swapped per call.
    var __section_url_tpl = '<?php echo e(route('project.stock.section', ['project_id' => $project->id, 'section' => '__SECTION__']), false); ?>';
    var __request_store_url = '<?php echo e(route('project.stock.request.store', $project->id), false); ?>';
    var __allocate_store_url = '<?php echo e(route('project.stock.allocate', $project->id), false); ?>';
    var __project_show_stock_url = '<?php echo e(action([\Modules\Project\Http\Controllers\ProjectController::class, 'show'], [$project->id]), false); ?>?view=project_stock';
    // Current section is driven by the dropdown-tab in the parent page (show.blade.php).
    var __current_section = null;
    var __project_request_row_index = 0;
    var __project_transfer_row_index = 0;

    function projectStockAppUrl(path) {
        if (typeof projectModuleUrl === 'function') {
            return projectModuleUrl(path);
        }

        var marker = '/project/';
        var pathname = window.location.pathname || '';
        var index = pathname.indexOf(marker);
        if (index !== -1) {
            return window.location.origin + pathname.substring(0, index).replace(/\/$/, '') + path;
        }

        return (typeof base_path !== 'undefined' ? base_path.replace(/\/$/, '') : '') + path;
    }

    function currentFilters() {
        return {
            from: $('#project_stock_filter_from').val() || '',
            to: $('#project_stock_filter_to').val() || '',
            q: $('#project_stock_filter_product').val() || '',
        };
    }

    function loadSection() {
        if (!__current_section) { return; }
        var params = $.param(currentFilters());
        $('#project_stock_filter_bar, #project_stock_search_row').show();
        $('#project_stock_section_body').html('<p class="text-center text-muted"><i class="fa fa-spinner fa-spin"></i> <?php echo app('translator')->get('messages.loading'); ?>…</p>');
        $.ajax({
            url: __section_url_tpl.replace('__SECTION__', encodeURIComponent(__current_section)) + '?' + params + '&_=' + Date.now(),
            method: 'GET',
            cache: false,
            success: function (html) {
                $('#project_stock_section_body').html(html);
                $('#project_stock_section_search').val('').trigger('keyup');
            },
            error: function (xhr) {
                var msg = (xhr.responseText && xhr.responseText.length < 500) ? xhr.responseText : '<?php echo app('translator')->get('messages.something_went_wrong'); ?>';
                $('#project_stock_section_body').html('<div class="alert alert-danger">' + msg + '</div>');
            }
        });
    }

    function showProjectStockModal(selector) {
        var modal = document.querySelector(selector);
        if (!modal) { return; }

        if (!$('.modal.in, .modal.show').length) {
            $('.modal-backdrop').remove();
            $('body').removeClass('modal-open').css('padding-right', '');
        }

        if ($.fn.modal) {
            $(modal).modal('show');
            return;
        }

        if (window.bootstrap && typeof window.bootstrap.Modal === 'function') {
            window.bootstrap.Modal.getOrCreateInstance(modal).show();
        }
    }

    function hideProjectStockModal(selector) {
        var modal = document.querySelector(selector);
        if (!modal) { return; }

        if ($.fn.modal) {
            $(modal).modal('hide');
        }

        if (window.bootstrap && typeof window.bootstrap.Modal === 'function') {
            var instance = window.bootstrap.Modal.getInstance(modal);
            if (instance) { instance.hide(); }
        }

        setTimeout(function () {
            if (!$('.modal.in, .modal.show').length) {
                $('.modal-backdrop').remove();
                $('body').removeClass('modal-open').css('padding-right', '');
            }
        }, 150);
    }

    // Public entry point — called from the Stock dropdown-tab in show.blade.php.
    window.loadProjectStockSection = function (section) {
        if (!section) { return; }
        __current_section = section;
        $('.project-stock-section-link').removeClass('active');
        $('.project-stock-section-link[data-section="' + section + '"]').addClass('active');
        // Clear filters when switching sections so the user gets a fresh view.
        $('#project_stock_filter_from, #project_stock_filter_to, #project_stock_filter_product').val('');
        loadSection();
    };

    $(document).off('click.projectStockRequestOpen').on('click.projectStockRequestOpen', '.open-project-stock-request-modal', function (e) {
        e.preventDefault();
        resetRequestForm();
        showProjectStockModal('#project_stock_request_modal');
    });

    $(document).off('click.projectStockTransferOpen').on('click.projectStockTransferOpen', '.open-project-stock-transfer-modal', function (e) {
        e.preventDefault();
        resetTransferForm();
        showProjectStockModal('#project_stock_transfer_modal');
    });

    $(document).off('click.projectStockReturnOpen').on('click.projectStockReturnOpen', '.open-project-stock-return-modal', function (e) {
        e.preventDefault();
        resetReturnForm();
        showProjectStockModal('#project_stock_return_modal');
    });

    $(document).off('click.projectStockConsumeOpen').on('click.projectStockConsumeOpen', '.open-project-stock-consume-modal', function (e) {
        e.preventDefault();
        showProjectStockModal('#project_stock_consume_modal');
    });

    $(document)
        .off('click.projectStockModalClose')
        .on('click.projectStockModalClose', '.project-stock-modal-close', function (e) {
            e.preventDefault();
            e.stopImmediatePropagation();
            var $modal = $(this).closest('.modal');
            if ($modal.length) {
                hideProjectStockModal('#' + $modal.attr('id'));
            }
        });

    $(document)
        .off('click.projectStockModalSubmit')
        .on('click.projectStockModalSubmit', '.project-stock-modal-submit', function (e) {
            e.preventDefault();
            e.stopImmediatePropagation();

            var formSelector = $(this).data('form');
            var form = formSelector ? document.querySelector(formSelector) : $(this).closest('form')[0];
            if (!form) { return; }

            if (typeof form.reportValidity === 'function' && !form.reportValidity()) {
                return;
            }

            $(form).trigger('submit');
        });

    // Filter / clear handlers (use the section already chosen).
    $(document).on('click', '#project_stock_apply_filters', loadSection);
    $(document).on('keydown', '#project_stock_filter_product', function (e) {
        if (e.key === 'Enter') { e.preventDefault(); loadSection(); }
    });
    $(document).on('click', '#project_stock_clear_filters', function () {
        $('#project_stock_filter_from, #project_stock_filter_to, #project_stock_filter_product').val('');
        loadSection();
    });

    // Within-section search — client-side filter on the already-loaded rows.
    $(document).on('keyup', '#project_stock_section_search', function () {
        var q = $(this).val().toLowerCase().trim();
        $('#project_stock_section_body tbody tr').each(function () {
            var $tr = $(this);
            if (!q) { $tr.show(); return; }
            $tr.toggle($tr.text().toLowerCase().indexOf(q) !== -1);
        });
    });

    // ------- Cancel a pending request (delegated) -------
    function resetRequestForm() {
        var $form = $('#project_stock_request_form');
        $form.attr('action', __request_store_url);
        $form.find('input[name="_method"]').remove();
        $form[0].reset();
        __project_request_row_index = 0;
        clearRequestRows();
        $form.find('select[name="source_location_id"]').val('<?php echo e($project->location_id, false); ?>').trigger('change');
        $form.find('select[name="priority"]').val('normal').trigger('change');
        $('#project_stock_request_modal .modal-title').text('<?php echo app('translator')->get('project::lang.request_stock'); ?>');
    }

    function projectStockEscape(value) {
        return $('<div>').text(value == null ? '' : value).html();
    }

    function clearRequestRows() {
        $('#project_request_product_table tbody').empty();
        $('#project_stock_product_search').val('');
    }

    function addRequestProductRow(item, quantity) {
        var $tbody = $('#project_request_product_table tbody');
        if (!$tbody.length || !item || !item.product_id || !item.variation_id) { return; }

        var existingSelector = 'tr[data-product-id="' + item.product_id + '"][data-variation-id="' + item.variation_id + '"]';
        var $existing = $tbody.find(existingSelector);
        if ($existing.length) {
            var $qty = $existing.find('.project-request-line-qty');
            var current = parseFloat($qty.val() || 0);
            var addQty = parseFloat(quantity || 1);
            var nextQty = current + addQty;
            $qty.val(nextQty.toFixed(2).replace(/\.00$/, ''));
            return;
        }

        var index = __project_request_row_index++;
        var qtyValue = parseFloat(quantity || 1);
        if (isNaN(qtyValue) || qtyValue <= 0) {
            qtyValue = 1;
        }

        var row = ''
            + '<tr data-product-id="' + item.product_id + '" data-variation-id="' + item.variation_id + '">'
            + '<td>'
            + projectStockEscape(item.row_label || item.label || item.product_name || item.value || '')
            + '<input type="hidden" name="products[' + index + '][product_id]" value="' + item.product_id + '">'
            + '<input type="hidden" name="products[' + index + '][variation_id]" value="' + item.variation_id + '">'
            + '</td>'
            + '<td><input type="number" class="form-control input-sm project-request-line-qty" name="products[' + index + '][quantity]" value="' + qtyValue + '" step="0.01" min="0.01" required></td>'
            + '<td class="text-center"><button type="button" class="btn btn-xs btn-danger remove-project-request-row"><i class="fa fa-trash"></i></button></td>'
            + '</tr>';

        $tbody.append(row);
    }

    function clearTransferRows() {
        $('#project_transfer_product_table tbody').empty();
        $('#project_transfer_product_search').val('');
    }

    function addTransferProductRow(item, quantity) {
        var $tbody = $('#project_transfer_product_table tbody');
        if (!$tbody.length || !item || !item.product_id || !item.variation_id) { return; }

        var existingSelector = 'tr[data-product-id="' + item.product_id + '"][data-variation-id="' + item.variation_id + '"]';
        var $existing = $tbody.find(existingSelector);
        if ($existing.length) {
            var $qty = $existing.find('.project-transfer-line-qty');
            var current = parseFloat($qty.val() || 0);
            var addQty = parseFloat(quantity || 1);
            var nextQty = current + addQty;
            var maxQty = parseFloat($qty.attr('max') || 0);
            if (maxQty > 0 && nextQty > maxQty) {
                nextQty = maxQty;
            }
            $qty.val(nextQty.toFixed(2).replace(/\.00$/, ''));
            return;
        }

        var index = __project_transfer_row_index++;
        var available = parseFloat(item.qty_available || item.available || 0);
        var enableStock = parseInt(item.enable_stock == null ? 1 : item.enable_stock);
        var maxAttr = enableStock === 1 ? ' max="' + available + '"' : '';
        var availableText = enableStock === 1 ? available.toFixed(2) : '-';
        var qtyValue = parseFloat(quantity || 1);
        if (enableStock === 1 && available > 0 && qtyValue > available) {
            qtyValue = available;
        }

        var row = ''
            + '<tr data-product-id="' + item.product_id + '" data-variation-id="' + item.variation_id + '">'
            + '<td>'
            + projectStockEscape(item.row_label || item.label || item.product_name || item.value || '')
            + '<input type="hidden" name="products[' + index + '][product_id]" value="' + item.product_id + '">'
            + '<input type="hidden" name="products[' + index + '][variation_id]" value="' + item.variation_id + '">'
            + '</td>'
            + '<td class="text-right">' + projectStockEscape(availableText) + '</td>'
            + '<td><input type="number" class="form-control input-sm project-transfer-line-qty" name="products[' + index + '][quantity]" value="' + qtyValue + '" step="0.01" min="0.01"' + maxAttr + ' required></td>'
            + '<td class="text-center"><button type="button" class="btn btn-xs btn-danger remove-project-transfer-row"><i class="fa fa-trash"></i></button></td>'
            + '</tr>';

        $tbody.append(row);
    }

    function resetTransferForm() {
        var $form = $('#project_stock_transfer_form');
        if (!$form.length) { return; }
        $form.attr('action', __allocate_store_url);
        $form[0].reset();
        $('#project_transfer_stock_request_id').val('');
        __project_transfer_row_index = 0;
        $form.find('select[name="source_location_id"]').val('<?php echo e($project->location_id, false); ?>').trigger('change');
        $form.find('select[name="pjt_project_step_id"]').val('').trigger('change');
        clearTransferRows();
        $('#project_stock_transfer_modal .modal-title').text('<?php echo app('translator')->get('project::lang.transfer_stock_to_project'); ?>');
    }

    function resetReturnForm() {
        var $form = $('#project_stock_return_form');
        if (!$form.length) { return; }
        $form[0].reset();
        $form.find('select[name="to_location_id"]').val('<?php echo e($project->location_id, false); ?>').trigger('change');
        clearReturnProductSelection();
    }

    $(document)
        .off('click.projectStockRequestReset')
        .on('click.projectStockRequestReset', '.open-project-stock-request-modal', resetRequestForm);

    $(document).on('click', '.edit-stock-request', function () {
        var $btn = $(this);
        var $form = $('#project_stock_request_form');

        resetRequestForm();
        $form.attr('action', $btn.data('update-url'));
        $form.append('<input type="hidden" name="_method" value="PUT">');
        addRequestProductRow({
            label: $btn.data('product-name') || '',
            product_id: $btn.data('product-id') || '',
            variation_id: $btn.data('variation-id') || ''
        }, $btn.data('quantity') || 1);
        $form.find('select[name="source_location_id"]').val($btn.data('source-location-id') || '').trigger('change');
        $form.find('select[name="priority"]').val($btn.data('priority') || 'normal').trigger('change');
        $form.find('textarea[name="notes"]').val($btn.data('notes') || '');
        $('#project_stock_request_modal .modal-title').text('<?php echo app('translator')->get('messages.edit'); ?> <?php echo app('translator')->get('project::lang.request_stock'); ?>');
        showProjectStockModal('#project_stock_request_modal');
    });

    $(document).on('click', '.fulfill-stock-request', function (e) {
        e.preventDefault();
        var $btn = $(this);
        resetTransferForm();
        $('#project_transfer_stock_request_id').val($btn.data('request-id') || '');
        if ($btn.data('source-location-id')) {
            $('#project_transfer_source_location_id').val($btn.data('source-location-id')).trigger('change');
        }
        addTransferProductRow({
            label: $btn.data('product-name') || '',
            product_id: $btn.data('product-id') || '',
            variation_id: $btn.data('variation-id') || '',
            enable_stock: 0
        }, $btn.data('quantity') || 1);
        $('#project_stock_transfer_modal .modal-title').text('<?php echo app('translator')->get('project::lang.fulfill'); ?> <?php echo app('translator')->get('project::lang.request_stock'); ?>');
        showProjectStockModal('#project_stock_transfer_modal');
    });

    $(document).on('click', '.remove-project-request-row', function (e) {
        e.preventDefault();
        $(this).closest('tr').remove();
    });

    $(document).on('click', '.remove-project-transfer-row', function (e) {
        e.preventDefault();
        $(this).closest('tr').remove();
    });

    $(document).off('submit.projectStockTransferForm').on('submit.projectStockTransferForm', '#project_stock_transfer_form', function (e) {
        e.preventDefault();
        var $form = $(this);
        if ($('#project_transfer_product_table tbody tr').length <= 0) {
            toastr.warning('<?php echo app('translator')->get('project::lang.no_products_selected_for_transfer'); ?>');
            return false;
        }
        $.ajax({
            url: $form.attr('action'),
            method: 'POST',
            data: $form.serialize(),
            dataType: 'json',
            headers: { 'X-Requested-With': 'XMLHttpRequest' },
            success: function (r) {
                if (r.success) {
                    toastr.success(r.msg);
                    hideProjectStockModal('#project_stock_transfer_modal');
                    window.location.href = __project_show_stock_url;
                } else {
                    toastr.error(r.msg);
                }
            },
            error: function (xhr) {
                var msg = xhr.responseJSON && (xhr.responseJSON.msg || xhr.responseJSON.message)
                    ? (xhr.responseJSON.msg || xhr.responseJSON.message) : '<?php echo app('translator')->get('messages.something_went_wrong'); ?>';
                toastr.error(msg);
            }
        });
        return false;
    });

    $(document).off('submit.projectStockRequestForm').on('submit.projectStockRequestForm', '#project_stock_request_form', function (e) {
        e.preventDefault();
        var $form = $(this);
        if ($('#project_request_product_table tbody tr').length <= 0) {
            toastr.warning('<?php echo app('translator')->get('project::lang.no_products_selected_for_request'); ?>');
            return false;
        }
        $.ajax({
            url: $form.attr('action'),
            method: 'POST',
            data: $form.serialize(),
            dataType: 'json',
            headers: { 'X-Requested-With': 'XMLHttpRequest' },
            success: function (r) {
                if (r.success) {
                    toastr.success(r.msg);
                    hideProjectStockModal('#project_stock_request_modal');
                    resetRequestForm();
                    loadSection();
                } else {
                    toastr.error(r.msg);
                }
            },
            error: function (xhr) {
                var json = xhr.responseJSON || {};
                var msg = json.msg || json.message || '<?php echo app('translator')->get('messages.something_went_wrong'); ?>';
                if (json.errors) {
                    $.each(json.errors, function (field, messages) {
                        msg = $.isArray(messages) ? messages[0] : messages;
                        return false;
                    });
                }
                toastr.error(msg);
            }
        });
        return false;
    });

    $(document).off('submit.projectStockReturnForm').on('submit.projectStockReturnForm', '#project_stock_return_form', function (e) {
        e.preventDefault();
        var $form = $(this);
        $.ajax({
            url: $form.attr('action'),
            method: 'POST',
            data: $form.serialize(),
            dataType: 'json',
            headers: { 'X-Requested-With': 'XMLHttpRequest' },
            success: function (r) {
                if (r.success) {
                    toastr.success(r.msg);
                    hideProjectStockModal('#project_stock_return_modal');
                    resetReturnForm();
                    loadSection();
                } else {
                    toastr.error(r.msg);
                }
            },
            error: function (xhr) {
                var msg = xhr.responseJSON && (xhr.responseJSON.msg || xhr.responseJSON.message)
                    ? (xhr.responseJSON.msg || xhr.responseJSON.message) : '<?php echo app('translator')->get('messages.something_went_wrong'); ?>';
                toastr.error(msg);
            }
        });
        return false;
    });

    $(document).on('click', '.cancel-stock-request', function () {
        var url = $(this).data('href');
        if (!confirm(LANG.sure || 'Are you sure?')) return;
        $.ajax({
            url: url, method: 'DELETE', dataType: 'json',
            success: function (r) {
                if (r.success) { toastr.success(r.msg); loadSection(); }
                else { toastr.error(r.msg); }
            }
        });
    });

    // ------- Select2 inside modals -------
    function initModalSelect2($modal) {
        if (!$modal || !$modal.length || typeof $.fn.select2 !== 'function') return;
        $modal.find('select.select2').each(function () {
            var $sel = $(this);
            if ($sel.hasClass('select2-hidden-accessible')) { $sel.select2('destroy'); }
            $sel.select2({
                dropdownParent: $modal,
                width: '100%',
                placeholder: $sel.attr('placeholder') || $sel.find('option[value=""]').text() || ''
            });
        });
    }
    $(document).on('shown.bs.modal',
        '#project_stock_transfer_modal, #project_stock_request_modal, #project_stock_return_modal, #project_stock_consume_modal',
        function () { initModalSelect2($(this)); }
    );

    // ------- Consume modal helpers -------
    function syncConsumeSelection() {
        var $opt = $('#consume_line option:selected');
        if (!$opt.length || !$opt.val()) {
            $('#consume_product_id, #consume_variation_id, #consume_location_id').val('');
            $('#consume_quantity').attr('max', '');
            $('#consume_available_hint').text('');
            return;
        }
        $('#consume_product_id').val($opt.data('product-id'));
        $('#consume_variation_id').val($opt.data('variation-id'));
        $('#consume_location_id').val($opt.data('location-id'));
        var avail = parseFloat($opt.data('available'));
        $('#consume_quantity').attr('max', avail);
        $('#consume_available_hint').text('<?php echo app('translator')->get('lang_v1.available'); ?>: ' + avail.toFixed(2));
    }
    $(document).on('change', '#consume_line', syncConsumeSelection);
    $(document).on('shown.bs.modal', '#project_stock_consume_modal', syncConsumeSelection);

    $(document).off('submit.projectStockConsumeForm').on('submit.projectStockConsumeForm', '#project_stock_consume_form', function (e) {
        e.preventDefault();
        var sureMessage = (typeof LANG !== 'undefined' && LANG.sure) ? LANG.sure : 'Are you sure?';
        if (!confirm(sureMessage)) return false;
        var $form = $(this);
        $.post($form.attr('action'), $form.serialize(), function (r) {
            if (r.success) { toastr.success(r.msg); location.reload(); }
            else { toastr.error(r.msg); }
        }, 'json').fail(function (xhr) {
            var msg = xhr.responseJSON && xhr.responseJSON.msg
                ? xhr.responseJSON.msg : '<?php echo app('translator')->get('messages.something_went_wrong'); ?>';
            toastr.error(msg);
        });
        return false;
    });

    // ------- Product autocomplete inside Request / Return modals -------
    function bindRequestProductSearch() {
        var $input = $('#project_stock_product_search');
        if (!$input.length || $input.data('autocomplete-bound')) return;
        $input.data('autocomplete-bound', true);

        $input.autocomplete({
            appendTo: '#project_stock_request_modal',
            source: function (request, response) {
                $.ajax({
                    url: projectStockAppUrl('/products/list'),
                    dataType: 'json',
                    headers: { 'X-Requested-With': 'XMLHttpRequest' },
                    data: { term: request.term, not_for_selling: 0 },
                    success: function (data) {
                        response($.map(data || [], function (p) {
                            var label = p.name
                                + (p.variation && p.variation !== 'DUMMY' ? ' - ' + p.variation : '')
                                + (p.sub_sku ? ' (' + p.sub_sku + ')' : '');
                            return {
                                label: label,
                                row_label: label,
                                value: p.name,
                                product_id: p.product_id,
                                variation_id: p.variation_id
                            };
                        }));
                    },
                    error: function () { response([]); }
                });
            },
            minLength: 1,
            select: function (e, ui) {
                addRequestProductRow(ui.item, 1);
                $(this).val('');
                return false;
            }
        });
    }

    function bindTransferProductSearch() {
        var $input = $('#project_transfer_product_search');
        if (!$input.length || $input.data('autocomplete-bound')) return;
        $input.data('autocomplete-bound', true);

        $input.autocomplete({
            appendTo: '#project_stock_transfer_modal',
            source: function (request, response) {
                $.ajax({
                    url: projectStockAppUrl('/products/list'),
                    dataType: 'json',
                    headers: { 'X-Requested-With': 'XMLHttpRequest' },
                    data: {
                        term: request.term,
                        location_id: $('#project_transfer_source_location_id').val(),
                        product_types: ['single', 'variable']
                    },
                    success: function (data) {
                        response($.map(data || [], function (p) {
                            var rowLabel = p.name
                                + (p.variation && p.variation !== 'DUMMY' ? ' - ' + p.variation : '')
                                + (p.sub_sku ? ' (' + p.sub_sku + ')' : '');
                            var label = rowLabel;
                            var qty = parseFloat(p.qty_available || 0);
                            if (p.enable_stock == 1) {
                                label += ' - <?php echo app('translator')->get('lang_v1.available'); ?>: ' + qty.toFixed(2);
                            }
                            return {
                                label: label,
                                row_label: rowLabel,
                                value: p.name,
                                product_id: p.product_id,
                                variation_id: p.variation_id,
                                qty_available: qty,
                                enable_stock: p.enable_stock
                            };
                        }));
                    },
                    error: function () { response([]); }
                });
            },
            minLength: 1,
            select: function (e, ui) {
                if (parseInt(ui.item.enable_stock) === 1 && parseFloat(ui.item.qty_available || 0) <= 0) {
                    toastr.error(typeof LANG !== 'undefined' && LANG.out_of_stock ? LANG.out_of_stock : 'Out of stock');
                    $(this).val('');
                    return false;
                }
                addTransferProductRow(ui.item, 1);
                $(this).val('');
                return false;
            }
        });
    }

    $(document).on('change', '#project_transfer_source_location_id', function () {
        clearTransferRows();
    });

    function clearReturnProductSelection() {
        $('#project_return_product_id, #project_return_variation_id, #project_return_from_location_id').val('');
        $('#project_return_quantity').attr('max', '');
        $('#project_return_available_hint').text('');
    }

    function bindProjectReturnStockSearch() {
        var $input = $('#project_return_product_search');
        if (!$input.length || $input.data('autocomplete-bound')) return;
        $input.data('autocomplete-bound', true);

        $input.autocomplete({
            appendTo: '#project_stock_return_modal',
            minLength: 0,
            source: function (request, response) {
                var term = (request.term || '').toLowerCase();
                var matches = $.grep(__project_return_stock_options || [], function (item) {
                    return !term || item.label.toLowerCase().indexOf(term) !== -1;
                });
                response(matches);
            },
            select: function (e, ui) {
                $('#project_return_product_id').val(ui.item.product_id);
                $('#project_return_variation_id').val(ui.item.variation_id);
                $('#project_return_from_location_id').val(ui.item.location_id);
                $('#project_return_quantity').attr('max', ui.item.available);
                $('#project_return_available_hint').text('<?php echo app('translator')->get('lang_v1.available'); ?>: ' + parseFloat(ui.item.available).toFixed(2));
                $(this).val(ui.item.label);
                return false;
            },
            change: function () {
                if (!$('#project_return_product_id').val()) {
                    clearReturnProductSelection();
                }
            }
        }).on('focus', function () {
            $(this).autocomplete('search', $(this).val());
        }).on('input', clearReturnProductSelection);
    }

    $(document).on('shown.bs.modal', '#project_stock_request_modal', function () {
        bindRequestProductSearch();
    });
    $(document).on('shown.bs.modal', '#project_stock_transfer_modal', function () {
        bindTransferProductSearch();
    });
    $(document).on('shown.bs.modal', '#project_stock_return_modal', function () {
        bindProjectReturnStockSearch();
    });
});
</script>
