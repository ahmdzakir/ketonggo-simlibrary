<?php
class TemplateContents extends _adminController{

	public function __construct(){
		parent::__construct();
		$this->init();
	}
	
	private function init(){
		$this->viewlist = "panelbackend/templatecontentslist";
		$this->viewdetail = "panelbackend/templatecontentsdetail";
		$this->template = "panelbackend/main";
		$this->layout = "panelbackend/layout1";

		if ($this->mode == 'add') {
			$this->data['page_title'] = 'Tambah Template Contents';
			$this->data['edited'] = true;
		}
		elseif ($this->mode == 'edit') {
			$this->data['page_title'] = 'Edit Template Contents';
			$this->data['edited'] = true;	
		}
		elseif ($this->mode == 'detail'){
			$this->data['page_title'] = 'Detail Template Contents';
			$this->data['edited'] = false;	
		}else{
			$this->data['page_title'] = 'Daftar Template Contents';
		}

		$this->model = new TemplateContentsModel();

		$this->pk = $this->model->pk;
		$this->data['pk'] = $this->pk;

	}

	function _actionIndex( $page=1){
		$this->data['header']=array(
			array('name'=>'nama', 'label'=>'Nama', 'width'=>"auto"),
			array('name'=>'isi', 'label'=>'Isi', 'width'=>"auto"),
		);

		$this->data['list']=$this->_getList($page);

		$this->data['page']=$page;

		$param_paging = array(
			'base_url'=>URL::Base("panelbackend/tamplate_contents/index"),
			'cur_page'=>$page,
			'total_rows'=>$this->data['list']['total'],
			'per_page'=>$this->limit
		);
		$paging = new Pagination($param_paging);

		$this->data['paging']=$paging->create_links();

		$this->data['limit']=$this->limit;
		
		$this->data['limit_arr']=$this->limit_arr;

		$this->View($this->viewlist);
	}


	function _actionAdd(){
		$this->_actionEdit();
	}

	function _actionEdit($id=null){

		if($this->post['act']=='reset'){
			URL::Redirect();
		}

		$this->data['row'] = $this->model->GetByPk($id);
		if (!$this->data['row'] && $id)
			$this->NoData();
		
		## EDIT HERE ##
		if ($this->post['act'] === 'save') {
			$record = array();
			$record['nama'] = $this->post['nama'];
			$record['isi'] = $this->post['isi'];

            $this->setLogRecord($record,$id);

			if ($id) {
				$return = $this->model->Update($record, "$this->pk = $id");
				if ($return) {
					$this->SetFlash('suc_msg', $return['success']);
					URL::Redirect("$this->page_ctrl/edit/$id");					
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
					URL::Redirect("$this->page_ctrl/edit/".$return['data'][$this->pk]);					
				}
				else {
					$this->data['row'] = $record;
					$this->data['err_msg'] = "Data gagal disimpan";
				}
			}
		}
				
		$this->View($this->viewdetail);
	}

	function _actionDetail( $id=null){		
		$this->data['row'] = $this->model->GetByPk($id);
		if (!$this->data['row'])
			$this->NoData();
        
		$this->View($this->viewdetail);		
	}

	function _actionDelete( $id=null){
		$return = $this->model->delete("$this->pk = $id");
		if ($return) {
			$this->SetFlash('suc_msg', $return['success']);
			URL::Redirect("$this->page_ctrl");
		}
		else {
			$this->SetFlash('err_msg',"Data gagal didelete");
			URL::Redirect("$this->page_ctrl/detail/$id");		
		}

	}

	function _actionTemplate($id=0){
		$data = $this->model->GetByPk($id);
		echo $data['isi'];
	}
}
