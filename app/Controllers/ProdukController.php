<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class ProdukController extends BaseController
{
    public function create()
    {
        return view('admin/produk/create_produk_form');
    }
}
