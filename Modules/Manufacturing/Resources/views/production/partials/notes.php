
<div class="production-notes-container">
    <?php if($notes->count() > 0): ?>
        <div class="timeline-container" style="max-height: 400px; overflow-y: auto;">
            <?php $__currentLoopData = $notes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $note): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div class="d-flex mb-3 border-bottom pb-2">
                    <div class="flex-shrink-0 me-2">
                        <span class="badge <?php echo e($note->note_type_badge, false); ?> rounded-pill">
                            <?php if($note->note_type == 'status_change'): ?>
                                <i class="fas fa-exchange-alt"></i>
                            <?php elseif($note->note_type == 'quality_check'): ?>
                                <i class="fas fa-clipboard-check"></i>
                            <?php elseif($note->note_type == 'cost_update'): ?>
                                <i class="fas fa-dollar-sign"></i>
                            <?php else: ?>
                                <i class="fas fa-comment"></i>
                            <?php endif; ?>
                        </span>
                    </div>
                    <div class="flex-grow-1">
                        <p class="mb-1"><?php echo e($note->note, false); ?></p>
                        <small class="text-muted">
                            <i class="fas fa-user"></i> <?php echo e($note->user ? ($note->user->first_name . ' ' . $note->user->last_name) : __('lang_v1.system'), false); ?>

                            &middot;
                            <i class="fas fa-clock"></i> <?php echo e($note->created_at->diffForHumans(), false); ?>

                            (<?php echo format_datetime_br($note->created_at); ?>)
                        </small>
                    </div>
                </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
    <?php else: ?>
        <p class="text-muted text-center"><i class="fas fa-info-circle"></i> <?php echo app('translator')->get('manufacturing::lang.no_notes_yet'); ?></p>
    <?php endif; ?>

    
    <hr>
    <form id="add_production_note_form">
        <div class="input-group">
            <input type="text" name="note" class="form-control" placeholder="<?php echo app('translator')->get('manufacturing::lang.add_note_placeholder'); ?>" required maxlength="1000">
            <input type="hidden" name="transaction_id" value="<?php echo e($transaction->id, false); ?>">
            <button type="submit" class="btn btn-primary">
                <i class="fas fa-paper-plane"></i>
            </button>
        </div>
    </form>
</div>

<script>
    $('#add_production_note_form').on('submit', function(e) {
        e.preventDefault();
        var form = $(this);
        var note = form.find('input[name="note"]').val();
        var transaction_id = form.find('input[name="transaction_id"]').val();
        
        if (!note.trim()) return;

        $.ajax({
            method: 'POST',
            url: '/manufacturing/production/' + transaction_id + '/notes',
            data: {
                note: note,
                note_type: 'comment',
                _token: $('meta[name="csrf-token"]').attr('content')
            },
            dataType: 'json',
            success: function(result) {
                if (result.success) {
                    toastr.success(result.msg);
                    // Reload notes
                    $.get('/manufacturing/production/' + transaction_id + '/notes', function(html) {
                        form.closest('.production-notes-container').parent().html(html);
                    });
                } else {
                    toastr.error(result.msg);
                }
            }
        });
    });
</script>
