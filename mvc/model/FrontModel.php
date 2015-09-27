<?php
class FrontModel extends Model{
	function __construct(){
		parent::__construct();
	}

	public function GetMenu($parent=false, $level=0, &$active=''){
		$level++;
		if(!$parent){
			$param = "where parent_halaman is null";
		}else{
			$param = "where parent_halaman = '$parent'";
		}
		$data = $this->GetArray("select * from contents_page_halaman $param order by urutan");

		if($data){
			$curr = trim($_SERVER['PATH_INFO'],'/');
			if($level==1){
				if(!$curr){
					//$active = 'current-menu-ancestor';
				}else{
					$active = '';
				}
				echo '<ul id="menu-main-menu" class="sf-menu header_right">';
				echo '<li class="'.$active.' menu-item menu-item-type-post_type menu-item-object-page menu-item-has-children"><a href="'.URL::Base().'">HOME</a></li>';
			}else{
				echo '<ul class="sub-menu">';
			}
			foreach ($data as $key => $value) {

				if($level==1){
					$value['nama'] = strtoupper($value['nama']);
				}
				$url = str_replace(' ', '-', $value['nama']).'.html';
				# code...
				$active ='';
				switch($value['jenis']){
					case 1:
						echo '<li class="'.$active.' submenu menu-item menu-item-type-post_type menu-item-object-page menu-item-has-children"><a href="#">'.$value['nama'].'</a>';
					break;
					case 2:
						$url1 = "pagedetail/index/{$value['halaman']}/$url";
						if($curr==$url1){
							$active = 'current_page_item current-menu-ancestor current-menu-parent current_page_parent current_page_ancestor';
						}
						$url1 = URL::Base($url1);
						echo "<li class=\"{$active} menu-item menu-item-type-post_type menu-item-object-page menu-item-has-children\"><a href=\"".$url1."\">{$value['nama']}</a>";
					break;
					case 3:
						$url1 = "page/index/{$value['halaman']}";
						if($curr==$url1){
							$active = 'current_page_item current-menu-ancestor current-menu-parent current_page_parent current_page_ancestor';
						}
						$url1 = URL::Base($url1);
						echo "<li class=\"{$active} menu-item menu-item-type-post_type menu-item-object-page menu-item-has-children\"><a href=\"".$url1."\">{$value['nama']}</a>";
					break;
					case 4:
						$url1 = "$value[halaman]";
						if($curr==$url1){
							$active = 'current_page_item current-menu-ancestor current-menu-parent current_page_parent current_page_ancestor';
						}
						$url1 = URL::Base($url1);
						echo '<li class="'.$active.' menu-item menu-item-type-post_type menu-item-object-page menu-item-has-children"><a href="'.$url1.'">'.$value['nama'].'</a>';
					break;
				}
				

				$this->GetMenu($value['halaman'], $level, $active);
				echo '</li>';
			}
			echo "</ul>";
		}
	}

	public function GetMenuMobile($parent=false,$level=0){
		if(!$parent){
			$param = "where parent_halaman is null";
		}else{
			$param = "where parent_halaman = '$parent'";
		}
		$data = $this->GetArray("select * from contents_page_halaman $param order by urutan");

		$strip = '';
		for($i=0; $i<$level; $i++){
			$strip .= '-';
		}
		$level++;
		if($level==1){
			echo '<option class="menu-item menu-item-type-custom menu-item-object-custom menu-item-has-children" value="'.URL::Base().'">'."HOME</option>";
		}
		if($data){
			foreach ($data as $key => $value) {
				# code...

				if($level==1){
					$value['nama'] = strtoupper($value['nama']);
				}
				$url = str_replace(' ', '-', $value['nama']).'.html';
				switch($value['jenis']){
					case 1:
						echo '<option class="submenu menu-item menu-item-type-custom menu-item-object-custom menu-item-has-children" value="#">'.$strip.' '.$value['nama']."</option>";
					break;
					case 2:
						echo "<option class=\"menu-item menu-item-type-custom menu-item-object-custom menu-item-has-children\" value=\"".URL::Base("pagedetail/index/{$value['halaman']}/$url")."\">{$strip}{$value['nama']}</option>";
					break;
					case 3:
						echo "<option class=\"menu-item menu-item-type-custom menu-item-object-custom menu-item-has-children\" value=\"".URL::Base("page/index/{$value['halaman']}")."\">{$strip}{$value['nama']}</option>";
					break;
					case 4:
						echo '<option class="menu-item menu-item-type-custom menu-item-object-custom menu-item-has-children" value="'.URL::Base("$value[halaman]").'">'.$strip.$value['nama']."</option>";
					break;
				}

				$this->GetMenuMobile($value['halaman'],$level);
			}
		}
	}

	public function GetSponsor(){
		$sql = "select * from contents_sponsor where is_aktif = 1";
		$data = $this->conn->GetArray($sql);
		return $data;
	}

	private function _getDetailInfoFooter($data){
		$i=0;
		$data3 = array();
		foreach ($data as $key => $value) {
			$sql = "select * from contents_page a where halaman='".$value['halaman']."' order by modified_date desc limit 5";
			$data2 = $this->conn->GetArray($sql);
			$data3[$i] = $value;
			$data3[$i]['list'] = $data2;
			$i++;
		}

		return $data3;
	}

	public function _updateStatistik(){
		$tanggal = date('Y-m-d');

		$cek = $this->conn->GetOne("
			select 1 
			from contents_statistik_pengunjung 
			where tanggal = '$tanggal'"
		);

		if($cek){
			return $this->conn->Execute("
				update 
				contents_statistik_pengunjung set jumlah = jumlah+1
				where tanggal = '$tanggal'"
			);
		}else{
			return $this->conn->Execute("
				insert 
				into contents_statistik_pengunjung (tanggal, jumlah)
				values ('$tanggal',1)"
			);
		}
	}

	function statistik(){
		$sql = "select sum(jumlah) from contents_statistik_pengunjung where tanggal = curdate()";
		$data['hari'] = $this->conn->GetOne($sql);
		$sql = "select sum(jumlah) from contents_statistik_pengunjung where tanggal = subdate(current_date, 1)";
		$data['kemarin'] = $this->conn->GetOne($sql);
		$sql = "select sum(jumlah) from (select * from contents_statistik_pengunjung where DATE_FORMAT(tanggal,'%m-%Y') = DATE_FORMAT(curdate(),'%m-%Y') order by tanggal desc limit 6) a";
		$data['minggu'] = $this->conn->GetOne($sql);
		$sql = "select sum(jumlah) from contents_statistik_pengunjung where DATE_FORMAT(tanggal,'%m-%Y') = DATE_FORMAT(curdate(),'%m-%Y')";
		$data['bulan'] = $this->conn->GetOne($sql);
		$sql = "select sum(jumlah) from contents_statistik_pengunjung where DATE_FORMAT(tanggal,'%Y') = DATE_FORMAT(curdate(),'%Y')";
		$data['tahun'] = $this->conn->GetOne($sql);
		$sql = "select sum(jumlah) from contents_statistik_pengunjung";
		$data['total'] = $this->conn->GetOne($sql);
		return $data;
	}
}