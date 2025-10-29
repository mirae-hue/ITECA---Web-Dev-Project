document.addEventListener("DOMContentLoaded", () => {
  // ===== Shrink header on scroll =====
  const header = document.querySelector("header");
  window.addEventListener("scroll", () => {
    if (window.scrollY > 60) {
      header.classList.add("shrink");
    } else {
      header.classList.remove("shrink");
    }
  });

  // ===== Mobile menu toggle =====
  const menuToggle = document.querySelector(".menu-toggle");
  const navLinks = document.querySelector(".nav-links");
  menuToggle.addEventListener("click", () => {
    navLinks.classList.toggle("show");
  });

  // ===== Smooth scroll for internal links =====
  document.querySelectorAll('a[href^="#"]').forEach(anchor => {
    anchor.addEventListener("click", function (e) {
      const targetId = this.getAttribute("href");
      if (targetId.length > 1) {
        e.preventDefault();
        document.querySelector(targetId).scrollIntoView({
          behavior: "smooth",
          block: "start"
        });
      }
    });
  });

  // ===== Fade-in sections =====
  const observer = new IntersectionObserver(
    entries => {
      entries.forEach(entry => {
        if (entry.isIntersecting) {
          entry.target.classList.add("fade-in");
        }
      });
    },
    { threshold: 0.2 }
  );
  document.querySelectorAll("section").forEach(section => observer.observe(section));
});
