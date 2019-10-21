<?php get_header(); ?>

<?php get_template_part('header_html'); ?>


<div class="div404" style="position:relative;">
		
	<div class="sub404">
	<img id="plop" src="<?php echo get_template_directory_uri(); ?>/img/logo-praemium-immobilier-bw2.png" alt="">
		<h1 style="clear:both;">404</h1>
		<p>La page que vous cherchez n’existe pas<br>Vous serez redirigé vers notre homepage dans quelques secondes</p>
		<!-- <a href="http://praemium.ch" class="bouton404">Retour vers praemium.ch >></a> -->
	</div>
</div>



<style>
/*img#plop:after{
	content: '';
	box-shadow: 0 0 100px rgba(0,0,0,0.3);
	height: 100%;
	width: 100%;
	position: absolute;
	top: 0;
	left:0;
	border-radius: 10px;
}*/

</style>

<?php // phpinfo(); ?>


<?php get_template_part('footer_html'); ?>
<?php //get_footer(); ?>

<script type="text/javascript">
	setTimeout(function(){
		console.log('redirect to praemium.ch');
		window.location.href='http://praemium.ch';
	}, 8000);
</script>
