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

$document = JFactory::getDocument();

// Add CSS
$document->addStyleSheet("components/com_emaillista/assets/css/default.css");

?>

<h1 class="page-header"><?php echo $this->title; ?></h1>

<div class="wrapper">
    <div id="btn-add-new-address" class="tss-button">Új email hozzáadása</div>
    <div id="btn-upload" class="tss-button">CSV file feltöltés</div>
    <div id="btn-download" class="tss-button">Lista exportálása</div>

    <div id="add-new-email-form" class="dropdown-form">

        <input id="new-address-field" type="text" placeholder="Email cím">
        <div id="btn-add" class="tss-button">Hozzáadás</div>

    </div>

    <div id="upload-csv-form" class="dropdown-form">

    <form method="post" enctype="multipart/form-data">
            <input id="csvToUpload" type="file" name="csvfile" />
            <input type="submit" value="Upload File" name="submit" />
        </form>

    </div>

    <table class="email-table">
        <col width=20%>
        <col width=60%>
        <col width=20%>
        <thead>
            <tr>
                <th><div id="btn-selectall" class="tss-tablebutton">Összes kijelölése</div></th>
                <th class="email-column">Email cím</th>
                <th><div id="btn-deleteall" class="tss-tablebutton">Kijelöltek törlése</div></th>
            </tr>
        </thead>
        <tbody>
    <?php
foreach ($this->emails as $email) {
    echo "<tr>";
    echo "<td align=\"center\"><input type=\"checkbox\" name=\"cbSelect\" value=\"$email->id\"></td>";
    echo "<td  class=\"email-column\">$email->email</td>";
    echo "<td class=\"tss-tablebutton tss-delete-button\" data-id=\"$email->id\">Törlés</td>";
    echo "</tr>";
}
?>
        </tbody>
    </table>

</div>

<?php
$document->addScript("components/com_emaillista/assets/js/mainview.js");

?>