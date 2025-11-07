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
    <?php $__env->slot('title', 'Supplier Registration'); ?>

    <div class="rounded-lg bg-white p-6 shadow-md dark:bg-gray-800 sm:p-8">
        <div class="mx-auto text-gray-900 dark:text-gray-100">


            <!-- Supplier Registration Form -->
            <form method="POST" action="<?php echo e(route('admin.suppliers.store')); ?>" x-data="purchaseForm()"
                x-init="init();
                enableSequentialInput();
                $nextTick(() => focusFirstInput());">
                <?php echo csrf_field(); ?>

                <div class="grid grid-cols-1 gap-6 md:grid-cols-2" x-data="stateCode(<?php echo e(Js::from($stateCodes)); ?>, '<?php echo e(old('state_code')); ?>', '<?php echo e(old('state')); ?>')">

                    <!-- Supplier Code -->
                    <div>
                        <label for="supplier_code"
                            class="mb-2 block text-sm font-medium text-gray-700 dark:text-gray-200">
                            Supplier Code <span class="text-red-500">*</span>
                        </label>
                        <?php if (isset($component)) { $__componentOriginalc8d1187b2ef4f66f642fdbe432c184c8 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalc8d1187b2ef4f66f642fdbe432c184c8 = $attributes; } ?>
