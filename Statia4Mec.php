<?php
// Initialize the session
session_start();
 
// Check if the user is logged in, if not then redirect him to login page
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: Login.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="ro">
<meta charset="UTF-8">
    <style>
    html {
        background-image: url("greybg.jpeg");
        font-family: "Helvetica", cursive, sans-serif;
    }

    p {
        align: center;
        font-size: 1.5vw;
    }

    .column {
        text-align: center;
    }

    #videoElement {
        width: 500px;
        height: 375px;
        display:inline-block;
        margin-left: 33%;
        transform: translateX(-50%);
    }

    #myCanvas {
        display:inline-block;
        width: 500px;
        height: 375px;
        outline: darkgray;
        outline-width: 10px;
    }

    button {
        background-color: whitesmoke; color: black;
        padding: 10px;
        text-align: center;
        font-size: 1vw;
        border-radius: 5px;
    }

    a {
        background-color: whitesmoke; color: black;
        padding: 10px;
        text-align: center;
        font-size: 14px;
        border-radius: 5px;
    }

    button:hover {
        background: rgba(45,45,45,0.95);
        color: white;
    }

    div.column {
        background-color: whitesmoke;
        opacity: 0.90;
        border-radius: 5px;
    }

    h2 {
        font-size:3vw;
        text-align:center;

    }

    span {
        background-color: whitesmoke;
        opacity: 0.8;
        border-radius: 5px;
    }
    


</style>

<script src="http://code.jquery.com/jquery-1.11.0.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"> </script> 
<script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/0.4.1/html2canvas.js"> </script>

<head>
    <title>Stația 4 Mecanic</title>
    <h2><span>Stația 4</span></h2>
</head>

<div class="row">
    <div class="column">
        <br>
        <p id="demo1"></p>
        <br>
        <button onclick="snapshot(this);">Capturați imaginea</button>
        <button  onclick="test();">Salvați captura</button>
        <br><br>
        <form action="Service21Mecanic.php">
            <button type="submit">Înapoi la pagina principală</button>
        </form>
        <br><br>
    </div>
    <br>
</div>
    <video autoplay="true" id="videoElement" onclick="snapshot(this);"> </video>
     <canvas id="myCanvas" width="500" height="375"></canvas>
<br>

<script>

    let video = document.querySelector("#videoElement");

    if (navigator.mediaDevices.getUserMedia) {
        navigator.mediaDevices.getUserMedia({video: true})
            .then(function (stream) {
                video.srcObject = stream;
            })
            .catch(function () {
                console.log("Eroare la accesul camerei video");
            })
    }

    let dataSalvata = parseInt(localStorage['dataSalvata']) || 0;
    let distance = new Date();


    // Update the count down every 1 second
    setInterval(function ()
    {

        // Get today's date and time
        let now = new Date();

        // Find the distance between now and the count down date
        distance = dataSalvata - now;

        // Time calculations for days, hours, minutes and seconds
        let hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
        let minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
        let seconds = Math.floor((distance % (1000 * 60)) / 1000);
        // Output the result in an element with id="demo"
        document.getElementById("demo").innerHTML = hours + "h "
            + minutes + "m " + seconds + "s ";

        // If the count down is over, write some text
        if (distance < 0) {
            //  clearInterval(x);
            document.getElementById("demo").innerHTML = "Disponibilă";
        }

    }, 1000);

    let canvas, ctx, dataURL;

// function init() {
     // Get the canvas and obtain a context for
     // drawing in it
      canvas = document.getElementById("myCanvas");
      ctx = canvas.getContext('2d');
      console.log(ctx);
     // dataURL = ctx.toDataURL();
      dataURL = canvas.toDataURL();
      document.getElementById('canvasImg').src = dataURL;

 //}


 function snapshot() {
     // Draws current image from the video element into the canvas
     ctx.drawImage(video, 0,0, canvas.width, canvas.height);
     ctx.save();
 }

 </script>

<script>

 function test(){

     html2canvas($("#myCanvas"), { 
         onrendered: function(canvas) { 
             var imgsrc = canvas.toDataURL("image/png"); 
             console.log(imgsrc); 
             // $("#newimg").attr('src', imgsrc); 
             // $("#img").show(); 
             var dataURL = canvas.toDataURL(); 
             $.ajax({ 
                 type: "POST", 
                 url: "testSave4.php", 
                 data: { 
                     imgBase64: dataURL 
                 } 
             }).done(function(o) { 
                 console.log('saved'); 
             }); 
         } 
     }); 

 }
</script>

</html>