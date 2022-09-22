		<?php if (get_field('macaron')) { ?>

			<div class="full-macaron">
				<div class="macaron-container">
					<div class="macaron">
						<div class="macaroninside"><?php echo get_field('texte_macaron'); ?> </div>

					</div>
				</div>
				<div class="flip-container">
					<div class="flip"></div>
				</div>
			</div>

			<div class="clear"></div>
			<?php $mft = get_field('macaron_fadeout_time'); ?>
			<?php if ($mft) : ?>
				<script>
					var macaroon_fadeout_time = <?php echo $mft; ?>;
				</script>
			<?php endif; ?>
		<?php } ?>

		<div id="header_container">
			<section class="titlesection" id="home">
				<div class="titlecontent">

					<div class="home_box_bg  ">
						<?php echo get_field('title_text'); ?>
						<div class="home_box_bg_inner  <?php echo get_field('text_background'); ?>"></div>
					</div>
				</div>
			</section>
			<?php get_template_part('navigation'); ?>
		</div>




		<?php

		if (have_rows('section')) {
			while (have_rows('section')) : the_row();

				if (get_row_layout() == 'fullimg') { ?>
					<section class="fullimg titlesection" style="background-attachment:fixed; background-image : url(<?php echo get_sub_field('image'); ?>)" <?php if (get_sub_field('id')) {
																																									echo 'id="' . get_sub_field('id') . '"';
																																								} ?>>
						<div class="titlecontent"><?php echo get_sub_field('text'); ?></div>
					</section>
				<?php }

				if (get_row_layout() == 'video') {  ?>

					<section class="video_section" style="background-image : url(<?php echo get_sub_field('image'); ?>)" <?php if (get_sub_field('id')) {
																																echo 'id="' . get_sub_field('id') . '"';
																															} ?>>

						<video playsinline muted loop poster="<?php echo get_sub_field('video'); ?>" id="" autoplay="autoplay"></video>
					</section>

				<?php	}

				if (get_row_layout() == 'slider') { ?>
					<section style="background:white" class="slider " <?php if (get_sub_field('id')) {
																			echo 'id="' . get_sub_field('id') . '"';
																		} ?>>

						<ul class="bxslider" style="height:100%">
							<?php while (have_rows('slide')) : the_row();
								if (get_sub_field('slide_type') == 'midmid') { ?>
									<li class="bxsliderli midmid">
										<div class="container-fluid">
											<div class="row <?php echo get_sub_field('background_color'); ?>">
												<div class="col-sm-6">
													<div class="slidepart fullimg" style="background-image: url(<?php echo get_sub_field('image'); ?>); background-size: <?php echo  get_sub_field('image_size'); ?>">
													</div>
												</div>
												<div class="col-sm-6">
													<div class="slidepart slidetext ">
														<?php echo get_sub_field('text'); ?>
													</div>
												</div>
											</div>
										</div>

									</li>
								<?php } elseif (get_sub_field('slide_type') == 'image') { ?>
									<li class="bxsliderli" style="background-image: url(<?php echo get_sub_field('image'); ?>); width:100%; background-size: <?php echo  get_sub_field('image_size'); ?>; ">
										<div class="fullimgli">
											<div class="titlecontent">
												<div class="container"><?php echo get_sub_field('text'); ?></div>
											</div>
										</div>
									</li>

								<?php } elseif (get_sub_field('slide_type') == 'slidies') { ?>

									<li class="slidies  <?php echo get_sub_field('background_color'); ?>" style="background-image: url(<?php echo get_sub_field('image'); ?>); width:100%; background-size:cover <?php // echo  get_sub_field('background_size'); 
																																																					?>">
										<div class="left_slidies open  ">
											<div class="left_slidies_inner"><?php echo get_sub_field('text'); ?></div>div>
											<div class="left_slidies_arrow">
												<div class="left_slidies_bg <?php echo get_sub_field('background_color'); ?>"></div>
											</div>
											<div class="left_slidies_bg <?php echo get_sub_field('background_color'); ?>"></div>

										</div>
									</li>
							<?php }
							endwhile; ?>
						</ul>

					</section>
				<?php } elseif (get_row_layout() == 'gmap') {

					$coordinates = strval(get_sub_field('address'));
					$google_map = '[chilly_map location="' . $coordinates . '"]'; ?>

					<section <?php if (get_sub_field('id')) {
									echo 'id=' . get_sub_field('id');
								} ?> class="mapcontainer">
						<address>
							<div><?php echo get_sub_field('title'); ?></div>
						</address>

						<?php echo do_shortcode($google_map); ?>
					</section>

				<?php } elseif (get_row_layout() == 'partners-bak') { ?>
					<section class="partenaires" style="background-color:<?php # echo get_sub_field('background_color');
																			?>#fff" <?php if (get_sub_field('id')) {
																						echo 'id=' . get_sub_field('id');
																					} ?>>

						<div class="slidetext">



							<h2><?php echo get_sub_field('title'); ?></h2>
							<?php $i = 1; ?>
							<?php while (have_rows('partner')) : the_row(); ?>
								<a href="#<?php echo 'partner' . $i; ?>" class="partnerlogos <?php if ($i == 1) {
																									echo 'visible_partner';
																								} ?>  ">
									<img src="<?php echo get_sub_field('logo'); ?>">
									<h4><?php echo get_sub_field('nom'); ?></h4>
								</a>
								<?php $i++; ?>
							<?php endwhile ?>

							<?php $i = 1; ?>
							<?php while (have_rows('partner')) : the_row(); ?>
								<div class="partnerdescription <?php if ($i == 1) {
																	echo 'displayed';
																} ?>" id="<?php echo 'partner' . $i; ?>">
									<?php echo get_sub_field('description') ?>
									<p><a target="_blank" href="<?php echo get_sub_field('lien'); ?>">Visiter le site >></a></p>
								</div>
								<?php $i++; ?>
							<?php endwhile ?>
						</div>
					</section>
				<?php } elseif (get_row_layout() == 'two_columns') { ?>
					<section class="two_columns" id="<?php echo get_sub_field('id'); ?>">
						<div class="container-fluid">
							<div class="row <?php echo get_sub_field('background_color'); ?>">
								<div class="col-sm-6 col_match" style="background-image: url(<?php echo get_sub_field('image')['url']; ?>); background-size:cover; min-height: 100vh;">
									<!-- <?php //$image = get_sub_field('image'); 
											?>
				<img style="width:100%;height: auto;" src="<?php echo $image['url']; ?>" alt="" /> -->

								</div>
								<div class="col-sm-6 col_match" style="padding:50px;">

									<?php echo get_sub_field('content'); ?>

								</div>

							</div>
						</div>
					</section>
				<?php } elseif (get_row_layout() == 'partners') { ?>
					<section class="partenairesslider" style="/*display:table; */width:100%; padding:150px 0 100px;" id="<?php echo get_sub_field('id'); ?>">
						<div style="/*display:table-cell; width:100%; vertical-align:middle;*/">
							<div style="width:60%; min-width:250px; margin:auto;">
								<h2><?php echo get_sub_field('title'); ?></h2>
								<ul class="bxslider" data-adaptiveheight="false">
									<?php while (have_rows('partner')) : the_row(); ?>
										<li>
											<h3><?php echo get_sub_field('nom'); ?></h3>
											<?php if (get_sub_field('logo')) { ?><img src="<?php echo get_sub_field('logo'); ?>"><?php } ?>
											<?php echo get_sub_field('description') ?>
											<?php if (get_sub_field('lien')) { ?><p><a href="<?php echo get_sub_field('lien'); ?>">Visiter le site >></a></p> <?php } ?>
										</li>
									<?php endwhile ?>
								</ul>
								<br /><br /><br />
							</div>
						</div>
					</section>
				<?php } elseif (get_row_layout() == 'price_list') { ?>
					<?php $has_brochure = get_field('brochure');
					$link_text = false;  ?>
					<?php if ($has_brochure == 'link')  $link_text =  get_field('brochure_lien'); ?>
					<?php if ($has_brochure == 'file')  $link_text =  get_field('brochure_fichier')['url']; ?>

					<?php $fields = get_sub_field('fields_to_display'); ?>

					<?php $contact_lots = array(); ?>

					<section id="lots" class="price_list" style="display:table; width:100%; background-color: white;">
						<div style="display:table-cell; width:100%; vertical-align:middle; ">
							<h2 style="text-align:center; margin-top:30px;color: #276084;"><?php if (get_sub_field('title')) {
																								the_sub_field('title');
																							} else {
																								echo 'Liste des Prix';
																							} ?> </h2>
							<div class="table_container">
								<table>
									<thead>
										<tr>
											<th><span class="expendable">N° </span>Lot</th>
											<?php if (in_array('rooms', $fields)) { ?><th>Pièces</th><?php } ?>
											<?php if (in_array('orientation', $fields)) { ?><th class="expendable">Orientation</th><?php } ?>
											<?php if (in_array('floor', $fields)) { ?><th class="expendable">Etage</th><?php } ?>
											<?php if (in_array('ppe', $fields)) { ?><th class="expendable">Surface PPE</th><?php } ?>
											<?php if (in_array('ponderee', $fields)) { ?><th class="expendable">Surface Pondérée</th><?php } ?>
											<?php if (in_array('sbp', $fields)) { ?><th>SBP</th><?php } ?>
											<?php if (in_array('sh', $fields)) { ?><th>Surface Habitable</th><?php } ?>
											<?php if (in_array('su', $fields)) { ?><th class="expendable">Surface Utile</th><?php } ?>
											<?php if (in_array('surface_parcelle', $fields)) { ?><th class="expendable">Surface parcelle</th><?php } ?>
											<?php if (in_array('surface_jardin', $fields)) { ?><th class="expendable">Surface jardin</th><?php } ?>
											<?php if (in_array('surface_balcon', $fields)) { ?><th class="expendable">Surface Balcon</th><?php } ?>
											<?php if (in_array('surface_terrasse', $fields)) { ?><th class="expendable">Surface Terrasse</th><?php } ?>
											<?php if (in_array('surface_veranda', $fields)) { ?><th class="expendable">Surface Véranda</th><?php } ?>

											<?php if (in_array('cave', $fields)) { ?><th class="expendable">Cave</th><?php } ?>
											<?php if (in_array('parking', $fields)) { ?><th class="expendable">Parking</th><?php } ?>
											<?php if (in_array('statut', $fields) or in_array('price', $fields)) {
												if (in_array('price', $fields)) { ?><th>Prix</th><?php } elseif (in_array('rent', $fields)) { ?><th>Loyer<span class="expendable">/mois</span></th><?php } else { ?><th>Statut</th><?php } ?>
											<?php } ?>
											<?php if (in_array('bills', $fields)) { ?><th class="expendable">Charges</th><?php } ?>
											<?php if (in_array('preview', $fields)) { ?><th></th><?php } ?>
										</tr>
									</thead>
									<tbody>
										<?php $i = 0; ?>
										<?php while (have_rows('lot')) : the_row(); ?>

											<?php $contact_lot = new stdClass(); ?>
											<?php $contact_lot->title = get_sub_field('number'); ?>
											<?php if (get_sub_field('statut') and get_sub_field('statut') != 'free') {
												$contact_lot->status = "unavailable";
											} else {
												$contact_lot->status = "free";
											} ?>
											<?php array_push($contact_lots, $contact_lot); ?>



											<tr>
												<td><?php if (get_sub_field('number')) {
														the_sub_field('number');
													} else {
														echo '-';
													} ?></td>

												<?php if (in_array('rooms', $fields)) { ?>
													<td><?php if (get_sub_field('rooms')) {
															the_sub_field('rooms');
														} else {
															echo '-';
														} ?></td>
												<?php } ?>
												<?php if (in_array('orientation', $fields)) { ?>
													<td class="expendable"><?php if (get_sub_field('orientation')) {
																				the_sub_field('orientation');
																			} else {
																				echo '-';
																			} ?></td>
												<?php } ?>
												<?php if (in_array('floor', $fields)) { ?>
													<td class="expendable"><?php if (get_sub_field('floor')) {
																				the_sub_field('floor');
																			} else {
																				echo '-';
																			} ?></td>
												<?php } ?>

												<?php if (in_array('ppe', $fields)) { ?>
													<td class="expendable"><?php if (get_sub_field('ppe')) {
																				the_sub_field('ppe');
																				echo " m<span class='m2'>2</span>";
																			} else {
																				echo '-';
																			} ?></td>
												<?php } ?>

												<?php if (in_array('ponderee', $fields)) { ?>
													<td class="expendable"><?php if (get_sub_field('ponderee')) {
																				the_sub_field('ponderee');
																				echo " m<span class='m2'>2</span>";
																			} else {
																				echo '-';
																			} ?></td>
												<?php } ?>

												<?php if (in_array('sbp', $fields)) { ?>
													<td><?php if (get_sub_field('sbp')) {
															the_sub_field('sbp');
															echo " m<span class='m2'>2</span>";
														} else {
															echo '-';
														} ?></td>
												<?php } ?>

												<?php if (in_array('sh', $fields)) { ?>
													<td><?php if (get_sub_field('sh')) {
															the_sub_field('sh');
															echo " m<span class='m2'>2</span>";
														} else {
															echo '-';
														} ?></td>
												<?php } ?>

												<?php if (in_array('su', $fields)) { ?>
													<td class="expendable"><?php if (get_sub_field('su')) {
																				the_sub_field('su');
																			} else {
																				echo '-';
																			} ?></td>
												<?php } ?>


												<?php if (in_array('surface_parcelle', $fields)) { ?>
													<td class="expendable"><?php if (get_sub_field('surface_parcelle')) {
																				the_sub_field('surface_parcelle');
																				echo " m<span class='m2'>2</span>";
																			} else {
																				echo '-';
																			} ?></td>
												<?php } ?>

												<?php if (in_array('surface_jardin', $fields) or in_array('sbp', $fields)) { ?>
													<td class="expendable"><?php if (get_sub_field('surface_jardin')) {
																				the_sub_field('surface_jardin');
																				echo " m<span class='m2'>2</span>";
																			} else {
																				echo '-';
																			} ?></td>
												<?php } ?>

												<?php if (in_array('surface_balcon', $fields)) { ?>
													<td class="expendable"><?php if (get_sub_field('surface_balcon')) {
																				the_sub_field('surface_balcon');
																				echo " m<span class='m2'>2</span>";
																			} else {
																				echo '-';
																			} ?></td>
												<?php } ?>

												<?php if (in_array('surface_terrasse', $fields)) { ?>
													<td class="expendable"><?php if (get_sub_field('surface_terrasse')) {
																				the_sub_field('surface_terrasse');
																				echo " m<span class='m2'>2</span>";
																			} else {
																				echo '-';
																			} ?></td>
												<?php } ?>

												<?php if (in_array('surface_veranda', $fields)) { ?>
													<td class="expendable"><?php if (get_sub_field('surface_veranda')) {
																				the_sub_field('surface_veranda');
																				echo " m<span class='m2'>2</span>";
																			} else {
																				echo '-';
																			} ?></td>
												<?php } ?>

												<?php if (in_array('cave', $fields)) { ?>
													<td><?php if (get_sub_field('cave')) {
															the_sub_field('cave');
														} else {
															echo '-';
														} ?></td>
												<?php } ?>

												<?php if (in_array('parking', $fields)) { ?>
													<td><?php if (get_sub_field('parking')) {
															the_sub_field('parking');
														} else {
															echo '-';
														} ?></td>
												<?php } ?>


												<?php if (in_array('statut', $fields) or in_array('price', $fields) or in_array('rent', $fields)) { ?>
													<td><?php if (get_sub_field('statut')) {
															$statut = get_sub_field('statut');
															if ($statut == 'free') {

																$prix_sur_demande = get_sub_field('prix_sur_demande');
																if ($prix_sur_demande) {
																	echo 'Prix sur demande';
																} else {
																	$price = get_sub_field('price');
																	if ($price) {
																		echo $price;
																	} else {
																		echo '-';
																	}
																}
															} elseif ($statut == 'prebooked') {
																echo '<span class="prebooked">Pré</span>-réservé';
															} elseif ($statut == 'booked') {
																echo '<span class="booked">Réservé</span>';
															} elseif ($statut == 'sold') {
																echo '<span class="sold">Vendu</span>';
															}
														} else {
															echo '-';
														} ?></td>
												<?php } ?>
												<?php if (in_array('bills', $fields)) { ?>
													<td class="expendable"><?php if (get_sub_field('bills')) {
																				the_sub_field('bills');
																			} else {
																				echo '-';
																			} ?></td>
												<?php } ?>

												<?php if (in_array('preview', $fields) and $statut != 'booked' and $statut != 'sold') { ?>
													<td><span class="plus plus_<?php echo $i; ?>">+</span></td>
												<?php } ?>
											</tr>
											<tr>
												<td colspan="7" class="desc_td" id="plus_<?php echo $i; ?>">
													<?php if (get_sub_field('preview')) { ?>
														<img class="preview_img" src="<?php echo get_sub_field('preview')['url']; ?>" />
														<div class="row">
															<div class="col-xs-4">
																<?php if (get_sub_field('brochure')) { ?>
																	<a class="btn" target="_blank" href="<?php echo get_sub_field('brochure')['url']; ?>"><span class="dwnld">Télécharger la </span>brochure</a>
																<?php } elseif ($link_text) { ?>
																	<a class="btn" target="_blank" href="<?php echo $link_text; ?>"><span class="dwnld">Télécharger la </span>brochure</a>
																<?php } ?>
															</div>
															<div class="col-xs-4">
																<?php if (get_sub_field('plans')) { ?>
																	<a class="btn" target="_blank" href="<?php echo get_sub_field('plans'); ?>"><span class="dwnld">Télécharger le </span>plan</a>
																<?php } ?>
															</div>
															<div class="col-xs-4">

																<?php $pagetitle = get_the_title(); ?>
																<?php $nnn = (get_sub_field('number')) ? 'le lot ' .  get_sub_field('number') : 'un des lots'; ?>
																<?php if (1 === preg_match('~[0-9]~', $string)) {
																	echo "<script type='text/javascript'> console.log('boop'); </script>";
																} ?>
																<?php if (get_sub_field('bouton_contact')) {
																	$contact_choice = get_sub_field('bouton_contact');
																} else {
																	$contact_choice = '';
																} ?>
																<?php if ($contact_choice == 'visit') {
																	$str =  htmlentities(' info@praemium.ch?subject=Intérêt pour une propriété - ' . $pagetitle . '&body=Bonjour%2C%0A%0AJe serais intéressé par '  . $nnn  .   ' de la propriété ' . $pagetitle . '. Merci de prendre contact avec moi au numéro de téléphone suivant :%0A%0AJe serai disponible le (merci d’indiquer la date et l\'heure souhaitée):%0A%0ACordialement,');
																	$obj = 'pour un rendez-vous';
																} else {

																	$str =  htmlentities(' info@praemium.ch?subject=Intérêt pour une propriété - ' . $pagetitle . '&body=Bonjour%2C%0A%0AJe serais intéressé par '  . $nnn  .   ' de la propriété ' . $pagetitle . '. Merci de prendre contact avec moi au numéro de téléphone suivant :%0A%0ACordialement,');
																	$obj = 'pour les prix';
																} ?>

																<a class="btn" href="mailto:<?php echo $str; ?>">Contact<span class="dwnld">ez-nous <?php echo $obj; ?></span></a>



															</div>
														</div>


													<?php } ?>
												</td>
											</tr>
											<?php $i++; ?>
										<?php endwhile ?>
									</tbody>
								</table>
							</div>

							<?php $brochure_download = get_sub_field('fichier'); ?>
							<?php if ($brochure_download) : ?>
								<p style="width:80%;max-width:400px;margin:20px auto 30px;text-align:center;"><a target="_blank" class="btn" href="<?php echo $brochure_download['url']; ?>">Formulaire d'inscription</a></p>
							<?php endif; ?>


						</div>
					</section>
				<?php } elseif (get_row_layout() == 'cartes') {
					include('markers_map.php');
				} elseif (get_row_layout() == 'iframe') {  ?>
					<?php $background = get_sub_field('background_color'); ?>
					<?php $url = get_sub_field('url'); ?>


					<section class="partenaires background_<?php echo $background; ?>">
						<div class="iframe_container">
							<iframe src="<?php echo $url; ?>"></iframe>
						</div>
					</section>

				<?php	}; ?>


			<?php endwhile ?>


		<?php } ?>