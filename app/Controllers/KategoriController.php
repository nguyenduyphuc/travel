<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class KategoriController extends BaseController
{
    public function index()
    {
        $data = [
            'dataKategori'  => $this->objKategori->getParentName()
        ];

        return view('admin/kategori/index', $data);
    }

    public function create()
    {
        $data = [
            'dataParent'  => $this->objKategori->getAllCatForAdm()
        ];

        return view('admin/kategori/form', $data);
    }
}
