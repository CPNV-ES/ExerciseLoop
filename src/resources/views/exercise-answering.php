<head>
  <link rel="stylesheet" href="/public/css/exercise-answering.css">
</head>

<div class="container">
  <h1>Your take</h1>
  <p><?= $exerciseTips ?></p>

  <form id="form-exercise" action="/exercise/<?= $exercise->id, isset($submission) ? ('/' . $submission->path . '/answer') : '/answer' ?>" accept-charset="UTF-8" method="post">
    <?php foreach ($questions as $question) : ?>
      <div class="field">
        <label for="<?= $question->question ?>"><?= $question->question ?></label>
        <?php if ($question->type()->slug == 'SHORT') : ?>
          <input type="text" name="<?= $question->question ?>" id="<?= $question->question ?>" value="<?= isset($submission) ? @$submission->answer($question)->answer : '' ?>" />
        <?php else : ?>
          <textarea type="text" name="<?= $question->question ?>" id="<?= $question->question ?>"><?= isset($submission) ? @$submission->answer($question)->answer : '' ?></textarea>
        <?php endif ?>
      </div>
    <?php endforeach ?>
    <div class="actions">
      <button type="submit" form="form-exercise">Save</button>
    </div>
  </form>
</div>