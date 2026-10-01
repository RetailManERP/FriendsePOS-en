<div class="modal-dialog modal-xl" role="document">
    <div class="modal-content">
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" 
        aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title"><?php echo app('translator')->get('aiassistance::lang.generated_workout_plan'); ?></h4>
    </div>
        <div class="modal-body">
            <?php if($workoutData): ?>
                <div class="alert alert-info">
                    <i class="fa fa-info-circle"></i> <?php echo app('translator')->get('aiassistance::lang.review_workout_plan_help'); ?>
                </div>
                
                <form id="workout_plan_review_form">
                    <input type="hidden" id="contact_id" name="contact_id" value="<?php echo e($contact_id, false); ?>">
                    
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label><strong><?php echo app('translator')->get('gym::lang.monday'); ?></strong></label>
                                <textarea class="form-control" name="monday" rows="3" placeholder="<?php echo app('translator')->get('aiassistance::lang.monday_placeholder'); ?>"><?php echo e($workoutData['monday'] ?? '', false); ?></textarea>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label><strong><?php echo app('translator')->get('gym::lang.tuesday'); ?></strong></label>
                                <textarea class="form-control" name="tuesday" rows="3" placeholder="<?php echo app('translator')->get('aiassistance::lang.tuesday_placeholder'); ?>"><?php echo e($workoutData['tuesday'] ?? '', false); ?></textarea>
                            </div>
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label><strong><?php echo app('translator')->get('gym::lang.wednesday'); ?></strong></label>
                                <textarea class="form-control" name="wednesday" rows="3" placeholder="<?php echo app('translator')->get('aiassistance::lang.wednesday_placeholder'); ?>"><?php echo e($workoutData['wednesday'] ?? '', false); ?></textarea>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label><strong><?php echo app('translator')->get('gym::lang.thursday'); ?></strong></label>
                                <textarea class="form-control" name="thursday" rows="3" placeholder="<?php echo app('translator')->get('aiassistance::lang.thursday_placeholder'); ?>"><?php echo e($workoutData['thursday'] ?? '', false); ?></textarea>
                            </div>
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label><strong><?php echo app('translator')->get('gym::lang.friday'); ?></strong></label>
                                <textarea class="form-control" name="friday" rows="3" placeholder="<?php echo app('translator')->get('aiassistance::lang.friday_placeholder'); ?>"><?php echo e($workoutData['friday'] ?? '', false); ?></textarea>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label><strong><?php echo app('translator')->get('gym::lang.saturday'); ?></strong></label>
                                <textarea class="form-control" name="saturday" rows="3" placeholder="<?php echo app('translator')->get('aiassistance::lang.saturday_placeholder'); ?>"><?php echo e($workoutData['saturday'] ?? '', false); ?></textarea>
                            </div>
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label><strong><?php echo app('translator')->get('gym::lang.sunday'); ?></strong></label>
                                <textarea class="form-control" name="sunday" rows="3" placeholder="<?php echo app('translator')->get('aiassistance::lang.sunday_placeholder'); ?>"><?php echo e($workoutData['sunday'] ?? '', false); ?></textarea>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label><strong><?php echo app('translator')->get('gym::lang.warm_up'); ?></strong></label>
                                <textarea class="form-control" name="warm_up" rows="3" placeholder="<?php echo app('translator')->get('aiassistance::lang.warm_up_placeholder'); ?>"><?php echo e($workoutData['warm_up'] ?? '', false); ?></textarea>
                            </div>
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label><strong><?php echo app('translator')->get('gym::lang.cool_down'); ?></strong></label>
                                <textarea class="form-control" name="cool_down" rows="3" placeholder="<?php echo app('translator')->get('aiassistance::lang.cool_down_placeholder'); ?>"><?php echo e($workoutData['cool_down'] ?? '', false); ?></textarea>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label><strong><?php echo app('translator')->get('gym::lang.rest_day_activities'); ?></strong></label>
                                <textarea class="form-control" name="rest_day_activities" rows="3" placeholder="<?php echo app('translator')->get('aiassistance::lang.rest_day_activities_placeholder'); ?>"><?php echo e($workoutData['rest_day_activities'] ?? '', false); ?></textarea>
                            </div>
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label><strong><?php echo app('translator')->get('gym::lang.remarks'); ?></strong></label>
                                <textarea class="form-control" name="remarks" rows="3" placeholder="<?php echo app('translator')->get('aiassistance::lang.remarks_placeholder'); ?>"><?php echo e($workoutData['remarks'] ?? '', false); ?></textarea>
                            </div>
                        </div>
                    </div>
                </form>
            <?php else: ?>
                <div class="alert alert-warning">
                    <i class="fa fa-exclamation-triangle"></i> <?php echo app('translator')->get('aiassistance::lang.no_workout_data'); ?>
                </div>
            <?php endif; ?>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">
                <?php echo app('translator')->get('messages.close'); ?>
            </button>
            <button type="button" class="btn btn-info" onclick="printWorkoutPlan()">
                <i class="fa fa-print"></i> <?php echo app('translator')->get('messages.print'); ?>
            </button>
            <?php if($workoutData): ?>
            <button type="button" class="btn btn-success" id="apply_workout_plan_btn">
                <i class="fa fa-check"></i> <?php echo app('translator')->get('aiassistance::lang.apply_workout_plan'); ?>
            </button>
            <?php endif; ?>
        </div>
    </div>
</div>
