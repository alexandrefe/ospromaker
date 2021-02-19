export function deleteSweetAlert() {
  $('.botao-deletar').on('click', function(e) {
    e.preventDefault();
    const dataTitle = this.getAttribute('data-title');
    const dataText = this.getAttribute('data-text');
    const dataId = this.getAttribute('data-id');
    const url = `${window.location.href}/destroy/${dataId}`;
    const dataRedirect = this.getAttribute('data-redirect');
    Swal.fire({
      title: dataTitle,
      text: dataText,
      icon: 'warning',
      showCancelButton: true,
      confirmButtonColor: '#3085d6',
      cancelButtonColor: '#d33',
      confirmButtonText: 'Sim, pode deletar!'
    }).then((result) => {
      if(result.isConfirmed) {
        $.ajax({
          type: "delete",
          url: url,
          success: function (response) {
            window.Location = window.location.href;
          }
        })
        return setTimeout(() => {
          window.location.href = dataRedirect;
        }, 500);
      }
    })
  })
}
