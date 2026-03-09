<?php if (!defined('BASEPATH')) exit('No direct script access allowed'); //这一句要求此文件必须通过index.php 调用执行

class sfci03n extends CI_Controller
{           //擴展類必须註明由母類擴展而來 (自訂類使用 ci 框架 第一個字母大寫)

	public function __construct()       //在類中使用構造函數,必须在構造函數中顯式繼承母類構造函數
	{
		parent::__construct();        //繼承父類別
		$this->load->helper('url');   //載入預設url 庫函數及數据庫配置	
		$this->load->library("session");
		$this->load->library('excel');
		date_default_timezone_set("Asia/Taipei");  //設置時區
		//  $this->output->cache(480);  //緩衝 
		$this->no_col = "TE003";	//序號欄位
		$this->detail_col =
			array(
				'TE003' => array(
					'name' => "序號",
					'title_class' => "center",
					'col_require' => "require",
					'data_class' => "center",
					'type' => "text",
					'size' => "4",
					'disabled' => "disabled",
					'readonly' => "readonly"
				),
				'cmsi09d' => array(
					'name' => "1:人時2:機時",
					'title_class' => "center",
					'data_class' => "center",
					'type' => "text",
					'size' => "8",
					'id' => "TE004",
					'style' => "background-color:#FFFFE4",
					'onblur' => "check_cmsi09d(this);",
					'ondblclick' => "search_cmsi09d_window(this);",
					'readonly' => "readonly",
					'disabled' => "disabled",
					'onkeyup' => "this.value=this.value.replace(/[^A-Z0-9]/gi,'');this.value=this.value.toLocaleUpperCase();"
					
				), 
				'cmsi09ddisp' => array(
					'name' => "員工姓名",
					'title_class' => "center",
					'data_class' => "center",
					'id' => "TE004disp",
					'type' => "text",
					'size' => "8",
					'style' => "background-color:#F0F0F0",
					'disabled' => "disabled",
					'readonly' => "value"
				),
				'TE005' => array(
					'name' => "機台代號",
					'title_class' => "center",
					'data_class' => "center",
					'type' => "text",
					'size' => "8",
					'id' => "cmsi03",
					'maxlength' => "6",
					'style' => "background-color:#FFFFE4",
					'onblur' => "check_cmsi03d(this);",
					'ondblclick' => "search_cmsi03d_window(this);",
					'disabled' => "disabled",
					'onkeyup' => "this.value=this.value.replace(/[^A-Z0-9]/gi,'');this.value=this.value.toLocaleUpperCase();"
					
				),
				'TE005disp' => array(
					'name' => "機台名稱",
					'title_class' => "center",
					'data_class' => "center",
					'type' => "text",
					'disabled' => "disabled",
					'size' => "18",
					'disabled' => "disabled",
					'style' => "background-color:#F0F0F0",
					'readonly' => "value"
				),
				'TE006' => array(
					'name' => "製令單別",
					'title_class' => "center",
					'data_class' => "center",
					'type' => "text",
					'size' => "8",
					'maxlength' => "4",
					'style' => "background-color:#FFFFE4",
					'onblur' => "check_sfcta(this);",
					'onchange' => "check_sfcta(this);",
					'ondblclick' => "search_sfci03na_window(this);",
					'onkeyup' => "this.value=this.value.replace(/[^0-9]/gi,'');",
					'disabled' => "disabled",
					'required' => "required"
				),
				'TE007' => array(
					'name' => "製令單號",
					'title_class' => "center",
					'data_class' => "center",
					'type' => "text",
					'size' => "12",
					'maxlength' => "12",
					'style' => "background-color:#FFFFE4",
					'ondblclick' => "search_sfci03n_window(this);",
					'disabled' => "disabled",
					'onkeyup' => "this.value=this.value.replace(/[^0-9]/gi,'');",
					'required' => "required"
				),
				'TE008' => array(
					'name' => "工序",
					'title_class' => "center",
					'data_class' => "center",
					'type' => "text",
					'size' => "4",
					'style' => "background-color:#F0F0F0",
					'readonly' => "value",
					'disabled' => "disabled",
					'required' => "required"
				),

				'TE009' => array(
					'name' => "製程代號",
					'title_class' => "center",
					'data_class' => "center",
					'type' => "text",
					'size' => "8",
					'maxlength' => "4",
					'style' => "background-color:#F0F0F0",
					'onblur' => "check_cmsi19(this);",
					'ondblclick' => "search_cmsi19_window(this);",
					'readonly' => "value",
					'disabled' => "disabled",
					'onkeyup' => "this.value=this.value.replace(/[^A-Z0-9]/gi,'');this.value=this.value.toLocaleUpperCase();",
					'required' => "required"
				),
				'TE009disp' => array(
					'name' => "製程名稱",
					'title_class' => "center",
					'data_class' => "center",
					'type' => "text",
					'size' => "14",
					'style' => "background-color:#F0F0F0",
					'readonly' => "value",
					'disabled' => "disabled",
					'required' => "required"
				),
				/*'TE010' => array(
					'name' => "型態",
					'title_class' => "center",
					'data_class' => "center",
					'type' => "select",
					'style' => "background-color:#EEF1CE",
					'option' => array('1' => "正常完成", '2' => "重工完成", '3' => "報廢")
				),
				'TE029' => array(
					'name' => "機台樣式",
					'title_class' => "center",
					'data_class' => "center",
					'type' => "select",
					'style' => "background-color:#EEF1CE",
					'option' => array('1' => "單衝(手動)", '2' => "連續")
				), */
				'TE011' => array(
					'name' => "數量",
					'title_class' => "center",
					'type' => "text",
					'size' => "8",
					'maxlength' => "8",
					'disabled' => "disabled",
					'onkeyup' => "this.value=this.value.replace(/[^0-9]/gi,'');",
					'onchange' => "count_pcs(this);",
					'required' => "required"
				),
				'TE028' => array(
					'name' => "可返修數量",
					'title_class' => "center",
					'type' => "text",
					'size' => "8",
					'maxlength' => "8",
					'onkeyup' => "this.value=this.value.replace(/[^0-9]/gi,'');",
					'onchange' => "count_pcs(this);",
					'value' => "0",
					'required' => "required"
				),
				'TE031' => array(
					'name' => "報廢品數量",
					'title_class' => "center",
					'type' => "text",
					'size' => "8",
					'maxlength' => "8",
					'onkeyup' => "this.value=this.value.replace(/[^0-9]/gi,'');",
					'onchange' => "count_pcs(this);",
					'value' => "0",
					'required' => "required"
				),
				'TE0311' => array(
					'name' => "不良品數量",
					'title_class' => "center",
					'type' => "text",
					'size' => "8",
					'style' => "background-color:#F0F0F0",
					'readonly' => "value",
					'value' => "0"
				),
				'TE0312' => array(
					'name' => "合格數量",
					'title_class' => "center",
					'type' => "text",
					'size' => "8",
					'style' => "background-color:#F0F0F0",
					'readonly' => "value",
					'value' => "0"
				), 
				'TE022' => array(
					'name' => "時段1起",
					'title_class' => "center",
					'type' => "text",
					'size' => "10",
					'placeholder' => "HHmm",
					'maxlength' => "4",
					'onblur' => "count_time(this);",
					'onkeyup' => "this.value=this.value.replace(/[^0-9]/gi,'');",
					'required' => "required"
				),
				'TE023' => array(
					'name' => "時段1訖",
					'title_class' => "center",
					'type' => "text",
					'size' => "10",
					'placeholder' => "HHmm",
					'maxlength' => "4",
					'onblur' => "count_time(this);",
					'onkeyup' => "this.value=this.value.replace(/[^0-9]/gi,'');",
					'required' => "required"
				),
				'TE024' => array(
					'name' => "時段2無",
					'title_class' => "center",
					'type' => "text",
					'size' => "10",
					'placeholder' => "HHmm",
					'maxlength' => "4",
					'onblur' => "count_time(this);",
					'onkeyup' => "this.value=this.value.replace(/[^0-9]/gi,'');"
				),
				'TE025' => array(
					'name' => "時段2無",
					'title_class' => "center",
					'type' => "text",
					'size' => "10",
					'placeholder' => "HHmm",
					'maxlength' => "4",
					'onblur' => "count_time(this);",
					'onkeyup' => "this.value=this.value.replace(/[^0-9]/gi,'');"
				),
				'TE026' => array(
					'name' => "時段3無",
					'title_class' => "center",
					'type' => "text",
					'size' => "10",
					'placeholder' => "HHmm",
					'maxlength' => "4",
					'onblur' => "count_time(this);",
					'onkeyup' => "this.value=this.value.replace(/[^0-9]/gi,'');"
				),
				'TE027' => array(
					'name' => "時段3無",
					'title_class' => "center",
					'type' => "text",
					'size' => "10",
					'placeholder' => "HHmm",
					'maxlength' => "4",
					'onblur' => "count_time(this);",
					'onkeyup' => "this.value=this.value.replace(/[^0-9]/gi,'');"
				),
				'TE012' => array(
					'name' => "人時(時分)",
					'title_class' => "center",
					'type' => "text",
					'maxlength' => "10",
					'size' => "10",
					'value' => "0",
					'style' => "background-color:#F0F0F0",
					'readonly' => "value"
				),
				'TE013' => array(
					'name' => "機時(時分)",
					'title_class' => "center",
					'type' => "text",
					'size' => "10",
					'value' => "0",
					'style' => "background-color:#F0F0F0",
					'readonly' => "value",
				),
				'TE017' => array(
					'name' => "產品品號",
					'title_class' => "center",
					'type' => "text",
					'size' => "18",
					'value' => "",
					'onblur' => "check_invi02(this);",
					'ondblclick' => "search_invi02_window(this);",
					'style' => "background-color:#F0F0F0",
					'readonly' => "value",
					'onkeyup' => "this.value=this.value.replace(/[^A-Z0-9]/gi,'');this.value=this.value.toLocaleUpperCase();",
					'required' => "required"
				),
				'TE018' => array(
					'name' => "產品品名",
					'title_class' => "center",
					'type' => "text",
					'size' => "20",
					'value' => "",
					'style' => "background-color:#F0F0F0",
					'readonly' => "value",
					'required' => "required"
				),
				'TE019' => array(
					'name' => "產品規格",
					'title_class' => "center",
					'type' => "text",
					'size' => "20",
					'value' => "",
					'style' => "background-color:#F0F0F0",
					'readonly' => "value"
				),
				'TE020' => array(
					'name' => "單位",
					'title_class' => "center",
					'type' => "text",
					'size' => "4",
					'value' => "",
					'style' => "background-color:#F0F0F0",
					'readonly' => "value"
				),

				/*'TE030' => array(
					'name' => "多人合作",
					'title_class' => "center",
					'type' => "text",
					'size' => "20",
					'value' => "",
					'style' => "background-color:#FFFFE4",
					'ondblclick' => "search_cmsi09ch_window(this);",
					'onkeyup' => "this.value=this.value.replace(/[^A-Z0-9\;]/gi,'');this.value=this.value.toLocaleUpperCase();"
				),*/
				'TE015' => array(
					'name' => "備註",
					'title_class' => "center",
					'type' => "text",
					'size' => "12",
					'value' => "",
					'ondblclick' => ""
				)
			);
          //修改1141121 modi 修改使用
		$this->detail_col_a =
			array(
				'TE003' => array(
					'name' => "序號",
					'title_class' => "center",
					'col_require' => "require",
					'data_class' => "center",
					'type' => "text",
					'size' => "4",
					'disabled' => "disabled",
					'readonly' => "readonly"
				),
				/*'cmsi09d' => array(
					'name' => "類別:1人2機",
					'title_class' => "center",
					'data_class' => "center",
					'type' => "text",
					'size' => "8",
					'id' => "TE004",
					'style' => "background-color:#FFFFE4",
					'onblur' => "check_cmsi09d(this);",
					'disabled' => "disabled",
					'ondblclick' => "search_cmsi09d_window(this);",
					'onkeyup' => "this.value=this.value.replace(/[^A-Z0-9]/gi,'');this.value=this.value.toLocaleUpperCase();",
					'required' => "required"
				),*/
				/*'cmsi09ddisp' => array(
					'name' => "員工姓名",
					'title_class' => "center",
					'data_class' => "center",
					'id' => "TE004disp",
					'type' => "text",
					'size' => "8",
					'style' => "background-color:#F0F0F0",
					'disabled' => "disabled",
					'readonly' => "value"
				),*/
				/*'TE005' => array(
					'name' => "機台代號",
					'title_class' => "center",
					'data_class' => "center",
					'type' => "text",
					'size' => "8",
					'id' => "cmsi03",
					'maxlength' => "6",
					'style' => "background-color:#FFFFE4",
					'onblur' => "check_cmsi03d(this);",
					'ondblclick' => "search_cmsi03d_window(this);",
					'onkeyup' => "this.value=this.value.replace(/[^A-Z0-9]/gi,'');this.value=this.value.toLocaleUpperCase();",
					'required' => "required"
				),*/
				/*'TE005disp' => array(
					'name' => "機台名稱",
					'title_class' => "center",
					'data_class' => "center",
					'type' => "text",
					'disabled' => "disabled",
					'size' => "14",
					'style' => "background-color:#F0F0F0",
					'readonly' => "value"
				),*/
				'TE006' => array(
					'name' => "製令單別",
					'title_class' => "center",
					'data_class' => "center",
					'type' => "text",
					'size' => "8",
					'maxlength' => "4",
					'style' => "background-color:#FFFFE4",
					'onblur' => "check_sfcta(this);",
					'onchange' => "check_sfcta(this);",
					'disabled' => "disabled",
					'ondblclick' => "search_sfci03na_window(this);",
					'onkeyup' => "this.value=this.value.replace(/[^0-9]/gi,'');",
					'required' => "required"
				),
				'TE007' => array(
					'name' => "製令單號",
					'title_class' => "center",
					'data_class' => "center",
					'type' => "text",
					'size' => "12",
					'maxlength' => "12",
					'disabled' => "disabled",
					'style' => "background-color:#FFFFE4",
					'ondblclick' => "search_sfci03n_window(this);",
					'onkeyup' => "this.value=this.value.replace(/[^0-9]/gi,'');",
					'required' => "required"
				),
				'TE008' => array(
					'name' => "工序",
					'title_class' => "center",
					'data_class' => "center",
					'type' => "text",
					'size' => "4",
					'style' => "background-color:#F0F0F0",
					'readonly' => "value",
					'disabled' => "disabled",
					'required' => "required"
				),

				'TE009' => array(
					'name' => "製程代號",
					'title_class' => "center",
					'data_class' => "center",
					'type' => "text",
					'size' => "8",
					'maxlength' => "4",
					'style' => "background-color:#F0F0F0",
					'onblur' => "check_cmsi19(this);",
					'ondblclick' => "search_cmsi19_window(this);",
					'readonly' => "value",
					'disabled' => "disabled",
					'onkeyup' => "this.value=this.value.replace(/[^A-Z0-9]/gi,'');this.value=this.value.toLocaleUpperCase();",
					'required' => "required"
				),
				'TE009disp' => array(
					'name' => "製程名稱",
					'title_class' => "center",
					'data_class' => "center",
					'type' => "text",
					'size' => "14",
					'disabled' => "disabled",
					'style' => "background-color:#F0F0F0",
					'readonly' => "value",
					'required' => "required"
				),
				/*'TE010' => array(
					'name' => "型態",
					'title_class' => "center",
					'data_class' => "center",
					'type' => "select",
					'style' => "background-color:#EEF1CE",
					'option' => array('1' => "正常完成", '2' => "重工完成", '3' => "報廢")
				),
				'TE029' => array(
					'name' => "機台樣式",
					'title_class' => "center",
					'data_class' => "center",
					'type' => "select",
					'style' => "background-color:#EEF1CE",
					'option' => array('1' => "單衝(手動)", '2' => "連續")
				), */
				'TE011' => array(
					'name' => "數量",
					'title_class' => "center",
					'type' => "text",
					'size' => "8",
					'maxlength' => "8",
					'disabled' => "disabled",
					'onkeyup' => "this.value=this.value.replace(/[^0-9]/gi,'');",
					'onchange' => "count_pcs(this);",
					'style' => "background-color:#F0F0F0",
					'readonly' => "value",
					'required' => "required"
				),
				/*'TE028' => array(
					'name' => "可返修數量",
					'title_class' => "center",
					'type' => "text",
					'size' => "8",
					'maxlength' => "8",
					'onkeyup' => "this.value=this.value.replace(/[^0-9]/gi,'');",
					'onchange' => "count_pcs(this);",
					'value' => "0",
					'required' => "required"
				),
				'TE031' => array(
					'name' => "報廢品數量",
					'title_class' => "center",
					'type' => "text",
					'size' => "8",
					'maxlength' => "8",
					'onkeyup' => "this.value=this.value.replace(/[^0-9]/gi,'');",
					'onchange' => "count_pcs(this);",
					'value' => "0",
					'required' => "required"
				),
				'TE0311' => array(
					'name' => "不良品數量",
					'title_class' => "center",
					'type' => "text",
					'size' => "8",
					'style' => "background-color:#F0F0F0",
					'readonly' => "value",
					'value' => "0"
				),
				'TE0312' => array(
					'name' => "合格數量",
					'title_class' => "center",
					'type' => "text",
					'size' => "8",
					'style' => "background-color:#F0F0F0",
					'readonly' => "value",
					'value' => "0"
				),*/
				'TE022' => array(
					'name' => "時段1起",
					'title_class' => "center",
					'type' => "text",
					'size' => "10",
					'placeholder' => "HHmm",
					'maxlength' => "4",
					'onblur' => "count_time(this);",
					'onkeyup' => "this.value=this.value.replace(/[^0-9]/gi,'');",
					'required' => "required"
				),
				'TE023' => array(
					'name' => "時段1訖",
					'title_class' => "center",
					'type' => "text",
					'size' => "10",
					'placeholder' => "HHmm",
					'maxlength' => "4",
					'onblur' => "count_time(this);",
					'onkeyup' => "this.value=this.value.replace(/[^0-9]/gi,'');",
					'required' => "required"
				),
				/*'TE024' => array(
					'name' => "2起無",
					'title_class' => "center",
					'type' => "text",
					'size' => "4",
					'placeholder' => "HHmm",
					'maxlength' => "4",
					'onblur' => "count_time(this);",
					'style' => "background-color:#F0F0F0",
					'readonly' => "value",
					'onkeyup' => "this.value=this.value.replace(/[^0-9]/gi,'');"
				),
				'TE025' => array(
					'name' => "2訖無",
					'title_class' => "center",
					'type' => "text",
					'size' => "4",
					'placeholder' => "HHmm",
					'maxlength' => "4",
					'style' => "background-color:#F0F0F0",
					'readonly' => "value",
					'onblur' => "count_time(this);",
					'onkeyup' => "this.value=this.value.replace(/[^0-9]/gi,'');"
				),
				'TE026' => array(
					'name' => "3起無",
					'title_class' => "center",
					'type' => "text",
					'size' => "4",
					'placeholder' => "HHmm",
					'maxlength' => "4",
					'onblur' => "count_time(this);",
					'style' => "background-color:#F0F0F0",
					'readonly' => "value",
					'onkeyup' => "this.value=this.value.replace(/[^0-9]/gi,'');"
				),
				'TE027' => array(
					'name' => "3訖無",
					'title_class' => "center",
					'type' => "text",
					'size' => "4",
					'placeholder' => "HHmm",
					'maxlength' => "4",
					'onblur' => "count_time(this);",
					'style' => "background-color:#F0F0F0",
					'readonly' => "value",
					'onkeyup' => "this.value=this.value.replace(/[^0-9]/gi,'');"
				),*/
				'TE013' => array(
					'name' => "有效分配時分",
					'title_class' => "center",
					'type' => "text",
					'maxlength' => "10",
					'size' => "10",
					'value' => "0",
					'style' => "background-color:#F0F0F0"
				),
				'TE012' => array(
					'name' => "報工時分",
					'title_class' => "center",
					'type' => "text",
					'size' => "10",
					'value' => "0",
					'style' => "background-color:#F0F0F0"
				),
				'TE017' => array(
					'name' => "產品品號",
					'title_class' => "center",
					'type' => "text",
					'size' => "12",
					'value' => "",
					'onblur' => "check_invi02(this);",
					'ondblclick' => "search_invi02_window(this);",
					'style' => "background-color:#F0F0F0",
					'readonly' => "value",
					'disabled' => "disabled",
					'onkeyup' => "this.value=this.value.replace(/[^A-Z0-9]/gi,'');this.value=this.value.toLocaleUpperCase();",
					'required' => "required"
				),
				'TE018' => array(
					'name' => "產品品名",
					'title_class' => "center",
					'type' => "text",
					'size' => "18",
					'value' => "",
					'style' => "background-color:#F0F0F0",
					'readonly' => "value",
					'disabled' => "disabled",
					'required' => "required"
				)
				/* 'TE019' => array(
					'name' => "產品規格",
					'title_class' => "center",
					'type' => "text",
					'size' => "18",
					'value' => "",
					'disabled' => "disabled",
					'style' => "background-color:#F0F0F0",
					'readonly' => "value"
				),
				'TE020' => array(
					'name' => "單位",
					'title_class' => "center",
					'type' => "text",
					'size' => "4",
					'value' => "",
					'disabled' => "disabled",
					'style' => "background-color:#F0F0F0",
					'readonly' => "value"
				)*/

				/*'TE030' => array(
					'name' => "多人合作",
					'title_class' => "center",
					'type' => "text",
					'size' => "20",
					'value' => "",
					'style' => "background-color:#FFFFE4",
					'ondblclick' => "search_cmsi09ch_window(this);",
					'onkeyup' => "this.value=this.value.replace(/[^A-Z0-9\;]/gi,'');this.value=this.value.toLocaleUpperCase();"
				),
				'TE015' => array(
					'name' => "備註",
					'title_class' => "center",
					'type' => "text",
					'size' => "12",
					'value' => "",
					'ondblclick' => ""
				)*/
			);

		$this->detail_col_b =
			array(
				'TE003' => array(
					'name' => "序號",
					'title_class' => "center",
					'col_require' => "require",
					'data_class' => "center",
					'type' => "text",
					'size' => "4",
					'readonly' => "readonly"
				),
				'cmsi09d' => array(
					'name' => "員工代號",
					'title_class' => "center",
					'data_class' => "center",
					'type' => "text",
					'size' => "8",
					'id' => "TE004",
					'style' => "background-color:#FFFFE4",
					'onblur' => "check_cmsi09d(this);",
					'ondblclick' => "search_cmsi09d_window(this);",
					'onkeyup' => "this.value=this.value.replace(/[^A-Z0-9]/gi,'');this.value=this.value.toLocaleUpperCase();",
					// 'required' => "required"
				),
				'cmsi09ddisp' => array(
					'name' => "員工姓名",
					'title_class' => "center",
					'data_class' => "center",
					'id' => "TE004disp",
					'type' => "text",
					'size' => "8",
					'style' => "background-color:#F0F0F0",
					'disabled' => "disabled",
					'readonly' => "value"
				),
				'TE005' => array(
					'name' => "機台代號",
					'title_class' => "center",
					'data_class' => "center",
					'type' => "text",
					'size' => "10",
					'id' => "cmsi03",
					'maxlength' => "10",
					'style' => "background-color:#FFFFE4",
					'onblur' => "check_cmsi03d(this);",
					'ondblclick' => "search_cmsi03d_window(this);",
					'onkeyup' => "this.value=this.value.replace(/[^A-Z0-9]/gi,'');this.value=this.value.toLocaleUpperCase();",
					// 'required' => "required"
				),
				'TE005disp' => array(
					'name' => "機台名稱",
					'title_class' => "center",
					'data_class' => "center",
					'type' => "text",
					'disabled' => "disabled",
					'size' => "48",
					'style' => "background-color:#F0F0F0",
					'readonly' => "value"
				),
				'TE006' => array(
					'name' => "製令單別",
					'title_class' => "center",
					'data_class' => "center",
					'type' => "text",
					'size' => "8",
					'maxlength' => "4",
					'style' => "background-color:#FFFFE4",
					'onblur' => "check_sfcta(this);",
					'onchange' => "check_sfcta(this);",
					'ondblclick' => "search_sfci03na_window(this);",
					'onkeyup' => "this.value=this.value.replace(/[^0-9]/gi,'');",
					'value' => "5101",
					'required' => "required"
				),
				'TE007' => array(
					'name' => "製令單號",
					'title_class' => "center",
					'data_class' => "center",
					'type' => "text",
					'size' => "12",
					'maxlength' => "11",
					'style' => "background-color:#FFFFE4",
					'ondblclick' => "search_sfci03n_window(this);",
					'onkeyup' => "this.value=this.value.replace(/[^0-9]/gi,'');",
					'required' => "required"
				),
				'TE008' => array(
					'name' => "工序",
					'title_class' => "center",
					'data_class' => "center",
					'type' => "text",
					'size' => "4",
					'style' => "background-color:#F0F0F0",
					'readonly' => "value",
					'required' => "required"
				),

				'TE009' => array(
					'name' => "製程代號",
					'title_class' => "center",
					'data_class' => "center",
					'type' => "text",
					'size' => "8",
					'maxlength' => "4",
					'style' => "background-color:#F0F0F0",
					'onblur' => "check_cmsi19(this);",
					'ondblclick' => "search_cmsi19_window(this);",
					'readonly' => "value",
					'onkeyup' => "this.value=this.value.replace(/[^A-Z0-9]/gi,'');this.value=this.value.toLocaleUpperCase();",
					// 'required' => "required"
				),
				'TE009disp' => array(
					'name' => "製程名稱",
					'title_class' => "center",
					'data_class' => "center",
					'type' => "text",
					'size' => "30",
					'style' => "background-color:#F0F0F0",
					'readonly' => "value",
					// 'required' => "required"
				),
				'TE010' => array(
					'name' => "型態",
					'title_class' => "center",
					'data_class' => "center",
					'type' => "select",
					'style' => "background-color:#EEF1CE",
					'option' => array('1' => "正常完成", '2' => "重工完成", '3' => "報廢")
				),
				'TE029' => array(
					'name' => "機台樣式",
					'title_class' => "center",
					'data_class' => "center",
					'type' => "select",
					'style' => "background-color:#EEF1CE",
					'option' => array('1' => "單衝(手動)", '2' => "連續")
				),
				'TE011' => array(
					'name' => "數量",
					'title_class' => "center",
					'type' => "text",
					'size' => "8",
					'maxlength' => "8",
					'onkeyup' => "this.value=this.value.replace(/[^0-9]/gi,'');",
					'onchange' => "count_pcs(this);",
					'required' => "required"
				),
				'TE028' => array(
					'name' => "可返修數量",
					'title_class' => "center",
					'type' => "text",
					'size' => "8",
					'maxlength' => "8",
					'onkeyup' => "this.value=this.value.replace(/[^0-9]/gi,'');",
					'onchange' => "count_pcs(this);",
					'value' => "0",
					'required' => "required"
				),
				'TE031' => array(
					'name' => "報廢品數量",
					'title_class' => "center",
					'type' => "text",
					'size' => "8",
					'maxlength' => "8",
					'onkeyup' => "this.value=this.value.replace(/[^0-9]/gi,'');",
					'onchange' => "count_pcs(this);",
					'value' => "0",
					'required' => "required"
				),
				'TE0311' => array(
					'name' => "不良品數量",
					'title_class' => "center",
					'type' => "text",
					'size' => "8",
					'style' => "background-color:#F0F0F0",
					'readonly' => "value",
					'value' => "0"
				),
				'TE0312' => array(
					'name' => "合格數量",
					'title_class' => "center",
					'type' => "text",
					'size' => "8",
					'style' => "background-color:#F0F0F0",
					'readonly' => "value",
					'value' => "0"
				),
				'TE022' => array(
					'name' => "時段1起",
					'title_class' => "center",
					'type' => "text",
					'size' => "10",
					'placeholder' => "HHmm",
					'maxlength' => "4",
					'onblur' => "count_time(this);",
					'onkeyup' => "this.value=this.value.replace(/[^0-9]/gi,'');",
					'required' => "required"
				),
				'TE023' => array(
					'name' => "時段1訖",
					'title_class' => "center",
					'type' => "text",
					'size' => "10",
					'placeholder' => "HHmm",
					'maxlength' => "4",
					'onblur' => "count_time(this);",
					'onkeyup' => "this.value=this.value.replace(/[^0-9]/gi,'');",
					'required' => "required"
				),
				'TE024' => array(
					'name' => "時段2起",
					'title_class' => "center",
					'type' => "text",
					'size' => "10",
					'placeholder' => "HHmm",
					'maxlength' => "4",
					'onblur' => "count_time(this);",
					'onkeyup' => "this.value=this.value.replace(/[^0-9]/gi,'');"
				),
				'TE025' => array(
					'name' => "時段2訖",
					'title_class' => "center",
					'type' => "text",
					'size' => "10",
					'placeholder' => "HHmm",
					'maxlength' => "4",
					'onblur' => "count_time(this);",
					'onkeyup' => "this.value=this.value.replace(/[^0-9]/gi,'');"
				),
				'TE026' => array(
					'name' => "時段3起",
					'title_class' => "center",
					'type' => "text",
					'size' => "10",
					'placeholder' => "HHmm",
					'maxlength' => "4",
					'onblur' => "count_time(this);",
					'onkeyup' => "this.value=this.value.replace(/[^0-9]/gi,'');"
				),
				'TE027' => array(
					'name' => "時段3訖",
					'title_class' => "center",
					'type' => "text",
					'size' => "10",
					'placeholder' => "HHmm",
					'maxlength' => "4",
					'onblur' => "count_time(this);",
					'onkeyup' => "this.value=this.value.replace(/[^0-9]/gi,'');"
				),
				'TE049' => array(
					'name' => "换内夹具黄油",
					'title_class' => "center",
					'data_class' => "center",
					'type' => "select",
					'style' => "background-color:#EEF1CE",
					'onchange' => "count_time(this);",
					'option' => array('1' => "沒換", '2' => "換30分鐘")
				), 
				'TE012' => array(
					'name' => "使用人時",
					'title_class' => "center",
					'type' => "text",
					'size' => "10",
					'value' => "0",
					'style' => "background-color:#F0F0F0",
					'readonly' => "value"
				),
				'TE013' => array(
					'name' => "使用機時",
					'title_class' => "center",
					'type' => "text",
					'size' => "10",
					'value' => "0",
					'style' => "background-color:#F0F0F0",
					'readonly' => "value",
				),
				'TE017' => array(
					'name' => "產品品號",
					'title_class' => "center",
					'type' => "text",
					'size' => "18",
					'value' => "",
					'onblur' => "check_invi02(this);",
					'ondblclick' => "search_invi02_window(this);",
					'style' => "background-color:#F0F0F0",
					'readonly' => "value",
					'onkeyup' => "this.value=this.value.replace(/[^A-Z0-9]/gi,'');this.value=this.value.toLocaleUpperCase();",
					'required' => "required"
				),
				'TE018' => array(
					'name' => "產品品名",
					'title_class' => "center",
					'type' => "text",
					'size' => "50",
					'value' => "",
					'style' => "background-color:#F0F0F0",
					'readonly' => "value",
					'required' => "required"
				),
				'TE019' => array(
					'name' => "產品規格",
					'title_class' => "center",
					'type' => "text",
					'size' => "40",
					'value' => "",
					'style' => "background-color:#F0F0F0",
					'readonly' => "value"
				),
				'TE020' => array(
					'name' => "單位",
					'title_class' => "center",
					'type' => "text",
					'size' => "4",
					'value' => "",
					'style' => "background-color:#F0F0F0",
					'readonly' => "value"
				),

				'TE030' => array(
					'name' => "多人合作",
					'title_class' => "center",
					'type' => "text",
					'size' => "20",
					'value' => "",
					'style' => "background-color:#FFFFE4",
					'ondblclick' => "search_cmsi09ch_window(this);",
					'onkeyup' => "this.value=this.value.replace(/[^A-Z0-9\;]/gi,'');this.value=this.value.toLocaleUpperCase();"
				),
				'TE041' => array(
					'name' => "不良原因",
					'title_class' => "center",
					'type' => "text",
					'size' => "20",
					'value' => "",
					'style' => "background-color:#FFFFE4",
					'ondblclick' => "search_admi13_window(this);",
					'onkeyup' => "this.value=this.value.replace(/[^A-Z0-9\;]/gi,'');this.value=this.value.toLocaleUpperCase();"
				),
				'TE052' => array(
					'name' => "孔小",
					'title_class' => "center",
					'type' => "text",
					'size' => "8",
					'value' => "",
					'onkeyup' => "this.value=this.value.replace(/[^0-9]/gi,'');"
				),
				'TE053' => array(
					'name' => "孔大",
					'title_class' => "center",
					'type' => "text",
					'size' => "8",
					'value' => "",
					'onkeyup' => "this.value=this.value.replace(/[^0-9]/gi,'');"
				),
				'TE054' => array(
					'name' => "氣孔",
					'title_class' => "center",
					'type' => "text",
					'size' => "8",
					'value' => "",
					'onkeyup' => "this.value=this.value.replace(/[^0-9]/gi,'');"
				),
				'TE055' => array(
					'name' => "偏模",
					'title_class' => "center",
					'type' => "text",
					'size' => "8",
					'value' => "",
					'onkeyup' => "this.value=this.value.replace(/[^0-9]/gi,'');"
				),
				'TE056' => array(
					'name' => "白口",
					'title_class' => "center",
					'type' => "text",
					'size' => "8",
					'value' => "",
					'onkeyup' => "this.value=this.value.replace(/[^0-9]/gi,'');"
				),
				'TE057' => array(
					'name' => "冷隔",
					'title_class' => "center",
					'type' => "text",
					'size' => "8",
					'value' => "",
					'onkeyup' => "this.value=this.value.replace(/[^0-9]/gi,'');"
				),
				'TE058' => array(
					'name' => "掉砂",
					'title_class' => "center",
					'type' => "text",
					'size' => "8",
					'value' => "",
					'onkeyup' => "this.value=this.value.replace(/[^0-9]/gi,'');"
				),
				'TE059' => array(
					'name' => "車壞",
					'title_class' => "center",
					'type' => "text",
					'size' => "8",
					'value' => "",
					'onkeyup' => "this.value=this.value.replace(/[^0-9]/gi,'');"
				),
				'TE060' => array(
					'name' => "燒砂",
					'title_class' => "center",
					'type' => "text",
					'size' => "8",
					'value' => "",
					'onkeyup' => "this.value=this.value.replace(/[^0-9]/gi,'');"
				),
				'TE061' => array(
					'name' => "缺邊",
					'title_class' => "center",
					'type' => "text",
					'size' => "8",
					'value' => "",
					'onkeyup' => "this.value=this.value.replace(/[^0-9]/gi,'');"
				),
				'TE062' => array(
					'name' => "綻模",
					'title_class' => "center",
					'type' => "text",
					'size' => "8",
					'value' => "",
					'onkeyup' => "this.value=this.value.replace(/[^0-9]/gi,'');"
				),
				'TE063' => array(
					'name' => "打壞",
					'title_class' => "center",
					'type' => "text",
					'size' => "8",
					'value' => "",
					'onkeyup' => "this.value=this.value.replace(/[^0-9]/gi,'');"
				),
				'TE064' => array(
					'name' => "澆水不足",
					'title_class' => "center",
					'type' => "text",
					'size' => "8",
					'value' => "",
					'onkeyup' => "this.value=this.value.replace(/[^0-9]/gi,'');"
				),
				'TE065' => array(
					'name' => "其他",
					'title_class' => "center",
					'type' => "text",
					'size' => "8",
					'value' => "",
					'onkeyup' => "this.value=this.value.replace(/[^0-9]/gi,'');"
				),
				'TE015' => array(
					'name' => "備註",
					'title_class' => "center",
					'type' => "text",
					'size' => "50",
					'value' => "",
					'ondblclick' => ""
				)
			);

		$this->detail_col_c =
			array(
				'TE003' => array(
					'name' => "序號",
					'title_class' => "center",
					'col_require' => "require",
					'data_class' => "center",
					'type' => "text",
					'size' => "4",
					'readonly' => "readonly"
				),
				'cmsi09d' => array(
					'name' => "員工代號",
					'title_class' => "center",
					'data_class' => "center",
					'type' => "text",
					'size' => "8",
					'id' => "TE004",
					'style' => "background-color:#FFFFE4",
					'onblur' => "check_cmsi09d(this);",
					'ondblclick' => "search_cmsi09d_window(this);",
					'onkeyup' => "this.value=this.value.replace(/[^A-Z0-9]/gi,'');this.value=this.value.toLocaleUpperCase();",
					'required' => "required"
				),
				'cmsi09ddisp' => array(
					'name' => "員工姓名",
					'title_class' => "center",
					'data_class' => "center",
					'id' => "TE004disp",
					'type' => "text",
					'size' => "8",
					'style' => "background-color:#F0F0F0",
					'disabled' => "disabled",
					'readonly' => "value"
				),
				'TE005' => array(
					'name' => "機台代號",
					'title_class' => "center",
					'data_class' => "center",
					'type' => "text",
					'size' => "10",
					'id' => "cmsi03",
					'maxlength' => "10",
					'style' => "background-color:#FFFFE4",
					'onblur' => "check_cmsi03d(this);",
					'ondblclick' => "search_cmsi03d_window(this);",
					'onkeyup' => "this.value=this.value.replace(/[^A-Z0-9]/gi,'');this.value=this.value.toLocaleUpperCase();",
					'required' => "required"
				),
				'TE005disp' => array(
					'name' => "機台名稱",
					'title_class' => "center",
					'data_class' => "center",
					'type' => "text",
					'disabled' => "disabled",
					'size' => "48",
					'style' => "background-color:#F0F0F0",
					'readonly' => "value"
				),
				'TE006' => array(
					'name' => "製令單別",
					'title_class' => "center",
					'data_class' => "center",
					'type' => "text",
					'size' => "8",
					'maxlength' => "4",
					'style' => "background-color:#FFFFE4",
					'onblur' => "check_sfcta(this);",
					'onchange' => "check_sfcta(this);",
					'ondblclick' => "search_sfci03na_window(this);",
					'onkeyup' => "this.value=this.value.replace(/[^0-9]/gi,'');",
					'value' => "5103",
					'required' => "required"
				),
				'TE007' => array(
					'name' => "製令單號",
					'title_class' => "center",
					'data_class' => "center",
					'type' => "text",
					'size' => "12",
					'maxlength' => "11",
					'style' => "background-color:#FFFFE4",
					'ondblclick' => "search_sfci03n_window(this);",
					'onkeyup' => "this.value=this.value.replace(/[^0-9]/gi,'');",
					'required' => "required"
				),
				'TE008' => array(
					'name' => "工序",
					'title_class' => "center",
					'data_class' => "center",
					'type' => "text",
					'size' => "4",
					'style' => "background-color:#F0F0F0",
					'readonly' => "value",
					'required' => "required"
				),

				'TE009' => array(
					'name' => "製程代號",
					'title_class' => "center",
					'data_class' => "center",
					'type' => "text",
					'size' => "8",
					'maxlength' => "4",
					'style' => "background-color:#F0F0F0",
					'onblur' => "check_cmsi19(this);",
					'ondblclick' => "search_cmsi19_window(this);",
					'readonly' => "value",
					'onkeyup' => "this.value=this.value.replace(/[^A-Z0-9]/gi,'');this.value=this.value.toLocaleUpperCase();",
					'required' => "required"
				),
				'TE009disp' => array(
					'name' => "製程名稱",
					'title_class' => "center",
					'data_class' => "center",
					'type' => "text",
					'size' => "8",
					'style' => "background-color:#F0F0F0",
					'readonly' => "value",
					'required' => "required"
				),
				'TE010' => array(
					'name' => "型態",
					'title_class' => "center",
					'data_class' => "center",
					'type' => "select",
					'style' => "background-color:#EEF1CE",
					'option' => array('1' => "正常完成", '2' => "重工完成", '3' => "報廢")
				),
				'TE029' => array(
					'name' => "機台樣式",
					'title_class' => "center",
					'data_class' => "center",
					'type' => "select",
					'style' => "background-color:#EEF1CE",
					'onfocus' => "check_sfci17(this);",
					'onchange' => "check_sfci17(this);",
					'option' => array('1' => "半自動", '2' => "全自動")
				),
				'TE032' => array(
					'name' => "實際模穴數",
					'title_class' => "center",
					'type' => "text",
					'size' => "8",
					'maxlength' => "5",
					'onkeyup' => "this.value=this.value.replace(/[^0-9]/gi,'');",
					'required' => "required"
				),
				'TE050' => array(
					'name' => "加硫時間(秒/模)",
					'title_class' => "center",
					'type' => "text",
					'size' => "10",
					'maxlength' => "8",
					'onkeyup' => "this.value=this.value.replace(/[^0-9]/gi,'');",
					'required' => "required"
				),
				'TE051' => array(
					'name' => "上下料時間(秒/模)",
					'title_class' => "center",
					'type' => "text",
					'size' => "10",
					'maxlength' => "8",
					'onkeyup' => "this.value=this.value.replace(/[^0-9]/gi,'');",
					'required' => "required"
				),
				'TE040' => array(
					'name' => "合格數量",
					'title_class' => "center",
					'type' => "text",
					'size' => "8",
					'maxlength' => "8",
					'onkeyup' => "this.value=this.value.replace(/[^0-9]/gi,'');",
					'onchange' => "sumQ(this);",
					// 'style' => "background-color:#F0F0F0",
					// 'readonly' => "value",
					'value' => "",
					'required' => "required"
				),
				'TE035' => array(
					'name' => "不良總數",
					'title_class' => "center",
					'type' => "text",
					'size' => "8",
					'maxlength' => "8",
					'onkeyup' => "this.value=this.value.replace(/[^0-9]/gi,'');",
					'onchange' => "sumQ(this);",
					'value' => "",
					'required' => "required"
				),
				'TE0333' => array(
					'name' => "生產數量",
					'title_class' => "center",
					'type' => "text",
					'size' => "8",
					// 'maxlength' => "8",
					// 'onkeyup' => "this.value=this.value.replace(/[^0-9]/gi,'');",
					'style' => "background-color:#F0F0F0",
					'readonly' => "value"
				),

				'TE022' => array(
					'name' => "時段1起",
					'title_class' => "center",
					'type' => "text",
					'size' => "10",
					'placeholder' => "HHmm",
					'maxlength' => "4",
					'onblur' => "count_time(this);",
					'onkeyup' => "this.value=this.value.replace(/[^0-9]/gi,'');",
					'required' => "required"
				),
				'TE023' => array(
					'name' => "時段1訖",
					'title_class' => "center",
					'type' => "text",
					'size' => "10",
					'placeholder' => "HHmm",
					'maxlength' => "4",
					'onblur' => "count_time(this);",
					'onkeyup' => "this.value=this.value.replace(/[^0-9]/gi,'');",
					'required' => "required"
				),
				'TE024' => array(
					'name' => "時段2起",
					'title_class' => "center",
					'type' => "text",
					'size' => "10",
					'placeholder' => "HHmm",
					'maxlength' => "4",
					'onblur' => "count_time(this);",
					'onkeyup' => "this.value=this.value.replace(/[^0-9]/gi,'');"
				),
				'TE025' => array(
					'name' => "時段2訖",
					'title_class' => "center",
					'type' => "text",
					'size' => "10",
					'placeholder' => "HHmm",
					'maxlength' => "4",
					'onblur' => "count_time(this);",
					'onkeyup' => "this.value=this.value.replace(/[^0-9]/gi,'');"
				),
				'TE026' => array(
					'name' => "時段3起",
					'title_class' => "center",
					'type' => "text",
					'size' => "10",
					'placeholder' => "HHmm",
					'maxlength' => "4",
					'onblur' => "count_time(this);",
					'onkeyup' => "this.value=this.value.replace(/[^0-9]/gi,'');"
				),
				'TE027' => array(
					'name' => "時段3訖",
					'title_class' => "center",
					'type' => "text",
					'size' => "10",
					'placeholder' => "HHmm",
					'maxlength' => "4",
					'onblur' => "count_time(this);",
					'onkeyup' => "this.value=this.value.replace(/[^0-9]/gi,'');"
				),
				'TE012' => array(
					'name' => "使用人時",
					'title_class' => "center",
					'type' => "text",
					'size' => "10",
					'value' => "0",
					'style' => "background-color:#F0F0F0",
					'readonly' => "value"
				),
				'TE013' => array(
					'name' => "使用機時",
					'title_class' => "center",
					'type' => "text",
					'size' => "10",
					'value' => "0",
					'style' => "background-color:#F0F0F0",
					'readonly' => "value",
				),
				'TE017' => array(
					'name' => "產品品號",
					'title_class' => "center",
					'type' => "text",
					'size' => "18",
					'value' => "",
					'onblur' => "check_invi02(this);",
					'ondblclick' => "search_invi02_window(this);",
					'style' => "background-color:#F0F0F0",
					'readonly' => "value",
					'onkeyup' => "this.value=this.value.replace(/[^A-Z0-9]/gi,'');this.value=this.value.toLocaleUpperCase();",
					'required' => "required"
				),
				'TE018' => array(
					'name' => "產品品名",
					'title_class' => "center",
					'type' => "text",
					'size' => "50",
					'value' => "",
					'style' => "background-color:#F0F0F0",
					'readonly' => "value",
					'required' => "required"
				),
				'TE019' => array(
					'name' => "產品規格",
					'title_class' => "center",
					'type' => "text",
					'size' => "40",
					'value' => "",
					'style' => "background-color:#F0F0F0",
					'readonly' => "value"
				),
				'TE020' => array(
					'name' => "單位",
					'title_class' => "center",
					'type' => "text",
					'size' => "4",
					'value' => "",
					'style' => "background-color:#F0F0F0",
					'readonly' => "value"
				),

				'TE030' => array(
					'name' => "多人合作",
					'title_class' => "center",
					'type' => "text",
					'size' => "20",
					'value' => "",
					'style' => "background-color:#FFFFE4",
					'ondblclick' => "search_cmsi09ch_window(this);",
					'onkeyup' => "this.value=this.value.replace(/[^A-Z0-9\;]/gi,'');this.value=this.value.toLocaleUpperCase();"
				),
				'TE041' => array(
					'name' => "不良原因",
					'title_class' => "center",
					'type' => "text",
					'size' => "20",
					'value' => "",
					'style' => "background-color:#FFFFE4",
					'ondblclick' => "search_admi13_window(this);",
					'onkeyup' => "this.value=this.value.replace(/[^A-Z0-9\;]/gi,'');this.value=this.value.toLocaleUpperCase();"
				),
				'TE015' => array(
					'name' => "備註",
					'title_class' => "center",
					'type' => "text",
					'size' => "12",
					'value' => "",
					'ondblclick' => ""
				)
			);

		$this->detail_col_c1 =
			array(
				'TE003' => array(
					'name' => "序號",
					'title_class' => "center",
					'col_require' => "require",
					'data_class' => "center",
					'type' => "text",
					'size' => "4",
					'readonly' => "readonly"
				),
				'cmsi09d' => array(
					'name' => "員工代號",
					'title_class' => "center",
					'data_class' => "center",
					'type' => "text",
					'size' => "8",
					'id' => "TE004",
					'style' => "background-color:#FFFFE4",
					'onblur' => "check_cmsi09d(this);",
					'ondblclick' => "search_cmsi09d_window(this);",
					'onkeyup' => "this.value=this.value.replace(/[^A-Z0-9]/gi,'');this.value=this.value.toLocaleUpperCase();",
					'required' => "required"
				),
				'cmsi09ddisp' => array(
					'name' => "員工姓名",
					'title_class' => "center",
					'data_class' => "center",
					'id' => "TE004disp",
					'type' => "text",
					'size' => "8",
					'style' => "background-color:#F0F0F0",
					'disabled' => "disabled",
					'readonly' => "value"
				),
				'TE005' => array(
					'name' => "機台代號",
					'title_class' => "center",
					'data_class' => "center",
					'type' => "text",
					'size' => "10",
					'id' => "cmsi03",
					'maxlength' => "10",
					'style' => "background-color:#FFFFE4",
					'onblur' => "check_cmsi03d(this);",
					'ondblclick' => "search_cmsi03d_window(this);",
					'onkeyup' => "this.value=this.value.replace(/[^A-Z0-9]/gi,'');this.value=this.value.toLocaleUpperCase();",
					'required' => "required"
				),
				'TE005disp' => array(
					'name' => "機台名稱",
					'title_class' => "center",
					'data_class' => "center",
					'type' => "text",
					'disabled' => "disabled",
					'size' => "48",
					'style' => "background-color:#F0F0F0",
					'readonly' => "value"
				),
				'TE006' => array(
					'name' => "製令單別",
					'title_class' => "center",
					'data_class' => "center",
					'type' => "text",
					'size' => "8",
					'maxlength' => "4",
					'style' => "background-color:#FFFFE4",
					'onblur' => "check_sfcta(this);",
					'onchange' => "check_sfcta(this);",
					'ondblclick' => "search_sfci03na_window(this);",
					'onkeyup' => "this.value=this.value.replace(/[^0-9]/gi,'');",
					'value' => "5103",
					'required' => "required"
				),
				'TE007' => array(
					'name' => "製令單號",
					'title_class' => "center",
					'data_class' => "center",
					'type' => "text",
					'size' => "12",
					'maxlength' => "11",
					'style' => "background-color:#FFFFE4",
					'ondblclick' => "search_sfci03n_window(this);",
					'onkeyup' => "this.value=this.value.replace(/[^0-9]/gi,'');",
					'required' => "required"
				),
				'TE008' => array(
					'name' => "工序",
					'title_class' => "center",
					'data_class' => "center",
					'type' => "text",
					'size' => "4",
					'style' => "background-color:#F0F0F0",
					'readonly' => "value",
					'required' => "required"
				),

				'TE009' => array(
					'name' => "製程代號",
					'title_class' => "center",
					'data_class' => "center",
					'type' => "text",
					'size' => "8",
					'maxlength' => "4",
					'style' => "background-color:#F0F0F0",
					'onblur' => "check_cmsi19(this);",
					'ondblclick' => "search_cmsi19_window(this);",
					'readonly' => "value",
					'onkeyup' => "this.value=this.value.replace(/[^A-Z0-9]/gi,'');this.value=this.value.toLocaleUpperCase();",
					'required' => "required"
				),
				'TE009disp' => array(
					'name' => "製程名稱",
					'title_class' => "center",
					'data_class' => "center",
					'type' => "text",
					'size' => "8",
					'style' => "background-color:#F0F0F0",
					'readonly' => "value",
					'required' => "required"
				),
				'TE010' => array(
					'name' => "型態",
					'title_class' => "center",
					'data_class' => "center",
					'type' => "select",
					'style' => "background-color:#EEF1CE",
					'option' => array('1' => "正常完成", '2' => "重工完成", '3' => "報廢")
				),
				'TE029' => array(
					'name' => "機台樣式",
					'title_class' => "center",
					'data_class' => "center",
					'type' => "select",
					'style' => "background-color:#EEF1CE",
					'onfocus' => "check_sfci17(this);",
					'onchange' => "check_sfci17(this);",
					'option' => array('1' => "半自動", '2' => "全自動")
				),
				'TE032' => array(
					'name' => "實際完成數(首)",
					'title_class' => "center",
					'type' => "text",
					'size' => "8",
					'maxlength' => "5",
					'onkeyup' => "this.value=this.value.replace(/[^0-9]/gi,'');",
					'required' => "required"
				),

				'TE022' => array(
					'name' => "時段1起",
					'title_class' => "center",
					'type' => "text",
					'size' => "10",
					'placeholder' => "HHmm",
					'maxlength' => "4",
					'onblur' => "count_time(this);",
					'onkeyup' => "this.value=this.value.replace(/[^0-9]/gi,'');",
					'required' => "required"
				),
				'TE023' => array(
					'name' => "時段1訖",
					'title_class' => "center",
					'type' => "text",
					'size' => "10",
					'placeholder' => "HHmm",
					'maxlength' => "4",
					'onblur' => "count_time(this);",
					'onkeyup' => "this.value=this.value.replace(/[^0-9]/gi,'');",
					'required' => "required"
				),
				'TE024' => array(
					'name' => "時段2起",
					'title_class' => "center",
					'type' => "text",
					'size' => "10",
					'placeholder' => "HHmm",
					'maxlength' => "4",
					'onblur' => "count_time(this);",
					'onkeyup' => "this.value=this.value.replace(/[^0-9]/gi,'');"
				),
				'TE025' => array(
					'name' => "時段2訖",
					'title_class' => "center",
					'type' => "text",
					'size' => "10",
					'placeholder' => "HHmm",
					'maxlength' => "4",
					'onblur' => "count_time(this);",
					'onkeyup' => "this.value=this.value.replace(/[^0-9]/gi,'');"
				),
				'TE026' => array(
					'name' => "時段3起",
					'title_class' => "center",
					'type' => "text",
					'size' => "10",
					'placeholder' => "HHmm",
					'maxlength' => "4",
					'onblur' => "count_time(this);",
					'onkeyup' => "this.value=this.value.replace(/[^0-9]/gi,'');"
				),
				'TE027' => array(
					'name' => "時段3訖",
					'title_class' => "center",
					'type' => "text",
					'size' => "10",
					'placeholder' => "HHmm",
					'maxlength' => "4",
					'onblur' => "count_time(this);",
					'onkeyup' => "this.value=this.value.replace(/[^0-9]/gi,'');"
				),
				'TE012' => array(
					'name' => "使用人時",
					'title_class' => "center",
					'type' => "text",
					'size' => "10",
					'value' => "0",
					'style' => "background-color:#F0F0F0",
					'readonly' => "value"
				),
				'TE013' => array(
					'name' => "使用機時",
					'title_class' => "center",
					'type' => "text",
					'size' => "10",
					'value' => "0",
					'style' => "background-color:#F0F0F0",
					'readonly' => "value",
				),
				'TE017' => array(
					'name' => "產品品號",
					'title_class' => "center",
					'type' => "text",
					'size' => "18",
					'value' => "",
					'onblur' => "check_invi02(this);",
					'ondblclick' => "search_invi02_window(this);",
					'style' => "background-color:#F0F0F0",
					'readonly' => "value",
					'onkeyup' => "this.value=this.value.replace(/[^A-Z0-9]/gi,'');this.value=this.value.toLocaleUpperCase();",
					'required' => "required"
				),
				'TE018' => array(
					'name' => "產品品名",
					'title_class' => "center",
					'type' => "text",
					'size' => "50",
					'value' => "",
					'style' => "background-color:#F0F0F0",
					'readonly' => "value",
					'required' => "required"
				),
				'TE019' => array(
					'name' => "產品規格",
					'title_class' => "center",
					'type' => "text",
					'size' => "40",
					'value' => "",
					'style' => "background-color:#F0F0F0",
					'readonly' => "value"
				),
				'TE020' => array(
					'name' => "單位",
					'title_class' => "center",
					'type' => "text",
					'size' => "4",
					'value' => "",
					'style' => "background-color:#F0F0F0",
					'readonly' => "value"
				),
				'TE015' => array(
					'name' => "備註",
					'title_class' => "center",
					'type' => "text",
					'size' => "12",
					'value' => "",
					'ondblclick' => ""
				)
			);

		$this->detail_col_d =
			array(
				'TE003' => array(
					'name' => "序號",
					'title_class' => "center",
					'col_require' => "require",
					'data_class' => "center",
					'type' => "text",
					'size' => "4",
					'readonly' => "readonly"
				),
				'cmsi09d' => array(
					'name' => "員工代號",
					'title_class' => "center",
					'data_class' => "center",
					'type' => "text",
					'size' => "8",
					'id' => "TE004",
					'style' => "background-color:#FFFFE4",
					'onblur' => "check_cmsi09d(this);",
					'ondblclick' => "search_cmsi09d_window(this);",
					'onkeyup' => "this.value=this.value.replace(/[^A-Z0-9]/gi,'');this.value=this.value.toLocaleUpperCase();",
					'required' => "required"
				),
				'cmsi09ddisp' => array(
					'name' => "員工姓名",
					'title_class' => "center",
					'data_class' => "center",
					'id' => "TE004disp",
					'type' => "text",
					'size' => "8",
					'style' => "background-color:#F0F0F0",
					'disabled' => "disabled",
					'readonly' => "value"
				),
				'TE005' => array(
					'name' => "機台代號",
					'title_class' => "center",
					'data_class' => "center",
					'type' => "text",
					'size' => "8",
					'id' => "cmsi03",
					'maxlength' => "6",
					'style' => "background-color:#FFFFE4",
					'onblur' => "check_cmsi03d(this);",
					'ondblclick' => "search_cmsi03d_window(this);",
					'onkeyup' => "this.value=this.value.replace(/[^A-Z0-9]/gi,'');this.value=this.value.toLocaleUpperCase();",
					'required' => "required"
				),
				'TE005disp' => array(
					'name' => "機台名稱",
					'title_class' => "center",
					'data_class' => "center",
					'type' => "text",
					'disabled' => "disabled",
					'size' => "48",
					'style' => "background-color:#F0F0F0",
					'readonly' => "value"
				),
				'TE006' => array(
					'name' => "製令單別",
					'title_class' => "center",
					'data_class' => "center",
					'type' => "text",
					'size' => "8",
					'maxlength' => "4",
					'style' => "background-color:#FFFFE4",
					'onblur' => "check_sfcta(this);",
					'onchange' => "check_sfcta(this);",
					'ondblclick' => "search_sfci03na_window(this);",
					'onkeyup' => "this.value=this.value.replace(/[^0-9]/gi,'');",
					'value' => "5104",
					'required' => "required"
				),
				'TE007' => array(
					'name' => "製令單號",
					'title_class' => "center",
					'data_class' => "center",
					'type' => "text",
					'size' => "12",
					'maxlength' => "11",
					'style' => "background-color:#FFFFE4",
					'ondblclick' => "search_sfci03n_window(this);",
					'onkeyup' => "this.value=this.value.replace(/[^0-9]/gi,'');",
					'required' => "required"
				),
				'TE008' => array(
					'name' => "工序",
					'title_class' => "center",
					'data_class' => "center",
					'type' => "text",
					'size' => "4",
					'style' => "background-color:#F0F0F0",
					'readonly' => "value",
					'required' => "required"
				),

				'TE009' => array(
					'name' => "製程代號",
					'title_class' => "center",
					'data_class' => "center",
					'type' => "text",
					'size' => "8",
					'maxlength' => "4",
					'style' => "background-color:#F0F0F0",
					'onblur' => "check_cmsi19(this);",
					'ondblclick' => "search_cmsi19_window(this);",
					'readonly' => "value",
					'onkeyup' => "this.value=this.value.replace(/[^A-Z0-9]/gi,'');this.value=this.value.toLocaleUpperCase();",
					'required' => "required"
				),
				'TE009disp' => array(
					'name' => "製程名稱",
					'title_class' => "center",
					'data_class' => "center",
					'type' => "text",
					'size' => "8",
					'style' => "background-color:#F0F0F0",
					'readonly' => "value",
					'required' => "required"
				),
				'TE010' => array(
					'name' => "型態",
					'title_class' => "center",
					'data_class' => "center",
					'type' => "select",
					'style' => "background-color:#EEF1CE",
					'option' => array('1' => "正常完成", '2' => "重工完成", '3' => "報廢")
				),
				'TE029' => array(
					'name' => "機台樣式",
					'title_class' => "center",
					'data_class' => "center",
					'type' => "select",
					'style' => "background-color:#EEF1CE",
					'onfocus' => "check_sfci17(this);",
					'onchange' => "check_sfci17(this);",
					'option' => array('1' => "半自動", '2' => "全自動")
				),

				'TE049' => array(
					'name' => "是否使用機械手",
					'title_class' => "center",
					'data_class' => "center",
					'type' => "select",
					'style' => "background-color:#EEF1CE",
					'option' => array('1' => "有", '2' => "")
				),

				'TE032' => array(
					'name' => "實際模穴數",
					'title_class' => "center",
					'type' => "text",
					'size' => "8",
					'maxlength' => "5",
					'onchange' => "Qcount(this);",
					'onkeyup' => "this.value=this.value.replace(/[^0-9]/gi,'');",
					'required' => "required"
				),
				'TE033' => array(
					'name' => "起始模數",
					'title_class' => "center",
					'type' => "text",
					'size' => "10",
					'maxlength' => "10",
					'onchange' => "Qcount(this);",
					'onkeyup' => "this.value=this.value.replace(/[^0-9]/gi,'');",
					'required' => "required"
				),
				'TE034' => array(
					'name' => "結束模數",
					'title_class' => "center",
					'type' => "text",
					'size' => "10",
					'maxlength' => "10",
					'onchange' => "Qcount(this);",
					'onkeyup' => "this.value=this.value.replace(/[^0-9]/gi,'');",
					'required' => "required"
				),
				'TE0111' => array(
					'name' => "模次數",
					'title_class' => "center",
					'type' => "text",
					'size' => "10",
					// 'maxlength' => "8",
					// 'onkeyup' => "this.value=this.value.replace(/[^0-9]/gi,'');",
					'style' => "background-color:#F0F0F0",
					'readonly' => "value"
				),
				'TE040' => array(
					'name' => "合格數量",
					'title_class' => "center",
					'type' => "text",
					'size' => "8",
					'maxlength' => "8",
					'onkeyup' => "this.value=this.value.replace(/[^0-9]/gi,'');",
					'onchange' => "sumQ(this);",
					// 'style' => "background-color:#F0F0F0",
					// 'readonly' => "value",
					'value' => "",
					'required' => "required"
				),
				'TE035' => array(
					'name' => "不良總數",
					'title_class' => "center",
					'type' => "text",
					'size' => "8",
					'maxlength' => "8",
					'onkeyup' => "this.value=this.value.replace(/[^0-9]/gi,'');",
					'onchange' => "sumQ(this);",
					'value' => "",
					'required' => "required"
				),
				'TE0333' => array(
					'name' => "生產數量",
					'title_class' => "center",
					'type' => "text",
					'size' => "8",
					// 'maxlength' => "8",
					// 'onkeyup' => "this.value=this.value.replace(/[^0-9]/gi,'');",
					'style' => "background-color:#F0F0F0",
					'readonly' => "value"
				),
				'TE036' => array(
					'name' => "可粉碎量",
					'title_class' => "center",
					'type' => "text",
					'size' => "8",
					'maxlength' => "8",
					'onkeyup' => "value=value.replace(/^\D*(\d*(?:\.\d{0,1})?).*$/g, '$1');",
					// 'onchange' => "Qcount(this);",
					'value' => "",
					'required' => "required"
				),
				'TE037' => array(
					'name' => "待粉碎量",
					'title_class' => "center",
					'type' => "text",
					'size' => "8",
					'onkeyup' => "value=value.replace(/^\D*(\d*(?:\.\d{0,1})?).*$/g, '$1');",
					// 'onchange' => "Qcount(this);",
					'value' => "0",
					'required' => "required"
				),
				'TE038' => array(
					'name' => "不可粉碎",
					'title_class' => "center",
					'type' => "text",
					'size' => "8",
					'onkeyup' => "value=value.replace(/^\D*(\d*(?:\.\d{0,1})?).*$/g, '$1');",
					// 'onchange' => "Qcount(this);",
					'value' => "0",
					'required' => "required"
				),
				'TE039' => array(
					'name' => "水口數量(KG)",
					'title_class' => "center",
					'type' => "text",
					'size' => "8",
					'onkeyup' => "value=value.replace(/^\D*(\d*(?:\.\d{0,1})?).*$/g, '$1');",
					'value' => "",
					'required' => "required"
				),

				'TE042' => array(
					'name' => "過管料可回收數量(KG)",
					'title_class' => "center",
					'type' => "text",
					'size' => "8",
					'onkeyup' => "value=value.replace(/^\D*(\d*(?:\.\d{0,1})?).*$/g, '$1');",
					'value' => "0",
					'required' => "required"
				),
				'TE043' => array(
					'name' => "過管料可回收已粉碎(KG)",
					'title_class' => "center",
					'type' => "text",
					'size' => "8",
					'onkeyup' => "value=value.replace(/^\D*(\d*(?:\.\d{0,1})?).*$/g, '$1');",
					'value' => "0",
					'required' => "required"
				),
				'TE044' => array(
					'name' => "過管料可回收未粉碎(KG)",
					'title_class' => "center",
					'type' => "text",
					'size' => "8",
					'onkeyup' => "value=value.replace(/^\D*(\d*(?:\.\d{0,1})?).*$/g, '$1');",
					'value' => "0",
					'required' => "required"
				),
				'TE045' => array(
					'name' => "過管料不可回收數量(KG)",
					'title_class' => "center",
					'type' => "text",
					'size' => "8",
					'onkeyup' => "value=value.replace(/^\D*(\d*(?:\.\d{0,3})?).*$/g, '$1');",
					'value' => "0",
					'required' => "required"
				),

				'TE022' => array(
					'name' => "時段1起",
					'title_class' => "center",
					'type' => "text",
					'size' => "10",
					'placeholder' => "HHmm",
					'maxlength' => "4",
					'onblur' => "count_time(this);",
					'onkeyup' => "this.value=this.value.replace(/[^0-9]/gi,'');",
					'required' => "required"
				),
				'TE023' => array(
					'name' => "時段1訖",
					'title_class' => "center",
					'type' => "text",
					'size' => "10",
					'placeholder' => "HHmm",
					'maxlength' => "4",
					'onblur' => "count_time(this);",
					'onkeyup' => "this.value=this.value.replace(/[^0-9]/gi,'');",
					'required' => "required"
				),
				'TE024' => array(
					'name' => "時段2起",
					'title_class' => "center",
					'type' => "text",
					'size' => "10",
					'placeholder' => "HHmm",
					'maxlength' => "4",
					'onblur' => "count_time(this);",
					'onkeyup' => "this.value=this.value.replace(/[^0-9]/gi,'');"
				),
				'TE025' => array(
					'name' => "時段2訖",
					'title_class' => "center",
					'type' => "text",
					'size' => "10",
					'placeholder' => "HHmm",
					'maxlength' => "4",
					'onblur' => "count_time(this);",
					'onkeyup' => "this.value=this.value.replace(/[^0-9]/gi,'');"
				),
				'TE026' => array(
					'name' => "時段3起",
					'title_class' => "center",
					'type' => "text",
					'size' => "10",
					'placeholder' => "HHmm",
					'maxlength' => "4",
					'onblur' => "count_time(this);",
					'onkeyup' => "this.value=this.value.replace(/[^0-9]/gi,'');"
				),
				'TE027' => array(
					'name' => "時段3訖",
					'title_class' => "center",
					'type' => "text",
					'size' => "10",
					'placeholder' => "HHmm",
					'maxlength' => "4",
					'onblur' => "count_time(this);",
					'onkeyup' => "this.value=this.value.replace(/[^0-9]/gi,'');"
				),
				'TE012' => array(
					'name' => "使用人時",
					'title_class' => "center",
					'type' => "text",
					'size' => "10",
					'value' => "0",
					'style' => "background-color:#F0F0F0",
					'readonly' => "value"
				),
				'TE013' => array(
					'name' => "使用機時",
					'title_class' => "center",
					'type' => "type",
					'size' => "10",
					'value' => "0",
					'style' => "background-color:#F0F0F0",
					'readonly' => "value",
				),
				'TE017' => array(
					'name' => "產品品號",
					'title_class' => "center",
					'type' => "text",
					'size' => "18",
					'value' => "",
					'onblur' => "check_invi02(this);",
					'ondblclick' => "search_invi02_window(this);",
					'style' => "background-color:#F0F0F0",
					'readonly' => "value",
					'onkeyup' => "this.value=this.value.replace(/[^A-Z0-9]/gi,'');this.value=this.value.toLocaleUpperCase();",
					'required' => "required"
				),
				'TE018' => array(
					'name' => "產品品名",
					'title_class' => "center",
					'type' => "text",
					'size' => "50",
					'value' => "",
					'style' => "background-color:#F0F0F0",
					'readonly' => "value",
					'required' => "required"
				),
				'TE019' => array(
					'name' => "產品規格",
					'title_class' => "center",
					'type' => "text",
					'size' => "40",
					'value' => "",
					'style' => "background-color:#F0F0F0",
					'readonly' => "value"
				),
				'TE020' => array(
					'name' => "單位",
					'title_class' => "center",
					'type' => "text",
					'size' => "4",
					'value' => "",
					'style' => "background-color:#F0F0F0",
					'readonly' => "value"
				),

				'TE030' => array(
					'name' => "多人合作",
					'title_class' => "center",
					'type' => "text",
					'size' => "20",
					'value' => "",
					'style' => "background-color:#FFFFE4",
					'ondblclick' => "search_cmsi09ch_window(this);",
					'onkeyup' => "this.value=this.value.replace(/[^A-Z0-9\;]/gi,'');this.value=this.value.toLocaleUpperCase();"
				),
				'TE041' => array(
					'name' => "不良原因",
					'title_class' => "center",
					'type' => "text",
					'size' => "20",
					'value' => "",
					'style' => "background-color:#FFFFE4",
					'ondblclick' => "search_admi13_window(this);",
					'onkeyup' => "this.value=this.value.replace(/[^A-Z0-9\;]/gi,'');this.value=this.value.toLocaleUpperCase();"
				),
				'TE052' => array(
					'name' => "雜色",
					'title_class' => "center",
					'type' => "text",
					'size' => "8",
					'value' => "",
					'onkeyup' => "this.value=this.value.replace(/[^0-9]/gi,'');"
				),
				'TE053' => array(
					'name' => "油污",
					'title_class' => "center",
					'type' => "text",
					'size' => "8",
					'value' => "",
					'onkeyup' => "this.value=this.value.replace(/[^0-9]/gi,'');"
				),
				'TE054' => array(
					'name' => "缺膠",
					'title_class' => "center",
					'type' => "text",
					'size' => "8",
					'value' => "",
					'onkeyup' => "this.value=this.value.replace(/[^0-9]/gi,'');"
				),
				'TE055' => array(
					'name' => "外觀不良",
					'title_class' => "center",
					'type' => "text",
					'size' => "8",
					'value' => "",
					'onkeyup' => "this.value=this.value.replace(/[^0-9]/gi,'');"
				),
				'TE056' => array(
					'name' => "調機",
					'title_class' => "center",
					'type' => "text",
					'size' => "8",
					'value' => "",
					'onkeyup' => "this.value=this.value.replace(/[^0-9]/gi,'');"
				),
				'TE057' => array(
					'name' => "黑點",
					'title_class' => "center",
					'type' => "text",
					'size' => "8",
					'value' => "",
					'onkeyup' => "this.value=this.value.replace(/[^0-9]/gi,'');"
				),
				'TE058' => array(
					'name' => "料花",
					'title_class' => "center",
					'type' => "text",
					'size' => "8",
					'value' => "",
					'onkeyup' => "this.value=this.value.replace(/[^0-9]/gi,'');"
				),
				'TE059' => array(
					'name' => "漏膠",
					'title_class' => "center",
					'type' => "text",
					'size' => "8",
					'value' => "",
					'onkeyup' => "this.value=this.value.replace(/[^0-9]/gi,'');"
				),
				'TE060' => array(
					'name' => "縮水",
					'title_class' => "center",
					'type' => "text",
					'size' => "8",
					'value' => "",
					'onkeyup' => "this.value=this.value.replace(/[^0-9]/gi,'');"
				),
				'TE061' => array(
					'name' => "孔大",
					'title_class' => "center",
					'type' => "text",
					'size' => "8",
					'value' => "",
					'onkeyup' => "this.value=this.value.replace(/[^0-9]/gi,'');"
				),
				'TE062' => array(
					'name' => "起泡",
					'title_class' => "center",
					'type' => "text",
					'size' => "8",
					'value' => "",
					'onkeyup' => "this.value=this.value.replace(/[^0-9]/gi,'');"
				),
				'TE063' => array(
					'name' => "頂白",
					'title_class' => "center",
					'type' => "text",
					'size' => "8",
					'value' => "",
					'onkeyup' => "this.value=this.value.replace(/[^0-9]/gi,'');"
				),
				'TE064' => array(
					'name' => "其他",
					'title_class' => "center",
					'type' => "text",
					'size' => "8",
					'value' => "",
					'onkeyup' => "this.value=this.value.replace(/[^0-9]/gi,'');"
				),
				'TE015' => array(
					'name' => "備註",
					'title_class' => "center",
					'type' => "text",
					'size' => "12",
					'value' => "",
					'ondblclick' => ""
				)
			);

		$this->detail_col_l =
			array(
				'TE003' => array(
					'name' => "序號",
					'title_class' => "center",
					'col_require' => "require",
					'data_class' => "center",
					'type' => "text",
					'size' => "4",
					'readonly' => "readonly"
				),
				'cmsi09d' => array(
					'name' => "員工代號",
					'title_class' => "center",
					'data_class' => "center",
					'type' => "text",
					'size' => "8",
					'id' => "TE004",
					'style' => "background-color:#FFFFE4",
					'onblur' => "check_cmsi09d(this);",
					'ondblclick' => "search_cmsi09d_window(this);",
					'onkeyup' => "this.value=this.value.replace(/[^A-Z0-9]/gi,'');this.value=this.value.toLocaleUpperCase();",
					'required' => "required"
				),
				'cmsi09ddisp' => array(
					'name' => "員工姓名",
					'title_class' => "center",
					'data_class' => "center",
					'id' => "TE004disp",
					'type' => "text",
					'size' => "8",
					'style' => "background-color:#F0F0F0",
					'disabled' => "disabled",
					'readonly' => "value"
				),
				'TE005' => array(
					'name' => "機台代號",
					'title_class' => "center",
					'data_class' => "center",
					'type' => "text",
					'size' => "8",
					'id' => "cmsi03",
					'maxlength' => "6",
					'style' => "background-color:#FFFFE4",
					'onblur' => "check_cmsi03d(this);",
					'ondblclick' => "search_cmsi03d_window(this);",
					'onkeyup' => "this.value=this.value.replace(/[^A-Z0-9]/gi,'');this.value=this.value.toLocaleUpperCase();",
					'required' => "required"
				),
				'TE005disp' => array(
					'name' => "機台名稱",
					'title_class' => "center",
					'data_class' => "center",
					'type' => "text",
					'disabled' => "disabled",
					'size' => "48",
					'style' => "background-color:#F0F0F0",
					'readonly' => "value"
				),
				'TE006' => array(
					'name' => "製令單別",
					'title_class' => "center",
					'data_class' => "center",
					'type' => "text",
					'size' => "8",
					'maxlength' => "4",
					'style' => "background-color:#FFFFE4",
					'onblur' => "check_sfcta(this);",
					'onchange' => "check_sfcta(this);",
					'disabled' => "disabled",
					'ondblclick' => "search_sfci03na_window(this);",
					'onkeyup' => "this.value=this.value.replace(/[^0-9]/gi,'');",
					'value' => "5103",
					'required' => "required"
				),
				'TE007' => array(
					'name' => "製令單號",
					'title_class' => "center",
					'data_class' => "center",
					'type' => "text",
					'size' => "12",
					'maxlength' => "11",
					'disabled' => "disabled",
					'style' => "background-color:#FFFFE4",
					'ondblclick' => "search_sfci03n_window(this);",
					'onkeyup' => "this.value=this.value.replace(/[^0-9]/gi,'');",
					'required' => "required"
				),
				'TE008' => array(
					'name' => "工序",
					'title_class' => "center",
					'data_class' => "center",
					'type' => "text",
					'size' => "4",
					'disabled' => "disabled",
					'style' => "background-color:#F0F0F0",
					'readonly' => "value",
					'required' => "required"
				),

				'TE009' => array(
					'name' => "製程代號",
					'title_class' => "center",
					'data_class' => "center",
					'type' => "text",
					'size' => "8",
					'maxlength' => "4",
					'disabled' => "disabled",
					'style' => "background-color:#F0F0F0",
					'onblur' => "check_cmsi19(this);",
					'ondblclick' => "search_cmsi19_window(this);",
					'readonly' => "value",
					'onkeyup' => "this.value=this.value.replace(/[^A-Z0-9]/gi,'');this.value=this.value.toLocaleUpperCase();",
					'required' => "required"
				),
				'TE009disp' => array(
					'name' => "製程名稱",
					'title_class' => "center",
					'data_class' => "center",
					'type' => "text",
					'size' => "30",
					'disabled' => "disabled",
					'style' => "background-color:#F0F0F0",
					'readonly' => "value",
					'required' => "required"
				),
				/*'TE010' => array(
					'name' => "型態",
					'title_class' => "center",
					'data_class' => "center",
					'type' => "select",
					'style' => "background-color:#EEF1CE",
					'option' => array('1' => "正常完成", '2' => "重工完成", '3' => "報廢")
				),
				'TE029' => array(
					'name' => "機台樣式",
					'title_class' => "center",
					'data_class' => "center",
					'type' => "select",
					'style' => "background-color:#EEF1CE",
					'option' => array('1' => "單衝(手動)", '2' => "連續")
				),*/
				'TE011' => array(
					'name' => "數量",
					'title_class' => "center",
					'type' => "text",
					'size' => "8",
					'maxlength' => "8",
					'disabled' => "disabled",
					'style' => "background-color:#F0F0F0",
					'onkeyup' => "this.value=this.value.replace(/[^0-9]/gi,'');",
					'onchange' => "count_pcs(this);",
					'required' => "required"
				),
				/*'TE028' => array(
					'name' => "可返修數量",
					'title_class' => "center",
					'type' => "text",
					'size' => "8",
					'maxlength' => "8",
					'onkeyup' => "this.value=this.value.replace(/[^0-9]/gi,'');",
					'onchange' => "count_pcs(this);",
					'value' => "0",
					'required' => "required"
				),
				'TE031' => array(
					'name' => "報廢品數量",
					'title_class' => "center",
					'type' => "text",
					'size' => "8",
					'maxlength' => "8",
					'onkeyup' => "this.value=this.value.replace(/[^0-9]/gi,'');",
					'onchange' => "count_pcs(this);",
					'value' => "0",
					'required' => "required"
				),
				'TE0311' => array(
					'name' => "不良品數量",
					'title_class' => "center",
					'type' => "text",
					'size' => "8",
					'style' => "background-color:#F0F0F0",
					'readonly' => "value",
					'value' => "0"
				),
				'TE0312' => array(
					'name' => "合格數量",
					'title_class' => "center",
					'type' => "text",
					'size' => "8",
					'style' => "background-color:#F0F0F0",
					'readonly' => "value",
					'value' => "0"
				),*/
				'TE022' => array(
					'name' => "時段1起",
					'title_class' => "center",
					'type' => "text",
					'size' => "10",
					'placeholder' => "HHmm",
					'maxlength' => "4",
					'onblur' => "count_time(this);",
					'onkeyup' => "this.value=this.value.replace(/[^0-9]/gi,'');",
					'required' => "required"
				),
				'TE023' => array(
					'name' => "時段1訖",
					'title_class' => "center",
					'type' => "text",
					'size' => "10",
					'placeholder' => "HHmm",
					'maxlength' => "4",
					'onblur' => "count_time(this);",
					'onkeyup' => "this.value=this.value.replace(/[^0-9]/gi,'');",
					'required' => "required"
				),
				'TE024' => array(
					'name' => "時段2起",
					'title_class' => "center",
					'type' => "text",
					'size' => "10",
					'placeholder' => "HHmm",
					'maxlength' => "4",
					'onblur' => "count_time(this);",
					'onkeyup' => "this.value=this.value.replace(/[^0-9]/gi,'');"
				),
				'TE025' => array(
					'name' => "時段2訖",
					'title_class' => "center",
					'type' => "text",
					'size' => "10",
					'placeholder' => "HHmm",
					'maxlength' => "4",
					'onblur' => "count_time(this);",
					'onkeyup' => "this.value=this.value.replace(/[^0-9]/gi,'');"
				),
				'TE026' => array(
					'name' => "時段3起",
					'title_class' => "center",
					'type' => "text",
					'size' => "10",
					'placeholder' => "HHmm",
					'maxlength' => "4",
					'onblur' => "count_time(this);",
					'onkeyup' => "this.value=this.value.replace(/[^0-9]/gi,'');"
				),
				'TE027' => array(
					'name' => "時段3訖",
					'title_class' => "center",
					'type' => "text",
					'size' => "10",
					'placeholder' => "HHmm",
					'maxlength' => "4",
					'onblur' => "count_time(this);",
					'onkeyup' => "this.value=this.value.replace(/[^0-9]/gi,'');"
				),
				'TE012' => array(
					'name' => "使用人時",
					'title_class' => "center",
					'type' => "text",
					'size' => "10",
					'value' => "0",
					'style' => "background-color:#F0F0F0",
					'readonly' => "value"
				),
				'TE013' => array(
					'name' => "使用機時",
					'title_class' => "center",
					'type' => "text",
					'size' => "10",
					'value' => "0",
					'style' => "background-color:#F0F0F0",
					'readonly' => "value",
				),
				'TE017' => array(
					'name' => "產品品號",
					'title_class' => "center",
					'type' => "text",
					'size' => "18",
					'value' => "",
					'onblur' => "check_invi02(this);",
					'ondblclick' => "search_invi02_window(this);",
					'style' => "background-color:#F0F0F0",
					'readonly' => "value",
					'onkeyup' => "this.value=this.value.replace(/[^A-Z0-9]/gi,'');this.value=this.value.toLocaleUpperCase();",
					'required' => "required"
				),
				'TE018' => array(
					'name' => "產品品名",
					'title_class' => "center",
					'type' => "text",
					'size' => "50",
					'value' => "",
					'style' => "background-color:#F0F0F0",
					'readonly' => "value",
					'required' => "required"
				),
				'TE019' => array(
					'name' => "產品規格",
					'title_class' => "center",
					'type' => "text",
					'size' => "40",
					'value' => "",
					'style' => "background-color:#F0F0F0",
					'readonly' => "value"
				),
				'TE020' => array(
					'name' => "單位",
					'title_class' => "center",
					'type' => "text",
					'size' => "4",
					'value' => "",
					'style' => "background-color:#F0F0F0",
					'readonly' => "value"
				),

				'TE030' => array(
					'name' => "多人合作",
					'title_class' => "center",
					'type' => "text",
					'size' => "20",
					'value' => "",
					'style' => "background-color:#FFFFE4",
					'ondblclick' => "search_cmsi09ch_window(this);",
					'onkeyup' => "this.value=this.value.replace(/[^A-Z0-9\;]/gi,'');this.value=this.value.toLocaleUpperCase();"
				),
				'TE015' => array(
					'name' => "備註",
					'title_class' => "center",
					'type' => "text",
					'size' => "12",
					'value' => "",
					'ondblclick' => ""
				)
			);
	}

