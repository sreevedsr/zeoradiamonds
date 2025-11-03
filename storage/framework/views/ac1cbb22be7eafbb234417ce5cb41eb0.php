<?php if (isset($component)) { $__componentOriginal9ac128a9029c0e4701924bd2d73d7f54 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal9ac128a9029c0e4701924bd2d73d7f54 = $attributes; } ?>
<?php $component = App\View\Components\AppLayout::resolve([] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('app-layout'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\App\View\Components\AppLayout::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
    <?php $__env->slot('title', 'Zeeyame - Diamond Certificates'); ?>

    <h2 class="mb-6 text-2xl font-semibold text-gray-700 dark:text-gray-200">
        Manage Diamond Certificates
    </h2>

    <!-- Assign Certificate Section -->
    <div class="mx-auto mb-8 rounded-lg bg-white p-6 shadow dark:bg-gray-800">
        

        <!-- Success Message -->
        <?php if(session('success')): ?>
            <div class="mb-4 rounded-md border border-green-300 bg-green-100 p-3 text-green-700">
                <?php echo e(session('success')); ?>

            </div>
        <?php endif; ?>
        <?php if(session('info')): ?>
            <div class="mb-4 rounded-md border border-green-300 bg-green-100 p-3 text-green-700">
                <?php echo e(session('info')); ?>

            </div>
        <?php endif; ?>
        <form method="POST" action="<?php echo e(route('admin.products.assign')); ?>" x-data="{
            merchantSearch: '',
            cardSearch: '',
            selectedMerchant: null,
            selectedCard: null
        }">
            <?php echo csrf_field(); ?>

            <div class="grid grid-cols-1 gap-6 rounded-xl md:grid-cols-2 mb-3">
                <!-- Merchant Selection -->
                <div
                    class="overflow-hidden rounded-xl bg-white shadow-sm transition-all duration-200 hover:shadow-md dark:bg-gray-800">

                    <div class="border-b border-gray-100 p-5 dark:border-gray-700">
                        <h3 class="flex items-center gap-2 text-lg font-semibold text-gray-800 dark:text-gray-200">
                            <svg xmlns="http://www.w3.org/2000/svg" class="mr-2 h-5 w-5 text-purple-600"
                                viewBox="0 0 20 20" fill="currentColor">
                                <path
                                    d="M13 6a3 3 0 11-6 0 3 3 0 016 0zM18 8a2 2 0 11-4 0 2 2 0 014 0zM14 15a4 4 0 00-8 0v3h8v-3zM6 8a2 2 0 11-4 0 2 2 0 014 0zM16 18v-3a5.972 5.972 0 00-.75-2.906A3.005 3.005 0 0119 15v3h-3zM4.75 12.094A5.973 5.973 0 004 15v3H1v-3a3 3 0 013.75-2.906z" />
                            </svg>
                            Select Merchant
                        </h3>
                    </div>

                    <div class="p-5">
                        <div class="relative mb-4">
                            <div class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-3">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-400"
                                    viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd"
                                        d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z"
                                        clip-rule="evenodd" />
                                </svg>
                            </div>
                            <input type="text" x-model="merchantSearch" placeholder="Search merchant..."
                                class="w-full rounded-lg border border-gray-300 py-3 pl-10 pr-4 transition-all duration-200 focus:border-transparent focus:outline-none focus:ring-2 focus:ring-purple-500 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-100" />
                        </div>

                        <!-- Merchants List -->
                        <div class="custom-scrollbar max-h-64 space-y-3 overflow-y-auto p-2">
                            <?php $__currentLoopData = $merchants; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $merchant): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <template
                                    x-if="'<?php echo e(strtolower($merchant->name . ' ' . $merchant->business_name)); ?>'.includes(merchantSearch.toLowerCase())
