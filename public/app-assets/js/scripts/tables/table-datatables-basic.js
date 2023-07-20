/**
 * DataTables Basic
 */

$(function () {
  'use strict';

  var dt_date_table = $('.dt-date'),
    dt_basic_table = $('.datatables-basic'),
    dt_complex_header_table = $('.dt-complex-header'),
    dt_row_grouping_table = $('.dt-row-grouping'),
    pengadaan_daerah_table = $('.detail-non-bilateral'),
    pengadaan_pusat_table = $('.detail-usibdd'),
    transfer_table = $('.detail-thainesia'),
    nakes = $('.nakes'),
    paramedis = $('.paramedis'),
    assetPath = '../../../app-assets/';

  if ($('body').attr('data-framework') === 'laravel') {
    assetPath = $('body').attr('data-asset-path');
  }

  // DataTable with buttons
  // --------------------------------------------------------------------

  // Flat Date picker
  if (dt_date_table.length) {
    dt_date_table.flatpickr({
      monthSelectorType: 'static',
      dateFormat: 'm/d/Y'
    });
  }

  // Add New record
  // ? Remove/Update this code as per your requirements ?
  var count = 101;
  $('.data-submit').on('click', function () {
    var $new_name = $('.add-new-record .dt-full-name').val(),
      $new_post = $('.add-new-record .dt-post').val(),
      $new_email = $('.add-new-record .dt-email').val(),
      $new_date = $('.add-new-record .dt-date').val(),
      $new_salary = $('.add-new-record .dt-salary').val();

    if ($new_name != '') {
      dt_basic.row
        .add({
          responsive_id: null,
          id: count,
          full_name: $new_name,
          post: $new_post,
          email: $new_email,
          start_date: $new_date,
          salary: '$' + $new_salary,
          status: 5
        })
        .draw();
      count++;
      $('.modal').modal('hide');
    }
  });

  // Delete Record
  $('.datatables-basic tbody').on('click', '.delete-record', function () {
    dt_basic.row($(this).parents('tr')).remove().draw();
  });

  // Complex Header DataTable
  // --------------------------------------------------------------------

  if (dt_complex_header_table.length) {
    var dt_complex = dt_complex_header_table.DataTable({
      ajax: assetPath + 'data/table-datatable.json',
      columns: [
        { data: 'full_name' },
        { data: 'email' },
        { data: 'city' },
        { data: 'post' },
        { data: 'salary' },
        { data: 'status' },
        { data: '' }
      ],
      columnDefs: [
        {
          // Label
          targets: -2,
          render: function (data, type, full, meta) {
            var $status_number = full['status'];
            var $status = {
              1: { title: 'Current', class: 'badge-light-primary' },
              2: { title: 'Professional', class: ' badge-light-success' },
              3: { title: 'Rejected', class: ' badge-light-danger' },
              4: { title: 'Resigned', class: ' badge-light-warning' },
              5: { title: 'Applied', class: ' badge-light-info' }
            };
            if (typeof $status[$status_number] === 'undefined') {
              return data;
            }
            return (
              '<span class="badge badge-pill ' +
              $status[$status_number].class +
              '">' +
              $status[$status_number].title +
              '</span>'
            );
          }
        },
        {
          // Actions
          targets: -1,
          title: 'Actions',
          orderable: false,
          render: function (data, type, full, meta) {
            return (
              '<div class="d-inline-flex">' +
              '<a class="pr-1 dropdown-toggle hide-arrow text-primary" data-toggle="dropdown">' +
              feather.icons['more-vertical'].toSvg({ class: 'font-small-4' }) +
              '</a>' +
              '<div class="dropdown-menu dropdown-menu-right">' +
              '<a href="javascript:;" class="dropdown-item">' +
              feather.icons['file-text'].toSvg({ class: 'mr-50 font-small-4' }) +
              'Details</a>' +
              '<a href="javascript:;" class="dropdown-item">' +
              feather.icons['archive'].toSvg({ class: 'mr-50 font-small-4' }) +
              'Archive</a>' +
              '<a href="javascript:;" class="dropdown-item delete-record">' +
              feather.icons['trash-2'].toSvg({ class: 'mr-50 font-small-4' }) +
              'Delete</a>' +
              '</div>' +
              '</div>' +
              '<a href="javascript:;" class="item-edit">' +
              feather.icons['edit'].toSvg({ class: 'font-small-4' }) +
              '</a>'
            );
          }
        }
      ],
      dom:
        '<"d-flex justify-content-between align-items-center mx-0 row"<"col-sm-12 col-md-6"l><"col-sm-12 col-md-6"f>>t<"d-flex justify-content-between mx-0 row"<"col-sm-12 col-md-6"i><"col-sm-12 col-md-6"p>>',
      displayLength: 7,
      lengthMenu: [7, 10, 25, 50, 75, 100],
      language: {
        paginate: {
          // remove previous & next text from pagination
          previous: '&nbsp;',
          next: '&nbsp;'
        }
      }
    });
  }

  // Row Grouping
  // --------------------------------------------------------------------

  var groupColumn = 2;
  if (dt_row_grouping_table.length) {
    var groupingTable = dt_row_grouping_table.DataTable({
      ajax: assetPath + 'data/table-datatable.json',
      columns: [
        { data: 'responsive_id' },
        { data: 'full_name' },
        { data: 'post' },
        { data: 'email' },
        { data: 'city' },
        { data: 'start_date' },
        { data: 'salary' },
        { data: 'status' },
        { data: '' }
      ],
      columnDefs: [
        {
          // For Responsive
          className: 'control',
          orderable: false,
          targets: 0
        },
        { visible: false, targets: groupColumn },
        {
          // Label
          targets: -2,
          render: function (data, type, full, meta) {
            var $status_number = full['status'];
            var $status = {
              1: { title: 'Current', class: 'badge-light-primary' },
              2: { title: 'Professional', class: ' badge-light-success' },
              3: { title: 'Rejected', class: ' badge-light-danger' },
              4: { title: 'Resigned', class: ' badge-light-warning' },
              5: { title: 'Applied', class: ' badge-light-info' }
            };
            if (typeof $status[$status_number] === 'undefined') {
              return data;
            }
            return (
              '<span class="badge badge-pill ' +
              $status[$status_number].class +
              '">' +
              $status[$status_number].title +
              '</span>'
            );
          }
        },
        {
          // Actions
          targets: -1,
          title: 'Actions',
          orderable: false,
          render: function (data, type, full, meta) {
            return (
              '<div class="d-inline-flex">' +
              '<a class="pr-1 dropdown-toggle hide-arrow text-primary" data-toggle="dropdown">' +
              feather.icons['more-vertical'].toSvg({ class: 'font-small-4' }) +
              '</a>' +
              '<div class="dropdown-menu dropdown-menu-right">' +
              '<a href="javascript:;" class="dropdown-item">' +
              feather.icons['file-text'].toSvg({ class: 'mr-50 font-small-4' }) +
              'Details</a>' +
              '<a href="javascript:;" class="dropdown-item">' +
              feather.icons['archive'].toSvg({ class: 'mr-50 font-small-4' }) +
              'Archive</a>' +
              '<a href="javascript:;" class="dropdown-item delete-record">' +
              feather.icons['trash-2'].toSvg({ class: 'mr-50 font-small-4' }) +
              'Delete</a>' +
              '</div>' +
              '</div>' +
              '<a href="javascript:;" class="item-edit">' +
              feather.icons['edit'].toSvg({ class: 'font-small-4' }) +
              '</a>'
            );
          }
        }
      ],
      order: [[groupColumn, 'asc']],
      dom:
        '<"d-flex justify-content-between align-items-center mx-0 row"<"col-sm-12 col-md-6"l><"col-sm-12 col-md-6"f>>t<"d-flex justify-content-between mx-0 row"<"col-sm-12 col-md-6"i><"col-sm-12 col-md-6"p>>',
      displayLength: 7,
      lengthMenu: [7, 10, 25, 50, 75, 100],
      drawCallback: function (settings) {
        var api = this.api();
        var rows = api.rows({ page: 'current' }).nodes();
        var last = null;

        api
          .column(groupColumn, { page: 'current' })
          .data()
          .each(function (group, i) {
            if (last !== group) {
              $(rows)
                .eq(i)
                .before('<tr class="group"><td colspan="8">' + group + '</td></tr>');

              last = group;
            }
          });
      },
      responsive: {
        details: {
          display: $.fn.dataTable.Responsive.display.modal({
            header: function (row) {
              var data = row.data();
              return 'Details of ' + data['full_name'];
            }
          }),
          type: 'column',
          renderer: $.fn.dataTable.Responsive.renderer.tableAll({
            tableClass: 'table'
          })
        }
      },
      language: {
        paginate: {
          // remove previous & next text from pagination
          previous: '&nbsp;',
          next: '&nbsp;'
        }
      }
    });

    // Order by the grouping
    $('.dt-row-grouping tbody').on('click', 'tr.group', function () {
      var currentOrder = table.order()[0];
      if (currentOrder[0] === groupColumn && currentOrder[1] === 'asc') {
        groupingTable.order([groupColumn, 'desc']).draw();
      } else {
        groupingTable.order([groupColumn, 'asc']).draw();
      }
    });
  }

  if (dt_basic_table.length) {
    var dt_basic = dt_basic_table.DataTable({
      ajax: assetPath + 'data/table-datatable.json',
      scrollX: true,
      columns: [
        { data: 'responsive_id' },
        { data: 'id' },
        { data: 'id' }, // used for sorting so will hide this column
        { data: '' },
        { data: 'sebaran' },
        { data: 'kategori' },
        { data: 'spesialis' },
        { data: 'nama' },
        { data: 'matra' },
        { data: 'pangkat' },
        { data: 'struktural' },
        { data: 'fungsional' },
        { data: 'ket' }
      ],
      columnDefs: [
        {
          // For Responsive
          className: 'control',
          orderable: false,
          responsivePriority: 2,
          visible: false,
          targets: 0
        },
        {
          // For Checkboxes
          targets: 1,
          orderable: false,
          responsivePriority: 3,
          render: function (data, type, full, meta) {
            return (
              '<div class="custom-control custom-checkbox"> <input class="custom-control-input dt-checkboxes" type="checkbox" value="" id="checkbox' +
              data +
              '" /><label class="custom-control-label" for="checkbox' +
              data +
              '"></label></div>'
            );
          },
          checkboxes: {
            selectAllRender:
              '<div class="custom-control custom-checkbox"> <input class="custom-control-input" type="checkbox" value="" id="checkboxSelectAll" /><label class="custom-control-label" for="checkboxSelectAll"></label></div>'
          }
        },
        {
          targets: 2,
          visible: false
        },
        {
          responsivePriority: 1,
          targets: 4
        },
        {
          // Actions
          targets: 3,
          orderable: false,
          render: function (data, type, full, meta) {
            return (
              '<div class="text-center">' +
              '<a href="#" class="delete-data" title="Delete">' +
              feather.icons['trash'].toSvg({ class: 'font-medium-4 text-danger' }) +
              '</a>' +
              '</div>'
            );
          }
        }
      ],
      order: [[2, 'desc']],
      displayLength: 7,
      lengthMenu: [7, 10, 25, 50, 75, 100],
      responsive: {
        details: {
          display: $.fn.dataTable.Responsive.display.modal({
            header: function (row) {
              var data = row.data();
              return 'Details of ' + data['full_name'];
            }
          }),
          type: 'column',
          renderer: function (api, rowIdx, columns) {
            var data = $.map(columns, function (col, i) {
              console.log(columns);
              return col.title !== '' // ? Do not show row in modal popup if title is blank (for check box)
                ? '<tr data-dt-row="' +
                    col.rowIndex +
                    '" data-dt-column="' +
                    col.columnIndex +
                    '">' +
                    '<td>' +
                    col.title +
                    ':' +
                    '</td> ' +
                    '<td>' +
                    col.data +
                    '</td>' +
                    '</tr>'
                : '';
            }).join('');

            return data ? $('<table class="table"/>').append(data) : false;
          }
        }
      },
      language: {
        paginate: {
          // remove previous & next text from pagination
          previous: '&nbsp;',
          next: '&nbsp;'
        }
      }
    });
  }
  
  // if (dt_basic_table.length) {
  //   var dt_basic = dt_basic_table.DataTable({
  //     ajax: assetPath + 'data/approval.json',
  //     scrollX: true,
  //     columns: [
  //       { data: 'responsive_id' },
  //       { data: 'id' },
  //       { data: 'id' }, // used for sorting so will hide this column
  //       { data: 'aksi' },
  //       { data: 'sebaran' },
  //       { data: 'kategori' },
  //       { data: 'spesialis' },
  //       { data: 'nama' },
  //       { data: 'matra' },
  //       { data: 'pangkat' },
  //       { data: 'struktural' },
  //       { data: 'fungsional' },
  //       { data: 'ket' }
  //     ],
  //     columnDefs: [
  //       {
  //         // For Responsive
  //         className: 'control',
  //         orderable: false,
  //         responsivePriority: 2,
  //         targets: 0
  //       },
  //       {
  //         // For Checkboxes
  //         targets: 1,
  //         orderable: false,
  //         responsivePriority: 3,
  //         render: function (data, type, full, meta) {
  //           return (
  //             '<div class="custom-control custom-checkbox"> <input class="custom-control-input dt-checkboxes" type="checkbox" value="" id="checkbox' +
  //             data +
  //             '" /><label class="custom-control-label" for="checkbox' +
  //             data +
  //             '"></label></div>'
  //           );
  //         },
  //         checkboxes: {
  //           selectAllRender:
  //             '<div class="custom-control custom-checkbox"> <input class="custom-control-input" type="checkbox" value="" id="checkboxSelectAll" /><label class="custom-control-label" for="checkboxSelectAll"></label></div>'
  //         }
  //       },
  //       {
  //         targets: 2,
  //         visible: false
  //       },
  //       {
  //         responsivePriority: 1,
  //         targets: 4
  //       }
  //     ],
  //     order: [[2, 'desc']],
  //     displayLength: 7,
  //     lengthMenu: [7, 10, 25, 50, 75, 100],
  //     language: {
  //       paginate: {
  //         // remove previous & next text from pagination
  //         previous: '&nbsp;',
  //         next: '&nbsp;'
  //       }
  //     }
  //   });
  // }

  // Multilingual DataTable
  // --------------------------------------------------------------------

  var lang = 'English';
  if (pengadaan_daerah_table.length) {
    var table_language = pengadaan_daerah_table.DataTable({
      ajax: assetPath + 'data/data-barang-keluar.json',
      columns: [
        { data: 'no' },
        { data: 'jenis' },
        { data: 'tgl' },
        { data: 'tempat' },
        { data: 'waktu' },
        { data: 'ket' },
        { data: 'status' },
        { data: '' }
      ],
      columnDefs: [
        {
          // For Responsive
          className: 'control',
          orderable: false,
          targets: 0
        },
        {
          // Actions
          targets: -1,
          orderable: false,
          render: function (data, type, full, meta) {
            return (
              '<div class="text-center">' +
              '<a href="#" class="item-edit" title="Edit">' +
              feather.icons['edit'].toSvg({ class: 'font-medium-4' }) +
              '</a>' +
              '</div>'
            );
          }
        }
      ]
    });
  }

  var lang = 'English';
  if (pengadaan_pusat_table.length) {
    var table_language = pengadaan_pusat_table.DataTable({
      ajax: assetPath + 'data/detail-usibdd.json',
      columns: [
        { data: 'no' },
        { data: 'jenis' },
        { data: 'tgl' },
        { data: 'tempat' },
        { data: 'waktu' },
        { data: 'ket' },
        { data: 'status' },
        { data: '' }
      ],
      columnDefs: [
        {
          // For Responsive
          className: 'control',
          orderable: false,
          targets: 0
        },
        {
          // Actions
          targets: -1,
          orderable: false,
          render: function (data, type, full, meta) {
            return (
              '<div class="text-center">' +
              '<a href="#" class="item-edit" title="Edit">' +
              feather.icons['edit'].toSvg({ class: 'font-medium-4' }) +
              '</a>' +
              '</div>'
            );
          }
        }
      ]
    });
  }

  var lang = 'English';
  if (transfer_table.length) {
    var table_language = transfer_table.DataTable({
      ajax: assetPath + 'data/detail-thainesia.json',
      columns: [
        { data: 'no' },
        { data: 'jenis' },
        { data: 'tgl' },
        { data: 'tempat' },
        { data: 'waktu' },
        { data: 'ket' },
        { data: 'status' },
        { data: '' }
      ],
      columnDefs: [
        {
          // For Responsive
          className: 'control',
          orderable: false,
          targets: 0
        },
        {
          // Actions
          targets: -1,
          orderable: false,
          render: function (data, type, full, meta) {
            return (
              '<div class="text-center">' +
              '<a href="#" class="item-edit" title="Edit">' +
              feather.icons['edit'].toSvg({ class: 'font-medium-4' }) +
              '</a>' +
              '</div>'
            );
          }
        }
      ]
    });
  }

  var lang = 'English';
  if (nakes.length) {
    var table_language = nakes.DataTable({
      // ajax: assetPath + 'data/detail-thainesia.json',
      columns: [
        { data: 'nakes' },
        { data: 'militer' },
        { data: 'pns' },
        { data: 'honorer' }
      ],
      columnDefs: [
        {
          // For Responsive
          className: 'control',
          orderable: false,
          targets: 0
        }
      ]
    });
  }

  var lang = 'English';
  if (paramedis.length) {
    var table_language = paramedis.DataTable({
      // ajax: assetPath + 'data/detail-thainesia.json',
      columns: [
        { data: 'paramedis' },
        { data: 'militer' },
        { data: 'pns' },
        { data: 'honorer' }
      ],
      columnDefs: [
        {
          // For Responsive
          className: 'control',
          orderable: false,
          targets: 0
        }
      ]
    });
  }

});
