<?php 
echo '<h4> How to Secure Password Using bcrypt in PHP? </h4>';
//สมมติว่ารับค่าจาก input ที่ส่งมาจากฟอร์ม
$username = 'admin';
$password = '123456';

//ลองแสดงออกมาดู
echo 'my username1 = '.$username .'<br>';
echo 'my password = '.$password .'<br>';

//Secure Password Using bcrypt
//cost (int) - which denotes the algorithmic cost that should be used. Examples of these values can be found on the crypt() page.

//If omitted, a default value of 10 will be used. This is a good baseline cost, but you may want to consider increasing it depending on your hardware.

//กำหนด cost 10 เพื่อให้การเข้ารหัสรวดเร็วยิ่งขึ้น *ตัวเลขยิ่งเยอะ ยิ่งทำงานช้า ซึ่งขึ้นอยู่กับความเร็วของคอมที่เราใช้ครับ เพราะฉะนั้น 10 ก็พอครับ หรือจะลองเพิ่มตัวเลขแล้วรันดูครับ ว่าจะดีเลเยอะไหม!!
$options = [
         'cost' => 10,
     ];

//รหัสผ่านที่นำมาเข้ารหัส
$store_password = '123456';
//นำเข้ากระบวนการเข้ารหัสด้วย PASSWORD_BCRYPT
$passwordHash = password_hash($store_password,  PASSWORD_BCRYPT, $options);


//ลองแสดงออกมาดู ทุกครั้งที่รีเฟรซหน้าเว็บ รหัสจะสุ่มไปเรื่อยๆ
echo 'password hash  using PASSWORD_BCRYPT =  <br> '
.'<font color="red">' .$passwordHash .'</font>';

echo '<br>';

//ตรวจสอบความถูกต้องของ username และ password
echo 'Verify Users Password <br>';

//check username ตรวจสอบ username
if($username=='admin'){

//Verify  Password ตรวจสอบ password ระหว่าง $password และ $passwordHash
$validPassword = password_verify($password, $passwordHash);

    if($validPassword){
    	//password ถูกต้อง
        echo '<font color="blue"> password match!! </font>';
    }else{
    	//password ผิด
    	echo '<font color="red"> wrong password !! </font>';
    }

}else{
	//username ผิด
	echo 'Wrong Username !!';
}

?>