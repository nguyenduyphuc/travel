<?php

namespace App\Models;

use CodeIgniter\Model;

class FotoReviewModel extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'foto_reviews';
    protected $primaryKey       = 'id_foto_review';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['foto','alt_foto','review_id'];

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
        if($arrSave['id_foto_review']>0)
        {
            $this->builder->where('id_foto_review',$arrSave['id_foto_review']);
            $this->builder->update($arrSave);
            return $arrSave['id_foto_review'];
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
