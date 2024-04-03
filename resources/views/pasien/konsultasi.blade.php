@extends('layouts.main')

@section('content')

<div class="container-xxl flex-grow-1 container-p-y">


    <div class="app-chat overflow-hidden card">
        <div class="row g-0">
            <!-- Sidebar Left -->
            <div class="col app-chat-sidebar-left app-sidebar overflow-hidden" id="app-chat-sidebar-left">
                <div
                    class="chat-sidebar-left-user sidebar-header d-flex flex-column justify-content-center align-items-center flex-wrap p-4 mt-2">
                    <div class="avatar avatar-xl avatar-online">
                        <img src="{{asset('admin_theme')}}/assets/img/avatars/1.png" alt="Avatar"
                            class="rounded-circle">
                    </div>
                    <h5 class="mt-3 mb-1">John Doe</h5>
                    <small class="text-muted">UI/UX Designer</small>
                    <i class="bx bx-x bx-sm cursor-pointer close-sidebar me-1 fs-4 " data-bs-toggle="sidebar"
                        data-overlay="" data-target="#app-chat-sidebar-left"></i>
                </div>
                <div class="sidebar-body px-4 pb-4 ps ps--active-y">
                    <div class="my-3">
                        <span class="text-muted text-uppercase">About</span>
                        <textarea id="chat-sidebar-left-user-about"
                            class="form-control chat-sidebar-left-user-about mt-2" rows="4"
                            maxlength="120">Dessert chocolate cake lemon drops jujubes. Biscuit cupcake ice cream bear claw brownie brownie marshmallow.</textarea>
                    </div>
                    <div class="my-4">
                        <span class="text-muted text-uppercase">Status</span>
                        <div class="d-grid gap-1 mt-2">
                            <div class="form-check form-check-success">
                                <input name="chat-user-status" class="form-check-input" type="radio" value="active"
                                    id="user-active" checked="">
                                <label class="form-check-label" for="user-active">Active</label>
                            </div>
                            <div class="form-check form-check-danger">
                                <input name="chat-user-status" class="form-check-input" type="radio" value="busy"
                                    id="user-busy">
                                <label class="form-check-label" for="user-busy">Busy</label>
                            </div>
                            <div class="form-check form-check-warning">
                                <input name="chat-user-status" class="form-check-input" type="radio" value="away"
                                    id="user-away">
                                <label class="form-check-label" for="user-away">Away</label>
                            </div>
                            <div class="form-check form-check-secondary">
                                <input name="chat-user-status" class="form-check-input" type="radio" value="offline"
                                    id="user-offline">
                                <label class="form-check-label" for="user-offline">Offline</label>
                            </div>
                        </div>
                    </div>
                    <div class="my-4">
                        <span class="text-muted text-uppercase">Settings</span>
                        <ul class="list-unstyled d-grid gap-2 mt-2">
                            <li class="d-flex justify-content-between align-items-center">
                                <div>
                                    <i class="bx bx-check-circle me-1"></i>
                                    <span class="align-middle">Two-step Verification</span>
                                </div>
                                <div class="form-check form-switch mb-0">
                                    <input class="form-check-input" type="checkbox" id="twoStepVerification">
                                </div>
                            </li>
                            <li class="d-flex justify-content-between align-items-center">
                                <div>
                                    <i class="bx bx-bell me-1"></i>
                                    <span class="align-middle">Notification</span>
                                </div>
                                <div class="form-check form-switch mb-0">
                                    <input class="form-check-input" type="checkbox" id="switchNotification" checked="">
                                </div>
                            </li>
                        </ul>
                    </div>
                    <div class="d-flex mt-4">
                        <button class="btn btn-primary" data-bs-toggle="sidebar" data-overlay=""
                            data-target="#app-chat-sidebar-left">Logout</button>
                    </div>
                    <div class="ps__rail-x" style="left: 0px; bottom: 0px;">
                        <div class="ps__thumb-x" tabindex="0" style="left: 0px; width: 0px;"></div>
                    </div>
                    <div class="ps__rail-y" style="top: 0px; height: 276px; right: 0px;">
                        <div class="ps__thumb-y" tabindex="0" style="top: 0px; height: 147px;"></div>
                    </div>
                </div>
            </div>
            <!-- /Sidebar Left-->

            <!-- Chat & Contacts -->
            <div class="col app-chat-contacts app-sidebar flex-grow-0 overflow-hidden border-end"
                id="app-chat-contacts">
                <div class="sidebar-header pt-3 px-3 mx-1">
                    <div class="d-flex align-items-center me-3 me-lg-0">
                        <div class="flex-shrink-0 avatar avatar-online me-2" data-bs-toggle="sidebar"
                            data-overlay="app-overlay-ex" data-target="#app-chat-sidebar-left">
                            <img class="user-avatar rounded-circle cursor-pointer border"
                                src="{{asset('profil/'.auth()->user()->profil)}}" alt="Avatar">
                        </div>
                        <div class="chat-contact-info flex-grow-1 ms-3">
                            <h6 class="m-0">{{auth()->user()->nama}}</h6>
                            <small class="user-status text-muted">Pasien</small>
                        </div>
                    </div>
                    <i class="bx bx-x cursor-pointer position-absolute top-0 end-0 mt-2 me-1 fs-4 d-lg-none d-block"
                        data-overlay="" data-bs-toggle="sidebar" data-target="#app-chat-contacts"></i>
                </div>
                <hr class="container-m-nx mt-3 mb-0">
                <div class="sidebar-body ps ps--active-y">

                    <!-- Chats -->
                    <ul class="list-unstyled chat-contact-list pt-1" id="chat-list">
                        <li class="chat-contact-list-item chat-contact-list-item-title">
                            <h5 class="text-primary mb-0">Konsultasi</h5>
                        </li>


                        @forelse($dokter as $d)

                        <li class="chat-contact-list-item" onclick="pilihdokter({{$d}},this)">
                            <a class="d-flex align-items-center">
                                <div class="flex-shrink-0 avatar avatar-online">
                                    <img src="{{asset('profil/'.$d->profil)}}" alt="Avatar"
                                        class="rounded-circle border">
                                </div>
                                <div class="chat-contact-info flex-grow-1 ms-3">
                                    <h6 class="chat-contact-name text-truncate m-0">{{$d->nama}}</h6>
                                    <p class="chat-contact-status text-truncate mb-0 text-muted">{{$d->nama_poli}}</p>
                                </div>
                                <small class="text-muted mb-auto">5 Minutes</small>
                            </a>
                        </li>
                        @empty
                        <li class="chat-contact-list-item chat-list-item-0">
                            <h6 class="text-muted mb-0">Tidak Ditemukan</h6>
                        </li>
                        @endforelse



                    </ul>
                    <!-- Contacts -->

                    <div class="ps__rail-x" style="left: 0px; bottom: 0px;">
                        <div class="ps__thumb-x" tabindex="0" style="left: 0px; width: 0px;"></div>
                    </div>
                    <div class="ps__rail-y" style="top: 0px; height: 391px; right: 0px;">
                        <div class="ps__thumb-y" tabindex="0" style="top: 0px; height: 142px;"></div>
                    </div>
                </div>
            </div>
            <!-- /Chat contacts -->

            <!-- Chat History -->
            <div class="col app-chat-history">
                <div class="chat-history-wrapper">
                    <div class="chat-history-header border-bottom">
                        <div class="d-flex justify-content-between align-items-center">
                            <div class="d-flex overflow-hidden align-items-center" id="active_chat">
                                <i class="bx bx-menu bx-sm cursor-pointer d-lg-none d-block me-2"
                                    data-bs-toggle="sidebar" data-overlay="" data-target="#app-chat-contacts"></i>
                                <div class="flex-shrink-0 avatar">

                                </div>
                                <div class="chat-contact-info flex-grow-1 ms-3">
                                    <h6 class="m-0"></h6>
                                    <small class="user-status text-muted"></small>
                                </div>
                            </div>
                            <div class="d-flex align-items-center">
                                <!-- <i class="bx bx-phone-call cursor-pointer d-sm-block d-none me-3 fs-4"></i>
                                <i class="bx bx-video cursor-pointer d-sm-block d-none me-3 fs-4"></i>
                                <i class="bx bx-search cursor-pointer d-sm-block d-none me-3 fs-4"></i> -->
                                <div class="dropdown">
                                    <button class="btn p-0" type="button" id="chat-header-actions"
                                        data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <i class="bx bx-dots-vertical-rounded fs-4"></i>
                                    </button>
                                    <div class="dropdown-menu dropdown-menu-end" aria-labelledby="chat-header-actions">
                                        <a class="dropdown-item" href="javascript:void(0);">View Contact</a>
                                        <a class="dropdown-item" href="javascript:void(0);">Mute Notifications</a>
                                        <a class="dropdown-item" href="javascript:void(0);">Block Contact</a>
                                        <a class="dropdown-item" href="javascript:void(0);">Clear Chat</a>
                                        <a class="dropdown-item" href="javascript:void(0);">Report</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="chat-history-body ps ps--active-y">
                        <ul class="list-unstyled chat-history mb-0">

                        </ul>

                    </div>
                    <!-- Chat message form -->
                    <div class="chat-history-footer">
                        <form class="form-send-message d-flex justify-content-between align-items-center ">
                            <input class="form-control message-input border-0 me-3 shadow-none"
                                placeholder="Type your message here..." disabled>
                            <div class="message-actions d-flex align-items-center">
                                <!-- <i class="speech-to-text bx bx-microphone bx-sm cursor-pointer"></i>
                                <label for="attach-doc" class="form-label mb-0">
                                    <i class="bx bx-paperclip bx-sm cursor-pointer mx-3 text-body"></i>
                                    <input type="file" id="attach-doc" hidden="">
                                </label> -->

                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <!-- /Chat History -->

            <!-- Sidebar Right -->
            <div class="col app-chat-sidebar-right app-sidebar overflow-hidden" id="app-chat-sidebar-right">
                <div
                    class="sidebar-header d-flex flex-column justify-content-center align-items-center flex-wrap p-4 mt-2">
                    <div class="avatar avatar-xl avatar-online">
                        <img src="{{asset('admin_theme')}}/assets/img/avatars/5.png" alt="Avatar"
                            class="rounded-circle">
                    </div>
                    <h6 class="mt-3 mb-1">Felecia Rower</h6>
                    <small class="text-muted">NextJS Developer</small>
                    <i class="bx bx-x bx-sm cursor-pointer close-sidebar me-1 fs-4 d-block" data-bs-toggle="sidebar"
                        data-overlay="" data-target="#app-chat-sidebar-right"></i>
                </div>
                <div class="sidebar-body px-4 pb-4 ps ps--active-y">
                    <div class="my-3">
                        <span class="text-muted text-uppercase">About</span>
                        <p class="mb-0 mt-2">A Next. js developer is a software developer who uses the Next. js
                            framework alongside ReactJS to build web applications.</p>
                    </div>
                    <div class="my-4">
                        <span class="text-muted text-uppercase">Personal Information</span>
                        <ul class="list-unstyled d-grid gap-2 mt-2">
                            <li class="d-flex align-items-center">
                                <i class="bx bx-envelope"></i>
                                <span class="align-middle ms-2">josephGreen@email.com</span>
                            </li>
                            <li class="d-flex align-items-center">
                                <i class="bx bx-phone-call"></i>
                                <span class="align-middle ms-2">+1(123) 456 - 7890</span>
                            </li>
                            <li class="d-flex align-items-center">
                                <i class="bx bx-time-five"></i>
                                <span class="align-middle ms-2">Mon - Fri 10AM - 8PM</span>
                            </li>
                        </ul>
                    </div>
                    <div class="mt-4">
                        <span class="text-muted text-uppercase">Options</span>
                        <ul class="list-unstyled d-grid gap-2 mt-2">
                            <li class="cursor-pointer d-flex align-items-center">
                                <i class="bx bx-bookmark"></i>
                                <span class="align-middle ms-2">Add Tag</span>
                            </li>
                            <li class="cursor-pointer d-flex align-items-center">
                                <i class="bx bx-star"></i>
                                <span class="align-middle ms-2">Important Contact</span>
                            </li>
                            <li class="cursor-pointer d-flex align-items-center">
                                <i class="bx bx-image-alt"></i>
                                <span class="align-middle ms-2">Shared Media</span>
                            </li>
                            <li class="cursor-pointer d-flex align-items-center">
                                <i class="bx bx-trash-alt"></i>
                                <span class="align-middle ms-2">Delete Contact</span>
                            </li>
                            <li class="cursor-pointer d-flex align-items-center">
                                <i class="bx bx-block"></i>
                                <span class="align-middle ms-2">Block Contact</span>
                            </li>
                        </ul>
                    </div>
                    <div class="ps__rail-x" style="left: 0px; bottom: 0px;">
                        <div class="ps__thumb-x" tabindex="0" style="left: 0px; width: 0px;"></div>
                    </div>
                    <div class="ps__rail-y" style="top: 0px; height: 279px; right: 0px;">
                        <div class="ps__thumb-y" tabindex="0" style="top: 0px; height: 149px;"></div>
                    </div>
                </div>
            </div>
            <!-- /Sidebar Right -->

            <div class="app-overlay"></div>
        </div>
    </div>


