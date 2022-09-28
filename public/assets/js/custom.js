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
