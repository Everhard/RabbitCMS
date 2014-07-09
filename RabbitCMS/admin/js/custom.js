$(document).ready(function() {
    $(".delete-page-button").click(function() {
        if (confirm("Do you really want to delete this page?")) {
            $("#delete-page-form input[name=id]").val($(this).attr("data-id"));
            $("#delete-page-form").submit();
        }
        return false;
    });
    $(".delete-menu-button").click(function() {
        if (confirm("Do you really want to delete this menu?")) {
            $("#delete-menu-form input[name=id]").val($(this).attr("data-id"));
            $("#delete-menu-form").submit();
        }
        return false;
    });
    $(".delete-menu-item-button").click(function() {
        if (confirm("Do you really want to delete this menu item?")) {
            $("#delete-menu-item-form input[name=id]").val($(this).attr("data-id"));
            $("#delete-menu-item-form").submit();
        }
        return false;
    });
    $("#add-menu-button").click(function() {
        $("#add-menu-form").submit();
    });
    $("#add-menu-item-button").click(function() {
        $("#add-menu-item-form").submit();
    });
});