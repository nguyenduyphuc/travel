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
            'produk_id' => $this->request->getPost('produk_id')
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

            return redirect()->to(base_url().'/admin/foto-produk/index')->with('sukses', 'Data Berhasil Ditambahkan!');
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

        return view('admin/foto_produk/form',$data);
    }

    public function update($id_foto)
    {
        if(!$this->validate($this->objFotoProduk->getUpdateRules()))
        {
            return redirect()->back()->withInput()->with('validation', $this->validator->getErrors());
        }

        $fotoProduk = $this->itemBuilder();

        try
        {
            $this->objFotoProduk->saveData($fotoProduk, $id_foto);

            return redirect()->to(base_url().'/admin/foto-produk')->with('sukses', 'Data Berhasil Diupdate!');
        }
        catch (\Exception $e)
        {
            return redirect()->back()->withInput()->with('error', $e->getMessage());
        }
    }

    public function destroy($id_foto)
    {
        $paramFoto  = array('id_foto' => $id_foto);
        $foto       = $this->objFotoProduk->getDataBy($paramFoto)->getRow();

        try
        {
            if($foto->foto!="" and $foto->foto!="no-image.jpg" and file_exists(realpath(APPPATH . './assets/images/products/'.$foto->foto)))
            {
                unlink(realpath(APPPATH . './assets/images/products/'.$foto->foto));
            }
            
            $this->objFotoProduk->deleteData($paramFoto);

            return redirect()->to(base_url().'/admin/foto-produk')->with('sukses', 'Data Berhasil Dihapus!');
        }
        catch (\Exception $e)
        {
            return redirect()->to(base_url().'/admin/foto-produk')->with('error', $e->getMessage());
        }
    }
}
