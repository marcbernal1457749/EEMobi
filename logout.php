<?php
session_start();
session_unset();
session_destroy();
header("location:http://deic-projectes.uab.cat/EEmobi/");
?>