</div>
@endsection

@push('js')
<script src="https://js.pusher.com/8.0.1/pusher.min.js"></script>
<script src="https://unpkg.com/axios/dist/axios.min.js"></script>
<script src="{{asset('admin_theme/assets/vendor/js/app-chat.js')}}"></script>
<script>
    let id_saya = "{{auth()->user()->id}}"
    let id_to = "";
    let input_message = $(".message-input");
    let i = document.querySelector(".chat-history-body");

    $(document).ready(function () {

        Pusher.logToConsole = true;

        var pusher = new Pusher('84d89372bac06830ab70', {
            cluster: 'ap1',
            forceTLS: true
        });
        var channel = pusher.subscribe('my-channel');
        channel.bind('my-event', function (data) {
            if (id_saya == data.to && id_to == data.from) {
                see_mess(data.isi_chat)
            }
        })
    });




    $(".form-send-message").on('submit', (e) => {
        e.preventDefault()
        axios.post("{{url('sendchat')}}", {
            to: id_to,
            isi_chat: input_message.val()
        });
        $(".chat-history").append(`
        <li class="chat-message chat-message-right">
                <div class="d-flex overflow-hidden">
                    <div class="chat-message-wrapper flex-grow-1">
                        <div class="chat-message-text">
                            <p class="mb-0">${input_message.val()}</p>
                        </div>
                        <div class="text-end text-muted mt-1">
                            <i class="bx bx-check-double text-success"></i>
                            <small>10:10 AM</small>
                        </div>
                    </div>
                    <div class="user-avatar flex-shrink-0 ms-3">
                        <div class="avatar avatar-sm">
                            <img src="http://127.0.0.1:8000/admin_theme/assets/img/avatars/1.png" alt="Avatar" class="rounded-circle">
                        </div>
                    </div>
                </div>
            </li>

        `)

        i.scrollTo(0, i.scrollHeight)
        input_message.val('')

    });

    let my_mee = (data)=>{
        let my_mee =  
        `
        <li class="chat-message chat-message-right">
                <div class="d-flex overflow-hidden">
                    <div class="chat-message-wrapper flex-grow-1">
                        <div class="chat-message-text">
                            <p class="mb-0">${data.isi_chat}</p>
                        </div>
                        <div class="text-end text-muted mt-1">
                            <i class="bx bx-check-double text-success"></i>
                            <small>10:10 AM</small>
                        </div>
                    </div>
                    <div class="user-avatar flex-shrink-0 ms-3">
                        <div class="avatar avatar-sm">
                            <img src="http://127.0.0.1:8000/admin_theme/assets/img/avatars/1.png" alt="Avatar" class="rounded-circle">
                        </div>
                    </div>
                </div>
            </li>
        `;

        return my_mee;
    }


    let see_mess = (data) => {
        let mess = `
             <li class="chat-message">
                    <div class="d-flex overflow-hidden">
                        <div class="user-avatar flex-shrink-0 me-3">
                            <div class="avatar avatar-sm">
                                <img src="{{asset('admin_theme')}}/assets/img/avatars/5.png" alt="Avatar"
                                    class="rounded-circle">
                            </div>
                        </div>
                        <div class="chat-message-wrapper flex-grow-1">
                            <div class="chat-message-text">
                                <p class="mb-0">${data.isi_chat}</p>
                            </div>
                            <div class="text-muted mt-1">
                                <small>10:02 AM</small>
                            </div>
                        </div>
                    </div>
                </li>
        `
        return mess;
    }

    let pilihdokter = async (data, el) => {
        $(".chat-contact-list-item").removeClass('active')
        $(el).addClass('active')

        let profil = `{{asset('profil')}}/${data.profil}`
        id_to = data.user_id
        $("#active_chat .avatar").html(` <img src="${profil}" alt="Avatar"
                                        class="rounded-circle border" data-bs-toggle="sidebar" data-overlay=""
                                        data-target="#app-chat-sidebar-right"> `)

        $("#active_chat .chat-contact-info").html(`  <h6 class="m-0">${data.nama}</h6>
                                    <small class="user-status text-muted">${data.nama_poli}</small>  `)
        await getChat(data.user_id)

    }

    let getChat = async (id) => {
        let data = await axios.get(`{{url('getchat')}}/${id}`)
            .then((res) => {
                console.log(res.data)
                if (res.data.status_konsultasi === 'active') {
                    $(".message-actions").html(`  
                                <button class="btn btn-primary d-flex send-msg-btn">
                                    <i class="bx bx-paper-plane me-md-1 me-0"></i>
                                    <span class="align-middle d-md-inline-block d-none">Send</span>
                                </button>`)
                    $(".message-input").prop('disabled',false)
                } else {
                    $(".message-input").prop('disabled',true)
                    $(".message-actions").html(`
                        <button disabled class="btn btn-primary d-flex send-msg-btn">
                                    Sesi Habis
                        </button>`);
                }

                $(".chat-history").empty()
                res.data.chats.forEach((cat)=>{
                    console.log(cat.to_id == id)
                    if(cat.to_id == id_to){
                        $(".chat-history").append(my_mee(cat))
                    }else{
                        $(".chat-history").append(see_mess(cat))
                    }
                })

                i.scrollTo(0, i.scrollHeight)

            })
        return data;
    }
</script>
@endpush