<?php 
include 'classes/students.class.php';

class StudentController extends StudentDb
{	
	private function cleandata($data) {
		$data = trim($data);
		$data = stripslashes($data);
		$data = htmlspecialchars($data);
		return $data;
	}
	
	public function addStudent($firstname,$lastname, $email, $password){
		$obj = new StudentDb();
		$obj->createStudent($this->cleandata($firstname),$this->cleandata($lastname),$this->cleandata($email),$this->cleandata($password));
	}

	public function findStudent($email, $password){
		$obj = new StudentDb();
		$obj->findStudent($this->cleandata($email), $this->cleandata($password));
	}



}