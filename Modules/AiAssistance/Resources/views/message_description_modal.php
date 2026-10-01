<div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" 
            aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title"><?php echo app('translator')->get('aiassistance::lang.generate_ai_message'); ?></h4>
        </div>
        <div class="modal-body">
            <form id="message_description_form">
                <div class="form-group">
                    <label for="message_description"><?php echo app('translator')->get('aiassistance::lang.message_description'); ?> <span class="text-danger">*</span></label>
                    <textarea 
                        class="form-control" 
                        id="message_description" 
                        name="message_description" 
                        rows="8" 
                        placeholder="<?php echo app('translator')->get('aiassistance::lang.message_description_placeholder'); ?>"
                        required
                    ></textarea>
                    <small class="form-text text-muted">
                        <?php echo app('translator')->get('aiassistance::lang.message_description_help'); ?>
                    </small>
                </div>
                
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label><?php echo app('translator')->get('aiassistance::lang.example_descriptions'); ?></label>
                            <div class="card">
                                <div class="card-body">
                                    <small class="text-muted">
                                        <strong><?php echo app('translator')->get('aiassistance::lang.example_description_title'); ?>:</strong><br>
                                        <?php echo app('translator')->get('aiassistance::lang.example_message_description_content'); ?>
                                    </small>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label><?php echo app('translator')->get('aiassistance::lang.ai_features'); ?></label>
                            <div class="card">
                                <div class="card-body">
                                    <small class="text-muted">
                                        <i class="fa fa-check text-success"></i> <?php echo app('translator')->get('aiassistance::lang.professional_tone'); ?><br>
                                        <i class="fa fa-check text-success"></i> <?php echo app('translator')->get('aiassistance::lang.engaging_content'); ?><br>
                                        <i class="fa fa-check text-success"></i> <?php echo app('translator')->get('aiassistance::lang.business_appropriate'); ?><br>
                                        <i class="fa fa-check text-success"></i> <?php echo app('translator')->get('aiassistance::lang.clear_structure'); ?>
                                    </small>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">
                <?php echo app('translator')->get('messages.cancel'); ?>
            </button>
            <button type="button" class="btn btn-primary" id="generate_message_btn">
                <i class="fa fa-magic"></i> <?php echo app('translator')->get('aiassistance::lang.generate_message'); ?>
            </button>
        </div>
    </div>
</div>