	/*'tg024' => array(
					'name' => "急料",
					'title_class' => "center",
					'data_class' => "center",
					'type' => "checkbox" */

	public function index()           //自訂類預設執行函數 流覽資料
	{
		$this->display_search();
	}

	public function display($offset = 0, $func = "")    //欄位表頭排序與display_search 同
	{
		if (session_status() == PHP_SESSION_NONE) {
			session_start();
			unset($_SESSION['sfci03n']['search']);
		}
		$this->display_search();
	}

	//欄位表頭排序 資料流覽 
	public function display_search($offset = 0, $func = "")
	{
		//權限控管--------------------------------
		$user = trim($this->session->userdata('sysuser'));
		$super = trim($this->session->userdata('syssuper'));
		$rms = trim($this->session->userdata('sysuserrms'));
		$prom = substr($rms, 2, 1);

		if (!$user) {
			redirect('/login/');
		}
		if (!($super == 'Y' || $prom == 'Y')) {
			$_SESSION['rms'] = 'N';
			redirect('/main'); //跳回首頁
		}
		//權限控管--------------------------------END

		if (session_status() == PHP_SESSION_NONE) {
			session_start();
		}
		if ($this->input->post('submit')) {	//如果是由find_v送過來的，reset session
			unset($_SESSION['sfci03n']['search']);
		}

		// echo "<pre>";var_dump($test);exit;

		$limit = 15;    //每頁筆數
		$this->load->model('sfc/sfci03n_model'); // 加載TABLE model 模型
		//echo "<pre>";var_dump($limit);exit;

		$result = $this->sfci03n_model->construct_sql($limit, $offset, $func); //至model 取 mysql 資料 預設 15,0,tf001,desc
		$data['results'] = $result['data'];
		$data['num_results'] = $result['num'];
		$data['numrow'] = $result['num']; // 總筆數 
		$data['page'] = $result['num'] / $limit; // 總頁數
		$data['sql'] = $_SESSION['sfci03n']['search']['sql'];  //顯示sql語法
		// $data['message'] = '資料瀏覽成功!<br>查詢條件:'.$data['sql']."<br>";
		$data['message'] = '資料瀏覽成功!';
		$data['sort_order'] = "desc";
		$this->load->library('pagination');
		$config = array();
		//$config['NUM_LINKS'] = 2;   //分頁前後出現2個數字
		$config['per_page'] = '15'; // 每頁筆數 必填
		$config['first_link'] = '首頁';
		$config['last_link'] = '尾頁';
		$config['next_link'] = '下一頁>';
		$config['prev_link'] = '<上一頁';
		$config['display_pages'] = TRUE;  //顯示數字鏈接 
		$config['full_tag_open'] = '<p>';  // 分頁開始樣式
		$config['full_tag_close'] = '</p>';   // 分頁结束樣式	
		$config['cur_tag_open'] = ' <a class="current">'; // 當前頁開始樣式
		$config['cur_tag_close'] = '</a>'; // 當前頁结束樣式
		$config['cur_page'] = $this->uri->segment(4, 0);   //當前頁 結合分頁url路徑 +1 url第四段無就置放0
		$config['base_url'] = site_url("sfc/sfci03n/display_search");   //設定分頁url路徑
		/* 網址去除".html" explode 字串進行切割 陣列,  */
		$temp_url = explode(".html", $config['base_url']);
		$config['base_url'] = "";
		foreach ($temp_url as $key => $val) {
			$config['base_url'] .= $val;
		}

		$config['total_rows'] = $result['num']; // 總筆數
		$config['per_page'] = $limit;                //每頁筆數
		$config['uri_segment'] = 4;       //當前頁
		$this->pagination->initialize($config);     //分頁初始化 display 3 + 2 + 1 = 6
		$data['pagination'] = $this->pagination->create_links();
		$data['username'] = $this->session->userdata('manager');
		$data['curpage'] = $this->uri->segment(4, 1);   //當前頁第4無時顯示 1
		$data['limit'] = $limit;    //每頁筆數
		$data['systitle'] = '報工單日結查詢';
		$data['menu_v'] = 'main_menu_v';
		// $data['content_v'] = 'sfc/sfci03n_brow_v';
		// $data['foot_v'] = 'main_foot_v';
		$this->load->vars($data);
		// $this->load->view('main_headbrow_v');
		$this->load->view('sfc/sfci03n_brow_v');
	}

