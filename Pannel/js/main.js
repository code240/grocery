function select_image(icode,arr){
    document.getElementById("dpid").value = icode;
    document.getElementById("dpid_dlt").value = icode;
    const x = arr.split(",");
    for(var i=0; i<x.length-1; i++){
        document.getElementById(x[i]).style.border = "1px solid #D3D3D3";
    }
    document.getElementById(icode).style.border = "5px solid blue";
}
function update_pin(){
    if(document.getElementById("dpid").value!=""){
        document.getElementById("pin_form").submit();
    }
}
function delete_pin(){
    if(document.getElementById("dpid_dlt").value!=""){
        document.getElementById("dlt_form").submit();
    }
}
function add_new_img_hide(){
    document.getElementById("add_image").style.display = "none";
}
function add_new_img_show(){
    document.getElementById("add_image").style.display = "block";
}
function img_upload(){
    document.getElementById("submit_img_upload").disabled = true;
    var dp = document.forms["dp_form"]["product_dp"].value;
    var pid = document.forms["dp_form"]["pid"].value;
    if(dp.trim()==""){
        alert("Please select an image");
        document.getElementById("submit_img_upload").disabled = false;
        return false;
    }
    if(pid.trim()==""){
        alert("There is an error while loding product");
        document.getElementById("submit_img_upload").disabled = false;
        return false;
    }
    return true;
}
function edit_brand_show(){
    document.getElementById("edit_brand").style.display = "block";
}
function edit_brand_hide(){
    document.getElementById("edit_brand").style.display = "none";
}

function edit_item_show(){
    document.getElementById("edit_itemname").style.display = "block";
}

function edit_item_hide(){
    document.getElementById("edit_itemname").style.display = "none";
}
function edit_mrp_show(){
    document.getElementById("edit_mrp").style.display = "block";
}

function edit_mrp_hide(){
    document.getElementById("edit_mrp").style.display = "none";
}

function edit_mrp_show(){
    document.getElementById("edit_mrp").style.display = "block";
}

function edit_mrp_hide(){
    document.getElementById("edit_mrp").style.display = "none";
}

function edit_sell_show(){
    document.getElementById("edit_sell").style.display = "block";
}

function edit_sell_hide(){
    document.getElementById("edit_sell").style.display = "none";
}

function edit_quantity_show(){
    document.getElementById("edit_quantity").style.display = "block";
}

function edit_quantity_hide(){
    document.getElementById("edit_quantity").style.display = "none";
}

function remove_offer(on,oc){
    document.getElementById("confirm_offer_heading").innerHTML = "Are you sure you want to remove the offer <span style='color:blue; ''>'"+on+"'</span>?";
    document.getElementById("offerToBeRemoved").value = oc;
    document.getElementById("confirm_box").style.display = "block";
}
function remove_offer_confirmed(){
    document.getElementById("remove_offer_form").submit();
}

function remove_cat(cn,cc){
    document.getElementById("confirm_cat_heading").innerHTML = "Are you sure you want to remove the category <span style='color:blue; ''>'"+cn+"'</span>?";
    document.getElementById("catToBeRemoved").value = cc;
    document.getElementById("confirm_box2").style.display = "block";    
}
function remove_cat_confirmed(){
    document.getElementById("remove_cat_form").submit();
}

function remove_des(dn,dc){
    document.getElementById("confirm_des_heading").innerHTML = "Are you sure you want to remove this line <span style='color:blue; ''>'"+dn+"'</span>?";
    document.getElementById("desToBeRemoved").value = dc;
    document.getElementById("confirm_box3").style.display = "block";    
}
function remove_des_confirmed(){
    document.getElementById("remove_des_form").submit();
}
// function add_des(){
    
