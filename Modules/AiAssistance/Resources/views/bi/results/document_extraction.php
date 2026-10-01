<div class="alert alert-info">
    <i class="fas fa-file-invoice"></i> <strong><?php echo app('translator')->get('aiassistance::lang.ai_document_extraction'); ?> — <?php echo e(ucfirst(str_replace('_', ' ', $document_type)), false); ?></strong>
</div>
<div class="bi-analysis-text" style="background: #f8f9fa; padding: 15px; border-radius: 5px; border-left: 4px solid var(--bs-primary);">
    <?php echo nl2br(e($text)); ?>

</div>
