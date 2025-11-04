document.addEventListener("DOMContentLoaded", () => {

  // ===== SHRINK HEADER ON SCROLL =====
  const header = document.querySelector("header");
  window.addEventListener("scroll", () => {
    if (window.scrollY > 60) header.classList.add("shrink");
    else header.classList.remove("shrink");
  });

  // ===== MOBILE MENU TOGGLE =====
  const menuToggle = document.querySelector(".menu-toggle");
  const navLinks = document.querySelector(".nav-links");
  if (menuToggle && navLinks) {
    menuToggle.addEventListener("click", () => navLinks.classList.toggle("show"));
  }

  // ===== DROPDOWN MENU (CLICK ACTIVATION) =====
  const menuBtns = document.querySelectorAll(".menu-btn");
  const dropdowns = document.querySelectorAll(".dropdown-content");

  menuBtns.forEach((btn) => {
    const dropdown = btn.parentElement.querySelector(".dropdown-content");
    btn.addEventListener("click", (e) => {
      e.stopPropagation(); // prevent closing immediately
      dropdowns.forEach(d => { if (d !== dropdown) d.classList.remove("show"); });
      dropdown.classList.toggle("show");
    });
  });

  // Close dropdowns when clicking outside
  document.addEventListener("click", () => {
    dropdowns.forEach(dropdown => dropdown.classList.remove("show"));
  });

  // ===== SMOOTH SCROLL FOR ANCHORS =====
  document.querySelectorAll('a[href^="#"]').forEach(anchor => {
    anchor.addEventListener("click", function(e) {
      const targetId = this.getAttribute("href");
      if (targetId.length > 1) {
        e.preventDefault();
        const target = document.querySelector(targetId);
        if (target) target.scrollIntoView({ behavior: "smooth", block: "start" });
      }
    });
  });

  // ===== FADE-IN SECTIONS =====
  const observer = new IntersectionObserver(
    entries => {
      entries.forEach(entry => {
        if (entry.isIntersecting) entry.target.classList.add("fade-in");
      });
    },
    { threshold: 0.2 }
  );
  document.querySelectorAll("section").forEach(section => observer.observe(section));

  // ===== CART =====
  const cartOverlay = document.getElementById('cart-overlay');
  const cartBack = document.getElementById('cart-back');
  const checkoutBtn = document.getElementById('checkout-btn');

  if (cartOverlay && cartBack) {
    function openCart() { cartOverlay.classList.add('active'); }
    function closeCart() { cartOverlay.classList.remove('active'); }

    cartBack.addEventListener('click', closeCart);
    // If you have a cart button somewhere:
    const cartBtn = document.querySelector('.fa-shopping-cart');
    if (cartBtn) cartBtn.addEventListener('click', openCart);
  }

  if (checkoutBtn) {
    checkoutBtn.addEventListener('click', () => {
      window.location.href = 'order.php';
    });
  }

  // ===== ORDER =====
  const orderForm = document.getElementById('order-form');
  if (orderForm) {
    orderForm.addEventListener('submit', function(e) {
      e.preventDefault();
      sessionStorage.setItem('orderDetails', JSON.stringify({
        name: this.name.value,
        email: this.email.value,
        address: this.address.value,
        phone: this.phone.value
      }));
      window.location.href = 'payment.php';
    });
  }

  // ===== PAYMENT =====
  const paymentForm = document.getElementById('payment-form');
  if (paymentForm) {
    paymentForm.addEventListener('submit', function(e) {
      e.preventDefault();
      alert('Payment successful! Thank you for your order.');
      window.location.href = 'index.php';
    });
  }

});
