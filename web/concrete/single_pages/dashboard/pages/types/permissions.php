<? defined('C5_EXECUTE') or die("Access Denied."); ?>


	<? ob_start(); ?>
	<?=Loader::element('permission/help');?>
	<? $help = ob_get_contents(); ?>
	<? ob_end_clean(); ?>

    <form method="post" action="<?=$view->action('save')?>">
	<?=Loader::helper('validation/token')->output('save_permissions')?>
	<input type="hidden" name="ptID" value="<?=$pagetype->getPageTypeID()?>" />
	<?
	$tp = new TaskPermission();
	if ($tp->canAccessPageTypePermissions()) { ?>	
		<? Loader::element('permission/lists/page_type', array(
			'pagetype' => $pagetype
		))?>
	<? } else { ?>
		<p><?=t('You cannot access page type permissions.')?></p>
	<? } ?>
	<div class="ccm-dashboard-form-actions-wrapper">
        <div class="ccm-dashboard-form-actions">
		    <a href="<?=$view->url('/dashboard/pages/types')?>" class="btn btn-default"><?=t('Back')?></a>
		    <button type="submit" value="<?=t('Save')?>" class="btn btn-primary pull-right"><?=t('Save')?> <i class="icon-ok-sign icon-white"></i></button>
	    </div>
    </div>
	</form>
	<?=Loader::helper('concrete/dashboard')->getDashboardPaneFooterWrapper(false)?>