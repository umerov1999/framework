<?php
if (!@include_once(getenv('FREEPBX_CONF') ? getenv('FREEPBX_CONF') : '/etc/freepbx.conf')) {
  include_once('/etc/asterisk/freepbx.conf');
}

$sbin = \FreePBX::Config()->get("AMPSBIN");
$mf = module_functions::create();
$modules = $mf->getinfo(false, array(MODULE_STATUS_NEEDUPGRADE));
if(is_array($modules)) {
	foreach($modules as $module) {
		$rawn = $module['rawname'];
		exec($sbin."/fwconsole ma install $rawn --force");
	}
}
