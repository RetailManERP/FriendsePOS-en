<div class="modal-dialog" role="document">
    <div class="modal-content">
        <div class="modal-header">
            <h4 class="modal-title"><?php echo app('translator')->get('superadmin::lang.agreement_url'); ?></h4>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <div class="mb-3">
                <input type="text" class="form-control" value="<?php echo e($url, false); ?>" id="agreement_url" readonly>
                <p class="help-block"><?php echo app('translator')->get('superadmin::lang.agreement_url_help'); ?></p>
            </div>
        </div>
        <div class="modal-footer">
            <button type="button" id="copy_agreement_url" class="btn btn-info">
                <i class="fas fa-copy"></i> <?php echo app('translator')->get('lang_v1.copy'); ?>
            </button>
            <a href="<?php echo e($url, false); ?>" target="_blank" rel="noopener" class="btn btn-primary">
                <?php echo app('translator')->get('messages.view'); ?>
            </a>
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"><?php echo app('translator')->get('messages.close'); ?></button>
        </div>
    </div>
</div>

<script type="text/javascript">
    $('input#agreement_url').click(function(){
        $(this).select().focus();
    });

    $('button#copy_agreement_url').click(function(){
        var agreementUrl = $('input#agreement_url').val();
        var button = $(this);

        if (navigator.clipboard) {
            navigator.clipboard.writeText(agreementUrl);
        } else {
            $('input#agreement_url').select();
            document.execCommand('copy');
        }

        button.data('original-text', button.html());
        button.html('<i class="fas fa-check"></i> <?php echo app('translator')->get('superadmin::lang.copied'); ?>');
        setTimeout(function(){
            button.html(button.data('original-text'));
        }, 1500);
    });
</script>
