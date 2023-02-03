<?php defined('BASEPATH') or exit('No direct script access allowed');

class Dashboard extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        is_logged_in();
        $this->load->model(['income_m', 'expenditure_m', 'bill_m', 'customer_m', 'package_m']);
    }
    public function index()
    {
        $data['title'] = 'Dashboard';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['income'] = $this->income_m->getIncome()->result();
        $data['totalCustomer'] = $this->customer_m->getCustomer()->num_rows();
        $data['totalServices'] = $this->package_m->getPItem()->num_rows();
        $data['expenditure'] = $this->expenditure_m->getexpenditure()->result();
        $data['incomeThisMonth'] = $this->income_m->getIncomeThisMonth()->result();
        $data['ExpenditureThisMonth'] = $this->expenditure_m->getExpenditureThisMonth()->result();
        $data['pendingPayment'] = $this->bill_m->getPendingPayment()->num_rows();
        $data['TotalpendingPayment'] = $this->bill_m->getTotalPendingPayment()->result();
        $data['incomeJan'] = $this->income_m->getIncomeJan()->result();
        $data['incomeFeb'] = $this->income_m->getIncomeFeb()->result();
        $data['incomeMar'] = $this->income_m->getIncomeMar()->result();
        $data['incomeApr'] = $this->income_m->getIncomeApr()->result();
        $data['incomeMay'] = $this->income_m->getIncomeMay()->result();
        $data['incomeJun'] = $this->income_m->getIncomeJun()->result();
        $data['incomeJul'] = $this->income_m->getIncomeJul()->result();
        $data['incomeAug'] = $this->income_m->getIncomeAug()->result();
        $data['incomeSep'] = $this->income_m->getIncomeSep()->result();
        $data['incomeOct'] = $this->income_m->getIncomeOct()->result();
        $data['incomeNov'] = $this->income_m->getIncomeNov()->result();
        $data['incomeDec'] = $this->income_m->getIncomeDec()->result();
        $data['company'] = $this->db->get('company')->row_array();
        $this->template->load('backend', 'backend/dashboard', $data);
    }
}
