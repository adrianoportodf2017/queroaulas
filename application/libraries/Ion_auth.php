<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');
    setlocale(LC_ALL, 'pt_BR.UTF8', 'portuguese');
    mb_internal_encoding('UTF8');
    mb_regex_encoding('UTF8');
    date_default_timezone_set('America/Sao_Paulo');
/**
 * Name:  Ion Auth
 *
 * Version: 2.5.2
 *
 * Author: Ben Edmunds
 * 		  ben.edmunds@gmail.com
 *         @benedmunds
 *
 * Added Awesomeness: Phil Sturgeon
 *
 * Location: http://github.com/benedmunds/CodeIgniter-Ion-Auth
 *
 * Created:  10.01.2009
 *
 * Description:  Modified auth system based on redux_auth with extensive customization.  This is basically what Redux Auth 2 should be.
 * Original Author name has been kept but that does not mean that the method has not been modified.
 *
 * Requirements: PHP5 or above
 *
 */
class Ion_auth {

    /**
     * account status ('not_activated', etc ...)
     *
     * @var string
     * */
    protected $status;

    /**
     * extra where
     *
     * @var array
     * */
    public $_extra_where = array();

    /**
     * extra set
     *
     * @var array
     * */
    public $_extra_set = array();

    /**
     * caching of users and their groups
     *
     * @var array
     * */
    public $_cache_user_in_group;

    /**
     * __construct
     *
     * @return void
     * @author Ben
     * */
    public function __construct() {
        $this->load->config('ion_auth', TRUE);
        //   $this->load->library(array('email'));
        $this->lang->load('ion_auth');
        $this->load->helper(array('cookie', 'language', 'url'));

        $this->load->library('session');

        $this->load->model('ion_auth_model');

        $this->load->model('email/email_model');

        $settings = $this->db->get('settings')->row();
        if ($settings->emailtype == 'Domain Email') {
             //  echo 'df';
               // die();
            $this->load->library('email');
        }
        if ($settings->emailtype == 'Smtp') {

            // $this->smtpCredentials($mailprovider);
            $email_Settings = $this->db->get_where('email_settings', array('type' => $settings->emailtype))->row();
            // print_r($emailSettings);
            $config['protocol'] = 'smtp';
            $config['mailpath'] = '/usr/sbin/sendmail';
            $config['smtp_host'] = $email_Settings->smtp_host;
            $config['smtp_port'] = number_format($email_Settings->smtp_port);
            $config['smtp_user'] = $email_Settings->user;
            $config['smtp_pass'] = base64_decode($email_Settings->password);
            $config['smtp_crypto'] = 'tls';
            $config['mailtype'] = 'html';
            $config['charset'] = 'utf-8';
            $config['wordwrap'] = TRUE;
            $config['send_multipart'] = TRUE;
            $config['newline'] = "\r\n";
            $this->load->library('email');
            $this->email->initialize($config);
            $this->load->library('email');
        }


        $this->_cache_user_in_group = & $this->ion_auth_model->_cache_user_in_group;

        //auto-login the user if they are remembered
        if (!$this->logged_in() && get_cookie($this->config->item('identity_cookie_name', 'ion_auth')) && get_cookie($this->config->item('remember_cookie_name', 'ion_auth'))) {
            $this->ion_auth_model->login_remembered_user();
        }

        $email_config = $this->config->item('email_config', 'ion_auth');

        if ($this->config->item('use_ci_email', 'ion_auth') && isset($email_config) && is_array($email_config)) {
            $this->email->initialize($email_config);
        }

        $this->ion_auth_model->trigger_events('library_constructor');
    }

    /**
     * __call
     *
     * Acts as a simple way to call model methods without loads of stupid alias'
     *
     * */
    public function __call($method, $arguments) {
        if (!method_exists($this->ion_auth_model, $method)) {
            throw new Exception('Undefined method Ion_auth::' . $method . '() called');
        }
        if ($method == 'create_user') {
            return call_user_func_array(array($this, 'register'), $arguments);
        }
        if ($method == 'update_user') {
            return call_user_func_array(array($this, 'update'), $arguments);
        }
        return call_user_func_array(array($this->ion_auth_model, $method), $arguments);
    }

