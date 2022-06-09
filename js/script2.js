//loading the values from the database
window.addEventListener('load',function(){
    getTables();
    getDuration();
    document.getElementById("seats").addEventListener('change',function(){
            getTables();
    })
    document.getElementById("smoke").addEventListener('change',function(){
            getTables();
})
})
function getTables(){

    const a=new XMLHttpRequest();
    let b=document.getElementById("seats").value;
    let c=document.getElementById("smoke").value;
    a.onload=function(){
        if(this.readyState==4 && this.status==200)
        document.getElementById("number").innerHTML=this.responseText;
    }
    a.open("POST","getTables.php?a="+b+"&b="+c,true);
    a.send();
}
//getting the allowed durations
function getDuration()
{
    let b="";
    for(let i=1;i<=6;i++)
    {
        b+="<option value="+i+">"+i+"</option>";
    }
    document.getElementById("duration").innerHTML=b;
}
