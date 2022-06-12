<?php

namespace App\Controllers;

use Core\View;

class BaiViet
{
    function index()
    {
        $hehe =$_SERVER;
        View::renderTemplate('BaiViet/baiviet.html',[$hehe]);
    }
}