	public function displayr($offset = 0, $func = "")
	{
		if (session_status() == PHP_SESSION_NONE) {
			session_start();
		}
		if ($this->input->post('submit')) {	//如果是由find_v送過來的，reset session
			unset($_SESSION['sfci03n']['search']);
		}

		// echo "<pre>";var_dump($test);exit;

		$limit = 15;    //每頁筆數
		$this->load->model('sfc/sfci03n_model'); // 加載TABLE model 模型
		//echo "<pre>";var_dump($limit);exit;

		$result = $this->sfci03n_model->construct_sqlr($limit, $offset, $func); //至model 取 mysql 資料 預設 15,0,tf001,desc
		$data['results'] = $result['data'];
		$data['num_results'] = $result['num'];
		$data['numrow'] = $result['num']; // 總筆數 
		$data['page'] = $result['num'] / $limit; // 總頁數
		$data['sql'] = $_SESSION['sfci03n']['search']['sql'];  //顯示sql語法
		// $data['message'] = '資料瀏覽成功!<br>查詢條件:'.$data['sql']."<br>";
		$data['message'] = '資料瀏覽成功!';
		$data['sort_order'] = "desc";
		$this->load->library('pagination');
		$config = array();
		//$config['NUM_LINKS'] = 2;   //分頁前後出現2個數字
		$config['per_page'] = '15'; // 每頁筆數 必填
		$config['first_link'] = '首頁';
		$config['last_link'] = '尾頁';
		$config['next_link'] = '下一頁>';
		$config['prev_link'] = '<上一頁';
		$config['display_pages'] = TRUE;  //顯示數字鏈接 
		$config['full_tag_open'] = '<p>';  // 分頁開始樣式
		$config['full_tag_close'] = '</p>';   // 分頁结束樣式	
		$config['cur_tag_open'] = ' <a class="current">'; // 當前頁開始樣式
		$config['cur_tag_close'] = '</a>'; // 當前頁结束樣式
		$config['cur_page'] = $this->uri->segment(4, 0);   //當前頁 結合分頁url路徑 +1 url第四段無就置放0
		$config['base_url'] = site_url("sfc/sfci03n/displayr");   //設定分頁url路徑
		/* 網址去除".html" explode 字串進行切割 陣列,  */
		$temp_url = explode(".html", $config['base_url']);
		$config['base_url'] = "";
		foreach ($temp_url as $key => $val) {
			$config['base_url'] .= $val;
		}

		$config['total_rows'] = $result['num']; // 總筆數
		$config['per_page'] = $limit;                //每頁筆數
		$config['uri_segment'] = 4;       //當前頁
		$this->pagination->initialize($config);     //分頁初始化 display 3 + 2 + 1 = 6
		$data['pagination'] = $this->pagination->create_links();
		$data['username'] = $this->session->userdata('manager');
		$data['curpage'] = $this->uri->segment(4, 1);   //當前頁第4無時顯示 1
		$data['limit'] = $limit;    //每頁筆數
		$data['systitle'] = '生產工價報表查詢';
		$data['menu_v'] = 'main_menu_v';
		// $data['content_v'] = 'sfc/sfci03n_brow_v';
		// $data['foot_v'] = 'main_foot_v';
		$this->load->vars($data);
		// $this->load->view('main_headbrow_v');
		$this->load->view('sfc/sfci03n_browr_v');
	}

