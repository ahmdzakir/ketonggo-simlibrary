<?php class HeaderModel extends _baseModel{
	public $table = "contents_header";
	public $pk = 'header_id';
	public $arrNoquote=array('is_aktif');
	function __construct(){
		parent::__construct();
	}

	function getFront(){
		return $this->GetArray("
			select * 
			from {$this->table} 
			where is_aktif = 1
			order by created_date desc");
	}
}
