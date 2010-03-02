<?php

class Rating
{
  public static function ratingAverage($positive, $total, $power = '0.05')
  {
    if ($total == 0)
      return 0;
 
    $z = Rating::pnormaldist(1-$power/2,0,1);
    $p = 1.0 * $positive / $total;
    $s = ($p + $z*$z/(2*$total) - $z * sqrt(($p*(1-$p)+$z*$z/(4*$total))/$total))/(1+$z*$z/$total);
    return $s;
  }
  
  // When dealing with sites like Reddit, Digg, and the like you have a certain "freshness" element. 
  // The above solution might be a working model for the entire span of the site, but for that front page element you  will need to implement some form of "gravity". 
  // This can be done by taking the raw score and decaying it over time, like so:
  public static function gravityRating($positive, $total, $time, $power = '0.05')
  {
    if ($total == 0)
      return 0;
    return (Rating::ratingAverage($positive, $total, $power) / pow($time,0.5));
  }
 
  public static function pnormaldist($qn)
  {
    $b = array(
      1.570796288, 0.03706987906, -0.8364353589e-3,
      -0.2250947176e-3, 0.6841218299e-5, 0.5824238515e-5,
      -0.104527497e-5, 0.8360937017e-7, -0.3231081277e-8,
      0.3657763036e-10, 0.6936233982e-12);
 
    if ($qn < 0.0 || 1.0 < $qn)
      return 0.0;
 
    if ($qn == 0.5)
      return 0.0;
 
    $w1 = $qn;
 
    if ($qn > 0.5)
      $w1 = 1.0 - $w1;
 
    $w3 = - log(4.0 * $w1 * (1.0 - $w1));
    $w1 = $b[0];
 
    for ($i = 1;$i <= 10; $i++)
      $w1 += $b[$i] * pow($w3,$i);
 
    if ($qn > 0.5)
      return sqrt($w1 * $w3);
 
    return - sqrt($w1 * $w3);
  }
}