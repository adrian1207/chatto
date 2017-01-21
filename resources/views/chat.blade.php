@extends('layouts.app')

@section('content')

<div id="chat">
    <div class="container-fluid">
        <div class="row grid">
            <isotope ref="grid" :list="users" :options="isotopeOptions()" v-images-loaded:on.progress="layout">
                <div class="user" v-for="user in users">
                    <user v-on:invite="eventInvite({{ Auth::user()->id }}, user.id)" :user="user" self="{{ Auth::user()->id }}"></user>
                </div>
            </isotope>
            <div class="nobody" v-if="nobody">
                <h2>Niestety, nie ma nikogo spełniajacego Twoje kryteria. :-(</h2>
            </div>
        </div>
    </div>
    <div v-for="(talk, channel) in talks">
        <talk :channel="channel" :messages="talk.messages" :members="talk.members"></talk>
    </div>
</div>
@endsection