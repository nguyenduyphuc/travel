<?php

namespace App\Controllers;

class Home extends BaseController
{
    // public function index(): string
    // {
    //     return view('welcome_message');
    // }

    public function index()
    {
        $paramParent = array('parent >' => 0);

        $data = [
            'kategoriNavbar'    => $this->objKategori->getMenuCat(),
            'dataKategori'      => $this->objKategori->getDataBy($paramParent)->getResult(),
            'produkDitampilkan' => $this->objProduk->showInIndex()->getResult(),
            'galeriDitampilkan' => $this->objGaleri->showInIndex()->getResult(),
        ];
        
        return view('main/index',$data);
    }
}
