
<?php $__env->startSection('title', __('cms::lang.edit_content_file') . ' - ' . $filename); ?>

<?php $__env->startSection('css'); ?>
<link rel="stylesheet" type="text/css" href="<?php echo e(asset('modules/cms/css/cms-admin.css?v=' . config('constants.asset_version')), false); ?>">
<style>
    .editor-container {
        display: flex;
        gap: 0;
        border: 1px solid #dee2e6;
        border-radius: 0.75rem;
        overflow: hidden;
        min-height: 600px;
        background: #fff;
    }
    .editor-pane, .preview-pane {
        flex: 1;
        min-width: 0;
    }
    .editor-pane {
        border-right: 1px solid #dee2e6;
        display: flex;
        flex-direction: column;
    }
    .editor-pane .pane-header,
    .preview-pane .pane-header {
        background: #f8f9fa;
        padding: 0.5rem 1rem;
        border-bottom: 1px solid #dee2e6;
        font-weight: 600;
        font-size: 0.82rem;
        color: #4a5568;
        display: flex;
        align-items: center;
        gap: 0.5rem;
    }
    .editor-pane textarea {
        flex: 1;
        border: none;
        resize: none;
        padding: 1rem;
        font-family: 'SF Mono', 'Fira Code', 'Consolas', monospace;
        font-size: 0.88rem;
        line-height: 1.6;
        outline: none;
        background: #1e1e2e;
        color: #cdd6f4;
        tab-size: 4;
    }
    .editor-pane textarea:focus {
        box-shadow: none;
    }
    .preview-pane {
        display: flex;
        flex-direction: column;
    }
    .preview-pane .preview-body {
        flex: 1;
        padding: 1.25rem;
        overflow-y: auto;
        font-size: 0.92rem;
        line-height: 1.7;
        color: #2d3748;
    }
    .preview-body h1 { font-size: 1.8rem; font-weight: 700; margin-top: 0.5rem; margin-bottom: 0.75rem; border-bottom: 2px solid #edf2f7; padding-bottom: 0.5rem; }
    .preview-body h2 { font-size: 1.4rem; font-weight: 600; margin-top: 1.25rem; margin-bottom: 0.5rem; color: var(--bs-primary); }
    .preview-body h3 { font-size: 1.15rem; font-weight: 600; margin-top: 1rem; margin-bottom: 0.4rem; }
    .preview-body p { margin-bottom: 0.75rem; }
    .preview-body code { background: #edf2f7; padding: 0.15em 0.4em; border-radius: 3px; font-size: 0.85em; color: #e53e3e; }
    .preview-body pre { background: #1e1e2e; color: #cdd6f4; padding: 1rem; border-radius: 0.5rem; overflow-x: auto; }
    .preview-body pre code { background: none; color: inherit; padding: 0; }
    .preview-body blockquote { border-left: 4px solid var(--bs-primary); padding: 0.5rem 1rem; margin: 0.75rem 0; background: rgba(var(--bs-primary-rgb), 0.05); border-radius: 0 0.5rem 0.5rem 0; }
    .preview-body ul, .preview-body ol { padding-left: 1.5rem; }
    .preview-body table { width: 100%; border-collapse: collapse; margin: 0.75rem 0; }
    .preview-body th, .preview-body td { border: 1px solid #e2e8f0; padding: 0.5rem 0.75rem; text-align: left; }
    .preview-body th { background: #f7fafc; font-weight: 600; }
    .preview-body img { max-width: 100%; height: auto; border-radius: 0.5rem; }
    .preview-body a { color: var(--bs-primary); text-decoration: underline; }
    .preview-body hr { border-color: #e2e8f0; margin: 1.5rem 0; }

    .file-info-bar {
        background: #f8f9fa;
        border: 1px solid #e3e6f0;
        border-radius: 0.5rem;
        padding: 0.6rem 1rem;
        font-size: 0.82rem;
        color: #718096;
        display: flex;
        align-items: center;
        gap: 1rem;
        flex-wrap: wrap;
    }
    .file-info-bar .badge {
        font-size: 0.72rem;
    }
    .editor-toolbar {
        background: #2d2d3f;
        padding: 0.35rem 0.75rem;
        display: flex;
        gap: 0.25rem;
        flex-wrap: wrap;
    }
    .editor-toolbar .tb-btn {
        background: transparent;
        border: 1px solid rgba(255,255,255,0.15);
        color: #a0aec0;
        padding: 0.2rem 0.5rem;
        border-radius: 0.3rem;
        font-size: 0.78rem;
        cursor: pointer;
        transition: all 0.15s;
    }
    .editor-toolbar .tb-btn:hover {
        background: rgba(255,255,255,0.1);
        color: #fff;
    }
    .editor-mode-toggle .btn {
        font-size: 0.8rem;
        padding: 0.25rem 0.75rem;
    }
    @media (max-width: 991px) {
        .editor-container {
            flex-direction: column;
            min-height: auto;
        }
        .editor-pane {
            border-right: none;
            border-bottom: 1px solid #dee2e6;
            min-height: 400px;
        }
        .preview-pane {
            min-height: 300px;
        }
    }
</style>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>

<?php echo $__env->make('cms::layouts.nav', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<section class="content-header cms-page-header">
    <div class="d-flex align-items-center justify-content-between flex-wrap gap-2">
        <h1>
            <span class="header-icon">
                <i class="fas fa-edit"></i>
            </span>
            <?php echo app('translator')->get('cms::lang.edit_content_file'); ?>
        </h1>
        <a class="btn btn-sm btn-outline-secondary" 
            href="<?php echo e(action([\Modules\Cms\Http\Controllers\CmsContentController::class, 'index'], ['folder' => $folder]), false); ?>">
            <i class="fas fa-arrow-left me-1"></i> <?php echo app('translator')->get('cms::lang.back_to_files'); ?>
        </a>
    </div>
</section>

<section class="content cms-content">
    
    <div class="file-info-bar mb-3">
        <span><i class="fas fa-folder me-1"></i><strong><?php echo e(ucfirst($folder), false); ?></strong></span>
        <span><i class="fab fa-markdown me-1"></i><?php echo e($filename, false); ?></span>
        <span><i class="fas fa-hdd me-1"></i><?php echo e(number_format($fileInfo['size'] / 1024, 1), false); ?> KB</span>
        <span><i class="far fa-clock me-1"></i><?php echo app('translator')->get('cms::lang.last_modified'); ?>: <?php echo e($fileInfo['modified'], false); ?></span>
        <span class="badge bg-success"><i class="fas fa-code-branch me-1"></i><?php echo app('translator')->get('cms::lang.file_based'); ?></span>
    </div>

    <?php echo Form::open(['url' => action([\Modules\Cms\Http\Controllers\CmsContentController::class, 'update']), 'id' => 'edit_content_form', 'method' => 'POST']); ?>

        <?php echo Form::hidden('folder', $folder); ?>

        <?php echo Form::hidden('file', $filename); ?>


        
        <div class="editor-container">
            <div class="editor-pane">
                <div class="pane-header">
                    <i class="fas fa-code"></i> <?php echo app('translator')->get('cms::lang.markdown_editor'); ?>
                </div>
                <div class="editor-toolbar">
                    <button type="button" class="tb-btn" data-action="bold" title="Bold"><i class="fas fa-bold"></i></button>
                    <button type="button" class="tb-btn" data-action="italic" title="Italic"><i class="fas fa-italic"></i></button>
                    <button type="button" class="tb-btn" data-action="h1" title="Heading 1">H1</button>
                    <button type="button" class="tb-btn" data-action="h2" title="Heading 2">H2</button>
                    <button type="button" class="tb-btn" data-action="h3" title="Heading 3">H3</button>
                    <button type="button" class="tb-btn" data-action="link" title="Link"><i class="fas fa-link"></i></button>
                    <button type="button" class="tb-btn" data-action="image" title="Image"><i class="fas fa-image"></i></button>
                    <button type="button" class="tb-btn" data-action="ul" title="Unordered List"><i class="fas fa-list-ul"></i></button>
                    <button type="button" class="tb-btn" data-action="ol" title="Ordered List"><i class="fas fa-list-ol"></i></button>
                    <button type="button" class="tb-btn" data-action="code" title="Code"><i class="fas fa-code"></i></button>
                    <button type="button" class="tb-btn" data-action="quote" title="Blockquote"><i class="fas fa-quote-left"></i></button>
                    <button type="button" class="tb-btn" data-action="hr" title="Horizontal Rule"><i class="fas fa-minus"></i></button>
                    <button type="button" class="tb-btn" data-action="table" title="Table"><i class="fas fa-table"></i></button>
                </div>
                <textarea name="content" id="md_content"><?php echo e($content, false); ?></textarea>
            </div>
            <div class="preview-pane">
                <div class="pane-header">
                    <i class="fas fa-eye"></i> <?php echo app('translator')->get('cms::lang.live_preview'); ?>
                </div>
                <div class="preview-body" id="md_preview"></div>
            </div>
        </div>

        <div class="row mt-4">
            <div class="col-md-12 text-center">
                <a href="<?php echo e(action([\Modules\Cms\Http\Controllers\CmsContentController::class, 'index'], ['folder' => $folder]), false); ?>" class="btn btn-secondary btn-lg me-2">
                    <?php echo app('translator')->get('messages.cancel'); ?>
                </a>
                <button type="submit" class="btn cms-submit-btn submit-btn btn-lg">
                    <i class="fas fa-save me-1"></i> <?php echo app('translator')->get('cms::lang.save_file'); ?>
                </button>
            </div>
        </div>
    <?php echo Form::close(); ?>

</section>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('javascript'); ?>

<script src="https://cdn.jsdelivr.net/npm/marked/marked.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/dompurify@3.0.6/dist/purify.min.js"></script>
<script type="text/javascript">
$(document).ready(function() {
    var textarea = document.getElementById('md_content');
    var preview = document.getElementById('md_preview');

    // Configure marked
    marked.setOptions({
        breaks: true,
        gfm: true,
    });

    // Live preview with sanitization
    function updatePreview() {
        var raw = marked.parse(textarea.value || '');
        preview.innerHTML = DOMPurify.sanitize(raw);
    }

    // Initial render
    updatePreview();

    // Live update on input
    $(textarea).on('input', function() {
        updatePreview();
    });

    // Toolbar actions
    function insertAtCursor(before, after, placeholder) {
        var start = textarea.selectionStart;
        var end = textarea.selectionEnd;
        var selected = textarea.value.substring(start, end);
        var text = selected || placeholder || '';
        var replacement = before + text + (after || '');
        textarea.value = textarea.value.substring(0, start) + replacement + textarea.value.substring(end);
        // Set cursor position
        var cursorPos = start + before.length;
        textarea.setSelectionRange(cursorPos, cursorPos + text.length);
        textarea.focus();
        updatePreview();
    }

    $('.editor-toolbar .tb-btn').on('click', function(e) {
        e.preventDefault();
        var action = $(this).data('action');
        switch(action) {
            case 'bold': insertAtCursor('**', '**', 'bold text'); break;
            case 'italic': insertAtCursor('*', '*', 'italic text'); break;
            case 'h1': insertAtCursor('\n# ', '\n', 'Heading 1'); break;
            case 'h2': insertAtCursor('\n## ', '\n', 'Heading 2'); break;
            case 'h3': insertAtCursor('\n### ', '\n', 'Heading 3'); break;
            case 'link': insertAtCursor('[', '](url)', 'link text'); break;
            case 'image': insertAtCursor('![', '](image-url)', 'alt text'); break;
            case 'ul': insertAtCursor('\n- ', '\n', 'list item'); break;
            case 'ol': insertAtCursor('\n1. ', '\n', 'list item'); break;
            case 'code': insertAtCursor('```\n', '\n```', 'code'); break;
            case 'quote': insertAtCursor('\n> ', '\n', 'blockquote'); break;
            case 'hr': insertAtCursor('\n---\n', '', ''); break;
            case 'table': insertAtCursor('\n| Column 1 | Column 2 | Column 3 |\n|----------|----------|----------|\n| ', ' | cell | cell |\n', 'cell'); break;
        }
    });

    // Tab key inserts spaces in textarea
    $(textarea).on('keydown', function(e) {
        if (e.key === 'Tab') {
            e.preventDefault();
            var start = this.selectionStart;
            var end = this.selectionEnd;
            this.value = this.value.substring(0, start) + '    ' + this.value.substring(end);
            this.selectionStart = this.selectionEnd = start + 4;
            updatePreview();
        }
    });

    // Form submit
    $("form#edit_content_form").validate({
        submitHandler: function(form) {
            let btn = Ladda.create(document.querySelector('.submit-btn'));
            btn.start();
            form.submit();
        }
    });

    // Page leave confirmation
    __page_leave_confirmation('#edit_content_form');
});
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>