<?php
class DB{
	protected static $table;
	protected static $raw;
	protected static $field = '*';
	protected static $from;
	protected static $where = '';
	protected static $orderBy = '';
	protected static $limit;
	
	protected static $connectionStatus;
	protected static $pdo;
	protected static $paginateDetails;
	protected static $paginateTotal;
	
	const SINGLE_RESULT = '100';
	const MULTI_RESULT = '101';
	const SINGLE_SAVE_RESULT = '200';
	const SINGLE_UPDATE_RESULT = '300';
	
	public $query;
	public $error;
	public $total;
	public $paginate;
	public $data;
	
	public function __construct(){}
	
	#relation
	public static function __callStatic($name, $arguments)
	{
		$relationsData = static::$relationsData;
		if(array_key_exists($name, $relationsData)){
			if($relationsData[$name][0]==static::BELONGS_TO_MANY){
				self::$table = $relationsData[$name][2];
				$foreignTable =  self::getTableId($relationsData[$name][1]::$table);
				$primaryTable = self::getTableId(static::$table);
				self::$from = $primaryTable.', '.$foreignTable;
			}
			return new static;
		}
	}
	
	public static function synch($ids, $secondary_ids){
		$val = array();
		if(!is_array($ids)){
			$ids = array($ids);
		}
		if(!is_array($secondary_ids)){
			$secondary_ids = array($secondary_ids);
		}
		foreach($ids as $id){
			foreach($secondary_ids as $secondary_id){
				$val[] = '("'.$id.'", "'.$secondary_id.'")';
			}
		}
		echo 'insert into '.self::$table.' ('.self::$from.') values '.implode(', ', $val);
		self::refreshQuery();
	}
	
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
	
	public static function paginate($perPage = 3){
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
	
	#store
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
		
		self::executeQuery($saveQuery, DB::SINGLE_SAVE_RESULT);
		$id = self::openPdo()->lastInsertId();
		
		$response = self::from($tableName)->find($id);
		foreach($response as $id=>$var){
			$this->$id = $var;
		}
		
		return $this;
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
	public static function getColumnNames(){
		$tableName = self::getTableName();
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
			$where = self::$where;
			$orderBy = self::$orderBy;
			$limit = self::$limit;
			
			$query ='select '.$field.' from '.$table.' ';
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
				'mysql:host=127.0.0.1;dbname=system;charset = utf8',
				'root', 
				''
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
		return $db;
	}
}