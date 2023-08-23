<?php

namespace App\Models;

use CodeIgniter\Model;

class KetentuanModel extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'ketentuans';
    protected $primaryKey       = 'id_ketentun';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['deskripsi','produk_id'];

    // Valydation
    protected $rules            = [
        'deskripsi'  => [
            'label' =>'Ketentuan',
            'rules'	=>'required',
            'errors'=> [
                'required'=>'Ketentuan wajib diisi',
            ]
        ],
        'produk_id'  => [
            'label' =>'Id Produk',
            'rules'	=>'required',
            'errors'=> [
                'required'=>'Produk wajib dipilih',
            ]
        ],
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
        $this->builder->join('produks','ketentuans.produk_id=produks.id_produk');
        return $this->builder->get();
    }

    public function getDataBy($param)
    {
        $this->builder->join('produks','ketentuans.produk_id=produks.id_produk');
        $this->builder->where($param);
        return $this->builder->get();
    }

    public function saveData($arrSave, $id_ketentun = 0)
    {
        if ($id_ketentun > 0)
        {
            $this->builder->where($this->primaryKey, $id_ketentun);
            return $this->builder->update($arrSave);
        }
        else
        {
            return $this->builder->insert($arrSave);
        }
    }

    public function deleteData($param)
    {
        $this->builder->where($param);
        return $this->builder->delete();
    }

	public function getRules() {
		return $this->rules;
	}
}
