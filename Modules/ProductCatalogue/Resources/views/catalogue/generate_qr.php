
<?php $__env->startSection('title', __( 'productcatalogue::lang.catalogue_qr' )); ?>

<?php $__env->startSection('content'); ?>
<!-- Content Header (Page header) -->
<section class="content-header">
    <h1 class="fs-4 fw-bold text-dark"><?php echo app('translator')->get( 'productcatalogue::lang.catalogue_qr' ); ?></h1>
</section>
<section class="content">
    <div class="row">
        <div class="col-md-7">
    	<?php $__env->startComponent('components.widget', ['class' => 'box-solid']); ?>
            <div class="form-group">
                <?php echo Form::label('location_id', __('purchase.business_location').':'); ?>

                <?php echo Form::select('location_id', $business_locations, null, ['class' => 'form-control', 'placeholder' => __('messages.please_select')]); ?>

            </div>
            <?php if(!empty($is_tables_enabled)): ?>
            <div class="form-group">
                <?php echo Form::label('table_id', __('restaurant.table').':'); ?>

                <?php echo Form::select('table_id', [], null, ['class' => 'form-control', 'placeholder' => __('messages.please_select')]); ?>

                <small class="text-muted">Select a table to generate a unique QR code.</small>
            </div>
            <?php endif; ?>
            <div class="form-group">
                <?php echo Form::label('color', __('productcatalogue::lang.qr_code_color').':'); ?>

                <?php echo Form::text('color', '#000000', ['class' => 'form-control']); ?>

            </div>
            <div class="form-group">
                <?php echo Form::label('title', __('productcatalogue::lang.title').':'); ?>

                <?php echo Form::text('title', $business->name, ['class' => 'form-control']); ?>

            </div>
            <div class="form-group">
                <?php echo Form::label('subtitle', __('productcatalogue::lang.subtitle').':'); ?>

                <?php echo Form::text('subtitle', '', ['class' => 'form-control', 'placeholder' => 'Table']); ?>

            </div>
            <div class="form-group">
                <div class="checkbox">
                    <label>
                        <?php echo Form::checkbox('add_logo', 1, true, ['id' => 'show_logo', 'class' => 'form-check-input']); ?> <?php echo app('translator')->get('productcatalogue::lang.show_business_logo_on_qrcode'); ?>
                    </label>
                </div>
            </div>
            <button type="button" class="btn btn-primary btn-sm" id="generate_qr"><?php echo app('translator')->get('productcatalogue::lang.generate_qr'); ?></button>
        <?php echo $__env->renderComponent(); ?>

        <?php $__env->startComponent('components.widget', ['class' => 'box-solid']); ?>
            <div class="row">
                <div class="col-md-12">
                    <h4><?php echo app('translator')->get('productcatalogue::lang.setting'); ?>:</h4>
                    <?php echo Form::open(['url' => action([\Modules\ProductCatalogue\Http\Controllers\ProductCatalogueController::class, 'productCatalogueSetting']), 'method' => 'post']); ?>

                        <?php echo Form::label('is_show', __('productcatalogue::lang.outofstock_products').':'); ?>

                        <div class="form-inline">
                        <div class="form-group">
                        <?php
                            $settings = json_decode($business->productcatalogue_settings);
                            $is_show = $settings->is_show ?? '';
                        ?>
                            <div class="checkbox">
                                <label>
                                    <?php echo Form::radio('is_show', 1, $is_show == 1 ? true : false, ['id' => 'show_logo', 'class' => 'form-check-input', 'required']); ?> <?php echo app('translator')->get('productcatalogue::lang.show'); ?>
                                </label>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="checkbox">
                                <label>
                                    <?php echo Form::radio('is_show', 0, $is_show == 0 ? true : false, ['id' => 'show_logo', 'class' => 'form-check-input', 'required']); ?> <?php echo app('translator')->get('productcatalogue::lang.hide'); ?>
                                </label>
                            </div>
                        </div>
                    </div> <br>
                    <button type="submit" class="btn btn-primary btn-sm" id=""><?php echo app('translator')->get('productcatalogue::lang.save'); ?></button>
                <?php echo Form::close(); ?>

                </div>
            </div>
        <?php echo $__env->renderComponent(); ?>
        

        <?php $__env->startComponent('components.widget', ['class' => 'box-solid']); ?>
            <div class="row">
                <div class="col-md-12">
                    <strong><?php echo app('translator')->get('lang_v1.instruction'); ?>:</strong>
                    <table class="table table-striped">
                        <tr>
                            <td>1</td>
                            <td><?php echo app('translator')->get( 'productcatalogue::lang.catalogue_instruction_1' ); ?></td>
                        </tr>
                        <tr>
                            <td>2</td>
                            <td><?php echo app('translator')->get( 'productcatalogue::lang.catalogue_instruction_2' ); ?></td>
                        </tr>
                        <tr>
                            <td>3</td>
                            <td><?php echo app('translator')->get( 'productcatalogue::lang.catalogue_instruction_3' ); ?></td>
                        </tr>
                    </table>
                </div>
            </div>
        <?php echo $__env->renderComponent(); ?>
        </div>
        <div class="col-md-5">
            <?php $__env->startComponent('components.widget', ['class' => 'box-solid']); ?>

                <div class="text-center">
                    <div id="qrcode"></div>
                    <span id="catalogue_link"></span>
                    <br>
                    <a href="#" class="btn btn-success hide" id="download_image"><?php echo app('translator')->get( 'productcatalogue::lang.download_image' ); ?></a>
                </div>
            <?php echo $__env->renderComponent(); ?>
        </div>
    </div>
