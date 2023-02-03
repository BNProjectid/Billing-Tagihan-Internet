<?php defined('BASEPATH') or exit('No direct script access allowed');

class Income extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        is_logged_in();
        $this->load->model(['income_m']);
    }


    public function index()
    {
        $data['title'] = 'Income';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['income'] = $this->income_m->getincome()->result();
        $data['company'] = $this->db->get('company')->row_array();
        $this->template->load('backend', 'backend/income/income', $data);
    }


    public function add()
    {
        $post = $this->input->post(null, TRUE);
        $this->income_m->add($post);
        if ($this->db->affected_rows() > 0) {
            $this->session->set_flashdata('success', 'Data pemasukan berhasil ditambahkan');
        }
        echo "<script>window.location='" . site_url('income') . "'; </script>";
    }
    public function edit()
    {
        $post = $this->input->post(null, TRUE);
        $this->income_m->edit($post);
        if ($this->db->affected_rows() > 0) {
            $this->session->set_flashdata('success', 'Data pemasukan berhasil diperbaharui');
        }
        echo "<script>window.location='" . site_url('income') . "'; </script>";
    }
    public function delete()
    {
        $income_id = $this->input->post('income_id');
        $this->income_m->delete($income_id);
        if ($this->db->affected_rows() > 0) {
            $this->session->set_flashdata('success', 'Data pemasukan berhasil dihapus');
        }
        echo "<script>window.location='" . site_url('income') . "'; </script>";
    }
}
