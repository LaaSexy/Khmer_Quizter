<style>
    @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap');

    body {
        line-height: 1.5;
        font-family: 'Poppins', sans-serif;
        min-height: 100vh;
        margin: 0;
        padding: 0;
        display: flex;
        flex-direction: column;
    }

    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
    }

    .container {
        max-width: 1170px;
        margin: auto;
        transition: 0.3s;
    }

    .row {
        display: flex;
        flex-wrap: wrap;
    }

    ul {
        list-style: none;
    }

    .footer {
        background-color: #D9D9D9;
        padding: 70px 0;

    }

    .footer-col {
        width: 25%;
        padding: 0 15px;
    }

    .footer-col h4 {
        font-size: 18px;
        color: #CE0037;
        text-transform: capitalize;
        margin-bottom: 35px;
        font-weight: 500;
        position: relative;
    }

    .footer-col h4::before {
        content: '';
        position: absolute;
        left: 0;
        bottom: -10px;
        background-color: #e91e63;
        height: 2px;
        box-sizing: border-box;
        width: 50px;
    }

    .footer-col ul li:not(:last-child) {
        margin-bottom: 10px;
    }

    .footer-col ul li a {
        font-size: 16px;
        text-transform: capitalize;
        color: black;
        text-decoration: none;
        font-weight: 300;
        display: block;
        transition: all 0.3s ease;
    }

    .footer-col ul li a:hover {
        color: #CE0037;
        padding-left: 8px;
    }

    .footer-col .social-links a {
        display: inline-block;
        height: 40px;
        width: 40px;
        background-color: rgba(255, 255, 255, 0.2);
        margin: 0 10px 10px 0;
        text-align: center;
        line-height: 40px;
        border-radius: 50%;
        color: #CE0037;
        transition: all 0.5s ease;
    }

    .footer-col .social-links a:hover {
        color: white;
        background-color: #CE0037;
    }

    /*responsive*/
    @media(max-width: 767px) {
        .footer-col {
            width: 50%;
            margin-bottom: 30px;
        }
    }

    @media(max-width: 574px) {
        .footer-col {
            width: 100%;
        }
    }
</style>

<link rel="stylesheet" href="css/style.css">
<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css">
</head>

<body>
    <br><br><br><br>
    <footer class="footer">
        <div class="container">
            <div class="row">
                <div class="footer-col">
                    <h4>SenQuiz</h4>
                    <ul>
                        <li><a href="#">about us</a></li>
                        <li><a href="home.php">join quiz</a></li>
                        <li><a href="create.php">create quiz</a></li>
                        <li><a href="findquiz.php">find quiz</a></li>
                    </ul>
                </div>
                <div class="footer-col">
                    <h4>Category</h4>
                    <ul>
                        <li><a href="#math">Mathematics</a></li>
                        <li><a href="#computer">Computer Science and Skills</a></li>
                        <li><a href="#game">Games</a></li>
                        <li><a href="#language">Language</a></li>
                        <li><a href="#general">General Knowledge</a></li>
                    </ul>
                </div>
                <div class="footer-col">
                    <h4>Popular</h4>
                    <ul>
                        <li><a href="#">Teacher</a></li>
                        <li><a href="#">Student</a></li>
                        <li><a href="#">All quiz</a></li>
                        <li><a href="#">Home</a></li>
                    </ul>
                </div>
                <div class="footer-col">
                    <h4>follow us</h4>
                    <div class="social-links">
                        <a href="#"><i class="fab fa-facebook-f"></i></a>
                        <a href="#"><i class="fab fa-twitter"></i></a>
                        <a href="#"><i class="fab fa-instagram"></i></a>
                        <a href="#"><i class="fab fa-linkedin-in"></i></a>
                    </div>
                </div>
            </div>
        </div>
    </footer>

</body>

</html>