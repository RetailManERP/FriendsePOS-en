<div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            <h4 class="modal-title" id="myModalLabel">
                <?php echo e($schedule_log->subject, false); ?>

            </h4>
        </div>
        <div class="modal-body">
            <div class="row">
                <div class="col-md-6">
                    <strong><?php echo app('translator')->get('crm::lang.start_datetime'); ?>:</strong>
                    <?php echo format_datetime_br($schedule_log->start_datetime); ?>

                </div>
                <div class="col-md-6">
                    <strong><?php echo app('translator')->get('crm::lang.end_datetime'); ?>:</strong>
                    <?php echo format_datetime_br($schedule_log->end_datetime); ?>

                </div>
            </div>
            <div class="row mt-5">
                <div class="col-md-12">
                    <div class="box box-primary">
                        <div class="box-body">
                            <?php echo $schedule_log->description; ?>

                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-default" data-bs-dismiss="modal">
                <?php echo app('translator')->get('messages.close'); ?>
            </button>
        </div>
    </div>
</div>
