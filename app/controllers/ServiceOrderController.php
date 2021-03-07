<?php 

namespace app\controllers;

use app\controllers\BaseController;
use app\database\models\ServiceOrderModel;

class ServiceOrderController extends BaseController
{

	private $serviceOrder;

	public function __construct()
	{
		$this->serviceOrder = new ServiceOrderModel();
	}

	public function index($request, $response)
	{
		$searched = filter_input(INPUT_GET, 'search', FILTER_SANITIZE_STRING);

		$serviceOrders = $this->serviceOrder->setLimit(10)->setCurrentPage()->serviceOrders($searched);
		$links = $this->serviceOrder->renderLinks($serviceOrders['total']);

		return $this->getTwig()->render($response, $this->setView('admin/serviceorders'), [

          'pagtitle' => 'OSPROMAKER - Ordem de Serviços',
          'subtitle' => 'Ordem de Serviços',
          'serviceorders' => $serviceOrders['registers'],
          'links' => $links,

        ]);

	}

}