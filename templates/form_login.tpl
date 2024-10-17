<?php require 'templates/header.tpl'?>

<?php if ($error): ?>
    <div class='alert alert-danger' role='alert'>
        <?= $error ?>
    </div>
<?php endif ?>

<form method='post' action='login'>
    <div class='form-group'>
        <label for='usuario'>Usuario</label>
        <input type='text' class='form-control' id='usuario' name='usuario' required>
    </div>
    <div class='form-group'>
        <label for='password'>Password</label>
        <input type='password' class='form-control' id='password' name='password' required>
    </div>
    <button type='submit' class='btn btn-primary'>Login</button>
</form>

<?php require 'templates/footer.tpl' ?>
