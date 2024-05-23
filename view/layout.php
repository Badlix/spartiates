<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <meta name="description" content="Serious Game de hockey pour les Spartiate de Marseille"/>
    <link rel="icon" href="/assets/images/favicon.ico" type="image/x-icon"/>
    <title>%title%</title>
    <!--    style-->
    <link rel="stylesheet" href="/dist/output.css">
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="/dist/bundle.js"></script>
    <script src="/dist/jquery.min.js"></script>
    <script src="/assets/index.js" defer></script>
</head>

<body class="bg-[var(--color-bg)] flex flex-col min-h-screen">

<header class="bg-cover bg-bottom bg-no-repeat h-[18vh] relative mb-5"
        style="background-image: url('/assets/images/header.png')">
    <a href="https://marseillehockeyclub.com" target="_blank">
        <img class="w-1/3 md:w-1/5 lg:w-1/5 absolute top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2"
             src="/assets/images/logo.png" alt="lg-logo">
    </a>
    <img class="w-1/5 absolute bottom-0 right-0" src="/assets/images/headerLines.png" alt="headerLines">
</header>

<div class="flex-1 px-5 flex items-center justify-center">
    %content%
</div>

<footer class="bg-cover bg-top h-[18vh] relative" style="background-image: url('/assets/images/footer.png')">
    <img class="w-1/5 absolute bottom-0 right-0" src="/assets/images/headerLines.png" alt="headerLines.png">
    <p class="absolute bottom-0 left-0 text-white">CC-by 2023-2024 le site </p>
</footer>

</body>
</html>