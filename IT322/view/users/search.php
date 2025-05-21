<?php
include("../../dB/config.php");

// Get search parameters from AJAX request
$search = $_POST['search'] ?? '';
$sortBy = $_POST['sortBy'] ?? '';
$genres = $_POST['genres'] ?? [];
$themes = $_POST['themes'] ?? [];
$contentRating = $_POST['contentRating'] ?? '';
$publicationYear = $_POST['publicationYear'] ?? '';
$publicationStatus = $_POST['publicationStatus'] ?? '';
$author = $_POST['author'] ?? '';
$artist = $_POST['artist'] ?? '';

$query = "SELECT c.comicId, c.title, au.authorName, ar.artistName, c.synopsis, c.cover, c.url, 
                 c.publicationDate, c.publicationStatus, c.contentRating,
                 GROUP_CONCAT(DISTINCT g.genre ORDER BY g.genre ASC) AS genres,
                 GROUP_CONCAT(DISTINCT t.theme ORDER BY t.theme ASC) AS themes
          FROM comics c
          LEFT JOIN comicgenre cg ON c.comicId = cg.comicId
          LEFT JOIN genres g ON cg.genreId = g.genreId
          LEFT JOIN comictheme ct ON c.comicId = ct.comicId
          LEFT JOIN themes t ON ct.themeId = t.themeId
          LEFT JOIN comicauthor cau ON c.comicId = cau.comicId
          LEFT JOIN authors au ON cau.authorId = au.authorId
          LEFT JOIN comicartist car ON c.comicId = car.comicId
          LEFT JOIN artists ar ON car.artistId = ar.artistId
          WHERE 1";

if (!empty($search)) {
    $query .= " AND c.title LIKE '%$search%'";
}
if (!empty($contentRating)) {
    $query .= " AND c.contentRating = '$contentRating'";
}
if (!empty($publicationYear)) {
    $query .= " AND c.publicationDate LIKE '$publicationYear%'";
}
if (!empty($publicationStatus)) {
    $query .= " AND c.publicationStatus = '$publicationStatus'";
}
if (!empty($author)) {
    $query .= " AND au.authorName LIKE '%$author%'";
}
if (!empty($artist)) {
    $query .= " AND ar.artistName LIKE '%$artist%'";
}

if (!empty($genres)) {
    $genrePlaceholders = "'" . implode("','", $genres) . "'";
    $query .= " AND g.genre IN ($genrePlaceholders)";
}

if (!empty($themes)) {
    $themePlaceholders = "'" . implode("','", $themes) . "'";
    $query .= " AND t.theme IN ($themePlaceholders)";
}

$sortOptions = [
    "Latest Upload" => "ORDER BY c.publicationDate DESC",
    "Oldest Upload" => "ORDER BY c.publicationDate ASC",
    "Title Ascending" => "ORDER BY c.title ASC",
    "Title Descending" => "ORDER BY c.title DESC",
    "Recently Added" => "ORDER BY c.comicId DESC",
    "Oldest Added" => "ORDER BY c.comicId ASC",
    "Year Ascending" => "ORDER BY c.publicationDate ASC",
    "Year Descending" => "ORDER BY c.publicationDate DESC"
];

$query .= " GROUP BY c.comicId";

if (!empty($sortBy) && isset($sortOptions[$sortBy])) {
    $query .= " " . $sortOptions[$sortBy];
} else {
    $query .= " ORDER BY c.comicId DESC"; // Default sorting
}

$query .= " LIMIT 10"; // Limit results

$result = mysqli_query($conn, $query);
$count = 0;
$response = "<div class='manga-results'>";

while ($row = mysqli_fetch_assoc($result)) {
    if ($count % 2 == 0) {
        $response .= "<div class='manga-row'>";  
    }

    $status_color = match ($row['publicationStatus']) {
        'Ongoing' => '#04d000',
        'Hiatus' => 'yellow',
        'Completed' => '#00c9f5',
        'Cancelled' => 'red',
        default => 'gray'
    };

    $rating_color = match ($row['contentRating']) {
        'Safe' => '#f8f9fa',
        'Suggestive' => 'orange',
        'Erotica' => 'red',
        default => '#ccc'
    };

    $genresArray = explode(',', $row['genres']);
    $themesArray = explode(',', $row['themes']);

    // Append HTML structure
    $response .= "
    <div class='manga-card'>
        <a href='{$row['url']}' target='_blank'>
            <img src='../../assets/{$row['cover']}' alt='Comic Cover' class='manga-cover'>
        </a>
        <div class='manga-details'>
            <h3>{$row['title']}</h3>
            <div class='status-box'>
                <span class='status-circle' style='background-color: $status_color;'></span>
                <span class='status-text'>{$row['publicationStatus']}</span>
            </div>
            <div class='info-row'>
                <span class='rating-box' style='background-color: $rating_color;'>{$row['contentRating']}</span>";

    foreach ($genresArray as $genre) {
        $response .= "<span class='genre'>$genre</span>";
    }
    foreach ($themesArray as $theme) {
        $response .= "<span class='theme'>$theme</span>";
    }

    $response .= "
            </div>
            <p class='synopsis'>{$row['synopsis']}</p>
        </div>
    </div>";

    $count++;

    if ($count % 2 == 0) {
        $response .= "</div>";
    }
}

// Ensure last row is closed if it contains only one item
if ($count % 2 == 1) {
    $response .= "</div>";
}

$response .= "</div>"; // Close manga-results

if ($count === 0) {
    echo "<div class='no-results-found'";
        echo "<p>No results found.</p>";
    echo "</div>";
} else {
    echo $response;
}
?>
