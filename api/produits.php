<?php
	// Connect to database
	require_once './db/database.php';
	$request_method = $_SERVER["REQUEST_METHOD"];

	function getProducts()
	{
		
		$query = "SELECT * FROM posts";
		$response = array();
		$stmt = EDatabase::prepare($query);
		$stmt->execute(array(':id' => $id));
		$response = $stmt->fetchAll(PDO::FETCH_BOTH);
		header('Content-Type: application/json');
		echo json_encode($response, JSON_PRETTY_PRINT);
	}
	
	function getProduct($id=0)
	{
		$query = "SELECT * FROM posts";
		if($id > 0)
		{
			$query .= " WHERE IDPosts=:id LIMIT 1";
		}
		$response = array();
		$stmt = EDatabase::prepare($query);
		$stmt->execute(array(':id' => $id));
		$response = $stmt->fetchAll(PDO::FETCH_BOTH);
		header('Content-Type: application/json');
		echo json_encode($response, JSON_PRETTY_PRINT);
	}

	function AddProduct()
	{

		// On retourne l'id du record inséré
		$sql = " INSERT INTO posts (commentaire, datePost, postType) VALUES (:c, :ts, :pt)";
		$sth = EDatabase::prepare($sql);
		try {
			$sth->execute(array(
				':c' => $_POST["commentaire"],
				':ts' => date("Y-m-d"),
				':pt' => $_POST["postType"]
			));
		} catch (PDOException $e) {
			echo 'Problème de lecture de la base de données: ' . $e->getMessage();
			EDatabase::rollBack();
			return false;
		}
		
		header('Content-Type: application/json');
		echo json_encode($sth);
	}

	function deleteProduct($id)
	{
		$query = "DELETE FROM posts WHERE IDPosts=:id";
		$sth = EDatabase::prepare($query);
		var_dump($id);
		try {
			$sth->bindParam(':id', $id, PDO::PARAM_INT);   
			$sth->execute();
		} catch (PDOException $e) {
			echo 'Problème de lecture de la base de données: ' . $e->getMessage();
			EDatabase::rollBack();
			return false;
		}

		header('Content-Type: application/json');
		echo json_encode($sth);
	}
	

	switch($request_method)
	{
		
		case 'GET':
			// Retrive Products
			if(!empty($_GET["id"]))
			{
				$id=intval($_GET["id"]);
				getProduct($id);
			}
			else
			{
				getProducts();
			}
			break;

		case 'POST':
			// Ajouter un produit
			AddProduct();
			break;

		case 'DELETE':
    		// Supprimer un produit
			$id = intval($_GET["id"]);
			deleteProduct($id);
			break;

		default:
			// Invalid Request Method
			header("HTTP/1.0 405 Method Not Allowed");
			break;

	}
?>