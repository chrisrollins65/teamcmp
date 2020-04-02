<?php

namespace App\Repositories;

use App\Infrastructure\Database;
use PDO;

class FriendRepository
{
    private $db;

    public function __construct()
    {
        $this->db = Database::getInstance();
    }

    public function isFriend($id)
    {
        $statement = $this->db->query('SELECT * FROM friends WHERE friend_id=:id', ['id'=>$id]);

        return $statement->fetch(PDO::FETCH_ASSOC);
    }

    public function addFriend($id)
    {
        $this->db->query('INSERT INTO friends (friend_id) VALUES (:id)', ['id'=>$id]);
    }

    public function deleteFriend($id)
    {
        $this->db->query('DELETE FROM friends WHERE friend_id=:id', ['id'=>$id]);
    }
}
