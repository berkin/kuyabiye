<?php
// auto-generated by sfPropelCrud
// date: 2009/01/01 18:26:05
?>
<?php

/**
 * tag actions.
 *
 * @package    sf_sandbox
 * @subpackage tag
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 3335 2007-01-23 16:19:56Z fabien $
@TODO
- tools js de form adresi vs. yi elle giriyorsun, yani adres değişince onlar almayacak. ona bir helper lazım.
- show comment'e iki kere arka arka tıklayınca sapıtıyor, jquery zıbırı iöin deliciousda linkler var konu hakkında. animate olurken return false göndercen. bi de gönder butonu hafif yanda çıkıo
- comment sisteminde transaction veya locktable bi guvenlik lazim
- bu comment save() methoduna bu commentpeer::updateCommentsTree methodunu eklemyi denedin olmadi ama deneyebilirsin yine:P
- comment'i lib/model/comment.php bunda commentjoinuser methodunu override etmeye çalışabilin http://trac.symfony-project.org/wiki/ApplyingCustomJoinsInDoSelect article a bak hydrate filanla startcolumn bunlarla deneyebilirsin.
- reply de login vs. ayrıca bos gondermeyi engelle
- markdown

<br />
@TODO<br />
-search yaptığın şeyi get ile ekliyorsun, misal tag/add/?vs vs. bunu postla yapsan daha mantıklı olur<br />
-executeAdd metodunda tag'i şak diye ekliyorsun, arama sonucundan geliyor adam ama yine de tag var mı yok mu kontrol et<br />
-tag/add/ ve tag/search var adam search diye tag eklemeye kalkarsa nolcak<br />
-komşuluk öldü mü, komşuluk oldu mu stripped tagleri aynı?? napcaz<br />
-boş aramayı engelle, special charackterleri engelle<br />
-search sqli çok çakma oldu, şu 21.konudaki olayı yap, kelime kelime arasın... senin ki did you mean? gibi bişe oldu<br />
 */
class tagActions extends sfActions
{
  public function executeIndex()
  {
    $this->getResponse()->addJavascript(sfConfig::get('app_jquery'));
    $this->getResponse()->addJavascript('cycle');

    $this->loved_tags   = TagPeer::getPopularTags(true);
    $this->hated_tags   = TagPeer::getPopularTags(false);
    // $this->sticky_tags  = TagPeer::getPopularTags(null, true);
    
    $this->showcase_tags = TagPeer::getShowcaseTags();
    
    $c = new Criteria();
    $c->add(UserPeer::AVATAR, null, Criteria::NOT_EQUAL);
    $c->addDescendingOrderByColumn(UserPeer::CREATED_AT);
    $c->setLimit(10);
    
    $this->last_users = UserPeer::doSelect($c);
  }

  public function executeList()
  {
    $this->tags = TagPeer::doSelect(new Criteria());
  }

  public function executeShow()
  {
    $c = new Criteria();
    $c->add(TagPeer::STRIPPED_TAG, $this->getRequestParameter('stripped_tag'));
    $this->tag = TagPeer::doSelectOne($c);
    
    if ( !$this->tag )
    {
      $this->setFlash('search', $this->getRequestParameter('ara'));
      $this->redirect('@tag_search');
    }
   
    $this->counts = UserToTagPeer::getCountOfLovers($this->tag->getId());
    $this->percents = myTools::getLimitOfLovers($this->counts, 100, 1);
    $this->total = myTools::getTotalLovers($this->counts);
    
    $this->lovers = array();
    if ( sizeof($this->counts) )
    {
      $users = UserPeer::getLovers($this->counts, $this->tag->getId());
      $this->lovers = isset($users['lovers']) ? $users['lovers'] : array();
      $this->haters = isset($users['haters']) ? $users['haters'] : array();
    }
    
    if ( $this->getUser()->isAuthenticated() )
    {
      $this->getResponse()->addJavascript(sfConfig::get('app_jquery'));
      $this->getResponse()->addJavascript('jquery.textarea-expander.js');
      $this->getResponse()->addJavascript('jquery.livequery.js');
    }
    
    $this->page = $this->getRequestParameter('page', 1);
    $this->comments = CommentPeer::getCommentsJoinUserWithDepth($this->tag->getId(), $this->page);

    $this->token = myTools::generate_random_key();
    $this->setFlash('token', $this->token);
  }
  
