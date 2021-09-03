$(document).ready(function () {

    //SHOW CONTENT 
    $("#b-dashboard-admin").click(function () {
        $(".adminBtn").not(this).removeClass("active-admin-tab");
        $(this).addClass("active-admin-tab");
        $(".adminCon").not("#admin-dashboard-content").hide();
        $("#admin-dashboard-content").show();
    })


    $("#b-users").click(function () {
        $(".adminBtn").not(this).removeClass("active-admin-tab");
        $(this).addClass("active-admin-tab");
        $(".adminCon").not("#users-content").hide();
        $("#users-content").show();
        clearUsers();
        showUsers();
    })

    $("#b-products").click(function () {
        $(".adminBtn").not(this).removeClass("active-admin-tab");
        $(this).addClass("active-admin-tab");
        $(".adminCon").not("#products-content").hide();
        $("#products-content").show();
        clearProducts();
        showProducts();
    })

    $("#b-reviews").click(function () {
        $(".adminBtn").not(this).removeClass("active-admin-tab");
        $(this).addClass("active-admin-tab");
        $(".adminCon").not("#reviews-content").hide();
        $("#reviews-content").show();
        clearReviews();
        showReviews();
    })

    $("#b-messages").click(function () {
        $(".adminBtn").not(this).removeClass("active-admin-tab");
        $(this).addClass("active-admin-tab");
        $(".adminCon").not("#messages-content").hide();
        $("#messages-content").show();
        clearMessages();
        showMessages();
    })

    $("#b-purchases").click(function () {
        $(".adminBtn").not(this).removeClass("active-admin-tab");
        $(this).addClass("active-admin-tab");
        $(".adminCon").not("#purchases-content").hide();
        $("#purchases-content").show();
    })

    $("#b-poll").click(function () {
        $(".adminBtn").not(this).removeClass("active-admin-tab");
        $(this).addClass("active-admin-tab");
        $(".adminCon").not("#poll-content").hide();
        $("#poll-content").show();
        showPoll();
    })


    /////////////////////////////////////////////////

    //////////////////MANAGE USERS//////////////////

    //ADD NEW USER
    $("#admSave").click(function () {
        let admId = $("#admId").val();
        let admName = $("#admName").val();
        let admLastname = $("#admLastname").val();
        let admUsername = $("#admUsername").val();
        let admEmail = $("#admEmail").val();
        let admPhone = $("#admPhone").val();
        let admAddress = $("#admAddress").val();
        let admRole = $("#admRole").val();

        if (admId == "") //then it is insert
        {
            $.post("php/admin-php.php?insertUser", {
                admName: admName,
                admLastname: admLastname,
                admUsername: admUsername,
                admEmail: admEmail,
                admPhone: admPhone,
                admAddress: admAddress,
                admRole: admRole
            }, function (response) {

                let jsonResp = JSON.parse(response);
                let admUsersMessage = $("#admUsersMessage");
                if (jsonResp.fail) admUsersMessage.html(jsonResp.fail);
                else admUsersMessage.html(jsonResp.pass);
            })
            clearUsers();
            showUsers();
        }
        //UPDATE EXISTING USER
        else //then it is update
        {
            $.post("php/admin-php.php?updateUser", {
                admId: admId,
                admName: admName,
                admLastname: admLastname,
                admUsername: admUsername,
                admEmail: admEmail,
                admPhone: admPhone,
                admAddress: admAddress,
                admRole: admRole
            }, function (response) {
                let jsonResp2 = JSON.parse(response);
                let admUsersMessage = $("#admUsersMessage");
                if (jsonResp2.fail) admUsersMessage.html(jsonResp2.fail);
                else admUsersMessage.html(jsonResp2.pass);
            })
            clearUsers();
            showUsers();
        }

    })


    //DELETE SELECTED USER

    $("#admDelete").click(function () {
        let admId = $("#admId").val();
        let admUsersMessage = $("#admUsersMessage");

        if (admId != "") {

            $.post("php/admin-php.php?deleteUser", {
                admId: admId
            }, function (response) {
                let jsonResp = JSON.parse(response);

                if (jsonResp.fail) admUsersMessage.html(jsonResp.fail);
                else admUsersMessage.html(jsonResp.pass);
            })
            clearUsers();
            showUsers();

        } else admUsersMessage.html("You did not choose user!");
    })


    //CLEAR FIELDS
    $("#admClear").click(function () {
        clearUsers();
        showUsers();
    })


    //FUNCTION TO SHOW ALL EXISTING USERS
    function showUsers() {
        $.post("php/admin-php.php?b-users", function (response) {
            let jsonResp = JSON.parse(response);

            for (element of jsonResp.data) {
                $("#all-users").append("<option value='" + element.user_id + "' data-admName='" + element.user_firstname + "' data-admLastname='" + element.user_lastname + "' data-admUsername='" + element.user_username + "' data-admEmail='" + element.user_email + "' data-admPassword='" + element.user_password + "' data-admPhone='" + element.user_phone + "' data-admAddress='" + element.user_address + "' data-admRole='" + element.user_role + "'>" + element.user_firstname + " " + element.user_lastname + "<br></option>");

                //putting user information in input fields
                $("#all-users").change(function () {
                    $("#admId").val($(this).val());
                    $("#admName").val($(this).find(':selected').attr('data-admName'));
                    $("#admLastname").val($(this).find(':selected').attr('data-admLastname'));
                    $("#admUsername").val($(this).find(':selected').attr('data-admUsername'));
                    $("#admEmail").val($(this).find(':selected').attr('data-admEmail'));
                    $("#admPassword").val($(this).find(':selected').attr('data-admPassword'));
                    $("#admPhone").val($(this).find(':selected').attr('data-admPhone'));
                    $("#admAddress").val($(this).find(':selected').attr('data-admAddress'));
                    $("#admRole").val($(this).find(':selected').attr('data-admRole'));
                    $("#admEmail").attr("disabled", "disabled");
                    $("#admUsersMessage").empty(); //to delete message with every new select
                })

            }
        })
    }


    //FUNCTION TO CLEAR FIELDS AND SELECT BARS
    function clearUsers() {
        $("#all-users option:not(:first)").remove();
        $("input").val("");
        $("#admRole").val("0");
        $("#admEmail").removeAttr("disabled");
        $("#admUsersMessage").html("");
    }


    //////////////////MANAGE PRODUCTS//////////////////

    //ADD NEW PRODUCT
    $("#prodSave").click(function () {
        let prodId = $("#prodId").val();


        if (prodId == "") //then it is insert new
        {

            $.ajax({
                url: "php/admin-php.php?insertProduct",
                type: "POST",
                data: new FormData(document.getElementById('product-form')),
                contentType: false,
                cache: false,
                processData: false,
                success: function (response) {
                    let jsonRespProd = JSON.parse(response);
                    let prodMessage = $("#prodMessage");
                    if (jsonRespProd.fail) prodMessage.html(jsonRespProd.fail);
                    else prodMessage.html(jsonRespProd.pass);

                }
            })
            clearProducts();
            showProducts();

        }
        //UPDATE EXISTING PRODUCT
        else //then it is update
        {
            $.ajax({
                url: "php/admin-php.php?updateProduct",
                type: "POST",
                data: new FormData(document.getElementById('product-form')),
                contentType: false,
                cache: false,
                processData: false,
                success: function (response) {
                    let jsonResp = JSON.parse(response);
                    let prodMessage = $("#prodMessage");
                    if (jsonResp.fail) prodMessage.html(jsonResp.fail);
                    else prodMessage.html(jsonResp.pass);

                }
            })
            clearProducts();
            showProducts();

        }
    })


    //DELETE PRODUCT - amend only product_size -(size and qty)
    $("#prodDelete").click(function () {
        let prodId = $("#prodId").val();
        let prodMessage = $("#prodMessage");


        if (prodId != 0) {
            $.ajax({
                url: "php/admin-php.php?deleteProduct",
                type: "POST",
                data: new FormData(document.getElementById('product-form')),
                contentType: false,
                processData: false,
                success: function (response) {
                    let jsonRespProd = JSON.parse(response);
                    let prodMessage = $("#prodMessage");
                    if (jsonRespProd.fail) prodMessage.html(jsonRespProd.fail);
                    else prodMessage.html(jsonRespProd.pass);
                    clearProducts();
                    showProducts();
                    $("#prodSizeId").removeAttr("readonly");
                }
            })

        } else prodMessage.html("You did not choose product to delete!");

    })

    //DELETE PRODUCT - ALL SIZES - EMPTY product_size(size and qty) and set unactive product

    $("#prodDeleteAllSizes").click(function () {
        let prodId = $("#prodId").val();
        let prodMessage = $("#prodMessage");


        if (prodId != 0) {
            $.ajax({
                url: "php/admin-php.php?prodDeleteAllSizes",
                type: "POST",
                data: new FormData(document.getElementById('product-form')),
                contentType: false,
                processData: false,
                success: function (response) {
                    let jsonRespProd = JSON.parse(response);
                    let prodMessage = $("#prodMessage");
                    if (jsonRespProd.fail) prodMessage.html(jsonRespProd.fail);
                    else prodMessage.html(jsonRespProd.pass);
                }
            })
            clearProducts();
            showProducts();
            $("#prodSizeId").removeAttr("readonly");


        } else prodMessage.html("You did not choose product to delete!");

    })



    //CLEAR INPUT FIELDS PRODUCTS
    $("#prodClear").click(function () {
        clearProducts();
        showProducts();
    })



    //FUNCTION TO SHOW ALL EXISTING PRODUCTS
    function showProducts() {
        $.post("php/admin-php.php?b-products", function (response) {
            let jsonResp = JSON.parse(response);

            for (element of jsonResp.data) {
                $("#all-products").append("<option value='" + element.product_id + " 'data-prodSizeId='" + element.size_id + "' data-prodName='" + element.product_name + "' data-prodPrice='" + element.product_price + "' data-prodDescr='" + element.product_description + "' data-prodColor='" + element.product_color + "' data-prodMaterial='" + element.product_material + "'data-prodCare='" + element.product_care + "' data-prodOrigin='" + element.product_origin + "' data-prodCategory='" + element.category_id + "' data-prodQty='" + element.quantity + "'>" + element.product_id + ". " + element.product_name + " (" + element.size_name + ")<br></option>");

                //putting user information in input fields
                $("#all-products").change(function () {
                    $("#prodId").val($(this).val());
                    $("#prodSizeId").val($(this).find(':selected').attr('data-prodSizeId'));
                    $("#prodName").val($(this).find(':selected').attr('data-prodName'));
                    $("#prodPrice").val($(this).find(':selected').attr('data-prodPrice'));
                    $("#prodDescr").val($(this).find(':selected').attr('data-prodDescr'));
                    $("#prodColor").val($(this).find(':selected').attr('data-prodColor'));
                    $("#prodMaterial").val($(this).find(':selected').attr('data-prodMaterial'));
                    $("#prodCare").val($(this).find(':selected').attr('data-prodCare'));
                    $("#prodOrigin").val($(this).find(':selected').attr('data-prodOrigin'));
                    $("#prodCategory").val($(this).find(':selected').attr('data-prodCategory'));
                    $("#prodQty").val($(this).find(':selected').attr('data-prodQty'));
                    $("#prodMessage").empty(); //to delete message with every new select

                })

            }
        })
    }


    //FUNCTION TO CLEAR FIELDS AND SELECT BARS
    function clearProducts() {
        $("#all-products option:not(:first)").remove();
        $("input").val("");
        $("#prodDescr").val(""); //textarea
        $("#prodCategory").val("0");
        $("#prodMessage").html("");
    }



    //////////////////MANAGE REVIEWS//////////////////

    //MANAGE REVIEWS 

    //ON CLICK REJECT SELECTED REVIEW

    $("#reject").click(function () {
        let adm_review_id = $("#all-reviews").val();
        approveMess = $("#approve-message");

        if (adm_review_id != 0) {
            $.post("php/admin-php.php?reject", {
                adm_review_id: adm_review_id
            }, function (response) {

                let jsonResp = JSON.parse(response);

                if (jsonResp.fail) approveMess.html(jsonResp.fail);
                else {
                    clearReviews();
                    showReviews();
                    approveMess.html(jsonResp.pass).css({
                        "color": "green",
                        "font-weight": "bold"
                    });
                }
            })
        } else approveMess.html("You must choose review!");
    })



    //ON CLICK APPROVE SELECTED REVIEW
    $("#approve").click(function () {
        approveMess = $("#approve-message");
        let adm_review_id = $("#all-reviews").val();

        if (adm_review_id != 0) {

            $.post("php/admin-php.php?approve", {
                adm_review_id: adm_review_id
            }, function (response) {

                let jsonResp = JSON.parse(response);

                if (jsonResp.fail) approveMess.html(jsonResp.fail);
                else {
                    clearReviews();
                    showReviews();
                    approveMess.html(jsonResp.pass).css({
                        "color": "green",
                        "font-weight": "bold"
                    });
                }
            })
        } else approveMess.html("You must choose review!");

    })



    //FUNCTION TO SHOW ALL UNSORTED REVIEWS
    function showReviews() {

        $.post("php/admin-php.php?b-reviews", function (response) {
            let jsonResp = JSON.parse(response);
            let noNew = $("#no_new_message");

            if (jsonResp.data != "") {
                for (element of jsonResp.data) {

                    $("#all-reviews").append("<option value='" + element.review_id + "' data-message='" + element.review_text + "'>" + element.review_name + " [" + element.created_at + "]<br></option>");
                    $("#all-reviews").change(function () {
                        $("#review-to-approve").val($(this).find(':selected').attr('data-message'));
                    })

                }
            } else {
                $("#all-reviews").remove();
                $("#reject, #approve").remove();
                $("#review-to-approve").remove();
                $("h4").text("");
                noNew.html("No new reviews.");
            }
        })

    }

    //FUNCTION TO CLEAR SELECT OPTION
    function clearReviews() {
        $("#all-reviews option:not(:first)").remove();
        $("#review-to-approve").val("");
        $("#approve-message").html("");

    }



    //////////////////MANAGE MESSAGES//////////////////

    //SEND ANSWER TO SELECTED MESSAGE

    $("#answer").click(function () {
        let adm_mess_id = $("#all-messages").val();
        let contact_answer = $("#contact_answer").val();
        let answerMessage = $("#answerMessage");

        if (adm_mess_id != 0) {
            $.post("php/admin-php.php?answer", {
                adm_mess_id: adm_mess_id,
                contact_answer: contact_answer
            }, function (response) {


                let jsonResp = JSON.parse(response);

                if (jsonResp.fail) answerMessage.html(jsonResp.fail).css("color", "red");
                else {
                    clearMessages();
                    showMessages();
                    answerMessage.html(jsonResp.pass).css({
                        "color": "yellow",
                        "font-weight": "bold"
                    });

                }
            })
        } else answerMessage.html("You must choose message!");
    })


    //FUNCTION TO SHOW ALL UNANSWERED MESSAGES
    function showMessages() {
        $.post("php/admin-php.php?b-messages", function (response) {
            let jsonResp = JSON.parse(response);
            let noNew1 = $("#no-new-message1");

            if (jsonResp.data != "") {
                for (element of jsonResp.data) {

                    $("#all-messages").append("<option value='" + element.contact_id + "' data-message='" + element.contact_message + "'>" + element.contact_subject + " [" + element.created_at + "]<br></option>");

                    $("#all-messages").change(function () {
                        $("#message-to-answer").val($(this).find(':selected').attr('data-message'));
                    })
                }

            } else {
                $("#all-messages").remove();
                $("#answer").remove();
                $("#message-to-answer, #contact_answer").remove();
                $("h4").text("");
                noNew1.html("No new messages.");
            }
        })
    }


    //FUNCTION TO CLEAR SELECTED MESSAGE

    function clearMessages() {
        $("#all-messages option:not(:first)").remove();
        $("#message-to-answer, #contact_answer").val("");
        $("#answerMessage").html("");

    }


    //////////////////MANAGE MESSAGES//////////////////
    //show poll results
    function showPoll() {

        $.post("php/admin-poll.php?b-poll", function (response) {
            $("#poll_results").html(response);
        })
    }
})