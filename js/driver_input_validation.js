function driverInputValidation()
{
    var carbrand = document.getElementById("carbrand").value;
    var carmodel = document.getElementById("carmodel").value;
    var carcolor = document.getElementById("carcolor").value;
    var carnum = document.getElementById("carnum").value;
    var drivingnum = document.getElementById("drivingnum").value;
    
    var errors = "";
    var errorOutput = document.getElementById("errorDisplay");
    
    carRE = /^[a-zA-Z]{2,40}$/;
    carnumRE = /^\d{1}[A-Z]{3}\d{3}$/;
    /* License plate can:
        --> Start with 3 alphabets
        --> Followed by 4 digits */
    var driversLicenseRE = /^[A-Z]\d{7}$/;
    /* Drivers License has a format that:
            --> Starts with an uppercase alphabet
            --> Followed by 7 digits */
    
    if (carbrand == '' || carmodel == '' || carcolor == '' || carnum == '' || drivingnum == '')
    {
        errors += "Error! Field cannot be empty.<br />";
    }
    if(!carRE.test(carbrand) || !carRE.test(carmodel) || !carRE.test(carcolor))
    {
        errors += "Error! This field can only contain alphabets between 2 and 40 characters.<br />";
    }
    if (!carnumRE.test(carnum))
    {
        errors += "Error! Please follow specified format. E.g. 1FHG832.<br />";
    }
    if (!driversLicenseRE.test(drivingnum))
    {
        errors += "Error! Invalid format. Ex: D1234567.<br />";
    }
    if(errors != "")
    {
        errorOutput.innerHTML = errors;
        return false;
    }
    return true;
}