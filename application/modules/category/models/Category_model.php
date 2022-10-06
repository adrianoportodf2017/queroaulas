<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Category_model extends CI_model {

    function __construct() {
        parent::__construct();
        $this->load->database();
    }


    function getCategory() {
        $this->db->order_by('id', 'asc');
        $this->db->where('sub_category', '0');
        $this->db->where('active', '1');
        $query = $this->db->get('category');
        return $query->result();
    }

    function getSubCategory($id) {
        $this->db->order_by('id', 'asc');
        $this->db->where('sub_category', '1');
        $this->db->where('parent', $id);
        $this->db->where('active', '1' );
        $query = $this->db->get('category');
        return $query->result();
    }

    function insertPlans($data) {
        $this->db->insert('plans', $data);
    }

    function updatePlans($id, $data) {
        $this->db->where('id', $id);
        $this->db->update('plans', $data);
    }

    function delete($id) {
        $this->db->where('id', $id);
        $this->db->delete('plans');
    }


    function getPaymentGatewaySettingsById($id) {
        $this->db->where('id', $id);
        $query = $this->db->get('paymentGateway');
        return $query->row();
    }
    
     function getPaymentGatewaySettingsByName($name) {
        $this->db->where('name', $name);
        $query = $this->db->get('paymentGateway');
        return $query->row();
    }

    function getPaymentGatewayByUser($user) {
        $this->db->order_by('id', 'desc');
        $this->db->where('user', $user);
        $query = $this->db->get('paymentGateway');
        return $query->result();
    }

    function getPaymentGatewaySettings() {
        $query = $this->db->get('paymentGateway');
        return $query->row();
    }

    

    
    function insertPaymentGateway($data) {
        $this->db->insert('paymentGateway', $data);
    }

    

    function getPlansWithoutSearch($order, $dir) {
        if ($order != null) {
            $this->db->order_by($order, $dir);
        } else {
            $this->db->order_by('id', 'desc');
        }
        $query = $this->db->get('plans');
        return $query->result();
    }

    function getPlansBySearch($search, $order, $dir) {
        if ($order != null) {
            $this->db->order_by($order, $dir);
        } else {
            $this->db->order_by('id', 'desc');
        }
        $this->db->like('id', $search);
        $this->db->or_like('title', $search);
        $this->db->or_like('description', $search);
        $query = $this->db->get('plans');
        return $query->result();
    }

    
    function getPlansByLimitBySearch($limit, $start, $search, $order, $dir) {
        if ($order != null) {
            $this->db->order_by($order, $dir);
        } else {
            $this->db->order_by('id', 'desc');
        }
        $this->db->like('id', $search);
        $this->db->or_like('title', $search);
        $this->db->or_like('description', $search);

        $this->db->limit($limit, $start);
        $query = $this->db->get('plans');
        return $query->result();
    }

    function getPlansByLimit($limit, $start, $order, $dir) {
        if ($order != null) {
            $this->db->order_by($order, $dir);
        } else {
            $this->db->order_by('id', 'desc');
        }
        $this->db->limit($limit, $start);
        $query = $this->db->get('plans');
        return $query->result();
    }

}
