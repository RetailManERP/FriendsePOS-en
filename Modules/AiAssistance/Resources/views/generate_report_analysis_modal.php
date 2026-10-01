<div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            <h4 class="modal-title">
                <i class="fas fa-chart-line"></i> <?php echo app('translator')->get('aiassistance::lang.report_analysis'); ?>
            </h4>
        </div>
        <div class="modal-body">
            <div class="row">
                <div class="col-sm-12">
                    <div class="form-group">
                        <?php
                            $class = rand();
                        ?>
                        <div class="alert alert-info">
                            <i class="fas fa-lightbulb"></i> <strong>AI Analysis Results:</strong>
                        </div>
                        <div>
                            <div id="<?php echo e($class, false); ?>" class="report_analysis_text" style="background: #f8f9fa; padding: 15px; border-radius: 5px; border-left: 4px solid var(--bs-primary);">
                                <?php echo nl2br($text); ?>

                            </div>
                            <div class="text-right" style="margin-top: 10px;">
                                <i class="fas fa-copy cursor-pointer" onclick="copyToClipboard(<?php echo e($class, false); ?>)" title="Copy to clipboard"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="modal-footer">
            <button type="button" class="btn btn-primary" id="export_analysis">
                <i class="fa fa-download"></i> Export Analysis
            </button>
            <button type="button" class="btn btn-default" data-dismiss="modal">
                <?php echo app('translator')->get('messages.close'); ?>
            </button>
        </div>
    </div>
</div>

<script>
function copyToClipboard(elementId) {
    var text = document.getElementById(elementId).innerText;
    navigator.clipboard.writeText(text).then(function() {
        toastr.success('Analysis copied to clipboard!');
    }, function(err) {
        console.error('Could not copy text: ', err);
        toastr.error('Failed to copy to clipboard');
    });
}

$(document).ready(function() {
    $('#export_analysis').click(function() {
        var analysisText = $('.report_analysis_text').text();
        var blob = new Blob([analysisText], {type: 'text/plain'});
        var url = window.URL.createObjectURL(blob);
        var a = document.createElement('a');
        a.href = url;
        a.download = 'report_analysis_' + new Date().toISOString().slice(0,10) + '.txt';
        document.body.appendChild(a);
        a.click();
        window.URL.revokeObjectURL(url);
        document.body.removeChild(a);
    });
});
</script> 