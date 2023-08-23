<?php

namespace App\Models;

use CodeIgniter\Model;

class GaleriModel extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'galeris';
    protected $primaryKey       = 'id_galeri';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['foto','alt_foto'];

    // Validasi
    protected $createRules      = [
        'foto'  => [
            'label' =>'Foto Galeri',
            'rules'	=>'required|uploaded[foto]|is_image[foto]|max_size[foto,1024]|ext_in[foto,jpg,png,jpeg]',
            'errors'=> [
                'required'  =>'Foto Galeri harus diisi',
                'uploaded'  =>'Foto Galeri harus terupload',
                'is_image'  =>'Harus mengupload foto',
                'max_size'  =>'Maks. size foto 1MB',
                'ext_in'    =>'Format harus .jpg / .jpeg / .png'
            ]
        ],
        'alt_foto'  => [
            'label' =>'Alt. Foto',
            'rules'	=>'required',
            'errors'=> [
                'required'=>'Isi field ini dengan deskripsi singkat foto',
            ]
        ]
    ];
    protected $updateRules      = [
        'alt_foto'  => [
            'label' =>'Alt. Foto',
            'rules'	=>'required',
            'errors'=> [
                'required'=>'Isi field ini dengan deskripsi singkat foto',
            ]
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

    public function showInIndex()
    {
        return $this->builder->limit(3)->get();
    }

    public function getDataBy($param)
    {
        $this->builder->where($param);
        return $this->builder->get();
    }

    public function deleteData($param)
    {
        $this->builder->where($param);
        return $this->builder->delete();
    }

    public function getCreateRules()
    {
		return $this->createRules;
	}

	public function getUpdateRules()
    {
		return $this->updateRules;
	}
}