<?php $component = App\View\Components\Input\Text::resolve([] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('input.text'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\App\View\Components\Input\Text::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['name' => 'supplier_code','placeholder' => 'Enter supplier code','required' => true,'class' => 'w-full hover:border-purple-400 transition duration-150']); ?>
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

                    <!-- Supplier Name -->
                    <div>
                        <label for="name" class="mb-2 block text-sm font-medium text-gray-700 dark:text-gray-200">
                            Supplier Name <span class="text-red-500">*</span>
                        </label>
                        <?php if (isset($component)) { $__componentOriginalc8d1187b2ef4f66f642fdbe432c184c8 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalc8d1187b2ef4f66f642fdbe432c184c8 = $attributes; } ?>
<?php $component = App\View\Components\Input\Text::resolve([] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('input.text'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\App\View\Components\Input\Text::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['name' => 'name','placeholder' => 'Enter supplier name','required' => true,'class' => 'w-full hover:border-purple-400 transition duration-150']); ?>
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

                    <!-- Address (kept as plain textarea) -->
                    <div class="md:col-span-2">
                        <label for="address" class="mb-2 block text-sm font-medium text-gray-700 dark:text-gray-200">
                            Address <span class="text-red-500">*</span>
                        </label>
                        <textarea name="address" rows="3" placeholder="Enter full address" required
                            class="input-field w-full rounded-md border border-gray-300 px-3 py-2
                       focus:outline-none focus:ring-2 focus:ring-purple-600
                       dark:border-gray-600 dark:bg-gray-700 dark:text-gray-100"><?php echo e(old('address')); ?></textarea>
                    </div>

                    <!-- Phone No -->
                    <div>
                        <label for="phone" class="mb-2 block text-sm font-medium text-gray-700 dark:text-gray-200">
                            Phone No. <span class="text-red-500">*</span>
                        </label>
                        <?php if (isset($component)) { $__componentOriginalc8d1187b2ef4f66f642fdbe432c184c8 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalc8d1187b2ef4f66f642fdbe432c184c8 = $attributes; } ?>
<?php $component = App\View\Components\Input\Text::resolve([] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('input.text'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\App\View\Components\Input\Text::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['name' => 'phone','placeholder' => 'Enter phone number','pattern' => '[0-9+\-\s]{7,15}','title' => 'Please enter a valid phone number','required' => true,'class' => 'w-full hover:border-purple-400 transition duration-150']); ?>
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



                    <!-- State Code Dropdown (unchanged) -->
                    <div class="relative" x-cloak @click.outside="openDropdown = false">
                        <label class="mb-2 block text-sm font-medium text-gray-700 dark:text-gray-200">
                            State Code <span class="text-red-500">*</span>
                        </label>

                        <div class="relative">
                            <input type="text" placeholder="Search or select state code" x-model="searchQuery"
                                @focus="openDropdown = true" @input="openDropdown = true"
                                @keydown.escape.window="openDropdown = false"
                                @keydown.enter.prevent="if(filteredStates.length>0) selectState(filteredStates[0])"
                                class="block input-field w-full rounded-md border border-gray-300 px-3 py-2 dark:border-gray-600
                           dark:bg-gray-700 dark:text-gray-100 focus:outline-none focus:ring-2 focus:ring-purple-600
                           hover:border-purple-400 transition duration-150">

                            <button type="button" @click="openDropdown = !openDropdown"
                                class="absolute right-2 top-2.5 text-gray-500 dark:text-gray-300">
                                <svg xmlns="http://www.w3.org/2000/svg"
                                    class="h-5 w-5 transition-transform duration-300"
                                    :class="openDropdown ? 'rotate-180' : 'rotate-0'" fill="none" viewBox="0 0 24 24"
                                    stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M19 9l-7 7-7-7" />
                                </svg>
                            </button>
                        </div>

                        <div x-show="openDropdown" x-transition
                            class="absolute z-10 mt-2 max-h-60 w-full overflow-y-auto rounded-lg border border-gray-200
                       bg-white shadow-lg dark:border-gray-700 dark:bg-gray-800 custom-scrollbar">
                            <template x-if="filteredStates.length > 0">
                                <ul>
                                    <template x-for="state in filteredStates" :key="state.state_code">
                                        <li @click="selectState(state)"
                                            class="cursor-pointer px-3 py-2 text-sm hover:bg-purple-100 dark:hover:bg-purple-700/40
                                       dark:text-gray-100 border-b border-gray-100 dark:border-gray-700 last:border-0"
                                            :class="selectedCode === state.state_code ?
                                                'bg-purple-100 dark:bg-purple-700/40 font-medium' : ''">
                                            <div class="flex flex-col">
                                                <span class="text-base font-semibold text-gray-900 dark:text-gray-100"
                                                    x-text="'GST: ' + (state.gstin_code || '-')"></span>
                                                <span class="text-xs text-gray-500 dark:text-gray-400 mt-0.5"
                                                    x-text="state.state_code + ' - ' + state.state_name"></span>
                                            </div>
                                        </li>
                                    </template>
                                </ul>
                            </template>

                            <template x-if="filteredStates.length === 0">
                                <div class="px-3 py-2 text-sm text-gray-500 dark:text-gray-400">
                                    No results found
                                </div>
                            </template>
                        </div>

                        <input type="hidden" name="state_code" x-model="selectedCode" required>
                    </div>

                    <!-- Editable auto-filled state name -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">State <span
                                class="text-red-500">*</span></label>
                        <input type="text" name="state" x-model="selectedState" @input="manualEdit = true"
                            placeholder="Enter or select a state"
                            class="mt-1 input-field block w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-md
                  dark:bg-gray-700 dark:text-gray-100 focus:outline-none focus:ring-2 focus:ring-purple-600
                  hover:border-purple-400 transition duration-150">
                    </div>

                    <!-- GST No -->
                    <div>
                        <label for="gst_no" class="mb-2 block text-sm font-medium text-gray-700 dark:text-gray-200">
                            GST No. <span class="text-red-500">*</span>
                        </label>
                        <?php if (isset($component)) { $__componentOriginalc8d1187b2ef4f66f642fdbe432c184c8 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalc8d1187b2ef4f66f642fdbe432c184c8 = $attributes; } ?>
<?php $component = App\View\Components\Input\Text::resolve([] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('input.text'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\App\View\Components\Input\Text::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['name' => 'gst_no','placeholder' => 'Enter GST number','required' => true,'class' => 'w-full hover:border-purple-400 transition duration-150']); ?>
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

                <!-- Save Button -->
                <div class="mt-6 text-right">
                    <button id="submitBtn" type="submit"
                        class="rounded-md bg-purple-600 px-5 py-2 font-medium text-white
                   hover:bg-purple-700 focus:outline-none focus:ring-2 focus:ring-purple-500">
                        Save
                    </button>
                </div>
            </form>

        </div>
    </div>
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
<?php /**PATH C:\xampp\htdocs\Zeeyame\resources\views/admin/suppliers/create.blade.php ENDPATH**/ ?>