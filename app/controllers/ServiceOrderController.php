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

		$serviceOrders = $this->serviceOrder->find(true);

		return $this->getTwig()->render($response, $this->setView('admin/serviceorders'), [

          'pagtitle' => 'OSPROMAKER - Ordem de Serviços',
          'subtitle' => 'Ordem de Serviços',
          'serviceorders' => $serviceOrders,

        ]);

	}

}