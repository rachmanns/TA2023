
  function store_data(content, button) {
    $('input').blur();
    let form_data = new FormData(content);
    let action = $(content).attr("action");
    $.ajax({
      url: action,
      type: 'POST',
      data: form_data,
      processData: false,  // tell jQuery not to process the data
      contentType: false,  // tell jQuery not to set contentType
      cache: false,
      success: function (response) {
        if (response.error) {
          Swal.fire({
            icon: 'error',
            title: 'Oops...',
            text: response.message
          })
        } else {
          Swal.fire(
            'Success!',
            response.message,
            'success'
          ).then(() => {
            if (response.modal) {
              setTimeout(function () { $(response.table).DataTable().ajax.reload(); }, 1000);
              var reset_form = content;
              // $(reset_form).removeClass('was-validated');
              reset_form.reset();
              $(response.modal).modal('hide');

              if (response.status_hutang) {
                status_hutang()
              }
            } else {
              if (response.url) {
                location = response.url
              } else {
                location.reload()
              }
            }

          });
        }
      },
      error: (xhr, status, error) => {
        const {
          responseJSON: response
        } = xhr;
        if (response.errors) {
          for (let form_data in response.errors) {
            let form_name = form_data.replace(/\.(\d+)\.(\w+)/g, "[$1][$2]");

            $(`[name^="${form_name}"]`, content).addClass('is-invalid');
            $(`[name^="${form_name}"]`, content).parents('.form-input').find(
              '.invalid-feedback').addClass('d-block');
            $(`[name^="${form_name}"]`, content).parents('.form-input').find(
              '.invalid-feedback').html(response.errors[form_data][0]);
            $(`[name^="${form_name}"]`, content).parents('.form-input').find(
              '.invalid-tooltip').html(response.errors[form_data][0]);
          }
        } else {
          Swal.fire({
            title: "Error",
            text: response.message,
            icon: "error",
            heightAuto: false
          })
        }
      }
    }).always(function () {
      button.prop('disabled', false);
      button.text('Simpan Data');
      // $('#upload').modal('hide');
    });
  }

(function () {

  function delete_data(content, args) {
    const { url, id } = args;
    const context = $(content).attr('context');
    let action = url + '/' + id;

    Swal.fire({
      title: 'Are you sure?',
      text: "You won't be able to revert this!",
      icon: 'warning',
      showCancelButton: true,
      confirmButtonColor: '#3085d6',
      cancelButtonColor: '#d33',
      confirmButtonText: 'Yes, delete it!'
    }).then((result) => {
      if (result.isConfirmed) {
        $.ajax({
          type: "DELETE",
          headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          },
          url: action,
          success: function (response) {
            if (response.error) {
              Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: response.message
              })
            } else {
              Swal.fire(
                response.table ? 'Deleted!' : 'Info',
                response.message,
                'success'
              ).then(() => {
                if (response.table) {
                  setTimeout(function () { $(response.table).DataTable().ajax.reload(); }, 1000);
                }
                if (response.reload_page) {
                  location.reload()
                }
                if (response.status_hutang) {
                  status_hutang()
                }

              });
            }
          }
        });

      }
    })

  }

  $(document).on('submit', '.default-form', function (event) {
    event.preventDefault();
    var button = $(this).find(':submit');
    button.prop('disabled', true)
    button.text('Menyimpan...');
    store_data(this, button);
  });

  $(document).on('click', '.delete-data', function () {
    delete_data(this, {
      url: $(this).attr('data-url'),
      id: $(this).attr('data-id'),
    });

  });

  $('form input').on('keyup change paste', function () {
    $(this).removeClass('is-invalid');
    $(this).parents('.form-input').find('.invalid-feedback').removeClass('d-block');
  });

  $('form textarea').on('keyup change paste', function () {
    $(this).removeClass('is-invalid');
    $(this).parents('.form-input').find('.invalid-feedback').removeClass('d-block');
  });

  $('select').on('change', function () {
    $(this).removeClass('is-invalid');
    $(this).parents('.form-input').find('.invalid-feedback').removeClass('d-block');
  });
})()