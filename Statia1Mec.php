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
        padding-bottom: 15px;
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
        opacity: 1;
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
        font-size: 3vw;
        text-align: center;
       
    }

    span {
        background-color: whitesmoke;
        opacity: 0.8;
        border-radius: 5px;
    }

    .field_wrapper{
        margin: 0 auto;
        width: 250px;
    }

    .AddProd{
        background-color: whitesmoke;
        opacity: 0.97;
        border-radius: 5px;
        width: 300px;
        margin: 0 auto;
        text-align: center;
        padding-left: 50px;
        padding-right: 50px;

    }

    table, td, th {
            border: 1px solid black;
            width: 300px;
         }

    

</style>

<script src="http://code.jquery.com/jquery-1.11.0.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"> </script> 
<script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/0.4.1/html2canvas.js"> </script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

<head>
    <title>Stația 1 Mecanic</title>
    <h2><span>Stația 1</span></h2>
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



<!-- Modala produse 
<div class="AddProd">
<div><br><br>
    <button id="myBtn">&emsp;Adauga inca un produs &emsp;</button><br><br>
  </div>
  <div>
    <table id="tasksTable">
      <thead>
        <tr style="background-color:whitesmoke">
          <th style="width: 190px;">Produse</th>
        </tr>

      </thead>
      <tbody></tbody>
    </table>
  </div>

  <div id="myModal" class="modal">

    <div class="modal-content">

      <div class="modal-header">

        <span class="close">&times;</span>
      </div>

      <div class="modal-body">
        <table >
          <tr>
            <td>
              Produs:
            </td>
            <td>
              <textarea name="desc" id="prod" cols="20" rows="1"></textarea>
            </td>
          </tr>
        </table>
      </div>

      <div class="modal-footer"><br>
        <button type="submit" value="submit" onclick="addTasks()">Confirmare</button>
        <br><br>
        <button type="submit" onclick="saveProd()">Salveaza produse</button>
        <br>
        <br>
        <br>
      </div>

    </div>
  </div>
</div>
The Modal -->


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

    let dataSalvata1 = parseInt(localStorage['dataSalvata1']) || 0;
    let distance1 = new Date();


    // Update the count down every 1 second
    setInterval(function ()
    {

        // Get today's date and time
        let now1 = new Date();

        // Find the distance between now and the count down date
        distance1 = dataSalvata1 - now1;

        // Time calculations for days, hours, minutes and seconds
        let hours1 = Math.floor((distance1 % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
        let minutes1 = Math.floor((distance1 % (1000 * 60 * 60)) / (1000 * 60));
        let seconds1 = Math.floor((distance1 % (1000 * 60)) / 1000);
        // Output the result in an element with id="demo"
        document.getElementById("demo1").innerHTML = hours1 + "h "
            + minutes1 + "m " + seconds1 + "s ";

        // If the count down is over, write some text
        if (distance1 < 0) {
            //  clearInterval(x);
            document.getElementById("demo1").innerHTML = "Disponibilă";
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

    $(document).ready(function(){
    var maxField = 10; //Input fields increment limitation
    var addButton = $('.add_button'); //Add button selector
    var wrapper = $('.field_wrapper'); //Input field wrapper
    var fieldHTML = '<div><input type="text" name="field_name[]" value=""/><a href="javascript:void(0);" class="remove_button"><img src="remove-icon.png"/></a></div>'; //New input field html 
    var x = 1; //Initial field counter is 1
    
    //Once add button is clicked
    $(addButton).click(function(){
        //Check maximum number of input fields
        if(x < maxField){ 
            x++; //Increment field counter
            $(wrapper).append(fieldHTML); //Add field html
        }
    });
    
    //Once remove button is clicked
    $(wrapper).on('click', '.remove_button', function(e){
        e.preventDefault();
        $(this).parent('div').remove(); //Remove field html
        x--; //Decrement field counter
    });
});

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
                    url: "testSave.php", 
                    data: { 
                        imgBase64: dataURL 
                    } 
                }).done(function(o) { 
                    console.log('saved'); 
                }); 
            } 
        }); 

    }

    var tasks = [];

// Get the modal
var modal = document.getElementById('myModal');

// Get the button that opens the modal
var btn = document.getElementById("myBtn");

// Get the <span> element that closes the modal
var span = document.getElementsByClassName("close")[0];

// When the user clicks the button, open the modal 
btn.onclick = function() {
  modal.style.display = "block";
}

// When the user clicks on <span> (x), close the modal
span.onclick = function() {
  modal.style.display = "none";
}

// When the user clicks anywhere outside of the modal, close it
window.onclick = function(event) {
  if (event.target == modal) {
    modal.style.display = "none";
  }
}
var rowCount = 1;

function addTasks() {
  var temp = 'style .fa fa-trash';
  tasks.push(document.getElementById("prod").value);
  var table = document.getElementById("tasksTable");
  var row = table.insertRow(rowCount);
  var cell1 = row.insertCell(0);
  cell1.innerHTML = tasks[rowCount - 1];
  rowCount++;
}

function saveProd(){
        var myTab = document.getElementById('tasksTable');
        var arrValues = new Array();

        // loop through each row of the table.
        for (row = 1; row < myTab.rows.length - 1; row++) {
            // loop through each cell in a row.
            for (c = 0; c < myTab.rows[row].cells.length; c++) {
                var element = myTab.rows.item(row).cells[c];
                if (element.childNodes[1].getAttribute('type') == 'text') {
                    arrValues.push("'" + element.childNodes[0].value + "'");
                    console.log(arrValues);
                }
            }
        }
}

console.log(arrValues);



</script>
</html>