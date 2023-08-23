<?php

namespace App\Models;

use CodeIgniter\Model;

class ProdukTidakTermasukModel extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'produk_tidak_termasuks';
    protected $primaryKey       = 'id_tidak_termasuk';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['produk_id', 'deskripsi'];

    // Valydation
    protected $rules                = [
        'produk_id'  => [
            'label' =>'Id Produk',
            'rules'	=>'required',
            'errors'=> [
                'required'=>'Produk wajib dipilih',
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
        $this->builder->join('produks','produk_tidak_termasuks.produk_id=produks.id_produk');
        return $this->builder->get();
    }

    public function getDataBy($param)
    {
        $this->builder->join('produks','produk_tidak_termasuks.produk_id=produks.id_produk');
        $this->builder->where($param);
        return $this->builder->get();
    }

    public function saveData($arrSave, $id_tidak_termasuk = 0)
    {
        if ($id_tidak_termasuk > 0)
        {
            $this->builder->where($this->primaryKey, $id_tidak_termasuk);
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