	public function construct_sql($offset = 0, $func = "")
	{
		$limit = 15;
		$this->load->model('sfc/sfci03n_model'); // 加載TABLE model 模型
		$this->sfci03n_model->construct_sql($limit, $offset, $func);
	}

	//欄位表頭排序   資料流覽construct_sql2 須隠藏某一個條件 如離職不顯示用
	public function display_leave($offset = 0, $func = "")
	{
		if (session_status() == PHP_SESSION_NONE) {
			session_start();
		}
		if ($this->input->post('submit')) {	//如果是由find_v送過來的，reset session
			unset($_SESSION['sfci03n']['search']);
		}
		$limit = 15;    //每頁筆數
		$this->load->model('sfc/sfci03n_model'); // 加載TABLE model 模型
		$result = $this->sfci03n_model->construct_sql2($limit, $offset, $func); //至model 取 mysql 資料 預設 15,0,tf001,desc
		$data['results'] = $result['data'];
		$data['num_results'] = $result['num'];
		$data['numrow'] = $result['num']; // 總筆數 
		$data['page'] = $result['num'] / $limit; // 總頁數
		$data['sql'] = $_SESSION['sfci03n']['search']['sql'];
		//$data['message'] = '資料瀏覽成功!<br>查詢條件:'.$data['sql']."<br>";
		$data['message'] = '資料瀏覽成功!';
		$data['sort_order'] = "desc";
		$this->load->library('pagination');
		$config = array();
		$config['per_page'] = '15'; // 每頁筆數 必填
		$config['first_link'] = '首頁';
		$config['last_link'] = '尾頁';
		$config['next_link'] = '下一頁>';
		$config['prev_link'] = '<上一頁';
		$config['display_pages'] = TRUE;  //顯示數字鏈接 
		$config['full_tag_open'] = '<p>';  // 分頁開始樣式
		$config['full_tag_close'] = '</p>';   // 分頁结束樣式	
		$config['cur_tag_open'] = ' <a class="current">'; // 當前頁開始樣式
		$config['cur_tag_close'] = '</a>'; // 當前頁结束樣式
		$config['cur_page'] = $this->uri->segment(4, 0);   //當前頁 結合分頁url路徑 +1
		$config['base_url'] = site_url("sfc/sfci03n/display_leave");   //設定分頁url路徑
		/* 網址去除".html" */
		$temp_url = explode(".html", $config['base_url']);
		$config['base_url'] = "";
		foreach ($temp_url as $key => $val) {
			$config['base_url'] .= $val;
		}

		$config['total_rows'] = $result['num']; // 總筆數
		$config['per_page'] = $limit;                //每頁筆數
		$config['uri_segment'] = 4;       //當前頁
		$this->pagination->initialize($config);     //分頁初始化 display 3 + 2 + 1 = 6
		$data['pagination'] = $this->pagination->create_links();
		$data['username'] = $this->session->userdata('manager');
		$data['curpage'] = $this->uri->segment(4, 1);   //當前頁第6無時顯示 1
		$data['limit'] = $limit;    //每頁筆數
		$data['systitle'] = '員工基本資料建立作業';
		$data['menu_v'] = 'main_menu_v';
		$data['content_v'] = 'sfc/sfci03n_browl_v';
		$data['foot_v'] = 'main_foot_v';
		$this->load->vars($data);
		$this->load->view('main_headbrow_v');
	}

