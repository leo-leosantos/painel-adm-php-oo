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