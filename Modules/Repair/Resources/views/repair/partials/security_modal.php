<div class="modal fade register_details_modal" tabindex="-1" role="dialog" 
  aria-labelledby="gridSystemModalLabel" id="security_modal">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                  <h4 class="modal-title"><?php echo app('translator')->get('repair::lang.security'); ?></h4>
            </div>

            <div class="modal-body">
                <div class="form-group">
                    <?php echo Form::label('repair_security_pwd', __('lang_v1.password') . ':'); ?>

                    <?php echo Form::text('repair_security_pwd', null, ['class' => 'form-control', 'placeholder' => __('lang_v1.password')]); ?>

                </div>
                <div class="form-group">
                    <?php echo Form::label('repair_security_pattern', __('repair::lang.pattern') . ':'); ?>

                    <div id="pattern_container"></div>
                    <?php echo Form::hidden('repair_security_pattern', null); ?>

                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-bs-dismiss="modal"><?php echo app('translator')->get( 'messages.close' ); ?></button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div>
