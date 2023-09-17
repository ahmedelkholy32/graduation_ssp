<?php
    session_start();
    // start check if there is session for user name
    if(!isset($_SESSION['username'])):
        // start chech if there is cookie for username
        if(!isset($_COOKIE['username'])):
            header("Location: ../../login");
            exit;
        else:
            $_SESSION['username'] = $_COOKIE['username'];
        endif; // end chech if there is cookie for username
    endif; // end check if there is session for user name
    // check if there is session called fopen
    if (!isset($_SESSION['fopen']) && $_SESSION['fopen'] !== 'yes'):
      header('Location: ../../');
      exit;
    endif; //end check if there is session called fopen
    // check if session expire
    if (!isset($_SESSION['pageexpire']) && $_SESSION['pageexpire'] < time()):
      unset($_SESSION['fopen']);
      header('Location: ../../');
      exit;
    endif; //end check if session expire
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <title>Face Recognition</title>
    <link rel="icon" href="../logo.png" />
    <meta http-equiv="content-type" content="text/html; charset=utf-8">
    <meta name="viewport" content="width=device-width, shrink-to-fit=yes">
    <meta name="application-name" content="FaceAPI">
    <meta name="keywords" content="FaceAPI">
    <meta name="description" content="FaceAPI: AI-powered Face Detection, Description & Recognition for Browser and NodeJS using Tensorflow/JS; Author: Vladimir Mandic <https://github.com/vladmandic>">
    <meta name="msapplication-tooltip" content="FaceAPI: AI-powered Face Detection, Description & Recognition for Browser and NodeJS using Tensorflow/JS; Author: Vladimir Mandic <https://github.com/vladmandic>">
    <script type="module">
      import * as faceapi from '../dist/face-api.esm.js';
    
      // configuration options
      const modelPath = '../model/'; // path to model folder that will be loaded using http
      // const modelPath = 'https://vladmandic.github.io/face-api/model/'; // path to model folder that will be loaded using http
      const minScore = 0.2; // minimum score
      const maxResults = 5; // maximum number of results to return
      let optionsSSDMobileNet;

      // helper function to pretty-print json object to string
      function str(json) {
        let text = '<font color="lightblue">';
        text += json ? JSON.stringify(json).replace(/{|}|"|\[|\]/g, '').replace(/,/g, ', ') : '';
        text += '</font>';
        return text;
      }

      // helper function to print strings to html document as a log
      function log(...txt) {
        // eslint-disable-next-line no-console
        console.log(...txt);
        const div = document.getElementById('log');
        if (div) div.innerHTML += `<br>${txt}`;
      }
      const loadLabels = () => {
        log('Processing reference images');
        const labels = ["<?php echo $_SESSION['username'];?>"]
        console.log(labels)
        return Promise.all(labels.map(async label => {
            const descriptions = []
            for (let i = 1; i <= 3; i++) {
                const img = await faceapi.fetchImage(`../../data/uploads/images/${label}/${i}.jpg`)
                const detections = await faceapi
                    .detectSingleFace(img)
                    .withFaceLandmarks()
                    .withFaceDescriptor()
                descriptions.push(detections.descriptor)
            }
            return new faceapi.LabeledFaceDescriptors(label, descriptions)
        }))
      }
      async function detectVideo(video, canvas, labels) {
        if (!video || video.paused) return false;
        const results = await faceapi
          .detectAllFaces(video)
          .withFaceLandmarks()
          .withFaceDescriptors()
        const faceMatcher = new faceapi.FaceMatcher(labels, 0.6)
        results.forEach(fd => {
          const bestMatch = faceMatcher.findBestMatch(fd.descriptor)
          console.log(bestMatch.label)
          if(bestMatch.label === "<?php echo $_SESSION['username']?>"){
              location.href = "../../fopen";
          }
        })  
        detectVideo(video, canvas, labels)
      }

      // just initialize everything and call main function
      async function setupCamera() {
        // this for access nown face to video object
        const labels = await loadLabels();
        const video = document.getElementById('video');
        const canvas = document.getElementById('canvas');
        if (!video || !canvas) return null;

        let msg = '';
        log('Setting up camera');
        // setup webcam. note that navigator.mediaDevices requires that page is accessed via https
        if (!navigator.mediaDevices) {
          log('Camera Error: access not supported');
          return null;
        }
        let stream;
        const constraints = {
          audio: false,
          video: { facingMode: 'user', resizeMode: 'crop-and-scale' },
        };
        if (window.innerWidth > window.innerHeight) constraints.video.width = { ideal: window.innerWidth };
        else constraints.video.height = { ideal: window.innerHeight };
        try {
          stream = await navigator.mediaDevices.getUserMedia(constraints);
        } catch (err) {
          if (err.name === 'PermissionDeniedError' || err.name === 'NotAllowedError') msg = 'camera permission denied';
          else if (err.name === 'SourceUnavailableError') msg = 'camera not available';
          log(`Camera Error: ${msg}: ${err.message || err}`);
          return null;
        }
        // @ts-ignore
        if (stream) video.srcObject = stream;
        else {
          log('Camera Error: stream empty');
          return null;
        }
        const track = stream.getVideoTracks()[0];
        const settings = track.getSettings();
        if (settings.deviceId) delete settings.deviceId;
        if (settings.groupId) delete settings.groupId;
        if (settings.aspectRatio) settings.aspectRatio = Math.trunc(100 * settings.aspectRatio) / 100;
        log(`Camera active: ${track.label}`); // ${str(constraints)}
        log(`Camera settings: ${str(settings)}`);
        canvas.addEventListener('click', () => {
          // @ts-ignore
          if (video && video.readyState >= 2) {
            // @ts-ignore
            if (video.paused) {
              // @ts-ignore
              video.play();
              detectVideo(video, canvas, labels);
            } else {
              // @ts-ignore
              video.pause();
            }
          }
          // @ts-ignore
          log(`Camera state: ${video.paused ? 'paused' : 'playing'}`);
        });
        return new Promise((resolve) => {
          video.onloadeddata = async () => {
            // @ts-ignore
            canvas.width = video.videoWidth;
            // @ts-ignore
            canvas.height = video.videoHeight;
            // @ts-ignore
            video.play();
            detectVideo(video, canvas, labels);
            resolve(true);
          };
        });
      }

      async function setupFaceAPI() {
        // load face-api models
        // log('Models loading');
        // await faceapi.nets.tinyFaceDetector.load(modelPath); // using ssdMobilenetv1
        await faceapi.nets.ssdMobilenetv1.load(modelPath);
        await faceapi.nets.faceLandmark68Net.load(modelPath);
        await faceapi.nets.faceRecognitionNet.load(modelPath);
        optionsSSDMobileNet = new faceapi.SsdMobilenetv1Options({ minConfidence: minScore, maxResults });

        // check tf engine state
        log(`Models loaded: ${str(faceapi.tf.engine().state.numTensors)} tensors`);
      }

      async function main() {
        // initialize tfjs
        log('SSP: open gate by Face Recognition');

        // if you want to use wasm backend location for wasm binaries must be specified
        // await faceapi.tf.setWasmPaths('../node_modules/@tensorflow/tfjs-backend-wasm/dist/');
        // await faceapi.tf.setBackend('wasm');

        // default is webgl backend
        await faceapi.tf.setBackend('webgl');
        await faceapi.tf.enableProdMode();
        await faceapi.tf.ENV.set('DEBUG', false);
        await faceapi.tf.ready();

        // check version
        log(`Version: FaceAPI ${str(faceapi?.version.faceapi || '(not loaded)')} TensorFlow/JS ${str(faceapi?.tf?.version_core || '(not loaded)')} Backend: ${str(faceapi?.tf?.getBackend() || '(not loaded)')}`);
        // log(`Flags: ${JSON.stringify(faceapi?.tf?.ENV.flags || { tf: 'not loaded' })}`);

        await setupFaceAPI();
        await setupCamera();
      }

      // start processing as soon as page is loaded
      window.onload = main;

    </script>
  </head>
  <body style="font-family: monospace; background: black; color: white; font-size: 16px; line-height: 22px; margin: 0; overflow: hidden">
    <video id="video" playsinline class="video"></video>
    <canvas id="canvas" class="canvas" style="position: fixed; top: 0; left: 0; z-index: 10"></canvas>
    <div id="log" style="overflow-y: scroll; height: 16.5rem"></div>
  </body>
</html>


