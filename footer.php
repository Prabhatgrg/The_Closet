</body>

</html>

<?php

global $con;

if (function_exists('close_con')) :
    close_con($con);
endif;

session_abort();
?>