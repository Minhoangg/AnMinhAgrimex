<?php

namespace Sabberworm\CSS\Property;

use Sabberworm\CSS\OutputFormat;

/**
* CSSNamespace represents an @namespace rule.
*/
class CSSNamespace implements AtRule {
	private $mUrl;
	private $sPrefix;
	
	public function __construct($mUrl, $sPrefix = null) {
		$this->mUrl = $mUrl;
		$this->sPrefix = $sPrefix;
	}
	
	public function __toString() {
		return $this->render(new OutputFormat());
	}

	public function render(OutputFormat $oOutputFormat) {
		return '@namespace '.($this->sPrefix === null ? '' : $this->sPrefix.' ').$this->mUrl->render($oOutputFormat).';';
	}
	
	public function getUrl() {
		return $this->mUrl;
	}

	public function getPrefix() {
		return $this->sPrefix;
	}

	public function setUrl($mUrl) {
		$this->mUrl = $mUrl;
	}

	public function setPrefix($sPrefix) {
		$this->sPrefix = $sPrefix;
	}

	public function atRuleName() {
		return 'namespace';
	}

	public function atRuleArgs() {
		$aResult = array($this->mUrl);
		if($this->sPrefix) {
			array_unshift($aResult, $this->sPrefix);
		}
		return $aResult;
	}
}