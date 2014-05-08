<?php if (!defined('TL_ROOT')) die('You cannot access this file directly!');

/**
 * Contao module om_backend
 * 
 * @copyright OMOS.de 2014 <http://www.omos.de>
 * @author    René Fehrmann <rene.fehrmann@omos.de>
 * @package   om_backend
 * @link      http://www.omos.de
 * @license   LGPL
 */


/**
 * Labels
 */
//$GLOBALS['TL_DCA']['tl_page']['list']['label']['fields'][] = 'id';
//$GLOBALS['TL_DCA']['tl_page']['list']['label']['format']   .= '<span style="font-weight:normal; color:#b3b3b3; padding-left:3px;">[Id: %s]</span>';


$GLOBALS['TL_DCA']['tl_page']['list']['label']['label_callback'] = array('tl_om_backend_page', 'addIcon');

class  tl_om_backend_page extends Backend
{

  /**
   * Add an image to each page in the tree
   * @param array
   * @param string
   * @param \DataContainer
   * @param string
   * @param boolean
   * @param boolean
   * @return string
   */
  public function addIcon($row, $label, DataContainer $dc=null, $imageAttribute='', $blnReturnImage=false, $blnProtected=false)
  {
    $this->import('BackendUser', 'User');
    
    $html = Backend::addPageIcon($row, $label, $dc, $imageAttribute, $blnReturnImage, $blnProtected);
    
    if ($this->User->om_flags && $row['type'] == 'root')
    {
      $html .= '<strong> - ' . $row['language'] . '</strong>';
    }
    
    return $html;
  }
  
}


