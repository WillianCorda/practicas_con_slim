<?php
// todabia no la uso
class Database {
    public static function conectar(){
 
     try{
         $host = 'localhost';
         $dbname = 'mi_base';
         $user = 'root';
         $pass = '';
         $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $user, $pass);
         $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
         return $pdo;
     } catch(PDOException $e) {
        die("error en la conexion: " . $e->getMessage());
     }
    }
}
