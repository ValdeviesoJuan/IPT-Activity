<!-- ======= Sidebar ======= -->
<aside id="sidebar" class="sidebar" style="background-color: #2c2c2c; color: #fff;">

  <ul class="sidebar-nav" id="sidebar-nav">

    <li class="nav-item">
      <a class="nav-link collapsed" href="index.php" id="dashboard" style="background-color: #2c2c2c; color: #fff;">
        <i class="ri-dashboard-fill icon-link" id="dashIcon"></i>
        <span>Dashboard</span>
      </a>
    </li><!-- End Dashboard Nav -->

    <li class="nav-item">
      <a class="nav-link collapsed" href="manageComics.php" id="manageComics" style="background-color: #2c2c2c; color: #fff;">
        <i class="ri-book-3-fill icon-link" id="comicsIcon"></i>
        <span>Manage Comics</span>
      </a>
    </li><!-- End Blank Page Nav -->

    <li class="nav-item">
      <a class="nav-link collapsed" href="manageUsers.php" id="manageUsers" style="background-color: #2c2c2c; color: #fff;">
        <i class="ri-group-fill icon-link" id="usersIcon"></i>
        <span>Manage Users</span>
      </a>
    </li><!-- End Blank Page Nav -->

    <li class="nav-item">
      <a class="nav-link collapsed" href="reviewsReports.php" id="reviewsReports" style="background-color: #2c2c2c; color: #fff;">
        <i class="ri-disqus-fill icon-link" id="reviewsIcon"></i>
        <span>Reviews & Reports</span>
      </a>
    </li><!-- End Blank Page Nav -->

    <li class="nav-item">
      <a class="nav-link collapsed" href="announcements.php" id="announcements" style="background-color: #2c2c2c; color: #fff;">
        <i class="ri-megaphone-fill icon-link" id="announcementsIcon"></i>
        <span>Announcements</span>
      </a>
    </li><!-- End Blank Page Nav -->

    <li class="nav-item">
      <a class="nav-link collapsed" href="settings.php" id="settings" style="background-color: #2c2c2c; color: #fff;">
        <i class="ri-settings-3-fill icon-link" id="settingsIcon"></i>
        <span>Settings</span>
      </a>
    </li><!-- End Blank Page Nav -->

    <li class="nav-heading">ComicZone</li> 

    <li class="nav-item">
      <a class="nav-link collapsed" href="aboutUs.php" id="aboutUs" style="background-color: #2c2c2c; color: #fff;">
        <i class="ri-team-fill icon-link" id="aboutUsIcon"></i>
        <span>About Us</span>
      </a>
    </li><!-- End Blank Page Nav -->

    <li class="nav-item">
      <a class="nav-link collapsed" href="contact.php" id="contact" style="background-color: #2c2c2c; color: #fff;">
        <i class="ri-global-fill icon-link" id="contactIcon"></i>
        <span>Contact</span>
      </a>
    </li><!-- End Blank Page Nav -->

  </ul>

</aside><!-- End Sidebar-->

<main id="main" class="main">

<script>
document.addEventListener("DOMContentLoaded", function () {
    // Get the current page filename (e.g., "manageComics.html")
    let currentPage = window.location.pathname.split("/").pop();
    
    // Get all sidebar nav links
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
      background-color:rgb(255, 217, 0) !important; /* Change to your theme color */
      color: #fff !important;
      font-weight: bold;
  }
</style>