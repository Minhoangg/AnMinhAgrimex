<?php

namespace Sabberworm\CSS\Value;

use Sabberworm\CSS\OutputFormat;

class CSSString extends PrimitiveValue {

	private $sString;

	public function __construct($sString) {
		$this->sString = $sString;
	}

	public function setString($sString) {
		$this->sString = $sString;
	}

	public function getString() {
		return $this->sString;
	}

	public function __toString() {
		return $this->render(new OutputFormat());
	}

	public function render(OutputFormat $oOutputFormat) {
		$sString = addslashes($this->sString);
		$sString = str_replace("\n", '\A', $sString);
		return $oOutputFormat->getStringQuotingType() . $sString . $oOutputFormat->getStringQuotingType();
	}

}