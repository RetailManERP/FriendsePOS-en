<?php
    $seoIsBlog = request()->is('c/blog/*');
    $seoPage = $seoIsBlog ? ($blog ?? null) : ($page ?? null);
    $seoBrand = config('app.name');
    $seoHome = request()->is('/');
    $seoContact = request()->routeIs('cms.contact.us');
    $seoDefaultTitle = $seoHome ? $seoBrand . ' - POS & ERP Software for Retail'
        : ($seoContact ? 'Contact ' . $seoBrand . ' - POS & ERP Enquiries'
        : trim($__env->yieldContent('title')) . ' | ' . $seoBrand);
    $seoTitle = optional($seoPage)->seo_title ?: $seoDefaultTitle;
    $seoDescription = trim(optional($seoPage)->meta_description ?? '');
    // Replace the legacy seed description, but retain owner-written descriptions.
    if ($seoHome && ($seoDescription === '' || str_contains($seoDescription, '40+ AI capabilities:'))) {
        $seoDescription = 'Manage retail sales, inventory, purchases and accounting with ' . $seoBrand . '. Connect business locations, CRM and HR with cloud POS and ERP software.';
    }
    if ($seoDescription === '') {
        $seoDescription = $seoContact
            ? 'Contact ' . $seoBrand . ' to discuss POS and ERP software, inventory, accounting and multi-location requirements. Tell us what your business needs.'
            : (optional($seoPage)->effective_seo_description ?: 'Explore Point of Sale, inventory management and business operations in the ' . $seoBrand . ' blog.');
    }
    $seoCanonical = optional($seoPage)->canonical_url ?: url()->current();
    if (empty(optional($seoPage)->canonical_url) && $seoIsBlog && isset($blog)) {
        $seoCanonical = action([\Modules\Cms\Http\Controllers\CmsController::class, 'viewBlog'], ['slug' => $blog->slug, 'id' => $blog->id]);
    } elseif (empty(optional($seoPage)->canonical_url) && $seoPage) {
        if ($seoPage->layout === 'home') {
            $seoCanonical = url('/');
        } elseif ($seoPage->layout === 'contact') {
            $seoCanonical = route('cms.contact.us');
        } elseif ($seoPage->type === 'page') {
            $seoCanonical = action([\Modules\Cms\Http\Controllers\CmsPageController::class, 'showPage'], ['page' => $seoPage->slug]);
        }
    }
    $seoImage = optional($seoPage)->og_image_url;
    $seoCanonical = \App\Support\PublicSeo::canonical($seoCanonical);
    $seoOrigin = \App\Support\PublicSeo::canonical(url('/'));
    $seoType = $seoIsBlog ? 'article' : 'website';
    $seoNoindex = isset($blogs) && $blogs->isEmpty();
    $seoSchema = [];
    if ($seoHome) {
        $seoSchema = ['@context' => 'https://schema.org', '@graph' => [
            ['@type' => 'Organization', '@id' => $seoOrigin . '#organization', 'name' => $seoBrand, 'url' => $seoOrigin],
            ['@type' => 'WebSite', '@id' => $seoOrigin . '#website', 'name' => $seoBrand, 'url' => $seoOrigin, 'publisher' => ['@id' => $seoOrigin . '#organization']],
            ['@type' => 'SoftwareApplication', 'name' => $seoBrand, 'url' => $seoOrigin, 'applicationCategory' => 'BusinessApplication', 'description' => $seoDescription],
        ]];
    } else {
        $seoSchema = ['@context' => 'https://schema.org', '@type' => 'BreadcrumbList', 'itemListElement' => [
            ['@type' => 'ListItem', 'position' => 1, 'name' => $seoBrand, 'item' => $seoOrigin],
            ['@type' => 'ListItem', 'position' => 2, 'name' => optional($seoPage)->title ?: trim($__env->yieldContent('title')), 'item' => $seoCanonical],
        ]];
    }
    if (isset($landingGroup)) {
        $seoTitle = ($landing['title'] ?? ($landingGroup === 'features' ? 'POS & ERP Features and Modules' : 'POS & ERP Software by Industry')) . ' | ' . $seoBrand;
        $seoDescription = $landing['description'] ?? ($landingGroup === 'features'
            ? 'Explore POS, inventory, manufacturing, repair, rental, warehouse and ecommerce modules. Find connected business workflows and practical setup guides.'
            : 'Explore POS and ERP workflows for retail, pharmacy retail, electronics, repair, rental, manufacturing, distribution and ecommerce businesses.');
        $seoCanonical = \App\Support\PublicSeo::canonical(url($landingGroup . (isset($landing['slug']) ? '/' . $landing['slug'] : '')));
        $seoSchema = ['@context' => 'https://schema.org', '@type' => 'BreadcrumbList', 'itemListElement' => [
            ['@type' => 'ListItem', 'position' => 1, 'name' => 'Home', 'item' => $seoOrigin],
            ['@type' => 'ListItem', 'position' => 2, 'name' => ucfirst($landingGroup), 'item' => \App\Support\PublicSeo::canonical(url($landingGroup))],
        ]];
        if ($landing) {
            $seoSchema['itemListElement'][] = ['@type' => 'ListItem', 'position' => 3, 'name' => $landing['title'], 'item' => $seoCanonical];
        }
    }
?>
<title><?php echo e($seoTitle, false); ?></title>
<?php echo $__env->make('layouts.partials.seo', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
