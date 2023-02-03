<?php defined('BASEPATH') or exit('No direct script access allowed');

class Setting_m extends CI_Model
{
    public function getCompany($id = null)
    {
        $this->db->select('*');
        $this->db->from('company');
        if ($id != null) {
            $this->db->where('id', $id);
        }
        $query = $this->db->get();
        return $query;
    }
    public function editCompany($post)
    {
        $params = [
            'company_name' => $post['company_name'],
            'sub_name' => $post['sub_name'],
            'email' => $post['email'],
            'facebook' => $post['fb'],
            'instagram' => $post['ig'],
            'whatsapp' => $post['hp'],
            'address' => $post['address'],
            'owner' => $post['owner'],
        ];
        if (!empty($_FILES['logo']['name'])) {
            $params['logo'] = $post['logo'];
        }
        $this->db->where('id', $post['id']);
        $this->db->update('company', $params);
    }
}
