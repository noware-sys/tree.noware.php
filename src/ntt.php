<?php
	namespace noware;
	
	//require_once ($_SERVER ['REQUEST_SCHEME'] . '//' . $_SERVER ['HTTP_HOST'] . '/Projects/NoWare/db.noware.php/src/db.incl.php');
	require_once ($_SERVER ['REQUEST_SCHEME'] . '://' . $_SERVER ['HTTP_HOST'] . '/lib/aaa.noware.php/www.usr.php');
	
	class ntt //implements \ArrayAccess, \Countable
	{
		protected $usr;
		protected $path;
		
		public function __construct ()
		{
			$this -> usr = new usr ();
			$this -> path = 0;
		}
		
		public function __destruct ()
		{
			//$this -> db -> disconnect ();
		}
		
		/*
		public function __wakeup ()
		{
			//var_dump ($this -> database);
			//$this -> database -> reconnect ();
			//$this -> database = new database ();
			//$this -> account -> database -> reconnect ();
			//$this -> account -> identify ('');
			var_dump ($this);
		}
		*/
		
		public function __sleep ()
		{
			return array ('usr', 'path');
		}
		
		public function __get ($name)
		{
			return $this -> $name;
		}
		
		public function __set ($name, $value)
		{
			switch ($name)
			{
				case 'usr':
					if (gettype ($value) == 'object' && get_class ($value) == usr::class)
					{
						$this -> $name = $value;
						//return $this -> $name;
					}
					break;
				case 'type':
			}
			
			return $this -> $name;
		}
		
		/*
		// get value
		public function __toString ()
		{
			if ($this -> type () == 0/*literal* /)
			{
				return '';
			}
		}
		
		// set value
		public function set ($value)
		{
			return false;
		}
		*/
		
		// nav[igate] cd
		public function nav ($path)
		{
			return false;
		}
		
		public function add ($item)
		{
			return false;
		}
		
		public function del ($item/*, $recursive = false*/)
		{
			return false;
		}
		
		public function ls ()
		{
			return
				array
				(
					'lit',
					'ref'
				);
		}
		
		public function types ()
		{
			return
				array
				(
					'literal',
					'reference'
				);
		}
		
		public function type ()
		{
			return 0;
		}
	}
