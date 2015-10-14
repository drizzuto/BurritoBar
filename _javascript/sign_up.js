function isSet(value) {
	if (value == '')
	{
		return false;
	}

	return true;
}

$(document).ready(function () 
{
	$("#submitButton").click(function() 
	{
		var emailSignUp= $("#emailSignUp").val();
		var passwordSignUp = $("#passwordSignUp").val();
		var firstNameSignUp = $("#firstNameSignUp").val();
		var lastNameSignUp = $("#lastNameSignUp").val();
		var creditCardNumberSignUp = $("#creditCardNumberSignUp").val();
		var creditCardTypeSignUp = $("#creditCardTypeSignUp").val();

		if(!isSet(em)) 
		{
			$('input[type="text"],input[type="password"]')
				.css("border","2px solid red");
			$('input[type="text"],input[type="password"]')
				.css("box-shadow","0 0 3px red");
			alert("Please fill out all fields");
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
});