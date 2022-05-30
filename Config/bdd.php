<?php

const HOST =  "localhost";
const DATABASE = "veville";
const USERNAME = "root";
const PASSWORD = "";

// const HOST =  "auroreybddaurore.mysql.db";
// const DATABASE = "auroreybddaurore";
// const USERNAME = "auroreybddaurore";
// const PASSWORD = "B6yZdvxD4RExAen";

//permet de tester la connexion à la base de données
// PDO : PHP Data Objet

try {
  //définir plusieurs arguments: 1(serveur + BDD), 2 (username), 3 (mdp), 4 (options)
  $pdo = new PDO("mysql:host=" . HOST . ";dbname=" . DATABASE . "", USERNAME, PASSWORD, array(PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING, PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));
  // PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING permet de gérer les messages d'erreur
  // PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8" pour l'encodage
} catch (PDOException $error) {
  echo "Problème connexion: " . $error->getMessage();
}

//Un objet peut contenir plusieurs types
//$error est un objet qui contient une méthode appelée getMessage()
