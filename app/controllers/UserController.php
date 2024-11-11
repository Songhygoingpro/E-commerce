<?php
require_once __DIR__ . '/../models/User.php';

class UserController
{
    public function register()
    {
        // Validate input
        if (empty($_POST['username']) || empty($_POST['email']) || empty($_POST['password'])) {
            echo 'All fields are required.';
            return;
        }

        // Sanitize input
        $userData = [
            'username' => htmlspecialchars(trim($_POST['username'])),
            'email' => htmlspecialchars(trim($_POST['email'])),
            'password' => password_hash(trim($_POST['password']), PASSWORD_DEFAULT),
        ];

        $user = new User();

        // Check if the email already exists
        if ($user->findByEmail($userData['email'])) {
            echo 'Email is already registered.';
            return;
        }

        // Create the user
        if ($user->create($userData)) {
            $_SESSION['signedUp'] = true;
            // Redirect or display a success message
            header('Location:  ../../public/index.php');
            exit();
        } else {
            echo 'Error creating user. Please try again.';
        }
    }

    public function login()
    {
        // Validate input
        if (empty($_POST['email']) || empty($_POST['password'])) {
            $error = urlencode('Both email and password are required.');
            header("Location: ../../views/auth/login.php?error=$error");
            exit();
        }

        // Sanitize input
        $email = htmlspecialchars(trim($_POST['email']));
        $password = trim($_POST['password']);

        $user = new User();
        $foundUser = $user->findByEmail($email);

        if ($foundUser && password_verify($password, $foundUser['password'])) {
            // Successful login, start a session
            session_start();
            $_SESSION['user_id'] = $foundUser['user_id'];
            $_SESSION['username'] = $foundUser['username'];
            $_SESSION['is_admin'] = $foundUser['is_admin'];
            $_SESSION['logedIn'] = true;

            // Redirect to user dashboard or other protected page
            header('Location: /public/index.php');
            exit();
        } else {
            // Login failed, display an error message
            $error = urlencode('Invalid email or password.');
            header("Location: ./../views/auth/login.php?error=$error");
            exit();
        }
    }
}

if (isset($_GET['action'])) {
    $controller = new UserController();

    if ($_GET['action'] === 'register' && $_SERVER['REQUEST_METHOD'] === 'POST') {
        $controller->register();
    } elseif ($_GET['action'] === 'login' && $_SERVER['REQUEST_METHOD'] === 'POST') {
        $controller->login();
    } else {
        echo 'Invalid action or request method.';
    }
} else {
    echo 'No action specified.';
}
