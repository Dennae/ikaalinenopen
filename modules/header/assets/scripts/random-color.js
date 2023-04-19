/**
 * Mouseover random colors
 */
function randomColor() {
    let colors = ["#DA2028", "#FBB133"];
    let random = colors[(Math.floor(Math.random() * colors.length))];

    return random;
  } 
  
  
const elems = document.querySelectorAll('.menu-item > .menu-item__link > a');

for (let i = 0; i < elems.length; i++) {
    elems[i].addEventListener("mouseover", function(event) {
        event.target.style.color = randomColor();
        event.target.style.textShadow = "2px 2px 4px #000000";
    });
}