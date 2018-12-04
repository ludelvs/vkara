<?php
/**
 * @package libs.helper
 * @author lude <lude@users.sourceforge.jp>
 */
class CustomFormHelper extends Mars_FormHelper
{

  public function eventStatusTypeSelect($selected)
  {
   $eventStatusType = Mars_Config::loadProperties('eventStatusType');

   $options = array('全て') + $eventStatusType;
   $attributes = array('onChange' => 'changeEventStatusType();');
   $extra = array('selected' => $selected, 'label' => 'ステータス');
   
   return $this->select('eventStatusType', $options, $attributes, $extra);
  } 
}