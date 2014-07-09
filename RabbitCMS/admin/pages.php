<div class="container">

    <div class="panel panel-default">
            <div class="panel-heading">Pages</div>
            <div class="panel-body">
                    <a class='btn btn-default' href="add-page">Add page</a>
            </div>

            <table class="table table-striped" id="prjects-list-table">
                    <thead>
                            <th>Title</th>
                            <th>URL</th>
                            <th>Control</th>
                    </thead>
                    <tbody>
<?php
$menus = Database::get_pages();
if (count($menus) > 0) {
    foreach ($menus as $page) {
            $url_column = $page->get_url() == '_frontpage_' ? "<strong>Main page</strong>" : $page->get_url();
            echo "<tr>
                    <td><a href='edit-page/".$page->get_id()."'>".$page->get_title()."</a></td>
                    <td>$url_column</td>
                    <td><button title='Delete page' class='btn btn-default btn-xs delete-page-button' data-id='".$page->get_id()."'><span class='glyphicon glyphicon-remove'></span></button></td>
            </tr>";
    }
} else echo "<tr><td colspan='3' class='text-center'>No pages</td></tr>";
?>
                    </tbody>
            </table>

    </div>

</div>

<form id="delete-page-form" method="post">
    <input type="hidden" name="id" value="" />   
    <input type="hidden" name="action-module" value="page" />
    <input type="hidden" name="action-method" value="delete-page" />
</form>