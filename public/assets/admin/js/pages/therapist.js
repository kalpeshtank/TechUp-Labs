'use strict';
// Class definition

var KTDatatableDataLocalDemoTherapist = function () {
    // Private functions
    // demo initializer
    var therapistData = function () {
        var datatable = $('.kt-datatable-therapist').KTDatatable({
            data: {
                type: 'remote',
                source: {
                    read: {
                        url: window.baseUrl + '/admin/therapist/show',
                        method: 'GET',
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        contentType: 'application/json',
                    }
                },
                pageSize: 10,
                serverPaging: true,
                serverFiltering: true,
                serverSorting: true,
            },
            // layout definition
            layout: {
                scroll: false, // enable/disable datatable scroll both horizontal and vertical when needed.
                // height: 450, // datatable's body's fixed height
                footer: false, // display/hide footer
            },
            // column sorting
            sortable: true,
            pagination: true,
            // columns definition
            columns: [
                {
                    field: 'name',
                    title: 'Name',
                },
                {
                    field: 'email',
                    title: 'Email',
                },
                {
                    field: 'phone_number',
                    title: 'Phone Number',
                },
                {
                    field: 'state',
                    title: 'State',
                    template: function (row) {
                        return row.country_data ? row.state_data['name'] : '';
                    },
                },
                {
                    field: 'country',
                    title: 'Country',
                    template: function (row) {
                        return row.country_data ? row.country_data['name'] : '';
                    },
                },
                {
                    field: 'is_active',
                    title: 'Status',
                    template: function (row) {
                        return row.is_active == 1 ? "Active" : 'Inactive';
                    },
                },
                {
                    field: 'Actions',
                    title: 'Actions',
                    sortable: false,
                    //selector: {class: 'kt-checkbox--solid'},
                    width: 110,
                    overflow: 'visible',
                    autoHide: false,
                    template: function (row) {
                        return '<a href="' + baseUrl + '/admin/therapist/' + row.id + '/edit" class="btn btn-sm btn-clean btn-icon btn-icon-md " title="Edit details">\
							<i class="la la-edit"></i></a>\
						<a href="javascript:void(0);" id="' + row.id + '" class="btn btn-sm btn-clean btn-icon btn-icon-md deleteRecord" title="Delete">\
							<i class="la la-trash"></i></a>';
                    },
                }
            ],
        });

        $(document).on("click", ".submit_delete", function () {
            var id = $("#record_id").val();
            $.ajax({
                url: baseUrl + '/admin/therapist/' + id,
                type: "DELETE",
                data: {"id": id},
                dataType: 'json',
                success: function (data) {
                    if (data == 'Error') {
                        toastr.error("Oops, There is some thing went wrong.Please try after some time.");
                    } else {
                        toastr.success('Record Deleted Successfully.');
                        $('.kt-datatable-therapist').KTDatatable('reload');
                    }
                }, error: function (data) {
                    toastr.error("Invalid Request");
                }
            });

            $("#deleteModal").modal('hide');
        });
    };

    return {
        // Public functions
        init: function () {
            // init dmeo
            therapistData();
        },
    };
}();

jQuery(document).ready(function () {
    KTDatatableDataLocalDemoTherapist.init();
});

$(document).on("click", ".deleteRecord", function () {
    $("#deleteModal").modal('show');
    $("#record_id").val(this.id);
});