<?php
class DB{
	const BELONGS_TO = 1;
	const BELONGS_TO_MANY = 2;
	
	protected static $table;
	protected static $raw;
	protected static $field = '*';
	protected static $from;
	protected static $where = '';
	protected static $orderBy = '';
	protected static $limit;
	
	protected static $primaryTable;
	protected static $foreignTable;
	protected static $primaryTableId;
	protected static $foreignTableId;
	
	protected static $connectionStatus;
	protected static $pdo;
	protected static $paginateDetails;
	protected static $paginateTotal;
	
	const SINGLE_RESULT = '100';
	const MULTI_RESULT = '101';
	const SINGLE_SAVE_RESULT = '200';
	const SINGLE_UPDATE_RESULT = '300';
	const SINGLE_ATTACH_RESULT = '400';
	const SINGLE_DETACH_RESULT = '500';
	const SINGLE_SYNCH_RESULT = '600';
	
	public $query;
	public $error;
	public $total;
	public $paginate;
	public $data;
	
	public function __construct(){}
	
	
	
	#grabber
	public static function get(){
		$query = self::getQuery();
		$response = self::executeQuery($query);
		return $response;
	}
	
	public static function find($id){
		self::where('id', '=', $id);
		$query = self::getQuery();
		$response = self::executeQuery($query, DB::SINGLE_RESULT);
		return $response;
	}
	
	public static function first(){
		self::limit('0', '1');
		$query = self::getQuery();
		$response = self::executeQuery($query, DB::SINGLE_RESULT);
		return $response;
	}
	
	public static function paginate($perPage = 15){
		$query = self::getQuery();
		
		$total = 0;
		if($row = self::openPdo()->query($query)){
			$total = $row->rowCount();
		}
		
		$lastPage =  ceil($total/$perPage);
		$currentPage = isset($_GET['page']) ? intval($_GET['page']) : 1;
		
		$start = ($perPage*($currentPage-1));
		self::limit($start, $perPage);
		$query = self::getQuery();
		
		self::$paginateTotal = $total;
		self::$paginateDetails = array(
			'perPage' => $perPage,
			'currentPage' => $currentPage,
			'lastPage' => $lastPage,
			'from' => $start,
			'to' => $start+$perPage,
		);
		
		$response = self::executeQuery($query);
		return $response;
	}
	
	#save
	public function save(){
		$db = new $this;
		
		$tableName = self::getTableName();
		$columnNames = self::getColumnNames();
		
		
		$columns = array();
		$values = array();
		foreach($columnNames as $columnName){
			if(isset($this->$columnName)){
				$columns[] = $columnName;
				$values[] = $this->$columnName;
			}elseif(isset($_POST[$columnName])){
				$columns[] = $columnName;
				$values[] = $_POST[$columnName];
			}
		}
		
		$columnQuery = '`'.(implode('`,`', $columns)).'`';
		$valueQuery = '"'.(implode('","', $values)).'"';
		$saveQuery = 'insert into '.$tableName.'('.$columnQuery.') values ('.$valueQuery.')';
		
		$db = self::executeQuery($saveQuery, DB::SINGLE_SAVE_RESULT);
		$id = self::openPdo()->lastInsertId();
		
		if($id>0){
			$response = self::from($tableName)->find($id);
			foreach($response as $id=>$var){
				$this->$id = $var;
			}
			$response = $this;
		}else{
			$response = $db;
		}
		
		return $response;
	}
	
	
	#relation
	public static function __callStatic($name, $arguments)
	{
		$relationsData = static::$relationsData;
		if(array_key_exists($name, $relationsData)){
			if($relationsData[$name][0]==static::BELONGS_TO){
				self::$table = $relationsData[$name][1];
				//self::$foreignTable =  self::getTableId($relationsData[$name][1]::$table);
				//self::$primaryTable = self::getTableId(static::$table);
				//self::$from = self::$primaryTable.', '.self::$foreignTable;
			}
			if($relationsData[$name][0]==static::BELONGS_TO_MANY){
				self::$table = self::$from = $relationsData[$name][2];
				self::$primaryTable = static::$table;
				self::$foreignTable =  $relationsData[$name][1]::$table;
				
				if(isset($relationsData[$name]['foreign_table'])){
					self::$foreignTable = $relationsData[$name]['foreign_table'];
				}
				
				self::$primaryTableId = self::getTableId(self::$primaryTable);
				self::$foreignTableId =  self::getTableId(self::$foreignTable);
				self::$field = self::$primaryTableId.', '.self::$foreignTableId;
				
			}
			return new static;
		}
	}
	
