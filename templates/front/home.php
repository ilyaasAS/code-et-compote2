<section>
    <h1 class="display-5">Accueil</h1>
    <div class=" w-75 mx-auto my-5 p-3 border rounded">
        <table class="table table-striped table-hover">
            <tbody>
                <?php foreach ($topics as $topic) { ?>
                    <tr>
                        <td>
                            <a href="/code-et-compote/topic/<?= htmlspecialchars($topic['id']); ?>">
                                <?= htmlspecialchars($topic['title']); ?>
                            </a>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
</section>