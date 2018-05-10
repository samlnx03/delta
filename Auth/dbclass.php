<?php
class db extends mysqli
{
    protected static $instance;
    protected static $options = array();
    private $resultSet;
    private $row;

    private $extra; //array para colocar campos extra en el result set (p.e. calculados)

    private function __construct() {
        $o = self::$options;

        // turn of error reporting
        mysqli_report(MYSQLI_REPORT_OFF);

        // connect to database
        @parent::__construct(isset($o['host'])   ? $o['host']   : 'localhost',
                             isset($o['user'])   ? $o['user']   : 'sperez',
                             isset($o['pass'])   ? $o['pass']   : 'sam',
                             isset($o['dbname']) ? $o['dbname'] : 'delta',
                             isset($o['port'])   ? $o['port']   : 3306,
                             isset($o['sock'])   ? $o['sock']   : false );

        // check if a connection established
        if( mysqli_connect_errno() ) {
            //throw new Exception(mysqli_connect_error(), mysqli_connect_errno()); 
	    echo "Error: ".mysqli_connect_error().", ". mysqli_connect_errno();
        }
    }

    public static function getInstance() {
        if( !self::$instance ) {
            self::$instance = new self(); 
        }
        return self::$instance;
    }

    public static function setOptions( array $opt ) {
        self::$options = array_merge(self::$options, $opt);
    }

    public function query($query, $resultmode=NULL) {
        if( !$this->real_query($query) ) {
            throw new exception( $this->error, $this->errno );
        }
	// http://php.net/manual/en/class.mysqli-result.php
        $result = new mysqli_result($this);
	$this->resultSet=$result;
        return $result;
    }

    public function insert_id(){ return $this->insert_id;}
    public function num_rows(){ return $this->resultSet->num_rows;}
    public function affected_rows(){ return $this->affected_rows;}

    public function prepare($query) {
        $stmt = new mysqli_stmt($this, $query);
        return $stmt;
    }

        public function next_row(){
                //$this->row=mysqli_fetch_array($this->resultSet);
		// genera con indice numerico y con nombre (doble!!)
                $this->row=mysqli_fetch_assoc($this->resultSet);
                return $this->row;
        }
        public function f($campo){
                return $this->row[$campo];
        }

	public function get_all(){
		$rows=array();
		while($row=$this->next_row()){
			/*
			if($extra){
				//extra=array(
				//"titulo1" => array("<a href='%href%'>%show%</a>",
				//			array("%refi%"=>"campo1", 
				//				"%show% => "campo2"
				//				)
				//		),
				//"titulo2" ...
				//); 
				foreach($extra as $coltit => $colval){
					$cadenaValor=$colval[0];
					foreach($colval[1] as $campo => $valor){
						str_replace($campo,$row[$valor],$cadenaValor);
					}
					$row[$coltit]=$cadenaValor;
				}
			}
			*/
			$rows[]=$row;
		}
		$this->resultSet->close();
		return $rows;
	}

    
}
?>
