<?php

namespace App\Models;

use CodeIgniter\Model;

class KategoriModel extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'kategoris';
    protected $primaryKey       = 'id_kategori';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['nama_produk','parent','foto_kategori','alt_foto','deskripsi','judul_seo','deskripsi_seo','url_kategori','slug_id'];

    // Validation
    protected $createRules      = [
        'nama_kategori'=> [
            'label' =>'Nama Kategori',
            'rules'	=>'required',
            'errors'=> [
                'required'=>'Nama Kategori harus diisi',
            ]
        ],
        'parent'     => [
            'label' => 'Parent',
            'rules'	=> 'required',
            'errors'=> [
                'required'=>'Parent harus diisi',
            ]
        ],
        'foto_kategori'  => [
            'label' =>'Foto Kategori',
            'rules'	=>'required|uploaded[foto]|is_image[foto]|max_size[foto,1024]|ext_in[foto,jpg,png,jpeg]',
            'errors'=> [
                'required'  =>'Foto Kategori harus diisi',
                'uploaded'  =>'Foto Kategori harus terupload',
                'is_image'  =>'Harus mengupload foto',
                'max_size'  =>'Maks. size foto 1MB',
                'ext_in'    =>'Format harus .jpg / .jpeg / .png'
            ]
        ],
        'alt_foto'    => [
            'label' => 'Alt. Foto',
            'rules'	=> 'required',
            'errors'=> [
                'required'=>'Isi alt. foto dengan deskripsi foto',
            ]
        ],
        'deskripsi' => [
            'label' => 'Deskripsi',
            'rules'	=> 'required',
            'errors'=> [
                'required'=>'Deskripsi harus diisi',
            ]
        ],
        'judul_seo' => [
            'label' => 'Judul SEO Kategori',
            'rules'	=> 'required',
            'errors'=> [
                'required'=>'Judul SEO Kategori harus diisi',
            ]
        ],
        'deskripsi_seo' => [
            'label' => 'Deskripsi SEO Kategori',
            'rules'	=> 'required',
            'errors'=> [
                'required'=>'Deskripsi SEO Kategori harus diisi',
            ]
        ],
        'url_kategori'    => [
            'label' => 'Url',
            'rules'	=> 'required',
            'errors'=> [
                'required'=>'Url harus diisi',
            ]
        ],
    ];
    protected $updateRules      = [
        'nama_kategori'=> [
            'label' =>'Nama Kategori',
            'rules'	=>'required',
            'errors'=> [
                'required'=>'Nama Kategori harus diisi',
            ]
        ],
        'parent'     => [
            'label' => 'Parent',
            'rules'	=> 'required',
            'errors'=> [
                'required'=>'Parent harus diisi',
            ]
        ],
        'alt_foto'    => [
            'label' => 'Alt. Foto',
            'rules'	=> 'required',
            'errors'=> [
                'required'=>'Isi alt. foto dengan deskripsi foto',
            ]
        ],
        'deskripsi' => [
            'label' => 'Deskripsi',
            'rules'	=> 'required',
            'errors'=> [
                'required'=>'Deskripsi harus diisi',
            ]
        ],
        'judul_seo' => [
            'label' => 'Judul SEO Kategori',
            'rules'	=> 'required',
            'errors'=> [
                'required'=>'Judul SEO Kategori harus diisi',
            ]
        ],
        'deskripsi_seo' => [
            'label' => 'Deskripsi SEO Kategori',
            'rules'	=> 'required',
            'errors'=> [
                'required'=>'Deskripsi SEO Kategori harus diisi',
            ]
        ],
        'url_kategori'    => [
            'label' => 'Url',
            'rules'	=> 'required',
            'errors'=> [
                'required'=>'Url harus diisi',
            ]
        ],
    ];
    protected $validationMessages   = [];
    protected $skipValidation       = false;
    protected $cleanValidationRules = true;

    private $list_item          = '';
    private $prefix             = array();
    private $admlistcat         = array();
    private $catid_kategori     = array();
    private $subCatid_kategori  = array();

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

    public function getMenuCat($child=false,$parent=0)
    {
        if($child==false)
        {
            $param=array('parent'=>$parent);
            $this->builder->where($param);
            $dataCat=$this->builder->get();

            foreach ($dataCat->getResult() as $catItem) 
            {

                $paramCheck=array('parent'=>$catItem->id_kategori);
                $this->builder->where($paramCheck);
                $totalRecCheck=$this->builder->countAllResults();

                if($totalRecCheck>0)
                {
                    $this->list_item.='<li class="nav-item dropdown">'.anchor('#',$catItem->nama_kategori,array('class'=>'nav-link dropdown-toggle','role'=>'button','data-bs-toggle'=>'dropdown','aria-expanded'=>'false'));
                }
                else
                {
                    $this->list_item.='<li class="nav-item">'.anchor($catItem->url_kategori,$catItem->nama_kategori,array('class'=>'nav-link'));
                }
                $this->getMenuCat(true,$catItem->id_kategori);
                $this->list_item.='</li>';
            }
        }
        else
        {
            $paramSub=array('parent'=>$parent);
            $this->builder->where($paramSub);
            $totalRec=$this->builder->countAllResults();

            if($totalRec>0)
            {
                $this->list_item.='<ul class="dropdown-menu">';

                $paramSub=array('parent'=>$parent);
                $this->builder->where($paramSub);
                $dataCatSub=$this->builder->get();

                foreach ($dataCatSub->getResult() as $catItemSub) {
                   $this->list_item.='<li>'.anchor($catItemSub->url_kategori,$catItemSub->nama_kategori,array('class'=>'dropdown-item'));

                   $this->getMenuCat(true,$catItemSub->id_kategori);
                   $this->list_item.='</li>';
                }
                $this->list_item.='</ul>';
            }
        }
        return $this->list_item;
    }

    function getAllCatforAdm($child=false,$parent=0)
    {

        if($child==false) 
        {
            $param=array('parent'=>$parent);
            $this->builder->where($param);
            $dataCat=$this->builder->get();

            foreach ($dataCat->getResult() as $catItem) {
               $this->admlistcat[]=array(
                'id_kategori'=>$catItem->id_kategori,
                'nama_kategori'=>$catItem->nama_kategori
               );

               $this->getAllCatforAdm(true,$catItem->id_kategori);
               array_shift($this->prefix);
            }
        }
        else
        {
            array_push($this->prefix,'-- ');  
            $paramSub=array('parent'=>$parent);
            $this->builder->where($paramSub);
            $totalRec=$this->builder->countAllResults();

            if($totalRec>0)
            {
                $paramSub=array('parent'=>$parent);
                $this->builder->where($paramSub);
                $dataCatSub=$this->builder->get();

                foreach ($dataCatSub->getResult() as $catItemSub) {
                    $this->admlistcat[]=array(
                        'id_kategori'=>$catItemSub->id_kategori,
                        'nama_kategori'=>implode('',$this->prefix).$catItemSub->nama_kategori
                       );

                    $this->getAllCatforAdm(true,$catItemSub->id_kategori);
                    array_shift($this->prefix);
                }
            }
        }
        return $this->admlistcat;
    }

    function getParentName()
    {
        $query  = $this->db->query
        ('
            SELECT cat.id_kategori , cat.nama_kategori , cat.foto_kategori , category.nama_kategori as parent FROM kategoris as cat
            LEFT join kategoris as category on category.id_kategori = cat.parent'
        );
        
        return $query->getResult('array');
    }

    public function saveData($arrSave, $id_kategori = 0)
    {
        if ($id_kategori > 0)
        {
            $this->builder->where($this->primaryKey, $id_kategori);
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