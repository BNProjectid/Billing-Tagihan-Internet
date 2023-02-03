<?php defined('BASEPATH') or exit('No direct script access allowed');
class Bill_m extends CI_Model
{
    public function getInvoice($invoice_id = null)
    {
        $this->db->select('*, invoice.created as created_invoice');
        $this->db->from('invoice');
        $this->db->join('customer', 'customer.no_services = invoice.no_services');
        if ($invoice_id != null) {
            $this->db->where('invoice_id', $invoice_id);
        }
        $this->db->order_by('created_invoice', 'DESC');
        $query = $this->db->get();
        return $query;
    }

    public function getInvoiceDetail($invoice = null)
    {
        $this->db->select('*');
        $this->db->from('invoice_detail');
        $this->db->where('invoice_id', $invoice);
        $query = $this->db->get();
        return $query;
    }
    public function getBill($invoice = null)
    {
        $this->db->select('*, invoice.created as created_invoice, invoice.no_services as noServices');
        $this->db->from('invoice');
        $this->db->join('customer', 'customer.no_services = invoice.no_services');
        if ($invoice != null) {
            $this->db->where('invoice', $invoice);
        }
        $this->db->order_by('created_invoice', 'DESC');
        $query = $this->db->get();
        return $query;
    }

    public function getEditInvoice($invoice)
    {
        $this->db->select('*, invoice_detail.price as detail_price, package_item.name as item_name, package_category.name as category_name');
        $this->db->from('invoice_detail');
        $this->db->join('package_item', 'package_item.p_item_id = invoice_detail.item_id');
        $this->db->join('package_category', 'package_category.p_category_id = invoice_detail.category_id');
        // $this->db->join('invoice_detail', 'invoice_detail.invoice_id = invoice.invoice');
        if ($invoice != null) {
            $this->db->where('invoice_id', $invoice);
        }
        $query = $this->db->get();
        return $query;
    }
    public function getPendingPayment()
    {
        $this->db->select('*');
        $this->db->from('invoice');
        $this->db->where('status', 'BELUM BAYAR');
        $query = $this->db->get();
        return $query;
    }
    public function getTotalPendingPayment()
    {
        $this->db->select('*');
        $this->db->from('invoice_detail');
        $this->db->join('invoice', 'invoice_detail.invoice_id = invoice.invoice');
        $this->db->where('status', 'BELUM BAYAR');
        $query = $this->db->get();
        return $query;
    }

    public function cekItem($p_item_id = null)
    {
        $this->db->select('*');
        $this->db->from('invoice_detail');
        if ($p_item_id != null) {
            $this->db->where('item_id', $p_item_id);
        }
        $query = $this->db->get();
        return $query;
    }
    function invoice_no()
    {
        $this->db->select('RIGHT(invoice.invoice,2) as invoice', FALSE);
        $this->db->order_by('invoice', 'DESC');
        $this->db->limit(1);
        $query = $this->db->get('invoice');  //cek dulu apakah ada sudah ada kode di tabel.    
        if ($query->num_rows() <> 0) {
            //cek kode jika telah tersedia    
            $data = $query->row();
            $kode = intval($data->invoice) + 1;
        } else {
            $kode = 001;  //cek jika kode belum terdapat pada table
        }
        $tgl = date('ymd');
        $batas = str_pad($kode, 3, "0", STR_PAD_LEFT);
        $kodetampil = ($tgl . "" . $batas);  //format kode
        return $kodetampil;
    }

    public function addBill($post)
    {
        $params = [
            'invoice' => $post['invoice'],
            'month' => $post['month'],
            'year' => $post['year'],
            'status' => 'BELUM BAYAR',
            'no_services' => $post['no_services'],
            'created' => time()
        ];

        $this->db->insert('invoice', $params);
    }

    public function add_bill_detail($params)
    {
        $this->db->insert_batch('invoice_detail', $params);
    }
    public function getCekInvoice($no_services = null)
    {
        $this->db->select('*');
        $this->db->from('invoice');
        if ($no_services != null) {
            $this->db->where('no_services', $no_services);
        }
        $query = $this->db->get();
        return $query;
    }
    public function delete($invoice)
    {
        $this->db->where('invoice', $invoice);
        $this->db->delete('invoice');
    }
    public function deleteDetailBill($invoice)
    {
        $this->db->where('invoice_id', $invoice);
        $this->db->delete('invoice_detail');
    }
    public function payment($post)
    {
        $params = [
            'status' => 'SUDAH BAYAR',
            'date_payment' => time(),
        ];
        $this->db->where('invoice', $post['invoice']);
        $this->db->update('invoice', $params);
    }

    public function cekPeriode($no_services, $month, $year)
    {
        $this->db->select('*');
        $this->db->from('invoice');
        $this->db->where('no_services', $no_services);
        $this->db->where('month', $month);
        $this->db->where('year', $year);
        $query = $this->db->get();
        return $query;
    }
}
