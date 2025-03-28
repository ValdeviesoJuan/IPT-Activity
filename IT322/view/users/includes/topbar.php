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

        <a class="nav-link nav-icon" href="#" data-bs-toggle="dropdown">
          <i class="bi bi-bell" style="color: white;"></i>
          <span class="badge bg-primary badge-number">4</span>
        </a><!-- End Notification Icon -->

        <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow notifications">
          <li class="dropdown-header">
            You have 4 new notifications
            <a href="#"><span class="badge rounded-pill bg-primary p-2 ms-2">View all</span></a>
          </li>
          <li>
            <hr class="dropdown-divider">
          </li>

          <li class="notification-item">
            <i class="bi bi-exclamation-circle text-warning"></i>
            <div>
              <h4>New Comic Release!</h4>
              <p>"The Dark Crusader" Issue #10 is out now!</p>
              <p>30 min. ago</p>
            </div>
          </li>

          <li>
            <hr class="dropdown-divider">
          </li>

          <li class="notification-item">
            <i class="bi bi-x-circle text-danger"></i>
            <div>
              <h4>Limited Edition Alert!</h4>
              <p>Only 5 copies left of "Galactic Warriors" signed edition!</p>
              <p>1 hr. ago</p>
            </div>
          </li>

          <li>
            <hr class="dropdown-divider">
          </li>

          <li class="notification-item">
            <i class="bi bi-check-circle text-success"></i>
            <div>
              <h4>Order Shipped!</h4>
              <p>Your order #45678 has been dispatched.</p>
              <p>2 hrs. ago</p>
            </div>
          </li>

          <li>
            <hr class="dropdown-divider">
          </li>

          <li class="notification-item">
            <i class="bi bi-info-circle text-primary"></i>
            <div>
              <h4>Comic Con Update</h4>
              <p>Meet the creators of "Neo City Chronicles" this Saturday!</p>
              <p>4 hrs. ago</p>
            </div>
          </li>

          <li>
            <hr class="dropdown-divider">
          </li>
          <li class="dropdown-footer">
            <a href="#">Show all notifications</a>
          </li>

        </ul><!-- End Notification Dropdown Items -->

      </li><!-- End Notification Nav -->

      <li class="nav-item dropdown">

        <a class="nav-link nav-icon" href="#" data-bs-toggle="dropdown" style="color: white;">
          <i class="bi bi-chat-left-text"></i>
          <span class="badge bg-success badge-number">3</span>
        </a><!-- End Messages Icon -->

        <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow messages">
          <li class="dropdown-header">
            You have 3 new messages
            <a href="#"><span class="badge rounded-pill bg-primary p-2 ms-2">View all</span></a>
          </li>
          <li>
            <hr class="dropdown-divider">
          </li>

          <li class="message-item">
            <a href="#">
              <img src="../../assets/img/kentImage.jpg" alt="" class="rounded-circle">
              <div>
                <h4>Kent "LiverLover" Vicente</h4>
                <p>Recommended a new and upcoming comic. Click Now!</p>
                <p>4 hrs. ago</p>
              </div>
            </a>
          </li>
          <li>
            <hr class="dropdown-divider">
          </li>

          <li class="message-item">
            <a href="#">
              <img src="../../assets/img/geloImage.jpg" alt="" class="rounded-circle">
              <div>
                <h4>Gelo "HaremBoii" Pagutayao</h4>
                <p>Recommended a new and upcoming comic. Click Now!</p>
                <p>6 hrs. ago</p>
              </div>
            </a>
          </li>
          <li>
            <hr class="dropdown-divider">
          </li>

          <li class="message-item">
            <a href="#">
              <img src="../../assets/img/shuaImage.jpg" alt="" class="rounded-circle">
              <div>
                <h4>Joshua "Bakuhatsu" Amper</h4>
                <p>Recommended a new and upcoming comic. Click Now!</p>
                <p>8 hrs. ago</p>
              </div>
            </a>
          </li>
          <li>
            <hr class="dropdown-divider">
          </li>

          <li class="dropdown-footer">
            <a href="#">Show all messages</a>
          </li>

        </ul><!-- End Messages Dropdown Items -->

      </li><!-- End Messages Nav -->

      <li class="nav-item dropdown pe-3">

        <a class="nav-link nav-profile d-flex align-items-center pe-0" href="#" data-bs-toggle="dropdown">
          <img src="../../assets/img/jcImage.jpg" alt="Profile" class="rounded-circle">
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
            <a class="dropdown-item d-flex align-items-center" href="users-profile.html">
              <i class="bi bi-person"></i>
              <span>My Profile</span>
            </a>
          </li>
          <li>
            <hr class="dropdown-divider">
          </li>

          <li>
            <a class="dropdown-item d-flex align-items-center" href="users-profile.html">
              <i class="bi bi-gear"></i>
              <span>Account Settings</span>
            </a>
          </li>
          <li>
            <hr class="dropdown-divider">
          </li>

          <li>
            <a class="dropdown-item d-flex align-items-center" href="pages-faq.html">
              <i class="bi bi-question-circle"></i>
              <span>Need Help?</span>
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

        </ul><!-- End Profile Dropdown Items -->
      </li><!-- End Profile Nav -->

    </ul>
  </nav><!-- End Icons Navigation -->

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

</header><!-- End Header -->