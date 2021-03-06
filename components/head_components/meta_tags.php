<?php
function getLabel($tag) {
    global $default_labels, $override_labels, $title;

    if (isset($override_labels) && isset($override_labels[$tag])) {
        return $override_labels[$tag];
    } else if (isset($title)) {
        return $title;
    } else {
        if (isset($default_labels[$tag]))
            return $default_labels[$tag];
        else
            return "Not set";
    }
}
?>

<title>
    <?php echo getLabel("title") ?>
</title>

<meta http-equiv="content-type" content="text/html; charset=utf-8" >
<meta http-equiv="content-style-type" content="text/css" >
<meta http-equiv="content-language" content="en" >
<meta name="viewport" content="width=device-width,initial-scale=1">
<meta name="robots" content="follow" >
<meta name="revisit-after" content="1 month" >
<meta name="distribution" content="global">
<meta name="author" content="Open Knowledge Maps" >
<meta name="publisher" content="Open Knowledge Maps" >
<meta name="keywords" content="knowldege visualization, open knowledge, open science" >

<!-- FAVICONS -->
<link rel="apple-touch-icon" sizes="180x180" href="/apple-touch-icon.png?v=xQz6nej7eR">
<link rel="icon" type="image/png" sizes="32x32" href="/favicon-32x32.png?v=xQz6nej7eR">
<link rel="icon" type="image/png" sizes="16x16" href="/favicon-16x16.png?v=xQz6nej7eR">
<link rel="manifest" href="/site.webmanifest?v=xQz6nej7eR">
<link rel="mask-icon" href="/safari-pinned-tab.svg?v=xQz6nej7eR" color="#263d54">
<link rel="shortcut icon" href="/favicon.ico?v=xQz6nej7eR">
<meta name="apple-mobile-web-app-title" content="OKMaps">
<meta name="application-name" content="OKMaps">
<meta name="msapplication-TileColor" content="#263d54">
<meta name="theme-color" content="#ffffff">

<meta name="description" content="<?php echo getLabel("description") ?>" >

<!-- TWITTER CARD -->

<meta name="twitter:card" content="<?php echo getLabel("twitter-type") ?>" />
<meta name="twitter:site" content="@OK_Maps" />
<meta name="twitter:title" content="<?php echo getLabel("title") ?>" />
<meta name="twitter:description" content="<?php echo getLabel("description") ?>" />
<meta name="twitter:image" content="<?php echo getLabel("twitter-image") ?>" />

<!-- OPEN GRAPH OG -->
<meta property="og:title" content="<?php echo getLabel("title") ?>"/>
<meta property="og:description" content="<?php echo getLabel("description") ?>"/>
<meta property="og:url" content="<?php echo getLabel("url") ?>"/>
<meta property="og:image" content="<?php echo getLabel("fb-image") ?>"/>
<meta property="og:type" content="website"/>
<meta property="og:site_name" content="<?php echo getLabel("app-name") ?>"/>
