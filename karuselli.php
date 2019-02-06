<!DOCTYPE html>
<html lang="fi">
<head>
  <title>Kuvakaruselli</title>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <style>
    .crsl_images
    {
      border:solid 2px;
      height:auto;
      width:100px;
      position:absolute;
      transition: width 1s, height 1s, opacity 1s, left 1s;
    }
  </style>
  <script>
  <?php
    $carousel_image_width_1 = 500;
    $carousel_image_width_2 = 200;
    $carousel_image_opacity = "0.2";
    $carousel_image_margin = 50;

    $nla = $carousel_image_width_2 + $carousel_image_margin;
    $nlb = $carousel_image_width_1 + $carousel_image_margin;
  ?>
    var images = ["img1.jpg", "img2.jpg", "img3.jpg", "img4.jpg", "img5.jpg", "img6.jpg"];
    var carousel_delay = 2000;

    var carousel_running;
    function run_carousel(n, l, loop)
    {
      if(n>=images.length) n=0;
      if(n<0) n=images.length-1;
      if(l>=4) l=0;
      if(l<0) l=3;

      for(var m=0, nl=0, nimg;m<4;m++)
      {
        if(m+l<4) nimg = m+l;
        else nimg = m+l-4;

        document.getElementById("image" + nimg).style.left = nl + "px";
        if(m!=3)
          document.getElementById("image" + nimg).style.visibility = "visible";
        else
        {
          document.getElementById("image" + nimg).style.visibility = "hidden";
          document.getElementById("image" + nimg).style.left = "<?php echo $nla*2; ?>px";
        }
        if(m!=1)
        {
          document.getElementById("image" + nimg).style.width = "<?php echo $carousel_image_width_2; ?>px";
          document.getElementById("image" + nimg).style.opacity = "<?php echo $carousel_image_opacity; ?>";
          nl+=<?php echo $nla; ?>;
        }
        else
        {
          document.getElementById("image" + nimg).style.width = "<?php echo $carousel_image_width_1; ?>px";
          document.getElementById("image" + nimg).style.opacity = "1";
          nl+=<?php echo $nlb; ?>;
        }
      }      
      document.getElementById("image" + nimg).src = images[n];
      document.getElementById("startbutton").onclick = function() { run_carousel(n+1, l+1, 1); }
      document.getElementById("leftbutton").onclick = function() { run_carousel(n-1, l-1, 0); }
      document.getElementById("rightbutton").onclick = function() { run_carousel(n+1, l+1, 0); }
      if(loop) carousel_running = setTimeout(function() { run_carousel(n+1, l+1, 1) }, carousel_delay);
      else clearTimeout(carousel_running);
    }

    function stop_carousel()
    {
      clearTimeout(carousel_running);
    }

    function start_carousel()
    {
      for(var m=0;m<4;m++)
      {
        if(m<images.length)
          document.getElementById("image" + m).src = images[m];
        else
          document.getElementById("image" + m).src = images[m-images.length];
      }
      run_carousel(0, 0, 1);
    }
  </script>
</head>
<body style="font-family:Arial, Helvetica, sans-serif;" onload = "start_carousel()">
  <input type = "button" value = "Pysäytä karuselli" onclick = "stop_carousel()">
  <input type = "button" id = "startbutton" value = "Käynnistä karuselli" onclick = "start_carousel()">
  <input type = "button" id = "leftbutton" value = "&lt;&lt; Vasemmalle" onclick = "">
  <input type = "button" id = "rightbutton" value = "Oikealle &gt;&gt;" onclick = "">
  <br><br>
  <img id = "image0" alt = "" src = "" class = "crsl_images" style = "left:0px;opacity:<?php echo $carousel_image_opacity; ?>;">
  <img id = "image1" alt = "" src = "" class = "crsl_images" style = "left:<?php echo $nla; ?>px;width:<?php echo $carousel_image_width_1; ?>px;">
  <img id = "image2" alt = "" src = "" class = "crsl_images" style = "left:<?php echo $nla*3; ?>px;opacity:<?php echo $carousel_image_opacity; ?>;">
  <img id = "image3" alt = "" src = "" class = "crsl_images" style = "left:<?php echo $nla*4; ?>px;visibility:hidden;">
</body>
</html>
