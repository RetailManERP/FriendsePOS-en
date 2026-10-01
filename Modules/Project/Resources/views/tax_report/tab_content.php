<div class="tab-pane" id="ouput-tax-project-invoice">
	<table class="table table-bordered table-striped" id="output_tax_project_invoice_table" width="100%">
        <thead>
            <tr>
                <th><?php echo app('translator')->get('messages.date'); ?></th>
                <th><?php echo app('translator')->get('sale.invoice_no'); ?></th>
                <th><?php echo app('translator')->get('contact.customer'); ?></th>
                <th><?php echo app('translator')->get('contact.tax_no'); ?></th>
                <th class="text-right"><?php echo app('translator')->get('sale.total_amount'); ?> (<?php echo e(session('currency')['symbol'] ?? '', false); ?>)</th>
                <th class="text-right"><?php echo app('translator')->get('receipt.discount'); ?> (<?php echo e(session('currency')['symbol'] ?? '', false); ?>)</th>
                <?php $__currentLoopData = $taxes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $tax): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <th class="text-right">
                        <?php echo e($tax['name'], false); ?> (<?php echo e(session('currency')['symbol'] ?? '', false); ?>)
                    </th>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </tr>
        </thead>
        <tfoot>
            <tr class="bg-gray font-17 text-center footer-total">
                <td colspan="4"><strong><?php echo app('translator')->get('sale.total'); ?>:</strong></td>
                <td class="text-right"><span id="project_invoice_total"></span></td>
                <td class="text-right">&nbsp;</td>
                <?php $__currentLoopData = $taxes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $tax): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <td class="text-right">
                        <span id="total_output_pi_<?php echo e($tax['id'], false); ?>"></span>
                    </td>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </tr>
        </tfoot>
    </table>
</div>
