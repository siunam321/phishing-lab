<?php
include_once "../template/en/header_footer.php";
getHeader();

if (isset($_POST["email"]) && isset($_POST["pass"]) && isset($_POST["login"])) {
    $receivedEmail = htmlspecialchars(trim(strval($_POST["email"])));
    $receivedPassword = htmlspecialchars(trim(strval($_POST["pass"])));
    $receivedLogin = htmlspecialchars(trim(strval($_POST["login"])));
?>

<body class="container">
    <p class="lead bg-info text-center fs-2">You've submitted your email and password!<br>
    The attacker will see the following information:</p>
    <hr>
    <table class="table table-success text-center fs-4">
        <thead>
            <tr>
                <th scope="col">Email</th>
                <th scope="col">Password</th>
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
    <p class="lead bg-danger text-warning text-center fs-1">Flag: flag{I_Have_Been_Phished!}</p>
</body>

<?php
}
?>

<script>
    document.getElementById('headerEnglish').className = 'nav-link active';
    document.getElementById('headerHome').className = 'nav-link';
</script>
<?php
getFooter();
?>