<div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">

    <!-- Stone Amount -->
    <?php if (isset($component)) { $__componentOriginalc8d1187b2ef4f66f642fdbe432c184c8 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalc8d1187b2ef4f66f642fdbe432c184c8 = $attributes; } ?>
<?php $component = App\View\Components\Input\Text::resolve([] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('input.text'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\App\View\Components\Input\Text::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['type' => 'number','label' => 'Stone Amount','name' => 'stone_amount','model' => 'item.stone_amount','min' => '0','step' => '0.01']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginalc8d1187b2ef4f66f642fdbe432c184c8)): ?>
<?php $attributes = $__attributesOriginalc8d1187b2ef4f66f642fdbe432c184c8; ?>
<?php unset($__attributesOriginalc8d1187b2ef4f66f642fdbe432c184c8); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalc8d1187b2ef4f66f642fdbe432c184c8)): ?>
<?php $component = $__componentOriginalc8d1187b2ef4f66f642fdbe432c184c8; ?>
<?php unset($__componentOriginalc8d1187b2ef4f66f642fdbe432c184c8); ?>
<?php endif; ?>

    <!-- Diamond Rate -->
    <div class="space-y-1">
        <?php if (isset($component)) { $__componentOriginalc8d1187b2ef4f66f642fdbe432c184c8 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalc8d1187b2ef4f66f642fdbe432c184c8 = $attributes; } ?>
<?php $component = App\View\Components\Input\Text::resolve([] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('input.text'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\App\View\Components\Input\Text::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['type' => 'number','label' => 'Diamond Rate (per carat)','name' => 'diamond_rate','model' => 'item.diamond_rate','min' => '0','step' => '0.01','x-init' => 'fetchDiamondRate()','required' => true]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginalc8d1187b2ef4f66f642fdbe432c184c8)): ?>
<?php $attributes = $__attributesOriginalc8d1187b2ef4f66f642fdbe432c184c8; ?>
<?php unset($__attributesOriginalc8d1187b2ef4f66f642fdbe432c184c8); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalc8d1187b2ef4f66f642fdbe432c184c8)): ?>
<?php $component = $__componentOriginalc8d1187b2ef4f66f642fdbe432c184c8; ?>
<?php unset($__componentOriginalc8d1187b2ef4f66f642fdbe432c184c8); ?>
<?php endif; ?>
        <p class="text-xs text-gray-500 dark:text-gray-400">
            Auto-fetched from latest diamond rate.
        </p>
    </div>

    <!-- Making Charge -->
    <?php if (isset($component)) { $__componentOriginalc8d1187b2ef4f66f642fdbe432c184c8 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalc8d1187b2ef4f66f642fdbe432c184c8 = $attributes; } ?>
<?php $component = App\View\Components\Input\Text::resolve([] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('input.text'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\App\View\Components\Input\Text::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['type' => 'number','label' => 'Making Charge','name' => 'making_charge','model' => 'item.making_charge','min' => '0','step' => '0.01']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginalc8d1187b2ef4f66f642fdbe432c184c8)): ?>
<?php $attributes = $__attributesOriginalc8d1187b2ef4f66f642fdbe432c184c8; ?>
<?php unset($__attributesOriginalc8d1187b2ef4f66f642fdbe432c184c8); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalc8d1187b2ef4f66f642fdbe432c184c8)): ?>
<?php $component = $__componentOriginalc8d1187b2ef4f66f642fdbe432c184c8; ?>
<?php unset($__componentOriginalc8d1187b2ef4f66f642fdbe432c184c8); ?>
<?php endif; ?>

    <!-- Card Charge -->
    <?php if (isset($component)) { $__componentOriginalc8d1187b2ef4f66f642fdbe432c184c8 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalc8d1187b2ef4f66f642fdbe432c184c8 = $attributes; } ?>
<?php $component = App\View\Components\Input\Text::resolve([] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('input.text'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\App\View\Components\Input\Text::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['type' => 'number','label' => 'Card Charge','name' => 'card_charge','model' => 'item.card_charge','min' => '0','step' => '0.01']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginalc8d1187b2ef4f66f642fdbe432c184c8)): ?>
<?php $attributes = $__attributesOriginalc8d1187b2ef4f66f642fdbe432c184c8; ?>
<?php unset($__attributesOriginalc8d1187b2ef4f66f642fdbe432c184c8); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalc8d1187b2ef4f66f642fdbe432c184c8)): ?>
<?php $component = $__componentOriginalc8d1187b2ef4f66f642fdbe432c184c8; ?>
<?php unset($__componentOriginalc8d1187b2ef4f66f642fdbe432c184c8); ?>
<?php endif; ?>

    <!-- Other Charge -->
    <?php if (isset($component)) { $__componentOriginalc8d1187b2ef4f66f642fdbe432c184c8 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalc8d1187b2ef4f66f642fdbe432c184c8 = $attributes; } ?>
