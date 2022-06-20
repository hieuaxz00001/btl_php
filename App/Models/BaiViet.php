<?php

namespace App\Models;

use App\Token;
use Core\Model;
use PDO;

class BaiViet extends Model
{
    /**
     * Error messages
     *
     * @var array
     */
    public $errors = [];

    /**
     * Class constructor
     *
     * @param array $data Initial property values (optional)
     *
     * @return void
     */
    public function __construct($data = [])
    {
        foreach ($data as $key => $value) {
            $this->$key = $value;
        };
    }

    /**
     * Save the user model with the current property values
     *
     * @return boolean  True if the user was saved, false otherwise
     */
    public function save()
    {
        if (empty($this->errors)) {

            $sql = 'INSERT INTO bai_viet (tieu_de, ngay_tao, tac_gia, noi_dung_phu,noi_dung_chinh,link_anh,chu_de,tag,luot_xem) 
            VALUES (:tieude, :ngaytao, :tacgia, :noidungphu, :noidungchinh, :image, :chude, :tags, 0)';
            $db = static::getDB();
            $stmt = $db->prepare($sql);
            $stmt->bindValue(':tieude', $this->tieu_de, PDO::PARAM_STR);
            $stmt->bindValue(':ngaytao', $this->ngay_tao, PDO::PARAM_STR);
            $stmt->bindValue(':tacgia', $this->tac_gia, PDO::PARAM_STR);
            $stmt->bindValue(':noidungphu', $this->noi_dung_phu, PDO::PARAM_STR);
            $stmt->bindValue(':noidungchinh', $this->noi_dung_chinh, PDO::PARAM_STR);
            $stmt->bindValue(':image', $this->anh, PDO::PARAM_STR);
            $stmt->bindValue(':chude', $this->chu_de, PDO::PARAM_STR);
            $stmt->bindValue(':tags', $this->tag, PDO::PARAM_STR);
            return $stmt->execute();
        }
        return false;
    }

    public function findAll()
    {
        $sql = 'SELECT * FROM btl_php.bai_viet';
        $db = static::getDB();
        $stmt = $db->prepare($sql);
        $stmt->setFetchMode(PDO::FETCH_OBJ);
        $stmt->execute();
        $arr = [];
        while ($row = $stmt->fetch()) {
            array_push($arr, $row);
        }
        return $arr;
    }

    public function findByTieuDe($tieu_de)
    {
        $sql = 'SELECT * FROM bai_viet WHERE tieu_de like  :tieu_de';

        $db = static::getDB();
        $stmt = $db->prepare($sql);
        $stmt->bindValue(':tieu_de', '%' . $tieu_de . "%", PDO::PARAM_STR);
        $stmt->setFetchMode(PDO::FETCH_OBJ);
        $stmt->execute();
        $arr = [];
        while ($row = $stmt->fetch()) {
            array_push($arr, $row);
        }
        return $arr;
    }

    public function findByTag($tag)
    {
        $sql = 'SELECT * FROM bai_viet WHERE tag =  :tag';
        $db = static::getDB();
        $stmt = $db->prepare($sql);
        $stmt->bindValue(':tag', $tag, PDO::PARAM_STR);
        $stmt->setFetchMode(PDO::FETCH_OBJ);
        $stmt->execute();
        $arr = [];
        while ($row = $stmt->fetch()) {
            array_push($arr, $row);
        }
        return $arr;
    }
    public function findByChuDe($tag)
    {
        $sql = 'SELECT * FROM bai_viet WHERE chu_de =  :tag';
        $db = static::getDB();
        $stmt = $db->prepare($sql);
        $stmt->bindValue(':tag', $tag, PDO::PARAM_STR);
        $stmt->setFetchMode(PDO::FETCH_OBJ);
        $stmt->execute();
        $arr = [];
        while ($row = $stmt->fetch()) {
            array_push($arr, $row);
        }
        return $arr;
    }
    public function findXemNhieuNhat()
    {
        $sql = 'SELECT * FROM btl_php.bai_viet   ORDER BY luot_xem desc';
        $db = static::getDB();
        $stmt = $db->prepare($sql);
        $stmt->setFetchMode(PDO::FETCH_OBJ);
        $stmt->execute();
        $arr = [];
        while ($row = $stmt->fetch()) {
            array_push($arr, $row);
        }
        return $arr;
    }
    public function findById($id)
    {
        $sql = 'SELECT * FROM bai_viet WHERE id = :id';
        $db = static::getDB();
        $stmt = $db->prepare($sql);
        $stmt->bindValue(':id', $id, PDO::PARAM_STR);
        $stmt->setFetchMode(PDO::FETCH_OBJ);
        $stmt->execute();
        $arr = [];
        while ($row = $stmt->fetch()) {
            array_push($arr, $row);
        }
        return $arr;
    }
    public function delete($id)
    {
        $sql = 'DELETE  FROM bai_viet WHERE id = :id';
        $db = static::getDB();
        $stmt = $db->prepare($sql);
        $stmt->bindValue(':id', $id, PDO::PARAM_STR);
        $stmt->setFetchMode(PDO::FETCH_OBJ);
        $stmt->execute();

        return true;
    }
    public static function UpdateBaiviet($data){

        $id = $data["id"];
        $chude = $data["chu_de"];
        $tieude = $data["tieu_de"];
        $tacgia = $data["ten_tac_gia"];
        $noidungchinh = $data["noi_dung_chinh"];
        $noidungphu = $data["noi_dung_phu"];
        $luotxem = $data["luot_xem"];
        $tag = $data["tag"];
        $ngaytao = $data["ngay_tao"];
        $sql = "UPDATE bai_viet
                    SET chu_de = :chude,
                        tieu_de = :tieude,
                        tac_gia = :tacgia,
                        noi_dung_chinh = :noidungchinh,
                        noi_dung_phu = :noidungphu,
                        luot_xem = :luotxem,
                        tag = :tag,
                        ngay_tao=:ngaytao
                    WHERE id = :id_baiviet";

        $db = static::getDB();
        $stmt = $db->prepare($sql);

        $stmt->bindValue(':chude', $chude, PDO::PARAM_STR);
        $stmt->bindValue(':tieude', $tieude, PDO::PARAM_STR);
        $stmt->bindValue(':tacgia', $tacgia, PDO::PARAM_STR);
        $stmt->bindValue(':noidungchinh', $noidungchinh, PDO::PARAM_STR);
        $stmt->bindValue(':noidungphu', $noidungphu, PDO::PARAM_STR);
        $stmt->bindValue(':luotxem', $luotxem, PDO::PARAM_INT);
        $stmt->bindValue(':tag', $tag, PDO::PARAM_STR);
        $stmt->bindValue(':ngaytao', $ngaytao, PDO::PARAM_STR);
        $stmt->bindValue(':id_baiviet', $id, PDO::PARAM_INT);
        $stmt->execute();
    }

}