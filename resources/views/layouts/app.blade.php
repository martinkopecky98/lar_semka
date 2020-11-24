<!DOCTYPE html>
<html lang="{{ config('app.locale') }}">

    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <link rel="stylesheet" href="{{asset('css/app.css')}}"> 
        <title>{{config('app.name', 'nazov')}}</title>

    </head>
    <body>
        @include('inc.navbar');
        <div class="container">
            @include('inc.messages')
            @yield('content')
        </div>

        <script src="{{asset('js/app.js')}}"></script>
        <script src="/vendor/unisharp/laravel-ckeditor/ckeditor.js"></script>
        <script>
            CKEDITOR.replace( 'article-ckeditor' );
            </script>
        
        <footer>
            @include('inc.footer');
        </footer>
    </body>

    
    <script src="https://cdnjs.cloudflare.com/ajax/libs/axios/0.21.0/axios.min.js"></script>
    <script
        src="https://code.jquery.com/jquery-3.4.1.min.js"
        integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo="
        crossorigin="anonymous"></script>
        <script type="module">
        $(document).ready(function(){
            axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';
            axios.defaults.headers.common['X-CSRF-TOKEN'] = $('meta[name="csrf-token"]').attr('content');
            $('#formular').submit(function(e){
                e.preventDefault();
                var data = new FormData()
                data.set("text", e.target.childNodes[1].value)
                data.set("_token", "{{ csrf_token() }}")
                
               axios.post("http://localhost:8080/lar_semka/public/todo", data)
               .then(function (response) {
                        console.log(response.data);
                        vypis(response.data)
                    })
                    .catch(function (error) {
                        console.log(error);
                })
                
                // //console.log("submit");
                // //console.log(e.target.childNodes[1].value);
                // $.ajaxSetup({
                //     beforeSend: function(xhr) {
                //         xhr.setRequestHeader("CSRF-Token" , "{{ csrf_token() }}");
                //     }
                // });
                // $.ajax({
                //     url : "{{ url("/todo")}}",
                //     method: "post",
                //     data : {text: e.target.childNodes[1].value, _token: "{{ csrf_token() }}"},
                //     success: function(result) {
                //         console.log(result[0]);
                //         vypis(result);
                //     }
                // });
            });

            function vypis(pole){
                var polee = '';
                for (let index = 0; index < pole.length; index++) {
                    //console.log(som tu);
                    polee += /*"<li> <a class="btn" href="./contact">Vymazat</a>*/ "<li>" + pole[index].text +"</li>"+
                    "<a class='btn' href='{{ url('todo/delete/') }}/"+pole[index].id+"'>Vymazat</a>";
                    "<a class='btn' href='{{ url('todo/edit/') }}/"+pole[index].id+"'>Upravit</a>";
                    //console.log(uz tu niesom);
                }
                $('#vypis').html(polee);
            }
            
        });
    </script>
</html>
