<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        .footer {
            background-color: #517A8B;
            color: white;
            padding: 40px 20px;
            display: flex;
            flex-direction: column;
            align-items: center;
            margin-top: 40px;
        }

        .footer_content {
            display: flex;
            justify-content: space-around;
            width: 100%;
            max-width: 1200px;
        }

        .footer_section {
            flex: 1;
            margin: 20px;
        }

        .footer_section h3 {
            margin-bottom: 20px;
            font-size: 20px;
            border-bottom: 2px solid #F1C40F;
            padding-bottom: 10px;
        }

        .footer_section p,
        .footer_section a {
            font-size: 16px;
            line-height: 1.6;
            color: white;
            text-decoration: none;
        }

        .footer_section a:hover {
            color: #F1C40F;
        }

        .footer_section ul {
            list-style: none;
            padding: 0;
        }

        .footer_section ul li {
            margin-bottom: 10px;
        }

        .footer_bottom {
            margin-top: 20px;
            border-top: 1px solid #F1C40F;
            padding-top: 10px;
            width: 100%;
            text-align: center;
            font-size: 14px;
        }
    </style>
</head>

<body>
    <footer class="footer">
        <div class="footer_content">
            <div class="footer_section about">
                <h3>About Us</h3>
                <p>We are a leading company in fashion, providing top-quality products to our customers. Our mission is to deliver the best shopping experience.</p>
            </div>
            <div class="footer_section links">
                <h3>Quick Links</h3>
                <ul>
                    <li><a href="#">Home</a></li>
                    <li><a href="#">Products</a></li>
                    <li><a href="#">About Us</a></li>
                    <li><a href="#">Contact</a></li>
                </ul>
            </div>
            <div class="footer_section contact">
                <h3>Contact Us</h3>
                <p>Email: Clothee@gmail.com</p>
                <p>Phone: 09223344556</p>
            </div>
        </div>
        <div class="footer_bottom">
            &copy; 2024 Clothee. All Rights Reserved.
        </div>
    </footer>
</body>

</html>