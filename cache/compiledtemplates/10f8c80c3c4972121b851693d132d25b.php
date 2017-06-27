<h1>Edit user - <?php  echo htmlspecialchars($user->name_support)?></h1><?php  if (isset($errors)) : ?><?php  if (isset($errors)) : ?><div data-alert class="alert alert-danger alert-dismissible fade in"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button><ul class="validation-ul"><?php  foreach ($errors as $err) : ?><li><?php  echo $err?></li><?php  endforeach;?></ul></div><?php  endif;?><?php  endif; ?><?php  if (isset($updated)) : $msg = 'Account updated'; ?><div role="alert" class="alert alert-success alert-dismissible fade in"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button><?php  echo $msg?></div><?php  endif; ?><ul class="nav nav-pills" role="tablist"><li role="presentation" <?php  if ($tab == '') : ?> class="active" <?php  endif;?>><a href="#account" aria-controls="account" role="tab" data-toggle="tab">Account data</a></li><li role="presentation" <?php  if ($tab == 'tab_departments') : ?>class="active"<?php  endif;?>><a href="#departments" aria-controls="departments" role="tab" data-toggle="tab" >Assigned departments</a></li><li role="presentation" <?php  if ($tab == 'tab_pending') : ?>class="active"<?php  endif;?>><a href="#pending" aria-controls="pending" role="tab" data-toggle="tab">Pending chats</a></li><?php  if (erLhcoreClassUser::instance()->hasAccessTo('lhpermission','see_permissions_users')) : ?><li role="presentation" <?php  if ($tab == 'tab_permission') : ?>class="active"<?php  endif;?>><a href="#permission" aria-controls="permission" role="tab" data-toggle="tab">Permissions</a></li><?php  endif;?><?php   ?></ul><div class="tab-content"><div role="tabpanel" class="tab-pane <?php  if ($tab == '') : ?>active<?php  endif;?>" id="account"><?php   ?><div class="explain">Do not enter a password unless you want to change it</div><br /><form action="/richard/sites/live121support.com-master/index.php/site_admin/user/edit/<?php  echo $user->id?>#account" method="post" autocomplete="off" enctype="multipart/form-data"><?php   ?><div class="form-group"><label>Username</label><input <?php  if ($can_edit_groups === false) : ?>disabled="disabled"<?php  endif;?> class="form-control" type="text" name="Username" value="<?php  echo htmlspecialchars($user->username);?>" /></div><div class="form-group"><label>Password</label><input autocomplete="new-password" type="password" <?php  if ($can_edit_groups === false) : ?>disabled="disabled"<?php  endif;?> class="form-control" name="Password" value="<?php  echo htmlspecialchars(isset($user->password_temp_1) ? $user->password_temp_1 : '');?>" /></div><div class="form-group"><label>Repeat the new password</label><input autocomplete="new-password" type="password" <?php  if ($can_edit_groups === false) : ?>disabled="disabled"<?php  endif;?> class="form-control" name="Password1" value="<?php  echo htmlspecialchars(isset($user->password_temp_2) ? $user->password_temp_2 : '');?>" /></div><div class="form-group"><label>E-mail</label><input type="text" class="form-control" name="Email" value="<?php  echo $user->email;?>"/></div><div class="form-group"><label>Chat nickname</label><input type="text" class="form-control" name="ChatNickname" value="<?php  echo htmlspecialchars($user->chat_nickname);?>" /></div><div class="form-group"><label>Name</label><input type="text" class="form-control" name="Name" value="<?php  echo htmlspecialchars($user->name);?>"/></div><div class="form-group"><label>Surname</label><input type="text" class="form-control" name="Surname" value="<?php  echo htmlspecialchars($user->surname);?>"/></div><div class="form-group"><label>Job title</label><input type="text" class="form-control" name="JobTitle" value="<?php  echo htmlspecialchars($user->job_title);?>"/></div><div class="form-group"><label>User time zone</label><?php  $tzlist = DateTimeZone::listIdentifiers(DateTimeZone::ALL); ?><select name="UserTimeZone" class="form-control"><option value="">[[Application default time zone]]</option><?php  foreach ($tzlist as $zone) : ?><option value="<?php  echo htmlspecialchars($zone)?>" <?php  $user->time_zone == $zone ? print 'selected="selected"' : ''?>><?php  echo htmlspecialchars($zone)?></option><?php  endforeach;?></select></div><div class="row"><div class="col-xs-6"><div class="form-group"><label title="Chat status will not change upon pending chat opening"><input type="checkbox" value="on" name="UserInvisible" <?php  echo $user->invisible_mode == 1 ? 'checked="checked"' : '' ?> /> Invisible mode</label></div></div><?php   ?><div class="col-xs-6"><div class="form-group"><label title="User receives other operators permissions request"><input type="checkbox" value="on" name="ReceivePermissionRequest" <?php  echo $user->rec_per_req == 1 ? 'checked="checked"' : '' ?> /> User receives other operators permissions request</label></div></div></div><?php   ?><div class="row form-group"><div class="col-md-6"><label>Skype</label><input type="text" class="form-control" name="Skype" value="<?php  echo htmlspecialchars($user->skype);?>"/></div><div class="col-md-6"><label>XMPP username</label><input type="text" class="form-control" name="XMPPUsername" value="<?php  echo htmlspecialchars($user->xmpp_username);?>"/></div></div><div class="form-group"><label>Photo, (jpg,png)</label><input type="file" name="UserPhoto" value="" /></div><?php  if ($user->has_photo) : ?><div class="form-group"><img src="<?php  echo $user->photo_path?>" alt="" width="50" /><br /><label><input type="checkbox" name="DeletePhoto" value="1" /> Delete</label></div><?php  endif;?><?php  if ($can_edit_groups === true) : ?><div class="form-group"><label>User group</label><?php  echo erLhcoreClassRenderHelper::renderCombobox( array ( 'input_name' => 'DefaultGroup[]', 'selected_id' => $user->user_groups_id, 'multiple' => true, 'css_class' => 'form-control', 'list_function' => 'erLhcoreClassModelGroup::getList', 'list_function_params' => $user_groups_filter )); ?></div><label>Disabled&nbsp;<input type="checkbox" value="on" name="UserDisabled" <?php  echo $user->disabled == 1 ? 'checked="checked"' : '' ?> /></label><br><?php  endif; ?><label>Do not show user status as online&nbsp;<input type="checkbox" value="on" name="HideMyStatus" <?php  echo $user->hide_online == 1 ? 'checked="checked"' : '' ?> /></label><br><input type="hidden" name="csfr_token" value="<?php  echo erLhcoreClassUser::instance()->getCSFRToken()?>" /><?php   ?><div class="btn-group" role="group" aria-label="..."><input type="submit" class="btn btn-default" name="Save_account" value="Save"/><input type="submit" class="btn btn-default" name="Update_account" value="Update"/><input type="submit" class="btn btn-default" name="Cancel_account" value="Cancel"/></div></form></div><div role="tabpanel" class="tab-pane <?php  if ($tab == 'tab_departments') : ?>active<?php  endif;?>" id="departments"><h5>Assigned departments</h5><?php  if (isset($account_updated_departaments) && $account_updated_departaments == 'done') : $msg = 'Account updated'; ?><div role="alert" class="alert alert-success alert-dismissible fade in"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button><?php  echo $msg?></div><?php  endif; ?><?php   $userDepartaments = erLhcoreClassUserDep::getUserDepartamentsIndividual($user->id); $userDepartamentsGroup = erLhcoreClassModelDepartamentGroupUser::getUserGroupsIds($user->id); ?><form action="/richard/sites/live121support.com-master/index.php/site_admin/user/edit/<?php  echo $user->id?>#departments" method="post" enctype="multipart/form-data"><label><input type="checkbox" value="on" name="all_departments" <?php  echo $user->all_departments == 1 ? 'checked="checked"' : '' ?> />All departments</label><br><hr class="mt10 mb10"><div class="row"><div class="col-xs-6"><input type="hidden" name="csfr_token" value="<?php  echo erLhcoreClassUser::instance()->getCSFRToken()?>" /><h4>Individual departments</h4><div class="mx170"><?php  foreach (erLhcoreClassDepartament::getDepartaments() as $departament) : ?><label><input type="checkbox" name="UserDepartament[]" value="<?php  echo $departament['id']?>" <?php  echo in_array($departament['id'],$userDepartaments) ? 'checked="checked"' : '';?> /><?php  echo htmlspecialchars($departament['name'])?></label><br><?php  endforeach; ?></div></div><?php  $departmentsGroups = erLhcoreClassModelDepartamentGroup::getList(array('limit' => false)); ?><?php  if (!empty($departmentsGroups)) : ?><div class="col-xs-6"><h4>Departments groups</h4><?php  foreach ($departmentsGroups as $departamentGroup) : ?><label><input type="checkbox" name="UserDepartamentGroup[]" value="<?php  echo $departamentGroup->id?>" <?php  echo in_array($departamentGroup->id,$userDepartamentsGroup) ? ' checked="checked" ' : '';?> /><?php  echo htmlspecialchars($departamentGroup->name)?></label><br><?php  endforeach; ?></div><?php  endif;?></div><input type="submit" class="btn btn-default" name="UpdateDepartaments_account" value="Update"/></form></div><div role="tabpanel" class="tab-pane <?php  if ($tab == 'tab_pending') : ?>active<?php  endif;?>" id="pending"><form action="/richard/sites/live121support.com-master/index.php/site_admin/user/edit/<?php  echo $user->id?>#pending" method="post"><input type="hidden" name="csfr_token" value="<?php  echo erLhcoreClassUser::instance()->getCSFRToken()?>" /><label><input type="checkbox" name="showAllPendingEnabled" value="1" <?php  erLhcoreClassModelUserSetting::getSetting('show_all_pending',1,$user->id) == 1 ? print 'checked="checked"' : '' ?> /> User can see all pending chats, not only assigned to him</label><br><input type="submit" class="btn btn-default" name="UpdatePending_account" value="Update"/></form></div><?php  if (erLhcoreClassUser::instance()->hasAccessTo('lhpermission','see_permissions_users')) : ?><div role="tabpanel" class="tab-pane <?php  if ($tab == 'tab_permission') : ?>active<?php  endif;?>" id="permission"><input type="button" class="btn btn-default" name="UpdateSpeech_account" onclick="lhinst.showMyPermissions('<?php  echo $user->id?>')" value="Show permissions" /><div id="permissions-summary"></div></div><?php  endif;?><?php   ?></div>