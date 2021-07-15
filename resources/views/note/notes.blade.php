<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Note</title>
    <!-- CSS only -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <!-- JavaScript Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>
</head>

<body>

    <a href="{{route('note.add')}}"><button class="btn btn-primary" style="margin-top: 50px; margin-left:120px;">Add New Notes and Resources</button></a>

    <div class="container-fluid">
        <div class="jumbotron">
            <div class="container table-responsive py-5">
                <table class="table table-bordered table-hover">
                    <thead class="thead-dark">
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Note Title</th>
                            <th scope="col">Document</th>
                            <th scope="col">Helpful Link</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>

                    {{-- <tbody>
                        <tr>
                            <td class="down">1</td>
                            <td class="down">Some title</td>
                            <td class="down">Some document</td>
                            <td class="down">Some Link</td>
                        </tr>
                    </tbody>

                    <tbody>
                        <tr>
                            <td class="down">2</td>
                            <td class="down">Some title</td>
                            <td class="down">Some document</td>
                            <td class="down">Some Link</td>
                        </tr>
                    </tbody> --}}
                    
                    <tbody>
                        @forelse($notes as $note)
                        <tr>
                            <td class="down">{{$count++}}</td>
                            <td class="down">{{$note->title}}</td>
                            <td class="down"><a href="{{ asset('/storage/docs').'/'.$note->document }}">{{ $note->document }}</a></td>
                            <td class="down"><a href="{{$note->link}}">{{$note->link}}</a></td>
                            <td class="down"><a href="{{route('notes.remove',['note'=>$note->id])}}">Delete</a></td>
                        </tr>
                        @empty
                        <tr>
                            <td class="down"> NO Notes Yet</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</body>

</html>
