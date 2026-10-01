
<div class="row">
    <?php if(!empty($receipt_details->logo)): ?>
        <img style="max-height: 120px; width: auto;" src="<?php echo e($receipt_details->logo, false); ?>" class="img img-responsive center-block">
    <?php endif; ?>
        <div class="col-xs-12 text-center">
            <h2 class="text-center">
                <?php echo e($receipt_details->business_name, false); ?>

            </h2>
        </div>


        <div class="col-xs-12 text-center">
        <h2 class="text-center">             Receipt of cash       </h2>
            <hr>
        </div>


        <div class="col-xs-12 ">
            <span class="float-start text-left word-wrap"> Customer :</span>
            <b><?php echo $client->name; ?></b>
        </div>
<br>
        <div class="col-xs-6 ">
            <span class="float-start text-left word-wrap"> Installment No.:</span>
            <b><?php echo $receipt_details->installment_number; ?></b>
        </div>

        <div class="col-xs-6 ">
            <span class="float-start text-left word-wrap">  TOTAL : </span>
            <b><?php echo $receipt_details->total; ?></b>
        </div>
        <div class="col-xs-6 ">
            <span class="float-start text-left word-wrap"> Paid Date :</span>
            <b><?php echo $receipt_details->paid_date; ?></b>
        </div>
 </div>

                     <br/>





</div>
        <div class="row">
            <div class="col-xs-12">
                <br/>
                <div class="table-responsive">
                <table class="table table-slim">
                    <thead>
                    <tr>
                        <th width="20%">Installment No.</th>
                        <th  width="30%">due date</th>
                        <th  width="30%">Paid Date</th>
                        <th  width="20%">Status</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php $__currentLoopData = $installments; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $installment): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr>
                          <td><?php echo e($installment->installment_number, false); ?></td>
                          <td><?php echo e($installment->installmentdate, false); ?></td>
                          <td><?php echo e($installment->paid_date, false); ?></td>
                          <td><?php if($installment->payment_id>0): ?>
                              <span> paid </span>
                              <?php endif; ?>  </td>

                        </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </tbody>
                </table>
                </div>
            </div>
        </div>
