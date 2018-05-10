<?php
class db extends mysqli
{
    protected static $instance;
    protected static $options = array();
    private $resultSet;
    private $row;

    private function __construct() {
        $o = self::$options;

        // turn of error reporting
        mysqli_report(MYSQLI_REPORT_OFF);

        // connect to database
        @parent::__construct(isset($o['host'])   ? $o['host']   : 'localhost',
                             isset($o['user'])   ? $o['user']   : 'a00u00',
                             isset($o['pass'])   ? $o['pass']   : 'ave00u00',
                             isset($o['dbname']) ? $o['dbname'] : 'ave00',
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

    public function query($query) {
        if( !$this->real_query($query) ) {
            throw new exception( $this->error, $this->errno );
        }

        $result = new mysqli_result($this);
	$this->resultSet=$result;
        return $result;
    }

    public function prepare($query) {
        $stmt = new mysqli_stmt($this, $query);
        return $stmt;
    }

        public function next_row(){
                $this->row=mysqli_fetch_array($this->resultSet);
                return $this->row;
        }
        public function f($campo){
                return $this->row[$campo];
        }

    
}
?>
