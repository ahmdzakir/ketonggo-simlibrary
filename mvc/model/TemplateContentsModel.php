<?php class TemplateContentsModel extends _baseModel{
	public $table = "contents_template_contents";
	public $pk = 'template_contents_id';

	function __construct(){
		parent::__construct();
	}

	function GetTemplate(){
		$sql = "select nama, template_contents_id from {$this->table}";
		return $this->conn->GetArray($sql);
	}
}
