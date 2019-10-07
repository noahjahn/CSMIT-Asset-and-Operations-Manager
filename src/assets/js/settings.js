/* *** Handle initial tab loading *** */
$(document).ready(function() {
//     $('a[data-toggle="tab"]').on( 'shown.bs.tab', function (e) {
//     // var target = $(e.target).attr("href"); // activated tab
//     // alert (target);
//     // $($.fn.dataTable.tables( true ) ).css('width', '100%');
//     // $($.fn.dataTable.tables( true ) ).DataTable().columns.adjust().draw();
// } );
    $($.fn.dataTable.tables(true)).DataTable().responsive.recalc().columns.adjust();
    makeAssetManagerActive();
    loadManufacturers();
});
/* *** ************************** *** */



/* *** Handle tab switching *** */
function makeAssetManagerActive() {
    $(this).addClass('active')
    $('#users-link').each(function() {
        $(this).removeClass('active');
    });
    $('#permissions-link').each(function() {
        $(this).removeClass('active');
    });
    $('#login-photos-link').each(function() {
        $(this).removeClass('active');
    });
    $('#asset-manager-content').each(function() {
        $(this).addClass('show');
        $(this).addClass('active');
    });
    $('#users-content').each(function() {
        $(this).removeClass('show');
        $(this).removeClass('active');
    });
    $('#permissions-content').each(function() {
        $(this).removeClass('show');
        $(this).removeClass('active');
    });
    $('#login-photos-content').each(function() {
        $(this).removeClass('show');
        $(this).removeClass('active');
    });
}

$(function() {
    $('#asset-manager-link').click(function(e) {
        e.preventDefault();
        makeAssetManagerActive();
    });
});

$(function() {
    $('#users-link').click(function() {
        $(this).addClass('active')
        $('#asset-manager-link').each(function() {
            $(this).removeClass('active');
        });
        $('#permissions-link').each(function() {
            $(this).removeClass('active');
        });
        $('#login-photos-link').each(function() {
            $(this).removeClass('active');
        });
        $('#users-content').each(function() {
            $(this).addClass('show');
            $(this).addClass('active');
        });
        $('#asset-manager-content').each(function() {
            $(this).removeClass('show');
            $(this).removeClass('active');
        });
        $('#permissions-content').each(function() {
            $(this).removeClass('show');
            $(this).removeClass('active');
        });
        $('#login-photos-content').each(function() {
            $(this).removeClass('show');
            $(this).removeClass('active');
        });
    });
});

$(function() {
    $('#permissions-link').click(function() {
        $(this).addClass('active')
        $('#users-link').each(function() {
            $(this).removeClass('active');
        });
        $('#asset-manager-link').each(function() {
            $(this).removeClass('active');
        });
        $('#login-photos-link').each(function() {
            $(this).removeClass('active');
        });
        $('#permissions-content').each(function() {
            $(this).addClass('show');
            $(this).addClass('active');
        });
        $('#users-content').each(function() {
            $(this).removeClass('show');
            $(this).removeClass('active');
        });
        $('#asset-manager-content').each(function() {
            $(this).removeClass('show');
            $(this).removeClass('active');
        });
        $('#login-photos-content').each(function() {
            $(this).removeClass('show');
            $(this).removeClass('active');
        });
    });
});

$(function() {
    $('#login-photos-link').click(function() {
        $(this).addClass('active')
        $('#users-link').each(function() {
            $(this).removeClass('active');
        });
        $('#permissions-link').each(function() {
            $(this).removeClass('active');
        });
        $('#asset-manager-link').each(function() {
            $(this).removeClass('active');
        });
        $('#login-photos-content').each(function() {
            $(this).addClass('show');
            $(this).addClass('active');
        });
        $('#users-content').each(function() {
            $(this).removeClass('show');
            $(this).removeClass('active');
        });
        $('#permissions-content').each(function() {
            $(this).removeClass('show');
            $(this).removeClass('active');
        });
        $('#asset-manager-content').each(function() {
            $(this).removeClass('show');
            $(this).removeClass('active');
        });
    });
});
/* *** ************************** *** */

