<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Teacher_model extends CI_model {

    function __construct() {
        parent::__construct();
        $this->load->database();
    }

    function insertTeacher($data) {
        $this->db->insert('teacher', $data);
    }

    function getTeacher() {
        $this->db->where('role_id', '2');
        $query = $this->db->get('users');
        return $query->result();
    }

    function getTeacherId() {
        $this->db->where('role_id', '2');
        $this->db->where('id', $id);
        $query = $this->db->get('users');
        return $query->result();
    }

    function getTeacherWithoutSearch($order, $dir) {
        $this->db->where('role_id', '2');
        if ($order != null) {
            $this->db->order_by($order, $dir);
        } else {
            $this->db->order_by('id', 'desc');
        }
        $query = $this->db->get('users');
        return $query->result();
    }

    function getTeacherBySearch($search, $order, $dir) {
        
        $this->db->where('status', 'active');

        $query = $this->db->get('teacher');
        return $query->result();
    }

    function getTeacherByLimit($limit, $start, $order, $dir) {
        if ($order != null) {
            $this->db->order_by($order, $dir);
        } else {
            $this->db->order_by('id', 'desc');
        }
        $this->db->limit($limit, $start);
        $query = $this->db->get('teacher');
        return $query->result();
    }

    function getTeacherByLimitBySearch($limit, $start, $search, $order, $dir) {

        $this->db->like('id', $search);

        if ($order != null) {
            $this->db->order_by($order, $dir);
        } else {
            $this->db->order_by('id', 'desc');
        }

        $this->db->or_like('name', $search);
        $this->db->or_like('phone', $search);
        $this->db->or_like('address', $search);
        $this->db->or_like('email', $search);
        $this->db->or_like('department', $search);

        $this->db->limit($limit, $start);
        $query = $this->db->get('teacher');
        return $query->result();
    }

    function getTeacherById($id) {
        $this->db->where('id', $id);
        $query = $this->db->get('teacher');
        return $query->row();
    }

    function getTeacherByIonUserId($id) {
        $this->db->where('ion_user_id', $id);
        $query = $this->db->get('teacher');
        return $query->row();
    }

    function updateTeacher($id, $data) {
        $this->db->where('id', $id);
        $this->db->update('teacher', $data);
    }

    function delete($id) {
        $this->db->where('id', $id);
        $this->db->delete('teacher');
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

    function getTeacherInfo($searchTerm) {
        if (!empty($searchTerm)) {
            $this->db->select('*');
            $this->db->where("name like '%" . $searchTerm . "%' ");
            $this->db->or_where("id like '%" . $searchTerm . "%' ");
            $fetched_records = $this->db->get('teacher');
            $users = $fetched_records->result_array();
        } else {
            $this->db->select('*');
            // $this->db->where("name like '%".$searchTerm."%' ");
            //  $this->db->or_where("id like '%".$searchTerm."%' ");
            $this->db->limit(10);
            $fetched_records = $this->db->get('teacher');
            $users = $fetched_records->result_array();
        }


        if ($this->ion_auth->in_group(array('Teacher'))) {
            $teacher_ion_id = $this->ion_auth->get_user_id();
            $this->db->select('*');
            $this->db->where('ion_user_id', $teacher_ion_id);
            $fetched_records = $this->db->get('teacher');
            $users = $fetched_records->result_array();
        }


        // Initialize Array with fetched data
        $data = array();
        foreach ($users as $user) {
            $data[] = array("id" => $user['id'], "text" => $user['name'] . ' (' . lang('id') . ': ' . $user['id'] . ')');
        }
        return $data;
    }

    function getTeacherWithAddNewOption($searchTerm) {
        if (!empty($searchTerm)) {
            $this->db->select('*');
            $this->db->where("name like '%" . $searchTerm . "%' ");
            $this->db->or_where("id like '%" . $searchTerm . "%' ");
            $fetched_records = $this->db->get('teacher');
            $users = $fetched_records->result_array();
        } else {
            $this->db->select('*');
            // $this->db->where("name like '%".$searchTerm."%' ");
            //  $this->db->or_where("id like '%".$searchTerm."%' ");
            $this->db->limit(10);
            $fetched_records = $this->db->get('teacher');
            $users = $fetched_records->result_array();
        }


        if ($this->ion_auth->in_group(array('Teacher'))) {
            $teacher_ion_id = $this->ion_auth->get_user_id();
            $this->db->select('*');
            $this->db->where('ion_user_id', $teacher_ion_id);
            $fetched_records = $this->db->get('teacher');
            $users = $fetched_records->result_array();
        }



        // Initialize Array with fetched data
        $data = array();
        $data[] = array("id" => 'add_new', "text" => lang('add_new'));
        foreach ($users as $user) {
            $data[] = array("id" => $user['id'], "text" => $user['name'] . ' (' . lang('id') . ': ' . $user['id'] . ')');
        }
        return $data;
    }

}
