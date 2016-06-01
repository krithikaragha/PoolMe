function locationValidation()
{
    var location = document.getElementById("location").value;
    
    var errors = "";
    var errorOutput = document.getElementById("errorDisplay");
    
    var nameRE = /^[a-zA-Z]{2,40}$/;

    if(location == "")
    {
        errors += "Error! You have to go somewhere. If not, then stay home! <br />";
    }
    if(errors != "")
    {
        errorOutput.innerHTML = errors;
        return false;
    }
    return true;
}



