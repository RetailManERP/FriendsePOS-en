<?php if(count($schedule->invoices) > 0): ?>
    <div class="col-md-12">
        <strong>
            <i class="fas fa-receipt margin-r-5"></i>
            <?php echo app('translator')->get('lang_v1.invoices'); ?>
        </strong> <br>
        <div class="table-responsive">
            <table class="table table-striped table-th-skin">
                <thead>
                    <tr>
                        <th>
                            <?php echo app('translator')->get('sale.invoice_no'); ?>
                        </th>
                        <th>
                            <?php echo app('translator')->get('messages.date'); ?>
                        </th>
                        <th>
                            <?php echo app('translator')->get('sale.total_amount'); ?>
                        </th>
                        <th>
                            <?php echo app('translator')->get('sale.total_paid'); ?>
                        </th>
                        <th>
                            <?php echo app('translator')->get('sale.total_remaining'); ?>
                        </th>
                    </tr>
                </thead>
                <tbody>
                    <?php $__currentLoopData = $schedule->invoices; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $schedule_invoice): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr>
                            <td>
                                <?php echo e($schedule_invoice->invoice_no, false); ?>

                            </td>
                            <td>
                                <?php echo format_datetime_br($schedule_invoice->transaction_date); ?>

                            </td>
                            <td>
                                <?php 
            $formated_number = "";
            /* if (session("business.currency_symbol_placement") == "before") {
                 $formated_number .= session("currency")["symbol"] . " ";
            }*/ 
            $formated_number .= number_format((float) $schedule_invoice->final_total, session("business.currency_precision", 2) , session("currency")["decimal_separator"], session("currency")["thousand_separator"]);

            /* if (session("business.currency_symbol_placement") == "after") {
                 $formated_number .= " " . session("currency")["symbol"];
            } */
            echo $formated_number; ?>
                            </td>
                            <td>
                                <?php
                                    $paid = 0;
                                    foreach($schedule_invoice->payment_lines as $payment_line) {
                                        if ($payment_line->is_return) {
                                            $paid -= $payment_line->amount;
                                        } else {
                                            $paid += $payment_line->amount;
                                        }
                                    }
                                ?>
                                <?php 
            $formated_number = "";
            /* if (session("business.currency_symbol_placement") == "before") {
                 $formated_number .= session("currency")["symbol"] . " ";
            }*/ 
            $formated_number .= number_format((float) $paid, session("business.currency_precision", 2) , session("currency")["decimal_separator"], session("currency")["thousand_separator"]);

            /* if (session("business.currency_symbol_placement") == "after") {
                 $formated_number .= " " . session("currency")["symbol"];
            } */
            echo $formated_number; ?>
                            </td>
                            <td>
                                <?php
                                    $pending = $schedule_invoice->final_total - $paid;
                                ?>
                                <?php 
            $formated_number = "";
            /* if (session("business.currency_symbol_placement") == "before") {
                 $formated_number .= session("currency")["symbol"] . " ";
            }*/ 
            $formated_number .= number_format((float) $pending, session("business.currency_precision", 2) , session("currency")["decimal_separator"], session("currency")["thousand_separator"]);

            /* if (session("business.currency_symbol_placement") == "after") {
                 $formated_number .= " " . session("currency")["symbol"];
            } */
            echo $formated_number; ?>
                            </td>
                        </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </tbody>
            </table>
        </div>
    </div>
<?php endif; ?>
