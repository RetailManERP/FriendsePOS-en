<div class="modal-dialog" role="document">
  <div class="modal-content">
    <div class="modal-header">
      <h4 class="modal-title"><?php echo app('translator')->get('essentials::lang.enrolled_users' ); ?></h4>
      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
    </div>

    <div class="modal-body">
        <div class="row">
          <div class="col-md-12">
            <div class="table-responsive">
<table class="table table-bordered table-striped table-th-skin" id="enrolled_users_table">
                <thead>
                  <tr>
                    <th><?php echo app('translator')->get('essentials::lang.user_id'); ?></th>
                    <th><?php echo app('translator')->get('essentials::lang.role'); ?></th>
                    <th><?php echo app('translator')->get('essentials::lang.name'); ?></th>
                    <th><?php echo app('translator')->get('essentials::lang.password'); ?></th>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <td colspan="4"></td>
                  </tr>
                </tbody>
            </table>
</div>
          </div>
        </div>
    </div>
    <div class="modal-footer">
      <button type="button" class="btn btn-default" data-bs-dismiss="modal"><?php echo app('translator')->get( 'messages.close' ); ?></button>
    </div>
</div><!-- /.modal-content -->
</div><!-- /.modal-dialog -->
