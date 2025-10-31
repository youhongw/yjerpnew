
$(document).ready(function () {
    
    $('#submitForm').click(function () {
        
        
        var Sdate = $("#Sdate").val();
        var Edate = $("#Edate").val();
        
        var reg = /^[1-9]\d{3}-(0[1-9]|1[0-2])-(0[1-9]|[1-2][0-9]|3[0-1])$/;
        var regExp = new RegExp(reg);
        if(!regExp.test(Sdate)){
            alert("日期格式不正確，請重新輸入(格式:2018-09-01)");
            return false;
        }else{
            if(!isExistDate(Sdate)){
                alert("不存在該日期，請重新輸入");
                return false;
            }
        }
        
        
        
        console.log($("#Sdate").val());
        return false;
        
        jqueryajax('printf','right','data','','');
    })
    
});

function isExistDate(dateStr) {
    var dateObj = dateStr.split('-'); // yyyy-mm-dd

    //列出12個月，每月最大日期限制
    var limitInMonth = [31, 28, 31, 30, 31, 30, 31, 31, 30, 31, 30, 31];

    var theYear = parseInt(dateObj[0]);
    var theMonth = parseInt(dateObj[1]);
    var theDay = parseInt(dateObj[2]);
    var isLeap = new Date(theYear, 1, 29).getDate() === 29; // 是否為閏年?

    if (isLeap) {
        // 若為閏年，最大日期限制改為 29
        limitInMonth[1] = 29;
    }

    // 比對該日是否超過每個月份最大日期限制
    return theDay <= limitInMonth[theMonth - 1];
}

//自動加入千分符號
function TextBoxNumberToAddComma()
{
    $(':input[type=textbox]').each(function(i, item)
    {
        // console.log(i);
        //加千分位
        AdjustComma(this, $(this).val(), 11);
        
        $(item).focus(function()
        {
            //當獲得focus時，要把千分位給拿掉
            $(this).val(RemoveComma($(this).val()));
            $(this).select();
        })
        .keydown(function(e)
        {
            if(e.keyCode === 13){
                $(this).blur(); //解決Enter鍵後，blur重覆執行問題
            }
        })
        .blur(function()
        {
            //限制輸入長度
            TextAreaLength(this, 14);
            //加千分位
            AdjustComma(this, $(this).val(), 11);
        });
    });
}

//數字處理為有千分位
function AppendComma(n)
{
    if (!/^[0-9]+(.[0-9]{1,2})?$/.test(n)) // ^[0-9]+(.[0-9]{1,2})?$ //有1~2位小數的正實數
    {
        var newValue = /^[0-9]+(.[0-9]{1,2})?$/.exec(n);
        if (newValue != null)
        {
            //if (parseInt(newValue, 10))
            if (parseFloat(newValue))
            {
                n = newValue;
            }
            else
            {
                n = '0';
            }
        }
        else
        {
            n = '0';
        }
    }
    
    if (parseFloat(n) == 0)
    {
        n = '0';
    }
    else
    {
        n = parseFloat(n).toString();
    }
    
    n += '';
    var arr = n.split('.');
    // var re = /(\d{1,3})(?=(\d{3})+(?:$|\D))/g;
    // return arr[0].replace(re, '$1,') + (arr.length == 2 ? '.' + arr[1] : '');
    var re = /(\d)(?=(\d\d\d)+(?!\d))/g; 
    return arr[0].replace(re,"$1,") + (arr.length == 2 ? "."+arr[1] : ""); 
}
//將有千分位的數值轉為一般數字
function RemoveComma(n)
{
    return n.replace(/[,]+/g, '');
}
//調整千分位
function AdjustComma(item, length)
{
    var originalValue = $.trim($(item).val()).length > length 
        ? $.trim($(item).val()).substr(0, length) 
        : $.trim($(item).val());
    $(item).val(AppendComma(originalValue));
}
//動態調整輸入欄位的長度
function TextAreaLength(item, length) 
{
    if (item.value.length > length) 
    {
        item.value = item.value.substring(0, length);
    }
}
//自動加入千分符號

//按Enter跳至下一input
function setupEnterToNext() {
  // add keydown event for all inputs
  $(':input').keydown(function (e) {
    if (e.keyCode == 13 /*Enter*/) {
        // focus next input elements
        $(':input:visible:enabled:eq(' + ($(':input:visible:enabled').index(this) + 1) + ')').focus();
        e.preventDefault();
    }
  });
}
//按Enter跳至下一input