<?php session_start(); // Start the session if it hasn't been started already ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>About Us - SAVOY-MOVIE</title>
    <link rel="stylesheet" href="./about.css">
</head>
<body>
    <?php include('header.php'); ?>

    <div class="about-us">
        <h1>About Us</h1>

        <section class="our-story">
            <h2>Our Story</h2>
            <p>SAVOY-MOVIE was founded with a passion for delivering unforgettable cinematic experiences. From our humble beginnings, we have grown into a renowned name in the film industry, known for our dedication to quality and innovation.</p>
        </section>

        <section class="mission-vision">
            <h2>Mission & Vision</h2>
            <p><strong>Mission:</strong> To create and deliver exceptional movie experiences that entertain, inspire, and captivate audiences around the world.</p>
            <p><strong>Vision:</strong> To be a leading force in the film industry, pushing the boundaries of storytelling and technology to create unforgettable moments.</p>
        </section>

        <section class="values-h2">
            <h2>Our Values</h2>
            <ul>
                <li><strong>Creativity:</strong> We believe in the power of imagination and originality.</li>
                <li><strong>Excellence:</strong> We strive for the highest standards in everything we do.</li>
                <li><strong>Integrity:</strong> We conduct our business with honesty and transparency.</li>
                <li><strong>Community:</strong> We are committed to giving back and making a positive impact.</li>
            </ul>
        </section>

        <section class="team">
  
        <h2>Meet the Team</h2>
        <div class="team-members">
            <div class="team-member">
                <h3>John Doe - Founder & CEO</h3>
                <p>John has over 20 years of experience in the film industry and a passion for storytelling.</p>
            </div>
            <div class="team-member">
                <h3>Jane Smith - Chief Operating Officer</h3>
                <p>Jane oversees our daily operations, ensuring everything runs smoothly.</p>
            </div>
            <div class="team-member">
                <h3>Michael Brown - Head of Production</h3>
                <p>Michael leads our production team with a keen eye for detail and innovation.</p>
            </div>
        </div>
    </section>

        <section  id="heading-two" class="services">
            <h2>What We Offer</h2>
            <ul>
                <li><strong>Film Production:</strong> From concept to completion, we handle all aspects of production.</li>
                <li><strong>Post-Production:</strong> Our state-of-the-art facilities ensure your film is polished to perfection.</li>
                <li><strong>Distribution:</strong> We help your film reach audiences around the globe.</li>
            </ul>
        </section>

        <section id="heading-two" class="milestones">
            <h2>Milestones and Achievements</h2>
            <ul>
                <li><strong>2020:</strong> Won the Best Picture award at the XYZ Film Festival.</li>
                <li><strong>2018:</strong> Released our first blockbuster hit, "Epic Journey."</li>
                <li><strong>2015:</strong> Established our state-of-the-art production studio.</li>
            </ul>
        </section>

        <section  id="heading-two" class="culture">
            <h2>Company Culture</h2>
            <p>We foster a creative and collaborative environment where our team can thrive. From team-building activities to community outreach, we believe in nurturing a positive and inclusive workplace.</p>
        </section>

        <section  id="heading-two" class="testimonials">
            <h2>Customer Testimonials</h2>
            <blockquote>
                <p>"SAVOY-MOVIE exceeded our expectations in every way. Their dedication and creativity brought our story to life."</p>
                <footer>— Sarah Lee, Director</footer>
            </blockquote>
            <blockquote>
                <p>"Working with SAVOY-MOVIE was a fantastic experience. Their team is professional, talented, and truly passionate about film."</p>
                <footer>— David Kim, Producer</footer>
            </blockquote>
        </section>

   <section  id="heading-two" class="map">
            <h2>OUR LOCATION</h2>
            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d15844.608943162575!2d79.85095958482862!3d6.872355690020541!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3ae25bc71061417b%3A0x20ffa0f7a9e8607b!2sSavoy%203D%20Cinema!5e0!3m2!1sen!2slk!4v1717841992006!5m2!1sen!2slk" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
      </section>

      <button id="Contact-us" onclick="openContactUsPage()">Contact US</button>

<script>
    function openContactUsPage() {
        window.location.href = 'contact_us.php'; 
    }
</script>

        <section  id="heading-two" class="join-us">
            <h2>Join Us</h2>
            <p>Want to be part of our journey? Connect with us on social media and subscribe to our newsletter for the latest updates.</p>
        </section>

     
    </div>

      

    <?php include('footer.php'); ?>

</body>
</html>
