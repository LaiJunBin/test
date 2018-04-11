<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>無標題文件</title>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/themes/smoothness/jquery-ui.css">
<script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
<link rel="stylesheet" href="../assets/main.css">
<script src="../assets/main.js"></script>
<script>

	$(function(){

		function plotCaptcha(maxLength){
			$("#captcha,#captchaImg").html('');
			$("[name=captcha]").val('');
			var code = [];
			for(var i = 1 ; i <=maxLength;i++){
				$.ajax({
					url:'captcha/getText.php',
					async:false,
					success:function(result){
						code.push(result);
						var img = document.createElement("img");
						img.src = 'captcha/plot.php?code='+result;
						$(img).attr('va',result);
						$("#captchaImg").append(img);
						$("#captcha").append("<div></div>");
					}
				});
			}
			code.sort();
			$("[name=ans]").val(code.join(''));
			$("#captchaImg img").draggable({
				snap:'#captcha div'	,
				snapMode:'inner',
				revert:'invalid'
			});
			$('#captcha div').droppable({
				drop:function(event,ui){
					var v = '';
					ui.helper.appendTo(this).css({
						'top':0,
						'left':0	
					});
					
					$("#captcha img").each(function(){
						v+=$(this).attr('va');
					});
					$("[name=captcha]").val(v);
				}
			});
		}
		plotCaptcha(4);
		$("#captchaBtn").click(function(){
			plotCaptcha(4);
		});
	});

</script>

</head>

<body>

	<div id="container">
    	<h1>汽車共乘網站管理-登入</h1>
    	<a href="../" class="ui-button fill">回首頁</a>
        <form method="post" action="loginProcess.php">
    	<table width="50%" border="0" align="center">
          <tr>
            <td>帳號</td>
            <td><input type="text" name="username" /></td>
          </tr>
          <tr>
            <td>密碼</td>
            <td><input type="password" name="password" /></td>
          </tr>
          <tr>
            <td>圖形驗證碼</td>
            <td>
            	<div id="captcha">
                
                </div>
            </td>
          </tr>
          <tr>
            <td>
            	<div id="captchaImg">
                </div>
            </td>
            <td>
            	<button type="button" id="captchaBtn">重新產生驗證碼</button>
            </td>
          </tr>
          <tr>
            <td colspan="2">
            	<button type="submit" class="ui-button">登入</button>
                <button type="reset">重設</button>
            </td>
          </tr>
        </table>
        <input type="hidden" name="ans" />
        <input type="hidden" name="captcha" />
</form>

    
    </div>



</body>
</html>