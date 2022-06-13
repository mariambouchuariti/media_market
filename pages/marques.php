<?php

ob_start();
// php
$title = "Marques";

$marques = $pdo->query("SELECT * FROM marques")->fetchAll();

// dd($marques);


if (isset($_POST['marque_delete'])) {

    $id = (int)$_POST['marque_id'];
    $pdo->query("DELETE FROM marques WHERE id = $id");
    $_SESSION['flash']['success'] = 'Bien supprimer';
    header('Location: marques');
    die();
}

$content_php = ob_get_clean();


ob_start(); ?>

<h3 class="mb-3">Marques</h3>


<div class="card shadow-sm">
    <div class="card-header">
        <h4>Liste des marques</h4>
    </div>

    <div class="card-body">
        <a href="marque_add" class="btn btn-primary mb-3">
            <i class="fas fa-plus"></i>
            Ajouter</a>

        <div class="table-responsive">

            <table class="table table-bordered table-hover table-sm table-striped">
                <thead>
                    <tr>
                        <th>Id</th>
                        <th>Nom</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($marques as $key => $m) : ?>
                        <tr>
                            <th>
                                <?= $m->id ?>
                            </th>
                            <td>
                                <?= strtoupper($m->nom) ?>
                            </td>
                            <td>
                                <a href="marque_update&id=<?= $m->id ?>" class="btn btn-dark btn-sm">
                                    <i class="fas fa-wrench"></i>
                                    Modifier
                                </a>

                                <form method="post" style="display: inline;">
                                    <input type="hidden" name="marque_id" value="<?= $m->id ?>">
                                    <button name="marque_delete" type="submit" class="btn btn-danger btn-sm">
                                        <i class="fas fa-trash-alt"></i>
                                        Supprimer
                                    </button>
                                </form>

                            </td>
                        </tr>
                    <?php endforeach  ?>

                </tbody>
            </table>
        </div>
    </div>
</div>


<?php $content_html = ob_get_clean(); ?>