	//iconv_substr('字串', 0, 20, 'utf-8'); 擷取字串前幾個字並避免截掉半個中文字

	// 下拉視窗不更新網頁查 品號品名
	public function lookup()
	{
		$keyword = urldecode(urldecode($this->uri->segment(4)));
		$data['response'] = 'false'; //Set default response 
		$this->load->model('sfc/sfci03n_model');
		$query = $this->sfci03n_model->lookup(urldecode(urldecode($this->uri->segment(4)))); //Search DB 

		if (!empty($query)) {
			$data['response'] = 'true'; //Set response  
			$data['message'] = array(); //Create array  
			foreach ($query as $row) {
				$data['message'][] = array(
					'category' => '',
					'value' => $row->mb001 . ',' . $row->mb002 . ',' . $row->mb003 . ',' . $row->mb004,
					'value1' => $row->mb001,
					'value2' => $row->mb002,
					'value3' => $row->mb003,
					'value4' => $row->mb004,
					''
				);  //Add a row to array  
			}
		}
		if ('IS_AJAX') {
			echo json_encode($data); //echo json string if ajax request 指定回傳格式 字串陣列
		} else {
			$this->load->view('sfc/sfci03n_model/lookup', $data);
			// $this->index; //Load html view of search results  
		}
	}

	// 下拉視窗不更新網頁查 交貨庫別
	public function lookupa()
	{
		$keyword = urldecode(urldecode($this->uri->segment(4)));
		$data['response'] = 'false'; //Set default response 
		$this->load->model('sfc/sfci03n_model');
		$query = $this->sfci03n_model->lookupa(urldecode(urldecode($this->uri->segment(4)))); //Search DB 

		if (!empty($query)) {
			$data['response'] = 'true'; //Set response  
			$data['message'] = array(); //Create array  
			foreach ($query as $row) {
				$data['message'][] = array(
					'category' => '',
					'value' => $row->mc001 . ',' . $row->mc002,
					'value1' => $row->mc001,
					'value2' => $row->mc002,
					''
				);  //Add a row to array  
			}
		}
		if ('IS_AJAX') {
			echo json_encode($data); //echo json string if ajax request
		} else {
			$this->load->view('sfc/sfci03n_model/lookupa', $data);
			// $this->index; //Load html view of search results  
		}
	}

	/* 不用此功能 1060814	
	  public function datapurq04a()   //提示改輸入資料如 移轉單別   不更新網頁
          {
	        $this->load->model('sfc/sfci03n_model');
	        $data['result'] = $this->sfci03n_model->ajaxpurq04a($this->uri->segment(4));
            $Result = $data['result'];		  
	        $this->load->vars($data);
	        echo  $Result;
          }
		
	  public function datacmsq05a()   //提示改輸入資料如 請購部門 不更新網頁
        {
	      $this->load->model('sfc/sfci03n_model');
	      $data['result'] = $this->sfci03n_model->ajaxcmsq05a($this->uri->segment(4));
          $Result = $data['result'];		  
	      $this->load->vars($data);
	      echo  $Result;
        }
		
	  public function datacmsq02a()  //提示改輸入資料如 廠別 不更新網頁td010
        {
	      $this->load->model('sfc/sfci03n_model');
	      $data['result'] = $this->sfci03n_model->ajaxcmsq02a($this->uri->segment(4));
          $Result = $data['result'];		  
	      $this->load->vars($data);
	      echo  $Result;
        }
		
	  public function datapalq01a()  //提示改輸入資料如 請購人員 不更新網頁td012
        {
	      $this->load->model('sfc/sfci03n_model');
	      $data['result'] = $this->sfci03n_model->ajaxpalq01a($this->uri->segment(4));
          $Result = $data['result'];		  
	      $this->load->vars($data);
	      echo  $Result;
        }
		
	  public function datachkno1()   //提示改輸入資料如  移轉單號 不更新網頁td012
        {
	      $this->load->model('sfc/sfci03n_model');
	      $data['result'] = $this->sfci03n_model->ajaxchkno1($this->uri->segment(4),$this->uri->segment(5));
          $Result = $data['result'];		  
	      $this->load->vars($data);
	      echo  $Result;
        }  */

	//篩選資料舊版 單一選項無and or
	public function filter1($sort_by = 'td001', $sort_order = 'desc', $offset = 0)
	{
		$limit = 15;
		$data['sort_by'] = $this->uri->segment(4);
		$data['sort_order'] = $this->uri->segment(5);
		$seq6 = urldecode(urldecode($this->uri->segment(6))); 	 //解決亂碼
		$seq7 = '1';
		$sort_order = (substr($sort_order, 0, 3) == 'asc') ? 'asc' : 'desc';  // if else  = ? :
		$data['sort_order'] = $sort_order;
		$this->load->model('sfc/sfci03n_model', '', TRUE);   //true 系統會使用反單引號（`, 在英文鍵盤左上方）來保護你的欄位或資料表名稱
		$result = $this->sfci03n_model->filterf1($limit, $offset, $sort_by, $sort_order);
		$data['message'] = '篩選資料成功!';
		$data['results'] = $result['rows'];
		$data['num_results'] = $result['num_rows'];
		$this->load->library('pagination');
		$data['numrow'] = $result['num_rows'];  // 總筆數 
		$data['page'] = $result['num_rows'] / $limit;  // 總頁數 
		$config = array();
		$config['per_page'] = $limit; // 每頁筆數
		$config['total_rows'] = $result['num_rows'];  // 總筆數 
		$config['first_link'] = '首頁';
		$config['last_link'] = '尾頁';
		$config['next_link'] = '下一頁>';
		$config['prev_link'] = '<上一頁';
		$config['display_pages'] = TRUE;  //顯示數字鏈接
		$config['full_tag_open'] = '<p>';
		$config['full_tag_close'] = '</p>';
		$config['cur_tag_open'] = ' <a class="current">'; // 當前頁開始樣式
		$config['cur_tag_close'] = '</a>'; // 當前頁结束樣式
		$config['cur_page'] = $this->uri->segment(8, 0);   //當前頁 結合分頁url路徑 +1
		$config['base_url'] = site_url("sfc/sfci03n/filter1/$sort_by/$sort_order/$seq6/$seq7");  //設定分頁url路徑
		$config['per_page'] = $limit;
		$config['uri_segment'] = 8;
		$this->pagination->initialize($config);
		$data['pagination'] = $this->pagination->create_links();
		$data['username'] = $this->session->userdata('manager');
		$data['curpage'] = $this->uri->segment(8, 1);   //當前頁
		$data['limit'] = $limit;    //每頁筆數
		$data['systitle'] = '報工單日結修改';
		$data['menu_v'] = 'main_menu_v';
		$data['content_v'] = 'sfc/sfci03n_brow_v';
		$data['foot_v'] = 'main_foot_v';
		$this->load->vars($data);
		$this->load->view('main_headbrow_v');
	}

