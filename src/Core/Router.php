<?php

namespace App\Core;

use App\Controller\Admin\AdminController;
use App\Controller\Admin\AdminUserController;
use App\Controller\Front\ContactController;
use App\Controller\Front\HomeController;
use App\Controller\Front\TopicController;
use App\Controller\Front\UserController;

class Router
{
    /**
     * @var array
     */
    private array $routes;

    /**
     * @var object
     */
    private object $currentController;

    public function __construct()
    {
        $this->addRoutes('/', function (): void {
            $this->currentController = new HomeController();
            $this->currentController->show();
        });

        $this->addRoutes('/contactez-nous', function (): void {
            $this->currentController = new ContactController();
            $this->currentController->show();
        });

        $this->addRoutes('/inscription', function (): void {
            $this->currentController = new UserController();
            $this->currentController->showSignUpForm();
        });

        $this->addRoutes('/process-sign-up-form', function (): void {
            $this->currentController = new UserController();
            $this->currentController->processSignUpForm();
        });

        $this->addRoutes('/connexion', function (): void {
            $this->currentController = new UserController();
            $this->currentController->showSignInForm();
        });

        $this->addRoutes('/process-sign-in-form', function (): void {
            $this->currentController = new UserController();
            $this->currentController->processSignInForm();
        });

        $this->addRoutes('/deconnexion', function (): void {
            $this->currentController = new UserController();
            $this->currentController->logout();
        });

        $this->addRoutes('/topic/{id}', function (array $params): void {
            $this->currentController = new TopicController();
            $this->currentController->showTopic($params);
        });

        $this->addRoutes('/messages/process-form', function (): void {
            $this->currentController = new TopicController();
            $this->currentController->processAddMessageForm();
        });

        $this->addRoutes('/admin/dashboard', function (): void {
            $this->currentController = new AdminController();
            $this->currentController->showDashboard();
        });

        $this->addRoutes('/admin/utilisateurs', function (): void {
            $this->currentController = new AdminUserController();
            $this->currentController->showUsers();
        });

        $this->addRoutes('/admin/users/modifier/{id}', function (array $params): void {
            $this->currentController = new AdminUserController();
            $this->currentController->showUpdateUserForm($params);
        });
        $this->addRoutes('/admin/users/process-update-user-form', function (): void {
            $this->currentController = new AdminUserController();
            $this->currentController->processUpdateUserForm();
        });
    }

    /**
     * @param string $route
     * @param callable $closure
     *
     * @return void
     */
    private function addRoutes(string $route, callable $closure): void
    {
        $pattern = str_replace('/', '\/', $route);
        $pattern = preg_replace('/\{(\w+)\}/', '(?P<$1>[^\/]+)', $pattern);
        $pattern = '/^' . $pattern . '$/';

        $this->routes[$pattern] = $closure;
    }

    /**
     * @return void
     */
    public function execute(): void
    {
        $requestUri = $_SERVER['REQUEST_URI'];
        $requestUri = str_replace('/code-et-compote', '', $requestUri);

        foreach ($this->routes as $key => $closure) {
            if (preg_match($key, $requestUri, $matches)) {
                array_shift($matches);
                $closure($matches);
                return;
            }
        }

        header('HTTP/1.0 404 Not Found');
        include_once '../templates/error-404.php';
    }
}
