<!DOCTYPE html>
<html>
<head>
    <title>my I frame is as tall as your page</title>
    <script type="text/javascript" src="http://code.jquery.com/jquery-2.1.1.min.js"></script>
</head>
<body onresize="$('#iframe1').attr('height', $(window).height());" style="margin:0;" >
<iframe id="iframe1" src="https://pje.tjmg.jus.br/pje/ConsultaPublica/listView.seam" style="width:100%;"  onload="this.height=$(window).height();"></iframe>
</body>
</html>