<?php
session_start();

include_once 'includes/handle_contact.php';
include_once 'includes/handle_order.php';


include('partials/header.php');
?>

<body id="home" data-spy="scroll" data-target=".navbar-collapse">

    <?php include('partials/navbar.php'); ?>

   
    <div class="flexslider">
        <ul class="slides">
            <li>
                <img src="assets/images/slider-img1.jpg" alt="Pizza Image 1">
                <div class="flex-caption">
                    <h2 class="slider-title">We make Pizza</h2>
                    <h3 class="slider-subtitle">Fresh, clean, and delicious.</h3>
                    <p class="slider-description">Praesent tincidunt neque semper elementum gravida. Donec id euismod magna. Ut erat ligula, malesuada eu quam a, fringilla auctor augue.</p>
                </div>
            </li>
            <li>
                <img src="assets/images/slider-img2.jpg" alt="Pizza Image 2">
                <div class="flex-caption">
                    <h2 class="slider-title">Freshly Baked Pizza</h2>
                    <h3 class="slider-subtitle">Premium Quality, Finest Ingredients</h3>
                    <p class="slider-description">Donec id euismod magna. Ut erat ligula, malesuada eu quam a, fringilla auctor augue. Praesent tincidunt neque semper elementum gravida.</p>
                </div>
            </li>
        </ul>
    </div>

    <!-- ABOUT -->
    <section id="about" class="templatemo-section templatemo-top-130">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <h1 class="text-uppercase">Your Pizza Shop</h1>
                </div>
                <div class="col-md-6 col-sm-6">
                    <h3 class="text-uppercase padding-bottom-10">Another Baker</h3>
                    <p>Pizza responsive web template is provided by <a rel="nofollow" href="http://www.templatemo.com" target="_parent">templatemo</a> website. Feel free to download, adapt, and use this template for your websites. Credit goes to <a rel="nofollow" href="http://pixabay.com" target="_parent">Pixabay</a> for images used in this template.</p>
                    <p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet. Dolore magna aliquam erat volutpat.</p>
                    <p>Proin enim sem, ultricies sit amet convallis nec, sodales quis augue. Duis consequat felis ac justo luctus, a cursus tellus pharetra. In ullamcorper gravida enim id pulvinar.</p>
                </div>
                <div class="col-md-6 col-sm-6">
                    <img src="assets/images/about-img1.jpg" class="img-responsive img-bordered img-about" alt="about img">
                </div>
            </div>
        </div>
    </section>


    <!-- start gallery -->
    <section id="gallery" class="templatemo-section templatemo-light-gray-bg">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h2 class="text-center text-uppercase">Gallery</h2>
                    <hr>
                </div>
                <div class="col-md-4 col-sm-4">
                    <div class="gallery-wrapper">
                        <img src="assets/images/gallery-img1.jpg" class="img-responsive gallery-img" alt="Pizza 1">
                        <div class="gallery-des">
                            <h3>Margherita</h3>
                            <h5>Cras in ante mattis, elementum nunc sed.</h5>
                        </div>
                    </div>
                </div>  
                <div class="col-md-4 col-sm-4">
                    <div class="gallery-wrapper">
                        <img src="assets/images/gallery-img2.jpg" class="img-responsive gallery-img" alt="Pizza 2">
                        <div class="gallery-des">
                            <h3>Pepperoni</h3>
                            <h5>In ullamcorper gravida enim id pulvinar</h5>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 col-sm-4">
                    <div class="gallery-wrapper">
                        <img src="assets/images/gallery-img3.jpg" class="img-responsive gallery-img" alt="Pizza 3">
                        <div class="gallery-des">
                            <h3>Hawaiian</h3>
                            <h5>Maecenas efficitur nisi id sapien</h5>
                        </div>
                    </div>
                </div>
                             
            </div>
        </div>
    </section>
    <!-- end gallery -->

    <!-- CONTACT -->
    <section id="contact" class="templatemo-section">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h2 class="text-uppercase text-center">Contact Us</h2>
                    <hr>
                </div>
                <div class="col-md-2"></div>
                <div class="col-md-8">


<?php if (!empty($_SESSION['contact_errors'])): ?>
    <div class="alert alert-danger">
        <ul>
            <?php foreach ($_SESSION['contact_errors'] as $error): ?>
                <li><?= htmlspecialchars($error) ?></li>
            <?php endforeach; ?>
        </ul>
    </div>
    <?php unset($_SESSION['contact_errors']); ?>
<?php endif; ?>

<?php if (!empty($_SESSION['contact_success'])): ?>
    <div class="alert alert-success">
        <?= htmlspecialchars($_SESSION['contact_success']) ?>
    </div>
    <?php unset($_SESSION['contact_success']); ?>
<?php endif; ?>

