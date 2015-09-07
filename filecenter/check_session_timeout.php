<?php
if (empty($_SESSION['person'])) {
    //header("Location: http://localhost/van/frontend/index.php?page=login");
    echo "<script>";
    echo " setTimeout(function(){alert('หมดเวลาการเชื่อมต่อ กรุณา เข้าระบบใหม่อีกครั้ง');";
    echo " window.location = 'http://localhost/van/frontend/index.php?page=login'},1000)";
    echo "</script>";
    exit(0);
}

