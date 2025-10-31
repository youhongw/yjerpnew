
$(document).ready(function () {
    
    $(':input[type=textbox]').css("text-align", "right");
    TextBoxNumberToAddComma();
    setupEnterToNext();
    
    updSno("DivOsmjb","jb006"); //序號重新排列
    updSno("DivOsmjc","jc004"); //序號重新排列
    
    var smapleHtml_jb = $('#RepOsmjb_sample').html();
    var smapleHtml_jc = $('#RepOsmjc_sample').html();
    
    //增加項目
    $('#addOsmjb').click(function () {
        $('#DivOsmjb').append(smapleHtml_jb);
        updSno("DivOsmjb","jb006"); //序號重新排列
        
        //-----------------
        //Div內倒數第幾個textbox加上千分位功能
        $('#DivOsmjb').find(':input[type=textbox]:eq(-1),:input[type=textbox]:eq(-2)').focus(function()
        {
            //當獲得focus時，要把千分位給拿掉
            $(this).val(RemoveComma($(this).val()));
            $(this).select();
        })
        .blur(function()
        {
            //限制輸入長度
            TextAreaLength(this, 14);
            //加千分位
            AdjustComma(this, $(this).val(), 11);
        });
        
        //-----------------
        
        $( "select[keyid='SelMode']" ).combobox();
        $( "#toggle" ).on( "click", function() {
            $( "select[keyid='SelMode']" ).toggle();
        });
    });
    //增加項目
    
    //增加項目
    $('#addOsmjc').click(function () {
        $(smapleHtml_jc).insertBefore("#LastOsmjc");
        updSno("DivOsmjc","jc004"); //序號重新排列
        
        //-----------------
        //Div內倒數第幾個textbox加上千分位功能
        $('#DivOsmjc').find(':input[type=textbox]:eq(-4),:input[type=textbox]:eq(-5),:input[type=textbox]:eq(-6)').focus(function()
        {
            //當獲得focus時，要把千分位給拿掉
            $(this).val(RemoveComma($(this).val()));
            $(this).select();
        })
        .blur(function()
        {
            //限制輸入長度
            TextAreaLength(this, 14);
            //加千分位
            AdjustComma(this, $(this).val(), 11);
        });
        
        //-----------------
        
        $( "select[keyid='SelMode']" ).combobox();
        $( "#toggle" ).on( "click", function() {
            $( "select[keyid='SelMode']" ).toggle();
        });
    });
    //增加項目

});

//修改銷售額
$("#ja014F").change(function() {
    $(this).val(parseFloat($(this).val()).toFixed(0));
    //console.log($("#ja016").val());
    $("#ja014").val(parseFloat($(this).val()).toFixed(0)).change(); // 銷售額合計
    
    var tax1 = parseFloat(($("#ja014").val() * $("#ja016").val() / 100).toFixed(0));
    var sum1 = parseFloat($("#ja014").val());
    var total1 = tax1 + sum1;
    
    $("#ja017").val(tax1).change(); //營業稅額
    $("#ja018").val(total1).change(); //總金額（含稅）
    $("#ja017F").val(tax1);
    $("#ja018F").val(total1);
    
    if($("#DCtype").val() == 1){
        // $("#ja025").val(tax1); //進項稅額
        // $("#ja028").val(total1); //借方金額（含稅）
        // $("#ja029").val(total1); //貸方金額（含稅）
    }else if($("#DCtype").val() == 2){
        // $("#ja026").val(tax1); //銷項稅額
        // $("#ja028").val(total1); //借方金額（含稅）
        // $("#ja029").val(total1); //貸方金額（含稅）
    }
});
//修改銷售額

//修改總金額（含稅）
$("#ja018F").change(function() {
    $(this).val(parseFloat($(this).val()).toFixed(0));
    //console.log($("#ja016").val());
    $("#ja018").val(parseFloat($(this).val()).toFixed(0)).change(); //總金額（含稅）
    
    var total1 = $("#ja018").val();
    var sum1 = parseFloat(($("#ja018").val() /  (1 + $("#ja016").val() / 100)).toFixed(0));
    var tax1= total1 - sum1;
    
    $("#ja014").val(sum1); // 銷售額合計
    $("#ja017").val(tax1); //營業稅額
    $("#ja014F").val(sum1);
    $("#ja017F").val(tax1);
    
    if($("#DCtype").val() == 1){
        // $("#ja025").val(tax1); //進項稅額
        // $("#ja028").val(total1); //借方金額（含稅）
        // $("#ja029").val(total1); //貸方金額（含稅）
    }else if($("#DCtype").val() == 2){
        // $("#ja026").val(tax1); //銷項稅額
        // $("#ja028").val(total1); //借方金額（含稅）
        // $("#ja029").val(total1); //貸方金額（含稅）
    }
});
//修改總金額（含稅）

//更新序號
function updSno(divName,keyid){
    var i = 0;
    $("#"+divName).find("div[sTag='sortNo']").find("input[keyid='"+keyid+"']").each(function() {
        i++;
        $(this).val(i);
    });
}
//更新序號

