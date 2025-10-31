<p>This is random text for the CodeIgniter article. 
There's nothing to see here folks, just move along!</p>
<h2>Contact Us add</h2>

<form class="submitForm" id="submitForm" method="post" action="test1/contactus">  
        <fieldset>  
          <legend>表单验证</legend>  
          <p>  
            <label for="id">id-username</label>  
            <em>*</em><input class="validate[required,custom[email]]" type="text"  name="id" size="25"  />  
          </p>  
          <p>  
            <label for="name">Required, minimum length 3: </label>
            <em>*</em><input  type="text"   id="name" name="name" required, minimum length 3 />  
          </p>  
          <p>  
            <label for="hobby">Required, minimum length 3: </label>
            <em>*</em><input type="text"  id="hobby" name="hobby" required, email size="25" value=""  
          </p>           
            <input class="submit" type="submit" value="提交"/>  
          </p>  
         </fieldset>  
        </form>  
<script>

$(function(){
  $( "#submitForm" ).validateEngine();
});


</script>
