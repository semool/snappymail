<?php

namespace RainLoop\Providers;

class Settings extends \RainLoop\Providers\AbstractProvider
{
	/**
	 * @var \RainLoop\Providers\Settings\ISettings
	 */
	private $oDriver;

	/**
	 * @param \RainLoop\Providers\Settings\ISettings $oDriver
	 */
	public function __construct(\RainLoop\Providers\Settings\ISettings $oDriver)
	{
		$this->oDriver = $oDriver;
	}

	/**
	 * @param \RainLoop\Model\Account $oAccount
	 *
	 * @return \RainLoop\Settings
	 */
	public function Load(\RainLoop\Model\Account $oAccount)
	{
		$oSettings = new \RainLoop\Settings();
		$oSettings->InitData($this->oDriver->Load($oAccount));
		return $oSettings;
	}

	/**
	 * @param \RainLoop\Model\Account $oAccount
	 * @param \RainLoop\Settings $oSettings
	 */
	public function Save(\RainLoop\Model\Account $oAccount, \RainLoop\Settings $oSettings) : bool
	{
		return $this->oDriver->Save($oAccount, $oSettings->DataAsArray());
	}

	public function IsActive() : bool
	{
		return $this->oDriver instanceof \RainLoop\Providers\Settings\ISettings;
	}
}
