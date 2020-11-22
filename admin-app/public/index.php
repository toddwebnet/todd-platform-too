<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="Content-Security-Policy" content="upgrade-insecure-requests">
    <script
            src="https://code.jquery.com/jquery-3.5.1.min.js"
            integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0="
            crossorigin="anonymous"></script>
    <script>
        $(document).ready(function () {
            token = getCookie('token');
            alert(token);
            if (token !== '') {
                loadUserPanel(token);
            }
        });

        function getCookie(cname) {
            var name = cname + "=";
            var decodedCookie = decodeURIComponent(document.cookie);
            var ca = decodedCookie.split(';');
            for (var i = 0; i < ca.length; i++) {
                var c = ca[i];
                while (c.charAt(0) == ' ') {
                    c = c.substring(1);
                }
                if (c.indexOf(name) == 0) {
                    return c.substring(name.length, c.length);
                }
            }
            return "";
        }

        function loadUserPanel(token) {
            $.ajax({
                url: 'http://session.tpt.com/get',
                dataType: "json",
                beforeSend: function(xhr){
                    xhr.setRequestHeader('token', token);
                },
                success: function(data){
                    if(data.admin){
                        console.log(data.admin);
                        $('#first_name').html(data.admin.person.first_name);
                        $('#last_name').text(data.admin.person.last_name);
                    }

                }

            });
        }


    </script>
</head>

<body>


<div style="background-color: red">
    <span style="float:right">
        <b>Welcome: </b> <span id="first_name"></span> <span id="last_name"></span>
    </span>

</div>
<?php
print "<pre>";
print_r($_GET);
print_r($_POST);
print "</pre>";

?>
<form action="http://login.tpt.com" method="get">

    <input type="text"
           name="redirect"
           value="http://admin.tpt.com"
    />
    <input type="submit" value="Submit"/>

</form>
</body>
</html>