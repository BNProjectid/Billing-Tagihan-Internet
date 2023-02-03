<?php defined('BASEPATH') or exit('No direct script access allowed');
class Income_m extends CI_Model
{
    public function getIncome($income_id = null)
    {
        $this->db->select('*');
        $this->db->from('income');
        if ($income_id != null) {
            $this->db->where('$income_id', $income_id);
        }
        $this->db->order_by('date_payment', 'DESC');
        $query = $this->db->get();
        return $query;
    }
    public function getIncomeThisMonth()
    {
        $this->db->select('*');
        $this->db->from('income');
        $this->db->where('MONTH(date_payment)', date('m'));
        $query = $this->db->get();
        return $query;
    }
    public function getIncomeJan()
    {
        $this->db->select('*');
        $this->db->from('income');
        $this->db->where('MONTH(date_payment)', '01');
        $this->db->where('YEAR(date_payment)', date('Y'));
        $query = $this->db->get();
        return $query;
    }
    public function getIncomeFeb()
    {
        $this->db->select('*');
        $this->db->from('income');
        $this->db->where('MONTH(date_payment)', '02');
        $this->db->where('YEAR(date_payment)', date('Y'));
        $query = $this->db->get();
        return $query;
    }
    public function getIncomeMar()
    {
        $this->db->select('*');
        $this->db->from('income');
        $this->db->where('MONTH(date_payment)', '03');
        $this->db->where('YEAR(date_payment)', date('Y'));
        $query = $this->db->get();
        return $query;
    }
    public function getIncomeApr()
    {
        $this->db->select('*');
        $this->db->from('income');
        $this->db->where('MONTH(date_payment)', '04');
        $this->db->where('YEAR(date_payment)', date('Y'));
        $query = $this->db->get();
        return $query;
    }
    public function getIncomeMay()
    {
        $this->db->select('*');
        $this->db->from('income');
        $this->db->where('MONTH(date_payment)', '05');
        $this->db->where('YEAR(date_payment)', date('Y'));
        $query = $this->db->get();
        return $query;
    }
    public function getIncomeJun()
    {
        $this->db->select('*');
        $this->db->from('income');
        $this->db->where('MONTH(date_payment)', '06');
        $this->db->where('YEAR(date_payment)', date('Y'));
        $query = $this->db->get();
        return $query;
    }
    public function getIncomeJul()
    {
        $this->db->select('*');
        $this->db->from('income');
        $this->db->where('MONTH(date_payment)', '07');
        $this->db->where('YEAR(date_payment)', date('Y'));
        $query = $this->db->get();
        return $query;
    }
    public function getIncomeAug()
    {
        $this->db->select('*');
        $this->db->from('income');
        $this->db->where('MONTH(date_payment)', '08');
        $this->db->where('YEAR(date_payment)', date('Y'));
        $query = $this->db->get();
        return $query;
    }
    public function getIncomeSep()
    {
        $this->db->select('*');
        $this->db->from('income');
        $this->db->where('MONTH(date_payment)', '09');
        $this->db->where('YEAR(date_payment)', date('Y'));
        $query = $this->db->get();
        return $query;
    }
    public function getIncomeOct()
    {
        $this->db->select('*');
        $this->db->from('income');
        $this->db->where('MONTH(date_payment)', '10');
        $this->db->where('YEAR(date_payment)', date('Y'));
        $query = $this->db->get();
        return $query;
    }
    public function getIncomeNov()
    {
        $this->db->select('*');
        $this->db->from('income');
        $this->db->where('MONTH(date_payment)', '11');
        $this->db->where('YEAR(date_payment)', date('Y'));
        $query = $this->db->get();
        return $query;
    }
    public function getIncomeDec()
    {
        $this->db->select('*');
        $this->db->from('income');
        $this->db->where('MONTH(date_payment)', '12');
        $this->db->where('YEAR(date_payment)', date('Y'));
        $query = $this->db->get();
        return $query;
    }
    public function addPayment($post)
    {
        $params = [
            'nominal' => $post['nominal'],
            'date_payment' => $post['date_payment'],
            'remark' => 'Pembayaran iuran no layanan' . ' ' . $post['no_services'] . ' ' . 'a/n' . ' ' . $post['name'] . ' ' . 'Periode' . ' ' . $post['month'] . ' ' . $post['year'],
            'created' => time()
        ];
        $this->db->insert('income', $params);
    }

    public function add($post)
    {
        $params = [
            'nominal' => $post['nominal'],
            'date_payment' => $post['date_payment'],
            'remark' => $post['remark'],
            'created' => time()
        ];
        $this->db->insert('income', $params);
    }
    public function edit($post)
    {
        $params = [
            'nominal' => $post['nominal'],
            'date_payment' => $post['date_payment'],
            'remark' => $post['remark'],
        ];
        $this->db->where('income_id',  $post['income_id']);
        $this->db->update('income', $params);
    }

    public function delete($income_id)
    {
        $this->db->where('income_id', $income_id);
        $this->db->delete('income');
    }
}
