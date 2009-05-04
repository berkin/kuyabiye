<?php

class ajaxWebdebugActions extends sfActions {
  public function executeGetWebdebug() {
    sfConfig::set('sf_web_debug', false);
    $this->getResponse()->setContent($this->getFlash('_ajaxWebDebug'));
    $this->getResponse()->setHttpHeader("X-JSON", JSON::encode(array('webdebug'=>true)));
    return sfView::NONE;
  }
}
?>