    /**
     * __get
     *
     * Enables the use of CI super-global without having to define an extra variable.
     *
     * I can't remember where I first saw this, so thank you if you are the original author. -Militis
     *
     * @access	public
     * @param	$var
     * @return	mixed
     */
    public function __get($var) {
        return get_instance()->$var;
    }

    /**
     * forgotten password feature
     *
     * @return mixed  boolian / array
     * @author Mathew
     * */
    public function forgotten_password($identity) {    //changed $email to $identity
       
        if ($this->ion_auth_model->forgotten_password($identity)) {   //changed
            // Get user information
            $identifier = $this->ion_auth_model->identity_column; // use model identity column, so it can be overridden in a controller
            $user = $this->where($identifier, $identity)->where('active', 1)->users()->row();  //changed to get_user_by_identity from email
           
            if ($user) {
                $data = array(
                    'identity' => $user->{$this->config->item('identity', 'ion_auth')},
                    'forgotten_password_code' => $user->forgotten_password_code
                );

                if (!$this->config->item('use_ci_email', 'ion_auth')) {
                    $this->set_message('forgot_password_successful');
                    return $data;
                } else {
                    $mail_provider = $this->settings_model->getSettings()->emailtype;
                    $email_settings = $this->email_model->getEmailSettingsByType($mail_provider);

                    $settings = $this->settings_model->getSettings();
$this->email->clear();
                    if ($mail_provider == 'Domain Email') {
                        $this->email->from($email_settings->admin_email, $settings->system_vendor);
                    }
                    if ($mail_provider == 'Smtp') {
                        $this->email->from($email_settings->user, $settings->system_vendor);
                    }
                    $messageprint1 = $this->load->view($this->config->item('email_templates', 'ion_auth') . $this->config->item('email_forgot_password', 'ion_auth'), $data, true);
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
                    
                    // $this->email->from($admin_email->admin_email, $settings->system_vendor);
                    $this->email->to($user->email);
                    $this->email->subject($settings->system_vendor . ' - ' . $this->lang->line('email_forgotten_password_subject'));
                    $this->email->message($messageprint1);

                    if ($this->email->send()) {
                        $this->set_message('forgot_password_successful');
                        return TRUE;
                    } else {
                        $this->set_error('forgot_password_unsuccessful');
                        return FALSE;
                    }
                }
            } else {
                $this->set_error('forgot_password_unsuccessful');
                return FALSE;
            }
        } else {
            $this->set_error('forgot_password_unsuccessful');
            return FALSE;
        }
    }

    /**
     * forgotten_password_complete
     *
     * @return void
     * @author Mathew
     * */
    public function forgotten_password_complete($code) {
        $this->ion_auth_model->trigger_events('pre_password_change');

        $identity = $this->config->item('identity', 'ion_auth');
        $profile = $this->where('forgotten_password_code', $code)->users()->row(); //pass the code to profile

        if (!$profile) {
            $this->ion_auth_model->trigger_events(array('post_password_change', 'password_change_unsuccessful'));
            $this->set_error('password_change_unsuccessful');
            return FALSE;
        }

        $new_password = $this->ion_auth_model->forgotten_password_complete($code, $profile->salt);

        if ($new_password) {
            $data = array(
                'identity' => $profile->{$identity},
                'new_password' => $new_password
            );
            if (!$this->config->item('use_ci_email', 'ion_auth')) {
                $this->set_message('password_change_successful');
                $this->ion_auth_model->trigger_events(array('post_password_change', 'password_change_successful'));
                return $data;
            } else {
                $messageprint1 = $this->load->view($this->config->item('email_templates', 'ion_auth') . $this->config->item('email_forgot_password_complete', 'ion_auth'), $data, true);
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
                $this->email->clear();
                $this->email->from($this->config->item('admin_email', 'ion_auth'), $this->config->item('site_title', 'ion_auth'));
                $this->email->to($profile->email);
                $this->email->subject($this->config->item('site_title', 'ion_auth') . ' - ' . $this->lang->line('email_new_password_subject'));
                $this->email->message($messageprint1);

                if ($this->email->send()) {
                    $this->set_message('password_change_successful');
                    $this->ion_auth_model->trigger_events(array('post_password_change', 'password_change_successful'));
                    return TRUE;
                } else {
                    $this->set_error('password_change_unsuccessful');
                    $this->ion_auth_model->trigger_events(array('post_password_change', 'password_change_unsuccessful'));
                    return FALSE;
                }
            }
        }

        $this->ion_auth_model->trigger_events(array('post_password_change', 'password_change_unsuccessful'));
        return FALSE;
    }

