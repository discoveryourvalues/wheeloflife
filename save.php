<?php

	$email = $_POST['email'];
	$resultsArray = $_POST['resultsArray'];

	$host = 'localhost';
	$db   = 'wheeloflife';
	$user = 'monty';
	$pass = 'bajaderi';

    $dsn = "mysql:host=$host;dbname=$db;port=3306";

    $options = [
	    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
	    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
	    PDO::ATTR_EMULATE_PREPARES   => false,
	];
	try {
	     $pdo = new PDO($dsn, $user, $pass, $options);
	     echo json_encode(['works' => "WORKS", 'email' => $email]);
	} catch (PDOException $e) {
	     throw new PDOException($e->getMessage(), (int)$e->getCode());
    }

    $stmt = $pdo->prepare('SELECT * FROM submission WHERE (email = :email)');
    $stmt->execute(['email' => $email]);
    $data = $stmt->fetchAll();

    if ($data != null ){
        $stmt = $pdo->prepare('UPDATE submission SET result=:result WHERE email=:email');
        $stmt->execute(['email' => $email, 'result' => $resultsArray]);
    }
    else {
        $stmt = $pdo->prepare('INSERT INTO submission (email, result) VALUES (:email, :result)');
        $stmt->execute(['email' => $email, 'result' => $resultsArray]);
    }
    
    $stmt = null;
    $pdo = null;
	
?>