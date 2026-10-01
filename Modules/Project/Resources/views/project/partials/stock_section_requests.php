<?php if($rows->isEmpty()): ?>
    <p class="text-muted"><?php echo app('translator')->get('project::lang.no_stock_requests'); ?></p>
<?php else: ?>
    <div class="project-stock-scroll">
        <table class="table table-bordered table-striped table-hover" height="400px">
            <thead>
                <tr>
                    <th><?php echo app('translator')->get('messages.date'); ?></th>
                    <th><?php echo app('translator')->get('lang_v1.product'); ?></th>
                    <th class="text-right"><?php echo app('translator')->get('sale.qty'); ?></th>
                    <th><?php echo app('translator')->get('project::lang.from_location'); ?></th>
                    <th><?php echo app('translator')->get('project::lang.requested_by'); ?></th>
                    <th><?php echo app('translator')->get('warehouse::lang.priority'); ?></th>
                    <th><?php echo app('translator')->get('sale.status'); ?></th>
                    <th><?php echo app('translator')->get('messages.action'); ?></th>
                </tr>
            </thead>
            <tbody>
                <?php $__currentLoopData = $rows; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $req): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <?php
                        $badges = ['pending'=>'warning','approved'=>'info','fulfilled'=>'success','cancelled'=>'danger'];
                        $b = $badges[$req->status] ?? 'default';
                        $request_product_label = optional($req->product)->name ?? '';
                        if (!empty(optional($req->variation)->name) && optional($req->variation)->name !== 'DUMMY') {
                            $request_product_label .= ' - ' . optional($req->variation)->name;
                        }
                        $transfer = $req->fulfilledTransaction;
                        $transfer_id = null;
                        $transfer_url = null;
                        if (!empty($transfer)) {
                            $transfer_id = in_array($transfer->type, ['purchase_transfer', 'wh_purchase_transfer'])
                                ? $transfer->transfer_parent_id
                                : $transfer->id;
                            if (in_array($transfer->type, ['wh_sell_transfer', 'wh_purchase_transfer']) && \Illuminate\Support\Facades\Route::has('warehouse.transfers.show')) {
                                $transfer_url = route('warehouse.transfers.show', [$transfer_id]);
                            } else {
                                $transfer_url = action([\App\Http\Controllers\StockTransferController::class, 'show'], [$transfer_id]);
                            }
                        }
                        $view_url = !empty($transfer_url)
                            ? $transfer_url
                            : route('project.stock.request.show', [$project->id, $req->id]);
                    ?>
                    <tr>
                        <td><?php echo e(optional($req->created_at)->format('Y-m-d H:i'), false); ?></td>
                        <td><?php echo e(optional($req->product)->name ?? '-', false); ?></td>
                        <td class="text-right"><?php echo e(number_format($req->quantity, 2), false); ?></td>
                        <td><?php echo e(optional($req->sourceLocation)->name ?? '-', false); ?></td>
                        <td><?php echo e(optional($req->requestedBy)->user_full_name ?? '-', false); ?></td>
                        <td><span class="label label-default"><?php echo e($req->priority, false); ?></span></td>
                        <td>
                            <span class="label label-<?php echo e($b, false); ?>"><?php echo e(ucfirst($req->status), false); ?></span>
                            <?php if($req->status === 'approved' && optional($req->approvedBy)->id): ?>
                                <br><small class="text-muted">
                                    <?php echo app('translator')->get('messages.approve'); ?> @ <?php echo e(optional($req->approved_at)->format('Y-m-d H:i'), false); ?><br>
                                    <?php echo e(optional($req->approvedBy)->user_full_name, false); ?>

                                </small>
                            <?php elseif($req->status === 'fulfilled'): ?>
                                <br><small class="text-muted">
                                    <?php echo app('translator')->get('project::lang.fulfilled_at'); ?> <?php echo e(optional($req->fulfilled_at)->format('Y-m-d H:i'), false); ?>

                                </small>
                            <?php endif; ?>
                        </td>
                        <td>
                            <div class="btn-group">
                                <button type="button" class="tw-dw-btn tw-dw-btn-xs tw-dw-btn-outline tw-dw-btn-info tw-w-max dropdown-toggle"
                                    data-bs-toggle="dropdown" aria-expanded="false">
                                    <?php echo app('translator')->get('messages.actions'); ?> <span class="caret"></span>
                                    <span class="sr-only">Toggle Dropdown</span>
                                </button>
                                <ul class="dropdown-menu dropdown-menu-right" role="menu">
                                    <li>
                                        <a href="#" class="btn-modal" data-container=".view_modal" data-href="<?php echo e($view_url, false); ?>">
                                            <i class="fa fa-eye"></i> <?php echo app('translator')->get('messages.view'); ?>
                                        </a>
                                    </li>
                                    <?php if($req->status === 'pending' && !empty($can_manage)): ?>
                                        <li>
                                            <a href="#" class="fulfill-stock-request"
                                                data-request-id="<?php echo e($req->id, false); ?>"
                                                data-product-name="<?php echo e(e($request_product_label), false); ?>"
                                                data-product-id="<?php echo e($req->product_id, false); ?>"
                                                data-variation-id="<?php echo e($req->variation_id, false); ?>"
                                                data-quantity="<?php echo e((float) $req->quantity, false); ?>"
                                                data-source-location-id="<?php echo e($req->source_location_id, false); ?>">
                                                <i class="fa fa-exchange-alt"></i> <?php echo app('translator')->get('project::lang.transfer_stock'); ?>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="#" class="edit-stock-request"
                                                data-update-url="<?php echo e(route('project.stock.request.update', [$project->id, $req->id]), false); ?>"
                                                data-product-name="<?php echo e(e($request_product_label), false); ?>"
                                                data-product-id="<?php echo e($req->product_id, false); ?>"
                                                data-variation-id="<?php echo e($req->variation_id, false); ?>"
                                                data-quantity="<?php echo e((float) $req->quantity, false); ?>"
                                                data-source-location-id="<?php echo e($req->source_location_id, false); ?>"
                                                data-priority="<?php echo e($req->priority, false); ?>"
                                                data-notes="<?php echo e(e($req->notes ?? ''), false); ?>">
                                                <i class="fa fa-edit"></i> <?php echo app('translator')->get('messages.edit'); ?>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="#" class="cancel-stock-request"
                                                data-href="<?php echo e(route('project.stock.request.cancel', [$project->id, $req->id]), false); ?>">
                                                <i class="fa fa-ban"></i> <?php echo app('translator')->get('messages.cancel'); ?>
                                            </a>
                                        </li>
                                    <?php endif; ?>
                                </ul>
                            </div>
                        </td>
                    </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </tbody>
        </table>
    </div>
    <small class="text-muted"><i class="fa fa-info-circle"></i> <?php echo e($rows->count(), false); ?> rows</small>
<?php endif; ?>
