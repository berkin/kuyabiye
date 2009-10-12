<?php
 
/*
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 */
/**
 * @package    symfony
 * @subpackage addon
 * @author     Fabien Potencier <fabien.potencier@symfony-project.com>
 * @version    SVN: $Id: sfPropelPager.class.php 1415 2006-06-11 08:33:51Z fabien $
 */
 
/**
 *
 * myCustomPager class.
 *
 * @package    symfony
 * @subpackage addon
 * @author     Fabien Potencier <fabien.potencier@symfony-project.com>
 *   
 * Changed: sfPropelPager.class.php 
 * Changed by: Timu EREN
 * Last Changed: 12 / 08 /2006(dd /mm/ YYYY)
 */
class myCustomPager
{
  private
    $page                   = 1,
    $maxPerPage             = 0,
    $lastPage               = 1,
    $nbResults              = 0,
    $query               = null,
    $countQuery     = null,
    $objects                = null,
    $cursor                 = 1,
    $parameters             = array(),
    $currentMaxLink         = 1;
 
 
  public function __construct($cSQL,$SQL, $defaultMaxPerPage = 10)
  {
        $con = Propel::getConnection();
        $SQL = $con->prepareStatement($SQL);
        $cSQL = $con->prepareStatement($cSQL);
        $this->setQuery($SQL);
        $this->setCountQuery($cSQL);
        $this->setMaxPerPage($defaultMaxPerPage);
        $this->setPage(1);
  }
 
  public function init()
  {
        $cForCount =  $this->getCountQuery();
        $c = $cForCount->executeQuery();
        $c->next();
 
        $this->setNbResults($c->get('count'));
 
        $c =  $this->getQuery();
        $c->setLimit(0);
        $c->setOffset(0);
        if (($this->getPage() == 0 || $this->getMaxPerPage() == 0))
        {
            $this->setLastPage(0);
        }
        else
        {
            $this->setLastPage(ceil($this->getNbResults() / $this->getMaxPerPage()));
            $c->setOffset(($this->getPage() - 1) * $this->getMaxPerPage());
            $c->setLimit($this->getMaxPerPage());
        }
  }
 
  public function getCurrentMaxLink()
  {
        return $this->currentMaxLink;
  }
 
  public function getLinks($nb_links = 5)
  {
    $links = array();
    $tmp   = $this->page - floor($nb_links / 2);
    $check = $this->lastPage - $nb_links + 1;
    $limit = ($check > 0) ? $check : 1;
    $begin = ($tmp > 0) ? (($tmp > $limit) ? $limit : $tmp) : 1;
 
    $i = $begin;
    while (($i < $begin + $nb_links) && ($i <= $this->lastPage))
    {
      $links[] = $i++;
    }
 
    $this->currentMaxLink = $links[count($links) - 1];
 
    return $links;
  }
  public function haveToPaginate()
  {
    return (($this->getPage() != 0) && ($this->getNbResults() > $this->getMaxPerPage()));
  }
 
  public function getCursor()
  {
    return $this->cursor;
  }
 
  public function setCursor($pos)
  {
    if ($pos < 1)
    {
      $this->cursor = 1;
    }
    else if ($pos > $this->nbResults)
    {
      $this->cursor = $this->nbResults;
    }
    else
    {
      $this->cursor = $pos;
    }
  }
 
  public function getObjectByCursor($pos)
  {
    $this->setCursor($pos);
    return $this->getCurrent();
  }
 
  public function getCurrent()
  {
    return $this->retrieveObject($this->cursor);
  }
 
  public function getNext()
  {
    if (($this->cursor + 1) > $this->nbResults)
    {
      return null;
    }
    else
    {
      return $this->retrieveObject($this->cursor + 1);
    }
  }
 
  public function getPrevious()
  {
    if (($this->cursor - 1) < 1)
    {
      return null;
    }
    else
    {
      return $this->retrieveObject($this->cursor - 1);
    }
  }
 
  private function retrieveObject($offset)
  {
    $cForRetrieve = $this->getQuery();
    $cForRetrieve->setOffset($offset - 1);
    $cForRetrieve->setLimit(1);
    $results = $cForRetrieve->executeQuery();
    return $results;
  }
 
  public function getResults()
  {
    $c = $this->getQuery();
    return $c->executeQuery();
  }
 
  public function getFirstIndice()
  {
    if ($this->page == 0)
    {
      return 1;
    }
    else
    {
      return ($this->page - 1) * $this->maxPerPage + 1;
    }
  }
 
  public function getLastIndice()
  {
    if ($this->page == 0)
    {
      return $this->nbResults;
    }
    else
    {
      if (($this->page * $this->maxPerPage) >= $this->nbResults)
      {
        return $this->nbResults;
      }
      else
      {
        return ($this->page * $this->maxPerPage);
      }
    }
  }
 
  public function getQuery()
  {
    return $this->query;
  }
 
  public function setQuery($c)
  {
    $this->query = $c;
  }
 
  public function getCountQuery()
  {
    return $this->countQuery;
  }
 
  public function setCountQuery($c)
  {
    $this->countQuery = $c;
  }
 
  public function getNbResults()
  {
    return $this->nbResults;
  }
 
  private function setNbResults($nb)
  {
    $this->nbResults = $nb;
  }
 
  public function getFirstPage()
  {
    return 1;
  }
 
  public function getLastPage()
  {
    return $this->lastPage;
  }
 
  private function setLastPage($page)
  {
    $this->lastPage = $page;
    if ($this->getPage() > $page)
    {
      $this->setPage($page);
    }
  }
 
  public function getPage()
  {
    return $this->page;
  }
 
  public function getNextPage()
  {
    return min($this->getPage() + 1, $this->getLastPage());
  }
 
  public function getPreviousPage()
  {
    return max($this->getPage() - 1, $this->getFirstPage());
  }
 
  public function setPage($page)
  {
    $page = intval($page);
 
    $this->page = ($page <= 0) ? 1 : $page;
  }
 
  public function getMaxPerPage()
  {
    return $this->maxPerPage;
  }
 
  public function setMaxPerPage($max)
  {
    if ($max > 0)
    {
      $this->maxPerPage = $max;
      if ($this->page == 0)
      {
        $this->page = 1;
      }
    }
    else if ($max == 0)
    {
      $this->maxPerPage = 0;
      $this->page = 0;
    }
    else
    {
      $this->maxPerPage = 1;
      if ($this->page == 0)
      {
        $this->page = 1;
      }
    }
  }
}
 
?>