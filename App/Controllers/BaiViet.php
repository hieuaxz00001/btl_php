<?php

namespace App\Controllers;


use Core\Controller;
use Core\Model;
use Core\View;

class BaiViet extends Controller


{
    function index()
    {
        $hehe =$_SERVER;
        View::renderTemplate('BaiViet/baiviet.html',[$hehe]);
    }

    public function saveBaiViet ()
    {
        $baiViet  = new \App\Models\BaiViet($_POST);

        $data = $baiViet->save();

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