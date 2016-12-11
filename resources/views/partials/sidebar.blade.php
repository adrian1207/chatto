<form id="logout-form" action="{{ url('/logout') }}" method="POST">
    {{ csrf_field() }}
    <input type="submit" class="btn btn-primary" value="Wyloguj" />
</form>
