<?php

// Import the file to connect to DB
require __DIR__ . '/inc/db.php';

// Initialize variables
$argonautesList = array();
$name = '';

// If the form is submitted
if (!empty($_POST)) {
  // Stock form's value into the variable $name
  $name = isset($_POST['name']) ? $_POST['name'] : '';

  // Insert into DB
  $insertQuery = "
      INSERT INTO `argonautes` (name)
      VALUES ('{$name}')
      ";

  $affectedRows = $pdo->exec($insertQuery);

  if ($affectedRows === 1) {
    header('Location: index.php');
    exit();
  } else {
    exit("Erreur lors de l'ajout d'un argonaute");
  }
}

// Get the Argonautes List from DB
$pdoStatement = $pdo->query("SELECT * FROM `argonautes`");

$argonautesList = $pdoStatement->fetchAll(PDO::FETCH_ASSOC);

// Import the file with HTML code
require __DIR__ . '/view/argonautes.php';