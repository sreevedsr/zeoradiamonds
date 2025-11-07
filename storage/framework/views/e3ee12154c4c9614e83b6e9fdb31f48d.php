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
    <?php $__env->slot('title', 'Add Merchant'); ?>

    <div class="mx-auto">
        <div class="p-6 sm:p-8 bg-white dark:bg-gray-800 shadow-md rounded-lg">

            <form action="<?php echo e(route('admin.merchants.store')); ?>" method="POST" x-data="purchaseForm()"
                x-init="init();
                enableSequentialInput();
                $nextTick(() => focusFirstInput());">
                <?php echo csrf_field(); ?>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6" x-data="stateCode(<?php echo e(Js::from($stateCodes)); ?>, '<?php echo e(old('state_code')); ?>', '<?php echo e(old('state')); ?>')">

                    <!-- Merchant Code -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                            Merchant Code <span class="text-red-500">*</span>
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
<?php $component->withAttributes(['name' => 'merchant_code','placeholder' => 'Enter merchant code','required' => true,'class' => 'mt-1 block hover:border-purple-400 transition duration-150']); ?>
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

                    <!-- Merchant Name -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                            Merchant Name <span class="text-red-500">*</span>
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
<?php $component->withAttributes(['name' => 'merchant_name','placeholder' => 'Enter merchant name','required' => true,'class' => 'mt-1 block hover:border-purple-400 transition duration-150']); ?>
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

                    <!-- Email -->
                    <div>
                        <label for="email" class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                            Email <span class="text-red-500">*</span>
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
<?php $component->withAttributes(['type' => 'email','name' => 'email','placeholder' => 'Enter email address','required' => true,'class' => 'mt-1 block hover:border-purple-400 transition duration-150']); ?>
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


                    <!-- Phone No -->
                    <div>
                        <label for="phone" class="block text-sm font-medium text-gray-700 dark:text-gray-300">
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
<?php $component->withAttributes(['name' => 'phone','placeholder' => 'Enter phone number','required' => true,'class' => 'mt-1 block hover:border-purple-400 transition duration-150']); ?>
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


                    <!-- Address (Full Width) -->
                    <div class="md:col-span-2">
                        <label for="address" class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                            Address <span class="text-red-500">*</span
                        </label>
                        <?php if (isset($component)) { $__componentOriginalb6d9f6b7453177a93fa45e3d5011f00a = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalb6d9f6b7453177a93fa45e3d5011f00a = $attributes; } ?>
<?php $component = App\View\Components\Input\Textarea::resolve([] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('input.textarea'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\App\View\Components\Input\Textarea::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['name' => 'address','rows' => '3','placeholder' => 'Enter full address','required' => true,'class' => 'mt-1 block hover:border-purple-400 transition duration-150']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginalb6d9f6b7453177a93fa45e3d5011f00a)): ?>
<?php $attributes = $__attributesOriginalb6d9f6b7453177a93fa45e3d5011f00a; ?>
<?php unset($__attributesOriginalb6d9f6b7453177a93fa45e3d5011f00a); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalb6d9f6b7453177a93fa45e3d5011f00a)): ?>
<?php $component = $__componentOriginalb6d9f6b7453177a93fa45e3d5011f00a; ?>
<?php unset($__componentOriginalb6d9f6b7453177a93fa45e3d5011f00a); ?>
<?php endif; ?>
                    </div>


                    <!-- State Code Dropdown -->
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
                                                <!-- GST Number - emphasized -->
                                                <span class="text-base font-semibold text-gray-900 dark:text-gray-100"
                                                    x-text="'GST: ' + (state.gstin_code || '-')"></span>

                                                <!-- State Code and Name - secondary -->
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

                        <!-- Hidden input for form -->
                        <input type="hidden" name="state_code" x-model="selectedCode" required>
                    </div>

                    <!-- Editable auto-filled state name -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">State <span class="text-red-500">*</span></label>
                        <input type="text" name="state" x-model="selectedState" @input="manualEdit = true"
                            placeholder="Enter or select a state"
                            class="mt-1 input-field block w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-md
                  dark:bg-gray-700 dark:text-gray-100 focus:outline-none focus:ring-2 focus:ring-purple-600
                  hover:border-purple-400 transition duration-150">
                    </div>

                    <!-- GST No -->
                    <div>
                        <label for="gst_no" class="block text-sm font-medium text-gray-700 dark:text-gray-300">
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
<?php $component->withAttributes(['name' => 'gst_no','placeholder' => 'Enter GST number','required' => true,'class' => 'mt-1 block hover:border-purple-400 transition duration-150']); ?>
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

                <!-- Submit -->
                <div class="flex justify-start pt-4">
                    <button x-ref="submitBtn" type="submit"
                        class="mt-4 px-6 py-2 bg-purple-600 text-white rounded-md hover:bg-purple-700
            focus:outline-none focus:ring-2 focus:ring-purple-500 transition duration-150">
                        Register Merchant
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
<?php /**PATH C:\xampp\htdocs\Zeeyame\resources\views/admin/merchants/create.blade.php ENDPATH**/ ?>