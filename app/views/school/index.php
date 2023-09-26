<?php require_once APPROOT . '/Views/Includes/head.php'; ?>

<div class="float-right">
    <a class="btn btn-success" href="<?= URLROOT; ?>schoolsController/create" style="margin: 2rem;">Create new
        school</a>
</div>

<table class="table table-hover">
    <thead>
        <th>school name</th>
        <th>school address</th>
    </thead>
    <tbody>
        <?php foreach ($data["Schools"] as $school) { ?>
        <tr>
            <td><a href="<?= URLROOT; ?>EducationsController/index/<?= $school->schoolId ?>"
                    style="text-decoration:none; color:black;"><?= $school->schoolName ?></a></td>
            <td><?= $school->schoolAdres ?></td>

        </tr>
        <?php } ?>
    </tbody>
</table>



<nav aria-label="Page navigation example">
    <ul class="pagination justify-content-center">
        <!-- Dit lijstitem wordt gebruikt voor de "Vorige" paginaknop. De 'disabled' class wordt toegevoegd als de waarde van $data['previousPage']
         kleiner is dan of gelijk is aan 0, wat aangeeft dat er geen vorige pagina is om naar terug te keren.
         De knop leidt naar de vorige pagina in de reeks. -->
        <li class="page-item <?= ($data['previousPage'] <= 0) ? 'disabled' : ''; ?>">
            <a class="page-link" href="<?= URLROOT ?>/schoolsController/index/<?= $data['previousPage'] ?>">Previous</a>
        </li>
        <!-- Dit is een lijstitem voor de eerste paginaknop. Als de huidige pagina de eerste pagina is, wordt 'active' toegevoegd
         aan de class van het element, anders wordt het vorige paginanummer of de volgende pagina minus 2 weergegeven. -->
        <li class="page-item <?= ($data['pageNumber'] == 1) ? 'active' : ''; ?>"><a class="page-link"
                href="<?= $data['firstPage'] ?>">
                <?= $data['firstPage'] ?>
            </a></li>
        <?php if ($data['totalPages'] >= 2) { ?>
        <li
            class="page-item <?= ($data['pageNumber'] != 1 && $data['totalPages'] != $data['pageNumber'] || ($data['totalPages'] == 2 && $data['pageNumber'] == 2)) ? 'active' : ''; ?>">
            <a class="page-link" href="<?= $data['secondPage'] ?>">
                <?= $data['secondPage'] ?>
            </a>
        </li>
        <?php   } ?>
        <?php if ($data['totalPages'] >= 3) { ?>
        <li class="page-item <?= ($data['pageNumber'] == $data['totalPages']) ? 'active' : ''; ?>"><a class="page-link"
                href="<?= $data['thirdPage'] ?>">
                <?= $data['thirdPage'] ?>
            </a></li>
        <?php } ?>
        <li class="page-item <?= ($data['nextPage'] > $data['totalPages']) ? 'disabled' : ''; ?>">
            <a class="page-link" href="<?= URLROOT ?>/schoolsController/index/<?= $data['nextPage'] ?>">Next</a>
        </li>
    </ul>
</nav>

<?php require_once APPROOT . '/Views/Includes/footer.php'; ?>