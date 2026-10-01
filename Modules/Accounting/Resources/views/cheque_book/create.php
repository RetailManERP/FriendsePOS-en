<div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
        <?php echo Form::open(['url' => action([\Modules\Accounting\Http\Controllers\ChequeBookController::class, 'store']),
            'method' => 'post', 'id' => 'cheque_book_form']); ?>


        <div class="modal-header">
            <h4 class="modal-title"><?php echo app('translator')->get('accounting::lang.add_cheque_book'); ?></h4>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>

        <div class="modal-body">
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <?php echo Form::label('accounting_account_id', __('accounting::lang.bank_account') . ':*'); ?>

                        <select name="accounting_account_id" id="bank_account_select" class="form-control" required style="width:100%">
                            <option value=""><?php echo e(__('messages.please_select'), false); ?></option>
                            <?php $__currentLoopData = $bank_accounts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $acc): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($acc['id'], false); ?>"
                                    data-account-number="<?php echo e($acc['account_number'], false); ?>"
                                    data-bank-name="<?php echo e($acc['bank_name'], false); ?>"
                                    data-bank-account-number="<?php echo e($acc['bank_account_number'], false); ?>"
                                    data-gl-code="<?php echo e($acc['gl_code'], false); ?>">
                                    <?php echo e($acc['name'], false); ?>

                                </option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <?php echo Form::label('cheque_book_no', __('accounting::lang.cheque_book_no') . ':*'); ?>

                        <?php echo Form::text('cheque_book_no', null, ['class' => 'form-control', 'required',
                            'placeholder' => __('accounting::lang.cheque_book_no_placeholder')]); ?>

                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-4">
                    <div class="form-group">
                        <?php echo Form::label('prefix', __('accounting::lang.prefix') . ':'); ?>

                        <?php echo Form::text('prefix', null, ['class' => 'form-control',
                            'placeholder' => __('accounting::lang.prefix_placeholder')]); ?>

                        <p class="help-block text-muted"><?php echo app('translator')->get('accounting::lang.prefix_help'); ?></p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <?php echo Form::label('start_number', __('accounting::lang.start_number') . ':*'); ?>

                        <?php echo Form::number('start_number', null, ['class' => 'form-control', 'required', 'min' => 1,
                            'placeholder' => __('accounting::lang.start_number_placeholder')]); ?>

                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <?php echo Form::label('end_number', __('accounting::lang.end_number') . ':*'); ?>

                        <?php echo Form::number('end_number', null, ['class' => 'form-control', 'required', 'min' => 2,
                            'placeholder' => __('accounting::lang.end_number_placeholder')]); ?>

                    </div>
                </div>
            </div>

            
            <div class="row">
                <div class="col-md-12">
                    <div class="alert alert-info" id="cheque_preview" style="display:none;">
                        <i class="fas fa-info-circle"></i>
                        <span id="cheque_preview_text"></span>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                        <?php echo Form::label('note', __('accounting::lang.note') . ':'); ?>

                        <?php echo Form::textarea('note', null, ['class' => 'form-control', 'rows' => 2,
                            'placeholder' => __('accounting::lang.cheque_book_note_placeholder')]); ?>

                    </div>
                </div>
            </div>
        </div>

        <div class="modal-footer">
            <button type="submit" class="btn btn-primary">
                <i class="fas fa-save"></i> <?php echo app('translator')->get('messages.save'); ?>
            </button>
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"><?php echo app('translator')->get('messages.close'); ?></button>
        </div>

        <?php echo Form::close(); ?>

    </div>
</div>

<script>
    // Enhanced Select2 for bank account with rich search & display
    $(document).ready(function() {
        var $modal = $('#bank_account_select').closest('.modal');
        if (!$modal.length) {
            $modal = $('#bank_account_select').closest('.modal-content').parent();
        }

        var $select = $('#bank_account_select').select2({
            dropdownParent: $modal.length ? $modal : $('body'),
            allowClear: true,
            width: '100%',
            placeholder: '<?php echo e(__("messages.please_select"), false); ?>',
            templateResult: function(option) {
                if (!option.id) return option.text;
                var $el = $(option.element);
                var name = option.text;
                var accNum = $el.data('account-number') || '';
                var bankName = $el.data('bank-name') || '';
                var bankAccNum = $el.data('bank-account-number') || '';
                var glCode = $el.data('gl-code') || '';

                var $container = $('<div class="py-1"></div>');
                var $title = $('<div style="font-weight:600;"></div>').text(name);
                $container.append($title);

                var details = [];
                if (accNum) details.push('Acc#: ' + accNum);
                if (bankName) details.push(bankName);
                if (bankAccNum) details.push('Bank A/C: ' + bankAccNum);
                if (glCode) details.push('GL: ' + glCode);

                if (details.length) {
                    var $meta = $('<div style="font-size:0.85em;color:#6c757d;"></div>').text(details.join(' | '));
                    $container.append($meta);
                }
                return $container;
            },
            templateSelection: function(option) {
                if (!option.id) return option.text;
                var $el = $(option.element);
                var name = option.text;
                var accNum = $el.data('account-number') || '';
                return accNum ? name + ' (' + accNum + ')' : name;
            },
            matcher: function(params, data) {
                if ($.trim(params.term) === '') return data;
                var term = params.term.toLowerCase();
                var searchable = (data.text || '').toLowerCase();
                if (data.element) {
                    var el = $(data.element);
                    searchable += ' ' + (el.data('account-number') || '').toString().toLowerCase();
                    searchable += ' ' + (el.data('bank-name') || '').toString().toLowerCase();
                    searchable += ' ' + (el.data('bank-account-number') || '').toString().toLowerCase();
                    searchable += ' ' + (el.data('gl-code') || '').toString().toLowerCase();
                }
                if (searchable.indexOf(term) > -1) return data;
                return null;
            }
        });

        // Auto-focus the search field when dropdown opens
        $select.on('select2:open', function() {
            setTimeout(function() {
                var $searchField = document.querySelector('.select2-container--open .select2-search__field');
                if ($searchField) {
                    $searchField.focus();
                }
            }, 0);
        });
    });

    // Preview cheque number range
    function updateChequePreview() {
        var prefix = $('input[name="prefix"]').val() || '';
        var start = parseInt($('input[name="start_number"]').val()) || 0;
        var end = parseInt($('input[name="end_number"]').val()) || 0;
        
        if (start > 0 && end > start) {
            var padLen = end.toString().length;
            var first = prefix + start.toString().padStart(padLen, '0');
            var last = prefix + end.toString().padStart(padLen, '0');
            var total = end - start + 1;
            $('#cheque_preview_text').html(
                '<strong><?php echo e(__("accounting::lang.cheque_range_preview"), false); ?>:</strong> ' +
                first + ' → ' + last + ' (' + total + ' <?php echo e(__("accounting::lang.leaves"), false); ?>)'
            );
            $('#cheque_preview').show();
        } else {
            $('#cheque_preview').hide();
        }
    }
    
    $('input[name="prefix"], input[name="start_number"], input[name="end_number"]').on('input', updateChequePreview);
</script>
