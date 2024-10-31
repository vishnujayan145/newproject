<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Email_model extends CI_Model {
	
	function __construct()
    {
        parent::__construct();
    }

function forgot_password($email,$name,$user,$pwd)
{
	//base_url()."/signup/verify/".$enc_id

 $email_msg="<!DOCTYPE html><html><head><meta content='width=device-width' name='viewport'><meta content='text/html; charset=utf-8' http-equiv='Content-Type'><title>Reset Pasword</title><style> /* ------------------------------------- GLOBAL A very basic CSS reset------------------------------------- */* { margin: 0; padding: 0; font-family: 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif; box-sizing: border-box; font-size: 14px;}img { max-width: 100%;}body { -webkit-font-smoothing: antialiased; -webkit-text-size-adjust: none; width: 100% !important; height: 100%; line-height: 1.6;}/* Let's make sure all tables have defaults */table td { vertical-align: top;}/* ------------------------------------- BODY & CONTAINER------------------------------------- */body { background-color: #f6f6f6;}.body-wrap { background-color: #f6f6f6; width: 100%;}.container { display: block !important; max-width: 600px !important; margin: 0 auto !important; /* makes it centered */ clear: both !important;}.content { max-width: 600px; margin: 0 auto; display: block; padding: 20px;}/* ------------------------------------- HEADER, FOOTER, MAIN------------------------------------- */.main { background: #fff; border: 1px solid #e9e9e9; border-radius: 3px;}.content-wrap { padding: 20px;}.content-block { padding: 0 0 20px;}.header { width: 100%; margin-bottom: 20px;}.footer { width: 100%; clear: both; color: #999; padding: 20px;}.footer a { color: #999;}.footer p, .footer a, .footer unsubscribe, .footer td { font-size: 12px;}/* ------------------------------------- TYPOGRAPHY------------------------------------- */h1, h2, h3 { font-family: 'Helvetica Neue', Helvetica, Arial, 'Lucida Grande', sans-serif; color: #000; margin: 40px 0 0; line-height: 1.2; font-weight: 400;}h1 { font-size: 32px; font-weight: 500;}h2 { font-size: 24px;}h3 { font-size: 18px;}h4 { font-size: 14px; font-weight: 600;}p, ul, ol { margin-bottom: 10px; font-weight: normal;}p li, ul li, ol li { margin-left: 5px; list-style-position: inside;}/* ------------------------------------- LINKS & BUTTONS------------------------------------- */a { color: #1ab394; text-decoration: underline;}.btn-primary { text-decoration: none; color: #FFF; background-color: #27aae1; border: solid #27aae1; border-width: 5px 10px; line-height: 2; font-weight: bold; text-align: center; cursor: pointer; display: inline-block; border-radius: 5px; text-transform: capitalize;}/* ------------------------------------- OTHER STYLES THAT MIGHT BE USEFUL------------------------------------- */.last { margin-bottom: 0;}.first { margin-top: 0;}.aligncenter { text-align: center;}.alignright { text-align: right;}.alignleft { text-align: left;}.clear { clear: both;}/* ------------------------------------- ALERTS Change the class depending on warning email, good email or bad email------------------------------------- */.alert { font-size: 16px; color: #fff; font-weight: 500; padding: 20px; text-align: center; border-radius: 3px 3px 0 0;}.alert a { color: #fff; text-decoration: none; font-weight: 500; font-size: 16px;}.alert.alert-warning { background: #f8ac59;}.alert.alert-bad { background: #ed5565;}.alert.alert-good { background: #1ab394;}/* ------------------------------------- INVOICE Styles for the billing table------------------------------------- */.invoice { margin: 40px auto; text-align: left; width: 80%;}.invoice td { padding: 5px 0;}.invoice .invoice-items { width: 100%;}.invoice .invoice-items td { border-top: #eee 1px solid;}.invoice .invoice-items .total td { border-top: 2px solid #333; border-bottom: 2px solid #333; font-weight: 700;}/* ------------------------------------- RESPONSIVE AND MOBILE FRIENDLY STYLES------------------------------------- */@media only screen and (max-width: 640px) { h1, h2, h3, h4 { font-weight: 600 !important; margin: 20px 0 5px !important; } h1 { font-size: 22px !important; } h2 { font-size: 18px !important; } h3 { font-size: 16px !important; } .container { width: 100% !important; } .content, .content-wrap { padding: 10px !important; } .invoice { width: 100% !important; }} html{font-family:sans-serif;-webkit-text-size-adjust:100%;-ms-text-size-adjust:100%}body{margin:0}article,aside,details,figcaption,figure,footer,header,hgroup,main,menu,nav,section,summary{display:block}audio,canvas,progress,video{display:inline-block;vertical-align:baseline}audio:not([controls]){display:none;height:0}[hidden],template{display:none}a{background-color:transparent}a:active,a:hover{outline:0}abbr[title]{border-bottom:1px dotted}b,strong{font-weight:700}dfn{font-style:italic}h1{margin:.67em 0;font-size:2em}mark{color:#000;background:#ff0}small{font-size:80%}sub,sup{position:relative;font-size:75%;line-height:0;vertical-align:baseline}sup{top:-.5em}sub{bottom:-.25em}img{border:0}svg:not(:root){overflow:hidden}figure{margin:1em 40px}hr{height:0;-webkit-box-sizing:content-box;-moz-box-sizing:content-box;box-sizing:content-box}pre{overflow:auto}code,kbd,pre,samp{font-family:monospace,monospace;font-size:1em}button,input,optgroup,select,textarea{margin:0;font:inherit;color:inherit}button{overflow:visible}button,select{text-transform:none}.text-muted{color:#777} </style></head><body><table class='body-wrap'><tr><td></td><td class='container' width='600'><div class='content'><table cellpadding='0' cellspacing='0' class='main' width='100%'><tr><td class='content-wrap'><table cellpadding='0' cellspacing='0'><tr style='background-color: #27aae1;'><td width='600'><center><h1 style='line-height: 1.5;color: #ffffff;font-family:'> Reset password</h1></br></center></td></tr><tr><td class='content-block'><h3 class='text-muted' style='font-family: 'Segoe UI',Arial,sans-serif;font-weight: 400;margin: 10px 0;'>Hallo, ".$name.".</h3></td></tr><tr><td class='content-block'><p class='text-muted'>Username : <b>".$user."</b>&nbsp;&nbsp;&nbsp;</br>Password : <b>".$pwd."</b></p></td></tr><tr><td class='content-block aligncenter'></td></tr></table></td></tr></table><div class='footer'><table width='100%'><tr><td class='aligncenter content-block'>Follow <a href='#'>@</a> on Email.</td></tr></table></div></div></td><td></td></tr></table></body></html>";
$email_sub	=	"Forgot password";
$this->do_email($email_msg , $email_sub , $email);
}
	
	/***custom email sender****/
	//function do_email($msg=NULL, $sub=NULL, $to=NULL, $from=NULL)
	function do_email($msg=NULL, $sub=NULL, $to=NULL)
	{

		//Load email library
		$this->load->library('email');

		//SMTP & mail configuration
		$config = array(
		    'protocol'  => 'smtp',
		    'smtp_host' => 'mail.almascan.in',
		    'smtp_port' => 25,
		    'smtp_user' => 'donotreply@almascan.in',
		    'smtp_pass' => 'ek2m+vlr]]QJ',
		    'mailtype'  => 'html',
		    'charset'   => 'utf-8'
		);
		$this->email->initialize($config);
		$this->email->set_mailtype("html");
		$this->email->set_newline("\r\n");



		$this->email->to($to);
		$this->email->from('donotreply@almascan.in','almascan.in');
		$this->email->subject($sub);
		$this->email->message($msg);

		//Send email
		$this->email->send();


	}
}

