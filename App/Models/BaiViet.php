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

}