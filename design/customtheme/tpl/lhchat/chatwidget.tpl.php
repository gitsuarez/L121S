<?php if (!session_id()) { session_start(); } ?>
<?php include(erLhcoreClassDesign::designtpl('lhchat/chatwidget/chatwidget_pre_multiinclude.tpl.php'));?>

<?php if ($disabled_department === true) : ?>

<h1><?php echo erTranslationClassLhTranslation::getInstance()->getTranslation('chat/startchat','Department is disabled');?></h1>

<?php else : ?>

<?php if (!isset($start_data_fields['show_operator_profile']) || $start_data_fields['show_operator_profile'] == false) : ?>
<div class="pl10 max-width-180 pull-right absolute-language-top-right">
	<?php $rightLanguage = true;?>
	<?php include(erLhcoreClassDesign::designtpl('pagelayouts/parts/switch_language.tpl.php'));?>
</div>
<?php endif;?>

<?php include(erLhcoreClassDesign::designtpl('lhchat/getstatus/widget_geo_adjustment.tpl.php'));?>
<?php if ($exitTemplate == true) return; ?>

<?php if ($leaveamessage == false || ($forceoffline === false && erLhcoreClassChat::isOnline($department, false, array('ignore_user_status'=> (int)erLhcoreClassModelChatConfig::fetch('ignore_user_status')->current_value, 'online_timeout' => (int)erLhcoreClassModelChatConfig::fetch('sync_sound_settings')->data['online_timeout'])) === true)) : ?>

<?php if (isset($start_data_fields['show_operator_profile']) && $start_data_fields['show_operator_profile'] == true) : ?>
<?php include_once(erLhcoreClassDesign::designtpl('lhchat/part/operator_profile_start_chat.tpl.php'));?>
<?php endif;?>

<?php if (isset($errors)) : ?>
		<?php include(erLhcoreClassDesign::designtpl('lhkernel/validation_error.tpl.php'));?>
<?php endif; ?>

<?php include(erLhcoreClassDesign::designtpl('lhchat/chatwidget/chatwidget_pre_form_multiinclude.tpl.php'));?>

<?php $hasExtraField = false;

if ($theme !== false && $theme->explain_text != '') : ?>
<p class="start-chat-intro"><?php echo erLhcoreClassBBCode::make_clickable(htmlspecialchars($theme->explain_text))?></p>
<?php endif;?>

<form method="post" id="form-start-chat" action="<?php echo erLhcoreClassDesign::baseurl('chat/chatwidget')?><?php echo $append_mode?><?php $department !== false ? print '/(department)/'.$department : ''?><?php $input_data->priority !== false ? print '/(priority)/'.$input_data->priority : ''?><?php $input_data->vid !== false ? print '/(vid)/'.htmlspecialchars($input_data->vid) : ''?><?php $input_data->hash_resume !== false ? print '/(hash_resume)/'.htmlspecialchars($input_data->hash_resume) : ''?><?php $leaveamessage == true ? print '/(leaveamessage)/true' : ''?><?php $forceoffline == true ? print '/(offline)/true' : ''?><?php echo $append_mode_theme?>" onsubmit="return <?php if (isset($start_data_fields['message_auto_start']) && $start_data_fields['message_auto_start'] == true) : ?>lhinst.prestartChat('<?php echo time()?>',$(this))<?php else : ?>lhinst.addCaptcha('<?php echo time()?>',$(this))<?php endif?>">

<?php if (isset($start_data_fields['message_visible_in_page_widget']) && $start_data_fields['message_visible_in_page_widget'] == true && isset($start_data_fields['show_messages_box']) && $start_data_fields['show_messages_box'] == true) : ?>
    <?php include(erLhcoreClassDesign::designtpl('lhchat/startchatformsettings/presend.tpl.php'));?>
<?php endif;?>

<?php $formResubmitId = 'form-start-chat'; ?>
<?php include(erLhcoreClassDesign::designtpl('lhchat/part/auto_resubmit.tpl.php'));?>

<script type="text/javascript">
	var myWindow;
	var cInterval;
	function fblogout() {
		myWindow  = window.open('/facebook-logout.php', '_blank', 'height=620, width=620');
		cInterval = setInterval(function(){ 
			if(myWindow.closed){
				window.location.reload();
				clearInterval(cInterval);
			}
		}, 1000);	
	}
	function fbauth(){
		myWindow  = window.open('/facebook-auth.php', '_blank', 'height=620, width=620');
		cInterval = setInterval(function(){ 
			if(myWindow.closed){
				window.location.reload();
				clearInterval(cInterval);
			}
		}, 1000);		
	}
</script>

