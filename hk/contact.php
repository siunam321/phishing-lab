<?php
include_once "../template/hk/header_footer.php";
getHeader();

$currentPage = substr($_SERVER["SCRIPT_NAME"],strrpos($_SERVER["SCRIPT_NAME"],"/")+1);
?>
<body class="container">
    <div class="card">
        <div class="container card-body text-center fs-2">
            <h1 class="bg-danger text-warning" id="contact-us">聯絡我哋</h1>
            <p>想同我哋聯絡？你可以透過以下嘅方式聯絡我哋：<br>
            Email：it114122.1c.sdd4006.ca@gmail.com</p>
        </div>
    </div>
</body>

<script>
    document.getElementById('headerEnglish').href += '<?=$currentPage?>';
    document.getElementById('headerZH').href += '<?=$currentPage?>';
    document.getElementById('headerHK').href += '<?=$currentPage?>';
    
    document.getElementById('headerHK').className = 'nav-link active';
    document.getElementById('headerHome').className = 'nav-link';
    document.getElementById('headerContact').className = 'nav-link active';
</script>
<?php
getFooter();
?>