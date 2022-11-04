<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Appointment_model extends CI_model {

    function __construct() {
        parent::__construct();
        $this->load->database();
    }

    function insertAppointment($data) {

        $this->db->insert('appointment', $data);
    }

    function getAppointment() {
        $this->db->order_by('id', 'desc');
        $query = $this->db->get('appointment');
        return $query->result();
    }
    
    function getAppointmentWithoutSearch($order, $dir) {
        if ($order != null) {
            $this->db->order_by($order, $dir);
        } else {
            $this->db->order_by('id', 'desc');
        }
        $query = $this->db->get('appointment');
        return $query->result();
    }

    function getAppointmentBySearch($search, $order, $dir) {
        if ($order != null) {
            $this->db->order_by($order, $dir);
        } else {
            $this->db->order_by('id', 'desc');
        }
        $this->db->like('id', $search);
        $this->db->or_like('app_time_full_format', $search);
        $this->db->or_like('clientname', $search);
        $this->db->or_like('teachername', $search);
        $query = $this->db->get('appointment');
        return $query->result();
    }

    function getAppointmentByLimit($limit, $start, $order, $dir) {
        if ($order != null) {
            $this->db->order_by($order, $dir);
        } else {
            $this->db->order_by('id', 'desc');
        }
        $this->db->limit($limit, $start);
        $query = $this->db->get('appointment');
        return $query->result();
    }

    function getAppointmentByLimitBySearch($limit, $start, $search, $order, $dir) {

        $this->db->like('id', $search);

        if ($order != null) {
            $this->db->order_by($order, $dir);
        } else {
            $this->db->order_by('id', 'desc');
        }

        $this->db->or_like('app_time_full_format', $search);
        $this->db->or_like('clientname', $search);
        $this->db->or_like('teachername', $search);

        $this->db->limit($limit, $start);
        $query = $this->db->get('appointment');
        return $query->result();
    }

    function getAppointmentForCalendar() {
        $this->db->order_by('id', 'asc');
        $query = $this->db->get('appointment');
        return $query->result();
    }

    function getAppointmentByTeacher($teacher) {
        $this->db->order_by('id', 'desc');
        $this->db->where('teacher', $teacher);
        $query = $this->db->get('appointment');
        return $query->result();
    }

    function getAppointmentRequest() {
        $this->db->order_by('id', 'desc');
        $this->db->where('request', 'Yes');
        $query = $this->db->get('appointment');
        return $query->result();
    }

    function getAppointmentRequestByTeacher($teacher) {
        $this->db->where('request', 'Yes');
        $this->db->where('teacher', $teacher);
        $query = $this->db->get('appointment');
        return $query->result();
    }

    function getAppointmentClientByTeacher($clientId, $teacherId) {
        $this->db->where('client', $clientId);
        $this->db->where('teacher', $teacherId);
        $query = $this->db->get('appointment');
        return $query->result();
    }

    function getAppointmentByClient($client) {
        $this->db->order_by('id', 'desc');
        $this->db->where('client', $client);
        $query = $this->db->get('appointment');
        return $query->result();
    }

    function getAppointmentByStatus($status) {
        $this->db->order_by('id', 'desc');
        $this->db->where('status', $status);
        $query = $this->db->get('appointment');
        return $query->result();
    }

    function getAppointmentByStatusByTeacher($status, $teacher) {
        $this->db->order_by('id', 'desc');
        $this->db->where('status', $status);
        $this->db->where('teacher', $teacher);
        $query = $this->db->get('appointment');
        return $query->result();
    }

    function getAppointmentById($id) {
        $this->db->where('id', $id);
        $query = $this->db->get('appointment');
        return $query->row();
    }

    function getAppointmentByDate($date_from, $date_to) {
        $this->db->select('*');
        $this->db->from('appointment');
        $this->db->where('date >=', $date_from);
        $this->db->where('date <=', $date_to);
        $query = $this->db->get();
        return $query->result();
    }

    function getAppointmentByTeacherByToday($teacher_id) {
        $today = strtotime(date('Y-m-d'));
        $this->db->where('teacher', $teacher_id);
        $this->db->where('date', $today);
        $query = $this->db->get('appointment');
        return $query->result();
    }

    function updateAppointment($id, $data) {
        $this->db->where('id', $id);
        $this->db->update('appointment', $data);
    }

    function delete($id) {
        $this->db->where('id', $id);
        $this->db->delete('appointment');
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

    function getRequestAppointment() {
        $this->db->order_by('id', 'desc');
        $this->db->where('status', 'Requested');
        $query = $this->db->get('appointment');
        return $query->result();
    }
    
    function getRequestAppointmentWithoutSearch($order, $dir) {
       if ($order != null) {
            $this->db->order_by($order, $dir);
        } else {
            $this->db->order_by('id', 'desc');
        }
        $this->db->where('status', 'Requested');
        $query = $this->db->get('appointment');
        return $query->result();
    }

    function getRequestAppointmentBySearch($search, $order, $dir) {
       if ($order != null) {
            $this->db->order_by($order, $dir);
        } else {
            $this->db->order_by('id', 'desc');
        }
        $this->db->where('status', 'Requested');
        $this->db->like('id', $search);
        $this->db->or_like('app_time_full_format', $search);
        $this->db->or_like('clientname', $search);
        $this->db->or_like('teachername', $search);
        $query = $this->db->get('appointment');
        return $query->result();
    }

    function getRequestAppointmentByLimit($limit, $start, $order, $dir) {
        if ($order != null) {
            $this->db->order_by($order, $dir);
        } else {
            $this->db->order_by('id', 'desc');
        }
        $this->db->where('status', 'Requested');
        $this->db->limit($limit, $start);
        $query = $this->db->get('appointment');
        return $query->result();
    }

    function getRequestAppointmentByLimitBySearch($limit, $start, $search, $order, $dir) {
        $this->db->where('status', 'Requested');
        $this->db->like('id', $search);

       if ($order != null) {
            $this->db->order_by($order, $dir);
        } else {
            $this->db->order_by('id', 'desc');
        }

        $this->db->or_like('app_time_full_format', $search);
        $this->db->or_like('clientname', $search);
        $this->db->or_like('teachername', $search);

        $this->db->limit($limit, $start);
        $query = $this->db->get('appointment');
        return $query->result();
    }

    function getPendingAppointment() {
        $this->db->order_by('id', 'desc');
        $this->db->where('status', 'Pending Confirmation');
        $query = $this->db->get('appointment');
        return $query->result();
    }
    
    function getPendingAppointmentWithoutSearch($order, $dir) {
        if ($order != null) {
            $this->db->order_by($order, $dir);
        } else {
            $this->db->order_by('id', 'desc');
        }
        $this->db->where('status', 'Pending Confirmation');
        $query = $this->db->get('appointment');
        return $query->result();
    }

    function getPendingAppointmentBySearch($search, $order, $dir) {
        if ($order != null) {
            $this->db->order_by($order, $dir);
        } else {
            $this->db->order_by('id', 'desc');
        }
        $this->db->where('status', 'Pending Confirmation');
        $this->db->like('id', $search);
        $this->db->or_like('app_time_full_format', $search);
        $this->db->or_like('clientname', $search);
        $this->db->or_like('teachername', $search);
        $query = $this->db->get('appointment');
        return $query->result();
    }

    function getPendingAppointmentByLimit($limit, $start, $order, $dir) {
        if ($order != null) {
            $this->db->order_by($order, $dir);
        } else {
            $this->db->order_by('id', 'desc');
        }
        $this->db->where('status', 'Pending Confirmation');
        $this->db->limit($limit, $start);
        $query = $this->db->get('appointment');
        return $query->result();
    }

    function getPendingAppointmentByLimitBySearch($limit, $start, $search, $order, $dir) {
        $this->db->where('status', 'Pending Confirmation');
        $this->db->like('id', $search);

        if ($order != null) {
            $this->db->order_by($order, $dir);
        } else {
            $this->db->order_by('id', 'desc');
        }

        $this->db->or_like('app_time_full_format', $search);
        $this->db->or_like('clientname', $search);
        $this->db->or_like('teachername', $search);

        $this->db->limit($limit, $start);
        $query = $this->db->get('appointment');
        return $query->result();
    }

    function getConfirmedAppointment() {
        $this->db->order_by('id', 'desc');
        $this->db->where('status', 'Confirmed');
        $query = $this->db->get('appointment');
        return $query->result();
    }
    
    function getConfirmedAppointmentWithoutSearch($order, $dir) {
        if ($order != null) {
            $this->db->order_by($order, $dir);
        } else {
            $this->db->order_by('id', 'desc');
        }
        $this->db->where('status', 'Confirmed');
        $query = $this->db->get('appointment');
        return $query->result();
    }

    function getConfirmedAppointmentBySearch($search, $order, $dir) {
       if ($order != null) {
            $this->db->order_by($order, $dir);
        } else {
            $this->db->order_by('id', 'desc');
        }
        $this->db->where('status', 'Confirmed');
        $this->db->like('id', $search);
        $this->db->or_like('app_time_full_format', $search);
        $this->db->or_like('clientname', $search);
        $this->db->or_like('teachername', $search);
        $query = $this->db->get('appointment');
        return $query->result();
    }

    function getConfirmedAppointmentByLimit($limit, $start, $order, $dir) {
        if ($order != null) {
            $this->db->order_by($order, $dir);
        } else {
            $this->db->order_by('id', 'desc');
        }
        $this->db->where('status', 'Confirmed');
        $this->db->limit($limit, $start);
        $query = $this->db->get('appointment');
        return $query->result();
    }

    function getConfirmedAppointmentByLimitBySearch($limit, $start, $search, $order, $dir) {
        $this->db->where('status', 'Confirmed');
        $this->db->like('id', $search);

        if ($order != null) {
            $this->db->order_by($order, $dir);
        } else {
            $this->db->order_by('id', 'desc');
        }

        $this->db->or_like('app_time_full_format', $search);
        $this->db->or_like('clientname', $search);
        $this->db->or_like('teachername', $search);

        $this->db->limit($limit, $start);
        $query = $this->db->get('appointment');
        return $query->result();
    }

    function getTreatedAppointment() {
        $this->db->order_by('id', 'desc');
        $this->db->where('status', 'Treated');
        $query = $this->db->get('appointment');
        return $query->result();
    }
    
     function getTreatedAppointmentWithoutSearch($order, $dir) {
       if ($order != null) {
            $this->db->order_by($order, $dir);
        } else {
            $this->db->order_by('id', 'desc');
        }
        $this->db->where('status', 'Treated');
        $query = $this->db->get('appointment');
        return $query->result();
    }

    function getTreatedAppointmentBySearch($search, $order, $dir) {
        if ($order != null) {
            $this->db->order_by($order, $dir);
        } else {
            $this->db->order_by('id', 'desc');
        }
        $this->db->where('status', 'Treated');
        $this->db->like('id', $search);
        $this->db->or_like('app_time_full_format', $search);
        $this->db->or_like('clientname', $search);
        $this->db->or_like('teachername', $search);
        $query = $this->db->get('appointment');
        return $query->result();
    }

    function getTreatedAppointmentByLimit($limit, $start, $order, $dir) {
        if ($order != null) {
            $this->db->order_by($order, $dir);
        } else {
            $this->db->order_by('id', 'desc');
        }
        $this->db->where('status', 'Treated');
        $this->db->limit($limit, $start);
        $query = $this->db->get('appointment');
        return $query->result();
    }

    function getTreatedAppointmentByLimitBySearch($limit, $start, $search, $order, $dir) {
        $this->db->where('status', 'Treated');
        $this->db->like('id', $search);

        if ($order != null) {
            $this->db->order_by($order, $dir);
        } else {
            $this->db->order_by('id', 'desc');
        }

        $this->db->or_like('app_time_full_format', $search);
        $this->db->or_like('clientname', $search);
        $this->db->or_like('teachername', $search);

        $this->db->limit($limit, $start);
        $query = $this->db->get('appointment');
        return $query->result();
    }

    function getCancelledAppointment() {
        $this->db->order_by('id', 'desc');
        $this->db->where('status', 'Cancelled');
        $query = $this->db->get('appointment');
        return $query->result();
    }
    
    function getCancelledAppointmentWithoutSearch($order, $dir) {
        if ($order != null) {
            $this->db->order_by($order, $dir);
        } else {
            $this->db->order_by('id', 'desc');
        }
        $this->db->where('status', 'Cancelled');
        $query = $this->db->get('appointment');
        return $query->result();
    }

    function getCancelledAppointmentBySearch($search, $order, $dir) {
        if ($order != null) {
            $this->db->order_by($order, $dir);
        } else {
            $this->db->order_by('id', 'desc');
        }
        $this->db->where('status', 'Cancelled');
        $this->db->like('id', $search);
        $this->db->or_like('app_time_full_format', $search);
        $this->db->or_like('clientname', $search);
        $this->db->or_like('teachername', $search);
        $query = $this->db->get('appointment');
        return $query->result();
    }

    function getCancelledAppointmentByLimit($limit, $start, $order, $dir) {
        if ($order != null) {
            $this->db->order_by($order, $dir);
        } else {
            $this->db->order_by('id', 'desc');
        }
        $this->db->where('status', 'Cancelled');
        $this->db->limit($limit, $start);
        $query = $this->db->get('appointment');
        return $query->result();
    }

    function getCancelledAppointmentByLimitBySearch($limit, $start, $search, $order, $dir) {
        $this->db->where('status', 'Cancelled');
        $this->db->like('id', $search);

        if ($order != null) {
            $this->db->order_by($order, $dir);
        } else {
            $this->db->order_by('id', 'desc');
        }

        $this->db->or_like('app_time_full_format', $search);
        $this->db->or_like('clientname', $search);
        $this->db->or_like('teachername', $search);

        $this->db->limit($limit, $start);
        $query = $this->db->get('appointment');
        return $query->result();
    }

    function getAppointmentListByTeacher($teacher) {
        $this->db->where('teacher', $teacher);
        $this->db->order_by('id', 'desc');
        $query = $this->db->get('appointment');
        return $query->result();
    }
    
    function getAppointmentListByTeacherWithoutSearch($teacher, $order, $dir) {
        $this->db->where('teacher', $teacher);
        if ($order != null) {
            $this->db->order_by($order, $dir);
        } else {
            $this->db->order_by('id', 'desc');
        }
        $query = $this->db->get('appointment');
        return $query->result();
    }

    function getAppointmentListBySearchByTeacher($teacher, $search, $order, $dir) {
        $this->db->where('teacher', $teacher);
        if ($order != null) {
            $this->db->order_by($order, $dir);
        } else {
            $this->db->order_by('id', 'desc');
        }
        $this->db->like('id', $search);
        $this->db->or_like('app_time_full_format', $search);
        $this->db->or_like('clientname', $search);
        $this->db->or_like('teachername', $search);
        $query = $this->db->get('appointment');
        return $query->result();
    }

    function getAppointmentListByLimitByTeacher($teacher, $limit, $start, $order, $dir) {
        $this->db->where('teacher', $teacher);
        if ($order != null) {
            $this->db->order_by($order, $dir);
        } else {
            $this->db->order_by('id', 'desc');
        }
        $this->db->limit($limit, $start);
        $query = $this->db->get('appointment');
        return $query->result();
    }

    function getAppointmentListByLimitBySearchByTeacher($teacher, $limit, $start, $search, $order, $dir) {
        $this->db->where('teacher', $teacher);

        $this->db->like('id', $search);

        if ($order != null) {
            $this->db->order_by($order, $dir);
        } else {
            $this->db->order_by('id', 'desc');
        }

        $this->db->or_like('app_time_full_format', $search);
        $this->db->or_like('clientname', $search);
        $this->db->or_like('teachername', $search);

        $this->db->limit($limit, $start);
        $query = $this->db->get('appointment');
        return $query->result();
    }

    function getRequestAppointmentByTeacher($teacher) {
        $this->db->order_by('id', 'desc');
        $this->db->where('status', 'Requested');
        $this->db->where('teacher', $teacher);
        $query = $this->db->get('appointment');
        return $query->result();
    }
    
    function getRequestAppointmentByTeacherWithoutSearch($teacher, $order, $dir) {
        if ($order != null) {
            $this->db->order_by($order, $dir);
        } else {
            $this->db->order_by('id', 'desc');
        }
        $this->db->where('status', 'Requested');
        $this->db->where('teacher', $teacher);
        $query = $this->db->get('appointment');
        return $query->result();
    }

    function getRequestAppointmentBySearchByTeacher($teacher, $search, $order, $dir) {
        if ($order != null) {
            $this->db->order_by($order, $dir);
        } else {
            $this->db->order_by('id', 'desc');
        }
        $query = $this->db->select('*')
                ->from('appointment')
                ->where('status', 'Requested')
                ->where('teacher', $teacher)
                ->where("(id LIKE '%" . $search . "%' OR app_time_full_format LIKE '%" . $search . "%' OR clientname LIKE '%" . $search . "%' OR teachername LIKE '%" . $search . "%')", NULL, FALSE)
                ->get();
        return $query->result();
    }

    function getRequestAppointmentByLimitByTeacher($teacher, $limit, $start, $order, $dir) {
        if ($order != null) {
            $this->db->order_by($order, $dir);
        } else {
            $this->db->order_by('id', 'desc');
        }
        $this->db->where('status', 'Requested');
        $this->db->where('teacher', $teacher);
        $this->db->limit($limit, $start);
        $query = $this->db->get('appointment');
        return $query->result();
    }

    function getRequestAppointmentByLimitBySearchByTeacher($teacher, $limit, $start, $search, $order, $dir) {

       if ($order != null) {
            $this->db->order_by($order, $dir);
        } else {
            $this->db->order_by('id', 'desc');
        }
        $this->db->limit($limit, $start);
        $query = $this->db->select('*')
                ->from('appointment')
                ->where('status', 'Requested')
                ->where('teacher', $teacher)
                ->where("(id LIKE '%" . $search . "%' OR app_time_full_format LIKE '%" . $search . "%' OR clientname LIKE '%" . $search . "%' OR teachername LIKE '%" . $search . "%')", NULL, FALSE)
                ->get();
        return $query->result();
    }

    function getCancelledAppointmentByTeacher($teacher) {
        $this->db->order_by('id', 'desc');
        $this->db->where('status', 'Cancelled');
        $this->db->where('teacher', $teacher);
        $query = $this->db->get('appointment');
        return $query->result();
    }
    
    function getCancelledAppointmentByTeacherWithoutSearch($teacher, $order, $dir) {
        if ($order != null) {
            $this->db->order_by($order, $dir);
        } else {
            $this->db->order_by('id', 'desc');
        }
        $this->db->where('status', 'Cancelled');
        $this->db->where('teacher', $teacher);
        $query = $this->db->get('appointment');
        return $query->result();
    }

    function getCancelledAppointmentBySearchByTeacher($teacher, $search, $order, $dir) {
        if ($order != null) {
            $this->db->order_by($order, $dir);
        } else {
            $this->db->order_by('id', 'desc');
        }
        $query = $this->db->select('*')
                ->from('appointment')
                ->where('status', 'Cancelled')
                ->where('teacher', $teacher)
                ->where("(id LIKE '%" . $search . "%' OR app_time_full_format LIKE '%" . $search . "%' OR clientname LIKE '%" . $search . "%' OR teachername LIKE '%" . $search . "%')", NULL, FALSE)
                ->get();
        return $query->result();
    }

    function getCancelledAppointmentByLimitByTeacher($teacher, $limit, $start, $order, $dir) {
        if ($order != null) {
            $this->db->order_by($order, $dir);
        } else {
            $this->db->order_by('id', 'desc');
        }
        $this->db->where('status', 'Cancelled');
        $this->db->where('teacher', $teacher);
        $this->db->limit($limit, $start);
        $query = $this->db->get('appointment');
        return $query->result();
    }

    function getCancelledAppointmentByLimitBySearchByTeacher($teacher, $limit, $start, $search, $order, $dir) {

        if ($order != null) {
            $this->db->order_by($order, $dir);
        } else {
            $this->db->order_by('id', 'desc');
        }
        $this->db->limit($limit, $start);
        $query = $this->db->select('*')
                ->from('appointment')
                ->where('status', 'Cancelled')
                ->where('teacher', $teacher)
                ->where("(id LIKE '%" . $search . "%' OR app_time_full_format LIKE '%" . $search . "%' OR clientname LIKE '%" . $search . "%' OR teachername LIKE '%" . $search . "%')", NULL, FALSE)
                ->get();
        return $query->result();
    }

    function getPendingAppointmentByTeacher($teacher) {
        $this->db->order_by('id', 'desc');
        $this->db->where('status', 'Pending Confirmation');
        $this->db->where('teacher', $teacher);
        $query = $this->db->get('appointment');
        return $query->result();
    }
    
     function getPendingAppointmentByTeacherWithoutSearch($teacher, $order, $dir) {
        if ($order != null) {
            $this->db->order_by($order, $dir);
        } else {
            $this->db->order_by('id', 'desc');
        }
        $this->db->where('status', 'Pending Confirmation');
        $this->db->where('teacher', $teacher);
        $query = $this->db->get('appointment');
        return $query->result();
    }

    function getPendingAppointmentBySearchByTeacher($teacher, $search, $order, $dir) {
       if ($order != null) {
            $this->db->order_by($order, $dir);
        } else {
            $this->db->order_by('id', 'desc');
        }
        $query = $this->db->select('*')
                ->from('appointment')
                ->where('status', 'Pending Confirmation')
                ->where('teacher', $teacher)
                ->where("(id LIKE '%" . $search . "%' OR app_time_full_format LIKE '%" . $search . "%' OR clientname LIKE '%" . $search . "%' OR teachername LIKE '%" . $search . "%')", NULL, FALSE)
                ->get();
        return $query->result();
    }

    function getPendingAppointmentByLimitByTeacher($teacher, $limit, $start, $order, $dir) {
        if ($order != null) {
            $this->db->order_by($order, $dir);
        } else {
            $this->db->order_by('id', 'desc');
        }
        $this->db->where('status', 'Pending Confirmation');
        $this->db->where('teacher', $teacher);
        $this->db->limit($limit, $start);
        $query = $this->db->get('appointment');
        return $query->result();
    }

    function getPendingAppointmentByLimitBySearchByTeacher($teacher, $limit, $start, $search, $order, $dir) {

       if ($order != null) {
            $this->db->order_by($order, $dir);
        } else {
            $this->db->order_by('id', 'desc');
        }
        $this->db->limit($limit, $start);
        $query = $this->db->select('*')
                ->from('appointment')
                ->where('status', 'Pending Confirmation')
                ->where('teacher', $teacher)
                ->where("(id LIKE '%" . $search . "%' OR app_time_full_format LIKE '%" . $search . "%' OR clientname LIKE '%" . $search . "%' OR teachername LIKE '%" . $search . "%')", NULL, FALSE)
                ->get();
        return $query->result();
    }

    function getTreatedAppointmentByTeacher($teacher) {
        $this->db->order_by('id', 'desc');
        $this->db->where('status', 'Treated');
        $this->db->where('teacher', $teacher);
        $query = $this->db->get('appointment');
        return $query->result();
    }
    
     function getTreatedAppointmentByTeacherWithoutSearch($teacher, $order, $dir) {
        if ($order != null) {
            $this->db->order_by($order, $dir);
        } else {
            $this->db->order_by('id', 'desc');
        }
        $this->db->where('status', 'Treated');
        $this->db->where('teacher', $teacher);
        $query = $this->db->get('appointment');
        return $query->result();
    }

    function getTreatedAppointmentBySearchByTeacher($teacher, $search, $order, $dir) {
       if ($order != null) {
            $this->db->order_by($order, $dir);
        } else {
            $this->db->order_by('id', 'desc');
        }
        $query = $this->db->select('*')
                ->from('appointment')
                ->where('status', 'Treated')
                ->where('teacher', $teacher)
                ->where("(id LIKE '%" . $search . "%' OR app_time_full_format LIKE '%" . $search . "%' OR clientname LIKE '%" . $search . "%' OR teachername LIKE '%" . $search . "%')", NULL, FALSE)
                ->get();
        return $query->result();
    }

    function getTreatedAppointmentByLimitByTeacher($teacher, $limit, $start, $order, $dir) {
        if ($order != null) {
            $this->db->order_by($order, $dir);
        } else {
            $this->db->order_by('id', 'desc');
        }
        $this->db->where('status', 'Treated');
        $this->db->where('teacher', $teacher);
        $this->db->limit($limit, $start);
        $query = $this->db->get('appointment');
        return $query->result();
    }

    function getTreatedAppointmentByLimitBySearchByTeacher($teacher, $limit, $start, $search, $order, $dir) {

        if ($order != null) {
            $this->db->order_by($order, $dir);
        } else {
            $this->db->order_by('id', 'desc');
        }
        $this->db->limit($limit, $start);
        $query = $this->db->select('*')
                ->from('appointment')
                ->where('status', 'Treated')
                ->where('teacher', $teacher)
                ->where("(id LIKE '%" . $search . "%' OR app_time_full_format LIKE '%" . $search . "%' OR clientname LIKE '%" . $search . "%' OR teachername LIKE '%" . $search . "%')", NULL, FALSE)
                ->get();
        return $query->result();
    }

    function getConfirmedAppointmentByTeacher($teacher) {
        $this->db->order_by('id', 'desc');
        $this->db->where('status', 'Confirmed');
        $this->db->where('teacher', $teacher);
        $query = $this->db->get('appointment');
        return $query->result();
    }
    
    function getConfirmedAppointmentByTeacherWithoutSearch($teacher, $order, $dir) {
       if ($order != null) {
            $this->db->order_by($order, $dir);
        } else {
            $this->db->order_by('id', 'desc');
        }
        $this->db->where('status', 'Confirmed');
        $this->db->where('teacher', $teacher);
        $query = $this->db->get('appointment');
        return $query->result();
    }

    function getConfirmedAppointmentBySearchByTeacher($teacher, $search, $order, $dir) {
        if ($order != null) {
            $this->db->order_by($order, $dir);
        } else {
            $this->db->order_by('id', 'desc');
        }
        $query = $this->db->select('*')
                ->from('appointment')
                ->where('status', 'Confirmed')
                ->where('teacher', $teacher)
                ->where("(id LIKE '%" . $search . "%' OR app_time_full_format LIKE '%" . $search . "%' OR clientname LIKE '%" . $search . "%' OR teachername LIKE '%" . $search . "%')", NULL, FALSE)
                ->get();
        return $query->result();
    }

    function getConfirmedAppointmentByLimitByTeacher($teacher, $limit, $start, $order, $dir) {
        if ($order != null) {
            $this->db->order_by($order, $dir);
        } else {
            $this->db->order_by('id', 'desc');
        }
        $this->db->where('status', 'Confirmed');
        $this->db->where('teacher', $teacher);
        $this->db->limit($limit, $start);
        $query = $this->db->get('appointment');
        return $query->result();
    }

    function getConfirmedAppointmentByLimitBySearchByTeacher($teacher, $limit, $start, $search, $order, $dir) {

       if ($order != null) {
            $this->db->order_by($order, $dir);
        } else {
            $this->db->order_by('id', 'desc');
        }
        $this->db->limit($limit, $start);
        $query = $this->db->select('*')
                ->from('appointment')
                ->where('status', 'Confirmed')
                ->where('teacher', $teacher)
                ->where("(id LIKE '%" . $search . "%' OR app_time_full_format LIKE '%" . $search . "%' OR clientname LIKE '%" . $search . "%' OR teachername LIKE '%" . $search . "%')", NULL, FALSE)
                ->get();
        return $query->result();
    }

}
