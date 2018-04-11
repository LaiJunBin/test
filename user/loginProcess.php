<?php
	session_start();
	$keys = array_keys($_POST);
	foreach($keys as $key){
		$$key = $_POST[$key];
	}
	include_once('../db.php');
	if(!isset($_SESSION['checkLogin'])){
		$_SESSION['checkLogin'] = 0;	
	}
	function err($msg){
		$_SESSION['checkLogin']+=1;
		if($_SESSION['checkLogin'] >= 3){
			unset($_SESSION['checkLogin']);
			echo "<script>alert('錯誤達到三次');location.href='loginErr.php'</script>";
		}
		echo "<script>alert('".$msg."');location.href='login.php'</script>";
	}
	$sql = 'select * from login where l_username = :user';
	$q = $db->prepare($sql);
	$q->bindValue(":user",$username);
	$q->execute();
	$result = $q->fetch(PDO::FETCH_ASSOC);
	
	if($result == false){
			err("帳號錯誤");
	}elseif ($result['l_password'] != $password){
			err("密碼錯誤");
	}elseif ($ans != $captcha){
			err("驗證碼錯誤");
	}else{
			unset($_SESSION['checkLogin']);
			echo "<script>alert('登入成功');location.href='../index.php'</script>";
	}
	
	
?>