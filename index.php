<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>HAPPY STAY-home</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@10/swiper-bundle.min.css"/>
    <?php require('inc/links.php'); ?>
    <style>
        .availability-form{
            margin-top: -50px;
            z-index:2;
            position:relative;
        }
        @media screen and (max-width:575px) {
            .availability-form{
            margin-top: 0px;
            padding:0 35px;
        }
            

        }
    </style>
</head>
<body class="bg-light">

<?php require('inc/header.php'); ?>


<!--carousel-->
<div class="container-fluid px-lg-4 mt-4">
<div class="swiper swiper-container">
    <div class="swiper-wrapper">
    <?php

      $res = selectAll('carousel');
      while($row = mysqli_fetch_assoc($res))
      {
        $path = CAROUSEL_IMG_PATH;
        echo <<<data
          <div class="swiper-slide">
            <img src="$path$row[image]" class="w-100 d-block">
          </div> 
        data;
      }
    ?>
      
    </div>
    
  </div>
</div>
<!--check availability form
<div class="container availability-form">
    <div class="row">
        <div class="col-lg-12 bg-white shadow p-4 rounded">
           <h5 class="mb-4">check booking availability</h5>
           <form>
            <div class="row align-items-end">
                <div class="col-lg-2 mb-3">
                <label class="form-label" style="font-weight:500;">check-in</label>
                <input type="date" class="form-control shadow-none">

                </div>
                <div class="col-lg-2 mb-3">
                <label class="form-label" style="font-weight:500;">check-out</label>
                <input type="date" class="form-control shadow-none">

                </div>
                <div class="col-lg-3 mb-3">
                <label class="form-label" style="font-weight:500;">Adults</label>
                <select class="form-select shadow none">
                    <option selected>Open this select menu</option>
                    <option value="1">One</option>
                    <option value="2">Two</option>
                    <option value="3">Three</option>
                    <option value="4">Four</option>
                    <option value="5">Five</option>
                    <option value="6">Six</option>
                    <option value="7">Seven</option>
                    <option value="8">Eight</option>
                    <option value="9">Nine</option>
                    <option value="10">Ten</option>
                </select>

                </div>
                <div class="col-lg-3 mb-3">
                <label class="form-label" style="font-weight:500;">children</label>
                <select class="form-select shadow none">
                <option selected>Open this select menu</option>
                    <option value="1">One</option>
                    <option value="2">Two</option>
                    <option value="3">Three</option>
                    <option value="4">Four</option>
                    <option value="5">Five</option>
                    <option value="6">Six</option>
                    <option value="7">Seven</option>
                    <option value="8">Eight</option>
                    <option value="9">Nine</option>
                    <option value="10">Ten</option>
                </select>

                </div>
                <div class="col-lg-1 mb-lg-3 mt-2">
                    <button type="submit" class="btn text-white shadow-none custom-bg">SUBMIT</button>
                </div>
            </div>
           </form>

        </div>
    </div>
