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
		$Theme=$json_obj->IsTheme;
		$UserId=$json_obj->UserId;;

	
		$query="update users  set Theme=".$Theme." where UserId=".$UserId;
		$res = mysqli_query($con,$query);
       
		if($res>0)
		{
			$responce['success']=0;
			$responce['message']="Successfully Change Application";
		}
		else
		{
			$responce['error']=1;
			$responce['message']="Error Occured";
		}	
		echo json_encode($responce);
?>
