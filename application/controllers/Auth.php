<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Auth extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->library('form_validation');
    }

    public function index()
    {
        $data['judul'] = 'Organisasi XYZ';
        $data['subjudul'] = 'Login';

        $this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email');
        $this->form_validation->set_rules('password', 'Password', 'trim|required');
        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header_auth', $data);
            $this->load->view('auth/login');
            $this->load->view('templates/footer_auth');
        } else {
            // validasinya lolos (success)
            $this->_login();
        }
    }

    private function _login()
    {
        $email = $this->input->post('email');
        $password = $this->input->post('password');

        $user = $this->db->get_where('user', ['email' => $email])->row_array();

        // usernya ada
        if ($user) {
            if ($user) {
                // jika usernya aktif
                if ($user['is_active'] == 1) {
                    // cek password
                    if (password_verify($password, $user['password'])) {
                        $data = [
                            'email' => $user['email'],
                            'role_id' => $user['role_id']
                        ];
                        $this->session->set_userdata($data);
                        redirect('user');
                    } else {
                        $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Wrong password!</div>');
                        redirect('auth');
                    }
                } else {
                    $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">This email is not activated!</div>');
                    redirect('auth');
                }
            }
        } else {
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Email is not registered!</div>');
            redirect('auth');
        }
    }

    public function registration()
    {
        $data['judul'] = 'Organisasi XYZ';
        $data['subjudul'] = 'Member Registration';

        $this->form_validation->set_rules('firstname', 'First name', 'required|trim');
        $this->form_validation->set_rules('lastname', 'Last name', 'required|trim');
        $this->form_validation->set_rules('email', 'Email', 'required|trim|valid_email|is_unique[user.email]', [
            'is_unique' => 'Another user already registered with this email'
        ]);
        $this->form_validation->set_rules('password', 'Password', 'required|trim|min_length[5]|matches[confirmpassword]', [
            'matches' => 'Password don\'t match!',
            'min_length' => 'Password too short! (min. 5 char)'
        ]);
        $this->form_validation->set_rules('confirmpassword', 'Confirm password', 'required|trim|matches[password]');

        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header_auth', $data);
            $this->load->view('auth/registration');
            $this->load->view('templates/footer_auth');
        } else {
            $data = [
                'firstname' => $this->input->post('firstname'),
                'lastname' => $this->input->post('lastname'),
                'email' => $this->input->post('email'),
                'password' => password_hash($this->input->post('password'), PASSWORD_DEFAULT),
                'image' => 'default.png',
                'role_id' => 2,
                'is_active' => 1,
                'date_created' => time()
            ];

            $this->db->insert('user', $data);
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Congratulation! your account has been created. Please Login!</div>');
            redirect('auth');
        }
    }

    public function forgot()
    {
        $data['judul'] = 'Organisasi XYZ';
        $data['subjudul'] = 'Forgot Password';

        $this->load->view('templates/header_auth', $data);
        $this->load->view('auth/forgot');
        $this->load->view('templates/footer_auth');
    }

    public function logout()
    {
        $this->session->unset_userdata('email');
        $this->session->unset_userdata('role_id');

        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">You have been logged out!</div>');
        redirect('auth');
    }
}
