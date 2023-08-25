<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class ProdukController extends BaseController
{
    private function itemBuilder()
    {
        $path       ='./assets/images/products';
        $file       =$this->request->getFile('foto_produk');

        if($file->isValid() && !$file->hasMoved())
        {
            $file->move($path, $file->getName());
            $fileName=$file->getName();
        }
        else
        {
            $fileName = (array_key_exists('image_path', $this->request->getPost())) ? $this->request->getPost('image_path') : "no-image.jpg"; 
        }

        $paramCat   =array('kategori_id' => $this->request->getPost('id_kategori'));
        $dataCat    =$this->objKategori->getDataBy($paramCat)->getRow();

        $itemslug=str_replace(" ", "-", $this->request->getPost('url'));
        $slug=$dataCat->url_kategori.'/'.strtolower($itemslug);

        return [
            'nama_produk'           =>$this->request->getPost('nama_produk'),
            'harga'                 =>$this->request->getPost('harga'),
            'satuan'                =>$this->request->getPost('satuan'),
            'durasi'                =>$this->request->getPost('satuan'),
            'deskripsi'             =>$this->request->getPost('deskripsi'),
            'foto_produk'           =>$fileName,
            'alt_foto'              =>$this->request->getPost('alt_foto'),
            'min_kapasitas'         =>$this->request->getPost('min_kapasitas'),
            'judul_seo_produk'      =>$this->request->getPost('judul_seo_produk'),
            'deskripsi_seo_produk'  =>$this->request->getPost('deskripsi_seo_produk'),
            'id_kategori'           =>$this->request->getPost('id_kategori'),
            'url'                   =>$slug
        ];
    }
    
    public function index()
    {
        $data = [
            'dataProduk' => $this->objProduk->getAllData()->getResult(),
        ];

        return view('admin/produk/index', $data);
    }
}
