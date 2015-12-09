<?php

namespace App\Repository;

use Doctrine\Common\Persistence\PersistentObject;
use Doctrine\DBAL\Connection;

class Guestbook
{
    private $db;

    public function __construct(Connection $db)
    {
        $this->db = $db;
    }

    public function findAll()
    {
        $sql = 'SELECT * FROM guestbook';
        return $this->db->executeQuery($sql)->fetchAll();
    }
}