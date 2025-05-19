<?php
// index.php

// Example: Google Ratings (mocked for this example)
$googleRating = 4.8; // Replace this with dynamic data from Google API
$reviewCount = 120; // Replace this with actual review count
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Guesthouse Booking</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <!-- Guesthouse Information -->
    <section id="guesthouse-info">
        <h1>Welcome to Our Guesthouse</h1>
        <p>Our guesthouse is a cozy retreat located in the heart of [Location]. With modern amenities and a welcoming atmosphere, we offer the perfect place to relax and unwind. Whether you're visiting for a weekend getaway or a longer stay, we strive to provide a memorable experience for every guest.</p>
        <p><strong>Location:</strong> [Guesthouse Address]</p>
        <p><strong>Facilities:</strong> Free Wi-Fi, Comfortable Rooms, Free Parking, Swimming Pool, Spa Services</p>
        <p><strong>Contact:</strong> [Phone Number] | [Email]</p>
    </section>

    <!-- Gallery Section -->
    <section id="gallery">
        <h2>Our Gallery</h2>
        <div class="gallery-images">
            <img src="image1.jpg" alt="Room 1">
            <img src="image2.jpg" alt="Room 2">
            <img src="image3.jpg" alt="Room 3">
            <!-- Add more images as needed -->
        </div>
    </section>

    <!-- Google Ratings Section -->
    <section id="google-ratings">
        <h2>Google Reviews</h2>
        <div class="ratings">
            <!-- Google Rating Placeholder -->
            <p>Rating: <strong><?php echo $googleRating; ?>/5</strong> based on <?php echo $reviewCount; ?> reviews</p>
            <a href="https://www.google.com/search?q=your-guesthouse-name" target="_blank">See more reviews on Google</a>
        </div>
    </section>

    <!-- Booking Form Section -->
    <section id="booking-form">
        <h2>Book Your Stay</h2>
        <form action="process-booking.php" method="POST">
            <div class="form-group">
                <label for="name">Full Name</label>
                <input type="text" id="name" name="name" required>
            </div>
            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" id="email" name="email" required>
            </div>
            <div class="form-group">
                <label for="checkin">Check-in Date</label>
                <input type="date" id="checkin" name="checkin" required>
            </div>
            <div class="form-group">
                <label for="checkout">Check-out Date</label>
                <input type="date" id="checkout" name="checkout" required>
            </div>
            <div class="form-group">
                <label for="guests">Number of Guests</label>
                <input type="number" id="guests" name="guests" min="1" required>
            </div>
            <button type="submit">Book Now</button>
        </form>
    </section>

    <script src="script.js"></script>
</body>
</html>
