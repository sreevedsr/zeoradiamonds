<div x-data="{ openDropdown: null }" class="grid grid-cols-1 gap-6 md:grid-cols-2">

    <!-- Certificate ID -->
    <div>
        <label class="mb-2 block text-sm font-medium text-gray-700 dark:text-gray-200">
            Certificate ID <span class="text-red-500">*</span>
        </label>

        <input type="text"
               name="certificate_id"
               x-model="item.certificate_id"
               placeholder="Enter unique certificate ID"
               required
               x-bind:class="errors.certificate_id ? 'border-red-500' : ''"
               class="w-full rounded-md border border-gray-300 px-3 py-2 focus:outline-none
                      focus:ring-2 focus:ring-purple-600 dark:border-gray-600
                      dark:bg-gray-700 dark:text-gray-100" />

        <p class="text-red-500 text-xs mt-1" x-text="errors.certificate_id" x-show="errors.certificate_id"></p>
    </div>

    <!-- Color -->
    <div x-data="{ open: false }" class="relative">
        <label class="mb-2 block text-sm font-medium text-gray-700 dark:text-gray-200">
            Color <span class="text-red-500">*</span>
        </label>

        <button type="button"
                @click="open = !open"
                x-bind:class="errors.color ? 'border-red-500' : ''"
                class="flex w-full items-center justify-between rounded-md border border-gray-300 px-3 py-2
                       focus:outline-none focus:ring-2 focus:ring-purple-600 dark:border-gray-600
                       dark:bg-gray-700 dark:text-gray-100">

            <span x-text="item.color || 'Select diamond color'"
                  :class="item.color ? 'text-gray-900 dark:text-gray-100' : 'text-gray-400'"></span>

            <svg xmlns="http://www.w3.org/2000/svg"
                 class="ml-2 h-4 w-4 transform transition-transform duration-300"
                 :class="open ? 'rotate-180' : 'rotate-0'"
                 fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
            </svg>
        </button>

        <div x-show="open"
             @click.outside="open = false"
             x-transition
             class="absolute z-10 mt-2 grid w-full grid-cols-7 gap-2 rounded-lg border border-gray-200
                    bg-white p-3 shadow-lg dark:border-gray-700 dark:bg-gray-800">

            <?php $__currentLoopData = range('D','Z'); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $color): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div @click="item.color='<?php echo e($color); ?>'; open=false"
                     class="cursor-pointer select-none rounded-md border px-3 py-2 text-center text-sm font-medium transition-all duration-200"
                     :class="{
                         'border-purple-600 bg-purple-100 dark:bg-purple-700 text-purple-900 dark:text-white shadow-sm':
                             item.color === '<?php echo e($color); ?>',
                         'border-gray-300 dark:border-gray-600 hover:border-purple-400 hover:bg-purple-50 dark:hover:border-purple-400 dark:hover:bg-purple-700/30 dark:text-gray-200':
                             item.color !== '<?php echo e($color); ?>'
                     }">
                    <?php echo e($color); ?>

                </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

        </div>

        <p class="text-red-500 text-xs mt-1" x-text="errors.color" x-show="errors.color"></p>
    </div>


    <!-- Clarity -->
    <div x-data="{ open: false }" class="relative">
        <label class="mb-2 block text-sm font-medium text-gray-700 dark:text-gray-200">
            Clarity <span class="text-red-500">*</span>
        </label>

        <button type="button"
                @click="open = !open"
                x-bind:class="errors.clarity ? 'border-red-500' : ''"
                class="flex w-full items-center justify-between rounded-md border border-gray-300 px-3 py-2
                       focus:outline-none focus:ring-2 focus:ring-purple-600 dark:border-gray-600
                       dark:bg-gray-700 dark:text-gray-100">

            <span x-text="item.clarity || 'Select clarity'"
                  :class="item.clarity ? 'text-gray-900 dark:text-gray-100':'text-gray-400'"></span>

            <svg xmlns="http://www.w3.org/2000/svg"
                 class="h-5 w-5 transition-transform duration-200"
                 :class="{ 'rotate-180': open }"
                 fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
            </svg>
        </button>

        <div x-show="open"
             @click.outside="open=false"
             x-transition
             class="absolute z-10 mt-2 grid max-h-[140px] w-full grid-cols-2 sm:grid-cols-3 lg:grid-cols-5 gap-2 overflow-y-auto
                    rounded-lg border border-gray-200 bg-white p-3 shadow-lg dark:border-gray-700 dark:bg-gray-800">

            <?php $__currentLoopData = ['FL','IF','VVS1','VVS2','VS1','VS2','SI1','SI2','SI3','I1']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $clarity): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div @click="item.clarity='<?php echo e($clarity); ?>'; open=false"
                     class="cursor-pointer select-none rounded-md border px-3 py-2 text-center text-sm font-medium transition-all duration-200"
                     :class="{
                         'border-purple-600 bg-purple-100 dark:bg-purple-700 text-purple-900 dark:text-white shadow-sm':
                             item.clarity === '<?php echo e($clarity); ?>',
                         'border-gray-300 dark:border-gray-600 hover:border-purple-400 hover:bg-purple-50 dark:hover:border-purple-400 dark:hover:bg-purple-700/30 dark:text-gray-200':
                             item.clarity !== '<?php echo e($clarity); ?>'
                     }">
                    <?php echo e($clarity); ?>

                </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

        </div>

        <p class="text-red-500 text-xs mt-1" x-text="errors.clarity" x-show="errors.clarity"></p>
    </div>


    <!-- Cut -->
    <div x-data="{ open: false }" class="relative">
        <label class="mb-2 block text-sm font-medium text-gray-700 dark:text-gray-200">
            Cut <span class="text-red-500">*</span>
        </label>

        <button type="button"
                @click="open = !open"
                x-bind:class="errors.cut ? 'border-red-500' : ''"
                class="flex w-full items-center justify-between rounded-md border border-gray-300 px-3 py-2
                       focus:outline-none focus:ring-2 focus:ring-purple-600 dark:border-gray-600
                       dark:bg-gray-700 dark:text-gray-100">

            <span x-text="item.cut || 'Select cut'"
                  :class="item.cut ? 'text-gray-900 dark:text-gray-100':'text-gray-400'"></span>

            <svg xmlns="http://www.w3.org/2000/svg"
                 class="ml-2 h-4 w-4 transform transition-transform duration-300"
                 :class="open ? 'rotate-180':'rotate-0'"
                 fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
            </svg>
        </button>

        <div x-show="open"
             @click.outside="open=false"
             x-transition
             class="absolute z-50 mt-2 grid w-full grid-cols-2 gap-3 rounded-lg border border-gray-300
                    bg-white p-3 shadow-lg dark:border-gray-600 dark:bg-gray-800">

            <?php $__currentLoopData = ['Poor','Fair','Good','Very Good','Excellent','Ideal']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cut): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div @click="item.cut='<?php echo e($cut); ?>'; open=false"
                     class="cursor-pointer select-none rounded-md border px-3 py-2 text-center transition-all duration-200"
                     :class="{
                         'border-purple-600 bg-purple-100 dark:bg-purple-700 text-purple-800 dark:text-white shadow-sm':
                             item.cut === '<?php echo e($cut); ?>',
                         'border-gray-300 dark:border-gray-600 hover:border-purple-400 hover:bg-purple-50 dark:hover:border-purple-400 dark:hover:bg-purple-700/30 dark:text-gray-200':
                             item.cut !== '<?php echo e($cut); ?>'
                     }">
                    <?php echo e($cut); ?>

                </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

        </div>

        <p class="text-red-500 text-xs mt-1" x-text="errors.cut" x-show="errors.cut"></p>
    </div>


    <!-- Certificate Image -->
    <div x-data="{ preview: null }">
        <label class="mb-2 block text-sm font-medium text-gray-700 dark:text-gray-200">
            Certificate Image
        </label>

        <label
            class="group relative flex w-full cursor-pointer flex-col items-center justify-center overflow-hidden
                   rounded-lg border-2 border-dashed border-gray-400 bg-transparent px-6 py-8 transition-all
                   hover:border-purple-500 hover:bg-gray-100 dark:border-gray-600 dark:bg-gray-800
                   dark:hover:bg-gray-700">

            <input type="file" accept="image/*"
                class="absolute inset-0 h-full w-full cursor-pointer opacity-0"
                @change="preview = $event.target.files[0] ? URL.createObjectURL($event.target.files[0]) : null;
                         item.certificate_image = $event.target.files[0]" />

            <div x-show="!preview" class="flex flex-col items-center space-y-2 text-center">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" stroke="currentColor">
                    <path d="M12 3v12"/>
                    <path d="m17 8-5-5-5 5"/>
                    <path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"/>
                </svg>
                <p class="text-sm font-semibold text-purple-600">Upload Certificate Image</p>
            </div>

            <div x-show="preview" class="flex flex-col items-center p-3">
                <img :src="preview" class="h-24 w-24 rounded-md border bg-white object-cover p-1 shadow-md"/>
                <button type="button"
                        @click="preview=null; item.certificate_image=null"
                        class="mt-4 rounded-md px-3 py-1.5 text-sm font-medium text-gray-600 hover:bg-purple-600 hover:text-white">
                    Remove
                </button>
            </div>
        </label>

        <p class="text-red-500 text-xs mt-1" x-text="errors.certificate_image" x-show="errors.certificate_image"></p>
    </div>

    <!-- Product Image -->
    <div x-data="{ preview: null }">
        <label class="mb-2 block text-sm font-medium text-gray-700 dark:text-gray-200">
            Product Image
        </label>

        <label
            class="group relative flex w-full cursor-pointer flex-col items-center justify-center overflow-hidden
                   rounded-lg border-2 border-dashed border-gray-400 bg-transparent px-6 py-8 transition-all
                   hover:border-purple-500 hover:bg-gray-100 dark:border-gray-600 dark:bg-gray-800
                   dark:hover:bg-gray-700">

            <input type="file" accept="image/*"
                class="absolute inset-0 h-full w-full cursor-pointer opacity-0"
                @change="preview = $event.target.files[0] ? URL.createObjectURL($event.target.files[0]) : null;
                         item.product_image = $event.target.files[0]" />

            <div x-show="!preview" class="flex flex-col items-center space-y-2 text-center">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" stroke="currentColor">
                    <path d="M12 3v12"/>
                    <path d="m17 8-5-5-5 5"/>
                    <path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"/>
                </svg>
                <p class="text-sm font-semibold text-purple-600">Upload Product Image</p>
            </div>

            <div x-show="preview" class="flex flex-col items-center p-3">
                <img :src="preview" class="h-24 w-24 rounded-md border bg-white object-cover p-1 shadow-md"/>
                <button type="button"
                        @click="preview=null; item.product_image=null"
                        class="mt-4 rounded-md px-3 py-1.5 text-sm font-medium text-gray-600 hover:bg-purple-600 hover:text-white">
                    Remove
                </button>
            </div>
        </label>

        <p class="text-red-500 text-xs mt-1" x-text="errors.product_image" x-show="errors.product_image"></p>
    </div>

</div>
<?php /**PATH C:\xampp\htdocs\Zeeyame\resources\views/admin/purchases/partials/card-details.blade.php ENDPATH**/ ?>