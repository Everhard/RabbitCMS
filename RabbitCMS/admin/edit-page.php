<?php
    defined('_RabbitCMS') or die('Restricted access');
    $page = new Page();
    $page->load_by_id($this->get_content());
?>
<div class="container">

    <div class="panel panel-default">
            <div class="panel-heading">Edit page</div>
            <div class="panel-body">
                <form role="form" action="../pages" method="post">
                    <div class="form-group">
                      <label>Page title:</label>
                      <input name="title" value="<?php echo $page->get_title(); ?>" type="text" class="form-control" placeholder='For example, "How to loose weight"...'>
                    </div>
                    <div class="form-group">
                      <label>URL-name of the page:</label>
                      <input name="url" value="<?php echo $page->get_url(); ?>" type="text" class="form-control" placeholder='For example, "how-to-loose-weight"'>
                      <p class="help-block">You will got: http://<?php echo $_SERVER['HTTP_HOST']; ?>/<span></span></p>
                    </div>
                    <div class="form-group">
                      <label>Template file:</label>
                      <input name="template" value="<?php echo $page->get_template(); ?>" type="text" class="form-control">
                    </div>
                    <div class="form-group">
                      <label>Text of the page:</label>
                      <textarea name="text" class="form-control" rows="15"><?php echo $page->get_text(); ?></textarea>
                    </div>
                    <input type="hidden" name="action-module" value="page" />
                    <input type="hidden" name="action-method" value="update-page" />
                    <input type="hidden" name="id" value="<?php echo $page->get_id(); ?>" />
                    <button type="submit" class="btn btn-default">Save</button>
                </form>
            </div>
    </div>

</div>