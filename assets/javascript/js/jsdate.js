<script type="text/javascript">
// 單擊輸入文本框右側的按鈕將觸發這個函數
function displayCalendar(){
  drawCalendar();
}
// 單擊日期輸入控制項底部的關閉按鈕將觸發這個函數
// 這個函數將清空alendarContainer的內容，也就等於是關閉了日期輸入控制項
function closeCalendar(){
  var oCalendarContainer =
                      document.getElementById("calendarContainer");
  oCalendarContainer.innerHTML = "";
}
// 下面的函數創建日期輸入控制項
function drawCalendar(sYear,sMonth){
  var newDate;
  // 初始打開的時候是當前系統的日期，否則使用自定義的日期
  // 自定義的日期往往是由日期輸入控制項頂部的兩個按鈕來控制的
  if(arguments[0]==null||arguments[1]==null){
    newDate = new Date();
  }else{
    newDate = new Date(sYear,sMonth-1);
  }
  var date_year = newDate.getFullYear();
  var date_month = newDate.getMonth()+1;
  var date_today = newDate.getDate();
  var date_day = newDate.getDay();
  // 下面的幾個變數用於給日期輸入控制項頂部的兩個按鈕提供事件參數
  // 如果當前是8月，那麼向前翻就是9月，向後翻就是7月
  // 但是，當前月是12月或者1月時就應該注意，因為這個時候將會有年份的變化
  var nextMonth = date_month+1;
  var nextYear = date_year;
  var prevMonth = date_month-1;
  var prevYear = date_year;
  if(sMonth==12){nextMonth=1;nextYear=date_year+1;}
  if(sMonth==1){prevMonth=12;prevYear=date_year-1;}
  var calendarTable="";
  calendarTable += '<table width="150" border="0" '+
            ' cellpadding="0" cellspacing="1" '+
            ' style="background-color:#0066FF;text-align:center;">';
  calendarTable += '  <tr style="background-color:#339999;">';
  // 向後翻月
  calendarTable += '    <td onclick="javascript:drawCalendar(' +
      prevYear + ',' + prevMonth + ');" ' +
      ' style="cursor:pointer;background-color:#FF6600;"><<</td>';
  calendarTable += '    <td colspan="5">'+date_year+
                                   "年"+date_month+'月</td>';
  // 向前翻月
  calendarTable +=
      ' <td onclick="javascript:drawCalendar('+nextYear+
      ',' + nextMonth + ');" ' +
      ' style="cursor:pointer;background-color:#FF6600;">>></td>';
  calendarTable += '  </tr>';    
  // 星期表頭
  calendarTable += '  <tr style="background-color:#6699FF;">';
  calendarTable += '    <td>日</td>';
  calendarTable += '    <td>一</td>';
  calendarTable += '    <td>二</td>';
  calendarTable += '    <td>三</td>';
  calendarTable += '    <td>四</td>';
  calendarTable += '    <td>五</td>';
  calendarTable += '    <td>六</td>';
  calendarTable += '  </tr>';  

  // 計算一個月內的天數，這裏要注意是否閏月
  var dayNum_in_month = [31,28,31,30,31,30,31,31,30,31,30,31]
  var isleapyear = date_year%4;
  if (isleapyear == 0) {
    dayNum_in_month[1] = "29";
  }
  var month_alldays = dayNum_in_month[date_month-1];
  // 計算行數       
  var line_top;
  var line_bot;
  if ((date_today-date_day+1)%7 != 0) {
	// line_top表示當前日期上面的行數，包括當前行
	line_top = Math.floor((date_today-date_day+1)/7)+1;
  } else {
	line_top = Math.floor((date_today-date_day+1)/7);
  }
  if ((30-date_today+date_day+1)%7 != 0) {
	// line_bot表示當前日期下面的行數，不包括當前行
	line_bot = Math.floor((30-date_today+date_day+1)%7)+1;
  } else {
	line_bot = Math.floor((30-date_today+date_day+1)%7);
  }
  // 定義一個二維陣列，我們預備是一個6X7的陣列，陣列中每個元素就對應一個單格
  var dateList = new Array([""],[""],[""],[""],[""],[""],[""]);
  var dateCell;
  for (var i=1; i<7; i++) {
    // i就是行數
    calendarTable += '  <tr>';
    for (var j=0; j<7; j++) {
	  // j就是列數
	  dateList[i][j] = date_today-7*(line_top-i+1)+j-date_day;
	  // 如果日期值<=0，那麼將它置空
	  if ((date_today-7*(line_top-i+1)+j-date_day) <= 0) {
		dateList[i][j] = "&nbsp;";
	  }
	  // 如果值大於當月總天數，那麼文本框不顯示值
	  if ((date_today-7*(line_top-i+1)+j-date_day)>month_alldays) {
	    dateList[i][j] = "&nbsp;";
	  }
	  if (dateList[i][j] != "&nbsp;") {
		// 如果單格不為空，那麼就可以設置其可以觸發事件，有三個事件：
		// [01]單擊事件，將會把當前日期寫到輸入文本框
		// [02]滑鼠指標移到單格上面事件，將會改變背景突出顯示
		// [03]滑鼠指標移出單格事件，將會初始化背景
		dateCell =
                   '<td onclick="javascript:setDateText('+date_year+
                   ','+date_month+',this.firstChild.nodeValue);" '+
                   ' onmouseover="javascript:setFocus(this);" '+
                   '  onmouseout="javascript:setFocusOut(this);" '+
                   '  style="cursor:pointer;">'+dateList[i][j]+'</td>';
	    if (i == line_top+1 && j==date_day){
	        // 當前日期的設置，包括改變文本的顏色以突出顯示，也包含同樣的三個事件
		  dateCell = '<td onclick="javascript:setDateText(' +
               date_year + ',' + date_month +
               ',this.firstChild.nodeValue);" '+
               ' onmouseover="javascript:setFocus(this);" '+
               ' onmouseout="javascript:setFocusOut(this);" '+
               ' style="background-color:#FF6600;cursor:pointer;">'+
               dateList[i][j]+'</td>';
	    }
	  } else {
	    dateCell = "<td>&nbsp;</td>";
	  }	  
	  calendarTable += dateCell;
	}
    calendarTable += '</tr>';
  }
  calendarTable += '<tr><td colspan="7" '+
               ' onclick="javascript:closeCalendar();"'+
               ' style="background-color:#339999;cursor:pointer;"> '+
               '關閉</td></tr>';
  calendarTable += '</table>'; 
  // 將輸入日期控制項寫入calendarContainer
  var oCalendarContainer =
                      document.getElementById("calendarContainer");
  oCalendarContainer.innerHTML = calendarTable;
}
// 當滑鼠指標指到這個日期上時觸發這個函數設置背景
function setFocus(who){
  who.style.backgroundColor="#FF6600";
  
}
// 當滑鼠指標離開這個日期時觸發這個函數還原背景
function setFocusOut(who){
  who.style.backgroundColor="";
}
// 當滑鼠單擊觸發這個函數，為日期文本框賦值
function setDateText(sYear,sMonth,sDate){
  var oDateText = document.getElementById("dateText");
  oDateText.value = sYear+"/"+sMonth+"/"+sDate;
}
</script>