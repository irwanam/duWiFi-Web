function isLogged(handleData){
    var checkSession = "session_check=true";
    $.ajax({
        type: 'post',
        url: "app/Session.php",
        data: checkSession,
        success: function(data){
            //console.log(data);
            var session = $.parseJSON(data);
            handleData(session);
            }
    });
}

function memberLogin(data){
    var dataLogin= "session_login=true&email="+data.email+"&password="+data.password;
    //console.log(dataLogin);
    $.ajax({
        type: 'post',
        url: "app/Session.php",
        data: dataLogin,
        success: function(data){
            //console.log(data);
            var login = $.parseJSON(data);
            if(login.success==='true'){
                window.location.replace("dashboard.html");
            } else {
                $.Dialog({
                    shadow: true,
                    overlay: true,
                    icon: '<span class="icon-checkbox"></span>',
                    title: 'Gagal Masuk',
                    width: 200,
                    padding: 10,
                    content: '<p>Anda gagal untuk masuk ke duWiFi.<br/> Silahkan cek kembali email / password anda.</p>'
                });
                document.getElementById("frm_login").reset();
                
            }
        }
    });
}

function memberLogout(){
    var dataLogout= "session_logout=true";
    $.ajax({
        type: 'post',
        url: "app/Session.php",
        data: dataLogout,
        success: function(){
            window.location.replace("index.html");
        }
    });
}