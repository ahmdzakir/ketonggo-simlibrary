<?php class AuthModel extends Model{
	function __construct(){
		parent::__construct();
	}
	public function Login($username="", $password="")
	{
		$username = $this->conn->qstr($username);
		$password = $this->conn->qstr(sha1(md5($password)));
		$data = $this->GetRow("
		select * from public_sys_user
		where username=$username and password=$password
		and is_active = '1'
		");
		
		if($data)
		{
			$data['login']=true;
			unset($data['password']);

			foreach($data as $k=>$v){
				$_SESSION[SESSION_APP][$k]=$v;
			}
			$datenow = $this->conn->sysTimeStamp;
			$this->conn->Execute("
			update public_sys_user
			set last_ip = '{$_SERVER['REMOTE_ADDR']}', last_login = $datenow
			where username = '{$data['username']}'");
			return array('success'=>'login success');
		}
		return array('error'=>'login filed');
	}

	public function GetMenu($parent_id=null,$ul="<ul class=\"easyui-tree\" data-options=\"animate:true\" id=\"menubar\">"){

		$group_id = $_SESSION[SESSION_APP]['group_id'];
		$user_id = $_SESSION[SESSION_APP]['user_id'];
		$filter = ($parent_id==null)?'b."parent_id" is null':'b."parent_id" = '.$parent_id;
		if($user_id == 1)
		{
			$strSQL = " SELECT b.*
						FROM public_sys_menu b
						WHERE visible = '1' and $filter
						ORDER BY b.sort";
		}else{
			$filter .= " and a.group_id =".$group_id;
			$strSQL = "	SELECT b.*
						FROM public_sys_group_menu a
						LEFT JOIN public_sys_menu b ON a.menu_id = b.menu_id
						WHERE b.visible = '1' and $filter
						ORDER BY b.sort";
		}
		$data = $this->GetArray($strSQL);
		if($data)
		{
			echo"$ul";
			foreach($data as $row){
				$options=array();
				foreach($row as $key=>$val){
					$key = ($key=='parent_id')?'_parentId':$key;
					$key = ($key=='iconcls')?'iconCls':$key;
					$val = trim($val);
					$row[$key]=$val;
					if(!empty($val) and $key!='label' and $key!='menu_id' and $key!='_parentId'){
						if($key=="url"){
							$val = trim($val,'/');
							$val .= "/index";
						}
						$options[]="$key:'$val'";
					}
				}
				$options="data-options=\"".implode(",",$options)."\"";
				echo "<li $options>";
					echo "<span>$row[label]</span>";
					$this->GetMenu($row['menu_id'],"<ul>");
				echo "</li>";
			}
			echo"</ul>";
		}
	}

	public function GetAction($url, $type){
		$group_id = $_SESSION[SESSION_APP]['group_id'];
		$user_id = $_SESSION[SESSION_APP]['user_id'];
		if($user_id == 1){
			$strSQL = "
				SELECT b.name
				from public_sys_action b
				LEFT JOIN public_sys_menu d ON b.menu_id=d.menu_id
				WHERE type = '$type' and b.visible = '1' AND d.url='$url'";
		}else{
			$strSQL = "
				SELECT b.name
				FROM public_sys_group_action a
				LEFT JOIN public_sys_action b ON a.action_id=b.action_id
				LEFT JOIN public_sys_group_menu c ON a.group_menu_id=c.group_menu_id
				LEFT JOIN public_sys_menu d ON c.menu_id=d.menu_id
				WHERE type = '$type'  and b.visible = '1' AND c.group_id = $group_id AND d.url='$url'";
		}
		
		$respons = $this->GetArray($strSQL);
		$respon = array();
		foreach($respons as $row)
		{
			$respon[]=$row['name'];
		}
		return $respon;
	}

	public function GetAccessRole($url="",$action=""){
		$group_id = $_SESSION[SESSION_APP]['group_id'];
		$user_id = $_SESSION[SESSION_APP]['user_id'];
		if($user_id == 1){
			return true;
		}
		$return = false;
		$action = strtolower(str_replace("_action","",$action));
		if($action == 'index'){
			$filter_action = '';
		}else{
			$filter_action = " AND b.name='$action'";
		}
		if(preg_match("/index/",$action)) $filter_action = "";
		$sql = "
			SELECT count(*)
			FROM public_sys_group_action a
			LEFT JOIN public_sys_action b ON a.action_id=b.action_id
			LEFT JOIN public_sys_group_menu c ON a.group_menu_id=c.group_menu_id
			LEFT JOIN public_sys_menu d ON c.menu_id=d.menu_id
			WHERE c.group_id = '$group_id' AND d.url='$url' $filter_action";
		$return = $this->GetOne($sql);
		return (bool)$return;
	}

	public function GetMenuCms($parent=false){
		if(!$parent){
			$param = "where parent_halaman is null";
		}else{
			$param = "where parent_halaman = '$parent'";
		}
		$data = $this->GetArray("select * from contents_page_halaman $param order by urutan");

		if($data){
			foreach ($data as $key => $value) {
				# code...
				switch($value['jenis']){
					case 1:
						echo "<li class=\"dropdown-header\">{$value['nama']}</li>";
					break;
					case 2:
						echo "<li><a href=\"".URL::Base("panelbackend/pageone/index/{$value['halaman']}")."\">{$value['nama']}</a></li>";
					break;
					case 3:
						echo "<li><a href=\"".URL::Base("panelbackend/page/index/{$value['halaman']}")."\">{$value['nama']}</a></li>";
					break;
					case 4:
						echo "<li><a href=\"".URL::Base("panelbackend/{$value['halaman']}")."\">{$value['nama']}</a></li>";
					break;
				}

				$this->GetMenuCms($value['halaman']);

			}
			echo "<li class=\"divider\"></li>";
		}
	}

	public function statistikVisitor($limit=30){
		$sql = "select * from (select * 
		from contents_statistik_pengunjung 
		order by tanggal desc limit $limit) a order by tanggal asc";
		$rows = $this->conn->GetArray($sql);

		$data = array();
		$ticks = array();
		foreach ($rows as $key => $value) {
			# code...
			$data[]=array($key, $value['jumlah']);
			$ticks[]=array($key, Eng2Ind($value['tanggal']));
		}

		$ret['data'] = json_encode($data);
		$ret['ticks'] = json_encode($ticks);
		return $ret;
	}

}
