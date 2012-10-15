function isValidEmail(email_address)
{
	var format = /^([0-9a-zA-Z_\.-]+)@([0-9a-zA-Z_-]+)(\.[0-9a-zA-Z_-]+){1,2}$/; 
            
        if (email_address.search(format) != -1)  
        {    
            return true;  
        }  
        else  
        {    
            return false;  
        }  
}

function join(){
	document.location.href='member.php';
}
function save_info(){
	document.location.href='save_info.php';
}
function login(){
	if(document.login_form.id.value =="")
	{
		alert('Username is required.');
		document.login_form.id.focus();
	}
	
	else if(document.login_form.pw.value =="")
	{
		alert('Password is required.');
		document.login_form.pw.focus();
	}
	
	else
	{
		document.login_form.submit();
	}
}

function join_ok(){
	var join = document.member_form;
	
	if(join.id.value == "")
	{
		alert('Username is required');
		join.id.focus();
	}
	
	else if(join.id.value.indexOf(" ")>=0)
	{
		alert('Username cannot contain spaces');
		join.id.value = "";
		join.id.focus();
	}
	
	else if(join.pw.value == "")
	{
		alert('Password is required');
		join.pw.focus();
	}
		
	else if(join.pw_02.value == "")
	{
		alert('Confirm Password is required');
		join.pw_02.focus();
	}
	
	else if(join.pw.value.length<6)
	{
		alert('Password must be at least 6 characters.');
		join.pw.value = "";
		join.pw_02.value = "";
		join.pw.focus();
	}
	
	else if(join.f_name.value == "")
	{
		alert('First Name is required');
		join.f_name.focus();
	}
		
	else if(join.l_name.value == "")
	{
		alert('Last Name is required');
		join.l_name.focus();
	}	
	
	else if(join.email.value == "")
	{
		alert('Email is required');
		join.email.focus();
	}
	
	else if(!isValidEmail(join.email.value))
	{
		alert('Email must follow valid format');
		join.email.value = "";
		join.email.focus();
	}
	
	else if(join.birth.value == "")
	{
		alert('Date of Birth is required');
		join.birth.focus();
	}
		
	else if(join.pw.value!=join.pw_02.value)
	{
		alert('Wrong Password. Please make sure your password is correct');
		join.pw_02.focus();
	}
	
	else
	{
		join.submit();
	}
}