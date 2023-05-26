<?php

declare(strict_types=1);

use App\Core\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

class Score extends BaseController{
    
    public function index(){
        $model = new ScoreModel();
        return $this->getResponse([
            'message' => 'Scores retrieved succesfully',
            'scores' => $mode->findAll();
        ]);
    }
}