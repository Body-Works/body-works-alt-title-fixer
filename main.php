<?php
require __DIR__ . "/vendor/autoload.php";
require __DIR__ . "/inc/helpers.php";
require __DIR__ . "/inc/sql.php";
require __DIR__ . "/inc/data.php";

if (file_exists("./.env")) {
    $dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
    $dotenv->load();
} else {
    nice_die("Dude! .env file required");
}

// Connect to db
$dsn = "mysql:host={$_ENV['DB_HOST']};dbname={$_ENV['DB_NAME']};charset=utf8";
$options = [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES   => false,
];

try {
    $pdo = new PDO($dsn, $_ENV['DB_USER'], $_ENV['DB_PASSWORD'], $options);
} catch (\PDOException $e) {
    nice_die($e->getMessage() . " " . (int)$e->getCode());
}

// OK. let's do the job...


// Count
$count = $pdo->query(SQL_COUNT_ALL_PRODUCTS)->fetchColumn();
nice_echo("We have {$count} products to work with.");

// Main loop
$stmt = $pdo->query(SQL_ALL_PRODUCTS);
$metaStmt = $pdo->prepare(SQL_GET_META);

while ($row = $stmt->fetch())
{
    nice_separator();
    nice_echo("Working on: {$row['post_title']} ({$row['model']})");
    $metaStmt->execute([$row["ID"]]);
    $meta = $metaStmt->fetchAll();

    /**
     * Product gallery
     */
    
    /** @var mixed $productGallery */
    $productGallery = $meta[0]["meta_value"];

    if (!empty($productGallery)) {
        $productGallery = explode(",", $productGallery);
    } else {
        nice_echo("There's no product gallery", "⛔");
    }

    /**
     * Product thumb
     */
    /** @var mixed $productThumb */
    $productThumb = $meta[1]["meta_value"];

    if (!empty($productThumb)) {
        
    } else {
        nice_echo("There's no product thumb", "🎃");
    }
} 