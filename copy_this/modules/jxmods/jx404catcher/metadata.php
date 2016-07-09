<?php
/**
 * Metadata version
 */
$sMetadataVersion = '1.1';
 
/**
 * Module information
 * 
 * @link      https://github.com/job963/jx404Catcher
 * @license   http://www.gnu.org/licenses/gpl-3.0.html GPL v3 or later
 * @copyright (C) Joachim Barthel 2016
 * 
 **/

$aModule = array(
    'id'           => 'jx404Catcher',
    'title'        => 'jx404Catcher - Logging and Redirecting of 404 Calls',
    'description'  => array(
                        'de' => 'Erfassung und Weiterleitung von 404 Aufrufen.',
                        'en' => 'Logging and Redirecting of 404 Calls.',
                        ),
    'thumbnail'    => 'jx404catcher.png',
    'version'      => '0.2.0',
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
                        array(
                                'group' => 'JX404CATCHER_DISPLAY', 
                                'name'  => 'sJx404CatcherUrlLength', 
                                'type'  => 'str', 
                                'value' => '60'
                                ),
                        )
);