<?php 
    include('connection.php');

    if (!$_SESSION['userid']) {
      header("Location: login.php");
    }else {
?>

<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>สะพานกรุงเทพ</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="css/animate.min.css">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/test.css">
    <script src="js/wow.min.js"></script>
    <script> new WOW().init(); </script>
  </head>
  <body>
    <div class="header">
      <div class="navbar">
        <div class="logo">
          <h3>สะพานกรุงเทพ</h3>
        </div>
        <ul class="">
      
      <?php if ( $_SESSION['userlevel'] == '0' ) { ?> 
        <li><a href="FTP.php">FTP</a></li>
      <?php } ?>

          <li><a class="active" href="index.php">home</a></li>
          <li><a href="profile.php">profile</a></li>
          <li><a href="logout.php">logout</a></li>
        </ul>
      </div>
      <img src="img/home.jpg" alt="">
    </div>
    <div class="about-me">
      <div class="about-me-intero wow fadeIn  data-wow-duration="1s" data-wow-delay="1s"">
        <h1>สะพานกรุงเทพ</h1>
        <p>สะพานกรุงเทพ (อังกฤษ:Krung Thep Bridge) เป็นสะพานข้ามแม่น้ำเจ้าพระยาแห่งที่ 3 ต่อจากสะพานพระราม 6 และสะพานพระพุทธยอดฟ้า ถือเป็นสะพานโยกเพียงแห่งเดียวในเอเชียตะวันออกเฉียงใต้ที่ยังเปิด-ปิดได้อยู่ เชื่อมระหว่างบริเวณสี่แยกถนนตก เขตบางคอแหลมทางฝั่งพระนคร กับบริเวณสี่แยกบุคคโลในพื้นที่เขตธนบุรีทางฝั่งธนบุรี ใช้ในการคมนาคมทางบกข้ามแม่น้ำเจ้าพระยาและปิด-เปิด ให้เรือเข้าออก ลักษณะการก่อสร้างเป็นแบบคอนกรีตอัดแรง โดยวิธีการอิสระซึ่งยาวที่สุดในประเทศไทย มีช่องทางจราจร 4 ช่อง ความยาวสะพาน 350.80 เมตร ช่วงกลางน้ำยาว 226 เมตร เริ่มเปิดใช้งานเมื่อวันที่ 24 มิถุนายน พ.ศ. 2502 ปัจจุบันอยู่ในความรับผิดชอบของกรมทางหลวงชนบท </p>
      </div>
      <table class="table table-striped wow fadeIn  data-wow-duration="2s" data-wow-delay="1s"">
        <thead>
          <tr>
            <th scope="col">หัวข้อ</th>
            <th scope="col">รายละเอียด</th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <td>เส้นทาง</td>
            <td>ถนนกระรามที่ 3 - ถนนมไหสวรรย์</td>
          </tr>
          <tr>
            <td>ข้าม</td>
            <td>แม่น้ำเจ้าพระยา</td>
          </tr>
          <tr>
            <td>ที่ตั้ง</td>
            <td>เขตบางคอแหลม (ฝั่งพระนคร), เขตธนบุรี (ฝั่งธนบุรี)</td>
          </tr>
          <tr>
            <td>ชื่อทางการ</td>
            <td>สะพานกรุงเทพ</td>
          </tr>
          <tr>
            <td>เจ้าของ</td>
            <td>กรมทางหลวงชนบท</td>
          </tr>
          <tr>
            <td>เหนือน้ำ</td>
            <td>สะพานพระราม 3</td>
          </tr>
          <tr>
            <td>ท้ายน้ำ</td>
            <td>สะพานพระราม 9</td>
          </tr>
          <tr>
            <td>ประเภท</td>
            <td>เปิด-ปิดได้</td>
          </tr>
          <tr>
            <td>วัสดุ</td>
            <td>คอนกรีตอัดแรง</td>
          </tr>
          <tr>
            <td>ความยาว</td>
            <td>350.80 เมตร</td>
          </tr>
          <tr>
            <td>ความกว้าง</td>
            <td>17.00 เมตร</td>
          </tr>
          <tr>
            <td>ความสูง</td>
            <td>7.50 เมตร</td>
          </tr>
          <tr>
            <td>จำนวนช่วง</td>
            <td>5</td>
          </tr>
          <tr>
            <td>วันที่เริ่มสร้าง</td>
            <td>31 สิงหาคม พ.ศ. 2497</td>
          </tr>
          <tr>
            <td>วันที่สร้างเสร็จ</td>
            <td>ปลายปี พ.ศ. 2500</td>
          </tr>
          <tr>
            <td>วันที่เปิด</td>
            <td>24 มิถุนายน พ.ศ. 2502</td>
          </tr>
        </tbody>
      </table>

    </div>
    <div class="separate"></div>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <div class="goahead">
        <a href="https://www.google.com/maps/place/%E0%B8%AA%E0%B8%B0%E0%B8%9E%E0%B8%B2%E0%B8%99%E0%B8%81%E0%B8%A3%E0%B8%B8%E0%B8%87%E0%B9%80%E0%B8%97%E0%B8%9E/@13.7008682,100.4899563,17z/data=!3m1!4b1!4m5!3m4!1s0x30e29923916a52cd:0xcdac53d9ef7bff1e!8m2!3d13.700863!4d100.492145?hl=th" target="_blank">แผนที่</a>
    </div>
    <div id="map-container-google-1" class="z-depth-1-half map-container wow fadeIn  data-wow-duration="2s" data-wow-delay="1s"" style="height: 500px">
      <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3876.290158954184!2d100.48995631527373!3d13.700868202161953!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x30e29923916a52cd%3A0xcdac53d9ef7bff1e!2z4Liq4Liw4Lie4Liy4LiZ4LiB4Lij4Li44LiH4LmA4LiX4Lie!5e0!3m2!1sth!2sus!4v1665923614065!5m2!1sth!2sus" frameborder="0"
      style="border:0" allowfullscreen></iframe>
    </div>
    <br>
    <br>
    <br>
    <br>
    <div class="separate"></div>

    <!-- contact-us -->

    <div class="contact-us wow fadeIn  data-wow-duration="2s" data-wow-delay="1s"">
      <h1>Get in touche!</h1>
      <form action="">
        <div class="name-info">
          <input type="text" name="" value="" placeholder="Name">
          <input type="text" name="" value="" placeholder="Email">
        </div>
        <textarea name="name" rows="8" cols="80" placeholder="How I can helpe you?"></textarea>
        <div class="wow zoomIn  data-wow-duration="2s" data-wow-delay="1s"">
          <button type="submit">Send</button>
        </div>
      </form>
    </div>
    <div class="footer">
      <div class="sociaux col-md-12">
        <div class="facebook col-md-4 wow fadeIn  data-wow-duration="2s" data-wow-delay="1s"">
          <a href="#"></a>
        </div>
        <div class="dribbble col-md-4 wow fadeIn  data-wow-duration="2s" data-wow-delay="1.5s"">
          <a href="#"></a>
        </div>
        <div class="twitter col-md-4 wow fadeIn  data-wow-duration="2s" data-wow-delay="2s"">
          <a href="#"></a>
        </div>
      </div>
      <div class="copyright">
        <h5>Copyright (c) 2017 By  <a href="https://goo.gl/Dz4SeU">Devma</a></h5>
      </div>
    </div>
<div class="goTop"><i class="fa fa-arrow-up" aria-hidden="true"></i></div>
    <script src="js/jquery.min.js"></script>
    <script src="js/mainscript.js"></script>
  </body>
</html>


<?php } ?>