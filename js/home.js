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
const showContactNav = () => {
    document.getElementById("bars-contact").style.display = "none";
    document.getElementById("cuts-contact").style.display = "block";
    document.getElementById("mobiNav2").style.display = "block";
}

const hideContactNav = () => {
    document.getElementById("bars-contact").style.display = "block";
    document.getElementById("cuts-contact").style.display = "none";
    document.getElementById("mobiNav2").style.display = "none";
}
const chat = (product_name) => {
    document.getElementById("chatroom").style.display = "block";
    document.getElementById("chat-heading").innerHTML = "Ask any question / query related to this product : <span style='color:red'>"+product_name+"</span>";
    document.getElementById("chat-subject2").value = "Query on a product :" + product_name; 
}
const cancel_chat = () => {
    document.getElementById("chatroom").style.display = "none";
}
const cancel_msg = () => {
    document.getElementById("messageroom").style.display = "none";
}
const visit_store = () => {
    document.getElementById("locationRoom").style.display = "block";
}
const cut_location = () => {
    document.getElementById("locationRoom").style.display = "none";
}
const call_us = () => {
    document.getElementById("callroom").style.display = "block";
}
const hide_call_us = () => {
    document.getElementById("callroom").style.display = "none";
}
const message_us = () => {
    document.getElementById("messageroom").style.display = "block";
}
function validation(){
    var name = document.forms['contact']['name'].value;
    var email = document.forms['contact']['email'].value;
    var subject = document.forms['contact']['subject'].value;
    var message = document.forms['contact']['message'].value;

    if(name.trim()==""){
        alert("Please enter a valid name");
        return false;
    }
    if(email.trim()==""){
        alert("Please enter a valid email");
        return false;
    }
    
    if(subject.trim()==""){
        alert("Please enter a valid subject");
        return false;
    }
    
    if(message.trim()==""){
        alert("Please enter a valid message");
        return false;
    }
    return true;
}
const handle_offer = () => {
    if(screen.width<="600"){
        catNav_Show();        
    }
}
const handle_offer_product = () => {
    if(screen.width<="799"){
        catNav_Show();        
    }
}


function change_image(src){
    document.getElementById("gallery-img").src = src;

}


