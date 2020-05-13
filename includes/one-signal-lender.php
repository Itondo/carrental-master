<?PHP
	function sendMessage(){
		$content = array(
			"en" => $_SESSION['lender_notification_message']
			);
		
		
		//Note: for matching ID of lender with vehicle from SESSION variable 
		$fields = array(
			'app_id' => "c7203da0-332c-4ab4-bf61-9e3802b93cb8",
			'filters' => array(array("field" => "tag", "key" => "user_type", "relation" => "=", "value" => "1"),array("operator" => "AND"),array("field" => "tag", "key" => "user_name", "relation" => "=", "value" => $_SESSION['renter_email'])),
			'data' => array("user_type" => "0"),
			'url' => 'https://ezrent.online/my-booking.php',
			'contents' => $content,
				
		);
		
		$fields = json_encode($fields);
		
		//for sending responses to Onesignal API(?)
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, "https://onesignal.com/api/v1/notifications");
		curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json; charset=utf-8',
        'Authorization: Basic MGFhMzAxZDgtYzQ1OC00ODIyLWJlNjEtNDE0Yzk4MDFjZTAw'));
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
		curl_setopt($ch, CURLOPT_HEADER, FALSE);
		curl_setopt($ch, CURLOPT_POST, TRUE);
		curl_setopt($ch, CURLOPT_POSTFIELDS, $fields);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);

		$response = curl_exec($ch);
		curl_close($ch);
		
		return $response;
		
	}
	
$response = sendMessage();
	$return["allresponses"] = $response;
	$return = json_encode( $return);

?>