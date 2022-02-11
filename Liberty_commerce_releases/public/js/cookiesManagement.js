// create 3 simplify selector for each button in the accept,decline and revoke.
const declineBtn = document.querySelector(".btn.decline");
const agreeBtn = document.querySelector(".btn.agree");
const revokeBtn = document.querySelector(".btn.revoke");

createPopUp();


function createPopUp()
{
    //timeout to do the popUp apparition
    setTimeout(function ()
        {
            let cookieAccepted = getCookie("cookieAccepted");
            if (cookieAccepted != "yes")
            {
                document.querySelector(".cookieConsent").classList.add("active");
            }
            else
            {
                revokeBtn.classList.add("active");
            }
        }, 2000)
}
//remove the popUp when cookies have been declined 
declineBtn.addEventListener("click", function ()
{
    document.querySelector(".cookieConsent").classList.remove("active");

})

//remove the popUp when cookies are accepted and update cookies accordingly
agreeBtn.addEventListener("click", function ()
{
    document.querySelector(".cookieConsent").classList.remove("active");
    createCookie("cookieAccepted", "yes",36500);//add experation date to 100 years because is obligatory to fixe one date.
    revokeBtn.classList.add("active");
})

//revoke the consent cookie
revokeBtn.addEventListener("click", function()
{
    deleteCookie("cookieAccepted");
    document.querySelector(".cookieConsent").classList.add("active");
    revokeBtn.classList.remove("active");
})


function createCookie(name,value,leftDays)
    {
      let date = new Date();
      date.setTime(date.getTime()+(leftDays*24*60*60*1000));
      document.cookie = name + "=" + value + "; expires=" + date.toGMTString();
    }


function getCookie(name) 
{
    let cookies, c;
    cookies = document.cookie.split('; ');
    
    for (var i=0; i < cookies.length; i++)
    {
        c = cookies[i].split('=');
        if (c[0] == name)
        {
            return c[1];
        }
    }
    return "";
}
function deleteCookie(name)
{
    createCookie(name,'',-1);
}
