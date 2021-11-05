<link rel="stylesheet" href="/css/exercise-answering.css">

<div class="container">
  <h1>Your take</h1>
  <p><?= $exerciseTips ?></p>

  <form id="form-exercise" action="/exercise/<?= $exercise->id, isset($submission) ? ('/' . $submission->path . '/answer') : '/answer' ?>" method="post">
    <!-- CSRF Token -->
    <input type="hidden" name="token" value="<?= $_SESSION["token"] ?>" />

    <?php foreach ($exercise->questions() as $question) : ?>
      <div class="field">
        <label for="<?= $question->question ?>"><?= $question->question ?></label>
        <?php if ($question->type()->slug == 'SHORT') : ?>
          <input type="text" name="answers[<?= $question->id ?>]" id="<?= $question->id ?>" value="<?= isset($submission) ? @$submission->answer($question->id)->answer : '' ?>" />
        <?php else : ?>
          <textarea type="text" name="answers[<?= $question->id ?>]" id="<?= $question->id ?>"><?= isset($submission) ? @$submission->answer($question->id)->answer : '' ?></textarea>
        <?php endif ?>
      </div>
    <?php endforeach ?>
    <div class="actions">
      <button type="submit" form="form-exercise">Save</button>
    </div>
  </form>
</div>