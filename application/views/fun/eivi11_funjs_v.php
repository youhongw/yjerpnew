<script language="javascript"   >
function calamt(oInput){         //不更新網頁 2 商品
      //稅金 tc030
	 console.log('test1');
	vmv007=$('input[name=\'mv007\']').val();
	vmv008=$('input[name=\'mv008\']').val();
	$('#mv009').val(Math.round(vmv007*vmv008));
}

function calamt1(oInput){         //不更新網頁 2 商品
      //稅金 tc030
	//  alert('tset2');
	  var tax=0.05;	
	  console.log('test2');
	form.mv026.value=$('input[name=\'mv009\']').val();
	 vmv026=$('input[name=\'mv026\']').val();
	var sumTax =Math.round(vmv026*tax);
	form.mv027.value=sumTax;
	
	form.mv028.value=parseFloat(vmv026)+parseFloat(sumTax); 
	 
}


  // Author: Peter Peng
var pf;
var c_ = new Array('仟','佰','拾','');
var d_ = new Array('零','壹','貳','參','肆','伍','陸','柒','捌','玖');

function NumToCh(oInput)
{
	console.log(oInput);
 var Result;
 var samt=oInput.value;
 var blank= "            "; // 12-space
 var n=samt.indexOf(".");
 if(n>=0)
 {
   samt=samt.substr(0,n); // 只轉換整數部份
   form.mv056.value=samt;
 }

 form.mv056.value="";

 if(isFinite(samt)==false)
 {
   alert("您輸入的資料不是數字!");
   return;
 }

 Leng=samt.length;
 if(Leng==0) return;

 if(Leng>12)
 {
   alert("不可大於12位數!");
   return;
 }

 samt=blank.substr(0,12-Leng) + samt;
  
 pf="";
 Result= Tran(samt.substr(0,4),'億');
 if (Result !="")
    pf=d_[0];
 Result= Result + Tran(samt.substr(4,4),'萬');
 if (Result!="")
    pf=d_[0];

 Result= Result + Tran(samt.substr(8,4),'');
 if (Result=="")
    Result=d_[0];

 form.mv056.value= Result;
}

function Tran(s,cap)
 {
  var n,leadzero,szero,sub;
  var zero='0000';
  var Result="";
  var trim_s=s;
  while(trim_s.indexOf(' ')>=0)
   trim_s=trim_s.replace(' ','');
  
  if (trim_s!="" && s!="0000") 
  {
     leadzero=false;
     szero=d_[0];
     for(n=0;n<4;n++)
     {
       sub=s.substr(n,4);
       if(zero.indexOf(sub)>=0) // 剩下的都是0 ('000' 或 '00' 或 '0')
         break;
       var dig=s.substr(n,1);
       if (dig==' ')
          leadzero=true;
       else if (dig=='0')
       {
          Result=Result + szero;  // 第一個0要加'零',第二個連續0就不加
          szero='';
       }
       else
       {
          Result=Result+ d_[parseInt(dig)] + c_[n];
          szero=d_[0];  // 例如'0102'=零壹佰零貳
       }

     }
     if (leadzero)
        Result=pf+Result;
     Result=Result+cap;
  }
  return Result;
 }
  function NumChange()
 {
 }

 function keydown()
 {
  key=event.keyCode;
  switch (key) 
  {
   case 123 : NumToCh(); break;  // F12
  }

 }
//--></script>

<script type="text/javascript"> 	
//檢查最新編號
function check_title_no(){
	
	var zymd1 = $('input[name=\'mv054\']').val();
	 var zymd2 = $('input[name=\'mv004\']').val();
	 var zymd3 = $('input[name=\'mv005\']').val();
	 var zymd = zymd1+zymd2+zymd3;
	 document.getElementById("mv055").value=zymd;
	
	console.log(zymd);
	$.ajax({
		method: "POST",
		url: "<?php echo base_url() ?>index.php/eiv/eivi11/check_title_no",
		data: {
			mv055: zymd
		}
	})
	.done(function( msg ) {
		
		$('#mv053').val(msg);
	});
}
</script>