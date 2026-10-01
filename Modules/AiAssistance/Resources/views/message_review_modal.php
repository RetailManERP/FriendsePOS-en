<div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" 
            aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title"><?php echo app('translator')->get('aiassistance::lang.ai_generated_message'); ?></h4>
        </div>
        <div class="modal-body"> 
            <div class="form-group">
                <label for="generated_message"><?php echo app('translator')->get('superadmin::lang.message'); ?></label>
                <div id="message_text" class="message_text" style="background: #f8f9fa; padding: 20px; border-radius: 8px; border: 1px solid #dee2e6; min-height: 200px; white-space: pre-wrap; font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; line-height: 1.6;"><?php echo e($message, false); ?></div>
            </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-info" id="copy_message_btn">
                <i class="fa fa-copy"></i> <?php echo app('translator')->get('aiassistance::lang.copy_message'); ?>
            </button>
            <button type="button" class="btn btn-default" data-dismiss="modal">
                <?php echo app('translator')->get('messages.close'); ?>
            </button>
        </div>
    </div>
</div>
