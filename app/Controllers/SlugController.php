<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class SlugController extends BaseController
{
    private function itemBuilder()
    {
        return [
            'slug'      => $this->request->getPost('slug'),
            'target'    => $this->request->getPost('target'),
            'filters'   => $this->request->getPost('filters')
        ];
    }
    public function index()
    {
        $data = [
            'dataSlug' => $this->objSlug->getAllData()->getResult()
        ];

        return view('admin/slug/index',$data);
    }

    public function create()
    {
        return view('admin/slug/form');
    }
    
    public function store()
    {
        if(!$this->validate($this->objSlug->getRules()))
        {
            return redirect()->back()->withInput()->with('validation', $this->validator->getErrors());
        }

        $slug = $this->itemBuilder();

        try
        {
            $this->objSlug->saveData($slug);

            return redirect()->to(base_url().'/admin/slug')->with('sukses', 'Data Berhasil Ditambahkan!');
        }
        catch (\Exception $e)
        {
            return redirect()->back()->withInput()->with('error', $e->getMessage());
        }
    }

    public function edit($id_slug)
    {
        $paramSlug      = array('id_slug' => $id_slug);

        $data = [
            'slug'    => $this->objSlug->getDataBy($paramSlug)->getRow()
        ];

        return view('admin/slug/form',$data);
    }

    public function update($id_slug)
    {
        if(!$this->validate($this->objSlug->getRules()))
        {
            return redirect()->back()->withInput()->with('validation', $this->validator->getErrors());
        }

        $slug = $this->itemBuilder();

        try
        {
            $this->objSlug->saveData($slug, $id_slug);

            return redirect()->to(base_url().'/admin/slug')->with('sukses', 'Data Berhasil Diupdate!');
        }
        catch (\Exception $e)
        {
            return redirect()->back()->withInput()->with('error', $e->getMessage());
        }
    }

    public function destroy($id_slug)
    {
        $paramSlug  = array('id_slug' => $id_slug);

        try
        {
            $this->objSlug->deleteData($paramSlug);

            return redirect()->to(base_url().'/admin/slug')->with('sukses', 'Data Berhasil Dihapus!');
        }
        catch (\Exception $e)
        {
            return redirect()->to(base_url().'/admin/slug')->with('error', $e->getMessage());
        }
    }
}
