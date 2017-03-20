<?php
$access_token = 'dTPLwK6K5H4WJwpbIbUThLs7kBvVpsIcwEMPyE3i4rx9MbkDEa5E5Dxl/MxikH1Tp16uOR6xGggV9EYy/LT8EmwCt94+dkgMM7pheUuse9WbT4X4/ovqEEejm7Kp/hLs3P/qYMS/RlsBmL66OB87EwdB04t89/1O/w1cDnyilFU=';

// Get POST body content
$content = file_get_contents('php://input');
// Parse JSON
$events = json_decode($content, true);
// Validate parsed JSON data
if (!is_null($events['events'])) {
	// Loop through each event
	foreach ($events['events'] as $event) {
		// Reply only when message sent is in 'text' format
		if ($event['type'] == 'message' && $event['message']['type'] == 'text') {
			// Get text sent
			$text = $event['message']['text'];

			$text_reply = 'ขอโทษค่ะ น้ำฝนไม่เข้าใจ';
			// Get replyToken
			$replyToken = $event['replyToken'];

			if($text == 'สวัสดี'){
				$text_reply = 'สวัสดีค่ะ';
			}else if($text == '@น้ำฝน คุณพ่อเป็นไงบ้าง'){
				$text_reply = 'คุณพ่อสบายดีค่ะ วันนี้คุณพ่อได้จำนวนก้าว 8310 ก้าว, เป็นระยะทาง 3.7 ก.ม., เดินว่ิงรวม 2.7 ชั่วโมงและนั่งและนอนพักผ่อนไปแล้ว 11 ชั่วโมงค่ะ';	
			}else if($text == '@น้ำฝน คุณแม่เป็นไงบ้าง'){
				$text_reply = 'คุณพ่อสบายดีค่ะ วันนี้คุณพ่อได้จำนวนก้าว 6454 ก้าว, เป็นระยะทาง 2.9 ก.ม., เดินว่ิงรวม 1.3 ชั่วโมงและนั่งและนอนพักผ่อนไปแล้ว 8 ชั่วโมงค่ะ';
			}else if($text == '@น้ำฝน คุณพ่ออยู่บ้านไหม'){
				$text_reply = 'อยู่ค่ะ ตอนนี้คุณพ่ออยู่ห้องครัวค่ะ';
			}else if($text == '@น้ำฝน คุณแม่อยู่บ้านไหม'){
				$text_reply = 'อยู่ค่ะ ตอนนี้คุณแม่อยู่ห้องนั่งเล่นค่ะ';
			}else if($text == '@น้ำฝน คุณพ่ออยู่ไหน'){
				$text_reply = 'ตำแหน่งตอนนี้อยู่ที่ตลาดหน้าปากซอยค่ะ';
			}else if($text == '@น้ำฝน คุณแม่อยู่ไหน'){
				$text_reply = 'ตำแหน่งตอนนี้อยู่ที่ร้านทำผมใกล้ๆบ้านค่ะ';
			}else if($text == '@น้ำฝน อายุเท่าไหร่'){
				$text_reply = '16 ค่ะ';
			}else if($text == '@น้ำฝน มีแฟนรึยัง'){
				$text_reply = 'ยังไม่ค่ะ โสดค่ะ';
			}else if($text == '@น้ำฝน อีดอก'){
				$text_reply = 'มึงซิอีดอก';
			}else{
				$text_reply = 'ขอโทษค่ะ น้ำฝนไม่เข้าใจ';
			}

			// Build message to reply back
			$messages = [
				'type' => 'text',
				'text' => $text_reply
			];
			

			// Make a POST Request to Messaging API to reply to sender
			$url = 'https://api.line.me/v2/bot/message/reply';
			$data = [
				'replyToken' => $replyToken,
				'messages' => [$messages],
			];
			$post = json_encode($data);
			$headers = array('Content-Type: application/json', 'Authorization: Bearer ' . $access_token);

			$ch = curl_init($url);
			curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
			curl_setopt($ch, CURLOPT_POSTFIELDS, $post);
			curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
			curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
			$result = curl_exec($ch);
			curl_close($ch);

			echo $result . "\r\n";
		}
	}
}
echo "OK";