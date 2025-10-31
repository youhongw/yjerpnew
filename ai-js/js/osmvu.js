
// $("#fileUpload1").change(function(){
    // $("#preview_imgs1").html(""); // 清除預覽
    // var img = "<img style='width: 80%; height: 80%;' src='https://dev.aibooks.tw/sts/sts/images/sys_images/no_pic.png'>";
    // $("#preview_imgs1").html(img);
    // readURL(this);
// });


function SubmitForm(n){
    var ChooseItemNum = $("#fileUpload"+n)[0].files.length;
    if(ChooseItemNum == 0){
        alert("請至少選擇一個檔案");
        return false;
    }
    $("#fileUpload"+n).trigger( "doSomething" );
}

$("#fileUpload1").on( "doSomething", function () {
    readURL(this,1);
});

$("#fileUpload2").on( "doSomething", function () {
    readURL(this,2);
});

function readURL(input,m){
    
    //------------------- 檢查上傳檔案是否正確 -----------------------
    var NumImg = 0;
    var NumTxt = 0;
    var PreImg = "<img style='width: 80%; height: 80%;' src='https://dev.aibooks.tw/sts/sts/images/sys_images/no_pic.png'>";
    
    if (input.files && input.files.length >= 0) {
        
        for(var i = 0; i < input.files.length; i ++){
            //console.log(input.files[i].type);
            
            fileType = input.files[i].type;
            fileName = input.files[i].name;
            
            if(fileType == "text/plain"){
                NumTxt++;
                if(m == 2){
                    $("#vu004").val(fileName);
                }
            }else if(fileType.indexOf("image") != -1){
                NumImg++;
            }
        }
        // console.log("NumImg=>" + NumImg);
        // console.log("NumTxt=>" + NumTxt);
        
        if(m == 2 && (NumImg != 1 || NumTxt != 1)){
            alert("請選擇1張圖片和1個TXT檔(OCR)上傳");
            $("#data").trigger('reset');
            $("#preview_imgs2").html(""); // 清除預覽
            $("#preview_imgs2").html(PreImg);
            $("#vu004").val("");
            $("#ChgChoose2").html("選擇檔案");
            $("#ChgChoose2").attr("title","選擇檔案");
            return false;
        }
        
        //-------------------------- 電子發票與其它票據僅上傳其中一項 ---------------------------
        if(m == 1){
            $("#vu004").val("");
            $("#fileUpload2").val("");
            $("#preview_imgs2").html(""); // 清除預覽
            $("#preview_imgs2").html(PreImg);
            $("#ChgChoose2").html("選擇檔案");
        }else if(m == 2){
            $("#vu005").val("");
            $("#fileUpload1").val("");
            $("#preview_imgs1").html(""); // 清除預覽
            $("#preview_imgs1").html(PreImg);
            $("#ChgChoose1").html("選擇檔案");
        }
        //-------------------------- 電子發票與其它票據僅上傳其中一項 ---------------------------
        
    }
    //------------------- 檢查上傳檔案是否正確 -----------------------
    
    //------------------- 開始預覽圖片 ---------------------------
    if (input.files && input.files.length >= 0) {
        for(var i = 0; i < input.files.length; i ++){
            var reader = new FileReader();
            reader.onload = function (e) {
                arrX = e.target.result.split(";base64");
                fileType = arrX[0];
                
                if(fileType.indexOf("image") != -1){
                    var PreImg = "<img style='width: auto; height: 80%;' src='" + e.target.result + "'>";
                    $("#preview_imgs"+m).html(PreImg);
                }
            }
            reader.readAsDataURL(input.files[i]);
        }
    }else{
        var noPictures = $("<p>目前沒有圖片</p>");
        $("#preview_imgs"+m).html(noPictures);
    }
    //------------------- 開始預覽圖片 ---------------------------
    
    
}

