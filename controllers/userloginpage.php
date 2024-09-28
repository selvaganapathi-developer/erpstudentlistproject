<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class userloginpage extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->helper('url'); // Load the URL helper
        $this->load->library('session');
        $this->load->model('crud_model');
    }

    public function index()
    {  
        $this->load->helper('url'); // Load the URL helper
        $this->load->view('signuppage.php');
        
    }

    public function save() {
        if (!empty($_POST)) {
            $password = $this->input->post('password');
            $result = array(
                'username' => $this->input->post('username'),
                'email' => $this->input->post('email'),
                'password' => $password,
                'confirm_password' => $this->input->post('cpassword'),
            );
            $insertedData = $this->db->insert('inserted_data', $result);
            if ($insertedData) {
                $data['success_message'] = 'Successfully Registered ! Please Visit Login Page';
            } else {
                $data['error_message'] = 'Failed To Register';
            }
        } else {
            $this->load->view('signuppage.php');
            return;
        }
        $this->load->view('signuppage.php', $data);
    }
    

    public function check_email_exists() {
        $email = $this->input->post('email');
        $exists = $this->crud_model->email_exists($email);
        if ($exists) {
            echo "false"; // Email exists
        } else {
            echo "true"; // Email doesn't exist
        }
    }



    public function login_user() {
        if ($this->session->has_userdata('id')) {
            redirect('crud_controller/index');
        }
    
        $email = $this->input->post('email');
        $password = $this->input->post('password');
    
        $checkUserDetails = $this->crud_model->checkDetails($email);
 
        if ($checkUserDetails) {
            if ($checkUserDetails->password == $password) {
                redirect('crud_controller/index');
                $this->session->set_userdata('id', $checkUserDetails->id); // Corrected variable name
            } else {
                $data['error_message'] = "Login Error! Incorrect password";
             
            }
        } else {
            $data['no_account_message'] = "No account exists with this email!";
           
        }
        $this->load->view('login_page', $data);
    }
    

    public function logout(){
        $this->session->unset_userdata('id');
        redirect('userloginpage/index');
    }
   
    
    
}
?>