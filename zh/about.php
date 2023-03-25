<?php
include_once "../template/zh/header_footer.php";
getHeader();

$currentPage = substr($_SERVER["SCRIPT_NAME"],strrpos($_SERVER["SCRIPT_NAME"],"/")+1);
?>
<body class="container">
    <div class="card">
        <div class="container card-body">
            <h1 class="bg-danger text-warning text-center" id="about-us">關於我們</h1>
            <ul>
                <li>我們是誰？</li>
            </ul>
            <p>這個網站是<a href="https://www.vtc.edu.hk/admission/tc/programme/it114122-higher-diploma-in-cybersecurity/" target="_blank">香港專業教育學院（IVE）的網絡安全高級文憑</a>的學生的課堂專案。</p>
            <ul>
                <li>專案目標：</li>
            </ul>
            <p>讓年輕人學習如何從網絡攻擊中學習並發展良好的網絡安全實踐。</p>
            <ul>
                <li>為什麼？</li>
            </ul>
            <p>根據聯合國（UN）的<a href="https://circular-taiwan.org/learn/sdgs/" target="_blank">可持續發展目標（SDG）</a>，人類需要實現17個目標，以消除貧困，保護地球，改善所有人的生活和前景：</p>
            <p><img class="img-fluid rounded" src="/assets/images/sdgs_zh.png" alt=""></p>
            <p>在我們的專案中，我們選擇了SDG目標9：工業，創新和基礎設施。</p>
            <p>我們還觀察到我們社區的一個問題是脆弱的風險管理。</p>
            <p>例如，未受教育的青少年可能會由於風險管理不善而意外洩露他們的個人信息或其他數據。此外，花費大量時間在互聯網上的青少年更容易受到騙局的影響。</p>
            <ul>
                <li>專案預期結果：</li>
            </ul>
            <p>有兩個主要預期結果：</p>
            <ol>
                <li>擴大網絡安全知識，確保未受教育的青少年了解風險和保護信息的重要性</li>
                <li>提高大家對網絡安全的意識</li>
            </ol>
            <ul>
                <li>專案成員：</li>
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
                <li>其他：</li>
                <ul>
                    <li><p>源代碼：<a href="https://github.com/siunam321/phishing-lab" target="_blank">GitHub</a></p></li>
                    <li><p>PowerPoint簡報：<a href="https://github.com/siunam321/phishing-lab/SDD4006-Group-Project.pptx" target="_blank">GitHub 下載鏈接</a></p></li>
                </ul>
            </ul>
        </div>
    </div>
</body>

<script>
    document.getElementById('headerEnglish').href += '<?=$currentPage?>';
    document.getElementById('headerZH').href += '<?=$currentPage?>';
    document.getElementById('headerHK').href += '<?=$currentPage?>';
    
    document.getElementById('headerZH').className = 'nav-link active';
    document.getElementById('headerHome').className = 'nav-link';
    document.getElementById('headerAbout').className = 'nav-link active';
</script>
<?php
getFooter();
?>