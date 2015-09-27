<?php
class Home extends _visitorController{

	public $limit = 2;
	public function __construct(){
		parent::__construct();
		$this->template = "main";
		$this->layout = "layout1";

		$this->model = new PageModel();

		$this->pk = $this->model->pk;
		$this->data['pk'] = $this->pk;
	}
	function _actionIndex(){
		$this->data['statistik'] = $this->front->statistik();

		$this->_setFilter(" halaman = 'agendakami' ");
		$this->data['list_agenda']=$this->_getList();

		$this->_resetFilter();

		$this->_setFilter(" halaman = 'infokesehatan' ");
		$this->data['list_infokesehatan']=$this->_getList();

		$this->data['profil'] = $this->model->getByHalaman('profil');
		$this->data['visimisi'] = $this->model->getByHalaman('visimisi');
		$this->data['nilainilai'] = $this->model->getByHalaman('nilainilai');

		$header = new HeaderModel();
		$this->data['header'] = $header->getFront();

		$this->view("home");
	}
}
