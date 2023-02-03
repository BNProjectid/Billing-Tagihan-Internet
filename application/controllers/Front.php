<?php defined('BASEPATH') or exit('No direct script access allowed');

class Front extends CI_Controller
{
	function __construct()
	{
		parent::__construct();
		$this->load->model(['services_m', 'customer_m']);
	}
	public function index()
	{
		$data['title'] = 'Home';
		$data['company'] = $this->db->get('company')->row_array();
		$this->template->load('frontend', 'frontend/welcome_message', $data);
	}
	public function faq()
	{
		$data['title'] = 'FAQ';
		$data['company'] = $this->db->get('company')->row_array();
		$this->template->load('frontend', 'frontend/faq', $data);
	}

	public function view_bill()
	{
		$no_services = $this->input->post('no_services');
		$month = $this->input->post('month');
		$year = $this->input->post('year');
		if (isset($_POST['cek_bill'])) {
			$data['bill'] =  $this->services_m->getCekBill($no_services, $month, $year);
			$data['customer'] =  $this->customer_m->getNSCustomer($no_services);
			$this->load->view('frontend/cek_bill', $data);
		} else {
			echo "Not Found";
		}
	}
}
