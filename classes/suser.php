<?php
	class  SUser{
		private $id;
		private $name;
		private $surname;
		private $email;
		private $phNumb;
		private $user_role;
		
	   public function __construct($id, $a, $b, $c, $d, $e)
		{
			$this->id = $id;
			$this->name = $a;
			$this->surname = $b;
			$this->phNumb = $c;
			$this->email = $d;
			$this->user_role = $e;
		}
		
		public function Get(){
		   return array($this->id, $this->name, $this->surname, $this->phNumb, $this->email, $this->user_role);
		}
	   
	}
?>