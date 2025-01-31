import './bootstrap';
import Dropzone from 'dropzone';
import Alpine from 'alpinejs';

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
    },
    init: function () {
        this.on("success", function (file, response) {
            // Asignar la ruta del archivo subido al campo oculto
            document.getElementById('archivo_path').value = response.path;
        });
    }
});






