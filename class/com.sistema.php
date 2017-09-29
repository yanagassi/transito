<?php
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
		}

		function chat()
		{
			$chat = new chat;
			$query = $this->con->query("SELECT * FROM chat");
			foreach ($query as $key) {
				if (empty($key['foto'])) {
					$key['foto']='img.jpg';
				}
				$chat->printa($key['msg'], $key['data'], $key['foto']);
			}
		}

		function printa($msg, $data, $foto)
		{
			
			print("<content class='mensagem'>");
			print("<img id='user_foto' src='img/". $foto . "'>");
			print("<a id='msg_text'>Anonimo: " . $msg . "</a>");
			print("<a id='data'>". $data ."</a>");
			print("</content>");
		}

		function insert($msg)
		{
			$data = date('H:i');
			$query = $this->con->prepare("INSERT INTO chat (id, msg, data, foto) VALUES (null, :msg, :data, '') ");
			$query->bindParam(":msg", $msg, PDO::PARAM_STR);
			$query->bindParam(":data", $data, PDO::PARAM_STR);
			$query->execute();
		}
	}
?>
