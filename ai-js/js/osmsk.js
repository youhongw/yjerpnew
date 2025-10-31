


//--------------- 部門 ---------------------
$("#cbi_deid").change(function() {
    var text1 = $(this).find("option:selected").text();
    var keyval1 = $(this).attr("keyval");
    
    if($(this).val() !== "0"){
        $("#sk004").val(text1).change();
    }else{
        $("#sk004").val("").change();
    }
});
//--------------- 部門 ---------------------


$("#cbi_vtid").change(function() {
    var text1 = $(this).find("option:selected").text();
    var keyval1 = $(this).attr("keyval");
    
    if($(this).val() !== "0"){
        $("#sk008").val(text1).change();
    }else{
        $("#sk008").val("").change();
    }
});

$("input[keyid='sk007']:checkbox").click(function(){
    if($(this).prop('checked')){
        $("input[keyid='sk007']:checkbox").prop('checked',false);
        $(this).prop('checked',true);
    }else{
        $(this).prop('checked',true);
    }
    $("#sk007").val($(this).val()).change();
});


//******************************** 以下 標籤功能*********************************
$(function(){
    //var sampleTags = ['c++', 'java', 'php', 'coldfusion', 'javascript', 'asp', 'ruby', 'python', 'c', 'scala', 'groovy', 'haskell', 'perl', 'erlang', 'apl', 'cobol', 'go', 'lua'];
    var sampleTags = [];
    
    
    //-------------------------------
    // Minimal
    //-------------------------------
    $('#myTags').tagit();

    //-------------------------------
    // Single field
    //-------------------------------
    $('#singleFieldTags').tagit({
        availableTags: sampleTags,
        // This will make Tag-it submit a single form value, as a comma-delimited field.
        singleField: true,
        singleFieldNode: $('#sk003')
    });

    // singleFieldTags2 is an INPUT element, rather than a UL as in the other 
    // examples, so it automatically defaults to singleField.
    $('#singleFieldTags2').tagit({
        availableTags: sampleTags
    });

    //-------------------------------
    // Preloading data in markup
    //-------------------------------
    $('#myULTags').tagit({
        availableTags: sampleTags, // this param is of course optional. it's for autocomplete.
        // configure the name of the input field (will be submitted with form), default: item[tags]
        itemName: 'item',
        fieldName: 'tags'
    });

    //-------------------------------
    // Tag events
    //-------------------------------
    var eventTags = $('#eventTags');

    var addEvent = function(text) {
        $('#events_container').append(text + '<br>');
    };

    eventTags.tagit({
        availableTags: sampleTags,
        beforeTagAdded: function(evt, ui) {
            if (!ui.duringInitialization) {
                addEvent('beforeTagAdded: ' + eventTags.tagit('tagLabel', ui.tag));
            }
        },
        afterTagAdded: function(evt, ui) {
            if (!ui.duringInitialization) {
                addEvent('afterTagAdded: ' + eventTags.tagit('tagLabel', ui.tag));
            }
        },
        beforeTagRemoved: function(evt, ui) {
            addEvent('beforeTagRemoved: ' + eventTags.tagit('tagLabel', ui.tag));
        },
        afterTagRemoved: function(evt, ui) {
            addEvent('afterTagRemoved: ' + eventTags.tagit('tagLabel', ui.tag));
        },
        onTagClicked: function(evt, ui) {
            addEvent('onTagClicked: ' + eventTags.tagit('tagLabel', ui.tag));
        },
        onTagExists: function(evt, ui) {
            addEvent('onTagExists: ' + eventTags.tagit('tagLabel', ui.existingTag));
        }
    });

    //-------------------------------
    // Read-only
    //-------------------------------
    $('#readOnlyTags').tagit({
        readOnly: true
    });

    //-------------------------------
    // Tag-it methods
    //-------------------------------
    $('#methodTags').tagit({
        availableTags: sampleTags
    });

    //-------------------------------
    // Allow spaces without quotes.
    //-------------------------------
    $('#allowSpacesTags').tagit({
        availableTags: sampleTags,
        allowSpaces: true
    });

    //-------------------------------
    // Remove confirmation
    //-------------------------------
    $('#removeConfirmationTags').tagit({
        availableTags: sampleTags,
        removeConfirmation: true
    });
    
});
//******************************** 以上 標籤功能*********************************

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
                    
                    //----------------------- 儲存資料 ------------------------
                    mainId = $("#mainId").val();
                    send_transfer1('UpdOsmsk','cbi_asid',ui.item.option,'','id=' + mainId);
                    var text1 = ui.item.value;
                    if(mainId !== "0"){
                        $("#sk001").val(text1.split("_")[0]).change();
                        $("#sk002").val(text1.split("_")[1]).change();
                    }else{
                        $("#sk001").val("").change();
                        $("#sk002").val("").change();
                    }
                   //----------------------- 儲存資料 ------------------------
                   
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

    $( "#cbi_asid" ).combobox();
    $( "#toggle" ).on( "click", function() {
        $( "#cbi_asid" ).toggle();
    });
} );
//******************************** 以上 Combobox功能*********************************