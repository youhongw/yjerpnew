$(document).ready(function () {
    let acttbHtml = $('div.acttb_sample').html()
    $('div.addchild').click(function () {
        let newOrder = 1
        let orderList = document.querySelectorAll('input.order')
        if (orderList.length > 0) {
            orderList.forEach(element => {
                newOrder = element.value >= newOrder ? element.value * 1 + 1 : newOrder
            })
        }
        let baseUrl = document.querySelector('div.addchild img').getAttribute('src').split('add')[0]
        $('div.table.table_jump_color').append(
            '<div class="acttb">' +
            '<div onclick="delSelf(this)" class="delchild" style="min-width: 45px;"><img src="' + baseUrl + 'delete.png" title="刪除資料"/></div>' +
            '<div style="display:none;"><input name="acttb_id[]" value="0" type="text"></div>' +
            '<div><input class="order" style="width:40px" keyid="tb003" id="tb003" name="tb003[]" value="' + newOrder + '" type="text"></div>' +
            acttbHtml +
            '</div>'
        )
    })
})

function delSelf (self) {
    $(self).parent().remove()
}

$("select[keyid='tb005']").change(function() {
    var text1 = $(this).find("option:selected").text();
    var keyval1 = $(this).attr("keyval");
    
    if($(this).val() !== "0"){
        $("input[keyid='tb018_"+keyval1+"']").val(text1.split("_")[1]).change();
    }else{
        $("input[keyid='tb018_"+keyval1+"']").val("").change();
    }
});

$("select[keyid='Last_tb005']").change(function() {
    var text1 = $(this).find("option:selected").text();
    
    if($(this).val() !== "0"){
        $("input[keyid='Last_tb018']").val(text1.split("_")[1]).change();
    }else{
        $("input[keyid='Last_tb018']").val("").change();
    }
});
