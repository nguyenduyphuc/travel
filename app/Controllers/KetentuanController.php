<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class KetentuanController extends BaseController
{
    private function itemBuilder()
    {
        return [
            'deskripsi' => $this->request->getPost('deskripsi'),
            'produk_id' => $this->request->getPost('produk_id')
        ];
    }

    public function index()
    {
        $data = [
            'dataKetentuan' => $this->objKetentuan->getAllData()->getResult()
        ];

        return view('admin/ketentuan/index',$data);
    }

    public function create()
    {
        $data = [
            'dataProduk'    => $this->objProduk->getAllData()->getResult()
        ];

        return view('admin/ketentuan/form',$data);
    }

    public function store()
    {
        if(!$this->validate($this->objKetentuan->getRules()))
        {
            return redirect()->back()->withInput()->with('validation', $this->validator->getErrors());
        }

        $ketentuan = $this->itemBuilder();

        try
        {
            $this->objKetentuan->saveData($ketentuan);

            return redirect()->to(base_url().'/admin/ketentuan')->with('sukses', 'Data Berhasil Ditambahkan!');
        }
        catch (\Exception $e)
        {
            return redirect()->back()->withInput()->with('error', $e->getMessage());
        }
    }

    public function edit($id_ketentuan)
    {
        $paramKetentuan      = array('id_ketentuan' => $id_ketentuan);

        $data = [
            'ketentuan'    => $this->objKetentuan->getDataBy($paramKetentuan)->getRow(),
            'dataProduk'    => $this->objProduk->getAllData()->getResult()
        ];

        return view('admin/ketentuan/form',$data);
    }

    public function update($id_ketentuan)
    {
        if(!$this->validate($this->objKetentuan->getRules()))
        {
            return redirect()->back()->withInput()->with('validation', $this->validator->getErrors());
        }

        $ketentuan = $this->itemBuilder();

        try
        {
            $this->objKetentuan->saveData($ketentuan, $id_ketentuan);

            return redirect()->to(base_url().'/admin/ketentuan')->with('sukses', 'Data Berhasil Diupdate!');
        }
        catch (\Exception $e)
        {
            return redirect()->back()->withInput()->with('error', $e->getMessage());
        }
    }

    public function destroy($id_ketentuan)
    {
        $paramKetentuan  = array('$id_ketentuan' => $id_ketentuan);

        try
        {
            $this->objKetentuan->deleteData($paramKetentuan);

            return redirect()->to(base_url().'/admin/ketentuan')->with('sukses', 'Data Berhasil Dihapus!');
        }
        catch (\Exception $e)
        {
            return redirect()->to(base_url().'/admin/ketentuan')->with('error', $e->getMessage());
        }
    }
}
