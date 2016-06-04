<?php
/*
 *    This file is part of the module jx404Catcher for OXID eShop Community Edition.
 *
 *    The module jx404Catcher for OXID eShop Community Edition is free software: you can redistribute it and/or modify
 *    it under the terms of the GNU General Public License as published by
 *    the Free Software Foundation, either version 3 of the License, or
 *    (at your option) any later version.
 *
 *    The module jx404Catcher for OXID eShop Community Edition is distributed in the hope that it will be useful,
 *    but WITHOUT ANY WARRANTY; without even the implied warranty of
 *    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 *    GNU General Public License for more details.
 *
 *    You should have received a copy of the GNU General Public License
 *    along with OXID eShop Community Edition.  If not, see <http://www.gnu.org/licenses/>.
 *
 * @link      https://github.com/job963/jx404Catcher
 * @license   http://www.gnu.org/licenses/gpl-3.0.html GPL v3 or later
 * @copyright (C) Joachim Barthel 2016
 * 
 */

class jx404Catcher_Install
{ 
    public static function onActivate() 
    { 

        $oDb = oxDb::getDb(); 

        $isUtf = oxRegistry::getConfig()->isUtf(); 
        $sCollate = ($isUtf ? "COLLATE 'utf8_general_ci'" : "");
        
        $aSql[] = "CREATE TABLE `jx404catches` ("
                    . "`JXID` char(32) $sCollate DEFAULT NULL, "
                    . "`JX404URL` varchar(255) $sCollate DEFAULT NULL, "
                    . "`JXCOUNTS` int(11) $sCollate DEFAULT NULL, "
                    . "`JXINSERT` datetime DEFAULT NULL, "
                    . "`JXTIMESTAMP` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP, "
                    . "UNIQUE INDEX `JX404URL` (`JX404URL`)"
                . ") "
                . "ENGINE=MyISAM DEFAULT " . ($isUtf ? ' CHARSET=utf8' : '');
        
        foreach ($aSql as $sSql) {
            try {
                $oRs = $oDb->Execute($sSql);
            }
            catch (Exception $e) {
                echo '<div style="border:2px solid #dd0000;margin:10px;padding:5px;background-color:#ffdddd;font-family:sans-serif;font-size:14px;">';
                echo '<b>SQL-Error '.$e->getCode().' in SQL statement</b><br />'.$e->getMessage().'';
                echo '</div>';
                return false;
                die();
            }
        }
        
        return true; 
    } 


    public static function onDeactivate() 
    { 
        /* do nothing */
        
        return true; 
    }  
}

?>