<h1>Departments</h1><form action="<?php  echo $input->form_action?>" method="get" name="SearchFormRight"><input type="hidden" name="doSearch" value="1"><div class="row"><div class="col-md-3"><div class="form-group"><label>Name</label><input type="text" class="form-control" name="name" value="<?php  echo htmlspecialchars($input->name)?>" /></div></div><div class="col-md-3"><div class="form-group"><label>Hidden</label><select class="form-control" name="hidden"><option>All</option><option value="1" <?php  $input->hidden === 1 ? print 'selected="selected"' : ''?>>Yes</option><option value="0" <?php  $input->hidden === 0 ? print 'selected="selected"' : ''?>>No</option></select></div></div><div class="col-md-3"><div class="form-group"><label>Visible only if online</label><select class="form-control" name="visible_if_online"><option>All</option><option value="1" <?php  $input->visible_if_online === 1 ? print 'selected="selected"' : ''?>>Yes</option><option value="0" <?php  $input->visible_if_online === 0 ? print 'selected="selected"' : ''?>>No</option></select></div></div><div class="col-md-3"><div class="form-group"><label>Disabled</label><select class="form-control" name="disabled"><option>All</option><option value="1" <?php  $input->disabled === 1 ? print 'selected="selected"' : ''?>>Yes</option><option value="0" <?php  $input->disabled === 0 ? print 'selected="selected"' : ''?>>No</option></select></div></div></div><div class="btn-group" role="group" aria-label="..."><input type="submit" name="doSearch" class="btn btn-default" value="Search" /></div></form><table class="table" cellpadding="0" cellspacing="0"><thead><tr><th width="1%">ID</th><th>Name</th><th>E-mail</th><th>Hidden</th><th>Disabled</th><th>Visible only if online</th><th width="1%">&nbsp;</th></tr></thead><?php  foreach ($items as $departament) : ?><tr><td><?php  echo $departament->id?></td><td><?php  echo htmlspecialchars($departament->name)?></td><td><?php  echo htmlspecialchars($departament->email)?></td><td><?php  if ($departament->hidden == 1) : ?>Yes<?php  else : ?>No<?php  endif;?></td><td><?php  if ($departament->disabled == 1) : ?>Yes<?php  else : ?>No<?php  endif;?></td><td><?php  if ($departament->visible_if_online == 1) : ?>Yes<?php  else : ?>No<?php  endif;?></td><td nowrap><a class="btn btn-default btn-xs" href="/richard/sites/live121support.com-master/index.php/site_admin/department/edit/<?php  echo $departament->id?>">Edit department</a></td></tr><?php  endforeach; ?></table><?php  if (isset($pages)) : ?><?php  if (isset($pages) && $pages->num_pages > 1) : ?><nav><ul class="pagination paginator-lhc"><?php  if ($pages->current_page != 1) : ?><li class="arrow"><a class="previous" href="<?php  echo $pages->serverURL,$pages->prev_page,$pages->querystring?>">&laquo;</a></li><?php  endif;?><?php  if ($pages->num_pages > 10) : $needNoBolder = false; if ($pages->range[0] > 1) : $i = 1; $pageURL = $i > 1 ? '/(page)/'.$i : ''; $needNoBolder = true; if ($i == $pages->current_page) : ?><li class="current no-b"><a title="Go to page <?php  echo $i?> of <?php  echo $pages->num_pages?>" href="#"><?php  echo $i?></a></li><?php  else : ?><li><a class="no-b" title="Go to page <?php  echo $i?> of <?php  echo $pages->num_pages?>" href="<?php  echo $pages->serverURL,$pageURL,$pages->querystring?>"><?php  echo $i?></a></li><?php  endif; ?><li><a href="#">...</a></li><?php endif; for($i=$pages->range[0];$i<=$pages->lastArrayNumber;$i++) : if ($i > 0) : $pageURL = $i > 1 ? '/(page)/'.$i : ''; $noBolderClass = ($i == 1 || $needNoBolder == true) ? ' no-b' : ''; $needNoBolder = false; if ($i == $pages->current_page): ?><li class="active<?php  echo $noBolderClass?>"><a title="Go to page <?php  echo $i?> of <?php  echo $pages->num_pages?>"  href="#"><?php  echo $i?></a></li><?php  else : ?><li><a class="<?php  echo $noBolderClass?>" title="Go to page <?php  echo $i?> of <?php  echo $pages->num_pages?>" href="<?php  echo $pages->serverURL,$pageURL,$pages->querystring?>"><?php  echo $i?></a></li><?php  endif;endif;endfor; if ($pages->lastArrayNumber < $pages->num_pages) : $i = $pages->num_pages; $pageURL = $i > 1 ? '/(page)/'.$i : ''; ?><li><a href="#">...</a></li><?php  if ($i == $pages->current_page) : ?><li class="active"><a title="Go to page <?php  echo $i?> of <?php  echo $pages->num_pages?>" href="#"><?php  echo $i?></a></li><?php   else : ?><li><a class="no-b" title="Go to page <?php  echo $i?> of <?php  echo $pages->num_pages?>" href="<?php  echo $pages->serverURL,$pageURL,$pages->querystring?>"><?php  echo $i?></a></li><?php  endif; endif; else : for ($i=1;$i<=$pages->num_pages;$i++) : $noBolderClass = ($i == 1) ? ' no-b' : ''; $pageURL = $i > 1 ? '/(page)/'.$i : ''; if ($i == $pages->current_page) :?><li class="active<?php  echo $noBolderClass?>"><a href="#"><?php  echo $i?></a></li><?php  else : ?><li><a class="paginate" href="<?php  echo $pages->serverURL,$pageURL,$pages->querystring;?>"><?php  echo $i?></a></li><?php  endif; endfor; endif; if ($pages->current_page != $pages->num_pages): ?><li class="arrow"><a class="next" href="<?php  echo $pages->serverURL,'/(page)/',$pages->next_page,$pages->querystring?>">&raquo;</a></li><?php  endif;?></ul><div class="found-total pull-right">Page <?php  echo $pages->current_page?> of <?php  echo $pages->num_pages?>, Found - <?php  echo $pages->items_total?></div></nav><?php  endif;?><?php  endif;?><?php  if (erLhcoreClassUser::instance()->hasAccessTo('lhdepartment','create')) : ?><a class="btn btn-default" href="/richard/sites/live121support.com-master/index.php/site_admin/department/new">New department</a><?php  endif;?>