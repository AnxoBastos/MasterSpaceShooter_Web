<?php

declare(strict_types=1);

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\ScoreModel;
use App\Models\UserModel;
use CodeIgniter\HTTP\ResponseInterface;

class Score extends BaseController{
    

    /* WEB
    ****************************************************/

    public function indexWeb(){
        var_dump($_SESSION);
        $data['scores'] = $this->getTopTen();
        return view('templates/header.view.php')
                .view('index.view.php', $data)
                .view('templates/footer.view.php');
    }

    public function userAccountWeb(){
        if( isset($_SESSION["user"]) ){
            $data = array();
            $data['top'] = $this->getUserTop();
            $data['new'] = $this->getUsernew();
            return view('templates/header.view.php')
                    .view('user.view.php', $data)
                    .view('templates/footer.view.php');
        }
        else{
            return redirect()->to('/access');
        }
    }

    private function getTopTen(){
        $modelScore = new ScoreModel();
        $modelUser = new UserModel();
        $top = $modelScore->getTopScores(10);
        if(!empty($top)){
            foreach($top as $key => $score){
                $user = $modelUser->findUserById(intval($score['id']));
                $top[$key]['username'] = $user['username'];
            }
            return $top;
        }
        else{
            false;
        }
    }

    private function getUserTop(){
        $modelScore = new ScoreModel();
        $data = $modelScore->orderBy('score', 'desc')->findScoresById($_SESSION['user']['id'], 10);
        return $data;
    }

    private function getUserNew(){
        $modelScore = new ScoreModel();
        $data = $modelScore->orderBy('date', 'desc')->findScoresById($_SESSION['user']['id'], 10);
        return $data;
    }

    /* API
    ****************************************************/

    public function store(){
        $rules = [
            'id' => 'required',
            'score' => 'required',
            'date' => 'required'
        ];

        $input = $this->getRequestInput($this->request);

        if (!$this->validateRequest($input, $rules)) {
            return $this->getResponse($this->validator->getErrors(), ResponseInterface::HTTP_BAD_REQUEST);
        }

        $model = new ScoreModel();
        $register = $model->insert($input);

        return $this->getResponse([
            'message' => 'Score added successfully',
            'code' => $register
        ]);
    }

    public function top(){
        $modelScore = new ScoreModel();
        $modelUser = new UserModel();
        $top = $modelScore->getTopScores(10);
        if(!empty($top))
        foreach($top as $key => $score){
            $user = $modelUser->findUserById(intval($score['id']));
            $top[$key]['username'] = $user['username'];
        }

        return $this->getResponse([
            'scores' => $top
        ]);
    }
}