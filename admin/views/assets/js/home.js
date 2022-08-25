function checkDelete(link) {
    Swal.fire({
        title: 'Xoá?',
        text: "Bạn có chắc xoá nó không!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Xoá!',
        cancelButtonText: 'Huỷ',
    }).then((result) => {
        if (result.isConfirmed) {
            window.location.href = link;
        }
    })

}