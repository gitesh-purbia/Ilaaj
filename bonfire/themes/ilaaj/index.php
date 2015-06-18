<?php
echo theme_view('partials/_header');
echo theme_view('partials/topbar');
echo theme_view('partials/sitenav');

echo isset($content) ? $content : Template::yield();
echo theme_view('partials/_footer'); 
?>