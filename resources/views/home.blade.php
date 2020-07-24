
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel + Vue CSV project</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">

        <!-- Styles -->
        <style>
            html, body {
                background-color: #fff;
                color: #666;
                font-family: 'Nunito', sans-serif;
                font-weight: 200;
                height: 100vh;
                margin: 0;
            }
        </style>
    </head>
    <body>
        <div id="app">
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
        </div>

        <script src="{{ asset('/js/app.js') }}" type="text/javascript"></script>

        <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.14.0/css/all.min.css" rel="stylesheet">

    </body>
</html>
