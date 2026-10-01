
<?php $__env->startSection('title', __('messages.settings')); ?>
<?php $__env->startSection('content'); ?>
<?php echo $__env->make('truckmate::layouts.nav', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<!-- Content Header (Page header) -->
<section class="content-header no-print">
    <div class="tm-page-header">
        <h1><i class="fas fa-cog" style="color:var(--tm-primary)"></i> <?php echo app('translator')->get('messages.settings'); ?></h1>
    </div>
</section>
<?php
    $custom_labels = ! empty(session()->get('business.custom_labels')) ? json_decode(session()->get('business.custom_labels'), true) : [] ;
?>

<div id="truckmate_settings_page" class="d-none"></div>
<!-- Main content -->
<section class="content tm-content">
    <div class="row">
        <?php
            $cat_code_enabled = isset($module_category_data['enable_taxonomy_code']) && !$module_category_data['enable_taxonomy_code'] ? false : true;
        ?>
        <div class="col-md-12">
            <div class="tm-card">
                <div class="tm-tabs">
                <ul class="nav nav-tabs">
                    <li class="nav-item">
                        <a class="nav-link active" href="#truckmate_status_tab" data-bs-toggle="tab" aria-expanded="true">
                            <i class="fas fa-check-circle me-1"></i>
                            <?php echo app('translator')->get('sale.status'); ?>
                            <?php
                if(session('business.enable_tooltip')){
                    echo '<i class="fa fa-info-circle text-info hover-q no-print"
                    aria-hidden="true"
                    data-bs-toggle="tooltip"
                    data-bs-placement="bottom"
                    data-bs-html="true"
                    title="' . __('repair::lang.all_js_status_tooltip') . '"></i>';
                }
            ?>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#truckmate_settings_tab" data-bs-toggle="tab" aria-expanded="true">
                            <i class="fas fa-cogs me-1"></i>
                            <?php if(!empty($custom_labels['truckmate_label'])): ?>
                                <?php echo e($custom_labels['truckmate_label'] .' ', false); ?><?php echo app('translator')->get('truckmate::lang.settings'); ?>
                            <?php else: ?>
                                <?php echo app('translator')->get('truckmate::lang.truckmate_settings'); ?>
                            <?php endif; ?>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#jobsheet_settings_tab" data-bs-toggle="tab" aria-expanded="true">
                            <i class="fas fa-clipboard me-1"></i>
                            <?php echo app('translator')->get('truckmate::lang.jobsheet_pdf_settings'); ?>
                        </a>
                    </li>
                </ul>
                </div>
                <div class="tab-content p-3">
                    <div class="tab-pane fade show active" id="truckmate_status_tab"> 
                        <?php if ($__env->exists('truckmate::status.index')) echo $__env->make('truckmate::status.index', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                    </div>
                    <div class="tab-pane fade" id="truckmate_settings_tab"> 
                        <?php if ($__env->exists('truckmate::settings.partials.truckmate_settings_tab')) echo $__env->make('truckmate::settings.partials.truckmate_settings_tab', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                    </div>
                    <div class="tab-pane fade" id="jobsheet_settings_tab"> 
                        <?php if ($__env->exists('truckmate::settings.partials.jobsheet_settings_tab')) echo $__env->make('truckmate::settings.partials.jobsheet_settings_tab', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('javascript'); ?>
<script type="text/javascript">
    $(document).ready( function(){

        $('a[data-bs-toggle="tab"]').on('shown.bs.tab', function (e) {
            var target = $(e.target).attr('href');
            if ( target == '#truckmate_settings_tab') {
                
                var data = [{
                  id: "",
                  text: '<?php echo app('translator')->get("messages.please_select"); ?>',
                  html: '<?php echo app('translator')->get("messages.please_select"); ?>',
                }, 
                <?php $__currentLoopData = $truckmate_statuses; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $truckmate_status): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    {
                    id: <?php echo e($truckmate_status->id, false); ?>,
                    <?php if(!empty($truckmate_status->color)): ?>
                        text: '<i class="fa fa-circle" aria-hidden="true" style="color: <?php echo e($truckmate_status->color, false); ?>;"></i> <?php echo e($truckmate_status->name, false); ?>',
                        title: '<?php echo e($truckmate_status->name, false); ?>'
                    <?php else: ?>
                        text: "<?php echo e($truckmate_status->name, false); ?>"
                    <?php endif; ?>
                    },
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                ];

                $("select#truckmate_status_id").select2({
                  data: data,
                  escapeMarkup: function(markup) {
                    return markup;
                  }
                });

                <?php if(!empty($truckmate_settings['default_status'])): ?>
                    $("select#truckmate_status_id").val(<?php echo e($truckmate_settings['default_status'], false); ?>).change();
                <?php endif; ?>
            }
        });

        //Truckmate Status Tab Code
        var status_table = $('#status_table').DataTable({
            processing: true,
            serverSide: true,
            ajax: "<?php echo e(action([\Modules\Truckmate\Http\Controllers\TruckmateStatusController::class, 'index']), false); ?>",
            aaSorting: [[2, 'desc']],
            columnDefs: [ {
                "targets": 3,
                "orderable": false,
                "searchable": false
            } ]
        });

        $(document).on('submit', 'form#status_form', function(e){
            e.preventDefault();
            $(this).find('button[type="submit"]').attr('disabled', true);
            var data = $(this).serialize();

            $.ajax({
                method: $(this).attr('method'),
                url: $(this).attr("action"),
                dataType: "json",
                data: data,
                success: function(result){
                    if(result.success == true){
                        $('div.view_modal').modal('hide');
                        toastr.success(result.msg);
                        status_table.ajax.reload();
                    } else {
                        toastr.error(result.msg);
                    }
                }
            });
        });

        $(document).on('shown.bs.modal', '.view_modal', function() {
            $('input#color').colorpicker({format: 'hex'});
        });

        $(document).on('click', '.view_modal [data-bs-dismiss="modal"], .view_modal [data-dismiss="modal"]', function() {
            $('div.view_modal').modal('hide');
        });

        $(document).on('click', '.update_job_sheets', function(e){
            e.preventDefault();
        
            $.ajax({
                method: 'get',
                url: '/truckmate/truckmate-js-migrate',
                dataType: "json",
                success: function(result){
                    if(result.success == true){
                        toastr.success(result.msg);
                    } else {
                        toastr.error(result.msg);
                    }
                }
            });
        });
        
    });
</script>
<?php if ($__env->exists('taxonomy.taxonomies_js')) echo $__env->make('taxonomy.taxonomies_js', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>