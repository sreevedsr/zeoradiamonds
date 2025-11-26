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
    <?php $__env->slot('title', 'Purchase Report'); ?>

    <?php
        $headers = [
            'SI. No.',
            'Date',
            'Rate',
            'Total',
            'Qty',
            'Gross Wgt',
            'Stone Wgt',
            'Diamond Carat',
            'Net Wgt',
            'Net Amt',
            'GST',
            'Total (With GST)',
            'Actions',
        ];
    ?>

    <?php if (isset($component)) { $__componentOriginal7d9f6e0b9001f5841f72577781b2d17f = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal7d9f6e0b9001f5841f72577781b2d17f = $attributes; } ?>
<?php $component = App\View\Components\Table::resolve([] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('table'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\App\View\Components\Table::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['headers' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($headers),'collection' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($cards),'route' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(route('admin.reports.purchase')),'searchPlaceholder' => 'Certificate ID, Item Name...']); ?>

        
         <?php $__env->slot('filters', null, []); ?> 

            <?php if (isset($component)) { $__componentOriginal2c7cd37e2e80199b9dbc9a9aa91b96b1 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal2c7cd37e2e80199b9dbc9a9aa91b96b1 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.date-input','data' => ['label' => 'From','name' => 'from','value' => request('from')]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('date-input'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['label' => 'From','name' => 'from','value' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(request('from'))]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal2c7cd37e2e80199b9dbc9a9aa91b96b1)): ?>
<?php $attributes = $__attributesOriginal2c7cd37e2e80199b9dbc9a9aa91b96b1; ?>
<?php unset($__attributesOriginal2c7cd37e2e80199b9dbc9a9aa91b96b1); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal2c7cd37e2e80199b9dbc9a9aa91b96b1)): ?>
<?php $component = $__componentOriginal2c7cd37e2e80199b9dbc9a9aa91b96b1; ?>
<?php unset($__componentOriginal2c7cd37e2e80199b9dbc9a9aa91b96b1); ?>
<?php endif; ?>

            <?php if (isset($component)) { $__componentOriginal2c7cd37e2e80199b9dbc9a9aa91b96b1 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal2c7cd37e2e80199b9dbc9a9aa91b96b1 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.date-input','data' => ['label' => 'To','name' => 'to','value' => request('to')]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('date-input'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['label' => 'To','name' => 'to','value' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(request('to'))]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal2c7cd37e2e80199b9dbc9a9aa91b96b1)): ?>
<?php $attributes = $__attributesOriginal2c7cd37e2e80199b9dbc9a9aa91b96b1; ?>
<?php unset($__attributesOriginal2c7cd37e2e80199b9dbc9a9aa91b96b1); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal2c7cd37e2e80199b9dbc9a9aa91b96b1)): ?>
<?php $component = $__componentOriginal2c7cd37e2e80199b9dbc9a9aa91b96b1; ?>
<?php unset($__componentOriginal2c7cd37e2e80199b9dbc9a9aa91b96b1); ?>
<?php endif; ?>


            
            <?php if (isset($component)) { $__componentOriginald32d6e5ccefff34d2bfa91c7f668faf8 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginald32d6e5ccefff34d2bfa91c7f668faf8 = $attributes; } ?>
