const hideTop = () => {
    document.getElementById("top").style.display = "none";
    document.getElementById("main-header").style.borderTop= "0px solid #625750";
    document.getElementById("side-inside-mainHeader").style.paddingTop= "0.5rem";

}
const show_nav = () => {
    document.getElementById("ShowBar").style.display = "none";
    document.getElementById("CutBar").style.display = "block";
    document.getElementById("mobiNav").style.display = "block";
}
const hide_nav = () => {
    document.getElementById("ShowBar").style.display = "block";
    document.getElementById("CutBar").style.display = "none";
    document.getElementById("mobiNav").style.display = "none";
}
const catNav_Show = () => {
     document.getElementById("catNavBars").style.display = "none";
     document.getElementById("catNavCut").style.display = "inline-block";
     document.getElementById("cat-nav").style.display = "block";
     
}
const catNav_Hide = () => {
    document.getElementById("catNavBars").style.display = "inline-block";
    document.getElementById("catNavCut").style.display = "none";
    document.getElementById("cat-nav").style.display = "none";
}