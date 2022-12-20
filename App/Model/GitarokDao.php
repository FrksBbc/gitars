<?php

namespace App\Model;

use App\Lib\Config;
use App\Lib\Database;
use App\Model\ICrudDao;

class GitarokDao implements ICrudDao
{
    private static $DATA = [];

    public static function all()
    {
        $dbObj = new Database();
        $conn = $dbObj->getConnection();
        $sql = "SELECT g.id, g.gyarto, g.tipus, g.kategoria_id, g.hurok_szama, g.ar, g.raktar_mennyiseg, g.allapot, gk.nev FROM gitarok as g INNER JOIN gitar_kategoriak as gk ON g.kategoria_id = gk.id ORDER BY g.id;";
        $statement = $conn->prepare($sql);
        $statement->setFetchMode(\PDO::FETCH_OBJ);
        $statement->execute();
        return $statement->fetchAll();
    }


    public static function save()
    {
        $gyarto = $_POST['gyarto'];
        $tipus = $_POST['tipus'];
        $kategoria_id = $_POST['kategoria_id'];
        $hurok_szama = $_POST['hurok_szama'];
        $ar = $_POST['ar'];
        $raktar_mennyiseg = $_POST['raktar_mennyiseg'];
        $allapot = isset($_POST['allapot']) ? 1 : 0;

        $dbObj = new Database();
        $conn = $dbObj->getConnection();

        $sql = "INSERT INTO gitarok (`gyarto`,`tipus`,`kategoria_id`,`hurok_szama`,`ar`,`raktar_mennyiseg`,`allapot`) VALUES (:gyarto, :tipus, :kategoria_id, :hurok_szama, :ar,:raktar_mennyiseg, :allapot);";
        $statement = $conn->prepare($sql);
        $statement->execute([
            'gyarto'=>$gyarto,
            'tipus'=>$tipus,
            'kategoria_id'=>$kategoria_id,
            'hurok_szama'=>$hurok_szama,
            'ar'=>$ar,
            'raktar_mennyiseg'=>$raktar_mennyiseg,
            'allapot'=>$allapot
        ]);
    }

    public static function getById(int $id)
    {
        $dbObj = new Database();
        $conn = $dbObj->getConnection();
        $statement = $conn->prepare("SELECT * FROM gitarok WHERE id =:id;");
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
        $gyarto = $_POST['gyarto'];
        $tipus = $_POST['tipus'];
        $kategoria_id = $_POST['kategoria_id'];
        $hurok_szama = $_POST['hurok_szama'];
        $ar = $_POST['ar'];
        $raktar_mennyiseg = $_POST['raktar_mennyiseg'];
        $allapot = isset($_POST['allapot']) ? 1 : 0;
        $sql = "UPDATE gitarok SET `gyarto`=:gyarto, `tipus`=:tipus, `kategoria_id`=:kategoria_id, `hurok_szama`=:hurok_szama,`ar`=:ar,`raktar_mennyiseg`=:raktar_mennyiseg,`allapot`=:allapot WHERE `id` =:id;";

        try {
            $statement = $conn->prepare($sql);
            $statement->execute([
                'gyarto'=>$gyarto,
                'tipus'=>$tipus,
                'kategoria_id'=>$kategoria_id,
                'hurok_szama'=>$hurok_szama,
                'ar'=>$ar,
                'raktar_mennyiseg'=>$raktar_mennyiseg,
                'allapot'=>$allapot,
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

        $sql = "DELETE FROM gitarok WHERE `id` =:id;";
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