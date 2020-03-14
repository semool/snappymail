<?php

/*
 * This file is part of MailSo.
 *
 * (c) 2014 Usenko Timur
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace MailSo\Mime;

/**
 * @category MailSo
 * @package Mime
 */
class Attachment
{
	/**
	 * @var resource
	 */
	private $rResource;

	/**
	 * @var string
	 */
	private $sFileName;

	/**
	 * @var int
	 */
	private $iFileSize;

	/**
	 * @var string
	 */
	private $sCID;

	/**
	 * @var bool
	 */
	private $bIsInline;

	/**
	 * @var bool
	 */
	private $bIsLinked;

	/**
	 * @var array
	 */
	private $aCustomContentTypeParams;

	/**
	 * @var string
	 */
	private $sContentLocation;

	/**
	 * @access private
	 */
	private function __construct($rResource, $sFileName, $iFileSize, $bIsInline, $bIsLinked, $sCID,
		$aCustomContentTypeParams = array(), $sContentLocation = '')
	{
		$this->rResource = $rResource;
		$this->sFileName = $sFileName;
		$this->iFileSize = $iFileSize;
		$this->bIsInline = $bIsInline;
		$this->bIsLinked = $bIsLinked;
		$this->sCID = $sCID;
		$this->aCustomContentTypeParams = $aCustomContentTypeParams;
		$this->sContentLocation = $sContentLocation;
	}

	/**
	 * @param resource $rResource
	 *
	 * @return \MailSo\Mime\Attachment
	 */
	public static function NewInstance($rResource, string $sFileName = '', int $iFileSize = 0, bool $bIsInline = false,
		bool $bIsLinked = false, string $sCID = '', array $aCustomContentTypeParams = array(), string $sContentLocation = '')
	{
		return new self($rResource, $sFileName, $iFileSize, $bIsInline, $bIsLinked, $sCID, $aCustomContentTypeParams, $sContentLocation);
	}

	/**
	 * @return resource
	 */
	public function Resource()
	{
		return $this->rResource;
	}

	public function ContentType() : string
	{
		return \MailSo\Base\Utils::MimeContentType($this->sFileName);
	}

	public function CustomContentTypeParams() : array
	{
		return $this->aCustomContentTypeParams;
	}

	public function CID() : string
	{
		return $this->sCID;
	}

	public function ContentLocation() : string
	{
		return $this->sContentLocation;
	}

	public function FileName() : string
	{
		return $this->sFileName;
	}

	public function FileSize() : int
	{
		return $this->iFileSize;
	}

	public function IsInline() : bool
	{
		return $this->bIsInline;
	}

	public function IsImage() : bool
	{
		return 'image' === \MailSo\Base\Utils::ContentTypeType($this->ContentType(), $this->FileName());
	}

	public function IsArchive() : bool
	{
		return 'archive' === \MailSo\Base\Utils::ContentTypeType($this->ContentType(), $this->FileName());
	}

	public function IsPdf() : bool
	{
		return 'pdf' === \MailSo\Base\Utils::ContentTypeType($this->ContentType(), $this->FileName());
	}

	public function IsDoc() : bool
	{
		return 'doc' === \MailSo\Base\Utils::ContentTypeType($this->ContentType(), $this->FileName());
	}

	public function IsLinked() : bool
	{
		return $this->bIsLinked && 0 < \strlen($this->sCID);
	}
}