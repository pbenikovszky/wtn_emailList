<?php
/**
 * @package     Joomla.Administrator
 * @subpackage  com_generatedcoupons
 *
 * @copyright   Copyright (C) 2019 TSS All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

// No direct access to this file
defined('_JEXEC') or die('Restricted access');

/**
 * General Controller of GeneratedCoupons component
 *
 * @package     Joomla.Administrator
 * @subpackage  com_generatedcoupons
 * @since       0.0.7
 */
class EmailListaController extends JControllerLegacy
{
    /**
     * The default view for the display method.
     *
     * @var string
     * @since 12.2
     */
    protected $default_view = 'mainview';

    public function addemail()
    {
        $view = $this->getView('mainview', 'json');
        $view->setLayout('addemail');
        $view->emailaddress = JRequest::getVar('emailaddress');
        $view->display();
    }

    public function deleteemail()
    {
        $view = $this->getView('mainview', 'json');
        $view->setLayout('deleteemail');
        $view->emailaddress = JRequest::getVar('emailaddress');
        $view->display();
    }    

    public function uploadlist()
    {
        $view = $this->getView('mainview', 'json');
        $view->setLayout('uploadlist');
        $view->emailaddress = JRequest::getVar('emailaddress');
        $view->display();
    }       

}
