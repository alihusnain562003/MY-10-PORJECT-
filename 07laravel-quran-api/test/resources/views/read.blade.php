<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quran Reader</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Amiri+Quran&family=Aref+Ruqaa&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Noto+Nastaliq+Urdu:wght@400..700&display=swap" rel="stylesheet">

    <style>
        body {
            direction: rtl;
            background-color: black;
            font-family: 'Amiri Quran', serif;
            margin: 20px;
        }

        p {
            background-color: #C7C0BF;
            margin: 5px 10px;
            padding: 5px 10px;
        }

        div {
            background-color: #728FCE;
            color: teal;
            width: 100%;
            margin: 20px 0;
            padding: 20px;
        }
    </style>
</head>

<body>

<div>
    @if(isset($dataArabic) && isset($dataTranslation))
        @foreach ($dataArabic as $index => $ayah)
            <div>
                <!-- Display Arabic text -->
                <p>{{ $ayah['text'] }}</p>
                
                <!-- Display English translation -->
                <p><strong>Translation: </strong>{{ $dataTranslation[$index]['text'] }}</p>
                
                <!-- Display audio player -->
                <audio controls src="{{ $ayah['audio'] }}"></audio>
            </div>
        @endforeach
    @else
        <p>No Surah Selected.</p>
    @endif
</div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        let audios = document.querySelectorAll('audio');

        // Loop through all audio elements and add event listeners
        audios.forEach((audio, index) => {
            audio.addEventListener('ended', function () {
                // Check if there is a next audio
                if (audios[index + 1]) {
                    audios[index + 1].play(); // Play the next audio
                }
            });
        });
    });
</script>

</body>
</html>
