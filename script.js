var fName = document.getElementById("fName");
var lname = document.getElementById("lname");
var contact = document.getElementById("contact");
var email = document.getElementById("email");
var address = document.getElementById("address");
var passwd = document.getElementById("passwd");
// var passwdOld = document.getElementById("passwdOld");
var cnfpwd = document.getElementById("cnfpwd");
var f1=0,f2=0,f3=0,f4=0,f5=0,f6=0,f7=0;
// var f8=0;


function emailValid()
{
    if (/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/.test(email.value))
    {
        document.getElementById("emailError").innerHTML = "OK";
        document.getElementById("emailError").style = "color:green;";
        f1=0;
    }
    else
    {
        document.getElementById("emailError").innerHTML = "Email ID invalid";
        document.getElementById("emailError").style = "color:red;";
        f1=1;
    }
    // if(email.value.length == 0)
    // {
        
    // }
    // else
    // {
    //     document.getElementById("emailError").innerHTML = "OK";
    //     document.getElementById("emailError").style = "color:green;";
    //     f1=0;
    // }
}

function fnameValid()
{
    if(fname.value.length < 3 || fname.value.length == 0)
    {
        document.getElementById("fnameError").innerHTML = "Name must be more than 2 characters!";
        document.getElementById("fnameError").style = "color:red;";
        f2=1;
    }
    else
    {
        document.getElementById("fnameError").innerHTML = "OK";
        document.getElementById("fnameError").style = "color:green;";
        f2=0;
    }
    
}

function lnameValid()
{
    if(lname.value.length < 3 || lname.value.length == 0)
    {
        document.getElementById("lnameError").innerHTML = "Name must be more than 2 characters!";
        document.getElementById("lnameError").style = "color:red;";
        f3=1;
    }
    else
    {
        document.getElementById("lnameError").innerHTML = "OK";
        document.getElementById("lnameError").style = "color:green;";
        f3=0;
    }
    
}

function addressValid()
{
    if(address.value.length == 0 || address.value.length > 150)
    {
        document.getElementById("addressError").innerHTML = "Address must be within 150 characters!";
        document.getElementById("addressError").style = "color:red;";
        f4=1;
        
    }
    else
    {
        document.getElementById("addressError").innerHTML = "OK";
        document.getElementById("addressError").style = "color:green;";
        f4=0;
    }
}

function contactValid()
{
    if(contact.value.length == 0 || contact.value.length != 10)
    {
        document.getElementById("contactError").innerHTML = "Contact Number must contain 10 digits!";
        document.getElementById("contactError").style = "color:red;";
        f5=1;
        
    }
    else
    {
        document.getElementById("contactError").innerHTML = "OK";
        document.getElementById("contactError").style = "color:green;";
        f5=0;
    }
}

function pwdValid()
{
    if(passwd.value.length == 0 || passwd.value.length > 15 || passwd.value.length < 8)
    {
        document.getElementById("pwdError").innerHTML = "Password must be between 8 to 15 characters!";
        document.getElementById("pwdError").style = "color:red;";
        f6=1;
        
    }
    else
    {
        document.getElementById("pwdError").innerHTML = "OK";
        document.getElementById("pwdError").style = "color:green;";
        f6=0;
    }
}

function cnfValid()
{
    if(cnfpwd.value != passwd.value)
    {
        document.getElementById("cnfError").innerHTML = "Confirm Password must be same as Password!";
        document.getElementById("cnfError").style = "color:red;";
        f7=1;
        
    }
    else
    {
        document.getElementById("cnfError").innerHTML = "OK";
        document.getElementById("cnfError").style = "color:green;";
        f7=0;
    }
}

function submitFunc()
{
    alert("hello");
    if(f1==0 && f2==0 && f3==0 && f4==0 && f5==0 && f6==0 && f7==0 )
    {
        document.getElementById("regForm").submit();
    }
    
}
function submitFunc2()
{
    alert("hello");
    if(f1==0 && f2==0 && f3==0 && f4==0 && f5==0 && f6==0 && f7==0 )
    {
        alert("inside");
        return true;
    }
    else
    {
        return false;
    }
}

