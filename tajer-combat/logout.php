<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
session_unset(); // إزالة جميع المتغيرات من الجلسة
session_destroy(); // تدمير الجلسة
header("Location: sin.html"); // إعادة التوجيه إلى صفحة تسجيل الدخول
exit();
?>
