<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <title>Uppy</title>
    <link href="https://releases.transloadit.com/uppy/v2.1.0/uppy.min.css" rel="stylesheet">
</head>
<body>
<div id="drag-drop-area"></div>

<script src="https://releases.transloadit.com/uppy/v2.1.0/uppy.min.js"></script>
<script>
    var uppy = new Uppy.Core()
        .use(Uppy.Dashboard, {
            inline: true,
            target: '#drag-drop-area'
        })
        .use(Uppy.Tus, {endpoint: 'https://tusd.tusdemo.net/files/'})

    uppy.on('complete', (result) => {
        console.log('Upload complete! We’ve uploaded these files:', result.successful)
    })


    const uppy = new Uppy({
        debug: true,
        autoProceed: false,
        restrictions: {
            maxFileSize: 1000000,
            maxNumberOfFiles: 3,
            minNumberOfFiles: 2,
            allowedFileTypes: ['image/*', 'video/*'],
            requiredMetaFields: ['caption'],
        }
    })
        .use(Dashboard, {
            trigger: '.UppyModalOpenerBtn',
            inline: true,
            target: '#drag-drop-area',
            showProgressDetails: true,
            note: 'Images and video only, 2–3 files, up to 1 MB',
            height: 470,
            metaFields: [
                { id: 'name', name: 'Name', placeholder: 'file name' },
                { id: 'caption', name: 'Caption', placeholder: 'describe what the image is about' }
            ],
            browserBackButtonClose: false
        })
        .use(GoogleDrive, { target: Dashboard, companionUrl: 'https://companion.uppy.io' })
        .use(Dropbox, { target: Dashboard, companionUrl: 'https://companion.uppy.io' })
        .use(Box, { target: Dashboard, companionUrl: 'https://companion.uppy.io' })
        .use(Instagram, { target: Dashboard, companionUrl: 'https://companion.uppy.io' })
        .use(Facebook, { target: Dashboard, companionUrl: 'https://companion.uppy.io' })
        .use(OneDrive, { target: Dashboard, companionUrl: 'https://companion.uppy.io' })
        .use(Webcam, { target: Dashboard })
        .use(ScreenCapture, { target: Dashboard })
        .use(ImageEditor, { target: Dashboard })
        .use(Tus, { endpoint: 'https://tusd.tusdemo.net/files/' })
        .use(DropTarget, {target: document.body })
        .use(GoldenRetriever)

    uppy.on('complete', result => {
        console.log('successful files:', result.successful)
        console.log('failed files:', result.failed)
    });
</script>
</body>
</html>
