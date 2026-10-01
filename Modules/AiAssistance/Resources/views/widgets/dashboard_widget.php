
<div class="dashboard-section" id="section-ai-intelligence">
    <div class="dashboard-section-header" data-section="ai-intelligence" onclick="toggleDashboardSection('ai-intelligence')">
        <h5>
            <span class="ai-sparkle-icon"><i class="fas fa-brain"></i></span>
            <span class="ai-widget-title">AI Business Intelligence</span>
            <span class="ai-badge-powered">AI-Powered</span>
        </h5>
        <span class="section-toggle"><i class="fas fa-chevron-down"></i></span>
    </div>
    <div class="dashboard-section-body" id="body-ai-intelligence">

        
        <div class="row mb-3">
            <div class="col-lg-3 col-md-6 col-12 mb-2">
                <div class="ai-insight-card" id="ai-insight-stock">
                    <div class="ai-insight-icon" style="background: var(--bs-primary);">
                        <i class="fas fa-boxes"></i>
                    </div>
                    <div class="ai-insight-info">
                        <h4 id="ai_low_stock_count" class="ai-loading">--</h4>
                        <p>Low Stock Items</p>
                    </div>
                    <div class="ai-insight-action">
                        <button class="btn btn-sm ai-action-btn" onclick="runAiTool('smart-reorder', 'Smart Reorder')">
                            <i class="fas fa-magic"></i> AI Fix
                        </button>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-12 mb-2">
                <div class="ai-insight-card" id="ai-insight-customers">
                    <div class="ai-insight-icon" style="background: var(--bs-primary);">
                        <i class="fas fa-user-clock"></i>
                    </div>
                    <div class="ai-insight-info">
                        <h4 id="ai_at_risk_customers" class="ai-loading">--</h4>
                        <p>At-Risk Customers</p>
                    </div>
                    <div class="ai-insight-action">
                        <button class="btn btn-sm ai-action-btn" onclick="runAiTool('followup-suggestions', 'Follow-up')">
                            <i class="fas fa-magic"></i> AI Fix
                        </button>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-12 mb-2">
                <div class="ai-insight-card" id="ai-insight-forecast">
                    <div class="ai-insight-icon" style="background: var(--bs-primary);">
                        <i class="fas fa-chart-line"></i>
                    </div>
                    <div class="ai-insight-info">
                        <h4 id="ai_forecast_trend" class="ai-loading">--</h4>
                        <p>Sales Trend</p>
                    </div>
                    <div class="ai-insight-action">
                        <button class="btn btn-sm ai-action-btn" onclick="runAiTool('sales-insights', 'Sales Insights')">
                            <i class="fas fa-magic"></i> Analyze
                        </button>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-12 mb-2">
                <div class="ai-insight-card" id="ai-insight-expenses">
                    <div class="ai-insight-icon" style="background: var(--bs-primary);">
                        <i class="fas fa-shield-alt"></i>
                    </div>
                    <div class="ai-insight-info">
                        <h4 id="ai_anomaly_count" class="ai-loading">--</h4>
                        <p>Expense Alerts</p>
                    </div>
                    <div class="ai-insight-action">
                        <button class="btn btn-sm ai-action-btn" onclick="runAiTool('expense-anomaly', 'Expense Anomaly')">
                            <i class="fas fa-magic"></i> Detect
                        </button>
                    </div>
                </div>
            </div>
        </div>

        
        <div class="row">
            <div class="col-12">
                <div class="ai-tools-quick-grid">
                    <a href="<?php echo e(url('/aiassistance/bi'), false); ?>" class="ai-quick-tool">
                        <i class="fas fa-chart-pie"></i>
                        <span>Demand Forecast</span>
                    </a>
                    <a href="<?php echo e(url('/aiassistance/bi'), false); ?>" class="ai-quick-tool">
                        <i class="fas fa-boxes"></i>
                        <span>Smart Reorder</span>
                    </a>
                    <a href="<?php echo e(url('/aiassistance/bi'), false); ?>" class="ai-quick-tool">
                        <i class="fas fa-tags"></i>
                        <span>Price Optimize</span>
                    </a>
                    <a href="<?php echo e(url('/aiassistance/bi'), false); ?>" class="ai-quick-tool">
                        <i class="fas fa-users"></i>
                        <span>Segments</span>
                    </a>
                    <a href="<?php echo e(url('/aiassistance/bi/nl-reports/form'), false); ?>" class="ai-quick-tool">
                        <i class="fas fa-comments"></i>
                        <span>Ask AI</span>
                    </a>
                    <a href="<?php echo e(url('/aiassistance/bi/document-extraction/form'), false); ?>" class="ai-quick-tool">
                        <i class="fas fa-file-invoice"></i>
                        <span>Doc Extract</span>
                    </a>
                    <a href="<?php echo e(url('/aiassistance/bi'), false); ?>" class="ai-quick-tool">
                        <i class="fas fa-money-bill-wave"></i>
                        <span>Cash Flow</span>
                    </a>
                    <a href="<?php echo e(url('/aiassistance/bi'), false); ?>" class="ai-quick-tool ai-tool-see-all">
                        <i class="fas fa-th"></i>
                        <span>All 15 Tools</span>
                    </a>
                </div>
            </div>
        </div>

    </div>
