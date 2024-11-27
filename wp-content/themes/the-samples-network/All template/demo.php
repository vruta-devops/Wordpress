<?php
// Template Name: Demo


$xmlUrl = "https://www.rakuten.com/feed/offer-feed.xml";

// Use file_get_contents to fetch the XML content
$xmlContent = file_get_contents($xmlUrl);

// Load the XML content into a SimpleXMLElement object
$xmlObject = simplexml_load_string(trim($xmlContent));


foreach ($xmlObject->channel->item as $item) {
    $title = (string) $item->title;
    $link = (string) $item->link;
    $description = (string) $item->description;

    echo '<div class="coupon-item">';
    echo '<h3><a href="' . esc_url($link) . '" target="_blank">' . esc_html($title) . '</a></h3>';
    echo '<div class="coupon-description">' . wp_kses_post($description) . '</div>';
    echo '</div>';
}
?>