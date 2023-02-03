<?php
defined('BASEPATH') or exit('No direct script access allowed');

class auth extends CI_Controller
{


    public function index()
    {
        if ($this->session->userdata('email')) {
            redirect('dashboard');
        }
        $this->form_validation->set_rules('email', 'Email', 'required|trim|valid_email');
        $this->form_validation->set_rules('password', 'Password', 'required|trim');
        if ($this->form_validation->run() == false) {
            $data['title'] = 'Login Page';
            $data['company'] = $this->db->get('company')->row_array();
            $this->load->view('backend/auth/login', $data);
        } else {
            $this->_login();
        }
    }
    private function _login()
    {
        $email = $this->input->post('email');
        $password = $this->input->post('password');
        $user = $this->db->get_where('user', ['email' => $email])->row_array(); // select * where user email = email
        // user ada
        if ($user) {
            // jika user active
            if ($user['is_active'] == 1) {
                # cek password dan verifikasi dengan input
                if (password_verify($password, $user['password'])) {
                    # jika sama
                    $data = [
                        'login' => true,
                        'id' => $user['id'],
                        'email' => $user['email'],
                        'role_id' => $user['role_id']
                    ];
                    $this->session->set_userdata($data);
                    if ($user['role_id'] == 1) {
                        $this->session->set_flashdata('success', 'Selamat datang kembali ' . $user['name']);
                        redirect('dashboard');
                    } else {
                        redirect('dashboard');
                    }
                } else {
                    # jika tidak sama atau error
                    $this->session->set_flashdata('error', 'Password Salah ! ');
                    redirect('auth');
                }
            } else {
                $this->session->set_flashdata('error', 'Alamat email di aktivasi ! ');
                redirect('auth');
            }
        } else {
            // jika tidak ada
            $this->session->set_flashdata('error', ' Alamat email belum terdaftar ! ');
            redirect('auth');
        }
    }

    private function _sendEmail($token, $type)
    {
        $config = [
            'protocol'  => 'smtp',
            'smtp_host' => 'ssl://smtp.googlemail.com',
            'smtp_user' => 'Alamat Email Google', // isi Alamat email
            'smtp_pass' => 'Password Email Google', // Isi Password email
            'smtp_port' => 465,
            'mailtype'  => 'html',
            'charset'   => 'utf-8',
            'newline'   => "\r\n"
        ];
        $this->email->initialize($config);


        $this->load->library('email', $config);

        $this->email->from('Alamat Email', '1112-Project'); // isi Alamat email dan nama pengirim
        $this->email->to($this->input->post('email'));

        if ($type == 'verify') {
            $this->email->subject('Account Verification');
            $this->email->message('Click this link to verify account : <a href="' . base_url() . 'auth/verify?email=' . $this->input->post('email') . '&token=' . urlencode($token) . '">Activated</a>');
        } elseif ($type == 'forgot') {
            $this->email->subject('Reset Password');
            $this->email->message('Click this link to reset your password : <a href="' . base_url() . 'auth/resetpassword?email=' . $this->input->post('email') . '&token=' . urlencode($token) . '">Reset Password</a>');
        }


        if ($this->email->send()) {
            return true;
        } else {
            echo $this->email->print_debugger();
            die;
        }
    }
    public function verify()
    {
        $email = $this->input->get('email');
        $token = $this->input->get('token');
        $user = $this->db->get_where('user', ['email' => $email])->row_array();

        if ($user) {
            $user_token = $this->db->get_where('user_token', ['token' => $token])->row_array();

            if ($user_token) {
                if (time() - $user_token['date_created'] < (60 * 60 * 24)) {
                    $this->db->set('is_active', 1);
                    $this->db->where('email', $email);
                    $this->db->update('user');
                    $this->db->delete('user_token', ['email' => $email]);
                    $this->session->set_flashdata('success', '
                    ' . $email . ' has been actived. Please login.
                  ');
                    redirect('auth');
                } else {
                    $this->db->delete('user', ['email' => $email]);
                    $this->db->delete('user_token', ['email' => $email]);
                    $this->session->set_flashdata('error', 'Account activation failed! Token Expired.
                  ');
                    redirect('auth');
                }
            } else {
                $this->session->set_flashdata('error', 'Account activation failed! Wrong token.
              ');
                redirect('auth');
            }
        } else {
            $this->session->set_flashdata('error', 'Account activation failed! Wrong email.
          ');
            redirect('auth');
        }
    }
    public function logout()
    {
        $this->session->unset_userdata('login');
        $this->session->unset_userdata('email');
        $this->session->unset_userdata('role_id');
        $this->session->set_flashdata('success', ' Logout Berhasil !');
        redirect('auth');
    }
    public function forgotpassword()
    {
        $this->form_validation->set_rules('email', 'Email', 'required|trim|valid_email');
        if ($this->form_validation->run() == false) {
            $data['title'] = 'Forgot Password';
            $data['company'] = $this->db->get('company')->row_array();
            $this->load->view('backend/auth/forgot-password', $data);
        } else {
            $email = $this->input->post('email');
            $user = $this->db->get_where('user', ['email' => $email, 'is_active' => 1])->row_array();
            if ($user) {
                $token = base64_encode(random_bytes(32));
                $user_token = [
                    'email' => $email,
                    'token' => $token,
                    'date_created' => time()
                ];
                $this->db->insert('user_token', $user_token);
                $this->_sendEmail($token, 'forgot');
                $this->session->set_flashdata('success', 'Silahkan cek email untuk reset password !');
                redirect('auth/forgotpassword');
            } else {
                $this->session->set_flashdata('error', 'Email belum terdaftar !');
                redirect('auth/forgotpassword');
            }
        }
    }

    public function resetPassword()
    {
        $email = $this->input->get('email');
        $token = $this->input->get('token');
        $user = $this->db->get_where('user', ['email' => $email])->row_array();

        if ($user) {
            $user_token = $this->db->get_where('user_token', ['token' => $token])->row_array();
            if ($user_token) {
                if (time() - $user_token['date_created'] < (60 * 60 * 24)) {
                    $this->session->set_userdata('reset_email', $email);
                    $this->changePassword();
                } else {
                    $this->db->delete('user_token', ['email' => $email]);
                    $this->session->set_flashdata('error', '
                    Reset password failed! Token Expired.
                 ');
                    redirect('auth');
                }
            } else {
                $this->session->set_flashdata('error', '
                Reset password failed! Wrong token.
             ');
                redirect('auth');
            }
        } else {
            $this->session->set_flashdata('error', '
            Reset password failed! Wrong email.
         ');
            redirect('auth');
        }
    }

    public function changePassword()
    {
        if (!$this->session->userdata('reset_email')) {
            redirect('auth');
        }
        $this->form_validation->set_rules('password1', 'Password', 'required|trim|min_length[3]|matches[password2]', [
            'matches' => 'Password not match !',
            'min_length' => 'Password too short !'
        ]);
        $this->form_validation->set_rules('password2', 'Repeat Password', 'required|trim|matches[password1]');
        if ($this->form_validation->run() == false) {
            $data['title'] = 'Reset Password';
            $data['company'] = $this->db->get('company')->row_array();
            $this->load->view('backend/auth/change-password', $data);
        } else {
            $password = password_hash($this->input->post('password1'), PASSWORD_DEFAULT);
            $email = $this->session->userdata('reset_email');

            $this->db->set('password', $password);
            $this->db->where('email', $email);
            $this->db->update('user');

            $this->session->unset_userdata('reset_email');
            $this->session->set_flashdata('success', '
            Password has been changed! Please login.
         ');
            redirect('auth');
        }
    }
}
