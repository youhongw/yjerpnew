<div style="width:80%; text-align:left; height:30px">
目前權限: 
<?php if($INS == 'Y') echo '<span style="color:#000">V 新增</span>'; else echo '<span style="color:#CCC">X 新增</span>';?>&nbsp;&nbsp;
<?php if($UPD == 'Y') echo '<span style="color:#000">V 修改</span>'; else echo '<span style="color:#CCC">X 修改</span>';?>&nbsp;&nbsp;
<?php if($DEL == 'Y') echo '<span style="color:#000">V 刪除</span>'; else echo '<span style="color:#CCC">X 刪除</span>';?>&nbsp;&nbsp;
<?php if($PRN == 'Y') echo '<span style="color:#000">V 列印</span>'; else echo '<span style="color:#CCC">X 列印</span>';?>&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<button class="cbt2">!</button> <span style="color:#999">小提醒 : 以下各欄位修改後即會自動儲存
 | <span style="color:#F03">*</span>為必填欄位
 | <span style="color:#000">*</span>為不可修改欄位</span></span>
</div>

<!--錯誤訊息，呼叫show_error來顯示-->
<span id="error_msg" style="display:none"><?php if(isset($error_msg)) echo $error_msg;?></span>
<span id="msg_times" style="display:none"><?php if(isset($msg_times)) echo $msg_times;?></span>


