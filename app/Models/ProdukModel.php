<?php

namespace App\Models;

use CodeIgniter\Model;

class ProdukModel extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'produks';
    protected $primaryKey       = 'id_produk';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['nama_produk','harga','durasi','deskripsi_produk','foto_produk','alt_foto','min_kapasitas','judul_seo_produk','deskripsi_produk_seo_produk','kategori_id','url_produk','slug_id'];

    // Validation
    protected $createRules      = [
        'nama_produk'=> [
            'label' =>'Nama Produk',
            'rules'	=>'required',
            'errors'=> [
                'required'=>'Nama Produk harus diisi',
            ]
        ],
        'harga'     => [
            'label' => 'Harga',
            'rules'	=> 'required',
            'errors'=> [
                'required'=>'Harga harus diisi',
            ]
        ],
        'durasi'    => [
            'label' => 'Durasi',
            'rules'	=> 'required',
            'errors'=> [
                'required'=>'Durasi harus diisi',
            ]
        ],
        'deskripsi_produk' => [
            'label' => 'deskripsi produk',
            'rules'	=> 'required',
            'errors'=> [
                'required'=>'deskripsi produk harus diisi',
            ]
        ],
        'foto_produk'  => [
            'label' =>'Foto Produk',
            'rules'	=>'uploaded[foto_produk]|is_image[foto_produk]|max_size[foto_produk,1024]|ext_in[foto_produk,jpg,png,jpeg]',
            'errors'=> [
                'uploaded'  =>'Foto Produk harus terupload',
                'is_image'  =>'Harus mengupload foto',
                'max_size'  =>'Maks. size foto 1MB',
                'ext_in'    =>'Format harus .jpg / .jpeg / .png'
            ]
        ],
        'alt_foto' => [
            'label' => 'Alt. Foto',
            'rules'	=> 'required',
            'errors'=> [
                'required'=>'Isi alt. foto dengan deskripsi_produk foto',
            ]
        ],
        'min_kapasitas' => [
            'label' => 'Min. Kapasitas',
            'rules'	=> 'required',
            'errors'=> [
                'required'=>'Min. kapasitas harus diisi',
            ]
        ],
        'judul_seo_produk' => [
            'label' => 'Judul SEO Produk',
            'rules'	=> 'required',
            'errors'=> [
                'required'=>'Judul SEO produk harus diisi',
            ]
        ],
        'deskripsi_seo_produk' => [
            'label' => 'Deskripsi SEO Produk',
            'rules'	=> 'required',
            'errors'=> [
                'required'=>'deskripsi SEO produk harus diisi',
            ]
        ],
        'kategori_id' => [
            'label' => 'Kategori',
            'rules'	=> 'required',
            'errors'=> [
                'required'=>'Kategori produk harus diisi',
            ]
        ],
        'url_produk' => [
            'label' => 'url produk',
            'rules'	=> 'required',
            'errors'=> [
                'required'=>'url produk produk harus diisi',
            ]
        ],
    ];
    protected $updateRules      = [
        'nama_produk'=> [
            'label' =>'Nama Produk',
            'rules'	=>'required',
            'errors'=> [
                'required'=>'Nama Produk harus diisi',
            ]
        ],
        'harga'     => [
            'label' => 'Harga',
            'rules'	=> 'required',
            'errors'=> [
                'required'=>'Harga harus diisi',
            ]
        ],
        'durasi'    => [
            'label' => 'Durasi',
            'rules'	=> 'required',
            'errors'=> [
                'required'=>'Durasi harus diisi',
            ]
        ],
        'deskripsi_produk' => [
            'label' => 'deskripsi produk',
            'rules'	=> 'required',
            'errors'=> [
                'required'=>'deskripsi produk harus diisi',
            ]
        ],
        'alt_foto' => [
            'label' => 'Alt. Foto',
            'rules'	=> 'required',
            'errors'=> [
                'required'=>'Isi alt. foto dengan deskripsi_produk foto',
            ]
        ],
        'min_kapasitas' => [
            'label' => 'Min. Kapasitas',
            'rules'	=> 'required',
            'errors'=> [
                'required'=>'Min. kapasitas harus diisi',
            ]
        ],
        'judul_seo_produk' => [
            'label' => 'Judul SEO Produk',
            'rules'	=> 'required',
            'errors'=> [
                'required'=>'Judul SEO produk harus diisi',
            ]
        ],
        'deskripsi_seo_produk' => [
            'label' => 'deskripsi SEO Produk',
            'rules'	=> 'required',
            'errors'=> [
                'required'=>'deskripsi SEO produk harus diisi',
            ]
        ],
        'kategori_id' => [
            'label' => 'Kategori',
            'rules'	=> 'required',
            'errors'=> [
                'required'=>'Kategori produk harus diisi',
            ]
        ],
        'url_produk' => [
            'label' => 'url_produk',
            'rules'	=> 'required',
            'errors'=> [
                'required'=>'url_produk produk harus diisi',
            ]
        ],
    ];
    protected $validationMessages   = [];
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

    public function showInIndex()
    {
        return $this->builder->limit(3)->get();
    }

    public function searchData($param)
    {
        $this->builder->like('nama_produk', $param);
        $this->builder->orLike('deskripsi_produk', $param);
        $this->builder->orLike('judul_seo_produk', $param);
        $this->builder->orLike('deskripsi_produk_seo_produk', $param);

        return $this->builder->get();
    }

    public function getCreateRules() {
		return $this->createRules;
	}

	public function getUpdateRules()
    {
		return $this->updateRules;
	}

    public function saveData($arrSave, $id_produk = 0)
    {
        if ($id_produk > 0)
        {
            $this->builder->where($this->primaryKey, $id_produk);
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
}