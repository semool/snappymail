<?php

namespace RainLoop\Providers;

class Settings extends \RainLoop\Providers\AbstractProvider
{
	/**
	 * @var \RainLoop\Providers\Settings\ISettings
	 */
	private $oDriver;

	public function __construct(\RainLoop\Providers\Settings\ISettings $oDriver)
	{
		$this->oDriver = $oDriver;
	}

	public function Load(\RainLoop\Model\Account $oAccount) : \RainLoop\Settings
	{
		$oSettings = new \RainLoop\Settings();
		$oSettings->InitData($this->oDriver->Load($oAccount));
		return $oSettings;
	}

	public function Save(\RainLoop\Model\Account $oAccount, \RainLoop\Settings $oSettings) : bool
	{
		return $this->oDriver->Save($oAccount, $oSettings->DataAsArray());
	}

	public function IsActive() : bool
	{
		return $this->oDriver instanceof \RainLoop\Providers\Settings\ISettings;
	}
}
