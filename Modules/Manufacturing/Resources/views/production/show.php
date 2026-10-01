<div class="modal-dialog modal-xl modal-dialog-scrollable" role="document">
    <div class="modal-content">
        <div class="modal-header bg-light" style="position: sticky; top: 0; z-index: 1055;">
            <h4 class="modal-title"><?php echo app('translator')->get( 'manufacturing::lang.production_details' ); ?> (<b><?php echo app('translator')->get('purchase.ref_no'); ?>:</b> #<?php echo e($production_purchase->ref_no, false); ?>)</h4>
            <button type="button" class="btn-close no-print" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>

        <div class="modal-body" style="overflow-x: auto;">
            <div class="row">
                <div class="col-sm-12">
                    <p class="float-end"><b><?php echo app('translator')->get('messages.date'); ?>:</b> <?php echo e(\Carbon::createFromTimestamp(strtotime($production_purchase->transaction_date))->format(session('business.date_format')), false); ?></p>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-6 invoice-col">
                    <?php echo app('translator')->get('business.business'); ?>:
                    <address>
                        <strong><?php echo e($production_purchase->business->name, false); ?></strong>
                        <?php echo e($production_purchase->location->name, false); ?>

                        <?php if(!empty($production_purchase->location->landmark)): ?>
                          <br><?php echo e($production_purchase->location->landmark, false); ?>

                        <?php endif; ?>
                        <?php if(!empty($production_purchase->location->city) || !empty($production_purchase->location->state) || !empty($production_purchase->location->country)): ?>
                          <br><?php echo e(implode(',', array_filter([$production_purchase->location->city, $production_purchase->location->state, $production_purchase->location->country])), false); ?>

                        <?php endif; ?>
                        
                        <?php if(!empty($production_purchase->business->tax_number_1)): ?>
                          <br><?php echo e($production_purchase->business->tax_label_1, false); ?>: <?php echo e($production_purchase->business->tax_number_1, false); ?>

                        <?php endif; ?>

                        <?php if(!empty($production_purchase->business->tax_number_2)): ?>
                          <br><?php echo e($production_purchase->business->tax_label_2, false); ?>: <?php echo e($production_purchase->business->tax_number_2, false); ?>

                        <?php endif; ?>

                        <?php if(!empty($production_purchase->location->mobile)): ?>
                          <br><?php echo app('translator')->get('contact.mobile'); ?>: <?php echo e($production_purchase->location->mobile, false); ?>

                        <?php endif; ?>
                        <?php if(!empty($production_purchase->location->email)): ?>
                          <br><?php echo app('translator')->get('business.email'); ?>: <?php echo e($production_purchase->location->email, false); ?>

                        <?php endif; ?>
                    </address>
                </div>
                <div class="col-sm-6 invoice-col">
                    <b><?php echo app('translator')->get('purchase.ref_no'); ?>:</b> #<?php echo e($production_purchase->ref_no, false); ?><br/>
                    <b><?php echo app('translator')->get('messages.date'); ?>:</b> <?php echo e(\Carbon::createFromTimestamp(strtotime($production_purchase->transaction_date))->format(session('business.date_format')), false); ?><br/>
                    <b><?php echo app('translator')->get('purchase.purchase_status'); ?>:</b> <?php echo e(ucfirst( $production_purchase->status ), false); ?><br>
                    <b><?php echo app('translator')->get('purchase.payment_status'); ?>:</b> <?php echo e(ucfirst( $production_purchase->payment_status ), false); ?><br>
                    <?php if(!empty($production_purchase->mfg_production_status)): ?>
                        <b><?php echo app('translator')->get('manufacturing::lang.production_status'); ?>:</b> 
                        <span class="badge <?php echo e(\Modules\Manufacturing\Utils\ManufacturingUtil::getProductionStatusBadge($production_purchase->mfg_production_status), false); ?>"><?php echo e(\Modules\Manufacturing\Utils\ManufacturingUtil::getProductionStatusLabel($production_purchase->mfg_production_status), false); ?></span><br>
                    <?php endif; ?>
                    <?php if(!empty($production_purchase->mfg_priority)): ?>
                        <b><?php echo app('translator')->get('manufacturing::lang.priority'); ?>:</b> 
                        <span class="badge <?php echo e(\Modules\Manufacturing\Utils\ManufacturingUtil::getPriorityBadge($production_purchase->mfg_priority), false); ?>"><?php echo e(ucfirst($production_purchase->mfg_priority), false); ?></span><br>
                    <?php endif; ?>
                    <?php if(!empty($production_purchase->mfg_batch_number)): ?>
                        <b><?php echo app('translator')->get('manufacturing::lang.batch_number'); ?>:</b> <?php echo e($production_purchase->mfg_batch_number, false); ?><br>
                    <?php endif; ?>
                    <?php if(!empty($production_purchase->mfg_due_date)): ?>
                        <b><?php echo app('translator')->get('manufacturing::lang.due_date'); ?>:</b> <?php echo e(\Carbon::createFromTimestamp(strtotime($production_purchase->mfg_due_date))->format(session('business.date_format')), false); ?><br>
                    <?php endif; ?>
                </div>
                <div class="col-sm-12">
                <?php
                    $medias = $production_purchase->media;
                ?>
                <?php if(count($medias)): ?>
                    <?php echo $__env->make('sell.partials.media_table', ['medias' => $medias], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                <?php endif; ?>
                </div>
            </div>

            <hr class="my-2">

            <div class="row">
                <div class="col-md-12">
                    <h4 class="mb-2"><?php echo app('translator')->get('manufacturing::lang.product_details'); ?></h4>
                </div>
                <div class="col-md-6">
                    <strong><?php echo app('translator')->get('sale.product'); ?>:</strong>
                    <?php echo e($purchase_line->variations->full_name, false); ?>

                    <?php if(request()->session()->get('business.enable_lot_number') == 1): ?>
                        <br><strong><?php echo app('translator')->get('lang_v1.lot_number'); ?>:</strong>
                        <?php echo e($purchase_line->lot_number, false); ?>

                    <?php endif; ?>
                    <?php if(session('business.enable_product_expiry')): ?>
                        <br><strong><?php echo app('translator')->get('product.exp_date'); ?>:</strong>
                        <?php if(!empty($purchase_line->exp_date)): ?>       
                            <?php echo e(\Carbon::createFromTimestamp(strtotime($purchase_line->exp_date))->format(session('business.date_format')), false); ?> 
                        <?php endif; ?>
                    <?php endif; ?>
                </div>
                <div class="col-md-6">
                    <strong><?php echo app('translator')->get('lang_v1.quantity'); ?>:</strong>
                    <?php echo e(number_format($quantity, session('business.quantity_precision', 2), session('currency')['decimal_separator'], session('currency')['thousand_separator']), false); ?> <?php echo e($unit_name, false); ?><br>
                    <strong><?php echo e(__('manufacturing::lang.cost_of_one_unit', ['unit' => $unit_name]), false); ?>:</strong>
                    <span class="display_currency" data-currency_symbol="true"><?php echo e($unit_production_cost, false); ?></span><br>
                    <strong><?php echo app('translator')->get('manufacturing::lang.waste_units'); ?>:</strong>
                    <?php echo e(number_format($quantity_wasted, session('business.quantity_precision', 2), session('currency')['decimal_separator'], session('currency')['thousand_separator']), false); ?> <?php echo e($unit_name, false); ?>

                </div>
            </div>

            <hr class="my-2">

            <div class="row">
                <div class="col-md-12">
                    <h4 class="mb-2"><?php echo app('translator')->get('manufacturing::lang.ingredients'); ?></h4>
                </div>
                <div class="col-md-12" style="overflow-x: auto;">
                    <table class="table table-striped table-bordered" style="min-width: 600px;">
                        <thead class="bg-light">
                            <tr>
                                <th><?php echo app('translator')->get('manufacturing::lang.ingredient'); ?></th>
                                <th><?php echo app('translator')->get('manufacturing::lang.input_quantity'); ?></th>
                                <th><?php echo app('translator')->get('manufacturing::lang.waste_percent'); ?></th>
                                <th><?php echo app('translator')->get('manufacturing::lang.final_quantity'); ?></th>
                                <th><?php echo app('translator')->get('manufacturing::lang.total_price'); ?></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                $total_ingredient_price = 0;
                            ?>
                            <?php $__currentLoopData = $ingredients; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $ingredient): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr>
                                    <td>
                                        <?php echo e($ingredient['full_name'], false); ?>

                                        <?php if(!empty($ingredient['lot_numbers'])): ?>
                                            <br>
                                            <small> <?php echo app('translator')->get('lang_v1.lot_n_expiry'); ?>:  <?php echo e($ingredient['lot_numbers'], false); ?></small>
                                        <?php endif; ?>
                                    </td>
                                    <td><?php echo e(number_format($ingredient['quantity'], session('business.quantity_precision', 2), session('currency')['decimal_separator'], session('currency')['thousand_separator']), false); ?> <?php echo e($ingredient['unit'], false); ?></td>
                                    <td><?php echo e(number_format($ingredient['waste_percent'], session('business.quantity_precision', 2), session('currency')['decimal_separator'], session('currency')['thousand_separator']), false); ?> %</td>
                                    <td><?php echo e(number_format($ingredient['final_quantity'], session('business.quantity_precision', 2), session('currency')['decimal_separator'], session('currency')['thousand_separator']), false); ?> <?php echo e($ingredient['unit'], false); ?></td>
                                    <?php
                                        $price = $ingredient['total_price'];

                                        $total_ingredient_price += $price;
                                    ?>
                                    <td>
                                         <span class="display_currency" data-currency_symbol="true"><?php echo e($price, false); ?></span>
                                    </td>
                                </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            <?php if(!empty($ingredient_groups)): ?>
                                <?php $__currentLoopData = $ingredient_groups; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $ingredient_group): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <tr>
                                        <td colspan="5" class="bg-gray">
                                            <strong>
                                                <?php echo e($ingredient_group['ig_name'] ?? '', false); ?>

                                            </strong>
                                            <?php if(!empty($ingredient_group['ig_description'])): ?>
                                                - <?php echo e($ingredient_group['ig_description'], false); ?>

                                            <?php endif; ?>
                                        </td>
                                    </tr>
                                    <?php $__currentLoopData = $ingredient_group['ig_ingredients']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $ingredient): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <tr>
                                            <td>
                                                <?php echo e($ingredient['full_name'], false); ?>

                                                <?php if(!empty($ingredient['lot_numbers'])): ?>
                                                    <br>
                                                    <small> <?php echo app('translator')->get('lang_v1.lot_n_expiry'); ?>:  <?php echo e($ingredient['lot_numbers'], false); ?></small>
                                                <?php endif; ?>
                                            </td>
                                            <td><?php echo e(number_format($ingredient['quantity'], session('business.quantity_precision', 2), session('currency')['decimal_separator'], session('currency')['thousand_separator']), false); ?> <?php echo e($ingredient['unit'], false); ?></td>
                                            <td><?php echo e(number_format($ingredient['waste_percent'], session('business.quantity_precision', 2), session('currency')['decimal_separator'], session('currency')['thousand_separator']), false); ?> %</td>
                                            <td><?php echo e(number_format($ingredient['final_quantity'], session('business.quantity_precision', 2), session('currency')['decimal_separator'], session('currency')['thousand_separator']), false); ?> <?php echo e($ingredient['unit'], false); ?></td>
                                            <?php
                                                $price = $ingredient['total_price'];
                                                $total_ingredient_price += $price;
                                            ?>
                                            <td>
                                                 <span class="display_currency" data-currency_symbol="true"><?php echo e($price, false); ?></span>
                                            </td>
                                        </tr>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            <?php endif; ?>
                        </tbody>
                        <tfoot>
                            <tr>
                                <td colspan="4" class="text-right"><strong><?php echo app('translator')->get('manufacturing::lang.ingredients_cost'); ?></strong></td>
                                <td><span class="display_currency" data-currency_symbol="true"><?php echo e($total_ingredient_price, false); ?></span></td>
                            </tr>
                            <tr>
                                <td colspan="4" class="text-right"><strong><?php echo e(__('manufacturing::lang.production_cost'), false); ?>:</strong></td>
                                <td><span class="display_currency" data-currency_symbol="true"><?php echo e($total_production_cost, false); ?></span> </td>
                            </tr>
                            <?php if(!empty($production_purchase->mfg_labor_cost) && $production_purchase->mfg_labor_cost > 0): ?>
                            <tr>
                                <td colspan="4" class="text-right"><strong><?php echo e(__('manufacturing::lang.labor_cost'), false); ?>:</strong></td>
                                <td><span class="display_currency" data-currency_symbol="true"><?php echo e($production_purchase->mfg_labor_cost, false); ?></span></td>
                            </tr>
                            <?php endif; ?>
                            <?php if(!empty($production_purchase->mfg_overhead_cost) && $production_purchase->mfg_overhead_cost > 0): ?>
                            <tr>
                                <td colspan="4" class="text-right"><strong><?php echo e(__('manufacturing::lang.overhead_cost'), false); ?>:</strong></td>
                                <td><span class="display_currency" data-currency_symbol="true"><?php echo e($production_purchase->mfg_overhead_cost, false); ?></span></td>
                            </tr>
                            <?php endif; ?>
                            <tr><td colspan="4" class="text-right"><strong><?php echo e(__('manufacturing::lang.total_cost'), false); ?>:</strong></td>
                                <td><span class="display_currency" data-currency_symbol="true"><?php echo e($production_purchase->final_total, false); ?></span></td></tr>
                        </tfoot>
                    </table>
                </div>
            </div>

            
            <?php if(!empty($production_purchase->mfg_expected_quantity) || !empty($production_purchase->mfg_actual_quantity)): ?>
            <hr class="my-2">
            <div class="row mt-3">
                <div class="col-md-12">
                    <h4 class="mb-2"><?php echo app('translator')->get('manufacturing::lang.yield_tracking'); ?></h4>
                </div>
                <div class="col-md-4">
                    <strong><?php echo app('translator')->get('manufacturing::lang.expected_quantity'); ?>:</strong>
                    <?php echo e(!empty($production_purchase->mfg_expected_quantity) ? number_format($production_purchase->mfg_expected_quantity, session('business.quantity_precision', 2), session('currency')['decimal_separator'], session('currency')['thousand_separator']) : '--', false); ?> <?php echo e($unit_name ?? '', false); ?>

                </div>
                <div class="col-md-4">
                    <strong><?php echo app('translator')->get('manufacturing::lang.actual_quantity'); ?>:</strong>
                    <?php echo e(!empty($production_purchase->mfg_actual_quantity) ? number_format($production_purchase->mfg_actual_quantity, session('business.quantity_precision', 2), session('currency')['decimal_separator'], session('currency')['thousand_separator']) : '--', false); ?> <?php echo e($unit_name ?? '', false); ?>

                </div>
                <div class="col-md-4">
                    <?php
                        $yield_efficiency = 0;
                        if(!empty($production_purchase->mfg_expected_quantity) && $production_purchase->mfg_expected_quantity > 0 && !empty($production_purchase->mfg_actual_quantity)) {
                            $yield_efficiency = round(($production_purchase->mfg_actual_quantity / $production_purchase->mfg_expected_quantity) * 100, 2);
                        }
                    ?>
                    <strong><?php echo app('translator')->get('manufacturing::lang.yield_efficiency'); ?>:</strong>
                    <span class="<?php if($yield_efficiency >= 95): ?> text-success <?php elseif($yield_efficiency >= 80): ?> text-warning <?php else: ?> text-danger <?php endif; ?>">
                        <?php echo e($yield_efficiency, false); ?>%
                    </span>
                </div>
            </div>
            <?php endif; ?>

            <?php if(!empty($production_purchase->mfg_notes)): ?>
            <hr class="my-2">
            <div class="row mt-3">
                <div class="col-md-12">
                    <h4 class="mb-2"><?php echo app('translator')->get('manufacturing::lang.production_notes'); ?></h4>
                    <p><?php echo e($production_purchase->mfg_notes, false); ?></p>
                </div>
            </div>
            <?php endif; ?>
        </div>

        <div class="modal-footer bg-light" style="position: sticky; bottom: 0; z-index: 1055;">
            <button type="button" class="btn btn-primary no-print" aria-label="Print" 
      onclick="$(this).closest('div.modal-content').printThis();"><i class="fa fa-print"></i> <?php echo app('translator')->get( 'messages.print' ); ?>
      </button>
            <button type="button" class="btn btn-default no-print" data-bs-dismiss="modal"><?php echo app('translator')->get( 'messages.close' ); ?></button>
        </div>
    </div><!-- /.modal-content -->
</div><!-- /.modal-dialog -->
