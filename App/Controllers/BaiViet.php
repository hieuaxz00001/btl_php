<?php

namespace App\Controllers;

use Core\Model;
use Core\View;

class BaiViet extends Model
{
    function index()
    {
        $hehe =$_SERVER;
        View::renderTemplate('BaiViet/baiviet.html',[$hehe]);
    }
    function admin(){
        $sql = 'SELECT * FROM bai_viet';
        $db = static::getDB();
        $stmt = $db->prepare($sql);
        $stmt->execute();
        $data = $stmt->fetch();

        View::renderTemplate('BaiViet/danhsachadmin.html',['data' => $data]);
}
}