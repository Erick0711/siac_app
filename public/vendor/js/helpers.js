
function notificacion()
{
    Livewire.on('notificar', function (data) 
    {
        console.log(data);
        if(data.message)
        {
            Swal.fire({
                position: "center",
                icon: "success",
                title: "Guardado Correctamente!",
                showConfirmButton: false,
                timer: 1500,
            });
        }else{
            Swal.fire({
                position: "center",
                icon: "error",
                title: "Algo sucedio!",
                showConfirmButton: false,
                timer: 1500,
            });
        }
    });
}

function confirmacion(component, metodo)
{
    Livewire.on('confirmDelete', function (id) 
    {
        // console.log(id);
        Swal.fire({
            title: "ADVERTENCIA?",
            text: "Deseas continuar con la acción?",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "Aceptar",
            cancelButtonText: "Cancelar"
            
        }).then((result) => {

            if (result.isConfirmed) 
            {
                
                Livewire.dispatchTo(component,metodo, {id: id})
                // console.log(nuevo);
                Swal.fire({
                    position: "center",
                    icon: "success",
                    title: "Accion ejecutada correctamente!",
                    showConfirmButton: false,
                    timer: 1500,
                });
            }   
        });
    });
}

