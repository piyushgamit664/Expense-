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
		
		$UserId = $json_obj->UserId;
		$FirstName=$json_obj->FirstName;
		$MiddleName=$json_obj->MiddleName;
		$LastName=$json_obj->LastName;
		$Address=$json_obj->Address;
		$Gender=$json_obj->Gender;
		$MobileNo=$json_obj->MobileNo;
		$Password=$json_obj->Password;
		$Status=$json_obj->Status;
		$CreatedBy=$json_obj->CreatedBy;
		
		$pass = sha1(sha1($Password).sha1("mySalt@$#(%"));

		if($UserId==0)
		{
			$query="insert into users(FirstName,MiddleName,LastName,Address,Gender,MobileNo,Password,Status,CreatedOn,CreatedBy) 
					values('".$FirstName."','".$MiddleName."','".$LastName."','".$Address."','".$Gender."','".$MobileNo."','".$pass."','".$Status."',now(),'".$CreatedBy."')";
			$res=mysqli_query($con,$query);
		}else{
			
				$query="update users 
						set 
								FirstName='".$FirstName."',
								MiddleName='".$MiddleName."',
								LastName='".$LastName."',
								Address='".$Address."',
								Gender='".$Gender."',
								MobileNo='".$MobileNo."',
								Status='".$Status."',
								ModifiedOn=now(),
								ModifiedBy='".$CreatedBy."'
						where UserId=".$UserId;
				$res = mysqli_query($con,$query);
			
		}
       
		if($res>0)
		{
			if($UserId==0)
			{
				$responce['success']=0;
				$responce['message']="Register Successfully";	
			}
			else
			{
				$responce['success']=0;
				$responce['message']="Successfully update";
			}
		}
		else
		{
			$responce['error']=1;
			$responce['message']="Error Occured";
		}	
		echo json_encode($responce);
?>
