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

const SQL_UPDATE_IMG_TITLE = '
UPDATE `wp_posts`
SET `post_title` = ?
WHERE `wp_posts`.`ID` = ?;
';

const SQL_UPDATE_IMG_ALT = '
UPDATE `wp_postmeta`
SET `meta_value` = ?
WHERE `wp_postmeta`.`post_id` = ?
  AND `meta_key` = "_wp_attachment_image_alt";
';

const SQL_INSERT_IMG_ALT = '
INSERT INTO `wp_postmeta` (`post_id`, `meta_key`, `meta_value`)
VALUES (?, "_wp_attachment_image_alt", ?);
';

const SQL_CHECK_IMG_ALT = '
SELECT COUNT(*) as count
FROM `wp_postmeta`
WHERE `wp_postmeta`.`post_id` = ?
  AND `meta_key` = "_wp_attachment_image_alt";
';