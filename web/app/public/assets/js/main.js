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

    // Toggle form
    $(".comment__button").click(() => {
        $("form[name='comment_form']").toggleClass("d-none");
    })

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
                $("form[name='comment_form']").addClass("d-none");
            }
        });
    }


    function addCommentToHtml(data) {
        $('.comments_block').html(('<div class="history__block">\n' +
            '            <div class="history__block-title"><h2>'+ data.subject +'</h2><p>'+ data.created_at +'</p></div>' +
            '        <p class="history__block-desc">'+ data.comment +'</p>\n' +
            '        <div class="history__block-info">\n' +
            '            <p class="author__name">'+ data.name +'</p>\n' +
            '            <p class="author__email">'+ data.email +'</p>\n' +
            '        </div>\n' +
            '    </div>') + $('.comments_block').html());
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
