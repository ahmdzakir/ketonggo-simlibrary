<?php class _visitorController extends Controller{
	protected $layout = "";
	public $front;
	public $pk;
	public $limit = 5;
	public $limit_arr = array('5','10','15');
	protected $viewdetail = "";
	protected $viewlist = "";
	protected $model_testimoni;
	protected $filter = " 1=1 ";
	public function __construct()
	{
		parent::__construct();

		#$this->conn->debug = true;

		$this->helper("Action");
		$this->helper("Shelper");

		$this->_pageIndex();
	}

	protected function _pageIndex(){

		$this->front = new FrontModel();
		if(!$_SESSION['ip_client']){
			$cek = $this->front->_updateStatistik();
			if($cek){
				$_SESSION['ip_client'] = $_SERVER["REMOTE_ADDR"];
			}
		}

		$this->data['list_sponsor']=$this->front->GetSponsor();
        $this->model_testimoni = new TestimoniModel();

        $list_testimoni = $this->model_testimoni->SelectGrid(array('order'=>'modified_date desc','filter'=>"is_approve = '1'"));

        $this->data['list_testimoni'] = $list_testimoni['rows'];

		if($this->session->Get($this->ctrl.'row_testimoni')){
			$this->data['row_testimoni']=$this->session->GetFlash($this->ctrl.'row_testimoni');
		}

		if($this->post['act']=='save_testimoni'){
			$this->_saveTestimoni();
		}
	}

	protected function _saveTestimoni(){
		$record = array();
		$record['nama'] = $this->post['nama'];
		$record['no_telepon'] = $this->post['no_telepon'];
		$record['email'] = $this->post['email'];
		$record['isi'] = $this->post['isi'];
		
		$rules = array(
		   array(
				 'field'   => 'nama',
				 'label'   => 'Nama',
				 'rules'   => 'required'
			  ),
		   array(
				 'field'   => 'no_telepon',
				 'label'   => 'No. Telephone',
				 'rules'   => 'phone'
			  ),
		   array(
				 'field'   => 'email',
				 'label'   => 'Email',
				 'rules'   => 'email'
			  ),
		   array(
				 'field'   => 'isi',
				 'label'   => 'Testimonials',
				 'rules'   => 'required'
			  )
		);

		$validation = new FormValidation($rules);
		if ($validation->run() == FALSE)
		{
			$this->SetFlash('row_testimoni',  $record);
			$this->SetFlash('err_msg', $validation->GetError());	
			URL::Redirect();
		}

        $this->setLogRecord($record,$id);
        $record['is_approve'] = 0;

		$return = $this->model_testimoni->Insert($record);
		if ($return) {
			$this->SetFlash('suc_msg', "Terima kasih {$record['nama']} atas testimoni yang Anda berikan.");				
		} else {
			$this->SetFlash('row_testimoni',  $record);
			$this->SetFlash('err_msg', "Maaf {$record['nama']}, testimoni Anda gagal disimpan.");	
		}
		URL::Redirect();	
	}

	protected function view($view='')
	{
		if(!empty($this->layout)){
			$this->data['content1']=$this->PartialView($view,true);
			parent::View($this->layout);
		}else{
			parent::View($view);
		}
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

	protected function _resetFilter(){
		$this->filter = '1=1';
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


		if($this->post['act']=='search'){
			$_SESSION[SESSION_APP][$this->ctrl]['keyword'] = $this->post['keyword'];
		}

		if($_SESSION[SESSION_APP][$this->ctrl]['keyword']){
			$this->data['keyword'] = $keyword = strtolower($_SESSION[SESSION_APP][$this->ctrl]['keyword']);
			replaceSingleQuote($keyword);
			$filter_arr[]=" (lower(nama) like '%{$keyword}%' or lower(isi) like '%{$keyword}%')";
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
				if(!empty($v))
					$filter_arr[]="lower($k) like '%$v%'";
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


	public function FlashMsg(){
		if($this->session->Get($this->ctrl.'suc_msg')){
			$this->data['suc_msg']=$this->session->GetFlash($this->ctrl.'suc_msg');
		}
		if($this->session->Get($this->ctrl.'inf_msg')){
			$this->data['inf_msg']=$this->session->GetFlash($this->ctrl.'inf_msg');
		}
		if($this->session->Get($this->ctrl.'wrn_msg')){
			$this->data['wrn_msg']=$this->session->GetFlash($this->ctrl.'wrn_msg');
		}
		if($this->session->Get($this->ctrl.'err_msg')){
			$this->data['err_msg']=$this->session->GetFlash($this->ctrl.'err_msg');
		}

		if($this->data['suc_msg']){
			echo '<div class="modal fade" id="main-modal" tabindex="-1" role="dialog" aria-hidden="true">
			<div class="modal-dialog modal-lg">
			<div class="modal-content" style="border-radius:0px">
			<div class="modal-body">';
			echo '
			<div class="alert alert-success" role="alert" style="margin:0px">
			<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span></button>
			'.$this->data['suc_msg'].'
			</div>
			</div>
			</div>
			</div>
			</div>';
			echo "
			<script type='text/javascript'>
			jQuery(function(){
			jQuery('#main-modal').modal('show');
			});
			</script>";
		}
		if($this->data['inf_msg']){
			echo '<div class="modal fade" id="main-modal" tabindex="-1" role="dialog" aria-hidden="true">
			<div class="modal-dialog modal-lg">
			<div class="modal-content" style="border-radius:0px">
			<div class="modal-body">';
			echo '
			<div class="alert alert-info" role="alert" style="margin:0px">
			<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span></button>
			'.$this->data['inf_msg'].'
			</div>
			</div>
			</div>
			</div>
			</div>';
			echo "
			<script type='text/javascript'>
			jQuery(function(){
			jQuery('#main-modal').modal('show');
			});
			</script>";
		}
		if($this->data['wrn_msg']){
			echo '<div class="modal fade" id="main-modal" tabindex="-1" role="dialog" aria-hidden="true">
			<div class="modal-dialog modal-lg">
			<div class="modal-content" style="border-radius:0px">
			<div class="modal-body">';
			echo '
			<div class="alert alert-warning" role="alert" style="margin:0px" style="margin:0px">
			<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span></button>
			'.$this->data['wrn_msg'].'
			</div>
			</div>
			</div>
			</div>
			</div>';
			echo "
			<script type='text/javascript'>
			jQuery(function(){
			jQuery('#main-modal').modal('show');
			});
			</script>";
		}

		if($this->data['err_msg']){
			echo '<div class="modal fade" id="main-modal" tabindex="-1" role="dialog" aria-hidden="true">
			<div class="modal-dialog modal-lg">
			<div class="modal-content" style="border-radius:0px">
			<div class="modal-body">';
			echo '
			<div class="alert alert-danger" role="alert" style="margin:0px">
			<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span></button>
			'.$this->data['err_msg'].'
			</div>
			</div>
			</div>
			</div>
			</div>';
			echo "
			<script type='text/javascript'>
			jQuery(function(){
			jQuery('#main-modal').modal('show');
			});
			</script>";
		}
	}

	public function NoData($str='Data tidak ditemukan.'){
		$this->data['error_str']=$str;
		$this->view("error404");
		exit();
	}

	public function Error404($str=''){
		$this->data['error_str']=$str;
		$this->view("error404");
		exit();
	}

	public function Error403($str=''){
		echo "<h2 align='center' style='margin-top:20%;color:#444'>ERROR 403</br>ACCESS DENIED</h2>$str";
		exit();
	}
}
?>
