<link rel="stylesheet" href="/css/exercise-results-submission.css">

<section class="container">
    <h1><?= $submission->timestamp ?> UTC</h1>
    <dl class="answer">
        <?php foreach ($exercise->questions() as $question) : ?>
            <dt><?= $question->question ?></dt>
            <dd><?= $submission->answer($question->id)->answer ?></dd>
        <?php endforeach ?>
    </dl>
</section>