// create admin
$(".create-admin-data").on("click", function() {
    $(".loader-container").addClass("hidden")
    $(".loader-container").removeClass("flex")
    $(".content").addClass("block")
    $(".content").removeClass("hidden")
    $(".footer").addClass("flex")
    $(".footer").removeClass("hidden")
})

// detail admin
$(".detail-admin-data").on("click", function() {
    $(".loader-container").addClass("flex")
    $(".loader-container").removeClass("hidden")
    $(".content").addClass("hidden")
    $(".content").removeClass("block")
    $(".footer").addClass("hidden")
    $(".footer").removeClass("flex")

    $.ajax({
        type: "GET",
        url: `/dashboard/admins/${$(this).closest('.table-body').find('.admin_id').val()}/json`,
        dataType: "json",
        success: function({admin}){
            if(admin.user.image_path != null) $("#detail_image").attr("src", `/${admin.user.image_path}`)

            $("#detail_name").val(admin.name)
            $("#detail_username").val(admin.user.username)
            $("#detail_email").val(admin.user.email)

            if(admin.user.status) {
                $("#detail_status").attr("checked", true)
            }

            $(".loader-container").addClass("hidden")
            $(".loader-container").removeClass("flex")
            $(".content").addClass("block")
            $(".content").removeClass("hidden")
            $(".footer").addClass("flex")
            $(".footer").removeClass("hidden")
        }
    })
})

// edit admin
$(".edit-admin-data").on("click", function() {
    $(".loader-container").addClass("flex")
    $(".loader-container").removeClass("hidden")
    $(".content").addClass("hidden")
    $(".content").removeClass("block")
    $(".footer").addClass("hidden")
    $(".footer").removeClass("flex")
    
    const adminID = $(this).closest('.table-body').find('.admin_id').val()

    $.ajax({
        type: "GET",
        url: `/dashboard/admins/${adminID}/json`,
        dataType: "json",
        success: function({admin}){
            if(admin.user.image_path != null) $("#edit_image").attr("src", `/${admin.user.image_path}`)

            $("#edit_form").attr('action', `/dashboard/admins/${adminID}`)
            $("#edit_name").val(admin.name)
            $("#edit_username").val(admin.user.username)
            $("#edit_email").val(admin.user.email)

            if(admin.user.status) {
                $("#edit_status").attr("checked", true)
            }

            $(".loader-container").addClass("hidden")
            $(".loader-container").removeClass("flex")
            $(".content").addClass("block")
            $(".content").removeClass("hidden")
            $(".footer").addClass("flex")
            $(".footer").removeClass("hidden")
        }
    })
})

// delete admin
$(".btn-delete-modal").attr("disabled", true)
$(".delete-admin-data").on("click", function() { 
    const admin_id = $(this).closest('.table-body').find('.admin_id').val()    
    $("#delete_admin_form").attr("action", `/dashboard/admins/${admin_id}`)

    $(".btn-delete-modal").attr("disabled", false)
})

// preview image
previewImg("create-admin-input", "create-admin-preview-img")
previewImg("edit-admin-input", "edit-admin-preview-img")