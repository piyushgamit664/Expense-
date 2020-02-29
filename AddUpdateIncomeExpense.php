<?php
		$responce=array();
		//$con=mysqli_connect("localhost","root","","expense") or
		//	die("db not connect");
		$con=mysqli_connect("remotemysql.com","SsLhp88JCI","5SuauyG5hL","SsLhp88JCI") or 
				die("dbnot connect");
			
		header('Access-Control-Allow-Origin: *');
	    header('Access-Control-Allow-Headers: X-Requested-With');
	    header('Access-Control-Allow-Methods: POST, GET, OPTIONS');
		
		$data= file_get_contents("php://input");
		$json_obj = json_decode($data);
		
		$IncomeExpenseId = $json_obj->IncomeExpenseId;
		$UserId = $json_obj->UserId;
		$Date=$json_obj->Date;
		$IsIncome=$json_obj->IsIncome;
		$CategoryId=$json_obj->CategoryId;
		$Amount=$json_obj->Amount;
		$Description=$json_obj->Description;
		$Image=$json_obj->Image;
		$IsActive=$json_obj->IsActive;
		$CreatedBy=$json_obj->CreatedBy;
		

		if($IncomeExpenseId==0)
		{
			$query="insert into incomeexpense(UserId,Date,IsIncome,CategoryId,Amount,Description,Image,IsActive,CreatedOn,CreatedBy) 
					values('".$UserId."','".$Date."','".$IsIncome."','".$CategoryId."','".$Amount."','".$Description."','".$Image."','".$IsActive."',now(),'".$CreatedBy."')";
			
			$res=mysqli_query($con,$query);
		}else{
			
				$query="update incomeexpense 
						set 
								UserId='".$UserId."',
								Date='".$Date."',
								IsIncome='".$IsIncome."',
								CategoryId='".$CategoryId."',
								Amount='".$Amount."',
								Description='".$Description."',
								Image='".$Image."',
								IsActive = '".$IsActive."',
								ModifiedOn=now(),
								ModifiedBy='".$CreatedBy."'
						where UserId=".$UserId;
				$res = mysqli_query($con,$query);
			
		}
       
		if($res>0)
		{
			if($IncomeExpenseId==0)
			{
				$responce['success']=0;
				$responce['message']="Income/expense add Successfully";	
			}
			else
			{
				$responce['success']=0;
				$responce['message']="Income/expense update Successfully ";
			}
		}
		else
		{
			$responce['error']=1;
			$responce['message']="Error Occured";
		}	
		echo json_encode($responce);
?>
