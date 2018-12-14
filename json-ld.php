<?php
// JSON-LD for Wordpress Home Articles and Author Pages written by Pete Wailes and Richard Baxter
function get_post_data() {
  global $post;
  return $post;
}

// stuff for any page
$payload["@context"] = "http://schema.org/";

// $payload["@type"] = "Organization";
// $payload["AggregateRating"] = array(  
//   "@type" => "AggregateRating",
//   "bestRating" => "10",
//   "worstRating" => "1", 
//   "ratingValue" => "8.6", 
//   "reviewCount" => "539",
// );

// this has all the data of the post/page etc
$post_data = get_post_data();

// stuff for any page, if it exists
$category = get_the_category();

//modified data
$mod_data = get_the_modified_time("c");

// stuff for specific pages
if (is_single()) {
  // this gets the data for the user who wrote that particular item
  $author_data = get_userdata($post_data->post_author);
  $post_url = get_permalink();
  $post_thumb = wp_get_attachment_url(get_post_thumbnail_id($post->ID));

  $payload["@type"] = "Article";
  $payload["url"] = $post_url;
  $payload["author"] = array(
      "@type" => "Person",
      "name" => $author_data->display_name,
      );
  $payload["headline"] = $post_data->post_title;
  $payload["datePublished"] = $post_data->post_date;
  $payload["dateModified"] = $mod_data;
  $payload["image"] = $post_thumb;
  $payload["ArticleSection"] = $category[0]->cat_name;
  $payload["Publisher"] = array (
      "@type" => "Organization",
     "name" => "MB - Bedrijfskundig Marketing Advies",
     );
  $payload["mainEntityOfPage"] = array(
    "@type" => "Webpage",
    "@id" => $post_url,
    );
}

// we do all this separately so we keep the right things for organization together

if (is_front_page()) {
  $payload["@type"] = "Organization";
  $payload["name"] = "MB - Bedrijfskundig Marketing Advies";
  $payload["logo"] = "http://www.mbbedrijfskundigmarketingadvies.nl/wp-content/themes/mbbma/library/images/mb-logo-mobile.png";
  $payload["url"] = "http://www.mbbedrijfskundigmarketingadvies.nl/";
  $payload["sameAs"] = array(
    "https://www.facebook.com/mbbedrijfskundigmarketingadvies",
    "https://www.linkedin.com/company/mb---bedrijfskundig-marketing-advies",
    "https://plus.google.com/112681938717547670066/posts"
  );
  $payload["contactPoint"] = array(
    array(
      "@type" => "ContactPoint",
      "telephone" => "+31 345 74 54 05",
      "email" => "info@mbbedrijfskundigmarketingadvies.nl",
      "contactType" => "sales"
    )
  );
}

if (is_author()) {
  // this gets the data for the user who wrote that particular item
  $author_data = get_userdata($post_data->post_author);

  // some of you may not have all of these data points in your user profiles - delete as appropriate
  // fetch twitter from author meta and concatenate with full twitter URL
  $twitter_url =  " https://twitter.com/";
  $twitterHandle = get_the_author_meta('twitter');
  $twitterHandleURL = $twitter_url . $twitterHandle;

  $websiteHandle = get_the_author_meta('url');

  $facebookHandle = get_the_author_meta('facebook');

  $gplusHandle = get_the_author_meta('googleplus');

  $linkedinHandle = get_the_author_meta('linkedin');

  $slideshareHandle = get_the_author_meta('slideshare');

  $payload["@type"] = "Person";
  $payload["name"] = $author_data->display_name;
  $payload["email"] = $author_data->user_email;
  $payload["sameAs"] =  array(
    $twitterHandleURL, $websiteHandle, $facebookHandle, $gplusHandle, $linkedinHandle, $slideshareHandle

      );
  
}
?>