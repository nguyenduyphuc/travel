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
    

    public function edit($id_slug)
    {
        $paramSlug      = array('id_slug' => $id_slug);

        $data = [
            'slug'    => $this->objSlug->getDataBy($paramSlug)->getRow()
        ];

        return view('admin/slug/form',$data);
    }
}
