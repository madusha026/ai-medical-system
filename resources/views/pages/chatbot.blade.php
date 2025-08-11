@extends('layout.app')

@section('content')
@vite('resources/css/app.css')

<!-- Include Bootstrap and Font Awesome -->
<link href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" rel="stylesheet" />
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css" />
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

<style>
    body {
        background: #f8f9fa;
    }

    a {
        color: inherit !important; 
        text-decoration: none !important;
    }

    .chat {
        margin-top: 60px;
    }

    .card {
        height: 600px;
        border-radius: 15px !important;
    }

    .msg_card_body {
        overflow-y: auto;
        flex: 1 1 auto;
        padding: 15px;
        background: #f0f0f0;
    }

    .card-header {
        background: #1e40af;;
        color: white;
    }

    .user_img,
    .user_img_msg {
        height: 50px;
        width: 50px;
        border: 1.5px solid #f5f6fa;
    }

    .img_cont,
    .img_cont_msg {
        position: relative;
        height: 50px;
        width: 50px;
    }

    .msg_cotainer,
    .msg_cotainer_send {
        max-width: 70%;
        padding: 10px;
        border-radius: 10px;
        margin: 5px;
    }

    .msg_cotainer {
        background-color: #e2e2e2;
        color: #000;
    }

    .msg_cotainer_send {
        background-color: #1e40af;
        color: #fff;
    }

    .msg_time,
    .msg_time_send {
        font-size: 10px;
        color: #808080;
        float: right;
        margin-top: 5px;
    }

    .type_msg {
        border: none;
        border-top-left-radius: 15px;
        border-bottom-left-radius: 15px;
    }

    .send_btn {
        border-top-right-radius: 15px;
        border-bottom-right-radius: 15px;
        background-color: #1e40af;
        color: white;
    }

    .chatbot-html h1, .chatbot-html h2, .chatbot-html h3 {
    font-size: 1rem;
    font-weight: bold;
    margin-top: 10px;
    }
    .chatbot-html ul, .chatbot-html ol {
        padding-left: 20px;
    }
    .chatbot-html li {
        margin-bottom: 10px;
    }
</style>

<div class="container-fluid h-100 mb-20">
    <div class="row justify-content-center h-100">
        <div class="col-md-8 col-xl-6 chat">
            <div class="card d-flex flex-column">
                <div class="card-header msg_head">
                    <div class="d-flex bd-highlight">
                        <div class="img_cont">
                            <img src="https://cdn-icons-png.flaticon.com/512/387/387569.png" class="rounded-circle user_img">
                            <span class="online_icon"></span>
                        </div>
                        <div class="user_info ms-3">
                            <span class="fw-bold">Medical Chatbot</span>
                            <p class="mb-0">Ask me anything!</p>
                        </div>
                    </div>
                </div>

                <div id="messageFormeight" class="card-body msg_card_body"></div>

                <div class="card-footer">
                    <form id="messageArea" class="input-group">
                        <input type="text" id="text" name="msg" placeholder="Type your message..." autocomplete="off" class="form-control type_msg" required />
                        <div class="input-group-append">
                            <button type="submit" id="send" class="input-group-text send_btn"><i class="fas fa-location-arrow"></i></button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Chatbot Script -->
<script>
    $(document).ready(function () {
        $("#messageArea").on("submit", function (event) {
            event.preventDefault();

            const date = new Date();
            const str_time = date.getHours().toString().padStart(2, '0') + ":" + date.getMinutes().toString().padStart(2, '0');
            const rawText = $("#text").val();

            const userHtml = `
                <div class="d-flex justify-content-end mb-4">
                    <div class="msg_cotainer_send">${rawText}<span class="msg_time_send">${str_time}</span></div>
                    <div class="img_cont_msg">
                        <img src="https://i.ibb.co/d5b84Xw/Untitled-design.png" class="rounded-circle user_img_msg">
                    </div>
                </div>`;

            $("#text").val("");
            $("#messageFormeight").append(userHtml);

            $.ajax({
                url: "http://127.0.0.1:5000/chat",
                type: "POST",
                contentType: "application/json",
                data: JSON.stringify({ message: rawText }),
                success: function (response) {
                const botHtml = `
                    <div class="d-flex justify-content-start mb-4">
                        <div class="img_cont_msg">
                            <img src="https://cdn-icons-png.flaticon.com/512/387/387569.png" class="rounded-circle user_img_msg">
                        </div>
                        <div class="msg_cotainer"><div class="chatbot-html">${response.response}</div><span class="msg_time">${str_time}</span></div>
                    </div>`;
                $("#messageFormeight").append(botHtml);
                $('#messageFormeight').scrollTop($('#messageFormeight')[0].scrollHeight);
                },
            });
        });
    });
</script>
@endsection
