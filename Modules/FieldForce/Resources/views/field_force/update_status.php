<div class="modal-dialog" role="document">
    <div class="modal-content">
        <?php echo Form::open(['url' => action('\Modules\FieldForce\Http\Controllers\FieldForceController@postUpdateVisitStatus', [$visit->id]), 'method' => 'post', 'id' => 'update_visit_status_form', 'files' => true ]); ?>

        <?php echo Form::hidden('visit_id', $visit->id); ?>


        <div class="modal-header">
            <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title"><?php echo app('translator')->get( 'lang_v1.update_status' ); ?> (#<?php echo e($visit->visit_id, false); ?>)</h4>
        </div>
        <div class="modal-body">
            <div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                        <h4><?php echo app('translator')->get( 'fieldforce::lang.did_you_meet_with_the_contact' ); ?></h4>
                    </div>
                    <div class="form-check">
                        <label class="radio-inline"><?php echo Form::radio('status', 'met_contact', false, ['class' => 'form-check-input', 'checked' => $visit->status == 'met_contact', 'required' => 'required']); ?> <?php echo app('translator')->get('messages.yes'); ?></label>
                        <label class="radio-inline"><?php echo Form::radio('status', 'did_not_meet_contact', false, ['class' => 'form-check-input' , 'checked' => $visit->status == 'did_not_meet_contact', 'required' => 'required']); ?> <?php echo app('translator')->get('messages.no'); ?></label>
                    </div>
                </div>
                <div class="col-md-12 <?php if($visit->status != 'did_not_meet_contact'): ?> hide <?php endif; ?>" id="reason_to_not_meet_contact">
                    <div class="form-group">
                        <?php echo Form::label('reason_to_not_meet_contact', __('fieldforce::lang.reason') . ':'); ?>

                        <?php echo Form::textarea('reason_to_not_meet_contact', $visit->reason_to_not_meet_contact, ['class' => 'form-control ', 'id' => 'reason_to_not_meet_contact', 'rows' => 3]); ?>

                    </div>
                </div>
                <div class="clearfix"></div>
                <div class="col-md-6 mt-15">
                    <div class="form-group">
                        <?php echo Form::label('photo', __('fieldforce::lang.take_photo_of_contact') . ':*' ); ?>

                        <input type="file" name="photo" accept="image/*" capture="user" id="photo" class="form-control">

                    </div>
                </div>
                <div class="col-md-6 mt-15">
                    <div class="form-group">
                        <?php echo Form::label('visited_on', __('fieldforce::lang.visited_on') . ':' ); ?>

                        <?php if(!empty($visit->visted_on)): ?>
                        <?php echo format_datetime_br($visit->visted_on); ?>

                        <?php else: ?>
                        <?php echo format_datetime_br('now'); ?>

                        <?php endif; ?>
                    </div>
                </div>
                <div class="clearfix"></div>

                <div class="col-md-12">
                    <div class="form-group">
                        <table class="table table-bordered table-sm table-th-skin">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th><?php echo app('translator')->get('fieldforce::lang.meet_with'); ?></th>
                                    <th><?php echo app('translator')->get('fieldforce::lang.meet_with_mobileno'); ?></th>
                                    <th><?php echo app('translator')->get('fieldforce::lang.designation'); ?></th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>1*</td>
                                    <td><?php echo Form::text('meet_with', $visit->meet_with, ['class' => 'form-control ', 'id' => 'meet_with', 'required' => 'required']); ?></td>
                                    <td><?php echo Form::number('meet_with_mobileno', $visit->meet_with_mobileno, ['class' => 'form-control ', 'id' => 'meet_with_mobileno', 'required' => 'required']); ?></td>
                                    <td><?php echo Form::text('meet_with_designation', $visit->meet_with_designation, ['class' => 'form-control ', 'id' => 'meet_with_designation', 'required' => 'required']); ?></td>
                                </tr>
                                <tr>
                                    <td>2</td>
                                    <td><?php echo Form::text('meet_with2', $visit->meet_with2, ['class' => 'form-control ', 'id' => 'meet_with2']); ?></td>
                                    <td><?php echo Form::number('meet_with_mobileno2', $visit->meet_with_mobileno2, ['class' => 'form-control ', 'id' => 'meet_with_mobileno2']); ?></td>
                                    <td><?php echo Form::text('meet_with_designation2', $visit->meet_with_designation2, ['class' => 'form-control ', 'id' => 'meet_with_designation2']); ?></td>
                                </tr>
                                <tr>
                                    <td>3</td>
                                    <td><?php echo Form::text('meet_with3', $visit->meet_with3, ['class' => 'form-control ', 'id' => 'meet_with3']); ?></td>
                                    <td><?php echo Form::number('meet_with_mobileno3', $visit->meet_with_mobileno3, ['class' => 'form-control ', 'id' => 'meet_with_mobileno3']); ?></td>
                                    <td><?php echo Form::text('meet_with_designation3', $visit->meet_with_designation3, ['class' => 'form-control ', 'id' => 'meet_with_designation3']); ?></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>

                <div class="clearfix"></div>
                <div class="col-md-12">
                    <div class="form-group">
                        <?php echo Form::label('visited_address', __('fieldforce::lang.visited_address') . ':'); ?>

                        <button type="button" class="btn btn-primary btn-xs" id="get_current_location_ff"> <i class="fas fa-map-marker-alt"></i> <?php echo app('translator')->get('fieldforce::lang.get_current_location'); ?></button>
                        <br>
                        <div id="visited_address_div_ff"><?php echo e($visit->visited_address ?? '', false); ?></div>
                        <?php echo Form::hidden('visited_address_latitude', $visit->visited_address_latitude, ['id' => 'visited_address_latitude']); ?>

                        <?php echo Form::hidden('visited_address_longitude', $visit->visited_address_longitude, ['id' => 'visited_address_longitude']); ?>

                        <?php echo Form::hidden('visited_address', $visit->visited_address, ['id' => 'visited_address_ff']); ?>


                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-group">
                        <?php echo Form::label('comments', __('fieldforce::lang.discussions_with_contact') . ':'); ?>

                        <?php echo Form::textarea('comments', $visit->comments, ['class' => 'form-control ', 'id' => 'comments', 'rows' => 3]); ?>

                    </div>
                </div>
            </div>
        </div>
        <div class="modal-footer">
            <button type="submit" class="btn btn-primary"><?php echo app('translator')->get( 'messages.update' ); ?></button>
            <button type="button" class="btn btn-default" data-bs-dismiss="modal"><?php echo app('translator')->get( 'messages.close' ); ?></button>
        </div>
        <?php echo Form::close(); ?>

    </div>
</div>
