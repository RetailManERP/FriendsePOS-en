
<?php $__env->startSection('title', __('hms::lang.prices')); ?>
<?php $__env->startSection('content'); ?>
    <?php echo $__env->make('hms::layouts.nav', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <section class="content-header">
        <h1 ><?php echo app('translator')->get('hms::lang.set_price_for'); ?> <?php echo e($room_type->type ?? '', false); ?>

        </h1>
        <p><i class="fa fa-info-circle"></i> <?php echo app('translator')->get('hms::lang.pricing_help_text'); ?> </p>
    </section>
    <!-- Main content -->
    <section class="content">

        <?php $__env->startComponent('components.widget'); ?>
            <div class="box-body">
                <?php echo Form::open([
                    'url' => action([\Modules\Hms\Http\Controllers\RoomController::class, 'post_pricing']),
                    'method' => 'post',
                    'id' => 'create_pricing',
                    'files' => true,
                ]); ?>

                <div class="row">
                <div class="col-md-12">
                    <div class="col-md-4">
                        <input type="hidden" name="season_type" value="default">
                        <div class="form-group">
                            <?php echo Form::label('type_id', 'Room type'); ?>

                            <?php echo Form::select('type_id', $types, $room_type->id ?? null, [
                                'class' => 'form-control',
                                'id' => 'type_id',
                                'placeholder' => __('messages.please_select'),
                                'required',
                            ]); ?>

                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-check">
                        <label class="form-check-label">
<input type="checkbox" class="check_price_type" checked>
                            <?php echo app('translator')->get('hms::lang.set_price_for_each_day'); ?>
                        </label>
                    </div>
                </div>
                <div class="col-md-12 week_days_pricing">
                    <table class="table table-bordered">
                        <thead>
                            <tr class="bg-light-green">
                                <th><?php echo app('translator')->get('hms::lang.monday'); ?></th>
                                <th><?php echo app('translator')->get('hms::lang.tuesday'); ?></th>
                                <th><?php echo app('translator')->get('hms::lang.wednesday'); ?></th>
                                <th><?php echo app('translator')->get('hms::lang.thursday'); ?></th>
                                <th><?php echo app('translator')->get('hms::lang.friday'); ?></th>
                                <th><?php echo app('translator')->get('hms::lang.saturday'); ?></th>
                                <th><?php echo app('translator')->get('hms::lang.sunday'); ?></th>
                            </tr>
                        </thead>
                        <tbody>
                            <td>
                                <?php if(is_object($default_pricing)): ?>
                                    <input type="hidden" name="pricing[0][id]" value="<?php echo e($default_pricing->id, false); ?>">
                                <?php endif; ?>
                                <?php echo Form::number('pricing[0][monday]', $default_pricing ? $default_pricing->price_monday : null, [
                                    'class' => 'form-control',
                                    'required',
                                    'step' => '0.0001',
                                ]); ?>

                            </td>
                            <td>
                                <?php echo Form::number('pricing[0][tuesday]', $default_pricing ? $default_pricing->price_tuesday : null, [
                                    'class' => 'form-control',
                                    'required',
                                    'step' => '0.0001',
                                ]); ?>

                            </td>
                            <td>
                                <?php echo Form::number('pricing[0][wednesday]', $default_pricing ? $default_pricing->price_wednesday : null, [
                                    'class' => 'form-control',
                                    'required',
                                    'step' => '0.0001',
                                ]); ?>

                            </td>
                            <td>
                                <?php echo Form::number('pricing[0][thursday]', $default_pricing ? $default_pricing->price_thursday : null, [
                                    'class' => 'form-control',
                                    'required',
                                    'step' => '0.0001',
                                ]); ?>

                            </td>
                            <td>
                                <?php echo Form::number('pricing[0][friday]', $default_pricing ? $default_pricing->price_friday : null, [
                                    'class' => 'form-control',
                                    'required',
                                    'step' => '0.0001',
                                ]); ?>

                            </td>
                            <td>
                                <?php echo Form::number('pricing[0][saturday]', $default_pricing ? $default_pricing->price_saturday : null, [
                                    'class' => 'form-control',
                                    'required',
                                    'step' => '0.0001',
                                ]); ?>

                            </td>
                            <td>
                                <?php echo Form::number('pricing[0][sunday]', $default_pricing ? $default_pricing->price_sunday : null, [
                                    'class' => 'form-control',
                                    'required',
                                    'step' => '0.0001',
                                ]); ?>

                            </td>
                        </tbody>
                    </table>
                </div>
                <div class="col-md-12 default_price" style="display: none;">
                    <div class="col-md-4">
                        <?php echo Form::label('default_price', __('hms::lang.default_price_per_night')); ?>

                        <?php echo Form::number(
                            'pricing[0][default_price]',
                            $default_pricing ? $default_pricing->default_price_per_night : null,
                            [
                                'class' => 'form-control',
                                'required',
                                'step' => '0.0001',
                            ],
                        ); ?>

                    </div>
                </div>
                <div class="col-md-12 mt-5">
                    <div class="alert alert-info">
                        <?php echo app('translator')->get('hms::lang.add_different_price_based_on_number_of_guests'); ?>
                    </div>
                </div>
                <div class="col-md-12">
                    <h3>
                        <?php echo app('translator')->get('hms::lang.special_price_based_on_number_of_guests'); ?>
                    </h3>
                </div>
                <div class="col-md-12">
                    <div class="form-check">
                        <label class="form-check-label">
<input type="checkbox" id="check_by_guest" <?php if(count($spacial_pricing) != 0): ?> checked <?php endif; ?>
                                class="check_by_guest">
                            <?php echo app('translator')->get('hms::lang.set_different_prices_based_on_number_of_guests'); ?>
                        </label>
                    </div>
                </div>

                <div class="col-md-12 week_days_pricing_spacial" <?php if(count($spacial_pricing) == 0): ?> style="display: none" <?php endif; ?>>
                    <table class="table table-bordered">
                        <thead>
                            <tr class="bg-light-green">
                                <th style="width: 100px;"><?php echo app('translator')->get('hms::lang.adults'); ?></th>
                                <th style="width: 100px;"><?php echo app('translator')->get('hms::lang.childrens'); ?></th>
                                <th><?php echo app('translator')->get('hms::lang.monday'); ?></th>
                                <th><?php echo app('translator')->get('hms::lang.tuesday'); ?></th>
                                <th><?php echo app('translator')->get('hms::lang.wednesday'); ?></th>
                                <th><?php echo app('translator')->get('hms::lang.thursday'); ?></th>
                                <th><?php echo app('translator')->get('hms::lang.friday'); ?></th>
                                <th><?php echo app('translator')->get('hms::lang.saturday'); ?></th>
                                <th><?php echo app('translator')->get('hms::lang.sunday'); ?></th>
                                <th style="width: 100px;"><?php echo app('translator')->get('messages.action'); ?></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $__currentLoopData = $spacial_pricing; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $pricing): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr>
                                    <td>
                                        <input type="hidden" name="pricing[<?php echo e($index + 1, false); ?>][id]"
                                            value="<?php echo e($pricing->id, false); ?>">
                                        <select class="form-control" required name="pricing[<?php echo e($index + 1, false); ?>][adults]">
                                            <?php for($i = 1; $i <= $room_type->no_of_adult; $i++): ?>
                                                <option <?php if($pricing->adults == $i): ?> selected <?php endif; ?>
                                                    value="<?php echo e($i, false); ?>"><?php echo e($i, false); ?></option>
                                            <?php endfor; ?>
                                        </select>
                                    </td>
                                    <td>
                                        <select class="form-control" required name="pricing[<?php echo e($index + 1, false); ?>][childrens]">
                                            <?php for($i = 0; $i <= $room_type->no_of_child; $i++): ?>
                                                <option <?php if($pricing->childrens == $i): ?> selected <?php endif; ?>
                                                    value="<?php echo e($i, false); ?>"><?php echo e($i, false); ?></option>
                                            <?php endfor; ?>
                                        </select>
                                    </td>
                                    <td>
                                        <input class="form-control" required step="0.0001"
                                            name="pricing[<?php echo e($index + 1, false); ?>][monday]" value="<?php echo e($pricing->price_monday, false); ?>"
                                            type="number">
                                    </td>
                                    <td>
                                        <input class="form-control" required step="0.0001"
                                            name="pricing[<?php echo e($index + 1, false); ?>][tuesday]" value="<?php echo e($pricing->price_tuesday, false); ?>"
                                            type="number">
                                    </td>
                                    <td>
                                        <input class="form-control" required step="0.0001"
                                            name="pricing[<?php echo e($index + 1, false); ?>][wednesday]"
                                            value="<?php echo e($pricing->price_wednesday, false); ?>" type="number">
                                    </td>
                                    <td>
                                        <input class="form-control" required step="0.0001"
                                            name="pricing[<?php echo e($index + 1, false); ?>][thursday]"
                                            value="<?php echo e($pricing->price_thursday, false); ?>" type="number">
                                    </td>
                                    <td>
                                        <input class="form-control" required step="0.0001"
                                            name="pricing[<?php echo e($index + 1, false); ?>][friday]" value="<?php echo e($pricing->price_friday, false); ?>"
                                            type="number">
                                    </td>
                                    <td>
                                        <input class="form-control" required step="0.0001"
                                            name="pricing[<?php echo e($index + 1, false); ?>][saturday]"
                                            value="<?php echo e($pricing->price_saturday, false); ?>" type="number">
                                    </td>
                                    <td>
                                        <input class="form-control" required step="0.0001"
                                            name="pricing[<?php echo e($index + 1, false); ?>][sunday]" value="<?php echo e($pricing->price_sunday, false); ?>"
                                            type="number">
                                    </td>
                                    <td>
                                        <button type="button" class="btn btn-danger remove"><i
                                                class="fas fa-trash-alt"></i></button>
                                        <button type="button" class="btn btn-success copy"><i class="fas fa-copy"></i></button>
                                    </td>
                                </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </tbody>
                    </table>
                    <button type="button" class="btn btn-sm btn-success add-row"><?php echo app('translator')->get('hms::lang.add_number_of_guests_spacial_price'); ?></button>
                </div>

                <div class="col-md-12 text-center">
                    <?php echo Form::submit(__('messages.submit'), ['class' => 'btn btn-lg btn-success']); ?>

                </div>
                </div>

                <?php echo Form::close(); ?>

            </div>
        <?php echo $__env->renderComponent(); ?>

    </section>
    <!-- /.content -->
