const sliderImages = document.querySelectorAll('.slider-image');
const prevButton = document.querySelector('.prev-button');
const nextButton = document.querySelector('.next-button');

let currentIndex = 0;
sliderImages[currentIndex].classList.add('active');

prevButton.addEventListener('click', () => {
  sliderImages[currentIndex].classList.remove('active');
  currentIndex--;
  if (currentIndex < 0) {
    currentIndex = sliderImages.length - 1;
  }
  sliderImages[currentIndex].classList.add('active');
});

nextButton.addEventListener('click', () => {
  sliderImages[currentIndex].classList.remove('active');
  currentIndex++;
  if (currentIndex >= sliderImages.length) {
    currentIndex = 0;
  }
  sliderImages[currentIndex].classList.add('active');
});


