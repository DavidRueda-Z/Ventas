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
     <?php $__env->slot('header', null, []); ?> 
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            <?php echo e(__('Panel de Control')); ?>

        </h2>
     <?php $__env->endSlot(); ?>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                <h1 class="text-2xl font-bold text-gray-800 mb-4">¡Bienvenido, <?php echo e(Auth::user()->name); ?>!</h1>
                <p class="text-gray-700 mb-6">
                    Has iniciado sesión correctamente en el <strong>Sistema de Flujo de Caja</strong>.
                </p>

                <div class="grid sm:grid-cols-2 lg:grid-cols-3 gap-6">
                    <!-- Tarjeta: Productos -->
                    <div class="p-6 bg-blue-50 rounded-lg shadow hover:shadow-md transition">
                        <h2 class="text-xl font-semibold text-blue-700 mb-2">📦 Productos</h2>
                        <p class="text-gray-600 mb-4">Gestiona el inventario de tus productos.</p>
                        <a href="<?php echo e(Auth::user()->hasRole('admin') ? route('admin.products.index') : route('products.index')); ?>" class="text-blue-600 hover:text-blue-800 font-medium">Ver productos →</a>
                    </div>

                    <!-- Tarjeta: Ventas -->
                    <div class="p-6 bg-green-50 rounded-lg shadow hover:shadow-md transition">
                        <h2 class="text-xl font-semibold text-green-700 mb-2">💵 Ventas</h2>
                        <p class="text-gray-600 mb-4">Registra y visualiza todas las ventas realizadas.</p>
                        <a href="<?php echo e(route('sales.index')); ?>" class="text-green-600 hover:text-green-800 font-medium">Ver ventas →</a>
                    </div>

                    <!-- Tarjeta: Perfil -->
                    <div class="p-6 bg-yellow-50 rounded-lg shadow hover:shadow-md transition">
                        <h2 class="text-xl font-semibold text-yellow-700 mb-2">👤 Perfil</h2>
                        <p class="text-gray-600 mb-4">Actualiza tu información o cambia tu contraseña.</p>
                        <a href="<?php echo e(route('profile.edit')); ?>" class="text-yellow-600 hover:text-yellow-800 font-medium">Editar perfil →</a>
                    </div>
                </div>
            </div>
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
<?php /**PATH C:\Users\User\Documents\Ventas\Ventas\FlujoDeCaja\resources\views/dashboard.blade.php ENDPATH**/ ?>