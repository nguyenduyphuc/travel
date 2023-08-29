<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class ReviewController extends BaseController
{
    public function index()
    {
        $data = [
            'dataReview'	=> $this->objReview->getAllData(),
        ];

        return view('admin/review/index',$data);
    }
}
