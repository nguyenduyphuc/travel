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

    public function store()
    {
        if(!$this->validate($this->objFotoProduk->getCreateRules()))
        {
            return redirect()->back()->withInput()->with('validation', $this->validator->getErrors());
        }

        $fotoProduk = $this->itemBuilder();

        try
        {
            $this->objFotoProduk->saveData($fotoProduk);

            return redirect()->to(base_url().'/admin/foto_produk/index')->with('sukses', 'Data Berhasil Ditambahkan!');
        }
        catch (\Exception $e)
        {
            return redirect()->back()->withInput()->with('error', $e->getMessage());
        }
    }

    public function edit($id_foto)
    {
        $paramFoto          = array('id_foto' => $id_foto);

        $data = [
            'foto'          => $this->objFotoProduk->getDataBy($paramFoto)->getRow(),
            'dataProduk'    => $this->objProduk->getAllData()->getResult()
        ];

        return view('admin/edit_foto-produk_form',$data);
    }
}
