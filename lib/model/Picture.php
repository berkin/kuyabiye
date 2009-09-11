<?php

/**
 * Subclass for representing a row from the 'pictures' table.
 *
 * 
 *
 * @package lib.model
 */ 
class Picture extends BasePicture
{
  public function __toString() {
    return $this->getName();
  }
}
