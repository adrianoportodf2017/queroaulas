<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Schedule_model extends CI_model
{

    function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    function getSchedule()
    {
        $query = $this->db->get('time_schedule');
        return $query->result();
    }

    function getAvailableteacherByDate($date)
    {

        $weekday = strftime("%A", $date);
        $this->db->where('date', $date);
        $query1 = $this->db->get('holidays')->result();
        if (!empty($query1)) {
            $teacher = array();
            foreach ($query1 as $q1) {
                $teacher[] = $q1->teacher;
            }
            $this->db->where_not_in('id', $staff);
        }

        $query = $this->db->get('teacher')->result();
        foreach ($query as $availableteacher) {
            $this->db->where('teacher', $availableteacher->id);
            $this->db->where('weekday', $weekday);
            $query_slot = $this->db->get('time_slot')->result();

            if (!empty($query_slot)) {
                $teacher_avail[] = $availableteacher->id;
            }
        }
        $this->db->where_in('id', $teacher_avail);
        $query_avail_teacher = $this->db->get('teacher');
        return $query_avail_teacher->result();
    }

    function getAvailableteachersByDateBySlot($date, $slot)
    {

        $weekday = strftime("%A", $date);
        $this->db->where('date', $date);
        $query1 = $this->db->get('holidays')->result();
        if (!empty($query1)) {
            $teacher = array();
            foreach ($query1 as $q1) {
                $teacher[] = $q1->teacher;
            }
            $this->db->where_not_in('id', $teacher);
        }

        $query = $this->db->get('teacher')->result();
        foreach ($query as $availableteacher) {
            $this->db->where('teacher', $availableteacher->id);
            $this->db->where('weekday', $weekday);
            $query_slot = $this->db->get('time_slot')->result();

            if (!empty($query_slot)) {
                $teacher_avail[] = $availableteacher->id;
            }
        }

        foreach ($teacher_avail as $key => $value) {
            $this->db->where('teacher', $value);
            $this->db->where('date', $date);
            $this->db->where('time_slot', $slot);
            $query_appointment = $this->db->get('appointment')->result();

            if (empty($query_appointment)) {
                $most_probable_avail_teacher[] = $value;
            }
        }
        $this->db->where_in('id', $most_probable_avail_teacher);
        $query_avail_teacher = $this->db->get('staff');
        return $query_avail_teacher->result();
    }

    function getAvailableSlotByteacherByDate($date, $teacher)
    {
        //$newDate = date("m-d-Y", strtotime($date));
        $weekday = strftime("%A", $date);

        $this->db->where('date', $date);
        $this->db->where('teacher', $teacher);
        $holiday = $this->db->get('holidays')->result();

        if (empty($holiday)) {
            $this->db->where('date', $date);
            $this->db->where('teacher', $teacher);
            $query = $this->db->get('appointment')->result();


            $this->db->where('teacher', $teacher);
            $this->db->where('weekday', $weekday);
            $this->db->order_by('s_time_key', 'asc');
            $query1 = $this->db->get('time_slot')->result();

            $availabletimeSlot = array();
            $bookedTimeSlot = array();

            foreach ($query1 as $timeslot) {
                $availabletimeSlot[] = $timeslot->s_time . ' To ' . $timeslot->e_time;
            }
            foreach ($query as $bookedTime) {
                if ($bookedTime->status != 'Cancelled') {
                    $bookedTimeSlot[] = $bookedTime->time_slot;
                }
            }

            $availableSlot = array_diff($availabletimeSlot, $bookedTimeSlot);
        } else {
            $availableSlot = array();
        }

        return $availableSlot;
    }

    function getAvailableSlotByteacherByDateByAppointmentId($date, $teacher, $appointment_id)
    {
        //$newDate = date("m-d-Y", strtotime($date));
        $weekday = strftime("%A", $date);

        $this->db->where('date', $date);
        $this->db->where('teacher', $teacher);
        $holiday = $this->db->get('holidays')->result();

        if (empty($holiday)) {

            $this->db->where('date', $date);
            $this->db->where('teacher', $teacher);
            $query = $this->db->get('appointment')->result();


            $this->db->where('teacher', $teacher);
            $this->db->where('weekday', $weekday);
            $this->db->order_by('s_time_key', 'asc');
            $query1 = $this->db->get('time_slot')->result();

            $availabletimeSlot = array();
            $bookedTimeSlot = array();

            foreach ($query1 as $timeslot) {
                $availabletimeSlot[] = $timeslot->s_time . ' To ' . $timeslot->e_time;
            }
            foreach ($query as $bookedTime) {
                if ($bookedTime->status != 'Cancelled') {
                    if ($bookedTime->id != $appointment_id) {
                        $bookedTimeSlot[] = $bookedTime->time_slot;
                    }
                }
            }

            $availableSlot = array_diff($availabletimeSlot, $bookedTimeSlot);
        } else {
            $availableSlot = array();
        }

        return $availableSlot;
    }

    function updateIonUser($username, $email, $password, $ion_user_id)
    {
        $uptade_ion_user = array(
            'username' => $username,
            'email' => $email,
            'password' => $password
        );
        $this->db->where('id', $ion_user_id);
        $this->db->update('users', $uptade_ion_user);
    }

    function getteacherByIonUserId($id)
    {
        $this->db->where('ion_user_id', $id);
        $query = $this->db->get('teacher');
        return $query->row();
    }

    function insertTimeSlot($data)
    {
        $this->db->insert('time_slot', $data);
    }

    function getTimeSlot()
    {
        $query = $this->db->get('time_slot');
        return $query->result();
    }

    function getTimeSlotById($id)
    {
        $this->db->where('id', $id);
        $query = $this->db->get('time_slot');
        return $query->row();
    }

    function getTimeSlotByteacher($id)
    {
        $this->db->order_by('s_time_key', 'asc');
        $this->db->where('teacher', $id);
        $query = $this->db->get('time_slot');
        return $query->result();
    }

    function updateTimeSlot($id, $data)
    {
        $this->db->where('id', $id);
        $this->db->update('time_slot', $data);
    }

    function deleteTimeSlot($id)
    {
        $this->db->where('id', $id);
        $this->db->delete('time_slot');
    }

    function insertSchedule($data)
    {
        $this->db->insert('time_schedule', $data);
    }

    function getScheduleByteacher($teacher)
    {
        $this->db->where('teacher', $teacher);
        $query = $this->db->get('time_schedule');
        return $query->result();
    }

    function getScheduleById($id)
    {
        $this->db->where('id', $id);
        $query = $this->db->get('time_schedule');
        return $query->row();
    }

    function getScheduleByteacherByWeekday($teacher, $weekday)
    {
        $this->db->where('teacher', $teacher);
        $this->db->where('weekday', $weekday);
        $query = $this->db->get('time_schedule');
        return $query->result();
    }

    function getScheduleByteacherByWeekdayById($teacher, $weekday, $id)
    {
        $this->db->where_not_in('id', $id);
        $this->db->where('teacher', $teacher);
        $this->db->where('weekday', $weekday);
        $query = $this->db->get('time_schedule');
        return $query->result();
    }

    function updateSchedule($id, $data)
    {
        $this->db->where('id', $id);
        $this->db->update('time_schedule', $data);
    }

    function deleteSchedule($id)
    {
        $this->db->where('id', $id);
        $this->db->delete('time_schedule');
    }

    function deleteTimeSlotByteacherByWeekday($teacher, $weekday)
    {
        $this->db->where('teacher', $teacher);
        $this->db->where('weekday', $weekday);
        $this->db->delete('time_slot');
    }

    function insertHoliday($data)
    {
        $this->db->insert('holidays', $data);
    }

    function getHolidays()
    {
        $query = $this->db->get('holidays');
        return $query->result();
    }

    function getHolidayById($id)
    {
        $this->db->where('id', $id);
        $query = $this->db->get('holidays');
        return $query->row();
    }

    function getHolidaysByteacher($id)
    {
        $this->db->order_by('id', 'asc');
        $this->db->where('teacher', $id);
        $query = $this->db->get('holidays');
        return $query->result();
    }

    function getHolidayByteacherByDate($teacher, $date)
    {
        $this->db->where('teacher', $teacher);
        $this->db->where('date', $date);
        $query = $this->db->get('holidays');
        return $query->row();
    }

    function getTimeSlotByteacherByWeekday($teacher, $weekday)
    {
        $this->db->where('teacher', $teacher);
        $this->db->where('weekday', $weekday);
        $query = $this->db->get('time_slot');
        return $query->result();
    }

    function getTimeSlotByteacherByWeekdayById($teacher, $weekday, $id)
    {
        $this->db->where_not_in('id', $id);
        $this->db->where('teacher', $teacher);
        $this->db->where('weekday', $weekday);
        $query = $this->db->get('time_slot');
        return $query->result();
    }

    function updateHoliday($id, $data)
    {
        $this->db->where('id', $id);
        $this->db->update('holidays', $data);
    }

    function deleteHoliday($id)
    {
        $this->db->where('id', $id);
        $this->db->delete('holidays');
    }

    public function hours_settings($hours, $id)

    {
        $data['hours_available'] = $hours;
        $this->db->where('id', $id);
        $this->db->update('teacher', $data);
    }

  public function hour_compare($hour, $user_id){
       //print_r($hour);
     // $final =  $hour - '24:00:00';
      $data = date('Y-m-d', strtotime($hour));
     /* if(date('Y-m-d', strtotime($hour)) == date('Y-m-d')){
      }*/
      $this->db->where('teacher', $user_id);
      $this->db->where('s_time >=', date('g:i A' , strtotime($hour)));
      $this->db->where('e_time <=', date('g:i A' , strtotime('+1 hours', strtotime($hour))));
      $this->db->where('date', strtotime($data));
      // echo $hour;
      //echo date('Y-m-d H:i:s' , strtotime('+1 hours', strtotime($hour)));
      // print_r($this->db->last_query());
      return $this->db->get('appointment')->result();
     }
}
