<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

$userLink = "/dragonstone/login/signup.php"; 
if (isset($_SESSION['user_id'])) { 
	$userLink = "/dragonstone/pages/u_dashboard.php"; 
}

$itemCount = 0;

if (isset($_SESSION['cart']) && is_array($_SESSION['cart'])) {
    foreach ($_SESSION['cart'] as $item) {
        $itemCount += $item['quantity'];
    }
}
?>


<header>
  <!-- Top Tier -->
  <div class="header-top">
    <!-- Logo -->
    <div class="logo">
      <a href="/dragonstone/index.php">
        <img src="/dragonstone/img/icons/logo3.png" alt="DragonStone Logo" />DragonStone
      </a>
    </div>

    <!-- Search Bar -->
    <div class="search-bar">
      <input type="text" placeholder="search eco-friendly products..." aria-label="Search">
      <button aria-label="Search">
        <svg width="20" height="20" viewBox="0 0 24 24" fill="none"
          stroke="#ffffff" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
          <circle cx="11" cy="11" r="8"></circle>
          <line x1="21" y1="21" x2="16.65" y2="16.65"></line>
        </svg>
      </button>
    </div>
	
    <!-- Header Icons -->
    <div class="header-icons">
      <a href="<?= $userLink; ?>"><i class="fa fa-user" aria-hidden="true"></i></a>
		<div class="cart-wrapper">
		  <a href="/dragonstone/pages/cart.php"><i class="fa fa-shopping-cart"></i></a>
		  <?php if ($itemCount > 0): ?>
			<span class="cart-count"><?= $itemCount; ?></span>
		  <?php endif; ?>
		</div>

    </div>
  </div>

  <!-- Bottom Tier / Navigation -->
<nav class="header-bottom">
  <div class="menu-dropdown">
    <button class="menu-btn">☰</button>
    <div class="dropdown-content">
      <a href="/dragonstone/pages/shopall.php">Shop All</a>

      <div class="dropdown-section">Categories</div>
      <a href="/dragonstone/pages/category.php?id=1">Cleaning & Household Supplies</a>
      <a href="/dragonstone/pages/category.php?id=2">Kitchen & Dining</a>
      <a href="/dragonstone/pages/category.php?id=3">Home Décor & Living</a>
      <a href="/dragonstone/pages/category.php?id=4">Bathroom & Personal Care</a>
      <a href="/dragonstone/pages/category.php?id=5">Lifestyle & Wellness</a>
      <a href="/dragonstone/pages/category.php?id=6">Kids & Pets</a>
      <a href="/dragonstone/pages/category.php?id=7">Outdoor & Garden</a>

      <div class="dropdown-section">Features</div>
      <a href="/dragonstone/pages/ecopoints.php">EcoPoints</a>
      <a href="/dragonstone/pages/subscribe.php">Subscribe & Save</a>
      <a href="/dragonstone/pages/calculator.php">Carbon Calculator</a>
      <a href="/dragonstone/pages/community.php">Community Hub</a>

      <div class="dropdown-section">Other</div>
      <a href="/dragonstone/pages/about.php">About Us</a>
      <a href="/dragonstone/pages/u_dashboard.php">Account</a>
    </div>
  </div>

  <ul class="nav-links">
    <li><a href="/dragonstone/pages/category.php?id=1">Cleaning & Household Supplies</a></li>
    <li><a href="/dragonstone/pages/category.php?id=2">Kitchen & Dining</a></li>
    <li><a href="/dragonstone/pages/category.php?id=3">Home Décor & Living</a></li>
    <li><a href="/dragonstone/pages/category.php?id=4">Bathroom & Personal Care</a></li>
    <li><a href="/dragonstone/pages/category.php?id=5">Lifestyle & Wellness</a></li>
    <li><a href="/dragonstone/pages/category.php?id=6">Kids & Pets</a></li>
    <li><a href="/dragonstone/pages/category.php?id=7">Outdoor & Garden</a></li>
  </ul>
</nav>
</header>
