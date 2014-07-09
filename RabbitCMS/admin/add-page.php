<div class="container">

    <div class="panel panel-default">
            <div class="panel-heading">Add new page</div>
            <div class="panel-body">
                <form role="form" action="pages" method="post">
                    <div class="form-group">
                      <label>Page title:</label>
                      <input name="title" type="text" class="form-control" placeholder='For example, "How to loose weight"...'>
                    </div>
                    <div class="form-group">
                      <label>URL-name of the page:</label>
                      <input name="url" type="text" class="form-control" placeholder='For example, "how-to-loose-weight"'>
                      <p class="help-block">You will got: http://site.com/how-to-loose-weight</p>
                    </div>
                    <div class="form-group">
                      <label>Text of the page:</label>
                      <textarea name="text" class="form-control" rows="15"></textarea>
                    </div>
                    <input type="hidden" name="action-module" value="page" />
                    <input type="hidden" name="action-method" value="add-page" />
                    <button type="submit" class="btn btn-default">Add</button>
                </form>
            </div>
    </div>

</div>