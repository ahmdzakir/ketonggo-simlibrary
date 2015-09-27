<?php
class Pagedetail extends _visitorController{

	public function __construct(){
		parent::__construct();
		$this->init();
	}
	
	private function init(){
		$this->viewdetail = "pageonedetail";
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

	function _actionIndex($halaman=''){
		$this->_setHalaman($halaman);

		if($this->post['act']=='reset'){
			URL::Redirect();
		}

		$this->data['row'] = $this->model->GetByHalaman($halaman);
		$id = $this->data['row'][$this->pk];
		if (!$this->data['row'] && $id)
			$this->NoData();
				
		$this->View($this->viewdetail);
	}
}