	#Relational db
	public static function attach($ids, $secondary_ids){
		$response = self::executeRelationalQuery($ids, $secondary_ids, DB::SINGLE_ATTACH_RESULT);
		return $response;
	}
	public static function detach($ids, $secondary_ids){
		$response = self::executeRelationalQuery($ids, $secondary_ids, DB::SINGLE_DETACH_RESULT);
		return $response;
	}
	public static function synch($ids, $secondary_ids){
		$response = self::executeRelationalQuery($ids, $secondary_ids, DB::SINGLE_SYNCH_RESULT);
		return $response;
	}
	public static function executeRelationalQuery($ids, $secondary_ids, $row_result_type){
		$values = array();
		$deleteWheres = array();
		$deleteOrWheres = array();
		if(!is_array($ids)){
			$ids = array($ids);
		}
		if(!is_array($secondary_ids)){
			$secondary_ids = array($secondary_ids);
		}
		foreach($ids as $id){
			foreach($secondary_ids as $secondary_id){
				$values[] = '("'.$id.'", "'.$secondary_id.'")';
				$deleteWheres[] = '(`'.self::$primaryTableId.'` = "'.$id.'" and `'.self::$foreignTableId.'` = "'.$secondary_id.'")';
				$deleteOrWheres[] = '(`'.self::$primaryTableId.'` = "'.$id.'")';
			}
		}
		
		$deleteOrWhere = implode(' or ', $deleteOrWheres);
		$deleteOrWhere = '
			DELETE FROM
				`'.self::$table.'`
			WHERE 
				'.$deleteOrWhere.';
		';
		
		$deleteWhere = implode(' or ', $deleteWheres);
		$deleteQuery = '
			DELETE FROM
				`'.self::$table.'`
			WHERE 
				'.$deleteWhere.';
		';
		
		$inserQuery = '
			INSERT INTO
				`'.self::$table.'` ('.self::$field.')
			VALUES
				'.implode(', ', $values).';
			';
			
		if($row_result_type == DB::SINGLE_ATTACH_RESULT){
			$relationalQuery = $inserQuery;
		}elseif($row_result_type == DB::SINGLE_DETACH_RESULT){
			$relationalQuery = $deleteQuery;
		}elseif($row_result_type == DB::SINGLE_SYNCH_RESULT){
			$relationalQuery = $deleteOrWhere.' '.$inserQuery;
		}
		
		$db = self::executeQuery($relationalQuery, $row_result_type);
		self::refreshQuery();
		
		return $db;
	}
	
	#query
	public static function raw($query){
		self::$raw = $query;
		return new static;
	}
	public static function select(){
		self::$field = '';
		$arguments = func_get_args();
		foreach($arguments as $argument){
			self::$field .= '`'.$argument.'`, ';
		}
		self::$field = trim(self::$field, ', ');
		return new static;
	}
	public static function from($tableName){
		self::$from = $tableName;
		return new static;
	}
	public static function where($field, $operator, $value, $callback = null){
		$field = '`'.$field.'`';
		if(is_callable($callback)){
			$field = "(".$field;
		}
		self::$where .= 'and '.$field.' '.$operator.' "'.$value.'" ';
		if(is_callable($callback)){
			$callback(new static);
			self::$where .= ") ";
		}
		self::$where = trim(self::$where, 'and');
		return new static;
	}
	public static function orWhere($field, $operator, $value){
		self::$where .= "or `".$field."` ".$operator.' "'.$value.'" ';
		self::$where = trim(self::$where, 'or');
		return new static;
	}
	public static function limit($start, $length = null){
		self::$limit = $start.' ';
		if($length != null){
			self::$limit .= ', '.$length.' ';
		}
		return new static;
	}
	
