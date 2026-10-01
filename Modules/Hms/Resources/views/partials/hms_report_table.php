<table class="table table-bordered table-striped table-hover table-th-skin">
    <thead>
        <tr class="bg-light-green">
            <th rowspan="2"><?php echo app('translator')->get('hms::lang.rooms'); ?></th>
            <th colspan="4"><?php echo app('translator')->get('hms::lang.booking_received'); ?></th>
            <th colspan="4"><?php echo app('translator')->get('hms::lang.booking_confirmed'); ?></th>
            <th colspan="4"><?php echo app('translator')->get('hms::lang.booking_cancelled'); ?></th>
            <th colspan="4"><?php echo app('translator')->get('hms::lang.booking_pending'); ?></th>
        </tr>
        <tr>
            <th class="bg-info"><?php echo app('translator')->get('hms::lang.booked'); ?></th>
            <th class="bg-info"><?php echo app('translator')->get('hms::lang.guests'); ?></th>
            <th class="bg-info"><?php echo app('translator')->get('hms::lang.nights'); ?></th>
            <th class="bg-info"><?php echo app('translator')->get('hms::lang.amount'); ?></th>
            <th class="bg-success"><?php echo app('translator')->get('hms::lang.booked'); ?></th>
            <th class="bg-success"><?php echo app('translator')->get('hms::lang.guests'); ?></th>
            <th class="bg-success"><?php echo app('translator')->get('hms::lang.nights'); ?></th>
            <th class="bg-success"><?php echo app('translator')->get('hms::lang.amount'); ?></th>
            <th class="bg-danger"><?php echo app('translator')->get('hms::lang.booked'); ?></th>
            <th class="bg-danger"><?php echo app('translator')->get('hms::lang.guests'); ?></th>
            <th class="bg-danger"><?php echo app('translator')->get('hms::lang.nights'); ?></th>
            <th class="bg-danger"><?php echo app('translator')->get('hms::lang.amount'); ?></th>
            <th class="bg-yellow"><?php echo app('translator')->get('hms::lang.booked'); ?></th>
            <th class="bg-yellow"><?php echo app('translator')->get('hms::lang.guests'); ?></th>
            <th class="bg-yellow"><?php echo app('translator')->get('hms::lang.nights'); ?></th>
            <th class="bg-yellow"><?php echo app('translator')->get('hms::lang.amount'); ?></th>
        </tr>
    </thead>
    <tbody>
        <?php $__currentLoopData = $all_room_types; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $all_room_type): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <tr>
                <td><?php echo e($all_room_type->type, false); ?></td>
                <td><?php echo e($all_room_type->transactions_count, false); ?></td>
                <td><?php echo e($all_room_type->no_of_guest ?? 0, false); ?></td>

                <?php if($all_room_type->transactions_count != 0): ?>
                    <td>
                        <?php echo e($all_room_type->total_days == 0 ? 1 : $all_room_type->total_days, false); ?>

                    </td>
                <?php else: ?>
                    <td>0</td>
                <?php endif; ?>

                <td class="display_currency" data-currency_symbol="true"><?php echo e($all_room_type->total_price, false); ?></td>

                <?php if(isset($confirmed_room_types[$index])): ?>
                    <td><?php echo e($confirmed_room_types[$index]->transactions_count, false); ?></td>
                <?php endif; ?>
                <?php if(isset($confirmed_room_types[$index])): ?>
                    <td><?php echo e($confirmed_room_types[$index]->no_of_guest ?? 0, false); ?></td>
                <?php endif; ?>
                <?php if(isset($confirmed_room_types[$index])): ?>
                    <?php if($confirmed_room_types[$index]->transactions_count != 0): ?>
                        <td>
                            <?php echo e($confirmed_room_types[$index]->total_days == 0 ? 1 : $confirmed_room_types[$index]->total_days, false); ?>

                        </td>
                    <?php else: ?>
                        <td>0</td>
                    <?php endif; ?>
                <?php endif; ?>
                <?php if(isset($confirmed_room_types[$index])): ?>
                    <td class="display_currency" data-currency_symbol="true">
                        <?php echo e($confirmed_room_types[$index]->total_price, false); ?>

                    </td>
                <?php endif; ?>

                <?php if(isset($cancelled_room_types[$index])): ?>
                    <td><?php echo e($cancelled_room_types[$index]->transactions_count ?? 0, false); ?></td>
                <?php endif; ?>
                <?php if(isset($cancelled_room_types[$index])): ?>
                    <td><?php echo e($cancelled_room_types[$index]->no_of_guest ?? 0, false); ?></td>
                <?php endif; ?>
                <?php if(isset($cancelled_room_types[$index])): ?>
                    <?php if($cancelled_room_types[$index]->transactions_count != 0): ?>
                        <td>
                            <?php echo e($cancelled_room_types[$index]->total_days == 0 ? 1 : $cancelled_room_types[$index]->total_days, false); ?>

                        </td>
                    <?php else: ?>
                        <td>0</td>
                    <?php endif; ?>
                <?php endif; ?>
                <?php if(isset($cancelled_room_types[$index])): ?>
                    <td class="display_currency" data-currency_symbol="true">
                        <?php echo e($cancelled_room_types[$index]->total_price, false); ?>

                    </td>
                <?php endif; ?>

                <?php if(isset($pending_room_types[$index])): ?>
                    <td><?php echo e($pending_room_types[$index]->transactions_count ?? 0, false); ?></td>
                <?php endif; ?>
                <?php if(isset($pending_room_types[$index])): ?>
                    <td><?php echo e($pending_room_types[$index]->no_of_guest ?? 0, false); ?></td>
                <?php endif; ?>
                <?php if(isset($pending_room_types[$index])): ?>
                    <?php if($pending_room_types[$index]->transactions_count != 0): ?>
                        <td>
                            <?php echo e($pending_room_types[$index]->total_days == 0 ? 1 : $pending_room_types[$index]->total_days, false); ?>

                        </td>
                    <?php else: ?>
                        <td>0</td>
                    <?php endif; ?>
                <?php endif; ?>
                <?php if(isset($pending_room_types[$index])): ?>
                    <td class="display_currency" data-currency_symbol="true">
                        <?php echo e($pending_room_types[$index]->total_price, false); ?>

                    </td>
                <?php endif; ?>
            </tr>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </tbody>
</table>
