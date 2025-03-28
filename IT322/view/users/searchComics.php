<?php
include("../../dB/config.php");

if (isset($_GET['q'])) {
    $query = trim($_GET['q']);
    $stmt = $conn->prepare("
        SELECT c.comicId, c.title, c.cover, c.url, c.publicationStatus, c.contentRating,
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

    $comics = [];
    while ($row = $result->fetch_assoc()) {
        $row['position'] = stripos($row['title'], $query);
        $comics[] = $row;
    }

    usort($comics, function ($a, $b) {
        return $a['position'] <=> $b['position'];
    });

    echo json_encode($comics);
}
?>
