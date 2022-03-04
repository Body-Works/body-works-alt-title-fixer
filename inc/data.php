<?php

function update_title(&$pdo, $id, $title) {
    $stmt = $pdo->prepare(SQL_UPDATE_IMG_TITLE);
    $stmt->bindParam(1, $title, PDO::PARAM_STR);
    $stmt->bindParam(2, $id, PDO::PARAM_INT);
    return $stmt->execute();
}

function update_alt(&$pdo, $id, $title) {
    $countStmt = $pdo->prepare(SQL_CHECK_IMG_ALT);
    $countStmt->execute([$id]);

    $hasAlt = $countStmt->fetchColumn() === 1 ? true : false;
    
    if ($hasAlt) {
        $updateStmt = $pdo->prepare(SQL_UPDATE_IMG_ALT);
        $updateStmt->bindParam(1, $id, PDO::PARAM_INT);
        $updateStmt->bindParam(2, $title, PDO::PARAM_STR);
        return $updateStmt->execute();
    } else {
        $insertStmt = $pdo->prepare(SQL_INSERT_IMG_ALT);
        $insertStmt->bindParam(1, $id, PDO::PARAM_INT);
        $insertStmt->bindParam(2, $title, PDO::PARAM_STR);
        return $insertStmt->execute();
    }
}