<?php

session_start();

if ((isset($_SESSION['zalogowany'])) && ($_SESSION['zalogowany'] == true)) {
  header('Location: logout.php');
  exit();
}

?>

<!DOCTYPE HTML>
<html lang="pl">
<meta charset="utf-8" />
<meta http-equiv="X-UA-Compatible" content="IE=11,chrome=1" />
<link rel="stylesheet" href="style19.css" type="text/css">
<link rel='stylesheet' media='screen and (min-width: 300px) and (max-width: 1900px)' href='style19.css' />

<head>
  <meta charset="utf-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=11,chrome=1" />
  <title>Formularz promocji na laserach</title>

</head>

<body>



  <meta name="viewport" content="width=device-width, initial-scale=1">

  <style>
    body {
      font-family: Arial, Helvetica, sans-serif;
    }


    input[type=text],
    input[type=password] {
      width: 100%;
      padding: 12px 20px;
      margin: 8px 0;
      display: inline-block;
      border: 1px solid #ccc;
      box-sizing: border-box;
    }

    button {
      background-color: #4CAF50;
      color: white;
      padding: 14px 20px;
      margin: 8px 0;
      border: none;
      cursor: pointer;
      width: 100%;
    }

    button:hover {
      opacity: 0.8;
    }

    .cancelbtn {
      width: auto;
      padding: 10px 18px;
      background-color: #f44336;
    }

    .imgcontainer {
      text-align: center;
      margin: 24px 0 12px 0;
    }

    img.avatar {
      width: 40%;
      border-radius: 50%;
    }

    .container {
      padding: 6px;
    }

    span.psw {
      float: right;
      padding-top: 16px;
    }


    @media screen and (max-width: 300px) {
      span.psw {
        display: block;
        float: none;
      }

      .cancelbtn {
        width: 100%;
      }
    }
  </style>
  </head>




  <meta name="viewport" content="width=device-width, initial-scale=1">
  <style>
    body {
      font-family: Arial, Helvetica, sans-serif;
    }


    input[type=text],
    input[type=password] {
      width: 100%;
      padding: 12px 20px;
      margin: 8px 0;
      display: inline-block;
      border: 1px solid #ccc;
      box-sizing: border-box;
    }


    button {
      background-color: #4CAF50;
      color: white;
      padding: 14px 20px;
      margin: 8px 0;
      border: none;
      cursor: pointer;
      width: 100%;

    }

    button:hover {
      opacity: 0.8;
    }

    .cancelbtn {
      width: auto;
      padding: 10px 18px;
      background-color: #f44336;
    }


    .imgcontainer {
      text-align: center;
      margin: auto;
      position: relative;
    }

    img.avatar {
      width: 40%;
      border-radius: 50%;
    }

    .container {
      padding: 9px;
    }

    span.psw {
      float: right;
      padding-top: 16px;
    }


    .modal {
      display: none;
      position: fixed;
      z-index: 1;
      left: 0;
      top: 0;
      width: 100%;
      height: 100%;
      overflow: auto;
      background-color: rgb(0, 0, 0);
      background-color: rgba(0, 0, 0, 0.4);
      padding-top: auto;
    }

    @media screen and (max-width: 300px) {
      span.psw {
        display: block;
        float: none;
      }

      .cancelbtn {
        width: 100%;
      }
    }

    @media screen and (max-width: 900px) {
      span.psw {
        display: block;
        float: none;
      }

      .cancelbtn {
        width: 100%;
      }
    }


    @media screen and (min-width: 1301px) {
      .modal-content {
        background-color: #fefefe;
        margin: auto;
        border: 1px solid #888;
        width: 40%;
        padding: 2%;
        padding-bottom: 5%;
      }

      .panellogin {
        BACKGROUND-COLOR: #164aa0;

        width: 400px;
        height: 30px;

        margin: 0 auto;
        padding: 15px 0 0;
        background: radial-gradient(#164aa0, #032660);

        border: 1px solid silver;
        font: 16px calibri;
        letter-spacing: -1px;
        -webkit-box-shadow: 0 0 2px silver;
        -moz-box-shadow: 0 0 2px silver;
        box-shadow: 0 0 2px silver;
      }

      .panellogin2 {
        BACKGROUND-COLOR: #bdb8b8;

        width: 398px;
        height: 74px;
        margin: 0 auto;
        padding: 15px 0 0;
        background: rgb(230, 230, 230);

        border: 1px solid silver;
        font: 16px calibri;
        letter-spacing: -1px;
        -webkit-box-shadow: 0 0 2px silver;
        -moz-box-shadow: 0 0 2px silver;
        box-shadow: 0 0 2px silver;
      }

      .loginstyle {


        top: auto;
        margin: 148px;
        color: white;
        font: 24px Times
      }
    }


    @media screen and (max-width: 1300px) {
      .modal-content {
        background-color: #fefefe;
        margin: 0 auto;
        border: 1px solid #888;
        width: 100%;
      }

      .panellogin {
        BACKGROUND-COLOR: #164aa0;

        width: 400px;
        height: 30px;

        margin: 0 auto;
        padding: 15px 0 0;
        background: radial-gradient(#164aa0, #032660);

        border: 1px solid silver;
        font: 16px calibri;
        letter-spacing: -1px;
        -webkit-box-shadow: 0 0 2px silver;
        -moz-box-shadow: 0 0 2px silver;
        box-shadow: 0 0 2px silver;
      }

      .panellogin2 {
        BACKGROUND-COLOR: #bdb8b8;

        width: 398px;
        height: 74px;
        margin: 0 auto;
        padding: 15px 0 0;
        background: rgb(230, 230, 230);

        border: 1px solid silver;
        font: 16px calibri;
        letter-spacing: -1px;
        -webkit-box-shadow: 0 0 2px silver;
        -moz-box-shadow: 0 0 2px silver;
        box-shadow: 0 0 2px silver;
      }

      .loginstyle {


        top: auto;
        margin: 148px;
        color: white;
        font: 24px Times
      }

    }

    @media screen and (max-width: 420px) {
      .modal-content {
        background-color: #fefefe;
        margin: auto;
        border: 1px solid #888;
        width: auto;
      }

      .panellogin {
        BACKGROUND-COLOR: #164aa0;

        width: auto;
        height: 30px;

        margin: 0 auto;
        padding: 15px 0 0;
        background: radial-gradient(#164aa0, #032660);

        border: 1px solid silver;
        font: 16px calibri;
        letter-spacing: -1px;
        -webkit-box-shadow: 0 0 2px silver;
        -moz-box-shadow: 0 0 2px silver;
        box-shadow: 0 0 2px silver;
      }

      .panellogin2 {
        BACKGROUND-COLOR: #bdb8b8;

        width: auto;
        height: 74px;
        margin: 0 auto;
        padding: 15px 0 0;
        background: rgb(230, 230, 230);

        border: 1px solid silver;
        font: 16px calibri;
        letter-spacing: -1px;
        -webkit-box-shadow: 0 0 2px silver;
        -moz-box-shadow: 0 0 2px silver;
        box-shadow: 0 0 2px silver;
      }

      .loginstyle {


        top: auto;
        margin: 152px;
        color: white;
        font: 20px Times
      }

    }


    @media screen and (max-width: 300px) {
      .modal-content {
        background-color: #fefefe;
        margin: auto;
        border: 1px solid #888;
        width: auto;
      }

      .panellogin {
        BACKGROUND-COLOR: #164aa0;

        width: auto;
        height: 30px;

        margin: 0 auto;
        padding: 15px 0 0;
        background: radial-gradient(#164aa0, #032660);

        border: 1px solid silver;
        font: 16px calibri;
        letter-spacing: -1px;
        -webkit-box-shadow: 0 0 2px silver;
        -moz-box-shadow: 0 0 2px silver;
        box-shadow: 0 0 2px silver;
      }

      .panellogin2 {
        BACKGROUND-COLOR: #bdb8b8;

        width: auto;
        height: 74px;
        margin: 0 auto;
        padding: 15px 0 0;
        background: rgb(230, 230, 230);

        border: 1px solid silver;
        font: 16px calibri;
        letter-spacing: -1px;
        -webkit-box-shadow: 0 0 2px silver;
        -moz-box-shadow: 0 0 2px silver;
        box-shadow: 0 0 2px silver;
      }

      .loginstyle {


        top: auto;
        margin: 151px;
        color: white;
        font: 24px Times
      }

    }


    .close {
      position: absolute;
      right: 25px;
      top: 0;
      color: #000;
      font-size: 35px;
      font-weight: bold;
    }

    .close:hover,
    .close:focus {
      color: red;
      cursor: pointer;
    }


    .animate {
      -webkit-animation: animatezoom 0.6s;
      animation: animatezoom 0.6s
    }

    @-webkit-keyframes animatezoom {
      from {
        -webkit-transform: scale(0)
      }

      to {
        -webkit-transform: scale(1)
      }
    }

    @keyframes animatezoom {
      from {
        transform: scale(0)
      }

      to {
        transform: scale(1)
      }
    }


    @media screen and (max-width: 300px) {
      span.psw {
        display: block;
        float: none;
      }

      .cancelbtn {
        width: 100%;
      }
    }
  </style>
  </head>

  <body>
    <div class="modal-content animate">
      <div id="logo2" style="color:rgba(0, 40, 94, 1); font: bold;">
        <h1>FORMULARZ PROMOCJI NA LASERACH</h1>
      </div>
      <br /><br />

      <div id="pic">
        <img src="logo.jpg" id="ad">
      </div>

      <br><br><br>

      <div class="panellogin">
        <FONT class="loginstyle"><B></B></FONT>
      </div>

      <div class="panellogin2">
        <button onclick="document.getElementById('id01').style.display='block'" style=" margin-left: 87px; width: 56%; margin-top: 2px; color: rgba(0, 40, 94, 1); font: bold 24px Times;  " class="button" onclick="window.location.href='https://laserpromocja.canpack.ad/login.php';">ZALOGUJ</button>
        <br><br>
        <?php

        if (isset($_SESSION['blad']) and $_SESSION['blad'] != '') {
          echo '<span style="color: red;">Nieprawidłowa nazwa lub hasło</span>';
        }
        ?>
        <br>

      </div>
    </div>
    </div>

    <div id="id01" class="modal">

      <form class="modal-content animate" action="zaloguj.php" method="post">
        <div class="imgcontainer">
          <span onclick="document.getElementById('id01').style.display='none'" class="close" title="Close Modal">&times;</span>

        </div>

        <div class="container">
          <label for="uname"><b>Nazwa użytkownika</b></label>
          <input type="text" placeholder="Wprowadź nazwe użytkownika" name="login" required>

          <label for="psw"><b>Hasło</b></label>
          <input type="password" placeholder="Wprowadź hasło" name="haslo" required>

          <button type="submit">Logowanie</button>

        </div>

        <div class="container" style="background-color:#f1f1f1">
          <button type="reset" onclick="javascript:location.href='https://laserpromocja.canpack.ad/logout.php'" class="cancelbtn">Anuluj</button>
          <?php

          if (isset($_SESSION['blad']) and $_SESSION['blad'] != '') {
            echo '<span style="color: red;">Nieprawidłowa nazwa lub hasło</span>';
          }
          ?>
        </div>

      </form>
    </div>

    <script>
      // Get the modal
      var modal = document.getElementById('id01');

      // When the user clicks anywhere outside of the modal, close it
      window.onclick = function(event) {
        if (event.target == modal) {
          modal.style.display = "none";
        }
      }
    </script>

  </body>

</html>