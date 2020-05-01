<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:53:"E:\www\trainlive\public/plugins/demo/view/widget.html";i:1516676889;}*/ ?>
<div class="well well-warning" style="display: inline-block;">
	<h2>ThinkCMF插件演示</h2>
	<p>
		<b>主页:</b><a href ="<?php echo cmf_plugin_url('Demo://Index/index'); ?>" target="_blank" >访问</a>
	</p>
	<p>
		<b>后台管理:</b><a href ="<?php echo cmf_plugin_url('Demo://AdminIndex/index'); ?>" target="_blank" >访问</a>
	</p>
	<p>
		<b>插件根目录:</b>/plugins/demo
	</p>

	<p>
		<b>插件模板根目录:</b>/plugins/demo/view
	</p>

	<p>
		<b>文本:</b><?php echo $text; ?>
	</p>
	<p>
		<b>密码:</b><?php echo $password; ?>
	</p>

	<?php  $select_options=array( '1'=>'ThinkCMFX', '2'=>'ThinkCMF',
		'3'=>'跟猫玩糗事', '4'=>'门户应用' );  ?>

	<p>
		<b>下拉列表:</b><?php echo $select_options[$select]; ?>
	</p>

	<?php  $checkbox_options=array( '1'=>'genmaowan.com',
		'2'=>'www.thinkcmf.com', );  ?>

	<p>
		<b>多选框:</b>
		<?php if(is_array($checkbox) || $checkbox instanceof \think\Collection || $checkbox instanceof \think\Paginator): if( count($checkbox)==0 ) : echo "" ;else: foreach($checkbox as $key=>$vo): ?><?php echo $checkbox_options[$vo]; endforeach; endif; else: echo "" ;endif; ?>
	</p>

	<?php  $radio_options=array( '1'=>'ThinkCMFX', '2'=>'ThinkCMF' );
	 ?>
	<p>
		<b>单选框:</b><?php echo $radio_options[$radio]; ?>
	</p>

	<p>
		<b>多行文本:</b><?php echo $textarea; ?>
	</p>

</div>
