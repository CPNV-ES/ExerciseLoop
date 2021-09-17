<head>
  <link rel="stylesheet" href="/public/css/exercise-creation.css">
</head>

<section class="container">
  <h1>New Exercise</h1>

  <form action="/exercises/new" accept-charset="UTF-8" method="post">

    <div class="field">
      <label for="exercise_title">Title</label>
      <input type="text" name="exercise[title]" id="exercise_title" />
    </div>

    <div class="actions">
      <input type="submit" name="commit" value="Create Exercise" data-disable-with="Create Exercise" />
    </div>
  </form>
</section>