<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
  <style>
    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
      font-family: 'Poppins', sans-serif;
    }
    nav {
      position: fixed;
      top: 0;
      width: 100%;
      z-index: 99;
      background: #242526;
      box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    }
    nav .wrapper {
      max-width: 1300px;
      margin: auto;
      padding: 0 30px;
      height: 70px;
      display: flex;
      align-items: center;
      justify-content: space-between;
    }
    nav .logo a {
      color: #f2f2f2;
      font-size: 30px;
      font-weight: 600;
      text-decoration: none;
    }
    nav .nav-links {
      display: flex;
      align-items: center;
    }
    nav .nav-links li {
      list-style: none;
    }
    nav .nav-links li a {
      color: #f2f2f2;
      text-decoration: none;
      font-size: 18px;
      font-weight: 500;
      padding: 10px 15px;
      border-radius: 5px;
      transition: background 0.3s ease;
    }
    nav .nav-links li a:hover {
      background: #3A3B3C;
    }
    nav .btn {
      display: none;
      font-size: 24px;
      color: #f2f2f2;
      cursor: pointer;
    }
    @media screen and (max-width: 970px) {
      nav .btn {
        display: block;
      }
      nav .nav-links {
        position: fixed;
        top: 70px;
        left: -100%;
        width: 100%;
        height: 100%;
        background: #242526;
        flex-direction: column;
        justify-content: center;
        align-items: center;
        transition: all 0.3s ease;
      }
      nav .nav-links li {
        margin: 15px 0;
      }
      nav .nav-links.show {
        left: 0;
      }
    }
    .body-text {
      padding-top: 120px;
      text-align: center;
    }
    .body-text .title {
      font-size: 45px;
      font-weight: 600;
      color: #333;
    }
    .body-text .sub-title {
      font-size: 20px;
      color: #555;
      margin-top: 10px;
    }
    nav {
    position: fixed; 
   
}



  </style>
</head>
<body>

<nav>
  <div class="wrapper">
    <div class="logo"><a href="#">Lost and found</a></div>
    <div class="btn menu-btn" onclick="toggleMenu()">☰</div>
    <ul class="nav-links">
      <li><a href="index.php">Home</a></li>
      <li><a href="report_lost.php">Report Lost</a></li>
      <li><a href="report_found.php">Report Found</a></li>
      <li><a href="view_items.php">View Items</a></li>
    </ul>
  </div>
</nav>


<script>
  const navLinks = document.querySelector('.nav-links');
  function toggleMenu() {
    navLinks.classList.toggle('show');
  }
</script>

</body>
</html>
