
<?php $__env->startSection('title', __('aiassistance::lang.ai_business_intelligence') . ' — Feature Showcase'); ?>

<?php $__env->startSection('css'); ?>
<style>
/* AI Feature Showcase Page */
.ai-showcase-hero {
    background: var(--bs-primary);
    color: #fff;
    padding: 60px 30px;
    text-align: center;
    position: relative;
    overflow: hidden;
    border-radius: 0 0 24px 24px;
}
.ai-showcase-hero::before {
    content: '';
    position: absolute;
    top: -60px;
    right: -60px;
    width: 300px;
    height: 300px;
    border-radius: 50%;
    background: rgba(255,255,255,0.03);
}
.ai-showcase-hero::after {
    content: '';
    position: absolute;
    bottom: -80px;
    left: -40px;
    width: 350px;
    height: 350px;
    border-radius: 50%;
    background: rgba(255,255,255,0.02);
}
.showcase-hero-content {
    position: relative;
    z-index: 2;
    max-width: 700px;
    margin: 0 auto;
}
.showcase-ai-icon {
    width: 80px;
    height: 80px;
    border-radius: 20px;
    background: rgba(255,255,255,0.12);
    border: 1px solid rgba(255,255,255,0.2);
    display: inline-flex;
    align-items: center;
    justify-content: center;
    font-size: 36px;
    margin-bottom: 20px;
    animation: showcase-float 3s ease-in-out infinite;
}
@keyframes showcase-float {
    0%, 100% { transform: translateY(0); }
    50% { transform: translateY(-8px); }
}
.showcase-title {
    font-size: 2.4rem;
    font-weight: 800;
    margin-bottom: 12px;
    letter-spacing: -0.5px;
}
.showcase-subtitle {
    font-size: 1.1rem;
    opacity: 0.85;
    max-width: 550px;
    margin: 0 auto 24px;
    line-height: 1.6;
}
.showcase-stats {
    display: flex;
    justify-content: center;
    gap: 40px;
    margin-top: 30px;
}
.showcase-stat {
    text-align: center;
}
.showcase-stat-value {
    font-size: 2rem;
    font-weight: 800;
    display: block;
}
.showcase-stat-label {
    font-size: 0.8rem;
    opacity: 0.7;
    text-transform: uppercase;
    letter-spacing: 1px;
}

/* Tier Sections */
.showcase-tier {
    padding: 30px 20px;
}
.tier-header {
    text-align: center;
    margin-bottom: 30px;
}
.tier-badge {
    display: inline-block;
    padding: 4px 16px;
    border-radius: 20px;
    font-size: 0.75rem;
    font-weight: 700;
    letter-spacing: 0.5px;
    text-transform: uppercase;
    margin-bottom: 10px;
    background: rgba(var(--bs-primary-rgb), 0.1);
    color: var(--bs-primary);
}
.tier-badge.tier1, .tier-badge.tier2, .tier-badge.tier3,
.tier-badge.tier4, .tier-badge.tier5, .tier-badge.tier6 {
    background: rgba(var(--bs-primary-rgb), 0.1);
    color: var(--bs-primary);
}
.tier-title {
    font-size: 1.5rem;
    font-weight: 700;
    color: #1f2937;
    margin-bottom: 6px;
}
.tier-desc {
    color: #6b7280;
    font-size: 0.9rem;
}

/* Feature Cards */
.showcase-card {
    background: #fff;
    border: 1px solid #e5e7eb;
    border-radius: 16px;
    padding: 24px;
    height: 100%;
    transition: all 0.3s ease;
    position: relative;
    overflow: hidden;
}
.showcase-card::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    height: 4px;
    background: var(--bs-primary);
    opacity: 0;
    transition: opacity 0.3s;
}
.showcase-card:hover {
    transform: translateY(-4px);
    box-shadow: 0 12px 40px rgba(var(--bs-primary-rgb), 0.12);
    border-color: rgba(var(--bs-primary-rgb), 0.3);
}
.showcase-card:hover::before {
    opacity: 1;
}
.showcase-card-icon {
    width: 48px;
    height: 48px;
    border-radius: 12px;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 20px;
    color: #fff;
    margin-bottom: 14px;
}
.showcase-card-icon.tier1-icon,
.showcase-card-icon.tier2-icon,
.showcase-card-icon.tier3-icon,
.showcase-card-icon.tier4-icon,
.showcase-card-icon.tier5-icon,
.showcase-card-icon.tier6-icon { background: var(--bs-primary); }
.showcase-card h5 {
    font-size: 1rem;
    font-weight: 700;
    color: #1f2937;
    margin-bottom: 8px;
}
.showcase-card p {
    font-size: 0.82rem;
    color: #6b7280;
    line-height: 1.5;
    margin-bottom: 0;
}

