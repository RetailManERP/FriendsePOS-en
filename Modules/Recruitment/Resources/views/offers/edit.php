<div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
        <?php echo Form::open(['url' => action([\Modules\Recruitment\Http\Controllers\OfferController::class, 'update'], [$offer->id]), 'method' => 'PUT', 'id' => 'edit_offer_form']); ?>

        <?php echo Form::hidden('_method', 'PUT'); ?>

        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title"><?php echo app('translator')->get('recruitment::lang.edit_offer'); ?></h4>
        </div>
        <div class="modal-body">
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <?php echo Form::label('application_id', __('recruitment::lang.application') . ':*'); ?>

                        <?php echo Form::select('application_id', ['' => __('messages.please_select')] + $applications, $offer->application_id, ['class' => 'form-control select2', 'required', 'style' => 'width:100%']); ?>

                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <?php echo Form::label('status', __('recruitment::lang.status') . ':'); ?>

                        <?php echo Form::select('status', $statuses, $offer->status, ['class' => 'form-control select2', 'style' => 'width:100%']); ?>

                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-4">
                    <div class="form-group">
                        <?php echo Form::label('offered_salary', __('recruitment::lang.offered_salary') . ':*'); ?>

                        <?php echo Form::number('offered_salary', $offer->offered_salary, ['class' => 'form-control', 'required', 'step' => '0.01']); ?>

                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <?php echo Form::label('salary_period', __('recruitment::lang.salary_period') . ':'); ?>

                        <?php echo Form::select('salary_period', ['' => __('messages.please_select'), 'monthly' => __('recruitment::lang.monthly'), 'yearly' => __('recruitment::lang.yearly'), 'weekly' => __('recruitment::lang.weekly'), 'hourly' => __('recruitment::lang.hourly')], $offer->salary_period, ['class' => 'form-control select2', 'style' => 'width:100%']); ?>

                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <?php echo Form::label('expected_joining_date', __('recruitment::lang.expected_joining_date') . ':'); ?>

                        <?php echo Form::text('expected_joining_date', $offer->expected_joining_date ? \Carbon::createFromTimestamp(strtotime($offer->expected_joining_date))->format(session('business.date_format')) : null, ['class' => 'form-control datepicker', 'readonly']); ?>

                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-4">
                    <div class="form-group">
                        <?php echo Form::label('offer_date', __('recruitment::lang.offer_date') . ':'); ?>

                        <?php echo Form::text('offer_date', \Carbon::createFromTimestamp(strtotime($offer->offer_date))->format(session('business.date_format')), ['class' => 'form-control datepicker', 'readonly']); ?>

                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <?php echo Form::label('valid_until', __('recruitment::lang.valid_until') . ':'); ?>

                        <?php echo Form::text('valid_until', $offer->valid_until ? \Carbon::createFromTimestamp(strtotime($offer->valid_until))->format(session('business.date_format')) : null, ['class' => 'form-control datepicker', 'readonly']); ?>

                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <?php echo Form::label('candidate_remarks', __('recruitment::lang.candidate_remarks') . ':'); ?>

                        <?php echo Form::text('candidate_remarks', $offer->candidate_remarks, ['class' => 'form-control']); ?>

                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <?php echo Form::label('terms_and_conditions', __('recruitment::lang.terms_and_conditions') . ':'); ?>

                        <?php echo Form::textarea('terms_and_conditions', $offer->terms_and_conditions, ['class' => 'form-control', 'rows' => 3]); ?>

                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <?php echo Form::label('benefits_offered', __('recruitment::lang.benefits_offered') . ':'); ?>

                        <?php echo Form::textarea('benefits_offered', $offer->benefits_offered, ['class' => 'form-control', 'rows' => 3]); ?>

                    </div>
                </div>
            </div>
        </div>
        <div class="modal-footer">
            <button type="submit" class="btn btn-primary"><?php echo app('translator')->get('messages.update'); ?></button>
            <button type="button" class="btn btn-default" data-dismiss="modal"><?php echo app('translator')->get('messages.close'); ?></button>
        </div>
        <?php echo Form::close(); ?>

    </div>
</div>
