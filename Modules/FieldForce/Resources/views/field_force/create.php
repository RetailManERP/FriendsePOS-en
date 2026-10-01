<div class="modal-dialog" role="document">
    <div class="modal-content">
        <?php echo Form::open(['url' => action('\Modules\FieldForce\Http\Controllers\FieldForceController@store'), 'method' => 'post', 'id' => 'add_visit_form', 'files' => true ]); ?>

        <div class="modal-header">
            <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title"><?php echo app('translator')->get( 'fieldforce::lang.add_visit' ); ?></h4>
        </div>
        <div class="modal-body">
            <div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                        <h4><?php echo app('translator')->get( 'fieldforce::lang.whom_you_will_be_visiting' ); ?>*</h4>
                    </div>
                    <div class="form-check">
                        <label class="radio-inline"><?php echo Form::radio('visit_to_type', 'contact', false, ['class' => 'form-check-input']); ?> <?php echo app('translator')->get('contact.contact'); ?></label>
                        <label class="radio-inline"><?php echo Form::radio('visit_to_type', 'did_not_meet_contact', false, ['class' => 'form-check-input']); ?> <?php echo app('translator')->get('lang_v1.others'); ?></label>
                    </div>
                </div>
                <div class="col-md-12 hide" id="contact_div">
      
<!-- Add the input field and target element for the autocomplete suggestions -->
<div class="form-group">
  <?php echo Form::label('contact_id', __('report.contact') . ':'); ?>

  <br>
  <input type="hidden" name="contact_id" id="contact_id">
  <input type="text" class="form-control" id="contact_select" placeholder="<?php echo e(__('messages.please_select'), false); ?>" autocomplete="off" style="width: 100%">
  <div id="contact_suggestions" class="d-none"></div>
</div>
                </div>
                <div id="others_div" class="hide">
                    <div class="clearfix"></div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <?php echo Form::label('visit_to', __('fieldforce::lang.person_company') . ':' ); ?>

                            <?php echo Form::text('visit_to', null, ['class' => 'form-control']); ?>

                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <?php echo Form::label('visit_address', __('fieldforce::lang.visit_address') . ':'); ?>

                            <?php echo Form::textarea('visit_address', null, ['class' => 'form-control ', 'id' => 'visit_address', 'rows' => 3]); ?>

                        </div>
                    </div>
                    <div class="clearfix"></div>
                </div>
                <div class="col-md-12">
                    <div class="form-group">
                        <?php echo Form::label('assigned_to', __('lang_v1.assigned_to') .':*'); ?>

                        <?php echo Form::select('assigned_to', $users, null, ['class' => 'form-control select2', 'required', 'style' => 'width: 100%;', 'placeholder' => __('messages.please_select')]); ?>

                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-group">
                        <?php echo Form::label('visit_on', __('fieldforce::lang.visit_on') . ':*' ); ?>

                        <?php echo Form::text('visit_on', \Carbon::createFromTimestamp(strtotime('now'))->format(session('business.date_format') . ' ' . 'h:i A'), ['class' => 'form-control', 'required', 'readonly']); ?>

                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-group">
                        <?php echo Form::label('visit_for', __('fieldforce::lang.visit_for') . ':'); ?>

                        <?php echo Form::textarea('visit_for', null, ['class' => 'form-control ', 'id' => 'visit_for', 'rows' => 3]); ?>

                    </div>
                </div>
            </div>
        </div>
        <div class="modal-footer">
            <button type="submit" class="btn btn-primary"><?php echo app('translator')->get( 'messages.save' ); ?></button>
            <button type="button" class="btn btn-default" data-bs-dismiss="modal"><?php echo app('translator')->get( 'messages.close' ); ?></button>
        </div>
        <?php echo Form::close(); ?>

    </div>
</div>


<!-- Initialize the Awesomplete instance on the input field -->
<script>
 $(document).ready(function() {
  var inputField = $('#contact_select');
  var awesomplete = new Awesomplete(inputField[0], {
    minChars: 1,
    maxItems: 10,
    autoFirst: true,
    replace: function(suggestion) {
      this.input.value = suggestion.label;
      $('#contact_id').val(suggestion.value);
    }
  });

  inputField.on('keyup', function() {
    var query = inputField.val();
    if (query.length > 0) {
      $.ajax({
        url: '/contacts/customers?query=' + encodeURIComponent(query),
        type: 'GET',
        dataType: 'json',
        success: function(response) {
          var suggestions = response.map(function(customer) {
            return {
              value: customer.id,
              label: customer.text
            };
          });
          if (suggestions.length > 0) {
            awesomplete.list = suggestions;
          } else {
            awesomplete.list = ["No Results found"];
          }
        },
        error: function(jqXHR, textStatus, errorThrown) {
          console.log('Error:', textStatus, errorThrown);
        }
      });
    } else {
      awesomplete.list = [];
    }
  });
});
</script>
