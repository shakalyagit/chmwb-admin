$(document).ready(function () {

    // add patient master form
    document.addEventListener("DOMContentLoaded", function () {
        $('#add_patient_form').on('submit', function (e) {
            e.preventDefault();
            if ($('#add_patient_form').valid()) {
                Livewire.emit('submit');
            }
        });

        $('#add_patient_form').validate({
            rules: {
                token_id: "required",
                year: {
                    required: true,
                    digits: 4
                },
                name: "required"
            },
            messages: {
                token_id: "Please enter Token ID",
                year: {
                    required: "Enter year",
                    digits: "Enter 4 digit year"
                },
                name: "Please enter name"
            }
        });
    });



    $('.complaint_person_name').on('keyup', function (param) {
        param.preventDefault();
        var input_value = $(this).val();
        if (input_value.length > 2) {
            $.ajax({
                data: {
                    'complaint': input_value
                },
                url: 'complaint_person_name',
                success: function (responce) {
                    $('#complaint_filter_list').show();
                    $('#complaint_filter_list').html(responce.data);
                    $(document).on('click', 'a[class^="get_complaint_"]', function (e) {
                        e.preventDefault();
                        var dataId = $(this).data('id');
                        var data_name = $(this).data('name');
                        $('input.complaint_person_name').val(data_name);
                        $('input.employee_name_input').val(dataId);
                        $('input.employee_name_input').attr('value', dataId);
                        $('#complaint_filter_list').hide();
                    });
                },
            });
        } else {
            // $('input.employees_filter_input').removeAttr('data-id');
        }
    });

    $('#complaint_filter').on('submit', function (e) {
        e.preventDefault();
        var complaint_filter_data = $(this).serialize();
        $('#overlay').show();

        $.ajax({
            url: '/complaint_filter',
            data: complaint_filter_data,
            success: function (response) {
                $('.complaint_table_list').html(response.data);
                $('.dataTables_info').text('Showing ' + response.count + ' of ' + response.count + ' entries');
                $('.data-table').removeAttr('data-datatables');
                $('.data-table').attr('data-datatables', '{"paging":false,"scrollY":"400px","searching":false,"scrollCollapse":true,"scrollX":true, "ordering": false}')
                // $('table').DataTable({
                //     searching: true
                // });
                $('#overlay').hide();
            },
            error: function (xhr, status, error) {
                console.error('An error occurred:', error);
                $('#overlay').hide();
            }
        });
    });

    $('input[name=start_date]').on('change', function (e) {
        e.preventDefault();
        var start_date = $(this).val();
        var today = new Date();
        var day = String(today.getDate()).padStart(2, '0');
        var month = String(today.getMonth() + 1).padStart(2, '0');
        var year = today.getFullYear();
        var formattedDate = year + '-' + month + '-' + day;
        $('input[name=end_date]').val(start_date);
        $('input[name=end_date]').attr('max', formattedDate);
        $('input[name=end_date]').attr('min', start_date);
    });

    //File type file
    let fileStore = new DataTransfer();
    $('#files').on('change', function (event) {
        const input = this;
        const newFiles = input.files;

        for (let i = 0; i < newFiles.length; i++) {
            fileStore.items.add(newFiles[i]);
        }

        input.files = fileStore.files;

        $.each(newFiles, function (index, file) {
            const fileContainer = $('<div class="file-container pt-3 pb-3" style="border-bottom:1px solid #d9dada;display:flex;"></div>');
            const fileName = $('<p class="file-name col-md-8" style="margin-left:15px;"></p>').text(file.name);
            const removeButton = $('<button type="button">&times;</button>');

            removeButton.on('click', function () {
                const dt = new DataTransfer();
                for (let i = 0; i < fileStore.files.length; i++) {
                    if (fileStore.files[i].name !== file.name) {
                        dt.items.add(fileStore.files[i]);
                    }
                }
                fileStore = dt;
                input.files = fileStore.files;
                fileContainer.remove();
            });

            const defaultImage = '/assets/img/generic/image-file-2.png';
            if (file.type.match('image.*')) {
                const reader = new FileReader();
                reader.onload = function (e) {
                    const img = $('<img style="height:40px;">').attr('src', e.target.result);
                    fileContainer.append(img).append(fileName).append(removeButton);
                    $('#file-preview').append(fileContainer);
                };
                reader.readAsDataURL(file);
            } else {
                const img = $('<img style="height:40px;">').attr('src', defaultImage);
                fileContainer.append(img).append(fileName).append(removeButton);
                $('#file-preview').append(fileContainer);
            }
        });
    });

    //Validate risk form
    $('#add_risk_form').validate({
        ignore: [],
        rules: {
            financial_year: {
                required: true
            },
            division_id: {
                required: true
            },
            risk_owner_id: {
                required: true
            },
            entity: {
                required: true
            },
            sub_entity: {
                required: true
            },
            process: {
                required: true
            },
            sub_process: {
                required: true
            },
            strategic_id: {
                required: true
            },
            risk_type: {
                required: true
            },
            risk_sub_type: {
                required: true
            },
            probability: {
                required: true
            },
            impact_id: {
                required: true
            },
            risk_statement: {
                required: true
            }
        },
        messages: {
            financial_year: {
                required: "Financial year is required.",
            },
            division_id: {
                required: "Division is required.",
            },
            risk_owner_id: {
                required: "Risk owner is required.",
            },
            entity: {
                required: "Entity is required.",
            },
            sub_entity: {
                required: "Sub entity is required.",
            },
            process: {
                required: "Process is required.",
            },
            sub_process: {
                required: "Sub process is required.",
            },
            strategic_id: {
                required: "Strategic Id is required.",
            },
            risk_type: {
                required: "Risk type is required.",
            },
            risk_sub_type: {
                required: "Risk sub type is required.",
            },
            probability: {
                required: "Likelihood is required.",
            },
            impact_id: {
                required: "Impact is required.",
            },
            risk_statement: {
                required: "Risk statement is required.",
            }
        },
        errorPlacement: function (error, element) {
            if (element.attr("id") == "risk_statement") {
                error.insertAfter(tinymce.get("risk_statement").getContainer());
            } else {
                error.insertAfter(element);
            }
        },
        submitHandler: function (form) {
            form.submit();
        }
    });

    //Validate kri form
    $('#add_kri_form').validate({
        ignore: [],
        rules: {
            risk_id: {
                required: true
            },
            kri_type_id: {
                required: true
            },
            kri_assessment_frequency_id: {
                required: true
            },
            kri_unit_of_measurement: {
                required: true,
                number: true,
                maxlength: 3,
                max: 100
            },
            kri_upper_thresold: {
                required: true,
                number: true,
                maxlength: 3,
                max: 100
            },
            kri_lower_thresold: {
                required: true,
                number: true,
                maxlength: 3,
                max: 100
            },
            breach_thresold: {
                required: true,
                number: true,
                maxlength: 3,
                max: 100
            },
            kri_computation_data_source: {
                required: true
            },
            thresold_parameter_category_id: {
                required: true
            },
            thresold_parameter: {
                required: true
            },
            kri_statement: {
                required: true
            }
        },
        messages: {
            risk_id: {
                required: "Risk Id is required.",
            },
            kri_type_id: {
                required: "KRI type is required.",
            },
            kri_assessment_frequency_id: {
                required: "KRI assessment frequency is required.",
            },
            kri_unit_of_measurement: {
                required: "KRI unit of measurement is required.",
            },
            kri_upper_thresold: {
                required: "KRI upper threshold is required.",
            },
            kri_lower_thresold: {
                required: "KRI lower threshold is required.",
            },
            breach_thresold: {
                required: "KRI breach threshold is required.",
            },
            kri_computation_data_source: {
                required: "KRI computation data source is required.",
            },
            thresold_parameter_category_id: {
                required: "Threshold parameter category is required.",
            },
            thresold_parameter: {
                required: "Threshold parameter is required.",
            },
            kri_statement: {
                required: "KRI statement is required.",
            }
        },
        errorPlacement: function (error, element) {
            if (element.attr("id") == "kri_statement") {
                error.insertAfter(tinymce.get("kri_statement").getContainer());
            } else {
                error.insertAfter(element);
            }
        },
        submitHandler: function (form) {
            form.submit();
        }
    });

    //Validate user form
    $.validator.addMethod("strong_password", function (value, element) {
        return this.optional(element) || /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[\W_]).{8,15}$/.test(value);
    }, "Password must be 8-15 characters and include uppercase, lowercase, number, and special character.");

    $('#add_user_form').validate({
        ignore: [],
        rules: {
            name: {
                required: true
            },
            email: {
                required: true,
                email: true,
            },
            password: {
                required: true,
                strong_password: true,
            },
            role_id: {
                required: true,
            },
            division_id: {
                required: true,
            },
        },
        messages: {
            name: {
                required: "Name is required.",
            },
            email: {
                required: "Email is required.",
            },
            password: {
                required: "Password is required.",
            },
            role_id: {
                required: "Role is required.",
            },
            division_id: {
                required: "Division is required.",
            }
        },
        submitHandler: function (form) {
            form.submit();
        }
    });

    $('#add_division_form').validate({
        ignore: [],
        rules: {
            division_name: {
                required: true
            }
        },
        messages: {
            division_name: {
                required: "Division name is required.",
            }
        },
        submitHandler: function (form) {
            form.submit();
        }
    });

    $('#risk_register_status_update_form').validate({
        ignore: [],
        rules: {
            probability: {
                required: true
            },
            impact: {
                required: true
            },
            comment: {
                required: true
            },
        },
        messages: {
            probability: {
                required: "Likelihood is required.",
            },
            impact: {
                required: "Impact is required",
            },
            comment: {
                required: "Comment is required"
            }
        },
        errorPlacement: function (error, element) {
            if (element.attr("id") == "comment") {
                error.insertAfter(tinymce.get("comment").getContainer());
            } else {
                error.insertAfter(element);
            }
        },
        submitHandler: function (form) {
            form.submit();
        }
    });

    $('#division_id').on('change', function () {
        var division_id = $(this).val();
        $('#risk_owner_id').html('<option value="">Loading...</option>');
        if (division_id) {
            $.ajax({
                url: "/get-users" + '/' + division_id,
                type: "GET",
                success: function (data) {
                    $('#risk_owner_id').empty();
                    $('#risk_owner_id').append('<option value="">Select</option>');

                    if (data.length > 0) {
                        $.each(data, function (index, user) {
                            $('#risk_owner_id').append('<option value="' + user.id + '">' + user.name + '</option>');
                        });
                    } else {
                        $('#risk_owner_id').append('<option value="">No users found</option>');
                    }
                }
            });
        } else {
            $('#risk_owner_id').empty();
            $('#risk_owner_id').append('<option value="">Select</option>');
        }
    });

    $('.close_model').on('click', function () {
        $('.modal').modal('hide');
    })
});
