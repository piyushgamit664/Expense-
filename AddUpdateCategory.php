<?php
		$responce=array();
		//$con=mysqli_connect("localhost","root","","expense") or
		//	die("db not connect");
			
		header('Access-Control-Allow-Origin: *');
	    header('Access-Control-Allow-Headers: X-Requested-With');
	    header('Access-Control-Allow-Methods: POST, GET, OPTIONS');
		
		$data= file_get_contents("php://input");
		$json_obj = json_decode($data);
		$name=$json_obj->Name;
		$categoryid=$json_obj->CategoryId;
		$UserId=$json_obj->UserId;
		$IsDelete=$json_obj->IsDelete;

		if($categoryid==0)
		{
			$query="insert into category(CategoryName,UserId,CreatedOn) values('".$name."','".$UserId."',now())";
			$res=mysqli_query($con,$query);
		}else{
			if($IsDelete==0)
			{
				$query="update category  set CategoryName='".$name."' where CategoryId=".$categoryid;
				$res = mysqli_query($con,$query);
			}
			else
			{
				$query="delete from category where CategoryId=".$categoryid;
				$res = mysqli_query($con,$query);
			}
		}
       
		if($res>0)
		{
			if($categoryid==0)
			{
				$responce['success']=0;
				$responce['message']="Successfully insert/update";	
			}
			else
			{
				if($IsDelete==0)
				{
					$responce['success']=0;
					$responce['message']="Successfully update";
				}
				else
				{
					$responce['success']=0;
					$responce['message']="Successfully deleted";
				}
			}
			
		}
		else
		{
			$responce['error']=1;
			$responce['message']="Error Occured";
		}	
		echo json_encode($responce);
?>
