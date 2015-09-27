<?php class _baseModel extends Model{
	public $limit = 50;
	protected $ctrl;
	protected $page_ctrl;
	function __construct(){
		parent::__construct();

		global $router;
		$this->ctrl = $router->page;
		$this->page_ctrl = $router->uri;
	}

}
