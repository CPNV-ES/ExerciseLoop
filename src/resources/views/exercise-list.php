<link rel="stylesheet" href="/css/exercise-list.css">

<section class="container">
  <ul id="ansering-list">

    <?php foreach ($exercises as $exercise) : ?>
      <li class="row">
        <div class="column card">
          <div class="title"><?= $exercise->title ?></div>
          <a class="button" href="/exercise/<?= $exercise->id ?>/answer">Take it</a>
        </div>
      </li>
    <?php endforeach ?>

  </ul>
</section>