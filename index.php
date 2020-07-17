<?php

//call id to main inputfield
$inputField = $_GET['inputfield'];
//replacement pokemon to prevent empty inputfield error
if (empty($_GET ['inputfield'])) {
    //main api
    $api = file_get_contents("https://pokeapi.co/api/v2/pokemon/1");
}
else {
    $api = file_get_contents("https://pokeapi.co/api/v2/pokemon/" . $inputField);
}
//----------------------------------
$data = json_decode($api, true);
$pokeId = $data["id"];
//sprite api
$sprite = $data["sprites"]["front_default"];
$movesArray = [];

// loop for randomized moves
for ($i =0; $i < count($data['moves']); $i++) {
    array_push($movesArray, $data['moves'][$i]['move']['name']);
    $randomMoveindex = array_rand($movesArray,4);
}
// moves
$move1 = $movesArray[$randomMoveindex[0]];
    $move2 = $movesArray[$randomMoveindex[1]];
        $move3 = $movesArray[$randomMoveindex[2]];
            $move4 = $movesArray[$randomMoveindex[3]];


//evolution api
$apiEvo = file_get_contents("https://pokeapi.co/api/v2/pokemon-species/" . $inputField);
$dataEvo = json_decode ($apiEvo, true);
//previous evolution api
$prevName = $dataEvo['evolves_from_species']['name'];
$apievoCall = file_get_contents("https://pokeapi.co/api/v2/pokemon/" . $prevName);
$dataCall = json_decode($apievoCall, true);
$callSprite = $dataCall["sprites"]["front_default"];


//-------------------------------------------------------------------------------------------------------------------------------------------------------
?>
<!-- --------------------------------------------------------------------------------------------------------------------------------------------------->

<!doctype html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css"
          integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <link rel="stylesheet" href="assets/style.css">

    <title></title>
</head>
<body>
<div id="pokedex">
    <div id="left">
        <div id="logo"></div>
        <div id="bg_curve1_left"></div>
        <div id="bg_curve2_left">
            <form method="get" action="">
            <input type="text" name="inputfield" id="input_field" placeholder="take pokemon">
            </form>
        </div>

        <div id="curve1_left">
            <div id="buttonGlass">
                <div id="reflect"> </div>
            </div>
            <div id="miniButtonGlass1"></div>
            <div id="miniButtonGlass2"></div>
            <div id="miniButtonGlass3"></div>
        </div>
        <div id="curve2_left">
            <div id="junction">
                <div id="junction1"></div>
                <div id="junction2"></div>
            </div>
        </div>
        <div id="screen">
            <div id="topPicture">
                <div id="buttontopPicture1"></div>
                <div id="buttontopPicture2"></div>
            </div>
            <div id="picture">
                <img src="<?php echo $sprite ?>" id="sprite">
            </div>
            <div id="buttonbottomPicture"></div>
            <div id="speakers">
                <div class="sp"></div>
                <div class="sp"></div>
                <div class="sp"></div>
                <div class="sp"></div>
            </div>
        </div>
        <div id="cross">
            <div id="leftcross">
                <div id="leftT"></div>
            </div>
            <div id="topcross">
                <div id="upT"></div>
            </div>
            <div id="rightcross">
                <div id="rightT"></div>
            </div>
            <div id="midcross">
                <div id="midCircle"></div>
            </div>
            <div id="botcross">
                <div id="downT"></div>
            </div>
        </div>
    </div>
    <div id="right">
        <div id="stats">
            <?php echo $data['name']?>
            <div id="moves">
                <div id="pokNr"><?php echo $pokeId ?></div>
                <div id="pokName"></div>
                <div id="pokType"></div>
                <div id="pokDescrip"></div>
                <div id="move1"><?php echo $move1?></div>
                <div id="move2"><?php echo $move2?></div>
                <div id="move3"><?php echo $move3?></div>
                <div id="move4"><?php echo $move4?></div>
            </div>

        </div>


        <div id="yellowBox1">
            <img id="evolPrev" src="<?php echo $callSprite?>">
        </div>
        <div id="yellowBox2">
            <div id="preName"></div>
        </div>
        <div id="bg_curve1_right"></div>
        <div id="bg_curve2_right"></div>
        <div id="curve1_right"></div>
        <div id="curve2_right"></div>
    </div>
</div>

<!-- Optional JavaScript -->
<!-- jQuery first, then Popper.js, then Bootstrap JS -->
<script src="https://unpkg.com/axios/dist/axios.min.js"></script>
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
        integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo"
        crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"
        integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1"
        crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"
        integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM"
        crossorigin="anonymous"></script>
</body>
</html>