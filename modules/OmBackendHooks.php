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
 * Class OmBackendHooks
 */
class OmBackendHooks extends \Backend
{
    /**
     * HOOK: getContentElement
     *
     * @param $objElement
     * @param $strBuffer
     * @return mixed
     */
    public function myGetContentElement($objElement, $strBuffer)
    {
        if ($objElement)
        {
            return $strBuffer;
        }

        return $strBuffer;
    }

    /**
     * HOOK: myOutputBackendTemplate
     *
     * @param $strContent
     * @param $strTemplate
     * @return mixed
     */
    public function myOutputBackendTemplate($strContent, $strTemplate)
    {
        // change backend template
        if ($strTemplate == 'be_main')
        {
            $this->import('BackendUser', 'User');

            // active features
            $arrFeatures = deserialize($this->User->om_features);

            // handle viewInfoOnShift
            if (is_array($arrFeatures) && in_array('viewInfoOnShift', $arrFeatures) && !preg_match('/<body.*class=".*om_viewInfoOnShift.*>/', $strContent))
            {
                // activate through new css class
                $strContent = str_replace('<body id="top" class="', '<body id="top" class="om_viewInfoOnShift ', $strContent);
            }

            // element buttons
            if (\Input::get('table') == 'tl_content' && \Input::get('act') == 'edit' && in_array('showElementButtons', $arrFeatures))
            {
                if (is_array($GLOBALS['TL_CTE']) && !empty($GLOBALS['TL_CTE']))
                {
                    $strElements = '<div class="om_elements">';
                    foreach ($GLOBALS['TL_CTE'] as $group)
                    {
                        $strElements .= '<div class="group">';
                        foreach ($group as $key => $element)
                        {
                            //$strPath = '/system/modules/om_backend/assets/buttons/';
                            //$strFile = (is_file(TL_ROOT.$strPath.$key.'.png')) ? $strPath.$key.'.png' : $strPath.'wildcard.png';
                            $strElements .= '<div class="button" data-value="'.$key.'" title="'.$GLOBALS['TL_LANG']['CTE'][$key][0].'"><div class="images '.$key.'"></div></div>';
                        }
                        $strElements .= '</div>';
                    }
                    $strElements .= '<div class="clear"></div></div>';

                    $strContent = str_replace('<select name="type"', $strElements.'<select name="type"', $strContent);
                }
            }
      
            // small backend in user setting activated?
            if ($this->User->om_small && !preg_match('/<body.*class=".*om_backend.*>/', $strContent))
            {
                // activate through new css class
                $strContent = str_replace('<body id="top" class="', '<body id="top" class="om_backend ', $strContent);
            }

            // toolbar in user settings activated?
            if ($this->User->isAdmin && $this->User->om_toolbar > 0 && !preg_match('/<body.*class=".*om_toolbar.*>/', $strContent))
            {
                // add new css class to body
                $strContent = str_replace('<body id="top" class="', '<body id="top" class="om_toolbar ', $strContent);
        
                // insert toolbar html
                switch ($this->User->om_toolbar)
                {
                    // vertical right
                    case 1:
                        $strContent = str_replace('<div id="container">', '<div id="container">' . $this->generateToolbar($strContent), $strContent);
                        break;
            
                    // horizontal top
                    case 2:
                        $strContent = str_replace('<div id="container">', $this->generateToolbar($strContent) . '<div id="container">', $strContent);
                        break;
                }
            }
      
            // element buttons
            $strContent = str_replace('<select name="type">', $this->generateElementButtons() . '<select name="type">', $strContent);
      
            // check table, prevent error since installation
            $objCheck = $this->Database->prepare("SHOW TABLES LIKE 'tl_om_backend_links'")->execute();
            if ($objCheck->numRows == 1)
            {
                // add backend links
                $strSearch = (version_compare(VERSION.'.'.BUILD, '3.3.0', '>=')) ? '<ul class="tl_level_1 collapsible_area">' : '<ul class="tl_level_1">';
                $strContent = str_replace($strSearch, $strSearch . $this->generateBackendLinks(), $strContent);
            }
        }
 
        return $strContent;
    }
  
  
    /**
     * Generate the html for the toolbar
     *
     * @param $strContent
     * @return string
     */
    protected function generateToolbar($strContent)
    {
        // get themes
        $objThemes = \ThemeModel::findAll(array('order'=>'name'));
    
        // vertical or horizontal
        $id    = ($this->User->om_toolbar == 1) ? 'toolbar' : 'toolbarHorizontal';
        $class = (version_compare(VERSION.'.'.BUILD, '3.3.0', '<')) ? '' : 'contao33';
    
        // open container
        $strToolbar  = '<div id="'.$id.'" class="'.$class.'"><h1>Tools</h1>';
    
        // add button - id search
        //$strToolbar .= '<a class="button" href="contao/main.php?do=id_search" title="'.$GLOBALS['TL_LANG']['om_backend']['id_search'].'"><img class="pngfix" src="system/modules/om_backend/html/find.png" width="16" height="16" alt="'.$GLOBALS['TL_LANG']['om_backend']['id_search'].'" onclick="Backend.getScrollOffset();Backend.openModalSelector({\'width\':765,\'title\':\'ID-Suche\',\'url\':this.href});return false"></a>';
        $strToolbar .= '<a class="button" href="contao/main.php?do=id_search" title="'.$GLOBALS['TL_LANG']['om_backend']['id_search'].'"><img class="pngfix" src="system/modules/om_backend/assets/icons/find.png" width="16" height="16" alt="'.$GLOBALS['TL_LANG']['om_backend']['id_search'].'"></a>';
    
        // add button - update database
        $strToolbar .= '<a class="button" href="contao/main.php?do=repository_manager&amp;update=database" title="'.$GLOBALS['TL_LANG']['om_backend']['update_database'].'"><img class="pngfix" src="system/modules/repository/themes/default/images/dbcheck16.png" width="16" height="16" alt="'.$GLOBALS['TL_LANG']['om_backend']['update_database'].'"></a>';
    
        // add button - new template
        $strToolbar .= '<a class="button" href="contao/main.php?do=tpl_editor&key=new_tpl&rt=' . $_SESSION['REQUEST_TOKEN'] .'" title="'.$GLOBALS['TL_LANG']['om_backend']['new_template'].'"><img class="pngfix" src="system/modules/om_backend/assets/icons/page_add.png" width="16" height="16" alt="'.$GLOBALS['TL_LANG']['om_backend']['new_template'].'"></a>';
    
        // add button - sync
        $syncLink = (!$this->checkComposer()) ? 'do=files&amp;act=sync' : 'do=composer&amp;update=database';
        $strToolbar .= '<a class="button" href="contao/main.php?' . $syncLink . '&amp;rt=' . $_SESSION['REQUEST_TOKEN'] .'" title="'.$GLOBALS['TL_LANG']['om_backend']['sync_files'].'"><img class="pngfix" src="system/themes/default/images/sync.gif" width="16" height="16" alt="'.$GLOBALS['TL_LANG']['om_backend']['sync_files'].'"></a>';
    
        // exist a theme?
        if (is_object($objThemes) && $objThemes->count() > 0)
        {
            // add css, modules and layouts
            while ($objThemes->next())
            {
                // add separator
                $strToolbar .= '<div class="separator"></div>';
      
                // add buttons
                $strToolbar .= '<a class="button" href="contao/main.php?do=themes&amp;table=tl_style_sheet&amp;id=' . $objThemes->id . '&amp;rt=' . $_SESSION['REQUEST_TOKEN'] .'" title="'.sprintf($GLOBALS['TL_LANG']['om_backend']['stylesheets'], $objThemes->name).'"><img src="system/themes/default/images/css.gif" width="17" height="16" alt="Stylesheets"></a>';
                $strToolbar .= '<a class="button" href="contao/main.php?do=themes&amp;table=tl_module&amp;id=' . $objThemes->id . '&amp;rt=' . $_SESSION['REQUEST_TOKEN'] .'" title="'.sprintf($GLOBALS['TL_LANG']['om_backend']['modules'], $objThemes->name).'"><img src="system/themes/default/images/modules.gif" width="16" height="16" alt="Module"></a>';
                $strToolbar .= '<a class="button" href="contao/main.php?do=themes&amp;table=tl_layout&amp;id=' . $objThemes->id . '&amp;rt=' . $_SESSION['REQUEST_TOKEN'] .'" title="'.sprintf($GLOBALS['TL_LANG']['om_backend']['layouts'], $objThemes->name).'"><img src="system/themes/default/images/layout.gif" width="14" height="16" alt="Seitenlayouts"></a>';
        
                if(version_compare(VERSION.'.'.BUILD, '3.4.0', '>='))
                {
                    $strToolbar .= '<a class="button" href="contao/main.php?do=themes&amp;table=tl_image_size&amp;id=' . $objThemes->id . '&amp;rt=' . $_SESSION['REQUEST_TOKEN'] .'" title="'.sprintf($GLOBALS['TL_LANG']['om_backend']['image_size'], $objThemes->name).'"><img src="system/themes/default/images/sizes.gif" width="14" height="16" alt="Bildgrößen"></a>';
                }
            }
        }

        // generate save buttons
        if (strpos($strContent, 'class="tl_submit_container"') !== false && strpos($strContent, 'name="save"') !== FALSE)
        {
            // declare variables
            $arrButtons = null;

            // button save
            if (strpos($strContent, 'name="save"') !== FALSE)
            {
                $arrButtons[] = 'save';
            }

            // button save and close
            if (strpos($strContent, 'name="saveNclose"') !== FALSE)
            {
                $arrButtons[] = 'saveNclose';
            }
      
            // button save and create
            if (strpos($strContent, 'name="saveNcreate"') !== FALSE)
            {
                $arrButtons[] = 'saveNcreate';
            }
      
            // button save and back
            if (strpos($strContent, 'name="saveNback"') !== FALSE)
            {
                $arrButtons[] = 'saveNback';
            }
      
            // add alls buttons and separator
            if (is_array($arrButtons))
            {
                // add separator
                $strToolbar .= '<div class="separator"></div>';
        
                // add buttons
                foreach ($arrButtons as $button)
                {
                    $strToolbar .= '<a class="button" onclick="document.getElementById(\''.$button.'\').click(); return false;" title="'.$GLOBALS['TL_LANG']['MSC'][$button].'"><img src="system/modules/om_backend/assets/icons/'.$button.'.png" width="14" height="16" alt="'.$GLOBALS['TL_LANG']['MSC'][$button].'"></a>';
                }
            }
        }

        // edit multiple ?
        if (strpos($strContent, 'class="header_edit_all"') !== false)
        {
            // get parameter
            $id    = (strlen(\Input::get('id'))) ? '&amp;id'.\Input::get('id') : '';
            $table = (strlen(\Input::get('table'))) ? '&amp;table='.\Input::get('table') : '';
        
            // add separator and button
            $strToolbar .= '<div class="separator"></div>';
            $strToolbar .= '<a class="button" href="contao/main.php?do='.\Input::get('do').$table.$id.'&amp;act=select&amp;rt=' . $_SESSION['REQUEST_TOKEN'] .'" title="'.sprintf($GLOBALS['TL_LANG']['om_backend']['stylesheets'], $objThemes->name).'"><img src="system/themes/default/images/all.gif" width="17" height="16" alt="Stylesheets"></a>';
        }
    
        // edit multiple buttons
        if (strpos($strContent, 'class="tl_submit_container"') !== false && strpos($strContent, 'name="edit"') !== FALSE)
        {
            // declare variables
            $arrButtons = null;

            // html button names
            $arrButtonNames = array('delete', 'cut', 'copy', 'override', 'edit', 'alias');
        
            // check for buttons
            foreach ($arrButtonNames as $buttonName)
            {
                // button save
                if (strpos($strContent, 'name="'.$buttonName.'"') !== FALSE)
                {
                    $arrButtons[] = $buttonName;
                }
            }
              
            // add alls buttons and separator
            if (is_array($arrButtons))
            {
                // add separator
                $strToolbar .= '<div class="separator"></div>';
            
                // add buttons
                foreach ($arrButtons as $button)
                {
                    $strToolbar .= '<a class="button" onclick="document.getElementById(\''.$button.'\').click(); return false;" title="'.$GLOBALS['TL_LANG']['om_backend']['button_'.$button].'"><img src="system/modules/om_backend/assets/icons/folder_'.$button.'.png" width="14" height="16" alt="'.$GLOBALS['TL_LANG']['om_backend']['button_'.$button].'"></a>';
                }
            }
        }
            
        // close container
        $strToolbar .= '</div>';
    
        return $strToolbar;
    }


