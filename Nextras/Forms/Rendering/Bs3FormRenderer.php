<?php

/**
 * This file is part of the Nextras community extensions of Nette Framework
 *
 * @license    New BSD License
 * @link       https://github.com/nextras/forms
 * @author     Jan Skrasek
 */

namespace Nextras\Forms\Rendering;

use Nette\Forms\Rendering\DefaultFormRenderer;
use Nette\Forms\Controls;
use Nette;
use Nette\Utils\Html;


/**
 * FormRenderer for Bootstrap 3 framework.
 * @author   Jan Skrasek
 * @author   David Grudl
 */
class Bs3FormRenderer extends DefaultFormRenderer
{
	/** @var bool */
	private $controlsInit = FALSE;


	public function __construct()
	{
		$this->wrappers['controls']['container'] = NULL;
		$this->wrappers['pair']['container'] = 'div class=form-group';
		$this->wrappers['pair']['.error'] = 'has-error';
		$this->wrappers['control']['container'] = 'div class=col-sm-9';
		$this->wrappers['label']['container'] = 'div class="col-sm-3 control-label"';
		$this->wrappers['control']['description'] = 'span class=help-block';
		$this->wrappers['control']['errorcontainer'] = 'span class=help-block';
	}


	public function renderBegin()
	{
		$this->controlsInit();
		return parent::renderBegin();
	}


	public function renderEnd()
	{
		$this->controlsInit();
		return parent::renderEnd();
	}


	public function renderBody()
	{
		$this->controlsInit();
		return parent::renderBody();
	}


	public function renderControls($parent)
	{
		$this->controlsInit();
		return parent::renderControls($parent);
	}


	public function renderPair(Nette\Forms\IControl $control)
	{
		$this->controlsInit();
		return parent::renderPair($control);
	}


	public function renderPairMulti(array $controls)
	{
		$this->controlsInit();
		return parent::renderPairMulti($controls);
	}


	public function renderLabel(Nette\Forms\IControl $control)
	{
		$this->controlsInit();
		return parent::renderLabel($control);
	}


	public function renderControl(Nette\Forms\IControl $control)
	{
		$this->controlsInit();
		return parent::renderControl($control);
	}


	private function controlsInit()
	{
		if ($this->controlsInit) {
			return;
		}

		$this->controlsInit = TRUE;
		$this->form->getElementPrototype()->class('form-horizontal');
		foreach ($this->form->getControls() as $control) {
			if ($control instanceof Controls\Button) {
				$control->setAttribute('class', empty($usedPrimary) ? 'btn btn-primary' : 'btn btn-default');
				$usedPrimary = TRUE;

			} elseif ($control instanceof Controls\TextBase || $control instanceof Controls\SelectBox || $control instanceof Controls\MultiSelectBox) {
				$control->setAttribute('class', 'form-control');

			} elseif ($control instanceof Controls\Checkbox || $control instanceof Controls\CheckboxList || $control instanceof Controls\RadioList) {
				$control->getSeparatorPrototype()->setName('div')->class($control->getControlPrototype()->type);
			}
		}
	}

}
