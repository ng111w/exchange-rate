<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />
        <script src="https://cdn.tailwindcss.com"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js" integrity="sha512-AA1Bzp5Q0K1KanKKmvN/4d3IRKVlv9PYgwFPvm32nPO6QS8yH1HO7LbgB1pgiOxPtfeg5zEn2ba64MUcqJx6CA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
        
    </head>
    <style>
        .w-550px{
            min-width:550px;
        }
    </style>
    <body class="antialiased">
        <div class="relative sm:flex sm:justify-center sm:items-center min-h-screen bg-dots-darker bg-center bg-gray-100 dark:bg-dots-lighter dark:bg-gray-900 selection:bg-red-500 selection:text-white">
            
            <div class="max-w-7xl mx-auto p-6 lg:p-8">
                <div class="flex justify-center">
                    
                    <form action="{{ route('search.form',["id" => '/' ]) }}" 
                        class="smart-form" 
                        autocomplete="off">
                      
                        <section class="form-group mb-4 col-md-12">
                            <?php $select_date[""] = "Search by date & time";  ?>
                             {!! Form::select('id', $select_date + $datetime, null, 
                                array('id' => 'datetime_type', 'class' => "w-550px bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 form-control".($errors->has('datetime_type')?" is-invalid":""))) !!} 
                            </section>

                        <div class="input-group">
                            <div class="input-group-btn">
                                <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                                Search
                              </button>
                            </div>
                        </div>
                    {!! Form::close() !!}             
                </div>                
            </div>
        </div>
        @if(Session::has('error_message'))
            <script>
                swal("Error Message", "{!!Session::get('error_message')!!}", 'error',{
                    button:true,
                    button:"Ok",
                    timer:3000,
                    dangerMode:true,
                })
            </script>
        @endif

         @if(Session::has('success_message'))
            <script>
                swal("Message", "{!!Session::get('success_message')!!}", 'success',{
                    button:true,
                    button:"Ok",
                    timer:3000,                            
                })
            </script>
        @endif

    </body>
</html>