<?php
error_reporting(E_ALL^E_NOTICE);
	/**
	* 
	*/
	class conexao
	{
		
		function initi()
		{
			$user = 'root';
			$pass = '';
			$conn = new PDO('mysql:host=localhost;dbname=banco', $user, $pass);
			$conn -> exec("SET CHARACTER SET utf8");
			$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			return $conn;
		}

	}
	/**
	* 
	*/
	class init
	{
		
		function __construct()
		{
			$con = new conexao;
			$this->con  = $con->initi();
		}

		function confirma($token)
		{
			$query = $this->con->prepare("SELECT * FROM usuarios WHERE token=:token");
			$query->bindParam(':token', $token, PDO::PARAM_STR);
			$query->execute();
			foreach ($query as $key) {
				$user = $key['usuario'];
				break;
			}
			if (empty($user)) {
				return FALSE;
			}else{
				return TRUE;
			}

		}
	}

	/**
	* 
	*/
	class Login
	{
		
		function __construct()
		{
			$con = new conexao;
			$this->con  = $con->initi();
		}

		function logar($user, $pass)
		{
			$login = new Login;
			$query = $this->con->prepare('SELECT * FROM usuarios  WHERE usuario=:user');
			$query->bindParam(":user", $user, PDO::PARAM_STR);
			$query->execute();
			foreach ($query as $key) {
				$userDB =  $key['usuario'];
				$senhaDB = $key['senha'];
				break;
			}
			if ($user == $userDB && $pass == $senhaDB) {
				session_start();
				$_SESSION['token'] = $login->token($user);
			}
			else{ print 'senha errada';}
		}

		function token($user)
		{
			$token = md5(uniqid(time()));
			$query = $this->con->prepare("UPDATE usuarios SET token=:token WHERE usuario=:user");
			$query->bindParam(':token', $token, PDO::PARAM_STR);
			$query->bindParam(':user', $user, PDO::PARAM_STR);
			$query->execute();
			return $token;
		}
	}

	/**
	* 
	*/
	class chat
	{
		
		function __construct()
		{
			date_default_timezone_set('America/Sao_Paulo');
			$con = new conexao;
			$this->con  = $con->initi();
			session_start();
			$this->token = $_SESSION['token'];
		}

		function chat()
		{
			$chat = new chat;
			$query = $this->con->query("SELECT * FROM chat");
			foreach ($query as $key) {
				if (empty($key['foto'])) {
					$key['foto']='img.jpg';
				}
				$chat -> printa($key['msg'], $key['data'], $key['foto'], $key['user']);
				

			}
		}

		function printa($msg, $data, $foto, $userDB)
		{
			$chat = new chat;
			$user = $chat-> user();
			if($user != $userDB)
			{
		
				print("<content class='mensagem'>");
				print("<img id='user_foto' src='img/". $foto . "'>");
				print("<a id='msg_text'>Anonimo: " . $msg . "</a>");
				print("<a id='data'>". $data ."</a>");
				print("</content>");
			}else{
				print("<content class='mensagem2' style='float:right;'>");
				//print("<img id='user_foto' src='img/". $foto . "'>");
				print("<a id='msg_text2'>" . $msg . "</a>");
				print("<a id='data2'>". $data ."</a>");
				print("</content>");
			}
		}

		function insert($msg)
		{
			$chat = new chat;
			$data = date('H:i');
			$user =  $chat-> user();
			$query = $this->con->prepare("INSERT INTO chat (id, msg, data, foto, user) VALUES (null, ?, ?, '', ?) ");
			$query->bindParam(1, $msg, PDO::PARAM_STR);
			$query->bindParam(2, $data, PDO::PARAM_STR);
			$query->bindParam(3, $user, PDO::PARAM_INT);
			$query->execute();
		}

		function user()
		{
			$data = $this->con->prepare("SELECT * FROM usuarios WHERE token=:token");
			$data->bindParam(':token', $this->token, PDO::PARAM_STR);
			$data->execute();
			foreach ($data as $row) {
				$user = $row['id'];
				return $user; 
				break;
			}
		}
	}

	/**
	* 
	*/
	class logout
	{

		function __construct()
		{
			date_default_timezone_set('America/Sao_Paulo');
			$con = new conexao;
			$this->con  = $con->initi();
			session_start();
		}
		function newToken($user){
			$token = md5(uniqid(time()));
			$query = $this->con->prepare("UPDATE usuarios SET token=:token WHERE token=:user");
			$query->bindParam(':token', $token, PDO::PARAM_STR);
			$query->bindParam(':user', $user, PDO::PARAM_STR);
			$query->execute();
		}
	}
?>
