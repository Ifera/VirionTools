<?php
declare(strict_types = 1);

/**
 *  _    _ _      _           _____           _
 * | |  | (_)    (_)         |_   _|         | |
 * | |  | |_ _ __ _  ___  _ __ | | ___   ___ | |___
 * | |  | | | '__| |/ _ \| '_ \| |/ _ \ / _ \| / __|
 *  \ \_/ / | |  | | (_) | | | | | (_) | (_) | \__ \
 *   \___/|_|_|  |_|\___/|_| |_\_/\___/ \___/|_|___/
 *
 * VirionTools, a VirionTools plugin like DevTools for PocketMine-MP.
 * Copyright (c) 2018 JackMD  < https://github.com/JackMD >
 *
 * Discord: JackMD#3717
 * Twitter: JackMTaylor_
 *
 * This software is distributed under "GNU General Public License v3.0".
 * This license allows you to use it and/or modify it but you are not at
 * all allowed to sell this plugin at any cost. If found doing so the
 * necessary action required would be taken.
 *
 * VirionTools is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
 * GNU General Public License v3.0 for more details.
 *
 * You should have received a copy of the GNU General Public License v3.0
 * along with this program. If not, see
 * <https://opensource.org/licenses/GPL-3.0>.
 * ------------------------------------------------------------------------
 */

namespace JackMD\VirionTools;

use JackMD\VirionTools\commands\CompileVirionCommand;
use JackMD\VirionTools\commands\InjectVirionCommand;
use pocketmine\plugin\PluginBase;

define("DS", DIRECTORY_SEPARATOR);

class VirionTools extends PluginBase{

	/** @var string */
	public const PREFIX = "§2[§6Virion§eTools§2]§r ";

	public function onLoad(): void{
		if(!is_dir($this->getDataFolder() . "builds" . DS)){
			mkdir($this->getDataFolder() . "builds" . DS);
		}
		if(!is_dir($this->getDataFolder() . "plugins" . DS)){
			mkdir($this->getDataFolder() . "plugins" . DS);
		}
	}

	public function onEnable(): void{
		$this->getServer()->getCommandMap()->register("viriontools", new CompileVirionCommand($this));
		$this->getServer()->getCommandMap()->register("viriontools", new InjectVirionCommand($this));
	}

	/**
	 * @return string
	 */
	public function getPHPBinary(){
		return PHP_BINARY;
	}

	/**
	 * @param string $virionName
	 * @return bool
	 */
	public function virionDirectoryExists(string $virionName): bool{
		return is_dir($this->getServer()->getDataPath() . "virions" . DS . $virionName);
	}

	/**
	 * @param string $virionName
	 * @return bool
	 */
	public function virionPharExists(string $virionName): bool{
		return file_exists($this->getDataFolder() . "builds" . DS . $virionName);
	}

	/**
	 * @param string $pluginName
	 * @return bool
	 */
	public function pluginPharExists(string $pluginName): bool{
		return file_exists($this->getDataFolder() . "plugins" . DS . $pluginName);
	}
}