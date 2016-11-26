@extends('layouts.app')

@section('content')

<div id="chat">
    <div class="container-fluid">
        <div class="row">
            <div v-for="user in users" v-on:dblclick="invite({{ Auth::user()->id }}, user.id)" v-if="user.id != {{ Auth::user()->id }}">
                <user :user="user"></user>
            </div>
        </div>
    </div>
    <div v-for="(talk, channel) in talks">
        <talk :channel="channel" :messages="talk.messages"></talk>
    </div>
</div>
@endsection