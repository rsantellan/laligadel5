<?php 
	class Persistencia {
		
		public $queryType='SELECT';
		protected $query;
		protected $table;
		protected $columnas = array();
		protected $valores = array();
		protected $where = '';
		protected $orderBy = '';
                protected $groupBy = '';
                protected $limit = 'LIMIT';
                protected $limitStart = -1;
                protected $limitEnd = 0;

                public function addLimit($start, $end){
                    $this->limitStart = $start;
                    $this->limitEnd = $end;
                }

                public function addGroupBy($condicion){
                    $this->groupBy = $condicion;
                }
		public function addOrderBy($condicion){
			$this->orderBy = $condicion;
		}

		public function addWhere($condicion){
			if($this->where == ''){
				$this->where = $condicion;
			}else{
				$this->where.= " AND ".$condicion;
			}
		}
		public function __construct($queryType){
			$this->queryType = strtoupper($queryType);
		}
		
		
		public function setTable($tableName){
			$this->table = $tableName;
		}
		
		public function addColum($colName){
			$this->columnas[]=$colName;
		}
		
		public function addValue($valName){
			$this->valores[]=$valName;
		}
		
		public function returnValores(){
			return $this->valores;
		}
		
		public function doQuery($sqlString){
			try{
				$result = mysql_query($sqlString);			
				
			}catch (Exception $e){
				throw $e;
			}
			return $result;
		}
		
		public function viewData($result){
			if(empty($this->valores)){
				$cantCol = mysql_num_fields($result);
				while($row = mysql_fetch_array($result)){
					for($i=0;$i<$cantCol;$i++){
						$this->addValue($row[$i]);
					}
				}
			}else{
				echo "Los datos no se pueden guardar";
				echo "<br>";
			}

		}
		public function constructQuery(){
			$sqlString= " ";
			switch($this->queryType){
				 case "INSERT":
				 	if(count($this->columnas)!= count($this->valores))return; //echo "ERROR"; 
					$sqlString.="INSERT INTO $this->table";
					$sqlString.="(";
					$sqlString.=implode(",", $this->columnas);
					$sqlString.=") VALUES (";
					$sqlString.=implode(",", $this->valores);					
					$sqlString.=");";
				break;
				case "SELECT":
					$sqlString = "SELECT ";
					if(count($this->columnas) > 0){
						$sqlString.= implode(",", $this->columnas);
					}else{
						$sqlString.= "*";
					}
					$sqlString.= " FROM $this->table";
					if($this->where != ''){
						$sqlString.= " WHERE ".$this->where;
					}
                                        if($this->groupBy != ''){
                                            $sqlString.= " GROUP BY ".$this->groupBy;
                                        }
					if($this->orderBy != ''){
						$sqlString.= " ORDER BY ".$this->orderBy;
					}
                                        if($this->limitStart >= 0){
                                            $sqlString .= " LIMIT ".$this->limitStart." , ".$this->limitEnd;
                                        }
				break;
				case "UPDATE":
					if(count($this->columnas)!= count($this->valores))return; //echo "ERROR"; 
					$sqlString.="UPDATE $this->table SET ";
					for($i=0;$i<count($this->columnas);$i++){
						$sqlString.= $this->columnas[$i];
						$sqlString.= " = '";
						$sqlString.= $this->valores[$i];
						$sqlString.= "'";
						if($i < count($this->columnas)-1){
							$sqlString.=", ";
						}
					}
					//echo "<br>";
					//echo $where;
					//echo "<br>";
					$sqlString.= " WHERE $this->where";
					break;
				case "DELETE":
					if(count($this->columnas)!= count($this->valores))return; //echo "ERROR"; 
					$sqlString.="DELETE FROM $this->table";
					if($this->where != ''){
						$sqlString.= " WHERE ".$this->where;
					}
				break;
			}
			return $sqlString;				
		} 
		
	}
	
?>
