<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Contact Us - Stylish</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    body {
      background-color: #f8f9fa;
    }
    .contact-container {
      background-color: white;
      padding: 40px;
      border-radius: 10px;
      box-shadow: 0 0 15px rgba(0,0,0,0.1);
    }
    .brand-name {
      color: #dc3545;
      font-weight: bold;
    }
  </style>
</head>
<body>
  <div class="container my-5">
    <div class="contact-container">
      <h1 class="text-center mb-4">Contact <span class="brand-name">Stylish</span></h1>
      <p class="text-center mb-4">Have questions, feedback, or need support? Reach out to us!</p>
      <form method="post" action="">
        <div class="mb-3">
          <label for="name" class="form-label">Your Name</label>
          <input type="text" class="form-control" id="name" name="name" required>
        </div>

        <div class="mb-3">
          <label for="email" class="form-label">Your Email</label>
          <input type="email" class="form-control" id="email" name="email" required>
        </div>

        <div class="mb-3">
          <label for="message" class="form-label">Your Message</label>
          <textarea class="form-control" id="message" name="message" rows="4" required></textarea>
        </div>

        <div class="text-center">
          <button type="submit" class="btn btn-danger">Send Message</button>
        </div>
      </form>
    </div>
  </div>
</body>
</html>
