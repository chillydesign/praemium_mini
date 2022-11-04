<?php


// ALLOW BOOKING FORM TO BE ADDED AS A SHORTCODE
add_shortcode('praemium_form',  'praemium_form_shortcode');

add_action('admin_post_nopriv_praemium_form',    'get_email_from_praemium_form');
add_action('admin_post_praemium_form',  'get_email_from_praemium_form');





function get_all_contact_backs() {

  return array(
    "Je souhaiterais",
    "Être rappelé(e)",
    "Faire une visite",
    "Recevoir une brochure",
    "Recevoir les plans",
    "Être informé(e) de vos nouvelles promotions"
  );
};

function get_all_sources() {

  return array(
    "Comment avez-vous entendu parler de nous?",
    "Courtier",
    "Référence",
    "Internet",
    "Email",
    "Journal",
    "Magazine",
    "Publicité",
    "Évènement",
    "Autre"
  );
};







//  ADD REQUEST FORM AS A SHORTCODE
function praemium_form_shortcode($atts) {
  global $post;
  $a = shortcode_atts(array(
    'bouton' => 'Acheteur',
    'primogefi' => "false"
  ), $atts);

  $primogefi = $a['primogefi'] == 'true';

  global $contact_lots; // define houses in the page loop
  $contact_backs = get_all_contact_backs();
  $sources = get_all_sources();
  $pr_frm = '';

  $pr_frm .= '
    <div class="row">
    <div class="col-md-6"><div style="min-height:280px">
    <p><strong>Praemium Immobilier</strong></p>

    <p>
    62 Quai Gustave Ador, 1207 Genève<br>
    Courtage et valorisation
    </p>

    <p>
    Skype: info.PraemiumImmobilier<br>
    E-Mail: <a href="mailto:sgris@praemium.ch;nc@praemium.ch;info@praemium.ch">info@praemium.ch</a><br>
    <strong>Tel. : +41(0)22 736 39 80</strong>
    </p>
    </div>
    </div>
    <div class="col-md-6"><div style="min-height:280px">';


  if ($primogefi) {
    $pr_frm .= '<a style="text-decoration:none" href="http://www.primogefi.ch/">
      <div class="contact-macaron">
      <p>
      <strong>Une nouvelle promotion Primogefi</strong><br>
      </p>
      </div>
      </a>';
  } else {
    $pr_frm .= '<a style="text-decoration:none" href="mailto:info@praemium.ch;nc@praemium.ch;info@praemium.ch?Subject=Estimation%20de%20ma%20propriété">
      <div class="contact-macaron">
      <p>
      <strong>Vous êtes propriétaire?</strong><br>
      Nous recherchons pour nos clients des objets immobiliers à la vente<br>
      Estimation gratuite,<br>
      Discrétion assurée,<br>
      Conseils personnalisés
      </p>
      </div>
      </a>';
  }




  $pr_frm .= '</div> ';
  $pr_frm .= '</div> ';
  $pr_frm .= '</div> ';



  if (isset($_GET['success'])) :
    $pr_frm .=  '<p class="alert alert-success">Merci pour votre message. Nous vous répondrons dans les plus brefs délais.</p>';
  elseif (isset($_GET['problem'])) :
    $pr_frm .=  '<p class="alert alert-danger">Une erreur s’est produite. Veuillez réessayer.</p>';
  endif;

  $pr_frm .= ' <form id="course_form" action="' .  esc_url(admin_url('admin-post.php')) . '" method="post">

    <input type="hidden" id="promotion" name="promotion" value="' . get_the_title($post)  . '">

    <div id="interest_person_check" class="field group_visible ">
    <div class="row">
    <div class="col-sm-6"><a href="#" data-person="acheteur" class="person_chooser selected_person">' . $a['bouton'] . '</a></div>
    <div class="col-sm-6">	<a href="#" data-person="courtier" class="person_chooser">courtier</a></div>
    </div>
    </div>


    <div class="row">
    <div class="field col-sm-6">
    <label for="person_prenom">Prénom</label>
    <input type="text" name="prenom" placeholder="Prénom" id="person_prenom" />
    </div>

    <div class="field col-sm-6">
    <label for="person_nom">Nom</label>
    <input type="text" name="nom" placeholder="Nom" id="person_nom" />
    </div>

    </div>

    <div class="field_group group_for_acheteur ">

    <div class="field">
    <label for="person_address">Adresse</label>
    <input type="text" name="address" placeholder="Adresse" id="person_address"  />
    </div>
    <div class="row">
    <div class="field col-sm-6">
    <label for="person_postcode">Code Postal</label>
    <input type="text" name="postcode" placeholder="Code Postal" id="person_postcode"  />
    </div>
    <div class="field col-sm-6">
    <label for="person_town">Ville</label>
    <input type="text" name="ville" placeholder="Ville" id="person_town"  />
    </div>
    </div>

    </div> 

    <div class="row">
    <div class="field col-sm-6">
    <label for="person_telephone">Téléphone</label>
    <input type="text" name="person_telephone" placeholder="Téléphone" id="person_telephone" />
    </div>
    <div class="field col-sm-6">
    <label for="person_email">Email</label>
    <input type="email" name="person_email" placeholder="Email" id="person_email" />
    </div>

    </div>

    <div class="field">
    <select id="source" name="source">';
  foreach ($sources as $source) {
    $pr_frm .=  '<option value="' . $source . '">' . $source . '</option>';
  }
  $pr_frm .=  '</select>
   </div>';

  if ($contact_lots) {
    $pr_frm .= '<div class="field_group group_for_acheteur ">
    <div class="field">
    <select id="interest" name="interest">
    <option value="">Je suis intéressé par</option>';
    foreach ($contact_lots as $lot) {
      if ($lot->status == 'free') {
        $lot_text = "Lot " . $lot->title;
      } else {
        $lot_text = "Lot " . $lot->title . " - Mise sur liste d'attente  ";
      }

      $pr_frm .=  '<option value="' . $lot_text . '">' . $lot_text . '</option>';
    }
    $pr_frm .=  '</select>
 </div></div>';
  }


  $pr_frm .= '<div class="field_group group_for_acheteur">
<div class="field">
<select id="contactback" name="contactback">';
  foreach ($contact_backs as $contactback) {
    $pr_frm .=  '<option value="' . $contactback . '">' . $contactback . '</option>';
  }
  $pr_frm .=  '</select>
</div>
</div>


<div class="field_group group_for_courtier">
<div class="field">
<label for="company">Entreprise de courtage</label>
<input type="text" name="company" placeholder="Entreprise de courtage" id="company"  />
</div>
</div>




<div class="field ">
<label for="message">Message (optionnel) </label>
<textarea  name="message" placeholder="Message (optionnel)" id="message"></textarea>
</div>


<input type="hidden" name="action" value="praemium_form">
<input type="hidden" id="person_type" name="person_type" value="acheteur">


<div class="submit_group_button">
<p><input type="submit" id="submit_praemium_form" value="Envoyer"></p>

</div>





</form>';


  // HIDDEN ACTION INPUT IS REQUIRED TO POST THE DATA TO THE CORRECT PLACE

  return  $pr_frm;
}










