<?php 
	include 'classes/instructors.class.php';
	class InstructorController extends InstructorDb
	{
	 
		private function cleandata($data) {
			$data = trim($data);
			$data = stripslashes($data);
			$data = htmlspecialchars($data);
			return $data;
		}


		public function registerInstructor($firstname,$lastname, $email, $password)
		{	
			$obj = new InstructorDb();
			$obj->setInstructor($this->cleandata($firstname),$this->cleandata($lastname), $this->cleandata($email), $this->cleandata($password));
		}

		public function findInstructor($email, $password)
		{
			$obj = new InstructorDb();
			$obj->findInstructor( $this->cleandata($email), $this->cleandata($password));
		}
}
