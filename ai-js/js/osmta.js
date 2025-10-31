
$(document).ready(function () {
    
    $(':input[type=textbox]').css("text-align", "right");
    TextBoxNumberToAddComma();
    
    updSno("DivActtb","tb003");
    
    var smapleHtml = $('#RepActtb_sample').html();
    
    $('#addchild').click(function () {
        
        $('#DivActtb').append(smapleHtml);
        updSno("DivActtb","tb003"); //序號重新排列
        
        //-----------------
        $('#DivActtb').find(':input[type=textbox]').last().focus(function()
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
    })
    
    document.querySelector('#btnSave').onclick = function () {
        var ta007 = RemoveComma($("#ta007").val());
        var ta008 = RemoveComma($("#ta008").val());
        
        if (ta007 !== ta008) {
            alert('借貸不平衡，請重新確認!');
        }else{
            $(':input[type=textbox]').each(function(i, item)
            {
                $(this).val(RemoveComma($(this).val()));
            });
            jqueryajax('updform/'+$("#taid").val(),'right','data','','');
        }
    }
    
});

function updSno(divName,keyid){
    var i = 0;
    $("#"+divName).find("div[sTag='sortNo']").find("input[keyid='"+keyid+"']").each(function() {
        i++;
        $(this).val(i);
    });
}

function DelSelf (self) {
    $(self).closest('div[RepId="RepActtb"]').remove();
    updSno("DivActtb","tb003");
    TotalCompute();
}

function TotalCompute () {
    //return false;
    
    var classList = document.querySelectorAll('div[RepId="RepActtb"] select[name="tb004[]"]');
    var amountList = document.querySelectorAll('div[RepId="RepActtb"] input[name="tb007[]"]');
    var ta007 = 0; //借
    var ta008 = 0; //貸
    classList.forEach((element, index) => {
        if (element.value == 'C') { //貸
            ta008 += RemoveComma(amountList[index].value) * 1;
        } else if (element.value == 'D') { //借
            ta007 += RemoveComma(amountList[index].value) * 1;
        }
    });
    // console.log(ta007);
    document.querySelector('input[name="ta007"]').value = AppendComma(ta007); //借方合計
    document.querySelector('input[name="ta008"]').value = AppendComma(ta008); //貸方合計
    
    var disCount = ta007-ta008;
    document.querySelector('input[id="disCount"]').value = AppendComma(disCount); //差額
    
    //TextBoxNumberToAddComma();

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
                .attr("style","width:300px;")
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