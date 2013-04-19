<h1><?php echo $controller ?></h1>
<p>Action : <?php echo $action ?></p>
<p>Id : <?php echo $id ?></p>
<?php if($userinfo) foreach($userinfo as $key => $info): ?>
<p><?php echo "$key : $info" ?></p>
<?php endforeach; ?>
