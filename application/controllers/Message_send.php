<?php  
class Message_send extends MY_Controller 
{
	public function __construct()
	{
	/*call CodeIgniter's default Constructor*/
	parent::__construct();

		$this->load->helper(array('url','language'));
		$this->lang->load('auth'); 
		$this->load->library('email'); 
		$this->load->model('Prefs','pre',TRUE);
		$this->load->model('Sal_common_model','sal_common',TRUE);
		$this->load->model('Proforma_model','proforma',TRUE);
		$this->load->model('common_model','common',TRUE);
		$this->load->model('Mdropdown','mdropdown',TRUE);
		$this->load->library('Ciqrcode');
           }

     public function index( $msg = array() )
	{  
		if($this->require_min_level(1))
        {
			$msg['form_url']		=	'Message_send/add';
	        $msg['form_toptittle']	=	'Invoice Management';
        	$msg['datatable_url']	=	'sales_order/datatable';
        	$msg['list_tittle']		=	'Invoice list';
        	
			$msg['notification'] 			= 	$sessionArr['successMsg'];
 			$auth_model 					= 	$this->authentication->auth_model; 
 			$sessionArr						=	$this->session->all_userdata();
			
 			$data	=	array(
								'sidebar'	=> '',
								'sb_type'	=> '0',
								'title'     => 'Invoice Management',
								'content'   =>$this->load->view('message',$msg,TRUE)
							);

			$array_sess_items = array('successMsg'=>'');
			$this->session->set_userdata($array_sess_items);
			$this->load->view('templates/main_template', $data);	
		}
	}

	public function add()
	{
// 		$phone=$this->input->post('mob_no');
// $user_message=$this->input->post('msg');
$mobile=$_POST['mob_no'];
	$message=$_POST['msg'];
	$data = [
    'phone' => $mobile, // Receivers phone
    'body' => $message, // Message
];
$json = json_encode($data); // Encode data to JSON
// URL for request POST /message
$url = 'https://api.chat-api.com/instance430902/message?token=tx3x4tiw6k9upp1l';
// Make a POST request
$options = stream_context_create(['http' => [
        'method'  => 'POST',
        'header'  => 'Content-type: application/json',
        'content' => $json
    ]
]);
// Send a request
$result = file_get_contents($url, false, $options);
print_r($result);

	}
public function message()
	{
		/*load registration view form*/
		$this->load->view('message');
	
		/*Check submit button */
		if($this->input->post('save'))
		{
		$phone=$this->input->post(‘phone’);
$user_message=$this->input->post(‘message’);
	    /*Your authentication key*/
$authKey = "3456655757gEr5a019b18";
/*Multiple mobiles numbers separated by comma*/
$mobileNumber = $phone;
/*Sender ID,While using route4 sender id should be 6 characters long.*/
$senderId = "ABCDEF";
/*Your message to send, Add URL encoding here.*/
$message = $user_message;
/*Define route */
$route = "route=4";
/*Prepare you post parameters*/
$postData = array(
'authkey' => $authKey,
'mobiles' => $mobileNumber,
'message' => $message,
'sender' => $senderId,
'route' => $route
);
/*API URL*/
$url="https://control.msg91.com/api/sendhttp.php";
/* init the resource */
$ch = curl_init();
curl_setopt_array($ch, array(
CURLOPT_URL => $url,
CURLOPT_RETURNTRANSFER => true,
CURLOPT_POST => true,
CURLOPT_POSTFIELDS => $postData
/*,CURLOPT_FOLLOWLOCATION => true*/
));
/*Ignore SSL certificate verification*/
curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
/*get response*/
$output = curl_exec($ch);
/*Print error if any*/
if(curl_errno($ch))
{
echo 'error:' . curl_error($ch);
}
curl_close($ch);
echo  " Message Sent Successfully !";
		}
	}
}
 