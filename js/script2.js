//loading the values from the database
window.addEventListener('load',function(){
    getTables();
    getDuration();
    document.getElementById("seats").addEventListener('change',function(){
            getTables();
    })
})
function getTables(){

    const a=new XMLHttpRequest();
    let b=document.getElementById("seats").value;
    a.onload=function(){
        if(this.readyState==4 && this.status==200)
        document.getElementById("number").innerHTML=this.responseText;
    }
    a.open("POST","getTables.php?a="+b,true);
    a.send();
}
function getDuration()
{
    let b="";
    for(let i=1;i<=6;i++)
    {
        b+="<option value="+i+">"+i+"</option>";
    }
    document.getElementById("duration").innerHTML=b;
}