<?php $component = App\View\Components\Input\Text::resolve([] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('input.text'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\App\View\Components\Input\Text::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['type' => 'number','label' => 'Other Charge','name' => 'other_charge','model' => 'item.other_charge','min' => '0','step' => '0.01']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginalc8d1187b2ef4f66f642fdbe432c184c8)): ?>
<?php $attributes = $__attributesOriginalc8d1187b2ef4f66f642fdbe432c184c8; ?>
<?php unset($__attributesOriginalc8d1187b2ef4f66f642fdbe432c184c8); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalc8d1187b2ef4f66f642fdbe432c184c8)): ?>
<?php $component = $__componentOriginalc8d1187b2ef4f66f642fdbe432c184c8; ?>
<?php unset($__componentOriginalc8d1187b2ef4f66f642fdbe432c184c8); ?>
<?php endif; ?>

    <!-- Total Amount -->
    <div class="col-span-full lg:col-span-2">
        <?php if (isset($component)) { $__componentOriginalc8d1187b2ef4f66f642fdbe432c184c8 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalc8d1187b2ef4f66f642fdbe432c184c8 = $attributes; } ?>
<?php $component = App\View\Components\Input\Text::resolve([] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('input.text'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\App\View\Components\Input\Text::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['type' => 'text','label' => 'Total Amount (Including Gold Rate)','name' => 'total_amount','readonly' => true,'x-bind:value' => 'formatCurrency(item.total_amount || 0)','class' => 'font-semibold text-lg sm:text-xl bg-gray-50 dark:bg-gray-800']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginalc8d1187b2ef4f66f642fdbe432c184c8)): ?>
<?php $attributes = $__attributesOriginalc8d1187b2ef4f66f642fdbe432c184c8; ?>
<?php unset($__attributesOriginalc8d1187b2ef4f66f642fdbe432c184c8); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalc8d1187b2ef4f66f642fdbe432c184c8)): ?>
<?php $component = $__componentOriginalc8d1187b2ef4f66f642fdbe432c184c8; ?>
<?php unset($__componentOriginalc8d1187b2ef4f66f642fdbe432c184c8); ?>
<?php endif; ?>
    </div>

    <!-- Landing Cost -->
    <div class="lg:col-span-2">
        <?php if (isset($component)) { $__componentOriginalc8d1187b2ef4f66f642fdbe432c184c8 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalc8d1187b2ef4f66f642fdbe432c184c8 = $attributes; } ?>
<?php $component = App\View\Components\Input\Text::resolve([] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('input.text'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\App\View\Components\Input\Text::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['type' => 'number','label' => 'Landing Cost','name' => 'landing_cost','model' => 'item.landing_cost','min' => '0','step' => '0.01','class' => 'font-semibold text-base sm:text-lg']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginalc8d1187b2ef4f66f642fdbe432c184c8)): ?>
<?php $attributes = $__attributesOriginalc8d1187b2ef4f66f642fdbe432c184c8; ?>
<?php unset($__attributesOriginalc8d1187b2ef4f66f642fdbe432c184c8); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalc8d1187b2ef4f66f642fdbe432c184c8)): ?>
<?php $component = $__componentOriginalc8d1187b2ef4f66f642fdbe432c184c8; ?>
<?php unset($__componentOriginalc8d1187b2ef4f66f642fdbe432c184c8); ?>
<?php endif; ?>
    </div>

    <!-- Retail & MRP Costs -->
    <div class="col-span-full grid grid-cols-1 sm:grid-cols-2 gap-4">

        <!-- Retail Markup -->
        <div class="space-y-1.5">
            <div class="flex items-center justify-between">
                <label class="text-sm font-medium text-gray-700 dark:text-gray-200">
                    Retail Cost (%)
                </label>
            </div>

            <div class="flex flex-col sm:flex-row sm:items-center gap-2">
                <!-- Retail % Input -->
                <?php if (isset($component)) { $__componentOriginalc8d1187b2ef4f66f642fdbe432c184c8 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalc8d1187b2ef4f66f642fdbe432c184c8 = $attributes; } ?>
