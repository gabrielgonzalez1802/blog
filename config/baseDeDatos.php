<?php
/**
 * Mysql Database access methods
 * @author Gabriel González
 */
require_once 'conexion.php';
class BaseDeDatos extends Conexion{
	
	/**
	 * @version 2.0 Gabriel Gonzalez
	 * Conexion utilizando PDO
	 * @return String conn devuelve la variable de la conexion
	 */
	 function conectarDb() {
	    //Gabriel Gonzalez
	     try {
	         
 	         $servername = parent::getServername();
 	         $username = parent::getUsername();
 	         $password = parent::getPassword();
 	         $dbname = parent::getDBname();
	         $port = parent::getPort();
             
	         // Create connection 
 	         // MYSQL 
		$conn = new PDO('mysql:host='.$servername.';dbname='.$dbname, $username, $password);
             // POSTGRESS
             // $conn = new PDO("pgsql:host=$servername;port=$port;dbname=$dbname", $username, $password);
	         // set the PDO error mode to exception
	         $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	         
	         if (!$conn) {
	             die("Can't connect to database!");
	         };
	     }
	     catch(PDOException $e)
	     {
	         echo "Connection failed: " . $e->getMessage();
	         return(false);
	     }
	     return($conn);
	}
	 
	/**
	 * desconectarDb desconecta de la base de datos
	 * @author Gabriel González
	 * @param  Sting conn $conn conexion a cerrar
	 * @return bool	   retorna true si cerro la conexion a la BD, false de caso contrario
	 */
	function desconectarDb($pdo, $stmt=null) {
	    if($stmt!=null){
	        $stmt->closeCursor();
	        $stmt = null;
	    }
	    $pdo = null;
	}

    /**
     * Funcion que ejecuta una consulta preparada del tipo SELECT
     * @author Gabriel González
     * @param String $sql
     *            Consulta SQL
     * @param Array $params
     *            Parametros
     */
    protected function executePreparedStatement($sql, $params)
    {
        $pdo = $this->conectarDb();
        $stmt = $pdo->prepare($sql);
        $data = false;
        try {
            $stmt->execute($params);
            $data = $stmt->fetchAll();
            $pdo->commit();
        } catch (Exception $e) {
            $pdo->rollback();
            throw $e;
        }finally {
            $this->desconectarDb($pdo, $stmt);
            return $data;
        }
    }
    
    /**
     * Funcion que ejecuta una consulta preparada del tipo UPDATE
     * @author Gabriel González
     * @param String $sql
     *            Consulta SQL
     * @param Array $params
     *            Parametros
     */
    protected function executePreparestatementUpdate($sql){
        $pdo = $this->conectarDb();
        $update = false;
        $stmt = $pdo->prepare($sql);
        try {
            $pdo->beginTransaction();
            $update = $stmt->execute();
            $pdo->commit();
        }catch (Exception $e){
            $pdo->rollback();
            throw $e;
        }finally {
            $this->desconectarDb($pdo,$stmt);
            return $update;
        }
    }
    
       
    
    /**
     * Funcion que ejecuta una consulta simple del tipo SELECT
     *
     * @author Gabriel González
     * @param String $sql
     *            Consulta SQL
     */
    protected function executeStatementPDO($sql)
    {
        $pdo = $this->conectarDb();
        
        $stmt = $pdo->query($sql);
        
        //Fetch our rows. Array (empty if no rows). False on failure.
        $data = $stmt->fetchAll(PDO::FETCH_ASSOC);

        if (! $data) {
            $data = false;
        }
        $this->desconectarDb($pdo, $stmt);
        return $data;
    }
	
    /**
     * Función encargada de ejecutar consultas preparadas del tipo UPDATE, INSERT y DELETE
     * @author Gabriel González
     * @param String $sql -> Consulta preparada del tipo ?
     * @param Array $params -> Arreglo con los parámetros para la consulta preparada
     * @throws Exception
     */
	protected function executeOtherQuery($sql,$params){
	    $pdo = $this->conectarDb();
	    
	    $stmt = $pdo->prepare($sql);
    	try {
    	    $pdo->beginTransaction();
    	    for($i=1; $i<= count($params); $i++)
     	    {
     	        $stmt->bindParam($i, $params[$i-1]);
     	    }
     	    $stmt->execute();
    	    $pdo->commit();
    	}catch (Exception $e){
    	    $pdo->rollback();    	    
    	    throw $e;
    	}finally {
    	    $this->desconectarDb($pdo);
    	}
	}
	
	/**
	 * Funcion encargada de realizar un insert Simple
	 * @param String $sql query sql
	 * @throws Exception
	 */
	protected function executeSimpleInsert($sql){
	    $insert = false;
	    $pdo = $this->conectarDb();
	    try {
	        $pdo->exec($sql);
	        $insert = true;
	    }catch (Exception $e){
	        //No inserto
	    }finally {
	        $this->desconectarDb($pdo);
	    }
	    return $insert;
	}
	
	/**
	 * Funcion encargada de realizar un insert Simple
	 * @param String $sql query sql
	 * @throws Exception
	 */
	protected function executeSimpleInsertReturnLastID($sql){
	    $insert = false;
	    $pdo = $this->conectarDb();
	    try {
	        $pdo->exec($sql);
	        $insert = $pdo->lastInsertId()!=0?$pdo->lastInsertId():null;
	    }catch (Exception $e){
	        $insert = null;
	    }finally {
	        $this->desconectarDb($pdo);
	    }
	    return $insert;
	}
}

?>
