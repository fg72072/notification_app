var main_url = $("meta[name='main-url']").attr('content');
$(document).on('submit', '.delete-form', function (e) {
    e.preventDefault();
    swal({
        title: "Are you sure?",
        text: "Once deleted, you will not be able to recover this data!",
        icon: "warning",
        buttons: true,
        dangerMode: true,
    })
        .then((willDelete) => {
            if (willDelete) {
                $.ajax({
                    url: $(this).attr('action'),
                    method: $(this).attr('method'),
                    data: new FormData(this),
                    processData: false,
                    contentType: false,
                    success: function (data) {
                        location.reload();
                        swal("Poof! Data has been deleted!", {
                            icon: "success",
                        });
                    }
                });
            }
        });
});

function getNotification() {
    // setInterval(() => {
        $.ajax({
            url: main_url + "/notification/all",
            type: 'GET',
            data: {
                type: 'friend',
            },
            success: function (res) {
                $(".new-notification").text(res.new_total)
                $(".notification-section").empty()
                $.each(res.data, function (key, obj) {
                    $(".notification-section").append(`
                    <div class="text-reset notification-item d-block dropdown-item position-relative ${obj.read_by == null ? 'unread-message' : ''}">
                    <div class="notify-main">
                        <div class="avatar-xs me-3 notify-avatar">
                            <span class="avatar-title bg-soft-info text-info rounded-circle fs-16">
                            <img src="assets/images/users/avatar-1.jpg" alt="">
                             </span>
                        </div>
                        <div class="flex-1">
                            <a href=${main_url + (obj.type == '2' ? '/group/edit/'+obj.group.slug : '/user/edit/'+obj.user_id)} class="stretched-link">
                            <h5 class="text-muted name-text">${obj.user.name + obj.id}</h5>
                            <h6 class="mt-0 mb-2 lh-base">
                            ${obj.body}
                            </h6>
                            </a>
                            <p class="mb-0 fs-11 fw-medium text-uppercase text-muted">
                                <span><i class="mdi mdi-clock-outline"></i> 
                                ${obj.date_diff}
                                </span>
                            </p>
                        </div>
                    </div>
                </div>
                    `)
                });
            }
        });
    // }, 1000);
}

getNotification();

$(".js-example-basic-multiple").select2();

$("#profileImage").click(function(e) {
    $("#imageUpload").click();
});

function fasterPreview(uploader) {
    if (uploader.files && uploader.files[0]) {
        $('#profileImage').attr('src',
            window.URL.createObjectURL(uploader.files[0]));
    }
}

$("#imageUpload").change(function() {
    fasterPreview(this);
});