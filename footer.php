<script src="./assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="./assets/js/script.js"></script>
</body>

</html>

<?php

global $con;

if (function_exists('close_con')) :
    close_con($con);
endif;

session_abort();
?>