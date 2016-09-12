<?php
/**
 * @link http://www.yiizh.com/
 * @copyright Copyright (c) 2016 yiizh.com
 * @license http://www.yiizh.com/license/
 */
use common\widgets\JsBlock;
use yii\web\View;

/**
 * @var $this View
 */
$this->title = '观看';

$this->registerJs(<<<JS
var cameras = new Array();
var receiver_socket = new WebSocket("ws://" + document.domain + ":10181");

receiver_socket.onmessage = function (data) {
    data = JSON.parse(data.data);
    var camera = data.camera;
    if (cameras[camera] == undefined) {
        var img = $('<img/>').attr({id: 'camera-' + camera, class: 'img img-thumbnail'});
        var col = $('<div/>').attr('class', 'col-xs-3').append(img);
        $('#cameras').append(col);
        cameras[camera] = camera;
    }
    var receiverImg = document.getElementById('camera-' + camera);
    receiverImg.src = data.data;
}
JS
);
?>
<div class="camera-play text-center">
    <div class="well">
        <h2>摄像头列表</h2>
        <div class="row" id="cameras">
        </div>
    </div>
</div>
