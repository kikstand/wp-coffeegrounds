<?php

// =============================================================================
// FUNCTIONS.PHP
// -----------------------------------------------------------------------------
// Overwrite or add your own custom functions to X in this file.
// =============================================================================

// =============================================================================
// TABLE OF CONTENTS
// -----------------------------------------------------------------------------
//   01. Enqueue Parent Stylesheet
//   02. Additional Functions
// =============================================================================

// Enqueue Parent Stylesheet
// =============================================================================

add_filter('x_enqueue_parent_stylesheet', '__return_true');

add_filter('option_siteurl', 'set_siteurl');
add_filter('option_home', 'set_siteurl');

function set_siteurl()
{
    return 'http://' . $_SERVER['HTTP_HOST'];
}

// Additional Functions
// =============================================================================

add_action('wp_head', 'loadFonts', 10);

function loadFonts()
{
    echo "<script src='https://use.typekit.net/npj0wni.js'></script><script>try{Typekit.load({ async: true });}catch(e){}</script>";
}