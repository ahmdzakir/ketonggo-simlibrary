<?php class _adminController extends Controller{
	public $url = "";
	public $urlaccess = "";
	public $viewpath = "";
	public $auth;
	static $referer = false;
	static $private = true;
	static $role = false;
	public $pk;
	public $limit = 5;
	public $limit_arr = array('5','10','15');
	public $arrNoquote = array();
	protected $layout = "";
	protected $viewdetail = "";
	protected $viewlist = "";
	protected $filter = " 1=1 ";
	public function __construct()
	{
		parent::__construct();
		#$this->conn->debug = true;

		$this->auth = new AuthModel();

		$this->helper("Action");
		$this->helper("Shelper");

		$this->SetAccessRole();

		$this->InitAdmin();
	}

	function InitAdmin(){
		$template = new TemplateContentsModel();
		$this->data['tamplate'] = $template->GetTemplate();
	}

	protected function View($view='')
	{
		if(!empty($this->layout)){
			$this->data['content1']=$this->PartialView($view,true);
			parent::View($this->layout);
		}else{
			parent::View($view);
		}
	}
	// set access for url and action
	protected function SetAccessRole($action=""){
		// ceck referer from host or not
		if(
		static::$referer == true and
		str_replace('/','',str_replace('backend','',str_replace('index.php','',$_SERVER['HTTP_REFERER'])))
		<>
		str_replace('/','',str_replace('backend','',str_replace('index.php','',URL::Base())))
		)
		{
			
			$this->Error404();
			exit();
		}
		// set private area
		if(static::$private)
		{
			// ceck login
			if(!$_SESSION[SESSION_APP]['login']){
				URL::Redirect('panelbackend/login','client');
			}
			if(static::$role){
				// ceck access from database model authorization
				$rolechache = $this->auth->GetAccessRole($this->router->uri,$this->router->methode);
				if(!$rolechache)
				{
					$this->Error403();
					exit();
				}
			}
		}
	}


	protected function _getList($page=1){
		$this->_resetList();
		
		$this->arrNoquote = $this->model->arrNoquote;

		$param=array(
			'page' => $page,
			'limit' => $this->_limit(),
			'order' => $this->_order(),
			'filter' => $this->_getFilter()
		);


		if($this->post['act']){
			if($this->data['add_param']){
				$add_param = '/'.$this->data['add_param'];
			}
			URL::Redirect(str_replace("/index$add_param/$page", "/index{$add_param}", URL::FullUri()));
		}

		$respon = $this->model->SelectGrid(
			$param
		);
		
		return $respon;
	}

	protected function _resetList(){
		if($this->post['act']=='list_reset'){
			unset($_SESSION[SESSION_APP][$this->ctrl]['list_limit']);
			unset($_SESSION[SESSION_APP][$this->ctrl]['list_sort']);
			unset($_SESSION[SESSION_APP][$this->ctrl]['list_filter']);
			unset($_SESSION[SESSION_APP][$this->ctrl]['list_search']);
		}
	}

	protected function _limit(){
		if($this->post['act']=='list_limit' && $this->post['list_limit']){
			$_SESSION[SESSION_APP][$this->ctrl]['list_limit']=$this->post['list_limit'];
		}

		if($_SESSION[SESSION_APP][$this->ctrl]['list_limit']){
			$this->limit = $_SESSION[SESSION_APP][$this->ctrl]['list_limit'];
		}

		return $this->limit;
	}

	protected function _order(){

		if($this->post['act']=='list_sort' && $this->post['list_sort']){

			$_SESSION[SESSION_APP][$this->ctrl]['list_order']=$this->post['list_order'];
			$_SESSION[SESSION_APP][$this->ctrl]['list_sort']=$this->post['list_sort'];				
		}

		if($_SESSION[SESSION_APP][$this->ctrl]['list_sort']){
			$order = $_SESSION[SESSION_APP][$this->ctrl]['list_sort'];
		}

		if($_SESSION[SESSION_APP][$this->ctrl]['list_order'] && $order){
			$order .= ' '. $_SESSION[SESSION_APP][$this->ctrl]['list_order'];
		}

		$this->data['list_sort'] = $_SESSION[SESSION_APP][$this->ctrl]['list_sort'];
		$this->data['list_order'] = $_SESSION[SESSION_APP][$this->ctrl]['list_order'];

		replaceSingleQuote($order);

		if($order)
			return $order;

		return null;
	}

	protected function _setFilter($filter=''){
		if($filter){
			$this->filter .= ' and '. $filter;
		}
	}

	protected function _getFilter(){
		$this->xss_clean = true;

		$this->FilterRequest();

		$filter_arr = array();

		if($this->post['act']=='list_filter' && $this->post['list_filter']){
			if(!$_SESSION[SESSION_APP][$this->ctrl]['list_filter']){
				$_SESSION[SESSION_APP][$this->ctrl]['list_filter'] = $this->post['list_filter'];
			}else{
				$_SESSION[SESSION_APP][$this->ctrl]['list_filter'] = array_merge($_SESSION[SESSION_APP][$this->ctrl]['list_filter'],$this->post['list_filter']);

			}
		}

		if($_SESSION[SESSION_APP][$this->ctrl]['list_filter']){
			foreach ($_SESSION[SESSION_APP][$this->ctrl]['list_filter'] as $r){
				$key = $r['key'];
				$filter_arr1 = array();

				foreach($r['values'] as $k=>$v){
					replaceSingleQuote($v);
					if(!empty($v))
						$filter_arr1[] = 'a.'.$key ." = '$v'";
				}

				$filter_str = implode(' or ',$filter_arr1);

				if($filter_str){
					$filter_arr[]="($filter_str)";
				}
			}
		}	

		if($this->post['act']=='list_search' && $this->post['list_search']){
			if(!$_SESSION[SESSION_APP][$this->ctrl]['list_search']){
				$_SESSION[SESSION_APP][$this->ctrl]['list_search'] = $this->post['list_search'];
			}else{
				$_SESSION[SESSION_APP][$this->ctrl]['list_search'] = array_merge($_SESSION[SESSION_APP][$this->ctrl]['list_search'],$this->post['list_search']);

			}
		}

		if($_SESSION[SESSION_APP][$this->ctrl]['list_search']){
			foreach ($_SESSION[SESSION_APP][$this->ctrl]['list_search'] as $k=>$v){

				replaceSingleQuote($v);

				if(trim($v)!='' && in_array($k, $this->arrNoquote)){
					$filter_arr[]="$k=$v";
				}else if(!empty($v)){
					$filter_arr[]="lower($k) like '%$v%'";
				}
			}
		}	

		$this->data['filter_arr'] = $_SESSION[SESSION_APP][$this->ctrl]['list_search'];

		if(count($filter_arr)){
			$this->filter .= ' and '.implode(' and ', $filter_arr);
		}


		return $this->filter;
	}

	protected function setLogRecord(&$array,$is_update=true){
		$datenow = '{{'.$this->conn->sysTimeStamp.'}}';
		$user_id = $_SESSION[SESSION_APP]['user_id'];
		if(!$is_update){
			$array['created_date']=$datenow;
			$array['created_by']=$user_id;
		}
		$array['modified_date']=$datenow;
		$array['modified_by']=$user_id;
	}
	

	function GenerateTree($row, $colparent, $colid, $collabel, $valparent=null, &$return=array(), &$i=0, $level=0){
		$level++;
		foreach ($row as $key => $value) {
			# code...
			if($value[$colparent]==$valparent){
				unset($row[$key]);

				$space = '';
				for($k=1; $k<$level; $k++){
					$space .='---';
				}

				$value[$collabel] = $space.$value[$collabel];
				$return[$i]=$value;

				$i++;
				$this->GenerateTree($row, $colparent, $colid, $collabel, $value[$colid], $return, $i, $level);
			}
		}
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

	function _actionAdd(){
		$this->_actionEdit();
	}
}