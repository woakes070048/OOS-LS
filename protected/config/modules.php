<?php
/**
 * Merge file module_core and module_addon
 *
 * @author Putra Sudaryanto <putra.sudaryanto@gmail.com>
 * @copyright Copyright (c) 2012 Ommu Platform (ommu.co)
 * @link https://github.com/oMMu/Ommu-Core
 * @contect (+62)856-299-4114
 *
 */
return CMap::mergeArray(
	require(dirname(__FILE__) . '/module_core.php'),
	require(dirname(__FILE__) . '/module_addon.php')
);
?>