<?php
header('Access-Control-Allow-Origin: *'); 
header("Access-Control-Allow-Credentials: true");
header('Access-Control-Allow-Methods: GET, PUT, POST, DELETE, OPTIONS');
header('Access-Control-Max-Age: 1000');
header('Access-Control-Allow-Headers: Origin, Content-Type, X-Auth-Token , Authorization');
class cron_job_model extends CI_Model 
{    	
    function cron_job()
    {
		$msg = "Hi! ";
		$msg = wordwrap($msg,70);
		// send email
		mail("rahulrithu2016@gmail.com","Codeignator cron job by Rahul",$msg);			
    }
}
?>
