
<?php $__env->startSection('title', __('messages.add') . ' ' . __('hms::lang.rooms')); ?>
<?php $__env->startSection('content'); ?>
    <?php echo $__env->make('hms::layouts.nav', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <section class="content-header">
        <h1 > <?php echo app('translator')->get('messages.add'); ?>
        </h1>
        <p><i class="fa fa-info-circle"></i> <?php echo app('translator')->get('hms::lang.add_rooms_help_text'); ?> </p>
    </section>
    <!-- Main content -->
    <section class="content">

        <?php $__env->startComponent('components.widget'); ?>
            <?php echo Form::open([
                'url' => action([\Modules\Hms\Http\Controllers\RoomController::class, 'store']),
                'method' => 'post',
                'id' => 'create_room',
                'files' => true,
            ]); ?>

            <div class="col-md-6">
                <div class="col-md-12">
                    <div class="form-group">
                        <?php echo Form::label('type', __('hms::lang.type') . ':'); ?>

                        <?php echo Form::text('type', null, [
                            'class' => 'form-control',
                            'required',
                            'placeholder' => __('hms::lang.type'),
                        ]); ?>

                    </div>
                </div>
                <div class="col-md-6">
                    <div class="col-md-12">
                        <?php echo Form::label('amenities', __('hms::lang.amenities') .  ':'); ?>

                    </div>
                    <?php $__currentLoopData = $amenities; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $amenity): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div class="col-md-4">
                            <div class="form-check">
                                <label class="form-check-label">
<?php echo Form::checkbox('amenities[]', $amenity->id , null ,
                                  [ 'class' => 'form-check-input']); ?> <?php echo e($amenity->name, false); ?>

                                </label>
                              </div>
                        </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    <div class="col-md-12">
                        <div class="form-group">
                            <?php echo Form::label('images', __('hms::lang.images') .  ':'); ?>

                            <?php echo Form::file('images[]', ['id' => 'upload_image', 'accept' => 'image/*',
                            'required' => false, 'multiple' => true, 'class' => 'upload-element']); ?>

                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <?php echo Form::label('description', __('hms::lang.description') . ':'); ?>

                            <?php echo Form::textarea('description', null, ['class' => 'form-control', 'rows'=> 5]); ?>

                        </div>
                    <div class="form-group">
                        <?php echo Form::label('no_of_adult', __('hms::lang.max_no_of_adult') . ':'); ?>

                        <?php echo Form::number('no_of_adult', null, [
                            'required',
                            'class' => 'form-control',
                            'placeholder' => __('hms::lang.no_of_adult'),
                            'min' => 0,
                        ]); ?>

                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <?php echo Form::label('no_of_child', __('hms::lang.max_no_of_child') . ':'); ?>

                        <?php echo Form::number('no_of_child', null, [
                            'class' => 'form-control',
                            'required',
                            'placeholder' => __('hms::lang.no_of_child'),
                        ]); ?>

                    </div>
                </div>

                <div class="col-md-12">
                    <div class="form-group">
                        <?php echo Form::label('max_occupancy', __('hms::lang.max_occupancy') . ':'); ?>

                        <?php echo Form::number('max_occupancy', null, [
                            'class' => 'form-control',
                            'required',
                            'placeholder' => __('hms::lang.max_occupancy'),
                        ]); ?>

                    </div>
                </div>
                <div class="col-md-12 add_room">
                    <table class="table table-bordered">
                        <thead>
                            <tr class="bg-light-green">
                                <th><?php echo app('translator')->get('hms::lang.room_no'); ?></th>
                                <th style="width: 100px;"><?php echo app('translator')->get('messages.action'); ?></th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>
                                    <input type="text" name="rooms[0]" class="form-control room-input" required
                                        placeholder="<?php echo e(__('hms::lang.room_no'), false); ?>">
                                    <div class="invalid-feedback error" style="display:none"><?php echo app('translator')->get('hms::lang.room_number_unick'); ?></div>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    <button type="button" class="btn btn-sm btn-primary add-room"> <?php echo app('translator')->get('messages.add'); ?> <?php echo app('translator')->get('hms::lang.rooms'); ?></button>
                </div>
            </div>
            <div class="col-md-6">
                <div class="col-md-12">
                    <?php echo Form::label('amenities', __('hms::lang.amenities') . ':'); ?>

                </div>
                <?php $__currentLoopData = $amenities; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $amenity): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div class="col-md-4">
                        <div class="form-check">
                            <label class="form-check-label">