</div>


<div class="modal fade" id="aiDashboardResultModal" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content" style="border-radius: 12px; overflow: hidden;">
            <div class="modal-header" style="background: var(--bs-primary); color: #fff; border: none;">
                <h5 class="modal-title" id="aiDashModalTitle">
                    <i class="fas fa-brain"></i> <span>AI Analysis</span>
                </h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body" id="aiDashModalBody" style="max-height: 70vh; overflow-y: auto;">
                <div class="text-center py-4">
                    <div class="ai-analyzing-spinner"></div>
                    <p class="mt-3 text-muted">AI is analyzing your data...</p>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
/* AI Dashboard Widget Styles */
.ai-sparkle-icon {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    width: 28px;
    height: 28px;
    border-radius: 8px;
    background: linear-gradient(135deg, #4F46E5, #7C3AED);
    color: #fff;
    font-size: 14px;
    margin-right: 8px;
}
.ai-widget-title {
    font-weight: 600;
}
.ai-badge-powered {
    display: inline-flex;
    align-items: center;
    font-size: 10px;
    font-weight: 700;
    color: #fff;
    background: linear-gradient(135deg, #4F46E5, #7C3AED);
    padding: 2px 8px;
    border-radius: 10px;
    margin-left: 8px;
    letter-spacing: 0.5px;
    text-transform: uppercase;
    animation: ai-pulse-glow 2s ease-in-out infinite;
}
@keyframes ai-pulse-glow {
    0%, 100% { box-shadow: 0 0 4px rgba(79, 70, 229, 0.3); }
    50% { box-shadow: 0 0 12px rgba(79, 70, 229, 0.6); }
}

.ai-insight-card {
    display: flex;
    align-items: center;
    gap: 12px;
    padding: 14px 16px;
    background: #fff;
    border-radius: 12px;
    border: 1px solid #e5e7eb;
    transition: all 0.2s ease;
    position: relative;
    overflow: hidden;
}
.ai-insight-card::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    height: 3px;
    background: linear-gradient(90deg, #4F46E5, #7C3AED, #EC4899);
    opacity: 0;
    transition: opacity 0.3s;
}
.ai-insight-card:hover {
    border-color: #c7d2fe;
    box-shadow: 0 4px 12px rgba(79, 70, 229, 0.1);
}
.ai-insight-card:hover::before {
    opacity: 1;
}
.ai-insight-icon {
    width: 42px;
    height: 42px;
    border-radius: 10px;
    display: flex;
    align-items: center;
    justify-content: center;
    color: #fff;
    font-size: 18px;
    flex-shrink: 0;
}
.ai-insight-info {
    flex: 1;
    min-width: 0;
}
.ai-insight-info h4 {
    font-size: 1.2rem;
    font-weight: 700;
    margin: 0;
    color: #1f2937;
}
.ai-insight-info p {
    font-size: 0.78rem;
    color: #6b7280;
    margin: 0;
    white-space: nowrap;
    overflow: hidden;
    text-overflow: ellipsis;
}
.ai-action-btn {
    background: linear-gradient(135deg, #4F46E5, #7C3AED);
    color: #fff !important;
    border: none;
    border-radius: 8px;
    font-size: 11px;
    font-weight: 600;
    padding: 5px 10px;
    white-space: nowrap;
    transition: all 0.2s;
}
.ai-action-btn:hover {
    transform: translateY(-1px);
    box-shadow: 0 4px 12px rgba(79, 70, 229, 0.3);
    color: #fff;
}
.ai-loading {
    color: #9ca3af !important;
}

/* AI Quick Tools Grid */
.ai-tools-quick-grid {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(120px, 1fr));
    gap: 8px;
    padding: 4px 0;
}
.ai-quick-tool {
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    gap: 6px;
    padding: 12px 8px;
    background: #f8fafc;
    border: 1px solid #e5e7eb;
    border-radius: 10px;
    text-decoration: none !important;
    color: #374151;
    font-size: 11px;
    font-weight: 500;
    text-align: center;
    transition: all 0.2s ease;
}
.ai-quick-tool i {
    font-size: 18px;
    color: #4F46E5;
}
.ai-quick-tool:hover {
    background: #eef2ff;
    border-color: #a5b4fc;
    color: #4F46E5;
    transform: translateY(-2px);
    box-shadow: 0 4px 12px rgba(79, 70, 229, 0.12);
}
.ai-tool-see-all {
    background: linear-gradient(135deg, #eef2ff, #e0e7ff);
    border-color: #a5b4fc;
    color: #4F46E5;
    font-weight: 700;
}
.ai-tool-see-all:hover {
    background: linear-gradient(135deg, #4F46E5, #7C3AED);
    color: #fff;
}
.ai-tool-see-all:hover i {
    color: #fff;
}

/* AI Analyzing Spinner */
.ai-analyzing-spinner {
    width: 48px;
    height: 48px;
    border: 3px solid #e5e7eb;
    border-top-color: #4F46E5;
    border-radius: 50%;
    animation: ai-spin 0.8s linear infinite;
    margin: 0 auto;
}
@keyframes ai-spin {
    to { transform: rotate(360deg); }
}

/* Dark Mode Support */
html.dark-theme .ai-insight-card {
    background: #1f2937;
    border-color: #374151;
}
html.dark-theme .ai-insight-card:hover {
    border-color: #4F46E5;
}
html.dark-theme .ai-insight-info h4 {
    color: #f3f4f6;
}
html.dark-theme .ai-insight-info p {
    color: #9ca3af;
}
html.dark-theme .ai-quick-tool {
    background: #1f2937;
    border-color: #374151;
    color: #d1d5db;
}
html.dark-theme .ai-quick-tool:hover {
    background: rgba(79, 70, 229, 0.15);
    border-color: #4F46E5;
    color: #a5b4fc;
}
html.dark-theme .ai-tool-see-all {
    background: rgba(79, 70, 229, 0.15);
    border-color: #4F46E5;
    color: #a5b4fc;
}

@media (max-width: 575.98px) {
    .ai-tools-quick-grid {
        grid-template-columns: repeat(4, 1fr);
    }
    .ai-insight-action {
        display: none;
    }
}
</style>

<script>
$(document).ready(function() {
    // Load AI Quick Insights via AJAX
    loadAiQuickInsights();
});

function loadAiQuickInsights() {
    $.ajax({
        url: '<?php echo e(url("/aiassistance/bi/quick-insights"), false); ?>',
        type: 'GET',
        dataType: 'json',
        success: function(data) {
            if (data.success) {
                $('#ai_low_stock_count').removeClass('ai-loading').text(data.low_stock_count || '0');
                $('#ai_at_risk_customers').removeClass('ai-loading').text(data.at_risk_customers || '0');
                $('#ai_forecast_trend').removeClass('ai-loading').html(data.sales_trend || '--');
                $('#ai_anomaly_count').removeClass('ai-loading').text(data.anomaly_alerts || '0');
            }
        },
        error: function() {
            $('#ai_low_stock_count, #ai_at_risk_customers, #ai_forecast_trend, #ai_anomaly_count')
                .removeClass('ai-loading').text('--');
        }
    });
}

function runAiTool(tool, title) {
    var modal = $('#aiDashboardResultModal');
    modal.find('#aiDashModalTitle span').text(title);
    modal.find('#aiDashModalBody').html(
        '<div class="text-center py-4">' +
        '<div class="ai-analyzing-spinner"></div>' +
        '<p class="mt-3 text-muted">AI is analyzing your data...</p>' +
        '</div>'
    );
    modal.modal('show');

    $.ajax({
        url: '<?php echo e(url("/aiassistance/bi"), false); ?>/' + tool,
        type: 'POST',
        data: {
            _token: '<?php echo e(csrf_token(), false); ?>'
        },
        dataType: 'json',
        success: function(response) {
            if (response.success && response.html) {
                modal.find('#aiDashModalBody').html(response.html);
            } else {
                modal.find('#aiDashModalBody').html(
                    '<div class="text-center py-4 text-danger">' +
                    '<i class="fas fa-exclamation-circle fa-2x mb-2"></i>' +
                    '<p>' + (response.msg || 'Analysis failed. Please try again.') + '</p>' +
                    '</div>'
                );
            }
        },
        error: function() {
            modal.find('#aiDashModalBody').html(
                '<div class="text-center py-4 text-danger">' +
                '<i class="fas fa-exclamation-circle fa-2x mb-2"></i>' +
                '<p>Unable to connect. Please try again.</p>' +
                '</div>'
            );
        }
    });
}
</script>