<?php $__env->stopSection(); ?>

<?php $__env->startSection('javascript'); ?>

    <script type="text/javascript">
        $(document).ready(function() {
            $(document).on('click', '.check_price_type', function(e) {
                if ($(this).is(':checked')) {
                    $('.default_price').hide();
                    $('.week_days_pricing').show();
                } else {
                    $('.week_days_pricing').hide();
                    $('.default_price').show();
                }
            });

            $(document).on('click', '#check_by_guest', function(e) {
                if ($(this).is(':checked')) {
                    $('.week_days_pricing_spacial').show();
                } else {
                    $('.week_days_pricing_spacial').hide();
                }
            });

            var currentIndex = parseFloat("<?php echo e(count($spacial_pricing), false); ?>") + 1;
            $('.add-row').on('click', function() {

                if ($('#type_id').val() == '') {
                    toastr.error('Please select room type');
                    return false;
                }

                currentIndex++; // Increment the current index

                $.ajax({
                    method: 'get',
                    url: "<?php echo e(route('get_spacial_pricing_html'), false); ?>",
                    dataType: 'html',
                    data: {
                        'currentIndex': currentIndex,
                        'id': $('#type_id').val(),
                    },
                    success: function(response) {
                        $('.week_days_pricing_spacial table tbody').append(response);
                    },
                    error: function(jqXHR, textStatus, errorThrown) {
                        console.error(textStatus, errorThrown);
                    },
                });
            });

            // Remove row functionality
            $(document).on('click', '.remove', function() {
                $(this).closest('tr').remove();
            });

            $(document).on('click', '.copy', function() {
                var $row = $(this).closest('tr').clone();
                currentIndex++; // Increment the current index for the new row
                // Update the name attribute of each input in the copied row
                $row.find('input, select').each(function() {
                    var currentName = $(this).attr('name');
                    console.log(currentName)
                    var newName = currentName.replace(/\[(\d+)\]/g, '[' + currentIndex + ']');
                    console.log(newName)
                    $(this).attr('name', newName);
                });
                $('.week_days_pricing_spacial table tbody').append($row);
            });

            $(document).on('change', '#type_id', function() {
                // Get the selected value of the dropdown (assuming it's a select element)
                var selectedValue = $(this).val();
                window.location.href = "<?php echo e(route('room_pricing'), false); ?>?room_id=" + selectedValue;
            });

            $("form#create_pricing").validate();
        });
    </script>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>