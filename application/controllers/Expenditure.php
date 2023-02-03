<?php defined('BASEPATH') or exit('No direct script access allowed');

class expenditure extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        is_logged_in();
        $this->load->model(['expenditure_m']);
    }


    public function index()
    {
        $data['title'] = 'expenditure';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['expenditure'] = $this->expenditure_m->getexpenditure()->result();
        $data['company'] = $this->db->get('company')->row_array();
        $this->template->load('backend', 'backend/expenditure/expenditure', $data);
    }


    public function add()
    {
        $post = $this->input->post(null, TRUE);
        $this->expenditure_m->add($post);
        if ($this->db->affected_rows() > 0) {
            $this->session->set_flashdata('success', 'Data pengeluaran berhasil ditambahkan');
        }
        echo "<script>window.location='" . site_url('expenditure') . "'; </script>";
    }
    public function edit()
    {
        $post = $this->input->post(null, TRUE);
        $this->expenditure_m->edit($post);
        if ($this->db->affected_rows() > 0) {
            $this->session->set_flashdata('success', 'Data pengeluaran berhasil diperbaharui');
        }
        echo "<script>window.location='" . site_url('expenditure') . "'; </script>";
    }
    public function delete()
    {
        $expenditure_id = $this->input->post('expenditure_id');
        $this->expenditure_m->delete($expenditure_id);
        if ($this->db->affected_rows() > 0) {
            $this->session->set_flashdata('success', 'Data pengeluaran berhasil dihapus');
        }
        echo "<script>window.location='" . site_url('expenditure') . "'; </script>";
    }
}
