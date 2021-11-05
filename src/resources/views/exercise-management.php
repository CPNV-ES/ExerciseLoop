<link rel="stylesheet" href="/css/exercise-management.css">

<section class="container">
    <div class="row">
        <div class="column">
            <h1>Building</h1>
            <table class="records">
                <thead>
                <tr>
                    <th>Title</th>
                    <th></th>
                </tr>
                </thead>

                <tbody>
                <?php foreach ($exercisesBuild as $building) : ?>
                    <tr>
                        <td><?= $building->title ?></td>
                        <td>
                            <?php if ($building->questions() != []) : ?>
                                <form action="/exercise/<?= $building->id ?>/edit/status/answer" method="post">
                                    <button type="submit"><i class="fa fa-comment"></i></button>
                                </form>
                            <?php endif; ?>
                            <a title="Manage fields" href="exercise/<?= $building->id ?>/edit">
                                <i class="fa fa-edit"></i>
                            </a>
                            <form action="/exercise/<?= $building->id ?>/destroy" accept-charset="UTF-8"
                                  method="post">
                                <button type="submit" onclick="return confirm('Are you sure?');"><i class="fa fa-trash"></i>
                                </button>
                            </form>
                        </td>
                    </tr>
                <?php endforeach; ?>
                </tbody>
            </table>
        </div>
        <div class="column">
            <h1>Answering</h1>
            <table class="records">
                <thead>
                <tr>
                    <th>Title</th>
                    <th></th>
                </tr>
                </thead>

                <tbody>
                <?php foreach ($exercisesAnswer as $anserwing) : ?>
                    <tr>
                        <td><?= $anserwing->title ?></td>
                        <td>
                            <a title="Show results" href=""><i class="fa fa-chart-bar"></i></a>
                            <form action="/exercise/<?= $anserwing->id ?>/edit/status/close" method="post">
                                <button type="submit"><i class="fa fa-minus-circle"></i></button>
                            </form>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </table>
        </div>
        <div class="column">
            <h1>Closed</h1>
            <table class="records">
                <thead>
                <tr>
                    <th>Title</th>
                    <th></th>
                </tr>
                </thead>

                <tbody>
                <?php foreach ($exercisesClose as $closed) : ?>
                    <tr>
                        <td><?= $closed->title ?></td>
                        <td>
                            <a title="Show results" href=""><i class="fa fa-chart-bar"></i></a>
                            <form action="/exercise/<?= $closed->id ?>/destroy" accept-charset="UTF-8" method="post">
                                <button type="submit" onclick="return confirm('Are you sure?');"><i class="fa fa-trash"></i></button>
                            </form>
                        </td>
                    </tr>
                <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</section>