<?php if(isset($_SESSION['fb_id'])){ ?>
<span class="fb-greetings">
	<b>Hello there!</b>
</span>
<div class="row user-fb-wrapper" style="">
	<div class="col-md-3 col-sm-3 col-xs-3" >
		<img class="fb-profile" src="http://graph.facebook.com/<?php echo $_SESSION['fb_id']; ?>/picture">
		<div class="facebook-icon"><img src="/design/customtheme/images/general/facebook-icon.png"></div>
	</div>
	<div class="col-md-9 col-sm-9 col-xs-9">
		<?php 
			echo '<p class="fb-details"><b>'.$_SESSION['fb_fn'] . '</b><br/>';
			echo $_SESSION['fb_ea'] . '</p>';
		?>
		<a href="#" class="fb-logout" onClick="fblogout()"></a>
		<input type="hidden" name="Username" value="<?php echo htmlspecialchars($_SESSION['fb_fn']);?>" />
		<input type="hidden" name="Email" value="<?php echo htmlspecialchars($_SESSION['fb_ea']);?>" />
	</div>
</div>
<?php } else { ?>
<div class="row">
    <?php if (isset($start_data_fields['name_visible_in_page_widget']) && $start_data_fields['name_visible_in_page_widget'] == true) : $hasExtraField = true;?>
    
    <?php if (isset($start_data_fields['name_hidden']) && $start_data_fields['name_hidden'] == true) : ?>
	<input type="hidden" name="Username" value="<?php echo htmlspecialchars($input_data->username);?>" />
	<?php else : ?>	
		<?php if (in_array('username', $input_data->hattr)) : ?>
			<input type="hidden" name="Username" value="<?php echo htmlspecialchars($input_data->username);?>" />
		<?php else : ?>
	    <div class="col-xs-6 form-group<?php if (isset($errors['nick'])) : ?> has-error<?php endif;?>">
	        <label class="control-label"><?php echo erTranslationClassLhTranslation::getInstance()->getTranslation('chat/startchat','Name');?><?php if (isset($start_data_fields['name_require_option']) && $start_data_fields['name_require_option'] == 'required') : ?>*<?php endif;?></label>
	        <input type="text" class="form-control" name="Username" value="<?php echo htmlspecialchars($input_data->username);?>" />
	    </div>    
	    <?php endif; ?>    
    <?php endif; ?>
    
    <?php endif; ?>

    <?php if (isset($start_data_fields['email_visible_in_page_widget']) && $start_data_fields['email_visible_in_page_widget'] == true) : $hasExtraField = true;?>
    
    <?php if (isset($start_data_fields['email_hidden']) && $start_data_fields['email_hidden'] == true) : ?>
	<input type="hidden" name="Email" value="<?php echo htmlspecialchars($input_data->email);?>" />
	<?php else : ?>
		<?php if (in_array('email', $input_data->hattr)) : ?>
			<input type="hidden" name="Email" value="<?php echo htmlspecialchars($input_data->email);?>" />
		<?php else : ?>
	    <div class="col-xs-6 form-group<?php if (isset($errors['email'])) : ?> has-error<?php endif;?>">
	        <label class="control-label"><?php echo erTranslationClassLhTranslation::getInstance()->getTranslation('chat/startchat','E-mail');?><?php if (isset($start_data_fields['email_require_option']) && $start_data_fields['email_require_option'] == 'required') : ?>*<?php endif;?></label>
	        <input class="form-control" type="text" name="Email" value="<?php echo htmlspecialchars($input_data->email);?>" />
	    </div>
	    <?php endif; ?>
    <?php endif; ?>
    
    <?php endif; ?>
</div>

<div class="row">
	
	<div class="col-md-12">
		<div class="form-group text-center">
	        <label class="control-label"><?php echo erTranslationClassLhTranslation::getInstance()->getTranslation('chat/startchat','Save Time & ');?></label>
	        <?php			
				echo '<a href="#" id="fblogin" onClick="fbauth()" class="sc-btn sc--facebook"> 
						<span class="sc-icon">
	      					<svg viewBox="0 0 33 33" width="25" height="25" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"><g><path d="M 17.996,32L 12,32 L 12,16 l-4,0 l0-5.514 l 4-0.002l-0.006-3.248C 11.993,2.737, 13.213,0, 18.512,0l 4.412,0 l0,5.515 l-2.757,0 c-2.063,0-2.163,0.77-2.163,2.209l-0.008,2.76l 4.959,0 l-0.585,5.514L 18,16L 17.996,32z"></path></g></svg>
						</span>
					  	<span class="sc-text">
					      Login with Facebook
					  	</span>
				</a>';
			?>

		</div>
	</div>
</div>
<?php } ?>
<?php if (isset($start_data_fields['phone_visible_in_page_widget']) && $start_data_fields['phone_visible_in_page_widget'] == true) : $hasExtraField = true;?>
<?php if (isset($start_data_fields['phone_hidden']) && $start_data_fields['phone_hidden'] == true) : ?>
<input type="hidden" name="Phone" value="<?php echo htmlspecialchars($input_data->phone);?>" />
<?php else : ?>
		<?php if (in_array('phone', $input_data->hattr)) : ?>
		<input type="hidden" name="Phone" value="<?php echo htmlspecialchars($input_data->phone);?>" />
		<?php else : ?>
		<div class="form-group<?php if (isset($errors['phone'])) : ?> has-error<?php endif;?>">
		  <label class="control-label"><?php echo erTranslationClassLhTranslation::getInstance()->getTranslation('chat/startchat','Phone');?><?php if (isset($start_data_fields['phone_require_option']) && $start_data_fields['phone_require_option'] == 'required') : ?>*<?php endif;?></label>
		  <input autofocus="autofocus" <?php if (isset($start_data_fields['phone_require_option']) && $start_data_fields['phone_require_option'] == 'required') : ?>aria-required="true" required<?php endif;?> aria-label="<?php echo erTranslationClassLhTranslation::getInstance()->getTranslation('chat/startchat','Enter your phone')?>" placeholder="<?php echo erTranslationClassLhTranslation::getInstance()->getTranslation('chat/startchat','Enter your phone')?>" class="form-control" aria-label="<?php echo erTranslationClassLhTranslation::getInstance()->getTranslation('chat/startchat','Enter your phone')?>" type="text" name="Phone" value="<?php echo htmlspecialchars($input_data->phone);?>" />
		</div>
		<?php endif; ?>