    /**
     * forgotten_password_check
     *
     * @return void
     * @author Michael
     * */
    public function forgotten_password_check($code) {
        $profile = $this->where('forgotten_password_code', $code)->users()->row(); //pass the code to profile

        if (!is_object($profile)) {
            $this->set_error('password_change_unsuccessful');
            return FALSE;
        } else {
            if ($this->config->item('forgot_password_expiration', 'ion_auth') > 0) {
                //Make sure it isn't expired
                $expiration = $this->config->item('forgot_password_expiration', 'ion_auth');
                if (time() - $profile->forgotten_password_time > $expiration) {
                    //it has expired
                    $this->clear_forgotten_password_code($code);
                    $this->set_error('password_change_unsuccessful');
                    return FALSE;
                }
            }
            return $profile;
        }
    }

    /**
     * register
     *
     * @return void
     * @author Mathew
     * */
    public function register($username, $password, $email, $additional_data = array(), $group_ids = array()) { //need to test email activation
        $this->ion_auth_model->trigger_events('pre_account_creation');

        $email_activation = $this->config->item('email_activation', 'ion_auth');

        if (!$email_activation) {
            $id = $this->ion_auth_model->register($username, $password, $email, $additional_data, $group_ids);
            if ($id !== FALSE) {
                $this->set_message('account_creation_successful');
                $this->ion_auth_model->trigger_events(array('post_account_creation', 'post_account_creation_successful'));
                return $id;
            } else {
                $this->set_error('account_creation_unsuccessful');
                $this->ion_auth_model->trigger_events(array('post_account_creation', 'post_account_creation_unsuccessful'));
                return FALSE;
            }
        } else {
            $id = $this->ion_auth_model->register($username, $password, $email, $additional_data, $group_ids);

            if (!$id) {
                $this->set_error('account_creation_unsuccessful');
                return FALSE;
            }

            //deactivate so the user much follow the activation flow
            $deactivate = $this->ion_auth_model->deactivate($id);

            //the deactivate method call adds a message, here we need to clear that
            $this->ion_auth_model->clear_messages();


            if (!$deactivate) {
                $this->set_error('deactivate_unsuccessful');
                $this->ion_auth_model->trigger_events(array('post_account_creation', 'post_account_creation_unsuccessful'));
                return FALSE;
            }

            $activation_code = $this->ion_auth_model->activation_code;
            $identity = $this->config->item('identity', 'ion_auth');
            $user = $this->ion_auth_model->user($id)->row();

            $data = array(
                'identity' => $user->{$identity},
                'id' => $user->id,
                'email' => $email,
                'activation' => $activation_code,
            );
            if (!$this->config->item('use_ci_email', 'ion_auth')) {
                $this->ion_auth_model->trigger_events(array('post_account_creation', 'post_account_creation_successful', 'activation_email_successful'));
                $this->set_message('activation_email_successful');
                return $data;
            } else {
                $messageprint1 = $this->load->view($this->config->item('email_templates', 'ion_auth') . $this->config->item('email_activate', 'ion_auth'), $data, true);
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
                $this->email->clear();
                $this->email->from($this->config->item('admin_email', 'ion_auth'), $this->config->item('site_title', 'ion_auth'));
                $this->email->to($email);
                $this->email->subject($this->config->item('site_title', 'ion_auth') . ' - ' . $this->lang->line('email_activation_subject'));
                $this->email->message($messageprint1);

                if ($this->email->send() == TRUE) {
                    $this->ion_auth_model->trigger_events(array('post_account_creation', 'post_account_creation_successful', 'activation_email_successful'));
                    $this->set_message('activation_email_successful');
                    return $id;
                }
            }

            $this->ion_auth_model->trigger_events(array('post_account_creation', 'post_account_creation_unsuccessful', 'activation_email_unsuccessful'));
            $this->set_error('activation_email_unsuccessful');
            return FALSE;
        }
    }

