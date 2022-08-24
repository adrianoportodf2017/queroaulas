<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Teacher extends MX_Controller {

    function __construct() {
        parent::__construct();

        $this->load->model('teacher_model');
        $this->load->model('appointment/appointment_model');
        $this->load->model('client/client_model');
        $this->load->model('schedule/schedule_model');
        $this->load->module('client');

        if (!$this->ion_auth->in_group(array('admin', 'Accountant', 'Teacher', 'Receptionist', 'Nurse', 'Laboratorist', 'client'))) {
          //  redirect('home/permission');
        }
    }

    public function index() {

        $data['teacher'] = $this->teacher_model->getTeacher();
        $this->load->view('home/dashboard'); // just the header file
        $this->load->view('teacher', $data);
        $this->load->view('home/footer'); // just the header file
    }

    public function addNewView() {
        $data = array();
        $this->load->view('home/dashboard'); // just the header file
        $this->load->view('add_new', $data);
        $this->load->view('home/footer'); // just the header file
    }

    public function addNew() {

        $id = $this->input->post('id');
        $name = $this->input->post('name');
        $password = $this->input->post('password');
        $email = $this->input->post('email');
        $address = $this->input->post('address');
        $phone = $this->input->post('phone');
        $profile = $this->input->post('profile');
        $cpf = $this->input->post('cpf');
        $cellphone = $this->input->post('cellphone');
        $postal_code = $this->input->post('postal_code');
        $country = $this->input->post('country');
        $state = $this->input->post('state');
        $city = $this->input->post('city');
        $district = $this->input->post('district');
        $complement = $this->input->post('complement');
        $number = $this->input->post('number');
        $date_of_birth = $this->input->post('date_of_birth');
        $biography = $this->input->post('biography');
        $crp = $this->input->post('crp');
        $specialties = $this->input->post('specialties');
        $facebook = $this->input->post('facebook');
        $instagram = $this->input->post('instagram');
        $linkedin = $this->input->post('linkedin');
        $recipient_id = $this->input->post('recipient_id');
        $amount_to_pay = $this->input->post('amount_to_pay');
        $status = $this->input->post('status');


        $this->load->library('form_validation');
        $this->form_validation->set_error_delimiters('<div class="error">', '</div>');
        // Validating Name Field
        $this->form_validation->set_rules('name', 'Name', 'trim|required|min_length[1]|max_length[100]|xss_clean');
        // Validating Password Field
        if (empty($id)) {
            $this->form_validation->set_rules('password', 'Password', 'trim|required|min_length[5]|max_length[100]|xss_clean');
        }
        // Validating Email Field
        $this->form_validation->set_rules('email', 'Email', 'trim|required|min_length[5]|max_length[100]|xss_clean');
        // Validating Address Field   
        $this->form_validation->set_rules('address', 'Address', 'trim|required|min_length[1]|max_length[500]|xss_clean');
        // Validating Phone Field           
        $this->form_validation->set_rules('phone', 'Phone', 'trim|required|min_length[1]|max_length[50]|xss_clean');
        // Validating Phone Field           


        if ($this->form_validation->run() == FALSE) {
            if (!empty($id)) {
                $data = array();
                $data['teacher'] = $this->teacher_model->getTeacherById($id);
                $this->load->view('home/dashboard'); // just the header file
                $this->load->view('add_new', $data);
                $this->load->view('home/footer'); // just the footer file
            } else {
                $data = array();
                $data['setval'] = 'setval';
                $this->load->view('home/dashboard'); // just the header file
                $this->load->view('add_new', $data);
                $this->load->view('home/footer'); // just the header file
            }
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
                    'profile' => $profile,
                    'cpf' => $cpf,
                    'cellphone' => $cellphone,
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
                    'crp' => $crp,
                    'specialties' => $specialties,
                    'facebook' => $facebook,
                    'instagram' => $instagram,
                    'linkedin' => $linkedin,
                    'recipient_id' => $recipient_id,
                    'amount_to_pay' => $amount_to_pay,
                    'status' => $status,
                    
                );
            } else {
                //$error = array('error' => $this->upload->display_errors());
                $data = array();
                $data = array(
                    'name' => $name,
                    'email' => $email,
                    'address' => $address,
                    'phone' => $phone,
                    'profile' => $profile,
                    'cpf' => $cpf,
                    'cellphone' => $cellphone,
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
                    'crp' => $crp,
                    'specialties' => $specialties,
                    'facebook' => $facebook,
                    'instagram' => $instagram,
                    'linkedin' => $linkedin,
                    'recipient_id' => $recipient_id,
                    'amount_to_pay' => $amount_to_pay,
                    'status' => $status,

                    
                );
            }
            $username = $this->input->post('name');
            if (empty($id)) {     // Adding New teacher
                if ($this->ion_auth->email_check($email)) {
                    $this->session->set_flashdata('feedback', lang('this_email_address_is_already_registered'));
                    redirect('teacher/addNewView');
                } else {
                    $dfg = 4;
                    $this->ion_auth->register($username, $password, $email, $dfg);
                    $ion_user_id = $this->db->get_where('users', array('email' => $email))->row()->id;
                    $this->teacher_model->insertTeacher($data);
                    $teacher_user_id = $this->db->get_where('teacher', array('email' => $email))->row()->id;
                    $id_info = array('ion_user_id' => $ion_user_id);
                    $this->teacher_model->updateTeacher($teacher_user_id, $id_info);

                    //sms
                    $set['settings'] = $this->settings_model->getSettings();
                    $autosms = $this->sms_model->getAutoSmsByType('teacher');
                    $message = $autosms->message;
                    $to = $phone;
                    $name1 = explode(' ', $name);
                    if (!isset($name1[1])) {
                        $name1[1] = null;
                    }
                    $data1 = array(
                        'firstname' => $name1[0],
                        'lastname' => $name1[1],
                        'name' => $name,
                        'company' => $set['settings']->system_vendor
                    );

                    if ($autosms->status == 'Active') {
                        $messageprint = $this->parser->parse_string($message, $data1);
                        $data2[] = array($to => $messageprint);
                        $this->sms->sendSms($to, $message, $data2);
                    }
                    //end
                    //email

                    $autoemail = $this->email_model->getAutoEmailByType('teacher');
                    if ($autoemail->status == 'Active') {
                        $mail_provider = $this->settings_model->getSettings()->emailtype;
                        $settngs_name = $this->settings_model->getSettings()->system_vendor;
                        $email_Settings = $this->email_model->getEmailSettingsByType($mail_provider);

                        $this->load->library('encryption');

                        $message1 = $autoemail->message;
                        $messageprint1 = $this->parser->parse_string($message1, $data1);
                        $messageprint1 =      '
                        <body style="width:100%;font-family:roboto, helvetica neue, helvetica, arial, sans-serif;-webkit-text-size-adjust:100%;-ms-text-size-adjust:100%;padding:0;Margin:0"> 
                         <div class="es-wrapper-color" style="background-color:#F4F6F7"><!--[if gte mso 9]>
                                   <v:background xmlns:v="urn:schemas-microsoft-com:vml" fill="t">
                                       <v:fill type="tile" color="#f4f6f7"></v:fill>
                                   </v:background>
                               <![endif]--> 
                          <table class="es-wrapper" width="100%" cellspacing="0" cellpadding="0" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;padding:0;Margin:0;width:100%;height:100%;background-repeat:repeat;background-position:center top"> 
                            <tr style="border-collapse:collapse"> 
                             <td valign="top" style="padding:0;Margin:0"> 
                             
                              <table cellpadding="0" cellspacing="0" class="es-content" align="center" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;table-layout:fixed !important;width:100%"> 
                                <tr style="border-collapse:collapse"> 
                                 <td align="center" style="padding:0;Margin:0"> 
                                 </td> 
                                </tr> 
                              </table> 
                              <table cellpadding="0" cellspacing="0" class="es-content" align="center" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;table-layout:fixed !important;width:100%"> 
                                <tr style="border-collapse:collapse"> 
                                 <td align="center" style="padding:0;Margin:0"> 
                                  <table bgcolor="#ffffff" class="es-content-body" align="center" cellpadding="0" cellspacing="0" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;background-color:#FFFFFF;width:600px"> 
                                    <tr style="border-collapse:collapse"> 
                                     <td align="left" style="Margin:0;padding-top:20px;padding-bottom:20px;padding-left:20px;padding-right:20px"> 
                                      <table cellpadding="0" cellspacing="0" width="100%" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px"> 
                                        <tr style="border-collapse:collapse"> 
                                         <td align="center" valign="top" style="padding:0;Margin:0;width:560px"> 
                                          <table cellpadding="0" cellspacing="0" width="100%" role="presentation" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px"> 
                                            <tr style="border-collapse:collapse"> 
                                             <td align="center" style="padding:0;Margin:0;font-size:0px"><img class="adapt-img" src="https://wfxwwh.stripocdn.email/content/guids/CABINET_ba1dc69d2f0c28d345af75441d95b415/images/logoQuero Aulaspngtransparente1768x480.png" alt style="display:block;border:0;outline:none;text-decoration:none;-ms-interpolation-mode:bicubic" width="560"></td> 
                                            </tr> 
                                            <tr style="border-collapse:collapse"> 
                                             <td align="center" style="padding:0;Margin:0;padding-bottom:10px;font-size:0"><img src="https://wfxwwh.stripocdn.email/content/guids/CABINET_23b09dc352206b9a3436692531aaf1f2/images/48401577371549314.png" alt style="display:block;border:0;outline:none;text-decoration:none;-ms-interpolation-mode:bicubic" width="41"></td> 
                                            </tr> 
                                          </table></td> 
                                        </tr> 
                                        <tr style="border-collapse:collapse"> 
                                         <td align="center" valign="top" style="padding:0;Margin:0;width:560px"> 
                                          <table cellpadding="0" cellspacing="0" width="100%" role="presentation" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px"> 
                                            <tr style="border-collapse:collapse"> 
                                             <td align="center" style="padding:0;Margin:0;padding-top:5px"><p style="Margin:0;-webkit-text-size-adjust:none;-ms-text-size-adjust:none;mso-line-height-rule:exactly;font-family:roboto, helvetica neue , helvetica, arial, sans-serif;line-height:24px;color:#333333;font-size:16px">Lorem ipsum dolor sit amet</p></td> 
                                            </tr> 
                                          </table></td> 
                                        </tr> 
                                        <tr style="border-collapse:collapse"> 
                                         <td align="center" valign="top" style="padding:0;Margin:0;width:560px"> 
                                          <table cellpadding="0" cellspacing="0" width="100%" role="presentation" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px"> 
                                            <tr style="border-collapse:collapse"> 
                                             <td align="center" style="padding:0;Margin:0;padding-top:15px"><p style="Margin:0;-webkit-text-size-adjust:none;-ms-text-size-adjust:none;mso-line-height-rule:exactly;font-family:roboto, helvetica neue , helvetica, arial, sans-serif;line-height:24px;color:#333333;font-size:16px">Lorem ipsum dolor sit amet, et vix regione praesent, ut habeo dictas vocent duo. Omnes detracto sea in, no audiam labitur intellegam vim. No esse quot vidit ius. Dicit platonem comprehensam eos ad. Wisi solet inermis cum id. Ne fastidii definiebas cum.</p></td> 
                                            </tr> 
                                            <tr class="es-visible-simple-html-only" style="border-collapse:collapse"> 
                                             <td align="center" style="padding:0;Margin:0;padding-top:15px">
                                             <span class="es-button-border" style="border-style:solid;border-color:#345DFE;background:#BAE8E8;border-width:0px;display:inline-block;border-radius:3px;width:auto">
                                            '.$messageprint1.'
                                             </span>
                                             </td> 
                                            </tr> 
                                          </table></td> 
                                        </tr> 
                                      </table></td> 
                                    </tr> 
                                  </table></td> 
                                </tr> 
                              </table> 
                              <table cellpadding="0" cellspacing="0" class="es-content" align="center" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;table-layout:fixed !important;width:100%"> 
                                <tr style="border-collapse:collapse"> 
                                 <td align="center" style="padding:0;Margin:0"> 
                                  <table bgcolor="#ffffff" class="es-content-body" align="center" cellpadding="0" cellspacing="0" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;background-color:#FFFFFF;width:600px"> 
                                    <tr style="border-collapse:collapse"> 
                                     <td align="left" bgcolor="transparent" style="Margin:0;padding-top:10px;padding-bottom:10px;padding-left:20px;padding-right:20px;background-color:transparent"> 
                                      <table cellpadding="0" cellspacing="0" width="100%" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px"> 
                                        <tr style="border-collapse:collapse"> 
                                         <td align="center" valign="top" style="padding:0;Margin:0;width:560px"> 
                                          <table cellpadding="0" cellspacing="0" width="100%" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px"> 
                                            <tr style="border-collapse:collapse"> 
                                             <td align="center" style="padding:0;Margin:0;display:none"></td> 
                                            </tr> 
                                          </table></td> 
                                        </tr> 
                                      </table></td> 
                                    </tr> 
                                  </table></td> 
                                </tr> 
                              </table> 
                              <table cellpadding="0" cellspacing="0" class="es-footer" align="center" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;table-layout:fixed !important;width:100%;background-color:transparent;background-repeat:repeat;background-position:center top"> 
                                <tr style="border-collapse:collapse"> 
                                 <td align="center" style="padding:0;Margin:0"> 
                                  <table bgcolor="#ffffff" class="es-footer-body" align="center" cellpadding="0" cellspacing="0" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;background-color:#FAFAFA;width:600px"> 
                                    <tr style="border-collapse:collapse"> 
                                     <td align="left" style="padding:0;Margin:0"> 
                                     </td> 
                                    </tr> 
                                    <tr style="border-collapse:collapse"> 
                                     <td align="left" style="padding:0;Margin:0"> 
                                      </td> 
                                    </tr> 
                                    <tr style="border-collapse:collapse"> 
                                     <td align="left" style="padding:0;Margin:0;padding-bottom:15px;padding-left:20px;padding-right:20px"> 
                                      <table cellpadding="0" cellspacing="0" width="100%" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px"> 
                                        <tr style="border-collapse:collapse"> 
                                         <td align="center" valign="top" style="padding:0;Margin:0;width:560px"> 
                                          <table cellpadding="0" cellspacing="0" width="100%" role="presentation" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px"> 
                                            <tr style="border-collapse:collapse"> 
                                             <td align="center" style="padding:0;Margin:0;padding-top:15px;padding-bottom:20px;font-size:0"> 
                                              <table cellpadding="0" cellspacing="0" class="es-table-not-adapt es-social" role="presentation" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px"> 
                                                <tr style="border-collapse:collapse"> 
                                                 <td align="center" valign="top" style="padding:0;Margin:0;padding-right:10px"><a target="_blank" href="https://viewstripo.email" style="-webkit-text-size-adjust:none;-ms-text-size-adjust:none;mso-line-height-rule:exactly;text-decoration:underline;color:#333333;font-size:13px"><img src="https://wfxwwh.stripocdn.email/content/assets/img/social-icons/logo-black/facebook-logo-black.png" alt="Fb" title="Facebook" width="32" style="display:block;border:0;outline:none;text-decoration:none;-ms-interpolation-mode:bicubic"></a></td> 
                                                 <td align="center" valign="top" style="padding:0;Margin:0"><a target="_blank" href="https://viewstripo.email" style="-webkit-text-size-adjust:none;-ms-text-size-adjust:none;mso-line-height-rule:exactly;text-decoration:underline;color:#333333;font-size:13px"><img src="https://wfxwwh.stripocdn.email/content/assets/img/social-icons/logo-black/instagram-logo-black.png" alt="Ig" title="Instagram" width="32" style="display:block;border:0;outline:none;text-decoration:none;-ms-interpolation-mode:bicubic"></a></td> 
                                                </tr> 
                                              </table></td> 
                                            </tr> 
                                          </table></td> 
                                        </tr> 
                                      </table></td> 
                                    </tr> 
                                  </table></td> 
                                </tr> 
                              </table> 
                             </td> 
                            </tr> 
                          </table> 
                         </div>  
                       ' ;

                        if ($mail_provider == 'Domain Email') {
                            $this->email->from($email_Settings->admin_email);
                        }
                        if ($mail_provider == 'Smtp') {
                            $this->email->from($email_Settings->user, $settngs_name);
                        }
                        $this->email->to($email);
                        $this->email->subject('Registration confirmation');
                        $this->email->message($messageprint1);
                        $this->email->send();
                    }

                    //end


                    $this->session->set_flashdata('feedback', lang('added'));
                }
            } else { // Updating teacher
                $ion_user_id = $this->db->get_where('teacher', array('id' => $id))->row()->ion_user_id;
                if (empty($password)) {
                    $password = $this->db->get_where('users', array('id' => $ion_user_id))->row()->password;
                } else {
                    $password = $this->ion_auth_model->hash_password($password);
                }
                $this->teacher_model->updateIonUser($username, $email, $password, $ion_user_id);
                $this->teacher_model->updateTeacher($id, $data);
                $this->session->set_flashdata('feedback', lang('updated'));
            }
            // Loading View
            redirect('teacher');
        }
    }

    function editTeacher() {
        $data = array();
        $id = $this->input->get('id');
        $data['teacher'] = $this->teacher_model->getTeacherById($id);
        $this->load->view('home/dashboard'); // just the header file
        $this->load->view('add_new', $data);
        $this->load->view('home/footer'); // just the footer file
    }

    function details() {

        $data = array();

        if ($this->ion_auth->in_group(array('Teacher'))) {
            $teacher_ion_id = $this->ion_auth->get_user_id();
            $id = $this->teacher_model->getTeacherByIonUserId($teacher_ion_id)->id;
        } else {
            redirect('home');
        }


        $data['teacher'] = $this->teacher_model->getTeacherById($id);
        //var_dump( $data['teacher']);die;

        $data['todays_appointments'] = $this->appointment_model->getAppointmentByTeacherByToday($id);
        $data['appointments'] = $this->appointment_model->getAppointmentByTeacher($id);
        $data['client'] = $this->client_model->getClient();
        $data['appointment_clients'] = $this->client->getClientByAppointmentByTeacherId($id);
        $data['teachers'] = $this->teacher_model->getTeacher();
//        $data['holidays'] = $this->schedule_model->getHolidaysByTeacher($id);
      //  $data['schedules'] = $this->schedule_model->getScheduleByTeacher($id);



        $this->load->view('home/dashboard', $data); // just the header file
        $this->load->view('details');
        $this->load->view('home/footer'); // just the footer file
    }

    function editTeacherByJason() {
        $id = $this->input->get('id');
        $data['teacher'] = $this->teacher_model->getTeacherById($id);
        echo json_encode($data);
    }

    function delete() {

        if ($this->ion_auth->in_group(array('Client'))) {
            redirect('home/permission');
        }

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
        $this->teacher_model->delete($id);
        $this->session->set_flashdata('feedback', lang('deleted'));
        redirect('teacher');
    }

    function getTeacher() {
        $requestData = $_REQUEST;
        $start = $requestData['start'];
        $limit = $requestData['length'];
        $search = $this->input->post('search')['value'];

        $order = $this->input->post("order");
        $columns_valid = array(
            "0" => "id",
            "1" => "name",
            "2" => "email",
            "3" => "phone",
        );
        $values = $this->settings_model->getColumnOrder($order, $columns_valid);
        $dir = $values[0];
        $order = $values[1];

        if ($limit == -1) {
            if (!empty($search)) {
                $data['teachers'] = $this->teacher_model->getTeacherBysearch($search, $order, $dir);
            } else {
                $data['teachers'] = $this->teacher_model->getTeacherWithoutSearch($order, $dir);
            }
        } else {
            if (!empty($search)) {
                $data['teachers'] = $this->teacher_model->getTeacherByLimitBySearch($limit, $start, $search, $order, $dir);
            } else {
                $data['teachers'] = $this->teacher_model->getTeacherByLimit($limit, $start, $order, $dir);
            }
        }
        //  $data['teachers'] = $this->teacher_model->getteacher();

        foreach ($data['teachers'] as $teacher) {
            if ($this->ion_auth->in_group(array('admin', 'Accountant', 'Receptionist'))) {
                $options1 = '<a type="button" class="btn btn-info btn-xs btn_width editbutton" title="' . lang('edit') . '" data-toggle="modal" data-id="' . $teacher->id . '"><i class="fa fa-edit"> </i> ' . lang('edit') . '</a>';
                //   $options1 = '<a class="btn btn-info btn-xs btn_width" title="' . lang('edit') . '" href="teacher/editteacher?id='.$teacher->id.'"><i class="fa fa-edit"> </i> ' . lang('edit') . '</a>';
            }
            $options2 = '<a class="btn btn-info btn-xs detailsbutton" title="' . lang('appointments') . '"  href="appointment/getAppointmentByTeacherId?id=' . $teacher->id . '"> <i class="fa fa-calendar"> </i> ' . lang('appointments') . '</a>';
            if ($this->ion_auth->in_group(array('admin', 'Accountant', 'Receptionist'))) {
                $options3 = '<a class="btn btn-info btn-xs btn_width delete_button" title="' . lang('delete') . '" href="teacher/delete?id=' . $teacher->id . '" onclick="return confirm(\'Are you sure you want to delete this item?\');"><i class="fa fa-trash"> </i> ' . lang('delete') . '</a>';
            }



            if ($this->ion_auth->in_group(array('admin', 'Accountant', 'Receptionist'))) {
                $options4 = '<a href="schedule/holidays?teacher=' . $teacher->id . '" class="btn btn-info btn-xs btn_width" data-toggle="modal" data-id="' . $teacher->id . '"><i class="fa fa-book"></i> ' . lang('holiday') . '</a>';
                $options5 = '<a href="schedule/timeSchedule?teacher=' . $teacher->id . '" class="btn btn-info btn-xs btn_width" data-toggle="modal" data-id="' . $teacher->id . '"><i class="fa fa-book"></i> ' . lang('time_schedule') . '</a>';
                $options6 = '<a type="button" class="btn btn-info btn-xs btn_width detailsbutton inffo" title="' . lang('info') . '" data-toggle="modal" data-id="' . $teacher->id . '"><i class="fa fa-info"> </i> ' . lang('info') . '</a>';
            }

            $info[] = array(
                $teacher->id,
                $teacher->name,
                $teacher->email,
                $teacher->phone,
                //  $options1 . ' ' . $options2 . ' ' . $options3,
                $options6 . ' ' . $options1 . ' ' . $options2 . ' ' . $options4 . ' ' . $options5 . ' ' . $options3,
                    //  $options2
            );
        }

        if (!empty($data['teachers'])) {
            $output = array(
                "draw" => intval($requestData['draw']),
                "recordsTotal" => $this->db->get('teacher')->num_rows(),
                "recordsFiltered" => $this->db->get('teacher')->num_rows(),
                "data" => $info
            );
        } else {
            $output = array(
                // "draw" => 1,
                "recordsTotal" => 0,
                "recordsFiltered" => 0,
                "data" => []
            );
        }

        echo json_encode($output);
    }

    public function geTeacherInfo() {
// Search term
        $searchTerm = $this->input->post('searchTerm');

// Get users
        $response = $this->teacher_model->getTeacherInfo($searchTerm);

        echo json_encode($response);
    }

    public function getTeacherWithAddNewOption() {
// Search term
        $searchTerm = $this->input->post('searchTerm');

// Get users
        $response = $this->teacher_model->getTeacherWithAddNewOption($searchTerm);

        echo json_encode($response);
    }

}

/* End of file teacher.php */
/* Location: ./application/modules/teacher/controllers/teacher.php */