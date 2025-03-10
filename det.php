<?php
// FORM HTML
function det_form($args, $html = null){
	if(!$args || !isset($args['tags'])) return;
	det_assets();
	det_form_action($args);
	$html .= '<form class="det hidden" method="POST">';
		$html .= '<h2>'.__('Empty Tags').'</h2>';
		$html .= '<p>'.__('Use the button below to delete empty tags that are listed on the <strong>current page</strong>.').'</p>';
		$html .= '<input type="hidden" name="delete-empty-tags" value="true"/>';
		$html .= '<button class="big red button" type="submit">'.__('Delete Empty Tags').'</button>';
	$html .= '</form>';
	return $html;
}

// FORM ASSETS
function det_assets(){
	include_once('det.css');
	include_once('det.js'); 
}

// FORM MESSAGE
function det_flash($number){
	if (!is_numeric($number)) return;
	$message = __('%s empty tags deleted.', $number);
	$flash = Zend_Controller_Action_HelperBroker::getStaticHelper('FlashMessenger');
	if($flash){
		$flash->addMessage($message, 'det');
	}
}

// FORM ACTION
function det_form_action($args, $deleted=0){
	if(isset($_POST) && isset($_POST['delete-empty-tags']) && isset($args)){
		foreach($args['tags'] as $tag){
			if(isset($tag->tagCount) && $tag->tagCount == 0){
				$tag->delete();
				$deleted++;
			}
			
		}
		// update page content
		header("Refresh: 0"); 
		det_flash($deleted);
	}
}