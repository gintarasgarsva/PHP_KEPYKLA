<?php

$faktai = [
    'Vyriausiasis picų chef master picas pradejo kepti miške ant laužo!',
    'Slaptasis picų ingredientas iki šiol neatskleistas!',
    'Pavalgyti picos i PHP KEPYKLĄ zmonės ir gyvuliai ateina net iš tolimojo Kalabybiškio!',
    'PHP KEPYKLOJE silpnų nėra, todėl vienintelis gėrimas prie picos yra vietinės gamybos samogonas!',
    'Kas nutinka PHP KEPYKLOJE - PHP KEPYKLOJE ir lieka!'
];

$verte = 0;

if (isset($_POST['mygtukas'])) {
    $verte = $_POST['mygtukas'] + 1;
}
$paspausk = 'PASPAUSK MANE';

if ($verte > 5) {
    $verte = 5;
}

if ($verte == 0) {
    $kiek_faktu = [];
} else {
    $kiek_faktu = range(0, $verte - 1);
}

?>
<html>
    <head>
        <title>ABOUT</title>
        <link href="https://fonts.googleapis.com/css?family=Permanent+Marker" rel="stylesheet">
        <style>
            @import url('https://fonts.googleapis.com/css?family=Gloria+Hallelujah|Roboto');
            #strickynav{
                background-color: red;
                position: sticky;
                top: 0;
                width: 100%;
            }
            nav a{
                text-decoration: none;
                font-size: 25px;
                margin-left: 30px;
                padding: 3px 25px 3px 25px;
                color: black;
                font-family: 'Roboto', sans-serif;
                transition-property: transform;
                transition-duration: 3s;
                transition: all 2s 1s;
            }
            nav a:hover{
                color: white;
                font-size: 27px;
                background-color: black;
                border-bottom: 2px solid white;
                border-top: 2px solid white;
                transform: rotate(1040deg);

            }
            .linksright{
                float: right;
            }
            body{
                background-image: url('data:image/jpeg;base64,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');
                background-size:inherit;
                text-align: center;
            }
            h1{
                color:white;
                padding-top:100px;
                font-size:70px;
                font-family: 'Permanent Marker', cursive;
            }
            h2{
                color:white;
                padding-top:40px;
                font-size:40px;
            }
            li{
                color:white;
                font-size:30px;
                list-style:none;
            }
        </style>
    </head>
    <body>
        <nav class="col-12" id="strickynav">
            <a href="index.php">PZ2APICERIJA</a>
            <a href="about.php" class="linksright">AbOuT</a>
            <a href="pizza.php" class="linksright">PZ2ApiCa</a>
        </nav>
        <h1>WE ARE PHP KEPYKLA</h1>
        <h2>SUŽINOK FAKTUS</h2>
        <form action="index.php" method="POST"> 
            <button name="mygtukas" value="<?php print $verte; ?>">
                <?php print $paspausk; ?>
            </button>
        </form>
        <div> 
            <?php foreach ($kiek_faktu as $key => $belekas): ?>
                <ul>
                    <li><?php print $faktai[$key]; ?></li>
                </ul>
            <?php endforeach; ?> 
        </div>
    </body>
</html>