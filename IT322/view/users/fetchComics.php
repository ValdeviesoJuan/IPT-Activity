<?php
include("../../dB/config.php");

$query = isset($_GET['query']) ? trim($_GET['query']) : "";
$comics = [];

if (!empty($query)) {
    $stmt = $conn->prepare("
        SELECT c.comicId, c.title, c.cover, c.url, c.publicationStatus, c.contentRating, c.synopsis,
                GROUP_CONCAT(DISTINCT g.genre ORDER BY g.genre ASC) AS genres,
                GROUP_CONCAT(DISTINCT t.theme ORDER BY t.theme ASC) AS themes
        FROM comics c
        LEFT JOIN comicgenre cg ON c.comicId = cg.comicId
        LEFT JOIN genres g ON cg.genreId = g.genreId
        LEFT JOIN comictheme ct ON c.comicId = ct.comicId
        LEFT JOIN themes t ON ct.themeId = t.themeId
        WHERE c.title LIKE CONCAT('%', ?, '%')
        GROUP BY c.comicId
        ORDER BY c.comicId DESC 
        LIMIT 10
    ");
    $stmt->bind_param("s", $query);
    $stmt->execute();
    $result = $stmt->get_result();

    while ($row = $result->fetch_assoc()) {
        $row['position'] = stripos($row['title'], $query);
        
        $row['genres'] = explode(',', $row['genres']);
        $row['themes'] = explode(',', $row['themes']);
        $comics[] = $row;
    }

    usort($comics, function ($a, $b) {
        return $a['position'] <=> $b['position'];
    });
}

header('Content-Type: application/json');
echo json_encode($comics);
?>
