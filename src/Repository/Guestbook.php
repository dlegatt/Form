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

    public function saveNew(array $data)
    {
        $this->db->insert('guestbook', $data);
        return $this->find($this->db->lastInsertId());
    }

    public function find($id)
    {
        return $this->db->fetchAssoc('SELECT * FROM guestbook WHERE id=?', [$id]);
    }

    public function delete($id)
    {
        return $this->db->delete('guestbook', ['id' => $id]);
    }

    public function update($id, $data)
    {
        unset($data['id']);
        $this->db->update('guestbook', $data, ['id' => $id]);
        return $this->find($id);
    }
}