<?php include_once('static/header.php');
function checkErrors($post)
{
    $errors = [];
    foreach ($post as $key => $value) {
        if (isset($value['name']) and empty($value['name']))
                {$errors[$key]['name'] = "<div class='text-center alert alert-danger mt-2'> Please enter the member name</div>";
                    $_SESSION[$key]['name']="";
                 }
        else $_SESSION[$key]['name']=$value['name'];
        if(!isset($value['games'])) 
        {$errors[$key]['games'] = "<div class='text-center alert alert-danger mt-2'> Please choose game</div>"; 
            $_SESSION[$key]['games']=[];

        }
        else  $_SESSION[$key]['games']=$value['games'];
    }
    return $errors;
}
function subdisplay($array, $i)
{
    $entry = '';
    $total = 0;
    $games = ['Football', 'Swimming', 'Volley', 'others'];
    foreach ($games as $ind => $game) {
        if (in_array($game,$array["member_$i"]['games'])) {
            $entry .= "<td>" . $game. "</td>";
            $total += getActPrice($game);
        } else {
            $entry .= "<td></td>";
            $total += 0;
        }
    }
    $entry .= "<td>$total</td></tr>";
    return [$entry,$total];
}
function getActPrice($input)
{
    switch ($input) {
        case 'Football':
            return 300;
            break;
        case 'Swimming':
            return 250;
            break;
        case 'Volley':
            return 150;
            break;
        case 'others':
            return 100;
            break;
        default:
            return 0;
    }
}
function eachClub($array,$input){
    $num=0;
    for($i=1;$i<=( $_SESSION['family']);$i++){
         if(in_array($input,$array["member_$i"]['games'])) 
         $num++; 
    }
    return $num;
}
function total_subscription(){
    return $_SESSION['family']*2500+10000;
}
function total_paid($amount){
    return total_subscription()+$amount;
}


if ($_POST) {

    IF(checkErrors($_POST)){
        $_SESSION['error']=checkErrors($_POST);
        header('location:games.php');
    }
}
   
?>

    <div class='container mt-5'>
        <div class='row text-center'>
            <div class='col-lg-10 offset-lg-1'>
                <div class='text-center mb-3 mt-3 h3'> Club pricing </div>
                <table class="table table-striped">
                    <tr class="bg-primary">
                        <td>Subscriber</td>
                        <td colspan='5' class='text-right'><?= ucfirst($_SESSION['name']) ?></td>
                    </tr>
                    <tr class='text-center'>
                        <th scope="col">Member name</th>
                        <th scope="col">Activity_1</th>
                        <th scope="col">Activity_2</th>
                        <th scope="col">Activity_3</th>
                        <th scope="col">Activity_4</th>
                        <th scope="col">Member Amount</th>
                    </tr>
                    <?php
                
                    $totalAmount=0;
                    for ($i = 1; $i <= $_SESSION['family']; $i++) {
                        $entry = "<tr class='text-center'><td>" . $_POST["member_$i"]['name'] . "</td>";
                        $entry .= subdisplay($_POST, $i)[0];
                        $totalAmount+=subdisplay($_POST, $i)[1];
                        echo $entry;
                    }
                    ?>
                    <tr class="bg-primary">
                        <td>Total Price</td>
                        <td colspan='5' class='text-right'><?= $totalAmount ?> L.E</td>
                    </tr>
                        <?php
                        $activities=['Football','Swimming','Volley','others'];
                        foreach($activities as $ind=>$activity){
                            echo("<tr><td colspan='2'>$activity Club</td>");
                            ?>
                             <td colspan='4' class='text-right'><?=eachClub($_POST,$activity)*getActPrice($activity)?> L.E</td></tr>
                        <?php } ?>
                        <tr class="bg-primary">
                        <td>Club subscription</td>
                        <td colspan='5' class='text-right'><?= total_subscription()?> L.E</td>
                    </tr>
                    <tr class="bg-primary">
                        <td>Total Paid</td>
                        <td colspan='5' class='text-right'><?= total_paid($totalAmount)?> L.E</td>
                    </tr>
                </table>
            </div>
        </div>
    </div>
    <?php
    include_once('static/footer.php') ?>