</section>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('javascript'); ?>
<script src="<?php echo e(asset('modules/productcatalogue/plugins/easy.qrcode.min.js'), false); ?>"></script>
<script type="text/javascript">
    (function($) {
        "use strict";

    var is_tables_enabled = <?php echo e(!empty($is_tables_enabled) ? 'true' : 'false', false); ?>;
    var catalogueBaseUrl = <?php echo json_encode($catalogue_base_url, 15, 512) ?>;
    var locationUids = <?php echo json_encode($location_uids, 15, 512) ?>;

    $(document).ready( function(){
        $('#color').colorpicker();
    });

    function getLocationUid(locationId) {
        return locationUids[locationId] || null;
    }

    function loadTables(locationId) {
        if (!is_tables_enabled) {
            console.log('Tables not enabled');
            return;
        }

        var $tableSelect = $('#table_id');
        $tableSelect.empty().append('<option value=""><?php echo e(__('messages.please_select'), false); ?></option>');

        if (!locationId) {
            console.log('No locationId selected');
            return;
        }

        var locationUid = getLocationUid(locationId);
        if (!locationUid) {
            console.error('No UID found for location', locationId);
            return;
        }

        var tablesUrl = catalogueBaseUrl + '/' + locationUid + '/tables';
        console.log('Loading tables from:', tablesUrl);
        $.ajax({
            url: tablesUrl,
            type: 'GET',
            dataType: 'json',
            success: function(response) {
                console.log('Tables response:', response);
                if (response && response.success && response.tables) {
                    response.tables.forEach(function(table) {
                        $tableSelect.append('<option value="' + table.id + '">' + table.name + '</option>');
                    });
                    console.log('Loaded ' + response.tables.length + ' tables');
                } else {
                    console.error('ProductCatalogue: Unexpected response format', response);
                    toastr.warning('No tables found for this location.');
                }
            },
            error: function(xhr, status, error) {
                console.error('ProductCatalogue: Failed to load tables', status, error, xhr.responseText);
                toastr.error('Failed to load tables: ' + error);
            }
        });
    }

    $(document).on('change', '#location_id', function() {
        loadTables($(this).val());
    });

    $(document).on('change', '#table_id', function() {
        var tableLabel = $(this).find('option:selected').text();
        if (tableLabel && $(this).val()) {
            $('#subtitle').val(tableLabel);
        } else {
            $('#subtitle').val('');
        }
    });
    
    $(document).on('click', '#generate_qr', function(e){
        $('#qrcode').html('');
        var locationVal = $('#location_id').val();
        var tableVal = is_tables_enabled ? $('#table_id').val() : null;

        if (!locationVal || (is_tables_enabled && !tableVal)) {
            alert(is_tables_enabled ? "Please select a location and table." : "Please select a location.");
            return;
        }

        var locationUid = getLocationUid(locationVal);
        if (!locationUid) {
            alert("Location configuration error. Please try again.");
            return;
        }

        var link = catalogueBaseUrl + '/' + locationUid;
        if (tableVal) {
            link += '?table_id=' + tableVal;
        }

        var color = '#000000';
        if ($('#color').val().trim() != '') {
            color = $('#color').val();
        }
        var opts = {
            text: link,
            margin: 4,
            width: 256,
            height: 256,
            quietZone: 20,
            colorDark: color,
            colorLight: "#ffffffff", 
        }

        if ($('#title').val().trim() !== '') {
            opts.title = $('#title').val();
            opts.titleFont = "bold 18px Arial";
            opts.titleColor = "#004284";
            opts.titleBackgroundColor = "#ffffff";
            opts.titleHeight = 60;
            opts.titleTop = 20;
        }

        if ($('#subtitle').val().trim() !== '') {
            opts.subTitle = $('#subtitle').val();
            opts.subTitleFont = "14px Arial";
            opts.subTitleColor = "#4F4F4F";
            opts.subTitleTop = 40;
        }

        if ($('#show_logo').is(':checked')) {
            opts.logo = "<?php echo e(asset( 'uploads/business_logos/' . $business->logo), false); ?>";
        }

        new QRCode(document.getElementById("qrcode"), opts);
        $('#catalogue_link').html('<a target="_blank" href="'+ link +'">Link</a>');
        $('#download_image').removeClass('hide');
        $('#qrcode').find('canvas').attr('id', 'qr_canvas');
    });
    })(jQuery);

    $('#download_image').click(function(e) {
        e.preventDefault();
        var link = document.createElement('a');
        link.download = 'qrcode.png';
        link.href = document.getElementById('qr_canvas').toDataURL()
        link.click();
    });
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>