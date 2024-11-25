<?php

namespace App\Controller\Admin;

use App\Controller\AbstractController;
use App\Core\Session;

class AdminController extends AbstractController
{
    public function showDashboard(): void
    {
        $session = new Session();

        if ($session->isAdmin() === false) {
            header('Location:/code-et-compote/');
            exit;
        }

        $this->render('admin/dashboard');
    }
}
