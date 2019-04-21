@extends('layouts.app')

@section('content')
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pb-2 border-bottom">
        <h1>Downtime for <a href="{{route('characters.show',$downtime->character)}}">{{$downtime->character->name}}</a></h1>
        <span>Downtime opened at: {{$downtime->downtimeperiod->opens_at->format('d/m/y - g:ia')}}</span>
    </div>
    <div class="container py-4">
        @foreach($downtime->downtimepoints as $point)
            <div class="card mb-3 downtimepoint">
                <div class="card-header">
                    Point {{$point->order}}
                    @can('delete', $point)
                        <a href="#" class="float-right text-danger delete-link" data-toggle="modal" data-target="#delete-downtimepoint-modal" data-action="{{route('downtimepoints.destroy',$point)}}"><span data-feather="trash-2" style="width: 20px; height: 20px;"></span></a>
                    @endcan
                </div>
                <div class="card-body">
                    <form action="{{route('downtimepoints.update', $point)}}" method="post">
                        @csrf
                        @method('PUT')
                        <div class="form-group">
                            <label for="text-{{$point->order}}" class="col-form-label">Action:</label>
                            <textarea class="form-control fieldinput" rows="4" id="text-{{$point->order}}" name="text">{{$point->text}}</textarea>
                        </div>
                        @if($showresponses)
                            <div class="form-group">
                                <label for="response-{{$point->order}}" class="col-form-label">Response:</label>
                                <textarea class="form-control fieldinput" rows="4" id="response-{{$point->order}}" name="response">{{$point->response}}</textarea>
                            </div>
                        @endif
                        <div class="row">
                            <div class="col text-right">
                                <button type="submit" class="btn btn-primary submit-button" hidden>Save changes</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        @endforeach
        @can('update', $downtime)
            <form action="{{route('downtimepoints.store')}}" method="post">
                @csrf
                <input type="hidden" name="downtime_id" value="{{$downtime->id}}">
                <button type="submit" class="btn btn-primary mb-5 new-downtime-point">Add downtime point</button>
            </form>
        @endcan
    </div>
    @include('downtime_points.modals.delete')
@endsection

@push('scripts')
    <script type="text/javascript">
        $(function(){
            $('#delete-downtimepoint-modal').on('show.bs.modal',function(event){
               var button = $(event.relatedTarget);
               var action = button.data('action');
               $('#delete-downtimepoint-form').attr('action', action);
           });

           $('.fieldinput').on('change, keyup',function(e){
               var dtp = $(this).parents('.downtimepoint');
               $('.new-downtime-point').hide();
               $('.delete-link').hide();
               $('.submit-button').removeClass('btn-primary');
               $('.submit-button').addClass('btn-danger');
               dtp.find('.submit-button').removeClass('btn-danger');
               dtp.find('.submit-button').addClass('btn-primary');
               dtp.find('.submit-button').attr('hidden', false);
               dtp.find('.delete-link').show();
           });
        });
    </script>
@endpush
