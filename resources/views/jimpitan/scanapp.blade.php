@include ('header') @include ('navbar')

<style>
    #camera-container {
        margin: 0px;
        padding: 0px;
        background-color: #000;
        width: 100vw !important;
        height: 90vh !important;
    }

    #device-camera {
        position: fixed;
        top: 10px;
        left: 10px;
    }

    #switch-btn {
        background-color: #ffffff;
        position: fixed;
        padding: 7px 10px 10px 10px;
        bottom: 40px;
        left: calc(50% - 15px);
        width: 40px;
        height: 40px;
        border-radius: 100%;
        z-index: 999;
    }

    #cancel-btn {
        position: fixed;
        padding: 7px 10px 10px 10px;
        bottom: 30px;
        zuhr left: 20px;
        z-index: 999;
    }
</style>

<div id="camera-container">
    <div id="reader"
         style="width: 100%"></div>

    <div id="switch-btn">
        <img src="{{ asset('img/switch-camera.png') }}"
             width="100%"
             alt="" />
    </div>

    <div id="cancel-btn">
        <a href="/jimpitan/tambah"
           class="btn btn-outline-danger">Kembali</a>
    </div>
</div>

<form action="{{ url('jimpitan/scan-qr') }}"
      id="form-qr"
      method="POST"
      autocomplete="off">
    @csrf
    <input type="hidden"
           id="scan-result"
           name="scan_result" />
</form>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://unpkg.com/html5-qrcode"></script>
<script>
    var cameraId

    var cameras = []
    var camerasIndex = 0

    var html5QrCodeEl
    // This method will trigger user permissions
    Html5Qrcode.getCameras()
        .then((devices) => {
            /**
             * devices would be an array of objects of type:
             * { id: "id", label: "label" }
             */
            if (devices && devices.length) {
                if (devices.length === 1) {
                    cameraId = devices[0].id
                } else {
                    cameraId = devices[1].id
                }

                html5QrCodeEl = new Html5Qrcode("reader")

                html5QrCodeEl
                    .start(
                        cameraId, {
                            fps: 10, // Optional, frame per seconds for qr code scanning
                            qrbox: {
                                width: 250,
                                height: 250,
                            }, // Optional, if you want bounded box UI
                        },
                        (decodedText, decodedResult) => {
                            $("#scan-result").val(decodedText)
                            $("#form-qr").submit()

                            alert("Kode QR berhasil di scan.")

                            return false
                        },
                        (errorMessage) => {
                            console.log(errorMessage)
                        }
                    )
                    .catch((err) => {
                        console.log("err")
                        console.log(err)
                    })

                if (devices.length == 1) {
                    $("#switch-btn").hide()
                } else {
                    devices.forEach((element, index) => {
                        cameras[index] = element.id
                    })
                }
            }
        })
        .catch((err) => {
            // handle err
        })

    $(document).ready(function() {
        $(document).on("click", "#switch-btn", function(e) {
            if (html5QrCodeEl) {
                html5QrCodeEl = null
            }

            if (camerasIndex >= cameras.length - 1) {
                camerasIndex = 0
            } else {
                camerasIndex += 1
            }

            cameraId = cameras[camerasIndex]

            html5QrCodeEl = new Html5Qrcode("reader")

            html5QrCodeEl
                .start(
                    cameraId, {
                        fps: 10, // Optional, frame per seconds for qr code scanning
                        qrbox: {
                            width: 250,
                            height: 250,
                        }, // Optional, if you want bounded box UI
                    },
                    (decodedText, decodedResult) => {
                        $("#scan-result").val(decodedText)
                        $("#form-qr").submit()

                        alert("Kode QR berhasil di scan.")

                        return false
                    },
                    (errorMessage) => {
                        console.log(errorMessage)
                    }
                )
                .catch((err) => {
                    console.log("err")
                    console.log(err)
                })
        })
    })
</script>