$("#fileUpload1").change(function(){
    var PreImg = "<img style='width: 80%; height: 80%;' src='https://dev.aibooks.tw/sts/sts/images/sys_images/no_pic.png'>";
    var numX = this.files.length;
    var titleX = "選擇檔案";
    if($("#fileUpload1")[0].files[0]){
        titleX = $("#fileUpload1")[0].files[0].name;
    }
    if(numX == 0){
        $("#ChgChoose1").html("選擇檔案");
    }else{
        $("#ChgChoose1").html("已選擇"+numX+"個檔案");
    }
    $("#ChgChoose1").attr("title",titleX);
    
    //-------------------------- 電子發票與其它票據僅上傳其中一項 ---------------------------
    $("#vu004").val("");
    $("#fileUpload2").val("");
    $("#preview_imgs2").html(""); // 清除預覽
    $("#preview_imgs2").html(PreImg);
    $("#ChgChoose2").html("選擇檔案");
    //-------------------------- 電子發票與其它票據僅上傳其中一項 ---------------------------
    $("#vu003").val("");
});

$("#fileUpload2").change(function(){
    var PreImg = "<img style='width: 80%; height: 80%;' src='https://dev.aibooks.tw/sts/sts/images/sys_images/no_pic.png'>";
    var numX = this.files.length;
    var titleX = "選擇檔案";
    if($("#fileUpload2")[0].files[0]){
        titleX = $("#fileUpload2")[0].files[0].name;
    }
    if($("#fileUpload2")[0].files[1]){
        titleX += "\n" + $("#fileUpload2")[0].files[1].name;
    }
    if(numX == 0){
        $("#ChgChoose2").html("選擇檔案");
    }else{
        $("#ChgChoose2").html("已選擇"+numX+"個檔案");
    }
    $("#ChgChoose2").attr("title",titleX);
    
    //-------------------------- 電子發票與其它票據僅上傳其中一項 ---------------------------
    $("#vu005").val("");
    $("#fileUpload1").val("");
    $("#preview_imgs1").html(""); // 清除預覽
    $("#preview_imgs1").html(PreImg);
    $("#ChgChoose1").html("選擇檔案");
    //-------------------------- 電子發票與其它票據僅上傳其中一項 ---------------------------
    $("#vu003").val("");
});

function ClearFrom(){
    
    $("#data").trigger('reset');
    
    var img = "<img style='width: auto; height: auto;' src='https://dev.aibooks.tw/sts/sts/images/sys_images/no_pic.png'>";
    
    //-------------------------- 電子發票與其它票據僅上傳其中一項 ---------------------------
    $("#vu004").val("");
    $("#fileUpload2").val("");
    $("#preview_imgs2").html(""); // 清除預覽
    $("#preview_imgs2").html(img);
    $("#ChgChoose1").html("選擇檔案");
    $("#ChgChoose1").attr("title","選擇檔案");
    //-------------------------- 電子發票與其它票據僅上傳其中一項 ---------------------------

    //-------------------------- 電子發票與其它票據僅上傳其中一項 ---------------------------
    $("#vu005").val("");
    $("#fileUpload1").val("");
    $("#preview_imgs1").html(""); // 清除預覽
    $("#preview_imgs1").html(img);
    $("#ChgChoose2").html("選擇檔案");
    $("#ChgChoose2").attr("title","選擇檔案");
    //-------------------------- 電子發票與其它票據僅上傳其中一項 ---------------------------
    
    $("#cbi_deid1").val(0).trigger('change'); //改變部門
    $("#vu003").val(""); //清除圖片名稱
    
}

$("#cbi_deid1").change(function() {
    $("#cbi_deid2").val($("#cbi_deid1").val());
});

$("#cbi_deid2").change(function() {
    $("#cbi_deid1").val($("#cbi_deid2").val());
});

$("#vu005").on( "blur", function () {
    var str = $(this).val();
    str = str.toUpperCase();
    $(this).val(str);
});