function get_email_from_praemium_form() {

  // IF DATA HAS BEEN POSTED
  if (isset($_POST['action'])  && $_POST['action'] == 'praemium_form') :

    // recipient should be an array if more than 1 person
    $recipient = array('info@praemium.ch', 'nc@praemium.ch');
    $subject =  $_POST['promotion'] . ' - Message ' . $_POST['person_type'];
    $body = "Réponses au formulaire de contact:\n\n";
    $comment_content = '';
    foreach ($_POST as $key => $value) {
      $body .=  $key  . ':  ' . $value . "\n";
    }
    //$body .= "\n End of message";


    // TO DO CHECK IF ALL NECESSARY FIELDS HAVE BEEN FILLED IN

    $referer = $_SERVER['HTTP_REFERER'];
    $referer =  explode('?',   $referer)[0];





    $comment_content = $body;
    // Call to comment check
    $spam_data = array(
      'blog' => 'http://praemium-re.com',
      'user_ip' => $_SERVER['REMOTE_ADDR'],
      'user_agent' => $_SERVER['HTTP_USER_AGENT']['browser_name_pattern'],
      'referrer' => $referrer,
      'permalink' => $referrer,
      'comment_type' => 'comment',
      'comment_author' => $_POST['prenom'] . ' '  . $_POST['nom'],
      'comment_author_email' => $_POST['person_email'],
      'comment_author_url' => '',
      'comment_content' => $_POST['message']
    );

    if (akismet_comment_check('52d37475e420', $spam_data)) {
      // it is spam
      wp_redirect($referer . '?problem&spam');
    } else {


      $headers = 'From: Praemium Immobilier <noreply@praemium-re.com>' . "\r\n";
      if (wp_mail($recipient, $subject, $body, $headers)) {
        wp_redirect($referer . '?success#course_form');
      } else {
        wp_redirect($referer . '?problem#course_form');
      }
    };









    exit;



  endif;
}








// Passes back true (it's spam) or false (it's ham)
function akismet_comment_check($key, $data) {
  $request = 'blog=' . urlencode($data['blog']) .
    '&user_ip=' . urlencode($data['user_ip']) .
    '&user_agent=' . urlencode($data['user_agent']) .
    '&referrer=' . urlencode($data['referrer']) .
    '&permalink=' . urlencode($data['permalink']) .
    '&comment_type=' . urlencode($data['comment_type']) .
    '&comment_author=' . urlencode($data['comment_author']) .
    '&comment_author_email=' . urlencode($data['comment_author_email']) .
    '&comment_author_url=' . urlencode($data['comment_author_url']) .
    '&comment_content=' . urlencode($data['comment_content']);
  $host = $http_host = $key . '.rest.akismet.com';
  $path = '/1.1/comment-check';
  $port = 443;
  $akismet_ua = "WordPress/4.4.1 | Akismet/3.1.7";
  $content_length = strlen($request);
  $http_request  = "POST $path HTTP/1.0\r\n";
  $http_request .= "Host: $host\r\n";
  $http_request .= "Content-Type: application/x-www-form-urlencoded\r\n";
  $http_request .= "Content-Length: {$content_length}\r\n";
  $http_request .= "User-Agent: {$akismet_ua}\r\n";
  $http_request .= "\r\n";
  $http_request .= $request;
  $response = '';
  if (false != ($fs = @fsockopen('ssl://' . $http_host, $port, $errno, $errstr, 10))) {

    fwrite($fs, $http_request);

    while (!feof($fs))
      $response .= fgets($fs, 1160); // One TCP-IP packet
    fclose($fs);

    $response = explode("\r\n\r\n", $response, 2);
  }

  if ('true' == $response[1])
    return true;
  else
    return false;
}
