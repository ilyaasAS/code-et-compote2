<section>
    <h1>Dashboard Utilisateur</h1>
    <a href="">Ajouter un utilisateur</a>
    <table class="table table-hover w-75 mx-auto my-5">
        <?php
        foreach ($users as $user) { ?>
            <tr>
                <td><?= $user['id']; ?></td>
                <td><?= $user['username']; ?></td>
                <td><?= $user['email']; ?></td>

                <!-- creer une route qui fonctionne -->
                <!-- AdminUserController -->
                <!-- showUpdateUserForm() passer les parametres -->
                <td><a href="/code-et-compote/admin/users/modifier/<?= $user['id']; ?>" class="btn btn-warning">Modifier</a></td>
                <td><a href="" class="btn btn-danger">supprimer</a></td>
            </tr>
        <?php } ?>

    </table>
</section>