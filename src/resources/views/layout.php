<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="author" content="Helene DUBUIS, Armand MARECHAL">
    <meta name="description" content="<?= $metas['description'] ?>">
    <meta name="keywords" content="<?= $metas['keywords'] ?>">

    <title>ExerciseLooper</title>

    <link rel="stylesheet" href="/css/normalize.css/normalize.css">
    <link rel="stylesheet" href="/css/milligram/milligram.min.css">
    <link rel="stylesheet" href="/css/colors.css">
    <link rel="stylesheet" href="/css/layout.css">

    <script src="https://kit.fontawesome.com/c2499f296f.js" crossorigin="anonymous"></script>
</head>

<body>
    <header class="heading">
        <section class="container">
            <a href="/"><img src="/images/logo.png" alt="Logo of the website" width="84" height="84" /></a>
            <?= isset($exerciseLabel) ? '<span class="exercise-label">' . $exerciseLabel . '</span>' : null ?>
            <?= isset($exerciseTitle) ? '<span class="exercise-title">' . $exerciseTitle . '</span>' : null ?>
        </section>
    </header>
    <?= $content ?>
</body>

</html>