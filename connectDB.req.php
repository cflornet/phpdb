<?
// Connexion à la base de données MySQL
// La chaine $dsn (Dota Source Nome), contient le type de base de données, son nom et l'adresse du serveur
const PARAM_HOST = "";
define("PARAM_PORT", "");
define("PARAM_DB", "");
const PARAM_USER = "";
const PARAM_PASSWD = "";

$dsn = "mysql:host=".PARAM_HOST.";port=".PARAM_PORT.";dbname=".PARAM_DB;

try {
// Connexion
$pdo = new PDO($dsn, PARAM_USER, PARAM_PASSWD);

// Lancer une exception en cas d'erreur
// Le premier attribut actuve le rapport d'erreurs. Le deuxième émet une exception.    
$pdo -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

// Afficher le bon encodage de caractères
$pdo -> exec("SET NAMES 'utf8'");
} catch(Exception $e) { //catch exception
  echo "<strong>Message d'erreur : </strong>" .$e->getMessage()."<br>";
  echo "<strong>Code de l'erreur : </strong>" .$e->getCode()."<br>";
  exit;
}

//var_dump($pdo->errorInfo()) ; //for errors other then connection

?>
