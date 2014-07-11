<?php defined('_RabbitCMS') or die('Restricted access'); ?>
<div class="container">

    <div class="panel panel-default">
            <div class="panel-heading">Menus</div>
            <div class="panel-body">
                    <a class='btn btn-default' data-toggle="modal" data-target="#add-menu">Add menu</a>
            </div>

            <table class="table table-striped" id="prjects-list-table">
                    <thead>
                            <th>Menu</th>
                            <th>tag</th>
                            <th>Control</th>
                    </thead>
                    <tbody>
<?php
$menus = Database::get_menus();
if (count($menus) > 0) {
    foreach ($menus as $menu) {
            echo "<tr>
                    <td><a href='menu-items/".$menu->get_id()."'>".$menu->get_name()."</a></td>
                    <td>".$menu->get_tag()."</td>
                    <td><button title='Delete menu' class='btn btn-default btn-xs delete-menu-button' data-id='".$menu->get_id()."'><span class='glyphicon glyphicon-remove'></span></button></td>
            </tr>";
    }
} else echo "<tr><td colspan='3' class='text-center'>No menus</td></tr>";
?>
                    </tbody>
            </table>

    </div>

</div>

<div class="modal fade" id="add-menu">
  <div class="modal-dialog">
	<div class="modal-content">
	  <div class="modal-header">
		<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
		<h4 class="modal-title">New menu</h4>
	  </div>
	  <div class="modal-body">
		<form role="form" method="post" id="add-menu-form">
		  <div class="form-group">
			<label>Menu name</label>
			<input type="text" name="name" class="form-control" placeholder='For example, "Main menu"...'>
		  </div>
		  <div class="form-group">
			<label>Tag</label>
			<input type="text" name="tag" class="form-control" placeholder='For example, "main"'>
		  </div>
		  <input type="hidden" name="action-module" value="menu" />
		  <input type="hidden" name="action-method" value="add-menu" />
		</form>
	  </div>
	  <div class="modal-footer">
		<button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
		<button type="button" class="btn btn-primary" id="add-menu-button">Add</button>
	  </div>
	</div>
  </div>
</div>

<form id="delete-menu-form" method="post">
    <input type="hidden" name="id" value="" />   
    <input type="hidden" name="action-module" value="menu" />
    <input type="hidden" name="action-method" value="delete-menu" />
</form>