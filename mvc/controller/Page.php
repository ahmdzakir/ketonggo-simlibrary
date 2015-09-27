<?php
class Page extends _visitorController{

	public function __construct(){
		parent::__construct();
		$this->init();
	}
	
	private function init(){
		$this->viewlist = "pagelist";
		$this->viewdetail = "pagedetail";
		$this->template = "main";
		$this->layout = "layout1";

		$this->model = new PageModel();

		$this->pk = $this->model->pk;
		$this->data['pk'] = $this->pk;
	}

	function _setHalaman(&$halaman = ''){
		$title='';
		
		$halaman = $this->xss($halaman);

		$data = $this->model->getMenuInfo($halaman);

		if(!count($data)){
			$this->NoData();
		}

		$this->data['add_param'] = $halaman;
		$this->data['page_title'].= " ".$data['nama'];
	}

	function _actionIndex($halaman, $page=1){
		$this->_setHalaman($halaman);
		
		$filter = " halaman = '$halaman' ";

		$this->_setFilter($filter);

		$this->data['list']=$this->_getList($page);

		$this->data['page']=$page;

		$param_paging = array(
			'base_url'=>URL::Base("page/index/$halaman"),
			'cur_page'=>$page,
			'total_rows'=>$this->data['list']['total'],
			'per_page'=>$this->limit,
			'first_tag_open'=>'<li>',
			'first_tag_close'=>'</li>',
			'last_tag_open'=>'<li>',
			'last_tag_close'=>'</li>',
			'cur_tag_open'=>'<li class="selected"><span>',
			'cur_tag_close'=>'</span></li>',
			'next_tag_open'=>'<li>',
			'next_tag_close'=>'</li>',
			'prev_tag_open'=>'<li>',
			'prev_tag_close'=>'</li>',
			'num_tag_open'=>'<li>',
			'num_tag_close'=>'</li>'
			);
		$paging = new Pagination($param_paging);

		$this->data['paging']=$paging->create_links();

		$this->data['limit']=$this->limit;
		
		$this->data['limit_arr']=$this->limit_arr;

		$this->View($this->viewlist);
	}


	function _actionDetail($halaman, $id=null, $title=''){		
		$this->_setHalaman($halaman);

		$this->data['row'] = $this->model->GetByPk($id);
		if (!$this->data['row'])
			$this->NoData();
        
		$this->View($this->viewdetail);		
	}
}
