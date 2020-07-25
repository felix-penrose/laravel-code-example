@extends('layouts.app')

@section('title', 'Laravel + Vue CSV project')

@section('content')
<div class="container">
    <div class="row">
        <div class="col">
            <h1 class="mt-3">Laravel + Vue mini project example</h1>
            <p>
                From the table below you can use the following functionality
            </p>
            <ul>
                <li>Add a new column to the table</li>
                <li>Add a new row to the table</li>
                <li>Remove a row from the table</li>
                <li>Export the table to a CSV file</li>
                <li>Reset the table after editing anything</li>
            </ul>
        </div>
    </div>
</div>

<c-s-v-generator dusk="csv"></c-s-v-generator>
@endsection