/* CTA Section */
.showcase-cta {
    background: linear-gradient(135deg, #f0f4ff 0%, #e8ecff 100%);
    border-radius: 16px;
    padding: 40px 30px;
    text-align: center;
    margin: 30px 20px;
}
.showcase-cta h3 {
    font-size: 1.5rem;
    font-weight: 700;
    color: #1f2937;
    margin-bottom: 12px;
}
.showcase-cta p {
    color: #6b7280;
    font-size: 0.9rem;
    margin-bottom: 20px;
}
.btn-showcase-cta {
    display: inline-flex;
    align-items: center;
    gap: 8px;
    background: var(--bs-primary);
    color: #fff;
    border: none;
    padding: 12px 28px;
    border-radius: 12px;
    font-weight: 600;
    font-size: 0.95rem;
    text-decoration: none;
    transition: all 0.2s;
    box-shadow: 0 4px 14px rgba(var(--bs-primary-rgb), 0.3);
}
.btn-showcase-cta:hover {
    transform: translateY(-2px);
    box-shadow: 0 8px 24px rgba(var(--bs-primary-rgb), 0.4);
    color: #fff;
    text-decoration: none;
}

/* Dark Mode */
html.dark-theme .showcase-card { background: #1f2937; border-color: #374151; }
html.dark-theme .showcase-card:hover { border-color: var(--bs-primary); }
html.dark-theme .showcase-card h5 { color: #f3f4f6; }
html.dark-theme .showcase-card p { color: #9ca3af; }
html.dark-theme .tier-title { color: #f3f4f6; }
html.dark-theme .tier-desc { color: #9ca3af; }
html.dark-theme .showcase-cta { background: rgba(var(--bs-primary-rgb), 0.15); }
html.dark-theme .showcase-cta h3 { color: #f3f4f6; }
html.dark-theme .showcase-cta p { color: #9ca3af; }

@media (max-width: 767.98px) {
    .showcase-title { font-size: 1.6rem; }
    .showcase-stats { gap: 20px; }
    .showcase-stat-value { font-size: 1.4rem; }
    .ai-showcase-hero { padding: 40px 20px; }
}
</style>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>

<?php echo $__env->make('aiassistance::layouts.nav', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<section class="content no-print">

<div class="ai-showcase-hero">
    <div class="showcase-hero-content">
        <div class="showcase-ai-icon">
            <i class="fas fa-brain"></i>
        </div>
        <h1 class="showcase-title">AI-Powered Business Intelligence</h1>
        <p class="showcase-subtitle">
            Transform your business decisions with 30 AI tools that analyze your real data to deliver actionable insights — no data science degree required.
        </p>
        <div class="showcase-stats">
            <div class="showcase-stat">
                <span class="showcase-stat-value">30</span>
                <span class="showcase-stat-label">AI Tools</span>
            </div>
            <div class="showcase-stat">
                <span class="showcase-stat-value">6</span>
                <span class="showcase-stat-label">Intelligence Tiers</span>
            </div>
            <div class="showcase-stat">
                <span class="showcase-stat-value">∞</span>
                <span class="showcase-stat-label">Insights</span>
            </div>
        </div>
    </div>
</div>


<div class="showcase-tier">
    <div class="tier-header">
        <span class="tier-badge tier1">Tier 1</span>
        <h2 class="tier-title"><?php echo e(__('aiassistance::lang.bi_tier1_title'), false); ?></h2>
        <p class="tier-desc">Core intelligence that directly impacts revenue and inventory management</p>
    </div>
    <div class="row g-3">
        <?php $__currentLoopData = $bi_tools['tier1']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $tool): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <div class="col-lg-4 col-md-6 col-12">
            <div class="showcase-card">
                <div class="showcase-card-icon tier1-icon">
                    <i class="<?php echo e($tool['icon'], false); ?>"></i>
                </div>
                <h5><?php echo e($tool['label'], false); ?></h5>
                <p><?php echo e($tool['description'], false); ?></p>
            </div>
        </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </div>
</div>


<div class="showcase-tier">
    <div class="tier-header">
        <span class="tier-badge tier2">Tier 2</span>
        <h2 class="tier-title"><?php echo e(__('aiassistance::lang.bi_tier2_title'), false); ?></h2>
        <p class="tier-desc">Advanced analytics that set your business apart from competitors</p>
    </div>
    <div class="row g-3">
        <?php $__currentLoopData = $bi_tools['tier2']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $tool): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <div class="col-lg-4 col-md-6 col-12">
            <div class="showcase-card">
                <div class="showcase-card-icon tier2-icon">
                    <i class="<?php echo e($tool['icon'], false); ?>"></i>
                </div>
                <h5><?php echo e($tool['label'], false); ?></h5>
                <p><?php echo e($tool['description'], false); ?></p>
            </div>
        </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </div>
</div>


<div class="showcase-tier">
    <div class="tier-header">
        <span class="tier-badge tier3">Tier 3</span>
        <h2 class="tier-title"><?php echo e(__('aiassistance::lang.bi_tier3_title'), false); ?></h2>
        <p class="tier-desc">Operational intelligence for loss prevention, staffing, and supplier management</p>
    </div>
    <div class="row g-3">
        <?php $__currentLoopData = $bi_tools['tier3']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $tool): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <div class="col-lg-4 col-md-6 col-12">
            <div class="showcase-card">
                <div class="showcase-card-icon tier3-icon">
                    <i class="<?php echo e($tool['icon'], false); ?>"></i>
                </div>
                <h5><?php echo e($tool['label'], false); ?></h5>
                <p><?php echo e($tool['description'], false); ?></p>
            </div>
        </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </div>
</div>


<div class="showcase-tier-section" style="margin-top: 40px;">
    <div style="margin-bottom: 18px;">
        <span class="tier-badge tier4"><?php echo app('translator')->get('aiassistance::lang.bi_tier4_title'); ?></span>
        <p class="tier-desc">Essential 2026 capabilities — daily briefings, smart search, receipt scanning & auto-categorization</p>
    </div>
    <div class="row g-3">
        <?php $__currentLoopData = $bi_tools['tier4']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $tool): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <div class="col-lg-4 col-md-6 col-12">
            <div class="showcase-card">
                <div class="showcase-card-icon tier4-icon">
                    <i class="<?php echo e($tool['icon'], false); ?>"></i>
                </div>
                <h5><?php echo e($tool['label'], false); ?></h5>
                <p><?php echo e($tool['description'], false); ?></p>
            </div>
        </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </div>
</div>


<div class="showcase-tier-section" style="margin-top: 40px;">
    <div style="margin-bottom: 18px;">
        <span class="tier-badge tier5"><?php echo app('translator')->get('aiassistance::lang.bi_tier5_title'); ?></span>
        <p class="tier-desc">Impressive AI capabilities — voice commands, marketing campaigns, smart discounts & credit scoring</p>
    </div>
    <div class="row g-3">
        <?php $__currentLoopData = $bi_tools['tier5']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $tool): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <div class="col-lg-4 col-md-6 col-12">
            <div class="showcase-card">
                <div class="showcase-card-icon tier5-icon">
                    <i class="<?php echo e($tool['icon'], false); ?>"></i>
                </div>
                <h5><?php echo e($tool['label'], false); ?></h5>
                <p><?php echo e($tool['description'], false); ?></p>
            </div>
        </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </div>
</div>


<div class="showcase-tier-section" style="margin-top: 40px;">
    <div style="margin-bottom: 18px;">
        <span class="tier-badge tier6"><?php echo app('translator')->get('aiassistance::lang.bi_tier6_title'); ?></span>
        <p class="tier-desc">Next-generation intelligence — expiry prediction, tax optimization, translation & competitive analysis</p>
    </div>
    <div class="row g-3">
        <?php $__currentLoopData = $bi_tools['tier6']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $tool): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <div class="col-lg-4 col-md-6 col-12">
            <div class="showcase-card">
                <div class="showcase-card-icon tier6-icon">
                    <i class="<?php echo e($tool['icon'], false); ?>"></i>
                </div>
                <h5><?php echo e($tool['label'], false); ?></h5>
                <p><?php echo e($tool['description'], false); ?></p>
            </div>
        </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </div>
</div>


<div class="showcase-cta">
    <h3><i class="fas fa-rocket" style="color: var(--bs-primary);"></i> Ready to Get Started?</h3>
    <p>Access all 30 AI-powered tools from your BI Dashboard and start making data-driven decisions today.</p>
    <a href="<?php echo e(url('/aiassistance/bi'), false); ?>" class="btn-showcase-cta">
        <i class="fas fa-brain"></i> Open AI Dashboard
    </a>
</div>

</section>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>