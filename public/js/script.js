const material = document.getElementById("material");
const farbe = document.getElementById("farbe");
const höhe = document.getElementById("höhe");
const paket = document.getElementById("paket");
const stück = document.getElementById("stück");
const zweck = document.getElementById("zweck");
const anmerkung = document.getElementById("anmerkungen");

const submit = document.getElementById("submit");
const showrechner = document.getElementById("click");
const mainApp = document.querySelector(".curd");
// const rechnenBox = document.querySelector(".rechnen-box");
const chartBox = document.querySelector(".container");

const connectData = document.querySelector(".success");



// Get the message element
const message = document.getElementById('#msgAll');
const chartPf = document.getElementById('#change-value-chart');

// Update the message position on scroll
window.addEventListener('scroll', () => {

    if (message !== null) {
        // Get the current scroll position
        const scrollY = window.scrollY || window.pageYOffset;
    
        // Set the message position based on the scroll position
        message.style.top = `${50 + scrollY}px`;
    }
});

window.addEventListener('scroll', () => {

    if (chartPf !== null) {
        // Get the current scroll position
        const scrollY = window.scrollY || window.pageYOffset;
        console.log(scrollY)
        // Set the message position based on the scroll position
        chartPf.style.top = `${20+scrollY}px`;
    }
});






// ------------------------------Remind Messages--------------------------------------
function hiddenNone(element, item){
    element.style.visibility = 'hidden'
    item.style.filter = 'none';
}
function visibleBlur(element, item){
    element.style.visibility = 'visible'
    item.style.filter = 'blur(5px)';
}
const popup = document.getElementById("popup");
const erinnerungsMas = document.getElementById("erinnerungsMas");
const schließen = document.getElementById("schließen");


//-----------------------------
const popupTwo = document.getElementById("popupTwo");
const erinnerungsMasTwo = document.getElementById("erinnerungsMasTwo");
const schließenTwo = document.getElementById("schließenTwo");





//-----------------------------Start the App-----------------------------------------
const infosBox = document.getElementById("infos");
const schließenInfo = document.getElementById("schließen-info");

let purpose = 'hinzufügen';

let index;

let dataMaterial;


// reset the Select Boxes
function reset(){
    material.options[0].text = '-----';
    farbe.options[0].text = '-----';
    höhe.options[0].text = '-----';
}


// delete Row of the data from the table
function deleteRow(i){
    dataMaterial.splice(i,1);
    localStorage.material = JSON.stringify(dataMaterial)
    showData();
}



//--------------------Rechner--------------------------



// calulate the Material
const materialBox = document.getElementById("material-box");
const farbeBox = document.getElementById("farbe-box");
const höheBox = document.getElementById("höhe-box");
const result = document.getElementById("result");
const msg = document.getElementById("message");
// Input Radios
const lagerOpt = document.getElementById("lager-opt");
const kundenOpt = document.getElementById("kunden-opt");

// css Function 
function noDrop(element){
    element.style.cursor= 'no-drop'
    element.disabled = true
}

function pointer(element){
    element.style.cursor= 'pointer'
    element.disabled = false
}
const rechnenMaterial = document.getElementById("rechnen-material");

    
  
//------------------------------Chart-----------------------------


function aktuUndLoschDisabled(){
    const delAll = document.getElementById("delAll");  
    const aktus = document.querySelectorAll("#aktualisieren")  
    const löschs = document.querySelectorAll("#löschen")  
    delAll.disabled = true
    aktus.forEach(element => {
        element.disabled = true;
    });
    löschs.forEach(element => {
        element.disabled = true;
    });
}

function aktuUndLoschEnabled(){
    const delAll = document.getElementById("delAll");  
    const aktus = document.querySelectorAll("#aktualisieren")  
    const löschs = document.querySelectorAll("#löschen")  
    delAll.disabled = false
    aktus.forEach(element => {
        element.disabled = false;
    });
    löschs.forEach(element => {
        element.disabled = false;
    });
}

// -------------------------------------------------------


