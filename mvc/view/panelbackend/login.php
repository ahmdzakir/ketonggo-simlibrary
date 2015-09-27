<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<title><?php echo Config::Title();?> - Login</title>
	<link rel="stylesheet" type="text/css" href="<?php echo URL::Base();?>assets/css/bootstrap.css">
	<link rel="stylesheet" type="text/css" href="<?php echo URL::Base()?>assets/css/styleadmin.css">
	<script type="text/javascript" src="<?php echo URL::Base()?>assets/js/jquery.js"></script>
</head>
<body>	

	 <div class="container">

      <form class="form-signin" role="form" id="login" method="post" accept-charset="UTF-8" action="<?php echo URL::Base("panelbackend/login/auth")?>">
        <h2 class="form-signin-heading">Please sign in</h2>

		<div id="respon-msg" style="display:none" role="alert"></div>

        <input type="text" 
        class="form-control" name="username" id="username" 
        placeholder="Email address" required autofocus>
        <input type="password" 
        class="form-control" name="password" id="password"
        placeholder="Password" required>
        <button class="btn btn-lg btn-primary btn-block" type="submit">Sign in</button>
      </form>

    </div>

</body>
<style type="text/css">
body {
  padding-top: 40px;
  padding-bottom: 40px;
}

.form-signin {
  max-width: 330px;
  padding: 15px;
  margin: 0 auto;
}
.form-signin .form-signin-heading,
.form-signin .checkbox {
  margin-bottom: 10px;
}
.form-signin .checkbox {
  font-weight: normal;
}
.form-signin .form-control {
  position: relative;
  height: auto;
  -webkit-box-sizing: border-box;
     -moz-box-sizing: border-box;
          box-sizing: border-box;
  padding: 10px;
  font-size: 16px;
}
.form-signin .form-control:focus {
  z-index: 2;
}
.form-signin input[type="email"] {
  margin-bottom: -1px;
  border-bottom-right-radius: 0;
  border-bottom-left-radius: 0;
}
.form-signin input[type="password"] {
  margin-bottom: 10px;
  border-top-left-radius: 0;
  border-top-right-radius: 0;
}

</style>
<script>
$("#login").submit(function(){
		$.ajax({
			url:$(this).attr("action"),
			type:"post",
			data:$(this).serialize(),
			dataType:"json",
			cache:false,
			success:function(data)
			{
				if(data.error)
				{
					$("#respon-msg").text(data.error).fadeOut('500');
					$("#respon-msg").attr("class","alert alert-danger");
					$("#respon-msg").text(data.error).fadeIn('500');
					
				}
				else
				{
					$("#respon-msg").text(data.success).fadeOut('500');
					$("#respon-msg").attr("class","alert alert-success");
					$("#respon-msg").text(data.success).fadeIn('500');
					window.location="<?php echo URL::Base("panelbackend");?>";
				}
			}
		});
		return false;
	});
$(function(){
});
</script>
</html>
