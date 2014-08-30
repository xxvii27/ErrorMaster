<?php
    shell_exec("cd .. && date >> log-deploy.out && git pull origin master >> log-deploy.out 2>&1 && echo '----------------------------\n' >> log-deploy.out");
?>
