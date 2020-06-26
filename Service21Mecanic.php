<?php
// Inițializarea sesiunii
session_start();
 
// Verifică dacă utilizatorul este autentificat, dacă nu, va fi redirecționat la pagina de autentificare
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: Login.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="ro">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta charset="UTF-8">

<style>

    html {
        background-image: url("greybg.jpeg");
        font-family: "Helvetica", cursive, sans-serif;
    }

    p {
        align: center;
        font-size: 1vw;
    }

    .column {
        float: right;
        width: 25%;
        padding: 0;
    }

    .container {
        text-align: center;
    }

    button {
        background-color: whitesmoke; color: black;
        padding: 5px;
        text-align: center;
        font-size: 20px;
        border-radius: 5px;
    }

    button:hover {
        background: rgba(45,45,45,0.95);
        color: white;
    }

    input  {
        background-color: whitesmoke; color: black;
        padding: 5px;
        text-align: center;
        font-size: 14px;
        border-radius: 5px;
    }

    div {
        background-color: whitesmoke;
        opacity: 0.97;
        border-radius: 5px;
    }



    h2 {
        font-size: 40px;
        text-align:center;
    }
    
    @media (max-width: 500px) {

        .column {
            display: flex;
            justify-content: center;
            flex-direction: column;
            width: 360px;
            height: 350px;
        }
        
    }

    span {
        background-color: whitesmoke;
        opacity: 0.8;
        border-radius: 5px;
        padding: 2px;
    }

    h1 {
        font-size: 2vw;
        text-align: center;
    }

    .butonaut {
        background-color: whitesmoke; color: black;
        padding: 10px;
        text-align: center;
        font-size: 18px;
        border-radius: 5px;
        }


</style>

<head>
    <title>Service 21</title>
    <h1>
        <span>Service 21 - Mecanic</span>
        <form action="ServiceHTML.html">
            <button type="submit">Mod Client</button>
        </form>
        <form action="Logout.php">
        <button type="submit">Delogare</form>
    </h1>
</head>

<body>
<div class="container">
    <div class="column">
        <h2>Stația 4</h2>
        <p id="demo"></p>
        <form>
            <label for="minute"></label><input type="number" id="minute" onsubmit="DataSaver()">
        <br><br>
        <button onclick="DataSaver()" id="submitButton">Submit</button>
        <button onclick="reseTime()">Reset</button>
        </form>
        <br>
        <label for="randomPassword4"></label><input type="text" name="randomPassword4" id="randomPassword4">
        <button id="generatePassword4">Genereaza Parola</button>
        <br>
        <br>
        <form action="Statia4Mec.php">
            <button type="submit">Urmărește stația</button>
        </form>
        <br><br><br>
    </div>
 </div>
 
<div class="container">
    <div class="column">
        <h2>Stația 3</h2>
        <p id="demo3"></p>
        <form>
            <label for="minute3"></label><input type="number" id="minute3" onsubmit="DataSaver3()">
        <br><br>
        <button onclick="DataSaver3()" id="submitButton3">Submit</button>
        <button onclick="reseTime3()">Reset</button>
        </form>
        <br>
        <label for="randomPassword3"></label><input type="text" name="randomPassword3" id="randomPassword3">
        <button id="generatePassword3">Genereaza Parola</button>
        <br>
        <br>
        <form action="Statia3Mec.php">
            <button type="submit">Urmărește stația</button>
        </form>
        <br><br><br>
    </div>
</div>
<div class="container">
    <div class="column">
        <h2>Stația 2</h2>
        <p id="demo2"></p>
        <form>
            <label for="minute2"></label><input type="number" id="minute2" onsubmit="DataSaver2()">
        <br><br>
        <button onclick="DataSaver2()" id="submitButton2">Submit</button>
        <button onclick="reseTime2()">Reset</button>
        </form>
        <br>
        <label for="randomPassword2"></label><input type="text" name="randomPassword2" id="randomPassword2">
        <button id="generatePassword2">Genereaza Parola</button>
        <br>
        <br>
        <form action="Statia2Mec.php">
            <button type="submit">Urmărește stația</button>
        </form>
        <br><br><br>
    </div>