<?php echo Form::checkbox('amenities[]', $amenity->id, null, ['class' => 'form-check-input']); ?> <?php echo e($amenity->name, false); ?>

                            </label>
                        </div>
                    </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                <div class="col-md-12">
                    <div class="form-group">
                        <?php echo Form::label('images', __('hms::lang.images') . ':'); ?>

                        <?php echo Form::file('images[]', [
                            'id' => 'upload_image',
                            'accept' => 'image/*',
                            'required' => false,
                            'multiple' => true,
                            'class' => 'upload-element',
                        ]); ?>

                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-group">
                        <?php echo Form::label('description', __('hms::lang.description') . ':'); ?>

                        <?php echo Form::textarea('description', null, ['class' => 'form-control', 'rows' => 5]); ?>

                    </div>
                </div>
            </div>
            <div class="col-md-12 text-center">
                <input type="hidden" name="submit_type" id="submit_type">
                <button type="submit" name="submit_action" value="save_and_pricing"
                    class="btn bg-purple submit_form"><?php echo app('translator')->get('hms::lang.save_and_add_price'); ?></button>
                <button type="submit" name="submit_action" value="save"
                    class="btn btn-primary submit_form"><?php echo app('translator')->get('messages.save'); ?></button>
            </div>

            <?php echo Form::close(); ?>

        <?php echo $__env->renderComponent(); ?>

    </section>
    <!-- /.content -->
<?php $__env->stopSection(); ?>

<?php $__env->startSection('javascript'); ?>

    <script type="text/javascript">
        $(document).ready(function() {
            var count = 1;
            $(document).on('click', '.add-room', function(e) {
                var inputField = $('#room_count');
                count++;
                var place_holder = "<?php echo e(__('hms::lang.room_no'), false); ?>";

                var newRoomField = $('<tr><td><input type="text" name="rooms[' + count +
                    ']" class="form-control room-input" required placeholder="' + place_holder +
                    '" ><div class="invalid-feedback error" style="display:none"><?php echo app('translator')->get('hms::lang.room_number_unick'); ?></div></td><td><button type="button" class="btn btn-sm btn-danger remove"><i class="fas fa-trash-alt"></i></button></td></tr>'
                    );
                $('.add_room table tbody').append(newRoomField);
            });


            tinymce.init({
                selector: 'textarea#description',
                height: 250
            });

            $("form#create_room").validate();

            // Remove row functionality
            $(document).on('click', '.remove', function() {
                $(this).closest('tr').remove();
            });

            $(document).on('click', '.submit_form', function(e) {
                e.preventDefault();
                var submit_type = $(this).attr('value');
                $('#submit_type').val(submit_type);
                if ($('form#create_room').valid()) {
                    if (!checkUniqueRoomNumbers()) {
                        return false;
                    }
                    $('form#create_room').submit();
                }
            });

            function checkUniqueRoomNumbers() {
                var roomNumbers = {};
                var hasDuplicate = false;
                // Loop through each room input field
                $('.room-input').each(function() {
                    var roomNumber = $(this).val();
                    // Check if the room number is already added to the object
                    if (roomNumbers[roomNumber]) {
                        $(this).addClass('is-invalid');
                        $(this).siblings('.invalid-feedback').show();
                        hasDuplicate = true;
                    } else {
                        $(this).removeClass('is-invalid');
                        $(this).siblings('.invalid-feedback').hide();
                    }
                    // Add the room number to the object
                    roomNumbers[roomNumber] = true;
                });
                return !hasDuplicate;
            }

        });
    </script>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>