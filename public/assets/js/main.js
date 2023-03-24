$(function () {
    // Get CommentsData
    $.get("/api/comment/get", function ({data}, status) {
        $.each(data, function (idx, value) {
            addCommentToHtml({
                name: value.name,
                email: value.email,
                subject: value.subject,
                comment: value.comment,
                created_at: value.created_at,
            })
        })
    });

    // Validate Form Data
    $("form[name='comment_form']").validate({
        rules: {
            name: "required",
            subject: "required",
            email: {
                required: true,
                email: true
            },
            comment: {
                required: true,
                minlength: 5
            }
        },
        messages: {
            name: "Please enter your name",
            subject: "Please enter the subject",
            comment: {
                required: "Please write comment",
                minlength: "Comment must be at least 5 characters long"
            },
            email: "Please enter a valid email address"
        },
        submitHandler: function (form, event) {
            event.preventDefault();
            saveComment();
        }
    });

    // Save Comment
    function saveComment() {
        const formValues = {
            name: $("form[name='comment_form'] input[name='name']").val(),
            email: $("form[name='comment_form'] input[name='email']").val(),
            subject: $("form[name='comment_form'] input[name='subject']").val(),
            comment: $("form[name='comment_form'] textarea[name='comment']").val(),
        };
        $.post({
            url: "/api/comment/save",
            data: formValues,
            dataType: "json",
            encode: true,
        }).done(function ({data}) {
            if (data) {
                addCommentToHtml({...formValues, created_at: getFormattedDate(new Date())})
            }
        }).catch(() => {
            setTimeout(function () {
                $('#form_error').toggleClass("d-none");
            }, 2000);
        });
    }

    function addCommentToHtml(data) {
        console.log(data);
        $('.comments').append(("<div class='comment'>"+data.name+"</div>"));
    }

    function getFormattedDate(date) {
        const today = new Date(date);
        const dd = String(today.getDate()).padStart(2, '0');
        const mm = String(today.getMonth() + 1).padStart(2, '0'); //January is 0!
        const yyyy = today.getFullYear();
        const time = today.getHours() + ':' + today.getMinutes();
        return  `${mm}-${dd}-${yyyy} ${time}`
    }
});
