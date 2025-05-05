<?php
//var url
$base_url = 'http://localhost/swu_alumni';

//var database
$db_host = 'localhost';
$db_user = 'root';
$db_pass = '';
$db_name = 'swu_alumni';

//connect database
$conn = mysqli_connect($db_host, $db_user, $db_pass, $db_name);
if (!$conn) {
    die('connection failed');
}

//prefix session
define('WP','project2024')

?>

<?php 
$conn = mysqli_connect("localhost", "root", "","swu_alumni"); 

mysqli_set_charset($conn,"utf8"); // เข้ารหัสไว้เพื่อให้แสดงอักขระเป็นภาษาไทย

function checknull($value1) /// ฟังก์ชันทั่วไปใช้เช็คค่าว่าง
{
	if(empty($value1))
	{			
		echo"<script>
		alert('กรุณากรอกข้อมูลให้ครบ'); 
		history.back();
		</script>";
		exit();				
	}
}
function convertdate($date) {  /// ฟังก์ชันแปลงวันที่จาก พศ เป็น คศ
	$date_array=explode("/",$date);
	$y=$date_array[2];
	$y=$y-543;
	$m=$date_array[1];
	$d=$date_array[0];
	$displaydate = $y."-".$m."-".$d;
	return $displaydate; 
}

function displaydate($date) { /// ฟังก์ชันแปลงวันที่จาก คศ เป็น พศ
	$date_array=explode("-",$date);
	$y=$date_array[0];
	$y=$y+543;
	//$y=substr($y,-2,2);	 
	$m=$date_array[1];
	$d=$date_array[2];
	$displaydate = $d."/".$m."/".$y;
	return $displaydate; 
}

function displaydatetextmonth($date) {  /// ฟังก์ชันแปลงเดือน
	$date_array=explode("-",$date);
	$y=$date_array[0];
	$y=$y+543;
	//$y=substr($y,-2,2);	 
	$m=tranmonth2text($date_array[1]); // เรียกใช้ ฟังก์ชันในการแปลงเป็นคำพูด
	$d=$date_array[2];
	$displaydate = $d." ".$m." ".$y;
	return $displaydate; 
}

function displaydatetextmonth2($date) {  /// ฟังก์ชันแปลงเดือน กรณีที่มีเวลามาด้วย
	// ตรวจสอบหากค่าว่าง หรือ เท่ากับวันที่ไม่สมบูรณ์
	if (empty($date) || $date == '0000-00-00 00:00:00') {
		return "-";  // หรือจะ return ค่าว่าง "" หรือ ข้อความอื่นตามต้องการ
	}
    // แยกวันที่ออกเป็นปี เดือน วัน เวลา
    $date_array = explode("-", $date);
    $y = $date_array[0];
    $y = $y + 543; // แปลง ค.ศ. เป็น พ.ศ.

    // แปลงเดือนเป็นข้อความ เช่น 01 เป็น มกราคม
    $m = tranmonth2text($date_array[1]);

    // แยกวันกับเวลา
    $day_array = explode(" ", $date_array[2]);

    // สร้างข้อความวันที่ใหม่
    $displaydate = $day_array[0] . " " . $m . " " . $y;

    // ถ้ามีเวลา ให้แสดงด้วย
    if (isset($day_array[1])) {
        $displaydate .= " " . $day_array[1];
    }
	return $displaydate; 
}


function displaydate2($date) {
	$date_array=explode("-",$date);
	$y=$date_array[0];
	$y=$y+543;
	//$y=substr($y,-2,2);	 
	$m=tranmonthshort($date_array[1]);
	$d=$date_array[2];
	$displaydate = $d."/".$m."/".$y;
	return $displaydate; 
}

function tranmonthshort($m1){
	if($m1=="01"){$mname="ม.ค";}
	else if($m1=="02"){$mname="ก.พ.";}
	else if($m1=="03"){$mname="มี.ค.";}
	else if($m1=="04"){$mname="เม.ย.";}
	else if($m1=="05"){$mname="พ.ค.";}
	else if($m1=="06"){$mname="มิ.ย";}
	else if($m1=="07"){$mname="ก.ค.";}
	else if($m1=="08"){$mname="ส.ค";}
	else if($m1=="09"){$mname="ก.ย.";}
	else if($m1=="10"){$mname="ต.ค";}
	else if($m1=="11"){$mname="พ.ย";}
	else if($m1=="12"){$mname="ธ.ค";}
return $mname;
}

