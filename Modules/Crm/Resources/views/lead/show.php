

<?php $__env->startSection('title', __('crm::lang.view_lead')); ?>

<?php $__env->startSection('content'); ?>
<?php echo $__env->make('crm::layouts.nav', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<section class="content no-print">
    <div class="row no-print">
        <div class="col-md-4">
            <h3><?php echo app('translator')->get('crm::lang.view_lead'); ?></h3>
        </div>
        <div class="col-md-4 col-xs-12 mt-15 float-end">
            <?php echo Form::select('lead_id', $leads, $contact->id , ['class' => 'form-control select2', 'id' => 'lead_id']); ?>

        </div>
    </div><br>
    <div class="row">
        <div class="col-md-12">
            <div class="box box-primary">
                <div class="box-body">
                    <?php echo $__env->make('crm::lead.partial.lead_info', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                </div>
            </div>
        </div>
    </div>
	<div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header p-0">
                    <ul class="nav nav-tabs nav-justified" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" href="#lead_schedule" data-bs-toggle="tab" aria-expanded="true">
                                <i class="fas fa fa-calendar-check"></i>
                                <?php echo app('translator')->get('crm::lang.schedule'); ?>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#documents_and_notes" data-bs-toggle="tab" aria-expanded="true">
                                <i class="fas fa-file-image"></i>
                                <?php echo app('translator')->get('crm::lang.documents_and_notes'); ?>
                            </a>
                        </li>

                        <?php if(!empty($contact_view_tabs)): ?>
                            <?php $__currentLoopData = $contact_view_tabs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $tabs): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <?php $__currentLoopData = $tabs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <?php if(!empty($value['tab_menu_path'])): ?>
                                        <?php
                                            $tab_data = !empty($value['tab_data']) ? $value['tab_data'] : [];
                                        ?>
                                        <?php echo $__env->make($value['tab_menu_path'], $tab_data, \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                                <?php endif; ?>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    <?php endif; ?>
                </ul>
                <div class="tab-content">
                    <div class="tab-pane active" id="lead_schedule">
                        <?php echo $__env->make('crm::lead.partial.lead_schedule', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                    </div>
                    <!-- model id like project_id, user_id -->
                    <input type="hidden" name="notable_id" id="notable_id" value="<?php echo e($contact->id, false); ?>">
                    <!-- model name like App\User -->
                    <input type="hidden" name="notable_type" id="notable_type" value="App\Contact">
                    <div class="tab-pane document_note_body" id="documents_and_notes">
                    </div>

                    <?php if(!empty($contact_view_tabs)): ?>
                        <?php $__currentLoopData = $contact_view_tabs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $tabs): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <?php $__currentLoopData = $tabs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <?php if(!empty($value['tab_content_path'])): ?>
                                    <?php
                                        $tab_data = !empty($value['tab_data']) ? $value['tab_data'] : [];
                                    ?>
                                    <?php echo $__env->make($value['tab_content_path'], $tab_data, \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                                <?php endif; ?>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</section>
<div class="modal fade schedule" tabindex="-1" role="dialog" aria-labelledby="gridSystemModalLabel">
</div>
<div class="modal fade edit_schedule" tabindex="-1" role="dialog"></div>
<div class="modal fade schedule_log_modal" tabindex="-1" role="dialog"></div>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('javascript'); ?>
	<script src="<?php echo e(asset('modules/crm/js/crm.js?v=' . $asset_v), false); ?>"></script>
    <?php if ($__env->exists('documents_and_notes.document_and_note_js')) echo $__env->make('documents_and_notes.document_and_note_js', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <script type="text/javascript">
        $(document).ready(function() {
            initializeLeadScheduleDatatable();
        });

        $('#lead_id').change( function() {
            if ($(this).val()) {
                window.location = "<?php echo e(url('/crm/leads'), false); ?>/" + $(this).val();
            }
        });
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>