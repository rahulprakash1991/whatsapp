<?php
class cron_job_cnt extends CI_Controller { 
    public function __construct() {
            parent::__construct();
	  $this->load->model('common_model','mcommon',TRUE);
        $this->load->library('email');      
    }
    function cron_job()
    {
	    $this->load->model('cron_job_model');
 		$this->cron_job_model->cron_job(); 

             //$email = "rahulprakash42@gmail.com";
             // $e_host='ssl://smtp.googlemail.com';
             //            $e_port='465';
             //            $e_user='rahulrithu2016@gmail.com';
             //            $e_pass='Rithu@2016';
             //            //   $e_user=$this->mcommon->get_com_pany_email();
             //            //   $e_pass= $this->mcommon->get_com_pany_email_pass();
             //            //   $e_port = $this->mcommon->get_com_pany_ssl();
             //            $config = array(
             //            'protocol'  => 'sendmail',
             //            'smtp_host' => $e_host,
             //            'smtp_port' => $e_port,
             //            'smtp_user' => $e_user,
             //            'smtp_pass' => $e_pass,
             //            'mailtype'  => 'html',
             //            'charset'   => 'iso-8859-1'
             //            );
             //            // $data['flag'] = $flag;
             //        $to_email =   strip_tags($email);
             //        $this->load->library('email');
             //        $this->email->initialize($config);
             //        $this->email->from($e_user);
             //        $this->email->to($to_email);
             //        $this->email->subject('Tseting');
             //        $content = 'Test data ';
             //        $body = 'Hai <br/><br/>&nbsp;&nbsp;&nbsp;&nbsp;';
             //        $body.= $content.'<br/><br/>';
             //        $body.= $this->load->view('Auth/testemail','', TRUE);
             //        $this->email->message($body); 
             //        $this->email->set_mailtype("html");
             //        $this->email->send();
    }
}
?>
