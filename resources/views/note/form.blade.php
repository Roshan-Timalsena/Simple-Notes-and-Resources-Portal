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
    <div class="container-fluid">
        <div class="container" style="margin-top: 90px;">
            <a href="{{route('notes.all')}}"><button class="btn btn-primary">View All Notes And Resources</button></a>
            <form action="{{route('note.upload')}}" method="POST" enctype="multipart/form-data" style="margin-top: 20px;">
                @if (Session::get('fail'))
                    <div class="alert alert-danger">
                        {{ Session::get('fail') }}
                    </div>
                @endif
                @csrf
                <h2>Upload Notes and Resources</h2>
                <br>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="title"><b>Note Title</b></label>
                            <input type="text" name="title" class="form-control" placeholder="Note Title" id="note-title" value={{old('title')}}>
                            <span class="text-danger">@error('title'){{$message}} @enderror</span>
                        </div>
                    </div>
                </div>
                <br>

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="file"><b>Upload File (PDF Only)</b></label>
                            <input type="file" name="file" class="form-control" id="file">
                            <span class="text-danger">@error('file'){{$message}} @enderror</span>
                        </div>
                    </div>
                </div>
                <br>

                <div class="row">
                    <div class="col-md-6">

                        <div class="form-group">
                            <label for="link"><b>Share Link</b></label>
                            <input type="text" name="link" class="form-control" id="likn" placeholder="Share Link" value="{{old('link')}}">
                            <span class="text-danger">@error('link'){{$message}} @enderror</span>
                        </div>
                    </div>
                </div>
                <br>
                <button type="submit" class="btn btn-primary">Share Now</button>
            </form>
        </div>
    </div>
</body>

</html>
