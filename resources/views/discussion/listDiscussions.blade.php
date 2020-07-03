@extends('layouts.base')
@section('cssBlock')

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
@endsection
@section('content')
    <div class="row">
        <div class="col">
            <div class="table-responsive container">
                <table class="align-middle mb-0 table table-borderless table-striped table-hover">
                    <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">name</th>
                        <th scope="col">created_at</th>
                        <th scope="col">{{ __('messages.due date') }}</th>
                        <th scope="col">{{ __('messages.status') }}</th>
                        <th colspan="2">Action</th>

                    </tr>
                    </thead>
                    <tbody>
                    <h5>unreadDiscussionCount : {{$unreadDiscussionCount}}</h5><br>
                    @foreach(  $discussions  as  $discussion)
                        <tr>
                            <td style="color: green;font-size: 15px;">     {{$discussion->id }}</td>
                            <td style="color: green;font-size: 15px;">
                                {{$discussion->name }}
                            </td>
                            <td>       {{$discussion->created_at }}</td>

                            {{--   <td>
                                   @foreach( $discussion->employee as $employee)
                                       <div style="display:inline-block">
                                           {{$employee->name}}
                                           <img src="{{asset($employee->image)}}" data-toggle="tooltip"
                                                data-original-title="{{$employee->name}}" class="rounded-circle"
                                                height="30px" width="30px" alt="employee"/>
                                       </div>
                                   @endforeach
                               </td>

   --}}
                            {{--                            <td style="color: tomato;font-size: 15px;">--}}
                            {{--                                @if($task->status === 1)--}}
                            {{--                                    <span class="badge badge-success"> {{ __('messages.Completed') }}</span>--}}
                            {{--                                @elseif($task->status === 2)--}}
                            {{--                                    <span class="badge badge-danger"> {{ __('messages.Incomplete') }}</span>--}}
                            {{--                                @else--}}
                            {{--                                    <span class="badge badge-info"> {{ __('messages.In Progress') }}</span>--}}
                            {{--                                @endif--}}
                            {{--                            </td>--}}


                            <td class="text-center">
                                <div class="btn-group dropdown m-r-10 open">
                                    <button aria-expanded="true" data-toggle="dropdown" class="btn"
                                            type="button">
                                        <i class="fa fa-ellipsis-h"></i>
                                    </button>
                                    {{--  <ul role="menu" class="dropdown-menu pull-right">
                                          <li>
                                              <a href="{{route('task.edit',$task->id)}}">
                                                  <strong>
                                                      <i class="fa fa-edit btn-icon-wrapper icon-gradient bg-sunny-morning"
                                                         style="font-size:20px;"></i>
                                                      Edit
                                                  </strong>
                                              </a>
                                          </li>
                                          <li>
                                              <form action="{{route('task.destroy',$task->id)}}" method="post">
                                                  @csrf
                                                  @method('DELETE')
                                                  <button class="mr-2 btn-icon btn-icon-only btn">
                                                      <strong>
                                                          <i class="fa fa-trash btn-icon-wrapper icon-gradient bg-love-kiss"
                                                             style="font-size: 20px;" id="delete">
                                                          </i> Delete
                                                      </strong>

                                                  </button>
                                              </form>
                                          </li>
                                      </ul>--}}

                                </div>

                            </td>

                        </tr>
                    @endforeach
                    </tbody>
                </table>
              {{--  @foreach(   $contact as $contac)
                    <h1>{{$contac->id}}</h1>
                @endforeach--}}
            </div>
        </div>
    </div>
@endsection
@section('jsBlock')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
@endsection
