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
        $data = [
            'kategoriNavbar'    => $this->objKategori->getMenuCat(),
            'produkDitampilkan' => $this->objProduk->showInIndex()->getResult(),
            'galeriDitampilkan' => $this->objGaleri->showInIndex()->getResult(),
        ];
        
        return view('main/index',$data);
    }
}
