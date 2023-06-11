<?php

declare(strict_types=1);

namespace App\Models;

use CodeIgniter\Model;

class ScoreModel extends Model{
    
    protected $table = 'score';
    protected $allowedFields = ['id', 'score', 'date'];
    protected $useAutoIncrement = false;

    public function getTopScores(int $limit = 0, int $id = 0){
        if(empty($id)){
            $scores = $this->orderBy('score', 'desc')->findAll($limit);
            if(!$scores){
                return false;
            }
            return $scores;
        }
        else{
            $scores = $this->orderBy('score', 'desc')->where(['id' => $id])->findAll($limit);
            if(!$scores){
                return false;
            }
            return $scores;
        }
    }

    public function getRecentScores(int $limit = 0, int $id = 0){
        if(empty($id)){
            $scores = $this->orderBy('date', 'desc')->findAll($limit);
            if(!$scores){
                return false;
            }
            return $scores;
        }
        else{
            $scores = $this->orderBy('date', 'desc')->where(['id' => $id])->findAll($limit);
            if(!$scores){
                return false;
            }
            return $scores;
        }
    }
}