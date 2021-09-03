//about us typing effect

let i=0;
let text="Experience the lifestyle....";
let textContainer=document.getElementById("typing-text");

function typing() {
  if (i<text.length) {
    textContainer.innerHTML+=text.charAt(i);    //Return the i character of a string
    i++;
    setTimeout(typing, 150);   //speed
  }
}

typing();