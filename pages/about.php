<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>About Us | DragonStone</title>

  <!-- Inline styles (integrates easily with your current structure) -->
  <style>
    @import url('https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600;700&display=swap');
    body {
      font-family: 'Inter', sans-serif;
      margin: 0;
      background-color: #f8f8f5;
      color: #1f1f1f;
      line-height: 1.6;
    }

    header, footer {
      background-color: rgba(250, 249, 247, 0.9);
      backdrop-filter: blur(10px);
      padding: 1rem 2rem;
      text-align: center;
      box-shadow: 0 2px 6px rgba(0,0,0,0.05);
    }

    .hero {
      background: url('../img/mission.png') center/cover no-repeat;
      color: #fff;
      text-align: center;
      padding: 6rem 1.5rem;
      position: relative;
    }
    .hero::before {
      content: "";
      position: absolute;
      inset: 0;
      background: rgba(0,0,0,0.4);
    }
    .hero h1 {
      position: relative;
      z-index: 2;
      font-size: 2.8rem;
      font-weight: 700;
      margin-bottom: 0.5rem;
    }
    .hero p {
      position: relative;
      z-index: 2;
      font-size: 1.2rem;
    }

    .section {
      max-width: 1000px;
      margin: 3rem auto;
      padding: 0 1.5rem;
    }

    h2 {
      color: #2b6e4a;
      font-weight: 700;
      margin-bottom: 0.75rem;
    }

    .founders {
      display: grid;
      grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
      gap: 1.5rem;
      margin-top: 1.5rem;
    }

    .founder {
      background: #fff;
      padding: 1.5rem;
      border-radius: 8px;
      box-shadow: 0 2px 6px rgba(0,0,0,0.08);
    }

    .founder h3 {
      color: #2b6e4a;
      margin-top: 0;
    }

    .values {
      display: flex;
      flex-wrap: wrap;
      gap: 1rem;
      margin-top: 1rem;
    }

    .value {
      flex: 1 1 45%;
      background: #ffffff;
      border-left: 4px solid #78a980;
      padding: 1rem;
      border-radius: 6px;
      box-shadow: 0 1px 4px rgba(0,0,0,0.05);
    }

    footer p {
      font-size: 0.9rem;
      color: #555;
    }
  </style>
</head>
<body>

  <!-- ================= HEADER ================= -->
  <header>
    <h1>DragonStone</h1>
  </header>

  <!-- ================= HERO SECTION ================= -->
  <section class="hero">
    <h1>About Us</h1>
    <p>Building a future where sustainability meets style and purpose.</p>
  </section>

  <!-- ================= OUR STORY ================= -->
  <section class="section">
    <h2>Our Story</h2>
    <p>
      The foundation of <strong>DragonStone</strong> was born from a shared frustration among its three founders - 
      <strong>Aegon</strong>, <strong>Visenya</strong>, and <strong>Rhaenys</strong> - who struggled to find genuinely sustainable home products 
      that were both affordable and stylish. Determined to change this, they envisioned a platform where every purchase 
      contributes to environmental preservation without compromising beauty or accessibility.
    </p>

    <div class="founders">
      <div class="founder">
        <h3>Aegon</h3>
        <p>A former interior designer who championed eco-conscious living. His design insight ensures DragonStone products embody balance between aesthetics and sustainability.</p>
      </div>
      <div class="founder">
        <h3>Visenya</h3>
        <p>A logistics expert who transformed his expertise into ethical sourcing and supply chain optimization, ensuring every supplier aligns with our values.</p>
      </div>
      <div class="founder">
        <h3>Rhaenys</h3>
        <p>A digital marketer and environmental activist passionate about educating and empowering consumers to make meaningful choices for the planet.</p>
      </div>
    </div>
  </section>

  <!-- ================= OUR MISSION ================= -->
  <section class="section">
    <h2>Our Mission</h2>
    <p>
      At DragonStone, our mission is simple yet powerful: to make sustainable living accessible and aspirational.  
      We believe conscious consumerism should feel rewarding, not restrictive - and that style and responsibility can coexist.
    </p>
    <p>
      From compostable cleaning pods to upcycled décor and refillable bathroom essentials, every product is thoughtfully vetted 
      to reduce waste and empower consumers to make eco-friendly choices with confidence.
    </p>
  </section>

  <!-- ================= CORE VALUES ================= -->
  <section class="section">
    <h2>Our Core Values</h2>
    <div class="values">
      <div class="value">
        <h4>🌿 Sustainability</h4>
        <p>Every product we sell is carefully sourced and assessed for environmental impact, ensuring our planet’s wellbeing comes first.</p>
      </div>
      <div class="value">
        <h4>💡 Transparency</h4>
        <p>We build trust through open communication about sourcing, production, and carbon impact metrics for every product.</p>
      </div>
      <div class="value">
        <h4>🤝 Community</h4>
        <p>We partner with small-scale manufacturers and support local artisans who share our environmental ethics and passion for change.</p>
      </div>
      <div class="value">
        <h4>🌎 Innovation</h4>
        <p>We integrate technology, from carbon footprint calculators to subscription models, to make sustainable living seamless and smart.</p>
      </div>
    </div>
  </section>

  <!-- ================= FUTURE VISION ================= -->
  <section class="section">
    <h2>Looking Ahead</h2>
    <p>
      As DragonStone continues to grow, we aim to expand internationally within two years, offering a platform that supports multiple currencies and languages.  
      Our goal is not just to sell products, but to cultivate a global movement - where eco-conscious living becomes the new normal.
    </p>
  </section>

  <!-- ================= FOOTER ================= -->
  <footer>
    <p>© 2025 DragonStone. Sustainable Living, Beautifully Designed.</p>
  </footer>

</body>
</html>
