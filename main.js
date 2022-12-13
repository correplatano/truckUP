const email = document.getElementById("email"); 
const contrasenia = document.getElementById("contrasenia");
const cifDni = document.getElementById("cifDni").value;
const cif = document.getElementById("cif");
const tlfn = document.getElementById("telefono");


const expRegcif= /(([A-W]{1})([-]?)(\d{7})([-]?)([a-zA-Z0-9]{1}))/;
const expRegdni=/((\d{8})([-]?)([A-Z]))/;
//[A-Za-z]([0-9]{7})([0-9A-Ja]$))|(^[0-9]{8}[A-Z]$)/ 



function validarEntrada(){
    

    if(email.value === null || email.value === ""){
        
        return alert("Ingresa el mail");
    }

    if(contrasenia.value === null || contrasenia.value === ""){
        
        return alert("Ingresa la contraseña");
    }
  
}

function valorCifDni(){
    console.log("entra dni");

    if(expRegdni.test(cifDni)){
        //console.log("entra if")
        alert("Ingresa Cif válido");
        return false;
    }

}


//document.getElementById("cifDni").addEventListener('blur', valorCifDni, false);
