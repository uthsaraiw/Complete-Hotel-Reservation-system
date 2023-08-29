let slideIndex = 1;
let slideIndex2 = 1;
showSlides(slideIndex);

// Next/previous controls
function plusSlides(n) {
  showSlides(slideIndex += n);
}


function showSlides(n) {
  let i;
  let slides = document.getElementsByClassName("mySlides");
  if (n > slides.length-1) {
    slideIndex = 0;
  } else {
  if (n <1) {
    slideIndex = slides.length-1;
  }
  }

  for (i = 0; i < slides.length; i++) {
    slides[i].style.display = "none";
  }

  slides[slideIndex].style.display = "block";
}




showSlides2(slideIndex2);

// Next/previous controls
function plusSlides2(n2) {
  showSlides2(slideIndex2 += n2);
}



function showSlides2(n) {
  let i;  
  let slides = document.getElementsByClassName("mySlides2");
  if (n == slides.length-3) {document.querySelector(".next2").style.display = "none"} else {document.querySelector(".next2").style.display = "block"}
  if (n == 1) {document.querySelector(".prev2").style.display = "none"} else {document.querySelector(".prev2").style.display = "block"}
  for (i = 0; i < slides.length; i++) {
    slides[i].style.display = "none";
  }


    
  slides[slideIndex2-1].style.display = "block";
  slides[slideIndex2].style.display = "block";
  slides[slideIndex2+1].style.display = "block";
  slides[slideIndex2+2].style.display = "block";
}
