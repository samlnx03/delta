<?php
class html_table{
	private $bdydata; // body de la tabla
	private $t_clas="TFtable", $rh_clas="rh_clas", 
		$r0_clas, $r1_clas;
	private $r_id;  // id del renglon
	private $colsclass=array(); // clase de columnas INUTIL
	private $fieldClass=array(); // campo=>id_class, p.e. 'id'=>"class='myclas'", "precio"=>"id='price'"
	private $fieldTotalizado=array(); // para totalizar columnas: "precio"=>0, "costo"=1, ...
	private $colgroup; 	// def de clase por columna

	private $extras=array();  // columnas extras calculadas row by row desde datos del bdydata
	private $cdatas; // array de titulo de columnas y nombres de campos a mostrar
			 // incluye los titulos de las columnas extras

	public function addextras($a){$this->extras[]=$a;}
		//a=array("titulo1", "<a href=%f0%", array("field0","field1",...)),

	public function setbody($bdy){ $this->bdydata=$bdy;}
	public function setTclas($c){ $this->t_clas=$c;}
	public function setRHclas($c){ $this->rh_clas=$c;}
	public function setR0clas($c){ $this->r0_clas=$c;}
	public function setR1clas($c){ $this->r1_clas=$c;}
	public function setRid($c){ $this->r_id=$c;}
	public function setcdatas($a){ $this->cdatas=$a;}

	private function chkColsData(){ // column datas (title=>dbfield)
		if(!$this->cdatas){ // solo si no las define el usuario
			if($this->bdydata){
				$r1=$this->bdydata[0];
				//echo "dbydata[0]:<br>\n";
				//var_dump($r1);
				//echo "<br>\n";
				foreach($r1 as $t => $dumy)
					$this->cdatas[$t]=$t;
			} else return; // no data
		}
	}
	private function setAllColsclass(){
		// clases de columnas
		for($i=0; $i<count($this->cdatas); $i++){
			if(!isset($this->colsclass[$i]))
				$this->colsclass[$i]="<col />"; // ninguna por default
		}
		if(count($this->colsclass)>0){
			$this->colgroup="<colgroup>";
			for($i=0; $i<count($this->cdatas); $i++){
				$this->colgroup.=$this->colsclass[$i];
			}
			$this->colgroup.="</colgroup>";
		}
	}
	public function setColClas($i, $c){
		$this->colsclass[$i]=$c;  // 3,"<col class='miclass' />"
	}
	public function setFieldClas($field, $id_class){ //campo=>id_class, p.e. 'id'=>"class='myclas'"
		$this->fieldClass[$field]=$id_class;
	}
	public function setFieldTotalizado($field, $inicial){
				$this->fieldTotalizado[$field]=$inicial;
	}
	public function getFieldTotalizado($field){ return $this->fieldTotalizado[$field];}

	public function show(){
		// 2018-may-09
		if(count($this->bdydata)==0) return;
		// end 2018-may-09
		$this->chkColsData(); // define cada columna
		$this->setAllColsclass(); // y su clase css
		//var_dump($this->fieldClass);
		echo "<table class='$this->t_clas'>\n";
		if(isset($this->colgroup)) echo $this->colgroup."\n";
		$this->show_theader();
		$this->show_tbody();
		echo "</table>\n";
	}
	private function show_theader(){
		echo "<tr class='{$this->rh_clas}'>\n";
		foreach($this->cdatas as $title => $dummy)
			echo "<th>".$title."</th>\n";
		echo "</tr>\n";
	}
	private function row_open($i){
		if(isset($this->r0_clas) && isset($this->r1_clas)){
			$rr=$i%2;
			$c = $rr ? $this->r1_clas : $this->r0_clas;
			echo "<tr class='$c'>\n";
		}
		else
			echo "<tr>\n";
	}
	private function row_show($row){
		// array(
		//   array("titulo1", "<a href=%f0%", array("field0","field1",...)),
		//   array("titulo2", "<a href=%f0%", array("field0","field1",...)),
		// )
		// se reemplazara %f0% con field0, %f1% con field1 ,... del query
		
		foreach($this->extras as $col){
			// col= array("titulo1", "<a href=%f0%", array(f0,f1,f2...)),
			$titulo=$col[0];
			$html=$col[1];
			foreach($col[2] as $i => $dbfield){
				$html=str_replace("%f$i%", $row[$dbfield], $html);
			}
			$row[$titulo]=$html;
			// cdatas ya debe tener los titulos dados por el usuario
		}
		// checa si hay clase o id definida para esa columna
		foreach($this->cdatas as $t => $d){
			if(!isset($this->fieldClass[$t]))
				echo "<td>".$row[$d]."</td>\n";
			else
				echo "<td ".$this->fieldClass[$t].">".$row[$d]."</td>\n";
		}
		// totalizables
		foreach($this->fieldTotalizado as $f => $n){
			$this->fieldTotalizado[$f]+=$row[$f];
		}
	}
	private function show_tbody(){
		$i=0;
		foreach($this->bdydata as $row){
			$this->row_open($i);
			$this->row_show($row);
			echo "</tr>\n";
			$i++;
		}
	}
	
}
?>
