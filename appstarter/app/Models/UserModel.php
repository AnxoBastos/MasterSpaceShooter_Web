<?php

namespace App\Models;

use CodeIgniter\Model;
use Exception;

class UserModel extends Model
{
    protected $table = 'user';
    protected $allowedFields = [
        'username', 'email', 'password'
    ];

    protected $beforeInsert = ['beforeInsert'];
    protected $beforeUpdate = ['beforeUpdate'];

    /* API
    ****************************************************/

    protected function beforeInsert(array $data): array
    {
        return $this->getUpdatedDataWithHashedPassword($data);
    }

    protected function beforeUpdate(array $data): array
    {
        return $this->getUpdatedDataWithHashedPassword($data);
    }

    private function getUpdatedDataWithHashedPassword(array $data): array
    {
        if (isset($data['data']['password'])) {
            $plaintextPassword = $data['data']['password'];
            $data['data']['password'] = password_hash($plaintextPassword, PASSWORD_BCRYPT);
        }

        return $data;
    }

    /* WEB & API
    ****************************************************/

    public function findUserByEmailAddress(string $email) {
        $user = $this->asArray()->where(['email' => $email])->first();

        if (!$user) {
            return false;
            //throw new Exception('User does not exist for specified email address');
        }
        return $user;
    }

    /* WEB
    ****************************************************/

    public function findUserById(int $id) {
        $user = $this->asArray()->where(['id' => $id])->first();
        if (!$user) {
            return false;
            //throw new Exception('User does not exist for specified id');
        }
        return $user;
    }

    public function findUserByUsername(string $username) {
        $user = $this->asArray()->where(['username' => $username])->first();
        if (!$user) {
            return false;
            //throw new Exception('User does not exist for specified id');
        }
        return $user;
    }

    public function validateUserWeb(string $email, string $password): ?array {
        $user = $this->findUserByEmailAddress($email);
        if( !empty($user) && password_verify($password, $user['password']) ){
            unset($user['password']);
            return $user;
        }
        else{
            return null;
        }
    }
    
}