    /**
     * logout
     *
     * @return void
     * @author Mathew
     * */
    public function logout() {
        $this->ion_auth_model->trigger_events('logout');

        $identity = $this->config->item('identity', 'ion_auth');
        $this->session->unset_userdata(array($identity => '', 'id' => '', 'user_id' => ''));

        //delete the remember me cookies if they exist
        if (get_cookie($this->config->item('identity_cookie_name', 'ion_auth'))) {
            delete_cookie($this->config->item('identity_cookie_name', 'ion_auth'));
        }
        if (get_cookie($this->config->item('remember_cookie_name', 'ion_auth'))) {
            delete_cookie($this->config->item('remember_cookie_name', 'ion_auth'));
        }

        //Destroy the session
        $this->session->sess_destroy();

        //Recreate the session
        if (substr(CI_VERSION, 0, 1) == '2') {
            $this->session->sess_create();
        } else {
            $this->session->sess_regenerate(TRUE);
        }

        $this->set_message('logout_successful');
        return TRUE;
    }

    /**
     * logged_in
     *
     * @return bool
     * @author Mathew
     * */
    public function logged_in() {
        $this->ion_auth_model->trigger_events('logged_in');

        return (bool) $this->session->userdata('identity');
    }

    /**
     * logged_in
     *
     * @return integer
     * @author jrmadsen67
     * */
    public function get_user_id() {
        $user_id = $this->session->userdata('user_id');
        if (!empty($user_id)) {
            return $user_id;
        }
        return null;
    }

    /**
     * is_admin
     *
     * @return bool
     * @author Ben Edmunds
     * */
    public function is_admin($id = false) {
        $this->ion_auth_model->trigger_events('is_admin');

        $admin_group = $this->config->item('admin_group', 'ion_auth');

        return $this->in_group($admin_group, $id);
    }

    /**
     * in_group
     *
     * @param mixed group(s) to check
     * @param bool user id
     * @param bool check if all groups is present, or any of the groups
     *
     * @return bool
     * @author Phil Sturgeon
     * */
    public function in_group($check_group, $id = false, $check_all = false) {
        $this->ion_auth_model->trigger_events('in_group');

        $id || $id = $this->session->userdata('user_id');

        if (!is_array($check_group)) {
            $check_group = array($check_group);
        }

        if (isset($this->_cache_user_in_group[$id])) {
            $groups_array = $this->_cache_user_in_group[$id];
        } else {
            $users_groups = $this->ion_auth_model->get_users_groups($id)->result();
            $groups_array = array();
            foreach ($users_groups as $group) {
                $groups_array[$group->id] = $group->name;
            }
            $this->_cache_user_in_group[$id] = $groups_array;
        }
        foreach ($check_group as $key => $value) {
            $groups = (is_string($value)) ? $groups_array : array_keys($groups_array);

            /**
             * if !all (default), in_array
             * if all, !in_array
             */
            if (in_array($value, $groups) xor $check_all) {
                /**
                 * if !all (default), true
                 * if all, false
                 */
                return !$check_all;
            }
        }

        /**
         * if !all (default), false
         * if all, true
         */
        return $check_all;
    }

}
