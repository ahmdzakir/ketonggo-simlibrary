<?php class PageModel extends _baseModel{
	public $table = "contents_page";
	public $pk = 'page_id';
	public $arrNoquote=array();
	function __construct(){
		parent::__construct();
	}

	function getMenuInfo($halaman){
		$data = $this->getRow("select * from contents_page_halaman where halaman = '$halaman'");
		return $data;
	}

	function getByHalaman($halaman){
		$data = $this->getRow("select a.*, b.name as created_name 
		from ".$this->table." a
		left join public_sys_user b on a.created_by = b.user_id
		where halaman = '$halaman'");
		return $data;
	}

	public function SelectGrid($arr_param=array(), $str_field="a.*")
	{
		$arr_return = array();
		$arr_params = array(
			'page' => 1,
			'limit' => 50,
			'order' => '',
			'filter' => ''
		);
		foreach($arr_param as $key=>$val){
			$arr_params[$key]=$val;
		}

		$str_condition = "";
		$str_order = "";
		if(!empty($arr_params['filter']))
		{
			$str_condition = "where ".$arr_params['filter'];
		}
		if(!empty($arr_params['order']))
		{
			$str_order = "order by ".$arr_params['order'];
		}

		$arr_return['rows'] = $this->conn->PageExecute("
			select 
			{$str_field}, b.name as created_name 
			from 
			".$this->table." a
			left join public_sys_user b on a.created_by = b.user_id
			{$str_condition} 
			{$str_order} ",$arr_params['limit'],$arr_params['page']
		)->GetArray();
		
		$arr_return['total'] = static::GetOne("
			select 
			count(*) as total 
			from 
			".$this->table."
			{$str_condition}
		");
		
		return $arr_return;
	}

	public function GetByPk($id=''){
		if(!$id){
			return array();
		}
		$sql = "select a.*, b.name as created_name from ".$this->table." a
		left join public_sys_user b on a.created_by = b.user_id 
		where {$this->pk} = '$id'";
		return $this->conn->GetRow($sql);
	}
}
