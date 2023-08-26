<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class FotoProdukController extends BaseController
{
    private function itemBuilder()
    {
        $path       = './assets/images/products';
        $file       = $this->request->getFile('foto');

        if($file->isValid() && !$file->hasMoved())
        {
            $file->move($path, $file->getName());
            $fileName=$file->getName();
        }
        else
        {
            $fileName = (array_key_exists('image_path', $this->request->getPost())) ? $this->request->getPost('image_path') : "no-image.jpg"; 
        }

        return [
            'foto'      => $fileName,
            'alt_foto'  => $this->request->getPost('alt_foto'),
            'id_produk' => $this->request->getPost('id_produk')
        ];
    }

    public function index()
    {
        $data = [
            'fotoProduk' => $this->objFotoProduk->getAllData()->getResult()
        ];

        return view('admin/foto_produk/index', $data);
    }

    public function create()
    {
        $data = [
            'dataProduk'    => $this->objProduk->getAllData()->getResult()
        ];

        return view('admin/foto_produk/form',$data);
    }
}
