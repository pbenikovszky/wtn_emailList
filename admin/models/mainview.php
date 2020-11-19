<?php
/**
 * @package     Joomla.Administrator
 * @subpackage  com_generatedcoupons
 *
 * @copyright   Copyright (C) 2019 TSS, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */
// No direct access to this file
defined('_JEXEC') or die('Restricted access');

/**
 * Generate Coupons Model
 *
 * @since  0.0.1
 */
class EmailListaModelMainView extends JModelList
{

    public function getTitle()
    {
        return "Email lista";
    }

    public function getEmailLista()
    {
        $db = JFactory::getDbo();
        $query = $db->getQuery(true);
        $query = 'SELECT * from #__email_lista';
        $db->setQuery($query);
        $result = $db->loadObjectList();

        return $result;
    }

    public function insertEntry($email) {

        $db = JFactory::getDbo();
        $query = $db->getQuery(true);
        $query = "INSERT INTO #__email_lista (email) 
                    VALUES (" . $db->quote($email) . ")";
        $db->setQuery($query);
        $result = $db->execute();

        return $result;
        // return 1;
        
    }

    public function deleteEntries($emails) {

        $db = JFactory::getDbo();
        $query = $db->getQuery(true);
        $query = "DELETE from #__email_lista WHERE id IN ($emails)";
        $db->setQuery($query);
        $result = $db->execute();

        return $result;

    }

    protected function getListQuery()
    {
        // Initialize variables.
        $db = JFactory::getDbo();
        $query = $db->getQuery(true);

        // Create the base select statement.
        $query->select('*')
            ->from($db->quoteName('#__email_lista'));

        return $query;
    }
}
