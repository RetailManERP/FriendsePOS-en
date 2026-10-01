<div class="modal-dialog" role="document">
    <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            <h4 class="modal-title"><?php echo e($campaign->name, false); ?></h4>
        </div>
        <div class="modal-body">
            <div class="row">
                <div class="col-sm-6">
                    <b><?php echo app('translator')->get('crm::lang.campaign_type'); ?>:</b>
                    <?php if($campaign->campaign_type == "sms"): ?>
                        <?php echo e(__("crm::lang.sms"), false); ?>

                    <?php elseif($campaign->campaign_type == "email"): ?>
                        <?php echo e(__("business.email"), false); ?>

                    <?php endif; ?>
                </div>
                <?php if(!empty($campaign->sent_on)): ?>
                    <div class="col-sm-6">
                      <p class="float-end">
                        <b><?php echo app('translator')->get('crm::lang.sent_on'); ?>:</b> 
                            <?php echo format_datetime_br($campaign->sent_on); ?>

                        </p>
                    </div>
                <?php endif; ?>
            </div>
            
            <?php if($campaign->campaign_type == 'email'): ?>
                <div class="row mt-5">
                    <div class="col-sm-12">
                        <b><?php echo app('translator')->get('crm::lang.subject'); ?>:</b> <?php echo e($campaign->subject, false); ?>

                    </div>
                </div>
                <div class="row mt-5">
                    <div class="col-sm-12">
                        <b><?php echo app('translator')->get('crm::lang.email_body'); ?>:</b>
                        <?php echo $campaign->email_body; ?>

                    </div>
                </div>
            <?php elseif($campaign->campaign_type == 'sms'): ?>
                <div class="row">
                    <div class="col-sm-12">
                        <b><?php echo app('translator')->get('crm::lang.sms_body'); ?>:</b>
                       <p><?php echo $campaign->sms_body; ?></p>
                    </div>
                </div>
            <?php endif; ?>

            <?php if(!empty($campaign->additional_info['to']) && $campaign->additional_info['to'] == 'transaction_activity'): ?>
                <div class="row">
                    <div class="col-md-6">
                        <b><?php echo app('translator')->get('crm::lang.transaction_activity'); ?>:</b>
                        <?php echo app('translator')->get('crm::lang.'.$campaign->additional_info['trans_activity']); ?>
                    </div>
                    <div class="col-md-6">
                        <b><?php echo app('translator')->get('crm::lang.in_days'); ?>:</b>
                        <?php echo e($campaign->additional_info['in_days'], false); ?>

                    </div>
                </div>
            <?php endif; ?>

            <?php
                $leads = [];
                $customers = [];
            ?>
            <?php if(count($notifiable_users) > 0): ?> 
                <?php $__currentLoopData = $notifiable_users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $contact): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?> 
                    <?php
                        if($contact->type == 'lead') {
                            $leads[] = $contact->name; 
                        } else if($contact->type == 'customer') {
                            $customers[] = $contact->name; 
                        }
                    ?>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?> 
            <?php endif; ?>
            <div class="row mt-5">
                <?php if(!empty($customers)): ?>
                    <div class="col-sm-12">
                        <strong><?php echo app('translator')->get('lang_v1.customers'); ?>: </strong>
                        <p>
                            <?php echo e(implode(', ', $customers), false); ?>

                        </p>
                    </div>
                <?php endif; ?>
                <?php if(!empty($leads)): ?>
                    <div class="col-sm-12">
                        <strong><?php echo app('translator')->get('crm::lang.leads'); ?>: </strong>
                        <p>
                            <?php echo e(implode(', ', $leads), false); ?>

                        </p>
                    </div>
                <?php endif; ?>
            </div>
        </div>
        <div class="modal-footer">
            <span class="float-start">
                <i class="fas fa-pencil-alt"></i>
                <?php echo app('translator')->get('crm::lang.created_this_campaign_on', [
                    'name' => $campaign->createdBy->user_full_name
                ]); ?>
                <?php echo e(\Carbon::createFromTimestamp(strtotime($campaign->created_at))->format(session('business.date_format')), false); ?>

            </span>
            <button type="button" class="btn btn-default" data-bs-dismiss="modal">
                <?php echo app('translator')->get('messages.close'); ?>
            </button>
        </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
