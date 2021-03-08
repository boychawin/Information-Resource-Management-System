# PhpMailer - ส่งอีเมลบน Localhost ด้วย PHPMailer
```sh
$mailto = "yourmail@gmail@gmail.com";
$mailSub = "Lorem Ipsum คือ เนื้อหาจำลองแบบเรียบๆ";
$mailMsg = "
  Lorem Ipsum คือ เนื้อหาจำลองแบบเรียบๆ ที่ใช้กันในธุรกิจงานพิมพ์หรืองานเรียงพิมพ์ 
  มันได้กลายมาเป็นเนื้อหาจำลองมาตรฐานของธุรกิจดังกล่าวมาตั้งแต่ศตวรรษที่
";
require 'PHPMailer/PHPMailerAutoload.php';
$mail = new PHPMailer();
$mail ->IsSmtp();

$mail ->SMTPAuth = true;
$mail ->SMTPSecure = 'tls';
$mail ->Host = "smtp.gmail.com";
$mail ->Port = 587; // or 587
//$mail ->IsHTML(true);
$mail ->Username = "yourmail@gmail.com";
$mail ->Password = "email acount Password";
$mail ->SetFrom("yourmail@gmail.com", "Company name");
$mail ->Subject = $mailSub;
$mail ->Body = $mailMsg;
$mail ->AddAddress($mailto);

if(!$mail->Send()){
  echo "Mail Not Sent";
}
else{
  echo "Mail Sent";
}
```

> หมายเหตุ
> ต้องตั้งค่าใน Gmail โดยเปิดแอปที่มีความปลอดภัยน้อยโดยพิมพ์คำว่า less secure apps ใน Google Search
