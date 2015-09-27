<?php class SponsorModel extends _baseModel{
	public $table = "contents_sponsor";
	public $pk = 'sponsor_id';
	public $arrNoquote=array('is_aktif');
	function __construct(){
		parent::__construct();
	}
}