</div>
<div class="container">
    <div class="column">
        <h2>Stația 1</h2>
        <p id="demo1"></p>
        <form>
            <label for="minute1"></label><input type="number" id="minute1" onsubmit="DataSaver1()">
        <br><br>
        <button onclick="DataSaver1()" id="submitButton1">Submit</button>
        <button onclick="reseTime1()">Reset</button>
        </form>
        <br>
        <label for="randomPassword1"></label><input type="text" name="randomPassword1" id="randomPassword1">
        <button id="generatePassword1">Genereaza Parola</button>
        <br>
        <br>
        <form action="Statia1Mec.php">
            <button type="submit">Urmărește stația</button>
        </form>
        <br><br><br>
    </div>
</div>
</body>

<script>

    //-------------------- Statia 4


    let dataSalvata = parseInt(localStorage['dataSalvata']) || 0;
    let inputData = new Date();
    let distance = new Date();
    let countDownDate = new Date();

    function reseTime()
    {
        localStorage.dataSalvata=new Date();
        location.reload();
    }

    function DataSaver()
    {
        inputData = document.getElementById("minute").value;
        countDownDate.setMinutes(countDownDate.getMinutes() + +inputData);
        dataSalvata = countDownDate;
        localStorage['dataSalvata'] = '' +dataSalvata.getTime();
    }



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

    let parola4 = localStorage['parola4'];

    function random_password_generate4(max,min)
    {
        let passwordChars4 = "0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz#@!%&()/";
        let randPwLen4 = Math.floor(Math.random() * (max - min + 1)) + min;
        return Array(randPwLen4).fill(passwordChars4).map(function (a) {
            return a[Math.floor(Math.random() * a.length)]
        }).join('');
    }

    document.getElementById("generatePassword4").addEventListener("click", function(){
        let random_password4 = random_password_generate4(10,8);
        document.getElementById("randomPassword4").value = random_password4;
        parola4 = random_password4;
        localStorage.setItem('parola4', parola4);
    });

    //-------------------- Statia 1

    let dataSalvata1 = parseInt(localStorage['dataSalvata1']) || 0;
    let inputData1 = new Date();
    let distance1 = new Date();
    let countDownDate1 = new Date();

    function reseTime1()
    {
        localStorage.dataSalvata1=new Date();
        location.reload();
    }

    function DataSaver1()
    {
        inputData1 = document.getElementById("minute1").value;
        countDownDate1.setMinutes(countDownDate1.getMinutes() + +inputData1);
        dataSalvata1 = countDownDate1;
        localStorage['dataSalvata1'] = '' +dataSalvata1.getTime();
    }



    // Actualizează numărătoarea inversă în fiecare secundă
    setInterval(function ()
    {

        // primește data curentă
        let now1 = new Date();

        // calculează diferența dintre data cu minutele introduse și data curentă
        distance1 = dataSalvata1 - now1;

        // transformări pentru ore, minute și secunde în secunde

        let hours1 = Math.floor((distance1 % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
        let minutes1 = Math.floor((distance1 % (1000 * 60 * 60)) / (1000 * 60));
        let seconds1 = Math.floor((distance1 % (1000 * 60)) / 1000);

        // afișează rezultatul într-un element cu id="demo1"

        document.getElementById("demo1").innerHTML = hours1 + "h "
            + minutes1 + "m " + seconds1 + "s ";

        // Dacă numărătoarea inversă s-a terminat afișează "Disponibil"
        if (distance1 < 0) {

            document.getElementById("demo1").innerHTML = "Disponibilă";
        }

    }, 1000);

    let parola1 = localStorage['parola1'];

    function random_password_generate1(max,min)
    {
        let passwordChars = "0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz#@!%&()/";
        let randPwLen = Math.floor(Math.random() * (max - min + 1)) + min;
        return Array(randPwLen).fill(passwordChars).map(function (x) {
            return x[Math.floor(Math.random() * x.length)]
        }).join('');
    }

    document.getElementById("generatePassword1").addEventListener("click", function(){
        let  random_password1 = random_password_generate1(10,8);
        document.getElementById("randomPassword1").value = random_password1;
        parola1 = random_password1;
        localStorage.setItem('parola1', parola1);
    });

    //-------------------- Statia 2



    let dataSalvata2 = parseInt(localStorage['dataSalvata2']) || 0;
    let inputData2 = new Date();
    let distance2 = new Date();
    let countDownDate2 = new Date();

    function reseTime2()
    {
        localStorage.dataSalvata2=new Date();
        location.reload();
    }

    function DataSaver2()
    {
        inputData2 = document.getElementById("minute2").value;
        countDownDate2.setMinutes(countDownDate2.getMinutes() + +inputData2);
        dataSalvata2 = countDownDate2;
        localStorage['dataSalvata2'] = '' +dataSalvata2.getTime();
    }



    // Update the count down every 1 second
    setInterval(function ()
    {

        // Get today's date and time
        let now2 = new Date();

        // Find the distance between now and the count down date
        distance2 = dataSalvata2 - now2;

        // Time calculations for days, hours, minutes and seconds
        let hours2 = Math.floor((distance2 % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
        let minutes2 = Math.floor((distance2 % (1000 * 60 * 60)) / (1000 * 60));
        let seconds2 = Math.floor((distance2 % (1000 * 60)) / 1000);
        // Output the result in an element with id="demo"
        document.getElementById("demo2").innerHTML = hours2 + "h "
            + minutes2 + "m " + seconds2 + "s ";

        // If the count down is over, write some text
        if (distance2 < 0) {
            //  clearInterval(x);
            document.getElementById("demo2").innerHTML = "Disponibilă";
        }

    }, 1000);

    let parola2 = localStorage['parola2'];

    function random_password_generate2(max,min)
    {
        let passwordChars2 = "0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz#@!%&()/";
        let randPwLen2 = Math.floor(Math.random() * (max - min + 1)) + min;
        return Array(randPwLen2).fill(passwordChars2).map(function (y) {
            return y[Math.floor(Math.random() * y.length)]
        }).join('');
    }

    document.getElementById("generatePassword2").addEventListener("click", function(){
        let random_password2 = random_password_generate2(10,8);
        document.getElementById("randomPassword2").value = random_password2;
        parola2 = random_password2;
        localStorage.setItem('parola2', parola2);
    });

    //-------------------- Statia 3

    let dataSalvata3 = parseInt(localStorage['dataSalvata3']) || 0;
    let inputData3 = new Date();
    let distance3 = new Date();
    let countDownDate3 = new Date();

    function reseTime3()
    {
        localStorage.dataSalvata3=new Date();
        location.reload();
    }

    function DataSaver3()
    {
        inputData3 = document.getElementById("minute3").value;
        countDownDate3.setMinutes(countDownDate3.getMinutes() + +inputData3);
        dataSalvata3 = countDownDate3;
        localStorage['dataSalvata3'] = '' +dataSalvata3.getTime();
    }



    // Update the count down every 1 second
    setInterval(function ()
    {

        // Get today's date and time
        let now3 = new Date();

        // Find the distance between now and the count down date
        distance3 = dataSalvata3 - now3;

        // Time calculations for days, hours, minutes and seconds
        let hours3 = Math.floor((distance3 % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
        let minutes3 = Math.floor((distance3 % (1000 * 60 * 60)) / (1000 * 60));
        let seconds3 = Math.floor((distance3 % (1000 * 60)) / 1000);
        // Output the result in an element with id="demo"
        document.getElementById("demo3").innerHTML = hours3 + "h "
            + minutes3 + "m " + seconds3 + "s ";

        // If the count down is over, write some text
        if (distance3 < 0) {
            //  clearInterval(x);
            document.getElementById("demo3").innerHTML = "Disponibilă";
        }

    }, 1000);

    let parola3 = localStorage['parola3'];

    function random_password_generate3(max,min)
    {
        let passwordChars3 = "0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz#@!%&()/";
        let randPwLen3 = Math.floor(Math.random() * (max - min + 1)) + min;
        return Array(randPwLen3).fill(passwordChars3).map(function (z) {
            return z[Math.floor(Math.random() * z.length)]
        }).join('');
    }

    document.getElementById("generatePassword3").addEventListener("click", function(){
        let random_password3 = random_password_generate3(10,8);
        document.getElementById("randomPassword3").value = random_password3;
        parola3 = random_password3;
        localStorage.setItem('parola3', parola3);
    });


</script>

</html>