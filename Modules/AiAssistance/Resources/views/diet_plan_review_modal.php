<div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" 
        aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title"><?php echo app('translator')->get('aiassistance::lang.review_generated_diet_plan'); ?></h4>
    </div>
        <div class="modal-body" >
            <div class="alert alert-info">
                <i class="fa fa-info-circle"></i> <?php echo e(__('aiassistance::lang.review_diet_plan_help'), false); ?>

            </div>
            <form id="diet_plan_review_form">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label><?php echo e(__('gym::lang.morning'), false); ?>:</label>
                            <textarea class="form-control" name="morning" rows="2" placeholder="<?php echo e(__('aiassistance::lang.morning_placeholder'), false); ?>"><?php echo e($dietData['morning'] ?? '', false); ?></textarea>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label><?php echo e(__('gym::lang.breakfast'), false); ?>:</label>
                            <textarea class="form-control" name="breakfast" rows="2" placeholder="<?php echo e(__('aiassistance::lang.breakfast_placeholder'), false); ?>"><?php echo e($dietData['breakfast'] ?? '', false); ?></textarea>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label><?php echo e(__('gym::lang.before_lunch'), false); ?>:</label>
                            <textarea class="form-control" name="before_lunch" rows="2" placeholder="<?php echo e(__('aiassistance::lang.before_lunch_placeholder'), false); ?>"><?php echo e($dietData['before_lunch'] ?? '', false); ?></textarea>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label><?php echo e(__('gym::lang.lunch'), false); ?>:</label>
                            <textarea class="form-control" name="lunch" rows="2" placeholder="<?php echo e(__('aiassistance::lang.lunch_placeholder'), false); ?>"><?php echo e($dietData['lunch'] ?? '', false); ?></textarea>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label><?php echo e(__('gym::lang.afternoon'), false); ?>:</label>
                            <textarea class="form-control" name="afternoon" rows="2" placeholder="<?php echo e(__('aiassistance::lang.afternoon_placeholder'), false); ?>"><?php echo e($dietData['afternoon'] ?? '', false); ?></textarea>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label><?php echo e(__('gym::lang.evening'), false); ?>:</label>
                            <textarea class="form-control" name="evening" rows="2" placeholder="<?php echo e(__('aiassistance::lang.evening_placeholder'), false); ?>"><?php echo e($dietData['evening'] ?? '', false); ?></textarea>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label><?php echo e(__('gym::lang.dinner'), false); ?>:</label>
                            <textarea class="form-control" name="dinner" rows="2" placeholder="<?php echo e(__('aiassistance::lang.dinner_placeholder'), false); ?>"><?php echo e($dietData['dinner'] ?? '', false); ?></textarea>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label><?php echo e(__('gym::lang.before_sleep'), false); ?>:</label>
                            <textarea class="form-control" name="before_sleep" rows="2" placeholder="<?php echo e(__('aiassistance::lang.before_sleep_placeholder'), false); ?>"><?php echo e($dietData['before_sleep'] ?? '', false); ?></textarea>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label><?php echo e(__('gym::lang.before_workout'), false); ?>:</label>
                            <textarea class="form-control" name="before_workout" rows="2" placeholder="<?php echo e(__('aiassistance::lang.before_workout_placeholder'), false); ?>"><?php echo e($dietData['before_workout'] ?? '', false); ?></textarea>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label><?php echo e(__('gym::lang.after_workout'), false); ?>:</label>
                            <textarea class="form-control" name="after_workout" rows="2" placeholder="<?php echo e(__('aiassistance::lang.after_workout_placeholder'), false); ?>"><?php echo e($dietData['after_workout'] ?? '', false); ?></textarea>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label><?php echo e(__('gym::lang.remarks'), false); ?>:</label>
                            <textarea class="form-control" name="remarks" rows="2" placeholder="<?php echo e(__('aiassistance::lang.remarks_placeholder'), false); ?>"><?php echo e($dietData['remarks'] ?? '', false); ?></textarea>
                        </div>
                    </div>
                </div>
            </form>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">
                <?php echo e(__('messages.cancel'), false); ?>

            </button>
            <button type="button" class="btn btn-primary" id="apply_diet_plan_btn">
                <i class="fa fa-check"></i> <?php echo e(__('aiassistance::lang.apply_to_form'), false); ?>

            </button>
        </div>
    </div>
</div>
