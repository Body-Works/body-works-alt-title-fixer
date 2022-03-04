<?php

const SQL_ALL_PRODUCTS = '
SELECT ID,
        post_title,
       `wp_postmeta`.meta_value AS model
FROM `wp_posts`
LEFT JOIN `wp_postmeta` ON ID = `wp_postmeta`.`post_id`
WHERE `wp_posts`.post_type = "product"
    AND `wp_posts`.post_status = "publish"
    AND `wp_postmeta`.`meta_key` = "model";
';

const SQL_GET_META = '
SELECT *
FROM `wp_postmeta`
WHERE `wp_postmeta`.`post_id` = ?
    AND `wp_postmeta`.meta_key IN ("_product_image_gallery",
                                 "_thumbnail_id")
    ORDER BY `wp_postmeta`.meta_key ASC;
';

const SQL_COUNT_ALL_PRODUCTS = '
SELECT COUNT(*) as count
FROM `wp_posts`
WHERE `wp_posts`.post_type = "product"
  AND `wp_posts`.post_status = "publish"
';