<?php endif; ?>
<?php endif; ?>

<?php $canReopen = erLhcoreClassModelChatConfig::fetch('reopen_chat_enabled')->current_value == 1 && ($reopenData = erLhcoreClassChat::canReopenDirectly(array('reopen_closed' => erLhcoreClassModelChatConfig::fetch('allow_reopen_closed')->current_value))) !== false; ?>

<?php $adminCustomFieldsMode = 'on';?>
<?php include(erLhcoreClassDesign::designtpl('lhchat/part/admin_form_variables.tpl.php'));?>

<?php if (isset($start_data_fields['message_visible_in_page_widget']) && $start_data_fields['message_visible_in_page_widget'] == true) : ?>
<?php if (isset($start_data_fields['message_hidden']) && $start_data_fields['message_hidden'] == true) : $hasExtraField = true; ?>
<textarea class="hide" placeholder="<?php echo erTranslationClassLhTranslation::getInstance()->getTranslation('chat/startchat','Enter your message');?>" name="Question"><?php echo htmlspecialchars($input_data->question);?></textarea>
<?php else : ?>
<div class="<?php if (isset($errors['question'])) : ?> has-error<?php endif;?>">
<?php if (!isset($start_data_fields['hide_message_label']) || $start_data_fields['hide_message_label'] == false) : ?><label class="control-label"><?php echo erTranslationClassLhTranslation::getInstance()->getTranslation('chat/startchat','Your question');?><?php if (isset($start_data_fields['message_require_option']) && $start_data_fields['message_require_option'] == 'required') : ?>*<?php endif;?></label><?php endif;?>
<?php include(erLhcoreClassDesign::designtpl('lhchat/part/above_text_area_user_start_chat.tpl.php'));?>
<textarea autofocus="autofocus" class="form-control form-group <?php if ($hasExtraField !== true && $canReopen !== true) : ?>btrad-reset<?php endif;?>" <?php if (isset($start_data_fields['user_msg_height']) && $start_data_fields['user_msg_height'] > 0) : ?>style="height: <?php echo $start_data_fields['user_msg_height']?>px"<?php endif;?> aria-label="<?php echo erTranslationClassLhTranslation::getInstance()->getTranslation('chat/startchat','Enter your message');?>" placeholder="<?php echo erTranslationClassLhTranslation::getInstance()->getTranslation('chat/startchat','Please enter a message...');?>" <?php if (isset($start_data_fields['message_require_option']) && $start_data_fields['message_require_option'] == 'required') : ?>aria-required="true" required<?php endif;?> id="id_Question" name="Question"><?php echo htmlspecialchars($input_data->question);?></textarea>
<?php include(erLhcoreClassDesign::designtpl('lhchat/part/below_text_area_user_start_chat.tpl.php'));?>
</div>
<?php endif; ?>
<?php else : $hasExtraField = true; endif; ?>

