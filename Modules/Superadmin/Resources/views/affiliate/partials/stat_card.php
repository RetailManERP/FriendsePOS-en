
<?php
    $bg = $bg ?? 'tw-bg-sky-100';
    $text = $text ?? 'tw-text-sky-500';
    $is_currency = $is_currency ?? false;
?>
<div
    class="tw-transition-all tw-duration-200 tw-bg-white tw-shadow-sm tw-rounded-xl hover:tw-shadow-md hover:tw--translate-y-0.5 tw-ring-1 tw-ring-gray-200">
    <div class="tw-p-4 sm:tw-p-5">
        <div class="tw-flex tw-items-center tw-gap-4">
            <div
                class="tw-inline-flex tw-items-center tw-justify-center tw-w-10 tw-h-10 tw-rounded-full sm:tw-w-12 sm:tw-h-12 shrink-0 <?php echo e($bg, false); ?> <?php echo e($text, false); ?>">
                <svg aria-hidden="true" class="tw-w-6 tw-h-6" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"
                    stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                    <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                    <?php echo $icon; ?>

                </svg>
            </div>

            <div class="tw-flex-1 tw-min-w-0">
                <p class="tw-text-sm tw-font-medium tw-text-gray-500 tw-truncate tw-whitespace-nowrap">
                    <?php echo e($label, false); ?>

                </p>
                <p class="tw-mt-0.5 tw-text-gray-900 tw-text-xl tw-truncate tw-font-semibold tw-tracking-tight tw-font-mono <?php if($is_currency): ?> display_currency <?php endif; ?>"
                    <?php if($is_currency): ?> data-currency_symbol="true" data-use_page_currency="true" <?php endif; ?>>
                    <?php echo e($value, false); ?>

                </p>
            </div>
        </div>
    </div>
</div>
