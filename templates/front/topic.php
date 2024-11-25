<?php

use App\Core\Session;

$session = new Session();

?>
<table class="table table-striped">
    <?php foreach ($messages as $message) { ?>
        <tr>
            <td>
                <?= $message['content']; ?>
            </td>
        </tr>
    <?php } ?>
</table>

<?php

if ($session->isAuthenticated()) { ?>
    <form action="/code-et-compote/messages/process-form" method="POST">
        <div class="mb-3">
            <input type="text" name="message" class="form-control" placeholder="votre message" required>
        </div>
        <input type="hidden" value="<?= $id; ?>" name="id">
        <input type="submit" value="Envoyer" class="btn btn-primary">
    </form>
<?php
}
?>