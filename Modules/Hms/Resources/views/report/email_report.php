
<div style="width: 100%;">
    <div style="border: 5px solid #05bfe7; border-radius: 5px; overflow: hidden; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); margin-bottom: 20px;">
        <h3 style="color: #05bfe7; margin-bottom: 0; background-color: #05bfe7; padding: 10px; color: #fff; margin-top:0px;">
            <i class="fa fa-exclamation-triangle" style="color: #fff;" aria-hidden="true"></i>
           
        </h3>
        <div style="overflow-x:auto;">
            <table align="center" style="width: 80%; border: 1px solid #ddd; border-collapse: collapse;">
                <thead style="background-color: #f9fafb;">
                        <tr class="bg-light-green">
                            <th rowspan="2" style="border: 1px solid #ddd; padding: 8px;"><?php echo app('translator')->get('hms::lang.rooms'); ?></th>
                            <th colspan="4" style="border: 1px solid #ddd; padding: 8px;"><?php echo app('translator')->get('hms::lang.booking_received'); ?></th>
                            <th colspan="4" style="border: 1px solid #ddd; padding: 8px;"><?php echo app('translator')->get('hms::lang.booking_confirmed'); ?></th>
                            <th colspan="4" style="border: 1px solid #ddd; padding: 8px;"><?php echo app('translator')->get('hms::lang.booking_cancelled'); ?></th>
                            <th colspan="4" style="border: 1px solid #ddd; padding: 8px;"><?php echo app('translator')->get('hms::lang.booking_pending'); ?></th>
                        </tr>
                        <tr>
                            <th  style="border: 1px solid #ddd; padding: 8px; background-color: #d1ecf1;"><?php echo app('translator')->get('hms::lang.booked'); ?></th>
                            <th  style="border: 1px solid #ddd; padding: 8px; background-color: #d1ecf1;"><?php echo app('translator')->get('hms::lang.guests'); ?></th>
                            <th  style="border: 1px solid #ddd; padding: 8px; background-color: #d1ecf1;"><?php echo app('translator')->get('hms::lang.nights'); ?></th>
                            <th  style="border: 1px solid #ddd; padding: 8px; background-color: #d1ecf1;"><?php echo app('translator')->get('hms::lang.amount'); ?></th>
                            <th  style="border: 1px solid #ddd; padding: 8px; background-color: #28a745;"><?php echo app('translator')->get('hms::lang.booked'); ?></th>
                            <th  style="border: 1px solid #ddd; padding: 8px; background-color: #28a745;"><?php echo app('translator')->get('hms::lang.guests'); ?></th>
                            <th  style="border: 1px solid #ddd; padding: 8px; background-color: #28a745;"><?php echo app('translator')->get('hms::lang.nights'); ?></th>
                            <th  style="border: 1px solid #ddd; padding: 8px; background-color: #28a745;"><?php echo app('translator')->get('hms::lang.amount'); ?></th>
                            <th  style="border: 1px solid #ddd; padding: 8px; background-color: red;"><?php echo app('translator')->get('hms::lang.booked'); ?></th>
                            <th  style="border: 1px solid #ddd; padding: 8px; background-color: red;"><?php echo app('translator')->get('hms::lang.guests'); ?></th>
                            <th  style="border: 1px solid #ddd; padding: 8px; background-color: red;"><?php echo app('translator')->get('hms::lang.nights'); ?></th>
                            <th  style="border: 1px solid #ddd; padding: 8px; background-color: red;"><?php echo app('translator')->get('hms::lang.amount'); ?></th>
                            <th  style="border: 1px solid #ddd; padding: 8px; background-color: yellow;"><?php echo app('translator')->get('hms::lang.booked'); ?></th>
                            <th  style="border: 1px solid #ddd; padding: 8px; background-color: yellow;"><?php echo app('translator')->get('hms::lang.guests'); ?></th>
                            <th  style="border: 1px solid #ddd; padding: 8px; background-color: yellow;"><?php echo app('translator')->get('hms::lang.nights'); ?></th>
                            <th  style="border: 1px solid #ddd; padding: 8px; background-color: yellow;"><?php echo app('translator')->get('hms::lang.amount'); ?></th>
                        </tr>
                    </thead>
                    <tboady>
                        <?php $__currentLoopData = $all_room_types; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $all_room_type): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr>
                                <td style="border: 1px solid #ddd; padding: 8px;"><?php echo e($all_room_type->type, false); ?></td>
                                <td style="border: 1px solid #ddd; padding: 8px;"><?php echo e($all_room_type->transactions_count, false); ?></td>
                                <td style="border: 1px solid #ddd; padding: 8px;"><?php echo e($all_room_type->no_of_guest ?? 0, false); ?></td>
                                
                                    <?php if($all_room_type->transactions_count != 0): ?>
                                        <td style="border: 1px solid #ddd; padding: 8px;">
                                            <?php echo e($all_room_type->total_days == 0 ? 1 : $all_room_type->total_days, false); ?>

                                        </td>
                                    <?php else: ?>
                                        <td style="border: 1px solid #ddd; padding: 8px;">0</td>
                                    <?php endif; ?>
                                
                                <td style="border: 1px solid #ddd; padding: 8px;"> <?php echo e($transactionUtil->num_f($all_room_type->total_price, true, $business), false); ?></td>

                                <?php if(isset($confirmed_room_types[$index])): ?>
                                    <td style="border: 1px solid #ddd; padding: 8px;"><?php echo e($confirmed_room_types[$index]->transactions_count, false); ?></td>
                                <?php endif; ?>
                                <?php if(isset($confirmed_room_types[$index])): ?>
                                    <td style="border: 1px solid #ddd; padding: 8px;"><?php echo e($confirmed_room_types[$index]->no_of_guest ?? 0, false); ?></td>
                                <?php endif; ?>
                                <?php if(isset($confirmed_room_types[$index])): ?>
                                    <?php if($confirmed_room_types[$index]->transactions_count != 0): ?>
                                        <td style="border: 1px solid #ddd; padding: 8px;">
                                            <?php echo e($confirmed_room_types[$index]->total_days == 0 ? 1 : $confirmed_room_types[$index]->total_days, false); ?>

                                        </td>
                                    <?php else: ?>
                                        <td style="border: 1px solid #ddd; padding: 8px;">0</td>
                                    <?php endif; ?>
                                <?php endif; ?>
                                <?php if(isset($confirmed_room_types[$index])): ?>
                                    <td style="border: 1px solid #ddd; padding: 8px;">
                                        <?php echo e($transactionUtil->num_f($confirmed_room_types[$index]->total_price, true, $business), false); ?>

                                    </td>
                                <?php endif; ?>

                                <?php if(isset($cancelled_room_types[$index])): ?>
                                    <td style="border: 1px solid #ddd; padding: 8px;"><?php echo e($cancelled_room_types[$index]->transactions_count ?? 0, false); ?></td>
                                <?php endif; ?>
                                <?php if(isset($cancelled_room_types[$index])): ?>
                                    <td style="border: 1px solid #ddd; padding: 8px;"><?php echo e($cancelled_room_types[$index]->no_of_guest ?? 0, false); ?></td>
                                <?php endif; ?>
                                <?php if(isset($cancelled_room_types[$index])): ?>
                                    <?php if($cancelled_room_types[$index]->transactions_count != 0): ?>
                                        <td style="border: 1px solid #ddd; padding: 8px;">
                                            <?php echo e($cancelled_room_types[$index]->total_days == 0 ? 1 : $cancelled_room_types[$index]->total_days, false); ?>

                                        </td>
                                    <?php else: ?>
                                        <td style="border: 1px solid #ddd; padding: 8px;">0</td>
                                    <?php endif; ?>

                                <?php endif; ?>
                                <?php if(isset($cancelled_room_types[$index])): ?>
                                    <td style="border: 1px solid #ddd; padding: 8px;">
                                            <?php echo e($transactionUtil->num_f($cancelled_room_types[$index]->total_price, true, $business), false); ?>

                                    </td>
                                <?php endif; ?>

                                <?php if(isset($pending_room_types[$index])): ?>
                                    <td style="border: 1px solid #ddd; padding: 8px;"><?php echo e($pending_room_types[$index]->transactions_count ?? 0, false); ?></td>
                                <?php endif; ?>
                                <?php if(isset($pending_room_types[$index])): ?>
                                    <td style="border: 1px solid #ddd; padding: 8px;"><?php echo e($pending_room_types[$index]->no_of_guest ?? 0, false); ?></td>
                                <?php endif; ?>
                                <?php if(isset($pending_room_types[$index])): ?>

                                <?php if($pending_room_types[$index]->transactions_count != 0): ?>
                                    <td style="border: 1px solid #ddd; padding: 8px;">
                                        <?php echo e($pending_room_types[$index]->total_days == 0 ? 1 : $pending_room_types[$index]->total_days, false); ?>

                                    </td>
                                <?php else: ?>
                                    <td style="border: 1px solid #ddd; padding: 8px;">0</td>
                                <?php endif; ?>

                                <?php endif; ?>
                                <?php if(isset($pending_room_types[$index])): ?>
                                    <td style="border: 1px solid #ddd; padding: 8px;">   
                                        <?php echo e($transactionUtil->num_f($pending_room_types[$index]->total_price, true, $business), false); ?>

                                    </td>
                                <?php endif; ?>
                            </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
