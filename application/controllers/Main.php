<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Main extends CI_Controller
{

	public function __construct()       //在類中使用構造函數,必须在構造函數中顯式繼承母類構造函數
	{
		parent::__construct();        //繼承父類別
		$this->load->helper('url');   //載入預設url 庫函數及數据庫配置	
		$this->load->library("session");
		$this->load->library('excel');
		//$this->output->cache(480);  //緩衝 
	}

	public function index()
	{
		$data['copmany'] = $this->session->userdata('sysml002');
		$data['username'] = $this->session->userdata('manager');
		if (session_status() == PHP_SESSION_NONE) {
			session_start();
		}
		//   $data['copmany'] = $_SESSION['sysml002'];
		//   $data['username'] = $_SESSION['manager'];

		$this->load->model('Main_model');
		//取得線上人數
		$data['online'] = $this->Main_model->updatetime($data['username']);

		$data['systitle'] = '雲端ERP企業資源管理系統';
		$this->session->set_userdata('page_ac', $this->uri->segment(3));
		$data['page_ac'] = $this->session->userdata('page_ac');
		$this->load->vars($data);
		$this->load->view('main_v');
	}

	public function onlinenum()
	{
		$this->load->model('Main_model');
		$data['online'] = $this->Main_model->updatetime($this->session->userdata('sysuser'));

		echo $this->session->userdata('sysuser');
		$this->load->vars($data);
	}


	//不更新網頁   權限Y  mg004 傳回基本權限字串 傳過去程式代號
	public function dataadmq05a()
	{
		$this->load->model('Main_model');
		//	echo var_dump('test');exit;
		$data['result'] = $this->Main_model->ajaxadmq04a($this->uri->segment(3));
		//echo var_dump('test');exit;

		$Result = $data['result'];
		//	$data['sysmg001'] = $this->session->userdata('sysmg001');
		//	$data['sysmg004'] = $this->session->userdata('sysmg004');
		//	$data['sysmg006'] = $this->session->userdata('sysmg006');
		$this->load->vars($data);
		echo  $Result;
	}

	//不更新網頁	使用者權限 mg004 傳回基本權限字串 有使用main_funtree 回傳 $this->uri->segment(4) 1050223 1050803
	public function datacmsq05a()
	{
		//echo var_dump('test1');exit;	
		$this->load->model('adm/Admi10_model');
		//echo var_dump('test');exit;
		$data['result'] = $this->Admi10_model->ajaxadmi10a($this->uri->segment(3));
		//echo var_dump('test');exit;

		$Result = $data['result'];
		$this->load->vars($data);
		echo  $Result;
	}
	//tree menu_fun.php
	/*
 * 菜單
 */
	public function getMenu($pid = 0)
	{
		global $webdb;
		if (isShopUser()) $where = " and (sid='0' or sid='" . $_SESSION['shop_id'] . "')";
		else $where = " and sid=0 ";
		$sql = "select * from web_prod_type where parent_id=" . $pid . " " . $where;
		$menuAry = $webdb->getList($sql);
		if (sizeof($menuAry) > 0) {
			foreach ($menuAry as $key => $val) {
				$sub_menu = getMenu($val['id']);
				if ($sub_menu) $menuAry[$key]['children'] = $sub_menu;
			}
			return $menuAry;
		} else return false;
	}
	public function menuJson($val, $autoDo = true)
	{
		$return['text'] = $val['name'];

		if ($autoDo) {
			$re_id_ary[] = 'do_tag=prodList';
			$re_id_ary[] = 'do_type=list';
			$re_id_ary[] = 'ptid=' . $val['id'];
			if (is_array($re_id_ary)) $re_id = implode('&', $re_id_ary);
			$return['id'] = ($re_id) ? $re_id : null;
		} else {
			$return['id'] = $val['id'];
		}

		if (is_array($val['children'])) {
			foreach ($val['children'] as $sub)
				$return['children'][] = menuJson($sub, $autoDo);
		} else {
			$return['leaf'] = true;
		}
		return $return;
	}
	public function menuTreeToList($menuList, &$reary)
	{
		if (is_array($menuList))
			foreach ($menuList as $menu) {
				if ($menu['id'])
					$reary[] = array('id' => $menu['id'], 'text' => $menu['text']);
				if (is_array($menu['children']))
					menuTreeToList($menu['children'], $reary);
			}
	}
	//tree_function.php		
	/*
 * 遞歸某個表,獲得下拉菜單
 */
	public function dgArray($tab, $where = '', $pid = 0, $ex = '', $nf = 'name', $pf = 'parent_id', $kf = 'id')
	{
		global $webdb;
		$sql = "select " . $kf . "," . $nf . " from " . $tab . " where " . $pf . "='" . $pid . "' ";
		if ($where) $sql .= $where;
		$res = $webdb->getList($sql);
		!$res && $res = array();
		foreach ($res as $val) {
			$val['dicval'] = $val[$kf];
			$val['name'] = $ex . $val[$nf];
			$reAry[] = $val;
			$reAry = array_merge($reAry, dgArray($tab, $where, $val[$kf], $ex . '&nbsp;&nbsp;', $nf, $pf, $kf));
		}
		!$reAry && $reAry = array();
		return $reAry;
	}

	public function arrayOption($ary, $def = null, $py = true, $desc = true)
	{
		$str = '';
		foreach ($ary as $val) {
			if ($val['id'] == $def) $selected = 'selected';
			else $selected = '';
			$str .= '<option value="' . $val['id'] . '" ' . $selected . '>' . $val['py'] . ' ' . $val['name'] . '</option>';
		}
		return $str;
	}

	public function resetArray($parent_id, $array)
	{
		$retVal = array();
		foreach ($array as $val) {
			if ($parent_id == $val["parent_id"]) {
				$retVal[] = $val;
				//$retVal[count($retVal)-1]['indent'].='&nbsp;&nbsp;&nbsp;&nbsp;';
				$tmp = array();
				$tmp = resetArray($val["id"], $array);
				if ($tmp) {
					foreach ($tmp as $val2) {
						$retVal[] = $val2;
						$retVal[count($retVal) - 1]['indent'] .= '&nbsp;&nbsp;&nbsp;&nbsp;';
						$retVal[count($retVal) - 1]['flag']++;
					}
				}
				unset($tmp);
			}
		}
		return $retVal;
	}
	public function hasSub($id, $array)
	{
		$retVal = false;
		foreach ($array as $ary) {
			if ($ary["parent_id"] == $id) {
				$retVal = true;
				break;
			}
		}
		return $retVal;
	}
	public function createmenu($array, $imgRootPath, $divIdPrefix = "", $parent_id = 0)
	{
		$result = "";
		$rs = resetArray($parent_id, $array);
		$result = '<div class="tree_menu" id="' . $divIdPrefix . '_tree_menu" >';
		for ($i = 0; $i < count($rs); $i++) {
			$result .= "<div width='100%'>";
			for ($j = 0; $j < $rs[$i]["flag"]; $j++) {
				if ($rs[$i]["name"] && (($j + 1) == $rs[$i]["flag"])) {
					if ($rs[$i + 1]["parent_id"] == $rs[$i]["parent_id"]) {
						$result .= '<img src="' . $imgRootPath . 'style/tree/H.gif">';
					} else {
						if ($rs[$i]["flag"] <= ($rs[$i + 1]["flag"] + 1)) {
							$result .= '<img src="' . $imgRootPath . 'style/tree/H.gif">';
						} else {
							$result .= '<img src="' . $imgRootPath . 'style/tree/L.gif">';
						}
					}
					//echo "<hr />";
				} else {
					$result .= '<img src="' . $imgRootPath . 'style/tree/I.gif">';
				}
			}

			$rsid = $rs[$i]["id"];
			$flag_img = "nfolder.gif";
			$onclick = "";
			$A_onclick = "";
			if (hasSub($rs[$i]["id"], $array)) {
				$flag_img = "ofolder.gif";
				//隱藏
				if ($rs[$i]["hide_sub"] == 1) $flag_img = "folder.gif";

				$onclick = ' onclick="OnClickOutline(\'' . $imgRootPath . '\',' . $rsid . ')" ';
				$A_onclick = "javascript:OnClickOutline('" . $imgRootPath . "'," . $rsid . ")";
			}

			$result .= '<img class="Outline" id="ID' . $rsid . '" style="CURSOR: pointer" ' . $onclick . ' alt="" src="' . $imgRootPath . 'style/tree/' . $flag_img . '" />&nbsp;';
			if ($rs[$i]["link"]) {
				$result .= '<a href="' . $rs[$i]["link"] . '">';
			} else {
				if ($A_onclick) {
					$result .= '<a href=' . $A_onclick;
				} else {
					$result .= '<a href="javascript:void(0);"';
				}
				//			$result.='<a href="javascript:void(0);"';
				//			if($onclick) $result.=$onclick;
				$result .= '>';
			}
			$result .= $rs[$i]["name"];
			$result .= '</a>';

			$result .= "</div>";

			//		if($rs[$i]["pid"]==0) $result.= "<br />";

			//</div>
			if ($rs[$i]["flag"] > $rs[$i + 1]["flag"]) {
				$div_n = $rs[$i]["flag"] - $rs[$i + 1]["flag"];
				for ($div_i = 0; $div_i < $div_n; $div_i++) {
					$result .=  "</div>";
				}
			}
			//end </div>
			//<div>
			if (hasSub($rs[$i]["id"], $array)) {
				$result .= '<div id="ID' . $rsid . 'd"';
				if ($rs[$i]["hide_sub"] == 1) $result .= ' style="display:none" ';
				$result .= '>';
			}
			//end <div>
		}
		//$result.= '  <div id="infodisplay"><font color="#999999">點擊＋展開節點</font></div>';
		$result .= '</div>';
		$result .= "<script>";
		$result .= "	$('#" . $divIdPrefix . "_tree_menu a').click(function (){";
		$result .= "		if($(this).attr('href')!='javascript:void(0);') {";
		$result .= "			SetCookie('" . $divIdPrefix . "_tree_menu',$(this).attr('href'));";
		$result .= "			SetCookie('" . $divIdPrefix . "_menu_name',$(this).text());";
		$result .= "	}});";
		//	$result.="	tree_menu_setNow(GetCookie('".$divIdPrefix."_tree_menu'),'".$divIdPrefix."_tree_menu');";
		$result .= "</script>";
		return $result;
	}
	public function get_hide_sub($hide_sub)
	{
		$result = "";
		if ($hide_sub == 1) {
			$result = "是";
		} else $result = "否";
		return $result;
	}

	public function get_group_id_by_admin_id($admin_id)
	{
		if (empty($admin_id)) return false;
		global $webdb;
		return $webdb->getValue("select * from _sys_admin where id=" . $admin_id, "gpid");
	}
	public function getMenuData($admin_id)
	{
		if (empty($admin_id)) return false;
		global $webdb;
		$where = " and admin_id=" . $admin_id;
		$group_id = get_group_id_by_admin_id($admin_id);
		if ($group_id) $where .= " or group_id=" . $group_id;
		// return $webdb->getList("select s.id,s.name,s.link,s.parent_id,s.hide_sub from _sys_section s inner join _sys_group_perm p on p.perm_id=s.id where 1 ".$where."  group by s.id order by s.sort,s.id asc");
		return $webdb->getList("select s.id,s.name,s.link,s.parent_id,s.hide_sub from _sys_section s inner join _sys_group_perm p on p.perm_id=s.id where (1 " . $where . " ) AND s.status=1 group by s.id order by s.sort,s.id asc");
	}
	public function getMenuAllData()
	{
		global $webdb;
		return $webdb->getList("select * from _sys_section order by sort,id asc");
	}
}
/* End of file login.php */
/* Location: ./application/controllers/login.php */
