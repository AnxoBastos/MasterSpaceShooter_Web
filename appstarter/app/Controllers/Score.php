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

    /* API
    ****************************************************/

    public function show(){
        $model = new ScoreModel();
        return $this->getResponse([
            'message' => 'Scores retrieved succesfully',
            'scores' => $model->orderBy('date', 'desc')->findAll()
        ]);
    }

    public function showTop(){
        $model = new ScoreModel();
        return $this->getResponse([
            'message' => 'Scores retrieved succesfully',
            'scores' => $model->orderBy('score', 'desc')->findAll()
        ]);
    }

    public function showDate($id){
        try {

            $model = new ScoreModel();
            $user = $model->orderBy('date', 'desc')->findUserById($id);

            return $this->getResponse([
                'message' => 'Score retrieved successfully',
                'id' => $user
            ]);

        } catch (Exception $e) {
            return $this->getResponse([
                'message' => 'Could not find scores for specified ID'
            ], ResponseInterface::HTTP_NOT_FOUND);
        }
    }

    public function showTop2($id){
        try {

            $model = new ScoreModel();
            $user = $model->orderBy('score', 'desc')->findUserById($id);

            return $this->getResponse([
                'message' => 'Score retrieved successfully',
                'id' => $user
            ]);

        } catch (Exception $e) {
            return $this->getResponse([
                'message' => 'Could not find scores for specified ID'
            ], ResponseInterface::HTTP_NOT_FOUND);
        }
    }

    private function getTopTen(){
        $modelScore = new ScoreModel();
        $modelUser = new UserModel();
        $top = $modelScore->getTopScores(10);
        foreach($top as $key => $score){
            $user = $modelUser->findUserById(intval($score['id']));
            $top[$key]['username'] = $user['username'];
        }
        return $top;
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
}