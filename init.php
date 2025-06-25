<?php 

session_start(); 
if(!isset($_SESSION['csrf_token'])){
    $_SESSION['csrf_token']=bin2hex(random_bytes(32)); 
}
$csrf_token=$_SESSION['csrf_token']; 
define ('BASE_URL', '/carpeta-del-curso/tu-proyecto'); 
error_reporting( E_ALL );
ini_set( 'display_errors', 1 );

$host='localhost'; 
$user='root'; 
$password= 'root'; 
$database='microcms'; 
$port='3306'; 
$pdo_dsn = "mysql:host=$host; dbname=$database; charset=utf8"; 
try{
    $db= new PDO($pdo_dsn, $user, $password ); 
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
}
catch (PDOException $e ){
    print "Erreur" .$e->getMessage(). "</br>";
    die;  
}

