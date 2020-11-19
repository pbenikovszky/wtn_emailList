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

class EmailListaViewMainView extends JViewLegacy
{
    public function display($tpl = null)
    {

        $this->title = $this->get('Title');
        $this->emails = $this->get('EmailLista');

        parent::display($tpl);
    }
}
