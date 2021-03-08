<?php
session_start();
session_destroy();
echo ("<script>");
echo ("window.top.location.href='index.php?index.php?tab=4';");
echo ("</script>");