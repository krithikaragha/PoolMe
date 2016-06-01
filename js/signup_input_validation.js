function inputValidation()
{
    var firstname = document.getElementById("firstname").value;
    var lastname = document.getElementById("lastname").value;
    var phone = document.getElementById("phone").value;
    var email = document.getElementById("email").value;
    var passwd = document.getElementById("newpass").value;
    var passconf = document.getElementById("confirmpass").value;
    
    var errors = "";
    var errorOutput = document.getElementById("errorDisplay");
    
    var nameRE = /^[a-zA-Z]{2,40}$/;
    var emailRE = /^.+@.+\..{2,4}$/;
    var phoneRE = /^\d{3}\d{3}\d{4}$/;
    var passwdRE = /(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{6,16}/;
    /* Password contains between 6 and 16 characters that include:
            --> One or more digits
            --> One or more lowercase characters
            --> One or more uppercase characters */
    
    if(firstname == '' || lastname == '' || phone == '' || email == '' || passwd == '' || passconf == '') 
    {
        errors += "Error! Field cannot be empty. <br />"
    }
    if(!nameRE.test(firstname) || !nameRE.test(lastname))
    {
        errors += "Error! Name field can contain only alphabets between 2 and 40 characters. <br />";
    }
    if(!emailRE.test(email))
    {
        errors += "Error! Invalid format. Ex: johndoe@ymail.com. <br />";
    }
    if(!passwdRE.test(passwd))
    {
        errors += "Error! Password should be 6-15 chars long & have digits, upper and lowercase characters. <br />";
    }
    if(!phoneRE.test(phone))
    {       
        errors += "Error! Invalid format. Ex: 4087762964.<br />";
    }
    if(passwd != passconf)
    {
        errors += "Error! Passwords entered do not match!<br />";
    } 
    if(errors != "")
    {
        errorOutput.innerHTML = errors;
        return false;
    }
    return true;
}