<?php
class Page extends _adminController{

	public function __construct(){
		parent::__construct();
		$this->init();
	}
	
	private function init(){
		$this->viewlist = "panelbackend/pagelist";
		$this->viewdetail = "panelbackend/pagedetail";
		$this->template = "panelbackend/main";
		$this->layout = "panelbackend/layout1";

		if ($this->mode == 'add') {
			$this->data['page_title'] = 'Tambah';
			$this->data['edited'] = true;
		}
		elseif ($this->mode == 'edit') {
			$this->data['page_title'] = 'Edit';
			$this->data['edited'] = true;	
		}
		elseif ($this->mode == 'detail'){
			$this->data['page_title'] = 'Detail';
			$this->data['edited'] = false;	
		}else{
			$this->data['page_title'] = 'Daftar';
		}

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


		$this->data['header']=array(
			array('name'=>'nama', 'label'=>'Judul', 'width'=>"auto"),
			array('name'=>'isi', 'label'=>'Isi', 'width'=>"auto")
		);
		
		$this->_setFilter(" halaman = '$halaman' ");

		$this->data['list']=$this->_getList($page);

		$this->data['page']=$page;

		$param_paging = array(
			'base_url'=>URL::Base("panelbackend/page/index/$halaman"),
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


	function _actionAdd($halaman){

		$this->_actionEdit($halaman);
	}

	function _actionEdit($halaman,$id=null){
		$this->_setHalaman($halaman);

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
			$record['halaman'] = $halaman;

            $this->setLogRecord($record,$id);

			if ($id) {
				$return = $this->model->Update($record, "$this->pk = $id");
				if ($return) {
					$this->SetFlash('suc_msg', $return['success']);
					URL::Redirect("$this->page_ctrl/edit/$halaman/$id");					
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
					URL::Redirect("$this->page_ctrl/edit/$halaman/".$return['data'][$this->pk]);					
				}
				else {
					$this->data['row'] = $record;
					$this->data['err_msg'] = "Data gagal disimpan";
				}
			}
		}
				
		$this->View($this->viewdetail);
	}

	function _actionDetail($halaman, $id=null){		
		$this->_setHalaman($halaman);

		$this->data['row'] = $this->model->GetByPk($id);
		if (!$this->data['row'])
			$this->NoData();
        
		$this->View($this->viewdetail);		
	}

	function _actionDelete($halaman, $id=null){
		$this->_setHalaman($halaman);

		$return = $this->model->delete("$this->pk = $id");
		if ($return) {
			$this->SetFlash('suc_msg', $return['success']);
			URL::Redirect("$this->page_ctrl/index/$halaman");
		}
		else {
			$this->SetFlash('err_msg',"Data gagal didelete");
			URL::Redirect("$this->page_ctrl/detail/$halaman/$id");		
		}

	}
}
