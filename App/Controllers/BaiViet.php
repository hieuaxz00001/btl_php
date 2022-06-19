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
}