<?php $component = App\View\Components\SearchableDropdown::resolve([] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('searchable-dropdown'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\App\View\Components\SearchableDropdown::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['name' => 'supplier_id','api' => '/admin/api/dropdown/suppliers','label' => 'Supplier','placeholder' => 'Select supplier','optionLabel' => 'name','optionValue' => 'id','autoSubmit' => 'true']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginald32d6e5ccefff34d2bfa91c7f668faf8)): ?>
<?php $attributes = $__attributesOriginald32d6e5ccefff34d2bfa91c7f668faf8; ?>
<?php unset($__attributesOriginald32d6e5ccefff34d2bfa91c7f668faf8); ?>
<?php endif; ?>
<?php if (isset($__componentOriginald32d6e5ccefff34d2bfa91c7f668faf8)): ?>
<?php $component = $__componentOriginald32d6e5ccefff34d2bfa91c7f668faf8; ?>
<?php unset($__componentOriginald32d6e5ccefff34d2bfa91c7f668faf8); ?>
<?php endif; ?>

            
            <div>
                <label class="block text-sm text-transparent">.</label>
                <button type="submit"
                    class="rounded-lg px-4 py-2 bg-purple-600 text-white hover:bg-purple-700 focus:ring">
                    Apply
                </button>
            </div>

         <?php $__env->endSlot(); ?>

        
        <?php $__currentLoopData = $cards; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $card): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <tr class="text-sm dark:text-gray-200">

                
                <td class="px-4 py-3"><?php echo e($cards->firstItem() + $index); ?></td>

                
                <td class="px-4 py-3"><?php echo e(optional($card->purchaseInvoice)->invoice_date); ?></td>

                
                <td class="px-4 py-3"><?php echo e($card->gold_rate + $card->diamond_rate); ?></td>

                
                <td class="px-4 py-3"><?php echo e(number_format($card->total_amount, 2)); ?></td>

                
                <td class="px-4 py-3"><?php echo e($card->quantity); ?></td>

                
                <td class="px-4 py-3"><?php echo e($card->gross_weight); ?></td>
                <td class="px-4 py-3"><?php echo e($card->stone_weight); ?></td>
                <td class="px-4 py-3"><?php echo e($card->diamond_weight); ?></td>
                <td class="px-4 py-3"><?php echo e($card->net_weight); ?></td>

                
                <td class="px-4 py-3"><?php echo e(number_format($card->total_amount, 2)); ?></td>

                
                <td class="px-4 py-3"><?php echo e(number_format($card->total_amount * 0.03, 2)); ?></td>

                
                <td class="px-4 py-3"><?php echo e(number_format($card->total_amount * 1.03, 2)); ?></td>

                
                <td class="px-4 py-3">
                    <div class="flex items-center space-x-3">
                        <a href="<?php echo e(route('admin.products.edit', $card->id)); ?>">
                            <?php if (isset($component)) { $__componentOriginal3b0e04e43cf890250cc4d85cff4d94af = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal3b0e04e43cf890250cc4d85cff4d94af = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.secondary-button','data' => []] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('secondary-button'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>Edit <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal3b0e04e43cf890250cc4d85cff4d94af)): ?>
<?php $attributes = $__attributesOriginal3b0e04e43cf890250cc4d85cff4d94af; ?>
<?php unset($__attributesOriginal3b0e04e43cf890250cc4d85cff4d94af); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal3b0e04e43cf890250cc4d85cff4d94af)): ?>
<?php $component = $__componentOriginal3b0e04e43cf890250cc4d85cff4d94af; ?>
<?php unset($__componentOriginal3b0e04e43cf890250cc4d85cff4d94af); ?>
<?php endif; ?>
                        </a>

                        <?php if (isset($component)) { $__componentOriginal656e8c5ea4d9a4fa173298297bfe3f11 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal656e8c5ea4d9a4fa173298297bfe3f11 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.danger-button','data' => ['type' => 'button','xData' => true,'xOn:click.prevent' => '
                                $dispatch(\'open-modal\', \'confirm-delete-modal\');
                                document.getElementById(\'deleteMerchantForm\').action =
                                    \''.e(route('admin.products.destroy', $card->id)).'\';
                            ']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('danger-button'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['type' => 'button','x-data' => true,'x-on:click.prevent' => '
                                $dispatch(\'open-modal\', \'confirm-delete-modal\');
                                document.getElementById(\'deleteMerchantForm\').action =
                                    \''.e(route('admin.products.destroy', $card->id)).'\';
                            ']); ?>
                            Delete
                         <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal656e8c5ea4d9a4fa173298297bfe3f11)): ?>
<?php $attributes = $__attributesOriginal656e8c5ea4d9a4fa173298297bfe3f11; ?>
<?php unset($__attributesOriginal656e8c5ea4d9a4fa173298297bfe3f11); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal656e8c5ea4d9a4fa173298297bfe3f11)): ?>
<?php $component = $__componentOriginal656e8c5ea4d9a4fa173298297bfe3f11; ?>
<?php unset($__componentOriginal656e8c5ea4d9a4fa173298297bfe3f11); ?>
<?php endif; ?>
                    </div>
                </td>

            </tr>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

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
<?php /**PATH C:\xampp\htdocs\zeoradiamonds\resources\views/admin/reports/purchase.blade.php ENDPATH**/ ?>