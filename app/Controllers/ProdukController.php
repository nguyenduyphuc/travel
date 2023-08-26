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

        $paramCat   =array('id_kategori' => $this->request->getPost('kategori_id'));
        $dataCat    =$this->objKategori->getDataBy($paramCat)->getRow();

        $itemslug=str_replace(" ", "-", $this->request->getPost('url_produk'));
        $slug=$dataCat->url_kategori.'/'.strtolower($itemslug);

        return [
            'nama_produk'           =>$this->request->getPost('nama_produk'),
            'harga'                 =>$this->request->getPost('harga'),
            'durasi'                =>$this->request->getPost('durasi'),
            'deskripsi_produk'      =>$this->request->getPost('deskripsi_produk'),
            'foto_produk'           =>$fileName,
            'alt_foto'              =>$this->request->getPost('alt_foto'),
            'min_kapasitas'         =>$this->request->getPost('min_kapasitas'),
            'judul_seo_produk'      =>$this->request->getPost('judul_seo_produk'),
            'deskripsi_seo_produk'  =>$this->request->getPost('deskripsi_seo_produk'),
            'kategori_id'           =>$this->request->getPost('kategori_id'),
            'url_produk'            =>$slug
        ];
    }
    
    public function index()
    {
        $data = [
            'dataProduk' => $this->objProduk->getAllData()->getResult(),
        ];

        return view('admin/produk/index', $data);
    }

    public function create()
    {
        $data = [
            'dataKategori' => $this->objKategori->getAllCatForAdm() 
        ];

        return view('admin/produk/form', $data);
    }

    public function store()
    {
        if(!$this->validate($this->objProduk->getCreateRules()))
        {
            return redirect()->back()->withInput()->with('validation', $this->validator->getErrors());
        }

        $produk = $this->itemBuilder();

        try
        {
            $this->objProduk->saveData($produk);

            $cariIdProduk   = array('nama_produk' => $this->request->getPost('nama_produk'));
            $produkDisimpan = $this->objProduk->getDataBy($cariIdProduk)->getRow();

            $saveSampul = array(
                'id_foto'       => '',
                'foto'          => $produkDisimpan->foto_produk,
                'alt_foto'      => $this->request->getPost('alt_foto'),
                'produk_id'     => $produkDisimpan->id_produk
            );

            $this->objFotoProduk->saveData($saveSampul);
            
            $arrRoute=array(
                'id_slug'   => '',
                'slug'      => $produk['url_produk'],
                'target'    => 'Home::product/'.$produkDisimpan->id_produk,
                'filters'   => ''
            );

            $this->objSlug->saveData($arrRoute);

            $cariIdSlug         = array('slug'=>$produk['url_produk']);
            $slugDisimpan       = $this->objSlug->getDataBy($cariIdSlug)->getRow();

            $saveIdSlug         = array('slug_id' => $slugDisimpan->id_slug);

            $this->objProduk->saveData($saveIdSlug, $produkDisimpan->id_produk);

            return redirect()->to(base_url().'/admin/produk')->with('sukses', 'Data Berhasil Ditambahkan!');
        }
        catch (\Exception $e)
        {
            return redirect()->back()->withInput()->with('error', $e->getMessage());
        }
    }

    public function update($id_produk)
    {
        if(!$this->validate($this->objProduk->getRules()))
        {
            return redirect()->back()->withInput()->with('validation', $this->validator->getErrors());
        }

        $produk = $this->itemBuilder();

        try
        {
            $this->objProduk->saveData($produk,$id_produk);

            $cariIdProduk   = array('nama_produk' => $this->request->getPost('nama_produk'));
            $produkDisimpan = $this->objProduk->getDataBy($cariIdProduk)->getRow();

            $paramFoto      = array('foto' => $produk['foto_produk'], 'id_produk' => $produkDisimpan->id_produk);
            $totalFoto      = $this->objFotoProduk->getTotalItem($paramFoto);
            $getFoto        = $this->objFotoProduk->getDataBy($paramFoto)->getRow();

            if($totalFoto > 0)
            {
                $saveSampul = array(
                    'foto'      => $produkDisimpan->foto_produk,
                    'alt_foto'  => $this->request->getPost('alt_foto'),
                    'produk_id' => $produkDisimpan->id_produk
                );
    
                $this->objFotoProduk->saveData($saveSampul,$getFoto->fotoproduk_id);
            }
            else
            {
                $saveSampul = array(
                    'id_foto'   => '',
                    'foto'      => $produkDisimpan->foto_produk,
                    'alt_foto'  => $this->request->getPost('alt_foto'),
                    'produk_id' => $produkDisimpan->id_produk
                );
    
                $this->objFotoProduk->saveData($saveSampul);
            }

            $paramIdSlug    = array('id_slug'=>$produkDisimpan->id_slug);
            $totalItemRoute = $this->objSlug->getTotalItem($paramIdSlug);
            
            if($totalItemRoute > 0)
            {
                $arrRoute=array(
                    'slug'      => $produk['url'],
                    'target'    => 'Home::product/'.$produkDisimpan->id_produk,
                    'filters'   > ''
                );

                $this->objSlug->saveData($arrRoute,$produkDisimpan->slug_id);
            }
            else
            {
                $arrRoute=array(
                    'id_slug'   => '',
                    'slug'      => $produk['url_produk'],
                    'target'    => 'Home::product/'.$produkDisimpan->id_produk,
                    'filters'   => ''
                );

                $this->objSlug->saveData($arrRoute);

                $cariIdSlug         = array('slug'=>$produk['url']);
                $slugDisimpan       = $this->objSlug->getDataBy($cariIdSlug)->getRow();
    
                $saveIdSlug         = array('slug_id' => $slugDisimpan->id_slug);
    
                $this->objProduk->saveData($saveIdSlug, $produkDisimpan->id_produk);
            }
            
            return redirect()->to(base_url().'/admin/produk')->with('sukses', 'Data Berhasil Diupdate!');
        }
        catch (\Exception $e)
        {
            return redirect()->back()->withInput()->with('error', $e->getMessage());
        }
    }

    public function destroy($id_produk)
    {
        $paramProduk= array('id_produk' => $id_produk);
        $produk     = $this->objProduk->getDataBy($paramProduk)->getRow();

        try
        {
            $this->objSlug->deleteData(array('id_slug' => $produk->slug_id));

            if($produk->foto_produk!="" and $produk->foto_produk!="no-image.jpg" and file_exists(realpath(APPPATH . './assets/images/products/'.$produk->foto_produk)))
            {
                unlink(realpath(APPPATH . './assets/images/products/'.$produk->foto_produk));
            }

            $this->objFotoProduk->deleteData(array('produk_id' => $id_produk));

            $this->objProduk->deleteData($paramProduk);

            return redirect()->to(base_url().'/admin/produk')->with('sukses', 'Data Berhasil Dihapus!');
        }
        catch (\Exception $e)
        {
            return redirect()->to(base_url().'/admin/produk')->with('error', $e->getMessage());
        }
    }
}