">
                                    <div @click="selectedMerchant === <?php echo e($merchant->id); ?> ? selectedMerchant = null : selectedMerchant = <?php echo e($merchant->id); ?>"
                                        :class="selectedMerchant === <?php echo e($merchant->id); ?> ?
                                            'border-purple-500 bg-purple-50 dark:bg-purple-900/30' :
                                            'border-gray-200 dark:border-gray-700 bg-white dark:bg-gray-800'"
                                        class="mb-2 cursor-pointer rounded-lg border p-4 transition-all duration-200 hover:shadow-md">
                                        <div class="flex items-center justify-between">
                                            <div>
                                                <h4 class="font-semibold text-gray-800 dark:text-gray-200">
                                                    <?php echo e($merchant->name); ?>

                                                </h4>
                                                <p class="text-sm text-gray-500 dark:text-gray-400">
                                                    <?php echo e($merchant->business_name); ?>

                                                </p>
                                            </div>
                                            <template x-if="selectedMerchant === <?php echo e($merchant->id); ?>">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-purple-600"
                                                    fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        stroke-width="2" d="M5 13l4 4L19 7" />
                                                </svg>
                                            </template>
                                        </div>
                                    </div>
                                </template>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </div>

                        <!-- Reset button (appears when selected) -->
                        <div class="mt-4" x-show="selectedMerchant" x-transition>
                            <button type="button" @click="selectedMerchant = null"
                                class="rounded-md bg-gray-200 px-4 py-2 text-sm text-gray-800 transition hover:bg-gray-300 dark:bg-gray-700 dark:text-gray-200 dark:hover:bg-gray-600">
                                Unselect Merchant
                            </button>
                        </div>
                    </div>

                    <!-- Hidden input for selected merchant -->
                    <input type="hidden" name="merchant_id" :value="selectedMerchant">
                </div>

                <!-- Card Selection -->
                <div
                    class="overflow-hidden rounded-xl bg-white shadow-sm transition-all duration-200 hover:shadow-md dark:bg-gray-800">

                    <div class="border-b border-gray-100 p-5 dark:border-gray-700">
                        <h3 class="flex items-center gap-2 text-lg font-semibold text-gray-800 dark:text-gray-200">
                            <svg xmlns="http://www.w3.org/2000/svg" class="mr-2 h-5 w-5 text-purple-600"
                                viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd"
                                    d="M4 4a2 2 0 00-2 2v4a2 2 0 002 2V6h10a2 2 0 00-2-2H4zm2 6a2 2 0 012-2h8a2 2 0 012 2v4a2 2 0 01-2 2H8a2 2 0 01-2-2v-4zm6 4a2 2 0 100-4 2 2 0 000 4z"
                                    clip-rule="evenodd" />
                            </svg>
                            Select Card
                        </h3>
                    </div>

                    <div class="p-5">
                        <!-- Search -->
                        <div class="relative mb-4">
                            <div class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-3">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-400"
                                    viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd"
                                        d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z"
                                        clip-rule="evenodd" />
                                </svg>
                            </div>
                            <input type="text" x-model="cardSearch" placeholder="Search card..."
                                class="w-full rounded-lg border border-gray-300 py-3 pl-10 pr-4 transition-all duration-200 focus:border-transparent focus:outline-none focus:ring-2 focus:ring-purple-500 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-100" />
                        </div>

                        <!-- Cards List -->
                        <div
                            class="custom-scrollbar grid max-h-64 w-full grid-cols-1 gap-3 overflow-y-auto p-2 sm:grid-cols-2">
                            <?php $__currentLoopData = $cards; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $card): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <template
                                    x-if="'<?php echo e(strtolower($card->card_number . ' ' . $card->clarity . ' ' . $card->color . ' ' . $card->cut . ' ' . $card->certificate_id)); ?>'
        .includes(cardSearch.toLowerCase())">

                                    <div @click="selectedCard === <?php echo e($card->id); ?> ? selectedCard = null : selectedCard = <?php echo e($card->id); ?>"
                                        :class="selectedCard === <?php echo e($card->id); ?> ?
                                            'border-purple-500 ring-2 ring-purple-400 ring-offset-2 bg-purple-50 dark:bg-purple-900/30 dark:ring-offset-gray-900' :
                                            'border-gray-200 dark:border-gray-700 bg-white dark:bg-gray-800'"
                                        class="relative cursor-pointer rounded-lg border p-4 transition-all duration-200 hover:border-purple-300 hover:shadow-md">

                                        <div class="flex items-start justify-between">
                                            <div>
                                                <h4 class="font-semibold text-gray-800 dark:text-gray-200">
                                                    Card #<?php echo e($card->certificate_id); ?>

                                                </h4>
                                                <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">
                                                    <?php echo e($card->card_number); ?>

                                                </p>
                                            </div>
                                            <span
                                                class="rounded-full bg-purple-100 px-2 py-1 text-sm font-semibold text-purple-800 dark:bg-purple-900 dark:text-purple-200">
                                                <?php echo e($card->carat_weight); ?>ct
                                            </span>
                                        </div>

                                        <div class="mt-2 flex flex-wrap gap-2">
                                            <span
                                                class="rounded bg-gray-100 px-2 py-1 text-xs text-gray-700 dark:bg-gray-700 dark:text-gray-300">
                                                <?php echo e($card->clarity); ?>

                                            </span>
                                            <span
                                                class="rounded bg-gray-100 px-2 py-1 text-xs text-gray-700 dark:bg-gray-700 dark:text-gray-300">
                                                <?php echo e($card->color); ?>

                                            </span>
                                            <span
                                                class="rounded bg-gray-100 px-2 py-1 text-xs text-gray-700 dark:bg-gray-700 dark:text-gray-300">
                                                <?php echo e($card->cut); ?>

                                            </span>
                                            <template x-if="selectedCard === <?php echo e($card->id); ?>">
                                                <div class="right-3 top-3">
                                                    <svg xmlns="http://www.w3.org/2000/svg"
                                                        class="h-6 w-6 text-purple-600" fill="none"
                                                        viewBox="0 0 24 24" stroke="currentColor">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            stroke-width="2" d="M5 13l4 4L19 7" />
                                                    </svg>
                                                </div>
                                            </template>
                                        </div>

                                    </div>
                                </template>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </div>

                        <!-- Unselect button -->
                        <div class="mt-4" x-show="selectedCard" x-transition>
                            <button type="button" @click="selectedCard = null"
                                class="rounded-md bg-gray-200 px-4 py-2 text-sm text-gray-800 transition hover:bg-gray-300 dark:bg-gray-700 dark:text-gray-200 dark:hover:bg-gray-600">
                                Unselect Card
                            </button>
                        </div>
                    </div>

                    <!-- Hidden input for selected card -->
                    <input type="hidden" name="card_id" :value="selectedCard" required>
                </div>

            </div>

            <style>

            </style>

            <?php if (isset($component)) { $__componentOriginald411d1792bd6cc877d687758b753742c = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginald411d1792bd6cc877d687758b753742c = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.primary-button','data' => ['type' => 'button','xData' => true,'xOn:click.prevent' => '
        if (selectedMerchant && selectedCard) {
            $dispatch(\'open-modal\', \'confirm-assign-modal\');
            document.getElementById(\'assignMerchantForm\').action = \''.e(route('admin.products.assign')).'\';
        } else {
            alert(\'Please select both a merchant and a card before assigning.\');
        }
    ']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('primary-button'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['type' => 'button','x-data' => true,'x-on:click.prevent' => '
        if (selectedMerchant && selectedCard) {
            $dispatch(\'open-modal\', \'confirm-assign-modal\');
            document.getElementById(\'assignMerchantForm\').action = \''.e(route('admin.products.assign')).'\';
        } else {
            alert(\'Please select both a merchant and a card before assigning.\');
        }
    ']); ?>
                <?php echo e(__('Assign Card')); ?>

             <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginald411d1792bd6cc877d687758b753742c)): ?>
<?php $attributes = $__attributesOriginald411d1792bd6cc877d687758b753742c; ?>
<?php unset($__attributesOriginald411d1792bd6cc877d687758b753742c); ?>
<?php endif; ?>
<?php if (isset($__componentOriginald411d1792bd6cc877d687758b753742c)): ?>
<?php $component = $__componentOriginald411d1792bd6cc877d687758b753742c; ?>
<?php unset($__componentOriginald411d1792bd6cc877d687758b753742c); ?>
<?php endif; ?>

            <?php if (isset($component)) { $__componentOriginal9f64f32e90b9102968f2bc548315018c = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal9f64f32e90b9102968f2bc548315018c = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.modal','data' => ['name' => 'confirm-assign-modal','focusable' => true]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('modal'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['name' => 'confirm-assign-modal','focusable' => true]); ?>
                <div class="p-6">
                    <form method="POST" id="assignMerchantForm" class="space-y-6">
                        <?php echo csrf_field(); ?>
                        <input type="hidden" name="merchant_id" :value="selectedMerchant">
                        <input type="hidden" name="card_id" :value="selectedCard">

                        <!-- Modal Header -->
                        <div
                            class="flex items-center justify-between border-b border-gray-200 pb-3 dark:border-gray-700">
                            <h2 class="flex items-center gap-2 text-lg font-semibold text-gray-900 dark:text-gray-100">
                                <svg xmlns="http://www.w3.org/2000/svg"
                                    class="h-5 w-5 text-purple-600 dark:text-purple-400" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M5 13l4 4L19 7" />
                                </svg>
                                <?php echo e(__('Confirm Card Assignment')); ?>

                            </h2>
                            <button type="button" x-on:click="$dispatch('close')"
                                class="text-gray-500 transition hover:text-gray-700 dark:hover:text-gray-300">
                                ✕
                            </button>
                        </div>

                        <!-- Modal Description -->
                        <p class="py-3 text-sm text-gray-600 dark:text-gray-400">
                            <?php echo e(__('Please review and confirm the following assignment details:')); ?>

                        </p>

                        <!-- Assignment Details -->

                        <div class="p-3">
                            <!-- Merchant Info -->
                            <div
                                class="flex items-center justify-between rounded-lg bg-purple-50 px-4 py-3 text-sm transition hover:bg-purple-100 dark:bg-purple-900/30 dark:hover:bg-purple-900/40 mb-3">
                                <span class="flex items-center gap-2 font-medium text-gray-700 dark:text-gray-300">
                                    <svg xmlns="http://www.w3.org/2000/svg"
                                        class="h-4 w-4 text-purple-600 dark:text-purple-400" fill="none"
                                        viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M4 6h16M4 12h16m-7 6h7" />
                                    </svg>
                                    Merchant
                                </span>
                                <template x-if="selectedMerchant">
                                    <span class="ml-2 font-semibold">
                                        <?php $__currentLoopData = $merchants; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $m): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <span x-show="selectedMerchant == <?php echo e($m->id); ?>">
                                                <?php echo e($m->name); ?> <span
                                                    class="text-gray-500 dark:text-gray-400">(<?php echo e($m->business_name); ?>)</span>
                                            </span>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </span>
                                </template>
                            </div>

                            <!-- Card Info -->
                            <div
                                class="flex items-center justify-between rounded-lg bg-purple-50 px-4 py-3 text-sm transition hover:bg-purple-100 dark:bg-purple-900/30 dark:hover:bg-purple-900/40">
                                <span class="flex items-center gap-2 font-medium text-gray-700 dark:text-gray-300">
                                    <svg xmlns="http://www.w3.org/2000/svg"
                                        class="h-4 w-4 text-purple-600 dark:text-purple-400" fill="none"
                                        viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M9 12h6m2 4H7m10-8H7" />
                                    </svg>
                                    Card
                                </span>
                                <template x-if="selectedCard">
                                    <span class="ml-2 font-semibold">
                                        <?php $__currentLoopData = $cards; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $c): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <span x-show="selectedCard == <?php echo e($c->id); ?>">
                                                Card #<?php echo e($c->certificate_id); ?>

                                                <span
                                                    class="text-gray-500 dark:text-gray-400">(<?php echo e($c->card_number); ?>)</span>
                                            </span>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </span>
                                </template>
                            </div>
                        </div>

                        <!-- Action Buttons -->
                        <div class="flex justify-end space-x-3 border-t border-gray-200 pt-4 dark:border-gray-700">
                            <?php if (isset($component)) { $__componentOriginal3b0e04e43cf890250cc4d85cff4d94af = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal3b0e04e43cf890250cc4d85cff4d94af = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.secondary-button','data' => ['type' => 'button','xOn:click' => '$dispatch(\'close\')']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('secondary-button'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['type' => 'button','x-on:click' => '$dispatch(\'close\')']); ?>
                                <?php echo e(__('Cancel')); ?>

                             <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal3b0e04e43cf890250cc4d85cff4d94af)): ?>
<?php $attributes = $__attributesOriginal3b0e04e43cf890250cc4d85cff4d94af; ?>
<?php unset($__attributesOriginal3b0e04e43cf890250cc4d85cff4d94af); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal3b0e04e43cf890250cc4d85cff4d94af)): ?>
<?php $component = $__componentOriginal3b0e04e43cf890250cc4d85cff4d94af; ?>
<?php unset($__componentOriginal3b0e04e43cf890250cc4d85cff4d94af); ?>
<?php endif; ?>

                            <?php if (isset($component)) { $__componentOriginald411d1792bd6cc877d687758b753742c = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginald411d1792bd6cc877d687758b753742c = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.primary-button','data' => []] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('primary-button'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
                                <?php echo e(__('Confirm & Assign')); ?>

                             <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginald411d1792bd6cc877d687758b753742c)): ?>
