<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Sistema de Flujo de Caja</title>
    <?php echo app('Illuminate\Foundation\Vite')(['resources/css/app.css', 'resources/js/app.js']); ?>
</head>
<body class="bg-gradient-to-b from-blue-100 to-gray-200 text-gray-800 antialiased min-h-screen flex flex-col">

    <!-- Contenido principal -->
    <main class="flex flex-col justify-center items-center flex-grow text-center px-6 py-12">
        <div class="bg-white shadow-2xl rounded-3xl p-10 w-full max-w-4xl border border-gray-200">

            <!-- Título -->
            <h1 class="text-5xl font-extrabold text-blue-700 mb-6">
                💰 Sistema de Flujo de Caja
            </h1>

            <!-- Descripción -->
            <p class="text-black-700 text-lg leading-relaxed mb-10">
                Controla tus ingresos y egresos fácilmente.
                Administra productos, registra ventas y lleva un control completo de tu negocio
            </p>

            <!-- Botones -->
            <div class="flex flex-wrap justify-center gap-6">
                <a href="<?php echo e(route('login')); ?>"
                   class="bg-blue-600 hover:bg-blue-700 text-black font-semibold px-8 py-3 rounded-xl shadow-md transition transform hover:scale-105">
                   Iniciar Sesión
                </a>

                <a href="<?php echo e(route('register')); ?>"
                   class="bg-gray-900 hover:bg-gray-800 text-black font-semibold px-8 py-3 rounded-xl shadow-md transition transform hover:scale-105">
                   Registrarse
                </a>

                <a href="<?php echo e(url('/dashboard')); ?>"
                   class="bg-green-600 hover:bg-green-700 text-black font-semibold px-8 py-3 rounded-xl shadow-md transition transform hover:scale-105">
                   Ir al Panel
                </a>
            </div>
        </div>
    </main>

    <!-- Footer -->
    <footer class="text-center text-black-600 py-6 text-sm">
        © <?php echo e(date('Y')); ?> — <span class="font-semibold">Sistema de Flujo de Caja</span> | Desarrollado por <span class="font-semibold text-blue-700">David Rueda</span>
    </footer>

</body>
</html>
<?php /**PATH C:\Users\User\Documents\Ventas\Ventas\FlujoDeCaja\resources\views/welcome.blade.php ENDPATH**/ ?>