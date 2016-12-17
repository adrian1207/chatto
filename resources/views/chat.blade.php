@extends('layouts.app')

@section('content')

<div id="chat">
    <div class="container-fluid">
        <div class="row grid">
            <div class="col-lg-2 user" v-for="user in users" v-on:dblclick="eventInvite({{ Auth::user()->id }}, user.id)">
                <user :user="user"></user>
            </div>
        </div>
    </div>
    <div v-for="(talk, channel) in talks">
        <talk :channel="channel" :messages="talk.messages" :members="talk.members"></talk>
    </div>
</div>
@endsection