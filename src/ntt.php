<?php
	namespace noware;
	
	//require_once ($_SERVER ['REQUEST_SCHEME'] . '//' . $_SERVER ['HTTP_HOST'] . '/Projects/NoWare/db.noware.php/src/db.incl.php');
	require_once ($_SERVER ['REQUEST_SCHEME'] . '://' . $_SERVER ['HTTP_HOST'] . '/lib/aaa.noware.php/www.usr.php');
	
	class ntt //implements \ArrayAccess, \Countable
	{
		protected $usr;
		protected $root, $path;
		const path_dft = null;
		
		public function __construct ()
		{
			$this -> usr = new usr ();
			$this -> root = 0;
			$this -> path = self::path_dft;
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
			return array ('usr', 'root', 'path');
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
				case 'root':
					$this -> $name = $value;
					break;
				case 'path':
					$sql = file_get_contents (__DIR__ . DIRECTORY_SEPARATOR . 'ntt.nav.param.sql');
					
					//var_dump (
						if (
							$this -> usr -> db -> query ($exception, $result, $sql, array (':path' => $value, ':src' => $this -> root))
					/*
						, $this -> root
						, $value
						, $sql
						, $exception
						, $result
					)
					*/
					//;
							)
							// check whether the provided path is valid
							if (!empty ($result) && $result [0] [0] > 0)
								$this -> $name = $value;
					
					break;
				//case 'type':
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
		
		/*
		// nav[igate] cd
		public function nav ($path)
		{
			$sql = file_get_contents (__DIR__ . DIRECTORY_SEPARATOR . 'ntt.nav.param.sql');
			
			$this -> usr -> db -> query ($exception, $result, $sql, array (':path' => $path, ':src' => $this -> root));
			
			if ($result [0] [0] == 0)
				return false;
			
			
			//$this -> path = $path;
			return true;
		}
		*/
		
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
			$result = array ();
			
			//echo 'noware::ntt::ls()' . PHP_EOL;
			
			//var_dump ($this -> root, $this -> path);
			
			$sql = file_get_contents (__DIR__ . DIRECTORY_SEPARATOR . 'ntt.ls.param.sql');
			//var_dump ($sql);
			
			// Try
			//var_dump (
			$this -> usr -> db -> query ($exception, $result, $sql, array (':path' => $this -> path, ':src' => $this -> root))
			//)
			;
			
			//var_dump ($exception);
			//var_dump ($result);
			
			//echo 'noware::ntt::ls()::return' . PHP_EOL;
			return $result;
		}
		
		public function types ()
		{
			return
				array
				(
					0 => 'literal',
					1 => 'reference'
				)
			;
		}
		/*
		public function type ()
		{
			if ($this -> path == null)
				return 0;
			else
				return 0;
		}
		*/
		public function val (string $key)
		{
			//if ($this -> type () == 0)
			//	return null;
			
			//$result [0] [0] = '';
			
			if (!$this -> usr -> db -> query ($exception, $result, '
				select
					"value"
				from
					"ntt"
				where
					"key" = :key
					and
					"id" =
					(
						select
							"dest"
						from
							"ntt.path.any"
						where
							"src" = :src
							and
							"path" = :path
					)
				', array (':path' => $this -> path, ':src' => $this -> root, ':key' => $key)))
			{
				//echo 'noware::ntt::val()::!db.query()' . PHP_EOL;
				return null;
			}
			
			//var_dump ($this -> root, $this -> path, $key, $exception, $result);
			
			if (empty ($result))
			{
				//echo 'noware::ntt::val()::result.empty()' . PHP_EOL;
				return null;
			}
			
			return $result [0] [0];
		}
	}
