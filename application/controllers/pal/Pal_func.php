<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Pal_func extends CI_Controller {           //擴展類必须註明由母類擴展而來 (自訂類使用 ci 框架)
	
	public function __construct()       //在類中使用構造函數,必须在構造函數中顯式繼承母類構造函數
	    {
     	  parent::__construct();        //繼承父類別
	      $this->load->helper('url');   //載入預設url 庫函數及數据庫配置	
	      $this->load->library("session");	  
	      $this->load->library('excel');
		  $this->firephp->setEnabled(TRUE);
		  
	    }
		
	public function index(){
		echo "此區域為外掛程式區<br><br>";
		$function_array = array(
			'replace_overtime_tax_operation' => "免稅加班費計算強制修復更新paltd",
			'replace_fixtax_operation' => "應稅所得公式與個人代扣強制修復更新paltd"
		);
		
		echo "目前有以下數個function:<br>";
		foreach($function_array as $key => $val){
			echo "　　".$val." : ".$key;
			echo "<br>";
		}echo "<br><br><br>";
		echo "請將欲執行方法輸入在網址中.../pal_func/ 的後方
			，如'.../derpal/index.php/pal/pal_func/".$key."' 以便跳轉到該方法";
		
	}
	public function test()   
        {
			$data = array();
			$this->load->vars($data);
			echo "<input />";
			echo "<input />";
			echo "<input />";
			echo "<input />";
			echo "<pre>";var_dump($this->db);
        }
		
	public function replace_fixtax_operation()	//應稅所得公式強制修復更新paltd
		{
			$date = $this->input->get('date');
			if(!@$date){echo "此功能為應稅所得公式與個人代扣強制修復更新paltd<br>";echo "請在網址加入date=年月(不含斜線等特殊符號)選擇執行年月!<br>";
				echo "欲返回方法選擇頁面，請將'../pal_func/' 後方的所有字元清除即可";exit;
			}
			$sure = $this->input->get('sure');
			if(!@$sure){echo "此功能為應稅所得公式與個人代扣強制修復更新paltd<br>";echo "請在網址加入sure=1表示已確認要執行!<br>";
				echo "欲返回方法選擇頁面，請將'../pal_func/' 後方的所有字元清除即可";exit;
			}
			$this->db->select('td005,td001,td002,td003,td004
				,mv200,td035,td043,td044,td045,td046,td030,td047,td048,td049
			');
			$this->db->from('paltd as a');
			$this->db->join('cmsmv as b', 'a.td001 = b.mv001 ','left');
			$this->db->where('td005', $date);
			$this->db->order_by('td003 asc, td001 asc');
			$query = $this->db->get();
			$result = $query->result();
			
			foreach($result as $key=>$val){
				foreach($val as $k=>$v){
					$$k = $v;
				}
				if($td030>=10000){$td047 = $td030-$td049;}else{$td047 = $td030;}
				$val->td047 = $td047;
				if($td048<=0){
					if($mv200>0&&$mv200<1){
						$td035 = $td047*$mv200;$val->td035 = round($td035,0);
					}else if($mv200==1&&$mv200==2){
						$td035 = 0;$val->td035 = $td035;
					}else if($mv200>2){
						$td035 = $mv200;$val->td035 = $td035;
					}
				}
				if($td030<21009){
					$td035 = 0;$val->td035 = $td035;
				}
				
			}
			
			$affected = 0;$affected_ary = array();
			foreach($result as $key=>$val){
				$data = array(			
					'td047' => $val->td047,
					'td035' => $val->td035
				);
				$this->db->where('td001', $val->td001);
				$this->db->where('td005', $val->td005);
				$this->db->update('paltd',$data);			//更改一筆
				
				if ($this->db->affected_rows() > 0){
					$affected++;$affected_ary[]=array($val->td001,$val->td002);
				}
				
			}
				echo "改動 ".$affected." 筆<br>";
				echo "改動員工:<br>";
				foreach($affected_ary as $key=>$val){
					echo $val[0].":".$val[1]."<br>";
				}
			
			
			
			//設定暫時view
			$view_string = "";
			$view_string .= "<table border='1'>";
			$colname_ary = array('td001'=>"員編",'td002'=>"姓名",'td003'=>"部門代號",'td004'=>"部門名稱"
				,'td005'=>"發薪年月",'td030'=>"應領薪資",'mv200'=>"個人代扣健保率",'td035'=>"個人代扣"
				,'td043'=>"免稅加時",'td044'=>"免稅加費"
				,'td045'=>"應稅加時",'td046'=>"應稅加費"
				,'td047'=>"應稅所得",'td048'=>"健保投保金額",'td049'=>"免稅伙食"
			);
			foreach($result as $key=>$val){
				$data_string = "";
				$data_string .= "<tr";
				if($key%2!=0){
					$data_string .= " style='background-color:rgba(128, 128, 128, 0.25)' ";
				}
				$data_string .= ">";
				$col_string = "<tr>";
				foreach($val as $k=>$v){
					if($key == 0){
						if(isset($colname_ary[$k]))
							$col_string .= "<th>".$colname_ary[$k]."</th>";
						else
							$col_string .= "<th>".$k."</th>";
					}
					$data_string .= "<td>".$v."</td>";
				}
				$data_string .= "</tr>";
				$col_string .= "</tr>";
				if($key == 0){
					$view_string .= $col_string;
				}
				$view_string .= $data_string;
			}
			$view_string .= "</table>";
			
			echo $view_string;
			//送出變數區//除非有view不然沒用
				$front_data = array();
				$this->load->vars($front_data);
			
			
		}
		
	public function replace_overtime_tax_operation()	//免稅加班費計算強制更新paltd
        {
			$date = $this->input->get('date');
			if(!@$date){echo "此功能為強制修改薪資檔中的免稅加班費<br>";echo "請在網址加入date=年月(不含斜線等特殊符號)選擇執行年月!<br>";
				echo "欲返回方法選擇頁面，請將'../pal_func/' 後方的所有字元清除即可";exit;
			}
			$sure = $this->input->get('sure');
			if(!@$sure){echo "此功能為強制修改薪資檔中的免稅加班費<br>";echo "請在網址加入sure=1表示已確認要執行!<br>";
				echo "欲返回方法選擇頁面，請將'../pal_func/' 後方的所有字元清除即可";exit;
			}
			$this->db->select('td001,td002,td003,td004
				,td030,td005
				,td017,td018,td019,td020
				,td021,td022,td023,td024
				,td025,td026,td027,td028
				,td043,td044,td045,td046
				,(b.md004+b.md005+b.md006+b.md009+b.md010+b.md011+b.md012)/240 as base_hr_salary
			');
			$this->db->from('paltd as a');
			$this->db->join('palmd as b', 'a.td001 = b.md001 ','left');
			$this->db->where('td005', $date);
			$this->db->order_by('td003 asc, td001 asc');
			$query = $this->db->get();
			$result = $query->result();
			//echo "<pre>";var_dump($result);exit;
			
		//設定暫時view
			$view_string = "";
			
		foreach($result as $key=>$val){
			foreach($val as $k=>$v){
				$$k = $v;
			}
			if($td017+$td019+$td021+$td023 <= 46){
				$val->td043 = $td017+$td019+$td021+$td023+$td025+$td027;
				$val->td044 = round(($td017*4/3+$td019*5/3+$td021*4/3+$td023*5/3+$td025*1+$td027*4/3)*$base_hr_salary,0);
				$val->td045 = 0;
				$val->td046 = 0;
			}else if($td017+$td019+$td021+$td023 > 46){
				$total_hr = $td017+$td019+$td021+$td023;
				
				$col_ary = array('td017'=>$td017,'td019'=>$td019,'td021'=>$td021
								,'td023'=>$td023
							);
				$rate_ary = array('td017'=>(4/3),'td019'=>(5/3),'td021'=>(4/3)
								,'td023'=>(5/3),'td025'=>1,'td027'=>(4/3)
							);
				$need_tax_hr = 0;$need_tax = 0;$non_tax_hr=0;$non_tax = 0;
				foreach($col_ary as $k=>$v){
					if($total_hr>46){
						$total_hr -= $v;
						$need_tax_hr += $v;
						$need_tax += $v*$rate_ary[$k]*$base_hr_salary;
						
						if($total_hr<46){//如果扣到低於46則補正
							$non_tax_hr += (46-$total_hr);
							$non_tax += (46-$total_hr)*$rate_ary[$k]*$base_hr_salary;
							$need_tax_hr -= (46-$total_hr);
							$need_tax -= (46-$total_hr)*$rate_ary[$k]*$base_hr_salary;
						}
					}else{
						$non_tax_hr += $v;
						$non_tax += $v*$rate_ary[$k]*$base_hr_salary;
					}
				}
				
				$val->td043 = $non_tax_hr+$td025+$td027;
				$val->td044 = round($non_tax,0)+round($td025*$base_hr_salary+$td027*$rate_ary['td027']*$base_hr_salary,0);
				$val->td045 = $need_tax_hr;
				$val->td046 = round($need_tax,0);
				
			}
			$val->base_hr_salary = round($val->base_hr_salary,2);
			
		}
		
		$colname_ary = array('td017'=>"平2時內",'td019'=>"平2時外",'td021'=>"六2時內"
			,'td023'=>"六2時外",'td025'=>"日8時內",'td027'=>"日8時外"
			,'td043'=>"免稅加時",'td044'=>"免稅加費",'td045'=>"應稅加時",'td046'=>"應稅加費"
			,'base_hr_salary'=>"計算時薪"
		);
		
		$view_string .= "<table border='1'>";
		foreach($result as $key=>$val){
			$data_string = "";
			$data_string .= "<tr";
			if($key%2!=0){
				$data_string .= " style='background-color:rgba(128, 128, 128, 0.25)' ";
			}
			$data_string .= ">";
			$col_string = "<tr>";
			foreach($val as $k=>$v){
				if($key == 0){
					if(isset($colname_ary[$k]))
						$col_string .= "<th>".$colname_ary[$k]."</th>";
					else
						$col_string .= "<th>".$k."</th>";
				}
				$data_string .= "<td>".$v."</td>";
			}
			$data_string .= "</tr>";
			$col_string .= "</tr>";
			if($key == 0){
				$view_string .= $col_string;
			}
			$view_string .= $data_string;
		}
		$view_string .= "</table>";
		
		$affected = 0;$affected_ary = array();
		foreach($result as $key=>$val){
			$data = array(			
				'td043' => $val->td043,
				'td044' => $val->td044,
				'td045' => $val->td045,
				'td046' => $val->td046
			);
			$this->db->where('td001', $val->td001);
			$this->db->where('td005', $val->td005);
			$this->db->update('paltd',$data);			//更改一筆
			
			if ($this->db->affected_rows() > 0){
				$affected++;$affected_ary[]=array($val->td001,$val->td002);
			}
			
		}
			echo "改動 ".$affected." 筆<br>";
			echo "改動員工:<br>";
			foreach($affected_ary as $key=>$val){
				echo $val[0].":".$val[1]."<br>";
			}
		//送出view
			echo $view_string;//暫時遮蔽
		//送出變數區//除非有view不然沒用
			$front_data = array();
			$this->load->vars($front_data);
        }
}
/* End of file palb01.php */
/* Location: ./application/controllers/palb01.php */

/*
//作為一些範例
  public function batcha()   
	{
		$this->load->model('pal/palb01_model','',TRUE);
		$data['message'] = '計算資料完成!';
		$this->palb01_model->batchaf();   //invlc 表
		$data['username'] = $this->session->userdata('manager');
		$data['systitle'] ='薪資計算作業-轉入';
		$data['menu_v'] = 'main_menuno_v';
		$data['content_v'] = 'pal/palb01_batch_v';
		$data['foot_v'] = 'main_foot_v';
		$data['date'] = $this->input->post('dateyymm');
		$this->load->vars($data);
		$this->load->view('main_head_v');
		//$this->tempfunc();
	}
//直接執行SQL	參考
	$sql2 = "INSERT INTO paltd (td001,td002,td003,td004,td005,td050,td051,td052,td053,td054) 
		select tc001,b.mv002,b.mv004,c.me002,$vyymm1,b.mv009,b.mv021,b.mv022,b.mv206,b.mv019 from paltc as a
		LEFT JOIN cmsmv as b ON a.tc001=b.mv001 and ((b.mv022='' or b.mv022 IS NULL) or substr(b.mv022,1,6)>='$vyymm1')
		LEFT JOIN cmsme as c ON a.tc002=c.me001 WHERE a.tc003='$vyymm1' and SUBSTR(b.mv021,1,6)<='$vyymm1'"; 
	$this->db->query($sql2);
	
//select		參考
	$this->db->select('a.tc001,b.mv002 as tc001disp, a.tc002, c.me002 as tc002disp,a.tc003, a.tc008, a.tc023, a.create_date');
	$this->db->from('paltc as a');
	$this->db->join('cmsmv as b', 'a.tc001 = b.mv001 ','left');
	$this->db->join('cmsme as c', 'a.tc002 = c.me001 ','left');
	$this->db->like('a.tc001', $seq4, 'after');
	$this->db->where('a.tc001', $seq4);
	$this->db->or_where('a.tc001', $seq4);
	$this->db->order_by('tc001 asc, tc002 asc');
	$this->db->limit(15, 0);			//15筆
	$query = $this->db->get();    
	$ret['rows'] = $query->result();	//以物件取得
	
//insert		參考
	$data = array( 
		'tc001' => $this->input->post('palq01a'),
		'tc002' => $tc002,
		'tc003' => $tc003
	);
	 
	$exist = $this->pali33_model->selone($this->input->post('palq01a'),$tc003);
	
	if ($exist)
		{
			return 'exist';
		} 
	$this->db->insert('paltc', $data);
	
	if ($this->db->affected_rows() > 0)
		{
			return TRUE;
		}
			return FALSE;
		   
//update		參考	
	$data = array(			
		'tc022' => $this->input->post('tc022'),
		'tc023' => $this->input->post('tc023')
	);
	$this->db->where('tc001', $tc001);
	$this->db->where('tc003', $tc003);
	$this->db->update('paltc',$data);			//更改一筆
	
	if ($this->db->affected_rows() > 0)
		{
			return TRUE;
		}
			return FALSE;

//	delete	參考
	$this->db->where('td005', $vyymm1);
	$this->db->delete('paltd'); 
*/





/*
//免稅加班費計算強制更新paltd  將假日加班也放入46計算版本

foreach($result as $key=>$val){
	foreach($val as $k=>$v){
		$$k = $v;
	}
	if($td017+$td019+$td021+$td023+$td025+$td027 <= 46){
		$val->td043 = $td017+$td019+$td021+$td023+$td025+$td027;
		$val->td044 = round(($td017*4/3+$td019*5/3+$td021*4/3+$td023*5/3+$td025*1+$td027*4/3)*$base_hr_salary,0);
		$val->td045 = 0;
		$val->td046 = 0;
	}else if($td017+$td019+$td021+$td023+$td025+$td027 > 46){
		$total_hr = $td017+$td019+$td021+$td023+$td025+$td027;
		
		$col_ary = array('td017'=>$td017,'td019'=>$td019,'td021'=>$td021
						,'td023'=>$td023,'td025'=>$td025,'td027'=>$td027
					);
		$rate_ary = array('td017'=>(4/3),'td019'=>(5/3),'td021'=>(4/3)
						,'td023'=>(5/3),'td025'=>1,'td027'=>(4/3)
					);
		$need_tax_hr = 0;$need_tax = 0;$non_tax_hr=0;$non_tax = 0;
		foreach($col_ary as $k=>$v){
			if($total_hr>46){
				$total_hr -= $v;
				$need_tax_hr += $v;
				$need_tax += $v*$rate_ary[$k]*$base_hr_salary;
				
				if($total_hr<46){//如果扣到低於46則補正
					$non_tax_hr += (46-$total_hr);
					$non_tax += (46-$total_hr)*$rate_ary[$k]*$base_hr_salary;
					$need_tax_hr -= (46-$total_hr);
					$need_tax -= (46-$total_hr)*$rate_ary[$k]*$base_hr_salary;
				}
			}else{
				$non_tax_hr += $v;
				$non_tax += $v*$rate_ary[$k]*$base_hr_salary;
			}
		}
		
		$val->td043 = $non_tax_hr;
		$val->td044 = round($non_tax,0);
		$val->td045 = $need_tax_hr;
		$val->td046 = round($need_tax,0);
		
	}
	$val->base_hr_salary = round($val->base_hr_salary,2);
	
}
*/
?>