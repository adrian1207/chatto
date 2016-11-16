@extends('layouts.app')

@section('content')
<div id="chat">
    <div class="container">
        <div class="row">
            <div class="col-md-2 col-md-offset-1">
                <div class="panel panel-default" v-for="user in users">
                    <div class="panel-heading">@{{ user.nick }}</div>

                    <div class="panel-body">
                        @{{ user.id }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection