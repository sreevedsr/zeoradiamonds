<div class="grid grid-cols-1 gap-4 md:grid-cols-3 lg:grid-cols-4"
    @dropdown-selected.window="
    if ($event.detail.merchantSelected) {
        item.item_code = $event.detail.merchantSelected.item_code;
        item.item_name = $event.detail.merchantSelected.item_name;
    }
">

    <!-- Product Code -->
    <div>
        <?php if (isset($component)) { $__componentOriginalc8d1187b2ef4f66f642fdbe432c184c8 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalc8d1187b2ef4f66f642fdbe432c184c8 = $attributes; } ?>
<?php $component = App\View\Components\Input\Text::resolve([] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('input.text'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\App\View\Components\Input\Text::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['label' => 'Product Code','name' => 'product_code','model' => 'item.product_code','placeholder' => 'Enter Product Code','required' => true,'x-bind:class' => 'errors.product_code ? \'border-red-500\' : \'\'']); ?>
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
        <p class="text-red-500 text-xs mt-1" x-text="errors.product_code" x-show="errors.product_code"></p>
    </div>

    <!-- Item Code Dropdown -->
    <div x-data="searchableDropdown({
        apiUrl: '<?php echo e(route('admin.dropdown.fetch', ['type' => 'products'])); ?>',
        optionLabel: 'item_code',
        optionValue: 'id',
        selectedKey: 'merchantSelected'
    })" x-init="init()" class="relative mt-1" @click.outside="open = false">

        <label class="block text-sm font-medium text-gray-700 dark:text-gray-200 mb-1">
            Item Code <span class="text-red-500">*</span>
        </label>

        <!-- Search Input -->
        <input type="text" x-model="searchQuery" placeholder="Search Item Code" required @focus="open = true"
            @input="filterOptions();
                const key = $data.selectedKey;
    const label = $data.optionLabel;

    if ($data[key] && searchQuery !== $data[key][label]) {
        $data[key] = null;
        $data.selectedId = null;
    }"
            @keydown.enter.prevent="
                if (filteredOptions.length > 0) {
                    select(filteredOptions[0]);
                }
            "
            x-bind:class="errors.item_code ? 'border-red-500' : ''"
            class="input-field w-full rounded-md border border-gray-300 px-3 py-2
                focus:outline-none focus:ring-2 focus:ring-purple-600
                dark:border-gray-600 dark:bg-gray-700 dark:text-gray-100
                hover:border-purple-400 transition duration-150" />

        <!-- Dropdown List -->
        <div x-show="open" x-transition
            class="absolute z-10 mt-1 w-full max-h-60 overflow-y-auto rounded-md
                   bg-white dark:bg-gray-800 shadow-lg custom-scrollbar border-0"
            style="top: calc(100% + 0.25rem);">
            <template x-if="filteredOptions.length > 0">
                <ul>
                    <template x-for="option in filteredOptions" :key="option.id">
                        <li @click="select(option)"
                            class="cursor-pointer px-3 py-2 text-sm
                                hover:bg-purple-100 dark:hover:bg-purple-700/40
                                dark:text-gray-100 border-b border-gray-100 dark:border-gray-700 last:border-0">
                            <div class="flex justify-between items-center">
                                <span x-text="option.item_code"></span>
                                <span class="text-xs text-gray-500 ml-1" x-text="option.item_name"></span>
                            </div>
                        </li>
                    </template>
                </ul>
            </template>

            <template x-if="filteredOptions.length === 0">
                <div class="px-3 py-2 text-sm text-gray-500 dark:text-gray-400">
                    No results found
                </div>
            </template>
        </div>

        <input type="hidden" name="item_id" :value="selectedId">

        <p class="text-red-500 text-xs mt-1" x-text="errors.item_code" x-show="errors.item_code"></p>
    </div>

    <!-- Item Name -->
    <div>
        <?php if (isset($component)) { $__componentOriginalc8d1187b2ef4f66f642fdbe432c184c8 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalc8d1187b2ef4f66f642fdbe432c184c8 = $attributes; } ?>
<?php $component = App\View\Components\Input\Text::resolve([] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('input.text'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\App\View\Components\Input\Text::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['label' => 'Item Name','name' => 'item_name','model' => 'item.item_name','placeholder' => 'Auto-filled','required' => true,'x-bind:class' => 'errors.item_name ? \'border-red-500\' : \'\'']); ?>
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
        <p class="text-red-500 text-xs mt-1" x-text="errors.item_name" x-show="errors.item_name"></p>
    </div>

    <!-- Quantity -->
    <div>
        <?php if (isset($component)) { $__componentOriginalc8d1187b2ef4f66f642fdbe432c184c8 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalc8d1187b2ef4f66f642fdbe432c184c8 = $attributes; } ?>
<?php $component = App\View\Components\Input\Text::resolve([] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('input.text'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\App\View\Components\Input\Text::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['type' => 'number','label' => 'Quantity','name' => 'quantity','model' => 'item.quantity','placeholder' => 'Enter Quantity','min' => '1','required' => true,'x-bind:class' => 'errors.quantity ? \'border-red-500\' : \'\'']); ?>
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
        <p class="text-red-500 text-xs mt-1" x-text="errors.quantity" x-show="errors.quantity"></p>
    </div>

    <!-- Gold Rate -->
    <div>
        <?php if (isset($component)) { $__componentOriginalc8d1187b2ef4f66f642fdbe432c184c8 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalc8d1187b2ef4f66f642fdbe432c184c8 = $attributes; } ?>
<?php $component = App\View\Components\Input\Text::resolve([] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('input.text'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\App\View\Components\Input\Text::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['type' => 'number','label' => 'Gold Rate (per unit)','name' => 'gold_rate','x-model' => 'gold_rate','step' => '0.01','placeholder' => 'Auto-filled','required' => true,'x-bind:class' => 'errors.gold_rate ? \'border-red-500\' : \'\'']); ?>
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
        <p class="text-red-500 text-xs mt-1" x-text="errors.gold_rate" x-show="errors.gold_rate"></p>

        <p class="mt-1 text-xs text-gray-500 dark:text-gray-400">
            Auto-fetched from latest gold rate.
        </p>
    </div>

    <!-- Gross Weight -->
    <div>
        <?php if (isset($component)) { $__componentOriginalc8d1187b2ef4f66f642fdbe432c184c8 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalc8d1187b2ef4f66f642fdbe432c184c8 = $attributes; } ?>
<?php $component = App\View\Components\Input\Text::resolve([] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('input.text'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\App\View\Components\Input\Text::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['type' => 'number','label' => 'Gross Weight (g)','name' => 'gross_weight','model' => 'item.gross_weight','step' => '0.001','placeholder' => 'Enter Gross Weight','required' => true,'x-bind:class' => 'errors.gross_weight ? \'border-red-500\' : \'\'']); ?>
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
        <p class="text-red-500 text-xs mt-1" x-text="errors.gross_weight" x-show="errors.gross_weight"></p>
    </div>

    <!-- Stone Weight -->
    <div>
        <?php if (isset($component)) { $__componentOriginalc8d1187b2ef4f66f642fdbe432c184c8 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalc8d1187b2ef4f66f642fdbe432c184c8 = $attributes; } ?>
<?php $component = App\View\Components\Input\Text::resolve([] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('input.text'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\App\View\Components\Input\Text::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['type' => 'number','label' => 'Stone Weight (g)','name' => 'stone_weight','model' => 'item.stone_weight','step' => '0.001','placeholder' => 'Enter Stone Weight','required' => true,'x-bind:class' => 'errors.stone_weight ? \'border-red-500\' : \'\'']); ?>
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
        <p class="text-red-500 text-xs mt-1" x-text="errors.stone_weight" x-show="errors.stone_weight"></p>
    </div>

    <!-- Diamond Weight -->
    <div>
        <?php if (isset($component)) { $__componentOriginalc8d1187b2ef4f66f642fdbe432c184c8 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalc8d1187b2ef4f66f642fdbe432c184c8 = $attributes; } ?>
<?php $component = App\View\Components\Input\Text::resolve([] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('input.text'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\App\View\Components\Input\Text::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['type' => 'number','label' => 'Diamond Weight (ct)','name' => 'diamond_weight','model' => 'item.diamond_weight','step' => '0.001','placeholder' => 'Enter Diamond Weight','required' => true,'x-bind:class' => 'errors.diamond_weight ? \'border-red-500\' : \'\'']); ?>
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
        <p class="text-red-500 text-xs mt-1" x-text="errors.diamond_weight" x-show="errors.diamond_weight"></p>
    </div>

    <!-- Net Weight -->
    <div>
        <?php if (isset($component)) { $__componentOriginalc8d1187b2ef4f66f642fdbe432c184c8 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalc8d1187b2ef4f66f642fdbe432c184c8 = $attributes; } ?>
<?php $component = App\View\Components\Input\Text::resolve([] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('input.text'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\App\View\Components\Input\Text::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['type' => 'number','label' => 'Net Weight (g)','name' => 'net_weight','model' => 'item.net_weight','readonly' => true,'placeholder' => 'Auto-calculated','x-bind:class' => 'errors.net_weight ? \'border-red-500\' : \'\'']); ?>
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

        <!-- Error message -->
        <p class="text-red-500 text-xs mt-1" x-text="errors.net_weight" x-show="errors.net_weight">
        </p>
    </div>


</div>
<?php /**PATH C:\xampp\htdocs\zeoradiamonds\resources\views/admin/purchases/partials/product-section.blade.php ENDPATH**/ ?>