<script type="text/javascript">$(function() {<?php  if (is_numeric($chat_id)) : ?>addChat(<?php  echo $chat_id;?>,'<?php  echo erLhcoreClassDesign::shrt($chat_to_load->nick,10,'...',30,ENT_QUOTES);?>');<?php  endif; ?>});</script><?php $soundData = erLhcoreClassModelChatConfig::fetch('sync_sound_settings')->data; $soundMessageEnabled = erLhcoreClassModelUserSetting::getSetting('chat_message',(int)($soundData['new_message_sound_admin_enabled'])); $soundNewChatEnabled = erLhcoreClassModelUserSetting::getSetting('new_chat_sound',(int)($soundData['new_chat_sound_enabled'])); $canChangeOnlineStatus = false; $currentUser = erLhcoreClassUser::instance(); if ( $currentUser->hasAccessTo('lhuser','changeonlinestatus') ) { $canChangeOnlineStatus = true; if ( !isset($UserData) ) { $UserData = $currentUser->getUserData(true); } } $canChangeVisibilityMode = false; if ( $currentUser->hasAccessTo('lhuser','changevisibility') ) { $canChangeVisibilityMode = true; if ( !isset($UserData) ) { $UserData = $currentUser->getUserData(true); } } ?><?php  if ($currentUser->hasAccessTo('lhchat','use') ) : ?><?php  if (!isset($hideULSetting)) : ?><ul class="list-inline user-settings-list pull-right"><?php  endif;?><li><a href="#"><i class="material-icons" onclick="return lhinst.disableChatSoundAdmin($(this))" title="Enable/Disable sound about new messages from users"><?php  $soundMessageEnabled == 0 ? print 'volume_off' : print 'volume_up'?></i></a></li><li><a href="#"><i class="material-icons" onclick="return lhinst.disableNewChatSoundAdmin($(this))" title="Enable/Disable sound about new pending chats"><?php  $soundNewChatEnabled == 0 ? print 'volume_off' : print 'volume_up'?></i></a></li><?php  if ($canChangeVisibilityMode == true) : ?><li><a href="#"><i id="vi-in-user" class="material-icons" title="Change my visibility to visible/invisible" onclick="return lhinst.changeVisibility($(this))"><?php  $UserData->invisible_mode == 1 ? print 'visibility_off' : print 'visibility'?></i><span class="menu-status-txt" id="visibility" onclick="return lhinst.changeVisibility($('#vi-in-user'))"><?php  $UserData->invisible_mode == 1 ? print 'invisible' : print 'visible'?></span></a></li><?php  endif;?><?php  if ($canChangeOnlineStatus == true) : ?><li><a href="#"><i id="online-offline-user" class="material-icons" title="Change my status to online/offline" onclick="return lhinst.disableUserAsOnline($(this))"><?php  $UserData->hide_online == 1 ? print 'flash_off' : print 'flash_on'?></i><span class="menu-status-txt" id="online-status" onclick="return lhinst.disableUserAsOnline($('#online-offline-user'))"><?php  $UserData->hide_online == 1 ? print 'offline' : print 'online'?></span></a></li><?php  endif;?><?php  if (!isset($hideULSetting)) : ?></ul><?php  endif;?><?php  endif;?><div role="tabpanel" id="tabs"><ul class="nav nav-pills" role="tablist"></ul><div class="tab-content"></div></div><script type="text/javascript">function addChat(chat_id,name){lhinst.setCloseWindowOnEvent(true);lhinst.setDisableRemember(true);lhinst.startChat(chat_id,$('#tabs'),name);window.focus();}</script>