<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Client extends MX_Controller
{

    function __construct()
    {
        parent::__construct();
        $this->load->model('client_model');
        $this->load->model('appointment/appointment_model');
        require APPPATH . 'third_party/stripe/stripe-php/init.php';
        $this->load->model('teacher/teacher_model');
        if (!$this->ion_auth->in_group(array('admin', 'Nurse', 'Client', 'Teacher', 'Laboratorist', 'Accountant', 'Receptionist'))) {
            redirect('home/permission');
        }
    }

    public function index()
    {
        if ($this->ion_auth->in_group(array('Client'))) {
            redirect('home/permission');
        }
        $data['teachers'] = $this->teacher_model->getTeacher();
        $data['groups'] = $this->donor_model->getBloodBank();
        $data['settings'] = $this->settings_model->getSettings();
        $this->load->view('home/dashboard'); // just the header file
        $this->load->view('client', $data);
        $this->load->view('home/footer'); // just the header file
    }

    public function customers()
    {
        if ($this->ion_auth->in_group(array('client'))) {
            redirect('home/permission');
        }

        $data = array();

        if ($this->ion_auth->in_group(array('Teacher'))) {
            $teacher_ion_id = $this->ion_auth->get_user_id();
            $id = $this->teacher_model->getTeacherByIonUserId($teacher_ion_id)->id;
        } else {
            redirect('home');
        }


        $data['teacher'] = $this->teacher_model->getteacherById($id);
        $data['settings'] = $this->settings_model->getSettings();
        $data['clients'] = $this->client_model->getclient();
        $this->load->view('home/dashboard', $data); // just the header file
        $this->load->view('customers');
        $this->load->view('home/footer'); // just the header file
    }

    public function calendar()
    {
        $data['settings'] = $this->settings_model->getSettings();
        $this->load->view('home/dashboard'); // just the header file
        $this->load->view('calendar', $data);
        $this->load->view('home/footer'); // just the header file
    }

    public function addNewView()
    {
        if ($this->ion_auth->in_group(array('client'))) {
            redirect('home/permission');
        }
        $data = array();
        $data['teachers'] = $this->teacher_model->getteacher();
        $data['groups'] = $this->donor_model->getBloodBank();
        $this->load->view('home/dashboard'); // just the header file
        $this->load->view('add_new', $data);
        $this->load->view('home/footer'); // just the header file
    }

    public function addNew()
    {

        if ($this->ion_auth->in_group(array('client'))) {
            redirect('home/permission');
        }

        $id = $this->input->post('id');
        $redirect = $this->input->get('redirect');
        if (empty($redirect)) {
            $redirect = $this->input->post('redirect');
        }
        $name = $this->input->post('name');
        $password = $this->input->post('password');
        $sms = $this->input->post('sms');
        $teacher = $this->input->post('teacher');
        $address = $this->input->post('address');
        $phone = $this->input->post('phone');
        $sex = $this->input->post('sex');
        $birthdate = $this->input->post('birthdate');
        $bloodgroup = $this->input->post('bloodgroup');
        $client_id = $this->input->post('p_id');
        if (empty($client_id)) {
            $client_id = rand(10000, 1000000);
        }
        if ((empty($id))) {
            $add_date = date('m/d/y');
            $registration_time = time();
        } else {
            $add_date = $this->client_model->getclientById($id)->add_date;
            $registration_time = $this->client_model->getclientById($id)->registration_time;
        }


        $email = $this->input->post('email');
        if (empty($email)) {
            $email = $name . '@' . $phone . '.com';
        }



        $this->load->library('form_validation');
        $this->form_validation->set_error_delimiters('<div class="error">', '</div>');

        // Validating Name Field
        $this->form_validation->set_rules('name', 'Name', 'trim|required|min_length[2]|max_length[100]|xss_clean');
        // Validating Password Field
        if (empty($id)) {
            $this->form_validation->set_rules('password', 'Password', 'trim|min_length[3]|max_length[100]|xss_clean');
        }
        // Validating Email Field
        $this->form_validation->set_rules('email', 'Email', 'trim|min_length[2]|max_length[100]|xss_clean');
        // Validating teacher Field
        //   $this->form_validation->set_rules('teacher', 'teacher', 'trim|min_length[1]|max_length[100]|xss_clean');
        // Validating Address Field   
        $this->form_validation->set_rules('address', 'Address', 'trim|required|min_length[2]|max_length[500]|xss_clean');
        // Validating Phone Field           
        $this->form_validation->set_rules('phone', 'Phone', 'trim|required|min_length[2]|max_length[50]|xss_clean');
        // Validating Email Field
        $this->form_validation->set_rules('sex', 'Sex', 'trim|min_length[2]|max_length[100]|xss_clean');
        // Validating Address Field   
        $this->form_validation->set_rules('birthdate', 'Birth Date', 'trim|min_length[2]|max_length[500]|xss_clean');
        // Validating Phone Field           
        $this->form_validation->set_rules('bloodgroup', 'Blood Group', 'trim|min_length[1]|max_length[10]|xss_clean');


        if ($this->form_validation->run() == FALSE) {
            if (!empty($id)) {
                $this->session->set_flashdata('feedback', lang('validation_error'));
                redirect("client/editclient?id=$id");
            } else {
                $data = array();
                $data['setval'] = 'setval';
                $data['teachers'] = $this->teacher_model->getteacher();
                $data['groups'] = $this->donor_model->getBloodBank();
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
                'max_size' => "10000000", // Can be set to particular file size , here it is 2 MB(2048 Kb)
                'max_height' => "10000",
                'max_width' => "10000"
            );

            $this->load->library('Upload', $config);
            $this->upload->initialize($config);

            if ($this->upload->do_upload('img_url')) {
                $path = $this->upload->data();
                $img_url = "uploads/" . $path['file_name'];
                $data = array();
                $data = array(
                    'client_id' => $client_id,
                    'img_url' => $img_url,
                    'name' => $name,
                    'email' => $email,
                    'address' => $address,
                    'teacher' => $teacher,
                    'phone' => $phone,
                    'sex' => $sex,
                    'birthdate' => $birthdate,
                    'bloodgroup' => $bloodgroup,
                    'add_date' => $add_date,
                    'registration_time' => $registration_time
                );
            } else {
                //$error = array('error' => $this->upload->display_errors());
                $data = array();
                $data = array(
                    'client_id' => $client_id,
                    'name' => $name,
                    'email' => $email,
                    'teacher' => $teacher,
                    'address' => $address,
                    'phone' => $phone,
                    'sex' => $sex,
                    'birthdate' => $birthdate,
                    'bloodgroup' => $bloodgroup,
                    'add_date' => $add_date,
                    'registration_time' => $registration_time
                );
            }

            $username = $this->input->post('name');

            if (empty($id)) {     // Adding New client
                if ($this->ion_auth->email_check($email)) {
                    $this->session->set_flashdata('feedback', lang('this_email_address_is_already_registered'));
                    redirect('client/addNewView');
                } else {
                    $dfg = 5;
                    $this->ion_auth->register($username, $password, $email, $dfg);
                    $ion_user_id = $this->db->get_where('users', array('email' => $email))->row()->id;
                    $this->client_model->insertclient($data);
                    $client_user_id = $this->db->get_where('client', array('email' => $email))->row()->id;
                    $id_info = array('ion_user_id' => $ion_user_id);
                    $this->client_model->updateclient($client_user_id, $id_info);
                    //sms
                    $set['settings'] = $this->settings_model->getSettings();
                    $autosms = $this->sms_model->getAutoSmsByType('client');
                    $message = $autosms->message;
                    $teachername = $this->teacher_model->getteacherById($teacher)->name;
                    $to = $phone;
                    $name1 = explode(' ', $name);
                    if (!isset($name1[1])) {
                        $name1[1] = null;
                    }
                    $data1 = array(
                        'firstname' => $name1[0],
                        'lastname' => $name1[1],
                        'name' => $name,
                        'teacher' => $teachername,
                        'company' => $set['settings']->system_vendor
                    );
                    //   if (!empty($sms)) {
                    // $this->sms->sendSmsDuringclientRegistration($client_user_id);
                    if ($autosms->status == 'Active') {
                        $messageprint = $this->parser->parse_string($message, $data1);
                        $data2[] = array($to => $messageprint);
                        $this->sms->sendSms($to, $message, $data2);
                    }
                    //end
                    //  }
                    //email

                    $autoemail = $this->email_model->getAutoEmailByType('client');
                    if ($autoemail->status == 'Active') {
                        $mail_provider = $this->settings_model->getSettings()->emailtype;
                        $settngs_name = $this->settings_model->getSettings()->system_vendor;
                        $email_Settings = $this->email_model->getEmailSettingsByType($mail_provider);
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
                        //  $this->email->from($emailSettings->admin_email);
                        $this->email->to($email);
                        $this->email->subject('Registration confirmation');
                        $this->email->message($messageprint1);
                        $this->email->send();



                        $mail_provider = $this->settings_model->getSettings()->emailtype;
                        $settngs_name = $this->settings_model->getSettings()->system_vendor;
                        $emailSettings = $this->email_model->getEmailSettingsByType($mail_provider);
                        $base_url = str_replace(array('http://', 'https://', '/'), '', base_url());
                        $subject = $base_url . ' - client Registration Details';
                        $message = 'Dear ' . $name . ', Thank you for the registration. <br> Here is your login details.<br> <br> Link: ' . base_url() . 'auth/login <br> Username: ' . $email . ' <br> Password: ' . $password . '<br><br> Thank You, <br>' . $this->settings->title;
                       
                       $message =    '
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
                                           '. $message.'
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
                            $this->email->from($emailSettings->admin_email);
                        }
                        if ($mail_provider == 'Smtp') {
                            $this->email->from($emailSettings->user, $settngs_name);
                        }
                        $this->email->to($email);
                        $this->email->subject($subject);
                        $this->email->message($message);
                        $this->email->send();
                    }

                    //end



                    $this->session->set_flashdata('feedback', lang('added'));
                }
                //    }
            } else { // Updating client
                $ion_user_id = $this->db->get_where('client', array('id' => $id))->row()->ion_user_id;
                if (empty($password)) {
                    $password = $this->db->get_where('users', array('id' => $ion_user_id))->row()->password;
                } else {
                    $password = $this->ion_auth_model->hash_password($password);
                }
                $this->client_model->updateIonUser($username, $email, $password, $ion_user_id);
                $this->client_model->updateclient($id, $data);
                $this->session->set_flashdata('feedback', lang('updated'));
            }
            // Loading View
            if (!empty($redirect)) {
                redirect($redirect);
            } else {
                redirect('client');
            }
        }
    }

    function editclient()
    {
        $data = array();
        $id = $this->input->get('id');
        $data['client'] = $this->client_model->getclientById($id);
        $data['teachers'] = $this->teacher_model->getteacher();
        $data['groups'] = $this->donor_model->getBloodBank();
        $this->load->view('home/dashboard'); // just the header file
        $this->load->view('add_new', $data);
        $this->load->view('home/footer'); // just the footer file
    }

    function editclientByJason()
    {
        $id = $this->input->get('id');
        $data['client'] = $this->client_model->getclientById($id);
        $data['teacher'] = $this->teacher_model->getteacherById($data['client']->teacher);
        echo json_encode($data);
    }

    function getclientByJason()
    {
        $id = $this->input->get('id');
        $data['client'] = $this->client_model->getclientById($id);

        $teacher = $data['client']->teacher;
        $data['teacher'] = $this->teacher_model->getteacherById($teacher);

        if (!empty($data['client']->birthdate)) {
            $birthDate = strtotime($data['client']->birthdate);
            $birthDate = date('m/d/Y', $birthDate);
            $birthDate = explode("/", $birthDate);
            $age = (date("md", date("U", mktime(0, 0, 0, $birthDate[0], $birthDate[1], $birthDate[2]))) > date("md") ? ((date("Y") - $birthDate[2]) - 1) : (date("Y") - $birthDate[2]));
            $data['age'] = $age . ' Year(s)';
        }

        echo json_encode($data);
    }

    function clientDetails()
    {
        $data = array();
        $id = $this->input->get('id');
        $data['client'] = $this->client_model->getclientById($id);
        $this->load->view('home/dashboard'); // just the header file
        $this->load->view('details', $data);
        $this->load->view('home/footer'); // just the footer file
    }

    function report()
    {
        $data = array();
        $id = $this->input->get('id');
        $data['settings'] = $this->settings_model->getSettings();
        $data['payment'] = $this->finance_model->getPaymentById($id);
        $this->load->view('home/dashboard'); // just the header file
        $this->load->view('diagnostic_report_details', $data);
        $this->load->view('home/footer'); // just the footer file
    }

    function addDiagnosticReport()
    {
        $id = $this->input->post('id');
        $invoice = $this->input->post('invoice');
        $client = $this->input->post('client');
        $report = $this->input->post('report');

        $date = time();

        $this->load->library('form_validation');
        $this->form_validation->set_error_delimiters('<div class="error">', '</div>');


        // Validating Name Field
        $this->form_validation->set_rules('invoice', 'Invoice', 'trim|required|min_length[1]|max_length[100]|xss_clean');
        // Validating Password Field

        $this->form_validation->set_rules('report', 'Report', 'trim|min_length[1]|max_length[10000]|xss_clean');


        if ($this->form_validation->run() == FALSE) {
            $this->session->set_flashdata('feedback', lang('validation_error'));
            redirect('client/report?id=' . $invoice);
        } else {

            //$error = array('error' => $this->upload->display_errors());
            $data = array();
            $data = array(
                'invoice' => $invoice,
                'date' => $date,
                'report' => $report
            );

            if (empty($id)) {     // Adding New department
                $this->client_model->insertDiagnosticReport($data);
                $this->session->set_flashdata('feedback', lang('added'));
            } else { // Updating department
                $this->client_model->updateDiagnosticReport($id, $data);
                $this->session->set_flashdata('feedback', lang('updated'));
            }
            // Loading View
            redirect('client/report?id=' . $invoice);
        }
    }

    function clientPayments()
    {
        $data['groups'] = $this->donor_model->getBloodBank();
        $data['settings'] = $this->settings_model->getSettings();
        $this->load->view('home/dashboard'); // just the header file
        $this->load->view('client_payments', $data);
        $this->load->view('home/footer'); // just the header file
    }

    function caseList()
    {
        $data['settings'] = $this->settings_model->getSettings();
        $data['clients'] = $this->client_model->getclient();
        $data['client_histories'] = $this->client_model->getclientHistory();
        $this->load->view('home/dashboard'); // just the header file
        $this->load->view('case_list', $data);
        $this->load->view('home/footer'); // just the footer file
    }

    function documents()
    {
        $data['clients'] = $this->client_model->getclient();
        $data['files'] = $this->client_model->getclientMaterial();
        $this->load->view('home/dashboard'); // just the header file
        $this->load->view('documents', $data);
        $this->load->view('home/footer'); // just the footer file
    }

    function myCaseList()
    {
        if ($this->ion_auth->in_group(array('client'))) {
            $client_ion_id = $this->ion_auth->get_user_id();
            $client_id = $this->client_model->getclientByIonUserId($client_ion_id)->id;
            $data['client_histories'] = $this->client_model->getclientHistoryByclientId($client_id);
            $this->load->view('home/dashboard'); // just the header file
            $this->load->view('my_case_list', $data);
            $this->load->view('home/footer'); // just the footer file
        }
    }

    function myDocuments()
    {
        if ($this->ion_auth->in_group(array('client'))) {
            $client_ion_id = $this->ion_auth->get_user_id();
            $client_id = $this->client_model->getclientByIonUserId($client_ion_id)->id;
            $data['files'] = $this->client_model->getclientMaterialByclientId($client_id);
            $this->load->view('home/dashboard'); // just the header file
            $this->load->view('my_documents', $data);
            $this->load->view('home/footer'); // just the footer file
        }
    }

    function myPrescription()
    {
        if ($this->ion_auth->in_group(array('client'))) {
            $client_ion_id = $this->ion_auth->get_user_id();
            $client_id = $this->client_model->getclientByIonUserId($client_ion_id)->id;
            $data['teachers'] = $this->teacher_model->getteacher();
            $data['prescriptions'] = $this->prescription_model->getPrescriptionByclientId($client_id);
            $data['settings'] = $this->settings_model->getSettings();
            $this->load->view('home/dashboard', $data); // just the header file
            $this->load->view('my_prescription', $data);
            $this->load->view('home/footer'); // just the header file
        }
    }

    public function myPayment()
    {
        if ($this->ion_auth->in_group(array('client'))) {
            $client_ion_id = $this->ion_auth->get_user_id();
            $client_id = $this->client_model->getclientByIonUserId($client_ion_id)->id;
            $data['settings'] = $this->settings_model->getSettings();
            $data['payments'] = $this->finance_model->getPaymentByclientId($client_id);
            $this->load->view('home/dashboard'); // just the header file
            $this->load->view('my_payment', $data);
            $this->load->view('home/footer'); // just the header file
        }
    }

    function myPaymentHistory()
    {
        if (!$this->ion_auth->logged_in()) {
            redirect('auth/login', 'refresh');
        }


        if ($this->ion_auth->in_group(array('client'))) {
            $client_ion_id = $this->ion_auth->get_user_id();
            $client = $this->client_model->getclientByIonUserId($client_ion_id)->id;
        }
        $data['settings'] = $this->settings_model->getSettings();
        $date_from = strtotime($this->input->post('date_from'));
        $date_to = strtotime($this->input->post('date_to'));
        if (!empty($date_to)) {
            $date_to = $date_to + 86399;
        }

        $data['date_from'] = $date_from;
        $data['date_to'] = $date_to;

        if (!empty($date_from)) {
            $data['payments'] = $this->finance_model->getPaymentByclientIdByDate($client, $date_from, $date_to);
            $data['deposits'] = $this->finance_model->getDepositByclientIdByDate($client, $date_from, $date_to);
            $data['gateway'] = $this->finance_model->getGatewayByName($data['settings']->payment_gateway);
        } else {
            $data['payments'] = $this->finance_model->getPaymentByclientId($client);
            $data['pharmacy_payments'] = $this->pharmacy_model->getPaymentByclientId($client);
            $data['ot_payments'] = $this->finance_model->getOtPaymentByclientId($client);
            $data['deposits'] = $this->finance_model->getDepositByclientId($client);
            $data['gateway'] = $this->finance_model->getGatewayByName($data['settings']->payment_gateway);
        }



        $data['client'] = $this->client_model->getclientByid($client);
        $data['settings'] = $this->settings_model->getSettings();



        $this->load->view('home/dashboard'); // just the header file
        $this->load->view('my_payments_history', $data);
        $this->load->view('home/footer'); // just the header file
    }

    function deposit()
    {
        $id = $this->input->post('id');


        if ($this->ion_auth->in_group(array('client'))) {
            $client_ion_id = $this->ion_auth->get_user_id();
            $client = $this->client_model->getclientByIonUserId($client_ion_id)->id;
        } else {
            $this->session->set_flashdata('feedback', lang('undefined_client_id'));
            redirect('client/myPaymentsHistory');
        }



        $payment_id = $this->input->post('payment_id');
        $date = time();

        $deposited_amount = $this->input->post('deposited_amount');

        $deposit_type = $this->input->post('deposit_type');

        if ($deposit_type != 'Card') {
            $this->session->set_flashdata('feedback', lang('undefined_payment_type'));
            redirect('client/myPaymentsHistory');
        }

        $user = $this->ion_auth->get_user_id();

        $this->load->library('form_validation');
        $this->form_validation->set_error_delimiters('<div class="error">', '</div>');
        // Validating client Name Field
        $this->form_validation->set_rules('client', 'client', 'trim|min_length[1]|max_length[100]|xss_clean');
        // Validating Deposited Amount Field
        $this->form_validation->set_rules('deposited_amount', 'Deposited Amount', 'trim|min_length[1]|max_length[100]|xss_clean');
        if ($this->form_validation->run() == FALSE) {
            redirect('client/myPaymentsHistory');
        } else {
            $data = array();
            $data = array(
                'client' => $client,
                // 'date' => $date,
                'payment_id' => $payment_id,
                'deposited_amount' => $deposited_amount,
                'deposit_type' => $deposit_type,
                'user' => $user
            );
            if (empty($id)) {
                $data['date'] = $date;
            }
            if (empty($id)) {
                if ($deposit_type == 'Card') {
                    $payment_details = $this->finance_model->getPaymentById($payment_id);

                    $gateway = $this->settings_model->getSettings()->payment_gateway;

                    if ($gateway == 'PayPal') {
                        $card_type = $this->input->post('card_type');
                        $card_number = $this->input->post('card_number');
                        $expire_date = $this->input->post('expire_date');
                        $cvv = $this->input->post('cvv_number');
                        $cardholdername = $this->input->post('cardholder');
                        $all_details = array(
                            'client' => $payment_details->client,
                            'date' => $payment_details->date,
                            'amount' => $payment_details->amount,
                            'teacher' => $payment_details->teacher_name,
                            'discount' => $payment_details->discount,
                            'flat_discount' => $payment_details->flat_discount,
                            'gross_total' => $payment_details->gross_total,
                            'status' => 'unpaid',
                            'client_name' => $payment_details->client_name,
                            'client_phone' => $payment_details->client_phone,
                            'client_address' => $payment_details->client_address,
                            'deposited_amount' => $deposited_amount,
                            'payment_id' => $payment_details->id,
                            'card_type' => $card_type,
                            'card_number' => $card_number,
                            'expire_date' => $expire_date,
                            'cvv' => $cvv,
                            'from' => 'client_payment_details',
                            'user' => $user,
                            'cardholdername' => $cardholdername
                        );

                        $this->paypal->paymentPaypal($all_details);
                    } elseif ($gateway == '2Checkout') {

                        $card_type = $this->input->post('card_type');
                        $card_number = $this->input->post('card_number');
                        $expire_date = $this->input->post('expire_date');
                        $cvv = $this->input->post('cvv');
                        $ref = date('Y') . rand() . date('d');
                        $amount = $deposited_amount;
                        $token = $this->input->post('token');
                        //   $token = $this->input->post('token');
                        //  $card_number = base64_encode($card_number);
                        //   $cvv = base64_encode($cvv);
                        //     if ($configuration) {
                        $datapayment = array(
                            'ref' => $ref,
                            'amount' => $amount,
                            'client' => $client,
                            'insertid' => $payment_id,
                            'card_type' => $card_type,
                            'card_number' => $card_number,
                            'expire_date' => $expire_date,
                            'cvv' => $cvv,
                            'cardholder' => $this->input->post('cardholder')
                        );

                        $this->load->module('twocheckoutpay');
                        $charge = $this->twocheckoutpay->createCharge($ref, $token, $amount, $datapayment);

                        if ($charge['response']['responseCode'] == 'APPROVED') {
                            $date = time();
                            $data1 = array(
                                'date' => $date,
                                'client' => $client,
                                'deposited_amount' => $deposited_amount,
                                'payment_id' => $payment_id,
                                'gateway' => '2Checkout',
                                'deposit_type' => $deposit_type,
                                'user' => $user
                            );
                            $this->finance_model->insertDeposit($data1);
                            $this->session->set_flashdata('feedback', lang('added'));
                            redirect('client/myPaymentHistory');
                        } else {
                            $this->session->set_flashdata('feedback', lang('transaction_failed'));
                            redirect('client/myPaymentHistory');
                        }
                    } elseif ($gateway == 'Authorize.Net') {

                        $card_type = $this->input->post('card_type');
                        $card_number = $this->input->post('card_number');
                        $expire_date = $this->input->post('expire_date');
                        $cvv = $this->input->post('cvv_number');
                        $ref = date('Y') . rand() . date('d');
                        $amount = $deposited_amount;

                        $card_number = base64_encode($card_number);
                        $cvv = base64_encode($cvv);
                        //     if ($configuration) {
                        $datapayment = array(
                            'ref' => $ref,
                            'amount' => $amount,
                            'client' => $client,
                            'insertid' => $payment_id,
                            'card_type' => $card_type,
                            'card_number' => $card_number,
                            'expire_date' => $expire_date,
                            'cvv' => $cvv,
                            //  'email'=>$client_email
                        );

                        $this->load->module('authorizenet');
                        $response = $this->authorizenet->paymentAuthorize($datapayment, 'patdep');
                        //  $this->authorizenet->reponseRedirectPageAuthorizenet($respose, $datapayment,'pos');
                        // $this->load->view('paytm/paytminfo', $datapayment);
                        //    }
                        // $email=$client_email;
                    } elseif ($gateway == 'Stripe') {
                        $card_number = $this->input->post('card_number');
                        $expire_date = $this->input->post('expire_date');
                        $cvv = $this->input->post('cvv_number');
                        $token = $this->input->post('token');

                        $stripe = $this->db->get_where('paymentGateway', array('name =' => 'Stripe'))->row();
                        \Stripe\Stripe::setApiKey($stripe->secret);
                        $charge = \Stripe\Charge::create(array(
                            "amount" => $deposited_amount * 100,
                            "currency" => "usd",
                            "source" => $token
                        ));
                        $chargeJson = $charge->jsonSerialize();
                        if ($chargeJson['status'] == 'succeeded') {
                            $data1 = array(
                                'client' => $client,
                                'date' => $date,
                                'payment_id' => $payment_id,
                                'deposited_amount' => $deposited_amount,
                                'deposit_type' => $deposit_type,
                                'gateway' => 'Stripe',
                                'deposit_type' => 'Card',
                                'user' => $user
                            );
                            $this->finance_model->insertDeposit($data1);
                            $this->session->set_flashdata('feedback', 'Added');
                            redirect('client/myPaymentHistory');
                        } else {
                            $this->session->set_flashdata('feedback', 'Payment failed.');
                            redirect('client/myPaymentHistory');
                        }
                    } elseif ($gateway == 'Paystack') {

                        $ref = date('Y') . '-' . rand() . date('d') . '-' . date('m');
                        $amount_in_kobo = $deposited_amount;
                        $this->load->module('paystack');
                        $this->paystack->paystack_standard($amount_in_kobo, $ref, $client, $payment_id, $user, '1');
                    } elseif ($gateway == 'SSLCOMMERZ') {
                        $this->load->module('sslcommerzpayment');
                        $this->sslcommerzpayment->request_api_hosted($deposited_amount, $client, $payment_id, $user, '0');
                    } elseif ($gateway == 'Paytm') {


                        $ref = date('Y') . '-' . rand() . date('d') . '-' . date('m') . '-1';
                        $amount = $deposited_amount;
                        $this->load->module('paytm');
                        // $configuration=$this->paytm->Configuration();
                        //   if($configuration){
                        $datapayment = array(
                            'ref' => $ref,
                            'amount' => $amount,
                            'client' => $client,
                            'insertid' => $payment_id,
                            'channel_id' => 'WEB',
                            'industry_type' => 'Retail',
                            //  'email'=>$client_email
                        );
                        //  $this->load->module('paytm/pgRedirects');
                        $this->paytm->PaytmGateway($datapayment);
                        //}
                        // $email=$client_email;
                    } elseif ($gateway == 'Pay U Money') {
                        redirect("payu/check?deposited_amount=" . "$deposited_amount" . '&payment_id=' . $payment_id);
                    } else {
                        $this->session->set_flashdata('feedback', lang('payment_failed_no_gateway_selected'));
                        redirect('client/myPaymentHistory');
                    }
                } else {
                    $this->finance_model->insertDeposit($data);
                    $this->session->set_flashdata('feedback', lang('added'));
                }
            } else {
                $this->finance_model->updateDeposit($id, $data);

                $amount_received_id = $this->finance_model->getDepositById($id)->amount_received_id;
                if (!empty($amount_received_id)) {
                    $amount_received_payment_id = explode('.', $amount_received_id);
                    $payment_id = $amount_received_payment_id[0];
                    $data_amount_received = array('amount_received' => $deposited_amount);
                    $this->finance_model->updatePayment($amount_received_payment_id[0], $data_amount_received);
                }

                $this->session->set_flashdata('feedback', lang('updated'));
                redirect('client/myPaymentHistory');
            }
        }
    }

    function myInvoice()
    {
        $id = $this->input->get('id');
        $data['settings'] = $this->settings_model->getSettings();
        $data['discount_type'] = $this->finance_model->getDiscountType();
        $data['payment'] = $this->finance_model->getPaymentById($id);
        $this->load->view('home/dashboard'); // just the header file
        $this->load->view('myInvoice', $data);
        $this->load->view('home/footer'); // just the footer fi
    }

    function addclientHistory()
    {
        $id = $this->input->post('id');
        $client_id = $this->input->post('client_id');

        $date = $this->input->post('date');

        $title = $this->input->post('title');

        if (!empty($date)) {
            $date = strtotime($date);
        } else {
            $date = time();
        }

        $description = $this->input->post('description');
        $this->load->library('form_validation');
        $this->form_validation->set_error_delimiters('<div class="error">', '</div>');

        $redirect = $this->input->post('redirect');
        if (empty($redirect)) {
            $redirect = 'client/clientHistory?id=' . $client_id;
        }

        // Validating Name Field
        $this->form_validation->set_rules('date', 'Date', 'trim|min_length[1]|max_length[100]|xss_clean');

        // Validating Title Field
        $this->form_validation->set_rules('title', 'Title', 'trim|min_length[1]|max_length[100]|xss_clean');

        // Validating Password Field

        $this->form_validation->set_rules('description', 'Description', 'trim|min_length[5]|max_length[10000]|xss_clean');


        if ($this->form_validation->run() == FALSE) {
            if (!empty($id)) {
                redirect("client/editclientHistory?id=$id");
            } else {
                $this->load->view('home/dashboard'); // just the header file
                $this->load->view('add_new');
                $this->load->view('home/footer'); // just the header file
            }
        } else {

            if (!empty($client_id)) {
                $client_details = $this->client_model->getclientById($client_id);
                $client_name = $client_details->name;
                $client_phone = $client_details->phone;
                $client_address = $client_details->address;
            } else {
                $client_name = 0;
                $client_phone = 0;
                $client_address = 0;
            }

            //$error = array('error' => $this->upload->display_errors());
            $data = array();
            $data = array(
                'client_id' => $client_id,
                'date' => $date,
                'title' => $title,
                'description' => $description,
                'client_name' => $client_name,
                'client_phone' => $client_phone,
                'client_address' => $client_address,
            );

            if (empty($id)) {     // Adding New department
                $this->client_model->insertclientHistory($data);
                $this->session->set_flashdata('feedback', lang('added'));
            } else { // Updating department
                $this->client_model->updateclientHistory($id, $data);
                $this->session->set_flashdata('feedback', lang('updated'));
            }
            // Loading View
            redirect($redirect);
        }
    }

    public function diagnosticReport()
    {
        if (!$this->ion_auth->logged_in()) {
            redirect('auth/login', 'refresh');
        }

        if ($this->ion_auth->in_group(array('client'))) {
            $current_user = $this->ion_auth->get_user_id();
            $client_user_id = $this->client_model->getclientByIonUserId($current_user)->id;
            $data['payments'] = $this->finance_model->getPaymentByclientId($client_user_id);
        } else {
            $data['payments'] = $this->finance_model->getPayment();
        }

        $data['settings'] = $this->settings_model->getSettings();
        $this->load->view('home/dashboard'); // just the header file
        $this->load->view('diagnostic_report', $data);
        $this->load->view('home/footer'); // just the header file
    }

    function clientHistory()
    {
        $data = array();
        $id = $this->session->userdata['user_id'];
        $client =  $this->client_model->getClientByIonUserId($id);
        $data['client'] = $this->client_model->getclientById($client->id);
       // var_dump($data['client']);
       // var_dump($client->id);
      

        if ($this->ion_auth->in_group(array('client'))) {
            $client_ion_id = $this->session->userdata['user_id'];
            $id = $client->id;
           // var_dump( $this->ion_auth->get_user_id());die;
        }

        if ($this->ion_auth->in_group(array('Teacher'))) {
            $teacher_ion_id = $this->ion_auth->get_user_id();
            $idTeacher = $this->teacher_model->getTeacherByIonUserId($teacher_ion_id)->id;
            $data['teacher'] = $this->teacher_model->getteacherById($idTeacher); 
        } 

        //var_dump($data['teacher']);die;    
        
        $data['appointments'] = $this->appointment_model->getAppointmentByclient($client->id);
        $data['first_name'] = $data['client']->name;    
        foreach ($data['appointments'] as $appointment) {
            $teacher_details = $this->teacher_model->getTeacherById($appointment->teacher);
            if (!empty($teacher_details)) {
                $teacher_name = $teacher_details->name;
            } else {
                $teacher_name = '';
            }
            $timeline[$appointment->date + 1] = '<div class="panel-body profile-activity" >
                <h5 class="pull-left"><span class="label pull-right r-activity">' . lang('appointment') . '</span></h5>
                                            <h5 class="pull-right">' . date('d-m-Y', $appointment->date) . '</h5>
                                            <div class="activity terques">
                                                <span>
                                                    <i class="fa fa-stethoscope"></i>
                                                </span>
                                                <div class="activity-desk">
                                                    <div class="panel col-md-6">
                                                        <div class="panel-body">
                                                            <div class="arrow"></div>
                                                            <i class=" fa fa-calendar"></i>
                                                            <h4>' . date('d-m-Y', $appointment->date) . '</h4>
                                                            <p></p>
                                                            <i class=" fa fa-user-md"></i>
                                                                <h4>' . $teacher_name . '</h4>
                                                                    <p></p>
                                                                    <i class=" fa fa-clock-o"></i>
                                                                <p>' . $appointment->s_time . ' - ' . $appointment->e_time . '</p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>';
        }
    

        if (!empty($timeline)) {
            $data['timeline'] = $timeline;
        }
        $this->load->view('home/dashboard', $data); // just the header file
       $this->load->view('client_history');
        $this->load->view('home/footer'); // just the footer file
    }

    function editclientHistoryByJason()
    {
        $id = $this->input->get('id');
        $data['client_history'] = $this->client_model->getclientHistoryById($id);
        $data['client'] = $this->client_model->getclientById($data['client_history']->client_id);
        echo json_encode($data);
    }

    function getCaseDetailsByJason()
    {
        $id = $this->input->get('id');
        $data['case'] = $this->client_model->getclientHistoryById($id);
        $client = $data['case']->client_id;
        $data['client'] = $this->client_model->getclientById($client);
        echo json_encode($data);
    }

    function getClientByAppointmentByTeacherId($teacher_id)
    {
        $data = array();
        $appointments = $this->appointment_model->getAppointmentByTeacher($teacher_id);
        foreach ($appointments as $appointment) {
            $client_exists = $this->client_model->getClientById($appointment->client);
            if (!empty($client_exists)) {
                $clients[] = $appointment->client;
            }
        }

        if (!empty($clients)) {
            $clients = array_unique($clients);
        } else {
            $clients = '';
        }

        return $clients;
    }

    function clientMaterial()
    {
        $data = array();
        $id = $this->input->get('client');
        $data['settings'] = $this->settings_model->getSettings();
        $data['client'] = $this->client_model->getclientById($id);
        $data['client_materials'] = $this->client_model->getclientMaterialByclientId($id);
        $this->load->view('home/dashboard', $data); // just the header file
        $this->load->view('client_material', $data);
        $this->load->view('home/footer'); // just the footer file
    }

    function addclientMaterial()
    {
        $title = $this->input->post('title');
        $client_id = $this->input->post('client');
        $img_url = $this->input->post('img_url');
        $date = time();
        $redirect = $this->input->post('redirect');

        if ($this->ion_auth->in_group(array('client'))) {
            if (empty($client_id)) {
                $current_client = $this->ion_auth->get_user_id();
                $client_id = $this->client_model->getclientByIonUserId($current_client)->id;
            }
        }


        if (empty($redirect)) {
            $redirect = "client/clientHistory?id=" . $client_id;
        }
        $this->load->library('form_validation');
        $this->form_validation->set_error_delimiters('<div class="error">', '</div>');

        // Validating client Field
        $this->form_validation->set_rules('client', 'client', 'trim|min_length[1]|max_length[100]|xss_clean');


        if ($this->form_validation->run() == FALSE) {
            $this->session->set_flashdata('feedback', lang('validation_error'));
            redirect($redirect);
        } else {

            if (!empty($client_id)) {
                $client_details = $this->client_model->getclientById($client_id);
                $client_name = $client_details->name;
                $client_phone = $client_details->phone;
                $client_address = $client_details->address;
            } else {
                $client_name = 0;
                $client_phone = 0;
                $client_address = 0;
            }






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
                'allowed_types' => "gif|jpg|png|jpeg|pdf|docx|doc|odt",
                'overwrite' => False,
                'max_size' => "48000000", // Can be set to particular file size , here it is 2 MB(2048 Kb)
                'max_height' => "10000",
                'max_width' => "10000"
            );

            $this->load->library('Upload', $config);
            $this->upload->initialize($config);

            if ($this->upload->do_upload('img_url')) {
                $path = $this->upload->data();
                $img_url = "uploads/" . $path['file_name'];
                $data = array();
                $data = array(
                    'date' => $date,
                    'title' => $title,
                    'url' => $img_url,
                    'client' => $client_id,
                    'client_name' => $client_name,
                    'client_address' => $client_address,
                    'client_phone' => $client_phone,
                    'date_string' => date('d-m-y', $date),
                );
            } else {
                $data = array();
                $data = array(
                    'date' => $date,
                    'title' => $title,
                    'client' => $client_id,
                    'client_name' => $client_name,
                    'client_address' => $client_address,
                    'client_phone' => $client_phone,
                    'date_string' => date('d-m-y', $date),
                );
                $this->session->set_flashdata('feedback', lang('upload_error'));
            }

            $this->client_model->insertclientMaterial($data);
            $this->session->set_flashdata('feedback', lang('added'));


            redirect($redirect);
        }
    }

    function deleteCaseHistory()
    {
        $id = $this->input->get('id');
        $redirect = $this->input->get('redirect');
        $case_history = $this->client_model->getclientHistoryById($id);
        $this->client_model->deleteclientHistory($id);
        $this->session->set_flashdata('feedback', lang('deleted'));
        if ($redirect == 'case') {
            redirect('client/caseList');
        } else {
            redirect("client/clientHistory?id=" . $case_history->client_id);
        }
    }

    function deleteclientMaterial()
    {
        $id = $this->input->get('id');
        $redirect = $this->input->get('redirect');
        $client_material = $this->client_model->getclientMaterialById($id);
        $path = $client_material->url;
        if (!empty($path)) {
            unlink($path);
        }
        $this->client_model->deleteclientMaterial($id);
        $this->session->set_flashdata('feedback', lang('deleted'));
        if ($redirect == 'documents') {
            redirect('client/documents');
        } else {
            redirect("client/clientHistory?id=" . $client_material->client);
        }
    }

    function delete()
    {
        $data = array();
        $id = $this->input->get('id');
        $user_data = $this->db->get_where('client', array('id' => $id))->row();
        $path = $user_data->img_url;

        if (!empty($path)) {
            unlink($path);
        }
        $ion_user_id = $user_data->ion_user_id;
        $this->db->where('id', $ion_user_id);
        $this->db->delete('users');
        $this->client_model->delete($id);
        $this->session->set_flashdata('feedback', lang('deleted'));
        redirect('client');
    }


    function getCustomers()
    {
        $requestData = $_REQUEST;
        $start = $requestData['start'];
        $limit = $requestData['length'];
        $search = $this->input->post('search')['value'];

        $order = $this->input->post("order");
        $columns_valid = array(
            "0" => "id",
            "1" => "name",
            "2" => "phone",
        );
        $values = $this->settings_model->getColumnOrder($order, $columns_valid);
        $dir = $values[0];
        $order = $values[1];

        if ($limit == -1) {
            if (!empty($search)) {
                $data['clients'] = $this->client_model->getclientBysearch($search, $order, $dir);
            } else {
                $data['clients'] = $this->client_model->getclientWithoutSearch($order, $dir);
            }
        } else {
            if (!empty($search)) {
                $data['clients'] = $this->client_model->getclientByLimitBySearch($limit, $start, $search, $order, $dir);
            } else {
                $data['clients'] = $this->client_model->getclientByLimit($limit, $start, $order, $dir);
            }
        }
        //  $data['clients'] = $this->client_model->getclient();

        foreach ($data['clients'] as $client) {

            if ($this->ion_auth->in_group(array('admin', 'Accountant', 'Receptionist', 'Laboratorist', 'Nurse', 'teacher'))) {
                //   $options1 = '<a type="button" class="btn editbutton" title="Edit" data-toggle="modal" data-id="463"><i class="fa fa-edit"> </i> Edit</a>';
                $options1 = ' <a type="button" class="btn editbutton" title="' . lang('edit') . '" data-toggle = "modal" data-id="' . $client->id . '"><i class="fa fa-edit"> </i> ' . lang('edit') . '</a>';
            }

            $options2 = '<a class="btn detailsbutton" title="' . lang('info') . '" style="color: #fff;" href="client/clientDetails?id=' . $client->id . '"><i class="fa fa-info"></i> ' . lang('info') . '</a>';

            $options3 = '<a class="btn green" title="' . lang('history') . '" style="color: #fff;" href="client/clientHistory?id=' . $client->id . '"><i class="fa fa-stethoscope"></i> ' . lang('history') . '</a>';

            $options4 = '<a class="btn invoicebutton" title="' . lang('payment') . '" style="color: #fff;" href="finance/clientPaymentHistory?client=' . $client->id . '"><i class="fa fa-money-bill-alt"></i> ' . lang('payment') . '</a>';

            if ($this->ion_auth->in_group(array('admin', 'Accountant', 'Receptionist', 'Laboratorist', 'Nurse', 'teacher'))) {
                $options5 = '<a class="btn delete_button" title="' . lang('delete') . '" href="client/delete?id=' . $client->id . '" onclick="return confirm(\'Are you sure you want to delete this item?\');"><i class="fa fa-trash"></i> ' . lang('delete') . '</a>';
            }

            $options6 = ' <a type="button" class="btn detailsbutton inffo" title="' . lang('info') . '" data-toggle = "modal" data-id="' . $client->id . '"><i class="fa fa-info"> </i> ' . lang('info') . '</a>';


            if ($this->ion_auth->in_group('teacher')) {
                $options7 = '<a class="btn green detailsbutton" title="' . lang('instant_meeting') . '" style="color: #fff;" href="meeting/instantLive?id=' . $client->id . '" onclick="return confirm(\'Are you sure you want to start a live meeting with this client? SMS and Email will be sent to the client.\');"><i class="fa fa-headphones"></i> ' . lang('start_live') . '</a>';
            } else {
                $options7 = '';
            }


            if ($this->ion_auth->in_group(array('admin'))) {
                $info[] = array(
                    $client->id,
                    $client->name,
                    $client->phone,
                    $this->settings_model->getSettings()->currency . $this->client_model->getDueBalanceByclientId($client->id),
                    $options1 . ' ' . $options6 . ' ' . $options3 . ' ' . $options4 . ' ' . $options5,
                    //  $options2
                );
            }

            if ($this->ion_auth->in_group(array('Accountant', 'Receptionist'))) {
                $info[] = array(
                    $client->id,
                    $client->name,
                    $client->phone,
                    $this->settings_model->getSettings()->currency . $this->client_model->getDueBalanceByclientId($client->id),
                    $options1 . ' ' . $options6 . ' ' . $options4,
                    //  $options2
                );
            }

            if ($this->ion_auth->in_group(array('Laboratorist', 'Nurse', 'teacher'))) {
                $info[] = array(
                    $client->id,
                    $client->name,
                    $client->phone,
                    $options1 . ' ' . $options6 . ' ' . $options3,
                    //  $options2
                );
            }
        }

        if (!empty($data['clients'])) {
            $output = array(
                "draw" => intval($requestData['draw']),
                "recordsTotal" => $this->db->get('client')->num_rows(),
                "recordsFiltered" => $this->db->get('client')->num_rows(),
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

    function getclient()
    {
        $requestData = $_REQUEST;
        $start = $requestData['start'];
        $limit = $requestData['length'];
        $search = $this->input->post('search')['value'];

        $order = $this->input->post("order");
        $columns_valid = array(
            "0" => "id",
            "1" => "name",
            "2" => "phone",
        );
        $values = $this->settings_model->getColumnOrder($order, $columns_valid);
        $dir = $values[0];
        $order = $values[1];

        if ($limit == -1) {
            if (!empty($search)) {
                $data['clients'] = $this->client_model->getclientBysearch($search, $order, $dir);
            } else {
                $data['clients'] = $this->client_model->getclientWithoutSearch($order, $dir);
            }
        } else {
            if (!empty($search)) {
                $data['clients'] = $this->client_model->getclientByLimitBySearch($limit, $start, $search, $order, $dir);
            } else {
                $data['clients'] = $this->client_model->getclientByLimit($limit, $start, $order, $dir);
            }
        }
        //  $data['clients'] = $this->client_model->getclient();

        foreach ($data['clients'] as $client) {

            if ($this->ion_auth->in_group(array('admin', 'Accountant', 'Receptionist', 'Laboratorist', 'Nurse', 'teacher'))) {
                //   $options1 = '<a type="button" class="btn editbutton" title="Edit" data-toggle="modal" data-id="463"><i class="fa fa-edit"> </i> Edit</a>';
                $options1 = ' <a type="button" class="btn editbutton" title="' . lang('edit') . '" data-toggle = "modal" data-id="' . $client->id . '"><i class="fa fa-edit"> </i> ' . lang('edit') . '</a>';
            }

            $options2 = '<a class="btn detailsbutton" title="' . lang('info') . '" style="color: #fff;" href="client/clientDetails?id=' . $client->id . '"><i class="fa fa-info"></i> ' . lang('info') . '</a>';

            $options3 = '<a class="btn green" title="' . lang('history') . '" style="color: #fff;" href="client/clientHistory?id=' . $client->id . '"><i class="fa fa-stethoscope"></i> ' . lang('history') . '</a>';

            $options4 = '<a class="btn invoicebutton" title="' . lang('payment') . '" style="color: #fff;" href="finance/clientPaymentHistory?client=' . $client->id . '"><i class="fa fa-money-bill-alt"></i> ' . lang('payment') . '</a>';

            if ($this->ion_auth->in_group(array('admin', 'Accountant', 'Receptionist', 'Laboratorist', 'Nurse', 'teacher'))) {
                $options5 = '<a class="btn delete_button" title="' . lang('delete') . '" href="client/delete?id=' . $client->id . '" onclick="return confirm(\'Are you sure you want to delete this item?\');"><i class="fa fa-trash"></i> ' . lang('delete') . '</a>';
            }

            $options6 = ' <a type="button" class="btn detailsbutton inffo" title="' . lang('info') . '" data-toggle = "modal" data-id="' . $client->id . '"><i class="fa fa-info"> </i> ' . lang('info') . '</a>';


            if ($this->ion_auth->in_group('teacher')) {
                $options7 = '<a class="btn green detailsbutton" title="' . lang('instant_meeting') . '" style="color: #fff;" href="meeting/instantLive?id=' . $client->id . '" onclick="return confirm(\'Are you sure you want to start a live meeting with this client? SMS and Email will be sent to the client.\');"><i class="fa fa-headphones"></i> ' . lang('start_live') . '</a>';
            } else {
                $options7 = '';
            }


            if ($this->ion_auth->in_group(array('admin'))) {
                $info[] = array(
                    $client->id,
                    $client->name,
                    $client->phone,
                    $this->settings_model->getSettings()->currency . $this->client_model->getDueBalanceByclientId($client->id),
                    $options1 . ' ' . $options6 . ' ' . $options3 . ' ' . $options4 . ' ' . $options5,
                    //  $options2
                );
            }

            if ($this->ion_auth->in_group(array('Accountant', 'Receptionist'))) {
                $info[] = array(
                    $client->id,
                    $client->name,
                    $client->phone,
                    $this->settings_model->getSettings()->currency . $this->client_model->getDueBalanceByclientId($client->id),
                    $options1 . ' ' . $options6 . ' ' . $options4,
                    //  $options2
                );
            }

            if ($this->ion_auth->in_group(array('Laboratorist', 'Nurse', 'teacher'))) {
                $info[] = array(
                    $client->id,
                    $client->name,
                    $client->phone,
                    $options1 . ' ' . $options6 . ' ' . $options3,
                    //  $options2
                );
            }
        }

        if (!empty($data['clients'])) {
            $output = array(
                "draw" => intval($requestData['draw']),
                "recordsTotal" => $this->db->get('client')->num_rows(),
                "recordsFiltered" => $this->db->get('client')->num_rows(),
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

    function getclientPayments()
    {
        $requestData = $_REQUEST;
        $start = $requestData['start'];
        $limit = $requestData['length'];
        $search = $this->input->post('search')['value'];

        $order = $this->input->post("order");
        $columns_valid = array(
            "0" => "id",
            "1" => "name",
            "2" => "phone",
        );
        $values = $this->settings_model->getColumnOrder($order, $columns_valid);
        $dir = $values[0];
        $order = $values[1];

        if ($limit == -1) {
            if (!empty($search)) {
                $data['clients'] = $this->client_model->getclientBysearch($search, $order, $dir);
            } else {
                $data['clients'] = $this->client_model->getclientWithoutSearch($order, $dir);
            }
        } else {
            if (!empty($search)) {
                $data['clients'] = $this->client_model->getclientByLimitBySearch($limit, $start, $search, $order, $dir);
            } else {
                $data['clients'] = $this->client_model->getclientByLimit($limit, $start, $order, $dir);
            }
        }
        //  $data['clients'] = $this->client_model->getclient();

        foreach ($data['clients'] as $client) {

            if ($this->ion_auth->in_group(array('admin', 'Accountant', 'Receptionist', 'Laboratorist', 'Nurse', 'teacher'))) {
                //   $options1 = '<a type="button" class="btn editbutton" title="Edit" data-toggle="modal" data-id="463"><i class="fa fa-edit"> </i> Edit</a>';
                $options1 = ' <a type="button" class="btn editbutton" title="' . lang('edit') . '" data-toggle = "modal" data-id="' . $client->id . '"><i class="fa fa-edit"> </i> ' . lang('edit') . '</a>';
            }

            $options2 = '<a class="btn detailsbutton" title="' . lang('info') . '" style="color: #fff;" href="client/clientDetails?id=' . $client->id . '"><i class="fa fa-info"></i> ' . lang('info') . '</a>';

            $options3 = '<a class="btn green" title="' . lang('history') . '" style="color: #fff;" href="client/clientHistory?id=' . $client->id . '"><i class="fa fa-stethoscope"></i> ' . lang('history') . '</a>';

            $options4 = '<a class="btn btn-xs green" title="' . lang('payment') . ' ' . lang('history') . '" style="color: #fff;" href="finance/clientPaymentHistory?client=' . $client->id . '"><i class="fa fa-money-bill-alt"></i> ' . lang('payment') . ' ' . lang('history') . '</a>';

            if ($this->ion_auth->in_group(array('admin', 'Accountant', 'Receptionist', 'Laboratorist', 'Nurse', 'teacher'))) {
                $options5 = '<a class="btn delete_button" title="' . lang('delete') . '" href="client/delete?id=' . $client->id . '" onclick="return confirm(\'Are you sure you want to delete this item?\');"><i class="fa fa-trash"></i> ' . lang('delete') . '</a>';
            }

            $due = $this->settings_model->getSettings()->currency . $this->client_model->getDueBalanceByclientId($client->id);

            $info[] = array(
                $client->id,
                $client->name,
                $client->phone,
                $due,
                //  $options1 . ' ' . $options2 . ' ' . $options3 . ' ' . $options4 . ' ' . $options5,
                $options4
            );
        }

        if (!empty($data['clients'])) {
            $output = array(
                "draw" => intval($requestData['draw']),
                "recordsTotal" => $this->db->get('client')->num_rows(),
                "recordsFiltered" => $this->db->get('client')->num_rows(),
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

    function getCaseList()
    {
        $requestData = $_REQUEST;
        $start = $requestData['start'];
        $limit = $requestData['length'];
        $search = $this->input->post('search')['value'];


        $order = $this->input->post("order");
        $columns_valid = array(
            "0" => "date",
            "1" => "client",
            "2" => "title",
        );
        $values = $this->settings_model->getColumnOrder($order, $columns_valid);
        $dir = $values[0];
        $order = $values[1];

        if ($limit == -1) {
            if (!empty($search)) {
                $data['cases'] = $this->client_model->getclientHistoryBySearch($search, $order, $dir);
            } else {
                $data['cases'] = $this->client_model->getclientHistoryWithoutSearch($order, $dir);
            }
        } else {
            if (!empty($search)) {
                $data['cases'] = $this->client_model->getclientHistoryByLimitBySearch($limit, $start, $search, $order, $dir);
            } else {
                $data['cases'] = $this->client_model->getclientHistoryByLimit($limit, $start, $order, $dir);
            }
        }
        //  $data['clients'] = $this->client_model->getclient();

        foreach ($data['cases'] as $case) {

            if ($this->ion_auth->in_group(array('admin', 'Accountant', 'Receptionist', 'Laboratorist', 'Nurse', 'teacher'))) {
                //   $options1 = '<a type="button" class="btn editbutton" title="Edit" data-toggle="modal" data-id="463"><i class="fa fa-edit"> </i> Edit</a>';
                $options1 = ' <a type="button" class="btn btn-info btn-xs btn_width editbutton" title="' . lang('edit') . '" data-toggle = "modal" data-id="' . $case->id . '"><i class="fa fa-edit"> </i> </a>';
            }
            if ($this->ion_auth->in_group(array('admin', 'Accountant', 'Receptionist', 'Laboratorist', 'Nurse', 'teacher'))) {
                $options2 = '<a class="btn btn-info btn-xs btn_width delete_button" title="' . lang('delete') . '" href="client/deleteCaseHistory?id=' . $case->id . '&redirect=case" onclick="return confirm(\'Are you sure you want to delete this item?\');"><i class="fa fa-trash"></i></a>';
                $options3 = ' <a type="button" class="btn btn-info btn-xs btn_width detailsbutton case" title="' . lang('case') . '" data-toggle = "modal" data-id="' . $case->id . '"><i class="fa fa-file"> </i> </a>';
            }

            if (!empty($case->client_id)) {
                $client_info = $this->client_model->getclientById($case->client_id);
                if (!empty($client_info)) {
                    $client_details = $client_info->name . '</br>' . $client_info->address . '</br>' . $client_info->phone . '</br>';
                } else {
                    $client_details = $case->client_name . '</br>' . $case->client_address . '</br>' . $case->client_phone . '</br>';
                }
            } else {
                $client_details = '';
            }

            $info[] = array(
                date('d-m-Y', $case->date),
                $client_details,
                $case->title,
                $options3 . ' ' . $options1 . ' ' . $options2
                // $options4
            );
        }

        if (!empty($data['cases'])) {
            $output = array(
                "draw" => intval($requestData['draw']),
                "recordsTotal" => $this->db->get('client_history')->num_rows(),
                "recordsFiltered" => $this->db->get('client_history')->num_rows(),
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

    function getDocuments()
    {
        $requestData = $_REQUEST;
        $start = $requestData['start'];
        $limit = $requestData['length'];
        $search = $this->input->post('search')['value'];

        $order = $this->input->post("order");
        $columns_valid = array(
            "0" => "date",
            "1" => "client",
        );
        $values = $this->settings_model->getColumnOrder($order, $columns_valid);
        $dir = $values[0];
        $order = $values[1];

        if ($limit == -1) {
            if (!empty($search)) {
                $data['documents'] = $this->client_model->getDocumentBySearch($search, $order, $dir);
            } else {
                $data['documents'] = $this->client_model->getclientMaterialWithoutSearch($order, $dir);
            }
        } else {
            if (!empty($search)) {
                $data['documents'] = $this->client_model->getDocumentByLimitBySearch($limit, $start, $search, $order, $dir);
            } else {
                $data['documents'] = $this->client_model->getDocumentByLimit($limit, $start, $order, $dir);
            }
        }
        //  $data['clients'] = $this->client_model->getclient();

        foreach ($data['documents'] as $document) {

            if ($this->ion_auth->in_group(array('admin', 'Accountant', 'Receptionist', 'Laboratorist', 'Nurse', 'teacher'))) {
                //   $options1 = '<a type="button" class="btn editbutton" title="Edit" data-toggle="modal" data-id="463"><i class="fa fa-edit"> </i> Edit</a>';
                $options1 = '<a class="btn btn-info btn-xs" href="' . $document->url . '" download> ' . lang('download') . ' </a>';
            }
            if ($this->ion_auth->in_group(array('admin', 'Accountant', 'Receptionist', 'Laboratorist', 'Nurse', 'teacher'))) {
                $options2 = '<a class="btn btn-info btn-xs delete_button" href="client/deleteclientMaterial?id=' . $document->id . '&redirect=documents"onclick="return confirm(\'You want to delete the item??\');"> X </a>';
            }

            if (!empty($document->client)) {
                $client_info = $this->client_model->getclientById($document->client);
                if (!empty($client_info)) {
                    $client_details = $client_info->name . '</br>' . $client_info->address . '</br>' . $client_info->phone . '</br>';
                } else {
                    $client_details = $document->client_name . '</br>' . $document->client_address . '</br>' . $document->client_phone . '</br>';
                }
            } else {
                $client_details = '';
            }
            $extension_url = explode(".", $document->url);

            $length = count($extension_url);
            $extension = $extension_url[$length - 1];

            if (strtolower($extension) == 'pdf') {
                $files = '<a class="example-image-link" href="' . $document->url . '" data-title="' . $document->title . '" target="_blank">' . '<img class="example-image" src="uploads/image/pdf.png" width="100px" height="100px"alt="image-1">' . '</a>';
            } elseif (strtolower($extension) == 'docx') {
                $files = '<a class="example-image-link" href="' . $document->url . '" data-title="' . $document->title . '">' . '<img class="example-image" src="uploads/image/docx.png" width="100px" height="100px"alt="image-1">' . '</a>';
            } elseif (strtolower($extension) == 'doc') {
                $files = '<a class="example-image-link" href="' . $document->url . '" data-title="' . $document->title . '">' . '<img class="example-image" src="uploads/image/doc.png" width="100px" height="100px"alt="image-1">' . '</a>';
            } elseif (strtolower($extension) == 'odt') {
                $files = '<a class="example-image-link" href="' . $document->url . '" data-title="' . $document->title . '">' . '<img class="example-image" src="uploads/image/odt.png" width="100px" height="100px"alt="image-1">' . '</a>';
            } else {
                $files = '<a class="example-image-link" href="' . $document->url . '" data-lightbox="example-1" data-title="' . $document->title . '">' . '<img class="example-image" src="' . $document->url . '" width="100px" height="100px"alt="image-1">' . '</a>';
            }
            $info[] = array(
                date('d-m-y', $document->date),
                $client_details,
                $document->title,
                $files,
                $options1 . ' ' . $options2
                // $options4
            );
        }

        if (!empty($data['documents'])) {
            $output = array(
                "draw" => intval($requestData['draw']),
                "recordsTotal" => $this->db->get('client_material')->num_rows(),
                "recordsFiltered" => $this->db->get('client_material')->num_rows(),
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

    function getClientHistoryByJason()
    {
        $data = array();

        $from_where = $this->input->get('from_where');
        $id = $this->input->get('id');

        if (!empty($from_where)) {
            $this->db->where('id', $id);
            $id = $this->db->get('appointment')->row()->client;
        }


        if ($this->ion_auth->in_group(array('Client'))) {
            $client_ion_id = $this->ion_auth->get_user_id();
            $id = $this->client_model->getclientByIonUserId($client_ion_id)->id;
        }

        $client = $this->client_model->getclientById($id);
        $appointments = $this->appointment_model->getAppointmentByclient($client->id);
        $clients = $this->client_model->getclient();
        $teachers = $this->teacher_model->getteacher();



        foreach ($appointments as $appointment) {

            $teacher_details = $this->teacher_model->getteacherById($appointment->teacher);
            if (!empty($teacher_details)) {
                $teacher_name = $teacher_details->name;
            } else {
                $teacher_name = '';
            }

            $timeline[$appointment->date + 1] = '
                <h5 class="pull-left"><span class="label pull-right r-activity">' . lang('appointment') . '</span></h5>
                                            <h5 class="pull-right">' . date('d-m-Y', $appointment->date) . '</h5>
                                            <div class="activity terques">
                                                <span>
                                                    <i class="fa fa-stethoscope"></i>
                                                </span>
                                                <div class="activity-desk">
                                                    <div class="panel col-md-6">
                                                        <div class="panel-body">
                                                            <div class="arrow"></div>
                                                            <i class=" fa fa-calendar"></i>
                                                            <h4>' . date('d-m-Y', $appointment->date) . '</h4>
                                                            <p></p>
                                                            <i class=" fa fa-user-md"></i>
                                                                <h4>' . $teacher_name . '</h4>
                                                                    <p></p>
                                                                    <i class=" fa fa-clock-o"></i>
                                                                <p>' . $appointment->s_time . ' - ' . $appointment->e_time . '</p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>';
        }


        $all_appointments = '';
        foreach ($appointments as $appointment) {

            $teacher_details = $this->teacher_model->getteacherById($appointment->teacher);
            if (!empty($teacher_details)) {
                $appointment_teacher = $teacher_details->name;
            } else {
                $appointment_teacher = "";
            }



            $client_appointments = '  <li class="list-group-item border-0 d-flex justify-content-between ps-0 mb-2 border-radius-lg">
            <div class="d-flex align-items-center">
                <button class="btn btn-icon-only btn-rounded btn-outline-success mb-0 me-3 btn-sm d-flex align-items-center justify-content-center"><i class="fas fa-arrow-down" aria-hidden="true"></i></button>
                <div class="d-flex flex-column">
                    <h6 class="mb-1 text-dark text-sm">'. $client->name .'</h6>
                    <span class="text-xs">'. date("d-m-Y", $appointment->date) .' / ' . $appointment->time_slot . '</span>
                </div>
            </div>
            <div class="d-flex align-items-center text-success text-gradient text-sm font-weight-bold">
               ' . $appointment->status . '
            </div>
        </li> ';

            $all_appointments .= $client_appointments ;
        }






        if (!empty($client->img_url)) {
            $profile_image = '<a href="#">
                            <img src="'  .base_url().$client->img_url . '" alt="">
                        </a>';
        } else {
            $profile_image = 'data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAIIAAACCCAMAAAC93eDPAAAAk1BMVEUEU33////v7u7u7e3w7+/39/f6+vrz8/MAUXwAT3sASHYASncAQHAATXoAQ3IARnW+xs8APW+zvcfm5+lwgpcRSnLe4OI8YoNVcYtHZ4efq7dQaoMAQ26Gk6IAR3EANmbU1dgAMWWqsbiHmqp4iqHK0tkvWHseUXgoTHBheY96k6qcoqyUo693i50+XnvJy9AAKmN+GITCAAALTUlEQVR4nNVbiZLisK4liZdsZCUB0tAEaELTDcP9/6+7djY7u0Jzq95zTc2oarBzYksnkiwtFD6wpqoqykXEJI0KEXOJqFwktaiS1qzWAmp7AUWrFyhEMUtd/P+HoL0NgvoKBAVjgguJUITKBehrEKjGhlpM42KxgsrFcgU+CgiaiihWSHjxTvf919fPz9fXOTl5lxjh9gKob4FCLCHwscBsUIyrfySRvWJLxJQ9HNPYO2/WV9N0TdPifywuutf15hxwHFhasjGI+A9JxAtNQqpW8IgQc6TlFrPXD4PV9mBbhq4v2kM3TP+QPQJaL0DaCwhR2quF2jqvCkLjvIppJE4+DrbRfbiMY2kfP5KQwe2xG9rSejwTguZtTNMYe3w1DHO38UKC3gmB7ViYZDbo+SUKO0tC3N7GAQiIDbWQVS6WlleLmIkk3H/ao/vfcyLO5z5/CcyfUClTLeZSCUHoyaBRavuDORNADsI87EM8ZpSkMMpis4apiZDk6s5/fjHMa1I87A8EjXC6dV7YgXonnPUTCKF/FzRK9/4MJewbhn8mEAj9uoBIejX/BoAPN0rHCVqoJslFUouUJO4ft6AY+i7BwiJoxyIGeQHRlfMOAHzYK1xsdt95D0HQsJZZ70LATOOb9kAY3wVyiZbvQ8C0kivEAAT5Syk4AwfRH0yxH4M39KWkfGDCRy7mkuK5b0bAlNJlGOonSI/tNUrsHd+OgGE4PNubPUTQGgneZgpNDI43wo6ynuDLu/WgGrlOAiAg7X+FgGOgwxBqXaDoe4416vkfOIZv3E/Qkp+CyArMSLrpusyPNVzTAsOwVniCoDWcAFXRMK3okQRpHKdB8ogsKAonmWBHeoEh0P0sSZXyfZh9K/E982EgnHQUAkJXyDq6u/UIrqKnagFvC+IzIyJjBI33EP/AiBJE61kiasMJ6LvinhuzlEUj4kp9wBJWFio94RobSvgNeQU/JfKsBkGTLcBFcVYYdUK1SiQQH8PYooZRytQEsQZnz2O1wRQHedjTa7h3KcppsKMK0EXrhvuiRUm8TfOKfg17IWgEoIuM3ZA6DoF+T5+mu5ch5O4BD7poeJiGb8UFr9WzZLHwBHAKYKmDpvCf5gssRAoHsAnOHVchRm3WrXQQ26D7tEqZe9xDTeHnJHh9rXWzSF0IdD290meIuhAA5mCfcNf77EJQTtNW4SSkA0HLpqHvKAJBILvptbKwyinUBO1NI7f2uOEAtwma1FHbftowbY9WHnShxZRspk3JfCr8p7Xvi4VD3BTxE2DeG6WcVfICiqcn6TuslDmg3uyrJrI5dFq1F7uwGVnTZBrCctM48LEcNGhPkyYE8gGYs4dDgBDtR4ugp5mxdLmGIYiD0PAv4IN3pBJBEyUAfN9sT5BqqXiMlKkQcSUyfQQ4HnagIFoTNF4BHAX7gvoCY4kXRDbnAnglYyVRk0q3AK/PvtAJCOKMIBD0DAkIKAaoAts4DIYAIDrmwIUCAvUgPiPzdcAQ7pBUpR8ICPgMiaCWDwKAUOjCA7KgeRYErQCYhKnPP24RRLIIyU9piuQfaMFNPi3nBTL9gc9Rh0BeQDEoJtPXqKamOILMWLgnIDvSEyxjeo1RBeECm2HcgBDwDZYy3V1qCB4wzXtUZaegL5TJDwJpR9h6pkfLGzrlBMz2MxXuj+RaN3GgyHTBT5aUN3T4Dk12mynq3EB2vaYUwks5hKTiBRgt8LFksdQ0Nd2gmSLrXEEgX+DcjnMiUxCUEzhlaH2VELQZEBaHdByCRkEJggYEzmU/cAh6lH9bqLjFkEQuxDNShuZPDoH/NQPCYrmOcXlxUrKyEJkQrmfcolg/pCLoGQfBMFyfZJCaLtc5SUvri3s58yEs9ENC25SYi1hJDrMSt9aKVOwINspyuJu0C4GS58fMC03zjCsIydy70KW1SrkF1KxMKE5Xn3Pvccw7LgmaQAlaBuH/u1/y6IqrBUnv//z5F0nmSSkJmkI/U42hW2a0vf0Gwe9tGzmvXGqzz1TFjujy4l2cbliu45jWeFXF8Nhdagjx9bUl/jj0LKwgqCrMcXs7hDWuCBphkPv69rG8KeKG7vyG2/H5o6CFMrKGRLWtoRumczz+Jx/Ho2O+oJK+RwUEUEAnPd6yne1X4qVpztQkTIPfr3+uD78fyschFk68QqfTbWJY7vonCEnxca7ZkdIw2K+dGeatb/NNKCGQB5TadMt9PFGnXKj8TNHnwwSTFAvuixQH/84jqDIYdnSinJSpSGkIEfP6OxREwOIXO1CKO+sixUEhnj+/kiqLC+UctNZw3Fio4a1Bl1THVvYVkO6yrgmikBy0gpPrtE4YH6RZxTGZ9NPtVQgJ7guHKlxNVoOZCW1CCCeUYWl7Vbnb6EFUtaHE201o+K6q0axKKCbiD3cTlvlaqdqiLTZywyTejHohyxtplVDQ0eyQu9JoXXg6EdbWJSL4MYaB7Wrzhk5F4Qg7+b8EvVKEfB+OavQ16lyPjdyXO7+KdMozICjDSVg7UToQ0ODFkJPMKsWWi5Dx78BZ6Fe1C0Eduq927pXlTZRiS5cBdangUDK6TKnXBM18Fp5260+Fmyv+NeJUWpaoFWZQBJJ1Bg63knGVqCir3n3wQ1rPkosH9j2/tj4EHzXeb5yapHT0R4+1u2ciiEWGEHa92PwWq3HKMHaU7m7C746O6Vc6UELRYxSOR7Q/QlC87qrJYAkFahcPmI9OMTcg11SLxYt19NzYkqK0t/xGjJVQ6BEkwTY9WlmP3hKK+lWbrrQZ0J7OAChBiw0Kmqvy604xq1lCwR5wlY5Cz5Q3dYnI5G9wXRwrMJPvK50AvwmCrJE7frkzWuMmrMLY0PEukWGC7rCHCNecU86kXQiiWB3XBWaOhxvFwaooDh5Odw2U+dbbUJBto6StW3iKyzI7Zg4tRXvRKPl8WhrFMsOdJpie8lsaFbtm5LF3+xs4m5q4IxCXWq5HGuos0FcBnJaVPUYWvwUCTbMSgZX21GD0FiFXtXbGZzrkCcyAgNPPUhktjzsm9axGCUW7WP1SRja6f1LUP+qCSEYePVyvJRN0uwIil9g+lNPsW+4rAOomaH1nLTvXJLyVLgAvvm3VOjdKKDr8eomqzcsuyssEjfAzK7lOj6pgsGksHYIW9fJpVTio22f8ovuK0dkp32QZpXh2lwity/Ldbw/TVyB435UfZmUa1iZaNLoQpMJB3dk8MdV6LL7/qrRYIN3UUT4vUFQnGlVajUXlPiZ1XLh0bzypQ8YJmtQLECW+udVkwzkR2mz/kBboIWihc+y7mdUe7dJfPQntqWsSVCtp6nPl1+G9eX3iTg+dbJR91CR1j91Fu87Sz5KQTF2PsSeESSZy4oZ/ZmfY2z2mjrCj3MAmNy0Z7nWTJ7oGILCjQHGwiUSLjW5vU64Gf+qhIzSR2ob0pX3dPFKNFr2VxZnw9qr8p+HzZ3N1lsJFcq8JkV3w/l3oJejGtxaHjQY2Xbf8aPt1D9KwBMFVJA7uq23kW1KfpW76v7RZb9+vC4pQzQJen8eB9tdGGk3Xl5bj27soW7ORRTvbd1ptnrpz3YekahEk7RbB4rFqXUIx2WGsUN7M2I3MdN0w2JO7IfnS/peggiKkQ/5bkzPCYXCzoS2dzu1Jm+/wBgi8lYtZ2+ZoL0dTaUVja9wx3UkI/d1ETU+gWIEGj8z3+/LuXD/8w/YRaIwK+5qcBQRNQNDKJud2UzPFBHdH0ZPM9D8MeJOzY7quVY6iyfl29mJG0txccb1et6m53Us9TtBK14MuP0sovnin5Fy2et9P3oVRFsZI7fWgx41yipqGfMfqq5RX/5X8MORBT1DTXAhdD7qZfZ0BAUrQ74gj/s9D+C/uw8Ytmj8XNAAAAABJRU5ErkJggg==';
        }



        $data['view'] = '
           
        <div class="card card-profile">
        <img src="'.base_url() . $this->db->get('settings')->row()->logo.'" alt="Image placeholder" class="card-img-top">
        <div class="row justify-content-center">
        <div class="col-4 col-lg-4 order-lg-2">
        <div class="mt-n4 mt-lg-n6 mb-4 mb-lg-0">
        <a href="javascript:;">
        <img src=" '.$profile_image . '" class="rounded-circle img-fluid border border-2 border-white">
        </a>
        </div>
        </div>
        </div>
        <div class="card-header text-center border-0 pt-0 pt-lg-2 pb-4 pb-lg-3">
        <div class="d-flex justify-content-between">
        <a href="javascript:;" class="btn btn-sm btn-info mb-0 d-block d-lg-none"><i class="ni ni-collection"></i></a>
        <a href="mailto:' . $client->email . '?Subject=Quero Aulas%20-%20Agendamento" class="btn btn-sm btn-dark float-right mb-0 d-none d-lg-block">Message</a>
        <a href="mailto:' . $client->email . '?Subject=Quero Aulas%20-%20Agendamento" class="btn btn-sm btn-dark float-right mb-0 d-block d-lg-none"><i class="ni ni-email-83"></i></a>
        </div>
        </div>
        <div class="card-body pt-0">
        <div class="row">
        <div class="col">
        <div class="d-flex justify-content-center">
        <div class="d-grid text-center">
        </div>
        <div class="d-grid text-center mx-4">
        </div>
        <div class="d-grid text-center">
        </div>
        </div>
        </div>
        </div>
        <div class="text-center mt-4">
        <h5>
        ' . $client->name . '<span class="font-weight-light">, ' . $client->email . ' </span>
        </h5>
        <div class="h6 font-weight-300">
        ' . $client->birthdate . '
        </div>
        <div class="h6 mt-4">
        ' . $client->address . '
        </div>
        <div>
        </div>
        </div>
        </div>
        </div>
                      

                </section>
                '.$all_appointments .  '</ul>
                       
                      
                </div>
            </div>
        </div>
    </div>';


        echo json_encode($data);
    }

    public function getclientinfo()
    {
        // Search term
        $searchTerm = $this->input->post('searchTerm');

        // Get users
        $response = $this->client_model->getclientInfo($searchTerm);

        echo json_encode($response);
    }

    public function getclientinfoWithAddNewOption()
    {
        // Search term
        $searchTerm = $this->input->post('searchTerm');
        //$teacher =   $this->id; 
        $id = $this->teacher_model->getteacherByIonUserId($this->ion_auth->get_user_id())->id;
        //var_dump($id);die;

        // Get users
        $response = $this->client_model->getclientinfoWithAddNewOption($searchTerm, $id);

        echo json_encode($response);
    }
}

/* End of file client.php */
    /* Location: ./application/modules/client/controllers/client.php */
