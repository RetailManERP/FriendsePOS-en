<div class="modal-dialog" role="document">
    <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            <h4 class="modal-title"><?php echo app('translator')->get('aiassistance::lang.generate_product_description'); ?></h4>
        </div>
        <div class="modal-body">
            <div class="row">
                <div class="col-sm-12">
                    <div class="form-group">
                        <?php
                            $class = rand();
                        ?>
                        <div>
                            <div id="<?php echo e($class, false); ?>" class="product_description_text"><?php echo nl2br($text); ?></div>
                            <i class="fas fa-copy pull-right cursor-pointer" onclick="copyToClipboard(<?php echo e($class, false); ?>)"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="modal-footer">
            <button type="button" class="btn btn-primary" id="use_description">
                <i class="fa fa-check"></i> <?php echo app('translator')->get('aiassistance::lang.use_description'); ?>
            </button>
            <button type="button" class="btn btn-default" data-dismiss="modal">
                <?php echo app('translator')->get('messages.close'); ?>
            </button>
        </div>
    </div>
</div>
<script>