//刪除項目
function DelSelf (self) {
    $(self).closest('div[RepDiv="Y"]').remove();
    updSno("DivOsmjb","jb006"); //序號重新排列
    updSno("DivOsmjc","jc004"); //序號重新排列
    TotalCompute();
}
//刪除項目

//計算會計項目資料
function TotalCompute () {
    var sum1 = sum2 = 0;
    $("input[keyid='jb003']").each(function() {
        //$(this).val(parseFloat($(this).val()));
        //if(isNaN($(this).val())) $(this).val(0);
        sum1 += RemoveComma($(this).val()) * 1;
        //if($(this).val() == 0) $(this).val("");
    });
    $("input[keyid='jb004']").each(function() {
        //$(this).val(parseFloat($(this).val()));
        //if(isNaN($(this).val())) $(this).val(0);
        sum2 += RemoveComma($(this).val()) * 1;
        //if($(this).val() == 0) $(this).val("");
    });
    // console.log(sum1);
    // console.log(sum2);
    $("#ja028").val(AppendComma(sum1)); //借方合計
    $("#ja029").val(AppendComma(sum2)); //貸方合計
    
    var disCount = sum1-sum2;
    $("#ja027").val(AppendComma(disCount)); //差額
}
//計算會計項目資料

 //產品明細合計計算
function TotalCount () {
    $("div[id='DivOsmjc'] div[RepDiv='Y']").each(function() {
        var jc008 = parseFloat($(this).find("input[keyid='jc008']").val()); //數量
        console.log(jc008);
        if (isNaN(jc008)) jc008 = 0;
        console.log(jc008);
        $(this).find("input[keyid='jc008']").val(jc008);
        var jc007 = parseFloat($(this).find("input[keyid='jc007']").val()); //單價
        if (isNaN(jc007)) jc007 = 0;
        $(this).find("input[keyid='jc007']").val(jc007);
        var jc010 = jc008*jc007;
        $(this).find("input[keyid='jc010']").val(jc010); //合計
    });
}
//產品明細合計計算

//營業稅稅別設定後計算
$("input[keyid='ja015']:checkbox").click(function(){
    if($(this).prop('checked')){
        $("input[keyid='ja015']:checkbox").prop('checked',false);
        $(this).prop('checked',true);
    }else{
        $(this).prop('checked',true);
    }
    
    $("#ja016").val($(this).attr("taxrate")).change(); // 營業稅率 5(%)
    
    $("#ja014").val(parseFloat($("#ja014").val()).toFixed(0)); // 銷售額合計
    
    var tax1 = parseFloat(($("#ja014").val() * $(this).attr("taxrate") / 100).toFixed(0));
    var sum1 = parseFloat($("#ja014").val());
    var total1 = tax1 + sum1;
    
    $("#ja017").val(tax1).change(); //營業稅額
    $("#ja018").val(total1).change(); //總金額（含稅）
    
    $("#ja014F").val($("#ja014").val()).change(); //銷售額
    $("#ja017F").val($("#ja017").val()); //營業稅額
    $("#ja018F").val($("#ja018").val()); //總金額（含稅）
});
//營業稅稅別設定後計算

//品名自動代入
$("input[keyid='jc006']").change(function() {
    var newHtml = "";
    $("input[keyid='jc006']").each(function() {
        if($(this).val().trim() != ""){
            newHtml += "<option>" + $(this).val() + "</option>";
        }
    });
    $("#pname").html(newHtml);
});
//品名自動代入

//送出表單前判斷
function chkFormMsg(n=1,urlx=""){
    
    //判斷資訊
    //------------- 借、貸方金額判斷 -----------------------
    var ja028 = RemoveComma($("#ja028").val()); //借方金額（含稅）
    var ja029 = RemoveComma($("#ja029").val()); //貸方金額（含稅）
    if (ja028 !== ja029) {
        alert('借貸不平衡，請重新確認!');return false;
    }
    //------------- 借、貸方金額判斷 -----------------------
    
    //------------- 申請、憑證日期判斷 -----------------------
    var reg= /^[1-9]\d{3}-(0[1-9]|1[0-2])-(0[1-9]|[1-2][0-9]|3[0-1])$/;
    var regExp = new RegExp(reg);
    var ja007 = $("#ja007").val(); //申請日期
    var ja008 = $("#ja008").val(); //憑證日期
    if(!regExp.test(ja007)){
        alert("申請日期格式有誤，請確認!!");return false;
    }
    if(!regExp.test(ja008)){
        alert("憑證日期格式有誤，請確認!!");return false;
    }
    //------------- 申請、憑證日期判斷 -----------------------
    //判斷資訊
    
    $(':input[type=textbox]').each(function(i, item)
    {
        $(this).val(RemoveComma($(this).val()));
    });
    
    if(n == 1){
        if(confirm('請再確認一次?')){
            jqueryajax('updform/','right','data','','');
        }else{
            return false;
        }
    }else if(n == 2){
        if(confirm('請再確認一次?')){
            send_transfer('change_qrcode',this,'right',urlx,change_div);
        }else{
            return false;
        }
    }
}
//送出表單前判斷


