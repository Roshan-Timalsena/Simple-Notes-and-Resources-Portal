<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Note</title>
    
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
        integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.9.2/dropzone.min.css" integrity="sha512-jU/7UFiaW5UBGODEopEqnbIAHOI8fO6T99m7Tsmqs2gkdujByJfkCbbfPSN4Wlqlb9TGnsuC0YgUgWkRBK7B9A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
        integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous">
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"
        integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous">
    </script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"
        integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous">
    </script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.9.2/min/dropzone.min.js" integrity="sha512-VQQXLthlZQO00P+uEu4mJ4G4OAgqTtKG1hri56kQY1DtdLeIqhKUp9W/lllDDu3uN3SnUNawpW7lBda8+dSi7w==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <style>
        .bg-black {
            background-color: #000000;
        }

    </style>

</head>

<nav class="navbar fixed-top navbar-expand-lg navbar-dark bg-black">
    <a class="navbar-brand" href="#">Notes</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo02"
        aria-controls="navbarTogglerDemo02" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarTogglerDemo02">
        <ul class="navbar-nav mr-auto mt-2 mt-lg-0">
            <li class="nav-item active">
                <a class="nav-link" href="{{route('note.add')}}">Upload <span class="sr-only">(current)</span></a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{route('notes.all')}}">View All Notes</a>
            </li>
        </ul>

        <a href="{{ route('logout') }}"
            onclick="event.preventDefault(); document.getElementById('logout-form').submit();"
            class="btn btn-primary">Logout</a>

        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
            @csrf
        </form>
    </div>
</nav>

<body class="jumbotron">
    <div class="container-fluid">
        <div class="container">
            <form action="{{ route('note.upload') }}" class="dropzone" id="note-upload" method="POST" enctype="multipart/form-data" style="margin-top: 20px;">
                @csrf
                <h2>Upload Notes and Resources</h2>
                <br>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="title"><b>Note Title</b></label>
                            <input type="text" name="title" class="form-control" placeholder="Note Title"
                                id="note-title" value={{ old('title') }}>
                            <span class="text-danger">@error('title'){{ $message }} @enderror</span>
                        </div>
                    </div>
                </div>
                <br>

                <div class="row">
                    <div>
                        <h3 class="text-center">Upload Files by Clicking Below</h3>
                    </div>

                    <div class="dz-default dz-message"><span>Drop Files Here</span></div>
                </div>

                {{-- <div class="row">
                    <div class="col-md-6">
                        <div class="dropzone dz-clickable">
                            <label for="file"><b>Upload File (PDF Only)</b></label>
                            <input type="file" name="file" class="form-control" id="file">
                            <div class="dz-default dz-message"><span>Drop Files Here</span></div>
                            <span class="text-danger">@error('file'){{ $message }} @enderror</span>
                        </div>
                    </div>
                </div> --}}
                <br>

                <div class="row">
                    <div class="col-md-6">

                        <div class="form-group">
                            <label for="link"><b>Share Link</b></label>
                            <input type="text" name="link" class="form-control" id="likn" placeholder="Share Link"
                                value="{{ old('link') }}">
                            <span class="text-danger">@error('link'){{ $message }} @enderror</span>
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
