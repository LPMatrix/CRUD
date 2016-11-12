<?php 
session_start();
	function register()
		{
			include 'connect.php';
			$name = $_POST['name'];
			$mail = $_POST['mail'];
			$passkey = $_POST['passkey'];

						$sql="INSERT INTO user(name,mail,password) VALUES('$name','$mail','$passkey')";
						$conn->exec($sql);
						header("Location:index.php");
			
		}
		
		function login()
		{
			include 'connect.php';
			$name = $_POST['name'];
			$passkey = $_POST['passkey'];


				if (isset($_POST['name']) && isset($_POST['passkey'])) {
					$sql="SELECT * FROM user WHERE name=? AND password=?";
					$data = $conn->prepare($sql);
					$data->execute(array($name,$passkey));
					$result = $data->fetch(PDO::FETCH_ASSOC);

					if ($result>0) {
						    $_SESSION['id']=$result['id'];
					 		$_SESSION['name']=$result['name'];
					 		header("Location:index.php");
					} else {
						echo "User not found";
					}
					
				}
			
		}

		if (isset($_POST['register'])) {
			register();

		} elseif (isset($_POST['login'])) {
			login();

		} 
		
 ?>