<?php

class Auth extends Controller {

    function __construct() {
        parent::Controller();
        //ui_render();
        $this->template->set_template('deauth');
    }

    function index($page=null) {

        $this->login($page);
    }

    function login($page=null) {

        //show_error("Due to a major problem, OTIS will be offline for an indefinite period of time");

        if ($this->quickauth->is_logged_in()) {//The user is not logged in
            redirect('dashboard');
        } else {
            //else show login form
            if (isset($page)) {
                $page = str_replace('/auth/login', '', uri_string());
                //echo $page;
                $newdata = array('goto' => $page);
                $this->session->set_userdata($newdata);
            }
            $this->load->model("Io");
            $data = array("date" => $this->Io->get("countdown"));

            $this->template->write_view('body', 'login.v.php', $data, true);
            $this->template->render();
            //$this->load->view('login.v.php');
        }
    }

    function authorize() {
        $username = stripslashes($_POST['username']);
        $password = stripslashes($_POST['password']);

        if ($this->quickauth->login($username, $password)) {
            $to = $this->session->userdata('goto');
            //echo $to;
            //remove page session var
            $this->session->unset_userdata('goto');

            $this->load->model('user_model', 'um');

            $this->um->lastlogin($username);

            //echo $to;
            //redirect('/admin/users');
            redirect($to);

            //echo "successfully logged in";
        } else {
            //messaged handled in quickauth
            //ui_set_error('Your username or password is incorrect');
            redirect('/auth');
        }
        //die("Your username or password is incorrect.");
    }

    function logout() {
        //ui_set_message("Successfully logged out");
        $this->quickauth->logout(); // this doesn't seem to work.
        //$this->session->sess_destroy();
        //echo $this->auth->is_logged_in();
        //make sure data destroyed?

        $ses = $this->session->all_userdata();

        //print_r($ses);
        $this->session->unset_userdata($ses);


        //ui_set_message("Successfully logged out");
        redirect('/auth');
        //ui_set_message("logged out");
        //print_r($this->session->all_userdata());
        //echo "<a href=\"" . base_folder().index_page()."/auth" . "\">Click here to procede</a>";
        //send to login page?
    }

    function register() {
        $this->template->write_view('body', 'register.v.php', true);
        $this->template->render();
//		$this->load->view('register.v.php');
    }

    function create_user() {
        $this->load->library('form_validation');

        // field name, error message, validation rules
        $this->form_validation->set_rules('first_name', 'Name', 'trim|required|is_not[Name]');
        $this->form_validation->set_rules('last_name', 'Last Name', 'trim|requiredis_not[Last Name]');
        $this->form_validation->set_rules('email_address', 'Email Address', 'trim|required|valid_email|is_not[Email Address]');
        $this->form_validation->set_rules('email_address2', 'Email Confirm', 'trim|required|valid_email|matches[email_address]|is_not[Email Confirm]');
        $this->form_validation->set_rules('username', 'Username', 'trim|required|min_length[4]|is_not[Username]');
        $this->form_validation->set_rules('password', 'Password', 'trim|required|min_length[4]|max_length[32]|is_not[Password]');
        $this->form_validation->set_rules('password2', 'Password Confirmation', 'trim|required|matches[password]|is_not[assword Confirmation]');


        if ($this->form_validation->run() == FALSE) {
            $this->template->write_view('body', 'register.v.php', true);
            $this->template->render();
        } else {
            $this->load->model('membership_model');

            if ($this->membership_model->create_member()) {
//            $usrnm = $this->input->post('username');

                ui_set_message('Your account has been created. Your username is: '.$_POST['username']);
                $this->load->helper('mail_helper');
                mailer("blake@team2648.com", "Account Creation", $_POST['username']." just created an account");
                redirect('/auth');
            } else {
                ui_st_error('There has been a error');
                redirect('/auth/register');
            }
        }
    }

}

?>