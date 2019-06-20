
<?php
	class  Applicant{
		private $id;
		private $name;
		private $surname;
		private $phNumb;
		private $email;
		private $interviewDate;
		private $comment;
		private $resumeURL;
		
	   public function __construct($id, $a, $b, $c, $d, $e, $f, $g)
		{
			$this->id = $id;
			$this->name = $a;
			$this->surname = $b;
			$this->phNumb = $c;
			$this->email = $d;
			$this->interviewDate = $e;
			$this->comment = $f;
			$this->resumeURL = $g;
		}
		
		public function Get(){
		   return array($this->id, $this->name, $this->surname, $this->phNumb, $this->email, $this->interviewDate, $this->comment, $this->resumeURL);
		}
	   
	}
?>