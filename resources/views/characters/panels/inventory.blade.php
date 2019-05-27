<div class="px-2 d-flex">
    <div class="w-25">
        @foreach($character->inventoryitems as $ii)
            <div class="p-1">
                @can('delete', $ii)
                    <form class="form w-100 d-flex justify-content-center" method="POST" action="{{route('inventoryitems.update', $ii)}}">
                        @csrf
                        @method('PATCH')
                        <div class="flex-shrink-1" style="width: 70px;">
                            <input class="form-control" type="number" name="quantity" value={{$ii->quantity}} min=0 step=1 max=999
                                style="border-top-right-radius: 0; border-bottom-right-radius: 0; border-right: 0"
                            >
                        </div>
                        <div class="input-group">
                            <div class="flex-grow-1">
                                <input class="form-control" type="text" name="name" value="{{$ii->name}}"
                                    style="border-top-left-radius: 0; border-bottom-left-radius: 0"
                                >
                            </div>
                            <div class="input-group-append">
                                <button type="submit" class="btn btn-outline-primary"><span data-feather="edit-2"></span></button>
                                {{-- <button class="btn btn-outline-primary"><span data-feather="send"></span></button> --}}
                            </div>
                        </div>
                    </form>
                @else
                    <div class="w-100 d-flex justify-content-center">
                        <div class="flex-shrink-1" style="width: 70px;">
                            <input class="form-control" style="border-top-right-radius: 0; border-bottom-right-radius: 0; border-right: 0; background-color: transparent;" type="text" value={{$ii->quantity}} disabled>
                        </div>
                        <div class="input-group">
                            <div class="flex-grow-1">
                                <input class="form-control" style="border-top-left-radius: 0; border-bottom-left-radius: 0; background-color: transparent;" type="text" value="{{$ii->name}}" disabled>
                            </div>
                            {{-- <div class="input-group-append">
                                <button class="btn btn-outline-primary"><span data-feather="send"></span></button>
                            </div> --}}
                        </div>
                    </div>
                @endcan
            </div>
            @if($loop->iteration % 9 == 0)
                </div>
                <div class="w-25">
            @endif
        @endforeach
        @can('create', "App\Inventoryitem")
            <div class="p-1">
                <form class="form w-100 d-flex justify-content-center" method="POST" action="{{route('inventoryitems.store')}}">
                    @csrf
                    <input type="hidden" name="character_id" value="{{$character->id}}">
                    <div class="flex-shrink-1" style="width: 70px;">
                        <input class="form-control" style="border-top-right-radius: 0; border-bottom-right-radius: 0; border-right: 0" type="number" name="quantity" value=1 min=1 step=1 max=999>
                    </div>
                    <div class="input-group">
                        <div class="flex-grow-1">
                            <input class="form-control" style="border-top-left-radius: 0; border-bottom-left-radius: 0" type="text" name="name" placeholder="Add new item">
                        </div>
                        <div class="input-group-append">
                            <button type="submit" class="btn btn-outline-success"><span data-feather="plus"></span></button>
                        </div>
                    </div>
                </form>
            </div>
        @endcan
    </div>
</div>
