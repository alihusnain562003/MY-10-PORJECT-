<?PHP

if (isset($_POST["reader"])) {


    $num = $_POST["reader"];

    $response = file_get_contents("https://api.alquran.cloud/v1/surah/$num/ar.abdurrahmaansudais");
    $response = json_decode($response, true);

   
    $data = $response["data"]["ayahs"];
}





?>




<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Amiri+Quran&family=Aref+Ruqaa&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Noto+Nastaliq+Urdu:wght@400..700&display=swap" rel="stylesheet">

    
    <style>
        body {
          
            direction: rtl;
            font-family: 'Amiri Quran', serif;
            margin: 5px 10px; 
            padding: 5px 10px;
       

        }
        p{
            background-color: #C7C0BF; 
            margin: 5px 10px; 
            padding: 5px 10px;
        
        }

 
        div {
            background-color: #728FCE;
            color: teal;
            width: 100%;
            height: 200%;

            margin: 10px ,10px;


        }
    </style>
</head>

<body>

<div>
<p>
    <?php


    foreach ($data as  $value) {
    
        echo '<p>' . $value["text"] . '</p>';
        echo '<audio controls src="'.$value["audio"].'"></audio>';
    }


    ?>
    </p>
    </div>

    <script src="mini.js"></script>
</body>

 
</html>