<?php
if($_POST) {
    $name=$_POST['name'];
    $email=$_POST['email'];
    $comment=$_POST['comment'];

    include("logica/Comments.class.php");
    include("./logica/SendMail.class.php");

    Comments::saveComment($_POST["name"],$_POST["email"],$_POST["comment"]);

    $sendMail = new SendMail();

    $sendMail->sendFeedBackMail($_POST["email"],$_POST["name"],$_POST["comment"]);

}
else {

}
?>

<li>
    <ul class="meta">
        <li class="image"><img src="http://www.gravatar.com/avatar/ad516503a11cd5ca435acc9bb6523536?s=48" alt="Author's name" /></li>
        <li class="author"><a href="#"><?php echo $name;?></a></li>
        <li class="date">Posteado recien</li>

    </ul>
    <div class="body"><?php echo $comment;?></div>
</li>