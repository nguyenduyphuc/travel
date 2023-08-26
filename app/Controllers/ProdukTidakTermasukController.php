<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class ProdukTidakTermasukController extends BaseController
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
            'dataExclusion' => $this->objTakTermasuk->getAllData()->getResult()
        ];

        return view('admin/ketentuan',$data);
    }

    public function create()
    {
        $data = [
            'dataProduk'    => $this->objProduk->getAllData()->getResult()
        ];

        return view('admin/tak_termasuk/form',$data);
    }

    public function store()
    {
        if(!$this->validate($this->objTakTermasuk->getRules()))
        {
            return redirect()->back()->withInput()->with('validation', $this->validator->getErrors());
        }

        $termasuk = $this->itemBuilder();

        try
        {
            $this->objTakTermasuk->saveData($termasuk);

            return redirect()->to(base_url().'/admin/tak_termasuk')->with('sukses', 'Data Berhasil Ditambahkan!');
        }
        catch (\Exception $e)
        {
            return redirect()->back()->withInput()->with('error', $e->getMessage());
        }
    }

    public function edit($id_termasuk)
    {
        $paramTermasuk      = array('id_termasuk' => $id_termasuk);

        $data = [
            'termasuk'    => $this->objTakTermasuk->getDataBy($paramTermasuk)->getRow(),
            'dataProduk'    => $this->objProduk->getAllData()->getResult()
        ];

        return view('admin/tak_termasuk/form',$data);
    }

    public function update($id_termasuk)
    {
        if(!$this->validate($this->objTakTermasuk->getRules()))
        {
            return redirect()->back()->withInput()->with('validation', $this->validator->getErrors());
        }

        $termasuk = $this->itemBuilder();

        try
        {
            $this->objTakTermasuk->saveData($termasuk, $id_termasuk);

            return redirect()->to(base_url().'/admin/tak_termasuk')->with('sukses', 'Data Berhasil Diupdate!');
        }
        catch (\Exception $e)
        {
            return redirect()->back()->withInput()->with('error', $e->getMessage());
        }
    }

    public function destroy($id_termasuk)
    {
        $paramTermasuk  = array('$id_termasuk' => $id_termasuk);

        try
        {
            $this->objTakTermasuk->deleteData($paramTermasuk);

            return redirect()->to(base_url().'/admin/tak_termasuk')->with('sukses', 'Data Berhasil Dihapus!');
        }
        catch (\Exception $e)
        {
            return redirect()->to(base_url().'/admin/tak_termasuk')->with('error', $e->getMessage());
        }
    }
}
