<?php
class Pageone extends _adminController{

	public function __construct(){
		parent::__construct();
		$this->init();
	}
	
	private function init(){
		$this->viewlist = "panelbackend/pageonelist";
		$this->viewdetail = "panelbackend/pageonedetail";
		$this->template = "panelbackend/main";
		$this->layout = "panelbackend/layout1";

		if ($this->mode == 'add' or $this->mode == 'edit') {
			$this->mode = 'oneedit';
			$this->data['page_title'] = 'Edit';
			$this->data['edited'] = true;	
		}else{
			$this->mode = 'onedetail';
			$this->data['page_title'] = 'Detail';
			$this->data['edited'] = false;	
		}

		$this->data['mode']=$this->mode;

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
		$this->_actionEdit($halaman);
	}


	function _actionAdd($halaman=''){

		$this->_actionEdit($halaman);
	}

	function _actionEdit($halaman='',$id=null){
		$this->_setHalaman($halaman);

		if($this->post['act']=='reset'){
			URL::Redirect();
		}

		$this->data['row'] = $this->model->GetByHalaman($halaman);
		$id = $this->data['row'][$this->pk];
		if (!$this->data['row'] && $id)
			$this->NoData();
		
		## EDIT HERE ##
		if ($this->post['act'] === 'save') {
			$record = array();
			$record['nama'] = $this->post['nama'];
			$record['isi'] = $this->post['isi'];
			$record['halaman'] = $halaman;

            $this->setLogRecord($record,$id);

			if ($id) {
				$return = $this->model->Update($record, "halaman = '$halaman'");
				if ($return) {
					$this->SetFlash('suc_msg', $return['success']);
					URL::Redirect("$this->page_ctrl/edit/$halaman");					
				}
				else {
					$this->data['row'] = $record;
					$this->data['err_msg'] = "Data gagal diubah";
				}
			}
			else {
				$return = $this->model->Insert($record);
				if ($return) {
					$this->SetFlash('suc_msg', $return['success']);
					URL::Redirect("$this->page_ctrl/edit/$halaman");					
				}
				else {
					$this->data['row'] = $record;
					$this->data['err_msg'] = "Data gagal disimpan";
				}
			}
		}
				
		$this->View($this->viewdetail);
	}

	function _actionDetail($halaman='', $id=null){		
		$this->_actionEdit($halaman);	
	}
}
