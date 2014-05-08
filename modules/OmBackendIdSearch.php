<?php

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
 * Namespace
 */
namespace om_backend;


/**
 * Class OmBackendIdSearch
 */
class OmBackendIdSearch extends \BackendModule
{

  /**
   * Template
   * @var string
   */
  protected $strTemplate = 'mod_om_backend_id_search';


  /**
   * Generate module
   */
  protected function compile()
  {
    
    // handle submit
    if (\Input::post('FORM_SUBMIT') == 'om_backend_id_search')
    {
      $this->handleSubmit();
    }    
    
    // set template vars
    $this->Template->button         = $GLOBALS['TL_LANG']['MSC']['backBT'];
    $this->Template->title          = specialchars($GLOBALS['TL_LANG']['MSC']['backBT']); 
    $this->Template->headline       = $GLOBALS['TL_LANG']['aid_training_overview']['headline'];
    $this->Template->search_options = $GLOBALS['TL_LANG']['om_backend']['search_options'];
  }
  
  
  /**
   * Handle submit
   */
  protected function handleSubmit()
  {
    // data array
    $arrOptions = array('news'    => array('table' => 'tl_news',            'url' => 'contao/main.php?do=news&table=tl_content&id='),
                        'event'   => array('table' => 'tl_calendar_events', 'url' => 'contao/main.php?do=calendar&table=tl_content&id='),
                        'page'    => array('table' => 'tl_page',            'url' => 'contao/main.php?do=page&act=edit&id='),
                        'element' => array('table' => 'tl_content',         'url' => 'contao/main.php?do=article&table=tl_content&act=edit&id='),
                        'module'  => array('table' => 'tl_module',          'url' => 'contao/main.php?do=themes&table=tl_module&act=edit&id='),
                        'article' => array('table' => 'tl_article',         'url' => 'contao/main.php?do=article&table=tl_article&act=edit&id='));    
    
    // get data
    $objData = $this->Database->prepare("SELECT * FROM " . $arrOptions[\Input::post('option')]['table'] . " WHERE id=?")->execute(\Input::post('id'));
    
    //
    if ($objData->numRows)
    {
      \System::redirect($arrOptions[\Input::post('option')]['url'] . \Input::post('id') . '&rt='. $_SESSION['REQUEST_TOKEN']);
    } else {
      $this->Template->id     = \Input::post('id');
      $this->Template->option = \Input::post('option');
      $this->Template->error  = sprintf($GLOBALS['TL_LANG']['om_backend']['error_id_not_found'], \Input::post('id'));
    }        
  }
}
