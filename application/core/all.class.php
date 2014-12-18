<?php 

// diky extends mohu pouzivat metody db - jako DBSelect ...
class all extends db
{
	// konstruktor
	public function all($connection)
	{
		// timto si nastavim pripojeni k DB, ktere jsem dostal od app()
		$this->connection = $connection;	
	}
	
	
	public function Insert($name, $array)
	{
		$this->DBInsertExpanded($name, $array);
	}
	
	
	public function DeleteByID($table_name, $id)
	{
		$this->DBDelete($table_name, $id);
	}
    
    public function DeleteRByID($table_name, $id_pokoj, $id_datum)
	{
		$this->DBDeleteR($table_name, $id_pokoj, $id_datum);
	}
	
    public function UpdateDB($table_name, $items, $id){
        $this->DBUpdate($table_name, $items, $id);
    }
	
	public function GetByID($name, $array)
	{
		$table_name = $name;
		$select_columns_string = "id_datum"; 
		$where_array = $array;
		$limit_string = "";
	
		// vrati pole zaznamu v podobe asociativniho pole: sloupec = hodnota
		$full = $this->DBSelectOne($table_name, $select_columns_string, $where_array, $limit_string);
		
		// tady jeste neco pripadne dochroupat - docist vsechna potrebna data
		
		// vratit data
		return $full;
	}
	
	
	public function LoadAll($name)
	{
		$table_name = $name;
		$select_columns_string = "*"; 
		$where_array = array();
		$limit_string = "";
		$order_by_array = array();
	
		// vrati pole zaznamu v podobe asociativniho pole: sloupec = hodnota
		$full = $this->DBSelectAll($table_name, $select_columns_string, $where_array, $limit_string, $order_by_array);
		//printr($predmety);
		
		// tady jeste neco pripadne dochroupat - docist vsechna potrebna data
		
		// vratit data
		return $full;
	}
}


?>