<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Profile extends MX_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('profile_model');
        $this->load->model('category/category_model');
        $this->load->model('teacher/teacher_model');
        if (!$this->ion_auth->logged_in()) {
            redirect('auth/login', 'refresh');
        }
    }

    public function index() {
        $ion_user_id = $this->ion_auth->get_user_id();
        $group_id = $this->profile_model->getUsersGroups($ion_user_id)->row()->group_id;
        $group_name = $this->profile_model->getGroups($group_id)->row()->name;
        $group_name = strtolower($group_name);

        $data = array();
        $id = $this->ion_auth->get_user_id();
        $data['profile'] = $this->profile_model->getProfileById($id);
        $data['teacher'] = $this->teacher_model->getteacherByIonUserId($id);        
        $this->load->view('home/dashboard', $data); // just the header file
        $this->load->view('profile');
        $this->load->view('home/footer'); // just the footer file
    }

    public function addNew() {



       if($_POST['categoria']) {
        $categorias = '';
      foreach ($_POST['categoria'] as $categoria){

        $categorias .= $categoria.',';


      }
      $categorias = substr($categorias, 0, -1);
    
    }

      

     // print_r($categorias);die;

        $id = $this->input->post('id');
        $name = $this->input->post('name');
        $password = $this->input->post('password');
        $email = $this->input->post('email');
        $address = $this->input->post('address');
        $phone = $this->input->post('phone');
        $cpf = $this->input->post('cpf');
        $postal_code = $this->input->post('postal_code');
        $country = $this->input->post('country');
        $state = $this->input->post('state');
        $city = $this->input->post('city');
        $district = $this->input->post('district');
        $complement = $this->input->post('complement');
        $number = $this->input->post('number');
        $date_of_birth = $this->input->post('date_of_birth');
        $biography = $this->input->post('biography');
        $profile = $this->input->post('profile');
        $specialties =  $categorias;
        $facebook = $this->input->post('facebook');
        $instagram = $this->input->post('instagram');
        $amount_to_pay = $this->input->post('amount_to_pay');
   

        $data['profile'] = $this->profile_model->getProfileById($id);
        if ($data['profile']->email != $email) {
            if ($this->ion_auth->email_check($email)) {
                
                $this->session->set_flashdata('feedback', lang('this_email_address_is_already_registered'));
                $data['feedback'] = (validation_errors()) ? validation_errors() : $this->session->flashdata('feedback');
               // var_dump( $data['feedback']);die;
                redirect('profile');
            }
        }

        $ion_user_id = $this->ion_auth->get_user_id();
            $group_id = $this->profile_model->getUsersGroups($ion_user_id)->row()->group_id;
            $group_name = $this->profile_model->getGroups($group_id)->row()->name;
            $group_name = strtolower($group_name);



        $this->load->library('form_validation');
        $this->form_validation->set_error_delimiters('<div class="error">', '</div>');
        // Validating Name Field
        $this->form_validation->set_rules('name', 'Name', 'trim|required|min_length[5]|max_length[100]|xss_clean');
        // Validating Password Field
        if (!empty($password)) {
            $this->form_validation->set_rules('password', 'Password', 'trim|required|min_length[5]|max_length[100]|xss_clean');
        }
        // Validating Email Field
       
        if ($this->form_validation->run() == FALSE) {
            $data = array();
            $id = $this->ion_auth->get_user_id();
            $data['profile'] = $this->profile_model->getProfileById($id);
            $data['feedback'] = (validation_errors()) ? validation_errors() : $this->session->flashdata('message');
            var_dump( $data['feedback']);die;
            $this->load->view('home/dashboard'); // just the header file
            $this->load->view('profile', $data);
            $this->load->view('home/footer'); // just the footer file
        } else {
            $file_name = $_FILES['img_url']['name'];
            $file_name_pieces = explode('_', $file_name);
            $new_file_name = '';
            $count = 1;
            foreach ($file_name_pieces as $piece) {
                if ($count !== 1) {
                    $piece = ucfirst($piece);
                }

                $new_file_name .= $piece;
                $count++;
            }
            $config = array(
                'file_name' => $new_file_name,
                'upload_path' => "./uploads/",
                'allowed_types' => "gif|jpg|png|jpeg|pdf",
                'overwrite' => False,
                'max_size' => "20480000", // Can be set to particular file size , here it is 2 MB(2048 Kb)
                'max_height' => "1768",
                'max_width' => "2024"
            );

            $this->load->library('Upload', $config);
            $this->upload->initialize($config);

            if ($this->upload->do_upload('img_url')) {
                $path = $this->upload->data();
                $img_url = "uploads/" . $path['file_name'];
                $data = array();
                $data = array(
                    'img_url' => $img_url,
                    'name' => $name,
                    'email' => $email,
                    'address' => $address,
                    'phone' => $phone,
                   // 'profile' => $profile,
                    'cpf' => $cpf,
                   // 'cellphone' => $cellphone,
                    'postal_code' => $postal_code,
                    'country' => $country,
                    'state' => $state,
                    'city' => $city,
                    'district' => $district,
                    'address' => $address,
                    'complement' => $complement,
                    'number' => $number,
                    'date_of_birth' => $date_of_birth,
                    'biography' => $biography,
                    'profile' => $profile,
                    'specialties' => $categorias,
                    'facebook' => $facebook,
                    'instagram' => $instagram,
                    //'linkedin' => $linkedin,
                  //  'recipient_id' => $recipient_id,
                    'amount_to_pay' => $amount_to_pay,
                    
                );
            } else {
                //$error = array('error' => $this->upload->display_errors());
                $data = array();
                $data = array(
                    'name' => $name,
                    'email' => $email,
                    'address' => $address,
                    'phone' => $phone,
                 //   'profile' => $profile,
                    'cpf' => $cpf,
                 //   'cellphone' => $cellphone,
                    'postal_code' => $postal_code,
                    'country' => $country,
                    'state' => $state,
                    'city' => $city,
                    'district' => $district,
                    'address' => $address,
                    'complement' => $complement,
                    'number' => $number,
                    'date_of_birth' => $date_of_birth,
                    'biography' => $biography,
                    'profile' => $profile,
                    'specialties' => $categorias,
                    'facebook' => $facebook,
                    'instagram' => $instagram,
                   // 'linkedin' => $linkedin,
                  //  'recipient_id' => $recipient_id,
                    'amount_to_pay' => $amount_to_pay,

                    
                );
            }

            $username = $this->input->post('name');
            
            //var_dump($group_name);die;
            if (empty($password)) {
                $password = $this->db->get_where('users', array('id' => $ion_user_id))->row()->password;
            } else {
                $password = $this->ion_auth_model->hash_password($password);
            }
            $this->profile_model->updateIonUser($username, $email, $password, $ion_user_id);
            if (!$this->ion_auth->in_group('admin')) {
                $this->profile_model->updateProfile($ion_user_id, $data, $group_name);
            }
            $this->session->set_flashdata('feedback', lang('updated'));
            $data['feedback'] = (validation_errors()) ? validation_errors() : $this->session->flashdata('feedback');
           // var_dump( $data['feedback']);die;


            // Loading View
            redirect('profile');
        }
    }

}

/* End of file profile.php */
/* Location: ./application/modules/profile/controllers/profile.php */
