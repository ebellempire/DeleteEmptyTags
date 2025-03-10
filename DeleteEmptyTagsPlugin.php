<?php
include 'det.php';
class DeleteEmptyTagsPlugin extends Omeka_Plugin_AbstractPlugin{
	protected $_hooks = array('admin_tags_browse');
	
	public function hookAdminTagsBrowse($tags)
	{
		echo det_form($tags);
	}

}