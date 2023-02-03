<?php defined('BASEPATH') or exit('No direct script access allowed');
class expenditure_m extends CI_Model
{
    public function getexpenditure($expenditure_id = null)
    {
        $this->db->select('*');
        $this->db->from('expenditure');
        if ($expenditure_id != null) {
            $this->db->where('$expenditure_id', $expenditure_id);
        }
        $this->db->order_by('date_payment', 'DESC');
        $query = $this->db->get();
        return $query;
    }
    public function getExpenditureThisMonth()
    {
        $this->db->select('*');
        $this->db->from('expenditure');
        $this->db->where('MONTH(date_payment)', date('m'));
        $query = $this->db->get();
        return $query;
    }


    public function add($post)
    {
        $params = [
            'nominal' => $post['nominal'],
            'date_payment' => $post['date_payment'],
            'remark' => $post['remark'],
            'created' => time()
        ];
        $this->db->insert('expenditure', $params);
    }
    public function edit($post)
    {
        $params = [
            'nominal' => $post['nominal'],
            'date_payment' => $post['date_payment'],
            'remark' => $post['remark'],
        ];
        $this->db->where('expenditure_id',  $post['expenditure_id']);
        $this->db->update('expenditure', $params);
    }

    public function delete($expenditure_id)
    {
        $this->db->where('expenditure_id', $expenditure_id);
        $this->db->delete('expenditure');
    }
}
