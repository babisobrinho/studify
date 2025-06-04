document.addEventListener('DOMContentLoaded', function() {
    const videoModal = document.getElementById('videoModal');
    const videoBtn = document.querySelector('.video-btn');
    const closeBtn = document.querySelector('.close-video');
    const youtubeIframe = document.getElementById('youtubeVideo');

    if (videoBtn && videoModal) {
        videoBtn.addEventListener('click', function() {
            videoModal.style.display = "block";
            youtubeIframe.src = "https://www.youtube-nocookie.com/embed/S8a0IIRK2Eo?si=B9qImTGANRjV6mCb"; 
        });
    }

    if (closeBtn && videoModal) {
        closeBtn.addEventListener('click', function() {
            videoModal.style.display = "none";
            youtubeIframe.src = "";
        });
    }

    window.addEventListener('click', function(event) {
        if (event.target == videoModal) {
            videoModal.style.display = "none";
            youtubeIframe.src = "";
        }
    });
});