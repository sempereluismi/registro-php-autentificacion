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
    <title>Error</title>
    <link rel="stylesheet" href="../frameworks/tailwind.min.css">
</head>

<body class="grid items-center h-screen">
    <main class="gap-8 grid justify-center">
        <h1 class="font-bold text-9xl">Opss ...</h1>
        <p class="text-2xl text-center"><?php echo $msg; ?></p>
        <svg class="justify-self-center flex" width="100" height="100" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
            <path d="M12 12m-9 0a9 9 0 1 0 18 0a9 9 0 1 0 -18 0" />
            <path d="M12 9v4" />
            <path d="M12 16v.01" />
        </svg>
        <a class="w-36 flex justify-self-center justify-center text-white bg-gradient-to-r from-blue-500 via-blue-600 to-blue-700 hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-blue-300 dark:focus:ring-blue-800 font-medium rounded-lg text-sm px-5 py-2.5 text-center me-2 mb-2" href="index.php">
            Volver al inicio
        </a>
    </main>
</body>

</html>