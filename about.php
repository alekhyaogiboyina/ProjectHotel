<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>HotelBooking-about</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@10/swiper-bundle.min.css"/>
    <?php require('inc/links.php'); ?>
<style>
    .box{
        border-top-color: var(--teal) !important;
    }
</style>
</head>
<body class="bg-light">

    <?php require('inc/header.php'); ?>
    <div class="my-5 px-4">
    <h2 class="fw-bold h-font text-center">ABOUT US</h2>
    <div class="h-line bg-dark"></div>
    </div>
    <p class="text-center mt-3">
    Welcome to HappyStay - Your Ultimate Retreat</p>
    <p class="text-center mt-3">
    At HappyStay, we believe that every journey deserves an extraordinary experience.</br> 
    Nestled in the heart of [City/Area], our hotel is designed to be your haven, offering a seamless blend of comfort, convenience, and charm.
    </p>
    <div class="container">
        <div class="row justify-content-between align-items-center">
            <div class="col-lg-6 col-md-5 mb-4 order-lg-1 order-md-1 order-2">
                <h3 class="mb-3">KNOW US BETTER</h3>
                <p>
                    HappyStay was born out of a passion for hospitality and a commitment to creating memorable moments for our guests. With a team dedicated to crafting a warm and welcoming atmosphere, we strive to make every stay with us a joyous occasion.</br>
                    </br>
                    </br>
                    From cozy single rooms to spacious suites, each accommodation at HappyStay is a sanctuary of relaxation. Immerse yourself in our stylish decor, enjoy modern amenities, and experience the unparalleled comfort that defines HappyStay.
                    </br>
                    </br>
                    Our user-friendly online booking platform ensures that reserving your room is a seamless and stress-free process. Whether you're traveling for business or leisure, finding the perfect room for your needs has never been easier.
                    </br>
                    </br>
                    From the moment you arrive, our attentive staff is dedicated to making your stay memorable. Whether you need local recommendations, assistance with arrangements, or a special request fulfilled, we're here to exceed your expectations.
                    </br></br>
                    After a day of exploration, return to the tranquility of HappyStay and unwind in our Spa, fitness center,Swimming pool,Yoga center etc.
                    
                    
                </p>
            </div>
        <div class="col-lg-5 col-md-5 mb-4 order-lg-2 order-md-2 order-1">
            <img src="images/rooms/customer.jpeg" class="w-100">
        </div>
        </div>
    </div>
    <div class="container mt-5">
        <div class="row">
            <div class="col-lg-3 col-md-6 mb-4 px-4">
                <div class="bg-white rounded shadow p-4 border-top border-4 text-center box">
                    <img src="images/rooms/customer.jpeg" width="250px">
                    <h4 class="mt-3">200+ customers</h4>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 mb-4 px-4">
                <div class="bg-white rounded shadow p-4 border-top border-4 text-center box">
                    <img src="images/rooms/ROOM9.jpg" width="230px">
                    <h4 class="mt-3">100+ Rooms</h4>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 mb-4 px-4">
                <div class="bg-white rounded shadow p-4 border-top border-4 text-center box">
                    <img src="images/rooms/review.jpeg" width="230px">
                    <h4 class="mt-3">150+ Reviews</h4>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 mb-4 px-4">
                <div class="bg-white rounded shadow p-4 border-top border-4 text-center box">
                    <img src="images/rooms/staff.jpeg" width="200px">
                    <h4 class="mt-3">200+ staff</h4>
                </div>
            </div>
        </div>
    </div>

    <h3 class="my-5 fw-bold h-font text-center">MANAGEMENT TEAM</h3>


    <div class="container px-4">
        <div class="swiper mySwiper">
            <div class="swiper-wrapper mb-5">
                <?php

                  $about_r = selectAll('team_details');
                  $path=ABOUT_IMG_PATH;

                  while($row = mysqli_fetch_assoc($about_r)){
                    echo <<<data
                        <div class="swiper-slide bg-white text-center overflow-hidden rounded">
                        <h5 class="mt-2">$row[name]</h5>
                        <img src="images/about/$row[picture]" class="w-100">
                        </div>

                        
                    data;
                  }
                
                ?>


                
                <div class="swiper-slide">Slide 1</div>
                <div class="swiper-slide">Slide 2</div>
                <div class="swiper-slide">Slide 3</div>
                <div class="swiper-slide">Slide 4</div>
                <div class="swiper-slide">Slide 5</div>
                <div class="swiper-slide">Slide 6</div>
                <div class="swiper-slide">Slide 7</div>
                <div class="swiper-slide">Slide 8</div>
                <div class="swiper-slide">Slide 9</div>
                
            </div>
            <div class="swiper-pagination"></div>
        </div>
        

    </div>


    <?php require('inc/footer.php'); ?>
   

    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>

    <!-- Initialize Swiper -->
    <script>
    var swiper = new Swiper(".mySwiper", {
        spaceBetween: 40 ,
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
            slidesPerView:3,
        },
        1024:{
            slidesPerView:3,
        },

      }
    });
    </script>

    </body>
</html>