<?php
$response = file_get_contents("https://api.alquran.cloud/v1/meta");
$response = json_decode($response, true);

$QuranApi = $response["data"]["surahs"]["references"];

$searchResults = [];

// Handle search functionality for Surah and Ayah
if (isset($_POST['surah']) && isset($_POST['ayah'])) {
    $surahNum = intval($_POST['surah']);
    $ayahNum = intval($_POST['ayah']);

    // Fetch the Surah data including Ayahs and audio
    $ayahResponse = file_get_contents("https://api.alquran.cloud/v1/surah/$surahNum/ar.abdurrahmaansudais");
    $ayahData = json_decode($ayahResponse, true);

    if ($ayahData['status'] == 'OK') {
        $surah = $ayahData['data'];
        if ($ayahNum <= count($surah['ayahs'])) {
            $ayah = $surah['ayahs'][$ayahNum - 1]; // Ayah numbers are 1-based

            // Store the search results with Ayah text and audio
            $searchResults = [
                'surahName' => $surah['englishName'],
                'ayahCount' => $surah['numberOfAyahs'],
                'ayahNumber' => $ayahNum,
                'ayahText' => $ayah['text'],
               
            ];
        } else {
            $searchResults = [
                'error' => 'Invalid Ayah number for the selected Surah.'
            ];
        }
    } else {
        $searchResults = [
            'error' => 'Invalid Surah number.'
        ];
    }
}
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Quran App</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Amiri+Quran&family=Aref+Ruqaa&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Noto+Nastaliq+Urdu:wght@400..700&display=swap" rel="stylesheet">

    <style>
        body {
            direction: rtl;
            font-family: 'Amiri Quran', serif;
        }
        h1 {
            text-align: center;
            background-color: black;
            color: white;
            display: block;
        }
        p {
            background-color: #C7C0BF;
            margin: 5px 10px;
            padding: 5px 10px;
        }
        audio {
            display: block;
            margin-top: 10px;
        }
    </style>
</head>
<body>

<div class="container">
    <h1>QURAN APP</h1>

    <!-- Search Form -->
    <div class="mb-4">
        <form action="" method="POST" class="row g-3">
            <div class="col-md-6">
                <label for="surah" class="form-label">Surah Number</label>
                <input type="number" class="form-control" id="surah" name="surah" placeholder="Enter Surah Number" required>
            </div>
            <div class="col-md-6">
                <label for="ayah" class="form-label">Ayah Number</label>
                <input type="number" class="form-control" id="ayah" name="ayah" placeholder="Enter Ayah Number" required>
            </div>
            <div class="col-12">
                <button type="submit" class="btn btn-primary">Search</button>
            </div>
        </form>
    </div>

    <!-- Display Search Results -->
    <?php if (!empty($searchResults)) : ?>
        <div class="alert alert-info">
            <?php if (isset($searchResults['error'])) : ?>
                <strong>Error:</strong> <?= $searchResults['error'] ?>
            <?php else : ?>
                <strong>Surah:</strong> <?= $searchResults['surahName'] ?><br>
                <strong>Total Ayahs:</strong> <?= $searchResults['ayahCount'] ?><br>
                <strong>Ayah Number:</strong> <?= $searchResults['ayahNumber'] ?><br>
                <strong>Ayah Text:</strong> <?= $searchResults['ayahText'] ?><br>
              
            <?php endif; ?>
        </div>
    <?php endif; ?>

    <table class="table table-dark table-striped">
        <thead>
        <tr>
            <th scope="col">S.no</th>
            <th scope="col">Surah Name</th>
            <th scope="col">Surah English Name</th>
            <th scope="col">Surah English Name Translation</th>
            <th scope="col">Number Of Ayahs</th>
            <th scope="col">Revelation Type</th>
            <th scope="col">Read Surah</th>
        </tr>
        </thead>
        <tbody>
        <?php
        foreach ($QuranApi as $index) {
            echo '<tr>
                <th scope="row">' . $index["number"] . '</th>
                <td>' . $index["name"] . '</td>
                <td>' . $index["englishName"] . '</td>
                <td>' . $index["englishNameTranslation"] . '</td>
                <td>' . $index["numberOfAyahs"] . '</td>
                <td>' . $index["revelationType"] . '</td>
                <td>
                    <form action="read.php" method="post">
                        <input type="hidden" name="reader" value="' . $index["number"] . '">
                        <input class="btn btn-primary" type="submit" value="Read Surah">
                    </form>
                </td>
            </tr>';
        }
        ?>
        </tbody>
    </table>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>
