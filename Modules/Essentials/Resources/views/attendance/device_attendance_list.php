<div class="modal-dialog modal-lg" role="document">
  <div class="modal-content">
    <div class="modal-header">
      <h4 class="modal-title">Device Attendance Logs</h4>
      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
    </div>

    <div class="modal-body">
        <div class="row">
          <div class="col-md-12">
            <div class="table-responsive">
              <table class="table table-bordered table-striped table-th-skin" id="device_attendance_table">
                <thead>
                  <tr>
                    <th>User ID / UID</th>
                    <th>Full Name</th>
                    <th>Timestamp</th>
                    <th>State</th>
                    <th>Mode</th>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <td colspan="5" class="text-center">No attendance data found</td>
                  </tr>
                </tbody>
              </table>
            </div>
          </div>
        </div>
    </div>
    <div class="modal-footer">
      <button type="button" class="btn btn-default" data-bs-dismiss="modal"><?php echo app('translator')->get('messages.close'); ?></button>
    </div>
  </div><!-- /.modal-content -->
</div><!-- /.modal-dialog -->
