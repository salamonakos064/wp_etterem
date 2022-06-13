window.addEventListener('load',function()
{
    document.getElementById('form').addEventListener('submit',function(e)
    {
        if(checkData())
        {
            e.preventDefault();
        }
    })
    
})
function checkData()
{
    let password=document.getElementById('pword').value;
    if(password.length<8)
    {
        return true;
    }
    return false;
}