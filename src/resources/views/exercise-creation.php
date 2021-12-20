<link rel="stylesheet" href="/css/exercise-creation.css">

<section class="container">
    <h1>New Exercise</h1>

    <form id="form-exercise" action="/exercises/new" method="post">
        <?= $this->csrf() ?>
        <div class="field">
            <label for="title">Title</label>
            <input id="title" name="title" type="text" minlength="1" maxlength="50" required/>
        </div>

        <div class="actions">
            <button type="submit" form="form-exercise">Create Exercise</button>
        </div>

    </form>
</section>