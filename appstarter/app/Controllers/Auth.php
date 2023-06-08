<?php

declare(strict_types=1);

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\UserModel;
use CodeIgniter\HTTP\ResponseInterface;

class Auth extends BaseController
{

    /* WEB
    ****************************************************/
    
    public function accessAccountWeb(){
        session_destroy();
        return view('login.view.php');
    }

    public function loginWeb(){
        $input = filter_var_array($_POST, FILTER_SANITIZE_SPECIAL_CHARS);
        $model = new UserModel();
        $user = $model->validateUserWeb($input['email'], $input['password']);
        if( !is_null($user) ){
            $_SESSION['user'] = $user;
            return redirect()->to('/');
        }
        else{
            $data['loginError'] = 'No existe el usuario o la contraseña es erronea.';
            return view('login.view.php', $data);
        }
    }

    public function logoutWeb(){
        session_destroy();
        return redirect()->to('/');
    }

    public function updateUsernameWeb(){
        $input = filter_var_array($_POST, FILTER_SANITIZE_SPECIAL_CHARS);
        $model = new UserModel();
        $user = $model->findUserByUsername($input['newUsername']);
        if( empty($user) ){
            $register = $model->save( array (
                'id' => $_SESSION['user']['id'],
                'username' => $input['newUsername']
            ));
            if($register) $_SESSION['user']['username'] = $input['newUsername'];
        }
        else{
            $data['updateUsernameError'] = 'El nombre de usuario ya esta en uso.';
            return view('templates/header.view.php')
                    .view('user.view.php', $data)
                    .view('templates/footer.view.php');
        }
        return redirect()->to('/user');
    }

    public function updatePasswordWeb(){
        $input = filter_var_array($_POST, FILTER_SANITIZE_SPECIAL_CHARS);
        $model = new UserModel();
        $user = $model->validateUserWeb($_SESSION['user']['email'], $input['actualPassword']);
        if( !is_null($user) ){
            $register = $model->save( array (
                'id' => $_SESSION['user']['id'],
                'password' => $input['newPassword']
            ));
        }
        else{
            $data['updatePasswordError'] = 'La contraseña actual no es correcta';
            return view('templates/header.view.php')
                    .view('user.view.php', $data)
                    .view('templates/footer.view.php');
        }
        return redirect()->to('/user');
    }

    public function deleteUserWeb(){
        $input = filter_var_array($_POST, FILTER_SANITIZE_SPECIAL_CHARS);
        $model = new UserModel();
        $user = $model->validateUserWeb($_SESSION['user']['email'], $input['password']);
        if( !is_null($user) ){
            $model->delete($_SESSION['user']['id']);
            session_destroy();
            return redirect()->to('/');
        }
        return redirect()->to('/');
    }

    public function registerWeb(){
        $input = filter_var_array($_POST, FILTER_SANITIZE_SPECIAL_CHARS);
        $model = new UserModel();
        $user = $model->findUserByEmailAddress($input['newEmail']);
        if( empty($user) ){
            $email = filter_var($input['newEmail'], FILTER_VALIDATE_EMAIL);
            if( !empty($email) ){
                $register = $model->insert( array(
                    'username' => $input['newUsername'],
                    'email' => $email,
                    'password' => $input['newPassword']
                ) );
                if( $register ){
                    $user = $model->validateUserWeb($input['newEmail'], $input['newPassword']);
                    if( !is_null($user) ){
                        $_SESSION['user'] = $user;
                        return redirect()->to('/');
                    }
                }
            }
            else{
                $data['registerError'] = 'Inserte un email valido.';
                return view('login.view.php', $data);
            }
        }
        else {
            $data['registerError'] = 'El usuario ya existe.';
            return view('login.view.php', $data);
        }
    }

    public function download(){
        return $this->response->download('assets/downloadables/desktop-1.0.jar', null);
    }

    /* API
    ****************************************************/

    public function register(){
        $rules = [
            'username' => 'required|is_unique[user.username]',
            'email' => 'required|valid_email|is_unique[user.email]',
            'password' => 'required|min_length[8]|max_length[255]'
        ];

        $input = $this->getRequestInput($this->request);

        if (!$this->validateRequest($input, $rules)) {
            return $this->getResponse($this->validator->getErrors(), ResponseInterface::HTTP_BAD_REQUEST);
        }

        $userModel = new UserModel();
        $userModel->save($input);

        return $this->getJWTForUser($input['email'], ResponseInterface::HTTP_CREATED);
    }

    public function login( )
    {
        $rules = [
            'email' => 'required|min_length[6]|max_length[50]|valid_email',
            'password' => 'required|min_length[8]|max_length[255]|validateUser[email, password]'
        ];

        $errors = [
            'password' => [
                'validateUser' => 'Invalid login credentials provided'
            ]
        ];
        
        $input = $this->getRequestInput($this->request);
        if (!$this->validateRequest($input, $rules, $errors)) {
            return $this->getResponse($this->validator->getErrors(), ResponseInterface::HTTP_BAD_REQUEST);
        }
        else{
            return $this->getJWTForUser($input['email']);
        }
    }

    private function getJWTForUser(string $email, int $responseCode = ResponseInterface::HTTP_OK){
        try {
            $model = new UserModel();
            $user = $model->findUserByEmailAddress($email);
            unset($user['password']);

            helper('jwt');

            return $this->getResponse([
                'message' => 'User authenticated successfully',
                'user' => $user,
                'access_token' => getSignedJWTForUser($email)
            ]);
        } catch (\Exception $e) {
            return $this->getResponse([
                'error' => $e->getMessage()
            ], $responseCode);
        }
    }
}