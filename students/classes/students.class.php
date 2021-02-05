<?php 
/**
 * 
 */
class StudentDb
{
	private function connectDb(){
		$connection = new mysqli("127.0.0.1", "root", "", "sad");
		return $connection;
	}

	protected function createStudent($firstname,$lastname, $email, $password){
		$query_string ="INSERT INTO students (firstname, lastname, email, password) VALUES ('".$firstname."', '".$lastname."', '".$email."', '".$password."')";
		 
		 $conn = $this->connectDb();
		 
		 if ($conn->connect_error) {
  		  die("Connection failed: " . $conn->connect_error);
		}else{
			if(!$conn->query($query_string)){
   			//	print_r($conn->error);
   				$err = $conn->error;
   				if(strpos($err, "uc_StudentEmail")){
   					header("location:index.php?err=Error on Registering&err_desc=Email you've entered is already been registered.");
   				}  					
			} else{
				header("location:log-in.php");
			}
		}
		
	}


	protected function findStudent($email, $password){
		$query_string ="SELECT * FROM students  WHERE email='".$email."' AND password='".$password."'";
		 
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

				        $_SESSION["student_lastname"]	=	$row["lastname"];
				        $_SESSION["student_firstname"]	=	$row["firstname"];
				        $_SESSION["student_email"]		=	$row["email"];
				        $_SESSION["student_id"]			=	$row["student_id"];
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