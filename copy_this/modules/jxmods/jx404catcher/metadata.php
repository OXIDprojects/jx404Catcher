<?php
/**
 * Metadata version
 */
$sMetadataVersion = '1.1';
 
/**
 * Module information
 */
$aModule = array(
    'id'           => 'jx404Catcher',
    'title'        => 'jx404Catcher - Catching and Logging of 404 Calls',
    'description'  => array(
                        'de' => 'Erfassung und Speicherung der 404 Aufrufe.',
                        'en' => 'Catching and Logging of 404 Calls.',
                        ),
    'thumbnail'    => 'jxadminlog.png',
    'version'      => '0.1',
    'author'       => 'Joachim Barthel',
    'url'          => 'https://github.com/job963/jx404Catcher',
    'email'        => 'jobarthel@gmail.com',
    'extend'       => array(
                        'oxutils' => 'jxmods/jx404catcher/core/jx404catcher_oxutils'
                        ),
    'files'        => array(
                        'jx404catcher_list'    	=> 'jxmods/jx404catcher/application/controllers/admin/jx404catcher_list.php',
                        'jx404catcher_install'  => 'jxmods/jx404catcher/application/controllers/admin/jx404catcher_install.php'
                        ),
   'templates'     => array(
                        'jx404catcher_list.tpl' => 'jxmods/jx404catcher/application/views/admin/tpl/jx404catcher_list.tpl'
                        ),
   'blocks'        => array(
                        ),
    'events'       => array(
                        'onActivate'   => 'jx404catcher_install::onActivate', 
                        'onDeactivate' => 'jx404catcher_install::onDeactivate'
                        ),
   'settings'      => array(
                        )
);