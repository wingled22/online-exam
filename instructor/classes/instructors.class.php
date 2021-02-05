<?php

class InstructorDb 
{
	
	private function connectDb(){
		$connection = new mysqli("127.0.0.1", "root", "", "sad");
		return $connection;
	}

	
	protected function setInstructor($firstname,$lastname, $email, $password){
		$query_string ="INSERT INTO instructors (firstname, lastname, email, password) VALUES ('".$firstname."', '".$lastname."', '".$email."', '".$password."')";
		 
		 $conn = $this->connectDb();
		 
		 if ($conn->connect_error) {
  		  die("Connection failed: " . $conn->connect_error);
		}else{
			if(!$conn->query($query_string)){
   			//	print_r($conn->error);
   				$err = $conn->error;
   				if(strpos($err, "uc_email")){
   					header("location:index.php?err=Error on Registering&err_desc=Email you've entered is already been registered.");
   				}  					
			} else{
				header("location:log-in.php");
			}
		}
		
	}


	protected function findInstructor($email, $password){
		$query_string ="SELECT * FROM instructors  WHERE email='".$email."' AND password='".$password."'";
		 
		 $conn = $this->connectDb();
		 
		 if ($conn->connect_error) {
  		  die("Connection failed: " . $conn->connect_error);
		}else{
			if(!$conn->query($query_string)){
   				print_r($conn->error);
   				$err = $conn->error;
   				  					
			} else{
				$result = $conn->query($query_string);
				 if($result->num_rows == 1){
				 	$row_cnt = $result->num_rows;
				 	session_start();
				 	 while ($row = $result->fetch_assoc()) {

				        $_SESSION["lastname"]	=	$row["lastname"];
				        $_SESSION["firstname"]	=	$row["firstname"];
				        $_SESSION["email"]		=	$row["email"];
				        $_SESSION["instructor_id"]	=	$row["instructor_id"];
				        print_r($_SESSION);
 					   }
    				
    				 header('location:dashboard.php');
    			}else{
    				header('location:log-in.php?err=User cannot be found&err_desc=Try signing up');
    			}   				 
			}
		}
		
	}
}