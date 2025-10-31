
$(document).ready(function () {
    
    $(':input[type=textbox]').css("text-align", "right");
    TextBoxNumberToAddComma();
    
    setupEnterToNext();
    
    $('#in001').blur(function () {
        var in001 = $(this).val();
        
        if(in001.trim() == ""){
            $(this).next().html("請輸入西元年").css("color","black");
            return false;
        }
        
        var reg = /\d{4}/;
        var regExp = new RegExp(reg);
        if(!regExp.test(in001)){
            $(this).next().html("["+ $(this).val() +"].輸入有誤，請重新輸入(例:2018)").css("color","red");
            $(this).val("").focus();
        }else{
            var Today=new Date();
            TYear = Today.getFullYear();
            oldY = in001 - 1911;
            if(oldY < 1){
                $(this).next().html("["+ $(this).val() +"].年份有誤，請重新輸入(例:2018)").css("color","red");
                $(this).val("").focus();
            }else if(in001 > TYear){
                $(this).next().html("["+ $(this).val() +"].年份區間有誤，請重新輸入").css("color","red");
                $(this).val("").focus();
            }else{
                $(this).next().html("民國 " + oldY + " 年").css("color","black");
            }
        }
    });
    
    $('#in002').blur(function () {
        var in002 = $(this).val();
        
        if(in002.trim() == ""){
            $(this).next().html("");
            return false;
        }
        
        var reg = /\d{1,2}/;
        var regExp = new RegExp(reg);
        if(!regExp.test(in002)){
            $(this).next().html("["+ $(this).val() +"].輸入有誤，請重新輸入").css("color","red");
            $(this).val("").focus();
        }else{
            if(parseInt(in002) < 1 || parseInt(in002) > 12){
                $(this).next().html("["+ $(this).val() +"].月份區間有誤，請重新輸入").css("color","red");
                $(this).val("").focus();
            }else{
                in002 = paddingLeft(in002,2);
                $(this).val(in002);
                $(this).next().html($(this).val() + "月").css("color","black");
            }
        }
    });
    
    //確認送出表單
    $('#btnSave').click(function () {
        var in001 = $('#in001').val();
        var in002 = $('#in002').val();
        if(in001.trim() == "" || in002.trim() == ""){
            alert("請輸入年份與月份");
            return false;
        }
        
        $(':input[type=textbox]').each(function(i, item)
        {
            $(this).val(RemoveComma($(this).val()));
        });
        
        var in003 = $('#in003').val();
        var in004 = $('#in004').val();
        var in005 = $('#in005').val();
        var in006 = $('#in006').val();
        var in007 = $('#in007').val();
        if((in003 + in004 + in005 + in006 + in007) <= 0){
            alert("尚無金額，請確認");
            return false;
        }

        jqueryajax('updform/'+$("#id").val(),'right','data','','');
    });
    //確認送出表單
    
});

function paddingLeft(str,lenght){
	if(str.length >= lenght)
	return str;
	else
	return paddingLeft("0" +str,lenght);
}