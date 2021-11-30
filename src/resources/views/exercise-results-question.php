<link rel="stylesheet" href="/css/exercise-results.css">

<section class="container">
    <h1><?= $question->question ?></h1>
    <table>
        <thead>
            <tr>
                <th>Take</th>
                <th>Content</th>
            </tr>
        </thead>

        <tbody>
            <?php foreach ($exercise->submissions() as $submission) : ?>
                <tr>
                    <td><a href="/exercise/<?= $exercise->id ?>/results/submission/<?= $submission->id ?>"><?= $submission->timestamp ?> UTC</a></td>
                    <td><?= $submission->answer($question->id)->answer ?></td>
                </tr>
            <?php endforeach ?>
        </tbody>
    </table>
</section>