function tranmonth2text($month){
	if($month=="01"){$monthname="มกราคม";}
	else if($month=="02"){$monthname="กุมภาพันธ์";}
	else if($month=="03"){$monthname="มีนาคม";}
	else if($month=="04"){$monthname="เมษายน";}
	else if($month=="05"){$monthname="พฤษภาคม";}
	else if($month=="06"){$monthname="มิถุนายน";}
	else if($month=="07"){$monthname="กรกฏาคม";}
	else if($month=="08"){$monthname="สิงหาคม";}
	else if($month=="09"){$monthname="กันยายน";}
	else if($month=="10"){$monthname="ตุลาคม";}
	else if($month=="11"){$monthname="พฤศจิกายน";}
	else if($month=="12"){$monthname="ธันวาคม";}
	else{$monthname="ทุกเดือน";}

return $monthname;
} 

function shortmonth($m1,$y1){
	
	$y=$y1+543;	 
	if($m1=="01"){$mname="ม.ค";}
	else if($m1=="02"){$mname="ก.พ.";}
	else if($m1=="03"){$mname="มี.ค.";}
	else if($m1=="04"){$mname="เม.ย.";}
	else if($m1=="05"){$mname="พ.ค.";}
	else if($m1=="06"){$mname="มิ.ย";}
	else if($m1=="07"){$mname="ก.ค.";}
	else if($m1=="08"){$mname="ส.ค";}
	else if($m1=="09"){$mname="ก.ย.";}
	else if($m1=="10"){$mname="ต.ค";}
	else if($m1=="11"){$mname="พ.ย";}
	else if($m1=="12"){$mname="ธ.ค";}
	$displaydate = $mname." ".$y;
	return $displaydate; 
}



function num2string($num){
	$digit=Array("หนึ่ง","สอง","สาม","สี่","ห้า","หก","เจ็ด","แปด","เก้า");
	$unit=Array("สิบ","ร้อย","พัน","หมื่น","แสน");

	if($num==0)
	return "ศูนย์บาทถ้วน";

	if(strpos($num,".")==0)
	$num.=".00";

	$tmp=substr($num,0,strpos($num,"."));
	while(strlen($tmp)>6)
	{
	$cut=strlen($tmp)%6;
	if($cut==0)$cut=6;
	$data=substr($tmp,0,$cut);
	for($i=0;$i<strlen($data)-2;$i++)
	{
	if($data[$i]==0)
	continue;

	$ans.=$digit[$data[$i]-1].$unit[strlen($data)-$i-2];
	}
	$ans.=num2string_2digit(substr($data,strlen($data)-2))."ล้าน";
	$tmp=substr($tmp,$cut);
	}

	for($i=0;$i<strlen($tmp)-2;$i++)
	{
	if($tmp[$i]==0)
	continue;

	$ans.=$digit[$tmp[$i]-1].$unit[strlen($tmp)-$i-2];
	}

	$ans.=num2string_2digit(substr($tmp,strlen($tmp)-2))."บาท";

	$tmp=substr($num,strpos($num,".")+1);
	if(substr($tmp,0,2)=="00")
	return $ans."ถ้วน";

	return $ans.num2string_2digit($tmp)."สตางค์";
}

function num2string_2digit($num){
	$digit=Array("","หนึ่ง","สอง","สาม","สี่","ห้า","หก","เจ็ด","แปด","เก้า");

	$ans="";
	$num=sprintf("%d",$num);

	if(strlen($num)==1)
	return $digit[$num];

	if($num[0]==2)
	$ans.="ยี่";
	else if($num[0]>2)
	$ans.=$digit[$num[0]];

	if($num[0]>0)
	$ans.="สิบ";

	if($num[1]>1)
	$ans.=$digit[$num[1]];
	else if($num[1]==1)
	$ans.="เอ็ด";

	return $ans;
}
?>