    /**
     * Generate element buttons
     *
     * @return string
     */
    protected function generateElementButtons()
    {
        $strReturn = '';
     
        if ((\Input::get('do') == 'article' && \Input::get('mode') > 0) || (\Input::get('do') == 'article' && \Input::get('table') == 'tl_content'))
        {
            $strReturn .= '<div class="elementButtons">';
            $strReturn .= '</div>';
        }
     
        return $strReturn;
    }


    /**
     * Generate backend links
     * 
     * @return string;
     */
    protected function generateBackendLinks()
    {
        // declare variables
        $arrGroups = null;
        $strReturn = '';

        // get all links
        $objLinks = $this->Database->prepare("SELECT * FROM tl_om_backend_links WHERE language=? AND published=1")->execute($this->User->language);        
        while ($objLinks->next())
        {
            $arrGroups[$objLinks->be_group][$objLinks->title] = $objLinks->url; 
        }
        
        if (is_array($arrGroups))
        {
            $strReturn = '';
            foreach ($arrGroups as $groupName => $group) 
            {
                $strReturn .= '<li class="tl_level_1_group"><a href="contao/main.php?do=repository_manager&amp;mtg='.$groupName.'" title="" onclick="return AjaxRequest.toggleNavigation(this,\''.$groupName.'\')"><img src="system/themes/default/images/modMinus.gif" width="16" height="16" alt="">'.$groupName.'</a></li>';
                $strReturn .= '<li class="tl_parent" id="'.$groupName.'" style="display: inline;"><ul class="tl_level_2">';
                foreach ($group as $linkTitle => $link)
                {
                    if (strpos($link, 'contao/main.php') !== false)
                    {
                        $link .= (strpos($link, '?') !== false) ? '&' : '?';
                        $strReturn .= '<li><a href="'.$link.'rt=' . $_SESSION['REQUEST_TOKEN'] . '" class="navigation themes" title="">'.$linkTitle.'</a></li>';
                    } else {
                        $strReturn .= '<li><a href="'.$link.'" target="_blank" class="navigation themes" title="">'.$linkTitle.'</a></li>';
                    }

                }
                $strReturn .= '</ul></li>';
            }
        }
        
        return $strReturn; 
    }
    
    /**
     * Check if Composer is installed
     *
     * @return boolean
     */
    protected function checkComposer()
    {
        return (is_array($GLOBALS['BE_MOD']['system']['composer']));
    }
}
