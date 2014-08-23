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
    $("#clear-journal-button").click(function() {
        $("#clear-journal-form").submit();
    });
    
    // Auto URL:
    $("input[name=title]").change(function() {
        var title = $(this).val().replace(/[^\w\s]/gi, '');
        var urlName = '';
        for (var i = 0; i < title.length; i++) {
            if (title[i] === ' ' || title[i] === '_') urlName += '-';
            else urlName += title[i].toLowerCase();
        }
        $("input[name=url]").val(urlName);
        $("input[name=url]+p span").text(urlName);
    });
    $("input[name=url]").change(function() {
        $(this).next("p").find("span").text($(this).val());
    });
});