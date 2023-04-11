$(function () {
    const options = {
        aspectRatio: 1 / 1,
        viewMode: 1,
        crop: function (e) {
            cropData = $('#preview').cropper("getData");
            $("#upload-image-x").val(Math.floor(cropData.x));
            $("#upload-image-y").val(Math.floor(cropData.y));
            $("#upload-image-w").val(Math.floor(cropData.width));
            $("#upload-image-h").val(Math.floor(cropData.height));
        },
        zoomable: true,
        autoCropArea: 0.5,
        minCropBoxWidth: 200,
        minCropBoxHeight: 200,
        zoomOnWheel: false,
        checkCrossOrigin: false,
        checkOrientation: false,
        zoomOnTouch: true,
        responsive: false,
        toggleDragModeOnDblclick: false
    }

    $('#preview').cropper(options);

    $(".move").draggable();

});