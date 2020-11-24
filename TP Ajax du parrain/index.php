<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>titre</title>
    </head>
    <body>
        <script type="text/javascript">
            function testAJAX(callback){
                var xhr = getXMLHttpRequest()
                xhr.onreadystatechange = function(){
                    if(xhr.readyState == 4 && (xhr.status == 200 || xhr.status == 0)){
                        callback(xhr.responseText);
                    }
                }
                
                var pseudo = document.getElementById('pseudo').value;
                var pass = document.getElementById('pass').value;
                
                //xhr.open("GET","handlingData.php?pseudo=toto&name=tata",true); //GET
                xhr.open("POST","handlingData.php",true); // POST
                xhr.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
                console.log("pseudo="+pseudo+"&pass="+pass);
                xhr.send("pseudo="+pseudo+"&pass="+pass);
            }
            
            function log(data){
                if(data == "OK"){
                    document.getElementById("retourPage").innerHTML = "<strong>Coucou</strong>";
                }else{
                    document.getElementById("retourPage").innerHTML = "<strong>Pas coucou</strong>";
                }
            }
        </script>
        <input id="pseudo" type="text">
        <input id="pass" type="password">
        <button onclick="testAJAX(log)">Click</button>
        <div id="retourPage"></div>
        <script src="XHR.js" type="text/javascript"></script>
    </body>
</html>
