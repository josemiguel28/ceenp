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
    acceptedFiles: "application/pdf",
    maxFilesize: 10,
    maxFiles: 1,
    addRemoveLinks: true,
    dictRemoveFile: "Eliminar archivo",
    uploadMultiple: false,

    headers: {
        "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').content
    }
});

dropzone.on('error', function (file) {
    toastr["error"]("El archivo debe ser un PDF", "Archivo no válido")

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






