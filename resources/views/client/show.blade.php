@extends('layouts.base')

@section('content')
    {{-- app-page-title--}}
    <div class="app-page-title">
        <div class="page-title-wrapper">
            {{-- page-title-wrapper--}}
            <div class="page-title-heading">
                <div class="page-title-icon">
                    <i class="pe-7s-user icon-gradient bg-mean-fruit">
                    </i>
                </div>
                <div> Client  Dashboard
                    {{--    <div class="page-title-subheading">This is an example dashboard created using build-in
                            elements and components
                        </div>--}}
                </div>
            </div>
            {{--   /page-title-wrapper--}}
        </div>
    </div>
    {{--                /app-page-title--}}


    <div class="row">
        <div class="col-md-12">
            <div class="main-card mb-3 card">

                {{--           @if(session()->get('success'))
                               <div class="alert alert-success">
                                   {{ session()->get('success') }}
                               </div><br />
                           @endif--}}

                <div class="card-header">{{__('messages.client') }}

                </div>
                <div class="table-responsive">
                    <table class="align-middle mb-0 table table-borderless table-striped table-hover">
                        <thead>
                        <tr>

                            <th class="text-center">#</th>
                            <th class="text-center">{{__('messages.name') }}</th>
                            {{--                            <th class="text-center">nom de l'entreprise</th>--}}
                            <th class="text-center">{{__('messages.email') }}</th>
                            <th class="text-center"> {{__('messages.created_at') }}</th>



                        </tr>
                        </thead>
                      <tbody>

                                <tr>
                                    <td class="text-center text-muted"> {{ $client->id }}</td>
                                    <td class="text-center text-muted">
                                        <div class="widget-content p-0">
                                            <div class="widget-content-wrapper">
                                       {{--   <div class="widget-content-left mr-3">
                                                      <div class="widget-content-left">
                                                             img
                                                      </div>
                                                  </div>--}}
                                                <div class="widget-content-left flex2">
                                                    <div class="widget-heading">
                                                        {{ $client->name }}   </div>
{{--                                                    <div class="widget-subheading opacity-7">Web Developer</div>--}}
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="text-center"> {{ $client->email }}</td>
                                    <td class="text-center">
                                        <div class="badge badge-warning">{{ $client->created_at }}</div>
                                    </td>
                                </tr>
                            </tbody>
                    </table>

                    {{--        <footer class="card-footer" style="float: right">

                                {{ $clients->links() }}
                            </footer>--}}
                </div>

            </div>
        </div>
    </div>
@endsection
