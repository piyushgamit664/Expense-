	<?php
		$responce=array();
		//$con=mysqli_connect("localhost","root","","Expense") or 
			//	die("dbnot connect");
			
			$con=mysqli_connect("remotemysql.com","SsLhp88JCI","5SuauyG5hL","SsLhp88JCI") or 
				die("dbnot connect");
				
				
		header('Access-Control-Allow-Origin: *');
	    header('Access-Control-Allow-Headers: X-Requested-With');
	    header('Access-Control-Allow-Methods: POST, GET, OPTIONS');
		
		//$data= file_get_contents("php://input");
		//$json_obj = json_decode($data);
		//$UserId=$json_obj->UserId;
		
		$responce['rec']=array();
		$q="select CategoryId,CategoryName,CreatedOn from category";
		$res=mysqli_query($con,$q);
		while($row=mysqli_fetch_array($res)){
			array_push($responce['rec'],$row);
		}
		 echo	json_encode($responce);
			
?>
