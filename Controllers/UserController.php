<?php

require '../Models/User.php';

class UserController
{

    public function index()
    {
        try {
            $user = new User();
            $all_users = $user->get_all_users();

            echo json_encode($all_users);
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    public function login()
    {
        try {
            $user = new User();
            $loginUser = $user->user_login($_POST);

            echo json_encode($loginUser);
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    public function store()
    {
        try {
            $user = new User();
            $newUser = $user->save_new_user($_POST);

            echo json_encode($newUser);
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    public function update()
    {
        try {
            $user = new User();
            $updateUser = $user->update_user($_POST);

            echo json_encode($updateUser);
        } catch (\Throwable $th) {
            throw $th;
        }
    }
}

$controller = new UserController();
$action = $_GET['action'] ?? '';

switch ($action) {
    case 'login':
        $controller->login();
        break;
    case 'store':
        $controller->store();
        break;
    case 'index':
        $controller->index();
        break;
    case 'update':
        $controller->update();
        break;
    default:
        echo json_encode(['success' => false, 'message' => 'Acción no válida.']);
        exit;
}
