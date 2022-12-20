<?php

namespace App\Model;

use App\Lib\Config;
use App\Lib\Database;
use App\Model\ICrudDao;

class GitarKategoriakDao implements ICrudDao
{
    public static function all()
    {
        $dbObj = new Database();
        $conn = $dbObj->getConnection();
        $sql = "SELECT * FROM gitar_kategoriak ORDER BY id;";
        $statement = $conn->prepare($sql);
        $statement->setFetchMode(\PDO::FETCH_OBJ);
        $statement->execute();
        return $statement->fetchAll();
    }

    public static function save()
    {
        $dbObj = new Database();
        $conn = $dbObj->getConnection();

        $nev = $_POST['nev'];
        $sql = "INSERT INTO gitar_kategoriak(`nev`) VALUES (:nev);";
        $statement = $conn->prepare($sql);
        $statement->execute([
            'nev'=>$nev,
        ]);
    }

    public static function getById(int $id)
    {
        $dbObj = new Database();
        $conn = $dbObj->getConnection();
        $statement = $conn->prepare("SELECT * FROM gitar_kategoriak WHERE id =:id;");
        $statement->setFetchMode(\PDO::FETCH_OBJ);
        $statement->execute([
            'id'=>$id,
        ]);
        return $statement->fetch();
    }

    public static function update()
    {
        $dbObj = new Database();
        $conn = $dbObj->getConnection();

        $id = $_POST['id'];
        $nev = $_POST['nev'];
        $sql = "UPDATE gitar_kategoriak SET `nev`=:nev WHERE `id` =:id;";
        try {
            $statement = $conn->prepare($sql);
            $statement->execute([
                'nev'=>$nev,
                'id'=>$id,
            ]);
        } catch (\PDOException $ex) {
            var_dump($ex);
        }
    }

    public static function delete()
    {
        $dbObj = new Database();
        $conn = $dbObj->getConnection();

        $id = $_POST['id'];

        $sql = "UPDATE gitar_kategoriak SET `deleted`=1,`deleted_at` = NOW() WHERE `id` =:id;";
        try {
            $statement = $conn->prepare($sql);
            $statement->execute([
                'id'=>$id,
            ]);
        } catch (\PDOException $ex) {
            var_dump($ex);
        }
    }
}