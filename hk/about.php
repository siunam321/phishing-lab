<?php
include_once "../template/hk/header_footer.php";
getHeader();

$currentPage = substr($_SERVER["SCRIPT_NAME"],strrpos($_SERVER["SCRIPT_NAME"],"/")+1);
?>
<body class="container">
    <div class="card">
        <div class="container card-body">
            <h1 class="bg-danger text-warning text-center" id="about-us">關於我哋</h1>
            <ul>
                <li>我哋係邊個？</li>
            </ul>
            <p>呢個網站係<a href="https://www.vtc.edu.hk/admission/tc/programme/it114122-higher-diploma-in-cybersecurity/" target="_blank">香港專業教育學院（IVE）嘅網絡安全高級文憑</a>學生嘅project。</p>
            <ul>
                <li>Project目標：</li>
            </ul>
            <p>希望年青人學識點樣喺網絡攻擊中學習同埋發展良好嘅網絡安全嘅意識。</p>
            <ul>
                <li>點解？</li>
            </ul>
            <p>根據聯合國（UN）嘅<a href="https://circular-taiwan.org/learn/sdgs/" target="_blank">可持續發展目標（SDG）</a>，人類需要實現17個目標，以消除貧困，保護地球，改善所有人嘅生活同埋前途：</p>
            <p><img class="img-fluid rounded" src="/assets/images/sdgs_zh.png" alt=""></p>
            <p>喺我哋嘅project入面，我哋揀咗SDG目標9：工業，創新同埋基礎設施。</p>
            <p>我哋都發現我哋嘅社區有一個問題：風險管理唔夠好。</p>
            <p>例如，未受教育嘅青少年可能會因為風險管理不善而意外洩露佢哋嘅個人資訊或其他數據。除咗咁，花費大量時間喺網絡上嘅青少年更加容易受騙局影響。</p>
            <ul>
                <li>Project預期結果：</li>
            </ul>
            <p>有兩個主要預期結果：</p>
            <ol>
                <li>擴大網絡安全知識，確保未受教育嘅青少年了解風險同埋保護資訊嘅重要性</li>
                <li>提高大家對網絡安全嘅意識</li>
            </ol>
            <ul>
                <li>Project成員：</li>
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
                    <li><p>PowerPoint：<a href="https://github.com/siunam321/phishing-lab/blob/main/SDD4006-Group-Project.pptx?raw=true" target="_blank">GitHub 下載link</a></p></li>
                </ul>
            </ul>
        </div>
    </div>
</body>

<script>
    document.getElementById('headerEnglish').href += '<?=$currentPage?>';
    document.getElementById('headerZH').href += '<?=$currentPage?>';
    document.getElementById('headerHK').href += '<?=$currentPage?>';
    
    document.getElementById('headerHK').className = 'nav-link active';
    document.getElementById('headerHome').className = 'nav-link';
    document.getElementById('headerAbout').className = 'nav-link active';
</script>
<?php
getFooter();
?>