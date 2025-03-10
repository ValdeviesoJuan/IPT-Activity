<!-- ======= Sidebar ======= -->
<aside id="sidebar" class="sidebar" style="background-color: #2c2c2c;"> <!--#2c2c2c -->

  <ul class="sidebar-nav" id="sidebar-nav">

    <li class="nav-item">
      <a class="nav-link" href="index.php" id="home" style="background-color: #2c2c2c; color: #fff;">
        <i class="ri-home-8-fill icon-link" style="color: #fff;"></i>
        <span>Home</span>
      </a>
    </li>

    <li class="nav-item">
      <a class="nav-link collapsed" href="userSearch.php" id="advancedSearch" style="background-color: #2c2c2c; color: #fff;">
        <i class="ri-search-eye-fill icon-link" style="color: #fff;"></i>
        <span>Advanced Search</span>
      </a>
    </li><!-- End User Page Nav -->
    
    <li class="nav-item">
      <a class="nav-link collapsed" href="userLibrary.php" id="library" style="background-color: #2c2c2c; color: #fff;">
        <i class="ri-book-shelf-fill icon-link" style="color: #fff;"></i>
        <span>My Library</span>
      </a>
    </li><!-- End User Page Nav -->

    <li class="nav-item">
      <a class="nav-link collapsed" href="userProfile.php" id="profile" style="background-color: #2c2c2c; color: #fff;">
        <i class="ri-user-fill icon-link" style="color: #fff;"></i>
        <span>Profile</span>
      </a>
    </li><!-- End Blank Page Nav -->

    <li class="nav-item">
      <a class="nav-link collapsed" href="settings.php" id="settings" style="background-color: #2c2c2c; color: #fff;">
        <i class="ri-settings-3-fill icon-link" style="color: #fff;"></i>
        <span>Settings</span>
      </a>
    </li><!-- End Blank Page Nav -->

    <li class="nav-heading" style="color: #FFEB3B;">ComicZone</li>

    <li class="nav-item">
      <a class="nav-link collapsed" href="aboutUs.php" id="aboutUs" style="background-color: #2c2c2c; color: #fff;">
        <i class="ri-team-fill icon-link" style="color: #fff;"></i>
        <span>About Us</span>
      </a>
    </li><!-- End Blank Page Nav -->

    <li class="nav-item">
      <a class="nav-link collapsed" href="contact.php" id="contact" style="background-color: #2c2c2c; color: #fff;">
        <i class="ri-global-fill icon-link" style="color: #fff;"></i>
        <span>Contact</span>
      </a>
    </li><!-- End Blank Page Nav -->

  </ul>

</aside><!-- End Sidebar-->

<script>
document.addEventListener("DOMContentLoaded", function () {
    // Get the current page filename (e.g., "manageComics.html")
    let currentPage = window.location.pathname.split("/").pop();
    
    // Get all sidebar links
    let navLinks = document.querySelectorAll(".sidebar-nav .nav-link");

    // Loop through links and compare with current page
    navLinks.forEach(link => {
        if (link.getAttribute("href") === currentPage) {
            link.classList.add("active");

            let icon = link.querySelector(".icon-link");
            if (icon) {
                icon.style.color = "#fff";
            }
        }
    });
});
</script>

<style>
  /* Active link styling */
  .nav-link.active {
      background-color: rgb(255, 217, 0) !important; /* Change to your theme color */
      color: #fff !important;
      font-weight: bold;
  }
</style>

<main id="main" class="main" style="background-color: #1a1a1c; color: white;">