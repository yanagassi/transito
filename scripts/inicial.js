   window.onload = function(){
    var p = document.getElementById('centro');
        p.scrollTop = 9999;
        function requisitar(){
            var xmlhttp;
            if (window.XMLHttpRequest)
            {
                 xmlhttp=new XMLHttpRequest();
            }
            else 
            {
                xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
            }
            xmlhttp.onreadystatechange = function()
            {
                if (xmlhttp.readyState==4 && xmlhttp.status==200)
                {
                    document.getElementById("centro").innerHTML=xmlhttp.responseText;
                }
            }
            xmlhttp.open("GET","chat.php",true);
            xmlhttp.send();
            var p = document.getElementById('centro');
            p.scrollTop = 9999;
        }
   }
