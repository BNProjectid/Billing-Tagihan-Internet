<?php defined('BASEPATH') or exit('No direct script access allowed');

class Services extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        is_logged_in();
        $this->load->model(['customer_m', 'package_m', 'services_m']);
    }
    public function index()
    {
    }
    public function detail($no_services)
    {
        $data['title'] = 'Services List';
        $data['p_item'] = $this->package_m->getPItem()->result();
        $data['services'] = $this->services_m->getServices($no_services);
        $query  = $this->customer_m->getNSCustomer($no_services);
        if ($query->num_rows() > 0) {
            $data['customer'] = $query->row();
            $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        } else {
            echo "<script> alert ('Data tidak ditemukan');";
            echo "window.location='" . site_url('customer') . "'; </script>";
        }
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['company'] = $this->db->get('company')->row_array();
        $this->template->load('backend', 'backend/customer/services/list', $data);
    }

    public function add($no_services)
    {
        $post = $this->input->post(null, TRUE);
        $this->services_m->add($post);
        if ($this->db->affected_rows() > 0) {
            $this->session->set_flashdata('success', 'Daftar layanan berhasil ditambahkan');
        }
        echo "<script>window.location='" . site_url('services/detail/' . $no_services) . "'; </script>";
    }
    public function edit()
    {
        $no_services = $this->input->post('no_services');
        $post = $this->input->post(null, TRUE);
        $this->services_m->edit($post);
        if ($this->db->affected_rows() > 0) {
            $this->session->set_flashdata('success', 'Item layanan berhasil diperbaharui');
        }
        echo "<script>window.location='" . site_url('services/detail/' . $no_services) . "'; </script>";
    }

    public function delete()
    {
        $no_services = $this->input->post('no_services');
        $services_id = $this->input->post('services_id');
        $this->services_m->delete($services_id);
        if ($this->db->affected_rows() > 0) {
            $this->session->set_flashdata('success', 'Item layanan berhasil dihapus');
        }
        echo "<script>window.location='" . site_url('services/detail/' . $no_services) . "'; </script>";
    }
}
