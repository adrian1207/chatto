@extends('layouts.app')

@section('content')

<div id="chat">
    <div class="container-fluid">
        <div class="row">
            <div class="grid" v-for="user in users" v-on:dblclick="eventInvite({{ Auth::user()->id }}, user.id)" v-if="user.id != {{ Auth::user()->id }}">
                <user :user="user"></user>
            </div>
        </div>
    </div>
    <div v-for="(talk, channel) in talks">
        <talk :channel="channel" :messages="talk.messages" :members="talk.members"></talk>
    </div>
</div>
@endsection