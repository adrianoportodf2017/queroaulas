<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Schedule extends MX_Controller
{

    function __construct()
    {
        parent::__construct();
        $this->load->model('schedule_model');
        $this->load->model('teacher/teacher_model');
        $this->load->model('appointment/appointment_model');
        if (!$this->ion_auth->in_group(array('admin', 'Teacher', 'Client', 'Nurse', 'Receptionist'))) {
            redirect('home/permission');
        }
    }

    function index()
    {
        $data['settings'] = $this->settings_model->getSettings();
        $data['schedules'] = $this->schedule_model->getSchedule();
        $data['teacher'] = $this->teacher_model->getTeacher();
        $this->load->view('home/dashboard', $data); // just the header file
        $this->load->view('schedule', $data);
        $this->load->view('home/footer'); // just the footer file
    }

    function timeSchedule()
    {
        if ($this->ion_auth->in_group(array('Teacher'))) {
            $teacher_ion_id = $this->ion_auth->get_user_id();
            $teacher = $this->teacher_model->getTeacherByIonUserId($teacher_ion_id)->id;
        } else {
            $teacher = $this->input->get('teacher');
        }
        $data['teacherr'] = $teacher;
        $data['teacher'] = $this->db->get_where('teacher', array('id' => $teacher))->row();
        $data['settings'] = $this->settings_model->getSettings();
        $data['schedules'] = $this->schedule_model->getScheduleByTeacher($teacher);
        $this->load->view('home/dashboard', $data); // just the header file
        $this->load->view('timeschedule', $data);
        $this->load->view('home/footer'); // just the footer file
    }

    function hours_settings()
    {
        $id = $this->input->post('id');

        // var_dump($_POST);die;

        $data = array(
            '1'   => array(
                '00:00' => $this->input->post('1-00:00'),
                '01:00' => $this->input->post('1-01:00'),
                '02:00' => $this->input->post('1-02:00'),
                '03:00' => $this->input->post('1-03:00'),
                '04:00' => $this->input->post('1-04:00'),
                '05:00' => $this->input->post('1-05:00'),
                '06:00' => $this->input->post('1-06:00'),
                '07:00' => $this->input->post('1-07:00'),
                '08:00' => $this->input->post('1-08:00'),
                '09:00' => $this->input->post('1-09:00'),
                '10:00' => $this->input->post('1-10:00'),
                '11:00' => $this->input->post('1-11:00'),
                '12:00' => $this->input->post('1-12:00'),
                '13:00' => $this->input->post('1-13:00'),
                '14:00' => $this->input->post('1-14:00'),
                '15:00' => $this->input->post('1-15:00'),
                '16:00' => $this->input->post('1-16:00'),
                '17:00' => $this->input->post('1-17:00'),
                '18:00' => $this->input->post('1-18:00'),
                '19:00' => $this->input->post('1-19:00'),
                '20:00' => $this->input->post('1-20:00'),
                '21:00' => $this->input->post('1-21:00'),
                '22:00' => $this->input->post('1-22:00'),
                '23:00' => $this->input->post('1-23:00')
            ),
            '2'   => array(
                '00:00' => $this->input->post('2-00:00'),
                '01:00' => $this->input->post('2-01:00'),
                '02:00' => $this->input->post('2-02:00'),
                '03:00' => $this->input->post('2-03:00'),
                '04:00' => $this->input->post('2-04:00'),
                '05:00' => $this->input->post('2-05:00'),
                '06:00' => $this->input->post('2-06:00'),
                '07:00' => $this->input->post('2-07:00'),
                '08:00' => $this->input->post('2-08:00'),
                '09:00' => $this->input->post('2-09:00'),
                '10:00' => $this->input->post('2-10:00'),
                '11:00' => $this->input->post('2-11:00'),
                '12:00' => $this->input->post('2-12:00'),
                '13:00' => $this->input->post('2-13:00'),
                '14:00' => $this->input->post('2-14:00'),
                '15:00' => $this->input->post('2-15:00'),
                '16:00' => $this->input->post('2-16:00'),
                '17:00' => $this->input->post('2-17:00'),
                '18:00' => $this->input->post('2-18:00'),
                '19:00' => $this->input->post('2-19:00'),
                '20:00' => $this->input->post('2-20:00'),
                '21:00' => $this->input->post('2-21:00'),
                '22:00' => $this->input->post('2-22:00'),
                '23:00' => $this->input->post('2-23:00')
            ),
            '3'   => array(
                '00:00' => $this->input->post('3-00:00'),
                '01:00' => $this->input->post('3-01:00'),
                '02:00' => $this->input->post('3-02:00'),
                '03:00' => $this->input->post('3-03:00'),
                '04:00' => $this->input->post('3-04:00'),
                '05:00' => $this->input->post('3-05:00'),
                '06:00' => $this->input->post('3-06:00'),
                '07:00' => $this->input->post('3-07:00'),
                '08:00' => $this->input->post('3-08:00'),
                '09:00' => $this->input->post('3-09:00'),
                '10:00' => $this->input->post('3-10:00'),
                '11:00' => $this->input->post('3-11:00'),
                '12:00' => $this->input->post('3-12:00'),
                '13:00' => $this->input->post('3-13:00'),
                '14:00' => $this->input->post('3-14:00'),
                '15:00' => $this->input->post('3-15:00'),
                '16:00' => $this->input->post('3-16:00'),
                '17:00' => $this->input->post('3-17:00'),
                '18:00' => $this->input->post('3-18:00'),
                '19:00' => $this->input->post('3-19:00'),
                '20:00' => $this->input->post('3-20:00'),
                '21:00' => $this->input->post('3-21:00'),
                '22:00' => $this->input->post('3-22:00'),
                '23:00' => $this->input->post('3-23:00')
            ),
            '4'   => array(
                '00:00' => $this->input->post('4-00:00'),
                '01:00' => $this->input->post('4-01:00'),
                '02:00' => $this->input->post('4-02:00'),
                '03:00' => $this->input->post('4-03:00'),
                '04:00' => $this->input->post('4-04:00'),
                '05:00' => $this->input->post('4-05:00'),
                '06:00' => $this->input->post('4-06:00'),
                '07:00' => $this->input->post('4-07:00'),
                '08:00' => $this->input->post('4-08:00'),
                '09:00' => $this->input->post('4-09:00'),
                '10:00' => $this->input->post('4-10:00'),
                '11:00' => $this->input->post('4-11:00'),
                '12:00' => $this->input->post('4-12:00'),
                '13:00' => $this->input->post('4-13:00'),
                '14:00' => $this->input->post('4-14:00'),
                '15:00' => $this->input->post('4-15:00'),
                '16:00' => $this->input->post('4-16:00'),
                '17:00' => $this->input->post('4-17:00'),
                '18:00' => $this->input->post('4-18:00'),
                '19:00' => $this->input->post('4-19:00'),
                '20:00' => $this->input->post('4-20:00'),
                '21:00' => $this->input->post('4-21:00'),
                '22:00' => $this->input->post('4-22:00'),
                '23:00' => $this->input->post('4-23:00')
            ),
            '5'   => array(
                '00:00' => $this->input->post('5-00:00'),
                '01:00' => $this->input->post('5-01:00'),
                '02:00' => $this->input->post('5-02:00'),
                '03:00' => $this->input->post('5-03:00'),
                '04:00' => $this->input->post('5-04:00'),
                '05:00' => $this->input->post('5-05:00'),
                '06:00' => $this->input->post('5-06:00'),
                '07:00' => $this->input->post('5-07:00'),
                '08:00' => $this->input->post('5-08:00'),
                '09:00' => $this->input->post('5-09:00'),
                '10:00' => $this->input->post('5-10:00'),
                '11:00' => $this->input->post('5-11:00'),
                '12:00' => $this->input->post('5-12:00'),
                '13:00' => $this->input->post('5-13:00'),
                '14:00' => $this->input->post('5-14:00'),
                '15:00' => $this->input->post('5-15:00'),
                '16:00' => $this->input->post('5-16:00'),
                '17:00' => $this->input->post('5-17:00'),
                '18:00' => $this->input->post('5-18:00'),
                '19:00' => $this->input->post('5-19:00'),
                '20:00' => $this->input->post('5-20:00'),
                '21:00' => $this->input->post('5-21:00'),
                '22:00' => $this->input->post('5-22:00'),
                '23:00' => $this->input->post('5-23:00')
            ),
            '6'   => array(
                '00:00' => $this->input->post('6-00:00'),
                '01:00' => $this->input->post('6-01:00'),
                '02:00' => $this->input->post('6-02:00'),
                '03:00' => $this->input->post('6-03:00'),
                '04:00' => $this->input->post('6-04:00'),
                '05:00' => $this->input->post('6-05:00'),
                '06:00' => $this->input->post('6-06:00'),
                '07:00' => $this->input->post('6-07:00'),
                '08:00' => $this->input->post('6-08:00'),
                '09:00' => $this->input->post('6-09:00'),
                '10:00' => $this->input->post('6-10:00'),
                '11:00' => $this->input->post('6-11:00'),
                '12:00' => $this->input->post('6-12:00'),
                '13:00' => $this->input->post('6-13:00'),
                '14:00' => $this->input->post('6-14:00'),
                '15:00' => $this->input->post('6-15:00'),
                '16:00' => $this->input->post('6-16:00'),
                '17:00' => $this->input->post('6-17:00'),
                '18:00' => $this->input->post('6-18:00'),
                '19:00' => $this->input->post('6-19:00'),
                '20:00' => $this->input->post('6-20:00'),
                '21:00' => $this->input->post('6-21:00'),
                '22:00' => $this->input->post('6-22:00'),
                '23:00' => $this->input->post('6-23:00')
            ),
            '7'   => array(
                '00:00' => $this->input->post('7-00:00'),
                '01:00' => $this->input->post('7-01:00'),
                '02:00' => $this->input->post('7-02:00'),
                '03:00' => $this->input->post('7-03:00'),
                '04:00' => $this->input->post('7-04:00'),
                '05:00' => $this->input->post('7-05:00'),
                '06:00' => $this->input->post('7-06:00'),
                '07:00' => $this->input->post('7-07:00'),
                '08:00' => $this->input->post('7-08:00'),
                '09:00' => $this->input->post('7-09:00'),
                '10:00' => $this->input->post('7-10:00'),
                '11:00' => $this->input->post('7-11:00'),
                '12:00' => $this->input->post('7-12:00'),
                '13:00' => $this->input->post('7-13:00'),
                '14:00' => $this->input->post('7-14:00'),
                '15:00' => $this->input->post('7-15:00'),
                '16:00' => $this->input->post('7-16:00'),
                '17:00' => $this->input->post('7-17:00'),
                '18:00' => $this->input->post('7-18:00'),
                '19:00' => $this->input->post('7-19:00'),
                '20:00' => $this->input->post('7-20:00'),
                '21:00' => $this->input->post('7-21:00'),
                '22:00' => $this->input->post('7-22:00'),
                '23:00' => $this->input->post('7-23:00')
            ),
        );

        $hours =   serialize($data);
        $id = $this->input->post('id');
        // var_dump( $id);die;
        //$this->schedule_model->getScheduleByteacherByWeekdayById($teacher, $hours, $id);
        $teste =   $this->schedule_model->hours_settings($hours, $id);
        //var_dump($teste );die;
        redirect('schedule/timeSchedule');
    }


    function addSchedule()
    {
        $redirect = $this->input->post('redirect');
        if (empty($redirect)) {
            $redirect = 'schedule';
        }
        $id = $this->input->post('id');
        $teacher = $this->input->post('teacher');
        $s_time = $this->input->post('s_time');
        $e_time = $this->input->post('e_time');
        $weekday = $this->input->post('weekday');

        $duration = $this->input->post('duration');

        if (empty($id)) {
            $check = $this->schedule_model->getScheduleByteacherByWeekday($teacher, $weekday);
            if (!empty($check)) {
                $this->session->set_flashdata('feedback', lang('schedule_already_exists'));
                redirect($redirect);
                die();
            }
        }

        if (empty($s_time)) {
            $this->session->set_flashdata('feedback', lang('fields_can_not_be_empty'));
            redirect($redirect);
            die();
        }

        if (empty($e_time)) {
            $this->session->set_flashdata('feedback', lang('fields_can_not_be_empty'));
            redirect($redirect);
            die();
        }

        $all_slot = array(
            0 => '12:00 AM',
            1 => '12:05 AM',
            2 => '12:10 AM',
            3 => '12:15 AM',
            4 => '12:20 AM',
            5 => '12:25 AM',
            6 => '12:30 AM',
            7 => '12:35 AM',
            8 => '12:40 PM',
            9 => '12:45 AM',
            10 => '12:50 AM',
            11 => '12:55 AM',
            12 => '01:00 AM',
            13 => '01:05 AM',
            14 => '01:10 AM',
            15 => '01:15 AM',
            16 => '01:20 AM',
            17 => '01:25 AM',
            18 => '01:30 AM',
            19 => '01:35 AM',
            20 => '01:40 AM',
            21 => '01:45 AM',
            22 => '01:50 AM',
            23 => '01:55 AM',
            24 => '02:00 AM',
            25 => '02:05 AM',
            26 => '02:10 AM',
            27 => '02:15 AM',
            28 => '02:20 AM',
            29 => '02:25 AM',
            30 => '02:30 AM',
            31 => '02:35 AM',
            32 => '02:40 AM',
            33 => '02:45 AM',
            34 => '02:50 AM',
            35 => '02:55 AM',
            36 => '03:00 AM',
            37 => '03:05 AM',
            38 => '03:10 AM',
            39 => '03:15 AM',
            40 => '03:20 AM',
            41 => '03:25 AM',
            42 => '03:30 AM',
            43 => '03:35 AM',
            44 => '03:40 AM',
            45 => '03:45 AM',
            46 => '03:50 AM',
            47 => '03:55 AM',
            48 => '04:00 AM',
            49 => '04:05 AM',
            50 => '04:10 AM',
            51 => '04:15 AM',
            52 => '04:20 AM',
            53 => '04:25 AM',
            54 => '04:30 AM',
            55 => '04:35 AM',
            56 => '04:40 AM',
            57 => '04:45 AM',
            58 => '04:50 AM',
            59 => '04:55 AM',
            60 => '05:00 AM',
            61 => '05:05 AM',
            62 => '05:10 AM',
            63 => '05:15 AM',
            64 => '05:20 AM',
            65 => '05:25 AM',
            66 => '05:30 AM',
            67 => '05:35 AM',
            68 => '05:40 AM',
            69 => '05:45 AM',
            70 => '05:50 AM',
            71 => '05:55 AM',
            72 => '06:00 AM',
            73 => '06:05 AM',
            74 => '06:10 AM',
            75 => '06:15 AM',
            76 => '06:20 AM',
            77 => '06:25 AM',
            78 => '06:30 AM',
            79 => '06:35 AM',
            80 => '06:40 AM',
            81 => '06:45 AM',
            82 => '06:50 AM',
            83 => '06:55 AM',
            84 => '07:00 AM',
            85 => '07:05 AM',
            86 => '07:10 AM',
            87 => '07:15 AM',
            88 => '07:20 AM',
            89 => '07:25 AM',
            90 => '07:30 AM',
            91 => '07:35 AM',
            92 => '07:40 AM',
            93 => '07:45 AM',
            94 => '07:50 AM',
            95 => '07:55 AM',
            96 => '08:00 AM',
            97 => '08:05 AM',
            98 => '08:10 AM',
            99 => '08:15 AM',
            100 => '08:20 AM',
            101 => '08:25 AM',
            102 => '08:30 AM',
            103 => '08:35 AM',
            104 => '08:40 AM',
            105 => '08:45 AM',
            106 => '08:50 AM',
            107 => '08:55 AM',
            108 => '09:00 AM',
            109 => '09:05 AM',
            110 => '09:10 AM',
            111 => '09:15 AM',
            112 => '09:20 AM',
            113 => '09:25 AM',
            114 => '09:30 AM',
            115 => '09:35 AM',
            116 => '09:40 AM',
            117 => '09:45 AM',
            118 => '09:50 AM',
            119 => '09:55 AM',
            120 => '10:00 AM',
            121 => '10:05 AM',
            122 => '10:10 AM',
            123 => '10:15 AM',
            124 => '10:20 AM',
            125 => '10:25 AM',
            126 => '10:30 AM',
            127 => '10:35 AM',
            128 => '10:40 AM',
            129 => '10:45 AM',
            130 => '10:50 AM',
            131 => '10:55 AM',
            132 => '11:00 AM',
            133 => '11:05 AM',
            134 => '11:10 AM',
            135 => '11:15 AM',
            136 => '11:20 AM',
            137 => '11:25 AM',
            138 => '11:30 AM',
            139 => '11:35 AM',
            140 => '11:40 AM',
            141 => '11:45 AM',
            142 => '11:50 AM',
            143 => '11:55 AM',
            144 => '12:00 PM',
            145 => '12:05 PM',
            146 => '12:10 PM',
            147 => '12:15 PM',
            148 => '12:20 PM',
            149 => '12:25 PM',
            150 => '12:30 PM',
            151 => '12:35 PM',
            152 => '12:40 PM',
            153 => '12:45 PM',
            154 => '12:50 PM',
            155 => '12:55 PM',
            156 => '01:00 PM',
            157 => '01:05 PM',
            158 => '01:10 PM',
            159 => '01:15 PM',
            160 => '01:20 PM',
            161 => '01:25 PM',
            162 => '01:30 PM',
            163 => '01:35 PM',
            164 => '01:40 PM',
            165 => '01:45 PM',
            166 => '01:50 PM',
            167 => '01:55 PM',
            168 => '02:00 PM',
            169 => '02:05 PM',
            170 => '02:10 PM',
            171 => '02:15 PM',
            172 => '02:20 PM',
            173 => '02:25 PM',
            174 => '02:30 PM',
            175 => '02:35 PM',
            176 => '02:40 PM',
            177 => '02:45 PM',
            178 => '02:50 PM',
            179 => '02:55 PM',
            180 => '03:00 PM',
            181 => '03:05 PM',
            182 => '03:10 PM',
            183 => '03:15 PM',
            184 => '03:20 PM',
            185 => '03:25 PM',
            186 => '03:30 PM',
            187 => '03:35 PM',
            188 => '03:40 PM',
            189 => '03:45 PM',
            190 => '03:50 PM',
            191 => '03:55 PM',
            192 => '04:00 PM',
            193 => '04:05 PM',
            194 => '04:10 PM',
            195 => '04:15 PM',
            196 => '04:20 PM',
            197 => '04:25 PM',
            198 => '04:30 PM',
            199 => '04:35 PM',
            200 => '04:40 PM',
            201 => '04:45 PM',
            202 => '04:50 PM',
            203 => '04:55 PM',
            204 => '05:00 PM',
            205 => '05:05 PM',
            206 => '05:10 PM',
            207 => '05:15 PM',
            208 => '05:20 PM',
            209 => '05:25 PM',
            210 => '05:30 PM',
            211 => '05:35 PM',
            212 => '05:40 PM',
            213 => '05:45 PM',
            214 => '05:50 PM',
            215 => '05:55 PM',
            216 => '06:00 PM',
            217 => '06:05 PM',
            218 => '06:10 PM',
            219 => '06:15 PM',
            220 => '06:20 PM',
            221 => '06:25 PM',
            222 => '06:30 PM',
            223 => '06:35 PM',
            224 => '06:40 PM',
            225 => '06:45 PM',
            226 => '06:50 PM',
            227 => '06:55 PM',
            228 => '07:00 PM',
            229 => '07:05 PM',
            230 => '07:10 PM',
            231 => '07:15 PM',
            232 => '07:20 PM',
            233 => '07:25 PM',
            234 => '07:30 PM',
            235 => '07:35 PM',
            236 => '07:40 PM',
            237 => '07:45 PM',
            238 => '07:50 PM',
            239 => '07:55 PM',
            240 => '08:00 PM',
            241 => '08:05 PM',
            242 => '08:10 PM',
            243 => '08:15 PM',
            244 => '08:20 PM',
            245 => '08:25 PM',
            246 => '08:30 PM',
            247 => '08:35 PM',
            248 => '08:40 PM',
            249 => '08:45 PM',
            250 => '08:50 PM',
            251 => '08:55 PM',
            252 => '09:00 PM',
            253 => '09:05 PM',
            254 => '09:10 PM',
            255 => '09:15 PM',
            256 => '09:20 PM',
            257 => '09:25 PM',
            258 => '09:30 PM',
            259 => '09:35 PM',
            260 => '09:40 PM',
            261 => '09:45 PM',
            262 => '09:50 PM',
            263 => '09:55 PM',
            264 => '10:00 PM',
            265 => '10:05 PM',
            266 => '10:10 PM',
            267 => '10:15 PM',
            268 => '10:20 PM',
            269 => '10:25 PM',
            270 => '10:30 PM',
            271 => '10:35 PM',
            272 => '10:40 PM',
            273 => '10:45 PM',
            274 => '10:50 PM',
            275 => '10:55 PM',
            276 => '11:00 PM',
            277 => '11:05 PM',
            278 => '11:10 PM',
            279 => '11:15 PM',
            280 => '11:20 PM',
            281 => '11:25 PM',
            282 => '11:30 PM',
            283 => '11:35 PM',
            284 => '11:40 PM',
            285 => '11:45 PM',
            286 => '11:50 PM',
            287 => '11:55 PM',
        );

        $key1 = array_search($s_time, $all_slot);
        $key2 = array_search($e_time, $all_slot);



        if ($key1 > $key2) {
            $this->session->set_flashdata('feedback', lang('time_selection_error'));
            redirect($redirect);
            die();
        }

        if (!empty($id)) {
            $previous_time = $this->schedule_model->getScheduleByteacherByWeekdayById($teacher, $weekday, $id);
        } else {
            $previous_time = $this->schedule_model->getScheduleByteacherByWeekday($teacher, $weekday);
        }

        if (!empty($previous_time)) {
            $x = 0;
            foreach ($previous_time as $pre_time) {
                $pre_s_time = $pre_time->s_time;
                $pre_e_time = $pre_time->e_time;

                $key_pre_s = array_search($pre_s_time, $all_slot);
                $key_pre_e = array_search($pre_e_time, $all_slot);

                if ($key1 < $key_pre_s) {
                    if ($key2 <= $key_pre_s) {
                        continue;
                    } else {
                        $this->session->set_flashdata('feedback', lang('slot_overlapped'));
                        redirect($redirect);
                        die();
                    }
                } elseif ($key1 > $key_pre_s) {
                    if ($key1 >= $key_pre_e) {
                        if ($key2 > $key_pre_e) {
                            continue;
                        } else {
                            $this->session->set_flashdata('feedback', lang('slot_overlapped'));
                            redirect($redirect);
                            die();
                        }
                    } else {
                        $this->session->set_flashdata('feedback', lang('slot_overlapped'));
                        redirect($redirect);
                        die();
                    }
                } elseif ($key1 >= $key_pre_s && $key2 <= $key_pre_e) {
                    $this->session->set_flashdata('feedback', lang('slot_overlapped'));
                    redirect($redirect);
                    die();
                } elseif ($key1 == $key_pre_s) {
                    $this->session->set_flashdata('feedback', lang('slot_overlapped'));
                    redirect($redirect);
                    die();
                }
            }
        }



        // Validating Starting Time Field
        $this->form_validation->set_rules('s_time', 'Start Time', 'trim|required|min_length[1]|max_length[100]|xss_clean');
        // Validating End Time Field   
        $this->form_validation->set_rules('e_time', 'End Time', 'trim|required|min_length[1]|max_length[500]|xss_clean');
        // Validating Week Day Field   
        $this->form_validation->set_rules('e_time', 'End Time', 'trim|required|min_length[1]|max_length[500]|xss_clean');

        // Validating Duration Field   
        $this->form_validation->set_rules('duration', 'Duration', 'trim|required|min_length[1]|max_length[500]|xss_clean');

        if ($this->form_validation->run() == FALSE) {
            if (!empty($id)) {
                redirect("schedule/editSchedule?id=$id");
            } else {
                $data['settings'] = $this->settings_model->getSettings();
                $this->load->view('home/dashboard', $data); // just the header file
                $this->load->view('timeschedule');
                $this->load->view('home/footer'); // just the header file
            }
        } else {

            $data = array();
            $data = array(
                'teacher' => $teacher,
                's_time' => $s_time,
                'e_time' => $e_time,
                'weekday' => $weekday,
                's_time_key' => $key1,
                'duration' => $duration
            );
            if (!empty($id)) {
                $this->session->set_flashdata('feedback', lang('updated'));
                $this->schedule_model->updateSchedule($id, $data);
            } else {


                $duration = intval($duration);
                $slot_s_time = $key1;
                $slot_e_time = $key1 + $duration;

                foreach ($all_slot as $key_start => $value) {
                    if ($slot_s_time == $key_start) {
                        $p_slot_s_time = $value;
                        foreach ($all_slot as $key_end => $value_e) {
                            if ($slot_e_time == $key_end) {
                                if ($slot_e_time <= $key2) {
                                    $p_slot_e_time = $value_e;

                                    $slot_data = array(
                                        'teacher' => $teacher,
                                        's_time' => $p_slot_s_time,
                                        'e_time' => $p_slot_e_time,
                                        'weekday' => $weekday,
                                        's_time_key' => $key_start
                                    );
                                    $this->schedule_model->insertTimeSlot($slot_data);
                                }
                            }
                        }
                        $slot_s_time = $slot_e_time;
                        $slot_e_time = $slot_s_time + $duration;
                    }
                }
                $this->schedule_model->insertSchedule($data);
                $this->session->set_flashdata('feedback', lang('added'));
            }

            redirect($redirect);
        }
    }

    function editScheduleByJason()
    {
        $id = $this->input->get('id');
        $data['schedule'] = $this->schedule_model->getScheduleById($id);
        echo json_encode($data);
    }

    function deleteSchedule()
    {
        $from = $this->input->get('all');
        $id = $this->input->get('id');
        $teacher = $this->input->get('teacher');
        $weekday = $this->input->get('weekday');
        $this->schedule_model->deleteTimeSlotByteacherByWeekday($teacher, $weekday);
        $this->schedule_model->deleteSchedule($id);

        if ($this->ion_auth->in_group(array('teacher'))) {
            redirect('schedule/timeSchedule');
        } else {
            redirect('schedule');
        }
    }

    function timeSlots()
    {
        $teacher = $this->input->get('teacher');
        $data['teacherr'] = $teacher;
        $data['settings'] = $this->settings_model->getSettings();
        $data['slots'] = $this->schedule_model->getTimeSlotByteacher($teacher);
        $this->load->view('home/dashboard', $data); // just the header file
        $this->load->view('timeslot', $data);
        $this->load->view('home/footer'); // just the footer file
    }

    function addTimeSlot()
    {
        $id = $this->input->post('id');
        $teacher = $this->input->post('teacher');
        $s_time = $this->input->post('s_time');
        $e_time = $this->input->post('e_time');
        $weekday = $this->input->post('weekday');


        if (empty($s_time)) {
            $this->session->set_flashdata('feedback', lang('fields_can_not_be_empty'));
            redirect('schedule/timeSlots?teacher=' . $teacher);
            die();
        }

        if (empty($e_time)) {
            $this->session->set_flashdata('feedback', lang('fields_can_not_be_empty'));
            redirect('schedule/timeSlots?teacher=' . $teacher);
            die();
        }


        /*

          $s_time_explode = explode(' ', $s_time);
          $e_time_explode = explode(' ', $e_time);

          $s_time_only = explode(':', $s_time_explode[0]);
          $e_time_only = explode(':', $e_time_explode[0]);

          if ($s_time_explode[1] == $e_time_explode[1]) {
          if ($s_time_only[0] == $e_time_only[0]) {
          if ($s_time_only[1] > $e_time_only[1]) {
          $this->session->set_flashdata('feedback', 'Error!');
          redirect('staff/timeSlots?staff=' . $staff);
          die();
          }
          }
          if ($s_time_only[0] != $e_time_only[0]) {
          if ($s_time_only[0] > $e_time_only[0]) {
          $this->session->set_flashdata('feedback', 'Error!');
          redirect('staff/timeSlots?staff=' . $staff);
          die();
          }
          }
          } elseif (($s_time_explode[1] == 'PM') && ($e_time_explode[1] = 'AM')) {
          $this->session->set_flashdata('feedback', 'Error!');
          redirect('staff/timeSlots?staff=' . $staff);
          die();
          }

          $previous_time = $this->staff_model->getTimeSlotByStaffByWeekday($staff, $weekday);

         */

        $all_slot = array(
            0 => '12:00 AM',
            1 => '12:05 AM',
            2 => '12:10 AM',
            3 => '12:15 AM',
            4 => '12:20 AM',
            5 => '12:25 AM',
            6 => '12:30 AM',
            7 => '12:35 AM',
            8 => '12:40 PM',
            9 => '12:45 AM',
            10 => '12:50 AM',
            11 => '12:55 AM',
            12 => '01:00 AM',
            13 => '01:05 AM',
            14 => '01:10 AM',
            15 => '01:15 AM',
            16 => '01:20 AM',
            17 => '01:25 AM',
            18 => '01:30 AM',
            19 => '01:35 AM',
            20 => '01:40 AM',
            21 => '01:45 AM',
            22 => '01:50 AM',
            23 => '01:55 AM',
            24 => '02:00 AM',
            25 => '02:05 AM',
            26 => '02:10 AM',
            27 => '02:15 AM',
            28 => '02:20 AM',
            29 => '02:25 AM',
            30 => '02:30 AM',
            31 => '02:35 AM',
            32 => '02:40 AM',
            33 => '02:45 AM',
            34 => '02:50 AM',
            35 => '02:55 AM',
            36 => '03:00 AM',
            37 => '03:05 AM',
            38 => '03:10 AM',
            39 => '03:15 AM',
            40 => '03:20 AM',
            41 => '03:25 AM',
            42 => '03:30 AM',
            43 => '03:35 AM',
            44 => '03:40 AM',
            45 => '03:45 AM',
            46 => '03:50 AM',
            47 => '03:55 AM',
            48 => '04:00 AM',
            49 => '04:05 AM',
            50 => '04:10 AM',
            51 => '04:15 AM',
            52 => '04:20 AM',
            53 => '04:25 AM',
            54 => '04:30 AM',
            55 => '04:35 AM',
            56 => '04:40 AM',
            57 => '04:45 AM',
            58 => '04:50 AM',
            59 => '04:55 AM',
            60 => '05:00 AM',
            61 => '05:05 AM',
            62 => '05:10 AM',
            63 => '05:15 AM',
            64 => '05:20 AM',
            65 => '05:25 AM',
            66 => '05:30 AM',
            67 => '05:35 AM',
            68 => '05:40 AM',
            69 => '05:45 AM',
            70 => '05:50 AM',
            71 => '05:55 AM',
            72 => '06:00 AM',
            73 => '06:05 AM',
            74 => '06:10 AM',
            75 => '06:15 AM',
            76 => '06:20 AM',
            77 => '06:25 AM',
            78 => '06:30 AM',
            79 => '06:35 AM',
            80 => '06:40 AM',
            81 => '06:45 AM',
            82 => '06:50 AM',
            83 => '06:55 AM',
            84 => '07:00 AM',
            85 => '07:05 AM',
            86 => '07:10 AM',
            87 => '07:15 AM',
            88 => '07:20 AM',
            89 => '07:25 AM',
            90 => '07:30 AM',
            91 => '07:35 AM',
            92 => '07:40 AM',
            93 => '07:45 AM',
            94 => '07:50 AM',
            95 => '07:55 AM',
            96 => '08:00 AM',
            97 => '08:05 AM',
            98 => '08:10 AM',
            99 => '08:15 AM',
            100 => '08:20 AM',
            101 => '08:25 AM',
            102 => '08:30 AM',
            103 => '08:35 AM',
            104 => '08:40 AM',
            105 => '08:45 AM',
            106 => '08:50 AM',
            107 => '08:55 AM',
            108 => '09:00 AM',
            109 => '09:05 AM',
            110 => '09:10 AM',
            111 => '09:15 AM',
            112 => '09:20 AM',
            113 => '09:25 AM',
            114 => '09:30 AM',
            115 => '09:35 AM',
            116 => '09:40 AM',
            117 => '09:45 AM',
            118 => '09:50 AM',
            119 => '09:55 AM',
            120 => '10:00 AM',
            121 => '10:05 AM',
            122 => '10:10 AM',
            123 => '10:15 AM',
            124 => '10:20 AM',
            125 => '10:25 AM',
            126 => '10:30 AM',
            127 => '10:35 AM',
            128 => '10:40 AM',
            129 => '10:45 AM',
            130 => '10:50 AM',
            131 => '10:55 AM',
            132 => '11:00 AM',
            133 => '11:05 AM',
            134 => '11:10 AM',
            135 => '11:15 AM',
            136 => '11:20 AM',
            137 => '11:25 AM',
            138 => '11:30 AM',
            139 => '11:35 AM',
            140 => '11:40 AM',
            141 => '11:45 AM',
            142 => '11:50 AM',
            143 => '11:55 AM',
            144 => '12:00 PM',
            145 => '12:05 PM',
            146 => '12:10 PM',
            147 => '12:15 PM',
            148 => '12:20 PM',
            149 => '12:25 PM',
            150 => '12:30 PM',
            151 => '12:35 PM',
            152 => '12:40 PM',
            153 => '12:45 PM',
            154 => '12:50 PM',
            155 => '12:55 PM',
            156 => '01:00 PM',
            157 => '01:05 PM',
            158 => '01:10 PM',
            159 => '01:15 PM',
            160 => '01:20 PM',
            161 => '01:25 PM',
            162 => '01:30 PM',
            163 => '01:35 PM',
            164 => '01:40 PM',
            165 => '01:45 PM',
            166 => '01:50 PM',
            167 => '01:55 PM',
            168 => '02:00 PM',
            169 => '02:05 PM',
            170 => '02:10 PM',
            171 => '02:15 PM',
            172 => '02:20 PM',
            173 => '02:25 PM',
            174 => '02:30 PM',
            175 => '02:35 PM',
            176 => '02:40 PM',
            177 => '02:45 PM',
            178 => '02:50 PM',
            179 => '02:55 PM',
            180 => '03:00 PM',
            181 => '03:05 PM',
            182 => '03:10 PM',
            183 => '03:15 PM',
            184 => '03:20 PM',
            185 => '03:25 PM',
            186 => '03:30 PM',
            187 => '03:35 PM',
            188 => '03:40 PM',
            189 => '03:45 PM',
            190 => '03:50 PM',
            191 => '03:55 PM',
            192 => '04:00 PM',
            193 => '04:05 PM',
            194 => '04:10 PM',
            195 => '04:15 PM',
            196 => '04:20 PM',
            197 => '04:25 PM',
            198 => '04:30 PM',
            199 => '04:35 PM',
            200 => '04:40 PM',
            201 => '04:45 PM',
            202 => '04:50 PM',
            203 => '04:55 PM',
            204 => '05:00 PM',
            205 => '05:05 PM',
            206 => '05:10 PM',
            207 => '05:15 PM',
            208 => '05:20 PM',
            209 => '05:25 PM',
            210 => '05:30 PM',
            211 => '05:35 PM',
            212 => '05:40 PM',
            213 => '05:45 PM',
            214 => '05:50 PM',
            215 => '05:55 PM',
            216 => '06:00 PM',
            217 => '06:05 PM',
            218 => '06:10 PM',
            219 => '06:15 PM',
            220 => '06:20 PM',
            221 => '06:25 PM',
            222 => '06:30 PM',
            223 => '06:35 PM',
            224 => '06:40 PM',
            225 => '06:45 PM',
            226 => '06:50 PM',
            227 => '06:55 PM',
            228 => '07:00 PM',
            229 => '07:05 PM',
            230 => '07:10 PM',
            231 => '07:15 PM',
            232 => '07:20 PM',
            233 => '07:25 PM',
            234 => '07:30 PM',
            235 => '07:35 PM',
            236 => '07:40 PM',
            237 => '07:45 PM',
            238 => '07:50 PM',
            239 => '07:55 PM',
            240 => '08:00 PM',
            241 => '08:05 PM',
            242 => '08:10 PM',
            243 => '08:15 PM',
            244 => '08:20 PM',
            245 => '08:25 PM',
            246 => '08:30 PM',
            247 => '08:35 PM',
            248 => '08:40 PM',
            249 => '08:45 PM',
            250 => '08:50 PM',
            251 => '08:55 PM',
            252 => '09:00 PM',
            253 => '09:05 PM',
            254 => '09:10 PM',
            255 => '09:15 PM',
            256 => '09:20 PM',
            257 => '09:25 PM',
            258 => '09:30 PM',
            259 => '09:35 PM',
            260 => '09:40 PM',
            261 => '09:45 PM',
            262 => '09:50 PM',
            263 => '09:55 PM',
            264 => '10:00 PM',
            265 => '10:05 PM',
            266 => '10:10 PM',
            267 => '10:15 PM',
            268 => '10:20 PM',
            269 => '10:25 PM',
            270 => '10:30 PM',
            271 => '10:35 PM',
            272 => '10:40 PM',
            273 => '10:45 PM',
            274 => '10:50 PM',
            275 => '10:55 PM',
            276 => '11:00 PM',
            277 => '11:05 PM',
            278 => '11:10 PM',
            279 => '11:15 PM',
            280 => '11:20 PM',
            281 => '11:25 PM',
            282 => '11:30 PM',
            283 => '11:35 PM',
            284 => '11:40 PM',
            285 => '11:45 PM',
            286 => '11:50 PM',
            287 => '11:55 PM',
        );

        $key1 = array_search($s_time, $all_slot);
        $key2 = array_search($e_time, $all_slot);


        if ($key1 > $key2) {
            $this->session->set_flashdata('feedback', 'Time Selection Error!');
            redirect('schedule/timeSlots?teacher=' . $teacher);
            die();
        }

        if (!empty($id)) {
            $previous_time = $this->schedule_model->getTimeSlotByteacherByWeekdayById($teacher, $weekday, $id);
        } else {
            $previous_time = $this->schedule_model->getTimeSlotByteacherByWeekday($teacher, $weekday);
        }

        if (!empty($previous_time)) {
            $x = 0;
            foreach ($previous_time as $pre_time) {
                $pre_s_time = $pre_time->s_time;
                $pre_e_time = $pre_time->e_time;

                $key_pre_s = array_search($pre_s_time, $all_slot);
                $key_pre_e = array_search($pre_e_time, $all_slot);

                if ($key1 < $key_pre_s) {
                    if ($key2 <= $key_pre_s) {
                        continue;
                    } else {
                        $this->session->set_flashdata('feedback', lang('slot_overlapped'));
                        redirect('schedule/timeSlots?teacher=' . $teacher);
                        die();
                    }
                } elseif ($key1 > $key_pre_s) {
                    if ($key1 >= $key_pre_e) {
                        if ($key2 > $key_pre_e) {
                            continue;
                        } else {
                            $this->session->set_flashdata('feedback', lang('slot_overlapped'));
                            redirect('schedule/timeSlots?teacher=' . $teacher);
                            die();
                        }
                    } else {
                        $this->session->set_flashdata('feedback', lang('slot_overlapped'));
                        redirect('schedule/timeSlots?teacher=' . $teacher);
                        die();
                    }
                } elseif ($key1 >= $key_pre_s && $key2 <= $key_pre_e) {
                    $this->session->set_flashdata('feedback', lang('slot_overlapped'));
                    redirect('schedule/timeSlots?teacher=' . $teacher);
                    die();
                } elseif ($key1 == $key_pre_s) {
                    $this->session->set_flashdata('feedback', lang('slot_overlapped'));
                    redirect('schedule/timeSlots?teacher=' . $teacher);
                    die();
                }
            }
        }



        // Validating Starting Time Field
        $this->form_validation->set_rules('s_time', 'Start Time', 'trim|required|min_length[5]|max_length[100]|xss_clean');
        // Validating End Time Field   
        $this->form_validation->set_rules('e_time', 'End Time', 'trim|required|min_length[5]|max_length[500]|xss_clean');
        // Validating Week Day Field   
        $this->form_validation->set_rules('e_time', 'End Time', 'trim|required|min_length[5]|max_length[500]|xss_clean');

        if ($this->form_validation->run() == FALSE) {
            if (!empty($id)) {
                redirect("schedule/editTimeSlot?id=$id");
            } else {
                $data['settings'] = $this->settings_model->getSettings();
                $this->load->view('home/dashboard', $data); // just the header file
                $this->load->view('timeslot');
                $this->load->view('home/footer'); // just the header file
            }
        } else {

            $data = array();
            $data = array(
                'teacher' => $teacher,
                's_time' => $s_time,
                'e_time' => $e_time,
                'weekday' => $weekday,
                's_time_key' => $key1
            );
            if (!empty($id)) {
                $this->session->set_flashdata('feedback', lang('updated'));
                $this->schedule_model->updateTimeSlot($id, $data);
            } else {
                $this->session->set_flashdata('feedback', lang('added'));
                $this->schedule_model->insertTimeSlot($data);
            }
            redirect('schedule/timeSlots?teacher=' . $teacher);
        }
    }

    function edittimeSlotByJason()
    {
        $id = $this->input->get('id');
        $data['slot'] = $this->schedule_model->getTimeSlotById($id);
        echo json_encode($data);
    }

    function getAvailableSlotByteacherByDateByJasonold()
    {
        $data = array();
        $date = $this->input->get('date');
        if (!empty($date)) {
            $date = strtotime($date);
        }
        $teacher = $this->input->get('teacher');
        $data['aslots'] = $this->schedule_model->getAvailableSlotByteacherByDate($date, $teacher);
        echo json_encode($data);
    }

    function getAvailableSlotByteacherByDateByAppointmentIdByJason()
    {
        $data = array();
        $appointment_id = $this->input->get('appointment_id');
        $date = $this->input->get('date');
        if (!empty($date)) {
            $date = strtotime($date);
        }
        $teacher = $this->input->get('teacher');
        $data['aslots'] = $this->schedule_model->getAvailableSlotByteacherByDateByAppointmentId($date, $teacher, $appointment_id);
        $data['current_value'] = $this->appointment_model->getAppointmentById($appointment_id)->time_slot;
        echo json_encode($data);
    }

    function allHolidays()
    {
        $data['settings'] = $this->settings_model->getSettings();
        $data['holidays'] = $this->schedule_model->getHolidays();
        $data['teachers'] = $this->teacher_model->getTeacher();
        $this->load->view('home/dashboard', $data); // just the header file
        $this->load->view('all_holidays', $data);
        $this->load->view('home/footer'); // just the footer file
    }

    function holidays()
    {
        if ($this->ion_auth->in_group(array('teacher'))) {
            $teacher_ion_id = $this->ion_auth->get_user_id();
            $teacher = $this->teacher_model->getTeacherByIonUserId($teacher_ion_id)->id;
        } else {
            $teacher = $this->input->get('teacher');
        }

        $data['teacherr'] = $teacher;
        $data['settings'] = $this->settings_model->getSettings();
        $data['holidays'] = $this->schedule_model->getHolidaysByteacher($teacher);
        $this->load->view('home/dashboard', $data); // just the header file
        $this->load->view('holidays', $data);
        $this->load->view('home/footer'); // just the footer file
    }

    function addHoliday()
    {
        $id = $this->input->post('id');
        $redirect = $this->input->post('redirect');
        if (empty($redirect)) {
            $redirect = 'schedule/allHolidays';
        }
        $teacher = $this->input->post('teacher');
        $date = $this->input->post('date');
        if (!empty($date)) {
            $date = strtotime($date);
        } else {
            $this->session->set_flashdata('feedback', lang('date_not_selected'));
            redirect($redirect);
            die();
        }


        if (empty($id)) {
            $is_exist = $this->schedule_model->getHolidayByteacherByDate($teacher, $date);
            if (!empty($is_exist)) {
                $this->session->set_flashdata('feedback', lang('already_exist'));
                redirect($redirect);
                die();
            }
        } else {
            $is_exist = $this->schedule_model->getHolidayByteacherByDate($teacher, $date);
            if (!empty($is_exist)) {
                if ($is_exist->date == $date) {
                    $this->session->set_flashdata('feedback', lang('already_exist'));
                    redirect($redirect);
                    die();
                }
            }
        }
        // Validating Email Field
        $this->form_validation->set_rules('date', 'Date', 'trim|required|min_length[5]|max_length[100]|xss_clean');



        if ($this->form_validation->run() == FALSE) {
            if (!empty($id)) {
                redirect("schedule/editHoliday?id=$id");
            } else {
                $data['settings'] = $this->settings_model->getSettings();
                $this->load->view('home/dashboard', $data); // just the header file
                $this->load->view('timeslot');
                $this->load->view('home/footer'); // just the header file
            }
        } else {

            $data = array();
            $data = array(
                'teacher' => $teacher,
                'date' => $date,
            );
            if (!empty($id)) {
                $this->session->set_flashdata('feedback', lang('updated'));
                $this->schedule_model->updateHoliday($id, $data);
            } else {
                $this->session->set_flashdata('feedback', lang('added'));
                $this->schedule_model->insertHoliday($data);
            }

            redirect($redirect);
        }
    }

    function editHolidayByJason()
    {
        $id = $this->input->get('id');
        $data['holiday'] = $this->schedule_model->getHolidayById($id);
        $data['teacher'] = $this->teacher_model->getTeacherById($data['holiday']->teacher);
        echo json_encode($data);
    }

    function deleteHoliday()
    {
        $id = $this->input->get('id');
        $redirect = $this->input->get('redirect');
        if (empty($redirect)) {
            $redirect = 'schedule/allHolidays';
        }
        $teacher = $this->input->get('teacher');
        $this->schedule_model->deleteHoliday($id);
        $this->session->set_flashdata('feedback', lang('deleted'));
        redirect($redirect);
    }

    function delete()
    {
        $data = array();
        $id = $this->input->get('id');
        $user_data = $this->db->get_where('teacher', array('id' => $id))->row();
        $path = $user_data->img_url;

        if (!empty($path)) {
            unlink($path);
        }
        $ion_user_id = $user_data->ion_user_id;
        $this->db->where('id', $ion_user_id);
        $this->db->delete('users');
        $this->schedule_model->delete($id);
        $this->session->set_flashdata('feedback', lang('deleted'));
        redirect('teacher');
    }

    function deleteTimeSlot()
    {
        $id = $this->input->get('id');
        $teacher = $this->input->get('teacher');
        $this->schedule_model->deleteTimeSlot($id);
        redirect('scedule/timeSlots?teacher=' . $teacher);
    }

    public function fetch_all_event($user_id)
    {
        $this->db->order_by('start_event', 'DESC');
        $this->db->where('user_id', $user_id);
        return $this->db->get('events');
    }

    function list_hour_teacher()
    {

        $date = $_POST['start'];
        $day_week = strval(substr($date, 0, 1));
        $today = str_replace(' ', '', strval(substr($date, 3)));
        $date_compare = strval(date('Y-m-d'));
        // var_dump($dataCompare);
        //var_dump(str_replace(' ', '', $data));

        $data = "";
        $teacher_ion_id = $this->ion_auth->get_user_id();
        $user_id = $this->teacher_model->getTeacherByIonUserId($teacher_ion_id)->id;
        $event_data = $this->db->get_where('teacher', array('id' => $user_id))->row();
        $hours_available =  unserialize($event_data->hours_available);
        //var_dump($day_week);die;
        foreach ($hours_available[$day_week] as $hours => $k) {
            if ($date_compare == $today) {
                $current_time = strval(date('H', strtotime('+1 hours')));
                //echo $current_time;
                if ($k == '1' && $current_time < $hours) {
                    // echo str_replace(' ', '', substr($date, 3)).' '.$hours.':00';
                    $liberado =  $this->schedule_model->hour_compare(str_replace(' ', '', substr($date, 3)) . ' ' . $hours . ':00', $user_id);
                    var_dump($liberado);
                    if (!$liberado) {
                        $data = $data . '<div><button class="btn btn-info round buttonhours">' . $hours . '</button>
              </div>';
                    } else {
                        $data = $data . '<div><button class="btn btn round buttonhours" disabled>' . $hours . '</button>
                  </div>';
                    }
                } else {
                    if ($k == '1') {
                        $data = $data . '<div><button class="btn btn round buttonhours" disabled>' . $hours . '</button>
                    </div>';
                    }
                }
                //echo $datahoje;die;

            } else if ($k == '1') {
                // echo str_replace(' ', '', substr($date, 3)).' '.$hours.':00';
                $liberado =  $this->schedule_model->hour_compare(str_replace(' ', '', substr($date, 3)) . ' ' . $hours . ':00', $user_id);
                var_dump($liberado);
                if (!$liberado) {
                    $data = $data . '<div><button class="btn btn-info round buttonhours">' . $hours . '</button>
          </div>';
                } else {
                    $data = $data . '<div><button class="btn btn round buttonhours" disabled>' . $hours . '</button>
              </div>';
                }
            }
        }
        /*$user_id = $this->session->userdata('user_id');
         // var_dump($user_id);
          $event_data = $this->fullcalendar_model->fetch_all_event($user_id);
         // var_dump($event_data);
          foreach ($event_data->result_array() as $row) {
              $data[] = array(
                  'id' => $row['id'],
                  'title' => $row['title'],
                  'start' => $row['start_event'],
                  'end' => $row['end_event']
                  
              );
          }*/
        echo die(die(($data)));
    }

    function getAvailableSlotByteacherByDateByjason()
    {
        $dateee = array();
        $dateee['aslots'] = null;
        $data = '';
        $date =  strftime('%u - %Y-%m-%d', strtotime($this->input->get('date')));
        $day_week = strval(substr($date, 0, 1));
        //var_dump($day_week);die;
        // $data = "";
        $teacher_ion_id = $this->ion_auth->get_user_id();
        $user_id = $this->teacher_model->getTeacherByIonUserId($teacher_ion_id)->id;
        $event_data = $this->db->get_where('teacher', array('id' => $user_id))->row();
        $hours_available =  unserialize($event_data->hours_available);
        $c = '0';
        //var_dump($hours_available[$day_week]);die;
        foreach ($hours_available[$day_week] as $hours => $k) {
            $c = $c + '1';
            if ($k == '1') {
                // echo str_replace(' ', '', substr($date, 3)).' '.$hours.':00';
                $liberado =  $this->schedule_model->hour_compare(str_replace(' ', '', substr($date, 3)) . ' ' . $hours . ':00', $user_id);
                //var_dump($liberado); 10:45 AM To 11:00 AM
                if (!$liberado) {
                    $dateee['aslots'][$c] = date("g:i A", strtotime($hours)) . " To " . date('g:i A', strtotime('+1 hours', strtotime($hours)));
                    $data = $data . '<div><button class="btn btn-info round buttonhours">' . $hours . '</button>
     </div>';
                } else {
                    //$dateee['aslots'][$c] = $hours;
                    $data = $data . '<div><button class="btn btn round buttonhours" disabled>' . $hours . '</button>
         </div>';
                }
            }
        }
        if ($dateee['aslots'] == null) {
            $dateee['aslots'] = array('1' => 'Nenhuma horário disponível');
        }

        echo json_encode($dateee); //echo die(die(($data)));
    }
}

/* End of file schedule.php */
/* Location: ./application/modules/schedule/controllers/schedule.php */
