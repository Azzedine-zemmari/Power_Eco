<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Mobile Sun – Énergie Renouvelable, Micromobilité et Photovoltaïque</title>

    <!-- Global SEO -->
    <meta name="description" content="Découvrez Mobile Sun, votre boutique en ligne spécialisée dans les produits d’énergie renouvelable, la micromobilité électrique, et les solutions photovoltaïques performantes.">
    <meta name="keywords" content="énergie renouvelable, micromobilité, photovoltaïque, trottinettes électriques, panneaux solaires, e-commerce, énergie verte, mobilité durable, Mobile Sun">
    <meta name="author" content="Mobile Sun">
    <meta name="robots" content="index, follow">

    <!-- Open Graph / Facebook -->
    <meta property="og:title" content="Mobile Sun – Boutique Énergie Renouvelable et Micromobilité" />
    <meta property="og:description" content="Produits écologiques, mobilité électrique et solutions solaires à prix compétitifs. Explorez notre catalogue en ligne." />
    <meta property="og:type" content="website" />
    <meta property="og:url" content="https://mobilesun.com" />
    <meta property="og:image" content="https://mobilesun.com/images/og-image.jpg" />

    <!-- Twitter Card -->
    <meta name="twitter:card" content="summary_large_image" />
    <meta name="twitter:title" content="Mobile Sun – Énergie Verte et Micromobilité Électrique" />
    <meta name="twitter:description" content="Produits d’énergie renouvelable, mobilité douce et solutions photovoltaïques pour un avenir durable." />
    <meta name="twitter:image" content="https://mobilesun.com/images/twitter-image.jpg" />

    <!-- Theme color for mobile -->
    <meta name="theme-color" content="#00b894" />

    <!-- CSRF + Fonts + Tailwind -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="icon" href="/favicon.ico">
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">

    @vite(['resources/js/app.js'])
</head>
<body class="">
    <div id="app"></div>
</body>
</html>
