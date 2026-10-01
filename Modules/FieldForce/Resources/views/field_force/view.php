<div class="modal-dialog" role="document">
    <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title"><?php echo app('translator')->get( 'fieldforce::lang.visit_details' ); ?> (#<?php echo e($visit->visit_id, false); ?>)</h4>
        </div>
        <div class="modal-body">
            <div class="row">
                <div class="col-md-6">
                    <strong><?php echo app('translator')->get('report.contact'); ?>:</strong>
                    <?php echo e($visit->contact->full_name_with_business ?? $visit->visit_to, false); ?>

                </div>
                <div class="col-md-6 mb-5">
                    <strong><?php echo app('translator')->get('lang_v1.assigned_to'); ?>: </strong><br>
                    <?php echo $visit->user->user_full_name; ?>

                </div>
                <div class="col-md-6">
                    <?php
                    $address_string = !empty($visit->contact_id) ? urlencode(implode(', ', $visit->contact->contact_address_array)) : urlencode($visit->visit_address);
                    ?>
                    <strong><?php echo app('translator')->get('business.address'); ?>: </strong> <a target="_blank" class="btn btn-primary btn-xs" href="https://maps.google.com/?q=<?php echo e($address_string, false); ?>"><i class="fas fa-map-marker-alt"></i> <?php echo app('translator')->get('fieldforce::lang.view_on_map'); ?></a><br>
                    <?php echo $visit->contact->contact_address ?? $visit->visit_address; ?>

                </div>
                <div class="col-md-6">
                    <strong><?php echo app('translator')->get('fieldforce::lang.visit_on'); ?>: </strong><br>
                    <?php echo format_datetime_br($visit->visit_on); ?>

                </div>
                <div class="col-md-6 mb-5">
                    <strong><?php echo app('translator')->get('fieldforce::lang.visit_for'); ?>: </strong><br>
                    <?php echo e($visit->visit_for, false); ?>

                </div>
            </div>
            <hr>
            <div class="row">
                <div class="col-md-6">
                    <strong><?php echo app('translator')->get('fieldforce::lang.visited_on'); ?>: </strong><br>
                    <?php if(!empty($visit->visited_on)): ?>
                    <?php echo format_datetime_br($visit->visited_on); ?>

                    <?php endif; ?>
                </div>
                <div class="col-md-6">
                    <strong><?php echo app('translator')->get('sale.status'); ?>: </strong>
                    <span class="label <?php echo e($visit_statuses[$visit->status]['class'], false); ?>"><?php echo e($visit_statuses[$visit->status]['label'], false); ?></span>

                    <?php if($visit->status == 'did_not_meet_contact'): ?>
                    <p>
                        <?php if(!empty($visit->reason_to_not_meet_contact)): ?>
                        (<?php echo e($visit->reason_to_not_meet_contact, false); ?>)
                        <?php endif; ?>
                    </p>
                    <?php endif; ?>
                </div>
                <div class="clearfix"></div>
                <div class="col-md-6">
                    <strong><?php echo app('translator')->get('fieldforce::lang.visited_address'); ?>: </strong>
                    <?php if(!empty($visit->visited_address_latitude) && !empty($visit->visited_address_longitude)): ?>
                    <a target="_blank" class="btn btn-primary btn-xs" href="https://maps.google.com/?q=loc:<?php echo e($visit->visited_address_latitude, false); ?>+<?php echo e($visit->visited_address_longitude, false); ?> "><i class="fas fa-map-marker-alt"></i> <?php echo app('translator')->get('fieldforce::lang.view_on_map'); ?></a>
                    <?php endif; ?><br>
                    <?php echo e($visit->visited_address, false); ?>

                </div>
                <div class="col-md-6">
                    <strong><?php echo app('translator')->get('fieldforce::lang.discussions_with_contact'); ?>: </strong><br>
                    <?php echo e($visit->comments, false); ?>

                </div>
                <br><br>
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
                                <?php if(!empty($visit->meet_with) && !empty($visit->meet_with_mobileno) && !empty($visit->meet_with_designation)): ?>
                                <tr>
                                    <td>1</td>
                                    <td class="col-md-4" style="word-break: break-word;"><?php echo e($visit->meet_with, false); ?></td>
                                    <td class="col-md-4" style="word-break: break-word;"><?php echo e($visit->meet_with_mobileno, false); ?></td>
                                    <td class="col-md-3" style="word-break: break-word;"><?php echo e($visit->meet_with_designation, false); ?></td>
                                </tr>
                                <?php endif; ?>
                                <?php if(!empty($visit->meet_with2) && !empty($visit->meet_with_mobileno2) && !empty($visit->meet_with_designation2)): ?>
                                <tr>
                                    <td>2</td>
                                    <td class="col-md-4" style="word-break: break-word;"><?php echo e($visit->meet_with2, false); ?></td>
                                    <td class="col-md-4" style="word-break: break-word;"><?php echo e($visit->meet_with_mobileno2, false); ?></td>
                                    <td class="col-md-3" style="word-break: break-word;"><?php echo e($visit->meet_with_designation2, false); ?></td>
                                </tr>
                                <?php endif; ?>
                                <?php if(!empty($visit->meet_with3) && !empty($visit->meet_with_mobileno3) && !empty($visit->meet_with_designation3)): ?>
                                <tr>
                                    <td>3</td>
                                    <td class="col-md-4" style="word-break: break-word;"><?php echo e($visit->meet_with3, false); ?></td>
                                    <td class="col-md-4" style="word-break: break-word;"><?php echo e($visit->meet_with_mobileno3, false); ?></td>
                                    <td class="col-md-3" style="word-break: break-word;"><?php echo e($visit->meet_with_designation3, false); ?></td>
                                </tr>
                                <?php endif; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="clearfix"></div>
                <div class="col-md-6">
                    <strong><?php echo app('translator')->get('fieldforce::lang.photo'); ?>: </strong><br>
                    <?php if(!empty($visit->media->first())): ?>
                    <img src="<?php echo e($visit->media->first()->display_url, false); ?>" alt="visit image" width="200px">
                    <?php endif; ?>
                </div>
            </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-default" data-bs-dismiss="modal"><?php echo app('translator')->get( 'messages.close' ); ?></button>
        </div>
    </div>
</div>
