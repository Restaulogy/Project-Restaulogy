<html><body> 
 
<?php 
 include("..\init.php");
 $seating_capacity = get_input('var1');
 $person = get_input('var2');
 $table = get_input('var4',1);
 $text = get_input('var3');
 
 $html_code .= table_layout::display($seating_capacity,$person,$text); 
?> 
<link href="<?=$CONFIG->wwwroot?>css/biz_data_grid.css" rel="stylesheet"/>
<?php echo $html_code;?>  
<script type="text/javascript" src="<?=$CONFIG->wwwroot?>js/jquery.js"></script>
<script type="text/javascript" src="<?=$CONFIG->wwwroot?>js/html2canvas.min.js"></script>
 <script type="text/javascript">
		 html2canvas([document.getElementById("biz_dining_layout")], {
        proxy: "https://html2canvas.appspot.com/query",
        onrendered: function(canvas) {

            var img = canvas.toDataURL("image/png");
            var output = img.replace(/^data:image\/(png|jpg);base64,/, "");
            var output = encodeURIComponent(img);

            //var name={'1','2'};

            var Parameters = "name[0]" + "=<?=$table?>" + "&image[0]=" + output +  "&name[1]" + "=2&image[1]=" + output +  "&filedir=" + "<?=$CONFIG->path?>/images/tables/occupied";
            //Parameters = "&name[]" + "=<?=$table.'_1'?>" + "&image[]=" + output + "";
            //alert(Parameters);
            //var Parameters = "name" + "=<?=$table?>" + "&image=" + output + "&filedir=" + "<?=$CONFIG->path?>/images/tables/occupied";
            alert(Parameters);
            $.ajax({
                type: "POST",
                url: "<?=$CONFIG->wwwroot?>ajax/getimgsrc.php",
                data: Parameters,
                success : function(data)
                {
                    //alert(data);
                    console.log("screenshot done");
									  //alert('done');
                },
                error : function (objrespone){
                    alert(objrespone.responseText);
                }
            });

        }
    });
	
</script>
</body>
</html>