</div>-->
<div class="container availability-form">
    <div class="row">
        <div class="col-lg-12 bg-white shadow p-4 rounded">
           <h5 class="mb-4">check booking availability</h5>
           <form action="rooms.php">
            <div class="row align-items-end">
                <div class="col-lg-3 mb-3">
                <label class="form-label" style="font-weight:500;">check-in</label>
                <input type="date" class="form-control shadow-none" name="checkin" required>

                </div>
                <div class="col-lg-3 mb-3">
                <label class="form-label" style="font-weight:500;">check-out</label>
                <input type="date" class="form-control shadow-none" name="checkout" required>

                </div>
                <div class="col-lg-3 mb-3">
                <label class="form-label" style="font-weight:500;">Adult</label>
                <select class="form-select shadow none" name="adult">
                  <?php
                  $guests_q=mysqli_query($con,"SELECT max(adult) AS `max_adult`, MAX(children) AS `max_children` 
                  FROM `rooms` WHERE `status`='1' AND `removed`='0'");
                  $guests_res=mysqli_fetch_assoc($guests_q);
                  for($i=1; $i<=$guests_res['max_adult']; $i++){
                    echo "<option value='$i'>$i</option>";
                  }

                  ?>
                </select>

                </div>
                <div class="col-lg-2 mb-3">
                <label class="form-label" style="font-weight:500;">children</label>
                <select class="form-select shadow none" name="children">
                  <?php 
                  for($i=0; $i<=$guests_res['max_children']; $i++){
                    echo "<option value='$i'>$i</option>";
                  }



                  ?>
                </select>

                </div>
                <input type="hidden" name="check_availability"> 
                <div class="col-lg-1 mb-lg-3 mt-2">
                    <button type="submit" class="btn text-white shadow-none custom-bg">SUBMIT</button>
                </div>
            </div>
           </form>

        </div>
    </div>
</div>




<!--rooms-->
<h2 class="mt-5 pt-4 mb-4 text-center fw-bold h-font">OUR ROOMS</h2>
 <div class="container">
    <div class="row">
    <?php 
        $room_res=select("SELECT * FROM `rooms` WHERE `status`=? AND `removed`=? ORDER BY `id` DESC LIMIT 3",[1,0],'ii');
        while($room_data=mysqli_fetch_assoc($room_res))
        {
          //get features of room

          $fea_q=mysqli_query($con,"SELECT f.name FROM `features` f 
             INNER JOIN `room_features` rfea ON f.id=rfea.features_id
             WHERE rfea.room_id='$room_data[id]'");
          
          $features_data="";
          while($fea_row=mysqli_fetch_assoc($fea_q)){
            $features_data.="<span class='badge rounded-pill bg-light text-dark text-wrap me-1 mb-1'>
            $fea_row[name]
            </span>";
          }
          //get facilities of room
          $fac_q=mysqli_query($con,"SELECT f.name FROM `facilities` f 
          INNER JOIN `room_facilities` rfac ON f.id=rfac.facilities_id
          WHERE rfac.room_id='$room_data[id]'");

          $facilities_data="";
          while($fac_row=mysqli_fetch_assoc($fac_q)){
            $facilities_data.="<span class='badge rounded-pill bg-light text-dark text-wrap me-1 mb-1'>
            $fac_row[name]
            </span>";
          }
          //get thumbnail of image

          $room_thumb=ROOMS_IMG_PATH."thumbnail.jpg";
          $thumb_q=mysqli_query($con,"SELECT * FROM `rooms_images` 
          WHERE `room_id`='$room_data[id]' 
          AND `THUMB`='1'");

          if(mysqli_num_rows($thumb_q)>0){
            $thumb_res=mysqli_fetch_assoc($thumb_q);
            $room_thumb=ROOMS_IMG_PATH.$thumb_res['image'];
          }

          $book_btn = "";
          if(!$settings_r['shutdown'])
          {
            $login=0;
            if(isset($_SESSION['login']) && $_SESSION['login']==true){
              $login=1;
            }

            $book_btn= "<button  onClick='checkLoginToBook($login,$room_data[id])' class='btn btn-sm text-white shadow-none ' style='background-color: teal'>Book now</button>  ";
          }

          //print room card

         echo <<<data
         <div class="col-lg-4 col-md-6 my-3">
        <div class="card border-0 shadow" style="max-width: 350px; ">
            <img src="$room_thumb" class="card-img-top" alt="...">
            <div class="card-body">
                <h5>$room_data[name]</h5>
                <h6 class="mb-4">₹$room_data[price]</h6>
                <div class="features mb-4">
                    <h6 class="mb-1">Features</h6>                
                    $features_data
                </div>
                <div class="facilities mb-4">
                <h6 class="mb-1">Facilities</h6>
                $facilities_data
                </div>
                <div class="guests mb-4">
                  <h6 class="mb-1">Guests</h6>
                  <span class="badge rounded-pill bg-light text-dark text-wrap">
                    $room_data[adult] Adults
                  </span>
                  <span class="badge rounded-pill bg-light text-dark text-wrap">
                    $room_data[children] children
                  </span>

                </div>
                <div class="rating mb-4">
                <h6 class="mb-1">Rating</h6>
                 <span class="badge rounded-pill bg-light">
                   <i class="bi bi-star-fill text-warning"></i>
                   <i class="bi bi-star-fill text-warning"></i>
                   <i class="bi bi-star-fill text-warning"></i>
                   <i class="bi bi-star-fill text-warning"></i>
                  </span>


                </div>
                <div class="d-flex justify-content-evenly mb-2">
                $book_btn 
                
                <a href="room-details.php?id=$room_data[id]" class="btn btn-sm btn-outline-dark shadow-none">More details</a>  
                </div>
                
            </div>
        </div>
        </div>    
        data;   
        }
      ?>
        
        <div class="col-lg-12 text-center mt-5">
            <a href="rooms.php" class="btn btn-sm btn-outline-dark rounded-0 fw-bold shadow-none">More Rooms>>></a>
        </div>
    </div>
 </div>


<!--our facilities-->
<h2 class="mt-5 pt-4 mb-4 text-center fw-bold h-font">OUR FACILITIES</h2>
<div class="container">
    <div class="row justify-content-evenly px-lg-0 px-md-0 px-5">
    <?php
      $res = mysqli_query($con,"SELECT * FROM `facilities` ORDER BY `id` DESC LIMIT 5");
      $path = FACILITIES_IMG_PATH;

      while($row = mysqli_fetch_assoc($res)){
        echo<<<data

        <div class="col-lg-2 col-md-2 text-center bg-white rounded shadow py-4 my-3">
           <img src="$path$row[icon]" width="50px">
            <h5 class="mt-3">$row[name]</h5>
        </div>
        data;
      }
    ?>
        <div class="col-lg-12 text-center mt-5">
        <a href="facilities.php" class="btn btn-sm btn-outline-dark rounded-0 fw-bold shadow-none">More Facilities>>></a>
        </div>
        </div>
</div>


  <!--reach us-->


  <?php
    $contact_q= "SELECT * FROM `contact_details` WHERE `sr_no`=?";
    $values=[1];
    $contact_r = mysqli_fetch_assoc(select($contact_q,$values,'i'));
    //print_r($contact_r);
  ?>

  <h2 class="mt-5 pt-4 mb-4 text-center fw-bold h-font">REACH US</h2>
  <div class="container">
      <div class="row">
          <div class="col-lg-8 col-md-8 p-4 mb-lg-0 mb-3 bg-white rounded">
          <iframe class="w-100 rounded" height="320px"  src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d30628.676206384684!2d80.51351473599061!3d16.344159793107156!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3a35f5c460ab7d1d%3A0x8c86e4f36490336b!2sVasireddy%20Venkatadri%20Institute%20of%20Technology!5e0!3m2!1sen!2sin!4v1720935239518!5m2!1sen!2sin" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
          </div>
          <div class="col-lg-4 col-md-4">
            <div class="bg-white p-4 rounded mb-4">
              <h5>call us</h5>
              <a href="tel: +<?php echo $contact_r['pn1']?>" class="d-inline-block mb-2 text-decoration-none text-dark">
                <i class="bi bi-telephone-fill"></i>+<?php echo $contact_r['pn1']?>
              </a>
              <br>
              <a href="tel: +<?php echo $contact_r['pn2']?>" class="d-inline-block mb-2 text-decoration-none text-dark">
                <i class="bi bi-telephone-fill"></i>+<?php echo $contact_r['pn2']?>
              </a>
              <br>
              
              <br>
            </div>
            <div class="bg-white p-4 rounded mb-4" >

            <h5 >Email</h5>
              <i class="bi bi-envelope-at"></i> 
              <a href="mailto: ask.happystay@gmail.com" class="d-inline-block text-decoration-none text-dark">
              ask.happystay@gmail.com
          </a> 

            </div>
            

            <div class="bg-white p-4 rounded mb-4">
              <h5>Follow us</h5>
              <?php
                if($contact_r['tw']!='')
                {
                  echo <<<data
                  <a href="$contact_r[tw]" class="d-inline-block mb-3">
                  <span class="badge bg-light text-dark fs-6 p-2">
                  <i class="bi bi-twitter me-1"></i> Twitter
                  </span>
                  </a> 
                  data;
                }
              
              
              ?>
              
              <br>
              <a href="<?php echo $contact_r['fb'] ?>" class="d-inline-block mb-3">
              <span class="badge bg-light text-dark fs-6 p-2">
              <i class="bi bi-facebook"></i> facebook
              </span>
            </a>
            <br>
            <a href="<?php echo $contact_r['insta'] ?>" class="d-inline-block">
                <span class="badge bg-light text-dark fs-6 p-2">
                <i class="bi bi-instagram"></i> instagram
                </span>
            </a>
            
              
            </div>
          </div>
          
      </div>
  </div>

<?php require('inc/footer.php'); ?>
<script src="https://cdn.jsdelivr.net/npm/swiper@10/swiper-bundle.min.js"></script>
<script>
    var swiper = new Swiper(".swiper-container", {
      spaceBetween: 30,
      effect: "fade",
      loop:true,
      autoplay:{
        delay:3500,
        disableOnIntreaction:false,
      }
    
    });
  var swiper = new Swiper(".swiper-testimonials", {
    effect: "coverflow",
    grabCursor: true,
    centeredSlides: true,
    slidesPerView: "auto",
    slidesPerView:"3",
    loop:true,
    coverflowEffect: {
      rotate: 50,
      stretch: 0,
      depth: 100,
      modifier: 1,
      slideShadows: false,
    },
    pagination: {
      el: ".swiper-pagination",
    },
    breakpoints: {
      320:{
          slidesPerView:1,
      },
      640:{
          slidesPerView:1,
      },
      768:{
          slidesPerView:2,
      },
      1024:{
          slidesPerView:3,
      },

    }
    });
</script>
</body>
</html>