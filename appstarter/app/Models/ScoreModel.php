<?php

declare(strict_types=1);

namespace App\Models;

use CodeIgniter\Model;

class ScoreModel extends Model{
    
    protected $table = 'score';
    protected $allowedFields = ['score', 'date'];

    public function findScoresById($id, int $limit = 0){
        $user = $this->asArray()->where(['id' => $id])->findAll($limit);
        if(!$user){
            throw new Exception( 'Could not find user for specific ID' );
        }
        return $user;
    }

    public function getTopScores(int $limit = 0){
        $scores = $this->orderBy('score', 'desc')->findAll($limit);
        if(!$scores){
            throw new Exception( 'Could not find scores' );
        }
        return $scores;
    }
}