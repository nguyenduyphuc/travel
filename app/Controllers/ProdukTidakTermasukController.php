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

        return view('admin/tak_termasuk/index',$data);
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

        $tak_termasuk = $this->itemBuilder();

        try
        {
            $this->objTakTermasuk->saveData($tak_termasuk);

            return redirect()->to(base_url().'/admin/tak-termasuk')->with('sukses', 'Data Berhasil Ditambahkan!');
        }
        catch (\Exception $e)
        {
            return redirect()->back()->withInput()->with('error', $e->getMessage());
        }
    }

    public function edit($id_tidak_termasuk)
    {
        $paramTidakTermasuk = array('id_tidak_termasuk' => $id_tidak_termasuk);

        $data = [
            'tak_termasuk'  => $this->objTakTermasuk->getDataBy($paramTidakTermasuk)->getRow(),
            'dataProduk'    => $this->objProduk->getAllData()->getResult()
        ];

        return view('admin/tak_termasuk/form',$data);
    }

    public function update($id_tidak_termasuk)
    {
        if(!$this->validate($this->objTakTermasuk->getRules()))
        {
            return redirect()->back()->withInput()->with('validation', $this->validator->getErrors());
        }

        $tak_termasuk = $this->itemBuilder();

        try
        {
            $this->objTakTermasuk->saveData($tak_termasuk, $id_tidak_termasuk);

            return redirect()->to(base_url().'/admin/tak-termasuk')->with('sukses', 'Data Berhasil Diupdate!');
        }
        catch (\Exception $e)
        {
            return redirect()->back()->withInput()->with('error', $e->getMessage());
        }
    }

    public function destroy($id_tidak_termasuk)
    {
        $paramTidakTermasuk  = array('$id_tidak_termasuk' => $id_tidak_termasuk);

        try
        {
            $this->objTakTermasuk->deleteData($paramTidakTermasuk);

            return redirect()->to(base_url().'/admin/tak-termasuk')->with('sukses', 'Data Berhasil Dihapus!');
        }
        catch (\Exception $e)
        {
            return redirect()->to(base_url().'/admin/tak-termasuk')->with('error', $e->getMessage());
        }
    }
}
