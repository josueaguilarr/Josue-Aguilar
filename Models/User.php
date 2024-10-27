<?php

require '../config/Database.php';

class User
{

    public function user_login(array $data)
    {
        $connection = Database::connection();

        $findUser = $connection->prepare("SELECT name, email, password FROM users WHERE email = :cEmail");
        $findUser->bindParam(':cEmail', $data['email'], PDO::PARAM_STR);
        $findUser->execute();

        if ($findUser->rowCount() == 1) {
            $user = $findUser->fetch(PDO::FETCH_ASSOC);

            if (password_verify($data['password'], $user['password'])) {

                session_start();
                $_SESSION['name'] = $user['name'];
                $_SESSION['email'] = $user['email'];

                return [
                    'success' => true,
                    'message' => "Inicio de sesión valido"
                ];
            } else {
                return [
                'success' => false,
                'message' => 'Las credenciales no coinciden con ningun registro.'
            ];
            }
        }
    }

    public function get_all_users()
    {
        $connection = Database::connection();

        $allUsers = $connection->prepare("SELECT id, name, phone, email, rfc, notes, created_at FROM users");
        $allUsers->execute();

        return $allUsers->fetchAll();
    }

    public function save_new_user(array $data)
    {
        $inputs_validated = $this->validateInputs($data);
        if (!$inputs_validated['success']) return $inputs_validated;

        $connection = Database::connection();

        $newUser = $connection->prepare("INSERT INTO users (name, phone, email, password, rfc, notes) VALUES (:cName, :cPhone ,:cEmail, :cPassword, :cRfc, :cNotes)");

        $passwordHash = password_hash($data['password'], PASSWORD_DEFAULT);

        $newUser->bindParam(':cName', $data['name'], PDO::PARAM_STR);
        $newUser->bindParam(':cPhone', $data['phone'], PDO::PARAM_STR);
        $newUser->bindParam(':cEmail', $data['email'], PDO::PARAM_STR);
        $newUser->bindParam(':cPassword', $passwordHash, PDO::PARAM_STR);
        $newUser->bindParam(':cRfc', $data['rfc'], PDO::PARAM_STR);
        $newUser->bindParam(':cNotes', $data['notes'], PDO::PARAM_STR);
        $newUser->execute();

        return [
            'success' => true,
            'message' => 'El registro se ha guardado de forma exitosa.'
        ];
    }

    public function update_user(array $data)
    {
        $connection = Database::connection();

        $updateUser = $connection->prepare("UPDATE users SET name = :cName, phone = :cPhone, email = :cEmail, rfc = :cRfc, notes = :cNotes WHERE id = :cId");

        $updateUser->bindParam(':cName', $data['name'], PDO::PARAM_STR);
        $updateUser->bindParam(':cPhone', $data['phone'], PDO::PARAM_STR);
        $updateUser->bindParam(':cEmail', $data['email'], PDO::PARAM_STR);
        $updateUser->bindParam(':cRfc', $data['rfc'], PDO::PARAM_STR);
        $updateUser->bindParam(':cNotes', $data['notes'], PDO::PARAM_STR);
        $updateUser->bindParam(':cId', $data['user_id'], PDO::PARAM_INT);
        $updateUser->execute();

        return [
            'success' => true,
            'message' => 'El registro se ha actualizado de forma exitosa.'
        ];
    }

    private function validateInputs($data)
    {
        $fields = [
            'name' => 'Nombre',
            'phone' => 'Teléfono',
            'email' => 'Correo Electrónico',
            'password' => 'Contraseña',
            'rfc' => 'RFC',
            'notes' => 'Notas'
        ];

        $inputData = array_map([$this, 'sanitizeInput'], $data);

        $emptyFields = array_filter($inputData, function ($value, $key) use ($fields) {
            return array_key_exists($key, $fields) && empty($value);
        }, ARRAY_FILTER_USE_BOTH);

        if (!empty($emptyFields)) {
            $invalidFields = array_map(function ($key) use ($fields) {
                return $fields[$key];
            }, array_keys($emptyFields));

            return [
                'success' => false,
                'message' => 'Campos inválidos: ' . implode(', ', $invalidFields)
            ];
        }

        return ['success' => true];
    }

    private function sanitizeInput($data)
    {
        return htmlspecialchars(trim($data), ENT_QUOTES, 'UTF-8');
    }
}