if($("#ViewTag").val() == "Y"){
    $("input").each(function() {
        $(this).attr('disabled', "disabled");
    });
    $("select").each(function() {
        $(this).attr('disabled', "disabled");
    });
    $("img").each(function() {
        $(this).attr('onclick', "return false;");
    });
    
    $("#refreshData").attr('onclick', "return false;");
    
    $("#refreshData").click(function() {
        $("#refreshData").blur();
    });
}

//******************************** 以下 Combobox功能*********************************
$( function() {
    $.widget( "custom.combobox", {
        _create: function() {
            this.wrapper = $( "<span>" )
                .addClass( "custom-combobox" )
                .insertAfter( this.element );

            this.element.hide();
            this._createAutocomplete();
            this._createShowAllButton();
        },

        _createAutocomplete: function() {
            var selected = this.element.children( ":selected" ),
                value = selected.val() ? selected.text() : "";

            this.input = $( "<input>" )
                .appendTo( this.wrapper )
                .val( value )
                .attr( "placeholder","請輸入欲查詢代碼或文字")
                .attr( "title", "" )
                .addClass( "custom-combobox-input ui-widget ui-widget-content ui-state-default1 ui-corner-left" )
                .attr("style","width:455px;")
                .autocomplete({
                    delay: 0,
                    minLength: 0,
                    source: $.proxy( this, "_source" )
                })
                .tooltip({
                    classes: {
                        "ui-tooltip": "ui-state-highlight1"
                    },
                    content: function() { //增加該定義後即可使用BR斷行
                        return $(this).attr('title');
                    }
                });
            
            //----------------------- 選擇後動作 ------------------------
            this._on( this.input, {
                autocompleteselect: function( event, ui ) {
                    ui.item.option.selected = true;
                    //console.log(ui.item.option.value);
                    //console.log($("#mainId").val());
                    
                    this._trigger( "select", event, {
                        item: ui.item.option
                    });
                },
                autocompletechange: "_removeIfInvalid"
            });
            //----------------------- 選擇後動作 ------------------------
        },

        _createShowAllButton: function() {
            var input = this.input,
                wasOpen = false;

            $( "<a>" )
            .attr( "tabIndex", -1 )
            .attr( "title", "顯示全部" )
            .tooltip()
            .appendTo( this.wrapper )
            .removeClass( "ui-corner-all" )
            .addClass( "custom-combobox-toggle" )
            .attr("style","margin-left:5px;padding:5px;width:25px;height:25px;border:0px solid #000;background-image: url('/sts/images/sys_images/find25x25.png');background-repeat: no-repeat;")
            .on( "mousedown", function() {
                wasOpen = input.autocomplete( "widget" ).is( ":visible" );
            })
            .on( "click", function() {
                input.trigger( "focus" );
                //console.log(2222);
                // Close if already visible
                if ( wasOpen ) {
                    //console.log(11111);
                    return;
                }

                // Pass empty string as value to search for, displaying all results
                input.autocomplete( "search", "" );
            });
        },

        _source: function( request, response ) {
            var matcher = new RegExp( $.ui.autocomplete.escapeRegex(request.term), "i" );
            response( this.element.children( "option" ).map(function() {
                var text = $( this ).text();
                if ( this.value && ( !request.term || matcher.test(text) ) )
                return {
                    label: text,
                    value: text,
                    option: this,
                };
            }) );
        },

        _removeIfInvalid: function( event, ui ) {
            //console.log(44444);
            // Selected an item, nothing to do
            if ( ui.item ) {
                //console.log("=>---" + ui.item);
                return;
            }

            // Search for a match (case-insensitive)
            var value = this.input.val(),
                valueLowerCase = value.toLowerCase(),
                valid = false;
            this.element.children( "option" ).each(function() {
                if ( $( this ).text().toLowerCase() === valueLowerCase ) {
                    this.selected = valid = true;
                    return false;
                }
            });
        
            //console.log("=>" + valid);
    
            // Found a match, nothing to do
            if ( valid ) {
              return;
            }

            // Remove invalid value
            this.input
                .val( "" )
                .attr( "title", "【" + value + "】 <BR>找不到符合的項目" )
                .tooltip( "open" );
            this.element.val( "" );
            this._delay(function() {
                this.input.tooltip( "close" ).attr( "title", "" );
            }, 2500 );
            
            //console.log(6666);
            //this.input.autocomplete( "instance" ).term = "";
        },

        _destroy: function() {
            this.wrapper.remove();
            this.element.show();
        }
    });

    $( "select[keyid='SelMode']" ).combobox();
    $( "#toggle" ).on( "click", function() {
        $( "select[keyid='SelMode']" ).toggle();
    });
} );
//******************************** 以上 Combobox功能*********************************

