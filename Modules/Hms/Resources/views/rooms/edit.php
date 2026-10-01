
<?php $__env->startSection('title', __('hms::lang.edit_room')); ?>
<?php $__env->startSection('content'); ?>
<?php echo $__env->make('hms::layouts.nav', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<section class="content-header">
    <h1 > <?php echo app('translator')->get('hms::lang.edit_room'); ?>
    </h1>
    <p><i class="fa fa-info-circle"></i> <?php echo app('translator')->get('hms::lang.edit_rooms_help_text'); ?> </p>
</section>
    <!-- Main content -->
    <section class="content">
        <div class="box box-solid">
            
            <div class="box-body">
                <?php echo Form::open([
                    'url' => action([\Modules\Hms\Http\Controllers\RoomController::class, 'update'], ['room' => $room_type->id]),
                    'method' => 'put',
                    'id' => 'edit_room',
                    'files' => true
                ]); ?>

                <div class="row">
                <div class="col-md-6">
                    <div class="col-md-12">
                        <div class="form-group">
                            <?php echo Form::label('type', __('hms::lang.type') . ':'); ?>

                            <?php echo Form::text('type', $room_type->type, [
                                'class' => 'form-control',
                                'required',
                                'placeholder' => __('hms::lang.type'),
                            ]); ?>

                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <?php echo Form::label('no_of_adult', __('hms::lang.max_no_of_adult') . ':'); ?>

                            <?php echo Form::number('no_of_adult', $room_type->no_of_adult, [
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

                            <?php echo Form::number('no_of_child', $room_type->no_of_child, [
                                'class' => 'form-control',
                                'required',
                                'placeholder' => __('hms::lang.no_of_child'),
                            ]); ?>

                        </div>
                    </div>
                   
                    <div class="col-md-6">
                        <div class="form-group">
                            <?php echo Form::label('max_occupancy', __('hms::lang.max_occupancy') . ':'); ?>

                            <?php echo Form::number('max_occupancy', $room_type->max_occupancy, [
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
                                <?php $__currentLoopData = $room_type['rooms']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $room): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr><td><input type="hidden" name="rooms[<?php echo e($index, false); ?>][id]" value="<?php echo e($room->id, false); ?>">
                                    <input type="text" name="rooms[<?php echo e($index, false); ?>][name]" class="form-control room-input" required value="<?php echo e($room->room_number, false); ?>">
                                    <div class="invalid-feedback error" style="display:none"><?php echo app('translator')->get('hms::lang.room_number_unick'); ?></div>
                                </td><td><button type="button" class="btn btn-sm btn-danger remove"><i class="fas fa-trash-alt"></i></button></td></tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
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
<?php echo Form::checkbox('amenities[]', $amenity->id , in_array($amenity->id, $existing_amenities) ,
                                    [ 'class' => 'form-check-input']); ?> <?php echo e($amenity->name, false); ?>

                                    </label>
                                </div>
                            </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    <div class="col-md-12">
                        <?php echo Form::label('images', __('hms::lang.images') . ':'); ?> <br>
                        <?php $__currentLoopData = $room_type->media; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $media): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <div class="img-thumbnail">
                                <span class="badge bg-red delete-media" data-href="<?php echo e(action([\App\Http\Controllers\ProductController::class, 'deleteMedia'], ['media_id' => $media->id]), false); ?>"><i class="fas fa-times"></i></span>
                                <?php echo $media->thumbnail(); ?>

                            </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        <div class="form-group">
                            <?php echo Form::file('images[]', ['id' => 'upload_image', 'accept' => 'image/*',
                            'required' => false, 'multiple' => true, 'class' => 'upload-element']); ?>

                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <?php echo Form::label('description', __('hms::lang.description') . ':'); ?>

                            <?php echo Form::textarea('description', $room_type->description, ['class' => 'form-control', 'rows'=> 5]); ?>

                        </div>
                    </div>
                </div>
                    <div class="col-md-12 text-center">

                        <input type="hidden" name="submit_type" id="submit_type">
                        <button type="submit" name="submit_action" value="save_and_pricing" class="btn btn-lg btn-info submit_form"><?php echo app('translator')->get('hms::lang.update_and_add_price'); ?></button>
                        <button type="submit" name="submit_action" value="save" class="btn btn-lg btn-primary submit_form"><?php echo app('translator')->get('messages.update'); ?></button>                    </div>
                    </div>

                    <?php echo Form::close(); ?>

            </div>
        </div>

    </section>
    <!-- /.content -->
<?php $__env->stopSection(); ?>

<?php $__env->startSection('javascript'); ?>

    <script type="text/javascript">
        $(document).ready(function() {
            var currentIndex = parseFloat("<?php echo e(count($room_type['rooms']), false); ?>") + 1;

            $(document).on('click', '.add-room', function(e) {  
                var place_holder = "<?php echo e(__('hms::lang.room_no'), false); ?>";
                currentIndex ++;
                var newRoomField = $('<tr><td><input type="text" name="rooms['+currentIndex+'][name]" class="form-control room-input" required placeholder="'+place_holder+'" ><div class="invalid-feedback error" style="display:none"><?php echo app('translator')->get('hms::lang.room_number_unick'); ?></div></td><td><button type="button" class="btn btn-sm btn-danger remove"><i class="fas fa-trash-alt"></i></button></td></tr>');
                $('.add_room table tbody').append(newRoomField);
            });
          
            tinymce.init({
                    selector: 'textarea#description', 
                    height:250
            });
             // Remove row functionality
            $(document).on('click', '.remove', function() {
                    swal({
                    title: LANG.sure,
                    text: "Once deleted, you will not be able to recover this Room !",
                    icon: "warning",
                    buttons: true,
                    dangerMode: true,
                    }).then((confirmed) => {
                        if (confirmed) {
                            $(this).closest('tr').remove();
                        }
                    });
            });

            $("form#edit_room").validate({
                rules: {
                    "rooms[][name]": {
                        required: true
                    }
                },
            });

            $(document).on('click', '.submit_form', function(e) { 
                e.preventDefault();
                var submit_type = $(this).attr('value');
                $('#submit_type').val(submit_type);
                if ($('form#edit_room').valid()) {
                    if (!checkUniqueRoomNumbers()) {
                        return false;
                    }
                    $('form#edit_room').submit();
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