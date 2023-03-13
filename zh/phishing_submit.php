<?php
include_once "../template/zh/header_footer.php";
getHeader();

if (isset($_POST["email"]) && isset($_POST["pass"]) && isset($_POST["login"])) {
    $receivedEmail = htmlspecialchars(trim(strval($_POST["email"])));
    $receivedPassword = htmlspecialchars(trim(strval($_POST["pass"])));
    $receivedLogin = htmlspecialchars(trim(strval($_POST["login"])));
?>

<body class="container">
    <p class="lead bg-info text-center fs-2">你發送了你的電郵地址和密碼！<br>
    攻擊者會看到以下內容：</p>
    <hr>
    <table class="table table-success text-center fs-4">
        <thead>
            <tr>
                <th scope="col">電郵地址</th>
                <th scope="col">密碼</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td><?=$receivedEmail?></td>
                <td><?=$receivedPassword?></td>
            </tr>
        </tbody>
    </table>
    <hr>
    <p class="lead bg-danger text-warning text-center fs-1">旗幟: 旗幟{我被釣魚啦！}</p>
</body>

<?php
}
?>

<script>
    document.getElementById('headerZH').className = 'nav-link active';
    document.getElementById('headerHome').className = 'nav-link';
</script>
<?php
getFooter();
?>