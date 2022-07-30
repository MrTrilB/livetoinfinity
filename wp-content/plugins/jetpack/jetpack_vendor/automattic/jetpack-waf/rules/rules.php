<?php
if ( require('/var/www/vhosts/mrtrilb.com/httpdocs/wp-content/plugins/jetpack/jetpack_vendor/automattic/jetpack-waf/src/../rules/allow-ip.php') ) { return; }
if ( require('/var/www/vhosts/mrtrilb.com/httpdocs/wp-content/plugins/jetpack/jetpack_vendor/automattic/jetpack-waf/src/../rules/block-ip.php') ) { return $waf->block('block', -1, 'ip block list'); }

