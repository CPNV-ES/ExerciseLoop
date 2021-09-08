<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>ExerciseLooper</title>

    <link rel="stylesheet" href="/node_modules/normalize.css/normalize.css">
    <link rel="stylesheet" href="/node_modules/milligram/dist/milligram.min.css">
    <link rel="stylesheet" href="/node_modules/@fortawesome/fontawesome-free/css/all.min.css">
    <link rel="stylesheet" href="/public/css/colors.css">
    <link rel="stylesheet" href="/public/css/layout.css">
</head>

<body>
    <header class="heading">
        <section class="container">
            <a href="/"><img src="/public/images/logo.png" /></a>
            <?= isset($pageName) ? '<span>' . $pageName . '</span>' : '' ?>
        </section>
    </header>
    <?= $content ?>
</body>

</html>