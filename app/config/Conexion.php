<?php
    require_once realpath('../../vendor/autoload.php');
    $dotenv = Dotenv\Dotenv::createImmutable('../../');
    $dotenv->load();

    define('SERVER', $_ENV['HOST']);
    define('BD', $_ENV['DATABASE']);
    define('PASS', $_ENV['PASSWORD']);
    define('USER', $_ENV['USUARIO']);
    define('PORT', $_ENV['PUERTO']);

    class Conexion{
        private static $conexion;

        public static function abrir_conexion(){
            if(!isset(self::$conexion)){
                try {
                    self::$conexion = new PDO('mysql:host ='.SERVER.';dbname='.BD,USER,PASS);
                    self::$conexion->exec('SET CHARACTER SET utf8');
                    return self::$conexion;
                } catch (PDOException $e) {
                    echo "error en la conexion".$e;
                    die();
                }
            }else{
                return self::$conexion;
            }
  
        }
        public static function obtener_conexion(){
            $conexion = self::abrir_conexion();
            
                return $conexion;
            
        }

        public static function cerrar_conexion(){
            self::$conexion= null;
        }

      
    }

    class CRUD{
        public static function consulta(){
            $consulta = Conexion::obtener_conexion()->prepare("SELECT * FROM t_ejemplo");
            echo 1;
            if($consulta->execute()){
                $data = $consulta->fetchAll(PDO::FETCH_ASSOC);
                echo print_r($data);
                echo "completaaaaaaaa";
            }else{
                echo "error de consulta";
            }
        }
        public static function agregar($nombre, $apellido){
            try {
                $stmt = Conexion::obtener_conexion()->prepare("INSERT INTO t_ejemplo (nombre, apellido) VALUES (?, ?)");
                $stmt->execute([$nombre, $apellido]);
                echo "Registro agregado correctamente";
            } catch (PDOException $e) {
                echo "Error al agregar registro: " . $e->getMessage();
            }
        }

        public static function editar($nombre, $apellido){
            try {
                $stmt = Conexion::obtener_conexion()->prepare("UPDATE t_ejemplo SET cadena1 = ?, cadena2 = ? WHERE id = ?");
                $stmt->execute([$nombre, $apellido]);
                echo"Se actualizo correctamente";
            } catch (PDOException $e){
                echo "Erro al actualizar:" . $e ->getMessage();
            }
        }

        public static function eliminar($id){
            try {
                $stmt = Conexion::obtener_conexion()->prepare("DELETE FROM t_ejemplo WHERE id = ?");
                $stmt->execute([$id]);
                echo "Registro eliminado correctamente";
            } catch (PDOException $e) {
                echo "Error al eliminar registro: " . $e->getMessage();
            }
        }  

    
    }

    CRUD::consulta();
    CRUD::agregar('sofia', 'Rafael');

    CRUD::editar(1, 'Sofia', 'Segundo');

    CRUD::eliminar(2);
    

    
    
  
       
    



?>