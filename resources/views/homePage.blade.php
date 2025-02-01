<!DOCTYPE html>
<html lang="en">

<style>
body {
    margin: 0;
    font-family: 'Press Start 2P', cursive;
    background: linear-gradient(to bottom, #a0d8ef, #f8b6d2);
    text-align: center;
}

.navbar {
    background-color: #d3e0ea;
    padding: 10px 0;
}

.navbar a {
    color: #000;
    text-decoration: none;
    margin: 0 15px;
    font-size: 12px;
}

.header {
    padding: 50px 0;
}

.header img {
    width: 50px;
    height: 50px;
    margin: 0 10px;
}

.header h1 {
    font-size: 24px;
    margin: 20px 0 10px;
}

.header p {
    font-size: 10px;
}

.recap {
    font-size: 24px;
    margin: 50px 0;
    text-align: left;
    padding-left: 20px;
}

.about {
    background-color: #f8b6d2;
    padding: 50px 0;
}

.about h2 {
    font-size: 24px;
    margin-bottom: 20px;
}

.about p {
    font-size: 10px;
    width: 80%;
    margin: 0 auto 20px;
}

.guidebook-button {
    background-color: #d3e0ea;
    border: none;
    padding: 10px 20px;
    font-size: 12px;
    cursor: pointer;
}

.bubble {
    position: relative;
    display: inline-block;
    padding: 20px;
    background-color: #fff;
    border-radius: 50%;
    margin-top: 20px;
}

.bubble::after,
.bubble::before {
    content: '';
    position: absolute;
    background-color: #fff;
    border-radius: 50%;
}

.bubble::before {
    width: 20px;
    height: 20px;
    bottom: -10px;
    left: 50%;
    transform: translateX(-50%);
}

.bubble::after {
    width: 10px;
    height: 10px;
    bottom: -20px;
    left: 50%;
    transform: translateX(-50%);
}

.total-prize {
    background: white;
    display: inline-block;
    padding: 10px 20px;
    border-radius: 10px;
    margin-bottom: 20px;
}

.total-prize span {
    font-size: 24px;
    font-weight: bold;
    color: #ff69b4;
}

.prizes {
    display: flex;
    justify-content: center;
    align-items: flex-end;
    margin-bottom: 20px;
}

.prize {
    background: white;
    border-radius: 10px;
    padding: 10px;
    margin: 0 10px;
    width: 150px;
    text-align: center;
}

.prize img {
    width: 50px;
    height: 50px;
}

.prize-1 {
    background: #ffb6c1;
    height: 200px;
}

.prize-2 {
    background: #add8e6;
    height: 150px;
}

.prize-3 {
    background: #87ceeb;
    height: 100px;
}

.why-join {
    font-size: 24px;
    font-weight: bold;
    margin: 20px 0;
    color: #ff69b4;
}

.faq {
    background: #f5f5dc;
    padding: 20px;
    text-align: left;
}

.faq h2 {
    font-size: 18px;
    font-weight: bold;
    margin-bottom: 10px;
}

.faq-item {
    margin-bottom: 10px;
    display: flex;
    justify-content: space-between;
    align-items: center;
}

.faq-item i {
    margin-left: 10px;
}

@media (max-width: 600px) {
    .prizes {
        flex-direction: column;
        align-items: center;
    }

    .prize {
        margin: 10px 0;
    }
}

.timeline {
    margin: 20px 0;
}

.timeline h1 {
    font-size: 24px;
    font-weight: bold;
}

.timeline-item {
    margin: 20px 0;
    padding: 10px;
    border: 2px solid #000;
    display: flex;
    justify-content: center;
    align-items: center;
}

.timeline-item div {
    background: linear-gradient(to bottom, #4a90e2, #9013fe);
    color: #fff;
    padding: 10px;
    border-radius: 5px;
    width: 80%;
}

.juries {
    margin: 20px 0;
    position: relative;
    text-align: left;
}

.juries h2 {
    font-size: 18px;
    font-weight: bold;
    color: #fff;
    position: absolute;
    top: 50%;
    left: 0;
    transform: translateY(-50%);
    margin: 0;
    padding-left: 10px;
}

.jury-member {
    display: flex;
    justify-content: center;
    align-items: center;
    margin: 10px 0;
    position: relative;
}

.jury-member img {
    width: 100px;
    height: 150px;
    border-radius: 10px;
}

.jury-member div {
    position: absolute;
    bottom: 0;
    left: 50%;
    transform: translateX(-50%);
    background: rgba(0, 0, 0, 0.5);
    color: #fff;
    padding: 5px;
    border-radius: 5px;
    text-align: center;
}

.jury-member div h3 {
    font-size: 16px;
    margin: 5px 0;
}

.jury-member div p {
    font-size: 14px;
    margin: 0;
}

.sponsors {
    margin: 20px 0;
}

.sponsors h2 {
    font-size: 18px;
    font-weight: bold;
}

.sponsor-level {
    display: flex;
    justify-content: center;
    margin: 10px 0;
}

.sponsor-level div {
    background: #a7a7a7;
    color: #fff;
    padding: 10px;
    margin: 0 5px;
    border-radius: 5px;
    width: 80px;
    text-align: center;
}

.media-partners {
    display: flex;
    flex-wrap: wrap;
    justify-content: center;
    gap: 10px;
}

.media-partners img {
    width: 200px;
    height: 200px;
    object-fit: cover;
}

.contact-section {
    background: linear-gradient(to bottom, #cce0ff, #ffccff);
    padding: 40px 20px;
}

.contact-section h2 {
    font-size: 2em;
    margin-bottom: 20px;
}

.contact-form {
    display: flex;
    flex-direction: column;
    align-items: center;
    gap: 10px;
}

.contact-form input,
.contact-form textarea {
    width: 80%;
    max-width: 500px;
    padding: 10px;
    border: 1px solid #ccc;
    border-radius: 5px;
}

.contact-form textarea {
    height: 100px;
}

.contact-form button {
    padding: 10px 20px;
    background-color: #007bff;
    color: white;
    border: none;
    border-radius: 5px;
    cursor: pointer;
}

.contact-form button:hover {
    background-color: #0056b3;
}

.footer {
    background-color: #1a3b5d;
    /* Dark blue background */
    color: white;
    text-align: center;
    padding: 20px 0;
    font-family: Arial, sans-serif;
}

.footer-container {
    display: flex;
    justify-content: space-around;
    align-items: center;
    flex-wrap: wrap;
    margin-bottom: 20px;
}

.footer-section {
    margin: 10px;
}

.footer-section p {
    margin: 10px 0;
    font-size: 14px;
    font-weight: bold;
}

.footer-logo {
    width: 100px;
    /* Adjust size as needed */
    margin: 10px 0;
}

.footer-section.links a {
    display: block;
    margin: 5px 0;
    color: white;
    text-decoration: underline;
    font-size: 14px;
}

.footer-bottom {
    background-color: #27496d;
    /* Slightly lighter blue */
    padding: 10px 0;
    font-size: 14px;
}

.footer-bottom p {
    margin: 0;
    font-size: 12px;
}
</style>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hackathon</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
</head>

<body>
    <div class="navbar">
        <a href="{{ route('viewHome') }}">LOGO</a>
        <a href="{{ route('viewHome') }}">HOME</a>
        <a href="#">PRIZES</a>
        <a href="#">MENTOR & JURY</a>
        <a href="#">FAQ</a>
        <a href="#">ABOUT</a>
        <a href="#">TIMELINE</a>
        <a href="{{ route('loginView') }}">LOGIN</a>
    </div>
    <div class="header"><img alt="Image 1" /><img alt="Image 2" />
        <h1>HACKATHON 8.0 </h1>
        <p>BRIDGING THE DIGITAL DIVIDE: BUILDING SOLUTIONS FOR A BETTER WORLD </p><img alt="Image 3" /><img
            alt="Image 4" />
    </div>
    <div class="recap">RECAP </div>
    <div class="about">
        <h2>ABOUT HACKATHON 7.0 </h2>
        <div class="bubble">
            <p>Hackathon adalah kompetisi coding yang diselenggarakan oleh Bina Nusantara Computer Club (BNCC) di
                Universitas Bina Nusantara. Kompetisi ini merupakan bagian dari acara tahunan TechnoScape. </p><button
                class="guidebook-button">GUIDEBOOK </button>
        </div>
    </div>
    <div class="container">
        <div class="total-prize">
            <div>TOTAL PRIZE: </div><span>Rp. 15.000.000,
                - </span>
        </div>
        <div class="prizes">
            <div class="prize prize-2"><img alt="Image" />
                <div>Rp. 4.500.000 </div>
                <div>Certificate </div>
                <div>Merchandise </div>
            </div>
            <div class="prize prize-1"><img alt="Image" />
                <div>Rp. 8.500.000 </div>
                <div>Certificate </div>
                <div>Merchandise </div>
            </div>
            <div class="prize prize-3"><img alt="Image" />
                <div>Rp. 2.000.000 </div>
                <div>Certificate </div>
                <div>Merchandise </div>
            </div>
        </div>
        <div class="why-join">WHY YOU SHOULD JOIN? </div>
        <div class="faq">
            <h2>FAQ – <i>Frequently Asked Questions </i></h2>
            <div class="faq-item">Apa saja persyaratan untuk berpartisipasi di event Hackathon? <i
                    class="fas fa-chevron-down"></i></div>
            <div class="faq-item">Kapan batas waktu pendaftarannya? <i class="fas fa-chevron-down"></i></div>
            <div class="faq-item">Apakah event Hackathon ini dipungut biaya? <i class="fas fa-chevron-down"></i></div>
            <div class="faq-item">Bisakah saya bergabung dengan lebih dari satu tim? <i class="fas fa-chevron-down"></i>
            </div>
            <div class="faq-item">Berapa minimal serta maksimal individu per tim? <i class="fas fa-chevron-down"></i>
            </div>
            <div class="faq-item">Bagaimana jika para peserta sudah menyiapkan dan menggunakan source code sebelum acara
                dimulai? <i class="fas fa-chevron-down"></i></div>
            <div class="faq-item">Jika saya tidak memiliki dasar pemograman atau desain,
                bolehkah saya berpartisipasi? <i class="fas fa-chevron-down"></i></div>
            <div class="faq-item">Jika saya memiliki pertanyaan,
                siapa yang dapat saya hubungi? <i class="fas fa-chevron-down"></i></div>
        </div>
    </div>
    <div class="container">
        <div class="timeline">
            <h1>Timeline </h1>
            <div class="timeline-item">
                <div>
                    <p>day month year </p>
                    <p>Registration Opens </p>
                </div>
            </div>
            <div class="timeline-item">
                <div>
                    <p>day month year </p>
                    <p>Registration Close </p>
                </div>
            </div>
            <div class="timeline-item">
                <div>
                    <p>day month year </p>
                    <p>Technical Meeting </p>
                </div>
            </div>
            <div class="timeline-item">
                <div>
                    <p>day month year </p>
                    <p>Competition Day </p>
                </div>
            </div>
        </div>
        <div class="juries">
            <h2>Juries </h2>
            <div class="jury-member"><img alt="Photo" />
                <div>
                    <h3>Na Jaemin </h3>
                    <p>Senior UI/UX Designer </p>
                </div>
            </div>
        </div>
        <div class="sponsors">
            <h2>Our Sponsors </h2>
            <div class="sponsor-level">
                <div>platinum </div>
            </div>
            <div class="sponsor-level">
                <div>gold </div>
                <div>gold </div>
            </div>
            <div class="sponsor-level">
                <div>silver </div>
                <div>silver </div>
                <div>silver </div>
            </div>
        </div>
    </div>
    <div class="container">
        <h1>Our Media Partners </h1>
        <div class="media-partners"><img alt="Media Partner 1" /><img alt="Media Partner 2" /><img
                alt="Media Partner 3" /><img alt="Media Partner 4" /><img alt="Media Partner 5" /><img
                alt="Media Partner 6" /></div>
    </div>
    <div class="contact-section">
        <h2>Contact Us </h2>
        <form class="contact-form"><input placeholder="Name" type="text" /><input placeholder="Email"
                type="email" /><input placeholder="Subject" type="text" /><textarea
                placeholder="Reason for contacting us..."></textarea><button type="submit">Submit </button></form>
        <div class="socials"><span>Follow our socials </span><a href="#"><i class="fab fa-instagram"></i></a><a
                href="#"><i class="fab fa-twitter"></i></a><a href="#"><i class="fab fa-facebook"></i></a><a href="#"><i
                    class="fab fa-linkedin"></i></a><a href="#"><i class="fas fa-times"></i></a></div>
        <footer class="footer">
            <div class="footer-container">
                <div class="footer-section organized-by">
                    <p>Organized by</p><img src="" alt="Logo" class="footer-logo">
                    <p>Unit Kegiatan Mahasiswa<br>BNCC (Computer Club)<br>BINUS UNIVERSITY</p>
                </div>
                <div class="footer-section powered-by">
                    <p>Powered by</p><img src="" alt="Logo" class="footer-logo">
                </div>
                <div class="footer-section links"><a href="#">Privacy Policy</a><a href="#">Terms & Conditions</a></div>
            </div>
            <div class="footer-bottom">
                <p>All Rights Reserved BNCC 2025 © Bina Nusantara Computer Club</p>
            </div>
        </footer>
</body>

</html>