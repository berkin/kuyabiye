<?php
function get_age($dob) {
  $distance = floor(abs(time() - $dob) / (60 * 525960));
  
  return $distance;
}