<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" >
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">
        <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.3/css/jquery.dataTables.min.css">
        
        <!-- Styles -->
        <link rel="stylesheet" href="{{ mix('css/app.css') }}">

        @livewireStyles

        <!-- Scripts -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
        <script src="//code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
        <script src="{{ mix('js/app.js') }}" defer></script>
        <script src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>
        
    </head>
    <body class="font-sans antialiased">
        <x-jet-banner />

        <div class="min-h-screen bg-gray-100">
            @livewire('navigation-menu')

            <!-- Page Heading -->
            @if (isset($header))
                <header class="bg-white shadow">
                    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                        {{ $header }}
                    </div>
                </header>
            @endif

            <!-- Page Content -->
            <main>
                {{ $slot }}
            </main>
        </div>

        @stack('modals')

        @livewireScripts
        @php $baseUrl = env('APP_URL'); @endphp
<script>
    window.baseUrl = <?php echo json_encode($baseUrl) ?>;
</script>
        <script>
    $(document).ready( function () {
        $('#url').DataTable({
        "stateSave": true,
        "responsive" : true,
        "processing": false,
        "deferRender": true,
        "ajax": {
            "url": baseUrl + "dashboard/url/get",
            "dataSrc": ""
        },
        'fnCreatedRow': function (nRow, aData, iDataIndex) {
            $(nRow).attr('id', 'notification-' + aData.id);
        },
        "columns": [
            {
                "render": function (data, type, content, meta) {
                    return content.id;
                }
            },
            {
                "render": function (data, type, content, meta) {
                    return content.title;
                }
            },
            {
                "render": function (data, type, content, meta) {
                    return content.url;
                }
            },
            
            {
                "render": function (data, type, content, meta) {
                    return content.slug;
                }
            },
            {
                "render": function (data, type, content, meta) {
                    return content.created_at;
                }
            },
            {
                sortable: false,
                "render": function (data, type, content, meta) {
                    return '<a class="btn btn-warning copy" data-url="'+ content.slug +'"  onclick="copyToClipboard('+ content.slug +')" data-placement="bottom" data-original-title="'+''+'" >Copy</a>';

                }
            }
        ]
    });
});


$(document).on('click', '.store', function () {
    var form_data = new FormData($('#url-add-form')[0]);
    $("#url-add-form :input").each(
        function () {
            var input = $(this).attr('name');
            var id = input + "-error";
            $('#' + id).html('');
        }
    );
    $.ajax({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        url: baseUrl + "dashboard/url/save",
        method:'POST',
        data : form_data,
        processData: false,
        contentType: false,
        error:function (jqXhr) {
            if (jqXhr.status === 422) {
                let data = jqXhr.responseJSON;
                $.each(data.errors, function (key, val) {
                   $("#" + key + "-error").text(val[0]);

                });
            }
        },
        success:function (response) {
            $('#url-add-modal').modal('hide');
            table = $("#url").DataTable();
            table.ajax.reload(null, false);
        }
    });
});

function copyToClipboard($text) {
    window.prompt("Copy to clipboard: Ctrl+C, Enter", $text);
}
</script>

    </body>
</html>

