<?php if (isset($component)) { $__componentOriginal69dc84650370d1d4dc1b42d016d7226b = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal69dc84650370d1d4dc1b42d016d7226b = $attributes; } ?>
<?php $component = App\View\Components\GuestLayout::resolve([] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('guest-layout'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\App\View\Components\GuestLayout::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['title' => 'Login']); ?>
  <div class="flex flex-col overflow-y-auto md:flex-row">
    <div class="h-32 md:h-auto md:w-1/2">
      <img aria-hidden="true" class="object-cover w-full h-full dark:hidden"
           src="<?php echo e(asset('assets/img/login.jpeg')); ?>" alt="Office" />
      <img aria-hidden="true" class="hidden object-cover w-full h-full dark:block"
           src="<?php echo e(asset('assets/img/login-office-dark.jpeg')); ?>" alt="Office" />
    </div>
    <div class="flex items-center justify-center p-6 sm:p-12 md:w-1/2">
      <div class="w-full">
        <h1 class="mb-4 text-xl font-semibold text-gray-700 dark:text-gray-200">Login</h1>

        <form method="POST" action="<?php echo e(route('login')); ?>">
          <?php echo csrf_field(); ?>
          <label class="block text-sm">
            <span class="text-gray-700 dark:text-gray-400">Email</span>
            <input name="email" type="email" required
                   class="block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700
                   focus:border-purple-400 focus:outline-none focus:shadow-outline-purple
                   dark:text-gray-300 form-input" placeholder="example@mail.com" />
          </label>

          <label class="block mt-4 text-sm">
            <span class="text-gray-700 dark:text-gray-400">Password</span>
            <input name="password" type="password" required
                   class="block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700
                   focus:border-purple-400 focus:outline-none focus:shadow-outline-purple
                   dark:text-gray-300 form-input" placeholder="Password" />
          </label>

          <button type="submit"
                  class="block w-full px-4 py-2 mt-4 text-sm font-medium leading-5 text-center
                         text-white transition-colors duration-150 bg-purple-600 border border-transparent
                         rounded-lg hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple">
            Log in
          </button>
        </form>

        <p class="mt-4 text-sm text-gray-600 dark:text-gray-400">
          <a href="<?php echo e(route('password.request')); ?>" class="text-purple-600 hover:underline">
            Forgot your password?
          </a>
        </p>

        
      </div>
    </div>
  </div>
 <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal69dc84650370d1d4dc1b42d016d7226b)): ?>
<?php $attributes = $__attributesOriginal69dc84650370d1d4dc1b42d016d7226b; ?>
<?php unset($__attributesOriginal69dc84650370d1d4dc1b42d016d7226b); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal69dc84650370d1d4dc1b42d016d7226b)): ?>
<?php $component = $__componentOriginal69dc84650370d1d4dc1b42d016d7226b; ?>
<?php unset($__componentOriginal69dc84650370d1d4dc1b42d016d7226b); ?>
<?php endif; ?>
<?php /**PATH C:\xampp\htdocs\Zeeyame\resources\views/auth/login.blade.php ENDPATH**/ ?>