<html>
	<head>
		<title>人间夜行 拉丁语在线练习</title>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
		<link rel="stylesheet" type="text/css" href="quiz.css" />
	</head>
	<body>
		<h1>拉丁语在线练习（试用版）</h1>
请选择以下形式的对应项：
<p>
<?php
include "la_data.php";
$ques=array_rand($dict);
echo $ques;

$anslst=array(0=>$dict[$ques]);
while(count($anslst)<4)
{
$ansop=array_rand($anspool);
array_push($anslst,$anspool[$ansop]);
$anslst=array_unique($anslst);
}
shuffle($anslst);
?>
</p>
<p>
<form method=post action=la_check.php>
<?php
echo "<input type=\"hidden\" name=\"ques\" value=\"".$ques."\">";
foreach ($anslst as $op)
{
echo "<input type=\"radio\" name=\"ans\" value=\"".$op."\">".$op."<br />";
}
?>
<input type="submit">
</form>
</p>
<p><a href="la_view.php">小抄列表</a></p>
<!-- Baidu Button BEGIN -->
<div class="bdsharebuttonbox"><a href="#" class="bds_more" data-cmd="more"></a><a href="#" class="bds_qzone" data-cmd="qzone" title="分享到QQ空间"></a><a href="#" class="bds_tsina" data-cmd="tsina" title="分享到新浪微博"></a><a href="#" class="bds_tqq" data-cmd="tqq" title="分享到腾讯微博"></a><a href="#" class="bds_renren" data-cmd="renren" title="分享到人人网"></a><a href="#" class="bds_weixin" data-cmd="weixin" title="分享到微信"></a></div>
<script>window._bd_share_config={"common":{"bdSnsKey":{},"bdText":"","bdMini":"2","bdMiniList":false,"bdPic":"","bdStyle":"0","bdSize":"16"},"share":{},"image":{"viewList":["qzone","tsina","tqq","renren","weixin"],"viewText":"分享到：","viewSize":"16"},"selectShare":{"bdContainerClass":null,"bdSelectMiniList":["qzone","tsina","tqq","renren","weixin"]}};with(document)0[(getElementsByTagName('head')[0]||body).appendChild(createElement('script')).src='http://bdimg.share.baidu.com/static/api/js/share.js?v=89860593.js?cdnversion='+~(-new Date()/36e5)];</script>
<!-- Baidu Button END -->

本站由人间夜行维护。访问人间夜行的主站：<a href="/" target="_blank">人间夜行</a><br /><script language="javascript" type="text/javascript" src="http://js.users.51.la/5319838.js"></script>
<noscript><a href="http://www.51.la/?5319838" target="_blank"><img alt="&#x6211;&#x8981;&#x5566;&#x514D;&#x8D39;&#x7EDF;&#x8BA1;" src="http://img.users.51.la/5319838.asp" style="border:none" /></a></noscript>
</body>
</html>
