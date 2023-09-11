//nav bar

const bar = document.getElementById('bar');
const close = document.getElementById('close');
const nav = document.getElementById('navbar');
const prodout = document.getElementById ("prdout")
        
        
        .addEventListener ("click", resetEmotes, false);
if (prodout) {
    prodout.addEventListener('click', () => {
        product_button;
    })
}

if (bar) {
    bar.addEventListener('click', () => {
        nav.classList.add('active');
    })
}

if (close) {
    close.addEventListener('click', () => {
        nav.classList.remove('active');
    })
}
function product_button() {
  document.getElementById("gtpp").click();
}

//login 
// Get the modal
var modal = document.getElementById('loginpop');

// When the user clicks anywhere outside of the modal, close it
window.onclick = function(event) {
	if (event.target == modal) {
	modal.style.display = "none";
	}
}

//contact page
//event handlers

var nameNode = document.getElementById('name');
var emailNode = document.getElementById('email');
var phoneNode = document.getElementById('phoneNum');
var orderNode = document.getElementById('orderNum');


nameNode.addEventListener("change", chkName, false);
emailNode.addEventListener("change", chkEmail, false);
phoneNode.addEventListener("change", chkPhone, false);
orderNode.addEventListener("change", chkOrder, false);


// The event handler function for the message box

function chkName(event) {

  var myName = event.currentTarget;

  var pos = myName.value.search(/^[A-Z][a-z]+$/);

  if (pos != 0) {
    alert("The name you entered (" + myName.value + ") is not in the correct form. \n" +
          "The correct form is: " + " Last-name First Name \n" +
          "Eg. John Lim");
    myName.focus();
    myName.select();
    return false;
  }
}

function chkEmail(event) {

  var myEmail = event.currentTarget;

  // \w (word character) matches any single letter, number or underscore (same as [a-zA-Z0-9_]).
  var pos = myEmail.value.search(/^(\w+([\.- ]?\w+))+@([\w]+\.)[\w]{2,3}$/);

  if (pos != 0) {
    alert("The username you entered (" + myEmail.value + ") is not in the correct form. \n" +
          "The correct form is: \n" +
          "username must contain word characters including hypen and dot \n" +
          "domain must contain 2 domain extensions \n" +
          "Eg. jo-hn.lim@gmail.com");
    myEmail.focus();
    myEmail.select();
    return false;
  }
}

function chkPhone(event) {

  var myPhone = event.currentTarget;

  var pos = myPhone.value.search(/^[0-9]{8}$/);

  if (pos != 0) {
    alert("The name you entered (" + myPhone.value + ") is not in the correct form. \n" +
          "The correct form is: " + " Last-name First Name \n" +
          "Eg. John Lim");
    myPhone.focus();
    myPhone.select();
    return false;
  }
}

function chkOrder(event) {

  var myOrder = event.currentTarget;

  var pos = myOrder.value.search(/^[0-9]{6}$/);

  if (pos != 0) {
    alert("The name you entered (" + myOrder.value + ") is not in the correct form. \n" +
          "The correct form is: " + " Last-name First Name \n" +
          "Eg. John Lim");
    myOrder.focus();
    myOrder.select();
    return false;
  }
}
