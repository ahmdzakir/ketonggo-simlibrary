<?php
class Jadwal extends _visitorController{

	public function __construct(){
		parent::__construct();
		$this->init();
	}
	
	private function init(){
		$this->viewlist = "jadwallist";
		$this->viewdetail = "jadwaldetail";
		$this->template = "main";
		$this->layout = "layout1";

		$this->data['page_title']='Jadwal Dokter';
		$this->model = new JadwalModel();
		$rows = $this->model->GetKategori();

		$listkategori=array(''=>'-pilih-');
		foreach($rows as $row){
			$listkategori[$row['jadwal_kategori_id']]=$row['nama'];
		}

		$this->data['listkategori'] = $listkategori;

		$this->pk = $this->model->pk;
		$this->data['pk'] = $this->pk;
		
		$filter = " is_aktif = '1' ";

		$this->_setFilter($filter);
	}

	function _actionIndex($page=1, $jadwal_kategori_id=0){
		$this->data['header']=array(
			array('name'=>'jadwal_kategori_id', 'label'=>'Spesialis', 'width'=>"300px", 'type'=>'list', 'value'=>$this->data['listkategori']),
			array('name'=>'nama', 'label'=>'Nama', 'width'=>"auto"),
		);

		if($jadwal_kategori_id){
			$this->post['act'] = 'list_search';
			$this->post['list_search'] = array('jadwal_kategori_id' => $jadwal_kategori_id);
		}

		$this->data['list']=$this->_getList($page);

		$this->data['page']=$page;

		$param_paging = array(
			'base_url'=>URL::Base("jadwal/index"),
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

	protected function _getList($page=1){
		$this->_resetList();
		
		$param=array(
			'page' => $page,
			'limit' => $this->_limit(),
			'order' => $this->_order(),
			'filter' => $this->_getFilter()
		);

		if($this->post['act']){
			URL::Redirect('jadwal');
		}

		$respon = $this->model->SelectGrid(
			$param
		);
		
		return $respon;
	}


	function _actionDetail($id=null, $title=''){		

		$this->data['row'] = $this->model->GetByPk($id);
		if (!$this->data['row'])
			$this->NoData();
		
		$this->View($this->viewdetail);		
	}
}
