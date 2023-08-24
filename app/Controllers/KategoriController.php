<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class KategoriController extends BaseController
{
    private function itemBuilder()
    {
        $path       = './assets/images';
        $file       = $this->request->getFile('foto_kategori');

        if($file->isValid() && !$file->hasMoved())
        {
            $file->move($path, $file->getName());
            $fileName=$file->getName();
        }
        else
        {
            $fileName = (array_key_exists('image_path', $this->request->getPost())) ? $this->request->getPost('image_path') : "no-image.jpg"; 
        }

        $itemslug   = str_replace(" ", "-", $this->request->getPost('url_kategori'));
        $slug       = strtolower($itemslug);

        return [
            'nama_kategori' => $this->request->getPost('nama_kategori'),
            'parent'        => $this->request->getPost('parent'),
            'foto_kategori' => $fileName,
            'alt_foto'      => $this->request->getPost('alt_foto'),
            'deskripsi'     => $this->request->getPost('deskripsi'),
            'judul_seo'     => $this->request->getPost('judul_seo'),
            'deskripsi_seo' => $this->request->getPost('deskripsi_seo'),
            'url_kategori'  => $slug
        ];
    }

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

    public function store()
    {
        if(!$this->validate($this->objKategori->getRules()))
        {
            return redirect()->back()->withInput()->with('validation', $this->validator->getErrors());
        }

        $kategori = $this->itemBuilder();

        try
        {
            $this->objKategori->saveData($kategori);

            $cariIdKategori     = array('nama_kategori' => $this->request->getPost('nama_kategori'));
            $kategoriDisimpan   = $this->objKategori->getDataBy($cariIdKategori)->getRow();
            
            $arrRoute=array(
                'id_slug'   => '',
                'slug'      => $kategori['url_kategori'],
                'target'    => 'Home::category/'.$kategoriDisimpan->id_kategori,
                'filter'    => ''
            );

            $this->objSlug->saveData($arrRoute);

            $cariIdSlug         = array('slug'=>$kategori['url_kategori']);
            $slugDisimpan       = $this->objSlug->getDataBy($cariIdSlug)->getRow();

            $saveIdSlug         = array('slug_id' => $slugDisimpan->id_kategori);

            $this->objKategori->saveData($saveIdSlug, $kategoriDisimpan->id_kategori);

            return redirect()->to(base_url().'/admin/kategori')->with('sukses', 'Data Berhasil Ditambahkan!');
        }
        catch (\Exception $e)
        {
            return redirect()->back()->withInput()->with('error', $e->getMessage());
        }
    }

    public function edit($id_kategori)
    {
        $paramKategori      = array('id_kategori'=>$id_kategori);

        $data = [
            'dataParent'    => $this->objKategori->getAllCatForAdm(),
            'dataKategori'  => $this->objKategori->getDataBy($paramKategori)->getRow()
        ];

        return view('admin/kategori/form', $data);
    }

    public function update($id_kategori)
    {
        if(!$this->validate($this->objKategori->getRules()))
        {
            return redirect()->back()->withInput()->with('validation', $this->validator->getErrors());
        }

        $kategori = $this->itemBuilder();

        try
        {
            $this->objKategori->saveData($kategori, $id_kategori);

            $cariIdKategori     = array('nama_kategori' => $this->request->getPost('nama_kategori'));
            $kategoriDisimpan   = $this->objKategori->getDataBy($cariIdKategori)->getRow();

            $paramIdSlug    = array('id_slug'=>$kategoriDisimpan->id_slug);
            $totalItemRoute = $this->objSlug->getTotalItem($paramIdSlug);
            
            if($totalItemRoute > 0)
            {
                $arrRoute=array(
                    'slug'      => $kategori['url_kategori'],
                    'target'    => 'Home::category/'.$kategoriDisimpan->kategori_id,
                    'filter'    => ''
                );

                $this->objSlug->saveData($arrRoute,$kategoriDisimpan->id_slug);
            }
            else
            {
                $arrRoute=array(
                    'id_slug'   => '',
                    'slug'      => $kategori['url_kategori'],
                    'target'    => 'Home::category/'.$kategoriDisimpan->kategori_id,
                    'filter'    => ''
                );

                $this->objSlug->saveData($arrRoute);

                $cariIdSlug         = array('slug'=>$kategori['url_kategori']);
                $slugDisimpan       = $this->objSlug->getDataBy($cariIdSlug)->getRow();
    
                $saveIdSlug         = array('slug_id' => $slugDisimpan->id_slug);
    
                $this->objKategori->saveData($saveIdSlug, $kategoriDisimpan->kategori_id);
            }

            return redirect()->to(base_url().'/admin/kategori')->with('sukses', 'Data Berhasil Diupdate!');
        }
        catch (\Exception $e)
        {
            return redirect()->back()->withInput()->with('error', $e->getMessage());
        }
    }

    public function destroy($id_kategori)
    {
        $paramKategori  = array('id_kategori' => $id_kategori);
        $kategori       = $this->objKategori->getDataBy($paramKategori)->getRow();

        try
        {
            if($kategori->foto_kategori!="" and $kategori->foto_kategori!="no-image.jpg" and file_exists(realpath(APPPATH . './assets/images/'.$kategori->foto_kategori)))
            {
                unlink(realpath(APPPATH . './assets/images/'.$kategori->foto_kategori));
            }

            $this->objSlug->deleteData(array('id_slug' => $kategori->slug_id));

            $this->objKategori->deleteData($paramKategori);

            return redirect()->to(base_url().'/admin/kategori')->with('sukses', 'Data Berhasil Dihapus!');
        }
        catch (\Exception $e)
        {
            return redirect()->to(base_url().'/admin/kategori')->with('error', $e->getMessage());
        }
    }
}
