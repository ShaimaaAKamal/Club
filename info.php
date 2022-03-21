<?php include_once('static/header.php');?>
<div class='container mt-5'>
        <div class='row'>
            <h1 class='col-lg-12 text-center'>Club system</h1>
            <div class='col-lg-6 offset-lg-3'>
                <form method='POST' action='games.php'>
                    <div class="form-group">
                        <label for="input1">Username</label>
                        <input type="text" class="form-control" id="input1" name='name' value='<?= isset($_SESSION['name'])?$_SESSION["name"]:"";?>'>
                    </div>
                    <?= isset($_SESSION['errors']['name'])?$_SESSION['errors']['name']:"";?>

                    <div class="form-group">
                        <label for="input2">Family members</label>
                        <input type="number" class="form-control" name='family' id="input2" value='<?= isset($_SESSION['family'])?$_SESSION["family"]:"";?>' >
                    </div>
                    <?= isset($_SESSION['errors']['family'])?$_SESSION['errors']['family']:"";?>
                    <div class="form-group">
                    <button type="submit" class="btn btn-danger form-control">Join club</button>
                    </div>      
                </form>
            </div>
        </div>
    </div>
<?php
unset($_SESSION['errors']);
 include_once('static/footer.php')?>
