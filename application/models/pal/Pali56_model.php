<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class pali56_model extends CI_Model
{

	function __construct()
	{
		parent::__construct();      //重載ci底層程式 自動執行父類別
	}

	//查詢 table 表所有資料 
	function selbrowse($num, $offset)
	{
		$this->db->select('tf001, tf002, tf003, tf004, tf005, tf006, create_date');
		$this->db->from('paltf');
		$this->db->order_by('tf001 desc, tf002 desc');    //排序  單欄以上 asc 由小至大 desc預設由大至小
		$this->db->limit($num, $offset);   // 每頁15筆
		$ret['rows'] = $this->db->get()->result();

		$this->db->select('COUNT(*) as count');    //查詢總筆數
		$this->db->from('paltf');
		$query = $this->db->get();
		$tmp = $query->result();
		$ret['num_rows'] = $tmp[0]->count;
		return $ret;
	}

	//欄位表頭排序流覽資料
	function search($sort_by, $sort_order, $dateo, $datec, $type, $epyo, $epyc, $dep = "")
	{
		$start_time = date("H") * 3600 + date("i") * 60 + date("s");
		// $start_time2 = microtime(true);
		preg_match_all('/\d/S', $dateo, $matches);  //處理日期字串
		$dateo = implode('', $matches[0]);
		preg_match_all('/\d/S', $datec, $matches);  //處理日期字串
		$datec = implode('', $matches[0]);
		if (!@$dateo) {
			$dateo = date("Ymd");
		}
		if (!@$datec) {
			$datec = date("Ymd");
		}
		if ($dateo > $datec) {
			$temp = $dateo;
			$dateo = $datec;
			$datec = $temp;
			unset($temp);
		} //如果前者較小則對換
		if (strlen($dateo) != 8) {
			$dateo = substr($dateo, 0, 6) . "0" . substr($dateo, 6, 1);
		}
		if (strlen($datec) != 8) {
			$datec = substr($datec, 0, 6) . "0" . substr($datec, 6, 1);
		}
		$sort_order = (substr($sort_order, 0, 3) == 'asc') ? 'asc' : 'desc';
		$sort_columns = array('te001', 'te002', 'me001', 'me002', 'create_date', 'modifier', 'modi_date', 'creator');
		$sort_by = (in_array($sort_by, $sort_columns)) ? $sort_by : 'me001';  //檢查排序欄位是否在 table 內

		$sql = "SELECT IFNULL(c.me001,'') as me001,IFNULL(c.me002,'') as me002,a.mv001 as te001,a.mv002,a.mv027,d.mo002, d.mo003, d.mo004, d.mo005, d.mo006, a.mv021, a.mv022 
				FROM cmsmv as a
				LEFT JOIN cmsme as c ON a.mv004 = c.me001
				LEFT JOIN palmo as d ON a.mv027 = d.mo001 
				WHERE a.mv021 <= '" . $datec . "' and (a.mv022='' or a.mv022 IS NULL or a.mv022 >= '" . $dateo . "') and a.mv026='Y' ";
		if ($epyo != "") {
			$sql .= " and a.mv001 >= '" . $epyo . "'";
		}
		if ($epyc != "") {
			$sql .= " and a.mv001 <= '" . $epyc . "'";
		}


		if (!@$this->input->get('dep')) {
			$dep = "DS005";
		} else {
			$dep = $this->input->get('dep');
		}

		echo $dep;
		exit;

		// if ($dep != "") {
		// 	$sql .= " and c.me001 = '" . $dep . "'";
		// }
		$sql .= " ORDER BY a.mv004 asc, a.mv021 asc";


		$query = $this->db->query($sql);
		$epy['rows'] = $query->result();
		$epy_data = array();
		foreach ($epy['rows'] as $t_k => $t_v) {
			$epy_data[$t_v->te001] = $t_v;
		}
		// echo "<pre>";var_dump($epy_data);exit;
		//total_num 計算筆數--------------------------------------
		$total_num = count($epy_data);


		//會有沒刷卡不顯示的問題產生
		$sql11 = "select IFNULL(c.me001,'') as me001,IFNULL(c.me002,'') as me002,a.mv001 as te001,a.mv002 as mv002 ,a.mv027 as mv027 ,IFNULL(a.mv028,'') as mv028 ,
				IFNULL(b.te002,'') as te002, COUNT(b.te003) as c_te003, b.create_date,
				Coalesce(e.mo001,d.mo001) as mo001 ,Coalesce(e.mo002,d.mo002) as mo002 , Coalesce(e.mo003,d.mo003) as mo003 , Coalesce(e.mo004,d.mo004) as mo004 ,
				Coalesce(e.mo005,d.mo005) as mo005 , Coalesce(e.mo006,d.mo006) as mo006, Coalesce(e.mo007,d.mo007) as mo007, Coalesce(e.mo008,d.mo008) as mo008 ,
				Coalesce(e.mo009,d.mo009) as mo009 ,Coalesce(e.mt005,'N') as mt005,	a.mv021, a.mv022 ,b.te008 
				FROM cmsmv as a
				LEFT JOIN palte as b ON a.mv001 = b.te001 and b.te002 >= '" . $dateo . "' and b.te002 <= '" . $datec . "' 
				LEFT JOIN cmsme as c ON a.mv004 = c.me001
				left join palmtmix as e on a.mv001=e.mt002 and b.te002 =e.mt003
				LEFT JOIN palmo as d ON a.mv027 = Coalesce(e.mt002,d.mo001) 
				WHERE a.mv021 <= '" . $datec . "' and (a.mv022='' or a.mv022 IS NULL or a.mv022 >= '" . $dateo . "') and a.mv026='Y'
				";



		// //會有第一次查palte7沒資料的問題		
		// $sql12 = "select IFNULL(c.me001,'') as me001,IFNULL(c.me002,'') as me002,a.mv001 as te001,a.mv002 as mv002 ,a.mv027 as mv027 ,IFNULL(a.mv028,'') as mv028 ,
		// 				IFNULL(f.te002,'') as te002,
		// 				Coalesce(e.mo001,d.mo001) as mo001 ,Coalesce(e.mo002,d.mo002) as mo002 , Coalesce(e.mo003,d.mo003) as mo003 , Coalesce(e.mo004,d.mo004) as mo004 ,
		// 				Coalesce(e.mo005,d.mo005) as mo005 , Coalesce(e.mo006,d.mo006) as mo006, Coalesce(e.mo007,d.mo007) as mo007, Coalesce(e.mo008,d.mo008) as mo008 ,
		// 				Coalesce(e.mo009,d.mo009) as mo009 ,Coalesce(e.mt005,'N') as mt005,	a.mv021, a.mv022 
		// 				, (select te008 from palte where te001=f.te001 and te002 =f.te002  LIMIT 1) as te008
		// 		from palte7 as f 
		// 				LEFT JOIN cmsmv as a on a.mv001= f.te001 and f.te002 >= '$dateo' and f.te002 <= '" . $datec . "' 
		// 				LEFT JOIN cmsme as c ON a.mv004 = c.me001
		// 				LEFT JOIN palmtmix as e on a.mv001=e.mt002 and f.te002 =e.mt003
		// 				LEFT JOIN palmo as d ON a.mv027 = Coalesce(e.mt002,d.mo001)
		// 		WHERE a.mv021 <= '" . $datec . "' and (a.mv022='' or a.mv022 IS NULL or a.mv022 >= '" . $dateo . "') and a.mv026='Y'";


		if ($epyo != "") {
			$sql11 .= " and b.te001 >= '" . $epyo . "' ";
			// $sql12 .= " and f.te001 >= '" . $epyo . "' ";
		}
		if ($epyc != "") {
			$sql11 .= " and b.te001 <= '" . $epyc . "' ";
			// $sql12 .= " and f.te001 <= '" . $epyc . "' ";
		}

		$sql11 .= " GROUP BY mv001 , te002
						ORDER BY b.te002 asc, a.mv004 asc, a.mv021 asc";
		// $sql12 .= "
		// 				ORDER BY f.te002 asc, a.mv004 asc, a.mv021 asc";




		// $query = $this->db->query($sql12);
		//沒資料就使用舊的方法
		// if (count($query->result()) == 0) {
		$query = $this->db->query($sql11);
		// }

		$ret['rows'] = $query->result();
		//temp_data 每人每上下班之時間設定 已含排班----------------------------
		$temp_data = $ret['rows'];
		// echo "<pre>";
		// var_dump($temp_data);
		// exit;

		//因跨天輪班所以多取一天
		$sql = "SELECT te001,te006 as te002,te003,
				Coalesce(c.mo003,d.mo003) as mo003 , Coalesce(c.mo004,d.mo004) as mo004,
				Coalesce(c.mt008,c.mo003,d.mo003) as emo003 , Coalesce(c.mt009,c.mo004,d.mo004) as emo004,Coalesce(c.mt005,'N') as mt005
				FROM palte as a
				LEFT JOIN cmsmv as b ON a.te001 = b.mv001
				left join palmtmix as c on b.mv001=c.mt002 and a.te006 =c.mt003
				LEFT JOIN palmo as d ON b.mv027 = Coalesce(c.mt002,d.mo001) 
				where te006 >= '" . date("Ymd", strtotime("-1 day", strtotime($dateo))) . "' and te006 <= '" . date("Ymd", strtotime("+1 day", strtotime($datec))) . "'";

		if ($epyo != "") {
			$sql .= " and te001 >= '" . $epyo . "' ";
		}
		if ($epyc != "") {
			$sql .= " and te001 <= '" . $epyc . "' ";
		}

		$query = $this->db->query($sql);
		//temp_tdata 刷卡記錄-------------------------------------------------
		$temp_tdata = $query->result();
		foreach ($temp_tdata as $key => $val) {

			/**
			 * 處理輪班所產生的隔天問題 20220304 by Sam
			 */

			$SE = $val->mt005;
			if ($SE == 'N') {										//特殊班
				$SE = $this->check_SE($val->te001, $val->te002);
			}

			$temp_kar_hr = substr($val->te003, 0, 2); //刷卡時
			$temp_onwork_hr = substr($val->mo003, 0, 2); //上班時
			$temp_offwork_hr = substr($val->mo004, 0, 2); //下班時

			//上班時 24-----------------------------------------
			$temp_onwork_hr = ($temp_onwork_hr == '00') ? 24 : $temp_onwork_hr;
			if ($temp_onwork_hr == 24) {
				$temp_kar_hr = ($temp_kar_hr == '00') ? 24 : $temp_kar_hr;
			}
			//上班時 24--end---------------------------------------

			// echo "<pre>";
			// var_dump('id:' . $val->te001);
			// var_dump('temp_kar:' . $val->te003);
			// var_dump('temp_onwork_hr:' . $temp_onwork_hr);


			$t_date = date('Ymd', strtotime(' -1 day', strtotime($val->te002))); //處理日期前一天
			$a_date = date('Ymd', strtotime(' +1 day', strtotime($val->te002))); //處理日期後一天
			if ($temp_onwork_hr >= 13 && $temp_onwork_hr != 24) {

				// var_dump($SE);
				if (!isset($time_data[$t_date][$val->te001])) { //看前一天無資料存在
					// var_dump(2);
					if ($SE != 'E') {
						// var_dump(3);
						if ($temp_kar_hr >=  ($temp_onwork_hr - 1)) { //打卡時間 >= 上班時間 才歸入
							// var_dump(4);
							$time_data[$val->te002][$val->te001][] = $val->te003;
						} else if ($temp_onwork_hr > $temp_kar_hr && $temp_kar_hr >= 13) {
							// var_dump(5);
							if ($temp_onwork_hr > $temp_kar_hr + 2) {
								// var_dump('5a');
								if ($temp_kar_hr + 2 <=  $temp_onwork_hr) {
									// var_dump('5aa');
									$time_data[$val->te002][$val->te001][] = $val->te003;
								} else {
									// var_dump('5ab');
									$time_data[$a_date][$val->te001][] = $val->te003;
								}
							} else {
								// var_dump('5b');
								$time_data[$val->te002][$val->te001][] = $val->te003;
							}
						} else if ($temp_onwork_hr == 24) {
							// var_dump(6);
							$time_data[$val->te002][$val->te001][] = $val->te003;
						} else if ($temp_onwork_hr == 22) {
							// var_dump(171);
							$time_data[$t_date][$val->te001][] = $val->te003;
						} else if ($temp_kar_hr <= $temp_offwork_hr + 4) {
							// var_dump('171e');
							$time_data[$t_date][$val->te001][] = $val->te003;
						}
					} else {
						$e_onwork_hr = substr($val->emo003, 0, 2); //特殊班 下班時
						$e_offwork_hr = substr($val->emo004, 0, 2); //特殊班 下班時
						// var_dump(7);
						if ($temp_kar_hr + 2 <= $e_onwork_hr) {
							// var_dump('7e1');
							$time_data[$t_date][$val->te001][] = $val->te003;
						} else {
							// var_dump('7e2');
							$time_data[$val->te002][$val->te001][] = $val->te003;
						}
					}
				} else { // 前一天有資料
					// var_dump(8);
					$ishave = '';
					if ($SE != 'E') {
						//從12小時制 改 8小時制
						// var_dump(9);
						if ($temp_kar_hr <= ($temp_offwork_hr + 4) && $temp_onwork_hr >= 22) { //打卡時間 <= 下班時間 才歸入
							// var_dump(10);

							if ($temp_kar_hr <= $temp_offwork_hr + 4) {
								// var_dump('10a');
								$time_data[$t_date][$val->te001][] = $val->te003;
							} else {
								// var_dump('10b');
								$time_data[$val->te002][$val->te001][] = $val->te003;
							}

							$ishave = '1';
						} else if ($temp_kar_hr >= ($temp_offwork_hr + 4) && $temp_kar_hr <= 13) {
							// var_dump(11);
							$time_data[$t_date][$val->te001][] = $val->te003;
							$ishave = '1';
						} else if ($temp_kar_hr <= $temp_offwork_hr + 4) { //因應8小時後的上班算加班
							// var_dump('9e');
							$time_data[$t_date][$val->te001][] = $val->te003;
							$ishave = '1';
						}

						if ($ishave == '') {
							//查兩天以上，就會產生 前一天已有資料
							if (!isset($time_data[$val->te002][$val->te001])) {
								// var_dump(12);
								if ($temp_kar_hr >=  ($temp_onwork_hr - 2)) { //提早上班時數
									// var_dump(13);
									$time_data[$val->te002][$val->te001][] = $val->te003;
								} else if ($temp_onwork_hr > $temp_kar_hr && $temp_kar_hr >= 18) { //為了一天2班設定 13=〉18
									// var_dump(14);
									$time_data[$val->te002][$val->te001][] = $val->te003;
								} else if ($temp_onwork_hr == 22) {
									// var_dump(19);
									if ($temp_kar_hr > $temp_onwork_hr) {
										// var_dump(201);
										$time_data[$val->te002][$val->te001][] = $val->te003;
									} else {
										// var_dump(202);
										$time_data[$t_date][$val->te001][] = $val->te003;
									}
								} else if ($temp_kar_hr <= $temp_onwork_hr) { //提前很多小時上班
									// var_dump('是怎麼會這樣提前的');
									$time_data[$val->te002][$val->te001][] = $val->te003;
								}
							} else if ($temp_onwork_hr >= 22) {
								// var_dump(20);

								if ($temp_kar_hr <= $temp_onwork_hr) {
									// var_dump(222);
									if ($temp_kar_hr >= $temp_offwork_hr + 4) { //因應8小時後的上班算加班
										// var_dump('222a');
										$time_data[$val->te002][$val->te001][] = $val->te003;
									} else {
										// var_dump('222b');
										$time_data[$t_date][$val->te001][] = $val->te003;
									}
								} else {
									// var_dump(223);
									$time_data[$t_date][$val->te001][] = $val->te003;
								}
							} else {
								$time_data[$val->te002][$val->te001][] = $val->te003;
							}
						}
					} else {
						// var_dump('15e');
						if (!isset($time_data[$t_date][$val->te001])) {
							// var_dump('15e1');
							$time_data[$val->te002][$val->te001][] = $val->te003;
						} else {
							$e_onwork_hr = substr($val->emo003, 0, 2); //特殊班 下班時
							$e_offwork_hr = substr($val->emo004, 0, 2); //特殊班 下班時
							// var_dump('15e2');
							if ($temp_kar_hr <= ($temp_offwork_hr + 4) && $temp_onwork_hr != 22) { //打卡時間 <= 下班時間 才歸入
								// var_dump('15e3');
								if ($temp_kar_hr + 1 >= $e_onwork_hr) {
									// var_dump('15e3a');
									$time_data[$val->te002][$val->te001][] = $val->te003;
								} else {
									// var_dump('15e3b');
									$time_data[$t_date][$val->te001][] = $val->te003;
								}
							} else {
								// var_dump('15e5');

								if ($temp_kar_hr + 2 <= $e_onwork_hr) {
									// var_dump('15e51');
									$time_data[$t_date][$val->te001][] = $val->te003;
								} else {
									// var_dump('15e52');
									$time_data[$val->te002][$val->te001][] = $val->te003;
								}
							}
						}
					}
				}
			} else {
				// var_dump(16);
				if ($SE != 'E') {

					// var_dump($SE);
					// time_data[依日期][工號] 加入刷卡資料------------------------------
					if ($temp_onwork_hr == 24) { //處理 0000~0800 上班打卡問題
						// var_dump(17);
						// var_dump($val->te002);
						if ($temp_kar_hr >=  13) {
							// var_dump(18);
							// var_dump($a_date);

							// $time_data[$a_date][$val->te001][] = $val->te003;
							$time_data[$val->te002][$val->te001][] = $val->te003;
						} else {
							// var_dump(21);
							// var_dump($t_date);
							if (($temp_offwork_hr + 4) >= $temp_kar_hr) {
								// var_dump(321);
								// $time_data[$val->te002][$val->te001][] = $val->te003;
								$time_data[$t_date][$val->te001][] = $val->te003;
							} else {
								// var_dump(322);
								// $time_data[$t_date][$val->te001][] = $val->te003;
								$time_data[$val->te002][$val->te001][] = $val->te003;
							}
						}
					} else {
						// var_dump(22);
						$time_data[$val->te002][$val->te001][] = $val->te003;
					}
				} else {
					$ishave = '';
					if ($temp_kar_hr + 2 >= $temp_onwork_hr && $temp_kar_hr <= $temp_offwork_hr + 2) { //正常上班時段
						// var_dump('16e');
						$time_data[$val->te002][$val->te001][] = $val->te003;
						$ishave = '1';
					}

					if ($ishave == '') {
						$e_onwork_hr = substr($val->emo003, 0, 2); //特殊班 下班時
						$e_offwork_hr = substr($val->emo004, 0, 2); //特殊班 下班時

						// var_dump('val->te002:' . $val->te002);
						// var_dump(31);
						if ($temp_kar_hr <= $e_offwork_hr) {
							// var_dump('31a');
							$time_data[$val->te002][$val->te001][] = $val->te003;
						} else if ($temp_kar_hr >= $e_onwork_hr) {
							// var_dump('31b');
							$time_data[$val->te002][$val->te001][] = $val->te003;
						} else {
							// var_dump('31c');
							$time_data[$a_date][$val->te001][] = $val->te003;
						}
					}
				}
			}
			// $time_data[$val->te002][$val->te001][] = $val->te003;
		}

		// echo "<pre>";
		// var_dump($temp_data);
		// exit;

		// 處理刷卡資料------------------------------------------------------------------------------------------
		$selected_date = array();
		$sort_me001 = array();
		foreach ($temp_data as $key => $val) {
			if ($val->te002) {
				$selected_date[$val->te002] = true;
			}	//偷存日期以供排序列表
			if ($val->me001) {
				$sort_me001[$val->me001] = $val->me001;
			} //偷存部門以供排序列表
			if (@$val->te002) {
				//依$data[日期][工號]塞入找到的$temp_tdata資料
				$data[$val->te002][$val->te001] = $val;
				if (@$time_data[$val->te002][$val->te001]) {

					//$data[日期][工號]中新增[te003]把刷卡資料塞入$time_data
					$data[$val->te002][$val->te001]->te003 = $time_data[$val->te002][$val->te001];
				}
			}
		}

		// echo "<pre>";
		// var_dump($selected_date);
		// exit;
		// 處理刷卡資料-end-$data---------------------------------------------------------------------------------------
		array_multisort($sort_me001, SORT_ASC, SORT_STRING); //對部門順序排列


		foreach ($temp_data as $key => $val) {
			foreach ($selected_date as $t_k => $t_v) {
				if (!@$data[$t_k][$val->te001]) {
					$data[$t_k][$val->te001] = clone $val; //複製物件需要加clone
					$data[$t_k][$val->te001]->te002 = $t_k;
					$data[$t_k][$val->te001]->te003 = array();
				}
			}
		}


		$sorted_data = array(); //重新排序，依照date->部門排序
		foreach ($sort_me001 as $key => $val) {
			foreach ($selected_date as $d_k => $d_v) {
				foreach ($data as $k => $v) {
					foreach ($v as $t_k => $t_v) {
						if ($t_v->te002 == $d_k && $t_v->me001 == $val) {
							$sorted_data[$d_k][$t_v->te001] = $t_v;
						}
					}
				}
			}
		}

		// echo "<pre>";var_dump($sorted_data);exit;

		if (!@$sorted_data) {
			$sorted_data = array();
		}
		// echo "<pre>";	var_dump($sorted_data);		exit;
		$result = $this->compute_status($sorted_data, $type);

		// echo "<pre>";var_dump($result);exit;

		$ret['rows'] = $result;
		$ret['total_num'] = $total_num;

		// $end_time = date("H") * 3600 + date("i") * 60 + date("s");
		// // $end_time2 = microtime(true);
		// echo "<pre>";
		// echo "start_time：" . $start_time . "秒<br />";
		// echo "end_time：" . $end_time . "秒<br />";
		// $time_total = $end_time - $start_time;
		// echo "前面處理，執行了：" . $time_total . "秒<br />";
		// exit;

		return $ret;
	}


	//欄位表頭排序流覽資料
	function search_bak($limit, $offset, $sort_by, $sort_order, $dateo, $datec, $type, $epyo, $epyc)
	{
		preg_match_all('/\d/S', $dateo, $matches);  //處理日期字串
		$dateo = implode('', $matches[0]);
		preg_match_all('/\d/S', $datec, $matches);  //處理日期字串
		$datec = implode('', $matches[0]);
		if (!@$dateo) {
			$dateo = date("Ymd");
		}
		if (!@$datec) {
			$datec = date("Ymd");
		}
		if ($dateo > $datec) {
			$temp = $dateo;
			$dateo = $datec;
			$datec = $temp;
			unset($temp);
		} //如果前者較小則對換
		if (strlen($dateo) != 8) {
			$dateo = substr($dateo, 0, 6) . "0" . substr($dateo, 6, 1);
		}
		if (strlen($datec) != 8) {
			$datec = substr($datec, 0, 6) . "0" . substr($datec, 6, 1);
		}
		$sort_order = (substr($sort_order, 0, 3) == 'asc') ? 'asc' : 'desc';
		$sort_columns = array('te001', 'te002', 'me001', 'me002', 'create_date', 'modifier', 'modi_date', 'creator');
		$sort_by = (in_array($sort_by, $sort_columns)) ? $sort_by : 'me001';  //檢查排序欄位是否在 table 內

		$sql = "SELECT IFNULL(c.me001,'') as me001,IFNULL(c.me002,'') as me002,a.mv001 as te001,a.mv002,a.mv027,d.mo002, d.mo003, d.mo004, d.mo005, d.mo006, a.mv021, a.mv022 
				FROM cmsmv as a
				LEFT JOIN cmsme as c ON a.mv004 = c.me001
				LEFT JOIN palmo as d ON a.mv027 = d.mo001 
				WHERE (a.mv022='' or a.mv022 IS NULL or a.mv022 >= '" . $dateo . "') and a.mv026='Y' ";
		if (@$epyo != "") {
			$sql .= " and a.mv001 >= '" . $epyo . "'";
		}
		if (@$epyc != "") {
			$sql .= " and a.mv001 <= '" . $epyc . "'";
		}
		$sql .= " ORDER BY a.mv004 asc, a.mv021 asc";

		$query = $this->db->query($sql);
		$epy['rows'] = $query->result();
		$epy_data = array();
		foreach ($epy['rows'] as $t_k => $t_v) {
			$epy_data[$t_v->te001] = $t_v;
		}
		$total_num = count($epy_data);
		$sql = "SELECT IFNULL(c.me001,'') as me001,IFNULL(c.me002,'') as me002,a.mv001 as te001,a.mv002,a.mv027,IFNULL(b.te002,'') as te002, COUNT(b.te003) as c_te003, b.create_date, b.modi_date as modi_date, d.mo002, d.mo003, d.mo004, d.mo005, d.mo006, a.mv021, a.mv022 
				FROM cmsmv as a
				LEFT JOIN palte2 as b ON a.mv001 = b.te001 and b.te002 >= '" . $dateo . "' and b.te002 <= '" . $datec . "'";
		if (@$epyo != "") {
			$sql .= " and b.te001 >= '" . $epyo . "'";
		}
		if (@$epyc != "") {
			$sql .= " and b.te001 <= '" . $epyc . "'";
		}
		$sql .= "LEFT JOIN cmsme as c ON a.mv004 = c.me001
				LEFT JOIN palmo as d ON a.mv027 = d.mo001 
				WHERE (a.mv022='' or a.mv022 IS NULL or a.mv022 >= '" . $dateo . "') and a.mv026='Y'
				GROUP BY mv001 , te002
				ORDER BY b.te002 asc, a.mv004 asc, a.mv021 asc";

		$query = $this->db->query($sql);
		$ret['rows'] = $query->result();

		$temp_data = $ret['rows'];

		$sql = "SELECT `te001`,`te002`,`te003` FROM `palte2` where te002 >= '" . $dateo . "' and te002 <= '" . $datec . "'";
		if (@$epyo != "") {
			$sql .= " and te001 >= '" . $epyo . "'";
		}
		if (@$epyc != "") {
			$sql .= " and te001 <= '" . $epyc . "'";
		}
		$query = $this->db->query($sql);
		$temp_tdata = $query->result();
		foreach ($temp_tdata as $key => $val) {
			$time_data[$val->te002][$val->te001][] = $val->te003;
		}
		$selected_date = array();
		$sort_me001 = array();
		foreach ($temp_data as $key => $val) {
			if ($val->te002) {
				$selected_date[$val->te002] = true;
			}	//偷存日期列表
			if ($val->me001) {
				$sort_me001[$val->me001] = $val->me001;
			} //偷存部門列表
			if (@$val->te002) {
				$data[$val->te002][$val->te001] = $val;
				if (@$time_data[$val->te002][$val->te001]) {
					$data[$val->te002][$val->te001]->te003 = $time_data[$val->te002][$val->te001];
				}
			}
		}
		array_multisort($sort_me001, SORT_ASC, SORT_STRING); //對部門順序排列

		foreach ($epy_data as $key => $val) {
			foreach ($selected_date as $t_k => $t_v) {
				if (!@$data[$t_k][$val->te001]) {
					$data[$t_k][$val->te001] = clone $val; //複製物件需要加clone
					$data[$t_k][$val->te001]->te002 = $t_k;
					$data[$t_k][$val->te001]->te003 = array();
				}
			}
		}

		$sorted_data = array(); //重新排序，依照date->部門排序
		foreach ($sort_me001 as $key => $val) {
			foreach ($selected_date as $d_k => $d_v) {
				foreach ($data as $k => $v) {
					foreach ($v as $t_k => $t_v) {
						if ($t_v->te002 == $d_k && $t_v->me001 == $val) {
							$sorted_data[$d_k][$t_v->te001] = $t_v;
						}
					}
				}
			}
		}
		//echo "<pre>";var_dump($sorted_data);exit;
		//echo "<pre>";var_dump($data);exit;

		if (!@$sorted_data) {
			$sorted_data = array();
		}
		$result = $this->compute_status($sorted_data, $type);

		$ret['rows'] = $result;
		$ret['total_num'] = $total_num;

		//echo "<pre>";var_dump($result);exit;

		return $ret;
	}


	//查詢一筆 修改用   
	function selone($seq1, $seq2)
	{
		$this->db->select('a.*, b.mv002,b.mv004,b.mv027,c.me001, c.me002,d.mo001,d.mo002,d.mo003,d.mo004,d.mo005');
		$this->db->from('paltf as a');
		$this->db->join('cmsmv as b', 'a.tf001 = b.mv001 ', 'left');
		$this->db->join('cmsme as c', 'b.mv004 = c.me001 ', 'left');
		$this->db->join('palmo as d', 'b.mv027 = d.mo001 ', 'left');
		$this->db->where('a.tf002', $seq1);
		$this->db->where('c.me001', $seq2);

		$query = $this->db->get();
		if ($query->num_rows() > 0) {
			$result = $query->result();
			return $result;
		}
	}


	//查新增資料是否重複 
	function selone1($seg1, $seg2, $seg3)
	{
		$this->db->where('te001', $seg1);
		$this->db->where('te002', $seg2);
		$this->db->where('te003', $seg3);
		$query = $this->db->get('palte');
		return $query->num_rows();
	}

	//新增多筆	
	function insertf($te001, $te002, $te003)
	{
		$data = array(
			'company' => $this->session->userdata('syscompany'),
			'creator' => $this->session->userdata('manager'),
			'usr_group' => 'A100',
			'create_date' => date("Ymd"),
			'modifier' => '',
			'modi_date' => '',
			'flag' => 0,
			'te001' => $te001,
			'te002' => $te002,
			'te003' => $te003
		);
		$exist = $this->pali56_model->selone1($te001, $te002, $te003);
		if ($exist) {
			return false;
		} else if ($this->db->insert('palte', $data)) {
			//新增 palte 異動碼(N/Y)-----------------------------
			$sql97 = " update palte set te008='Y' where te001='$te001' and te002='$te002' ";
			$this->db->query($sql97);

			//end--新增 palte 異動碼(N/Y)------------------------
			return true;
		} else {
			return false;
		}
	}

	//查複製資料是否重複	 
	function selone2($seg2, $seg4)
	{
		$this->db->where('te001', $seg2);
		$this->db->where('te002', $seg4);
		$query = $this->db->get('palte');
		return $query->num_rows();
	}

	//轉excel檔	 
	function excelnewf()
	{
		$seq1 = $this->input->post('tf001o');    //查詢一筆以上
		$seq2 = $this->input->post('tf001c');
		$seq3 = substr($this->input->post('tf002o'), 0, 4) . substr($this->input->post('tf002o'), 5, 2);
		$seq4 = substr($this->input->post('tf002c'), 0, 4) . substr($this->input->post('tf002c'), 5, 2);

		$sql1 = " SELECT a.tf001,b.mv002 as tf001disp,b.mv004 as tf001disp1,c.me002 as tf001disp2,a.tf002,a.tf003, a.tf010,a.tf011,a.tf012,a.tf013,a.tf014,a.tf015,a.tf016 ";
		$sql2 = " FROM paltf as a LEFT JOIN cmsmv as b ON  a.tf001=b.mv001 LEFT JOIN cmsme as c ON b.mv004=c.me001 ";
		$sql3 = " WHERE a.tf001 >= '$seq1'  AND a.tf001 <= '$seq2' AND  a.tf002 >= '$seq3'  AND a.tf002 <= '$seq4' ";
		$sql = $sql1 . $sql2 . $sql3;
		$query = $this->db->query($sql);
		return $query->result_array();
	}

	//印明細表	
	function printfd()
	{
		$seq1 = $this->input->post('tf001o');    //查詢一筆以上
		$seq2 = $this->input->post('tf001c');
		$seq3 = substr($this->input->post('tf002o'), 0, 4) . substr($this->input->post('tf002o'), 5, 2) . substr($this->input->post('tf002o'), 8, 2);
		$seq4 = substr($this->input->post('tf002c'), 0, 4) . substr($this->input->post('tf002c'), 5, 2) . substr($this->input->post('tf002c'), 8, 2);

		$sql1 = " SELECT a.*,b.mv002 as tf001disp,b.mv004 as tf001disp1,c.me002 as tf001disp2 ";
		$sql2 = " FROM paltf as a LEFT JOIN cmsmv as b ON  a.tf001=b.mv001 LEFT JOIN cmsme as c ON b.mv004=c.me001 ";
		$sql3 = " WHERE a.tf001 >= '$seq1'  AND a.tf001 <= '$seq2' AND  a.tf002 >= '$seq3'  AND a.tf002 <= '$seq4' ";
		$sql = $sql1 . $sql2 . $sql3;
		$query = $this->db->query($sql);
		$ret['rows'] = $query->result();
		$seq32 = "tf001 >= '$seq1'  AND tf001 <= '$seq2' AND  tf002 >= '$seq3'  AND tf002 <= '$seq4' ";
		$query = $this->db->select('COUNT(*) as count', FALSE)  //筆數查詢,如果設為FALSE不會使用反引號保護你的字段或者表名
			->from('paltf')
			->where($seq32);
		$num = $query->get()->result();
		$ret['num_rows'] = $num[0]->count;
		return $ret;
	}

	//更改一筆
	function updatef($te001, $te002, $te003, $te003_origin)   //更改一筆
	{
		$data = array(
			'modifier' => $this->session->userdata('manager'),
			'modi_date' => date("Ymd"),
			'te003' => $te003
		);
		$this->db->where('te001', $te001);
		$this->db->where('te002', $te002);
		$this->db->where('te003', $te003_origin);
		$this->db->update('palte', $data);                   //更改一筆

		if ($this->db->affected_rows() > 0) {
			//新增 palte 異動碼(N/Y)-----------------------------
			$sql97 = " update palte set te008='Y' where te001='$te001' and te002='$te002' ";
			$this->db->query($sql97);

			//end--新增 palte 異動碼(N/Y)------------------------
			return TRUE;
		}
		if ($te003 == $te003_origin) {
			return TRUE;
		}
		return FALSE;
	}

	//刪除一筆
	function deletef($te001, $te002, $te003)
	{
		$this->db->where('te001', $te001);
		$this->db->where('te002', $te002);
		$this->db->where('te003', $te003);
		$this->db->delete('palte');
		if ($this->db->affected_rows() > 0) {
			//新增 palte 異動碼(N/Y)-----------------------------
			$sql97 = " update palte set te008='Y' where te001='$te001' and te002='$te002' ";
			$this->db->query($sql97);

			//end--新增 palte 異動碼(N/Y)------------------------
			return TRUE;
		}
		return FALSE;
	}

	//選取刪除多筆
	function delmutif($seq1, $seq2)
	{
		foreach ($seq1 as $key => $val) {
			// $temp_tf001 = $this->get_depart($seq2[$key]);
			$temp_tf001 = $seq2[$key];
			if ($temp_tf001) {
				foreach ($temp_tf001[$seq2[$key]] as $k => $v) {
					$this->db->where('tf001', $v);
					$this->db->where('tf002', $seq1[$key]);
					$this->db->delete('paltf');
				}
			}
		}
		if ($this->db->affected_rows() > 0) {
			return TRUE;
		}
		return FALSE;
	}

	function recoverf($te001, $te002)
	{
		$this->db->where('te001', $te001);
		$this->db->where('te002', $te002);
		$this->db->delete('palte');
		//修改------------
		$this->db->where('te003', $te001);
		$this->db->where('te007', $te002);
		$query = $this->db->get('palte2');
		$data = $query->result();
		$total = count($data);
		$count = 0;
		foreach ($data as $key => $val) {

			// 上傳刷卡資料 palte
			$this->db->select('mv001,mv028');    	//mv001 員工代號,mv002 員工姓名,mv004 部門代號,mv027 班別代號, mv028 刷卡卡號
			$this->db->from('cmsmv');				//cmsmv 員工基本資料檔
			$this->db->where('mv001', $te001);			//mv001 員工代號
			$temp_ary1 = $this->db->get()->result_array();
			if (count($temp_ary1) == 1) {

				$data = array(
					'company' => $this->session->userdata('syscompany'),
					'creator' => $val->creator,
					'usr_group' => 'A100',
					'create_date' => $val->create_date,
					'modifier' => $val->modifier,
					'modi_date' => $val->modi_date,
					'flag' => 0,
					'te001' => $val->te003,		//te001 員工代號
					'te002' => $val->te007,		//te002 刷卡日期
					'te003' => $val->te006,		//te003 刷卡時間
					'te004' => $temp_ary1[0]['mv028'],	//te004 臨時卡號   6
					'te005' => 'N',		//te005 產生明細
					'te006' => $val->te007,	//te006 歸屬日期     8
					'te007' => 'R', 	//te007 功能碼  1
					'te008' => 'Y'      //異動碼(N/Y)

				);
				$exist = $this->pali56_model->selone1($val->te003, $val->te007, $val->te006);
				if ($exist) {
					continue;
				} else {
					$this->db->insert('palte', $data);
					if ($this->db->affected_rows() > 0) {
						$count++;
					}
				}
			}
		}
		if ($count > 0) {
			return "成功 " . $count . "筆 共應 " . $total . "筆";
		} else {
			return FALSE;
		}
	}

	/***自動判斷出勤狀態***/
	/*
	
	*/
	function compute_status($day_data, $type)
	{
		/***參數列表***/
		$return_data = $day_data;
		$today = date("Ymd");
		$leave_data = array();
		$leave_class_hr = array(
			'tg006' => "事",
			'tg007' => "病",
			'tg008' => "年", //"特"->"年"
			'tg010' => "無薪",
			'tg024' => "出差",
			'tg004' => "已審核"
		);
		$leave_class_day = array(
			'tg009' => "喪",
			'tg011' => "產",
			'tg012' => "陪產",
			'tg013' => "婚",
			'tg014' => "公傷",
			'tg016' => "公",
			'tg201' => "產檢",
			'tg202' => "生理",
			'tg203' => "補休"
		);
		$over_data = array();
		$over_class_hr = array(
			'tf006' => "計時加班",
			'tf010' => "平日加班",
			'tf012' => "六日加班",
			'tf014' => "國定加班"
		);

		$start_time = date("H") * 3600 + date("i") * 60 + date("s");
		// $start_time2 = microtime(true);

		foreach ($day_data as $day_key => $day_val) {		//每天 一天一天處理 $day_key => $day_val

			/**取得一些資料(以天為計的資料)**/
			$week = date("w", mktime(0, 0, 0, substr($day_key, 4, 2), substr($day_key, 6, 2), substr($day_key, 0, 4))); //判斷平日六日假日

			//當日請假資料 $temp_data
			$temp_data = $this->get_leave($day_key);
			// $temp_data = $this->get_leave(20220225);
			foreach ($temp_data as $key => $val) {
				foreach ($val as $k => $v) {
					if ($v)
						$leave_data[$day_key][$val->tg001][$k] = $v; //取用結果$leave_data['日期']['員編']
				}
			}


			//當日加班資料 $temp_data
			$temp_data = $this->get_over($day_key);
			// $temp_data = $this->get_over(20220225);
			foreach ($temp_data as $key => $val) {
				foreach ($val as $k => $v) {
					if ($v)
						$over_data[$day_key][$val->tf001][$k] = $v; //取用結果$work_overtime['日期']['員編']
				}
			}

			// echo "<pre>";var_dump($day_val);exit;
			/***開始判斷
			$day_key=日期
			$day_val=日期的資料
			$epy_key=員工編號
			$epy_val=員工資料
			 **/
			foreach ($day_val as $epy_key => $epy_val) {				//每位員工 $epy_key => $epy_val
				/**參數列表**/
				$year_late_time = $epy_val->mo006;					//年遲到時間 $year_late_time
				$on_time = $epy_val->mo003;							//上班時間，到+5分鐘的時間點之間是遲到，超過等於曠職 $on_time
				$on_time_hr = substr($on_time, 0, 2);
				$on_time_mn = substr($on_time, 2, 2); 				//上班時、分 $on_time_hr $on_time_mn
				$off_time = $epy_val->mo004;						//下班時間 $off_time
				$off_time_hr = substr($off_time, 0, 2);
				$off_time_mn = substr($on_time, 2, 2); 				//下班時、分 $off_time_hr $off_time_mn
				$half_hr = $epy_val->mo008;							//連班休息時間30分鐘，不連班休息時間60分鐘
				$class = $epy_val->mo001;							//班別
				$change = $epy_val->te008;							//異動碼(N/Y)

				$SE = $epy_val->mt005;
				if ($SE == 'N') {										//特殊班
					$SE = $this->check_SE($epy_key, $epy_val->te002);
				}

				$com_time_hr = $epy_val->mo009;						//上班時數
				// $noon_time_hr = "12";
				// $noon_time_mn = "00";			//12:00
				// $aftnoon_time_hr = "13";
				// $aftnoon_time_mn = "00";	//13:00
				if (!@$epy_val->te003) {
					//$return_data[$day_val][$epy_key]->te003 = array();
					$punch_data = array();
					$punch_count = count($punch_data);
				} else {
					$punch_data = $epy_val->te003;					//刷卡資料 $punch_data
					// sort($punch_data, SORT_NATURAL | SORT_FLAG_CASE); //尚不清楚有無排序問題
					$punch_count = count($punch_data);				//刷卡資料筆數 $punch_count
				}

				// //計算時制： 8 時制、 12 時制-----------------------------
				// if ($on_time_hr > $off_time_hr) {
				// 	$com_time_hr = $on_time_hr - $off_time_hr; //計算時制： 8 時制、 12 時制
				// } else {
				// 	$com_time_hr = $off_time_hr - $on_time_hr;
				// }
				// if ($com_time_hr <= 9) {
				// 	$com_time_hr = 8;
				// } else {
				// 	$com_time_hr = 12;
				// }
				// //計算時制： 8 時制、 12 時制-----end------------------------

				$return_data[$day_key][$epy_key]->status = array();	//預先宣告狀態與請假曠職資訊
				$return_data[$day_key][$epy_key]->leave_hr = 0;
				$return_data[$day_key][$epy_key]->absenteeism_hr = 0;
				$return_data[$day_key][$epy_key]->status['absenteeism'] = "";
				$return_data[$day_key][$epy_key]->over_hr = 0;
				$absenteeism_hr = 0;
				//判斷行事曆是否是例假日-----true 例假日----------------
				$week_kind = $this->check_holiday($day_key);
				$check_hoiday = ($week_kind == 1) ? true : false;

				//判斷班別是否是休息week ----true 休息-------------------
				$check_week = (strpos($return_data[$day_key][$epy_key]->mo007, $week) === false) ? true : false;

				if ($week_kind == 3) { //調班上班
					$check_week = false;
				}
				if ($week_kind == 2) { //六日休假
					$check_week = true;
				}
				if ($week_kind == 1) { //國定假日休假
					$check_week = true;
				}

				$have_pal = 0; //初始不需請假
				/**/
				if ($change == 'Y') {
					//先刪除--------------palte3---------------------------------
					$sql = " DELETE FROM palte3 WHERE te001='$epy_key' AND te002='$day_key' ";
					$this->db->query($sql);	//記錄曠職未請假 palte3
					// $this->db->where('te001', $epy_key);
					// $this->db->where('te002', $day_key);
					// $this->db->delete('palte3'); //記錄曠職未請假 palte3

					//先刪除--------------palte6---------------------------------
					$sql = " DELETE FROM palte6 WHERE te001='$epy_key' AND te002='$day_key' ";
					$this->db->query($sql); //記錄上班時數，以便累計 palte6

					// $this->db->where('te001', $epy_key);
					// $this->db->where('te002', $day_key);
					// $this->db->delete('palte6'); //記錄上班時數，以便累計 palte6

					//先刪除--------------palte7---------------------------------
					$sql = " DELETE FROM palte7 WHERE te001='$epy_key' AND te002='$day_key' ";
					$this->db->query($sql); //備份pali56查詢結果 palte7

					// $this->db->where('te001', $epy_key);
					// $this->db->where('te002', $day_key);
					// $this->db->delete('palte7'); //備份pali56查詢結果 palte7
				}

				// echo "<pre>";var_dump($epy_val);exit;


				//未到職處理--------------------------------
				if ($epy_val->mv021 > $day_key) {
					$return_data[$day_key][$epy_key]->status['error'] = substr($epy_val->mv021, 0, 4) . "/" . substr($epy_val->mv021, 4, 2) . "/" . substr($epy_val->mv021, 6, 2) . " 到職";
					if ($punch_count == 0 && ($check_hoiday || $check_week)) {
						unset($return_data[$day_key][$epy_key]);
						continue;
					}
					continue;
				}
				//未到職處理--end------------------------------

				//已離職處理--------------------------------------
				if ($epy_val->mv022 && $epy_val->mv022 < $day_key) {
					$return_data[$day_key][$epy_key]->status['error'] = substr($epy_val->mv022, 0, 4) . "/" . substr($epy_val->mv022, 4, 2) . "/" . substr($epy_val->mv022, 6, 2) . " 離職";
					if ($punch_count == 0 && ($check_hoiday || $check_week)) {
						unset($return_data[$day_key][$epy_key]);
						continue;
					}
					continue;
				}
				//已離職處理--end------------------------------------


				//請假判斷區域-------------------依上面定義假別放入資訊---------------
				$return_data[$day_key][$epy_key]->status['leave'] = "";
				if (@$leave_data[$day_key][$epy_key]) {
					foreach ($leave_class_hr as $l_k => $l_v) {
						if (@$leave_data[$day_key][$epy_key][$l_k]) {
							$return_data[$day_key][$epy_key]->leave_hr += $leave_data[$day_key][$epy_key][$l_k];
							if ($l_v != "已審核") {
								$return_data[$day_key][$epy_key]->status['leave'] .= $leave_data[$day_key][$epy_key][$l_k] . "小時" . $l_v;
							}
							if ($l_v == "年") { //"特"->"年"
								$return_data[$day_key][$epy_key]->status['leave'] .= "休 ";
							} else if ($l_v == "出差") {
								$return_data[$day_key][$epy_key]->status['leave'] .= " ";
							} else if ($l_v == "已審核") {
								$return_data[$day_key][$epy_key]->status['leave'] .= " " . $l_v;
							} else {
								$return_data[$day_key][$epy_key]->status['leave'] .= "假 ";
							}
						}
						$have_pal = $have_pal - 1; //已請假
					}
					foreach ($leave_class_day as $l_k => $l_v) {
						if (@$leave_data[$day_key][$epy_key][$l_k]) {
							$return_data[$day_key][$epy_key]->leave_hr += $leave_data[$day_key][$epy_key][$l_k] * 8;
							$return_data[$day_key][$epy_key]->status['leave'] .= $leave_data[$day_key][$epy_key][$l_k] . "天" . $l_v . "假 ";
							$have_pal = $have_pal - 1; //已請假
						}
					}
				}
				//請假判斷區域---end----------------依上面定義假別放入資訊---------------

				//加班判斷區域-------------------依上面定義加班放入資訊---------------
				$return_data[$day_key][$epy_key]->status['over'] = "";
				if (@$over_data[$day_key][$epy_key]) {
					foreach ($over_class_hr as $l_k => $l_v) {
						if (@$over_data[$day_key][$epy_key][$l_k]) {
							$return_data[$day_key][$epy_key]->over_hr += $over_data[$day_key][$epy_key][$l_k];
							$return_data[$day_key][$epy_key]->status['over'] .= $over_data[$day_key][$epy_key][$l_k] . "小時" . $l_v;
						}
					}
				}
				//加班判斷區域---end----------------依上面定義假別放入資訊---------------



				//進出不平衡
				if ($punch_count > 0 && $punch_count % 2 != 0 && $day_key != $today) {
					$return_data[$day_key][$epy_key]->status['error'] = "進出不平衡";

					if ($punch_count == 0 && ($check_hoiday || $check_week)) {
						unset($return_data[$day_key][$epy_key]);

						//--新增 -------備份pali56查詢結果 palte7--------------------------------------
						$valte004 = '';
						$valte005 = '';
						if (isset($return_data[$day_key][$epy_key]->te003)) {
							for ($i = 0; $i < count($return_data[$day_key][$epy_key]->te003); $i++) {
								$valte004 = $valte004 . $return_data[$day_key][$epy_key]->te003[$i] . ' ';
							}
						}
						if (isset($return_data[$day_key][$epy_key]->status['late'])) {
							$valte005 = $valte005 . $return_data[$day_key][$epy_key]->status['late'];
						}
						if (isset($return_data[$day_key][$epy_key]->status['absenteeism'])) {
							$valte005 = $valte005 . $return_data[$day_key][$epy_key]->status['absenteeism'];
						}
						if (isset($return_data[$day_key][$epy_key]->status['leave'])) {
							$valte005 = $valte005 . $return_data[$day_key][$epy_key]->status['leave'];
						}
						if ($change == 'Y') {
							$data7 = array(
								'company' => 'YJ',		//$this->session->userdata('syscompany')
								'creator' => $this->session->userdata('manager'),
								'usr_group' => 'A100',
								'create_date' => date("Ymd"),
								'modifier' => ' ',
								'modi_date' => ' ',
								'flag' => 0,
								'te001' => $epy_key,	//te001 員工代號    10
								'te002' => $day_key,	//te002 刷卡日期      8
								'te003' => $epy_val->mv028,	//te003 臨時卡號   10
								'te004' => $valte004,	//te004 刷卡時間   varchar 50
								'te005' => $valte005	//te005 狀態   varchar 50
							);
							$this->db->insert('palte7', $data7);
						}
						//-end--新增 -------備份pali56查詢結果 palte7--------------------------------------

						continue;
					}

					//--新增 -------備份pali56查詢結果 palte7--------------------------------------
					$valte004 = '';
					$valte005 = '';
					if (isset($return_data[$day_key][$epy_key]->te003)) {
						for ($i = 0; $i < count($return_data[$day_key][$epy_key]->te003); $i++) {
							$valte004 = $valte004 . $return_data[$day_key][$epy_key]->te003[$i] . ' ';
						}
					}
					if (isset($return_data[$day_key][$epy_key]->status['late'])) {
						$valte005 = $valte005 . $return_data[$day_key][$epy_key]->status['late'];
					}
					if (isset($return_data[$day_key][$epy_key]->status['absenteeism'])) {
						$valte005 = $valte005 . $return_data[$day_key][$epy_key]->status['absenteeism'];
					}
					if (isset($return_data[$day_key][$epy_key]->status['leave'])) {
						$valte005 = $valte005 . $return_data[$day_key][$epy_key]->status['leave'];
					}
					if ($change == 'Y') {
						$data7 = array(
							'company' => $this->session->userdata('syscompany'),
							'creator' => $this->session->userdata('manager'),
							'usr_group' => 'A100',
							'create_date' => date("Ymd"),
							'modifier' => ' ',
							'modi_date' => ' ',
							'flag' => 0,
							'te001' => $epy_key,	//te001 員工代號    10
							'te002' => $day_key,	//te002 刷卡日期      8
							'te003' => $epy_val->mv028,	//te003 臨時卡號   10
							'te004' => $valte004,	//te004 刷卡時間   varchar 50
							'te005' => $valte005	//te005 狀態   varchar 50
						);
						$this->db->insert('palte7', $data7);
					}
					//-end--新增 -------備份pali56查詢結果 palte7--------------------------------------

					continue;
				}

				// if ($punch_count > 0 && $punch_count < 4 && $day_key != $today) { //忘刷休息卡
				// 	$return_data[$day_key][$epy_key]->status['forgot'] = "忘刷休息卡";
				// }


				if ($punch_count == 0 && !$check_hoiday && !$check_week && $SE == 'N') {
					$return_data[$day_key][$epy_key]->absenteeism_hr = $com_time_hr; //完全沒來就是曠職八小時 依上班時數
					$return_data[$day_key][$epy_key]->status['absenteeism'] .= "曠" . $com_time_hr . "小時";
					$have_pal = $have_pal + 1; //有曠職
					if ($type == "C") {
						if ($return_data[$day_key][$epy_key]->absenteeism_hr == 0 && !@$return_data[$day_key][$epy_key]->status['error']) {
							unset($return_data[$day_key][$epy_key]);
						} else if ($return_data[$day_key][$epy_key]->absenteeism_hr - $return_data[$day_key][$epy_key]->leave_hr == 0 && !@$return_data[$day_key][$epy_key]->status['error']) {
							unset($return_data[$day_key][$epy_key]);
						}
					}

					//--新增 -------記錄曠職未請假--------------------------------------
					if ($change == 'Y') {
						if ($have_pal > 0) { //表示有曠職未請假
							$data3 = array(
								'company' => $this->session->userdata('syscompany'),
								'creator' => $this->session->userdata('manager'),
								'usr_group' => 'A100',
								'create_date' => date("Ymd"),
								'modifier' => ' ',
								'modi_date' => ' ',
								'flag' => 0,
								'te001' => $epy_key,	//te001 員工代號    10
								'te002' => $day_key,	//te002 刷卡日期      8
								'te003' => $epy_val->mv028,	//te003 臨時卡號   10
								'te004' => $return_data[$day_key][$epy_key]->status['absenteeism']	//te004 狀態   255
							);
							$this->db->insert('palte3', $data3);
						}
					}
					//-end--新增 -------記錄曠職未請假--------------------------------------

					//--新增 -------備份pali56查詢結果 palte7--------------------------------------
					$valte004 = '';
					$valte005 = '';
					if (isset($return_data[$day_key][$epy_key]->te003)) {
						for ($i = 0; $i < count($return_data[$day_key][$epy_key]->te003); $i++) {
							$valte004 = $valte004 . $return_data[$day_key][$epy_key]->te003[$i] . ' ';
						}
					}
					if (isset($return_data[$day_key][$epy_key]->status['late'])) {
						$valte005 = $valte005 . $return_data[$day_key][$epy_key]->status['late'];
					}
					if (isset($return_data[$day_key][$epy_key]->status['absenteeism'])) {
						$valte005 = $valte005 . $return_data[$day_key][$epy_key]->status['absenteeism'];
					}
					if (isset($return_data[$day_key][$epy_key]->status['leave'])) {
						$valte005 = $valte005 . $return_data[$day_key][$epy_key]->status['leave'];
					}
					if ($change == 'Y') {
						$data7 = array(
							'company' => $this->session->userdata('syscompany'),
							'creator' => $this->session->userdata('manager'),
							'usr_group' => 'A100',
							'create_date' => date("Ymd"),
							'modifier' => ' ',
							'modi_date' => ' ',
							'flag' => 0,
							'te001' => $epy_key,	//te001 員工代號    10
							'te002' => $day_key,	//te002 刷卡日期      8
							'te003' => $epy_val->mv028,	//te003 臨時卡號   10
							'te004' => $valte004,	//te004 刷卡時間   varchar 50
							'te005' => $valte005	//te005 狀態   varchar 50
						);
						$this->db->insert('palte7', $data7);
					}
					//-end--新增 -------備份pali56查詢結果 palte7--------------------------------------


					if (!$change) {
						$sql96 = " select * from palte7 where te001='$epy_key' and te002='$day_key' ";
						$query = $this->db->query($sql96);


						if ($query->num_rows() == 0) {
							$data7 = array(
								'company' => $this->session->userdata('syscompany'),
								'creator' => $this->session->userdata('manager'),
								'usr_group' => 'A100',
								'create_date' => date("Ymd"),
								'modifier' => ' ',
								'modi_date' => ' ',
								'flag' => 0,
								'te001' => $epy_key,	//te001 員工代號    10
								'te002' => $day_key,	//te002 刷卡日期      8
								'te003' => $epy_val->mv028,	//te003 臨時卡號   10
								'te004' => $valte004,	//te004 刷卡時間   varchar 50
								'te005' => $valte005	//te005 狀態   varchar 50
							);
							$this->db->insert('palte7', $data7);
						} else {
							$sql99 = " update palte7 set te003='$epy_val->mv028', te004='$valte004', te005='$valte005' where te001='$epy_key' and te002='$day_key' ";
							$this->db->query($sql99);
						}

						//end--新增 palte 異動碼(N/Y)------------------------
					}
					//-end--新增 -------備份pali56查詢結果 palte7--------------------------------------

					continue;
				}
				// else if ($punch_count == 0 && ($check_hoiday || !$check_week)) { //修改 week休息無刷卡==〉不印出來
				// 	unset($return_data[$day_key][$epy_key]);
				// 	continue;
				// }
				// }


				//----計算是否遲到、早退------------------------------------------
				if ($punch_count != 0 && !$check_hoiday && !$check_week && $SE == 'N') {
					$return_data[$day_key][$epy_key]->compute_times = array();
					foreach ($punch_data as $key => $val) {
						// echo "<pre>";var_dump($punch_data);	exit;
						$current_status = 0;									//初始化參數 $current_status 1是進廠 0是離廠
						if ($key == 0) {
							//--新增 -------記錄上班時數，以便累計--------------------------------------
							if ($change == 'Y') {
								if (!($check_hoiday || $check_week)) { //表示有曠職未請假
									$data6 = array(
										'company' => $this->session->userdata('syscompany'),
										'creator' => $this->session->userdata('manager'),
										'usr_group' => 'A100',
										'create_date' => date("Ymd"),
										'modifier' => ' ',
										'modi_date' => ' ',
										'flag' => 0,
										'te001' => $epy_key,	//te001 員工代號    10
										'te002' => $day_key,	//te002 刷卡日期      8
										'te003' => $epy_val->mv028,	//te003 臨時卡號   10
										'te004' => $com_time_hr	//te004 時數   int 依上班時數
									);
									$this->db->insert('palte6', $data6);
								}
							}
							//-end--新增 -------記錄上班時數，以便累計--------------------------------------
						}
						if ($key % 2 == 0) {
							$current_status = 1;
						}
						if ($key % 2 == 1) {
							$current_status = 0;
						}	//偶數進廠，奇數離廠  因為key"0"是第一個
						$val_hr = substr($val, 0, 2);
						$val_mn = substr($val, 2, 2);	//切出每個時間點的時和分

						if ($key == 0) {								// $key= 0是進廠  進入要往後
							if ($val_mn > '30') {
								$val_hr++;
								$val_mn = "00";
							} else if ($val_mn == '00') {
								$val_mn = "00";
							} else {
								$val_mn = "30";
							}
						} else if ($key == (count($punch_data) - 1)) {		// $key= 最後一筆 是離廠 離開要拉前
							if ($val_mn > '30') {
								$val_mn = "30";
							} else if ($val_mn < '30' && $val_mn > '00') {
								$val_mn = "00";
							}
						}
						//else {
						// 	//中間刷卡======================
						// 	if ($current_status == 0) {								// $current_status  0是離廠 離開要拉前 進入要往後
						// 		if ($val_mn > 30) {
						// 			$val_mn = "30";
						// 		} else if ($val_mn < 30) {
						// 			$val_mn = "00";
						// 		}
						// 	}
						// 	if ($current_status == 1) {								// $current_status 1是進廠 進入要往後
						// 		if ($val_mn > 30) {
						// 			$val_hr++;
						// 			$val_mn = "00";
						// 		} else if ($val_mn < 30 && $val_mn > 0) {
						// 			$val_mn = "30";
						// 		}
						// 	}
						// 	//中間刷卡=======end===============
						// }


						$return_data[$day_key][$epy_key]->compute_times[] = $val_hr . $val_mn;
						if ($key == 0) {											//最先前一筆，當作上班打卡，判斷遲到
							if ($current_status != 1) {
								$return_data[$day_key][$epy_key]->status['error'] = "系統錯誤，請聯絡工程師!";
								continue;
							}
							if ($on_time > $val && $val > $year_late_time) {
								$return_data[$day_key][$epy_key]->status['late'] = "年遲到(" . $epy_val->mo002 . ")";
							}
							//先刪除--------------palte5---------------------------------
							$sql = " DELETE FROM palte5 WHERE te001='$epy_key' AND te002='$day_key' AND te008='N' ";
							$this->db->query($sql); //遲到次數審核作業 palte5

							// $this->db->where('te001', $epy_key);
							// $this->db->where('te002', $day_key);
							// $this->db->where('te008', 'N');
							// $this->db->delete('palte5'); //遲到次數審核作業 palte5


							if ($val > $on_time - 45) { //江陽是-5分鐘 算遲到 0800-45=0755
								$return_data[$day_key][$epy_key]->status['late'] = "遲到";

								//上傳 遲到次數審核作業 palte5 selone5(工號      , 日期  , 時間)
								$exist = $this->pali56_model->selone5($epy_key, $day_key, $val);

								$data1 = array(
									'company' => $this->session->userdata('syscompany'),
									'creator' => $this->session->userdata('manager'),
									'usr_group' => 'A100',
									'create_date' => date("Ymd"),
									'modifier' => ' ',
									'modi_date' => ' ',
									'flag' => 0,
									'te001' => $epy_key,	//te001 員工代號    6
									'te002' => $day_key,	//te002 刷卡日期      8
									'te003' => $val,	//te003 刷卡時間  4
									'te004' => $epy_val->mv028,	//te004 臨時卡號   6
									'te005' => 'N',		//te005 產生明細
									'te006' => $day_key,	//te006 歸屬日期     8
									'te007' => 'R', 	//te007 功能碼  1
									'te008' => 'N'
								);
								if (!$exist) {

									if (($on_time - 45) < $val && $val <= ($on_time + 30)) { //江陽是-5分鐘~30分鐘內算遲到 0800-45=0755
										$this->db->insert('palte5', $data1);
									}
								}
							}
							if ($val > ($on_time + 30)) {
								$return_data[$day_key][$epy_key]->status['late'] = ""; //超過五分鐘就不算遲到 算曠職 ==>江陽是30分鐘內
							}
						}

						//新增 中午上班打卡遲到 正常班1 1256~1325的就歸到遲到-------------------------
						if ($key > 0 && $current_status == 1 && $val > 1255 && $val <= 1325 && $class == 1) {
							//先刪除--------------palte5---------------------------------
							$sql = " DELETE FROM palte5 WHERE te001='$epy_key' AND te002='$day_key' AND te008='N' ";
							$this->db->query($sql); //遲到次數審核作業 palte5

							// $this->db->where('te001', $epy_key);
							// $this->db->where('te002', $day_key);
							// $this->db->where('te008', 'N');
							// $this->db->delete('palte5'); //遲到次數審核作業 palte5

							$return_data[$day_key][$epy_key]->status['late'] = "遲到";

							//上傳 遲到次數審核作業 palte5 selone5(工號      , 日期  , 時間)
							$exist = $this->pali56_model->selone5($epy_key, $day_key, $val);

							$data1 = array(
								'company' => $this->session->userdata('syscompany'),
								'creator' => $this->session->userdata('manager'),
								'usr_group' => 'A100',
								'create_date' => date("Ymd"),
								'modifier' => ' ',
								'modi_date' => ' ',
								'flag' => 0,
								'te001' => $epy_key,	//te001 員工代號    6
								'te002' => $day_key,	//te002 刷卡日期      8
								'te003' => $val,	//te003 刷卡時間  4
								'te004' => $epy_val->mv028,	//te004 臨時卡號   6
								'te005' => 'N',		//te005 產生明細
								'te006' => $day_key,	//te006 歸屬日期     8
								'te007' => 'R', 	//te007 功能碼  1
								'te008' => 'N'
							);
							if (!$exist) {
								$this->db->insert('palte5', $data1);
							}
						}
						//-end--新增 中午上班打卡遲到 正常班1 1256~1325的就歸到遲到-------------------------

						//開始處理曠職問題，原則:以入抓出(往前推)，最後一筆抓下班
						// if ($val > $on_time && $val < $off_time) {							//在上班期間有刷卡就是有問題!!
						// if ($key == 0 && $val > ($on_time + 25)) {
						// 	$absenteeism_hr += ($val_hr - $on_time_hr) + ($val_mn - $on_time_mn) / 60;
						// 	$absenteeism_hr = ($absenteeism_hr > 4) ? $absenteeism_hr - 1 : $absenteeism_hr;
						// } else if ($key == (count($punch_data) - 1)) {
						// 	if (($key + 1) == (floor($epy_val->c_te003 / 2) * 2)) { //表示最後一筆下班時間
						// 		if ($val < $off_time) {
						// 			$absenteeism_hr += (($off_time_hr - $val_hr) + ($off_time_mn - $val_mn) / 60) > 4 ?
						// 				(($off_time_hr - $val_hr) + ($off_time_mn - $val_mn) / 60) - 1 : (($off_time_hr - $val_hr) + ($off_time_mn - $val_mn) / 60);
						// 		}
						// 	}
						// } else {
						// }

						if ($current_status == 1) { //進場時間就是計算截止點

							if ($key == 0) {
								$absenteeism_hr = 0;
								if ($val > ($on_time + 5) && substr($val, 0, 2) !=  '00') {
									if ($val_hr == '12') { //中午休息處理
										$val_hr = '12';
										$val_mn = '00';
									}

									if ($val_hr == '13' && $val_mn == '00') { //中午休息處理
										$val_hr = '12';
										$val_mn = '00';
									}
									if (substr($val, 0, 2) > 20) {
										$temp_on_time_hr = ($on_time_hr == '00') ? '24' : $on_time_hr;
										// var_dump('1');
										$absenteeism_hr += (($val_hr - $temp_on_time_hr) * 60 + (ceil(($val_mn - $on_time_mn) / 30)) * 30) / 60;
										$absenteeism_hr = ($absenteeism_hr > 4) ? $absenteeism_hr - 1 : $absenteeism_hr;
									} else {
										// var_dump('2');
										$absenteeism_hr += (($val_hr - $on_time_hr) * 60 + (ceil(($val_mn - $on_time_mn) / 30)) * 30) / 60;
										$absenteeism_hr = ($absenteeism_hr > 4) ? $absenteeism_hr - 1 : $absenteeism_hr;
									}
								}

								if (substr($val, 0, 2) ==  '00') {
									// var_dump('3');
									$temp_val_hr = '24';
									$temp_val_hr = $temp_val_hr + $val_hr;
									$temp_on_time_hr = ($on_time_hr == '00') ? '24' : $on_time_hr;
									$absenteeism_hr += (($temp_val_hr - $temp_on_time_hr) * 60 + (ceil(($val_mn - $on_time_mn) / 30)) * 30) / 60;
									$absenteeism_hr = ($absenteeism_hr > 4) ? $absenteeism_hr - 1 : $absenteeism_hr;
								}

								$absenteeism_hr = $absenteeism_hr < 0 ? 0 : $absenteeism_hr; //提早來不算
								// var_dump($val_hr);
								// var_dump($on_time_hr);
								// var_dump($val_mn);
								// var_dump($on_time_mn);
								// var_dump($absenteeism_hr);
							} else { //處理休息時間的問題

								// $temp_time = $punch_data[$key - 1];
								// $temp_hr = substr($temp_time, 0, 2); //09
								// $temp_mn = substr($temp_time, 2, 2); //31
								// $count_hr = substr($val, 0, 2) - $temp_hr; //12-09
								// $count_mn = substr($val, 2, 2) - $temp_mn; //30-31

								$front_time = $punch_data[$key - 1]; 	//前一個刷卡時間
								$front_hr = substr($front_time, 0, 2); 	//前一個刷卡時
								$front_mn = substr($front_time, 2, 2); 	//前一個刷卡分
								$now_hr = substr($val, 0, 2);			//目前刷卡時
								$now_mn = substr($val, 2, 2);			//目前刷卡分

								if ($half_hr == 'N') {
									if ($front_mn > 30) {
										$front_mn = "30";
									} else if ($front_mn < 30 && $front_mn > 0) {
										$front_mn = "00";
									}
								}

								if ($now_hr == '12') { //中午休息處理
									$now_hr = '12';
									$now_mn = '00';
								}

								if ($now_hr == '13' && $now_mn == '00') { //中午休息處理
									$now_hr = '12';
									$now_mn = '00';
								}

								$count_hr = $now_hr - $front_hr;
								$count_mn = $now_mn - $front_mn;

								$count_leave = $count_hr * 60 + $count_mn;

								// echo "<pre>";
								// var_dump($front_hr);
								// var_dump($front_mn);
								// var_dump($now_hr);
								// var_dump($now_mn);
								// var_dump($count_leave);

								// if ($half_hr == 'N') { //不連班處理中午休息問題
								// 	$temp_mn = (substr($temp_time, 2, 2) > 30) ? 30 : 0;
								// 	$count_mn = (substr($val, 2, 2) > 30) ? 60 - $temp_mn : 30 - $temp_mn;
								// 	$count_leave = $count_hr * 60 + $count_mn;
								// }

								if (@$punch_data[$key + 1]) { //有進沒出不計算
									// $absenteeism_hr += (floor($count_leave / 30)) * 30 / 60;

									if ($half_hr == 'Y') {	//連班 休30分
										if ($count_leave > 30) {
											$absenteeism_hr += (ceil($count_leave / 30)) * 30 / 60;
										}
									} else {	//不連班休60分
										if ($count_leave > 30) {
											// if ($val_hr < 12) {
											// 	$absenteeism_hr += (ceil($count_leave / 30)) * 30 / 60;
											// } else {
											// 	$absenteeism_hr += (ceil($count_leave / 30) - 2) * 30 / 60;
											// }
											if ($front_hr <= '12' && $now_hr > '12') {
												$absenteeism_hr += (ceil($count_leave / 30) - 2) * 30 / 60;
											} else {
												$absenteeism_hr += (ceil($count_leave / 30)) * 30 / 60;
											}
										}
									}
									// var_dump($absenteeism_hr);
								}
							}
						}
						if ($current_status == 0) { //離場時間就是計算開始點，只抓下班時間
							// echo "<pre>";
							// var_dump(count($punch_data));
							$c_te003 = count($punch_data);
							if (($key + 1) == (floor($c_te003 / 2) * 2)) { //表示最後一筆下班時間
								// var_dump('comein');
								if ($val < $off_time) {

									if ($val_hr == '12') { //中午休息處理
										$val_hr = '12';
										$val_mn = '00';
									}

									if ($val_hr == '13' && $val_mn == '00') { //中午休息處理
										$val_hr = '12';
										$val_mn = '00';
									}
									// echo "<pre>";
									// var_dump($off_time_hr);
									// var_dump($val_hr);
									// var_dump($off_time_mn);
									// var_dump($val_mn);
									// var_dump((($off_time_hr - $val_hr) + ($off_time_mn - $val_mn) / 60));
									$absenteeism_hr += (($off_time_hr - $val_hr) + ($off_time_mn - $val_mn) / 60) > 4 ?
										(($off_time_hr - $val_hr) + ($off_time_mn - $val_mn) / 60) - 1 : (($off_time_hr - $val_hr) + ($off_time_mn - $val_mn) / 60);
									// var_dump($absenteeism_hr);
								}
							}
						}
						// }
					}
					// exit;
				} else if ($punch_count != 0 && $SE == 'E') { //特殊班
					foreach ($punch_data as $key => $val) {
						if ($key == 0) {
							//--新增 -------記錄上班時數，以便累計--------------------------------------
							if ($change == 'Y') {
								$data6 = array(
									'company' => $this->session->userdata('syscompany'),
									'creator' => $this->session->userdata('manager'),
									'usr_group' => 'A100',
									'create_date' => date("Ymd"),
									'modifier' => ' ',
									'modi_date' => ' ',
									'flag' => 0,
									'te001' => $epy_key,	//te001 員工代號    10
									'te002' => $day_key,	//te002 刷卡日期      8
									'te003' => $epy_val->mv028,	//te003 臨時卡號   10
									'te004' => $com_time_hr	//te004 時數   int 依時制
								);
								$this->db->insert('palte6', $data6);
							}
							//-end--新增 -------記錄上班時數，以便累計--------------------------------------
						}
					}
				}
				//----計算是否遲到、早退--end----------------------------------------
				// exit;

				$return_data[$day_key][$epy_key]->status['absenteeism'] = "";
				$return_data[$day_key][$epy_key]->absenteeism_hr = $absenteeism_hr;
				if ($absenteeism_hr > 0) {
					$return_data[$day_key][$epy_key]->status['absenteeism'] .= "曠" . $absenteeism_hr . "小時";
					$have_pal = $have_pal + 1; //有曠職
				}

				//--新增 -------記錄曠職未請假--------------------------------------
				if ($change == 'Y') {
					if ($have_pal > 0) { //表示有曠職未請假
						$data3 = array(
							'company' => $this->session->userdata('syscompany'),
							'creator' => $this->session->userdata('manager'),
							'usr_group' => 'A100',
							'create_date' => date("Ymd"),
							'modifier' => ' ',
							'modi_date' => ' ',
							'flag' => 0,
							'te001' => $epy_key,	//te001 員工代號    10
							'te002' => $day_key,	//te002 刷卡日期      8
							'te003' => $epy_val->mv028,	//te003 臨時卡號   10
							'te004' => $return_data[$day_key][$epy_key]->status['absenteeism']	//te004 狀態   255
						);
						$this->db->insert('palte3', $data3);
					}
				}
				//-end--新增 -------記錄曠職未請假--------------------------------------

				//--新增 -------備份pali56查詢結果 palte7--------------------------------------
				$valte004 = '';
				$valte005 = '';
				if (isset($return_data[$day_key][$epy_key]->te003)) {
					for ($i = 0; $i < count($return_data[$day_key][$epy_key]->te003); $i++) {
						$valte004 = $valte004 . $return_data[$day_key][$epy_key]->te003[$i] . ' ';
					}
				}
				if (isset($return_data[$day_key][$epy_key]->status['late'])) {
					$valte005 = $valte005 . $return_data[$day_key][$epy_key]->status['late'] . ' ';
				}
				if (isset($return_data[$day_key][$epy_key]->status['absenteeism'])) {
					$valte005 = $valte005 . $return_data[$day_key][$epy_key]->status['absenteeism'] . ' ';
				}
				if (isset($return_data[$day_key][$epy_key]->status['leave'])) {
					$valte005 = $valte005 . $return_data[$day_key][$epy_key]->status['leave'] . ' ';
				}
				if (isset($return_data[$day_key][$epy_key]->status['over'])) {
					$valte005 = $valte005 . $return_data[$day_key][$epy_key]->status['over'] . ' ';
				}
				if ($change == 'Y') {
					$data7 = array(
						'company' => $this->session->userdata('syscompany'),
						'creator' => $this->session->userdata('manager'),
						'usr_group' => 'A100',
						'create_date' => date("Ymd"),
						'modifier' => ' ',
						'modi_date' => ' ',
						'flag' => 0,
						'te001' => $epy_key,	//te001 員工代號    10
						'te002' => $day_key,	//te002 刷卡日期      8
						'te003' => $epy_val->mv028,	//te003 臨時卡號   10
						'te004' => $valte004,	//te004 刷卡時間   varchar 50
						'te005' => $valte005	//te005 狀態   varchar 50
					);
					$this->db->insert('palte7', $data7);

					//新增 palte 異動碼(N/Y)-----------------------------
					$sql97 = " update palte set te008='N' where te001='$epy_key' and te002='$day_key' ";
					$this->db->query($sql97);

					//end--新增 palte 異動碼(N/Y)------------------------
				}

				//-end--新增 -------備份pali56查詢結果 palte7--------------------------------------

				if (!$change) {
					if ($epy_key == $epy_val->te001) {
						$sql96 = " select * from palte7 where te001='$epy_key' and te002='$day_key' ";
						$query1 = $this->db->query($sql96);

						if ($query1->num_rows() == 0) {
							$data7 = array(
								'company' => $this->session->userdata('syscompany'),
								'creator' => $this->session->userdata('manager'),
								'usr_group' => 'A100',
								'create_date' => date("Ymd"),
								'modifier' => ' ',
								'modi_date' => ' ',
								'flag' => 0,
								'te001' => $epy_key,	//te001 員工代號    10
								'te002' => $day_key,	//te002 刷卡日期      8
								'te003' => $epy_val->mv028,	//te003 臨時卡號   10
								'te004' => $valte004,	//te004 刷卡時間   varchar 50
								'te005' => $valte005	//te005 狀態   varchar 50
							);
							$this->db->insert('palte7', $data7);
						} else {
							$sql99 = " update palte7 set te003='$epy_val->mv028', te004='$valte004', te005='$valte005' where te001='$epy_key' and te002='$day_key' ";
							$query2 = $this->db->query($sql99);
						}
					}
					//end--新增 palte 異動碼(N/Y)------------------------
				}
				//-end--新增 -------備份pali56查詢結果 palte7--------------------------------------





				if ($type == "B") {
					if ($return_data[$day_key][$epy_key]->absenteeism_hr == 0 && !@$return_data[$day_key][$epy_key]->status['error'] && !@$return_data[$day_key][$epy_key]->status['late']) {
						unset($return_data[$day_key][$epy_key]);
						// echo "<pre>";
						// var_dump($epy_key);
					}
				}
				if ($type == "C") {
					if ($return_data[$day_key][$epy_key]->absenteeism_hr == 0 && !@$return_data[$day_key][$epy_key]->status['error'] && !@$return_data[$day_key][$epy_key]->status['late']) {
						unset($return_data[$day_key][$epy_key]);
					} else if ($return_data[$day_key][$epy_key]->absenteeism_hr - $return_data[$day_key][$epy_key]->leave_hr == 0 || ($return_data[$day_key][$epy_key]->leave_hr - $return_data[$day_key][$epy_key]->absenteeism_hr == 0.5 && @$return_data[$day_key][$epy_key]->status['late'])) {
						unset($return_data[$day_key][$epy_key]);
					}
				}
			}
		}

		// $end_time = date("H") * 3600 + date("i") * 60 + date("s");
		// // $end_time2 = microtime(true);
		// echo "start_time：" . $start_time . "秒<br />";
		// echo "end_time：" . $end_time . "秒<br />";
		// $time_total = $end_time - $start_time;
		// echo "delet拿掉 palte3 palte6 palte7，執行了：" . $time_total . "秒<br />";
		// exit;
		// echo "<pre>";var_dump($return_data);exit;
		return $return_data;
	}

	function check_SE($id, $day)
	{
		$query = $this->db->query(" select * from palmtmix where mt002='$id' and mt003='$day' ");
		if ($query->num_rows() > 0) {
			//一個一個丟
			foreach ($query->result() as $row) {
				return $row->mt005;
			}
		}
		return 'N';
	}
	function selone5($seg1, $seg2, $seg3)
	{
		$this->db->where('te001', $seg1);
		$this->db->where('te002', $seg2);
		$this->db->where('te003', $seg3);
		$query52 = $this->db->get('palte5');
		return $query52->num_rows();
	}

	function get_leave($date)
	{
		preg_match_all('/\d/S', $date, $matches);  //處理日期字串
		$date = implode('', $matches[0]);
		$sql = " SELECT * FROM `paltg` WHERE tg003 = '" . $date . "' ";
		$query = $this->db->query($sql);
		$ret = $query->result();

		return $ret;
	}
	function get_over($date)
	{
		preg_match_all('/\d/S', $date, $matches);  //處理日期字串
		$date = implode('', $matches[0]);
		$sql = " SELECT * FROM `paltf` WHERE tf002 = '" . $date . "' and tf017='Y' ";
		$query = $this->db->query($sql);
		$ret = $query->result();

		return $ret;
	}

	function get_work_class()
	{
		$sql = " SELECT * FROM `palmo` ";
		$query = $this->db->query($sql);
		$ret = $query->result();

		return $ret;
	}

	function check_holiday($seq1)
	{
		preg_match_all('/\d/S', $seq1, $matches);
		$seq1 = implode('', $matches[0]);
		$seq_1 = substr($seq1, 0, 4);
		$seq_2 = substr($seq1, 4, 4);

		$this->db->select('*');
		$this->db->from('palms');
		$this->db->where('ms001', $seq_1);
		$this->db->where('ms002 like', '%' . $seq_2); //$this->db->where('ms002', $seq_2);
		$query = $this->db->get();
		if ($query->num_rows() > 0) {
			$tmp = $query->result();
			return $tmp[0]->ms004;
		}
		return '5'; //未設定的平日
	}

	function get_oneday_data($seq1)
	{
		preg_match_all('/\d/S', $seq1, $matches);
		$seq1 = implode('', $matches[0]);
		$sql9 = " SELECT a.mv004 ,IFNULL(c.me002,'') as me002,a.mv001 as te001,a.mv002,a.mv027,b.te003,b.te002, d.mo002, d.mo003, d.mo004, d.mo005, d.mo006 
				FROM cmsmv as a
				LEFT JOIN palte as b ON a.mv001=b.te001 and b.te002 = $seq1 ";
		$sql9 .= "LEFT JOIN cmsme as c ON a.mv004=c.me001
				LEFT JOIN palmo as d ON a.mv027 = d.mo001 
				WHERE (a.mv022='' or a.mv022 IS NULL) and a.mv026='Y'  
				ORDER BY a.mv004 asc, a.mv021 asc, b.te002 asc, b.te003 asc";
		//echo $sql9;exit;
		// $result = mysql_query($sql9) or die_content("查詢資料失敗" . mysql_error());
		$query = $this->db->query($sql9);
		$ret = $query->result();
		return $ret;
	}

	function get_excel_date($dateo = '', $datec = '', $type = '', $epyo = '', $epyc = '', $dep = '')
	{
		$sql = "select  c.me002,a.te001,b.mv002,a.te002,te004,te005  from palte7 as a 
				LEFT JOIN cmsmv as b ON a.te001=b.mv001
				LEFT JOIN cmsme as c on b.mv004=c.me001";
		$where = "";
		if ($dateo != "") {
			$where = $where . " where a.te002>='$dateo' ";
		}
		if ($datec != "") {
			if ($where == "") {
				$where = $where . " where a.te002<='$datec' ";
			} else {
				$where = $where . " and a.te002<='$datec' ";
			}
		}
		if ($epyo != "") {
			if ($where == "") {
				$where = $where . " where a.te001>='$epyo' ";
			} else {
				$where = $where . " and a.te001>='$epyo' ";
			}
		}
		if ($epyc != "") {
			if ($where == "") {
				$where = $where . " where a.te001<='$epyc' ";
			} else {
				$where = $where . " and a.te001<='$epyc' ";
			}
		}
		if ($dep != "") {
			if ($where == "") {
				$where = $where . " where c.me001='$dep' ";
			} else {
				$where = $where . " and c.me001='$dep' ";
			}
		}

		if ($type == '1') {
			$order = "order by a.te002,c.me001,a.te001"; //依照日期
		} else {
			$order = "order by a.te001,c.me001,a.te002"; //依照員工
		}


		$query = $this->db->query($sql . $where . $order);
		$ret = $query->result();
		return $ret;
	}

	function get_excel_dateM($dateo = '', $datec = '', $type = '', $epyo = '', $epyc = '', $dep = '')
	{
		$sql = "select  c.me002,a.te001,b.mv002,a.te002,te004,te005,
		                Coalesce(d.mo003,e.mo003) as mo003 , Coalesce(d.mo004,e.mo004) as mo004, IFNULL(f.ms004,'3') as ms004  
		        from palte7 as a 
				LEFT JOIN cmsmv as b ON a.te001=b.mv001
				LEFT JOIN cmsme as c on b.mv004=c.me001
				LEFT JOIN palmtmix as d on b.mv001=d.mt002 and a.te002 =d.mt003
				LEFT JOIN palmo as e ON b.mv027 = Coalesce(d.mt002,e.mo001) 
				LEFT JOIN palms as f on a.te002 = f.ms002
				";
		$where = "";
		if ($dateo != "") {
			$where = $where . " where a.te002>='$dateo' ";
		}
		if ($datec != "") {
			if ($where == "") {
				$where = $where . " where a.te002<='$datec' ";
			} else {
				$where = $where . " and a.te002<='$datec' ";
			}
		}
		if ($epyo != "") {
			if ($where == "") {
				$where = $where . " where a.te001>='$epyo' ";
			} else {
				$where = $where . " and a.te001>='$epyo' ";
			}
		}
		if ($epyc != "") {
			if ($where == "") {
				$where = $where . " where a.te001<='$epyc' ";
			} else {
				$where = $where . " and a.te001<='$epyc' ";
			}
		}
		if ($dep != "") {
			if ($where == "") {
				$where = $where . " where c.me001='$dep' ";
			} else {
				$where = $where . " and c.me001='$dep' ";
			}
		}

		if ($type == '1') {
			$order = "order by a.te002,c.me001,a.te001"; //依照日期
		} else {
			$order = "order by a.te001,c.me001,a.te002"; //依照員工
		}


		$query = $this->db->query($sql . $where . $order);
		$result = $query->result();
		$ret = array();
		foreach ($result as $key => $val) {
			if ($val->ms004 == '3') {

				$ret[$key][] = $val->me002;
				$ret[$key][] = $val->te001;
				$ret[$key][] = $val->mv002;
				$ret[$key][] = $val->te002;

				// if (strpos($val->te005, "加班") !== false) {
				$rte004 = '';
				$rte005 = '';
				$str_kala = explode(" ", $val->te004);
				$str_state = explode(" ", $val->te005);
				$doOne = 'Y';

				for ($i = 0; $i < count($str_kala) - 1; $i++) {
					# code...
					if ($doOne == 'Y') {
						if ($val->mo003 > '1400') {
							if ($i == 0) {
								$rte004 = $str_kala[$i];
							} else if ($i == count($str_kala) - 2) {
								$rte004 .= ' ' . substr($val->mo004, 0, 2) . substr($str_kala[$i], 2, 2);
								$doOne = 'N';
							} else {
								$rte004 .= ' ' . $str_kala[$i];
							}
						} else {
							if ($i == 0) {
								$rte004 = $str_kala[$i];
							} else if ($val->mo004 > $str_kala[$i]) {
								$rte004 .= ' ' . $str_kala[$i];
							} else {
								$rte004 .= ' ' . substr($val->mo004, 0, 2) . substr($str_kala[$i], 2, 2);
								$doOne = 'N';
							}
						}
					}
				}

				for ($j = 0; $j < count($str_state) - 1; $j++) {
					if (strpos($str_state[$j], "加班") !== false) {
						$rte005 .= '';
					} else {
						$rte005 .= ' ' . $str_state[$j];
					}
				}



				$ret[$key][] = $rte004;
				$ret[$key][] = $rte005;
				// } else {
				// 	$ret[$key][] = $val->te004;
				// 	$ret[$key][] = $val->te005;
				// }
			} else {
				$ret[$key][] = $val->me002;
				$ret[$key][] = $val->te001;
				$ret[$key][] = $val->mv002;
				$ret[$key][] = $val->te002;
				$ret[$key][] = '';
				$ret[$key][] = '';
			}
		}



		return $ret;
	}


	function get_epy_data($now_date = "")
	{
		if (!@$now_date) {
			$now_date = date("Ymd");
		}
		$sql = " SELECT a.mv004,a.mv001,a.mv002,b.me002 
				FROM cmsmv as a 
				LEFT JOIN cmsme as b on a.mv004 = b.me002
				WHERE mv026 = 'Y' and (mv022 ='' or mv022 is null or mv022 > " . $now_date . " )
				ORDER BY mv004 asc,mv001 asc ";

		// $result = mysql_query($sql) or die_content("查詢資料失敗" . mysql_error());
		$query = $this->db->query($sql);
		$ret = $query->result();
		return $ret;
	}
}
/* End of file model.php */
/* Location: ./application/model/model.php */
