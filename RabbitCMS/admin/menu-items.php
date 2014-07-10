<?php
    $menu = new Menu();
    $menu->load_by_id($this->get_content());
?>
<div class="container">

    <div class="panel panel-default">
        <div class="panel-heading">Menus / <strong><?php echo $menu->get_name(); ?></strong></div>
            <div class="panel-body">
                    <a class='btn btn-default' data-toggle="modal" data-target="#add-menu-item">Add item</a>
            </div>

            <table class="table table-striped" id="prjects-list-table">
                    <thead>
                            <th>Item</th>
                            <th>URL</th>
                            <th>Control</th>
                    </thead>
                    <tbody>
<?php
$items = $menu->get_items();
if (count($items) > 0) {
    foreach ($items as $item) {
            echo "<tr>
                    <td><a href='".$item->get_url()."'>".$item->get_name()."</a></td>
                    <td>".$item->get_url()."</td>
                    <td><button title='Delete menu item' class='btn btn-default btn-xs delete-menu-item-button' data-id='".$item->get_id()."'><span class='glyphicon glyphicon-remove'></span></button></td>
            </tr>";
    }
} else echo "<tr><td colspan='3' class='text-center'>No menu items</td></tr>";
?>
                    </tbody>
            </table>

    </div>

</div>

<div class="modal fade" id="add-menu-item">
  <div class="modal-dialog">
	<div class="modal-content">
	  <div class="modal-header">
		<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
		<h4 class="modal-title">New menu item</h4>
	  </div>
	  <div class="modal-body">
		<form role="form" method="post" id="add-menu-item-form">
		  <div class="form-group">
			<label>Item name (anchor):</label>
			<input type="text" name="name" class="form-control">
		  </div>
		  <div class="form-group">
			<label>URL:</label>
			<input type="text" name="url" class="form-control">
		  </div>
                  <input type="hidden" name="menu_id" value="<?php echo $menu->get_id(); ?>" />
		  <input type="hidden" name="action-module" value="menuitem" />
		  <input type="hidden" name="action-method" value="add-item" />
		</form>
	  </div>
	  <div class="modal-footer">
		<button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
		<button type="button" class="btn btn-primary" id="add-menu-item-button">Add</button>
	  </div>
	</div>
  </div>
</div>

<form id="delete-menu-item-form" method="post">
    <input type="hidden" name="id" value="" />   
    <input type="hidden" name="action-module" value="menuitem" />
    <input type="hidden" name="action-method" value="delete-item" />
</form>