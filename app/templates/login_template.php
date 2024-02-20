<?php

/**
 * @author Luis Miguel
 */

?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./frameworks/tailwind.min.css">
    <title>Login / Reginster</title>
</head>

<body>
    <header class="grid place-items-center h-24">
        <h1 class="text-5xl font-bold">Login / Register</h1>
    </header>
    <?php if (isset($msg)) : ?>
        <div class="p-4 m-4 w-3/4 mx-auto text-sm text-red-800 rounded-lg bg-red-50 dark:bg-gray-800 dark:text-red-400" role="alert">
            <p><?php echo $msg; ?></p>
        </div>
    <?php endif; ?>
    <main class="grid grid-cols-2">
        <section class="place-self-center">
            <h1 class="text-4xl text-center mb-4">Login</h1>
            <form action="<?php htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST" class="flex flex-col gap-4">
                <div>
                    <label for="user" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">User or Email:</label>
                    <input type="text" name="user" placeholder="Usuario" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                </div>
                <div>
                    <label for="password" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Password:</label>
                    <input type="password" name="password" placeholder="Contraseña" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                </div>
                <input type="submit" name="Login" value="Login" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">
            </form>
        </section>

        <section class="place-self-center">
            <h1 class="text-4xl text-center mb-4">Register</h1>
            <form action="<?php htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST" class="flex flex-col gap-4">
                <div>
                    <label for="user" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">User:</label>
                    <input type="text" name="user" placeholder="Usuario" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                </div>
                <div>
                    <label for="email" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Email:</label>
                    <input type="text" name="email" placeholder="email" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                </div>
                <div>
                    <label for="password" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Password:</label>
                    <input type="password" name="password" placeholder="Contraseña" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                </div>

                <div>
                    <label for="rpassword" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Repeat Password:</label>
                    <input type="password" name="rpassword" placeholder="Contraseña" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                </div>
                <input type="submit" name="Register" value="Register" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">
            </form>
        </section>
    </main>
</body>

</html>