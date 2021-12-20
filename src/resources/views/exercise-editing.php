<link rel="stylesheet" href="/css/exercise-editing.css">

<section class="container">
    <div class="row">
        <div class="column">
            <h1>Fields</h1>
            <table class="records">
                <thead>
                <tr>
                    <th>Label</th>
                    <th>Value kind</th>
                    <th></th>
                </tr>
                </thead>
                <tbody>
                <?php foreach (array_reverse($exercise->questions()) as $question) : ?>
                    <tr>
                        <td><?= htmlspecialchars($question->question) ?></td>
                        <td><?= $question->type()->name ?></td>
                        <td id="icons-actions">
                            <a href="/exercise/<?= $exercise->id ?>/edit/edit-question/<?= $question->id ?>">
                                <i class="fa fa-edit"></i>
                            </a>
                            <form action="/exercise/<?= $exercise->id ?>/edit/remove-question/<?= $question->id ?>"
                                  method="post">
                                <?= $this->csrf() ?>
                                <button type="submit" data-confirm="Are you sure?"><i class="fa fa-trash"></i></button>
                            </form>
                        </td>
                    </tr>
                <?php endforeach ?>
                </tbody>
            </table>
            <form action="/exercise/<?= $exercise->id ?>/edit/status/answer" method="post">
                <?= $this->csrf() ?>
                <input type="submit" value="Complete and be ready for answers"
                       onclick="return confirm('Are you sure?You wont be able to further edit this exercise');"/>
            </form>
        </div>

        <div class="column">
            <h1>New Field</h1>
            <form action="/exercise/<?= $exercise->id ?>/edit/add-question" method="post">
                <?= $this->csrf() ?>
                <div class="field">
                    <label for="field_label">Label</label>
                    <input type="text" name="field[label]" id="field_label"/>
                </div>

                <div class="field">
                    <label for="field_value_kind">Value kind</label>
                    <select name="field[value_kind]" id="field_value_kind">
                        <option selected="selected" value="SHORT">Single line text</option>
                        <option value="MEDIUM">List of single lines</option>
                        <option value="LONG">Multi-line text</option>
                    </select>
                </div>

                <div class="actions">
                    <input type="submit" name="commit" value="Create Field" data-disable-with="Create Field"/>
                </div>
            </form>
        </div>
    </div>
</section>