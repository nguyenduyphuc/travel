<?php

namespace App\Models;

use CodeIgniter\Model;

class FotoProdukModel extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'foto_produks';
    protected $primaryKey       = 'id_foto';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['foto','alt_foto','produk_id'];

    // Validasi
    protected $createRules      = [
        'foto'  => [
            'label' =>'Foto Produk',
            'rules'	=>'required|uploaded[foto]|is_image[foto]|max_size[foto,1024]|ext_in[foto,jpg,png,jpeg]',
            'errors'=> [
                'required'  =>'Foto Produk harus diisi',
                'uploaded'  =>'Foto Produk harus terupload',
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
        ],
        'produk_id' => [
            'label' => 'Produk',
            'rules'	=> 'required',
            'errors'=> [
                'required'=>'Pilih produk dimana foto ditampilkan',
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
        ],
        'produk_id' => [
            'label' => 'Produk',
            'rules'	=> 'required',
            'errors'=> [
                'required'=>'Pilih produk dimana foto ditampilkan',
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
        $this->builder->join('produks','foto_produks.produk_id=produks.id_produk');
        return $this->builder->get();
    }

    public function getDataBy($param)
    {
        $this->builder->join('produks','foto_produks.produk_id=produks.id_produk');
        $this->builder->where($param);
        return $this->builder->get();
    }

    public function getTotalItem($paramFoto)
    {
        $this->builder->where($paramFoto);
        return $this->builder->countAllResults();
    }

    public function saveData($arrSave, $id_foto = 0)
    {
        if ($id_foto > 0)
        {
            $this->builder->where($this->primaryKey, $id_foto);
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

	public function getCreateRules()
    {
		return $this->createRules;
	}

    public function getUpdateRules()
    {
		return $this->updateRules;
	}
}
