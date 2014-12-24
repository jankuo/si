<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"><head>
<meta http-equiv="content-type" content="text/html; charset=UTF-8">
<meta charset="UTF-8">
<title>瀑布流定位</title>
<link href="css/default/style.css" rel="stylesheet" type="text/css">
<script type="text/javascript" src="http://s1.56img.com/script/lib/jquery/jquery-1.4.4.min.js"></script>
</head>
<body><!--height: 1463px-->
<div style="width: 1390px; visibility: visible;" id="wrap" class="wrap active">
   <script>
   var last =0;
   var ent  =0;
   var ori  =0;
   var mtv  =0;
   var sport=0;
   var game =0;   
   </script>
   <div id="hot_0"></div>
   <div id="ent_0"></div>
   <div id="ori_0"></div>
   <div id="mtv_0"></div>
   <div id="sport_0"></div>
   <div id="game_0"></div>
   <?php 
   foreach($hot as $k=>$v){?>
   <div style="left: 0px; visibility: visible;<?php if($k>0){?>margin-top:15px;<?php }?>" class="mode popup_in" id="hot_<?php echo ($k+1);?>" > 
       <p class="pic"><a href="http://dev.56.com/player.php?vid=<?php echo $v['vid'];?>" target="_blank"><img src="<?php echo $v['bimg']; ?>" style="height: 156px;"></a></p>
       <h3 class="tit"><span><a href="http://dev.56.com/player.php?vid=<?php echo $v['vid'];?>" target="_blank"><?php echo $v['title'];?></a></span></h3>
       <p><b>描述：</b><?php echo $v['content'];?></p>
       <p><b>用户名：</b><?php echo $v['user_id'];?></p>
       <p><b>评论数：</b><?php echo $v['comments'];?></p>
   </div>
   <script>
    last = last + $("#hot_<?php echo $k;?>").outerHeight(true);
    $("#hot_<?php echo $k+1;?>").css("top",last);
   </script>
   <?php }?>
   <?php foreach($ent as $k=>$v){?>
   <div style="left: 234px; visibility: visible;<?php if($k>0){?>margin-top:15px;<?php }?>" class="mode popup_in" id="ent_<?php echo ($k+1);?>" > 
       <p class="pic"><a href="http://dev.56.com/player.php?vid=<?php echo $v['vid'];?>" target="_blank"><img src="<?php echo $v['bimg']; ?>" style="height: 156px;"></a></p>
       <h3 class="tit"><span><a href="http://dev.56.com/player.php?vid=<?php echo $v['vid'];?>" target="_blank"><?php echo $v['title'];?></a></span></h3>
       <p><b>描述：</b><?php echo $v['content'];?></p>
       <p><b>用户名：</b><?php echo $v['user_id'];?></p>
       <p><b>评论数：</b><?php echo $v['comments'];?></p>
   </div>
   <script>
       var ent = ent + $("#ent_<?php echo $k;?>").outerHeight(true);
       $("#ent_<?php echo $k+1;?>").css("top",ent);
   </script>
   <?php }?>
   
   
   <?php foreach($ori as $k=>$v){?>
   <div style="left: 468px; visibility: visible;<?php if($k>0){?>margin-top:15px;<?php }?>" class="mode popup_in" id="ori_<?php echo ($k+1);?>" > 
       <p class="pic"><a href="http://dev.56.com/player.php?vid=<?php echo $v['vid'];?>" target="_blank"><img src="<?php echo $v['bimg']; ?>" style="height: 156px;"></a></p>
       <h3 class="tit"><span><a href="http://dev.56.com/player.php?vid=<?php echo $v['vid'];?>" target="_blank"><?php echo $v['title'];?></a></span></h3>
       <p><b>描述：</b><?php echo $v['content'];?></p>
       <p><b>用户名：</b><?php echo $v['user_id'];?></p>
       <p><b>评论数：</b><?php echo $v['comments'];?></p>
   </div>
   <script>
       var ori = ori + $("#ori_<?php echo $k;?>").outerHeight(true);
       $("#ori_<?php echo $k+1;?>").css("top",ori);
   </script>
   <?php }?>
   
   
   <?php foreach($mtv as $k=>$v){?>
   <div style="left:  702px; visibility: visible;<?php if($k>0){?>margin-top:15px;<?php }?>" class="mode popup_in" id="mtv_<?php echo ($k+1);?>" > 
       <p class="pic"><a href="http://dev.56.com/player.php?vid=<?php echo $v['vid'];?>" target="_blank"><img src="<?php echo $v['bimg']; ?>" style="height: 156px;"></a></p>
       <h3 class="tit"><span><a href="http://dev.56.com/player.php?vid=<?php echo $v['vid'];?>" target="_blank"><?php echo $v['title'];?></a></span></h3>
       <p><b>描述：</b><?php echo $v['content'];?></p>
       <p><b>用户名：</b><?php echo $v['user_id'];?></p>
       <p><b>评论数：</b><?php echo $v['comments'];?></p>
   </div>
   <script>
       var mtv = mtv + $("#mtv_<?php echo $k;?>").outerHeight(true);
       $("#mtv_<?php echo $k+1;?>").css("top",mtv);
   </script>
   <?php }?>
   
   
   <?php foreach($sport as $k=>$v){?>
   <div style="left:936px; visibility: visible;<?php if($k>0){?>margin-top:15px;<?php }?>" class="mode popup_in" id="sport_<?php echo ($k+1);?>" > 
       <p class="pic"><a href="http://dev.56.com/player.php?vid=<?php echo $v['vid'];?>" target="_blank"><img src="<?php echo $v['bimg']; ?>" style="height: 156px;"></a></p>
       <h3 class="tit"><span><a href="http://dev.56.com/player.php?vid=<?php echo $v['vid'];?>" target="_blank"><?php echo $v['title'];?></a></span></h3>
       <p><b>描述：</b><?php echo $v['content'];?></p>
       <p><b>用户名：</b><?php echo $v['user_id'];?></p>
       <p><b>评论数：</b><?php echo $v['comments'];?></p>
   </div>
   <script>
       var sport = sport + $("#sport_<?php echo $k;?>").outerHeight(true);
       $("#sport_<?php echo $k+1;?>").css("top",sport);
   </script>
   <?php }?>
   
   
   <?php foreach($game as $k=>$v){?>
   <div style="left:1170px; visibility: visible;<?php if($k>0){?>margin-top:15px;<?php }?>" class="mode popup_in" id="game_<?php echo ($k+1);?>" > 
       <p class="pic"><a href="http://dev.56.com/player.php?vid=<?php echo $v['vid'];?>" target="_blank"><img src="<?php echo $v['bimg']; ?>" style="height:156px;"></a></p>
       <h3 class="tit"><span><a href="http://dev.56.com/player.php?vid=<?php echo $v['vid'];?>" target="_blank"><?php echo $v['title'];?></a></span></h3>
       <p><b>描述：</b><?php echo $v['content'];?></p>
       <p><b>用户名：</b><?php echo $v['user_id'];?></p>
       <p><b>评论数：</b><?php echo $v['comments'];?></p>
   </div>
   <script>
       var game = game + $("#game_<?php echo $k;?>").outerHeight(true);
       $("#game_<?php echo $k+1;?>").css("top",game);
   </script>
   <?php }?>
    
</div>

<div id="aaa1" style="display:none;position: fixed;width:400px;height:200px;background:#000;color:#fff;top:30%;left:50%"></div>
</body></html>