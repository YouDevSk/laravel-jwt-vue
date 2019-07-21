@extends('layout.master')
@section('content')
  <div class="uk-container">
    <div class="uk-padding-small">
      <h2 class="uk-title uk-text-bold">Menu</h2>
      {{-- menu dishes --}}
      <div class="uk-section uk-padding-remove-horizontal">
        @foreach ($dishes as $dish)
          <h3 class="uk-title uk-text-bold">{{ $dish->name }}</h3>
            <p>
            <ul>
                @foreach ($dish->ingredients as $dish->ingredient)
                  <li>
                      {{$dish->ingredient->name}}
                  </li>
                @endforeach
            </ul>
            </p>
        @endforeach
      </div>
    </div>
  </div>
@endsection