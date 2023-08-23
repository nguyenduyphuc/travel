<?php

namespace App\Models;

use CodeIgniter\Model;

class PagingGaleriModel extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'galeris';
    protected $primaryKey       = 'id_galeri';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['foto','alt_foto'];
}
