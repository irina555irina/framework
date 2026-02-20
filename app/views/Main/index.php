
<h1>Main Index</h1>
<div class="container">
    
	<div id='answer'></div>
<button class="btn" id="send">SEND</button>
<br><br>


<?php if(!empty($authors)): ?>
	<?php foreach($authors as $author): ?>
		<div class="content-grid-info">
			<img src="/blog/images/post2.jpg" alt=""/>
			<div class="post-info">
				<h4><a href="<?=$author->id;?> "><?=$author->surname;?></a>  July 30, 2014 / 27 Comments</h4>
				<p><?=$author->name;?></p>
				<a href="single.html"><span></span>READ MORE</a>
			</div>
		</div>
	<?php endforeach; ?>
<?php else: ?>
	<h3>Authors not found</h3>
<?php endif; ?>


<div class="pagination">
	<p>Авторов: <?=count($authors);?> из 
	<?=$total;?></p>

	<?php if($pagination->countPages > 1): ?>
		<?=$pagination; ?>
	<?php endif; ?>

</div>






  <!-- <?php new \framework\widgets\menu\Menu([
	//'tpl' => WWW . '/menu/mymenu.php',
	'tpl' => WWW. '/menu/select.php',
	//'container' => 'ul',
	'container' => 'select',
	//'class' =>'mymenu',
	'class' => 'myselect',
	'table' => 'categories',
	'cache' => 60,
	'cacheKey' =>'menu_select',
]); ?>

<?php new \framework\widgets\menu\Menu([
	'tpl' => WWW . '/menu/mymenu.php',
	'container' => 'ul',
	'class' =>'mymenu',
	'table' => 'categories',
	'cache' => 60,
	'cacheKey' =>'menu_ul',
]); ?>

   -->


</div>

<script src="/js/test.js">
</script>

<script>
$(function() {
	$('#send').click(function(){
		//alert("hello irina");
		$.ajax({
			url: '/main/test',
			type: 'post',
			data: {'id': 2},
			success : function(res){
				//var data = JSON.parse(res);

				//console.log(data);
				//alert(data['answer']); // data.code
				//$('#answer').html('<p>'+data.answer+'</p>');
				$('#answer').html(res);
			
			},

			error: function(){
				alert("Error!");
			}

		});
	});
})
</script>


    <!--
        <?php 
    if (!empty($res)) : ?>
    <?php foreach($res as $item ): ?>
    <?= $item['surname']; ?><br>
    <?= $item['name']; ?><br> 
    <?= $item['lastname']; ?><br><br> 
    <?php endforeach; ?>
    <?php endif; ?>
    -->


    