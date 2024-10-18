<?php
$key = '$2y$10$sVGWfpcINzznkJ8JbKon2DsdrXl756lCKrfOghvvh6trm11XmcG';

// Initialize variables for storing API results
$books = [];
$chapters = [];
$hadithsByKeyword = [];

// 1. Search Books
if (isset($_POST['searchBook'])) {
    $response = file_get_contents("https://hadithapi.com/api/books?apiKey=$key");
    $books = json_decode($response, true)["books"];
    $searchBookName = $_POST['searchBookName'];

    // Filter books by name
    if (!empty($searchBookName)) {
        $books = array_filter($books, function ($book) use ($searchBookName) {
            return stripos($book['bookName'], $searchBookName) !== false;
        });
    }
}

// 2. Search Hadith by Number within a specific book's chapter
if (isset($_POST['searchHadith'])) {
    $bookSlug = $_POST['bookSlug'];
    $chapterNumber = $_POST['chapterNumber'];
    $response = file_get_contents("https://hadithapi.com/api/$bookSlug/$chapterNumber/hadiths?apiKey=$key");
    $hadiths = json_decode($response, true)["hadiths"];
    
    $hadithNumber = $_POST['hadithNumber'];
    $filteredHadiths = array_filter($hadiths, function ($hadith) use ($hadithNumber) {
        return $hadith["hadithNumber"] == $hadithNumber;
    });
}

// 3. Search Hadith by Keyword
if (isset($_POST['searchKeyword'])) {
    $keyword = $_POST['keyword'];
    $response = file_get_contents("https://hadithapi.com/api/hadiths/?apiKey=$key");
    $hadithsByKeyword = json_decode($response, true)["hadiths"];

    // Filter by keyword in Arabic, Urdu, or English
    if (!empty($keyword)) {
        $hadithsByKeyword = array_filter($hadithsByKeyword, function ($hadith) use ($keyword) {
            return stripos($hadith['hadithArabic'], $keyword) !== false ||
                   stripos($hadith['hadithUrdu'], $keyword) !== false ||
                   stripos($hadith['hadithEnglish'], $keyword) !== false;
        });
    }
}
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Hadith Search</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Amiri+Quran&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Noto+Nastaliq+Urdu:wght@400..700&display=swap" rel="stylesheet">
    <style>
        body { direction: rtl; font-family: 'Noto Nastaliq Urdu', serif; }
        .arabic { font-family: 'Amiri Quran', serif; }
    </style>
</head>
<body>
    <div class="container">
        <h1 class="my-4 text-center">Hadith Search</h1>

        <!-- Search by Book Name -->
        <form action="search.php" method="post" class="mb-4">
            <div class="input-group mb-3">
                <input type="text" class="form-control" name="searchBookName" placeholder="Search by book name..." value="<?php echo isset($_POST['searchBookName']) ? htmlspecialchars($_POST['searchBookName']) : ''; ?>">
                <button class="btn btn-primary" type="submit" name="searchBook">Search Book</button>
            </div>
        </form>

        <!-- Display Searched Books -->
        <?php if (!empty($books)): ?>
            <div class="row">
                <?php foreach ($books as $book): ?>
                    <div class="col-md-4 col-sm-6 mb-4">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title"><?php echo $book["bookName"]; ?></h5>
                                <p class="card-text">Author: <?php echo $book["writerName"]; ?></p>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>

        <!-- Search Hadith by Number -->
        <form action="" method="post" class="mb-4">
            <div class="input-group mb-3">
                <input type="text" class="form-control" name="bookSlug" placeholder="Enter book slug..." required>
                <input type="number" class="form-control" name="chapterNumber" placeholder="Chapter number..." required>
                <input type="number" class="form-control" name="hadithNumber" placeholder="Hadith number..." required>
                <button class="btn btn-primary" type="submit" name="searchHadith">Search Hadith</button>
            </div>
        </form>

        <!-- Display Searched Hadith by Number -->
        <?php if (isset($filteredHadiths)): ?>
            <?php foreach ($filteredHadiths as $hadith): ?>
                <div class="card mt-4">
                    <div class="card-body">
                        <h5 class="card-title">Hadith Number: <?php echo $hadith["hadithNumber"]; ?></h5>
                        <p class="card-text arabic"><?php echo $hadith["hadithArabic"]; ?></p>
                        <p class="card-text"><?php echo $hadith["hadithUrdu"]; ?></p>
                        <p class="card-text"><?php echo $hadith["hadithEnglish"]; ?></p>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php endif; ?>

        <!-- Search Hadith by Keyword -->
        <form action="" method="post" class="mb-4">
            <div class="input-group mb-3">
                <input type="text" class="form-control" name="keyword" placeholder="Search by keyword (Arabic, Urdu, English)..." value="<?php echo isset($_POST['keyword']) ? htmlspecialchars($_POST['keyword']) : ''; ?>">
                <button class="btn btn-primary" type="submit" name="searchKeyword">Search Keyword</button>
            </div>
        </form>

        <!-- Display Searched Hadith by Keyword -->
        <?php if (!empty($hadithsByKeyword)): ?>
            <?php foreach ($hadithsByKeyword as $hadith): ?>
                <div class="card mt-4">
                    <div class="card-body">
                        <h5 class="card-title">Hadith Number: <?php echo $hadith["hadithNumber"]; ?></h5>
                        <p class="card-text arabic"><?php echo $hadith["hadithArabic"]; ?></p>
                        <p class="card-text"><?php echo $hadith["hadithUrdu"]; ?></p>
                        <p class="card-text"><?php echo $hadith["hadithEnglish"]; ?></p>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php endif; ?>
    </div>
</body>
</html>
