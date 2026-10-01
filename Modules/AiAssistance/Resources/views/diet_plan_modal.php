<div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" 
        aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title"><?php echo app('translator')->get('aiassistance::lang.generate_diet_plan'); ?></h4>
    </div>
        <div class="modal-body">
            <form id="diet_plan_form">
                <div class="form-group">
                    <label for="customer_profile"><?php echo app('translator')->get('aiassistance::lang.customer_profile'); ?> <span class="text-danger">*</span></label>
                    <textarea 
                        class="form-control" 
                        id="customer_profile" 
                        name="customer_profile" 
                        rows="8" 
                        placeholder="<?php echo app('translator')->get('aiassistance::lang.customer_profile_placeholder'); ?>"
                        required
                    ></textarea>
                    <small class="form-text text-muted">
                        <?php echo app('translator')->get('aiassistance::lang.customer_profile_help'); ?>
                    </small>
                </div>
                
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label><?php echo app('translator')->get('aiassistance::lang.example_profile'); ?></label>
                            <div class="card">
                                <div class="card-body">
                                    <small class="text-muted">
                                        <strong><?php echo app('translator')->get('aiassistance::lang.example_profile_title'); ?>:</strong><br>
                                        <?php echo app('translator')->get('aiassistance::lang.example_profile_content'); ?>
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
                                        <i class="fa fa-check text-success"></i> <?php echo app('translator')->get('aiassistance::lang.personalized_plans'); ?><br>
                                        <i class="fa fa-check text-success"></i> <?php echo app('translator')->get('aiassistance::lang.nutritional_guidance'); ?><br>
                                        <i class="fa fa-check text-success"></i> <?php echo app('translator')->get('aiassistance::lang.food_recommendations'); ?><br>
                                        <i class="fa fa-check text-success"></i> <?php echo app('translator')->get('aiassistance::lang.meal_timing'); ?>
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
            <button type="button" class="btn btn-primary" id="generate_diet_plan_btn">
                <i class="fa fa-magic"></i> <?php echo app('translator')->get('aiassistance::lang.generate_plan'); ?>
            </button>
        </div>
    </div>
</div>
