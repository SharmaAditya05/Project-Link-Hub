<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="mystyle.css" type="text/css">
    <style>
     
  body{
    background-color:#000000;
          /* background-image:url("web-1012467_1280.webp"); */
  }
 

    </style>
</head>
<body>
    

<input type="checkbox" id="menu-toggle" checked>
<div class="menu dflex">
  <div id="logoCSS3" class="text-center">
    <i class="fa fa-css3"></i>
  </div>
  <div class="elements-container dflex">
    <a class="element" href="#">
        <i class="fa fa-leaf"></i> Home
      </a>
    <a class="element" href="#">
        <i class="fa fa-gavel"></i> Requests
      </a>
    <a class="element" href="AddProject.php">
        <i class="fa fa-cogs"></i> Add Projects
      </a>
    <a class="element" href="logout.php">
        <i class="fa fa-cogs"></i> Logout
      </a>
  </div>
  <div class="menu-container-btn">
    <div class="menu-toggle-btn">
      <label class="menu-btn text-center" for="menu-toggle">
          <i class="fa fa-close"></i>
          <i class="fa fa-bars"></i>
        </label>
    </div>
  </div>
</div>
<div>
<div class="aboutus">
  <span class="word" style="color: #e0dbc1;">Welcome</span>
  <span class="word" style="color: #e0dbc1;">to</span>
  <span class="word" style="color: #e0dbc1;">Project</span>
  <span class="word" style="color: #e0dbc1;">Link</span>
  <span class="word" style="color: #e0dbc1;">Hub</span>
</div>
   <div class="aboutcon" >
    <div class="sec1">
     <img src="pic1.jpg" alt="" class="pic1">
     <p>
     Are you a student eager to turn your academic knowledge into practical, real-world experience? Or perhaps you're a faculty member seeking to mentor and guide the next generation of talent? Look no further. Project Link Hub is the ideal platform for you.
      </p>
    </div>
    <div class="sec2">
     <img src="pic2.jpg" alt="" class="pic1">
     <p>
     Empower the Future
     Share your expertise with the next generation of professionals. Create and post projects in your area of expertise, and help students gain valuable insights and skills. Nurturing talent is one of the most rewarding aspects of academia, and Project Link Hub makes it easier than ever.
      </p>
    </div>
  </div>
</div>
<script>
  document.addEventListener("DOMContentLoaded", function () {
    const words = document.querySelectorAll(".word");
    let delay = 0;

    words.forEach((word) => {
      word.style.transitionDelay = delay + "s";
      delay += 0.5; // Adjust the delay (0.5s) as needed for the desired speed.
      setTimeout(() => {
        word.style.opacity = 1;
      }, delay * 300);
    });
  });
</script>
</body>
</html>