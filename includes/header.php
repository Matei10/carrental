<header class="bg-white shadow">

  <!-- TOP BAR -->
  <div class="w-full bg-black text-gray-100 py-2">
    <div class="max-w-7xl mx-auto flex items-center justify-between px-4 text-sm">

      <!-- LOGO -->
      <a href="index.php" class="flex items-center">
        <img src="assets/images/logo.png" class="h-10" alt="Logo">
      </a>

      <!-- CONTACT INFO -->
      <div class="flex items-center gap-8">

        <?php
        $sql = "SELECT EmailId,ContactNo FROM tblcontactusinfo";
        $query = $dbh->prepare($sql);
        $query->execute();
        $results = $query->fetchAll(PDO::FETCH_OBJ);
        foreach ($results as $result) {
          $email = $result->EmailId;
          $contactno = $result->ContactNo;
        }
        ?>

        <!-- Email -->
        <div class="flex items-center gap-2">
          <i class="fa fa-envelope text-green-400"></i>
          <div>
            <p class="text-xs uppercase">Mail us</p>
            <a href="mailto:<?php echo htmlentities($email);?>" class="hover:text-green-300">
            Choolwelucky23@gmail.com
            </a>
          </div>
        </div>

        <!-- Phone -->
        <div class="flex items-center gap-2">
          <i class="fa fa-phone text-green-400"></i>
          <div>
            <p class="text-xs uppercase">Call us</p>
            <a href="tel:<?php echo htmlentities($contactno);?>" class="hover:text-green-300">
          +260770506812
            </a>
          </div>
        </div>

        <!-- LOGIN BUTTON -->
        <?php if(strlen($_SESSION['login'])==0) { ?>
          <a href="#loginform"
             class="bg-green-500 hover:bg-green-600 px-4 py-2 rounded text-white text-sm"
             data-toggle="modal" data-dismiss="modal">
            Login / Register
          </a>
        <?php } else { ?>
          <span class="text-green-300 font-semibold">Welcome to Car Rental Portal</span>
        <?php } ?>

      </div>
    </div>
  </div>



  <!-- NAVIGATION -->
  <nav class="bg-white border-t border-gray-200">
    <div class="max-w-7xl mx-auto px-4 py-3 flex items-center justify-between">

      <!-- MOBILE MENU BUTTON -->
      <button class="md:hidden text-gray-600 text-2xl"
              onclick="document.getElementById('mobileNav').classList.toggle('hidden')">
        <i class="fa fa-bars"></i>
      </button>

      <!-- LEFT NAV LINKS (DESKTOP) -->
      <ul class="hidden md:flex items-center gap-6 font-medium text-gray-700">
        <li><a href="index.php" class="hover:text-orange-500">Home</a></li>
        <li><a href="page.php?type=aboutus" class="hover:text-orange-500">About Us</a></li>
        <li><a href="car-listing.php" class="hover:text-orange-500">Car Listing</a></li>
        <li><a href="page.php?type=faqs" class="hover:text-orange-500">FAQs</a></li>
        <li><a href="contact-us.php" class="hover:text-orange-500">Contact Us</a></li>
      </ul>

      <div class="flex w-full justify-center items-center gap-6 ">

        <!-- ⭐ ORIGINAL SEARCH BAR (WORKING) -->
        <div class="header_search flex items-center ">
          <form action="search.php" method="post" class="flex items-center border border-gray-300 rounded overflow-hidden">
            <input type="text" 
                   placeholder="Search..." 
                   name="searchdata"
                   required
                   class="px-10 py-2 w-full focus:outline-none focus:ring-2 focus:ring-orange-400" />

            <button type="submit" class="bg-orange-500 hover:bg-orange-600 text-white px-4 py-2">
              <i class="fa fa-search"></i>
            </button>
          </form>
        </div>


        <!-- USER MENU -->
        <?php if($_SESSION['login']) { ?>
        <div class="relative group">

          <button class="flex items-center gap-2 text-gray-700 hover:text-orange-500">
            <i class="fa fa-user-circle text-xl"></i>

            <?php 
            $email = $_SESSION['login'];
            $sql ="SELECT FullName FROM tblusers WHERE EmailId=:email";
            $query = $dbh->prepare($sql);
            $query->bindParam(':email', $email, PDO::PARAM_STR);
            $query->execute();
            $results = $query->fetchAll(PDO::FETCH_OBJ);
            if($query->rowCount() > 0){
              foreach($results as $result){
                echo htmlentities($result->FullName);
              }
            }
            ?>

            <i class="fa fa-angle-down"></i>
          </button>

          <ul class="absolute hidden group-hover:block bg-white shadow-lg rounded w-48 mt-2 text-gray-700">
            <li><a href="profile.php" class="block px-4 py-2 hover:bg-gray-100">Profile Settings</a></li>
            <li><a href="update-password.php" class="block px-4 py-2 hover:bg-gray-100">Update Password</a></li>
            <li><a href="my-booking.php" class="block px-4 py-2 hover:bg-gray-100">My Booking</a></li>
            <li><a href="post-testimonial.php" class="block px-4 py-2 hover:bg-gray-100">Post Testimonial</a></li>
            <li><a href="my-testimonials.php" class="block px-4 py-2 hover:bg-gray-100">My Testimonials</a></li>
            <li><a href="logout.php" class="block px-4 py-2 text-red-500 hover:bg-gray-100">Sign Out</a></li>
          </ul>

        </div>
        <?php } ?>

      </div>
    </div>



    <!-- MOBILE NAVIGATION -->
    <div id="mobileNav" class="md:hidden hidden px-4 pb-4">
      <ul class="flex flex-col gap-3 text-gray-700">
        <li><a href="index.php" class="hover:text-orange-500">Home</a></li>
        <li><a href="page.php?type=aboutus" class="hover:text-orange-500">About Us</a></li>
        <li><a href="car-listing.php" class="hover:text-orange-500">Car Listing</a></li>
        <li><a href="page.php?type=faqs" class="hover:text-orange-500">FAQs</a></li>
        <li><a href="contact-us.php" class="hover:text-orange-500">Contact Us</a></li>
      </ul>
    </div>

  </nav>

</header>
