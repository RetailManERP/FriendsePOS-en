
<?php $__env->startSection('title', $title); ?>
<?php $__env->startSection('content'); ?>
<style>
    .agreement-page {
        background: #f5f7fb;
        min-height: 100vh;
        padding: 28px 0;
    }

    .agreement-shell {
        background: #fff;
        border: 1px solid #d9dee8;
        max-width: 900px;
        margin: 0 auto;
        padding: 32px;
    }

    .agreement-title {
        color: #1f2937;
        font-size: 26px;
        font-weight: 600;
        margin: 0 0 6px;
    }

    .agreement-subtitle {
        color: #6b7280;
        margin-bottom: 22px;
    }

    .agreement-content {
        color: #1f2937;
        line-height: 1.6;
        overflow-wrap: anywhere;
    }

    @media print {
        @page {
            size: auto;
            margin: 12mm;
        }

        html,
        body,
        .agreement-page {
            background: #fff !important;
            margin: 0 !important;
            padding: 0 !important;
        }

        .agreement-shell {
            border: 0 !important;
            max-width: none !important;
            padding: 0 !important;
        }
    }
</style>
<div class="agreement-page">
    <div class="container">
        <div class="mb-3 no-print">
            <button type="button" class="btn btn-primary btn-sm" id="print_agreement">
                <i class="fas fa-print"></i> <?php echo app('translator')->get('messages.print'); ?>
            </button>
        </div>
        <div class="agreement-shell" id="agreement_content">
            <h1 class="agreement-title"><?php echo app('translator')->get('superadmin::lang.register_tc'); ?></h1>
            <div class="agreement-subtitle"><?php echo e($app_name, false); ?></div>
            <div class="agreement-content">
                <?php if(!empty($agreement_terms)): ?>
                    <?php echo $agreement_terms; ?>

                <?php else: ?>
                    <p><?php echo app('translator')->get('superadmin::lang.no_agreement_terms'); ?></p>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('javascript'); ?>
<script type="text/javascript">
    $(document).ready(function(){
        $(document).on('click', '#print_agreement', function(){
            $('#agreement_content').printThis();
        });
    });
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.guest', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>