<?php
		$responce=array();
		//$con=mysqli_connect("localhost","root","","expense") or
			//die("db not connect");
		
		
		$con=mysqli_connect("remotemysql.com","SsLhp88JCI","5SuauyG5hL","SsLhp88JCI") or 
		 die("dbnot connect");
		header('Access-Control-Allow-Origin: *');
	    header('Access-Control-Allow-Headers: X-Requested-With');
	    header('Access-Control-Allow-Methods: POST, GET, OPTIONS');
		
		$data= file_get_contents("php://input");
		$json_obj = json_decode($data);
		$UserName=$json_obj->UserName;
		$Password=$json_obj->Password;

		$pass = sha1(sha1($Password).sha1("mySalt@$#(%"));
		
	
		
		$result = mysqli_query($con,"SELECT UserId FROM users WHERE MobileNo = '".$UserName."'");
		
		if (mysqli_num_rows($result) == 0)
		{
				$responce['success']=1;
				$responce['message']="User Does not exists";	
		} else {
			$result = mysqli_query($con,"SELECT * FROM users WHERE MobileNo = '".$UserName."' and Password='".$pass."'");
			if(mysqli_num_rows($result)==0) 
			{
				$responce['success']=1;
				$responce['message']="Invalid username and password";
			}
			else
			{
				$responce['success']=0;
				$responce['message']="Successfully Lodin!!!";
				$responce['Users']=array();
				while($row=mysqli_fetch_array($result)){
					array_push($responce['Users'],$row);
				}
				
			}
		}
		
		
		echo json_encode($responce);
?>
