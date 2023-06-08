<?php

declare(strict_types=1);

namespace App\Models;

use CodeIgniter\Model;

class ScoreModel extends Model{
    
    protected $table = 'score';
    protected $allowedFields = ['id', 'score', 'date'];
    protected $useAutoIncrement = false;

    public function findScoresById($id, int $limit = 0){
        $user = $this->asArray()->where(['id' => $id])->findAll($limit);
        if(!$user){
            return false;
        }
        return $user;
    }

    public function getTopScores(int $limit = 0){
        $scores = $this->orderBy('score', 'desc')->findAll($limit);
        if(!$scores){
            return false;
        }
        return $scores;
    }
}