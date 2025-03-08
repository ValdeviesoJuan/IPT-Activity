  <!-- ======= Sidebar ======= -->
  <aside id="sidebar" class="sidebar">

    <ul class="sidebar-nav" id="sidebar-nav">

      <li class="nav-item">
        <a class="nav-link" href="index.php" id="dashboard">
          <i class="ri-dashboard-fill"></i>
          <span>Dashboard</span>
        </a>
      </li><!-- End Dashboard Nav -->

      <li class="nav-item">
        <a class="nav-link collapsed" href="manageComics.php" id="manageComics">
          <i class="ri-book-3-fill"></i>
          <span>Manage Comics</span>
        </a>
      </li><!-- End Blank Page Nav -->

      <li class="nav-item">
        <a class="nav-link collapsed" href="manageUsers.php" id="manageUsers">
          <i class="ri-group-fill"></i>
          <span>Manage Users</span>
        </a>
      </li><!-- End Blank Page Nav -->

      <li class="nav-item">
        <a class="nav-link collapsed" href="reviewsReports.php" id="reviewsReports">
          <i class="ri-disqus-fill"></i>
          <span>Reviews & Reports</span>
        </a>
      </li><!-- End Blank Page Nav -->

      <li class="nav-item">
        <a class="nav-link collapsed" href="announcements.php" id="announcements">
          <i class="ri-megaphone-fill"></i>
          <span>Announcements</span>
        </a>
      </li><!-- End Blank Page Nav -->

      <li class="nav-item">
        <a class="nav-link collapsed" href="settings.php" id="settings">
          <i class="ri-settings-3-fill"></i>
          <span>Settings</span>
        </a>
      </li><!-- End Blank Page Nav -->

      <li class="nav-heading">ComicZone</li> 

      <li class="nav-item">
        <a class="nav-link collapsed" href="aboutUs.php" id="aboutUs">
          <i class="ri-team-fill"></i>
          <span>About Us</span>
        </a>
      </li><!-- End Blank Page Nav -->

      <li class="nav-item">
        <a class="nav-link collapsed" href="contact.php" id="contact">
          <i class="ri-global-fill"></i>
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
      
      // Get all sidebar links
      let navLinks = document.querySelectorAll(".sidebar-nav .nav-link");

      // Loop through links and compare with current page
      navLinks.forEach(link => {
          if (link.getAttribute("href") === currentPage) {
              link.classList.add("active");
          }
      });
  });
</script>

<style>
  /* Active link styling */
  .nav-link.active {
      background-color: #007bff !important; /* Change to your theme color */
      color: #fff !important;
      font-weight: bold;
  }
</style>