<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>HAPPYSTAY-CONTACT</title>
    <?php require('inc/links.php'); ?>
    <style>
      .pop:hover{
        border-top-color: var(--teal) !important;
        transform:scale(1.03);
        transition:all 0.3s;
      }
    </style>
    
</head>
<body class="bg-light">

<?php require('inc/header.php'); ?>

<div class="my-5 px-4">
  <h2 class="fw-bold h-font text-center">CONTACT US</h2>
  <div class="h-line bg-dark"></div>

    <p class="text-center mt-3">
      
    </p>
</div>




<div class="container">
  <div class="row">
    <div class="col-lg-6 col-md-6 mb-5 px-4">
      <div class="bg-white rounded shawdow p-4 ">
      <iframe src="<?php echo $contact_r['iframe'] ?>" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
        <h5>Adress</h5>
        <a href=">?php echo $contact_r['iframe'] ?>" target="_blank" class="d-inline-block text-decoration-none text-dark mb-2">
          <i class="bi bi-geo-alt-fill"></i> <?php echo $contact_r['address']?>
        </a>   
        <h5 class=" mb-4 mt-4">call us</h5>
        <a href="tel:+<?php echo $contact_r['pn1'] ?>" class="d-inline-block mb-2 text-decoration-none text-dark">
          <i class="bi bi-telephone-fill"></i> +<?php echo $contact_r['pn1']?>
        </a>
        <br>
        <a href="tel:+<?php echo $contact_r['pn2'] ?>" class="d-inline-block mb-2 text-decoration-none text-dark">
          <i class="bi bi-telephone-fill"></i> +<?php echo $contact_r['pn2']?>
        </a>

        
        <h5 class="mt-4 ">Email</h5>
            <i class="bi bi-envelope-at"></i> 
            <a href="mailto: <?php echo $contact_r['email']?>" class="d-inline-block text-decoration-none text-dark">
            <?php echo $contact_r['email']?>
        </a> 
       
        <h5 class="mt-4">Follow us</h5>
        <?php
              if($contact_r['tw']!='')
              {
                echo <<<data
                <a href="$contact_r[tw]" class="d-inline-block mb-3">
                <span class="badge bg-light text-dark fs-6 p-2">
                <i class="bi bi-twitter me-1"></i> 
                </span>
                </a> 
                data;
              }  
        ?>



           
        
        <a href="<?php echo $contact_r['fb']?>" class="d-inline-block text-dark fs-5 mb-3">
            <span class="badge bg-light text-dark fs-6 p-2">
             <i class="bi bi-facebook"></i> 
        </a>
        <a href="<?php echo $contact_r['insta']?>" class="d-inline-block">
            <span class="badge bg-light text-dark fs-6 p-2">
            <i class="bi bi-instagram"></i> 
        </a>
      </div>
    </div>
     <div class="col-lg-6 col-md-6 px-4">
      <div class="bg-white rounded shawdow p-4 ">
        <form method="POST">
            <h5>Send a message</h5>
            <div class="mb-3">
                <label class="form-label" style="font-weight: 500;">Name</label>
                <input name="name" required type="text" class="form-control shadow-none">
            </div>
            <div class="mb-3">
                <label class="form-label">Email</label>
                <input name="email" required type="email" class="form-control shadow-none">
                    
            </div>
            <div class="mb-3">
                 <label class="form-label">Subject</label>
                <input name="subject" required type="text" class="form-control shadow-none">        
            </div>
            <div class="mb-3">
                <label class="form-label">Message</label>
                <textarea name="message" required class="form-control shadow-none" rows="5" style="resize:none";></textarea>
            </div>
            <button name="send" type="submit" class="btn btn-dark shadow-none">SEND</button>


        </form>

    </div>
  </div>
</div>

<?php

if(isset($_POST['send']))
{
  $frm_data=filteration($_POST);


  $q= "INSERT INTO `user_queries`( `name`, `email`, `subject`, `message`) VALUES (?,?,?,?)";
  $values=[$frm_data['name'],$frm_data['email'],$frm_data['subject'],$frm_data['message']];

  $res=insert($q,$values,'ssss');
  if($res==1){
    alert('success','Mail sent!');
  }
  else{
    alert('error','Try again');
  }
}


?>



<?php require('inc/footer.php'); ?>

</body>
</html>