$(document).ready(function() 
{
	$("#submitButton").click(function() 
	{

		var emailLogin = $("#emailLogin").val();
		var passwordLogin = $("#passLogin").val();

		if(emailLogin=='' || passwordLogin == '') 
		{
			$('input[type="text"],input[type="password"]')
				.css("border","2px solid red");
			$('input[type="text"],input[type="password"]')
				.css("box-shadow","0 0 3px red");
			alert("Username or Password not correct, please try again.");
		}
		else 
		{
			$.post("../_api/login", 
			{
				email: emailLogin,
				password: passwordLogin
			}, 
			function(data) 
			{
				alert(data);
			});

		}
});