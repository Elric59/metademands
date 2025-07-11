<?php

/*
 -------------------------------------------------------------------------
 Metademands plugin for GLPI
 Copyright (C) 2003-2019 by the Metademands Development Team.

 -------------------------------------------------------------------------

 LICENSE

 This file is part of Metademands.

 Metademands is free software; you can redistribute it and/or modify
 it under the terms of the GNU General Public License as published by
 the Free Software Foundation; either version 2 of the License, or
 (at your option) any later version.

 Metademands is distributed in the hope that it will be useful,
 but WITHOUT ANY WARRANTY; without even the implied warranty of
 MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 GNU General Public License for more details.

 You should have received a copy of the GNU General Public License
 along with Metademands. If not, see <http://www.gnu.org/licenses/>.
 --------------------------------------------------------------------------
 */

class PluginMetademandsAutoloader
{
    public function autoload($classname)
    {
        $dir      = PLUGIN_METADEMANDS_DIR . "/inc/";
        foreach (glob(dirname(__FILE__).'/typefields/*.class.php') as $class_file) {
            $matches = null;
            preg_match("#typefields/(.+)\.class.php$#", $class_file, $matches);

            $filename = $dir.$matches[0];

            if (is_readable($filename) && is_file($filename)) {
                include_once($filename);
            }
        }
    }

    public function register()
    {
        spl_autoload_register([$this, 'autoload'], true, true);
    }
}
