<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Home extends MX_Controller {

    function __construct() {
        parent::__construct();
       $this->load->model('finance/finance_model');
        $this->load->model('appointment/appointment_model');
        $this->load->model('home_model');
    }

    public function index() {

        $data = array();
        $data['settings'] = $this->settings_model->getSettings();
        $data['payments'] = $this->finance_model->getPayment();
    //    $data['this_month'] = $this->finance_model->getThisMonth();
     //   $data['expenses'] = $this->finance_model->getExpense();
        if ($this->ion_auth->in_group(array('Teacher'))) {
            redirect('teacher/details');
        } else {
            $data['appointments'] = $this->appointment_model->getAppointment();
        }
       if ($this->ion_auth->in_group(array('Client'))) {
           // redirect('client/medicalHistory');
        }



       $this->load->view('dashboard'); // just the header file
        $this->load->view('home', $data);
        $this->load->view('footer', $data);
    }

    

    public function permission() {
        $this->load->view('permission');
    }

}

/* End of file home.php */
/* Location: ./application/controllers/home.php */
