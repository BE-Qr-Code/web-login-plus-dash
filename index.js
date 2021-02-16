//      .......... QR CODE ............
//initialize the textbox
var courseName = document.getElementById('course');
var sessionName = document.getElementById('session');
var instructorName = document.getElementById('instructor');
var passwordName = document.getElementById('password');

//initialize the div where you are going to display the QR(using the api)
var qrcode = new QRCode(document.getElementById('qr_display'));

//onClick() of button
function generateQR() {
    //get the actual content in textbox
    var course = courseName.value;
    var session = sessionName.value;
    var instructor = instructorName.value;
    var password = passwordName.value; 

    //convert the data to a JSON string
    var obj = {course : course, session : session, instructor : instructor, password : password};
    var myJSON = JSON.stringify(obj);
   
    //create the actual QR code (this function ia already defined in the qrcode.min.js)
    qrcode.makeCode(myJSON);    
  }

//      .......... To show different pages ............
function showPage(elementId){
  var id = document.getElementById(elementId);

  var pages = document.getElementsByClassName('page');
  for(var i=0; i<pages.length; i++){
    pages[i].style.display='none';
  }

  id.style.display='block';
}

//      .......... To change SIDEBAR link color on click ............
var selector, elems, makeActive;

selector = '.sideLink';

elems = document.querySelectorAll(selector);

makeActive = function () {
    for (var i = 0; i < elems.length; i++)
        elems[i].classList.remove('active');
    
    this.classList.add('active');
};

for (var i = 0; i < elems.length; i++)
    elems[i].addEventListener('mousedown', makeActive);




