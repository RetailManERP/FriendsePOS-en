

<?php $__env->startSection('title', __('accounting::lang.chart_of_accounts')); ?>

<?php $__env->startSection('content'); ?>
<?php $__env->startSection('css'); ?>
<style>
    #create_account_modal .modal-dialog {
        max-height: calc(100vh - 3.5rem);
    }

    #create_account_modal .modal-content {
        overflow: hidden;
    }

    #create_account_modal .modal-content > form {
        display: flex;
        flex-direction: column;
        max-height: calc(100vh - 3.5rem);
        min-height: 0;
    }

    #create_account_modal .modal-header,
    #create_account_modal .modal-footer {
        flex: 0 0 auto;
        position: sticky;
        z-index: 3;
        background: #fff;
    }

    #create_account_modal .modal-header {
        top: 0;
    }

    #create_account_modal .modal-footer {
        bottom: 0;
    }

    #create_account_modal .modal-body {
        flex: 1 1 auto;
        min-height: 0;
        overflow: auto;
    }
</style>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('accounting::layouts.nav', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<!-- Content Header (Page header) -->
<section class="content-header">
    <h1><?php echo app('translator')->get( 'accounting::lang.chart_of_accounts' ); ?></h1>
</section>
<section class="content">
    <div class="row mb-12">
        <div class="col-md-12">
            <div class="btn-group btn-group-toggle" data-bs-toggle="buttons">
                <label class="btn btn-info active">
                    <input type="radio" name="view_type" value="tree" class="view_type">
                    <i class="fas fa-list-ul"></i> <?php echo app('translator')->get('accounting::lang.tree_view'); ?>
                </label>
                <label class="btn btn-info">
                    <input type="radio" name="view_type" value="table" class="view_type">
                    <i class="fas fa-table"></i> <?php echo app('translator')->get('accounting::lang.tabular_view'); ?>
                </label>
                
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <?php $__env->startComponent('components.widget', ['class' => 'box-primary']); ?>
            <?php $__env->slot('tool'); ?>
                <div class="box-tools">
                    <a class="btn btn-primary btn-sm float-end btn-modal" 
                    href="<?php echo e(action([\Modules\Accounting\Http\Controllers\CoaController::class, 'create']), false); ?>" 
                    data-href="<?php echo e(action([\Modules\Accounting\Http\Controllers\CoaController::class, 'create']), false); ?>" 
                    data-container="#create_account_modal">
                    <i class="fas fa-plus"></i> <?php echo app('translator')->get( 'messages.add' ); ?></a>
                </div>
            <?php $__env->endSlot(); ?>
                <div id="accounts_tree"></div>
                <div id="tabular_view" class="hide">
                    <div class="row">
                        <div class="col-md-12">
                            <?php $__env->startComponent('components.filters', ['title' => __('report.filters')]); ?>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <?php echo Form::label('account_type_filter', __( 'accounting::lang.account_type' ) . ':'); ?>

                                        <?php echo Form::select('account_type_filter', $account_types, null,
                                            ['class' => 'form-control select2', 'style' => 'width:100%', 
                                            'id' => 'account_type_filter', 'placeholder' => __('lang_v1.all')]); ?>

                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <?php echo Form::label('status_filter', __( 'sale.status' ) . ':'); ?>

                                        <?php echo Form::select('status_filter', ['active' => __( 'accounting::lang.active' ),
                                            'inactive' => __('lang_v1.inactive')], null,
                                            ['class' => 'form-control select2', 'style' => 'width:100%', 
                                            'id' => 'status_filter', 'placeholder' => __('lang_v1.all')]); ?>

                                    </div>
                                </div>
                            <?php echo $__env->renderComponent(); ?>
                        </div>
                    </div>
                    <div class="table-responsive" id="accounts_table">
                    </div>
                </div>
            <?php echo $__env->renderComponent(); ?>
        </div>
    </div>
</section>
<div class="modal fade" id="create_account_modal" tabindex="-1" role="dialog">
</div>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('javascript'); ?>
<script type="text/javascript">
	$(document).ready( function(){
        load_accounts_table();
        load_accounts_table('tree');
	});

    $(document).on('change', '#account_type_filter, #status_filter', function(){
        load_accounts_table();
    });

    $('input[type=radio][name=view_type]').change(function() {
        if (this.value == 'tree') {
            $('#accounts_tree').removeClass('hide');
            $('#tabular_view').addClass('hide');
        }
        else if (this.value == 'table') {
            $('#accounts_tree').addClass('hide');
            $('#tabular_view').removeClass('hide');
        }
    });

    function load_accounts_table(view_type='table'){
        var data = {view_type: view_type};

        if($('#account_type_filter').val()!== ''){
            data.account_type = $('#account_type_filter').val();
        }
        if($('#status_filter').val()!== ''){
            data.status = $('#status_filter').val();
        }
        $.ajax({
            url: '/accounting/chart-of-accounts',
            data: data,
            dataType: 'html',
            success: function(html) {
                if(view_type=='table') {
                    $('#accounts_table').html(html);
                } else {
                    $('#accounts_tree').html(html);
                    initCoaTree();
                }
            },
        });
    };

    function initCoaTree() {
        // Toggle type headers (level 1)
        $(document).off('click.coaType').on('click.coaType', '.coa-type-header', function(e) {
            $(this).toggleClass('collapsed');
        });

        // Toggle sub-type headers (level 2)
        $(document).off('click.coaSubtype').on('click.coaSubtype', '.coa-subtype-header', function(e) {
            $(this).toggleClass('collapsed');
        });

        // Toggle child accounts (level 3→4)
        $(document).off('click.coaChildren').on('click.coaChildren', '.coa-parent-toggle', function(e) {
            e.stopPropagation();
            $(this).toggleClass('collapsed');
            var $icon = $(this).find('i');
            if ($(this).hasClass('collapsed')) {
                $icon.css('transform', 'rotate(-90deg)');
                $(this).closest('.coa-account-item').next('.coa-children').slideUp(200);
            } else {
                $icon.css('transform', 'rotate(0deg)');
                $(this).closest('.coa-account-item').next('.coa-children').slideDown(200);
            }
        });

        // Search
        var searchTimeout = null;
        $(document).off('keyup.coaSearch').on('keyup.coaSearch', '#coa_tree_search', function() {
            var q = $(this).val().toLowerCase().trim();
            if (searchTimeout) clearTimeout(searchTimeout);
            searchTimeout = setTimeout(function() {
                if (q === '') {
                    // Show everything
                    $('.coa-account-item, .coa-children, .coa-subtype-group, .coa-type-group').removeClass('coa-search-hidden coa-search-match');
                    $('.coa-children').show();
                    return;
                }
                // First hide all, then reveal matches
                $('.coa-account-item').each(function() {
                    var name = $(this).attr('data-coa-name') || '';
                    if (name.indexOf(q) !== -1) {
                        $(this).removeClass('coa-search-hidden').addClass('coa-search-match');
                    } else {
                        $(this).addClass('coa-search-hidden').removeClass('coa-search-match');
                    }
                });
                // Show children containers that have visible items
                $('.coa-children').each(function() {
                    if ($(this).find('.coa-account-item:not(.coa-search-hidden)').length) {
                        $(this).show().removeClass('coa-search-hidden');
                    } else {
                        $(this).hide();
                    }
                });
                // Show parent account-items if their children are visible
                $('.coa-children:visible').each(function() {
                    $(this).prev('.coa-account-item').removeClass('coa-search-hidden');
                });
                // Show/hide subtypes
                $('.coa-subtype-group').each(function() {
                    var $body = $(this).find('.coa-subtype-body');
                    if ($body.find('.coa-account-item:not(.coa-search-hidden)').length) {
                        $(this).removeClass('coa-search-hidden');
                        $(this).find('.coa-subtype-header').removeClass('collapsed');
                    } else {
                        $(this).addClass('coa-search-hidden');
                    }
                });
                // Show/hide types
                $('.coa-type-group').each(function() {
                    if ($(this).find('.coa-subtype-group:not(.coa-search-hidden)').length) {
                        $(this).removeClass('coa-search-hidden');
                        $(this).find('.coa-type-header').removeClass('collapsed');
                    } else {
                        $(this).addClass('coa-search-hidden');
                    }
                });
            }, 250);
        });

        // Stop dropdown clicks from toggling parent
        $(document).off('click.coaActions').on('click.coaActions', '.coa-node-actions .dropdown-toggle, .coa-node-actions .dropdown-menu a', function(e) {
            e.stopPropagation();
        });
    }

    // Expand all
    $(document).on('click', '#expand_all', function(e){
        $('.coa-type-header, .coa-subtype-header').removeClass('collapsed');
        $('.coa-parent-toggle').removeClass('collapsed').find('i').css('transform', 'rotate(0deg)');
        $('.coa-children').slideDown(200);
    });

    // Collapse all
    $(document).on('click', '#collapse_all', function(e){
        $('.coa-type-header, .coa-subtype-header').addClass('collapsed');
        $('.coa-parent-toggle').addClass('collapsed').find('i').css('transform', 'rotate(-90deg)');
        $('.coa-children').slideUp(200);
    });

    $(document).on('shown.bs.modal', '#create_account_modal', function(){
        $(this).find('#account_sub_type').select2({
            dropdownParent: $('#create_account_modal')
        });
        $(this).find('#detail_type').select2({
            dropdownParent: $('#create_account_modal')
        });
        $(this).find('#parent_account').select2({
            dropdownParent: $('#create_account_modal')
        });
        $('#as_of').datepicker({
            autoclose: true,
            endDate: 'today',
        });
        init_tinymce('description');
        
    });

    $(document).on('hidden.bs.modal', '#create_account_modal', function(){
        tinymce.remove("#description");
    });
    $(document).on('change', '#account_primary_type', function(){
        if($(this).val() !== '') {
            $.ajax({
                url: '/accounting/get-account-sub-types?account_primary_type=' + $(this).val(),
                dataType: 'json',
                success: function(result) {
                    $('#account_sub_type').select2('destroy')
                        .empty()
                        .select2({
                            data: result.sub_types,
                            dropdownParent: $('#create_account_modal'),
                        }).on('change', function() {
                            if($(this).select2('data')[0].show_balance==1) {
                                $('#bal_div').removeClass('hide');
                            } else {
                                $('#bal_div').addClass('hide');
                            }
                        });
                        $('#account_sub_type').change();
                },
            });
        }
    });
    $(document).on('change', '#account_sub_type', function(){
        if($(this).val() !== '') {
            $.ajax({
                url: '/accounting/get-account-details-types?account_type_id=' + $(this).val(),
                dataType: 'json',
                success: function(result) {
                    $('#detail_type').select2('destroy')
                            .empty()
                            .select2({
                                data: result.detail_types,
                                dropdownParent: $('#create_account_modal'),
                            }).on('change', function() {
                                if($(this).val() !== '') {
                                    var desc = $(this).select2('data')[0].description;
                                    $('#detail_type_desc').html(desc);
                                }
                            });
                        var $parent_account = $('#parent_account');
                        $parent_account.select2('destroy').empty();
                        $.each(result.parent_accounts, function(index, account) {
                            $parent_account.append(new Option(account.text, account.id, false, false));
                        });
                        $parent_account.select2({
                            dropdownParent: $('#create_account_modal'),
                        });
                },
            });
        }
    });
    $(document).on('change', '#name', function(){
        if($(this).val() !== '') {
            $.ajax({
                url: '/accounting/check-account-name?name=' + $(this).val(),
                dataType: 'json',
                success: function(result) {
                    if(result){
                        toastr.warning('Account with Same Name Exists');
                    }
                },
            });
        }
    });

    $(document).on('click', 'a.activate-deactivate-btn', function(e) {
        e.preventDefault();
        $.ajax({
            url: $(this).attr('href'),
            dataType: 'json',
            success: function(response) {
                toastr.success(response.msg);
                load_accounts_table();
                load_accounts_table('tree');
            },
        });
    })
    $(document).on('click', 'a.ledger-link', function(e) {
        window.location.href = $(this).attr('href');
    });
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>