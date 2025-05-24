<?php
include("../../dB/config.php");
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

$userId = $_SESSION['userId'] ?? null;

if ($userId !== null) {
    $stmt = $conn->prepare("
        SELECT id, comicId, message, createdAt, type, userId 
        FROM notifications 
        WHERE userId IS NULL OR userId = ?
        ORDER BY createdAt DESC 
        LIMIT 5
    ");
    $stmt->bind_param("i", $userId);
} else {
    $stmt = $conn->prepare("
        SELECT id, comicId, message, createdAt, type, userId 
        FROM notifications 
        WHERE userId IS NULL 
        ORDER BY createdAt DESC 
        LIMIT 5
    ");
}

$stmt->execute();
$result = $stmt->get_result();
$notificationCount = $result->num_rows;
?>

<!-- ======= Header ======= -->
<header id="header" class="header fixed-top d-flex align-items-center" style="background-color: #191a1c;">

  <div class="d-flex align-items-center justify-content-between">
    <a href="index.php" class="logo d-flex align-items-center">
      <img src="../../assets/img/Logo1.png" alt="ComicZone Logo" style="max-width: 100px; max-height: 80px;">
      <span class="d-none d-lg-block" style="color: white; margin-left: -20px;">ComicZone</span>
    </a>
    <i class="bi bi-list toggle-sidebar-btn" style="color: white;"></i>
  </div><!-- End Logo -->

  <div class="search-bar position-relative">
    <form class="search-form d-flex align-items-center" method="GET" action="../comicSearch.php">
      <input type="text" class="main-search-input" id="main-search-input" name="query" placeholder="Search" autocomplete="off" title="Enter search keyword">
      <button type="submit" title="Search"><i class="bi bi-search" style="color: white;"></i></button>
    </form>
    <div id="search-results" class="search-dropdown"></div> <!-- Dropdown for results -->
  </div><!-- End Search Bar -->

  <nav class="header-nav ms-auto">
    <ul class="d-flex align-items-center">

      <li class="nav-item d-block d-lg-none">
        <a class="nav-link nav-icon search-bar-toggle " href="#">
          <i class="bi bi-search"></i>
        </a>
      </li><!-- End Search Icon-->

      <li class="nav-item dropdown">
        <a class="nav-link nav-icon" href="#" data-bs-toggle="dropdown" aria-label="View Notifications">
          <i class="bi bi-bell" style="color: white;"></i>
          <span class="badge bg-primary badge-number" id="notificationCount">0</span>
        </a>

        <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow notifications">
          <li class="dropdown-header" id="notificationHeader">
            You have 0 new notification<span id="notificationPlural">s</span>
            <a href="#"><span class="badge rounded-pill bg-primary p-2 ms-2">View all</span></a>
          </li>
          <li><hr class="dropdown-divider"></li>

          <li>
            <ul id="notificationList" class="list-unstyled mb-0">
              <!-- JS will append <li> notification items here -->
            </ul>
          </li>

          <li class="dropdown-footer">
            <a href="#">Show all notifications</a>
          </li>
        </ul>
      </li>

      <li class="nav-item dropdown pe-3">

        <a class="nav-link nav-profile d-flex align-items-center pe-0" href="#" data-bs-toggle="dropdown">
          <img src="<?php echo !empty($_SESSION['authUser']['profilePicture']) ? $_SESSION['authUser']['profilePicture'] : '../../assets/img/profileImage.png'; ?>" 
          alt="<?php echo htmlspecialchars($fullName); ?>'s Profile Picture"
          class="rounded-circle me-2"
          style="width: 35px; height: 35px; object-fit: cover; border: solid 1px white"
          >
          <span class="d-none d-md-block dropdown-toggle ps-2" style="color: white;"><?php echo htmlspecialchars($fullName); ?></span>
        </a><!-- End Profile Iamge Icon -->

        <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow profile">
          <li class="dropdown-header">
            <h6><?php echo htmlspecialchars($fullName); ?></h6>
            <span><?php echo htmlspecialchars($role); ?></span>
          </li>
          <li>
            <hr class="dropdown-divider">
          </li>

          <li>
            <a class="dropdown-item d-flex align-items-center" href="../userProfile.php">
              <i class="bi bi-person"></i>
              <span>My Profile</span>
            </a>
          </li>
          <li>
            <hr class="dropdown-divider">
          </li>

          <li>
            <a class="dropdown-item d-flex align-items-center" href="../../controller/logout.php">
              <i class="bi bi-box-arrow-right"></i>
              <span>Sign Out</span>
            </a>
          </li>

        </ul>
      </li>

    </ul>
  </nav>

  <style>
    .search-bar .search-form .main-search-input{
      color: white; 
      font-size: 16px; 
      font-weight: bold; 
      background-color: #2c2c2c;
      width: 280px;
      transition: width 0.2s ease-out;
    }
    .search-bar .search-form .main-search-input:focus {
      width: 700px;
      border: 1px solid #ffd700;
    }
    .search-dropdown {
      position: absolute;
      background-color: #2c2c2c;
      color: white;
      width: 100%;
      max-height: 200px;
      overflow-y: auto;
      display: none;
      border-radius: 5px;
      z-index: 1000;
    }
    .search-dropdown a {
      display: block;
      padding: 8px;
      color: white;
      text-decoration: none;
    }
    .search-dropdown a:hover {
      background-color: #444;
    }
  </style>

  <script>
    document.addEventListener("DOMContentLoaded", function() {
      const searchInput = document.getElementById("main-search-input");
      const searchResults = document.getElementById("search-results");

      searchInput.addEventListener("keyup", function(event) {
        let query = this.value.trim();

        if (query.length > 0) {
          fetch("searchComics.php?q=" + encodeURIComponent(query))
            .then(response => response.json())
            .then(data => {
              searchResults.innerHTML = "";
              if (data.length > 0) {
                searchResults.style.display = "block";
                data.forEach(comic => {
                  let item = document.createElement("a");
                  item.href = comic.url;
                  item.target = "_blank";
                  item.textContent = comic.title;
                  item.style.color = "#ffeb3b";
                  item.style.width = "100%";
                  searchResults.appendChild(item);
                });
              } else {
                let noResults = document.createElement("div");
                noResults.textContent = "No matching results";
                noResults.style.padding = "8px";
                noResults.style.color = "#ffeb3b";
                noResults.style.textAlign = "center";
                searchResults.appendChild(noResults);
              }
            });
        } else {
          searchResults.style.display = "none";
        }
      });

      // Handle pressing Enter to go to search results page
      searchInput.addEventListener("keypress", function(event) {
        if (event.key === "Enter") {
          event.preventDefault();
          window.location.href = "comicSearch.php?query=" + encodeURIComponent(searchInput.value);
        }
      });

      // Hide results when clicking outside
      document.addEventListener("click", function(event) {
        if (!searchInput.contains(event.target) && !searchResults.contains(event.target)) {
          searchResults.style.display = "none";
        }
      });
    });
  </script>

  <script>
  document.addEventListener("DOMContentLoaded", function () {
    fetch('/IPT-Activity/IT322/view/admin/get_notifications.php')

      .then(res => res.json())
      .then(data => {
        console.log("Notification data:", data); // Debugging

        const count = data.count || 0;
        const list = data.notifications || [];

        document.getElementById("notificationCount").textContent = count;
        document.getElementById("notificationHeader").innerHTML = `
          You have ${count} new notification${count !== 1 ? 's' : ''}
          <a href="#"><span class="badge rounded-pill bg-primary p-2 ms-2">View all</span></a>
        `;

        const container = document.getElementById("notificationList");
        container.innerHTML = "";

        if (list.length === 0) {
          container.innerHTML = `<li class="notification-item text-center p-2">No notifications</li>`;
          return;
        }

        list.forEach(item => {
          const li = document.createElement("li");
          li.className = "notification-item";
          li.innerHTML = `
            <div>
              <h4>${item.type.replace("_", " ").toUpperCase()}</h4>
              <p>${item.message}</p>
              <p class="small text-muted">${new Date(item.createdAt).toLocaleString()}</p>
            </div>
          `;
          container.appendChild(li);

          const divider = document.createElement("li");
          divider.innerHTML = '<hr class="dropdown-divider">';
          container.appendChild(divider);
        });
      })
      .catch(err => {
        console.error("Failed to load notifications:", err);
      });
  });

  function renderNotifications(notifications) {
  const notificationCount = notifications.length;
  const countBadge = document.getElementById("notificationCount");
  const header = document.getElementById("notificationHeader");
  const plural = document.getElementById("notificationPlural");
  const list = document.getElementById("notificationList");

  countBadge.textContent = notificationCount;
  plural.textContent = notificationCount !== 1 ? "s" : "";
  header.innerHTML = `You have ${notificationCount} new notification${notificationCount !== 1 ? "s" : ""} 
    <a href="#"><span class="badge rounded-pill bg-primary p-2 ms-2">View all</span></a>`;

  list.innerHTML = ""; // clear existing notifications

  if (notificationCount === 0) {
    list.innerHTML = "<li class='text-center text-muted'>No notifications</li>";
    return;
  }

  notifications.forEach(notif => {
    const li = document.createElement("li");
    li.classList.add("notification-item", "px-3", "py-2");
    li.innerHTML = `
      <div><strong>${notif.message}</strong></div>
      <small class="text-muted">${new Date(notif.createdAt).toLocaleString()}</small>
    `;
    list.appendChild(li);
  });
}
  </script>


</header><!-- End Header -->