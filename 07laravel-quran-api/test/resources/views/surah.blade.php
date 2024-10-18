<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Bootstrap demo</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Amiri+Quran&family=Aref+Ruqaa&display=swap" rel="stylesheet">
    <style>
        body {
            color:whitesmoke; 
            direction: rtl;
            background-color: rgb(252, 250, 250);
        }

        .container {
            width: 1200px !important;
            padding: 0 !important;
            margin-right: auto;
            margin-left: auto;
        }

        .gradient-cards {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr)); /* 3 or more cards in a row */
            gap: 32px;
            padding: 30px;
        }

        .card {
            width: 100%; /* Ensure the card takes up the full width of its grid space */
            margin-inline: auto;
        }

        @media screen and (max-width: 991px) {
            .gradient-cards {
                grid-template-columns: 1fr; /* 1 card per row for smaller screens */
            }
        }

        .container-card {
            position: relative;
            border: 2px solid transparent;
            background: linear-gradient(71deg, #080509, #1a171c, #080509);
            background-clip: padding-box;
            border-radius: 45px;
            padding: 40px;
        }
    </style>
</head>

<body>

    <div class="container">
        <div class="row">
            @foreach ($alldata as $item)
            <div class="col-md-4">
                <p class="container-title"></p>
                <div class="gradient-cards">
                    <div class="card">
                        <div class="container-card bg-green-box">
                            <!-- SVG Icon -->
                            
                                <rect x="1" y="1" width="118" height="118" rx="24"
                                    fill="url(#paint0_linear_1366_4547)" fill-opacity="0.15"
                                    stroke="url(#paint1_radial_1366_4547)" stroke-width="2"></rect>
                                <path d="M33.2182 61.4C33.2182 75.425 37.2682 86.75 51.5932 86.75C65.9182 86.75 69.8182 75.425 69.8182 61.4C69.8182 47.225 65.9182 35.9 51.5932 35.9C37.2682 35.9 33.2182 47.225 33.2182 61.4ZM43.7182 61.4C43.7182 53.075 45.5932 46.1 51.5932 46.1C57.5182 46.1 59.3182 53.075 59.3182 61.4C59.3182 69.65 57.5182 76.55 51.5932 76.55C45.5932 76.55 43.7182 69.65 43.7182 61.4Z"
                                    fill="#54E8A9"></path>
                                <path d="M87.7143 36.35L78.0543 56H80.1243L89.7843 36.35H87.7143ZM74.6943 40.16C74.6943 42.44 76.4043 44.15 78.6843 44.15C80.9343 44.15 82.7043 42.44 82.7043 40.16C82.7043 37.91 80.9343 36.14 78.6843 36.14C76.4043 36.14 74.6943 37.91 74.6943 40.16ZM77.1243 40.16C77.1243 39.29 77.7543 38.57 78.6843 38.57C79.5543 38.57 80.2743 39.29 80.2743 40.16C80.2743 41.09 79.5543 41.72 78.6843 41.72C77.7543 41.72 77.1243 41.09 77.1243 40.16ZM85.3143 52.31C85.3143 54.59 87.0243 56.3 89.3043 56.3C91.5543 56.3 93.3243 54.59 93.3243 52.31C93.3243 50.06 91.5543 48.29 89.3043 48.29C87.0243 48.29 85.3143 50.06 85.3143 52.31ZM87.7443 52.31C87.7443 51.44 88.3743 50.72 89.3043 50.72C90.1743 50.72 90.8943 51.44 90.8943 52.31C90.8943 53.24 90.1743 53.87 89.3043 53.87C88.3743 53.87 87.7443 53.24 87.7443 52.31Z"
                                    fill="#2FCB89"></path>
                                <defs>
                                    <linearGradient id="paint0_linear_1366_4547" x1="0.0063367" y1="0.168432"
                                        x2="120.853" y2="119.009" gradientUnits="userSpaceOnUse">
                                        <stop stop-color="#2FCB89" stop-opacity="0.7"></stop>
                                        <stop offset="0.489583" stop-color="#2FCB89" stop-opacity="0"></stop>
                                        <stop offset="1" stop-color="#2FCB89" stop-opacity="0.7"></stop>
                                    </linearGradient>
                                    <radialGradient id="paint1_radial_1366_4547" cx="0" cy="0" r="1"
                                        gradientUnits="userSpaceOnUse"
                                        gradientTransform="translate(60 60) rotate(96.8574) scale(122.674 149.921)">
                                        <stop stop-color="#54E8A9"></stop>
                                        <stop offset="1" stop-color="#1A3E31" stop-opacity="0.2"></stop>
                                    </radialGradient>
                                </defs>
                            </svg>
                            <!-- Card Content -->
                            <h5 class="card-title">{{ $item['number'] }}</h5>
                            <p class="card-title">{{ $item['name'] }}</p>
                            <p class="card-title">{{ $item['englishNameTranslation'] }}</p>
                            <p class="card-title">{{ $item['englishName'] }}</p>
                            <p class="card-text">{{ $item['numberOfAyahs'] }} | {{ $item['revelationType'] }}</p>
                            <a href="/read/{{ $item['number'] }}" class="btn btn-light">Read Surah</a>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
    </script>
</body>

</html>
