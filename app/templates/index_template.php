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
    <title>index</title>
    <link rel="stylesheet" href="../frameworks/tailwind.min.css">
</head>

<body class="grid items-center h-screen">
    <?php if (!$verificado) : ?>
        <main class="gap-8 grid justify-center">
            <h1 class="font-bold text-4xl">El usuario <?php echo $_SESSION["userName"]; ?> no esta verificado</h1>
            <p class="text-2xl text-center">Comprueba el correo electronico.</p>
            <svg class="justify-self-center flex" width="75" height="75" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                <path d="M12 18h-7a2 2 0 0 1 -2 -2v-10a2 2 0 0 1 2 -2h14a2 2 0 0 1 2 2v7.5" />
                <path d="M3 6l9 6l9 -6" />
                <path d="M15 18h6" />
                <path d="M18 15l3 3l-3 3" />
            </svg>
            <a class="w-36 flex justify-self-center justify-center text-white bg-gradient-to-r from-blue-500 via-blue-600 to-blue-700 hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-blue-300 dark:focus:ring-blue-800 font-medium rounded-lg text-sm px-5 py-2.5 text-center me-2 mb-2" href="logout.php">Cerrar sesion</a>
        </main>
    <?php else : ?>
        <main class="gap-8 grid justify-center">
            <h1 class="font-bold text-4xl">El usuario <?php echo $_SESSION["userName"]; ?> esta verificado</h1>
            <p class="text-2xl text-center">Gracias por registrarte en nuestra aplicación.</p>
            <svg class="justify-self-center flex" width="75" height="75" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                <path d="M8 7a4 4 0 1 0 8 0a4 4 0 0 0 -8 0" />
                <path d="M6 21v-2a4 4 0 0 1 4 -4h4" />
                <path d="M15 19l2 2l4 -4" />
            </svg>
            <a class="w-36 flex justify-self-center justify-center text-white bg-gradient-to-r from-blue-500 via-blue-600 to-blue-700 hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-blue-300 dark:focus:ring-blue-800 font-medium rounded-lg text-sm px-5 py-2.5 text-center me-2 mb-2" href="logout.php">Cerrar sesión</a>
        </main>
    <?php endif; ?>
</body>

</html>