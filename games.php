<?php include_once('static/header.php');
function displayActivies($i)
{
    $memb = '';
    $games = ['Football', 'Swimming', 'Volley', 'others'];
    foreach ($games as $ind => $game) {
        $memb .= '<div class="form-check">';
        $memb .= "<input class='form-check-input' type='checkbox'" . "value='" . $game . "' name='member_$i" . "[games][]";
        if (check($i, $game))
            $memb .= "' checked";
        else 
        $memb .= "'";
        $memb .=  ">" . "$game </div>";
    }
    $memb .= isset($_SESSION['error']["member_$i"]['games']) ? $_SESSION['error']["member_$i"]['games'] : "";
    return $memb;
}
function generateMember($i)
{
    $memb = '<div class="form-group mt-3">';
    $memb .= "<label for='$i' style='font-weight:bold;'>Member" . $i . "</label><input  type='input' class='form-control' id='" . $i;
    $memb .= "' name='member_" . $i . "[name]' value='" . (isset($_SESSION["member_$i"]['name']) ? $_SESSION["member_$i"]['name'] : "") . "'></div>";
    $memb .= isset($_SESSION['error']["member_$i"]['name']) ? $_SESSION['error']["member_$i"]['name'] : "";
    $memb .= displayActivies($i);
    echo $memb;
}
function check($i, $game)
{
    if (isset($_SESSION["member_$i"]['games']))
        return in_array($game, $_SESSION["member_$i"]['games']);
}

if (($_POST)) {
    $_SESSION['name'] = $_POST['name'];
    $_SESSION['family'] = $_POST['family'];
    $errors = [];
    if (!(isset($_POST['name']) and $_POST['name'])) {
        $errors['name'] = "<div class='text-center alert alert-danger mt-2'> Please enter your name</div>";
    }
    if (!(isset($_POST['family']) and $_POST['family'])) {
        $errors['family'] = "<div class='text-center alert alert-danger mt-2'> Please enter number of family member</div>";
    }
    if (($errors)) {
        $_SESSION['errors'] = $errors;
        header('location:info.php');
    }
}
?>
<div class='container mt-5'>
    <div class='row'>
        <div class='col-lg-10'>
            <form method='POST' action='subscribe.php'>
                <?php
                for ($i = 1; $i <= $_SESSION['family']; $i++) {
                    generateMember($i);
                }
                ?>
                <div class="form-group">
                    <button type="submit" class="btn btn-primary mt-5 form-control">Subscribe</button>
                </div>
            </form>
        </div>
    </div>
</div>
<?php
unset($_SESSION['error']);
include_once('static/footer.php') ?>