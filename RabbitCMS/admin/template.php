<?php defined('_RabbitCMS') or die('Restricted access'); ?>
<div class="container">
    <?php Message::show(); ?>
    <div class="panel panel-default">
            <div class="panel-heading">Template installation</div>
            <div class="panel-body">
                    <p>Please choose template to install on RabbitCMS:</p>
                    <form method="post" enctype="multipart/form-data">
                        <div class="form-group">
                            <input type="file" name="template" />
                            <p class="help-block">It must be template folder in zip archive.</p>
                        </div>
                        <input type="hidden" name="action-module" value="template" />
                        <input type="hidden" name="action-method" value="install" />
                        <input class='btn btn-default' type="submit" value="Upload and install" />
                    </form>
            </div>
    </div>

</div>