<?php $attributes = $__attributesOriginald411d1792bd6cc877d687758b753742c; ?>
<?php unset($__attributesOriginald411d1792bd6cc877d687758b753742c); ?>
<?php endif; ?>
<?php if (isset($__componentOriginald411d1792bd6cc877d687758b753742c)): ?>
<?php $component = $__componentOriginald411d1792bd6cc877d687758b753742c; ?>
<?php unset($__componentOriginald411d1792bd6cc877d687758b753742c); ?>
<?php endif; ?>
                        </div>
                    </form>
                </div>
             <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal9f64f32e90b9102968f2bc548315018c)): ?>
<?php $attributes = $__attributesOriginal9f64f32e90b9102968f2bc548315018c; ?>
<?php unset($__attributesOriginal9f64f32e90b9102968f2bc548315018c); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal9f64f32e90b9102968f2bc548315018c)): ?>
<?php $component = $__componentOriginal9f64f32e90b9102968f2bc548315018c; ?>
<?php unset($__componentOriginal9f64f32e90b9102968f2bc548315018c); ?>
<?php endif; ?>

        </form>

    </div>

    <!-- Diamond Certificates Table -->
    <?php if (isset($component)) { $__componentOriginal7d9f6e0b9001f5841f72577781b2d17f = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal7d9f6e0b9001f5841f72577781b2d17f = $attributes; } ?>
