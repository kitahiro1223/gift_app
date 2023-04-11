<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <link href="//cdnjs.cloudflare.com/ajax/libs/cropper/3.1.6/cropper.min.css" rel="stylesheet">
</head>
<body>
    <div class="wrap">
        <div class="move red">要素1</div>
        <div class="move green">要素2</div>
    </div>
    <div id="imgwrap">
        <img src="./img/PHP-logo.svg.webp" id="preview">
    </div>
    <form method="post">
        <input type="hidden" id="upload-image-x" name="profileImageX" value="0" />
        <input type="hidden" id="upload-image-y" name="profileImageY" value="0" />
        <input type="hidden" id="upload-image-w" name="profileImageW" value="0" />
        <input type="hidden" id="upload-image-h" name="profileImageH" value="0" />
        <input type="submit" name="submit" value="送信" />
    </form>

<script src="./js/cropper_code.js"></script>
<script type="text/javascript" src="http://code.jquery.com/jquery-1.6.min.js"></script>
<script type="text/javascript" src="http://code.jquery.com/ui/1.10.3/jquery-ui.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/cropper/3.1.6/cropper.min.js"></script>
</body>
</html>

