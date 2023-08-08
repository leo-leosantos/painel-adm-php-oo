if(window.history.replaceState){
    window.history.replaceState(null, null, window.location.href)
}

function passwordStrength(){
    var password = document.getElementById("password").value;

        var strength = 0;
        if((password.length >= 6) && (password.length <= 7)){
            strength += 10;

        }else if(password.length > 7){
            strength += 25;

        }
        
        if((password.length >= 6) && (password.match(/[a-z]+/))){
            strength += 10;

        }

        if((password.length >= 7) && (password.match(/[A-Z]+/))){
            strength += 20;

        }

        if((password.length >= 8) && (password.match(/[@#$%;*]+/))){
            strength += 25;

        }
         if(password.match[/([1-9]+)\1{1,}/]) {
            strength -= 25;

        }

        viewStrength(strength);
        //console.log(strength);
}


function viewStrength(strength){
        if(strength < 30){
            document.getElementById("msgViewStrength").innerHTML = "<p style ='color: #f00'>Senha Fraca</p>";
        }else if((strength >= 30) && (strength < 50)){
            document.getElementById("msgViewStrength").innerHTML = "<p style ='color: #ff8c00'>Senha Media</p>";
        }else if((strength >= 50) && (strength < 70)){
            document.getElementById("msgViewStrength").innerHTML = "<p style ='color: #7cfc00'>Senha Boa</p>";
        }else if((strength >= 70)){
            document.getElementById("msgViewStrength").innerHTML = "<p style ='color: #339611'>Senha Forte</p>";
        }else{
            document.getElementById("msgViewStrength").innerHTML = "";

        }
}


const FormNewUser = document.getElementById("form-new-user");
if(FormNewUser){
    FormNewUser.addEventListener("submit", async(e) => {
        //receber os dados dos campos do form
        var name = document.querySelector("#name").value;
        if(name === ""){
            e.preventDefault();
            document.getElementById("msg").innerHTML = "<p> error: campo nome requeried!</p>"
                return;
        }
        var email = document.querySelector("#email").value;
        if(email === ""){
            e.preventDefault();
            document.getElementById("msg").innerHTML = "<p> error: campo email requeried!</p>"
                return;
        }

        var password = document.querySelector("#password").value;
        if(password === ""){
            e.preventDefault();
            document.getElementById("msg").innerHTML = "<p> error: campo password requeried!</p>"
                return;
        }

        if(password.length < 6 ){
            e.preventDefault();
            document.getElementById("msg").innerHTML = "<p> error: A senha deve ter no mininio 6 carac!</p>"
                return;
        }
        // Verificar se o campo senha não possui números repetidos
        if (password.match(/([1-9]+)\1{1,}/)) {
            e.preventDefault();
            document.getElementById("msg").innerHTML = "<p style='color: #f00;'>Erro: A senha não deve ter número repetido!</p>";
            return;
        }
        if(!password.match(/[A-Za-z]/)){
            e.preventDefault();
            document.getElementById("msg").innerHTML = "<p> error: Deve ter pelo menos uma letra!</p>"
                return;
        }
    });
}



const FormLogin = document.getElementById("form-login");
if(FormLogin){
    FormLogin.addEventListener("submit", async(e) => {
        var user = document.querySelector("#user").value;
        if(user === ""){
            e.preventDefault();
            document.getElementById("msg").innerHTML = "<p> error: campo user requeried!</p>"
                return;
        }

        var password = document.querySelector("#password").value;
        if(password === ""){
            e.preventDefault();
            document.getElementById("msg").innerHTML = "<p> error: campo password requeried!</p>"
                return;
        }
    });
}
    const newConfEmail = document.getElementById("form-new-conf-email");
    if(newConfEmail){
        newConfEmail.addEventListener("submit", async(e) => {
            var email = document.querySelector("#email").value;
            if(email === ""){
                e.preventDefault();
                document.getElementById("msg").innerHTML = "<p> error: campo email requeried!</p>"
                    return;
            }
        
        });
    }

    const recoveryPass = document.getElementById("form-recovery-pass");
    if(recoveryPass){
        recoveryPass.addEventListener("submit", async(e) => {
            var email = document.querySelector("#password").value;
            if(email === ""){
                e.preventDefault();
                document.getElementById("msg").innerHTML = "<p> error: campo  requeried!</p>"
                    return;
            }
        
        });
    }

    const updatePassword = document.getElementById("update-password");
    if(updatePassword){
        updatePassword.addEventListener("submit", async(e) => {
            var email = document.querySelector("#password").value;
            if(email === ""){
                e.preventDefault();
                document.getElementById("msg").innerHTML = "<p> error: campo  requeried!</p>"
                    return;
            }
        
        });
    }