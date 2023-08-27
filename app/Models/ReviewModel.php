<?php

namespace App\Models;

use CodeIgniter\Model;

class ReviewModel extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'reviews';
    protected $primaryKey       = 'id_review';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [];

    // Validation
    protected $createRules          = [
        'foto_customer' => [
            'label' =>'Foto Kategori',
            'rules'	=>'uploaded[foto_customer]|is_image[foto_customer]|max_size[foto_customer,1024]|ext_in[foto_customer,jpg,png,jpeg]',
            'errors'=> [
                'uploaded'  =>'Foto Customer harus terupload',
                'is_image'  =>'Harus mengupload foto',
                'max_size'  =>'Maks. size foto 1MB',
                'ext_in'    =>'Format harus .jpg / .jpeg / .png'
            ]
        ],
        'customer'      => [
            'label' =>'Nama customer',
            'rules'	=>'required',
            'errors'	=>['required'=>'Nama customer harus diisi']
        ],
        'email'         => [
            'label' =>'Email',
            'rules'	=>'required|valid_email',
            'errors'	=>
            [
                'required'=>'Email customer harus diisi',
                'valid_email' => 'Penulisan email tidiak valid']
        ],
        'rating'        => [
            'label' =>'Rating',
            'rules'	=>'required',
            'errors'	=>['required'=>'Rating harus diisi']
        ],
        'review'        => [
            'label' =>'Review',
            'rules'	=>'required',
            'errors'	=>['required'=>'Review harus diisi']
        ]
    ];
    protected $updateRules          = [
        'customer'      => [
            'label' =>'Nama customer',
            'rules'	=>'required',
            'errors'	=>['required'=>'Nama customer harus diisi']
        ],
        'email'         => [
            'label' =>'Email',
            'rules'	=>'required|valid_email',
            'errors'	=>
            [
                'required'=>'Email customer harus diisi',
                'valid_email' => 'Penulisan email tidiak valid']
        ],
        'rating'        => [
            'label' =>'Rating',
            'rules'	=>'required',
            'errors'	=>['required'=>'Rating harus diisi']
        ],
        'review'        => [
            'label' =>'Review',
            'rules'	=>'required',
            'errors'	=>['required'=>'Review harus diisi']
        ]
    ];
    protected $skipValidation       = false;
    protected $cleanValidationRules = true;
    
    public function __construct()
    {
        $this->db      = \Config\Database::connect();
        $this->builder = $this->db->table($this->table);
    }

    public function getAllData()
    {
        return $this->builder->get();
    }

    public function getDataBy($param)
    {
        $this->builder->where($param);
        return $this->builder->get();
    }

    public function getTotalItem($param)
    {
        $this->builder->where($param);
        return $this->builder->countAllResults();
    }

    public function saveData($arrSave)
    {
        if($arrSave['id_review']>0)
        {
            $this->builder->where('id_review',$arrSave['id_review']);
            $this->builder->update($arrSave);
            return $arrSave['id_review'];
        }
        else
        {
            $this->builder->insert($arrSave);
            return $this->db->insertID();
        }
    }

    public function deleteData($param)
    {
        $this->builder->where($param);
        return $this->builder->delete();
    }
}
