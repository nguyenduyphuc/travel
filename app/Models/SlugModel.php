<?php

namespace App\Models;

use CodeIgniter\Model;

class SlugModel extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'slugs';
    protected $primaryKey       = 'id_slug';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['slug','target','filter'];

    // Valydation
    protected $rules            = [
        'slug'  => [
            'label' =>'Slug',
            'rules'	=>'required',
            'errors'=> [
                'required'=>'Slug wajib diisi',
            ]
        ],
        'target'  => [
            'label' =>'Target',
            'rules'	=>'required',
            'errors'=> [
                'required'=>'Target wajib diisi',
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
        return $this->builder->get();
    }

    public function getDataBy($param)
    {
        $this->builder->where($param);
        return $this->builder->get();
    }

    public function getTotalItem($paramRoute)
    {
        $this->builder->where($paramRoute);
        return $this->builder->countAllResults();
    }

    public function saveData($arrSave, $id_slug = 0)
    {
        if ($id_slug > 0)
        {
            $this->builder->where($this->primaryKey, $id_slug);
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
