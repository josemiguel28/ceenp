import './bootstrap';
import Dropzone from 'dropzone';
import Alpine from 'alpinejs';
import toastr from 'toastr';
import 'toastr/build/toastr.min.css';

window.Alpine = Alpine;

Alpine.start();

Dropzone.autoDiscover = false;

const dropzone = new Dropzone("#dropzone", {
    dictDefaultMessage: "Arrastra o da click para subir el archivo",
    acceptedFiles: 'video/*,application/pdf,application/msword,application/vnd.openxmlformats-officedocument.wordprocessingml.document,application/vnd.ms-excel,application/vnd.openxmlformats-officedocument.spreadsheetml.sheet,application/vnd.ms-powerpoint,application/vnd.openxmlformats-officedocument.presentationml.presentation',
    maxFiles: 1,
    maxFilesize: 1024,
    addRemoveLinks: true,
    dictRemoveFile: "Eliminar archivo",
    uploadMultiple: false,

    headers: {
        "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').content
    },
    init: function () {
        this.on("success", function (file, response) {
            // Asignar la ruta del archivo subido al campo oculto
            const input = document.getElementById('archivo_path').value = response.path;
            console.log(response.path)
            console.log(document.getElementById('archivo_path'))
        });
    }
});

dropzone.on('error', function (file, message) {
    toastr["error"](message)

    console.log(message)
    toastr.options = {
        "closeButton": false,
        "debug": false,
        "newestOnTop": false,
        "progressBar": false,
        "positionClass": "toast-top-right",
        "preventDuplicates": false,
        "onclick": null,
        "showDuration": "500",
        "hideDuration": "1000",
        "timeOut": "5000",
        "extendedTimeOut": "1000",
        "showEasing": "swing",
        "hideEasing": "linear",
        "showMethod": "fadeIn",
        "hideMethod": "fadeOut"
    }
    this.removeFile(file)
})






