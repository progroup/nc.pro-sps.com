<?php include_once('config.php'); ob_start();  ?>
<?php
session_start();
if(isset($_POST['tta_reports'])){
    if(is_array($_SESSION['AttachmentUpload'])){
		$UploadFolderName_temp = array();
		$UploadFileName_temp = array();
		foreach($_SESSION['AttachmentUpload'] as $key => $value){
			$UploadFolderName_temp[] = $key;
			$UploadFileName_temp[] = $value;
		}
		$UploadFolderName = serialize($UploadFolderName_temp);
		$UploadFileName = serialize($UploadFileName_temp);
	}else{
		$UploadFolderName = "";
		$UploadFileName = "";
	}
   $SQL = "INSERT INTO TTA_Reports_Uploads
    (agency, fname, lname, position, emailid, contact_no, report_note, uploadfoldername, uploadfilename)
    VALUES(
        '" . $_POST['report_agency'] . "',
        '" . $_POST['report_fname'] . "',
        '" . $_POST['report_lname'] . "',
        '" . $_POST['report_position'] . "',
        '" . $_POST['report_email'] . "',
        '" . $_POST['report_cnt_no'] . "',
        '" . $_POST['report_query'] . "',
        '" . $UploadFolderName . "',
        '" . $UploadFileName . "'
     )";
    $result = mysql_query($SQL);
}
else if(isset($_POST['email'])){

        if(is_array($_SESSION['AttachmentUpload']) ){
            $UploadFolderName_temp = array();
            $UploadFileName_temp = array();
            foreach($_SESSION['AttachmentUpload'] as $key => $value){
                $UploadFolderName_temp[] = $key;
                $UploadFileName_temp[] = $value;
            }
            $UploadFolderName = serialize($UploadFolderName_temp);
            $UploadFileName = serialize($UploadFileName_temp);
        }else{
            $UploadFolderName = "";
            $UploadFileName = "";
        }


	$get_email = [];
	$sql = "SELECT user_id, username, user_level, email FROM login_users";
	$result_mail = mysql_query($sql) or die(mysql_error());
	$num_rows = mysql_num_rows($result_mail);

	while($row = mysql_fetch_array($result_mail)) {
		$user_level = $row['user_level'];
		$list = unserialize($user_level);
		if($list[0] == 1 || $list[0] == 2) {
			$get_email[] = $row['email'];
		}
	}
 $_POST['enq_time']=(isset($_POST['enq_time']))? $_POST['enq_time']:'';
    $_POST['region']=(isset($_POST['region']))? $_POST['region']:'';
	$email_bcc = implode(",", $get_email);
	$key = rand(999, 9999);
	$contract_num = mt_rand(10000000, 99999999);
	$contract_num = "TTAREQ-" . $contract_num;

	$SQL = "INSERT INTO help
    (fname, lname, date_time, enq_time, position, agency, region, emailid, cnt_no, queries, active_key, contract_num, uploadfoldername, uploadfilename)
    VALUES(
        '" . $_POST['fname'] . "',
        '" . $_POST['lname'] . "',
        '" . date('Y-m-d') . "',
        '" . $_POST['enq_time'] . "',
        '" . $_POST['position'] . "',
        '" . $_POST['agency'] . "',
        '" . $_POST['region'] . "',
        '" . $_POST['email'] . "',
        '" . $_POST['cnt_no'] . "',
        '" . $_POST['query'] . "',
        '" . $key . "',
        '" . $contract_num . "',
        '" . $UploadFolderName . "',
        '" . $UploadFileName . "'
     )";

	$user_name = $_POST['fname'] . " " . $_POST['lname'];
	$result = mysql_query($SQL);
	$sql = "SELECT * FROM agency WHERE id = '" . $_POST['agency'] . "'";
	$result_agency = mysql_query($sql) or die(mysql_error());

	while($row_agency = mysql_fetch_array($result_agency)) {
		$agency_name = $row_agency['name'];
		$agency_address = $row_agency['street'] . "," . $row_agency['city'] . "," . $row_agency['state'] . "," . $row_agency['zip'];
		$manager_name = $row_agency['manager_name'];
		$agency_cntno = $row_agency['phone'];
	}

if(is_array($_POST['document'])) {
    $documents=array();
    foreach ($_POST['document'] as $document) {
        $document_link=urldecode($document);
        $document_arr=explode('/content',$document_link);
        $count_no=count($document_arr)-1;
        $doc= 'content'.$document_arr[$count_no];
        $sql="SELECT id FROM documents WHERE document_name like '%".$doc."' ";
         $res_doc=mysql_query($sql);
        $rows=mysql_fetch_array($res_doc);
        if($rows['id']<>'') $documents[]=$rows['id'];
    }
}
   date_default_timezone_set('America/New_York');
	$current_date = date('Y-m-d h:i:s A');
	$insert_tta = "INSERT INTO TTA_Forms (agency_id, contract_num, status, AgencyName, ManagerName, AgencyContactNumber, AgencyAddress, TTA_inquiry_notes, TTA_Contact_Phone, user_name, TTA_Email, created_date, regarding, updated_date, TTA_Referral,regarding_notes,resources)
    VALUES(
        '" . $_POST['agency'] . "',
        '" . $contract_num . "',
        'pending',
        '" . $agency_name . "',
        '" . $manager_name . "',
        '" . $agency_cntno . "',
        '" . $agency_address . "',
        '" . $_POST['query'] . "',
        '" . $_POST['cnt_no'] . "',
        '" . $user_name . "',
        '" . $_POST['email'] . "',
        '" . $current_date . "',
        '" . $_POST['regarding'] . "',
        '" . $current_date . "',
        '" . $user_name . "',
        '" . $_POST['regarding_notes']."',
        '".serialize($documents)."'
    )";
	$result_tta = mysql_query($insert_tta);

	if($result == 1) {
		confimation_mail_user($_POST['email'], $user_name, $agency_name, date('Y-m-d'), $_POST['position'], $_POST['region'], $_POST['cnt_no'], $_POST['query'],$_POST['regarding'], $_POST['regarding_notes'], $_POST['fname'] );
		information_mail_admin($_POST['email'], $user_name, $agency_name, date('Y-m-d'), $_POST['agency'], $_POST['position'], $_POST['region'], $_POST['cnt_no'], $_POST['query'], $_POST['regarding'], $_POST['regarding_notes'], $email_bcc);
	}
unset($_SESSION['AttachmentUpload']);

}

	function confimation_mail_user($email, $user_name, $agency, $time, $position, $region, $cnt_no, $query, $regarding, $regarding_notes, $fname ) {
		require 'mail/class.phpmailer.php';
		$img_path = "http://www." . $_SERVER["SERVER_NAME"] . "/assets/images/logo-gasps.png";
		try {
			$mail = new PHPMailer(true); //New instance, with exceptions enabled
			$message = '<html><body>';
			$message .= '<table width="100%"; border="0"  cellpadding="10">';
			$message .= "<tr><td colspan=2><img src='".$img_path."' style='width:200px;'/></td></tr>";
			$message .= "<tr><td colspan=2>" . $fname .",<br /><br />Your Ecco request has been submitted.</td></tr>";
			$message .= "<tr><td colspan=2 font='color:#999999;'><p>Here are your requested resources</p><ul>";
			$pattern = '/(.*\/)(.*)/';
			$replacement = '$2';
			if(is_array($_POST['document'])){
				foreach($_POST['document'] as $document)
				{
					$message .=  '<li><a href="' . $document . '">' . preg_replace($pattern, $replacement, urldecode($document)) . '</a></li>';
				}
			}
			$message .= "</ul></td></tr>";

			$message .= "<tr><td colspan=2 font='color:#999999;'><p>Uploaded documents for review:</p><ul>";

                if(is_array($_SESSION['AttachmentUpload'])){
                    foreach($_SESSION['AttachmentUpload'] as $key => $value){
                        $message .=  '<li><a href="http://dev.ga-sps.org/assets/uploader/php-traditional-server/files/' . $key . '/'.$value.'">' . $value . '</a></li>';
                    }
                }

			$message .= "</ul></td></tr>";

			$message .= "<tr><td colspan=2>You should receive contact within 48 hours.</td></tr>";
			$message .= "<tr><td colspan=2>If you need assistance faster, please call Marcus Bouligny or Krystal Lokkesmoe.</td></tr>";
			$message .= "<tr><td colspan=2 font='color:#999999;'>Marcus Bouligny<br />Workforce Development Lead<br />Prospectus Group, LLC<br />Cell: 415.516.1332</td></tr>";
			$message .= "<tr><td colspan=2 font='color:#999999;'>Krystal Lokkesmoe<br />Workforce Development Coordinator<br />Prospectus Group, LLC<br />Cell: 678.557.8711</td></tr>";
			$message .= "<tr><td colspan=2 font='color:#999999;'>--------------------------------------</td></tr>";
			$message .= "<tr><td colspan=2 font='colr:#999999;'>Agency: ".$agency."<br/>Time Submitted:".date ('d M Y',strtotime($time))."<br />Requester:".$user_name."<br />Your Position:".$position."<br />Address:".$email."<br />Contact Number:".$cnt_no."<br />Nature of Query:".$query."<br />Regarding:  ".$regarding."</td></tr>";
			$message .= "<tr><td colspan=2 font='colr:#999999;'>Thanks for using Ecco!</td></tr>";
			$message .= "</table>";
			$message .= "</body></html>";

			$body  = $message;
			$mail->IsSMTP();                               // tell the class to use SMTP
			$mail->SMTPAuth   = true;                      // enable SMTP authentication
			$mail->Port       = 25;                        // set the SMTP server port
			$mail->Host       = "ssl://smtp.gmail.com";    // SMTP server
			$mail->Username   = "vtestid11@gmail.com";     // SMTP server username
			$mail->Password   = "vivid123";                // SMTP server password
			$mail->IsSendmail();                           // tell the class to use Sendmail
			$mail->AddReplyTo("mbouligny@progroup.us","Marcus");
			$mail->From       = "mbouligny@progroup.us";
			$mail->FromName   = "Marcus";
			// $mail->AddReplyTo("victor.tolbert@gmail.com","Victor");
			// $mail->From       = "victor.tolbert@gmail.com";
			// $mail->FromName   = "Victor";

			$to = $email;
			$mail->AddAddress($to);
			$mail->Subject    = "Your ECCO Intake request has been submitted";
			$mail->WordWrap   = 80; // set word wrap
			$mail->MsgHTML($body);
			$mail->IsHTML(true); // send as HTML
			$mail->Send();
			#echo '<pre>'; print_r($mail);
			#echo 'Message has been sent.';

		} catch (phpmailerException $e) {
			echo $e->errorMessage();
		}
	}

	function information_mail_admin($email, $user_name, $agency, $time, $requester, $position, $region, $cnt_no, $query, $regarding, $regarding_notes, $email_bcc) {

    $img_path = "http://www." . $_SERVER["SERVER_NAME"] . "/assets/images/logo-gasps.png";
    // $to   = 'mbouligny@progroup.us';
    $to   = 'victor.tolbert@gmail.com';
    // $bcc = $email_bcc;
    $bcc = 'victor.tolbert@gmail.com';

    $from = $email;
    $subject = "An ECCO request has been submitted";

    $headers = "From: " . strip_tags($from) . "\r\n";
    $headers .= 'BCC: ' . $bcc . "\r\n";
    $headers .= "MIME-Version: 1.0\r\n";
    $headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";

    $message = '<html><body>';
    $message .= '<table width="100%"; border="0"  cellpadding="10">';
    $message .= "<tr><td colspan=2>Marcus,<br /><br />An Ecco has been submitted by  " . $agency . "</td></tr>";
    $message .= "<tr><td colspan=2 font='color:#999999;'>Ecco Intake</td></tr>";
    $message .= "<tr><td colspan=2 font='color:#999999;'>--------------------------------------</td></tr>";

    $message .= "<tr><td colspan=2 font='color:#999999;'><p>The requested resources:</p><ul>";

    $pattern = '/(.*\/)(.*)/';
    $replacement = '$2';

	if(is_array($_POST['document'])){
		foreach($_POST['document'] as $document)
		{
			$message .=  '<li><a href="' . $document . '">' . preg_replace($pattern, $replacement, urldecode($document)) . '</a></li>';
		}
	}
    $message .= "</ul></td></tr>";

	$message .= "<tr><td colspan=2 font='color:#999999;'><p>Uploaded documents for review:</p><ul>";

    if (is_array($_SESSION['AttachmentUpload'])) {
        foreach ($_SESSION['AttachmentUpload'] as $key => $value) {
            $message .= '<li><a href="http://dev.ga-sps.org/assets/uploader/php-traditional-server/files/' . $key . '/' . $value . '">' . $value . '</a></li>';
        }

}
    $message .= "</ul></td></tr>";


    $message .= "<tr><td colspan=2 font='color:#999999;'>Agency: " . $agency . "<br/>Time Submitted:  " . date('d M Y',strtotime($time)) . "<br />Requester:  " . $user_name . "<br />Your Position:  " . $position . "<br />Address:  " . $email . "<br />Contact Number:  " . $cnt_no . "<br />Nature of Query:  " . $query . "<br />Regarding:  " . $regarding . "<br />Regarding Notes:  " . $regarding_notes . "</td></tr>";
    $message .= "<tr><td colspan=2 font='color:#999999;'>Thanks for using Ecco!</td></tr>";
    $message .= "<tr><td colspan=2><img src='" . $img_path . "' style='width:200px;'/></td></tr>";
    $message .= "</table>";
    $message .= "</body></html>";

    mail($to, $subject, $message, $headers);
 }
?>
<script>
    window.location.href = '/help';
</script>
