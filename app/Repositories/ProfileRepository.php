<?php

namespace App\Repositories;

use App\Infrastructure\Database;
use PDO;

class ProfileRepository
{
    private $db;

    public function __construct()
    {
        $this->db = Database::getInstance();
    }

    public function getProfile($id)
    {
        $profileStatement = $this->db->query('SELECT * FROM profiles WHERE id=:id', ['id'=>$id]);

        return $profileStatement->fetch(PDO::FETCH_ASSOC);
    }

    public function getAvatars()
    {
        $avatarsStatement = $this->db->query('SELECT id, avatar FROM profiles');

        return $avatarsStatement->fetchAll(PDO::FETCH_ASSOC);
    }
}
