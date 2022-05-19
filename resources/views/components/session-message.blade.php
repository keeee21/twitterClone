<div class="flex justify-around items-center my-5" >
    @if($errors->any())
        <div>
            <ul>
                @foreach($errors->all() as $error)
                    <li class="text-red-600">{{$error}}</li>
                @endforeach
            </ul>
        </div>
    @endif
    @if(session('error'))
        <div>
            <p class="text-red-600">{{session('error')}}</p>
        </div>
    @endif
    @if(session('success'))
        <div>
            <p class="text-green-600">{{session('success')}}</p>
        </div>
    @endif
</div>