<?php class TestimoniModel extends _baseModel{
	public $table = "contents_testimoni";
	public $pk = 'testimoni_id';
	public $arrNoquote=array('is_approve');
	function __construct(){
		parent::__construct();
	}
}
