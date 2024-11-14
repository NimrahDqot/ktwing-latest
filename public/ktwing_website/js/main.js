// Navigation functions
function openNav() {
    document.getElementById("mySidenav").style.width = "250px";
}

function closeNav() {
    document.getElementById("mySidenav").style.width = "0";
}

// Common configuration for all swipers
const commonConfig = {
    loop: true,
    navigation: {
        nextEl: ".swiper-button-next",
        prevEl: ".swiper-button-prev",
    },
    // autoplay: {
    //     delay: 2500,
    //     disableOnInteraction: false,
    // },
    pagination: {
        el: ".swiper-pagination",
        clickable: true,
    },
    // Common breakpoints
    breakpoints: {
        0: {
            slidesPerView: 1,
            spaceBetween: 0,
        },
        500: {
            slidesPerView: 1,
            spaceBetween: 0,
        },
        768: {
            slidesPerView: 2,
            spaceBetween: 10,
        },
        992: {
            slidesPerView: 2,
            spaceBetween: 30,
        },
        1200: {
            slidesPerView: 3,
            spaceBetween: 40,
        },
    }
};

// Initialize all Swipers when DOM is loaded
document.addEventListener('DOMContentLoaded', function() {
    // Horoscope Banner Swiper
    new Swiper(".mySwiper-ktwing-banner", {
        ...commonConfig,
        slidesPerView: 1,
        spaceBetween: 0,
        breakpoints: {
            0: { slidesPerView: 1 },
            1200: { slidesPerView: 1 }
        }
    });

    // Astrologers Slider
    new Swiper(".mySwiper-rewards-slider", {
        ...commonConfig,
        slidesPerView: 3,
        spaceBetween: 3,
        breakpoints: {
            0: {
                slidesPerView: 1,
                spaceBetween: 0,
            },
            500: {
                slidesPerView: 1,
                spaceBetween: 0,
            },
            768: {
                slidesPerView: 2,
                spaceBetween: 10,
            },
            992: {
                slidesPerView: 2,
                spaceBetween: 30,
            },
            1400: {
                slidesPerView: 3,
                spaceBetween: 20,
            },
        }
    });
    new Swiper(".mySwiper-testimonials-slide", {
        ...commonConfig,
        slidesPerView: 3,
        spaceBetween: 3,
        breakpoints: {
            ...commonConfig.breakpoints,
            1200: {
                slidesPerView: 3,
                spaceBetween: 10,
            }
        }
    });
    new Swiper(".mySwiper-testimonials-slide1", {
        ...commonConfig,
        slidesPerView: 4,
        spaceBetween: 3,
        breakpoints: {
            0: {
                slidesPerView: 1,
                spaceBetween: 0,
            },
            500: {
                slidesPerView: 1,
                spaceBetween: 0,
            },
            768: {
                slidesPerView: 2,
                spaceBetween: 10,
            },
            992: {
                slidesPerView: 2,
                spaceBetween: 30,
            },
            1400: {
                slidesPerView: 4,
                spaceBetween: 20,
            },
        }
    });
    new Swiper(".mySwiper-banner2-slide", {
        spaceBetween: 3,
        autoplay: {
            delay: 2500,
            disableOnInteraction: false,
        },

            breakpoints: {
                0: {
                    slidesPerView: 1,
                    spaceBetween: 0,
                },
                500: {
                    slidesPerView: 1,
                    spaceBetween: 0,
                },
                768: {
                    slidesPerView: 2,
                    spaceBetween: 10,
                },
                992: {
                    slidesPerView: 3,
                    spaceBetween: 30,
                },
                1200: {
                    slidesPerView: 3,
                    spaceBetween: 40,
                },
                1400: {
                    slidesPerView: 4,
                    spaceBetween: 40,
                },
            }

    });

    // News Slider
});


function animateCounter(element, targetValue) {
    let current = 0;
    const duration = 2000; // 2 seconds
    const step = targetValue / (duration / 16);

    const timer = setInterval(() => {
        current += step;
        if (current >= targetValue) {
            current = targetValue;
            clearInterval(timer);
        }
        element.textContent = Math.floor(current).toLocaleString('en-IN');
    }, 16);
}

// Initialize counter animation
document.addEventListener('DOMContentLoaded', () => {
    const counterElement = document.getElementById('memberCounter');
    const targetValue = 10645022; // Your target number
    animateCounter(counterElement, targetValue);
});

document.addEventListener('DOMContentLoaded', function() {
    const videoThumbnails = document.querySelectorAll('.video-thumbnail');
    const videoModal = new bootstrap.Modal(document.getElementById('videoModal'));
    const modalVideo = document.querySelector('#videoModal video');

    videoThumbnails.forEach(thumbnail => {
        thumbnail.addEventListener('click', function() {
            const videoUrl = this.dataset.videoUrl;
            modalVideo.src = videoUrl;
            videoModal.show();
            modalVideo.play();
        });
    });

    // Reset video when modal is closed
    document.getElementById('videoModal').addEventListener('hidden.bs.modal', function () {
        modalVideo.pause();
        modalVideo.currentTime = 0;
        modalVideo.src = '';
    });
});


let currentlyPlaying = null;

        function playVideo(videoId) {
            const video = document.getElementById(videoId);
            const videoSection = video.closest('.video-section');

            // If there's another video playing, stop it
            if (currentlyPlaying && currentlyPlaying !== video) {
                currentlyPlaying.pause();
                currentlyPlaying.closest('.video-section').classList.remove('playing');
            }

            if (video.paused) {
                video.play();
                videoSection.classList.add('playing');
                currentlyPlaying = video;
            } else {
                video.pause();
                videoSection.classList.remove('playing');
                currentlyPlaying = null;
            }
        }

        // Add event listeners to handle video completion
        document.querySelectorAll('video').forEach(video => {
            video.addEventListener('ended', () => {
                video.closest('.video-section').classList.remove('playing');
                currentlyPlaying = null;
            });
        });

        document.addEventListener('DOMContentLoaded', function() {
            const videoThumbnails = document.querySelectorAll('.video-thumbnail');
            const videoModal = new bootstrap.Modal(document.getElementById('videoModal'));
            const modalVideo = document.querySelector('#videoModal video');

            videoThumbnails.forEach(thumbnail => {
                thumbnail.addEventListener('click', function() {
                    const videoUrl = this.dataset.videoUrl;
                    modalVideo.src = videoUrl;
                    videoModal.show();
                    modalVideo.play();
                });
            });

            document.getElementById('videoModal').addEventListener('hidden.bs.modal', function () {
                modalVideo.pause();
                modalVideo.currentTime = 0;
                modalVideo.src = '';
            });
        });
