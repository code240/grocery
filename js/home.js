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