<?php
 $tpl = erLhcoreClassTemplate::getInstance( 'lhpermission/roles.tpl.php'); $tpl->set('currentUser',$currentUser); $Result['content'] = $tpl->fetch(); $Result['path'] = array(array('url' => '/richard/sites/live121support.com-master/index.php/site_admin/system/configuration','title' => 'System configuration'), array('title' => 'List of roles') ); erLhcoreClassChatEventDispatcher::getInstance()->dispatch('permission.roles_path', array('result' => & $Result)); ?>