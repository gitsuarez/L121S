<?php
 $tpl = erLhcoreClassTemplate::getInstance( 'lhdepartment/departments.tpl.php'); $departmentParams = array(); if ($currentUser->hasAccessTo('lhdepartment','manageall') !== true) { $userDepartments = erLhcoreClassUserDep::parseUserDepartmetnsForFilter($currentUser->getUserID()); if ($userDepartments !== true){ $departmentParams['filterin']['id'] = $userDepartments; } } if (isset($_GET['doSearch'])) { $filterParams = erLhcoreClassSearchHandler::getParams(array('module' => 'departament','module_file' => 'dep_list','format_filter' => true, 'use_override' => true, 'uparams' => $Params['user_parameters_unordered'])); $filterParams['is_search'] = true; } else { $filterParams = erLhcoreClassSearchHandler::getParams(array('module' => 'departament','module_file' => 'dep_list','format_filter' => true, 'uparams' => $Params['user_parameters_unordered'])); $filterParams['is_search'] = false; } $pages = new lhPaginator(); $pages->serverURL = '/richard/sites/live121support.com-master/index.php/site_admin/department/departments'; $pages->items_total = erLhcoreClassModelDepartament::getCount(array_merge($filterParams['filter'],$departmentParams)); $pages->setItemsPerPage(20); $pages->paginate(); $items = array(); if ($pages->items_total > 0) { $items = erLhcoreClassModelDepartament::getList(array_merge($filterParams['filter'],$departmentParams,array('offset' => $pages->low, 'limit' => $pages->items_per_page,'sort' => 'id ASC'))); } $tpl->set('items',$items); $tpl->set('pages',$pages); $filterParams['input_form']->form_action = '/richard/sites/live121support.com-master/index.php/site_admin/department/departments'; $tpl->set('input',$filterParams['input_form']); $Result['content'] = $tpl->fetch(); $Result['path'] = array( array('url' => '/richard/sites/live121support.com-master/index.php/site_admin/system/configuration','title' => 'System configuration'), array('url' => '/richard/sites/live121support.com-master/index.php/site_admin/department/departments','title' => 'Departments')) ?>