<?php
$contactData = $_SESSION['contact_data'] ?? [];
unset($_SESSION['contact_data']);
?>



                    <form action="#contact" method="post" role="form">
                        <div class="col-md-6 col-sm-6">
							<input name="name" type="text" class="form-control" maxlength="60" placeholder="Name" required value="<?= htmlspecialchars($contactData['name'] ?? '') ?>">
							<input name="email" type="email" class="form-control" placeholder="Email" required value="<?= htmlspecialchars($contactData['email'] ?? '') ?>">
							<input name="message" type="text" class="form-control" placeholder="Subject" value="<?= htmlspecialchars($contactData['subject'] ?? '') ?>">
                        </div> 
			
                        <div class="col-md-6 col-sm-6">
                            <textarea name="textarea" class="form-control" rows="5" placeholder="Message" required><?= htmlspecialchars($contactData['message'] ?? '') ?></textarea>
                        </div>
                        <div class="col-md-offset-3 col-md-6 col-sm-offset-3 col-sm-6">
                            <input name="submit" type="submit" class="form-control" value="Send">
                        </div>
                    </form>
                </div>
                <div class="col-md-2"></div>
                <div class="col-md-4 col-sm-4">
                    <h3 class="padding-bottom-10 text-uppercase">Visit our shop</h3>
                    <p><i class="fa fa-map-marker contact-fa"></i> 63 Another Walking Street, BKK 18080</p>
                    <p><i class="fa fa-phone contact-fa"></i> 
                        <a href="tel:010-020-0340" class="contact-link">010-020-0340</a>, 
                        <a href="tel:080-090-0660" class="contact-link">080-090-0660</a>
                    </p>
                    <p><i class="fa fa-envelope-o contact-fa"></i> 
                        <a href="mailto:hello@company.com" class="contact-link">hello@company.com</a>
                    </p>
                </div>
                <div class="col-md-4 col-sm-4">
                    <h3 class="text-uppercase">Opening hours</h3>
                    <p><i class="fa fa-clock-o contact-fa"></i> 7:00 AM - 11:00 PM</p>
                    <p><i class="fa fa-bell-o contact-fa"></i> Monday to Friday and Sunday</p>
                    <p><i class="fa fa-download contact-fa"></i> 
                        <a class="contact-link" rel="nofollow" href="http://fontawesome.io/icons/" target="_blank">Change Icons</a>
                    </p>
                </div>
            </div>
        </div>
    </section>

    <!-- ORDER -->
    <section id="order" class="templatemo-section templatemo-light-gray-bg">
    <div class="container">
        <h2 class="text-uppercase text-center">Order Your Pizza</h2>
        <hr>


<?php if (!empty($_SESSION['order_errors'])): ?>
    <div class="alert alert-danger">
        <ul>
            <?php foreach ($_SESSION['order_errors'] as $error): ?>
                <li><?= htmlspecialchars($error) ?></li>
            <?php endforeach; ?>
        </ul>
    </div>
    <?php unset($_SESSION['order_errors']); ?>
<?php endif; ?>

<?php if (!empty($_SESSION['order_success'])): ?>
    <div class="alert alert-success">
        <?= htmlspecialchars($_SESSION['order_success']) ?>
    </div>
    <?php unset($_SESSION['order_success']); ?>
<?php endif; ?>

<?php
$data = $_SESSION['order_data'] ?? [];
unset($_SESSION['order_data']);
?>



        <form action="includes/handle_order.php" method="post" role="form">
            <div class="row">
                <div class="col-md-6 col-sm-6">
                    <div class="form-group">
                        <label for="name">Your Name:</label>
                        <input name="name" type="text" class="form-control" placeholder="Your Name" required value="<?= htmlspecialchars($data['name'] ?? '') ?>">
                    </div>
                    <div class="form-group">
                        <label for="phone">Phone Number:</label>
                        <input name="phone" type="text" class="form-control" placeholder="Phone Number" required value="<?= htmlspecialchars($data['phone'] ?? '') ?>">
                    </div>
                    <div class="form-group">
                        <label for="address">Delivery Address:</label>
                        <input name="address" type="text" class="form-control" placeholder="Delivery Address" required value="<?= htmlspecialchars($data['address'] ?? '') ?>">
                    </div>
                </div>
                <div class="col-md-6 col-sm-6">
                    <label class="text-uppercase">Select your pizza(s):</label>
                    <div class="form-group">
                        <div class="checkbox">
                            <label>
                                <input type="checkbox" name="pizza[Margherita][selected]" value="1" <?= isset($data['pizza']['Margherita']['selected']) ? 'checked' : '' ?>>
                                Margherita
                            </label>
                            <input type="number" class="form-control" name="pizza[Margherita][quantity]" min="0" value="<?= htmlspecialchars($data['pizza']['Margherita']['quantity'] ?? 0) ?>" placeholder="Quantity">
                        </div>

                        <div class="checkbox">
                            <label>
                                <input type="checkbox" name="pizza[Pepperoni][selected]" value="1" <?= isset($data['pizza']['Pepperoni']['selected']) ? 'checked' : '' ?>>
                                Pepperoni
                            </label>
                            <input type="number" class="form-control" name="pizza[Pepperoni][quantity]" min="0" value="<?= htmlspecialchars($data['pizza']['Pepperoni']['quantity'] ?? 0) ?>" placeholder="Quantity">
                        </div>

                        <div class="checkbox">
                            <label>
                                <input type="checkbox" name="pizza[Hawaiian][selected]" value="1" <?= isset($data['pizza']['Hawaiian']['selected']) ? 'checked' : '' ?>>
                                Hawaiian
                            </label>
                            <input type="number" class="form-control" name="pizza[Hawaiian][quantity]" min="0" value="<?= htmlspecialchars($data['pizza']['Hawaiian']['quantity'] ?? 0) ?>"
                                placeholder="Quantity">
                        </div>
                    </div>
                </div>
            </div> <!-- .row -->

            <div class="row" style="margin-top: 20px;">
                <div class="col-md-12 text-center">
                    <input type="submit" name="order_submit" class="btn btn-primary btn-lg" value="Place Order">
                </div>
            </div>
        </form>
    </div> <!-- .container -->
</section>
							


    <!-- footer -->
    <?php include('partials/footer.php'); ?>

    <script src="assets/js/jquery.js"></script>
    <script src="assets/js/bootstrap.min.js"></script>
    <script src="assets/js/plugins.js"></script>
    <script src="assets/js/smoothscroll.js"></script>
    <script src="assets/js/custom.js"></script>

</body>
</html>
