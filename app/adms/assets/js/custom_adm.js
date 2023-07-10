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