<?php $component = App\View\Components\Input\Text::resolve([] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('input.text'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\App\View\Components\Input\Text::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['type' => 'number','name' => 'retail_percent','model' => 'item.retail_percent','min' => '0','step' => '0.01','placeholder' => 'Enter percentage','class' => 'flex-1 text-sm']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginalc8d1187b2ef4f66f642fdbe432c184c8)): ?>
<?php $attributes = $__attributesOriginalc8d1187b2ef4f66f642fdbe432c184c8; ?>
<?php unset($__attributesOriginalc8d1187b2ef4f66f642fdbe432c184c8); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalc8d1187b2ef4f66f642fdbe432c184c8)): ?>
<?php $component = $__componentOriginalc8d1187b2ef4f66f642fdbe432c184c8; ?>
<?php unset($__componentOriginalc8d1187b2ef4f66f642fdbe432c184c8); ?>
<?php endif; ?>

                <!-- Retail Cost Result -->
                <?php if (isset($component)) { $__componentOriginalc8d1187b2ef4f66f642fdbe432c184c8 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalc8d1187b2ef4f66f642fdbe432c184c8 = $attributes; } ?>
<?php $component = App\View\Components\Input\Text::resolve([] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('input.text'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\App\View\Components\Input\Text::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['type' => 'text','name' => 'retail_cost','readonly' => true,'x-bind:value' => 'formatCurrency(item.retail_cost || 0)','class' => 'flex-1 bg-gray-50 dark:bg-gray-800 font-medium text-gray-800 dark:text-gray-100']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginalc8d1187b2ef4f66f642fdbe432c184c8)): ?>
<?php $attributes = $__attributesOriginalc8d1187b2ef4f66f642fdbe432c184c8; ?>
<?php unset($__attributesOriginalc8d1187b2ef4f66f642fdbe432c184c8); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalc8d1187b2ef4f66f642fdbe432c184c8)): ?>
<?php $component = $__componentOriginalc8d1187b2ef4f66f642fdbe432c184c8; ?>
<?php unset($__componentOriginalc8d1187b2ef4f66f642fdbe432c184c8); ?>
<?php endif; ?>
            </div>
        </div>

        <!-- MRP Margin -->
        <div class="space-y-1.5">
            <div class="flex items-center justify-between">
                <label class="text-sm font-medium text-gray-700 dark:text-gray-200">
                    MRP Cost (%)
                </label>
            </div>

            <div class="flex flex-col sm:flex-row sm:items-center gap-2">
                <!-- MRP % Input -->
                <?php if (isset($component)) { $__componentOriginalc8d1187b2ef4f66f642fdbe432c184c8 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalc8d1187b2ef4f66f642fdbe432c184c8 = $attributes; } ?>
<?php $component = App\View\Components\Input\Text::resolve([] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('input.text'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\App\View\Components\Input\Text::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['type' => 'number','name' => 'mrp_percent','model' => 'item.mrp_percent','min' => '0','step' => '0.01','placeholder' => 'Enter percentage','class' => 'flex-1 text-sm']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginalc8d1187b2ef4f66f642fdbe432c184c8)): ?>
<?php $attributes = $__attributesOriginalc8d1187b2ef4f66f642fdbe432c184c8; ?>
<?php unset($__attributesOriginalc8d1187b2ef4f66f642fdbe432c184c8); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalc8d1187b2ef4f66f642fdbe432c184c8)): ?>
<?php $component = $__componentOriginalc8d1187b2ef4f66f642fdbe432c184c8; ?>
<?php unset($__componentOriginalc8d1187b2ef4f66f642fdbe432c184c8); ?>
<?php endif; ?>

                <!-- MRP Cost Result -->
                <?php if (isset($component)) { $__componentOriginalc8d1187b2ef4f66f642fdbe432c184c8 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalc8d1187b2ef4f66f642fdbe432c184c8 = $attributes; } ?>
<?php $component = App\View\Components\Input\Text::resolve([] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('input.text'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\App\View\Components\Input\Text::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['type' => 'text','name' => 'mrp_cost','readonly' => true,'x-bind:value' => 'formatCurrency(item.mrp_cost || 0)','class' => 'flex-1 bg-gray-50 dark:bg-gray-800 font-medium text-gray-800 dark:text-gray-100']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginalc8d1187b2ef4f66f642fdbe432c184c8)): ?>
<?php $attributes = $__attributesOriginalc8d1187b2ef4f66f642fdbe432c184c8; ?>
<?php unset($__attributesOriginalc8d1187b2ef4f66f642fdbe432c184c8); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalc8d1187b2ef4f66f642fdbe432c184c8)): ?>
<?php $component = $__componentOriginalc8d1187b2ef4f66f642fdbe432c184c8; ?>
<?php unset($__componentOriginalc8d1187b2ef4f66f642fdbe432c184c8); ?>
<?php endif; ?>
            </div>
        </div>

    </div>



</div>
<?php /**PATH C:\xampp\htdocs\Zeeyame\resources\views/admin/purchases/partials/pricing-section.blade.php ENDPATH**/ ?>