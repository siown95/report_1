<?php 
session_start();
include "db.php";
$origin = $_SESSION['userid'];
$id = $_POST['id'];
$password = $_POST['password'];
$passChk = $_POST['passChk'];
$email1 = $_POST['email1'];
$email2 = $_POST['email2'];
$home1 = $_POST['home1'];
$home2 = $_POST['home2'];
$home3 = $_POST['home3'];
$zip = $_POST['zip'];
$address1 = $_POST['address1'];
$address2 = $_POST['address2'];
$radio = $_POST['radio'];
$radio2 = $_POST['radio2'];
$email = $email1.'@'.$email2;
$email_query = "select email from member where email='$email'";
$email_result = mysqli_query($conn, $email_query);
$row = mysqli_fetch_array($result);
if($home1 != '' && $home2 != '' && $home3 != ''){
    $home = $home1.'-'.$home2.'-'.$home3;
}else{
    $home = '';
}
$check_email=filter_var($email, FILTER_VALIDATE_EMAIL);
$home = $home1.$home2.$home3;
$address = $address1.'  '.$address2;
$hashpass = hash("sha256", $password);
if($password != $passChk){
    echo '<script>alert("비밀번호와 확인이 다릅니다.");history.back();</script>';
}else if($check_email!=true){
    echo '<script>alert("비밀번호와 확인이 다릅니다.");history.back();</script>';
}else if(row == 1){
    echo '<script>alert("등록된 이메일 형식입니다.");history.back();</script>';
}else{
    $query = "update member set id='$id', pw='$password', pw_crypt='$hashpass', email='$email', home='$home', address='$address', sms=$radio, mailre=$radio2 where id='$origin'";

    $result = mysqli_query($conn, $query);
    if($result){
        $_SESSION['userid'] = $id;
        echo '<script>alert("정보가 수정되었습니다.");location.href="/member/index.php/?mode=index";</script>';

    }else{
        echo '<script>alert("fail");history.back();</script>';
    }
}
mysqli_close($conn);

?>