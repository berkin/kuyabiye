<?php
use_helper('Form');
function object_radiobutton_tag($object, $method, $value, $options = array())
{
  $options = _parse_attributes($options);

  // See if the object contains the value passed in
  // if yes, set "true" (radio button toggled on)
  if ( _get_object_value($object, $method) == $value )
  {
    $checked = true;
  }
  else
  {
    $checked = false;
  }

  return radiobutton_tag(_convert_method_to_name($method, $options), $value, $checked, $options);
}