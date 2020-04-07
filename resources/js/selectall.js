$(".selectall").click(function() {
    $(".selectbox").prop("checked", $(this).prop("checked"));
    $(".selectall2").prop("checked", $(this).prop("checked"));
});
$(".selectall2").click(function() {
    $(".selectbox").prop("checked", $(this).prop("checked"));
    $(".selectall2").prop("checked", $(this).prop("checked"));
});
$(".selectbox").change(function() {
    var total = $(".selectall").length;
    var number = $(".selectbox:checked").length;
    if (total == number) {
        $(".selectall").prop("checked", true);
        $(".selectall2").prop("checked", true);
    } else {
        $(".selectall").prop("checked", false);
        $(".selectall2").prop("checked", false);
    }
});
