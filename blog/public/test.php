<?php
header("content-type:text/html;charset=utf-8"); 
?>
<!DOCTYPE html>
<html>
<head>
	<title>file upload</title>
	<script src="jquery.js"></script>
    <style type="text/css">
    .log{
        border: 1px solid auto;
    }
    </style>
</head>
<body>
<form name="form1" id="form1" enctype="multipart/form-data"> 
        <div class="log" data-time="1"></div>
        <div class="log" data-time="2"></div> 
        <p>name:<input type="text" name="name" /></p>  
        <p>gender:<input type="radio" name="gender" value="1" />male <input type="radio" name="gender" value="2" />female</p>
        <p>stu-number:<input type="text" name="number" /></p>  
        <p>photo:<input type="file" name="photo" id="photo"></p>  
        <p><input type="button" name="b1" value="submit" onclick="fsubmit()" /></p>  
</form>  
<div id="result"></div>
</body>
<script type="text/javascript">
function fsubmit() {

        var form=document.getElementById("form1");
        var fd =new FormData(form);
        $.ajax({
             url: "server1.php",
             type: "POST",
             data: fd,
             processData: false,  // 告诉jQuery不要去处理发送的数据
             contentType: false,   // 告诉jQuery不要去设置Content-Type请求头
             success: function(response,status,xhr){
                console.log(xhr);
                var json=$.parseJSON(response);
                var result = '';
                result +="个人信息：<br/>name:"+json['name']+"<br/>gender:"+json['gender']+"<br/>number:"+json['number'];
                
                 $('#result').html(result);
             }
        });
        return false;
    }
$(function(){
    $(".log[data-time='2']").html("<h1>hello world<h1/>");

})();
</script>
</html>