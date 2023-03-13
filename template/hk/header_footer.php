<?php 
function getHeader(){
?>
<!-- Modify header here -->
<!DOCTYPE html>
<html lang="zh-Hant">
    <head>
        <!-- meta tag -->
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta property="og:image" content="https://phishing-lab.infinityfreeapp.com/assets/images/ogimage.jpg" />
        <meta property="og:description" content="歡迎來臨！你會喺到學到有關釣魚攻擊嘅知識！" />
        <meta name="description" content="歡迎來臨！你會喺到學到有關釣魚攻擊嘅知識！！">
        <meta property="og:title" content="釣魚網站 101 — 互動式釣魚攻擊教學" />
        <meta property="og:locale" content="zh_HK" />
        <meta property="og:url" content="https://phishing-lab.infinityfreeapp.com/zh/" />
        <meta property="og:site_name" content="互動式釣魚攻擊教學" />
        <meta property="og:type" content="website" />
        <meta name="twitter:card" content="summary" />
        <meta property="twitter:title" content="釣魚網站 101 — 互動式釣魚攻擊教學" />
        <!-- meta tag -->
        <title>釣魚網站 101 - 互動式釣魚攻擊教學</title>
        <!-- Main CSS styles -->
        <link rel="stylesheet" href="/assets/css/styles.css">
        <!-- Main CSS styles -->
        <!-- Bootstrap 5.2.3 CSS framework minified CSS  -->
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
        <!-- Bootstrap 5.2.3 CSS framework minified CSS  -->
        <!-- jQuery -->
        <script src="https://code.jquery.com/jquery-3.6.3.min.js" integrity="sha256-pvPw+upLPUjgMXY0G+8O0xUf+/Im1MZjXxxgOcBQBXU=" crossorigin="anonymous"></script>
        <!-- jQuery -->
        <!-- Boostrap 5.2.3 CSS framework JavaScript -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.min.js" integrity="sha384-cuYeSxntonz0PPNlHhBs68uyIAVpIIOZZ5JqeqvYYIcEL727kskC66kF92t6Xl2V" crossorigin="anonymous"></script>
        <!-- Boostrap 5.2.3 CSS framework JavaScript -->
    </head>
    <!-- DOMPurify -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/dompurify/3.0.0/purify.js" integrity="sha512-Jv1LuJlYi60auZ8kNw/Yjzpk0MK2mwF2OhA51j+fZZMcNvctE/S8KODl0kpnwa4emUs9Etz0hxOkp0wNpbvpnQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <!-- DOMPurify -->
    <!-- favicon -->
    <link rel="shortcut icon" type="image/x-icon" href="/assets/images/favicon.ico">
    <!-- favicon -->
    <!-- Header -->
    <header class="d-flex flex-wrap justify-content-center py-3 mb-4 border-bottom">
      <a href="index.php" class="d-flex align-items-center mb-3 mb-md-0 me-md-auto text-dark text-decoration-none">
        <span class="bi mx-2" width="40" height="32"></span>
        <span class="fs-4 mx-4 mb-2">互動式釣魚攻擊教學</span>
      </a>
      <ul class="nav nav-pills bi mx-4 mb-2">
        <li class="nav-item"><a href="/en/" class="nav-link" aria-current="page" id="headerEnglish">English</a></li>
        <li class="nav-item"><a href="/zh/" class="nav-link" id="headerZH">繁體中文</a></li>
        <li class="nav-item"><a href="/hk/" class="nav-link" id="headerHK">廣東話</a></li>
      </ul>
      <ul class="nav nav-pills bi mx-4">
        <li class="nav-item"><a href="index.php" class="nav-link active" aria-current="page" id="headerHome">主頁</a></li>
        <li class="nav-item"><a href="about.php" class="nav-link" id="headerAbout">關於</a></li>
        <li class="nav-item"><a href="contact.php" class="nav-link" id="headerContact">聯絡我們</a></li>
      </ul>
    </header>
    <!-- Header -->
<!-- Modify header here -->
<?php
}
?>

<?php
function getFooter(){
?>
<!-- Modify footer here -->
    <footer></footer>
</html>
<!-- Modify footer here -->
<?php
}
?>