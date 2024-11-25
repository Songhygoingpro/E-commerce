<?php

session_start();
// require_once '../config/database.php';

ob_start();
?>
        <section class="products py-10 px-16 flex flex-col gap-6 bg-[#E0E0E0] h-full w-full">
       hello world
    </section>
    <?php
// Capture the page content
$content = ob_get_clean();

// Include the main layout
include '../layouts/admin.php';