$(document).ready( function () {
    /* Prepare Asset Types table */
    $('#asset_types').DataTable( {
        ajax: {
            url: baseUrl + "AssetTypes/get_all_json",
            dataSrc: ''
        },
        columns: [
            { "data": "id" },
            { "data": "name" },
            { "data": "rate", "render": function (data, type, row) {
                    return "$" + row.rate;
            }
            },
            { "render": function ( data, type, row ) {
                    return '<button class="table-icon" data-toggle="modal" data-target="#add-edit-asset-type" data-type="POST" data-tableid="asset_types" data-url="AssetTypes/edit/' + row.id + '" data-target="#add-edit-asset-type"><img class="mini-icon" src="' + baseUrl + 'assets/img/icons/edit-svgrepo-com-white.svg"></button></td>';
                }
            },
            { "render": function ( data, type, row ) {
                    return '<button class="table-icon" data-toggle="modal" data-id="delete-asset-type" data-type="DELETE" data-tableid="asset_types" data-url="AssetTypes/delete/' + row.id + '" data-target="#delete-asset-type"><img class="mini-icon" src="' + baseUrl + 'assets/img/icons/trash-can-with-cover-svgrepo-com-white.svg"></button></td>';
                }
            }
        ],
        scrollY:        200,
        paging:         false,
        fixedHeader:    true,
        info:           false,
        columnDefs: [
            { "orderable": false, "targets": [3,4] },
            { "visible": false, "targets": 0 }
        ],
        dom:
            "<'row'<'col-sm'<'table-title-asset_types'>>fB>" +
			"<'row'<'col-sm'tr>>",
        buttons: [
            {
                text: "Add Asset Type",
                action: function (e, dt, node, config) {
                },
                init: function (api, node, config) {
                    $(node).removeClass('btn-secondary');
                    $(node).addClass("add-edit-button");
                    $(node).attr("data-toggle", "modal");
                    $(node).attr("data-url", "AssetTypes/add");
                    $(node).attr("data-id", "add-edit-asset-type");
                    $(node).attr("data-type", "POST");
                    $(node).attr("data-tableid", "asset-types");
                    $(node).attr("data-target", "#add-edit-asset-type");
                },
                className: 'btn-primary'
            }
        ],
        language: {
            search: "",
            searchPlaceholder: "Search..."
        }
    });
    $("div.table-title-asset_types").html('<h5 class="pt-3">Asset Types</h5>');
    $("#asset_types_wrapper").addClass("mb-4", "pt-2");

    /* Prepare Teams table */
    $('#teams').DataTable( {
        ajax: {
            url: baseUrl + "Teams/get_all_json",
            dataSrc: ''
        },
        columns: [
            { "data": "id" },
            { "data": "name" },
            { "render": function ( data, type, row ) {
                    return '<button class="table-icon" data-toggle="modal" data-target="#add-edit-team" data-type="POST" data-tableid="teams" data-url="Teams/edit/' + row.id + '" data-target="#add-edit-team"><img class="mini-icon" src="' + baseUrl + 'assets/img/icons/edit-svgrepo-com-white.svg"></button></td>';
                }
            },
            { "render": function ( data, type, row ) {
                    return '<button class="table-icon" data-toggle="modal" data-id="delete-team" data-type="DELETE" data-tableid="teams" data-url="Teams/delete/' + row.id + '"  data-target="#delete-team"><img class="mini-icon" src="' + baseUrl + 'assets/img/icons/trash-can-with-cover-svgrepo-com-white.svg"></button></td>';
                }
            }
        ],
        scrollY:        200,
        paging:         false,
        fixedHeader:    true,
        info:           false,
        columnDefs: [
            { "orderable": false, "targets": [2,3] },
            { "visible": false, "targets": 0 }
        ],
        dom:
            "<'row'<'col-sm'<'table-title-teams'>>fB>" +
			"<'row'<'col-sm'tr>>",
        buttons: [
            {
                text: "Add Team",
                action: function (e, dt, node, config) {
                },
                init: function (api, node, config) {
                    $(node).removeClass('btn-secondary');
                    $(node).addClass("add-edit-button");
                    $(node).attr("data-toggle", "modal");
                    $(node).attr("data-url", "Teams/add");
                    $(node).attr("data-id", "add-edit-team");
                    $(node).attr("data-type", "POST");
                    $(node).attr("data-tableid", "teams");
                    $(node).attr("data-target", "#add-edit-team");
                },
                className: 'btn-primary'
            }
        ],
        language: {
            search: "",
            searchPlaceholder: "Search..."
        }
    });
    $("div.table-title-teams").html('<h5 class="pt-3">Teams</h5>');
    $("#teams_wrapper").addClass("mb-4", "pt-2");

    /* Prepare Manufacturers table */
    $('#manufacturers').DataTable( {
        ajax: {
            url: baseUrl + "Manufacturers/get_all_json",
            dataSrc: ''
        },
        columns: [
            { "data": "id" },
            { "data": "name" },
            { "render": function ( data, type, row ) {
                    return '<button class="table-icon" data-toggle="modal" data-target="#add-edit-manufacturer" data-type="POST" data-tableid="manufacturers" data-url="Manufacturers/edit/' + row.id + '" data-target="#add-edit-manufacturer"><img class="mini-icon" src="' + baseUrl + 'assets/img/icons/edit-svgrepo-com-white.svg"></button></td>';
                }
            },
            { "render": function ( data, type, row ) {
                    return '<button class="table-icon" data-toggle="modal" data-id="delete-manufacturer" data-type="DELETE" data-tableid="manufacturers" data-url="Manufacturers/delete/' + row.id + '" data-target="#delete-manufacturer"><img class="mini-icon" src="' + baseUrl + 'assets/img/icons/trash-can-with-cover-svgrepo-com-white.svg"></button></td>';
                }
            }
        ],
        scrollY:        200,
        paging:         false,
        fixedHeader:    true,
        info:           false,
        columnDefs: [
            { "orderable": false, "targets": [2,3] },
            { "visible": false, "targets": 0 }
        ],
        dom:
            "<'row'<'col-sm'<'table-title-manufacturers'>>fB>" +
			"<'row'<'col-sm'tr>>",
        buttons: [
            {
                text: "Add Manufacturer",
                action: function (e, dt, node, config) {
                },
                init: function (api, node, config) {
                    $(node).removeClass('btn-secondary');
                    $(node).addClass("add-edit-button");
                    $(node).attr("data-toggle", "modal");
                    $(node).attr("data-url", "Manufacturers/add");
                    $(node).attr("data-id", "add-edit-manufacturer");
                    $(node).attr("data-type", "POST");
                    $(node).attr("data-tableid", "manufacturers");
                    $(node).attr("data-target", "#add-edit-manufacturer");
                },
                className: 'btn-primary'
            }
        ],
        language: {
            search: "",
            searchPlaceholder: "Search..."
        }
    });
    $("div.table-title-manufacturers").html('<h5 class="pt-3">Manufacturers</h5>');
    $("#manufacturers_wrapper").addClass("mb-4", "pt-2");

    /* Prepare Models table */
    $('#models').DataTable( {
        ajax: {
            url: baseUrl + "Models/get_all_json",
            dataSrc: ''
        },
        columns: [
            { "data": "id" },
            { "data": "name" },
            { "data": "manufacturer" },
            { "render": function ( data, type, row ) {
                    return '<button class="table-icon" data-toggle="modal" data-target="#add-edit-model" data-type="POST" data-tableid="models" data-url="Models/edit/' + row.id + '" data-target="#add-edit-model"><img class="mini-icon" src="' + baseUrl + 'assets/img/icons/edit-svgrepo-com-white.svg"></button></td>';
                }
            },
            { "render": function ( data, type, row ) {
                    return '<button class="table-icon" data-toggle="modal" data-id="delete-model" data-type="DELETE" data-tableid="models" data-url="Models/delete/' + row.id + '" data-target="#delete-model"><img class="mini-icon" src="' + baseUrl + 'assets/img/icons/trash-can-with-cover-svgrepo-com-white.svg"></button></td>';
                }
            }
        ],
        "order": [[ 1, "asc" ]],
        scrollY:        200,
        paging:         false,
        fixedHeader:    true,
        info:           false,
        columnDefs: [
            { "orderable": false, "targets": [3,4] },
            { "visible": false, "targets": 0 }
        ],
        dom:
            "<'row'<'col-sm'<'table-title-models'>>fB>" +
			"<'row'<'col-sm'tr>>",
        buttons: [
            {
                text: "Add Model",
                action: function (e, dt, node, config) {
                    // loadManufacturers("model-manufacturer");
                },
                init: function (api, node, config) {
                    $(node).removeClass('btn-secondary');
                    $(node).addClass("add-edit-button");
                    $(node).attr("data-toggle", "modal");
                    $(node).attr("data-url", "Models/add");
                    $(node).attr("data-id", "add-edit-model");
                    $(node).attr("data-type", "POST");
                    $(node).attr("data-tableid", "models");
                    $(node).attr("data-target", "#add-edit-model");
                },
                className: 'btn-primary'
            }
        ],
        language: {
            search: "",
            searchPlaceholder: "Search..."
        }
    });
    $("div.table-title-models").html('<h5 class="pt-3">Models</h5>');
    $("#models_wrapper").addClass("mb-4", "pt-2");
});

