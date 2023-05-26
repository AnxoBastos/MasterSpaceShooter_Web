<?php

declare(strict_types=1);

namespace App\Models;

use CodeIgniter\Model;

class ScoreModel extends Model{
    
    protected $table = 'score';
    protected $allowedFields = {'score', 'date'};

    public function findUserById($id){
        $user = $this->asArray()->where(['id' => $id])->first();
        if(!$user){
            throw new Exception( 'Could not find client for specific ID' )
        }
        return $user;
    }
}