  public function executeLovers()
  {
    $c = new Criteria();
    $c->add(TagPeer::STRIPPED_TAG, $this->getRequestParameter('stripped_tag'));
    $this->tag = TagPeer::doSelectOne($c);
    
    $this->forward404Unless($this->tag);
    
    $this->sense = $this->getRequestParameter('sense');
    if ( !array_search($this->sense, sfConfig::get('app_lovers')) )
    {
      $this->forward404();    
    }
    
    $pager = new sfPropelPager('UserToTag', 40);    
    $c = new Criteria();
    $c->add(UserToTagPeer::TAGS_ID, $this->tag->getId());
    $c->addDescendingOrderByColumn(UserToTagPeer::CREATED_AT);
    switch ( $this->sense )
    {
      case 'sevenler':
        $c->add(UserToTagPeer::LOVE, 1);
        break;
      case 'sevmeyenler':
        $c->add(UserToTagPeer::LOVE, 0);
        break;
    }
    
    $pager->setCriteria($c);
    $pager->setPage($this->getRequestParameter('page', 1));
    $pager->setPeerMethod('doSelectJoinUser');
    $pager->init();
    
    $this->users = $pager;
    
  }
  
  public function executeSearch()
  {

    $this->search = mb_strtolower($this->getRequestParameter('ara'), 'UTF-8');  
    
    
    $c = new Criteria();
    $c->add(TagPeer::TAG, $this->search);
    $tag = TagPeer::doSelectOne($c);
    if ( $tag )
    {
      $this->redirect('@tag?stripped_tag=' . $tag->getStrippedTag() . '&page=');
    }
    
    $conn = Propel::getConnection();
    $query = 'SELECT ' . TagPeer::TAG . ', ' . TagPeer::STRIPPED_TAG . ' FROM ' . TagPeer::TABLE_NAME . ' 
                WHERE ' . TagPeer::TAG . ' SOUNDS LIKE ? 
                LIMIT ?;';
              
    $stmt = $conn->prepareStatement($query);
    $stmt->setString(1, $this->search);
    $stmt->setInt(2, 20);
    $rs = $stmt->executeQuery();

    $this->sounds = array();
    while ( $rs->next() ) 
    {
      $this->sounds[] = array('tag' => $rs->getString('TAG'),
                              'stripped_tag' => $rs->getString('STRIPPED_TAG'));
    }
  }
  
  public function executeAdd()
  {
    
    $c = new Criteria();
    $c->add(TagPeer::TAG, mb_strtolower($this->getRequestParameter('search'), 'UTF-8'));
    $search = TagPeer::doSelectOne($c);
    if ( $search )
    {
      $this->redirect('@tag?stripped_tag=' . $search->getStrippedTag() . '&page=');
    }

    $tag = new Tag();
    $tag->setTag($this->getRequestParameter('search'));
    $tag->setCreatedBy($this->getUser()->getSubscriberId());
    $tag->save();
    
    $sense = $this->getRequestParameter('sense');
    
    if ( $sense )
    {
      $user_tag = new UserToTag();
      $user_tag->setUser($this->getUser()->getSubscriber());
      $user_tag->setTag($tag);
      $user_tag->setLove($sense == 'seviyorum' ? true : false);
      $user_tag->save();
    }
        
    $this->redirect('@tag?stripped_tag=' . $tag->getStrippedTag() . '&page=');
  }
  
  public function handleErrorSearch()
  {
    $this->search = $this->getRequestParameter('search');
  }
  
}
