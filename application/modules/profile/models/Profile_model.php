<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Profile_model extends CI_model {

    function __construct() {
        parent::__construct();
        $this->load->database();
    }

    function getProfileById($id) {
        $this->db->where('id', $id);
        $query = $this->db->get('users');
        return $query->row();
    }

    function updateProfile($id, $data, $group_name) {
        $this->db->where('ion_user_id', $id);
        $this->db->update($group_name, $data);
    }

    function updateIonUser($username, $email, $password, $ion_user_id) {
        $uptade_ion_user = array(
            'username' => $username,
            'email' => $email,
            'password' => $password
        );
        $this->db->where('id', $ion_user_id);
        $this->db->update('users', $uptade_ion_user);
    }

    function getUsersGroups($id) {
        $this->db->where('user_id', $id);
        $query = $this->db->get('users_groups');
        return $query;
    }

    function getGroups($group_id) {
        $this->db->where('id', $group_id);
        $query = $this->db->get('groups');
        return $query;
    }

    function updateDoctor($user_id) { 
               
               
        $data['first_name'] = html_escape($this->input->post('first_name'));
        $data['cpf'] = html_escape($this->input->post('cpf'));
        $data['phone'] = html_escape($this->input->post('telefone'));
        $data['cellphone'] = html_escape($this->input->post('cellphone'));
        $data['postal_code'] = html_escape($this->input->post('postal_code'));
        $data['country'] = sha1(html_escape($this->input->post('country')));
        $data['state'] = html_escape($this->input->post('state'));
        $data['city'] = html_escape($this->input->post('city'));
        $data['district'] = html_escape($this->input->post('district'));
        $data['address'] =  html_escape($this->input->post('address'));
        $data['complement'] = $this->input->post('complement');
        $data['date_of_birth'] = $this->input->post('date_of_birth');
        $data['biography'] = $this->input->post('biography');
        $data['crp'] = $this->input->post('crp');
        $data['number'] =  html_escape($this->input->post('number'));        
        $data['specialties'] = serialize($array  = explode(',', $this->input->post('specialties')));
        $data['facebook'] = html_escape($this->input->post('facebook'));
        $data['instagram'] = html_escape($this->input->post('instagram'));
        $data['linkedin'] = html_escape($this->input->post('linkedin'));
       // $data['password'] = $this->input->post('password');
        if (isset($_POST['email'])) {
            $data['email'] = html_escape($this->input->post('email'));
        }     
                
        $data['last_modified'] = strtotime(date("Y-m-d H:i:s")); 

        $this->db->where('ion_user_id', $user_id);
        $this->db->update('doctor', $data);
        $this->upload_user_image($user_id);           

    }

   

public function upload_user_image($user_id) {
    if (isset($_FILES['user_image']) && $_FILES['user_image']['name'] != "") {
        move_uploaded_file($_FILES['user_image']['tmp_name'], 'uploads/user_image/'.$user_id.'.jpg');
        $this->session->set_flashdata('flash_message', get_phrase('user_update_successfully'));
    }

}
}
