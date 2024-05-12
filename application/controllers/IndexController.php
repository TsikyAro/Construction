<?php
defined('BASEPATH') or exit('No direct script access allowed');
require APPPATH.'controllers/HomeController.php';
class IndexController extends HomeController
{
	public function __construct()
    {
        parent::__construct();
    }
	private function viewer($page, $data)
	{
		$data = array(
			'page' => $page,
			'data' => $data
		);
		$this->load->view('template/BasePage', $data);
	}

	public function index()
	{
		$this->viewer('specifique/chart_pdf',[]);
	}
}