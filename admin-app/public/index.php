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
