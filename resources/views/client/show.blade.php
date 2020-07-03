@extends('layouts.base')
@section('cssBlock')
    <style>
        .top_60 {
            margin-top: 60px;
        }

        .profile {
            background: #fff;
            -webkit-border-radius: 6px;
            width: 100%;
            display: inline-block;
            -webkit-box-shadow: 0px 2px 92px 0px rgba(0, 0, 0, 0.07);
        }

        .profile-name {
            line-height: 18px;
            padding: 20px;
        }

        .profile .name {
            text-transform: uppercase;
            font-size: 17px;
            font-weight: bold;
        }

        .profile-image {
            margin-top: -18px;
            clip-path: polygon(0 9%, 100% 0, 100% 94%, 0% 100%);
        }

        ul.profile-information {
            list-style: none;
            margin: 8px 0px 8px 35px;
        }

        ul.profile-information li:first-child {
            padding-bottom: 10px;
            padding-left: 30px;
            position: relative;
        }

        ul.profile-information li {
            border-left: solid 2px #eee;
            padding: 0 0 23px 20px;
            font-size: 14px;
            color: #787878;
        }

        li {
            display: list-item;
            text-align: -webkit-match-parent;
        }

        ul.profile-information {
            list-style: none;
            margin: 8px 0px 8px 35px;
        }

        ul.profile-information li:first-child:before {
            margin-left: -51px;
            margin-top: -30px;
            margin-bottom: 20px;
            position: relative;
            border: 0;
            width: 40px;
            height: 40px;
            padding: 11px 14px;
            box-shadow: 0px 2px 32px 0px rgba(4, 123, 248, 0.3);
        }

        li:first-child:before {
            background: #ffc500 !important;
        }

        ul.profile-information li:before {
            border-color: #ffb100 !important;
        }

        ul.profile-information li:first-child:after {
            content: '';
            width: 30px;
            height: 10px;
            position: absolute;
            top: 0;
            left: 0;
            margin: 16px -15px;
        }

        ul.profile-information li:first-child:after {
            background-size: 27px 10px;
        }

        .profile-image img {
            width: 100%;
        }

        img {
            vertical-align: middle;
        }

        .profile-image {
            margin-top: -18px;
            clip-path: polygon(0 9%, 100% 0, 100% 94%, 0% 100%);
        }

        figure {
            margin-block-start: 1em;
            margin-block-end: 1em;
            margin-inline-start: 40px;
            margin-inline-end: 40px;
        }

        ul.profile-information li:before {
            content: "";
            border: solid 2px;
            width: 8px;
            height: 8px;
            -moz-border-radius: 50px;
            -webkit-border-radius: 50px;
            font-size: 8px;
            margin-left: -25px;
            margin-top: 2px;
            font-weight: 400;
            background: #fff;
            display: block;
            position: absolute;
        }

        ul.profile-information li:before {
            border-color: #ffb100 !important;
        }

        ul.profile-information li p {
            line-height: 12px;
        }

        ul.profile-information {
            list-style: none;
        }

        header nav {
            background: #fff;
            display: inline-block;
            -webkit-border-radius: 6px;
            height: 70px;
            width: 100%;
            margin-bottom: 30px;
            line-height: 70px;
            -webkit-box-shadow: 0px 2px 92px 0px rgba(0, 0, 0, 0.07);
        }

        header nav ul li {
            float: left;
        }

        nav ul {
            list-style: none;
        }

        header nav {
            line-height: 70px;
        }

        #content {
            min-height: 500px;
            -webkit-border-radius: 6px;
            padding: 15px;
        }

        #content {
            background: #fff;
            -webkit-box-shadow: 0px 2px 92px 0px rgba(0, 0, 0, 0.07);
        }

        .padding_30 {
            padding-top: 30px;
        }

        .padbot_45 {
            padding-bottom: 45px;
        }

        section {
            padding-left: 30px !important;
            padding-right: 30px !important;
        }

        .section-title h1, .section-title h2, .section-title h3, .section-title h4, .section-title h5 {
            font-size: 18px;
            font-weight: 600;
            position: relative;
        }

        h1, h2, h3, h4, h5, h6, .h1, .h2, .h3, .h4, .h5, .h6 {
            font-family: inherit;
            line-height: 1.1;
            color: inherit;
        }

        .spinner:before {
            border-top-color: #ffb100;
        }

        ul.profile-information li:before {
            border-color: #ffc500;
        }

        /* Hover Color*/

        .site-btn:hover, header nav a.home-btn:hover, .section-title span {
            background-color: #ffb100 !important;
        }

        /* Opacity Color*/

        #portfolio .cbp-item .portfolio-image .icon i, #portfolio .cbp-item figure .icon i {
            background: rgb(255, 197, 1);
        }

        /* for light colors */

        .site-btn, header nav a.home-btn i, ul.profile-information li:first-child:before, #blog .blog-box .date span, #blog .blog-box .date span, .timeline li:first-child i, .cbp-l-loadMore-link.site-btn {
            color: #000 !important;
        }

        .timeline li:before, ul.profile-information li:before {
            border-color: #ffb100 !important;
        }

        .tab.active a, #blog-post .post-list ul li a, #blog-post .post-comment ul li .comment-content a {
            color: #ffb100;
        }

        ul.profile-information li:first-child:after {
            background: url('{{asset('download.png')}}') no-repeat;
            background-size: 27px 10px;
        }

        h2 {
            display: block;
            margin-block-start: 0.83em;
            margin-block-end: 0.83em;
            margin-inline-start: 0px;
            margin-inline-end: 0px;
        }

        .site-btn:hover, header nav a.home-btn:hover, .section-title span {
            background-color: #ffb100 !important;
        }

        .section-title span {
            position: absolute;
            height: 7px;
            width: 100%;
            bottom: 0;
            opacity: 0.4;
            left: 0;
        }

        .section-title {
            position: relative;
            display: inline-block;
            padding: 0 3px;
        }

        .padbot_45 {
            padding-bottom: 45px;
        }

        .padding_30 {
            padding-top: 30px;
        }

        section {
            padding-left: 30px !important;
            padding-right: 30px !important;
        }

        section:last-child {
            border: 0;
        }

        section.graybg {
            background: #fafafa;
        }

        section:last-child {
            border: 0;
        }

        .padbot_50 {
            padding-bottom: 50px;
        }

        .padding_50 {
            padding-top: 50px;
        }

        .top_30 {
            margin-top: 30px;
        }

        .bottom_45 {
            margin-bottom: 45px;
        }

        .section-title {
            position: relative;
            display: inline-block;
            padding: 0 3px;
        }

        ul.profile-information li:first-child:before {
            background: #ffc500 !important;
        }

        ul.profile-information li:first-child:before {
            margin-left: -51px;
            margin-top: -30px;
            margin-bottom: 20px;
            position: relative;
            border: 0;
            width: 40px;
            height: 40px;
            padding: 11px 14px;
            box-shadow: 0px 2px 32px 0px rgba(4, 123, 248, 0.3);
        }

        ul.profile-information li:before {
            border-color: #ffb100 !important;
        }

        ul.profile-information {
            list-style: none;
            margin: 8px 0px 8px 35px;
        }

        ul {
            display: block;
            margin-block-start: 1em;
            margin-block-end: 1em;
            margin-inline-start: 0px;
            margin-inline-end: 0px;
            padding-inline-start: 40px;
        }

        ul.profile-information li:first-child {
            padding-bottom: 10px;
            padding-left: 30px;
            position: relative;
        }

        ul.profile-information li {
            border-left: solid 2px #eee;
            padding: 0 0 23px 20px;
            font-size: 14px;
            color: #787878;
        }

        li {
            display: list-item;
            text-align: -webkit-match-parent;
        }

        ul.profile-information {
            list-style: none;
        }

        ul.profile-information li:first-child:before {
            color: #000 !important;
        }

        header nav a.home-btn, .estate figure .imgout .price, .site-btn, .timeline li:first-child i, nav ul li a:after, .owl-theme .owl-controls .owl-page span, .skill-list .progress .percentage, ul.profile-information li:first-child:before {
            background: #ffc500 !important;
        }

        ul.profile-information li:first-child:before {
            margin-left: -51px;
            margin-top: -30px;
            margin-bottom: 20px;
            position: relative;
            border: 0;
            width: 40px;
            height: 40px;
            padding: 11px 14px;
            box-shadow: 0px 2px 32px 0px rgba(4, 123, 248, 0.3);
        }
    </style>

