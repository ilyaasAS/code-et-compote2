<?php

namespace App\Controller\Admin;

use App\Controller\AbstractController;
use App\Core\Session;
use App\Repository\UserRepository;

class AdminUserController extends AbstractController
{
    public function showUsers(): void
    {
        $session = new Session();

        if ($session->isAdmin() === false) {
            header('Location:/code-et-compote/');
            exit;
        }

        $repository = new UserRepository();
        $users = $repository->findAll();

        $this->render('admin/users', ['users' => $users]);
    }

    public function showUpdateUserForm($params)
    {
        $session = new Session();

        if ($session->isAdmin() === false) {
            header('Location:/code-et-compote/');
            exit;
        }

        $id = $params['id'];

        if (filter_var($id, FILTER_VALIDATE_INT) === false) {
            header('Location:/code-et-compote/admin/utilisateurs');
            exit;
        }

        $repository = new UserRepository();
        $user = $repository->findById($id);

        $this->render('admin/updateUserForm', ['id' => $id, 'user' => $user]);
    }

    public function processUpdateUserForm()
    {
        $session = new Session();

        if ($session->isAdmin() === false) {
            header('Location:/code-et-compote/');
            exit;
        }

        $id = trim(htmlspecialchars($_POST['id']));

        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            header('Location:/code-et-compote/admin/users/modifier/' . $id);
            exit;
        }

        if (!isset($_POST['pseudo']) || empty($_POST['pseudo'])) {

            $session->createFlashMessage('Veuillez ajouter un pseudo');

            header('Location:/code-et-compote/admin/users/modifier/' . $id);

            exit;
        }

        if (!isset($_POST['email']) || empty($_POST['email'])) {
            $session->createFlashMessage('Veuillez ajouter un email');

            header('Location:/code-et-compote/admin/users/modifier/' . $id);
            exit;
        }

        if (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
            $session->createFlashMessage('Votre email n\'est pas correct');

            header('Location:/code-et-compote/admin/users/modifier/' . $id);
            exit;
        }

        if (!isset($_POST['status']) || empty($_POST['status'])) {
            $session->createFlashMessage('Veuillez selectionner un status');

            header('Location:/code-et-compote/admin/users/modifier/' . $id);
            exit;
        }

        $pseudo = trim($_POST['pseudo']);
        $email = trim($_POST['email']);
        $status = trim($_POST['status']);

        $repository = new UserRepository();
        $repository->updateUserById($id, $pseudo, $email, $status);

        header('Location:/code-et-compote/admin/users/modifier/' . $id);
        exit;
    }
}
