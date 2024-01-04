@extends('admin.layouts.app')
@section('css')
<link rel="stylesheet" href="{{ asset('Modules/CMS/Resources/assets/css/style.min.css') }}">
@endsection
@section('content')
<div class="col-sm-12">
  
    <div class="row">
        <div class="card card-info display_block" id="nav">
            <div class="col-md-3 col-sm-12 " aria-labelledby="navbarDropdown">
                <ul class="nav flex-column nav-pills" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                    <nav id="column_left">
                        <div class="card-header p-t-20">
                            <h5><a href="#" id="general-settings">{{ __('Manage') . " " . __('Themes') }}</a></h5>
                        </div>
                        <ul class="nav nav-list flex-column">
                            <li>
                                <a class="accordion-heading" data-toggle="collapse" data-target="#submenu0">General <span class="pull-right"><b class="caret"></b></span></a>
                            </li>
                            
                        <li>
                            <a class="accordion-heading" data-toggle="collapse" data-target="#submenu1">Header <span class="pull-right"><b class="caret"></b></span></a>
                                <ul class="nav nav-list flex-column flex-nowrap collapse ml-2" id="submenu1">
                                    <li><a id="v-pills-profile-tab" data-toggle="pill" href="#v-pills-profile" role="tab" aria-controls="v-pills-profile" aria-selected="false">Header One</a></li>
                                    <li><a id="v-pills-messages-tab" data-toggle="pill" href="#v-pills-messages" role="tab" aria-controls="v-pills-messages" aria-selected="false">Header Two</a></li>
                                </ul>
                        </li>

                        <li>
                            <a class="accordion-heading" data-toggle="collapse" data-target="#submenu2">Footer <span class="pull-right"><b class="caret"></b></span></a>
                            <ul class="nav nav-list flex-column flex-nowrap collapse ml-2" id="submenu2">
                                <li><a id="v-pills-profile-tab" data-toggle="pill" href="#v-pills-profile" role="tab" aria-controls="v-pills-profile" aria-selected="false">Fooooter One</a></li>
                                <li><a id="v-pills-messages-tab" data-toggle="pill" href="#v-pills-messages" role="tab" aria-controls="v-pills-messages" aria-selected="false">Fooooter Two</a></li>
                            </ul>
                        </li>
                        </ul>
                    </nav>
                </ul>
            </div>
        </div>
        <div class="col-md-9 col-sm-12">
            <div class="card-header p-t-20">
                <h5> <h5><a href="#">{{ __('Themes') }} </a> >> {{ __('General') }}</h5></h5>
            </div>
            <div class="tab-content" id="v-pills-tabContent">
                <div class="tab-pane fade show active" id="v-pills-home" role="tabpanel" aria-labelledby="v-pills-home-tab">
                    <p class="mb-0">Cillum ad ut irure tempor velit nostrud occaecat ullamco aliqua anim Lorem sint. Veniam sint duis incididunt do esse magna mollit excepteur laborum qui. Id id reprehenderit sit est
                        eu aliqua
                        occaecat quis et velit excepteur laborum mollit dolore eiusmod. Ipsum dolor in occaecat commodo et voluptate minim reprehenderit mollit pariatur. Deserunt non laborum enim et cillum eu deserunt
                        excepteur ea incididunt minim occaecat.</p>
                </div>
                <div class="tab-pane fade" id="v-pills-profile" role="tabpanel" aria-labelledby="v-pills-profile-tab">
                    <p class="mb-0">Culpa dolor voluptate do laboris laboris irure reprehenderit id incididunt duis pariatur mollit aute magna pariatur consectetur. Eu veniam duis non ut dolor deserunt commodo et
                        minim in quis
                        laboris ipsum velit id veniam. Quis ut consectetur adipisicing officia excepteur non sit. Ut et elit aliquip labore Lorem enim eu. Ullamco mollit occaecat dolore ipsum id officia mollit qui
                        esse anim eiusmod do sint minim consectetur qui.</p>
                </div>
                <div class="tab-pane fade" id="v-pills-messages" role="tabpanel" aria-labelledby="v-pills-messages-tab">
                    <p class="mb-0">Fugiat id quis dolor culpa eiusmod anim velit excepteur proident dolor aute qui magna. Ad proident laboris ullamco esse anim Lorem Lorem veniam quis Lorem irure occaecat velit
                        nostrud magna
                        nulla. Velit et et proident Lorem do ea tempor officia dolor. Reprehenderit Lorem aliquip labore est magna commodo est ea veniam consectetur.</p>
                </div>
                <div class="tab-pane fade" id="v-pills-settings" role="tabpanel" aria-labelledby="v-pills-settings-tab">
                    <p class="mb-0">Eu dolore ea ullamco dolore Lorem id cupidatat excepteur reprehenderit consectetur elit id dolor proident in cupidatat officia. Voluptate excepteur commodo labore nisi cillum duis
                        aliqua do.
                        Aliqua amet qui mollit consectetur nulla mollit velit aliqua veniam nisi id do Lorem deserunt amet. Culpa ullamco sit adipisicing labore officia magna elit nisi in aute tempor commodo eiusmod.
                    </p>
                </div>
            </div>
        </div>
    </div>

</div>
@endsection