@endsection
@section('content')
    {{-- app-page-title--}}
    <div class="app-page-title">
        <div class="page-title-wrapper">
            {{-- page-title-wrapper--}}
            <div class="page-title-heading">
                <div class="page-title-icon">
                    <i class="metismenu-icon fas fa-user icon-gradient bg-arielle-smile" style="font-size:36px"></i>
                </div>
                <div>
                    <h5 class="page-title">
                     <strong>  {{__('messages.client') }} {{ $client->id }}#  [ {{$client->name}} ]</strong>
                    </h5>
                </div>
            </div>
            {{--   /page-title-wrapper--}}

            <div class="page-title-actions">
                <div class="d-inline-block dropdown text-center">
                </div>
            </div>
        </div>
    </div>

    <div class="wrapper top_60 container">
        <div class="row">
            {{--profile--}}
            <div class="col-lg-4 col-md-3">
                <div class="profile">
                    <div class="profile-name" style="background: #ffc500 !important; ">
                        <span class="name">   <strong>{{ $client->name }} </strong> </span>
                        <br>
                        <span class="job"></span>
                    </div>
                    {{-- <figure>
                         <img src="{{asset($employee->image)}}"
                              height="150px" width="150px">
                     </figure>--}}
                    <ul class="profile-information">
                        <li></li>
                        <li><p><span><strong>{{ __('messages.name') }} : {{ $client->name }}</strong></span></p></li>
                        <li><p><span> <strong>EMAIL: <br><br> {{$client->email }}</strong></span></p></li>
                        <li><p>
                                <span> <strong> {{ __('messages.Joining_Date') }}: <br> <br>{{ $client->created_at }}</strong></span>
                            </p>
                        </li>
                        <li><p>
                                <span>  <strong>   {{ __('messages.mobile') }}: &nbsp; {{$client->mobile}}</strong></span>
                            </p></li>
                        <li><p>
                                <span> <strong> {{ __('messages.Address') }}: &nbsp; {{$client->address}}</strong> </span>
                            </p></li>
                        <li><p><span> <strong>{{__('messages.Linkedin') }}  :  {{$client->linkedin}}</strong></span></p>
                        </li>
                        <li><p><span> <strong>{{__('messages.Facebook') }}  :{{$client->facebook}}</strong></span></p>
                        </li>
                        <li><p><span> <strong>{{__('messages.Skype') }} :  {{$client->skype}}</strong></span></p></li>

                        {{--                        <li><p><span>      {{ __('messages.skills') }}: <br> {{$employee->skills}}</span></p></li>--}}
                    </ul>
                </div>
            </div>
            {{--/profile--}}
            {{--        project    --}}
            <div id="ajax-tab-container" class="col-9 col-md-8 tab-container" data-easytabs="true">
                <div class="row">
                    <div class="col-md-12">
                        <div id="content" class="panel-container">
                            <div id="home" class="active" style="display: block;">
                                <div class="row">
                                    <section class="about-me line col-md-12 padding_30 padbot_45">
                                        <div class="section-title">
                                            <span></span>
                                            <h2>{{ __('messages.projects') }}</h2>
                                        </div>
                                        <div class="top_30">
                                            <table
                                                class="align-middle mb-0 table table-borderless table-striped table-hover">
                                                <thead>
                                                <tr style="text-align: justify">
                                                    <th>{{ __('messages.project name') }}</th>
                                                    <th>{{ __('messages.deadline') }}</th>
                                                    <th>{{ __('messages.completion') }}</th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                @if(auth()->user())
                                                    @foreach($projects as $project)
                                                        <tr>
                                                            <td>
                                                                <a href="{{route('project')}}">{{$project->name}}</a>
                                                            </td>
                                                            <td>{{ $project->deadline}}</td>
                                                            <td class="text-center">
                                                                @if($project->progress_bar <50)
                                                                    <h5>Progress
                                                                        <span class="pull-right">{{ $project->progress_bar }} %</span>
                                                                    </h5>
                                                                    <div class="progress">
                                                                        <div class="progress-bar bg-danger"
                                                                             role="progressbar"
                                                                             style="width: 25%"
                                                                             aria-valuenow="40" aria-valuemin="0"
                                                                             aria-valuemax="100">
                                                                            {{ $project->progress_bar }}
                                                                        </div>
                                                                    </div>
                                                                @elseif($project->progress_bar<80)
                                                                    <h5>Progress
                                                                        <span
                                                                            class="pull-right">{{ $project->progress_bar }} %</span>
                                                                    </h5>
                                                                    <div class="progress">
                                                                        <div class="progress-bar bg-warning"
                                                                             role="progressbar"
                                                                             style="width: 80%"
                                                                             aria-valuenow="80" aria-valuemin="0"
                                                                             aria-valuemax="100">
                                                                            {{ $project->progress_bar }}
                                                                            <span
                                                                                class="sr-only">          {{ $project->progress_bar }}</span>
                                                                        </div>

                                                                    </div>
                                                                @elseif($project->progress_bar >= 80)
                                                                    <h5>Progress
                                                                        <span
                                                                            class="pull-right">{{ $project->progress_bar }} %</span>
                                                                    </h5>
                                                                    <div class="progress">
                                                                        <div class="progress-bar bg-success"
                                                                             role="progressbar"
                                                                             style="width: 90%"
                                                                             aria-valuenow="90" aria-valuemin="0"
                                                                             aria-valuemax="100">
                                                                            {{ $project->progress_bar }}
                                                                        </div>
                                                                    </div>
                                                                @endif
                                                            </td>
                                                        </tr>
                                                    @endforeach
                                                @endif
                                                </tbody>
                                            </table>
                                        </div>

                                    </section>
                                </div>
                                {{--/project    --}}
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>




@endsection
@section('jsBlock')
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
@endsection