<?php $component = App\View\Components\Table::resolve([] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('table'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\App\View\Components\Table::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['headers' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(['Certificate No', 'Merchant', 'Carat', 'Clarity', 'Color', 'Cut', 'Assigned Date']),'from' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($cards->firstItem()),'to' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($cards->lastItem()),'total' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($cards->total()),'pages' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(range(1, $cards->lastPage())),'current' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($cards->currentPage()),'route' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(route('admin.products.assign')),'searchPlaceholder' => 'Search certificates...']); ?>

        <?php $__empty_1 = true; $__currentLoopData = $cards; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $card): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
            <tr class="border-b hover:bg-gray-50 dark:border-gray-700 dark:hover:bg-gray-700">
                <td class="px-4 py-3"><?php echo e($card->certificate_id); ?></td>
                <td class="px-4 py-3"><?php echo e($card->merchant ? $card->merchant->name : '—'); ?></td>
                <td class="px-4 py-3"><?php echo e($card->carat_weight); ?></td>
                <td class="px-4 py-3"><?php echo e($card->clarity); ?></td>
                <td class="px-4 py-3"><?php echo e($card->color); ?></td>
                <td class="px-4 py-3"><?php echo e($card->cut); ?></td>
                <td class="px-4 py-3"><?php echo e($card->created_at->format('d M Y')); ?></td>
            </tr>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
            <tr>
                <td colspan="7" class="px-4 py-4 text-center text-gray-500 dark:text-gray-400">
                    No certificates found.
                </td>
            </tr>
        <?php endif; ?>
     <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal7d9f6e0b9001f5841f72577781b2d17f)): ?>
<?php $attributes = $__attributesOriginal7d9f6e0b9001f5841f72577781b2d17f; ?>
<?php unset($__attributesOriginal7d9f6e0b9001f5841f72577781b2d17f); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal7d9f6e0b9001f5841f72577781b2d17f)): ?>
<?php $component = $__componentOriginal7d9f6e0b9001f5841f72577781b2d17f; ?>
<?php unset($__componentOriginal7d9f6e0b9001f5841f72577781b2d17f); ?>
<?php endif; ?>
 <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal9ac128a9029c0e4701924bd2d73d7f54)): ?>
<?php $attributes = $__attributesOriginal9ac128a9029c0e4701924bd2d73d7f54; ?>
<?php unset($__attributesOriginal9ac128a9029c0e4701924bd2d73d7f54); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal9ac128a9029c0e4701924bd2d73d7f54)): ?>
<?php $component = $__componentOriginal9ac128a9029c0e4701924bd2d73d7f54; ?>
<?php unset($__componentOriginal9ac128a9029c0e4701924bd2d73d7f54); ?>
<?php endif; ?>
<?php /**PATH C:\xampp\htdocs\Zeeyame\resources\views/admin/cards/assign.blade.php ENDPATH**/ ?>