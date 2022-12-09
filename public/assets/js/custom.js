$('.modal').modal({backdrop: 'static', keyboard: false})
function alertMessage(status, message){
    if(status == 1){
        icon = 'success';
        title = "Pemberitahuan";
    }else{
        icon = 'error'
        title = 'Peringatan'
    }
    Swal.fire({
        icon: icon,
        title: title,
        text: message,
    })
}

async function alertConfirm(title, message){
    const response = await Swal.fire({
        title: title,
        text: message,
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Ya, Hapus'
      });

      return response
}

async function alertConfirmCustom(title, message, textYes){
    const response = await Swal.fire({
        title: title,
        text: message,
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: textYes
      });

      return response
}
