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

        $this->load->view('templates/header_auth', $data);
        $this->load->view('auth/login');
        $this->load->view('templates/footer_auth');
    }

    public function registration()
    {
        $data['judul'] = 'Organisasi XYZ';
        $data['subjudul'] = 'Member Registration';

        $this->form_validation->set_rules('firstname', 'First Name', 'required|trim');
        $this->form_validation->set_rules('lastname', 'Last Name', 'required|trim');
        $this->form_validation->set_rules('email', 'Email', 'required|trim|valid_email|is_unique[user.email]', [
            'is_unique' => 'Another user already registered with this email'
        ]);
        $this->form_validation->set_rules('password', 'Password', 'required|trim|min_length[5]|matches[confirmpassword]', [
            'matches' => 'Password don\'t match!',
            'min_length' => 'Password too short! (min. 5 char)'
        ]);
        $this->form_validation->set_rules('confirmpassword', 'Confirm Password', 'required|trim|matches[password]');

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
}
