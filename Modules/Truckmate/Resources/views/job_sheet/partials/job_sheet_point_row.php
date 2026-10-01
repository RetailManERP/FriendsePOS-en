<tr class="point_row">
    <td>
        <?php echo Form::text("points[$row_count][load_point]", $point_line->load_point, ['class' => 'form-control', 'placeholder' => __('truckmate::lang.loading_point')]); ?>

        <?php if(!empty($point_line->id)): ?>
        <?php echo Form::hidden("points[$row_count][point_line_id]", $point_line->id); ?>

        <?php endif; ?>
    </td>
    <td>
        <?php echo Form::text("points[$row_count][load_address]", $point_line->load_address, ['class' => 'form-control', 'placeholder' => __('lang_v1.optional')]); ?>

    </td>
    <td>
        <?php echo Form::text("points[$row_count][dest_point]", $point_line->dest_point, ['class' => 'form-control', 'placeholder' => __('truckmate::lang.destination_point')]); ?>

    </td>
    <td>
        <?php echo Form::text("points[$row_count][dest_address]", $point_line->load_address, ['class' => 'form-control', 'placeholder' => __('lang_v1.optional')]); ?>

    </td>
    <td class="text-center v-center">
        <?php if($row_count != 0): ?>
        <i class="fa fa-times text-danger point_row cursor-pointer" aria-hidden="true"></i>
        <?php endif; ?>
    </td>
</div>
