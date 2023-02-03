<?php defined('BASEPATH') or exit('No direct script access allowed');

class Package extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        is_logged_in();
        $this->load->model(['package_m', 'services_m', 'bill_m']);
    }
    public function index()
    {
        $data['title'] = 'Paket';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['company'] = $this->db->get('company')->row_array();
        $this->template->load('backend', 'backend/package', $data);
    }
    public function Item()
    {
        $data['title'] = 'Item Package';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['p_item'] = $this->package_m->getPItem()->result();
        $data['p_category'] = $this->package_m->getPCategory()->result();
        $data['company'] = $this->db->get('company')->row_array();
        $this->template->load('backend', 'backend/package/item', $data);
    }
    public function Category()
    {
        $data['title'] = 'Category Package';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['p_category'] = $this->package_m->getPCategory()->result();
        $data['company'] = $this->db->get('company')->row_array();
        $this->template->load('backend', 'backend/package/category', $data);
    }
    public function addPcategory()
    {
        $post = $this->input->post(null, TRUE);
        $this->package_m->addPCategory($post);
        if ($this->db->affected_rows() > 0) {
            $this->session->set_flashdata('success', 'Data berhasil disimpan');
        }
        redirect('package/category');
    }
    public function editPcategory()
    {
        $post = $this->input->post(null, TRUE);
        $this->package_m->editPCategory($post);
        if ($this->db->affected_rows() > 0) {
            $this->session->set_flashdata('success', 'Data berhasil diperbaharui');
        }
        redirect('package/category');
    }

    public function deletePCategory()
    {
        $id = $this->input->post('p_category_id');
        $query = $this->package_m->cekCategory($id);
        if ($query->num_rows() > 0) {
            $this->session->set_flashdata('error', 'Data Kategori tidak dapat dihapus dikarenakan masih digunakan di Item Layanan atau Detail Tagihan');
            redirect('package/category');
        } else {
            $this->package_m->deletePCategory($id);
            if ($this->db->affected_rows() > 0) {
                $this->session->set_flashdata('success', 'Data Kategori berhasil dihapus');
            }
        }
        redirect('package/category');
    }

    public function addPItem()
    {
        $config['upload_path']          = './assets/images/package';
        $config['allowed_types']        = 'gif|jpg|png|jpeg';
        $config['max_size']             = 10048; // 10 Mb
        $config['file_name']             = 'package-' . date('ymd') . '-' . substr(md5(rand()), 0, 10);
        $this->load->library('upload', $config);
        $post = $this->input->post(null, TRUE);
        if (@FILES['picture']['name'] != null) {
            if ($this->upload->do_upload('picture')) {
                $post['picture'] =  $this->upload->data('file_name');
                $this->package_m->addPItem($post);
                if ($this->db->affected_rows() > 0) {
                    $this->session->set_flashdata('success', 'Data Item Layanan berhasil disimpan');
                }
                echo "<script>window.location='" . site_url('package/item') . "'; </script>";
            } else {
                $post['picture'] =  null;
                $this->package_m->addPItem($post);
                if ($this->db->affected_rows() > 0) {
                    $this->session->set_flashdata('success', 'Data Item Layanan berhasil disimpan');
                }
                echo "<script>window.location='" . base_url('package/item') . "'; </script>";
            }
        } else {
            $error = $this->upload->display_errors();
            $this->session->set_flashdata('error', $error);
            echo "<script>window.location='" . base_url('package/item') . "'; </script>";
        }
    }
    public function editPItem()
    {
        $config['upload_path']          = './assets/images/package';
        $config['allowed_types']        = 'gif|jpg|png|jpeg';
        $config['max_size']             = 10048; // 10 Mb
        $config['file_name']             = 'package-' . date('ymd') . '-' . substr(md5(rand()), 0, 10);
        $this->load->library('upload', $config);
        $post = $this->input->post(null, TRUE);
        if (@FILES['picture']['name'] != null) {
            if ($this->upload->do_upload('picture')) {
                $package = $this->package_m->getPItem($post['p_item_id'])->row();
                if ($package->picture != null) {
                    $target_file = './assets/images/package/' . $package->picture;
                    unlink($target_file);
                }
                $post['picture'] =  $this->upload->data('file_name');
                $this->package_m->editPItem($post);
                if ($this->db->affected_rows() > 0) {
                    $this->session->set_flashdata('success', 'Data Item layanan berhasil diperbaharui');
                }
                echo "<script>window.location='" . site_url('package/item') . "'; </script>";
            } else {
                $post['picture'] =  null;
                $this->package_m->editPItem($post);
                if ($this->db->affected_rows() > 0) {
                    $this->session->set_flashdata('success', 'Data Item layanan berhasil diperbaharui');
                }
                echo "<script>window.location='" . base_url('package/item') . "'; </script>";
            }
        } else {
            $error = $this->upload->display_errors();
            $this->session->set_flashdata('error', $error);
            echo "<script>window.location='" . base_url('package/item') . "'; </script>";
        }
    }
    public function deletePItem()
    {
        $p_item_id = $this->input->post('p_item_id');
        $query = $this->services_m->cekItem($p_item_id);
        if ($query->num_rows() > 0) {
            $this->session->set_flashdata('error', 'Data Layanan tidak dapat dihapus dikarenakan masih digunakan di Layanan Pelanggan atau Detail Tagihan');
            redirect('package/item');
        }
        $query = $this->bill_m->cekItem($p_item_id);
        if ($query->num_rows() > 0) {
            $this->session->set_flashdata('error', 'Data Item tidak dapat dihapus dikarenakan masih digunakan Detail Tagihan');
            redirect('package/Item');
        } else {
            $package = $this->package_m->getPItem($p_item_id)->row();
            if ($package->picture != null) {
                $target_file = './assets/images/package/' . $package->picture;
                unlink($target_file);
            }
        }

        $this->package_m->deletePitem($p_item_id);
        if ($this->db->affected_rows() > 0) {
            $this->session->set_flashdata('success', 'Data berhasil dihapus');
        }
        redirect('package/item');
    }
}