	public function findform()   //進階查詢輸入資料
	{
		$data['date'] = date("Ymd");
		$data['username'] = $this->session->userdata('manager');
		$data['message'] = '';
		$data['systitle'] = '移轉單建立-進階查詢';
		$data['menu_v'] = 'main_menuno_v';
		$data['content_v'] = 'sfc/sfci03n_find_v';
		$data['foot_v'] = 'main_foot_v';
		$this->load->vars($data);
		$this->load->view('main_head_v');
	}

	public function findsql($sort_by = 'td001', $sort_order = 'desc', $offset = 0)  //進階查詢流覽資料
	{
		//下一頁不跑版
		if (session_status() == PHP_SESSION_NONE) {
			session_start();
		}
		if (@$_POST['find005']) {
			$_SESSION['sfci03n_sql_term'] = $_POST['find005'];
		}
		if (@$_POST['find007']) {
			$_SESSION['sfci03n_sql_sort'] = $_POST['find007'];
		}
		$limit = 15;    //每頁筆數
		$data['message'] = '資料流覽成功!';
		$data['sort_by'] = $sort_by;
		$data['sort_order'] = $sort_order;
		$this->load->model('sfc/sfci03n_model'); // 加載TABLE model 模型		
		$result = $this->sfci03n_model->findf($limit, $offset, $sort_by, $sort_order); //至model 取 mysql 資料 預設 15,0,td001,desc
		$data['results'] = $result['rows'];
		$data['num_results'] = $result['num_rows'];
		$this->load->library('pagination');
		$data['numrow'] = $result['num_rows']; // 總筆數 
		$data['page'] = $result['num_rows'] / $limit; // 總頁數 
		$config = array();
		//$config['NUM_LINKS'] = 2;   //分頁前後出現2個數字
		$config['per_page'] = '15'; // 每頁筆數 必填
		$config['first_link'] = '首頁';
		$config['last_link'] = '尾頁';
		$config['next_link'] = '下一頁>';
		$config['prev_link'] = '<上一頁';
		$config['display_pages'] = TRUE;  //顯示數字鏈接 
		$config['full_tag_open'] = '<p>';  // 分頁開始樣式
		$config['full_tag_close'] = '</p>';   // 分頁结束樣式	
		$config['cur_tag_open'] = ' <a class="current">'; // 當前頁開始樣式
		$config['cur_tag_close'] = '</a>'; // 當前頁结束樣式
		$config['cur_page'] = $this->uri->segment(6, 0);   //當前頁 結合分頁url路徑 5+1=6
		$this->pagination->initialize($config);    //分頁初始化 display 3
		$config['base_url'] = site_url("sfc/sfci03n/findsql/$sort_by/$sort_order");   //設定分頁url路徑
		$config['total_rows'] = $result['num_rows']; // 總筆數
		$config['per_page'] = $limit;                //每頁筆數
		$config['uri_segment'] = 6;       //當前頁
		$this->pagination->initialize($config);
		$data['pagination'] = $this->pagination->create_links();
		$data['username'] = $this->session->userdata('manager');
		$data['curpage'] = $this->uri->segment(6, 1);   //當前頁
		$data['limit'] = $limit;    //每頁筆數
		$data['systitle'] = '報工單日結修改';
		$data['menu_v'] = 'main_menu_v';
		$data['content_v'] = 'sfc/sfci03n_brow_v';
		$data['foot_v'] = 'main_foot_v';
		$this->load->vars($data);
		$this->load->view('main_headbrow_v');
	}

	public function clear_sql_term()
	{  //清除條件
		if (session_status() == PHP_SESSION_NONE) {
			session_start();
		}
		if (@$_SESSION["sfci03n_sql_term"]) {
			unset($_SESSION["sfci03n_sql_term"]);
		}
		if (@$_SESSION["sfci03n_sql_sort"]) {
			unset($_SESSION["sfci03n_sql_sort"]);
		}
		//1060809
		unset($_SESSION['sfci03n']['search']['where']);
		unset($_SESSION['sfci03n']['search']['order']);
		unset($_SESSION['sfci03n']['search']['offset']);
		$this->display();
	}

	public function addform()   //新增輸入資料
	{
		//權限控管--------------------------------
		$user = trim($this->session->userdata('sysuser'));
		$super = trim($this->session->userdata('syssuper'));
		$rms = trim($this->session->userdata('sysuserrms'));
		$prom = substr($rms, 2, 1);

		if (!$user) {
			redirect('/login/');
		}
		if (!($super == 'Y' || $prom == 'Y')) {
			$_SESSION['rms'] = 'N';
			redirect('/main'); //跳回首頁
		}
		//權限控管--------------------------------END

		//Default columns 檢視明細設定
		$data['no_col'] = $this->no_col;
		$data['col_array'] = $this->detail_col;
		// $this->load->model('set/seti01_model');
		// $coldata = $this->seti01_model->get_detail_view($this->session->userdata('manager'), 'sfci03n');
		// echo "<pre>";var_dump($coldata);exit;
		// if ($coldata == "no_data") {
		// 	$data['usecol_array'] = $data['col_array'];
		// } else {
		// 	$usecol_array = explode(',', $coldata->TE003);
		// 	$data['usecol_array'] = array();
		// 	foreach ($usecol_array as $key => $val) {
		// 		$data['usecol_array'][$val] = $data['col_array'][$val];
		// 	}
		// }
		$data['usecol_array'] = $data['col_array'];
		// $data['date'] = date("Y/m/d");
		$data['message'] = '';
		$data['username'] = $this->session->userdata('manager');
		$data['systitle'] = '報工單-新增資料';
		// //系統參數
		// $this->load->model('sfc/sfci03n_model', '', TRUE);
		// $result2 = $this->sfci03n_model->funsysf();
		// $data['results2'] = $result2['rows2'];

		$data['menu_v'] = 'main_menuno_v';
		$data['content_v'] = 'sfc/sfci03n_add_v';
		$data['foot_v'] = 'main_foot_v';
		// echo "<pre>";
		// var_dump(mb_convert_encoding($this->session->userdata('sysml002'), "utf-8", "big-5"));
		// var_dump($data);
		// exit;
		$this->load->vars($data);
		$this->load->view('main_head_v');
	}

	public function addsave()   //新增存檔
	{
		//權限控管--------------------------------
		$user = trim($this->session->userdata('sysuser'));
		$super = trim($this->session->userdata('syssuper'));
		$rms = trim($this->session->userdata('sysuserrms'));
		$prom = substr($rms, 2, 1);

		if (!$user) {
			redirect('/login/');
		}
		if (!($super == 'Y' || $prom == 'Y')) {
			$_SESSION['rms'] = 'N';
			redirect('/main'); //跳回首頁
		}
		//權限控管--------------------------------END

		//Default columns 檢視明細設定
		$data['no_col'] = $this->no_col;
		$data['col_array'] = $this->detail_col;
		// $this->load->model('set/seti01_model');
		// $coldata = $this->seti01_model->get_detail_view(trim($this->input->post('sfci01')), trim($this->input->post('td002')));
		// if ($coldata == "no_data") {
		// 	$data['usecol_array'] = $data['col_array'];
		// } else {
		// 	$usecol_array = explode(',', $coldata->TE003);
		// 	$data['usecol_array'] = array();
		// 	foreach ($usecol_array as $key => $val) {
		// 		$data['usecol_array'][$val] = $data['col_array'][$val];
		// 	}
		// }

		$data['usecol_array'] = $data['col_array'];
		$data['username'] = $this->session->userdata('manager');
		$this->load->model('sfc/sfci03n_model', '', TRUE);
		$data['message'] = '新增成功!';
		$action = $this->sfci03n_model->insertf();
		if ($action === 'exist') {
			$data['message'] = '資料重複!';
		}
		//------------凍結日期------------------
		if ($action === '輸入日期資料不可小於庫存現行年月') {
			$data['message'] = '輸入日期資料不可小於庫存現行年月 !';
		}
		if ($action === '輸入日期資料須大於帳務凍結日期') {
			$data['message'] = '輸入日期資料須大於帳務凍結日期 !';
		}
		//------------凍結日期----end--------------
		// else {
		// $this->sfci03n_model->auto_print();
		// }

		$data['systitle'] = '報工單-新增';
		$data['menu_v'] = 'main_menuno_v';
		$data['content_v'] = 'sfc/sfci03n_add_v';
		$data['foot_v'] = 'main_foot_v';
		$this->load->vars($data);
		$this->load->view('main_head_v');
	}

	public function copyform()   //複製資料輸入
	{
		$data['username'] = $this->session->userdata('manager');
		$data['message'] = '';
		$data['systitle'] = '移轉單建立-複製資料';
		$data['menu_v'] = 'main_menuno_v';
		$data['content_v'] = 'sfc/sfci03n_copy_v';
		$data['foot_v'] = 'main_foot_v';
		$this->load->vars($data);
		$this->load->view('main_head_v');
	}

	public function copysave()   //複製存檔
	{
		$data['username'] = $this->session->userdata('manager');
		$this->load->model('sfc/sfci03n_model', '', TRUE);
		$data['message'] = '複製成功!';
		$action = $this->sfci03n_model->copyf();
		if ($action === 'exist')      // "=="只比較數值，而"==="數值與類型一起比較
		{
			$data['message'] = '資料重複!';
		}
		$data['systitle'] = '移轉單建立-複製資料';
		$data['menu_v'] = 'main_menuno_v';
		$data['content_v'] = 'sfc/sfci03n_copy_v';
		$data['foot_v'] = 'main_foot_v';
		$this->load->vars($data);
		$this->load->view('main_head_v');
	}


	public function exceldetail()   //轉excel明細輸入起迄資料, 改報表轉出
	{
		//權限控管--------------------------------
		$user = trim($this->session->userdata('sysuser'));
		$super = trim($this->session->userdata('syssuper'));
		$rms = trim($this->session->userdata('sysuserrms'));
		$prom = substr($rms, 3, 1);

		if (!$user) {
			redirect('/login/');
		}
		if (!($super == 'Y' || $prom == 'Y')) {
			$_SESSION['rms'] = 'N';
			redirect('/main'); //跳回首頁
		}
		//權限控管--------------------------------END

		// $data['message'] = '';
		// $data['username'] = $this->session->userdata('manager');
		// $data['systitle'] = '移轉單建立-轉excel檔';
		// $data['menu_v'] = 'main_menuno_v';
		// $data['content_v'] = 'sfc/sfci03n_excel_v';
		// $data['foot_v'] = 'main_foot_v';
		// $this->load->vars($data);
		// $this->load->view('main_head_v');

		$data['message'] = '';
		$data['username'] = $this->session->userdata('manager');
		$data['systitle'] = '報工單-轉excel';
		$this->load->vars($data);
		$this->load->view('sfc/sfci03n_excel_v');
	}

	public function write()   //轉excel 部份資料由 print_v call
	{
		$this->load->model('sfc/sfci03n_model', '', TRUE);
		$data['message'] = '轉檔excel成功!';
		$data['username'] = $this->session->userdata('manager');

		$seq1 = trim($this->input->post('td001'));

		$seq2 = trim($this->input->post('bi001')); //其他報表

		if ($seq2 == '1') { //溶解生產記錄表
			$this->sfci03n_model->excelnewf_prs('溶解生產記錄表');
		} else if ($seq2 == '2') { //軸承孔檢查表
			$this->sfci03n_model->excelnewf_pcl('軸承孔檢查表');
		} else if ($seq2 == '3') { //月報表
			$this->sfci03n_model->excelnewf_month('月報表');
		} else if ($seq2 == '4') { //端面粗糙度檢查
			$this->sfci03n_model->excelnewf_pclmn('端面粗糙度檢查');
		} else if ($seq2 == '5') { //健溢CNC報工表			
			$this->sfci03n_model->excelnewf_cnc04('健溢CNC報工表');
		} else if ($seq2 == '6') { //機加工報工表
			$this->sfci03n_model->excelnewf_cnc05('機加工報工表');
		} else if ($seq2 == '7') { //拋丸粗糙度測量表
			$this->sfci03n_model->excelnewf_pclsa('拋丸粗糙度測量表');
		} else if ($seq2 == '8') { //拋丸打磨不良報表
			$result1 = $this->sfci03n_model->excelnewf_cnc06();
		} else if ($seq2 == '9') { //實心胎一次硫化報表
			$this->sfci03n_model->excelnewf_rw001('實心胎一次硫化報工表');
		} else if ($seq2 == '10') { //空心胎硫化報表
			$this->sfci03n_model->excelnewf_rw002('空心胎硫化報工表');
		} else if ($seq2 == '11') { //萬馬力-報工表
			$this->sfci03n_model->excelnewf_rw003('萬馬力報工表');
		} else if ($seq1 == 'D403' || $seq1 == 'D503') { //橡膠------〉從下拉選單：實心胎一次硫化、空心胎硫化

			redirect('/sfc/sfci03n/exceldetail/'); //存檔後跳回正常之頁面
		} else {
			if ($seq1 == 'D404' || $seq1 == 'D504') { //注塑
				$title = array(
					'生產日期', '班別', '機台名稱', '是否使用機械手', '製令單號', '品號', '品名', '規格', '訂單數量', '累計產量', '訂單完成率%', '執行配方', '理論模穴數', '實際模穴數',
					'生產週期', '每模毛重', '每模淨重', '起始模數', '結束模數', '模次數', '折合生產數', '操作員', '生產起訖時間', '生產時間', '標準生產數量', '生產數量',
					'產量達標率', '合格數量', '不良總數', '可粉碎量', '待粉碎量', '不可粉碎', '水口數量(KG)', '過管料可回收未粉碎(KG)', '過管料可回收數量(KG)',
					'過管料可回收已粉碎(KG)', '過管料可回收未粉碎(KG)', '過管料不可回收數量(KG)', '良品率', '總不良率', '不可粉碎率', '不良原因', '備註'
				);  //excel 表頭
			} else if ($seq1 == 'D401' || $seq1 == 'D501') { //鑄造
				$title = array(
					'生產日期', '品號', '品名', '規格', '造型数(模)', '澆注數(模)', '每模個數', '空模率(%)', '模重(KG)', '毛坯單重(KG)', '出水重量(KG)', '澆注重量(KG)', '鐵水損耗率(%)', '毛坯數(件)',
					'毛坯總重(KG)', '得料率'
				);
			} else if ($seq1 == 'D407' || $seq1 == 'D507') { //衝壓 1.單衝 2.連續
				$title = array(
					'生產日期', '機台代號', '機台名稱', '作業員', '作業人數', '品號', '品名', '規格', '模具名稱', '工序名稱', '模穴數(1出幾)', '模具標準衝次(次/分)',
					'生產起訖時間', '生產用時', '生產衝次', '目標產能', '生產數量', '累積衝次', '累計數量', '工令數量', '合格數量', '不良數量', '可返修數量', '報廢品數量',  '生產效率', '備註', '機台樣式'
				);  //excel 表頭
			} else if ($seq1 == 'D411' || $seq1 == 'D511') { //裝配
				$title = array(
					'生產日期', '機台代號', '機台名稱', '作業員', '作業人數', '品號', '品名', '規格', '工序名稱', '生產起訖時間', '生產用時', '生產數量', '標準時間',
					'生產效率', '備註'
				);  //excel 表頭
			} else { //其他
				$title = array(
					'生產日期', '機台代號', '機台名稱', '作業員', '作業人數', '品號', '品名', '規格', '模具名稱', '工序名稱', '模穴數(1出幾)', '模具標準衝次(次/分)',
					'生產起訖時間', '生產用時', '生產衝次', '目標產能', '生產數量', '累積衝次', '累計數量', '工令數量', '合格數量', '不良數量', '可返修數量', '報廢品數量',  '生產效率', '備註'
				);  //excel 表頭
			}
            $this->load->model('sfc/sfci03n_model');
			$result1 = $this->sfci03n_model->excelnewf();

			// echo "<pre>";	var_dump($result1);		exit;

			//為了解決excel下載的問題，
			//原因為中文轉碼出錯 20220105
			//lz006、lz007、lz008有中文
			// for ($i = 0; $i < count($result1); $i++) {
			foreach ($result1 as $key => $val) {
				// $result1[$i][$key] = iconv("big-5", "utf-8", $value);

				if ($seq1 == 'D404' || $seq1 == 'D504') { //注塑1140331
					$result1[$key]->MB002 = mb_convert_encoding(trim($val->MB002), "utf-8", "big-5");
					$result1[$key]->TE005disp = mb_convert_encoding(trim($val->TE005disp), "utf-8", "big-5");
					$result1[$key]->TE018 = mb_convert_encoding(trim($val->TE018), "utf-8", "big-5");
					$result1[$key]->TE019 = mb_convert_encoding(trim($val->TE019), "utf-8", "big-5");
					$result1[$key]->TE015 = mb_convert_encoding(trim($val->TE015), "utf-8", "big-5");
				} else if ($seq1 == 'D401' || $seq1 == 'D501') { //鑄造
					$result1[$key]->MB002 = mb_convert_encoding(trim($val->MB002), "utf-8", "big-5");
					$result1[$key]->MB003 = mb_convert_encoding(trim($val->MB003), "utf-8", "big-5");
				} else if ($seq1 == 'D411' || $seq1 == 'D511') { //裝配
					$result1[$key]->TE005disp = mb_convert_encoding(trim($val->TE005disp), "utf-8", "big-5");
					$result1[$key]->TE018 = mb_convert_encoding(trim($val->TE018), "utf-8", "big-5");
					$result1[$key]->TE019 = mb_convert_encoding(trim($val->TE019), "utf-8", "big-5");
					$result1[$key]->TE009disp = mb_convert_encoding(trim($val->TE009disp), "utf-8", "big-5");
					$result1[$key]->TE015 = mb_convert_encoding(trim($val->TE015), "utf-8", "big-5");
				} else {
					if ($seq1 == 'D407' || $seq1 == 'D507') { //衝壓 1.單衝 2.連續
						$result1[$key]->TE029 = $result1[$key]->TE029 == '1' ? '1.單衝' : '2.連續';
					}
					$result1[$key]->TE009disp = mb_convert_encoding(trim($val->TE009disp), "utf-8", "big-5");
					$result1[$key]->da002 = mb_convert_encoding(trim($val->da002), "utf-8", "big-5");
					$result1[$key]->TE005disp = mb_convert_encoding(trim($val->TE005disp), "utf-8", "big-5");
					$result1[$key]->TE018 = mb_convert_encoding(trim($val->TE018), "utf-8", "big-5");
					$result1[$key]->TE019 = mb_convert_encoding(trim($val->TE019), "utf-8", "big-5");
					$result1[$key]->TE015 = mb_convert_encoding(trim($val->TE015), "utf-8", "big-5");
				}
			}
			// }
			$this->excel->writer($title, $result1);    //讀取excel  
		}
	}
	public function write_month()
	{
		$this->load->model('sfc/sfci03n_model', '', TRUE);
		$data['message'] = '轉檔excel成功!';
		$data['username'] = $this->session->userdata('manager');

		$seq1 = trim($this->input->post('td001'));

		$title = array(
			'生產日期', '品號', '品名', '規格', '預計產量', '工序名稱1', '生產數量1', '合格數量1', '工序名稱2', '生產數量2', '合格數量2', '工序名稱3', '生產數量3', '合格數量4',
			'工序名稱4', '生產數量4', '合格數量4', '工序名稱5', '生產數量5', '合格數量5', '工序名稱6', '生產數量6', '合格數量6', '工序名稱7', '生產數量7', '合格數量7'
		);

		$result1 = $this->sfci03n_model->excelnewf_month();

		//為了解決excel下載的問題，
		//原因為中文轉碼出錯 20220105
		//lz006、lz007、lz008有中文
		// for ($i = 0; $i < count($result1); $i++) {
		foreach ($result1 as $key => $val) {

			$result1[$key]->MB002 = mb_convert_encoding(trim($val->MB002), "utf-8", "big-5");
			$result1[$key]->TE005disp = mb_convert_encoding(trim($val->TE005disp), "utf-8", "big-5");
			$result1[$key]->TE018 = mb_convert_encoding(trim($val->TE018), "utf-8", "big-5");
			$result1[$key]->TE019 = mb_convert_encoding(trim($val->TE019), "utf-8", "big-5");
			$result1[$key]->TE015 = mb_convert_encoding(trim($val->TE015), "utf-8", "big-5");
		}

		$this->excel->writer($title, $result1);    //讀取excel  
	}

