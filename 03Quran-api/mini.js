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