/* *** ************************** *** */

$(document).on("click", ".table-icon, .add-edit-button", function () {
    var url = $(this).data('url');
    var id = $(this).data('id');
    var type = $(this).data('type');
    var tableId = $(this).data('tableid');

    console.log(url + "" + id +  " " + type + " " + tableId);

    // var originalTitle = appendModalContent("#modal-title" + "-" + id, title);
    // var originalBody = appendModalContent("#modal-body" + "-" + id, title + "?");
    if (type == "DELETE") {
        $("#modal-confirm" + "-" + id).click(async function(e) {
            $.ajax({
                type: type,
                url: baseUrl + url,
                success: function(result) {
                },
                error: function(result) {
                    console.log(result);
                }
            });
            $("#" + tableId).DataTable().ajax.reload();
        });
    } else if (type == "POST") {
        if (tableId == "asset-types") {
            $("#asset-type-add-edit-form").submit(function(e) {
                console.log( $( this ).serializeArray() );
                e.preventDefault();
            });
            // var formData = $("#asset-type-add-edit-form").serializeArray()
            // console.log(formData);
        }
    }
});

function loadManufacturers(selectId) {
    $.ajax({
        type: "GET",
        url: baseUrl + "Manufacturers/get_all_json",
        data: "{ name: name, id: id }",
        contentType: "application/json;",
        dataType: "json",
        success: function(data)
                {
                    $.each(data, function () {
                        $("#model-manufacturer").append("<option value=" + this.id + ">" + this.name + "</option>");
                    });
                },
        failure: function () {
            alert("Failed to load manufacturer");
        }
    });
}

function validateAssetTypes() {
    var name = document.forms["asset-type-add-edit-form"]["name"].value;
    var rate = document.forms["asset-type-add-edit-form"]["rate"].value;

    if (name = "") {
        $("#asset-type-add-edit-form #name").next().append("The Name field is required");
    }

    if (rate = "") {
        $("#asset-type-add-edit-form #rate").next().append("The Rate field is required");
    }
}
