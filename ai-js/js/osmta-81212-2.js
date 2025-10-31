let saveEvent
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
            '<div onclick="DelSelf(this)" class="delchild" style="min-width: 45px;"><img src="' + baseUrl + 'delete.png" title="刪除資料"/></div>' +
            '<div style="display:none;"><input name="acttb_id[]" value="0" type="text"></div>' +
            '<div><input class="order" style="width:40px" keyid="tb003" id="tb003" name="tb003[]" value="' + newOrder + '" type="text"></div>' +
            acttbHtml +
            '</div>'
        )
        $('div.acttb select[name="tb004[]"]').change(function () {
            TotalCompute()
        })
        $('div.acttb input[name="tb007[]"]').change(function () {
            TotalCompute()
        })
    })
    saveEvent = document.querySelector('#btnSave').onclick
})

function DelSelf (self) {
    $(self).parent().remove()
}

function TotalCompute () {
    let classList = document.querySelectorAll('div.acttb select[name="tb004[]"]')
    let amountList = document.querySelectorAll('div.acttb input[name="tb007[]"]')
    let ta007 = 0
    let ta008 = 0
    classList.forEach((element, index) => {
        if (element.value == 'C') {
            ta007 += amountList[index].value * 1
        } else if (element.value == 'D') {
            ta008 += amountList[index].value * 1
        }
    })
    document.querySelector('input[name="ta007"]').value = ta007
    document.querySelector('input[name="ta008"]').value = ta008
    if (ta007 !== ta008) {
        document.querySelector('#btnSave').onclick = function () {
            alert('借貸不平衡，請重新確認!')
        }
    } else {
        document.querySelector('#btnSave').onclick = saveEvent
    }
}

$('div.acttb select[name="tb005[]"]').change(function () {
     var text1 = $(this).find("option:selected").text();
     var keyval1 = $(this).attr("keyval");
    console('testtb005');
        })

$("select[keyid='tb005']").change(function() {
    var text1 = $(this).find("option:selected").text();
    var keyval1 = $(this).attr("keyval");
    console('test1');
    if($(this).val() !== "0"){
        $("input[keyid='tb018_"+keyval1+"']").val(text1.split("_")[1]).change();
    }else{
        $("input[keyid='tb018_"+keyval1+"']").val("").change();
    }
});

$("select[keyid='Last_tb005']").change(function() {
    var text1 = $(this).find("option:selected").text();
    console('test2');
    if($(this).val() !== "0"){
        $("input[keyid='Last_tb018']").val(text1.split("_")[1]).change();
    }else{
        $("input[keyid='Last_tb018']").val("").change();
    }
});