	public function exceldetailr()   //轉excel明細輸入起迄資料, 改報表轉出
	{
		$data['message'] = '';
		$data['username'] = $this->session->userdata('manager');
		$data['systitle'] = '生產工價報表-列印';
		$this->load->vars($data);
		$this->load->view('sfc/sfci03n_excelr_v');
	}
    public function writeday()   //轉excel 部份資料由 print_v call
	{
		$this->load->model('sfc/sfci03n_model', '', TRUE);
		$data['message'] = '轉檔excel成功!';
		$data['username'] = $this->session->userdata('manager');

		$seq1 = trim($this->input->post('td001'));

		$seq2 = trim($this->input->post('bi001')); //其他報表

		if ($seq2 == '1') { //溶解生產記錄表
			$this->sfci03n_model->excelnewf_prs('溶解生產記錄表');
		} else if ($seq2 == '2') { //軸承孔檢查表
			$this->sfci03n_model->excelnewf_pcl('軸承孔檢查表');
		} else if ($seq2 == '3') { //月報表
			$this->sfci03n_model->excelnewf_month('月報表');
		} else if ($seq2 == '4') { //端面粗糙度檢查
			$this->sfci03n_model->excelnewf_pclmn('端面粗糙度檢查');
		} else if ($seq2 == '5') { //健溢CNC報工表			
			$this->sfci03n_model->excelnewf_cnc04('健溢CNC報工表');
		} else if ($seq2 == '6') { //機加工報工表
			$this->sfci03n_model->excelnewf_cnc05('機加工報工表');
		} else if ($seq2 == '7') { //拋丸粗糙度測量表
			$this->sfci03n_model->excelnewf_pclsa('拋丸粗糙度測量表');
		} else if ($seq2 == '8') { //拋丸打磨不良報表
			$result1 = $this->sfci03n_model->excelnewf_cnc06();
		} else if ($seq2 == '9') { //實心胎一次硫化報表
			$this->sfci03n_model->excelnewf_rw001('實心胎一次硫化報工表');
		} else if ($seq2 == '10') { //空心胎硫化報表
			$this->sfci03n_model->excelnewf_rw002('空心胎硫化報工表');
		} else if ($seq2 == '11') { //萬馬力-報工表
			$this->sfci03n_model->excelnewf_rw003('萬馬力報工表');
		} else if ($seq1 == 'D403' || $seq1 == 'D503') { //橡膠------〉從下拉選單：實心胎一次硫化、空心胎硫化

			redirect('/sfc/sfci03n/exceldetail/'); //存檔後跳回正常之頁面
		} else {
			if ($seq1 == 'D404' || $seq1 == 'D504') { //注塑
				$title = array(
					'生產日期', '班別', '機台名稱', '是否使用機械手', '製令單號', '品號', '品名', '規格', '訂單數量', '累計產量', '訂單完成率%', '執行配方', '理論模穴數', '實際模穴數',
					'生產週期', '每模毛重', '每模淨重', '起始模數', '結束模數', '模次數', '折合生產數', '操作員', '生產起訖時間', '生產時間', '標準生產數量', '生產數量',
					'產量達標率', '合格數量', '不良總數', '可粉碎量', '待粉碎量', '不可粉碎', '水口數量(KG)', '過管料可回收未粉碎(KG)', '過管料可回收數量(KG)',
					'過管料可回收已粉碎(KG)', '過管料可回收未粉碎(KG)', '過管料不可回收數量(KG)', '良品率', '總不良率', '不可粉碎率', '不良原因', '備註'
				);  //excel 表頭
			} else if ($seq1 == 'D401' || $seq1 == 'D501') { //鑄造
				$title = array(
					'生產日期', '品號', '品名', '規格', '造型数(模)', '澆注數(模)', '每模個數', '空模率(%)', '模重(KG)', '毛坯單重(KG)', '出水重量(KG)', '澆注重量(KG)', '鐵水損耗率(%)', '毛坯數(件)',
					'毛坯總重(KG)', '得料率'
				);
			} else if ($seq1 == 'D407' || $seq1 == 'D507') { //衝壓 1.單衝 2.連續
				$title = array(
					'生產日期', '機台代號', '機台名稱', '作業員', '作業人數', '品號', '品名', '規格', '模具名稱', '工序名稱', '模穴數(1出幾)', '模具標準衝次(次/分)',
					'生產起訖時間', '生產用時', '生產衝次', '目標產能', '生產數量', '累積衝次', '累計數量', '工令數量', '合格數量', '不良數量', '可返修數量', '報廢品數量',  '生產效率', '備註', '機台樣式'
				);  //excel 表頭
			} else if ($seq1 == 'D411' || $seq1 == 'D511') { //裝配
				$title = array(
					'生產日期', '機台代號', '機台名稱', '作業員', '作業人數', '品號', '品名', '規格', '工序名稱', '生產起訖時間', '生產用時', '生產數量', '標準時間',
					'生產效率', '備註'
				);  //excel 表頭
			} else { //其他
				$title = array(
					'生產日期', '機台代號', '機台名稱', '作業員', '作業人數', '品號', '品名', '規格', '模具名稱', '工序名稱', '模穴數(1出幾)', '模具標準衝次(次/分)',
					'生產起訖時間', '生產用時', '生產衝次', '目標產能', '生產數量', '累積衝次', '累計數量', '工令數量', '合格數量', '不良數量', '可返修數量', '報廢品數量',  '生產效率', '備註'
				);  //excel 表頭
			}

			$result1 = $this->sfci03n_model->excelnewfday();

			// echo "<pre>";	var_dump($result1);		exit;

			//為了解決excel下載的問題，
			//原因為中文轉碼出錯 20220105
			//lz006、lz007、lz008有中文
			// for ($i = 0; $i < count($result1); $i++) {
			foreach ($result1 as $key => $val) {
				// $result1[$i][$key] = iconv("big-5", "utf-8", $value);

				if ($seq1 == 'D404' || $seq1 == 'D504') { //注塑
					$result1[$key]->MB002 = mb_convert_encoding(trim($val->MB002), "utf-8", "big-5");
					$result1[$key]->TE005disp = mb_convert_encoding(trim($val->TE005disp), "utf-8", "big-5");
					$result1[$key]->TE018 = mb_convert_encoding(trim($val->TE018), "utf-8", "big-5");
					$result1[$key]->TE019 = mb_convert_encoding(trim($val->TE019), "utf-8", "big-5");
					$result1[$key]->TE015 = mb_convert_encoding(trim($val->TE015), "utf-8", "big-5");
				} else if ($seq1 == 'D401' || $seq1 == 'D501') { //鑄造
					$result1[$key]->MB002 = mb_convert_encoding(trim($val->MB002), "utf-8", "big-5");
					$result1[$key]->MB003 = mb_convert_encoding(trim($val->MB003), "utf-8", "big-5");
				} else if ($seq1 == 'D411' || $seq1 == 'D511') { //裝配
					$result1[$key]->TE005disp = mb_convert_encoding(trim($val->TE005disp), "utf-8", "big-5");
					$result1[$key]->TE018 = mb_convert_encoding(trim($val->TE018), "utf-8", "big-5");
					$result1[$key]->TE019 = mb_convert_encoding(trim($val->TE019), "utf-8", "big-5");
					$result1[$key]->TE009disp = mb_convert_encoding(trim($val->TE009disp), "utf-8", "big-5");
					$result1[$key]->TE015 = mb_convert_encoding(trim($val->TE015), "utf-8", "big-5");
				} else {
					if ($seq1 == 'D407' || $seq1 == 'D507') { //衝壓 1.單衝 2.連續
						$result1[$key]->TE029 = $result1[$key]->TE029 == '1' ? '1.單衝' : '2.連續';
					}
					$result1[$key]->TE009disp = mb_convert_encoding(trim($val->TE009disp), "utf-8", "big-5");
					$result1[$key]->da002 = mb_convert_encoding(trim($val->da002), "utf-8", "big-5");
					$result1[$key]->TE005disp = mb_convert_encoding(trim($val->TE005disp), "utf-8", "big-5");
					$result1[$key]->TE018 = mb_convert_encoding(trim($val->TE018), "utf-8", "big-5");
					$result1[$key]->TE019 = mb_convert_encoding(trim($val->TE019), "utf-8", "big-5");
					$result1[$key]->TE015 = mb_convert_encoding(trim($val->TE015), "utf-8", "big-5");
				}
			}
			// }
			$this->excel->writer($title, $result1);    //讀取excel  
		}
	}
	public function writer()   // 1140508 轉excel 部份資料由 print_v call
	{
		$this->load->model('sfc/sfci03n_model', '', TRUE);
		$data['message'] = '轉檔excel成功!';
		$data['username'] = $this->session->userdata('manager');
		$title = array(
			'生產日期', '機台代號', '機台名稱', '作業員', '作業人數','共同合作',  '品號', '品名', '規格',  '工序', '工序名稱',
			// '生產起訖時間', '生產用時', '生產數量', '工令數量', '累計生產數量',
			'合格數量',
			//  '不良數量', '可返修數量', '報廢品數量', '穴數(產能)', '衝次(分)', 
			'產能85%',
			//  '生產效率',  
			'工價','單號'
			//  ,'生產線別', '線別名稱'
		);  //excel 表頭
		$day=$this->input->post('day');
		if ($day=='day') {$result1 = $this->sfci03n_model->excelnewfrday();} else
		{$result1 = $this->sfci03n_model->excelnewfr();}
     
		//為了解決excel下載的問題，
		//原因為中文轉碼出錯 20220105
		//lz006、lz007、lz008有中文
		//1140210 modi
		//select  TD008,MX001,TE005disp,TE004disp,TE030disp,TE030dispN,TE017,
	//TE018,TE019,MW001,TE009disp,TA015,TE040,da015,   TE013,da005,da004,TE011,da010,TE029,TE001,MD013m
	//	 from sfci03nGP
		for ($i = 0; $i < count($result1); $i++) {
			foreach ($result1[$i] as $key => $value) {
				if ($key == 'tc003' or $key == 'tc008' or $key == 'tc009' or $key == 'tc011' or $key == 'TE009disp' or $key == 'MD002') {
					// $result1[$i][$key] = iconv("big-5", "utf-8", $value);
					            
					$result1[$i][$key] = mb_convert_encoding(trim($value), "utf-8", "big-5");
				} else if ($key == 'TE029') {
					$seq1 = trim($this->input->post('td001'));
					if ($seq1 == 'D401' or $seq1 == 'D501') {
						if (trim($value) == '1') {
							$result1[$i][$key] = '合模';
						} else {
							$result1[$i][$key] = '單模';
						}
					} else if ($seq1 == 'D403' or $seq1 == 'D503' or $seq1 == 'D404' or $seq1 == 'D504') {
						if (trim($value) == '1') {
							$result1[$i][$key] = '半自動';
						} else {
							$result1[$i][$key] = '全自動';
						}
					} else {
						if (trim($value) == '1') {
							$result1[$i][$key] = '單衝(手動)';
						} else {
							$result1[$i][$key] = '連續';
						}
					}
				}
				else if ($key == 'tc014_tc005') {
				$result1[$i][$key] = "　" . number_format($value, 3, '.', '');
				 }
				if ($key == 'TE013' or $key == 'da005' or $key == 'da004' or $key == 'TE011' or
              		$key == 'da015' or $key == 'TE029' or $key == 'TA015' or $key == 'da010' or $key == 'TE029' or $key == 'TE001' or $key == 'MD013m1' ) 
			        {$result1[$i][$key] ='';}
			//	if ($key == 'da0051') {$result1[$i]['TE029'] =$result1[$i][$key];}
             //   if ($key == 'MD013m') {$result1[$i]['da015'] =$result1[$i][$key];}
              //  if ($key == 'da0051') {$result1[$i][$key] ='';}
              //  if ($key == 'MD013m') {$result1[$i][$key] ='';}				
			}
		} 
       //  echo var_dump($result1);exit;
		$this->excel->writer($title, $result1);    //讀取excel  
	}
	public function writer_gnew()   //轉excel 部份資料由 print_v call
	{
		$this->load->model('sfc/sfci03n_model', '', TRUE);
		$data['message'] = '轉檔excel成功!';
		$data['username'] = $this->session->userdata('manager');
		$title = array(
			'生產日期', '機台代號', '機台名稱', '作業員', '作業人數','共同合作',  '品號', '品名', '規格',  '工序', '工序名稱',
			// '生產起訖時間', '生產用時', '生產數量', '工令數量', '累計生產數量',
			'合格數量',
			//  '不良數量', '可返修數量', '報廢品數量', '穴數(產能)', '衝次(分)', 
			'產能85%',
			//  '生產效率',  
			'工價','機台樣式'
			//  ,'生產線別', '線別名稱'
		);  //excel 表頭
		$result1 = $this->sfci03n_model->excelnewf();
     
		//為了解決excel下載的問題，
		//原因為中文轉碼出錯 20220105
		//lz006、lz007、lz008有中文
		//1140210 modi
		//select  TD008,MX001,TE005disp,TE004disp,TE030disp,TE030dispN,TE017,
	//TE018,TE019,MW001,TE009disp,TA015,TE040,da015,   TE013,da005,da004,TE011,da010,TE029,TE001,MD013m
	//	 from sfci03nGP
		for ($i = 0; $i < count($result1); $i++) {
			foreach ($result1[$i] as $key => $value) {
				if ($key == 'TE005disp' or $key == 'TE018' or $key == 'TE019' or $key == 'da002' or $key == 'TE009disp' or $key == 'MD002') {
					// $result1[$i][$key] = iconv("big-5", "utf-8", $value);
					            
					$result1[$i][$key] = mb_convert_encoding(trim($value), "utf-8", "big-5");
				} else if ($key == 'TE029') {
					$seq1 = trim($this->input->post('td001'));
					if ($seq1 == 'D401' or $seq1 == 'D501') {
						if (trim($value) == '1') {
							$result1[$i][$key] = '合模';
						} else {
							$result1[$i][$key] = '單模';
						}
					} else if ($seq1 == 'D403' or $seq1 == 'D503' or $seq1 == 'D404' or $seq1 == 'D504') {
						if (trim($value) == '1') {
							$result1[$i][$key] = '半自動';
						} else {
							$result1[$i][$key] = '全自動';
						}
					} else {
						if (trim($value) == '1') {
							$result1[$i][$key] = '單衝(手動)';
						} else {
							$result1[$i][$key] = '連續';
						}
					}
				}
				else if ($key == 'tc014_tc005') {
				$result1[$i][$key] = "　" . number_format($value, 3, '.', '');
				 }
				if ($key == 'TE0131' or $key == 'da0051'  or $key == 'TE0132'
                    or $key == 'da002'	or $key == 'da005'  or $key == 'da015'	or $key == 'da004'		 
					or $key == 'TE013'	or $key == 'TE001' or $key == 'TE011'			) 
			        {$result1[$i][$key] ='';}
					
			//	if ($key == 'da0051') {$result1[$i]['TE029'] =$result1[$i][$key];}
             //   if ($key == 'MD013m') {$result1[$i]['da015'] =$result1[$i][$key];}
              //  if ($key == 'da0051') {$result1[$i][$key] ='';}
              //  if ($key == 'MD013m') {$result1[$i][$key] ='';}				
			}
		} 
       //  echo var_dump($result1);exit;
		$this->excel->writer($title, $result1);    //讀取excel  
	}
	public function writer_dnew()   //轉excel 部份資料由 print_v call
	{
		$this->load->model('sfc/sfci03n_model', '', TRUE);
		$data['message'] = '轉檔excel成功!';
		$data['username'] = $this->session->userdata('manager');
		$title = array(
			'生產日期', '機台代號', '機台名稱', '作業員', '作業人數','共同合作',  '品號', '品名', '規格',  '工序', '工序名稱',
			// '生產起訖時間', '生產用時', '生產數量', '工令數量', '累計生產數量',
			'合格數量',
			//  '不良數量', '可返修數量', '報廢品數量', '穴數(產能)', '衝次(分)', 
			'產能85%',
			//  '生產效率',  
			'工價','機台樣式'
			//  ,'生產線別', '線別名稱'
		);  //excel 表頭
		$result1 = $this->sfci03n_model->excelnewf();
     
		//為了解決excel下載的問題，
		//原因為中文轉碼出錯 20220105
		//lz006、lz007、lz008有中文
		//1140210 modi
		//select  TD008,MX001,TE005disp,TE004disp,TE030disp,TE030dispN,TE017,
	//TE018,TE019,MW001,TE009disp,TA015,TE040,da015,   TE013,da005,da004,TE011,da010,TE029,TE001,MD013m
	//	 from sfci03nGP
		for ($i = 0; $i < count($result1); $i++) {
			foreach ($result1[$i] as $key => $value) {
				if ($key == 'TE005disp' or $key == 'TE018' or $key == 'TE019' or $key == 'da002' or $key == 'TE009disp' or $key == 'MD002') {
					// $result1[$i][$key] = iconv("big-5", "utf-8", $value);
					            
					$result1[$i][$key] = mb_convert_encoding(trim($value), "utf-8", "big-5");
				} else if ($key == 'TE029') {
					$seq1 = trim($this->input->post('td001'));
					if ($seq1 == 'D401' or $seq1 == 'D501') {
						if (trim($value) == '1') {
							$result1[$i][$key] = '合模';
						} else {
							$result1[$i][$key] = '單模';
						}
					} else if ($seq1 == 'D403' or $seq1 == 'D503' or $seq1 == 'D404' or $seq1 == 'D504') {
						if (trim($value) == '1') {
							$result1[$i][$key] = '半自動';
						} else {
							$result1[$i][$key] = '全自動';
						}
					} else {
						if (trim($value) == '1') {
							$result1[$i][$key] = '單衝(手動)';
						} else {
							$result1[$i][$key] = '連續';
						}
					}
				}
				else if ($key == 'tc014_tc005') {
				$result1[$i][$key] = "　" . number_format($value, 3, '.', '');
				 }
				if ($key == 'TE0131' or $key == 'da0051'  or $key == 'TE0132A'
                    or $key == 'da002'	  or $key == 'da005' or $key == 'da015'	or $key == 'da010' or $key == 'da004'		 
						or $key == 'TE013' or $key == 'TE001' or $key == 'TE011'			) 
			        {$result1[$i][$key] ='';} 
					
			//	if ($key == 'da0051') {$result1[$i]['TE029'] =$result1[$i][$key];}
             //   if ($key == 'MD013m') {$result1[$i]['da015'] =$result1[$i][$key];}
              //  if ($key == 'da0051') {$result1[$i][$key] ='';}
              //  if ($key == 'MD013m') {$result1[$i][$key] ='';}				
			}
		} 
       //  echo var_dump($result1);exit;
		$this->excel->writer($title, $result1);    //讀取excel  
	}

	public function printdetail()   //印明細起迄資料輸入
	{
		$data['username'] = $this->session->userdata('manager');
		$data['message'] = '';
		$data['systitle'] = '移轉單建立-印明細表';
		$data['username'] = $this->session->userdata('manager');
		// $data['menu_v'] = 'main_menuno_v';
		// $data['content_v'] = 'sfc/sfci03n_print_v';
		// $data['foot_v'] = 'main_foot_v';
		$this->load->vars($data);
		$this->load->view('sfc/sfci03n_print_v');
	}

