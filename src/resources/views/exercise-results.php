<link rel="stylesheet" href="/css/exercise-results.css">

<section class="container">
    <table>
        <thead>
            <tr>
                <th>Take</th>
                <?php foreach ($exercise->questions() as $question) : ?>
                    <th><a href="#"><?= $question->question ?></a></th>
                <?php endforeach ?>
            </tr>
        </thead>

        <tbody>
            <?php foreach ($exercise->submissions() as $submission) : ?>
                <tr>
                    <td><a href="#"><?= $submission->timestamp ?> UTC</a></td>
                    <?php foreach ($submission->answers() as $answer) : ?>
                        <?php if (empty(trim($answer->answer))) : ?>
                            <td class="answer"><i class="fas fa-times empty"></i></td>
                        <?php elseif (strlen(trim($answer->answer)) >= ANSWER_DOUBLE_LIMIT) : ?>
                            <td class="answer"><i class="fa fa-check-double filled"></i></td>
                        <?php else : ?>
                            <td class="answer"><i class="fa fa-check short"></i></td>
                        <?php endif ?>         
                    <?php endforeach ?>
                </tr>
            <?php endforeach ?>
        </tbody>
    </table>
</section>