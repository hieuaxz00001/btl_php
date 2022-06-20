<?php

namespace App\Controllers;


use App\Models\BaivietModel;
use Core\Controller;
use Core\Model;
use Core\View;

class BaiViet extends Controller
{

    function themBaiViet()
    {
        $hehe = $_SERVER;
        View::renderTemplate('BaiViet/thembaiviet.html', [$hehe]);
    }

    public function saveBaiViet()
    {
        $baiViet = new \App\Models\BaiViet($_POST);

        $data = $baiViet->save();

    }

    function admin()
    {
        $baiViet = new \App\Models\BaiViet();
        $data = $baiViet->findAll();
        View::renderTemplate('BaiViet/danhsachadmin.html', ['data' => $data]);
    }

    function timKiem()
    {

        $url = $_SERVER['QUERY_STRING'];
        $url_components = parse_url($url);
        parse_str($url_components['path'], $params);
        echo $params['tieude'];
        $baiViet = new \App\Models\BaiViet();
        $data= $baiViet->findByTieuDe($params['tieude']);
        View::renderTemplate('BaiViet/danhsachadmin.html', ['data' => $data]);


    }
    function trangchu(){
        $baiViet = new \App\Models\BaiViet();
        $list1= $baiViet->findByChuDe('Thời sự');
        $list2= $baiViet->findByChuDe('Kinh doanh');
        $list3= $baiViet->findByChuDe('Khoa học');
        $list4= $baiViet->findByChuDe('Giải trí');
        $list5= $baiViet->findByChuDe('Pháp luật');
        $list_xem_nhieu_nhat = $baiViet->findXemNhieuNhat();
        View::renderTemplate('BaiViet/trang_chu_bai_viet.html',[
            'list1' =>$list1,'list2' =>$list2,'list3' =>$list3,'list4' =>$list4,'list5' =>$list5,'list_xnn'=>$list_xem_nhieu_nhat
        ]);
    }
    function detail(){
        $url = $_SERVER['QUERY_STRING'];
        $url_components = parse_url($url);
        parse_str($url_components['path'], $params);
        $baiViet = new \App\Models\BaiViet();
        $data= $baiViet->findById($params['id']);
        View::renderTemplate('BaiViet/chi_tiet_bai_viet.html',['data' =>$data]);
    }
    function chuDe(){
        $url = $_SERVER['QUERY_STRING'];
        $url_components = parse_url($url);
        parse_str($url_components['path'], $params);

        $baiViet = new \App\Models\BaiViet();
        $data= $baiViet->findByChuDe($params['chu-de']);

        View::renderTemplate('BaiViet/ds_chu_de.html',['data' =>$data,'name'=>$params['chu-de']]);
    }
    function editBaiviet()
    {
        $url = $_SERVER['QUERY_STRING'];
        $url_components = parse_url($url);
        parse_str($url_components['path'], $params);
        $baiViet = new \App\Models\BaiViet();
        $data =$baiViet->findById($params['id']);
        View::renderTemplate('BaiViet/chinhsuabaiviet.html',['datas'=>$data]);
    }

    function UpdateBaiviet()
    {
        $baiViet = new \App\Models\BaiViet();
        $check= $baiViet->UpdateBaiviet($_POST);
        $this->redirect('/admin/trang-chu');

    }
    function delete()
    {
        $url = $_SERVER['QUERY_STRING'];
        $url_components = parse_url($url);
        parse_str($url_components['path'], $params);
        $baiViet = new \App\Models\BaiViet();
        $check= $baiViet->delete($params['id']);
        $this->redirect('/admin/trang-chu');

    }
}