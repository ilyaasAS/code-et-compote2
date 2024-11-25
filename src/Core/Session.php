<?php

namespace App\Core;

class Session
{
    public function __construct()
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
    }

    public function isAdmin(): bool
    {
        if (isset($_SESSION['status']) && $_SESSION['status'] === 'admin') {
            return true;
        }

        return false;
    }

    public function isAuthenticated(): bool
    {
        return isset($_SESSION['is_logged']) && $_SESSION['is_logged'] === true;
    }

    public function createFlashMessage(string $message): void
    {
        $_SESSION['message'] = $message;
    }

    public function displayFlashMessage(): void
    {
        if (isset($_SESSION['message'])) {
            echo $_SESSION['message'];
            unset($_SESSION['message']);
        }
    }

    public function createUserSession(array $user): void
    {
        $_SESSION['is_logged'] = true;
        $_SESSION['status'] = $user['status'];
        $_SESSION['id'] = $user['id'];
    }

    public function destroySession(): void
    {
        session_start();
        $_SESSION = [];
        session_destroy();
    }
}
