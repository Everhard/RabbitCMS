<?php defined('_RabbitCMS') or die('Restricted access'); ?>
<div class="container">

    <div class="panel panel-default">
            <div class="panel-heading">Journal</div>
            <div class="panel-body">
                    <a id="clear-journal-button" class='btn btn-default'>Clear journal</a>
            </div>

            <table class="table table-striped" id="journal-table">
                    <thead>
                            <th>Message</th>
                            <th>IP</th>
                            <th>Browser</th>
                            <th>Time</th>
                    </thead>
                    <tbody>
<?php
$journal = Journal::get_records();
if (count($journal) > 0) {
    foreach ($journal as $record) {
            echo "<tr>
                    <td>".$record->get_message()."</td>
                    <td>".$record->get_ip()."</td>
                    <td>".$record->get_browser()."</td>
                    <td>".date("d.m.Y H:i", $record->get_time())."</td>
            </tr>";
    }
} else echo "<tr><td colspan='4' class='text-center'>No records</td></tr>";
?>
                    </tbody>
            </table>

    </div>

</div>

<form id="clear-journal-form" method="post"> 
    <input type="hidden" name="action-module" value="journal" />
    <input type="hidden" name="action-method" value="clear" />
</form>