<?php

abstract class AbstractModel
	implements IModel
{
	protected static $table;
		
	protected $data = Array();
	
	public function __set($k, $v)
	{
		$this->data[$k] = $v;
	}
	
	public function __get($k)
	{
		return $this->data[$k];
	}
	
	public function __isset($k)
	{
		return isset($this->data[$k]);
	}
	
	public static function findAll()
	{
		$db = new DB();
		$class = get_called_class();
		$db->setClassName($class);
		$sql = 'SELECT * FROM ' . static::$table;
		return $db->queryToClass($sql);
	}
	
	public static function findLimitedAndOrderedByColumn($columns, $offset = 0, $count = 0) {
		$db = new DB();
		$db->setClassName(get_called_class());
		$order = Array();
		foreach ($columns as $column => $value){
			$order[] = $column . ' ' . $value;
		}
		$sql = 'SELECT * 
		  FROM ' . static::$table . ' 
		  ORDER BY ' . implode(', ', $order);
		if ($count == 0 AND $offset == 0) {
			# ищем все строки
		} else {
			# ищем только несколько строк
			$sql .= ' LIMIT ' . ((!empty($offset)) ? $offset . ', ': '') .  ((!empty($count)) ? $count : '');
		}
		$sql .= ';';
		$res = $db->queryToClass($sql);
		if (empty($res)) {
			throw new ModelException('Не найдено записей в таблице "' . static::$table . '".');
		}		
		return $res;		
	}

	public static function findAllOrderedByColumn($columns)
	{
		$res = static::findLimitedAndOrderedByColumn($columns);
		return $res;
	}
		
	public static function findOneByPk($id)
	{
		$db = new DB();
		$class = get_called_class();
		$db->setClassName($class);
		$sql = 'SELECT * FROM ' . static::$table . ' WHERE id=:id';
		$res = $db->queryToClass($sql, Array(':id' => $id));
		if (empty($res)) {
			throw new ModelException('Не найдено значение "id" = "' . $id . '" в таблице "' . static::$table . '".');
		}
		return $res[0];
	}

	public static function findOneByColumnValue($column, $value)
	{
		$db = new DB(); 
		$db->setClassName(get_called_class());
		$sql = 'SELECT * FROM ' . static::$table . ' WHERE ' . $column . ' = :value';
		$res = $db->queryToClass($sql, Array(':value' => $value));
		if (empty($res)) {
			throw new ModelException('Не найдено значение "' . $value . '" в поле "' . $column . '" в таблице "' . static::$table . '".');
		}
		return $res[0];
	}

	public static function countByColumnValue($column, $value)
	{
		$db = new DB(); 
		$db->setClassName(get_called_class());
		$sql = 'SELECT count(id) FROM ' . static::$table . ' WHERE ' . $column . ' = :value';
		$res = $db->queryToArray($sql, Array(':value' => $value));
		if (empty($res)) {
			throw new ModelException('Не найдено количество строк с полем "' . $column . '" равным "' . $value . '"в таблице "' . static::$table . '".');
		}
		return $res[0]['count(id)'];
	}

	public static function countId()
	{
		$db = new DB(); 
		$db->setClassName(get_called_class());
		
		$sql = 'SELECT count(id) FROM ' . static::$table;
		$res = $db->queryToClass($sql);
		if (empty($res)) {
			throw new ModelException('Не найдено записей в таблице "' . static::$table . '".');
		}
		return $res[0];
	}

	protected function insert()
	{
		$db = new DB();
		$db->setClassName(get_called_class());
		$cols = array_keys($this->data);
		$data = Array();
		foreach ($cols as $col){
			$data[':' . $col] = $this->data[$col];
		}
		$sql = '
		  INSERT INTO ' . static::$table . '
		  (' . implode(', ', $cols) . ')
		  VALUES (' . implode(', ', array_keys($data)) . ')
		';
		
		$res = $db->execute($sql, $data);
		if ($res){
			$this->id = $db->lastInsertId();
		}
		return $res;
	}
	
	protected function update()
	{
		$db = new DB();
 		$db->setClassName(get_called_class());
		$cols = Array();
		$data = Array();
		foreach ($this->data as $k => $v){
			$data[':' . $k] = $v;
			if ($k == 'id') {
				continue;
			}
			$cols[] = $k . '=:' . $k;
		}
		$sql = '
		  UPDATE ' . static::$table . ' 
		  SET ' . implode(', ', $cols) . ' 
		  WHERE id = :id
		';
		$res = $db->execute($sql, $data);
		return $res;
	}

	public function save()
	{
		if (!isset($this->id)){
			$this->insert();
		} else {
			$this->update();
		}
	}
	
	public function delete()
	{
		$db = new DB();
		$sql = 'DELETE ' . static::$table . ' WHERE id=:id';
		return $db->queryToClass($sql, Array(':id' => $this->id));
	}

}