<?php include_once(erLhcoreClassDesign::designtpl('lhchat/part/user_variables.tpl.php'));?>

<?php if ($department === false) : ?>
	<?php include_once(erLhcoreClassDesign::designtpl('lhchat/part/department.tpl.php'));?>
<?php endif;?>

<?php include(erLhcoreClassDesign::designtpl('lhchat/part/product.tpl.php'));?>

<?php include(erLhcoreClassDesign::designtpl('lhchat/part/user_timezone.tpl.php'));?>

<?php $tosVariable = 'tos_visible_in_page_widget';$tosCheckedVariable = 'tos_checked_online';?>
<?php include_once(erLhcoreClassDesign::designtpl('lhchat/part/accept_tos.tpl.php'));?>

<?php if ($hasExtraField == true || $canReopen == true) : ?>
<div class="btn-group" role="group" aria-label="...">  
  <?php if ($hasExtraField === true) : ?>
  <?php include(erLhcoreClassDesign::designtpl('lhchat/part/buttons/start_chat_button_widget.tpl.php'));?>
  <?php endif;?>
  
  <?php include(erLhcoreClassDesign::designtpl('lhchat/chatwidget_button_multiinclude.tpl.php'));?>
  
  <?php if ( $canReopen == true ) : ?>
  <?php include(erLhcoreClassDesign::designtpl('lhchat/part/buttons/reopen_button_widget.tpl.php'));?>
  <?php endif; ?>
</div>
<?php endif;?>

<input type="hidden" value="<?php echo htmlspecialchars($referer);?>" name="URLRefer" />
<input type="hidden" value="<?php echo htmlspecialchars($referer_site);?>" name="r" />
<input type="hidden" value="<?php echo htmlspecialchars($input_data->operator);?>" name="operator" />
<input type="hidden" value="1" name="StartChat"/>
<?php if ($hasExtraField === true) : ?>
    <input type="hidden" value="1" id="hasFormExtraField"/>
<?php endif;?>
</form>

<?php include_once(erLhcoreClassDesign::designtpl('lhchat/part/switch_to_offline.tpl.php'));?>

<?php if ($hasExtraField === false) : ?>
<script>
<?php if ($canReopen == false) : ?>
jQuery('#id_Question').addClass('mb0');
<?php endif;?>

<?php if ($hasExtraField == false && isset($start_data_fields['message_auto_start']) && $start_data_fields['message_auto_start'] == true && isset($start_data_fields['message_auto_start_key_press']) && $start_data_fields['message_auto_start_key_press'] == true) : ?>
$('#id_Question').on('keydown', function (e) {
	if ($( "#form-start-chat").attr("key-up-started") != 1) {
    	$( "#form-start-chat").attr("key-up-started",1);
    	$( "#form-start-chat").submit();	
	}
});
<?php endif;?>

var formSubmitted = false;
jQuery('#id_Question').bind('keydown', 'return', function (evt){
	if (formSubmitted == false) {
		$( "#form-start-chat" ).submit();	
		<?php if (!isset($start_data_fields['message_auto_start']) || $start_data_fields['message_auto_start'] == false) : ?>
		formSubmitted = true;
		jQuery('#id_Question').attr('readonly','readonly');		
		<?php endif;?>
	};
	return false;	
});
</script>
<?php endif;?>

<?php include(erLhcoreClassDesign::designtpl('lhchat/chatwidget/chatwidget_post_multiinclude.tpl.php'));?>

<?php else : ?>
	<?php if (isset($start_data_fields['show_operator_profile']) && $start_data_fields['show_operator_profile'] == true) : ?>
	
		<div class="pl10 pos-rel max-width-180 pull-right">
		<?php $rightLanguage = true;?>
		<?php include(erLhcoreClassDesign::designtpl('pagelayouts/parts/switch_language.tpl.php'));?>
		</div>
	
	<?php endif;?>

	<?php if (isset($errors)) : ?>
		<?php include(erLhcoreClassDesign::designtpl('lhkernel/validation_error.tpl.php'));?>
	<?php endif; ?>
	
	<?php include(erLhcoreClassDesign::designtpl('lhchat/chatwidget/chatwidget_pre_offline_form_multiinclude.tpl.php'));?>

	<?php include(erLhcoreClassDesign::designtpl('lhchat/offline_form.tpl.php'));?>
	
	<?php include(erLhcoreClassDesign::designtpl('lhchat/chatwidget/chatwidget_post_offline_form_multiinclude.tpl.php'));?>
	
	
<?php endif;?>

<?php endif;?>
