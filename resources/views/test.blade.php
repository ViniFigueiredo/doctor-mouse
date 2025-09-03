@extends('layouts.base')

<div id="parent-div">
    @section('title')
        Doctor Mouse - Teste
    @endsection
</div>

<button hx-get="/clicked"
    hx-trigger="click"
    hx-target="#parent-div"
    hx-swap="outerHTML">
    Click Me!
</button>