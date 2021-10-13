<head>
    <link rel="stylesheet" href="/public/css/question-editing.css">
</head>

<section class="container">
    <h1>Editing Field</h1>

    <form action="/exercise/<?= $exercise->id ?>/edit/edit-question/<?= $question->id ?>" accept-charset="UTF-8" method="post"><input name="utf8" type="hidden" value="&#x2713;" />
        <div class="field">
            <label for="field_label">Label</label>
            <input type="text" value="<?= $question->question ?>" name="field[label]" id="field_label" />
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
            <input type="submit" name="commit" value="Update Field" data-disable-with="Update Field" />
        </div>
    </form>
</section>