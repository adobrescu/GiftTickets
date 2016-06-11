<?php

//Dummy empty class. It just impersonate a real framework "FormView" class from which this app classes inherits.

include_once(__DIR__.'/View.class.php');

class FormView extends View
{
	public function showArraySelect($arr, $nameAndId, $selectedOption, $optionNone='None', $multiple=false, $prefix='', $concatText='', $concatValue='')
	{
		$html='<select name="'.$nameAndId.'" id="'.$nameAndId.'"'.($multiple?' multiple':'').'>';
		
		if($optionNone)
		{
			$html.='<option value=""'.($selectedOption===''?' selected':'').'>'.$optionNone.'</option>';
		}
		foreach($arr as $value=>$text)
		{
			$html .= '<option value="'.$value.($concatValue?$concatValue.$text:'').'"'.($value==$selectedOption?' selected':'').'>'.$prefix.($concatText?$value.$concatText.' ':'').$text.'</option>';
		}
		
		$html .= '</select>';
		
		return $html;
	}
}