	#get
	public static function getTableName(){
		$tableName = get_called_class();
		if(self::$from != null){
			$tableName = self::$from;
		}elseif(static::$table != null){
			$tableName = static::$table;
		}
		return $tableName;
	}
	public static function getTableId($table){
		$tableId = str_ireplace('s_id', '_id', $table.'_id');
		return $tableId;
	}
	public static function getColumnNames($tableName = null){
		if($tableName==null){
			$tableName = self::getTableName();
		}
		$pdo = self::openPdo()->prepare('DESCRIBE `'.$tableName.'`');
		if($pdo->execute()){
			if($fetch = $pdo->fetchAll(PDO::FETCH_COLUMN)){
				return $fetch;
			}
		}
	}
	public static function getQuery(){
		if(self::$raw==null){
			$field = self::$field;
			$table = self::getTableName();
			$foreignTable = self::$foreignTable;
			$where = self::$where;
			$orderBy = self::$orderBy;
			$limit = self::$limit;
			
			$query ='select '.$field.' from '.$table.' ';
			
			if($foreignTable!=null){
				$primaryTable = self::$primaryTable;
				$primaryTableId = self::$primaryTableId;
				$query ='
					SELECT '.$primaryTable.'.*
					FROM '.$primaryTable.'
					LEFT JOIN '.$table.'
					ON '.$primaryTable.'.id = '.$table.'.'.$primaryTableId.'
				'; 
			}
			
			
			if($where!=''){
				$query .='where '.$where.' ';
			}
			if($orderBy!=''){
				$query .='order by '.$orderBy.' ';
			}
			if($limit!=''){
				$query .='limit '.$limit.' ';
			}
		}else{
			$query = self::$raw;
		}
		
		return $query;
	}
	
	#refresh
	public static function refreshQuery(){
		self::$table = null;
		self::$raw = null;
		self::$field = '*';
		self::$from = null;
		self::$where = '';
		self::$orderBy = '';
		self::$limit = null;
		self::$paginateDetails = null;
		self::$paginateTotal = null;
		
		self::$primaryTable = null;
		self::$foreignTable = null;
		self::$primaryTableId = null;
		self::$foreignTableId = null;
	}
	public static function refreshObject($db){
		$db->query = null;
		$db->error = null;
		$db->total = null;
		$db->paginate = null;
		$db->data = null;
	}
	
	#db
	public static function beginTransaction(){
		self::openPdo()->beginTransaction();
	}
	public static function rollBack(){
		self::openPdo()->rollBack();
	}
	public static function commit(){
		self::openPdo()->commit();
	}
	public static function openPdo(){
		if(self::$connectionStatus==null){
			$pdo = new PDO(
				Config::database('driver').':host='.Config::database('host').';dbname='.Config::database('database').';charset = utf8',
				Config::database('username'), 
				Config::database('password')
			);
			self::$pdo = $pdo;
			self::$connectionStatus = 1;
		}else{
			$pdo = self::$pdo;
		}
		return $pdo;
	}
	public static function executeQuery($query, $row_result_type = DB::MULTI_RESULT){
		$db = new self;
		$db->query = $query;
		
		$pdo = self::openPdo()->prepare($query);
		if(!$pdo->execute()){
			$errors = $pdo->errorInfo();
			$db->error = $errors[2];
		}
		
		$db->total = $pdo->rowCount();
		
		if($row_result_type == DB::MULTI_RESULT){
			if($fetch = $pdo->fetchAll(PDO::FETCH_ASSOC)){
				if(self::$paginateDetails!=null){
					$db->paginate = self::$paginateDetails;
					$db->total = self::$paginateTotal;
				}
				$db->data = $fetch;
			}
		}elseif($row_result_type == DB::SINGLE_RESULT){
			if($fetch = $pdo->fetch(PDO::FETCH_ASSOC)){
				$db->data = $fetch;
			}
		}
		
		self::refreshQuery();
		if(isset(static::$append) && ($row_result_type == DB::MULTI_RESULT)){
			$db = self::append($db, static::$append);
		};
		return $db;
	}
	public static function append($db, $callbacks){
		$results = $db->data;
		if($results!=null){
			if(!is_array($callbacks)){
				$callbacks = array($callbacks);
			}
			foreach($results as $index => $result){
				foreach($callbacks as $callback){
					$response[$callback] = call_user_func(array(get_called_class(), 'append_'.$callback), $result);
					$results[$index] = array_merge($result, $response);
				}
			}
			$db->data = $results;
		}
		return $db;
	}
}