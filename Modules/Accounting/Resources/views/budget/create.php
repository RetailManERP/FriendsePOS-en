

<?php $__env->startSection('title', __('accounting::lang.budget_for_fy', ['fy' => $fy_year])); ?>

<?php $__env->startSection('content'); ?>

<?php echo $__env->make('accounting::layouts.nav', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<!-- Content Header (Page header) -->
<section class="content-header">
    <h1><?php echo app('translator')->get('accounting::lang.budget_for_fy', ['fy' => $fy_year]); ?></h1>
</section>
<section class="content">
	<?php $__env->startComponent('components.widget', ['class' => 'box-primary']); ?>
    <?php echo Form::open(['url' => action([\Modules\Accounting\Http\Controllers\BudgetController::class, 'store']), 
            'method' => 'post', 'id' => 'add_budget_form' ]); ?>

        <input type="hidden" name="financial_year" value="<?php echo e($fy_year, false); ?>">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header p-0">
                        <ul class="nav nav-tabs nav-justified" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active" href="#monthly_tab" data-bs-toggle="tab" 
                                aria-expanded="true"><?php echo app('translator')->get('accounting::lang.monthly'); ?></a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#quarterly_tab" data-bs-toggle="tab" 
                                aria-expanded="true"><?php echo app('translator')->get('accounting::lang.quarterly'); ?></a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#yearly_tab" data-bs-toggle="tab" 
                                aria-expanded="true"><?php echo app('translator')->get('accounting::lang.yearly'); ?></a>
                            </li>
                        </ul>
                    </div>
                    <div class="card-body">
                        <div class="tab-content">
                            <div class="tab-pane fade show active" id="monthly_tab">
                            <div class="table-responsive" style="height: 500px;">
                                <table class="table table-striped">
                                    <tr>
                                        <th>
                                            <?php echo app('translator')->get('account.account'); ?>
                                        </th>
                                        <?php $__currentLoopData = $months; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $k => $m): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <th><?php echo e(Carbon::createFromFormat('m', $k)->format('M'), false); ?></th>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </tr>
                                    <?php $__currentLoopData = $accounts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $account): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <tr>
                                            <th><?php echo e($account->name, false); ?></th>
                                            <?php $__currentLoopData = $months; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $k => $m): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <?php
                                                    $account_budget = $budget->where('accounting_account_id', $account->id)->first();
                                                    $value = !is_null($account_budget) && !is_null($account_budget->$m) 
                                                    ? $account_budget->$m : null;
                                                ?>
                                                <td>
                                                    <input type="text" class="form-control input_number" 
                                                    name="budget[<?php echo e($account->id, false); ?>][<?php echo e($m, false); ?>]" <?php if(!is_null($value)): ?>
                                                    value="<?php echo e(number_format($value, session('business.currency_precision', 2), session('currency')['decimal_separator'], session('currency')['thousand_separator']), false); ?>" <?php endif; ?>>
                                                </td>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </tr>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </table>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="quarterly_tab">
                            <div class="table-responsive" style="height: 500px;">
                                <table class="table table-striped">
                                    <tr>
                                        <th>
                                            <?php echo app('translator')->get('account.account'); ?>
                                        </th>
                                        <th>
                                            <?php echo app('translator')->get('accounting::lang.1st_quarter'); ?>
                                        </th>
                                        <th>
                                            <?php echo app('translator')->get('accounting::lang.2nd_quarter'); ?>
                                        </th>
                                        <th>
                                            <?php echo app('translator')->get('accounting::lang.3rd_quarter'); ?>
                                        </th>
                                        <th>
                                            <?php echo app('translator')->get('accounting::lang.4th_quarter'); ?>
                                        </th>
                                    </tr>
                                    <?php $__currentLoopData = $accounts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $account): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <?php
                                                $account_budget = $budget->where('accounting_account_id', $account->id)->first();
                                            ?>
                                        <tr>
                                            <th><?php echo e($account->name, false); ?></th>
                                            <td>
                                                <input type="text" class="form-control input_number" 
                                                name="budget[<?php echo e($account->id, false); ?>][quarter_1]"
                                                <?php if(!is_null($account_budget) && !is_null($account_budget->quarter_1)): ?> 
                                                value="<?php echo e(number_format($account_budget->quarter_1, session('business.currency_precision', 2), session('currency')['decimal_separator'], session('currency')['thousand_separator']), false); ?>" <?php endif; ?> >
                                            </td>
                                            <td>
                                                <input type="text" class="form-control input_number" 
                                                name="budget[<?php echo e($account->id, false); ?>][quarter_2]"
                                                <?php if(!is_null($account_budget) && !is_null($account_budget->quarter_2)): ?> 
                                                value="<?php echo e(number_format($account_budget->quarter_2, session('business.currency_precision', 2), session('currency')['decimal_separator'], session('currency')['thousand_separator']), false); ?>" <?php endif; ?>
                                                >
                                            </td>
                                            <td>
                                                <input type="text" class="form-control input_number" 
                                                name="budget[<?php echo e($account->id, false); ?>][quarter_3]"
                                                <?php if(!is_null($account_budget) && !is_null($account_budget->quarter_3)): ?> 
                                                value="<?php echo e(number_format($account_budget->quarter_3, session('business.currency_precision', 2), session('currency')['decimal_separator'], session('currency')['thousand_separator']), false); ?>" <?php endif; ?>
                                                >
                                            </td>
                                            <td>
                                                <input type="text" class="form-control input_number" 
                                                name="budget[<?php echo e($account->id, false); ?>][quarter_4]"
                                                <?php if(!is_null($account_budget) && !is_null($account_budget->quarter_4)): ?> 
                                                value="<?php echo e(number_format($account_budget->quarter_4, session('business.currency_precision', 2), session('currency')['decimal_separator'], session('currency')['thousand_separator']), false); ?>" <?php endif; ?>
                                                >
                                            </td>
                                        </tr>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </table>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="yearly_tab">
                            <div class="table-responsive" style="height: 500px;">
                                <table class="table table-striped">
                                    <tr>
                                        <th>
                                            <?php echo app('translator')->get('account.account'); ?>
                                        </th>
                                        <th class="text-center">
                                        <?php echo e($fy_year, false); ?>

                                        </th>
                                    </tr>
                                    <?php $__currentLoopData = $accounts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $account): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <?php
                                            $account_budget = $budget->where('accounting_account_id', $account->id)->first();
                                        ?>
                                        <tr>
                                            <th><?php echo e($account->name, false); ?></th>
                                            <td>
                                                <input type="text" class="form-control input_number" 
                                                name="budget[<?php echo e($account->id, false); ?>][yearly]"
                                                <?php if(!is_null($account_budget) && !is_null($account_budget->yearly)): ?> 
                                                value="<?php echo e(number_format($account_budget->yearly, session('business.currency_precision', 2), session('currency')['decimal_separator'], session('currency')['thousand_separator']), false); ?>" <?php endif; ?>
                                                >
                                            </td>
                                        </tr>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12 text-center">
                <button type="submit" class="btn btn-primary btn-lg"><?php echo app('translator')->get('messages.submit'); ?></button>
            </div>
        </div>
    <?php echo Form::close(); ?>

    <?php echo $__env->renderComponent(); ?>
</section>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('javascript'); ?>
<script type="text/javascript">
	$(document).ready( function(){
	});
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>