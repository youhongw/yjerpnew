
var DivIdName = "DivOsmdemo"; //整個table的Div Id Name
var SortKeyIdName = "sortkeyid"; //需要填入排序值的Keyid Name
var RepDivIdName = "RepDemo"; //重覆項目的RepId Name
var SampleRepDivIdName = "RepDemo_sample"; //需要重覆的範本sample Div Id Name

$(document).ready(function () {
    
    updSno(DivIdName,SortKeyIdName); //更新序號
    
    $("#" + SampleRepDivIdName).hide();
    
    //---------------------- 新增項目 -------------------
    var smapleHtml = $('#' + SampleRepDivIdName).html();
    
    $('#addchild').click(function () { //點擊增加按鈕後
        
        /*用法一，append 是在該Div中最後一筆添加項目*/
        $('#DivOsmdemo').append(smapleHtml);
        
        /*用法二，insertBefore 是在指定Div前添加項目*/
        // $(smapleHtml).insertBefore( "#LastRecord" );

        updSno(DivIdName,SortKeyIdName); //更新序號
    });
    //---------------------- 新增項目 -------------------

});


//---------------------- 更新序號 -------------------
function updSno(divName,keyid){  //(DivID,欄位keyid)
    var i = 0;
    $("#"+divName).find("div[sTag='sortNo']").find("input[keyid='"+keyid+"']").each(function() {
        i++;
        $(this).val(i);
    });
}
//---------------------- 更新序號 -------------------

//---------------------- 刪除項目 -------------------
function DelSelf (self) {
    $(self).closest('div[RepId="'+RepDivIdName+'"]').remove();
    updSno(DivIdName,SortKeyIdName); //更新序號
}
//---------------------- 刪除項目 -------------------