// }
function delete_confirmed(){
    document.getElementById("del_form").submit();
}
const add_new_quantity_form = () => {
    var pname = document.forms["new_quantity_form"]["itemname"].value;
    var pquantity = document.forms["new_quantity_form"]["quantity"].value;
    var mrp = document.forms["new_quantity_form"]["mrp"].value;
    var sell = document.forms["new_quantity_form"]["selling"].value;
    if(pname.trim() == ""){
        alert("Please enter the product title");
        return false;
    }
    if(pquantity.trim() == ""){
        alert("Please enter the quantity");
        return false;
    }
    if(mrp.trim() == ""){
        alert("Please enter the mrp");
        return false;
    }
    if(sell.trim() == ""){
        alert("Please enter the selling price");
        return false;
    }
    return true;    
}



function new_product(){
    var brandname = document.forms["new"]["brandname"].value;
    var itemname = document.forms["new"]["productname"].value;
    var mrp = document.forms["new"]["mrp"].value;
    var sell = document.forms["new"]["sell"].value;
    var quantity = document.forms["new"]["quantity"].value;
    var rating = document.forms["new"]["rating"].value;
    var img = document.forms["new"]["img"].value;
    var productdes = document.forms["new"]["productdes"].value;
    var cat = document.forms["new"]["cat"].value;
    var offer = document.forms["new"]["offer"].value;
    
    if(brandname.trim()==""){
        alert("Please enter brand name");
        return false;
    }
    if(itemname.trim()==""){
        alert("Please enter item name");
        return false;
    }if(mrp.trim()==""){
        alert("Please enter the mrp");
        return false;
    }if(sell.trim()==""){
        alert("Please enter the selling price");
        return false;
    }
    if(quantity.trim()==""){
        alert("Please enter the quantity.");
        return false;
    }if(rating.trim()==""){
        alert("Please select the rating");
        return false;
    }if(img.trim()==""){
        alert("Please select the image");
        return false;
    }if(cat.trim()==""){
        alert("Please select the category");
        return false;
    }if(offer.trim()==""){
        alert("Please select an offer");
        return false;
    }
    return true;
}

function edit_offer(offer_name,offer_code){
    document.getElementById("offer_inp").value = offer_name;
    document.getElementById("ofcode").value = offer_code;
    document.getElementById("edit_offer_name").style.display = "block";
}

function del_offer(x){
    y = confirm("Are you sure you want to delete it?");
    // alert(y);
    if(y==true){
        window.location.assign('backend/delete_offer.php?do='+x)
    }
}

function create_offer_validate(){
    var offer = document.forms["new_offer_name_form"]["offername"].value;
    if(offer.trim() == ""){
        alert("Please enter offer name");
        return false;
    }
    return true;
}

function edit_cats(cn,oc){
    document.getElementById("cat_inp").value = cn;
    document.getElementById("catcode").value = oc;
    document.getElementById("edit_cat_name_div").style.display = "block";
}
function del_cat(x){
    y = confirm("Are you sure you want to delete it?");
    if(y==true){
        window.location.assign('backend/delete_cat.php?do='+x)
    }
}

function insert_cat(){
    var cat = document.forms["insert_cat_form"]["cat"].value;
    if(cat.trim() == ""){
        alert("Please enter category name");
        return false;
    }
    return true;
} 
function pannel_nav_show(){
    document.getElementById("show_bar").style.display = "none";
    document.getElementById("cut_bar").style.display = "block";
    document.getElementById("nav_pannel").style.display = "block";

}
function pannel_nav_hide(){
    document.getElementById("show_bar").style.display = "block";
    document.getElementById("cut_bar").style.display = "none";
    document.getElementById("nav_pannel").style.display = "none";

}

function check_ps(){
    var ps = document.forms["ps_form"]["oldps"].value;
    var newps = document.forms["ps_form"]["newps"].value;
    var cps = document.forms["ps_form"]["cps"].value;
    if(ps.trim()==""){
        alert("PLEASE ENTER THE OLD PASSWORD");
        return false;
    }
    if(newps.trim()==""){
        alert("PLEASE ENTER THE NEW PASSWORD");
        return false;
    }
    if(cps.trim()==""){
        alert("PLEASE CONFIRM THE NEW PASSWORD");
        return false;
    }
    if(cps != newps){
        alert("Password confirmation failed");
        return false;
    }
    return true;
}