	public function printdetailc()   //印明細起迄資料輸入(訂單一次筆列印)
	{
		//權限控管--------------------------------
		$user = trim($this->session->userdata('sysuser'));
		$super = trim($this->session->userdata('syssuper'));
		$rms = trim($this->session->userdata('sysuserrms'));
		$prom = substr($rms, 0, 1);

		if (!$user) {
			redirect('/login/');
		}
		if (!($super == 'Y' || $prom == 'Y')) {
			$_SESSION['rms'] = 'N';
			redirect('/main'); //跳回首頁
		}
		//權限控管--------------------------------END

		// $data['username'] = $this->session->userdata('manager');
		// $data['message'] = '';
		// $data['systitle'] = '移轉單建立-印明細表';
		// $data['menu_v'] = 'main_menuno_v';
		// $data['content_v'] = 'sfc/sfci03n_print1_v';
		// $data['foot_v'] = 'main_foot_v';
		// $this->load->vars($data);
		// $this->load->view('main_head_v');

		$data['message'] = '';
		$data['username'] = $this->session->userdata('manager');
		$data['systitle'] = '工票單-列印';

		// var_dump($data);		exit;
		$this->load->vars($data);
		$this->load->view('sfc/sfci03n_print1_v');
	}

	public function printc()   //印工票單
	{
		// $data['paper9'] = $this->input->post('ta009c');

		$data['copies'] = $this->input->post('copies'); //列印份數
		$this->load->model('sfc/sfci03n_model', '', TRUE);
		$data['message'] = '列印工票單!';
		$data['title'] = '工票單';
		//公司參數
		$data['companyf'] = $this->sfci03n_model->companyf();
		$data['results'] = $this->sfci03n_model->printfc();
		// echo "<pre>";		var_dump($data);		exit;

		$this->load->vars($data);
		$this->load->view('sfc/sfci03n_printc_v');
	}

	public function printbb($ta009c)   //印移轉單
	{
		$data['paper9'] = $ta009c;
		$this->load->model('sfc/sfci03n_model', '', TRUE);
		$data['message'] = '列印移轉單!';
		//公司參數
		$result1 = $this->sfci03n_model->companyf();
		$data['results1'] = $result1['rows1'];

		$result = $this->sfci03n_model->printfb();
		$data['results'] = $result['rows'];
		$this->load->vars($data);
		$this->load->view('sfc/sfci03n_printb_v');
	}

	public function auto_printbb()
	{    //自動列印
		$this->load->model('sfc/sfci03n_model', '', TRUE);
		$data['message'] = '列印移轉單!';

		$result = $this->sfci03n_model->printfb();
		$data['results'] = $result['rows'];
		$this->load->vars($data);
		$this->load->view('sfc/sfci03n_printb_v');
	}

	public function printa()   //印明細
	{
		$data['paper9'] = $this->input->post('ta009c');
		if ($this->input->post('action') == "excel") {
			$this->write();                          //轉excel
		}

		$this->load->model('sfc/sfci03n_model', '', TRUE);
		$data['message'] = '列印明細成功!';
		$result = $this->sfci03n_model->printfd();
		$data['results'] = $result['rows'];
		$data['num_results'] = $result['num_rows'];
		//$this->load->library('pagination');
		$data['numrow'] = $result['num_rows']; // 總筆數 
		$data['username'] = $this->session->userdata('manager');
		$data['systitle'] = '移轉單建立-印明細表';
		$data['content_v'] = 'sfc/sfci03n_printa_v';
		$this->load->vars($data);
		$this->load->view('main_headprint_v');
	}

	public function updsave()   //修改存檔
	{
		//權限控管--------------------------------
		$user = trim($this->session->userdata('sysuser'));
		$super = trim($this->session->userdata('syssuper'));
		$rms = trim($this->session->userdata('sysuserrms'));
		$prom = substr($rms, 2, 1);

		if (!$user) {
			redirect('/login/');
		}
		if (!($super == 'Y' || $prom == 'Y')) {
			$_SESSION['rms'] = 'N';
			redirect('/main'); //跳回首頁
		}
		//權限控管--------------------------------END

		$seg1 = $this->input->post('TD001');
		$seg2 = $this->input->post('TD002');

		//Default columns 檢視明細設定
		$data['no_col'] = $this->no_col;
		if ($seg1 == 'D404' || $seg1 == 'D504') {
			$data['col_array'] = $this->detail_col_d;
		} else if ($seg1 == 'D401' || $seg1 == 'D501') {
			$data['col_array'] = $this->detail_col_a;
		} else if ($seg1 == 'D402' || $seg1 == 'D502') {
			$data['col_array'] = $this->detail_col_b;
		} else if ($seg1 == 'D403') {
			$data['col_array'] = $this->detail_col_c;
		} else if ($seg1 == 'D503') {
			$data['col_array'] = $this->detail_col_c1;
		} else if ($seg1 == 'D404' || $seg1 == 'D504') {
			$data['col_array'] = $this->detail_col_d;
		} else if ($seg1 == 'D412' || $seg1 == 'D512') {
			$data['col_array'] = $this->detail_col_l;
		} else {
			$data['col_array'] = $this->detail_col;
		}

		$data['usecol_array'] = $data['col_array'];

		$data['username'] = $this->session->userdata('manager');
		$data['message'] = '修改資料成功!';
		$this->load->model('sfc/sfci03n_model', '', TRUE);
		$this->sfci03n_model->updatef();
        //1141107 Add
		
		
		//回首頁
		// $this->display();
		//改回修改頁
		$data['seg1'] = $seg1;
		$data['seg2'] = $seg2;
		$data['result'] = $this->sfci03n_model->selone($seg1, $seg2);

		if ($data['result'] == "no_data") {
			redirect('sfc/sfci03n/' . $this->session->userdata('sfci03n_search'));
			exit;
		}


		$data['systitle'] = '報工單-修改資料';
		$data['menu_v'] = 'main_menuno_v';
		$data['content_v'] = 'sfc/sfci03n_upd_v';
		$data['foot_v'] = 'main_foot_v';
		$this->load->vars($data);
		$this->load->view('main_head_v');
	}

	public function updform()   //修改輸入資料
	{
		//權限控管--------------------------------
		$user = trim($this->session->userdata('sysuser'));
		$super = trim($this->session->userdata('syssuper'));
		$rms = trim($this->session->userdata('sysuserrms'));
		$prom = substr($rms, 2, 1);

		if (!$user) {
			redirect('/login/');
		}
		if (!($super == 'Y' || $prom == 'Y')) {
			$_SESSION['rms'] = 'N';
			redirect('/main'); //跳回首頁
		}
		//權限控管--------------------------------END

		$seg1 = $this->uri->segment(4);
		$seg2 = $this->uri->segment(5);

		$data['seg1'] = $seg1;
		$data['seg2'] = $seg2;
		$data['message'] = '查詢一筆修改資料!';
		$this->load->model('sfc/sfci03n_model');
		$data['result'] = $this->sfci03n_model->selone($seg1, $seg2);
		if ($data['result'] == "no_data") {
			redirect('sfc/sfci03n/' . $this->session->userdata('sfci03n_search'));
			exit;
		}

		// echo "<pre>";
		// var_dump($data['result']);


		//Default columns 檢視明細設定
		$data['no_col'] = $this->no_col;
		if ($seg1 == 'D404' || $seg1 == 'D504') {
			$data['col_array'] = $this->detail_col_d;
		} else if ($seg1 == 'D401' || $seg1 == 'D501') {
			$data['col_array'] = $this->detail_col_a;
		} else if ($seg1 == 'D402' || $seg1 == 'D502') {
			$data['col_array'] = $this->detail_col_b;
		} else if ($seg1 == 'D403') {
			$data['col_array'] = $this->detail_col_c;
		} else if ($seg1 == 'D503') {
			$data['col_array'] = $this->detail_col_c1;
		} else if ($seg1 == 'D404' || $seg1 == 'D504') {
			$data['col_array'] = $this->detail_col_d;
		} else if ($seg1 == 'D412' || $seg1 == 'D512') {
			$data['col_array'] = $this->detail_col_l;
		} else {
			$data['col_array'] = $this->detail_col;
		}

		// $this->load->model('set/seti01_model');
		// $coldata = $this->seti01_model->get_detail_view($this->session->userdata('manager'), 'sfci03n');
		// if ($coldata == "no_data" || strlen($coldata->TE003) < 5) {
		// 	$data['usecol_array'] = $data['col_array'];
		// } else {
		// 	$usecol_array = explode(',', $coldata->TE003);
		// 	$data['usecol_array'] = array();
		// 	foreach ($usecol_array as $key => $val) {
		// 		$data['usecol_array'][$val] = $data['col_array'][$val];
		// 	}
		// }
		$data['usecol_array'] = $data['col_array'];
		// echo "<pre>";		var_dump($data['usecol_array']);		exit;

		$data['username'] = $this->session->userdata('manager');
		$data['systitle'] = '報工單-修改資料';
		$data['menu_v'] = 'main_menuno_v';
		$data['content_v'] = 'sfc/sfci03n_upd_v';
		$data['foot_v'] = 'main_foot_v';
		$this->load->vars($data);
		$this->load->view('main_head_v');
	}

	public function see()   //看資料
	{
		$seg1 = $this->uri->segment(4);
		$seg2 = $this->uri->segment(5);
		//以下暫存view處理，上一筆下一筆用
		$view_str = $seg1 . "_" . $seg2;
		if (session_status() == PHP_SESSION_NONE) {
			session_start();
		}
		if (isset($_SESSION['sfci03n']['search']) && isset($_SESSION['sfci03n']['search']['view'][$view_str])) {
			$current_index = $_SESSION['sfci03n']['search']['view'][$view_str];
			if ($current_index != 0) {
				$data['prev'] = $_SESSION['sfci03n']['search']['index'][$current_index - 1];
			}
			if (isset($_SESSION['sfci03n']['search']['index'][$current_index + 1])) {
				$data['next'] = $_SESSION['sfci03n']['search']['index'][$current_index + 1];
			}
			$offset = floor($current_index / 15) * 15;
			$temp_ident = explode('/', $this->session->userdata('sfci03n_search'));
			$this->session->set_userdata('sfci03n_search', "display_search/" . $offset);
			if ($temp_ident[0] == "display") {
				$this->session->set_userdata('sfci03n_search', "display/td002/desc/" . $offset);
			}
		}

		$data['seg1'] = $seg1;
		$data['seg2'] = $seg2;
		$data['message'] = '查詢一筆資料!';
		$this->load->model('sfc/sfci03n_model');
		$data['result'] = $this->sfci03n_model->selone($seg1, $seg2);
		if ($data['result'] == "no_data") {
			redirect('sfc/sfci03n/' . $this->session->userdata('sfci03n_search'));
			exit;
		}

		//Default columns 檢視明細設定
		$data['no_col'] = $this->no_col;
		$data['col_array'] = $this->detail_col;
		$this->load->model('set/seti01_model');
		$coldata = $this->seti01_model->get_detail_view($this->session->userdata('manager'), 'sfci03n');
		if ($coldata == "no_data" || strlen($coldata->TE003) < 5) {
			$data['usecol_array'] = $data['col_array'];
		} else {
			$usecol_array = explode(',', $coldata->TE003);
			$data['usecol_array'] = array();
			foreach ($usecol_array as $key => $val) {
				$data['usecol_array'][$val] = $data['col_array'][$val];
			}
		}

		$data['username'] = $this->session->userdata('manager');
		$data['systitle'] = '移轉單建立-查看資料';
		$data['menu_v'] = 'main_menuno_v';
		$data['content_v'] = 'sfc/sfci03n_see_v';
		$data['foot_v'] = 'main_foot_v';
		$this->load->vars($data);
		$this->load->view('main_head_v');
	}

	public function del()   //刪除單筆 暫存 (置於修改右按鈕)
	{
		$seg1 = $this->uri->segment(4);
		$seg2 = $this->uri->segment(5);
		$data['message'] = '刪除資料成功!';
		$this->load->model('sfc/sfci03n_model', '', TRUE);
		$this->sfci03n_model->deletef($seg1, $seg2);
		$this->display();
	}

	public function delete()   //刪除選取
	{
		$data['message'] = '刪除資料成功!';
		$this->load->model('sfc/sfci03n_model', '', TRUE);
		$this->sfci03n_model->delmutif();
		$this->display();
	}

	public function printb()   //印單據選取
	{
		$this->load->model('sfc/sfci03n_model', '', TRUE);
		$data['message'] = '列印單據成功!';
		$result = $this->sfci03n_model->printfd1($this->uri->segment(4), $this->uri->segment(5));
		$data['results'] = $result['rows'];
		$data['num_results'] = $result['num_rows'];
		$this->load->library('pagination');
		$data['numrow'] = $result['num_rows']; // 總筆數 
		$data['username'] = $this->session->userdata('manager');
		$data['systitle'] = '移轉單';
		$data['content_v'] = 'sfc/sfci03n_printb_v';
		$this->load->vars($data);
		$this->load->view('main_headprint_v');
	}

	public function delete_detail()
	{
		$data['message'] = '刪除資料成功!';
		$this->load->model('sfc/sfci03n_model', '', TRUE);
		$this->sfci03n_model->del_detail();
		redirect('sfc/sfci03n/updform/' . $_POST['del_md001'] . '/' . $_POST['del_md002']);   //重新整理
	}

	//欄位表頭排序   資料流覽 開視窗
	public function display_child($offset = 0, $func = "")
	{
		if (session_status() == PHP_SESSION_NONE) {
			session_start();
		}

		$limit = 10;    //每頁筆數
		$data['message'] = '資料流覽成功!';
		$this->load->model('sfc/sfci03n_model'); // 加載TABLE model 模型
		$result = $this->sfci03n_model->construct_sql_sfcta($limit, $offset, $func); //至model 取 mysql 資料 預設 15,0,ma001,desc
		$data['results'] = $result['data'];
		$data['num_results'] = $result['num'];
		$this->load->library('pagination');
		$data['numrow'] = $result['num']; // 總筆數 
		$data['page'] = $result['num'] / $limit; // 總頁數 
		// $data['page'] = '1';
		$config = array();
		$config['per_page'] = '10'; // 每頁筆數 必填
		$config['first_link'] = '首頁';
		$config['last_link'] = '尾頁';
		$config['next_link'] = '下一頁>';
		$config['prev_link'] = '<上一頁';
		$config['display_pages'] = TRUE;  //顯示數字鏈接 
		$config['full_tag_open'] = '<p>';  // 分頁開始樣式
		$config['full_tag_close'] = '</p>';   // 分頁结束樣式	
		$config['cur_tag_open'] = ' <a class="current">'; // 當前頁開始樣式
		$config['cur_tag_close'] = '</a>'; // 當前頁结束樣式
		$config['cur_page'] = $this->uri->segment(4, 0);   //當前頁 結合分頁url路徑 +1  ,分頁初始化 display 3 + 2 + 1 = 6
		$config['base_url'] = site_url("sfc/sfci03n/display_child");   //設定分頁url路徑
		/* 網址去除".html" */
		$temp_url = explode(".html", $config['base_url']);
		$config['base_url'] = "";
		foreach ($temp_url as $key => $val) {
			$config['base_url'] .= $val;
		}

		$config['total_rows'] = $result['num']; // 總筆數
		$config['per_page'] = $limit;                //每頁筆數
		$config['uri_segment'] = 4;       //當前頁
		$this->pagination->initialize($config);     //分頁初始化 display 3 + 2 + 1 = 6
		$data['pagination'] = $this->pagination->create_links();
		$data['username'] = $this->session->userdata('manager');
		$data['curpage'] = $this->uri->segment(4, 1);   //當前頁第6無時顯示 1
		$data['limit'] = $limit;    //每頁筆數
		$data['systitle'] = '廠商基本資料建立作業';
		$data['menu_v'] = 'main_menu_v';
		$data['content_v'] = 'funnew/sfci03n_child_v';
		$data['foot_v'] = 'main_foot_v';
		$this->load->vars($data);
		$this->load->view('main_headchild_v');
	}

	public function display_childa($offset = 0, $func = "")
	{
		if (session_status() == PHP_SESSION_NONE) {
			session_start();
		}

		$limit = 10;    //每頁筆數
		$data['message'] = '資料流覽成功!';
		$this->load->model('sfc/sfci03n_model'); // 加載TABLE model 模型
		$result = $this->sfci03n_model->construct_sqla($limit, $offset, $func); //至model 取 mysql 資料 預設 15,0,ma001,desc
		$data['results'] = $result['data'];
		$data['num_results'] = $result['num'];
		$this->load->library('pagination');
		$data['numrow'] = $result['num']; // 總筆數 
		$data['page'] = $result['num'] / $limit; // 總頁數 
		// $data['page'] = '1';
		$config = array();
		$config['per_page'] = '10'; // 每頁筆數 必填
		$config['first_link'] = '首頁';
		$config['last_link'] = '尾頁';
		$config['next_link'] = '下一頁>';
		$config['prev_link'] = '<上一頁';
		$config['display_pages'] = TRUE;  //顯示數字鏈接 
		$config['full_tag_open'] = '<p>';  // 分頁開始樣式
		$config['full_tag_close'] = '</p>';   // 分頁结束樣式	
		$config['cur_tag_open'] = ' <a class="current">'; // 當前頁開始樣式
		$config['cur_tag_close'] = '</a>'; // 當前頁结束樣式
		$config['cur_page'] = $this->uri->segment(4, 0);   //當前頁 結合分頁url路徑 +1  ,分頁初始化 display 3 + 2 + 1 = 6
		$config['base_url'] = site_url("sfc/sfci03n/display_childa");   //設定分頁url路徑
		/* 網址去除".html" */
		$temp_url = explode(".html", $config['base_url']);
		$config['base_url'] = "";
		foreach ($temp_url as $key => $val) {
			$config['base_url'] .= $val;
		}

		$config['total_rows'] = $result['num']; // 總筆數
		$config['per_page'] = $limit;                //每頁筆數
		$config['uri_segment'] = 4;       //當前頁
		$this->pagination->initialize($config);     //分頁初始化 display 3 + 2 + 1 = 6
		$data['pagination'] = $this->pagination->create_links();
		$data['username'] = $this->session->userdata('manager');
		$data['curpage'] = $this->uri->segment(4, 1);   //當前頁第6無時顯示 1
		$data['limit'] = $limit;    //每頁筆數
		$data['systitle'] = '廠商基本資料建立作業';
		$data['menu_v'] = 'main_menu_v';
		$data['content_v'] = 'funnew/sfci03n_childa_v';
		$data['foot_v'] = 'main_foot_v';
		$this->load->vars($data);
		$this->load->view('main_headchild_v');
	}

	public function clear_sql()
	{
		if (session_status() == PHP_SESSION_NONE) {
			session_start();
			unset($_SESSION['sfci03n']['search']);
		}
	}
	public function clear_sql_sfcta()
	{
		if (session_status() == PHP_SESSION_NONE) {
			session_start();
			unset($_SESSION['sfci03n']['search']);
		}
		$this->display_child();
	}

	public function clear_sqla()
	{
		if (session_status() == PHP_SESSION_NONE) {
			session_start();
			unset($_SESSION['sfci03n']['search']);
		}
		$this->display_childa();
	}

	/*==以下AJAX處理區域==*/
	//抓取最新一筆的編號
	public function check_title_no()
	{
		extract($this->input->get());
		$this->load->model('sfc/sfci03n_model', '', TRUE);
		$data = $this->sfci03n_model->check_title_no($sfci01, $td008);
		echo $data;
	}

	//刪除單筆細項AJAX
	public function del_detail_ajax()
	{
		// extract($this->input->get());
		$seg1 = $this->input->get('tc001');
		$seg2 = $this->input->get('tc002');
		$seg3 = $this->input->get('tc003');


		$data['message'] = '刪除資料成功!';
		$this->load->model('sfc/sfci03n_model', '', TRUE);
		echo $this->sfci03n_model->deletedetailf($seg1, $seg2, $seg3);
	}
}
/* End of file sfci03n.php */
/* Location: ./application/controllers/sfci03n.php */
