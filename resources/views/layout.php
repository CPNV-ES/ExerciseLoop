<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="initial-scale=1, maximum-scale=1">
    
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
            <?= isset($exerciseLabel) ? '<span class="exercise-label">' . $exerciseLabel . '</span>' : null ?>
            <?= isset($exerciseTitle) ? '<span class="exercise-title">' . $exerciseTitle . '</span>' : null ?>
        </section>
    </header>
    <?= $content ?>
</body>

</html>