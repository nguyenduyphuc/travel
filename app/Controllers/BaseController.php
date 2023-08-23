<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use CodeIgniter\HTTP\CLIRequest;
use CodeIgniter\HTTP\IncomingRequest;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use Psr\Log\LoggerInterface;

use App\Models\ProdukModel;
use App\Models\KategoriModel;
use App\Models\FotoProdukModel;
use App\Models\GaleriModel;
use App\Models\SlugModel;
use App\Models\ProdukTermasukModel;
use App\Models\ProdukTidakTermasukModel;
use App\Models\KetentuanModel;

use App\Models\PagingGaleriModel;

/**
 * Class BaseController
 *
 * BaseController provides a convenient place for loading components
 * and performing functions that are needed by all your controllers.
 * Extend this class in any new controllers:
 *     class Home extends BaseController
 *
 * For security be sure to declare any new methods as protected or private.
 */
abstract class BaseController extends Controller
{
    /**
     * Instance of the main Request object.
     *
     * @var CLIRequest|IncomingRequest
     */
    protected $request;

    /**
     * An array of helpers to be loaded automatically upon
     * class instantiation. These helpers will be available
     * to all other controllers that extend BaseController.
     *
     * @var array
     */
    protected $helpers = [];

    /**
     * Be sure to declare properties for any property fetch you initialized.
     * The creation of dynamic property is deprecated in PHP 8.2.
     */
    // protected $session;

    /**
     * @return void
     */
    public function initController(RequestInterface $request, ResponseInterface $response, LoggerInterface $logger)
    {
        // Do Not Edit This Line
        parent::initController($request, $response, $logger);

        $this->objProduk        = new ProdukModel;
        $this->objKategori      = new KategoriModel;
        $this->objFotoProduk    = new FotoProdukModel;
        $this->objGaleri        = new GaleriModel;
        $this->objSlug          = new SlugModel;
        $this->objTermasuk      = new ProdukTermasukModel;
        $this->objTakTermasuk   = new ProdukTidakTermasukModel;
        $this->objKetentuan     = new KetentuanModel;

        $this->objPagingGaleri  = new PagingGaleriModel;

        $this->session  = \Config\Services::session();
        $this->request  = \Config\Services::request();
        $this->pager    = \Config\Services::pager();

        // Preload any models, libraries, etc, here.

        // E.g.: $this->session = \Config\Services::session();
    }
}
