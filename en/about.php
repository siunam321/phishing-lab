<?php
include_once "../template/en/header_footer.php";
getHeader();

$currentPage = substr($_SERVER["SCRIPT_NAME"],strrpos($_SERVER["SCRIPT_NAME"],"/")+1);
?>
<body class="container">
    <div class="card">
        <div class="container card-body">
            <h1 class="bg-danger text-warning text-center" id="about-us">About us</h1>
            <ul>
                <li>Who are we?</li>
            </ul>
            <p>This website is a group project comprised of students studying for a <a href="https://www.vtc.edu.hk/admission/en/programme/it114122-higher-diploma-in-cybersecurity/" target="_blank">Higher Diploma in Cybersecurity at Hong Kong Institution of Vocational Education (IVE)</a>.</p>
            <ul>
                <li>Project aim:</li>
            </ul>
            <p>How young people can learn from cyberattacks and develop good practices in cybersecurity.</p>
            <ul>
                <li>Why?</li>
            </ul>
            <p>According to the United Nations (UN)'s <a href="https://sdgs.un.org/goals" target="_blank">Sustainable Development Goals (SDG)</a>, humanity needs to achieve 17 goals to end poverty, protect the planet, and improve the lives and prospects of everyone, everywhere:</p>
            <p><img class="img-fluid rounded" src="/assets/images/sdgs.png" alt=""></p>
            <p>In our project, we have chosen SDG Goal 9: Industry, Innovation, and Infrastructure.</p>
            <p>We have also observed that one of our community's problems is weak risk management.</p>
            <p>For instance, uneducated teenagers may inadvertently leak their personal information or other data due to poor risk management. Moreover, teenagers, who spend a significant amount of time on the internet, are more vulnerable to scams.</p>
            <ul>
                <li>Project expected outcome:</li>
            </ul>
            <p>There are two main expected outcomes:</p>
            <ol>
                <li>Expand cybersecurity knowledge and ensure that uneducated teenagers understand the risks and the importance of safeguarding their information</li>
                <li>Increase participants' awareness of cybersecurity</li>
            </ol>
            <ul>
                <li>Project members:</li>
            </ul>
            <ol>
                <li>Mercado John Kenneth De Leon</li>
                <li>Ng Wing Yin</li>
                <li>Ko Chun Kit</li>
                <li>Dong Siu Him</li>
                <li>Hung Yat Shan</li>
                <li>Tang Cheuk Hei (siunam)</li>
            </ol>
            <ul>
                <li>Other:</li>
                <ul>
                    <li><p>Source code: <a href="https://github.com/siunam321/phishing-lab" target="_blank">GitHub</a></p></li>
                    <li><p>PowerPoint: <a href="#" target="_blank">GitHub download link</a></p></li>
                </ul>
            </ul>
        </div>
    </div>
</body>

<script>
    document.getElementById('headerEnglish').href += '<?=$currentPage?>';
    document.getElementById('headerZH').href += '<?=$currentPage?>';
    document.getElementById('headerHK').href += '<?=$currentPage?>';
    
    document.getElementById('headerEnglish').className = 'nav-link active';
    document.getElementById('headerHome').className = 'nav-link';
    document.getElementById('headerAbout').className = 'nav-link active';
</script>
<?php
getFooter();
?>