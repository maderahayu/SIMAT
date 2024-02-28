@extends('layouts.app')

@section('content')
    <h1>Create a Task</h1>
    <form action="{{ route('tugas.store') }}" method="POST">
        <!-- Form fields here -->
        <!-- ... -->
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
@endsection
