import './bootstrap';
import Dropzone from 'dropzone';
import Alpine from 'alpinejs';
import toastr from 'toastr';
import 'toastr/build/toastr.min.css';

window.Alpine = Alpine;

Alpine.start();

Dropzone.autoDiscover = false;

const dropzone = new Dropzone("#dropzone", {
    dictDefaultMessage: "Arrastra o selecciona tu archivo",
    maxFiles: 50,
    maxFilesize: 30720, // 30GB
    chunking: true,
    chunkSize: 10000000, // 10MB
    acceptedFiles: "image/*,video/*,.mp4,.avi,.flv,.mov, .pdf,.doc,.docx,.xls,.xlsx,.ppt,.pptx",
    //pemite remover archivos
    addRemoveLinks: true,
    dictRemoveFileConfirmation: "¿Estás seguro de que quieres eliminar este archivo?",

    headers: {
        "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').content
    },
    success: function (file, response) {
       document.getElementById('archivo_path').value = response.path

        toastr["info"]("El archivo se ha subido.", "Completado")

        toastr.options = {
            "closeButton": false,
            "debug": false,
            "newestOnTop": false,
            "progressBar": false,
            "positionClass": "toast-top-right",
            "preventDuplicates": false,
            "onclick": null,
            "showDuration": "300",
            "hideDuration": "1000",
            "timeOut": "5000",
            "extendedTimeOut": "1000",
            "showEasing": "swing",
            "hideEasing": "linear",
            "showMethod": "fadeIn",
            "hideMethod": "fadeOut"
        }
    },
    error: function (file, message) {
        toastr["error"](message.error)

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
    }
});






