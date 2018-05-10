<?php
namespace Auto;
?></div>
</div>
<?php
if(!isset($current_user)){
    ?>
    <div class="page-mask" id="page-mask"></div>
    <div class="login-form" id="login_form">
        <a class="close" id="close_login_form">&times;</a>
        <form action="<?= Router::getLink('login'); ?>" method="POST">
            <input type="email" name="email" id="email" placeholder="Email cím">
            <input type="password" name="password" id="password" placeholder="Jelszó">
            <input type="submit" value="Bejelentkezés">
        </form>
    </div>
    <?php
}
?>
</body>
<script src="/js/jquery.js"></script>
<script src="/js/main.js"></script>
</html>