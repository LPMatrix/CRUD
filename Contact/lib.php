<?php 
session_start();
include 'connect.php';


		
		function delete(){
			include 'connect.php';

			$id=$_POST['del_id'];

			$sql="DELETE FROM contact WHERE id= ?";
			$data=$conn->prepare($sql);
			$data->execute(array($id));

			header("Location:index.php");
		}
		
		function edit(){
			include 'connect.php';
			$name = $_POST['name'];
			$pnumber = $_POST['number'];
			$mail = $_POST['mail'];
			$category = $_POST['category'];
			$id=$_POST['hide'];

			$sql="UPDATE contact SET name=?,pnumber=?,mail=?,category=? WHERE id=?";	
			$data=$conn->prepare($sql);
			$data->execute(array($name,$pnumber,$mail,$category,$id));

			header("Location:index.php");
		}

		function add(){
			include 'connect.php';
			$name = $_POST['name'];
			$number = $_POST['number'];
			$mail = $_POST['mail'];
			$category = $_POST['category'];
			$id=$_POST['id'];
			$sql="INSERT INTO contact(user_id,name,pnumber,mail,category) VALUES('$id','$name','$number','$mail','$category')";
			$data=$conn->exec($sql);
			if($data){

			header("Location:index.php");
		}
		else{echo "Values not saved";}
		}


		if (isset($_POST['delete'])) {
				
				delete();
			}

			elseif (isset($_POST['edit'])) {
				edit();
			}
			elseif (isset($_POST['save'])) {
				add();
			}

 ?>