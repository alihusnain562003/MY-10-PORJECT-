<?php
if (isset($_POST["booksSlug"])) {
    $bookslug = $_POST["booksSlug"];
    $chapterNum = $_POST["chapnum"];
    $apikey = '$2y$10$sVGWfpcINzznkJ8JbKon2DsdrXl756lCKrfOghvvh6trm11XmcG';
    $response = file_get_contents("https://hadithapi.com/api/hadiths?apiKey=$apikey&book=$bookslug&chapter=$chapterNum&paginate=1000000");

    $response = json_decode($response, true);

    $hadithchapters = $response["hadiths"]["data"];
} else {
    echo "No data provided.";
    exit;
}
?>

<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Hadith Viewer</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Amiri+Quran&family=Aref+Ruqaa&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Noto+Nastaliq+Urdu:wght@400..700&display=swap" rel="stylesheet">

    <style>
        body {
            direction: rtl;
            background-color: #f8f9fa; /* Light background */
            font-family: Arial, sans-serif;
        }

        @font-face {
            font-family: "jameel";
            src: url(fonts/jameel.ttf);
        }

        .arabic {
            font-family: 'Amiri Quran', serif;
            color: #4a4a4a; /* Dark text for better contrast */
        }

        .urdu {
            font-family: "jameel";
            color: #4a4a4a;
        }

        .page {
            margin-bottom: 30px;
            padding: 20px;
            background-color: white; /* White background for each hadith */
            border-radius: 8px; /* Rounded corners */
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1); /* Subtle shadow */
        }

        h2 {
            font-size: 1.75rem; /* Larger font size for headings */
            margin-bottom: 10px;
            text-align: center; /* Center the Arabic heading */
            color: #007bff; /* Bootstrap primary color */
        }

        h3 {
            font-size: 1.5rem;
            margin-top: 20px; /* Spacing above headings */
            color: #333; /* Darker color for English and Urdu headings */
        }

        p {
            font-size: 1rem;
            line-height: 1.6; /* Better readability */
            margin-bottom: 15px; /* Space between paragraphs */
        }

        .row {
            margin-top: 20px; /* Space above the row */
        }
    </style>
</head>

<body>
    <div class="container mt-5">
        <?php
        foreach ($hadithchapters as $value) {
            echo '
            <div class="page">
                <h2 class="arabic">' . htmlspecialchars($value["headingArabic"]) . '</h2>
                <p class="arabic">' . htmlspecialchars($value["hadithArabic"]) . '</p>
                
                <div class="row">
                    <div class="col-md-6">
                        <h3>' . htmlspecialchars($value["headingEnglish"]) . '</h3>
                        <p>' . htmlspecialchars($value["hadithEnglish"]) . '</p>
                    </div>
                    <div class="col-md-6">
                        <h3 class="urdu">' . htmlspecialchars($value["headingUrdu"]) . '</h3>
                        <p class="urdu">' . htmlspecialchars($value["hadithUrdu"]) . '</p>
                    </div>
                </div>
            </div>';
        }
        ?>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
