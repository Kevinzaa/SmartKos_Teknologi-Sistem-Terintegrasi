<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome to SmartKos</title>
    <link rel="stylesheet" href="<?= base_url('css/style.css'); ?>">
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f9f9f9;
            color: #333;
        }

        .hero {
            background: linear-gradient(to right, #007BFF, #0056b3);
            color: white;
            text-align: center;
            padding: 80px 20px;
            border-bottom-left-radius: 50% 10%;
            border-bottom-right-radius: 50% 10%;
        }

        .hero h1 {
            font-size: 2.5rem;
            margin-bottom: 10px;
        }

        .hero p {
            margin-top: 0;
            font-size: 1.2rem;
            margin-bottom: 20px;
        }

        .hero .btn {
            padding: 10px 30px;
            font-size: 16px;
            color: #007BFF;
            background-color: white;
            text-decoration: none;
            border-radius: 5px;
            font-weight: bold;
            transition: background-color 0.3s ease, color 0.3s ease;
        }

        .hero .btn:hover {
            background-color: #333;
            color: white;
        }

        .features {
            max-width: 1200px;
            margin: 40px auto;
            padding: 20px;
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 20px;
        }

        .feature-card {
            background: white;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            padding: 20px;
            text-align: center;
        }

        .feature-card img {
            max-width: 100px;
            margin-bottom: 15px;
        }

        .feature-card h3 {
            font-size: 1.2rem;
            margin-bottom: 10px;
            color: #007BFF;
        }

        .feature-card p {
            font-size: 0.95rem;
            color: #666;
        }

        .feature-card img {
            margin-bottom: 10px; /* Kurangi jarak bawah ikon */
            width: 60px;
            height: 60px;
        }

        .feature-card h3 {
            margin-top: 5px; /* Kurangi jarak atas teks */
            font-size: 18px;
            font-weight: bold;
            color: #2A7BE4;
            text-align: center;
        }

        footer {
            background: #333;
            color: white;
            text-align: center;
            padding: 29px 0;
            margin-top: 40px;
        }

        footer p {
            margin: 0;
            font-size: 0.9rem;
        }

        footer a {
            color: #007BFF;
            text-decoration: none;
        }

        footer a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>

    <!-- Hero Section -->
    <div class="hero">
        <h1>Welcome to SmartKos</h1>
        <p>Laporkan permasalahan kos secara mudah dan efisien.</p>
        <a href="<?= base_url('/register'); ?>" class="btn">Get Started</a>
    </div>

    <!-- Features Section -->
    <div class="features">
        <div class="feature-card">
            <img src="<?= base_url('img/report.png'); ?>" alt="Report Icon">
            <h3>Report Issues</h3>
            <p>Easily report any issues in your room or environment with a few clicks.</p>
        </div>
        <div class="feature-card">
            <img src="<?= base_url('img/status.png'); ?>" alt="Track Icon">
            <h3>Track Progress</h3>
            <p>Keep track of your report status in real-time with instant updates.</p>
        </div>
        <div class="feature-card">
            <img src="<?= base_url('img/support.png'); ?>" alt="Support Icon">
            <h3>24/7 Support</h3>
            <p>Get assistance anytime you need it, with our dedicated support team.</p>
        </div>
    </div>

    <!-- Footer Section -->
    <footer>
        <p>&copy; <?= date('Y'); ?> SmartKos. 18222072.</p>
    </footer>

</body>
</html>
