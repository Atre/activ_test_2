<!DOCTYPE html>
<html>
<head>
    <title>
        Registration form!
    </title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>


<span id="alert"></span>
<form onsubmit="return submitForm()" onkeyup="return validateForm()">
    <label for="name">ФИО:</label><br/>
    <span class="err" id="nameerr"></span>
    <input type="text" id="name" o><br/>

    <label for="email">E-mail:</label><br/>
    <span class="err" id="emailerr"></span>
    <input type="text" id="email" /><br/>
    <hr>
    <label for="text">Текст:</label><br/>
    <span class="err" id="texterr"></span>
    <textarea id="text"></textarea><br/>
    <input type="submit" />
</form>

<script>
    // No jQuery here

    // Error text
    var nameErr = document.getElementById("nameerr");
    var emailErr = document.getElementById("emailerr");
    var textErr = document.getElementById("texterr");


    var errors = 1;

    function validateForm() {
        errors = 1;
        // Clear error messages
        for (i = 0; i < document.getElementsByClassName("err").length; i++) {
            document.getElementsByClassName("err")[i].innerHTML = '';
        }

        // Form fields
        var name = document.getElementById("name");
        var email = document.getElementById("email");
        var text = document.getElementById("text");


        var nameRegex = /^[a-zA-Z' '-]+$/;
        var emailRegex = /\S+@\S+\.\S+/;
        // Client-side form validation
        if(name.value.length === 0) {
            nameErr.innerHTML = "Введите имя<br/>";
            return false;
        }
        if( !nameRegex.test(name.value) ) {
            nameErr.innerHTML = "ФИО, только буквы, пробелы и '-', минимум три слова<br/>";
            return false;
        }
        if(name.value.split(" ").length < 3) {
            nameErr.innerHTML = "Минимум три слова<br/>";
            return false;
        }
        if(name.value.length > 50) {
            nameErr.innerHTML = "50 символов максимум<br/>";
            return false;
        }
        if(email.value.length === 0) {
            emailErr.innerHTML = "Введите email<br/>";
            return false;
        }
        if( !emailRegex.test(email.value) ) {
            emailErr.innerHTML = "*abc@de.com<br/>";
            return false;
        }
        if(email.value.length > 50) {
            emailErr.innerHTML = "50 символов максимум<br/>";
            return false;
        }
        if(text.value.length === 0) {
            textErr.innerHTML = "Напишите что-нибудь<br/>";
            return false;
        }
        if(text.value.length > 200) {
            textErr.innerHTML = "200 символов максимум<br/>";
            return false;
        }

        errors = 0;
    }

    function submitForm() {
        // Form fields
        var name = document.getElementById("name");
        var email = document.getElementById("email");
        var text = document.getElementById("text");
        if(errors == 0) {
            // Ajax
            var ajax = new XMLHttpRequest();
            ajax.open("POST", "ajax.php", true);
            ajax.setRequestHeader("Content-type","application/x-www-form-urlencoded");
            ajax.send("name=" + name.value + "&email=" + email.value + "&text=" + text.value);
            ajax.onreadystatechange=function()
            {
                if (ajax.readyState==4 && ajax.status==200)
                {
                    if(ajax.responseText) {
                        document.getElementById("alert").innerHTML = "Post created";
                    }
                }
            }
            return false;
        }
        else {
            return false;
        }
    }
</script>

</body>
</html>