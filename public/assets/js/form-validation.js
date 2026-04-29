// npm package: jquery-validation
// github link: https://github.com/jquery-validation/jquery-validation

$(function () {
    "use strict";

    $(function () {
        // Add a custom validation method
        $.validator.addMethod("daterange", function (value, element) {
            // Regular expression to match "Y-m-d to Y-m-d"
            var regex = /^\d{4}-\d{2}-\d{2} to \d{4}-\d{2}-\d{2}$/;
            if (!regex.test(value)) {
                return false;
            }
            // Split the dates and validate each date format
            var dates = value.split(' to ');
            for (var i = 0; i < dates.length; i++) {
                if (!moment(dates[i], "YYYY-MM-DD", true).isValid()) {
                    return false;
                }
            }
            return true;
        }, "Please enter a valid date range for tenure in the format 'YYYY-MM-DD to YYYY-MM-DD'.");

        // validate  form on keyup and submit
        $("#signupForm").validate({
            rules: {
                first_name: {
                    required: true,
                },
                last_name: {
                    required: true,
                },
                from: {
                    required: true,
                },
                to: {
                    required: true,
                },
                fixed_deduction: {
                    required: true,
                },
                deduction_percentage: {
                    required: true,
                },
                religion: {
                    required: true,
                },
                father_name: {
                    required: true,
                },
                mother_name: {
                    required: true,
                },
                joining_date: {
                    required: true,
                },
                type: {
                    required: true,
                },
                short_bio: {
                    required: true,
                },
                salary: {
                    required: true,
                },
                salary_type: {
                    required: true,
                },
                name: {
                    required: true,
                },
                class_id: {
                    required: true,
                },
                code: {
                    required: true,
                },
                subject_type: {
                    required: true,
                },
                expense_type: {
                    required: true,
                },
                section: {
                    required: true,
                },
                class: {
                    required: true,
                },
                roll_no: {
                    required: true,
                },
                section: {
                    required: true,
                },
                time: {
                    required: true,
                },
                parents: {
                    required: true,
                },
                address: {
                    required: true,
                },
                age_select: {
                    required: true,
                },
                date_of_birth: {
                    required: true,
                },
                user_type: {
                    required: true,
                },
                phone: {
                    required: true,
                },
                gender: {
                    required: true,
                },
                skill_check: {
                    required: true,
                },
                password: {
                    required: true,
                    minlength: 5,
                },
                exam_name: {
                    required: true,
                },
                fee_type: {
                    required: true,
                },
                fee_amount: {
                    required: true,
                },
                school_id:{
  required: true
                },
                fee: {
                    required: true,
                },
                amount: {
                    required: true,
                },
                start_date: {
                    required: true,
                },
                date: {
                    required: true,
                },
                // student_id: {
                //     required: true,
                // },
                school_name: {
                    required: true,
                },
                end_date: {
                    required: true,
                },
                teacher_id: {
                    required: true,
                },
                staff_id: {
                    required: true,
                },
                day: {
                    required: true,
                },
                fee_status: {
                    required: true,
                },
                start_time: {
                    required: true,
                },
                end_time: {
                    required: true,
                },
                subject_id: {
                    required: true,
                },

                role_id: {
                    required: true,
                },
                admission_date: {
                    required: true,
                },
                off_days: {
                    required: true,
                },
                fee_type_id: {
                    required: true,
                },
                paid_date: {
                    required: true,
                },
                reason: {
                    required: true,
                },
                confirm_password: {
                    required: true,
                    minlength: 5,
                    equalTo: "#password",
                },
                terms_agree: {
                    required: true,
                },
                tenure: {
                    required: true,
                    daterange: true
                },
                guardian: {
                    required: true,
                },
                b_form_no: {
                    required: true,
                },
                batch: {
                    required: true,
                },
                // section_id: {
                //     required: true,
                // },
                province_id: {
                    required: true,
                },
                district_id: {
                    required: true,
                },
                city: {
                    required: true,
                },
                month: {
                    required: true,
                },
                cnic: {
                    required: true,
                },
                marital_status: {
                    required: true,
                },
                nationality: {
                    required: true,
                },
                domicile_city: {
                    required: true,
                },
                blood_group: {
                    required: true,
                },
                highest_degree: {
                    required: true,
                },
                recent_job_title: {
                    required: true,
                },
                fee_type_name: {
                    required: true,
                },
                total_experience_years: {
                    required: true,
                },
                'subject_id[]': {
                    required: true,
                },
                'offdays[]': {
                    required: true
                },
                'time[]': {
                    required: true
                },
                'class_id[]': {
                    required: true
                },
                'section_id[]': {
                    required: true
                },
                'fee_type_id[]': {
                    required: true
                },
                'amount[]': {
                    required: true
                },
                'day[]':{
                   required: true  
                },
                school_registration_number: {
                    required: true,
                },
                email:{
                     required: true,
                }

            },
            messages: {

                first_name: "Please Enter The  First Name",
                last_name: "Please Enter the  Last Name",
                from: "Please Enter The Annual income from",
                to: "Please Enter The  Annual Income To",
                fixed_deduction: "Please Enter The Fixed Deduction",
                deduction_percentage: "Please Enter The Annual Income Deduction Percentage",
                religion: "Please Enter The Religion",
                father_name: "Please Enter the  Father Name",
                mother_name: "Please Enter The Mother Name",
                joining_date: "Please Select The Joining Date",
                type: "Please Select The  Leave Type",
                short_bio: "Please Enter The Short Bio",
                salary: "Please Enter The Salary",
                salary_type: "Please Select The Salary Type",
                name: "Please Enter The Name",
                school_name: "Please Enter The School Name",
                email: "Please Enter a valid Email Address",
                expense_type: "Please Select The Expense Type",
                // student_id: "Please Select The Student",
                staff_id: "Please Select The Staff",
                fee_amount: "Please Enter Fee Amount",
                amount: "Please Enter Amount",
                fee_type: "Please Enter Fee Type",
                start_time: "Please Select Start Time",
                month: "Please Select The Month",
                time: "Please Select  Session",
                exam_name: "Please Enter The Exam Name",
                end_time: "Please Select The End Time",
                teacher_id: "Please Select The Teacher Name",
                start_date: "Please Select Start Date",
                end_date: "Please Select The End Date",
                date: "Please Select The  Date",
                subject_id: "Please Select The Subject Name",
                subject_type: "Please Select Subject Type",
                fee_status: "Please Select The Fee Status",
                day: "Please a Day",
                class_id: "Please Select The Class Name",
                fee: "Please Enter The Fee Amount",
                reason: "Please Enter The Reason ",
                class: "Please Enter The  Class Name",
                role_id: "Please Select The  Role",
                section: "Please Select The Section",
                parents: "Please Enter The Parents Name",
                school_id:"Please Select The School",
                address: "Please Enter The Address",
                phone: "Please Enter a Valid Phone Number",
                age_select: "Please Select The Age",
                date_of_birth: "Please Select The Date oF Birth",
                admission_date: "Please The Select Admission Date",
                fee_type_id: "Please The Select Fee Type",
                paid_date: "Please Select The Paid Date",
                off_days: "Please Select The Off Days",
                skill_check: "Please Select The Skills",
                gender: "Please Select The Gender",
                fee_type_name:"Please Enter The Fee Type Name",
                password: {
                    required: "Please Provide a Password",
                    minlength:
                        "Your Password Must Be At Least 5 Characters Long",
                },
                confirm_password: {
                    required: "Please Confirm The Password",
                    minlength:
                        "Your Password Must Be At Least 5 Characters Long",
                    equalTo: "Please Enter The Same Password As Above",
                },
                terms_agree: "Please Agree To Terms Tnd Conditions",
                user_type: "User Type Is Required",
                tenure: {
                    required: "Please Select The tenure",
                    daterange: "Please Enter a Valid Date Range For Tenure In The Format 'YYYY-MM-DD to YYYY-MM-DD'."
                },
                guardian: "Please Enter The  Guardian Name",
                b_form_no: "Please Enter The B-Form / Smart Card No",
                batch: "Please Select The Batch",
                // section_id: "Please Select The Section",
                province_id: "Please Select The Province",
                district_id: "Please Select The District",
                city: "Please Enter The  City Name",
                cnic: "Please Enter The Cnic",
                marital_status: "Please Select The Marital Status",
                nationality: "Please Enter The  Nationality",
                domicile_city: "Please Enter The  Domicile City",
                blood_group: "Please Enter The  Blood Group",
                highest_degree: "Please Enter The  Highest Degree",
                recent_job_title: "Please Enter The  Recent Job Title",
                total_experience_years: "Please Enter The  Total Experience Years",
                school_registration_number: "Please Enter School Registration Number",

                'day[]': {
                    required: "Please Select The Days"
                },

                'offdays[]': {
                    required: "Please Select The Days"
                },
                'subject_id[]': {
                    required: "Please Select The Subject"
                },
                'time[]': {
                    required: "Please Select The Session"
                },
                'class_id[]': {
                    required: "Please Select The Class"
                },
                'section_id[]': {
                    required: "Please Select The Section"
                },
                'fee_type_id[]': {
                    required: "Please Select The Fee Type"
                },
                'fee_type_id[]': {
                    required: "Please Select The Fee Type"
                },

                'amount[]': "Please Enter The Amount",
            },
            errorPlacement: function (error, element) {
                error.addClass("invalid-feedback");

                // ✅ Custom logic for phone input
                if (element.attr("name") === "phone") {
                    // Place error after the border wrapper (below the full phone input group)
                    error.insertAfter(element.closest('.phone-wrapper').find('.border'));
                } else if (element.parent(".input-group").length) {
                    error.insertAfter(element.parent());
                } else if (
                    element.prop("type") === "radio" &&
                    element.parent(".radio-inline").length
                ) {
                    error.insertAfter(element.parent().parent());
                } else if (
                    element.prop("type") === "checkbox" ||
                    element.prop("type") === "radio"
                ) {
                    error.appendTo(element.parent().parent());
                } else if (element.hasClass("select2-hidden-accessible")) {
                    error.insertAfter(element.next(".select2-container"));
                } else {
                    error.insertAfter(element);
                }
            },

        });
    });

});

