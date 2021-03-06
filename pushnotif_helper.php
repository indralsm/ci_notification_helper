<?php
/*
****************************************************************
Fatimah Cita Integrasi
Description modul	: Push Notification To Android with FireBase
Author				: Indra Lesmana
Email				: indra.lesmana@gmail.com
development Date	: May 2018
****************************************************************
*/
function pushnotif($to,$title,$body){
#API access key from Google API's Console
    define( 'API_ACCESS_KEY', 'YOUR_API_KEY' );
//    $registrationIds = $to;
#prep the bundle
     $msg = array
          (
				'body'  	=> $body,
				'title'     => $title,
				'vibrate'   => 1,
				'sound'     => 'default',
				'largeIcon'	=> 'large_icon',
				'smallIcon'	=> 'small_icon',
             	'icon'	=> 'myicon'
          );
	$fields = array
			(
				'to'		=> $to,
				'notification'	=> $msg
			);
	
	
	$headers = array
			(
				'Authorization: key=' . API_ACCESS_KEY,
				'Content-Type: application/json'
			);
#Send Reponse To FireBase Server	
		$ch = curl_init();
		curl_setopt( $ch,CURLOPT_URL, 'https://fcm.googleapis.com/fcm/send' );
		curl_setopt( $ch,CURLOPT_POST, true );
		curl_setopt( $ch,CURLOPT_HTTPHEADER, $headers );
		curl_setopt( $ch,CURLOPT_RETURNTRANSFER, true );
		curl_setopt( $ch,CURLOPT_SSL_VERIFYPEER, false );
		curl_setopt( $ch,CURLOPT_POSTFIELDS, json_encode( $fields ) );
		$result = curl_exec($ch );
		curl_close( $ch );

return $result;
}

//Push Notification Mail
function pushmail($to,$subject,$data){
				$ci =& get_instance();
				$msg = $ci->load->view('email/email',$data,TRUE);
	
				$ci->load->library('email');
				//Setting account with SSL
				$ci->email->initialize(array(
				  'protocol' => 'smtp',
				  'smtp_host' => 'ssl://yourdomain.com',				//SMTP Host
				  'smtp_user' => 'email@yourdomain.com', 	//SMTP Username
				  'smtp_pass' => 'your_email_password', 				//SMTP Password
				  'smtp_port' => 465, 							//SMTP Port
				  'crlf' => "\r\n",
				  'newline' => "\r\n"
				));

				$ci->email->from('email@yourdomain.com', 'Your Name'); //Email From
				$ci->email->to($to);  //Email Tujuan
				$ci->email->subject($subject);
				//Content Email
				$ci->email->message($msg);
				$ci->email->set_mailtype('html');
				$send = $ci->email->send();
return $send;
}

?>
