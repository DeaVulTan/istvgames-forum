<html>
    <head>
        <link rel="stylesheet" href="tpls/style.css" />
        <script type="text/javascript" src="tpls/jquery-2.1.1.min.js" ></script>
    </head>
    <body>
        <div class="container">
            <div class="serverlist">
                {servers}
                <script type="text/javascript">
                $("p.btn").click(function(){
                    var id = $(this).attr("id");
                    $.ajax({
                    type: "GET",
                    url: "status.php",
                    data: {action:"onlyblock", id:id},
                    success: function(result){$("div.serverinfo").html(result)},
                    });
                });
                </script>
            </div>
            <div class="serverinfo">
                {server-info}
            </div>
        </div>
    </body>
</html>