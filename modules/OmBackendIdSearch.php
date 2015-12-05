<?php

/**
 * Contao module om_backend
 * 
 * @copyright OMOS.de 2015 <http://www.omos.de>
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
        // get tables from database
        $arrTables = $this->Database->listTables();

        // get all dca tables
        foreach ($GLOBALS['BE_MOD'] as $groupName => $group)
        {
            foreach ($group as $moduleName => $modules)
            {
                if (is_array($modules['tables']))
                {
                    foreach ($modules['tables'] as $table)
                    {
                        if (in_array($table, $arrTables))
                        {
                            $arrGroups[$groupName]['title']    = $GLOBALS['TL_LANG']['MOD'][$groupName];
                            $arrGroups[$groupName]['tables'][] = array($table, $GLOBALS['TL_LANG']['MOD'][$moduleName][0], $moduleName);
                        }
                    }
                }
            }
        }
                
        // handle submit
        if (\Input::post('FORM_SUBMIT') == 'om_backend_id_search' && \Input::post('option'))
        {
            // handle post data
            $arrSelected = explode('::', \Input::post('option'));

            // check table for alias field
            $objAlias = $this->Database->prepare("SHOW COLUMNS FROM ".$arrSelected[1]." LIKE 'alias'")->execute();
            if ($objAlias->numRows)
            {
                // get data
                $objData = $this->Database->prepare("SELECT * FROM ".$arrSelected[1]." WHERE id=? or alias=?")->execute(\Input::post('id'), \Input::post('id'));
            } else {
                // get data
                $objData = $this->Database->prepare("SELECT * FROM ".$arrSelected[1]." WHERE id=?")->execute(\Input::post('id'));
            }


            // id or alias exists
            if ($objData->numRows)
            {
                // redirect
                \System::redirect('contao/main.php?do='.$arrSelected[0].'&table='.$arrSelected[1].'&act=edit&id='.$objData->id.'&rt='.$_SESSION['REQUEST_TOKEN']);
            } else {
                // error
                $this->Template->id       = \Input::post('id');
                $this->Template->selected = $arrSelected[1];
                $this->Template->error    = sprintf($GLOBALS['TL_LANG']['om_backend']['error_id_or_alias_not_found'], \Input::post('id'));
            }       
        }    
        
        // set template vars
        $this->Template->button   = $GLOBALS['TL_LANG']['MSC']['backBT'];
        $this->Template->title    = specialchars($GLOBALS['TL_LANG']['MSC']['backBT']); 
        $this->Template->headline = $GLOBALS['TL_LANG']['aid_training_overview']['headline'];
        $this->Template->groups   = $arrGroups;
    }
}
