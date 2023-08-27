<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class GaleriController extends BaseController
{
    private function itemBuilder()
    {
        $path       = './assets/images/gallery';
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
            'alt_foto'  => $this->request->getPost('alt_foto')
        ];
    }

    public function index()
    {
        $data = [
            'dataGaleri' => $this->objGaleri->getAllData()->getResult()
        ];

        return view('admin/galeri/index',$data);
    }

    public function create()
    {
        return view('admin/galeri/form');
    }

    public function store()
    {
        if(!$this->validate($this->objGaleri->getCreateRules()))
        {
            return redirect()->back()->withInput()->with('validation', $this->validator->getErrors());
        }

        $galeri = $this->itemBuilder();

        try
        {
            $this->objGaleri->saveData($galeri);

            return redirect()->to(base_url().'/admin/galeri')->with('sukses', 'Data Berhasil Ditambahkan!');
        }
        catch (\Exception $e)
        {
            return redirect()->back()->withInput()->with('error', $e->getMessage());
        }
    }

    public function edit($id_galeri)
    {
        $paramFoto      = array('id_galeri' => $id_galeri);

        $data = [
            'galeri'    => $this->objGaleri->getDataBy($paramFoto)->getRow()
        ];

        return view('admin/galeri/form',$data);
    }

    public function update($id_galeri)
    {
        if(!$this->validate($this->objGaleri->getRules()))
        {
            return redirect()->back()->withInput()->with('validation', $this->validator->getErrors());
        }

        $galeri = $this->itemBuilder();

        try
        {
            $this->objGaleri->saveData($galeri, $id_galeri);

            return redirect()->to(base_url().'/admin/galeri')->with('sukses', 'Data Berhasil Diupdate!');
        }
        catch (\Exception $e)
        {
            return redirect()->back()->withInput()->with('error', $e->getMessage());
        }
    }

    public function destroy($id_galeri)
    {
        $paramFoto  = array('id_galeri' => $id_galeri);
        $foto       = $this->objGaleri->getDataBy($paramFoto)->getRow();

        try
        {
            if($foto->foto!="" and $foto->foto!="no-image.jpg" and file_exists(realpath(APPPATH . './assets/images/gallery/'.$foto->foto)))
            {
                unlink(realpath(APPPATH . './assets/images/gallery/'.$foto->foto));
            }
            
            $this->objGaleri->deleteData($paramFoto);

            return redirect()->to(base_url().'/admin/galeri')->with('sukses', 'Data Berhasil Dihapus!');
        }
        catch (\Exception $e)
        {
            return redirect()->to(base_url().'/admin/galeri')->with('error', $e->getMessage());
        }
    }
}
